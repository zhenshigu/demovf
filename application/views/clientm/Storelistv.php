<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/apm.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/load-com.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/load5.css';?>">
    
</head>

<body>
    <div class="page-group">
        <!-- 单个page ,第一个.page默认被展示-->
        <div class="page">
             <nav class="bar bar-tab">
                <a class="tab-item external " href="/phone/shifan">
                    <span class="icon icon-home"></span>
                    <span class="tab-label">首页</span>
                </a>
                <a class="tab-item external active" href="/phone/goods/hslist">
                    <span class="icon icon-cart"></span>
                    <span class="tab-label">交易</span>
                </a>
                <a class="tab-item external " href="/phone/account/myprofile">
                    <span class="icon icon-me"></span>
                    <span class="tab-label">我的</span>
                </a>
            </nav>
            <!-- 这里是页面内容区 -->
            <div class="content">
<ul class="nav">
    <li><span  ><a external href="<?php echo $base_url.'phone/goods/hsList'?>">婚摄</a></span></li>
    <li class="line-s"></li>
    <li><span class="act"><a external href="<?php echo $base_url.'phone/Goods/storeList'?>">影楼</a></span></li>
</ul>
<div id="tip1" class="load-container load5" style="z-index:125;position: fixed;display:none">
        <div class="loader">Loading...</div>
    </div>
    <ul class="nav_b" id="hstc">
        <?php 
            if(!empty($res)){
                foreach ($res as &$one){
                    ?>
                    <li>
                    <a href="<?php echo $base_url.'phone/Goods/storeDetail/'.$one['sid'];?>">
                        <img src="<?php echo $one['headimg']; ?>">
                    <span class="store_name"><?php echo $one['nickname'];?></span><span class="store_place"><?php echo $one['district'].$one['address']?></span>
                    </a>
                    </li>
        <?php
                }
            }
        ?>
        
    </ul>
    <!--
    <ul class="index_nav">
        <li><a href="<?php echo $base_url.'phone/shifan'?>"><span  data-tag="0">首页</span></a></li>
        <li><a href="<?php echo $base_url.'phone/shifan'?>"><span data-tag="1">视范</span></a></li>
        <li><a href="<?php echo $base_url.'phone/Account/myProfile'?>"><span data-tag="2">我的</span></a></li>
        <li><a href="<?php echo $base_url.'phone/Goods/hsList'?>"><span class="act" data-tag="3">婚摄</span></a></li>
</ul>-->
    </div>
   </div>
 </div>
    <script type="text/javascript" src="http://static.viewfuns.com/static/js/zepto.js"></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
<script type="text/javascript">
    $('#hstc').swipeUp(function(){
        var str='    <li><img src="../img/2.jpg"><a href=""><span class="store_name">海天盛宴婚纱摄影 3999元</span><span class="store_palce">海南三亚</span></a></li>'
//        $('#hstc').append(str);
    })
        //获取屏幕高度
//$(function(){
//    var sh=document.documentElement.clientHeight;
//var timetop = sh - 45;
//$('.index_nav').css('top', timetop + "px");
//})

$('.index_nav li').tap(function() {
    $('.index_nav li span').removeClass("act");
    $(this).children().addClass("act");
    var _tag = $(this).children().data("tag");
    current = _tag;
    switch (_tag) {
        case 0:

            break;
        case 1:

            break;
        case 2:

            break;
        case 3:
//            location=base_url+demo.getCity();
    }
})
</script>
</body>
</html>

