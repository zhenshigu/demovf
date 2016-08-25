<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">

  </head>
  <body>
    <div class="page-group">
        <div class="page page-current">
        <header class="bar bar-nav">
            <a class="icon icon-left pull-left"></a>
            <a class="icon icon-refresh pull-right"></a>
            <h1 class="title">用户登录</h1>
        </header>
        <div class="content">
  <div class="list-block">
    <ul>
      <!-- Text inputs -->
      <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
              <div class="item-title label" >手机号</div>
            <div class="item-input">
              <input type="text" placeholder="手机号" id="user_phone">
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-password"></i></div>
          <div class="item-inner">
            <div class="item-title label">密码</div>
            <div class="item-input">
                <input type="password" placeholder="密码" class="" id="user_password">
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <div class="content-block">
    <div class="row">
      <div class="col-50"><a href="#" class="button button-big button-fill button-danger">取消</a></div>
      <div class="col-50"><a href="#" class="button button-big button-fill button-success" id="mylogin">登录</a></div>
    </div>
  </div>
            
</div>
        </div>
    </div>
<input type="hidden" id="_base_url" value="<?php echo $base_url;?>">
     <?php echo $commonJs;?>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
    <script type="text/javascript" src='http://static.viewfuns.com/static/js/mysha1.js'></script>
    <script type="text/javascript">
        $('#mylogin').tap(function(){
            var base_url=$('#_base_url').val();
            var account=$('#user_phone').val();
            var password=$('#user_password').val();
            if(account==''||password==''){
                $.toast("手机号或者密码不能为空");
                return;
            }
            $.ajax({
            url: base_url + 'phone/Account/login',
            type: 'post',
            data: {
                account:account,
                password:hex_sha1(password),
            },
            success: function(data) {
                console.log(data);
                switch(data.code){                   
                    case 10013:
                        $.toast("登录失败");
                        break;
                    case 10012:
                        window.location.href=base_url+'phone/account/myprofile';
                        break;
                }
            }
        })
        })
    </script>
  </body>
</html>