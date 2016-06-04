<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title>首页</title>
    <?php echo $commonCss;?>         
    <link rel="stylesheet" type="text/css" href='http://static.viewfuns.com/static/css/public.css?v=0.1'> 
    <link rel="stylesheet" type="text/css" href='http://static.viewfuns.com/static/css/load-com.css'>
    <link rel="stylesheet" type="text/css" href='http://static.viewfuns.com/static/css/load5.css'>
</head>

<body>
    <div id="tip1" class="load-container load5" style="z-index:125;position: fixed;display:none">
        <div class="loader">Loading...</div>
    </div>


    <article class="i_top">
        <div id="out">
            <div id="in">
                    <ul></ul>
            </div>
            <div class="ad_btn_wrap"></div>
        </div>
    </article>
    <ul id="ind_articles" class="index_content">
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
        <li><a href="<?php echo $base_url.'phone/shifan'?>"><span class="act" data-tag="0">首页</span></a></li>
        <li><a href="<?php echo $base_url.'phone/shifan/dgou'?>"><span data-tag="1">视范</span></a></li>
        <li><a href="<?php echo $base_url.'phone/Account/myProfile'?>"><span data-tag="2">我的</span></a></li>
        <li><a href="<?php echo $base_url.'phone/Goods/hsList'?>"><span data-tag="3">婚摄</span></a></li>
    </ul>-->
    <input type="hidden" id="_base_url" value="<?php echo $base_url;?>">
    <?php echo $commonJs;?>
    <script src='http://static.viewfuns.com/static/js/baidutouch.js' type="text/javascript" ></script>
    <script src='http://static.viewfuns.com/static/js/tween.js' type="text/javascript" ></script>
    <script type="text/javascript">
$(function(){
    var base_url = $('#_base_url').val();
    //获取定位
//    var dingwei=demo.getCity();
//    $('#_dingwei').html("当前城市:"+dingwei);
    //获取屏幕高度
//    $(function(){
//        var sh=document.documentElement.clientHeight;
//        var timetop = sh - 45;
//        $('.index_nav').css('top', timetop + "px");
//    })
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
    touch.on('#ind_articles', 'swipeup', function(ev){
  
        var offset=$('#ind_articles li').length;
        $.ajax({
            url:base_url+'phone/Shifan/ajaxIndex',
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
                $('#ind_articles').append(str);
            },
            error:function(){
                    $('#tip1').css("display","none");
            }
        })
    })
})
    
 //图片轮播
                        var links=[
				'viewfuns.html',
				'viewfuns.html',
				'viewfuns.html',
				'viewfuns.html',
				'viewfuns.html'
			];
$(document).ready(function() {
                       
			var lst = [
				'IMG_0363.jpg',
				'IMG_0364.jpg',
				'IMG_0365.jpg',
				'IMG_0366.jpg',
				'IMG_0367.jpg'
			];
                        
			var i=0;
			var htm = '';
			$(lst).each(function(k, v) {
				htm += "<li class='picslist' name='is_tj_r' data-tag=" + i + " style='padding-right: 0;'>";
                               
				htm += '<img src=<?php echo $base_url."static/article/index_img/"?>'+v+'>';
				htm += '</li>';
				$('.ad_btn_wrap').append('<a href="javascript:;"></a>');
                                i++;
			});
			/*
			 * 注意下面一截代码！
			 * 这些代码一个都不能少，否则css会出问题。
			 * 只需要把lst换成对应的图片集合就ok了
			 */
			$("#in ul").empty().append(htm);
			$("#in ul").css("width", (lst.length * 100) + "%");
			$("#in ul li").css("width", (100 / lst.length) + "%");
			$(lst).each(function(k1, v1) {
				if (k1 != 0)
					$(".ad_btn_wrap a").eq(k1).css("margin-left", "2%");
			});
			bindEvent();
		});
		var adIndex = 0,
			timer,
			autoTimer;
		 //广告图的滚动
		function adMove(el) {
			clearInterval(autoTimer);
			var ind = 0;
			var start = el.scrollLeft;
			var end = el.clientWidth * adIndex;
			var change = end - start;
			var max = $('#in li').length;

			clearInterval(timer);
			timer = setInterval(function() {
				ind++;
				if (ind == 20) {
					$('.ad_btn_wrap a').eq(adIndex).css('background', 'black'); //ff7b23
					clearInterval(timer);
					autoTimer = setInterval(function() {
						adIndex++;
						if (adIndex >= max) {
							adIndex = 0;
						};
						$('.ad_btn_wrap a').css('background', '#888888');
						adMove(document.getElementById('in'));
					}, 5000);
				}
				el.scrollLeft = Tween.Expo.easeOut(ind, start, change, 20);
			}, 33);
		}


		function bindEvent() {
			//广告事件
			$('#in').on('touchstart', 'img', function(event) {
				var wrap = $(this).parent().parent().parent();
				adIndex = $(this).parent().index();
				pageXStart = event.originalEvent.targetTouches[0].pageX;
			});

			$('#in').on('touchend', 'img', function(event) {
				pageXEnd = event.originalEvent.changedTouches[0].pageX;
				if (pageXEnd - pageXStart > 30) {
					// 左移  && adIndex != 0
					if (adIndex <= 0) {
						adIndex = $('#in li').length;
					};
					adIndex--;
					$('.ad_btn_wrap a').css('background', '#888888');
					adMove(document.getElementById('in'));
				} else if (pageXEnd - pageXStart < -30) {
					// 右移 && adIndex + 1 != $('#in li').length
					if (adIndex + 1 >= $('#in li').length) {
						adIndex = -1;
					};
					adIndex++;
					$('.ad_btn_wrap a').css('background', '#888888');
					adMove(document.getElementById('in'));
				}
			});

			autoTimer = setInterval(function() {
				adIndex++;
				if (adIndex >= 4) {
					adIndex = 0;
				}
				$('.ad_btn_wrap a').css('background', '#888888');
				adMove(document.getElementById('in'));
			}, 3333);
		}
$(function(){
	$('.picslist').tap(function() {
	    var picslist_tag=$(this).data('tag');
	    location.href='<?php echo $base_url."static/article/"?>'+links[picslist_tag];
	})
})
</script>
</body>
</html>
