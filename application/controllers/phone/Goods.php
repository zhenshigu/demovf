<?php
require 'vendor/autoload.php';
//客户端用来查看商品的控制器
class Goods extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('phonem/Goodsm');
        $this->load->helper('url');
        $this->config->load('my_sys_config');
    }
    
    //手机端获取婚纱摄影套餐列表
    function hsList($city='深圳市'){
        $city=  $this->security->xss_clean($city);
        $conf['city']=$city;
        $res=  $this->Goodsm->ogetes($conf);
        $data=array();
        if($res){    
            foreach ($res as &$tc){
                $tc['thumbnail']=  $this->config->item('http_tc_img').$tc['sid'].'/'.$tc['thumbnail'];              
            }
        }         
	$data['base_url']=  base_url();
        $data['res']=$res;

        $this->load->view('clientm/Hstcv',$data);
    }
    //异步获取婚纱摄影套餐列表,每次默认返回5条记录
    function ajaxHstc(){
        header("Content-Type:application/json");
        $city=  $this->input->post('city',TRUE);
        $sid=  $this->input->post('sid',TRUE);
        $offset=  $this->input->post('offset',TRUE);
        $limit=10;
        if($city){
            $conf['city']=$city;
        }
        if($sid){
            $conf['sid']=$sid;
        }
        $res=  $this->Goodsm->ogetes($conf,'*',$limit,$offset);
        if($res){    
            foreach ($res as &$tc){
                $tc['thumbnail']=  $this->config->item('http_tc_img').$tc['sid'].'/'.$tc['thumbnail'];              
            }
            echo json_encode($res);
        }  else {
            echo json_encode(array());
        }
    }
    //根据商家编号异步获取婚纱摄影套餐列表,每次默认返回10条记录
    function ajaxHstcSid(){
        header("Content-Type:application/json");
        $sid=  $this->input->post('sid',TRUE);
        $offset=  $this->input->post('offset',TRUE);
        $limit=10;
        if($sid){
            $conf['sid']=$sid;
        }  else {
            echo json_encode(array());
        }
        $res=  $this->Goodsm->tget($conf,'*','goods',$limit,$offset);
        if($res){    
            foreach ($res as &$tc){
                $tc['thumbnail']=  $this->config->item('http_tc_img').$tc['sid'].'/'.$tc['thumbnail'];              
            }
            echo json_encode($res);
        }  else {
            echo json_encode(array());
        }
    }
    //查看婚纱套餐详情
    function hsdetail($gid,$sid){
        $gid=  $this->security->xss_clean($gid);
        $sid=  $this->security->xss_clean($sid);
        $conf['gid']=$gid;
        $res=  $this->Goodsm->oget($conf);
        if($res){
            $imgurls=  json_decode($res['gimg']);
            if($imgurls){
              foreach ($imgurls as &$url){
                  $url=  $this->config->item('http_tc_img').$sid."/".$url;
              } 
            }
            $res['gimg']=$imgurls;
        }
	$res['base_url']=  base_url();
        $this->load->view('clientm/Hsdetailv',$res);
    }
    //获取门店列表
    function storeList($city='深圳市'){
        $city=  $this->security->xss_clean($city);
        if(!$city){
            echo 0;
            return;
        }
        $conf['city']=&$city;
        $field='sid,nickname,headimg,city,district,address';
        $res=  $this->Goodsm->tget($conf,$field,'seller');
        if($res){
            foreach ($res as &$tc){
                $tc['headimg']=  $this->config->item('http_tc_img').$tc['sid'].'/headimg/'.$tc['headimg'];              
            }
        }
        $data['res']=$res;
        $data['base_url']=  base_url();
        $this->load->view('clientm/Storelistv',$data);
    }
    //异步获取门店列表
    function ajaxStore(){
        $city=  $this->input->post('city',TRUE);
        if(!$city){
            echo 0;
            return;
        }
        $conf['city']=&$city;
        $field='sid,nickname,headimg,city,district,address';
        $res=  $this->Goodsm->tget($conf,$field,'seller');
        if($res){
            foreach ($res as &$tc){
                $tc['headimg']=  $this->config->item('http_tc_img').$tc['sid'].'/headimg/'.$tc['headimg'];              
            }
        }
        echo json_encode($res);
    }
    //获取门店详情
    function storeDetail($sid){
        $sid=  $this->security->xss_clean($sid);
        $conf['sid']=$sid;
        $field='sid,nickname,headimg,cellphone,sphone,semail,province,city,district,address,board';
        $res1=  $this->Goodsm->tget($conf,$field,'seller');
        $field='sid,gid,gname,gprice,thumbnail';
        $res2=  $this->Goodsm->tget($conf,$field);
        if($res1){
            foreach ($res1 as &$one){
                $one['headimg']=$this->config->item('http_tc_img').$one['sid'].'/headimg/'.$one['headimg'];
            }
            $data['res1']=$res1[0];
        }
        if($res2){
            foreach ($res2 as &$one){
                $one['thumbnail']=  $this->config->item('http_tc_img').$one['sid'].'/'.$one['thumbnail'];
            }
        }
        $data['base_url']=  base_url();
        $data['res2']=$res2;
        $this->load->view('clientm/Storetc',$data);
    }
    //提交订单
    function addOrder(){
        //判断是否登录
        if(!$this->is_login){
            echo -1;
            return;
        }
        $userid=  $this->_userid;
        $gid=  $this->input->post('gid',TRUE);
        if(!$gid||!$userid){
            echo 0;
            return;
        }
        $conf['gid']=&$gid;
        $field="gid,gname,gprice,gdescription,sid,thumbnail";
        $res=  $this->Goodsm->oget($conf,$field);
        if($res){
            $data['odate']=  time();
            $data['ostatus']=1;
            $data['oname']=$res['gname'];
            $data['oprice']=$res['gprice'];
            $data['odescription']=$res['gdescription'];
            $data['thumbnail']=$res['thumbnail'];
            $data['userid']=&$userid;
            $data['sid']=$res['sid'];
            $data['gid']=$res['gid'];
            if($this->Goodsm->addrecord($data,'customer_order')){
                echo 1;
                //send new order email to notify me
                $mail = new PHPMailer;
                //$mail->SMTPDebug = 3;                               // Enable verbose debug output
                $mail->CharSet = "utf-8"; 
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.viewfuns.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'notify@viewfuns.com';                 // SMTP username
                $mail->Password = $this->config->item('notify_email');                           // SMTP password
//                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 25;                                    // TCP port to connect to

                $mail->setFrom('notify@viewfuns.com');
                $mail->addAddress('cds@viewfuns.com');     // Add a recipient
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = '你有新的订单';
                $mail->Body    = '用户编号:'.$data['userid'].'<br>下单时间:'.date('Y-m-d H:i:s',$data['odate']).'<br>'
                        . '套餐编号:'.$data['gid'].';套餐名称:'.$data['oname'].';套餐价格:'.$data['oprice'].'<br>'
                        . '套餐描述:'.$data['odescription'].'<br>'.'商家编号:'.$data['sid'];
                $mail->AltBody = '你有新的订单，请注意查看';
                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message has been sent';
                }
                return;
            }
        }
        echo 0;
    }
    //查看个人订单
    function myorder($userid){
        $userid=  $this->security->xss_clean($userid);
        if(!$userid){
            echo 0;
            return;
        }
        $conf['userid']=$userid;
        $t1='customer_order';
        $t2='seller';
        $join_conf='customer_order.sid=seller.sid';
        $field='odate,oprice,oid,oname,ostatus,odescription,seller.sid,gid,nickname,thumbnail,userid';
        $res=  $this->Goodsm->mtget($conf,$t1,$t2,$join_conf,$field,10);
        if($res){
            foreach ($res as &$one){
                $one['thumbnail']=  $this->config->item('http_tc_img').$one['sid'].'/'.$one['thumbnail'];
            }
        }
        $data['base_url']=  base_url();
        $data['res']=$res;
        $this->load->view('clientm/Myorder',$data);
    }
    //异步获取个人订单
    function ajaxMyorder(){
        $userid=  $this->input->post('userid',TRUE);
        if(!$userid){
            echo 0;
            return;
        }
        $conf['userid']=$userid;
        $t1='customer_order';
        $t2='seller';
        $join_conf='customer_order.sid=seller.sid';
        $field='odate,oprice,oid,oname,ostatus,odescription,seller.sid,gid,nickname,thumbnail,userid';
        $res=  $this->Goodsm->mtget($conf,$t1,$t2,$join_conf,$field,10);
        if($res){
            foreach ($res as &$one){
                $one['thumbnail']=  $this->config->item('http_tc_img').$one['sid'].'/'.$one['thumbnail'];
            }
        }
        echo json_encode($res);
    }
    //修改订单状态
    function setStatus(){
        $oid=  $this->input->post('oid',TRUE);
        $userid=  $this->input->post('userid',TRUE);
        $ostatus=  $this->input->post('ostatus',TRUE);
        if(!$oid||!$userid||!$ostatus){
            echo 0;
            return;
        }
        $conf['oid']=&$oid;
        $conf['userid']=&$userid;
        $arr['ostatus']=&$ostatus;
        if($this->Goodsm->updaterecord($conf,$arr)){
            echo 1;
        }  else {
            echo 0;
        }
    }
    //删除订单
    function delorder(){
        $oid=  $this->input->post('oid',TRUE);
        $userid=  $this->input->post('userid',TRUE);
        if(!$oid||!$userid){
            echo 0;
            return;
        }
        $conf['oid']=&$oid;
        $conf['userid']=&$userid;
        
    }
    //显示评价页面
    function showComment($oid,$accessToken){
        
    }
    //评价订单
    function ajaxComment(){
        $oid=  $this->input->post('oid',TRUE);
        $userid=  $this->input->post('userid',TRUE);
        $theComment=  $this->input->post('theComment',TRUE);
        if(!$oid||!$userid||!$theComment){
            echo 0;
            return;
        }
        $conf['oid']=&$oid;
        $conf['userid']=&$userid;
        $arr['criticism']=&$theComment;
        if($this->Goodsm->updaterecord($conf,$arr)){
            echo 1;
        }  else {
            echo 0;
        }
    }
    
}
