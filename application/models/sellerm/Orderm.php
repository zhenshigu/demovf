<?php
//商家订单模型管理类
class Orderm extends CI_Model{
    protected $table="customer_order";
    protected $joinTable='customer_account';
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    //查看信息,返回多条记录
    function ogetes($arr,$field='*',$limit='',$offset=''){
        $this->db->select($field);
//        $query = $this->db->get_where($this->table, $arr,$limit,$offset);
        $this->db->from($this->table);       
        $this->db->join($this->joinTable,'customer_order.userid=customer_account.userid');
        $this->db->where($arr);
        $this->db->order_by('odate', 'DESC');
        $this->db->limit($limit, $offset);       
        $query=$this->db->get();
        if ($query->num_rows()>0){
                return $query->result_array();
        }else {
                return  FALSE;
        }
    }
    //查看信息,返回1条记录
    function oget($arr,$field='*',$limit='',$offset=''){
        $this->db->select($field);
        $query = $this->db->get_where($this->table, $arr,$limit,$offset);
        if ($query->num_rows()>0){
                return $query->row_array();
        }else {
                return  FALSE;
        }
    }
    //获取符合条件的记录数
    function ocount($arr){
        $this->db->where($arr);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    //获取订单信息
    function getOrders($arr,$field='*'){
//        $this->db->select($field);
//        $this->db->where_in('oid',$arr);
//        $query=  $this->db->get($this->table);
        $this->db->select($field);
        $this->db->from($this->table);       
        $this->db->join($this->joinTable,'customer_order.userid=customer_account.userid');
        $this->db->where_in('oid',$arr);
        $query=  $this->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }  else {
            return 0;
        }
    }
}

