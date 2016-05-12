<?php
class Test extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('Predis');
        $this->load->library('Commonuse');
        $this->load->library('Alimessage');
        $this->load->helper('url');
	$this->load->helper('captcha');
        $this->load->database();
    }
    function redis_test()
    {
        $res=$this->predis->setEx('a',100,100);
        var_dump($res);
        $res=  $this->predis->hmset('b',array('a'=>1,'b'=>2));
        var_dump($res);
        $res=  $this->predis->hmget('b',array('a','b'));
        var_dump($res);
        
    }
    function encode_test(){
        $a= base64_encode('641337590@qq.com');
        echo $a."<br>";
        echo base64_decode($a);
    }
    function array_t(){
        $a=array(1,2,3);
        $a=array(4,5);
        var_dump($a);
    }
    function time_t(){
        echo date('Y-m-d H:i:s');
    }
    function textarea_t(){
        $data['content']=  $this->input->get_post('content',TRUE);
   echo $data['content']=str_replace("\n", "<br>", $data['content']) ;
        if($data['content'])
        $this->db->insert('test',array('content'=>$data['content']));
        $data['base_url']=  base_url();
        $this->load->view('sellerv/nav',$data);
        $this->load->view('sellerv/testv');
        
    }
    function compat_t(){
        $this->load->view('sellerv/compatv');
    }
    function json_t(){
        $a=array('0'=>array('a'=>1,'b'=>2));
        echo json_encode(array('a'=>$a,'b'=>1));
    }
    function mytime_t(){
        echo $time=strtotime(date('Y-m-d'));
        $year=  date('Y');
        $month=date('m');
        $day=  date('d');
        $time=  mktime(0, 0, 0,$month,$day,$year);
        echo date('Y-m-d H:i:s',  $time);
    }
    function thumb_t(){
        $imgPath='../upload/img_1/20160321000443_992.jpg';
        $thumbPath='../upload/img_1/20160321000443_992_thumb.jpg';
        if($this->commonuse->createThumb($imgPath,$thumbPath)){
            echo $thumbPath.'成功';
        }
    }
     function test(){
          $data['userid'] = 22;
        $data['token'] = 11;
            //将token插入redis缓存
            $this->predis->hMset("userid:22", $data);
            $this->predis->expire("userid:22", 3600);
            var_dump( $this->predis->hGetAll("userid:22"));
    }
//    function sendMessage_t(){
//        $code='888888';
//        $phone='15626475581';
//        $result=$this->alimessage->send($code,$phone);
//        var_dump($result);
//    }
    function captcha_t(){
	$vals = array(
    'img_path'  => '/home/cds/captcha',
    'img_url'   => 'http://example.com/captcha/'
);

$cap = create_captcha($vals);
var_dump($cap);
}
}
