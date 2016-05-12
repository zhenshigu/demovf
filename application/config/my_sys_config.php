<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$myhost='http://139.129.15.27';
//套餐图片服务器存放地址
$config['tc_img']='../upload/img_';
//套餐图片http存放地址
$config['http_tc_img']= "$myhost/upload/img_";
//控制器类地址
$config['ctl_dir']="$myhost/seller/";
//客户端图片服务器存放地址
$config['client_img']='../upload/customer/customer_';
//客户端图片http存放地址
$config['http_client_img']="$myhost/upload/customer/customer_";
//导购文章http存放地址
$config['http_article']="$myhost/static/article/";
//导购文章图片存放地址
$config['http_article_img']="$myhost/static/article/art-img/";
//验证码服务器存放地址
$config['captcha']='./static/captcha/';
//验证码http地址
$config['http_captcha']="$myhost/static/captcha/";
