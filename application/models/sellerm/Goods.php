<?php
class Goods extends CI_Model{
    protected $table="goods";
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    //创建新的婚纱套餐
    public function newTaocan($arr){
        return $this->db->insert($this->table,$arr);
    }
    //读取指定婚纱套餐
    function gettc($gid,$field='*'){
        $this->db->select($field);
        $query = $this->db->get_where($this->table, array('gid' => $gid));
        if ($query->num_rows()>0){
                return $query->row_array();
        }else {
                return  FALSE;
        }
    }
    //更新指定套餐
    function updatetc($arr,$gid){
        $this->db->where('gid', $gid);
        return $this->db->update($this->table, $arr);
    }
    //删除婚纱套餐
    function deletetc($gid){
        return $this->db->delete($this->table, array('gid' => $gid));
    }
    
    //返回婚纱套餐的总数
    public function totaltc($sid){
        $this->db->where('sid',$sid);
        $this->db->from($this->table);
        return $this->db->count_all_results();;
    }
    //获取指定数量的套餐
    public function sometc($arr){
        $sql="select * from {$this->table} where sid=? order by gid limit ?,?";
        $query=$this->db->query($sql,$arr);
        if ($query->num_rows()>0){
                return $query->result_array();
        }else {
                return  FALSE;
        }
    }
    //获取套餐图片名称数组
    function getImgNames($gid){
        $this->db->select('gimg');
        $query = $this->db->get_where($this->table, array('gid' => $gid));
        if ($query->num_rows()>0){
                $res= $query->row_array();
                $imgNames=  json_decode($res['gimg']);
                return $imgNames;
        }else {
                return  FALSE;
        }
    }
    //更新套餐图片，将套餐图片名称数组格式化为Json保存
    function setImgNames($gid,$imgNames){
        $json=  json_encode($imgNames);
        $arr=array('gimg'=>$json);
        $this->db->where('gid', $gid);
        return $this->db->update($this->table, $arr);
    }
}

