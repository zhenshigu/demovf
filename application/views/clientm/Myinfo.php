<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/apm.css';?>">
    <script type="text/javascript" src="<?php echo $base_url.'static/js/zepto.js'?>"></script>
    <script type="text/javascript" src="<?php echo $base_url.'static/js/mysha1.js'?>"></script>
</head>

<body>
<ul class="myinfo_head">
        <li >我的资料</li>
    </ul>
<ul class="myinfo_body">
    <li id="headimg"><span>头像:</span><span id="append_img"><img class="thumb_head" src=""></span><span><img class="small_arrow" src="<?php echo $base_url.'static/img/next.png';?>"></span></li>
    <li id="phone"><span >手机号码:</span><span id="append_phone"></span><span><img class="small_arrow" src="<?php echo $base_url.'static/img/next.png';?>"></span></li>
    <li id="nickname"><span>昵称:</span><span  id="append_name"></span><span><img class="small_arrow" src="<?php echo $base_url.'static/img/next.png';?>"></span></li>
    <li id="gender"><span>性别:</span><span id="append_sex"></span><span><img class="small_arrow" src="<?php echo $base_url.'static/img/next.png';?>"></span></li>
    <li id="setpwd">修改密码</li>
</ul>
<ul class="myinfo_order">
<li>订单</li>
<li>收藏</li>
<li>分享</li>
</ul>
<ul class="myinfo_foot">
    <li><span class="orange_button" id="logout">退出</span></li>
</ul>
    <!--
    <ul class="index_nav">
        <li><a href="<?php echo $base_url.'phone/shifan'?>"><span  data-tag="0">首页</span></a></li>
        <li><a href="<?php echo $base_url.'phone/shifan/dgou'?>"><span data-tag="1">视范</span></a></li>
        <li><a href="<?php echo $base_url.'phone/Account/myProfile'?>"><span class="act" data-tag="2">我的</span></a></li>
        <li><a href="<?php echo $base_url.'phone/Goods/hsList'?>"><span data-tag="3">婚摄</span></a></li>
    </ul>-->
<div id="mask" class="mask"> </div>
    <div class="forgender" id="forgender">
        <ul>
            <li style="border-bottom: 2px solid #E2DADA;">修改性别 </li>
            <li id="setboy">男</li>
            <li id="setgirl">女</li>
        </ul>
    </div>
    <div class ="forphone" id="forphone">
        <ul>
        <li style="border-bottom: 2px solid #E2DADA;">修改手机号码 </li>
        <li>
            <div class="shell_common margin_bottom_10">
                手机号码:
                <input type="text" class="custom_input" id="" placeholder="输入手机号码">
            </div>
        </li>
            <li class="txtcenter"><span class="white_button ">提交</span></li>
        </ul>
    </div>
    <div class ="forname" id="forname">
        <ul>
        <li style="border-bottom: 2px solid #E2DADA;">修改昵称 </li>
        <li>
        <div class="shell_common margin_bottom_10">
            昵称:
            <input type="text" id="myname" class="custom_input"  placeholder="输入昵称">
        </div>
        </li>
        <li class="txtcenter"><span class="white_button" id="setname">提交</span></li>
        </ul>
    </div>
    <div class="forsetpwd" id="forsetpwd">
        <ul>
            <li style="border-bottom: 2px solid #E2DADA;">修改密码</li>
            <li>
                <div class="shell_common margin_bottom_10">
                旧密码:
                <input type="password" class="custom_input" id="myoldPwd" placeholder="输入旧密码">
                </div>
                <div class="shell_common margin_bottom_10">
                新密码:
                <input type="password" class="custom_input" id="mynewPwd" placeholder="输入新密码">
                </div>
                <div class="shell_common margin_bottom_10">
                确认密码:
                <input type="password" class="custom_input" id="confPwd" placeholder="输入密码进行确认">
                </div>
            </li>
            <li class="txtcenter"><span class="white_button" id="modifyPwd">提交</span></li>
        </ul>
    </div>
<input type="hidden" id="_base_url" value="<?php echo $base_url; ?>">
</body>
<script type="text/javascript">
 var base_url=$('#_base_url').val();
