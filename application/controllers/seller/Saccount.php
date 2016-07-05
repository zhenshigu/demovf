<?php
//商店账号管理类，包括登录验证注册等功能
class Saccount extends CI_Controller{
//    protected $headImgPath='';
//    protected $headWidth=120;
//    protected $headHeight=120;
//    public function __construct() {
//        parent::__construct();
//         $this->config->load('my_sys_config');
//        $this->load->library('form_validation');
//        $this->load->library(array('session','Fileupload','Commonuse','email','Predis'));
//        $this->load->library('Account_errors');       
//        $this->load->helper(array('form', 'url'));
//        $this->load->model('sellerm/Saccountm');
//        $this->load->model('sellerm/Orderm');
//        $isLogined=  isset($_SESSION['sid']);
//        $tologin=($this->router->method=="login");
//        $toregister=($this->router->method=="register");
//        $toverifyemail=($this->router->method=="verifyEmail");
//        $toforgot=($this->router->method=='forgotPwd');
//        if(!$isLogined&&(!$tologin&!$toregister&!$toverifyemail&!$toforgot)){
//               redirect('/seller/Saccount/login', 'refresh');
//        }
//        if(isset($_SESSION['sid'])){
//           $this->headImgPath=$this->config->item('tc_img').$_SESSION['sid'].'/headimg';
//        }       
//    }
//    //商家首页
//    function index(){
//        $data['base_url']=  base_url();
//        $data['username']=$_SESSION['semail'];
//        $data['nickname']=$_SESSION['nickname'];
//        $data['cellphone']=$_SESSION['cellphone'];
//        $data['sphone']=$_SESSION['sphone'];
//        $data['address']=$_SESSION['province'].$_SESSION['city'].$_SESSION['district'].$_SESSION['address'];
//        $data['headimg']=$_SESSION['headimg'];
//        //获取前8条订单
//        $fields='oid,odate,ostatus,oname,oprice,customer_order.userid,sid,gid,snapshot,customer_account.username';
//        $ordesList=  $this->Orderm->ogetes(array('sid'=>$_SESSION['sid']),$fields,8,0);
//        $data['res']=$ordesList;
//        $this->load->view("sellerv/nav",$data);
//        $this->load->view('sellerv/Index');
//    }
//    //注册
//    function register(){
//        $this->form_validation->set_rules('email', '用户名', 'trim|required|valid_email|is_unique[seller.semail]');
//        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
//        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|min_length[6]|matches[password]');
//        if ($this->form_validation->run() == FALSE)
//        {
//               $data['base_url']=  base_url();
//            $this->load->view("sellerv/nav",$data); 
//              $this->load->view("sellerv/Sregisterv");
//        }
//        else
//        {
//              $info=$this->input->post(NULL,TRUE);
//              $data['semail']=  $info['email'];
//              $data['spwd']=$info['password'];
//              $data['regtime']=  time();          
//              $data['token']=  md5($data['semail'].time());
//              $url_email=  urlencode($data['semail']);
//              //将注册信息存放到redis缓存一天，等待验证
//              if($this->predis->hMset($url_email,$data)){
//                     $this->predis->expire($url_email,3600*24);
//                    $this->email->from('hscycg@163.com', 'hscycg');
//                    $this->email->to('641337590@qq.com');
//                    $verify_url=  base_url().'seller/Saccount/verifyEmail/'.$url_email.'/'.$data['token'];
//                    $this->email->subject('verify email');
//                    $this->email->message($verify_url);
//                    if($this->email->send()){
//                        echo '注册成功，去邮箱进行账号激活';
//                    }  else {
//                        echo '发送失败';
//                        echo $this->email->print_debugger();
//                    }
//              }else {                    
//                      echo "缓存服务器出错,注册失败";
//              }
//        }
//    }
//    //验证邮箱，激活账号
//    function verifyEmail($base64_email,$token){
//        $base64_email= urlencode($this->security->xss_clean($base64_email));
//        $token=  $this->security->xss_clean($token);
//        if(empty($base64_email)||empty($token)){
//            echo '参数空，链接无效';
//        }  else if($cacheToken=$this->predis->hget($base64_email,'token')){
//            if($token==$cacheToken){
//                $data=  $this->predis->hMget($base64_email,array('semail','regtime','spwd'));
//                if($this->Saccountm->register($data)){
//                    echo '账号激活成功,请登录网站';
//                    $this->predis->delete($base64_email);
//                }  else {
//                    echo '账号激活错误,请刷新重试';
//                }
//            }  else {
//                echo 'token无效，链接无效';
//            }
//        }  else {
//            echo '链接已经失效，请重新注册账号';
//        }
//    }
//    //登录,通过邮箱进行登录
//    function login(){
//        if(isset($_SESSION['sid'])){
//            redirect('/seller/Saccount/index', 'refresh');
//        }
//        $this->form_validation->set_rules('email', '用户名', 'trim|required|valid_email');
//        $this->form_validation->set_rules('password', '密码', 'trim|required');
//        if ($this->form_validation->run() == FALSE)
//        {
//            $data['base_url']=  base_url();
//            $this->load->view("sellerv/nav",$data);
//              $this->load->view("sellerv/Sloginv");
//        }
//        else
//        {
//            $info=  $this->input->post(NULL,TRUE);
//            $data['semail']=$info['email'];
//            $data['spwd']=$info['password'];
//            $userInfo=$this->Saccountm->login($data);
//            if(empty($userInfo)){               
//                  $data['msg']=Account_errors::RET_LOGIN_FAILED;  
//                $data['base_url']=  base_url();
//                $this->load->view("sellerv/nav",$data);
//                $this->load->view("sellerv/Sloginv");
//                return;
//            }  else {
//                $_SESSION['sid']=$userInfo['sid'];
//                $_SESSION['nickname']=$userInfo['nickname'];
//                $_SESSION['headimg']=  $this->config->item('http_tc_img').$_SESSION['sid'].'/headimg/'.$userInfo['headimg'];
//                $_SESSION['spwd']=$userInfo['spwd'];
//                $_SESSION['semail']=$userInfo['semail'];
//                $_SESSION['cellphone']=$userInfo['cellphone'];
//                $_SESSION['sphone']=$userInfo['sphone'];
//                $_SESSION['province']=$userInfo['province'];
//                $_SESSION['city']=$userInfo['city'];
//                $_SESSION['district']=$userInfo['district'];
//                $_SESSION['address']=$userInfo['address'];
//                redirect('/seller/Saccount/index', 'refresh');
//            }
//        }
//    }
//    //退出
//    function logout(){
//        if(session_destroy()){
//            redirect('/seller/Saccount/login', 'refresh');
//        }  else {
//            echo '退出失败';
//        }
//    }
//    //上传裁剪头像
//    function setHeadImg(){
//        $isSetHead=$this->input->post('uphead');
//        $iscrop=  $this->input->post('crophead');
//        $abspath='';
//        $filetype='';
//        $msg='';
//        //上传原始图片
//        if(!empty($isSetHead)){
//            $this->fileupload-> set("path",$this->headImgPath);
//             if($this->fileupload-> upload("pic")) {
//                 $abspath=  $this->headImgPath.'/'.$this->fileupload->getFileName();
//                 $this->session->set_flashdata('abspath', $abspath);
//                 $filetype=  $this->fileupload->getFileType();
//                 list($width,$height)=  getimagesize($abspath);
//                 $ret_info=array('imgpath'=>$abspath,'width'=>$width,'height'=>$height);
//                 //返回图片保存路径，宽度和长度
//                echo $this->config->item('http_tc_img').$_SESSION['sid'].'/headimg/'.$this->fileupload->getFileName();
//                 exit();
//             }  else {
//                 echo $this->fileupload->getFileType();
//                 var_dump($this->fileupload->getErrorMsg());
//             }
//             exit();
//        }
//        if(!empty($iscrop)){
//            //检查传递过来的参数是否存在
//            $params=array('desx','desy','desw','desh');
//            if(!$this->commonuse->checkParams($params)){
//                $data['msg']=  Account_errors::RET_FIELD_NULL;
//            }  else {
//                $desx=  $this->input->post('desx');
//                $desy=  $this->input->post('desy');
//                $desw=  $this->input->post('desw');
//                $desh=  $this->input->post('desh');
//                $jpeg_quality = 90;
//                $abspath=  $this->session->flashdata('abspath');
//                $originalImg=  imagecreatefromjpeg($abspath);
//                if($originalImg){
//                    $newImg=ImageCreateTrueColor($this->headWidth,  $this->headHeight);
//                    if($newImg){
//                        imagecopyresampled($newImg, $originalImg, 0, 0, $desx, $desy, $this->headWidth, $this->headHeight, $desw, $desh);
//                        if(imagejpeg($newImg,$abspath,$jpeg_quality)){
//                            $msg= '裁剪成功';
//                            $data['headimg']=  basename($abspath);
//                            $this->Saccountm->updateProfile($_SESSION['sid'],$data);
//                            $_SESSION['headimg']=str_replace('../',  base_url(), $abspath);
//                        }  else {
//                            $this->session->set_flashdata('abspath', $abspath);
//                            echo '裁剪失败';
//                        }
//                    }  else {
//                        $this->session->set_flashdata('abspath', $abspath);
//                        echo '生成裁剪图错误';
//                    }
//                }  else {
//                    echo '打开原图片错误';
//                }
//            }
//        }
//        $data['msg']=$msg;
//        $data['base_url']=  base_url();
//        $data['extra_info']=  $this->load->view('sellerv/extra/sethead_ev',array('base_url'=>  base_url()),TRUE);
//        $this->load->view("sellerv/nav",$data);
//        $this->load->view('sellerv/Setheadv');
//    }
//    //查看,设置商家资料
//    public function setProfile(){
//        //设置商家资料
//        $isModify=  $this->input->post('setprofile');
//        if($isModify==1){
//                $data['nickname']=  $this->input->post('nickname',TRUE);
//                $data['cellphone']=  $this->input->post('cellphone',TRUE);
//                $data['sphone']=  $this->input->post('sphone',TRUE);
//                $data['province']=  $this->input->post('province',TRUE);
//                $data['city']=  $this->input->post('city',TRUE);
//                $data['district']=  $this->input->post('district',TRUE);
//                $data['address']=  $this->input->post('address',TRUE);
//                if($data['province']=="请选择"){
//                    $data['province']='';
//                }
//                if($data['city']=="请选择"){
//                    $data['city']='';
//                }
//                if($data['district']=="请选择"){
//                    $data['district']='';
//                }
//                if(!$data['province']||!$data['city']){
//                    echo Account_errors::RET_FIELD_NULL;
//                    return;
//                }
//                if($this->Saccountm->updateProfile($_SESSION['sid'],$data)){
//                    $_SESSION['nickname']=$data['nickname'];
//                    $_SESSION['province']=$data['province'];
//                    $_SESSION['city']=$data['city'];
//                    $_SESSION['district']=$data['district'];
//                    $_SESSION['address']=$data['address'];
//                    $_SESSION['cellphone']=$data['cellphone'];
//                    $_SESSION['sphone']=$data['sphone'];
//                    
//                    echo  1;
//                    return;
//                }  else {
//                    echo 0;
//                    return;
//                }
//        }
//        //查看商家资料
//        $data['base_url']=  base_url();
//        $data['extra_info']=  $this->load->view('sellerv/extra/profile_ev','',TRUE);
//        $data['nickname']=$_SESSION['nickname'];
//        $data['province']=$_SESSION['province'];
//        $data['city']=$_SESSION['city'];
//        $data['district']=$_SESSION['district'];
//        $data['address']=$_SESSION['address'];
//        $data['cellphone']=$_SESSION['cellphone'];
//        $data['sphone']=$_SESSION['sphone'];
//        $data['headimg']=$_SESSION['headimg'];
//        $this->load->view("sellerv/nav",$data);
//        $this->load->view('sellerv/Profilev',array('nickname'=>$_SESSION['nickname']));
//    }
//    //修改密码
//    function setPwd(){
//        $this->form_validation->set_rules('oldPwd', '老密码', 'trim|required');
//        $this->form_validation->set_rules('newPwd','新密码','trim|required|min_length[6]');
//        $this->form_validation->set_rules('passconf', '确认密码', 'trim|required|min_length[6]|matches[newPwd]');
//        if ($this->form_validation->run() == FALSE)
//        {
//              $data['base_url']=  base_url();
//              $this->load->view("sellerv/nav",$data);
//              $this->load->view("sellerv/Setpwdv");
//        }  else {
//            $oldPwd=  $this->input->post('oldPwd');
//            if($oldPwd==  $_SESSION['spwd']){
//                $data['spwd']=  $this->input->post('newPwd',TRUE);
//                if($this->Saccountm->updateProfile($_SESSION['sid'],$data)){
//                    $data['base_url']=  base_url();
//                    $data['msg']='密码修改成功';
//                    $this->load->view("sellerv/nav",$data);
//                    $this->load->view("sellerv/Setpwdv");
//                }  else {
//                    $data['base_url']=  base_url();
//                    $data['msg']='密码修改失败';
//                    $this->load->view("sellerv/nav",$data);
//                    $this->load->view("sellerv/Setpwdv");
//                }
//            }  else {
//                 $data['base_url']=  base_url();
//                $data['msg']='老密码输入错误';
//                $this->load->view("sellerv/nav",$data);
//                $this->load->view("sellerv/Setpwdv");
//            }          
//        }
//    }
//    //忘记密码
//    function forgotPwd(){
//        $this->form_validation->set_rules('email', '邮箱','required|valid_email');
//        if ($this->form_validation->run() == FALSE)
//        {
//              $this->load->view("sellerv/Forgotpwdv");
//        }  else {
//            $email=  $this->input->post('email');
//            //检查邮箱是否存在
//            $is_exist=  $this->Saccountm->checkUnique($email,'sid');
//            if($is_exist){
//                $this->email->from('hscycg@163.com', 'min');
//                $this->email->to('641337590@qq.com');
//                $salt=md5($email.rand(0, 1999));
//                $this->predis->set($salt,$email);
//                $this->predis->expire($salt,3600);
//                
//                $change_url=  base_url().'seller/Saccount/changePwd/'."$salt";
//                $this->email->subject('Email Test');
//                $this->email->message($change_url);
//                if($this->email->send()){
//                    echo $salt;
//                    echo '发送成功';
//                    
//                }  else {
//                    echo '发送失败';
//                    echo $this->email->print_debugger();
//                }
//            }  else {
//                echo '邮箱还没注册';
//            }
//        }
//    }
//    //验证修改密码链接是否有效
//    function verifyLink($token=''){
//            $token = $this->security->xss_clean($token);
//             $email=  $this->predis->get($token);
//             if(empty($email)){
//                 echo '链接无效';
//                 exit();
//             }
//             $newPwd=  $this->input->post('newpwd');
//              if($email&&$newPwd){
//                  if($this->Saccountm->changePwd($email,array('spwd',$newPwd))){
//                      echo '密码修改成功';
//                  }  else {
//                      echo '密码修改失败';
//                  }
//                
//              }  else {
//                  $this->load->view('sellerv/Setnewpwdv',array('token'=>$token));
//              }          
//    }
//    
//    function test(){
//      echo date('Y-m-d H:i:s');
//    }
}

