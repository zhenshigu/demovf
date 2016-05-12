<?php
class Goodsm extends CI_Model{
    protected $table="goods";
    protected $joinTable='seller';
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    //单表查找
    function tget($arr,$field='*',$table='goods',$limit=10,$offset=''){
        $this->db->select($field);
        $this->db->from($table);       
        $this->db->where($arr);
        $this->db->limit($limit, $offset);       
        $query=$this->db->get();
        if ($query->num_rows()>0){
                return $query->result_array();
        }else {
                return  FALSE;
        }
    }
    //两表查找
    function mtget($arr,$t1,$t2,$join,$field='*',$limit=10,$offset=''){
         $this->db->select($field);
        $this->db->from($t1);       
        $this->db->join($t2,$join);
        $this->db->where($arr);
        $this->db->limit($limit, $offset);       
        $query=$this->db->get();
        if ($query->num_rows()>0){
                return $query->result_array();
        }else {
                return  FALSE;
        }
    }
    //查看信息,返回多条记录
    function ogetes($arr,$field='*',$limit=10,$offset=0){
        $this->db->select($field);
        $this->db->from($this->table);       
        $this->db->join($this->joinTable,'goods.sid=seller.sid');
        $this->db->where($arr);
        $this->db->limit($limit, $offset);       
        $query=$this->db->get();
        if ($query->num_rows()>0){
                return $query->result_array();
        }else {
                return  FALSE;
        }
    }
    //查看信息,返回1条记录
    function oget($arr,$field='*',$table='goods',$limit='',$offset=''){
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
    //插入新记录
    function addrecord($arr,$table='goods'){
         return $this->db->insert($table,$arr);
    }
    //更新记录
    function updaterecord($conf,$arr,$table='customer_order'){
        $this->db->where($conf);
        return $this->db->update($table, $arr);
    }
    //删除记录
    function deleterecord($arr,$table='customer_order'){
         return $this->db->delete($table,$arr);
    }
}
