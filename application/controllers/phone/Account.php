<?php
//手机用户的帐号管理类，包括登录验证，注册等功能
//引用到的文件：控制器文件application/core/MY_Controller,
//配置文件library/Account_errors.php,library/Predis;
//模型文件model/phonem/Accountm,model/phonem/Token

class Account extends MY_Controller{
     CONST  PHONE_LENGTH=11;
     CONST EMAIL_REGX="^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$";
     CONST NAME_REGX='/^[a-zA-Z0-9_]{3,16}$/';
     private $headimgPath='';
//     private $uid='';
     public function __construct() {
        parent::__construct();
        $this->config->load('my_sys_config');
        $this->load->model('phonem/Accountm');
        $this->load->model('phonem/Token');
        $this->load->library('Account_errors');
        $this->load->library('Predis');
        $this->load->library('Fileupload');
        $this->load->library('Alimessage');
        $this->load->helper('url');
        $this->load->helper('captcha');
        if($this->is_login){
//            $this->uid=intval($this->uri->segment(6));
            $this->headimgPath=$this->config->item('client_img').$this->_userid.'/headimg';
        }
    }
    //手机用户注册函数
    function register(){
        header("Content-type: application/json");
        $registerInfo=  $this->input->post(NULL,TRUE);
        //判断注册类型，包括通过手机号注册，用户名注册，邮箱注册三种方式
        if (isset($registerInfo['regtype'])&!empty($registerInfo['regtype'])){
            switch ($registerInfo['regtype']){
                case 'byphone':
                        if (!isset($registerInfo['phone'])||empty($registerInfo['phone'])){
                            $result=array();
                            $result['code']=  Account_errors::RET_PHONE_NULL;
                            $result['msg']=  Account_errors::$code_msg[Account_errors::RET_PHONE_NULL];
                            echo json_encode($result);
                            exit();
                        }
                        if (isset($registerInfo['captcha'])){
                            $server_captcha=  $this->predis->get("ca:".$registerInfo['phone']);
                            if($registerInfo['captcha']!=$server_captcha){
                                $result=array();
                                $result['code']=  Account_errors::RET_CAPTCHA_ERROR;
                                $result['msg']=  Account_errors::$code_msg[Account_errors::RET_CAPTCHA_ERROR];
                                echo json_encode($result);
                                exit();
                            }  else {
                                $this->predis->delete("ca:".$registerInfo['phone']);
                            }                   
                        }  else {
                            $result=array();
                            $result['code']=  Account_errors::RET_CAPTCHA_ERROR;
                            $result['msg']=  Account_errors::$code_msg[Account_errors::RET_CAPTCHA_ERROR];
                            echo json_encode($result);
                            exit();
                        }
                        if(!isset($registerInfo['password'])||empty($registerInfo['password'])){
                            $result['code']=  Account_errors::RET_PASSWORD_NULL;
                            $result['msg']=  Account_errors::$code_msg[Account_errors::RET_PASSWORD_NULL];
                            echo json_encode($result);
                            exit();
                        }
                        //电话，密码格式检查  
                       if(!is_numeric($registerInfo['phone'])||strlen($registerInfo['phone'])!=self::PHONE_LENGTH){
                           $result=array();
                           $result['code']=  Account_errors::RET_PHONE_FORMAT;
                           $result['msg']=  Account_errors::$code_msg[Account_errors::RET_PHONE_FORMAT];
                           echo json_encode($result);
                           exit();
                       }
                        //判断手机号是否已经被注册
                       if($this->Accountm->check_exist(array('phone'=>$registerInfo['phone']))){
                           $result=array();
                           $result['code']=  Account_errors::RET_PHONE_REGISTERED;
                           $result['msg']= Account_errors::$code_msg[Account_errors::RET_PHONE_REGISTERED];
                           echo json_encode($result);
                           exit();
                       }
                       $data['phone']=$registerInfo['phone'];
//                       $data['mypwd']=$registerInfo['password'];
                       $data['mypwd']=  password_hash($registerInfo['password'],PASSWORD_DEFAULT);
                       if ($this->Accountm->register($data)){
                           $result=array();
                           $result['code']=  Account_errors::RET_REGISTER_SUCCESS;
                           $result['msg']=  Account_errors::$code_msg[Account_errors::RET_REGISTER_SUCCESS];
                           echo json_encode($result);
                           exit();  
                       }  else {
                           $result=array();
                           $result['code']=  Account_errors::RET_REGISTER_FAILED;
                           $result['msg']=  Account_errors::$code_msg[Account_errors::RET_REGISTER_FAILED];
                           echo json_encode($result);
                           exit();  
                       }                                           
                    break;
//                case 'byname':                  
//                    if(!isset($registerInfo['username'])||empty($registerInfo['username'])){
//                        $result['code']=  Account_errors::RET_NAME_NULL;
//                        $result['msg']= Account_errors::$code_msg[Account_errors::RET_NAME_NULL];
//                        echo json_encode($result);
//                        exit();
//                    }
//                    if(!isset($registerInfo['password'])||empty($registerInfo['password'])){
//                        $result['code']=  Account_errors::RET_PASSWORD_NULL;
//                        $result['msg']=  Account_errors::$code_msg[Account_errors::RET_PASSWORD_NULL];
//                        echo json_encode($result);
//                        exit();
//                    }
//                    if(!$this->_isNameValid($registerInfo['username'])){
//                        $result['code']=  Account_errors::RET_NAME_FORMAT;
//                        $result['msg']=  Account_errors::$code_msg[Account_errors::RET_NAME_FORMAT];
//                        echo json_encode($result);
//                        exit();
//                    }
//                     if($this->Accountm->check_exist(array('username'=>$registerInfo['username']))){
//                         $result['code']=  Account_errors::RET_NAME_REGISTERED;
//                         $result['msg']=  Account_errors::$code_msg[Account_errors::RET_NAME_REGISTERED];
//                         echo json_encode($result);
//                         exit();
//                     }
//                     $data['username']=$registerInfo['username'];
//                     $data['mypwd']=$registerInfo['password'];
//                     if($this->Accountm->register($data)){
//                         $result['code']=  Account_errors::RET_REGISTER_SUCCESS;
//                         $result['msg']=  Account_errors::$code_msg[Account_errors::RET_REGISTER_SUCCESS];
//                         echo json_encode($result);
//                         exit();
//                     }  else {
//                         $result['code']=  Account_errors::RET_REGISTER_FAILED;
//                         $result['msg']=  Account_errors::$code_msg[Account_errors::RET_REGISTER_FAILED];
//                         echo json_encode($result);
//                         exit();
//                     }
//                    break;
//                case 'byemail':
//                    if(!isset($registerInfo['email'])||empty($registerInfo['email'])){
//                        $result['code']=  Account_errors::RET_EMAIL_NULL;
//                        $result['msg']= Account_errors::$code_msg[Account_errors::RET_EMAIL_NULL];
//                        echo json_encode($result);
//                        exit();
//                    }
//                    if(!isset($registerInfo['password'])||empty($registerInfo['password'])){
//                        $result['code']=  Account_errors::RET_PASSWORD_NULL;
//                        $result['msg']=  Account_errors::$code_msg[Account_errors::RET_PASSWORD_NULL];
//                        echo json_encode($result);
//                        exit();
//                    }
//                    //邮箱密码格式判断
//                    if (!$this->_isEmail($registerInfo['email'])){    
//                        $result=array();
//                        $result['code']=  Account_errors::RET_EMAIL_FORMAT;
//                        $result['msg']=  Account_errors::$code_msg[Account_errors::RET_EMAIL_FORMAT];
//                        echo json_encode($result);
//                        exit();
//                    }
//                    if($this->Accountm->check_exist(array('email'=>$registerInfo['email']))){
//                        $result=array();
//                        $result['code']=  Account_errors::RET_EMAIL_REGISTERED;
//                        $result['msg']=  Account_errors::$code_msg[Account_errors::RET_EMAIL_REGISTERED];
//                        echo json_encode($result);
//                        exit();
//                    }
//                    $data['email']=$registerInfo['email'];
//                    $data['mypwd']=$registerInfo['password'];
//                    if($this->Accountm->register($data)){
//                        $result=array();
//                        $result['code']=  Account_errors::RET_REGISTER_SUCCESS;
//                        $result['msg']=  Account_errors::$code_msg[Account_errors::RET_REGISTER_SUCCESS];
//                        echo json_encode($result);
//                        exit();
//                    }                    
//                    break;
            }
        }  else {
            $result=array();
            $result['code']=  Account_errors::RET_TYPE_NULL;
            $result['msg']=  Account_errors::$code_msg[Account_errors::RET_TYPE_NULL];
            echo json_encode($result);
            exit();
        }              
    }
    //手机用户登录函数
    function login(){
        $loginInfo=array();
//        $loginInfo['account']=  $this->input->post('account',TRUE);
//        $loginInfo['password']=  $this->input->post('password',TRUE);
//        $userInfo=$this->Accountm->login($loginInfo);
        $loginInfo['phone']=$this->input->post('account',TRUE);
        $userInfo=  $this->Accountm->oget($loginInfo);
        $postPwd=$this->input->post('password',TRUE);       
        if(empty($userInfo)){
            $result=array();
            $result['code']=  Account_errors::RET_LOGIN_FAILED;
            $result['msg']=  Account_errors::$code_msg[Account_errors::RET_LOGIN_FAILED];
            echo json_encode($result);
            exit();
        }elseif (!password_verify($postPwd, $userInfo['mypwd'])) {
            $result=array();
            $result['code']=  Account_errors::RET_LOGIN_FAILED;
            $result['msg']=  Account_errors::$code_msg[Account_errors::RET_LOGIN_FAILED];
            echo json_encode($result);
            exit();
        }
        //登录成功，判断是否重复登录
        $accessToken=  $this->Token->getByUserid($userInfo['userid']);
        log_message("info", $accessToken);
        //不存在token，属于第一次登录
        if(!$accessToken){
            log_message("info", "in");
            $ip = $this->input->ip_address();
            $accessToken=$this->Token->genToken($userInfo,$ip);        
            if(!$accessToken){
                $result=array();
                $result['code']=  Account_errors::RET_TOKEN_GEN_ERROR;
                $result['msg']=  Account_errors::$code_msg[Account_errors::RET_TOKEN_GEN_ERROR];
                echo json_encode($result);
                exit();
            }
        }
        //返回用户信息和accessToken
        $result=array();
        unset($userInfo['mypwd']);
        $userInfo['token']=$accessToken;
        $result['result']=$userInfo;
        $result['code']=  Account_errors::RET_LOGIN_SUCCESS;
        echo json_encode($result);
        exit();
    }
    //手机用户自动登录
    function autoLogin(){
        if($this->_isLogin()){
            $result=array();
            $result['result']=  $this->userinfo;
            $result['code']=  Account_errors::RET_LOGIN_SUCCESS;
            echo json_encode($result);
            exit();
        }
        
    }
    //检查是否登录了
    protected function _isLogin() {
        if (!$this->is_login) {
            $result = array();
            $result['code'] = Account_errors::RET_TOKEN_ERROR;
            $result['msg'] = Account_errors::$code_msg[Account_errors::RET_TOKEN_ERROR];
            echo json_encode($result);
            exit();
        }  else {
            return TRUE;
        }
    }
    //用户退出
    function logout(){
        if($this->is_login){
            $userid=intval($this->uri->segment(6));
            if($this->Token->logout($userid)){
                echo 1;
            }  else {
                echo 0;
            }
        }  else {
            echo 0;
        }        
    }

//    function myProfile(){
//        if($this->is_login){
//            $conf['userid']= intval($this->uri->segment(6));
//            $field='username,phone,sex,headimg';
//            $res=  $this->Accountm->oget($conf,$field);
//            if($res){
//                $res['headimg']=  $this->config->item('http_client_img').$this->uid.'/headimg/'.$res['headimg'];
//            }
//            $res['base_url']=  base_url();
//            $this->load->view('clientm/Myinfo',$res);
//        }  else {
//            $this->load->view('clientm/Nologin');
//        }
//    }
        //显示个人资料页面
    function myProfile(){
        header('Cache-Control: no-cache, must-revalidate'); 
        $res['base_url']=  base_url();    
            $this->load->view('clientm/Myinfo',$res);
        
    }
    //异步获取个人资料
    function ajaxProfile(){
        header("Content-type: application/json");
        if($this->is_login){
            $conf['userid']=  $this->_userid;
            $field='username,phone,sex,headimg';
            $res=  $this->Accountm->oget($conf,$field);
            if($res){
                $res['headimg']=  $this->config->item('http_client_img').$this->_userid.'/headimg/'.$res['headimg'];
                $res['toLogin']=0;
            }
            echo json_encode($res);
        }  else {
            echo json_encode(array('toLogin'=>1));
        }
    }
    //用户修改性别
    function setGender(){
        if($this->is_login){
            $sex= intval($this->input->post('gender',TRUE));
            $conf['userid']= $this->_userid;
            $arr['sex']=&$sex;
            if($this->Accountm->updaterecord($conf,$arr)){
                echo 1;
            }  else {
                echo 0;
            }
        }  else {
            echo 0;
        }
    }
    //用户修改昵称
    function setNickname(){
        if($this->is_login){
            $nickname=  $this->input->post('name',TRUE);
            if($nickname==''){
                echo 0;
                return;
            }
            $arr['username']=&$nickname;
            $conf['userid']= $this->_userid;
            if($this->Accountm->updaterecord($conf,$arr)){
                echo 1;
            }  else {
                echo 0;
            }
        }  else {
            echo 0;
        }
    }
    //修改密码
    function setPwd(){
        header("Content-type: application/json");
        $result=array();
        if($this->is_login){
            $newPwd=  $this->input->post('password');
            $oldPwd=  $this->input->post('oldPwd');
            if($newPwd==''){
                $result['code']=0;
                echo json_encode($result);
                return;
            } 
            
            $arr['mypwd']=  password_hash($newPwd, PASSWORD_DEFAULT);
            $conf['userid']=  $this->_userid;
            $res=  $this->Accountm->oget($conf,'mypwd');
            
            if(!password_verify($oldPwd, $res['mypwd'])){
                $result['code']=-1;
                echo json_encode($result);
                return;
            }
            if($this->Accountm->updaterecord($conf,$arr)){
                $result['code']=1;
                echo json_encode($result);
                return;
            }  else {
                $result['code']=0;
                echo json_encode($result);
                return;
            }
        }  else {
            $result['code']=  Account_errors::RET_PASSWORD_NULL;
            echo json_encode($result);
            return;
        }
    }
    //设置手机号码
    function setPhone(){
        header("Content-type: application/json");
        $result=array();
        if($this->is_login){
            $newPhone=  $this->input->post('newPhone',TRUE);
            $captcha=  $this->input->post('captcha',TRUE);
            //电话，密码格式检查  
            if(!is_numeric($newPhone)||strlen($newPhone)!=self::PHONE_LENGTH){
                
                $result['code']=  Account_errors::RET_PHONE_FORMAT;
                echo json_encode($result);
                exit();
            }
            //判断手机号是否已经被注册
            if($this->Accountm->check_exist(array('phone'=>$newPhone))){
                
                $result['code']=  Account_errors::RET_PHONE_REGISTERED;
                echo json_encode($result);
                exit();
            }
            
            $serverCaptcha=  $this->predis->get("l:ca:$newPhone");
            if($captcha!=$serverCaptcha){
                $result['code']= Account_errors::RET_CAPTCHA_ERROR;
                echo json_encode($result);
                exit();
            }
            $this->predis->delete("l:ca:$newPhone");
            $arr['phone']=&$newPhone;
            $conf['userid']=  $this->_userid;
            if($this->Accountm->updaterecord($conf,$arr)){
                $result['code']=1;
                echo json_encode($result);
                return;
            }  else {
                $result['code']=0;
                echo json_encode($result);
                return;
            }
        }  else {
            $result['code']=  Account_errors::RET_NO_LOGIN;
            echo json_encode($result);
            return;
        }
    }
    //忘记密码
    function forgotPwd(){
        $type=  $this->input->post('type',TRUE);
        if($type==1){
            header("Content-type: application/json");
            $passwd=  $this->input->post('passwd',TRUE);
            $phone=  $this->input->post('phone',TRUE);
            $captcha=  $this->input->post('captcha',TRUE);
            if($passwd===''){
                $result['code']=  Account_errors::RET_PASSWORD_NULL;
                echo json_encode($result);
                return;
            }
            //电话格式检查  
            if(!is_numeric($phone)||strlen($phone)!=self::PHONE_LENGTH){                
                $result['code']=  Account_errors::RET_PHONE_FORMAT;
                echo json_encode($result);
                exit();
            }
            $serverCaptcha=  $this->predis->get("p:ca:$phone");
            if($captcha!=$serverCaptcha){
                $result['code']= Account_errors::RET_CAPTCHA_ERROR;
                echo json_encode($result);
                exit();
            }
            $this->predis->delete("p:ca:$phone");
            $arr['mypwd']=  password_hash($passwd, PASSWORD_DEFAULT);
            $conf['phone']=  $phone;
            if($this->Accountm->updaterecord($conf,$arr)){
                $result['code']=1;
                echo json_encode($result);
                return;
            }  else {
                $result['code']=0;
                echo json_encode($result);
                return;
            }
        }  else {
            $res['base_url']=  base_url();
            $this->load->view('clientm/Forgotpwd',$res);
        }       
    }
    //设置头像
    function setHead(){
        if($this->is_login){
            $this->fileupload-> set("path",$this->headimgPath);
            $this->fileupload->set('israndname',TRUE);
//            $this->fileupload->set('savedname',"headimg");
             if($this->fileupload-> upload("file")) {
                     $arr['headimg']=$this->fileupload->getFileName();
                     $conf['userid']=  $this->_userid;
                     if($this->Accountm->updaterecord($conf,$arr)){
                         echo 1;
                     } 
             }  else {
                 echo $this->fileupload->getErrorMsg();
             }
             return;
        }  
        echo 0;
    }
    //用户名是否合法
    protected function _isNameValid($username){
         return preg_match(self::NAME_REGX,$username);
    }
    //邮箱格式是否合法判断
    protected function _isEmail($email){
        return preg_match(self::EMAIL_REGX, $email);
    }
    //显示注册页面
    public function regPage(){
	//set_time_limit(1800);
        $vals = array(
            'img_path'  => $this->config->item('captcha'),
            'img_url'   => $this->config->item('http_captcha'),
            'img_width' => '70',
            'img_height'=>'30',
            'word_length'   => 4,
            'img_id'=>'imgid',
            'pool'      => '2345678abcdefghjklmnprstuvwxyzABCDEFGHJKLMNPRSTUVWXYZ'
            
        );
        $cap = create_captcha($vals);
	#var_dump($cap);
        $ip=  $this->input->ip_address();
        $save2Redis=$this->predis->setEx("$ip:code",1800,  strtolower($cap['word']));
        if($save2Redis){
            $data['base_url']=  base_url();
            $data['imgcode']=$cap['image'];
            $this->load->view('clientm/Regpage',$data);
        }  else {
            echo 'cache error';
        }
    }   
    //获取验证码,注册用
    public function getCaptcha(){
        header("Content-type: application/json");
        $phone=  $this->input->post('yourphone',TRUE);
        //判断手机号是否已经被注册
        if($this->Accountm->check_exist(array('phone'=>$phone))){
            $result=array();
            $result['code']=  Account_errors::RET_PHONE_REGISTERED;
            echo json_encode($result);
            exit();
        }
        //电话，密码格式检查  
        if(!is_numeric($phone)||strlen($phone)!=self::PHONE_LENGTH){
            $result=array();
            $result['code']=  Account_errors::RET_PHONE_FORMAT;
            echo json_encode($result);
            exit();
        }
        $imgcode= strtolower($this->input->post('imgcode',TRUE));
        $ip=  $this->input->ip_address();
        if($phone&&$imgcode){
            $server_code=  $this->predis->get("$ip:code");
            if($imgcode!=$server_code){
                $result=array();
                $result['code']=0;
                echo json_encode($result);
                return;
            }
            $captcha='';
            for($i=0;$i<6;$i++){
                $captcha.=rand(0, 9);
            }
            //sava captcha to the redis
            $result=$this->predis->setEx('ca:'.$phone,600,$captcha);
            if($result){
                //发送验证码到手机
                $this->alimessage->send($captcha,$phone);
                $result=array();
                $result['code']=1;
                echo json_encode($result);
                return;
            }  else {
                $result=array();
                $result['code']=-1;
                echo json_encode($result);
                return;
            }
        }
    }
   //登录后用,获取验证码    
   function myCaptcha(){
       header("Content-type: application/json");
       $phone=  $this->input->post('yourphone',TRUE);
       $type=  $this->input->post('type',TRUE);
       switch ($type){
           //change phone
           case 1:
               if($this->is_login){                      
                //电话格式检查  
                if(!is_numeric($phone)||strlen($phone)!=self::PHONE_LENGTH){
                    $result=array();
                    $result['code']=  Account_errors::RET_PHONE_FORMAT;
                    echo json_encode($result);
                    exit();
                }
                //判断手机号是否已经被注册
                if($this->Accountm->check_exist(array('phone'=>$phone))){
                    $result=array();
                    $result['code']=  Account_errors::RET_PHONE_REGISTERED;
                    echo json_encode($result);
                    exit();
                }
                $captcha='';
                for($i=0;$i<6;$i++){
                    $captcha.=rand(0, 9);
                }
                //sava captcha to the redis               
                $result=$this->predis->setEx('l:ca:'.$phone,600,$captcha);
                if($result){
                    //发送验证码到手机
                    $this->alimessage->generalSend($captcha,$phone);
                    $result=array();
                    $result['code']=1;
                    echo json_encode($result);
                    return;
                }  else {
                    $result=array();
                    $result['code']=-1;
                    echo json_encode($result);
                    return;
                }
            }  else {
                $result['code']=  Account_errors::RET_NO_LOGIN;
                echo json_encode($result);
                return;
            }
            break;
            //change password
            case 2:
                //电话格式检查  
                if(!is_numeric($phone)||strlen($phone)!=self::PHONE_LENGTH){
                    $result=array();
                    $result['code']=  Account_errors::RET_PHONE_FORMAT;
                    echo json_encode($result);
                    exit();
                }
                //判断手机号码是否有注册
                if(!$this->Accountm->check_exist(array('phone'=>$phone))){
                    $result=array();
                    $result['code']=  Account_errors::RET_NO_REGISTERED;
                    echo json_encode($result);
                    exit();
                }
                $captcha='';
                for($i=0;$i<6;$i++){
                    $captcha.=rand(0, 9);
                }
                //sava captcha to the redis               
                $result=$this->predis->setEx('p:ca:'.$phone,600,$captcha);
                if($result){
                    //发送验证码到手机
                    $this->alimessage->generalSend($captcha,$phone);
                    $result=array();
                    $result['code']=1;
                    echo json_encode($result);
                    return;
                }else {
                    $result=array();
                    $result['code']=-1;
                    echo json_encode($result);
                    return;
                }
                break;
       }
       
   }

}

