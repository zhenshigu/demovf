<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/apm.css';?>">
    <script type="text/javascript" src="<?php echo $base_url.'static/js/zepto.js'?>"></script>
</head>
    <body>
        <!--
        <form action="http://192.168.31.181:8011/phone/Account/setHead" method="post" enctype="multipart/form-data" >
            <input type="file" name="file">
            <input type="submit">
        </form>
        -->
        <ul>
            <li>我的资料</li>
        </ul>
        <script>
            $('ul li').tap(function(){
                window.location.href="http://192.168.31.181:8011/phone/Account/myProfile/"+demo.getSign();
            })
            </script>
    </body>
</html>
