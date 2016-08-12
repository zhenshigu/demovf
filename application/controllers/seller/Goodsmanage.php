<?php
//婚纱套餐管理系统，功能包括创建新的婚纱套餐，删除等等。
class Goodsmanage extends CI_Controller{
    protected $savePath;
    protected $pageCount=8;//分页用，每页显示n条记录

    public function __construct() {
        parent::__construct();
        $this->config->load('my_sys_config');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('Fileupload');
        $this->load->library("Mypagination");
        $this->load->library('Commonuse');
        $this->load->library('Account_errors');
        $this->load->helper(array('form', 'url'));
        $this->load->model('sellerm/Goods');
        $isLogined=  isset($_SESSION['sid']);
        if(!$isLogined){
            redirect('/seller/Saccount/login', 'refresh');
        }
        $this->savePath= $this->config->item('tc_img').$_SESSION['sid'];//设置上传图片的保存路径
    }
    //新建婚纱套餐
    function createNewtc(){
        $this->form_validation->set_rules('name', '套餐名', 'trim|required');
        $this->form_validation->set_rules('price', '套餐价格', 'trim|required|numeric');
        $this->form_validation->set_rules('description', '描述', 'trim|required');
        $this->form_validation->set_rules('content','详情','trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['base_url']=  base_url();
            $this->load->view('sellerv/nav',$data);
           $this->load->view('sellerv/Createtcv');
        }  else {
            //保存套餐图片
            $this->fileupload-> set("path",  $this->savePath);
             if($this->fileupload-> upload("pic")) {
                 $imgs=$this->fileupload->getFileName();
                 //生成套餐缩略图
                 $thumbnail=$imgs[0];
                 $tmp_thumb=  explode('.', $thumbnail);
                 $thumbnail=$tmp_thumb[0].'_thumb.'.$tmp_thumb[1];
                 $oriPath=  $this->config->item('tc_img').$_SESSION['sid'].'/'.$imgs[0];
                 $thumbnailPath=$this->config->item('tc_img').$_SESSION['sid'].'/'.$thumbnail;
                 $createThumb=@$this->commonuse->createThumb($oriPath,$thumbnailPath);
                 if($createThumb){
                     $data['thumbnail']=&$thumbnail;
                 }
                 $imgUrl=  json_encode($imgs);               
                 $data['gname']=  $this->input->post('name',TRUE);
                 $data['gprice']=  $this->input->post('price',TRUE);
                 $data['gdescription']=  $this->input->post('description',TRUE);
                 $data['gcontent']=  $this->input->post("content",TRUE);
                 $data['gimg']=$imgUrl;        
                 $data['sid']=$_SESSION['sid'];
                 if($this->Goods->newTaocan($data)){
                     $data['msg']='新建套餐成功';

                 }  else {
                     $data['msg']='新建套餐失败';
                 }
                    $data['base_url']=  base_url();
                    $this->load->view('sellerv/nav',$data);
                   $this->load->view('sellerv/Createtcv');
             }  else {
                 print_r($this->fileupload->getErrorMsg());
             }
        }   
    }
    //删除婚纱套餐
    function deletetc($gid){
        //获取套餐信息，用来删除套餐图片
        $tc=  $this->Goods->gettc($gid);
        if($this->Goods->deletetc($gid)){         
            $imgurl=  json_decode($tc['gimg']);
            //删除套餐图片
            foreach ($imgurl as $img){
                $i=$this->config->item('tc_img').$_SESSION['sname']."/".$img;
//                 unlink ($i); //删除本地文件,暂时不用
            }             
         }
    }
//分页查看商家套餐
    function showAlltc($startRecord=0){
      //获得当前商家所有的套餐数量
      $totalTaocan=  $this->Goods->totaltc($_SESSION['sid']);
      if (!$totalTaocan){
//                $this->load->view('webviews/nav');
                echo "暂时还没有添加套餐";
                return ;
        }
        $from=  intval($startRecord);
        if (empty($from)){
                $from=0;
        }
        $data=array($_SESSION['sid'],$from,  $this->pageCount);
        if($res=$this->Goods->sometc($data)){
            foreach ($res as &$tc){
                $tc['thumbnail']=  $this->config->item('http_tc_img').$_SESSION['sid'].'/'.$tc['thumbnail'];              
            }
                $baseurl= base_url().'seller/goodsmanage/showAlltc/';
                $nevigation=$this->mypagination->paginagtion($this->pageCount,$totalTaocan,$from,$baseurl);
                $tmp['base_url']=  base_url();
                $this->load->view('sellerv/nav',$tmp);
                $this->load->view('sellerv/Showtcv',array('res'=>$res,'nevigation'=>$nevigation));
        }  else {
            echo '获取套餐失败';
        }
  }
  //修改查看指定套餐的具体内容
  function tcdetail($gid){
      $gid=  $this->security->xss_clean($gid);
      $edit=$this->input->post('editBut');
      //编辑套餐文字内容,通过AJAX请求
      if($edit){
          $params=array('name','price','description','content');
          if(!$this->commonuse->checkParams($params)){
              $data['msg']=  Account_errors::RET_FIELD_NULL;
          }  else {
            $data['gname']=  $this->input->post('name');
            $data['gprice']=  $this->input->post('price');
            $data['gdescription']=  $this->input->post('description');
            $data['gcontent']=  trim($this->input->post('content'));
            $data['gcontent']=str_replace("\r", "<br>", $data['gcontent']) ;
            if($this->Goods->updatetc($data,$gid)){
                $data['msg']=  Account_errors::RET_UPDATE_SUCCESS;
            }  else {
                $data['msg']=  Account_errors::RET_UPDATE_FAILED;
            }
          }
          echo $data['msg'];
          return;
      }
       //查看套餐详情
      if($res=  $this->Goods->gettc($gid)){
          $imgurls=  json_decode($res['gimg']);
          if($imgurls){
            foreach ($imgurls as &$url){
                $url=  $this->config->item('http_tc_img').$_SESSION['sid']."/".$url;
            } 
          }
          $res['base_url']=  base_url();
          $res['gimg']=$imgurls;
          $res['extra_info']=  $this->load->view('sellerv/extra/tcdetail_ev',NULL,TRUE);
          $this->load->view('sellerv/nav',$res);
          $this->load->view('sellerv/tcdetailv');
      }  else {
          echo '套餐不存在';
      }
  }
//ajax删除套餐图片
    function deltcImg(){
//        $this->output->enable_profiler(TRUE);
        $params=array('imgUrl','gid');
        if(!$this->commonuse->checkParams($params)){
              $data['msg']=  Account_errors::RET_FIELD_NULL;
          }  else {
              $imgUrl=  $this->input->post('imgUrl',TRUE);
              $gid=  $this->input->post('gid',TRUE);       
               $imgSeverUrl=  str_replace(base_url(), './', $imgUrl);
               $imgName=  ltrim(strrchr($imgSeverUrl, '/'),'/');
               $img_path=  $this->config->item('tc_img').$_SESSION['sid'].'/'.$imgName;
               @unlink($img_path);
               $preimgNames=  $this->Goods->getImgNames($gid);
               if(!empty($preimgNames)){
                   $newImgNames= array_values(array_diff($preimgNames, array($imgName)));

                   if($this->Goods->setImgNames($gid,$newImgNames)){
                       $data['msg']=  Account_errors::RET_DELETE_SUCCESS;
                   }  else {
                       $data['msg']=  Account_errors::RET_DELETE_FAILED;
                   }
               }  else {
                   $data['msg']=  Account_errors::RET_DB_ERROR;
               }
          }
          echo $data['msg'];       
    }
//上传套餐图片
    function upimg($gid){
        $gid=  $this->security->xss_clean($gid);
        $edit=$this->input->post('editBut');
        if($edit){
           //保存套餐图片
            $this->fileupload-> set("path",  $this->savePath);
             if($this->fileupload-> upload("pic")) {
                 $imgNames=  $this->fileupload->getFileName();
                 $preImg=  $this->Goods->gettc($gid,'gimg');
                 $preImgNames=  json_decode($preImg['gimg']);
                 $newImgNames=  json_encode(array_merge($imgNames,$preImgNames));
                 if($this->Goods->updatetc(array('gimg'=>$newImgNames),$gid)){                  
                     $data['msg']=  Account_errors::RET_UPDATE_SUCCESS;
                 }  else {
                     $data['msg']=  Account_errors::RET_UPDATE_FAILED;
                 }
             }
       }
        $data['base_url']=  base_url();
        $data['gid']=$gid;
        $this->load->view('sellerv/nav',$data);
        $this->load->view('sellerv/Upimg_v');
    }
}
