<?php
class Saccountm extends CI_Model{
    protected $table='seller';
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function register($arr){
        return $this->db->insert($this->table,$arr);
    }
    function login($arr){
        $sql="select * from {$this->table} where semail=? and spwd=?";
        $query=  $this->db->query($sql,$arr);
        return $query->row_array();
    }
    //通过编号获取商家资料
    function getProfile($sid,$field='*'){
        $this->db->select($field);
        $query=  $this->db->get_where($this->table,array('sid'=>$sid));
        if ($query->num_rows()>0){
                return $query->row_array();
        }else {
                return  FALSE;
        }
    }
    //通过邮箱判断是否已经存在某字段
    function checkUnique($email,$field='*'){
        $this->db->select($field);
        $query=  $this->db->get_where($this->table,array('semail'=>$email));
        return $query->num_rows();
    }
    //更新商家资料
    function updateProfile($sid,$arr){
        $this->db->where('sid', $sid);
        return $this->db->update($this->table, $arr);
    }
    //修改密码
    function changePwd($email,$arr){
        $this->db->where('semail',$email);
        return $this->db->update($this->table,$arr);
    }
}
