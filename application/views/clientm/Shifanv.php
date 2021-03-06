<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <?php echo $commonCss;?>
    <link rel="stylesheet" type="text/css" href='http://static.viewfuns.com/static/css/load-com.css'>
    <link rel="stylesheet" type="text/css" href='http://static.viewfuns.com/static/css/load5.css'>
    
</head>

<body id="mybody">
    
    <ul class="classify">
        <li><span class="act_red" data-tag="-1">全部</span></li>
        <li><span data-tag="18">攻略</span></li>
        <li><span data-tag="17">影楼</span></li>
        <li><span data-tag="15">风格</span></li>      
        <li id="more"><span data-tag="-2"><img src="<?php echo $base_url.'static/img/icon_dropdown.png'?>"></span></li>
        <li class="to_hidden"><span data-tag="21">婚纱</span></li>
        <li class="to_hidden"><span data-tag="16">拍摄地</span></li>
        <!--<li class="to_hidden"><span  data-tag="1">韩式风</span></li>
        <li class="to_hidden"><span data-tag="2">欧式风</span></li>
        <li class="to_hidden"><span data-tag="3">中式风</span></li> 
        <li class="to_hidden"><span data-tag="4">碧海蓝天</span></li>-->
        <li class="to_hidden"><span data-tag="5">海景风</span></li>
        <!--<li class="to_hidden"><span data-tag="6">古典风</span></li>
        <li class="to_hidden"><span data-tag="7">浪漫风</span></li>
        <li class="to_hidden"><span data-tag="8">清新自然</span></li>
        <li class="to_hidden"><span data-tag="9">山水风</span></li>
        <li class="to_hidden"><span data-tag="10">奢华风</span></li>-->
        <li class="to_hidden"><span data-tag="11">公主风</span></li>
        <li class="to_hidden"><span data-tag="12">水底风</span></li>
        <li class="to_hidden"><span data-tag="13">美人鱼</span></li>
        <li class="to_hidden"><span data-tag="19">体验</span></li>
        <li class="to_hidden"><span data-tag="20">旅拍</span></li>
        <li class="to_hidden"><span data-tag="22">星座</span></li>
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
    <input type="hidden" id="_base_url" value="<?php echo $base_url;?>">
    <script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
    <script src='http://static.viewfuns.com/static/js/baidutouch.js' type="text/javascript" ></script>
    <script type="text/javascript">
$(function(){
    var base_url = $('#_base_url').val();
    var current=-1;
    var swipeup=false;
    //swipe up to add more
    touch.on('#dgl', 'swipeup', function(ev){
        if(swipeup){
            
            return;
        }
        swipeup=true;
        var offset=$('#dgl li').length;
        $.ajax({
            url:base_url+'phone/Shifan/ajaxDgl',
            type: 'post',           
            data: {offset:offset,type:current},
            beforeSend:function(){
 		 	$('#tip1').css("display","block");
 		 },
            success:function(data){
                
                $('#tip1').css("display","none");
                var str='';
                $.each(data,function(index,item){
                    str+='<li><a href='+item['url']+'><img src="'+item['headimg']+'"><p>'+item['title']+'</p></a></li>';
                });
                $('#dgl').append(str);
                swipeup=false;
            },
            error:function(){
                $('#tip1').css("display","none");
                swipeup=false;
            }
        });
    });
    $('.classify li').on('tap',function() {
        $('.classify li span').removeClass("act_red");
        $(this).children().addClass("act_red");
        var _tag = $(this).children().data("tag");
         console.log(1);
        if(_tag==-2){           
            $('.to_hidden').toggle();
            return;
        }
        current = _tag;
        $.ajax({
            url:base_url+'phone/Shifan/ajaxDgl',
            type: 'post',           
            data: {offset:0,type:current},
            beforeSend:function(){
 		 	$('#tip1').css("display","block");
 		 },
            success:function(data){
                $('#tip1').css("display","none");
                var str='';
                $.each(data,function(index,item){
                    str+='<li><a href='+item['url']+'><img src="'+item['headimg']+'"><p>'+item['title']+'</p></a></li>';
                });
                $('#dgl').html(str);
            },
            error:function(){
                    $('#tip1').css("display","none");
            }
        });
    });
});
</script>
</body>
</html>

