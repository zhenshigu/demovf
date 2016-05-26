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
        $res=  $this->Seefunm->tget(array(),'*','article','edittime',30);
        if($res){
            foreach ($res as &$one){
                $one['headimg']=  $this->config->item('http_article_img').$one['headimg'];
                $one['url']=  $this->config->item('http_article').$one['url'];
            }
        }
        $data['base_url']=  base_url();
        $data['res']=$res;     
        $this->load->view('clientm/Index',$data);
        
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
        $this->load->view('clientm/Shifanv',$data);
    }
    //ajax异步获取文章
    function ajaxDgl(){
        header("Content-type: application/json");
        $offset=  $this->input->post('offset');
        $limit=10;
        $res=  $this->Seefunm->tget(array(),'*','article','edittime',$limit,$offset);
        if($res){
            foreach ($res as &$one){
                $one['headimg']=  $this->config->item('http_article_img').$one['headimg'];
                $one['url']=  $this->config->item('http_article').$one['url'];
            }
        }
        echo json_encode($res);
    }
}
