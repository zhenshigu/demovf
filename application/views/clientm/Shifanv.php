<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/apm.css?v=0.1';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/load-com.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/load5.css';?>">
    
</head>

<body id="mybody">
    
    <ul class="classify">
        <li><span class="act_red" data-tag="0">韩国风</span></li>
        <li><span data-tag="1">欧美风</span></li>
        <li><span data-tag="2">复古风</span></li>
        <li><span data-tag="3">清新风</span></li>
        <li id="more"><span data-tag="4"><img src="<?php echo $base_url.'static/img/icon_dropdown.png'?>"></span></li>
        <li class="to_hidden"><span data-tag="5">甜美风</span></li>
        <li class="to_hidden"><span data-tag="6">校园风</span></li>
        <li class="to_hidden"><span data-tag="7">日系</span></li>
        <li class="to_hidden"><span data-tag="8">美系</span></li>
        <li class="to_hidden"><span data-tag="9">高原风</span></li>
        <li class="to_hidden"><span data-tag="10">流行榜</span></li>
        <li class="to_hidden"><span data-tag="11">热销榜</span></li>
        <li class="to_hidden"><span data-tag="12">unknown</span></li>
        <li class="to_hidden"><span data-tag="13">unknown</span></li>
        <li class="to_hidden"><span data-tag="14">unknown</span></li>
    </ul>
    <div id="tip1" class="load-container load5" style="z-index:125;position: fixed;display:none">
        <div class="loader">Loading...</div>
    </div>
    <ul id="dgl" class="dgou_content">
        <?php if($res){
            foreach($res as $one){
                ?>
                <li>
                <a href="<?php echo $one['url'];?>">
                <img src="<?php echo $one['headimg'];?>">
                <p><?php echo $one['title'];?></p>
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
        <li><a href="<?php echo $base_url.'phone/shifan/dgou'?>"><span class="act" data-tag="1">视范</span></a></li>
        <li><a href="<?php echo $base_url.'phone/Account/myProfile'?>"><span data-tag="2">我的</span></a></li>
        <li><a href="<?php echo $base_url.'phone/Goods/hsList'?>"><span data-tag="3">婚摄</span></a></li>
    </ul>-->
    <input type="hidden" id="_base_url" value="<?php echo $base_url;?>">
    <script type="text/javascript" src="<?php echo $base_url.'static/js/zepto.js'?>"></script>

<script type="text/javascript">
$(function(){
    var base_url = $('#_base_url').val();
//获取屏幕高度
//    var sh=document.documentElement.clientHeight;
//    var timetop = sh - 45;
//    $('.index_nav').css('top', timetop + "px");
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
    $('#dgl').swipeUp(function(){
        var offset=$('#dgl li').length;
        $.ajax({
            url:base_url+'phone/Shifan/ajaxDgl',
            type: 'post',           
            data: {offset:offset},
            beforeSend:function(){
 		 	$('#tip1').css("display","block");
 		 },
            success:function(data){
                $('#tip1').css("display","none");
                var str='';
                $.each(data,function(index,item){
                    str+='<li><a href='+item['url']+'><img src="'+item['headimg']+'"><p>'+item['title']+'</p></a></li>'
                })
                $('#dgl').append(str);
            },
            error:function(){
                    $('#tip1').css("display","none");
            }
        })
    })
    $('.classify li').tap(function() {
        $('.classify li span').removeClass("act_red");
        $(this).children().addClass("act_red");
        var _tag = $(this).children().data("tag");
        current = _tag;
        switch (_tag) {
            case 0:

                break;
            case 1:

                break;
            case 2:

                break;
        }
    })
    $('#more').tap(function(){
        $('.to_hidden').toggle();
    })
})
</script>
</body>
</html>

