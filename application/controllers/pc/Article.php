<?php
//for pc website to show the articles
class Article extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('phonem/Seefunm');
        $this->config->load('my_sys_config');

    }
    //show the initial articles
    function index(){
        $res=  $this->Seefunm->tget(array(),'*','article','artid',10);
        if($res){
            foreach ($res as &$one){
                $one['headimg']=  $this->config->item('http_article_img').$one['headimg'];
                $one['url']= $this->config->item('myhost')."/pc/articleDetail/".$one['url'];
            }
        }
        $data['res']=$res; 
      
        $this->load->view('pc/web_article',$data);
    }
    //load more articles by ajax
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
    //load the article details;
    function articleDetail($title){
        var_dump($title);
        $title=$this->security->xss_clean($title);
        if(empty($title)){
            return;
        }
        $title="http://www.viewfuns.com/".$title;
        $res['article']=&$title;
        $this->load->view('pc/article_detail',$res);
    }
}
