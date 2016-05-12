<?php
class Ordermanage extends CI_Controller{
    protected $redis_newo;//保存在redis的新订单队列，存放新订单消息
    protected $redis_delo;//保存在redis的取消订单队列，存在取消订单消息
    protected $redis_newo_result;//存放新订单内容
    protected $redis_delo_result;//存放取消订单内容
    protected $pageCount=2;//分页用，每页显示的记录数
    public function __construct() {
        parent::__construct();
        $this->config->load('my_sys_config');
        $this->load->library(array('session','Commonuse','Predis','Mypagination'));
        $this->load->helper(array('form', 'url'));
        $this->load->model('sellerm/Orderm');
        //检查是否已经登录
        $isLogined=  isset($_SESSION['sid']);
        if(!$isLogined){
            redirect('/seller/Saccount/login', 'refresh');
        }
        $this->redis_newo='new:sid:'.$_SESSION['sid'];
        $this->redis_delo='del:sid:'.$_SESSION['sid'];
        $this->redis_newo_result='new:sid:'.$_SESSION['sid'].':r';
        $this->redis_delo_result='del:sid:'.$_SESSION['sid'].':r';
    }
    function index(){
        
    }
    //查看是否有新的订单或者订单取消消息，若有则返回订单信息;
    //新订单编号数组放在redis存放一天,当有新订单时进行覆盖
    function hasNewOrder(){
//        $this->output->enable_profiler(TRUE);
        $size_new=  $this->predis->lSize($this->redis_newo);
        $size_del=  $this->predis->lSize($this->redis_delo);
        $order_new=$order_del=array();
        if($size_new>0){
            $oids=  $this->predis->lRange($this->redis_newo,0,-1);
            $fields='oid,odate,ostatus,oname,oprice,customer_order.userid,sid,gid,snapshot,customer_account.username';
            $order_new= $this->Orderm->getOrders($oids,$fields); 
            if($order_new){
                foreach ($order_new as &$order){
                    $order['odate']=  date("Y-m-d H:i:s",$order['odate']);
                }
                $this->predis->delete($this->redis_newo);
                //取消缓存
//                $order_new_copy= json_encode($order_new); 
//                $this->predis->set($this->redis_newo_result,$order_new_copy);
//                $now = time(); // current timestamp
//                $this->predis->expireAt($this->redis_newo_result, $now + 3600);    // x will disappear in 3600 seconds.               
            }           
        }
        if($size_del>0){
            $oids=$this->predis->lRange($this->redis_delo,0,-1);           
            $order_del= $this->Orderm->getOrders($oids); 
            if($order_del){
                $this->predis->delete($this->redis_delo);
                $order_del_copy=  json_encode($order_del);
                $this->predis->set($this->redis_delo_result,$order_del_copy);
                $now = time(); // current timestamp
                $this->predis->expireAt($this->redis_delo_result, $now + 3600);    // x will disappear in 3600 seconds.
            }            
        }
       
        $output=array('hasnew'=>$size_new,'hasdel'=>$size_del,'ordernew'=>$order_new,'orderdel'=>$order_del);
        echo json_encode($output);
    }
    //返回符合条件的订单列表并进行分页
    function ordersList($offset=0){
//        $this->output->enable_profiler(TRUE);
//        $this->benchmark->mark('dog_start');
        $ostatus=  $this->input->post('ostatus');
        $ostatus=intval($ostatus);
        if(!empty($ostatus)){
            $data['ostatus']=&$ostatus ;
        }
        $data['sid']=&$_SESSION['sid'];
        $total=  $this->Orderm->ocount($data);
        if(!$total){
            $data['total']=0;
             $data['base_url']=  base_url();
             $data['res']=array();
             $data['nevigation']='';
            $this->load->view('sellerv/nav',$data);
            $this->load->view('sellerv/Showorders');
            return;
        }
        $offset=  intval($offset);
        if(!$offset){
            $offset=0;
        }  else {
            $offset=$offset-$offset%$this->pageCount;
        }
        $res=  $this->Orderm->ogetes($data,'*',  $this->pageCount,$offset);
        if($res){
            $theurl=  $this->config->item('ctl_dir').'Ordermanage/ordersList/';
            $nevigation=$this->mypagination->paginagtion($this->pageCount,$total,$offset,$theurl);
            $data['base_url']=  base_url();
            $data['total']=$total;
            $this->load->view('sellerv/nav',$data);
            $this->load->view('sellerv/Showorders',array('res'=>$res,'nevigation'=>$nevigation));
        }  else {
            echo '获取套餐失败';
        }
//        $this->benchmark->mark('dog_end');
        
    }
    //从mysql获取今天的新预约单数据
    function newOrdersList(){
//        $newOL= json_decode($this->predis->get($this->redis_newo_result));
         $year=  date('Y');
        $month=date('m');
        $day=  date('d');
        $time=  mktime(0, 0, 0,$month,$day,$year);//获取今天0点的unix时间戳
        $conf['sid']=$_SESSION['sid'];
        $conf['odate >=']= $time;
        $fields='oid,odate,ostatus,oname,oprice,customer_order.userid,sid,gid,snapshot,customer_account.username';
        $newOL=  $this->Orderm->ogetes($conf,$fields);
        if($newOL){
            $data['res']=$newOL;
        }  else {
            $data['res']= array();
        }
        $data['base_url']=  base_url();
        $this->load->view('sellerv/nav',$data);
        $this->load->view('sellerv/Newordersv');
    }
}