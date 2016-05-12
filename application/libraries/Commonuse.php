<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Commonuse{
    protected $CI;
    // We'll use a constructor, as you can't directly call a function
    // from a property definition.
    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
    }
    /**
     * 
     * 判断所需要的字段
     * 
     */
    function checkParams($params) {
        $post = $this->CI->input->post(NULL,TRUE);
        foreach ($params as &$param) {
            if (isset($post[$param])&&!empty($post[$param])) {
                return TRUE;
            }  else {
                return FALSE;
            }
        }
        return FALSE;
    }
    //生成图片缩略图
    function createThumb($path,$thumb_path,$scale=1){
        if(!file_exists($path)){
            return FALSE;
        }
        $imgInfo=  getimagesize($path);
        $imgHeight=$imgInfo[1];
        $imgWidth=$imgInfo[0];
        $ratio=$imgWidth/$imgHeight;
        $imgType=$imgInfo[2];
        $jpeg_quality=75;
        $desx=0;
        $desy=0; 
        $desw=100*$scale;
        $desh=  intval($desw/$ratio);
        if($imgType==1){
            $originalImg=  imagecreatefromgif($path);
        }elseif ($imgType==2) {
            $originalImg=  imagecreatefromjpeg($path);
        }elseif ($imgType==3) {
            $originalImg=  imagecreatefrompng($path);
        }
        if($originalImg){
            $newImg=  ImageCreateTrueColor($desw, $desh);
            if($newImg){
                imagecopyresampled($newImg, $originalImg,$desx,$desy,0,0,$desw,$desh,$imgWidth,$imgHeight);
                if($imgType==1){
                    if(imagegif($newImg,$thumb_path,$jpeg_quality)){
                        return TRUE;
                    }
                }elseif ($imgType==2) {
                    if(imagejpeg($newImg,$thumb_path,$jpeg_quality)){
                        return TRUE;
                    } 
                }elseif ($imgType==3) {
                    if(imagepng($newImg,$thumb_path,$jpeg_quality)){
                        return TRUE;
                    }
                }               
            }  
        }
        return FALSE;
    }
}