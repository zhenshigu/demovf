<?php
class Shifan extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('phonem/Seefunm');
        $this->load->helper('url');
        $this->config->load('my_sys_config');
    }    
    //app首页
    function index(){
//	$this->output->enable_profiler(TRUE);
        $res=  $this->Seefunm->tget(array(),'*','article','artid',10);
        if($res){
            foreach ($res as &$one){
                $one['headimg']=  $this->config->item('http_article_img').$one['headimg'];
                $one['url']=  $this->config->item('http_article').$one['url'];
            }
        }
        $data['base_url']=  base_url();
        $data['res']=$res; 
        $data['commonCss']=  $this->load->view('clientm/commonCss','',TRUE);
        $data['commonJs']=  $this->load->view('clientm/commonJs','',TRUE);
        $this->load->view('clientm/Index',$data);
        
    }    
    function ajaxIndex(){
        header("Content-type: application/json");
        $offset= intval($this->input->post('offset'));
//        if($offset>10){
//            return;
//        }
        $limit=10;
        $res=  $this->Seefunm->tget(array(),'*','article','artid',$limit,$offset);
        if($res){
            foreach ($res as &$one){
                $one['headimg']=  $this->config->item('http_article_img').$one['headimg'];
                $one['url']=  $this->config->item('http_article').$one['url'];
            }
        }
        echo json_encode($res);
    }
    //视范页面
    function dgou(){
        $limit=10;
        $res=  $this->Seefunm->tget(array(),'*','article','artid',$limit);
        if($res){
            foreach ($res as &$one){
                $one['headimg']=  $this->config->item('http_article_img').$one['headimg'];
                $one['url']=  $this->config->item('http_article').$one['url'];
            }
        }
        $data['base_url']=  base_url();
        $data['res']=$res; 
        $data['commonCss']=  $this->load->view('clientm/commonCss','',TRUE);
        $data['commonJs']=  $this->load->view('clientm/commonJs','',TRUE);
        $this->load->view('clientm/Shifanv',$data);
    }
    //ajax异步获取文章
    function ajaxDgl(){
//        $this->output->enable_profiler(TRUE);
        header("Content-type: application/json");
        $offset=  $this->input->post('offset');
        $style= intval($this->input->post('type'));
        $limit=10;
        if($style<=0){
            $arr=array();
        }
        elseif ($style==15) {
            $arr=array('styleid<='=>$style);
        }
        else {
            $arr=array('styleid'=>$style);
        }
        if($style==-1){            
            $res=  $this->Seefunm->tget(array(),'*','article','artid',$limit,$offset);
        }  else {
            $field='article.artid,title,headimg,url,edittime';
            $joinConf='article.artid=articleStyle.artid';
            $res=  $this->Seefunm->mtget($arr,$field,'article','articleStyle',$joinConf,'article.artid',$limit,$offset);
            
        }
        if($res){
            foreach ($res as &$one){
                $one['headimg']=  $this->config->item('http_article_img').$one['headimg'];
                $one['url']=  $this->config->item('http_article').$one['url'];
            }
        }        
        echo json_encode($res);
    }
}
