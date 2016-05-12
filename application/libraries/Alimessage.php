<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include APPPATH.'third_party/alimessage/TopSdk.php';
class Alimessage{
    private $config;
    private $c;
    private $req;
    public function __construct($config) {
        $defaultConfig=array('product'=>'视范','appkey'=>'','secretKey'=>'',
        'format'=>'json','extend'=>'','smstype'=>'normal',
            'FreeSignName'=>'视范','templateCode'=>'SMS_8905738');
        $this->config=  array_merge($defaultConfig,$config);
        $this->c=new TopClient;
        $this->c->appkey=  $this->config['appkey'];
        $this->c->secretKey=  $this->config['secretKey'];
        $this->c->format=  $this->config['format'];
        $this->req=new AlibabaAliqinFcSmsNumSendRequest;
        $this->req->setExtend($this->config['extend']);
        $this->req->setSmsType($this->config['smstype']);
        $this->req->setSmsFreeSignName($this->config['FreeSignName']);
        $this->req->setSmsTemplateCode($this->config['templateCode']);
    }
    public function send($code,$phones){
        $this->req->setSmsParam("{\"code\":\"".$code."\",\"product\":\"".$this->config['product']."\"}");
        $this->req->setRecNum($phones);
        $response= $this->c->execute($this->req);
        return $this->objectArray($response);
        
    }
    //stdClass Object 转 数组
    private function objectArray($array){
        if(is_object($array)){
            $array = (array)$array;
        }
        if(is_array($array)){
            foreach($array as $key=>$value){
                $array[$key] = $this->objectArray($value);
            }
        }
        return $array;
    }
}