$(function(){
    $.ajax({
        url: base_url + 'phone/Account/ajaxProfile',
        type: 'post',
        data: {
            sign_time_id:demo.getSign()
        },
        success: function(data) {
            if(data.toLogin){
                demo.ToLogin();
            }else{
                
                var str='<img class="thumb_head" src="'+data.headimg+'">';
                $('#append_img').html(str);
                $('#append_name').html(data.username);
                $('#append_phone').html(data.phone);
                if(data.sex==0){
                    $('#append_sex').html("女");
                }else{
                    $('#append_sex').html("男");
                }
            }
        }
    })
//    var sh=document.documentElement.clientHeight;
//    var timetop = sh - 45;
//    $('.index_nav').css('top', timetop + "px");
//    $('.index_nav li').tap(function() {
//        $('.index_nav li span').removeClass("act");
//        $(this).children().addClass("act");
//        var _tag = $(this).children().data("tag");
//        current = _tag;
//        switch (_tag) {
//            case 0:
//
//                break;
//            case 1:
//
//                break;
//            case 2:
//
//                break;
//            case 3:
//    //            location=base_url+demo.getCity();
//        }
//    })
})
$('#gender').tap(function() {
    $("#mask").show().css("opacity", "0.8");
    $('#forgender').show();
})
$('#phone').tap(function(){
    $("#mask").show().css("opacity", "0.8");
    $("#forphone").show();

})
$('#setpwd').tap(function(){
    $("#mask").show().css("opacity", "0.8");
    $('#forsetpwd').show();
})
$('#nickname').tap(function(){
    $("#mask").show().css("opacity", "0.8");
    $("#forname").show();
})
$('#mask').tap(function(){
    $(this).hide();
    $('#forgender').hide();
    $('#forname').hide();
    $('#forphone').hide();
    $('#forsetpwd').hide();
})
$('#setboy').tap(function(){
    $.ajax({
        url: base_url + 'phone/Account/setGender/'+demo.getSign(),
        type: 'post',
        data: {
            gender:1
        },
        success: function(data) {
            if(data==1){
                $('#gender').html('<span>性别:</span><span>男</span>');
                 onEvent("setSex","男",1);
            }else{
                demo.showToast('设置失败');
            }
            $('#mask').hide();
            $('#forgender').hide();
        }
    })
})
$('#setgirl').tap(function(){
    $.ajax({
        url: base_url + 'phone/Account/setGender/'+demo.getSign(),
        type: 'post',
        data: {
            gender:0
        },
        success: function(data) {
            if(data==1){
                $('#gender').html('<span>性别:</span><span>女</span>');
                $('#mask').hide();
            $('#forgender').hide();
            onEvent("setSex","女",1);
            }else{
                demo.showToast('设置失败');
            }
        }
    })
})
$('#setname').tap(function(){
    var name=$('#myname').val();
        $.ajax({
        url: base_url + 'phone/Account/setNickname/'+demo.getSign(),
        type: 'post',
        data: {
            name:name
        },
        success: function(data) {
            if(data==1){
                $('#nickname').html('<span>昵称:</span><span>'+name+'</span>');
                $('#mask').hide();
            $('#forname').hide();
            }else{
                demo.showToast('设置失败');
            }
        }
    })
})
$('#modifyPwd').tap(function(){
    var myoldPwd=$('#myoldPwd').val();
    var mynewPwd=$('#mynewPwd').val();
    var confPwd=$('#confPwd').val();
    if(!myoldPwd){
        demo.showToast("旧密码不能为空");
        return;
    }
    if(!mynewPwd){
        demo.showToast("新密码不能为空");
        return;
    }
    if(!confPwd){
        demo.showToast("确认密码不能为空");
        return;
    }
    if(mynewPwd!=confPwd){
        demo.showToast("新密码和确认密码不一致");
        return;
    }
    $.ajax({
            url: base_url + 'phone/Account/setPwd',
            type: 'post',
            data: { 
                oldPwd:hex_sha1(myoldPwd),
                password:hex_sha1(mynewPwd),
                sign_time_id:demo.getSign()
            },
            success: function(data) {
                switch(data.code){
                    
                    case 0:
                        demo.showToast("修改密码失败");
                        break;
                    case 10010:
                        demo.showToast("密码不能为空");
                        break;     
                    case -1:
                        demo.showToast("旧密码不正确");
                        break; 
                    case 1:
                        demo.showToast("修改密码成功");
   
                        break;
                }
            }
        })
})
$('#logout').tap(function(){
    $.ajax({
        url: base_url + 'phone/Account/logout/'+demo.getSign(),
        type: 'post',
        data: {
        },
        success: function(data) {
            if(data==1){
                demo.showToast('退出成功');
                demo.ToLogin();
            }else{
                demo.showToast('退出失败');
            }
        }
    })
})
$('#headimg').tap(function(){
    demo.setHeadimg();
})
function onEvent(tag, label, duration) {
    prompt("event", JSON.stringify({tag:tag,label:label, duration:duration}));
}

function onKVEvent(tag, map, duration) {
    map.id = tag;
    map.duration = duration;
    prompt("ekv", JSON.stringify( map ));
}

</script>

</html>
