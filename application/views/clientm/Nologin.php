<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/apm.css?v=0.1';?>">
   
</head>

<body>
    <ul class="myinfo_head">
            <li >我的资料</li>
    </ul>
    <div style="
    width: 100%;
    height: 200px;
    text-align: center;
    padding-top: 100px;
">
        空空如也...
    </div>
    <div style="text-align: center">
    <span class="red_button"  onclick="demo.ToLogin()">去登录</span>
    <span class="blue_button"  onclick="demo.ToLogin()">去注册</span>
    </div>
     <script type="text/javascript" src="<?php echo $base_url.'static/js/zepto.js'?>"></script>
    <script type="text/javascript" src="<?php echo $base_url.'static/js/mysha1.js'?>"></script>
</body>
</html>