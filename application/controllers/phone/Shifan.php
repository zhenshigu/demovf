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
        $res=  $this->Seefunm->tget(array(),'*','article','edittime',3);
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
        if($offset>10){
            return;
        }
        $limit=3;
        $res=  $this->Seefunm->tget(array(),'*','article','edittime',$limit,$offset);
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
        $res=  $this->Seefunm->tget(array(),'*','article','edittime',$limit);
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
        header("Content-type: application/json");
        $offset=  $this->input->post('offset');
        $style= intval($this->input->post('type'));
        $limit=10;
        if($style<=0){
            $arr=array();
        }  else {
            $arr=array('styleid'=>$style);
        }
        $res=  $this->Seefunm->tget($arr,'*','article','edittime',$limit,$offset);
        if($res){
            foreach ($res as &$one){
                $one['headimg']=  $this->config->item('http_article_img').$one['headimg'];
                $one['url']=  $this->config->item('http_article').$one['url'];
            }
        }
        echo json_encode($res);
    }
}
