<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/apm.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/load-com.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/load5.css';?>">
    
</head>

<body>
<ul class="nav">
    <li><span class="act"><a href="<?php echo $base_url.'phone/goods/hsList'?>">婚摄</a></span></li>
    <li class="line-s"></li>
    <li><span><a href="<?php echo $base_url.'phone/Goods/storeList'?>">门店</a></span></li>
</ul>
<div id="tip1" class="load-container load5" style="z-index:125;position: fixed;display:none">
        <div class="loader">Loading...</div>
    </div>
    <ul class="nav_b" id="hstc">
        <?php
            if($res){
                foreach ($res as &$one){
                    $tcdetail=$base_url.'phone/Goods/hsdetail/'.$one['gid'].'/'.$one['sid'];
                    echo "<li><a href=$tcdetail><img src={$one['thumbnail']}>";
                    echo '<span class="hs_title_price">'."{$one['gname']} {$one['gprice']}".'</span></a></li>';
                }
            }
        ?>
    </ul>
    <!--
    <ul class="index_nav">
        <li><a href="<?php echo $base_url.'phone/shifan'?>"><span  data-tag="0">首页</span></a></li>
        <li><a href="<?php echo $base_url.'phone/shifan/dgou'?>"><span data-tag="1">视范</span></a></li>
        <li><a href="<?php echo $base_url.'phone/Account/myProfile'?>"><span data-tag="2">我的</span></a></li>
        <li><a href="<?php echo $base_url.'phone/Goods/hsList'?>"><span class="act" data-tag="3">婚摄</span></a></li>
</ul>-->
    <input type="hidden" id="_base_url" value="<?php echo $base_url; ?>">
    <script type="text/javascript" src="<?php echo $base_url.'static/js/zepto.js'?>"></script>

<script type="text/javascript">
    var base_url=$('#_base_url').val();
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
    $('#hstc').swipeUp(function(){
        var offset=$('#hstc li').length;
        $.ajax({
            url:base_url+'phone/Goods/ajaxHstc',
            type: 'post',           
            data: {city: '深圳市',offset:offset},
            beforeSend:function(){
 		 	$('#tip1').css("display","block");
 		 },
            success:function(data){
                $('#tip1').css("display","none");
                var str='';
                $.each(data,function(index,item){
                    str+='<li><a href='+base_url+'phone/Goods/hsdetail/'+item['gid']+'/'+item['sid']+'><img src="'+item['thumbnail']+'"><span class="hs_title_price">'+item['gname']+ ' '+item['gprice']+'元'+'</span></a></li>'
                })
                $('#hstc').append(str);
            },
            error:function(){
                    $('#tip1').css("display","none");
            }
        })
    })
    
</script>
</body>
</html>
