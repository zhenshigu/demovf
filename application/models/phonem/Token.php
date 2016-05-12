<?php
class Token extends CI_Model{
    protected $tableName="access_token";
    const  EXPIRE_TIME=36000;
    const REDIS_TAG='customer:';
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    //根据token获取登录信息
//    function getByToken($token){
//        //先从缓存redis服务器获取
//        $ret = $this->predis->hGetAll($token);
//        if ($ret && $this->isExpired($ret)) {           
//            return array();
//        }
//        //缓存不存在接着从数据库获取
//        $sql="select token,expire_time,a.userid,b.username,b.sex,b.phone,b.email"
//                . " from {$this->tableName} a join customer_account b on token=? and  a.userid=b.userid";
//        $query = $this->db->query($sql,$token);
//        $ret = $query->row_array();
//        if (empty($ret)||$this->isExpired($ret)) {
//            return array();
//        }  
//        return $ret;    
//    }
    //根据userid获取token,包括判断token的有效期
//    function getByUserid($userid){
//            $sql="select token from {$this->tableName} where userid=? and expire_time>?";
//            $query=$this->db->query($sql,array($userid,  time()));
//            $row=$query->row_array();
//            if(empty($row)){
//                return FALSE;
//            }  else {
//                return $row['token'];
//            }
//    }
    //生成token
//    function genToken($userinfo=array(),$ip, $deviceid = '', $platform = -1){
//        $data=array();
//        $data['userid'] = $userinfo['userid'];
////        $data['login_time'] = time();
////        $data['deviceid'] = $deviceid;
////        $data['ip'] = $ip;
////        $data['platform'] = $platform;
//        $data['expire_time'] = time()+ self::EXPIRE_TIME;
//        $data['token'] = md5(uniqid(rand(0,10000),true));
//        //将token插入数据库保存
//        $query = $this->db->insert($this->tableName, $data);
//        if($query){
//            //将token插入redis缓存
//            $this->predis->hMset($data['token'], $data);
////            $this->predis->expireAt($data['token'],  self::EXPIRE_TIME);
//            return $data['token'];
//        }
//        return $query;
//    }

    /**
     * 判断token是否过期
     * 
     */
//    function isExpired($tokenRecord) {
//        return $tokenRecord['expire_time'] < time();
//    }
    /**
     * 登出删除token
     * 
     */
//    function logout($token) {       
//        $sql = "delete from  {$this->tableName}  where token=?";
//        $ret = $this->db->query($sql,$token);
//        if ($ret) {
//            $this->predis->del($token);
//        }
//        return $ret;
//    }
    
    //----------以上作废---------
      function genToken($userinfo=array(),$ip, $deviceid = '', $platform = -1){
        $data=array();
        $data['userid'] = $userinfo['userid'];
        $data['token'] = md5(uniqid(rand(0,10000),true));
            //将token插入redis缓存
            $this->predis->hMset("userid:".$data['userid'], $data);
            $this->predis->expire("userid:".$data['userid'],  self::EXPIRE_TIME);
            return $data['token'];
    }
    //根据userid获取token,包括判断token的有效期
    function getByUserid($userid){
           return $this->predis->hGet("userid:$userid",'token');
    }
    function logout($userid){
        return    $this->predis->del("userid:$userid");
    }
}
