<?php
class MY_Controller extends CI_Controller{
    protected $is_login = false;
    protected $userinfo = null;
    protected $salt="this is salt";
    protected $_userid='';
//    function __construct() {
//        parent::__construct();
//        $this->load->model('phonem/Token');
//        $this->load->library('Predis');
//        $accessToken = $this->input->post('accessToken');       
//        if(empty($accessToken)){
//            return;
//        }
//        //token保存在redis里，取出的值为用户信息
//        if (($this->router->class == 'user' || $this->router->class == 'Account') && $this->router->method == 'login') {
//            return;
//        }
//        //非登录接口都需要判断token
//        $userinfo = $this->token->getByToken($accessToken);
//        if (empty($userinfo)) {
//            $this->is_login = false;
//            return;
//        } else {
//            $this->userinfo = $userinfo;
//            $this->is_login = true;
//        }
//    }
    //20160412新构造函数，判断是否已经登录
    function __construct() {
        parent::__construct();
        $this->load->model('phonem/Token');
        $this->load->library('Predis');
        $sign_time_id=  $this->input->post('sign_time_id');
        if(!$sign_time_id){
            $sign=  $this->uri->segment(4);
            $timestamp=  $this->uri->segment(5);
            $userid=  $this->uri->segment(6);
            $this->_userid=$userid;
        }  else {
            $tmparr=  explode('/', $sign_time_id);
            $sign=$tmparr[0];
            $timestamp=$tmparr[1];
            $userid=$tmparr[2];
            $this->_userid=$userid;
        }               
        if(!$sign||!$timestamp||!$userid){
            return;
        }
        $now=  time();
        //判断URL的登录态是否有效
        if($now-$timestamp>10){
            return;
        }
        $serverToken=  $this->Token->getByUserid($userid);
        //token不存在
        if(!$serverToken){
            return;
        }
        $serverSign=  md5($serverToken.$timestamp.$this->salt);
        log_message("debug", $serverSign);
        if($sign!=$serverSign){
            return;
        }  else {
            $this->is_login = true;
        }
    }
}
