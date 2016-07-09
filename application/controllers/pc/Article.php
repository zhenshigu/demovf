<?php
//for pc website to show the articles
class Article extends CI_Controller{
    public function __construct() {
        parent::__construct();
	$this->load->helper('url');
        $this->load->model('phonem/Seefunm');
        $this->config->load('my_sys_config');

    }
    //show the initial articles
    function index(){
        $res=  $this->Seefunm->tget(array(),'*','article','artid',10);
        if($res){
            foreach ($res as &$one){
                $one['headimg']=  $this->config->item('http_article_img').$one['headimg'];
                $one['url']="article/articleDetail/".$one['url'];
            }
        }
        $data['res']=$res; 
        $data['base_url']= $this->config->item('pc_host');
        $this->load->view('pc/web_article',$data);
    }
    //load more articles by ajax
    function ajaxIndex(){
        header("Content-type: application/json");
        $offset= intval($this->input->post('offset'));
        $limit=10;
        $res=  $this->Seefunm->tget(array(),'*','article','artid',$limit,$offset);
        if($res){
            foreach ($res as &$one){
                $one['headimg']=  $this->config->item('http_article_img').$one['headimg'];
                $one['url']="article/articleDetail/".$one['url'];
            }
        }
        echo json_encode($res);
    }
    //load the article details;
    function articleDetail($title){
        $title=$this->security->xss_clean($title);
        if(empty($title)){
            return;
        }
        $title="http://www.viewfuns.com/webarticle/".$title;
        $res['article']=&$title;
        $this->load->view('pc/article_detail',$res);
    }
    function aboutus(){
        $this->load->view('pc/abountUs');
    }
    function aboutmore(){
        $this->load->view('pc/aboutMore');
    }
}
