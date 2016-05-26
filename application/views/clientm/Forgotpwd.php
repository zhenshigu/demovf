<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/apm.css';?>">
    <script type="text/javascript" src="<?php echo $base_url.'static/js/zepto.js'?>"></script>
    <script type="text/javascript" src="<?php echo $base_url.'static/js/mysha1.js'?>"></script>
</head>

<body style="background: #fff">
    <ul class="reg_head">
        <li><span id="goback" ><img class="rotate" src="<?php echo $base_url.'static/img/icon_dropdown.png';?>"></span><span>忘记密码</span></li>
    </ul>
    <ul class="block1" id="block1">
        <li>
            <div class="shell_common margin_bottom_10">
                
                <input id="_newphone" type="text" class="custom_input"  placeholder="输入手机号码">
            </div>
            <div class="shell_common margin_bottom_10">
                <span ></span>
                <span ><input type="text" class="custom_input" style="width: 80px" id="phoneCaptcha" placeholder="输入短信验证码"></span>
                <button id="modify_captcha" class="white_button modify_captcha" style="width:40%;height: 30px;float: right" onclick="getMyCaptcha($(this))">获取验证码</button>        
            </div>
            <div class="shell_common margin_bottom_10">
               
                <input type="password" class="custom_input" id="mynewPwd" placeholder="输入新密码">
                </div>
                <div class="shell_common margin_bottom_10">
                
                <input type="password" class="custom_input" id="confPwd" placeholder="输入密码进行确认">
                </div>
        </li>
        <li class="txtcenter"><span id="setPwd" style="line-height: 30px" class="white_button ">提交</span></li>
    </ul>
    <input type="hidden" id="_base_url" value="<?php echo $base_url;?>">
<script type="text/javascript">
 var base_url=$('#_base_url').val();
$('#goback').tap(function(){
   demo.ToLogin();
})
 //获取短信验证码
var countdown=60;
function getMyCaptcha(obj){
    var yourphone=$('#_newphone').val();
    if(!yourphone){
        demo.showToast("先输入新手机号码");
        return;
    }
    $.ajax({
        url: base_url + 'phone/Account/myCaptcha',
        type: 'post',
        data: {
            yourphone:yourphone,
            type:2
        },
        success: function(data) {
            switch(data.code){
                case 1:
                    demo.showToast("发送短信验证码成功");
                    break;
                case -1:
                    demo.showToast("服务器发送短信验证码出错");
                
                    break;
                case 10004:
                    demo.showToast("手机格式不正确");
                    
                    break;
                case 10026:
                    demo.showToast("该手机号码还没被注册");
                    
                    break;
                
            }
        }
    })
    settime(obj);
}
function settime(obj) {
    
    if (countdown == 0) { 
        //obj.addClass("modify_captcha");  
        obj.removeAttr('disabled');       
        obj.text("免费获取验证码"); 
        countdown = 60; 
        return;
    } else { 
        //obj.removeClass("modify_captcha"); 
        obj.attr('disabled','true');
        obj.text("重新发送(" + countdown + ")"); 
        countdown--; 
    } 
    setTimeout(function() { 
    settime(obj) }
    ,1000) 
}
//设置手机号码
$('#setPwd').tap(function(){
    var yourphone=$('#_newphone').val();    
    if(!yourphone){
        demo.showToast("先输入新手机号码");
        return;
    }
    var mynewPwd=$('#mynewPwd').val();
    var confPwd=$('#confPwd').val();
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
    var captcha=$('#phoneCaptcha').val();
    if(!captcha){
        demo.showToast("请先输入短信验证码");
        return;
    }
    $.ajax({
        url: base_url + 'phone/Account/forgotPwd',
        type: 'post',
        data: {
            phone:yourphone,
            captcha:captcha,
            passwd:hex_sha1(mynewPwd),
            type:1
        },
        success: function(data) {
            switch(data.code){
                case 1:
                    demo.showToast("重置密码成功");      
                    demo.ToLogin();
                    break;
                case 0:
                    demo.showToast("重置密码失败");
                    break;
                case 10004:
                    demo.showToast("手机格式不正确");
                    break;
                case 10010:
                    demo.showToast("密码不能为空");
                    break;
                case 10024:
                    demo.showToast("短信验证码错误");
            }
        }
    })
})
</script>
</body>