<?php
class Seefunm extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    //单表查找
    function tget($arr,$field='*',$table='article',$orderby='',$limit=10,$offset=''){
        $this->db->select($field);
        $this->db->from($table);       
        $this->db->where($arr);
        $this->db->order_by($orderby);
        $this->db->limit($limit, $offset);       
        $query=$this->db->get();
        if ($query->num_rows()>0){
                return $query->result_array();
        }else {
                return  FALSE;
        }
    }
}
