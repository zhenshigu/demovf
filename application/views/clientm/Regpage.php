<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <?php echo $commonCss;?>
    
</head>

<body >
    
    <ul class="block1" id="block1">
        <li>
            <div class="shell_common">
            
                <input type="number" class="custom_input" id="yourphone" placeholder="输入要注册的手机号码">
            </div>
        </li>
        <li style="height: 40px">
            <div class="shell_input">
                <input class="custom_input" type="text" placeholder="输入图片验证码,看不清点击图片" id="imgcode" >
            </div>
            <div style="width:30%;text-align: right;float: left">
            <?php echo $imgcode;?>
            </div></li>
        <li style="background:#F1F3F2;padding-top:20px;"><div id="sendCode"  class="sendCode">获取短信验证码</div></li>   
    </ul>
    <ul class="block2" id="block2" style="display: none;">
        <li>
            <div style="width: 90%;margin-left:5%">
            
            <input type="text" class="custom_input" id="captcha" placeholder="输入收到的短信验证码">
            </div>
        </li>
        <li>
            <div style="width: 90%;margin-left:5%">
            
            <input type="password" class="custom_input" id="pwd" placeholder="输入你的密码">
            </div>
        </li>
        <li>
            <div style="width: 90%;margin-left:5%">
           
            <input type="password" class="custom_input" id="pwd2" placeholder="输入密码进行确认">
            </div>
        </li>
        <li style="background: #F1F3F2;padding-top: 20px;"><div id="sendCaptcha"   class="sendCode">注册</div></li>
    </ul>
    <input type="hidden" id="_base_url" value="<?php echo $base_url;?>">
    <?php echo $commonJs;?>
    <script type="text/javascript" src='http://static.viewfuns.com/static/js/mysha1.js'></script>

<script type="text/javascript">
$(function() {
    var base_url=$('#_base_url').val();
    $('#sendCode').tap(function() {
        var yourphone = $('#yourphone').val();
        var imgcode = $('#imgcode').val();
        $.ajax({
            url: base_url + 'phone/Account/getCaptcha',
            type: 'post',
            data: {
                yourphone:yourphone,
                imgcode:imgcode
            },
            success: function(data) {
                switch(data.code){
                    case 1:
                        $('#block1').toggle();
                        $('#sendCode').toggle();
                        $('#block2').toggle();
                        break;
                    case 0:
                        demo.showToast("图片验证码错误");
                        break;
                    case 10001:
                        demo.showToast("手机号码已经被注册");
                        break;
                    case 10004:
                        demo.showToast("手机号码格式错误,必须为11位数字");
                        break;
                    case -1:
                        deomo.showToast("短信验证码发送失败");
                        break;
                }                
            }
        })
    })
    $('#goback').tap(function(){
        demo.ToLogin();
    })
    $('#imgid').tap(function(){
        location.reload();
    })
    $('#sendCaptcha').tap(function(){
        var captcha=$('#captcha').val();
        var password=$('#pwd').val();
        var pwd2=$('#pwd2').val();
        var phone = $('#yourphone').val();
        if (!captcha||!password||!pwd2) {
            demo.showToast("输入框不能为空");
            return;
        }
        if (password!=pwd2) {
            demo.showToast("两次输入的密码不一致");
            return;
        }
        $.ajax({
            url: base_url + 'phone/Account/register',
            type: 'post',
            data: {
                captcha:captcha,
                phone:phone,
                password:hex_sha1(password),
                regtype:"byphone"
            },
            success: function(data) {
                switch(data.code){
                    
                    case 10011:
                        demo.showToast("注册类型不能为空");
                        break;
                    case 10007:
                        demo.showToast("手机号码不能为空");
                        break;
                    case 10024:
                        demo.showToast("短信验证码错误,请重新输入");
                        break;
                    case 1:
                        demo.showToast("注册成功");
                        demo.ToLogin();
                        break;
                }
            }
        })
    })
    $('#yourphone').on('blur',function(){
        var regAccount=$('#yourphone').val();     
        if(regAccount!=""){
            demo.saveAccount(regAccount);           
        }       
    })
    $('#yourphone').val(demo.getAccount());
})
</script>
</body>
</html>
