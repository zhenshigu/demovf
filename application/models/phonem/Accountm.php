<?php
//手机用户帐号相关的模型
class Accountm extends CI_Model{
    protected $table="customer_account";
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    //注册函数
    function register($arr){
        return $this->db->insert($this->table,$arr);
    }
    //登录函数
    function login($arr){
        $sql="select userid,username,phone,sex,email  from {$this->table} where (username=? or phone=? or email=?) and mypwd=? ";
        $query=  $this->db->query($sql,array($arr['account'],$arr['account'],$arr['account'],$arr['password']));
        return $query->row_array();
    }
    //检查是否已经存在的帐号例如手机号，用户名，邮箱
    function check_exist($arr){
        $this->db->where($arr);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    //查看信息,返回1条记录
    function oget($arr,$field='*',$table='customer_account',$limit='',$offset=''){
        $this->db->select($field);
        $this->db->from($table);       
        $this->db->where($arr);
        $this->db->limit($limit, $offset);       
        $query=$this->db->get();
        if ($query->num_rows()>0){
                return $query->row_array();
        }else {
                return  FALSE;
        }
    }
        //更新记录
    function updaterecord($conf,$arr,$table='customer_account'){
        $this->db->where($conf);
        return $this->db->update($table, $arr);
    }
}

