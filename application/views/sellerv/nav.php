<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <title>index</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="renderer" content="webkit">
        <link rel="stylesheet" type="text/css" href=<?php echo $base_url."static/css/bootstrap.min.css"?>>
<!--[if lte IE 9]>
<script src="http://192.168.31.181:8011/static/js/respond.js"></script>
<script src="http://192.168.31.181:8011/static/js/html5shiv.min.js"></script>
<![endif]-->
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://cdn.bootcss.com/jquery/1.12.1/jquery.min.js"></script>
     <script type="text/javascript" src=<?php echo $base_url."static/js/bootstrap.min.js"?>></script>
    <style type="text/css">
    body {
        padding-top: 70px;
    }
    </style>
    <?php if (isset($extra_info)){
            echo $extra_info;
    }
    ?>

</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">管理系统</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo $base_url.'seller/saccount/index'?>">首页<span class="sr-only">(current)</span></a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">套餐管理 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $base_url.'seller/goodsmanage/createNewtc'?>">新增套餐</a></li>
                            <li><a href="<?php echo $base_url.'seller/goodsmanage/showAlltc'?>">查看套餐</a></li>
                        </ul>
                    </li>
                 <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">预约单管理 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $base_url.'seller/Ordermanage/newOrdersList'?>">新预约单</a></li>
                            <li><a href="<?php echo $base_url.'seller/Ordermanage/ordersList'?>">所有预约单</a></li>
                        </ul>
                    </li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">资料管理 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $base_url.'seller/Saccount/setprofile'?>">商家资料查看</a></li>
                             <li><a href="<?php echo $base_url.'seller/Saccount/setHeadImg'?>">上传头像</a></li>
                            <li><a href="<?php echo $base_url.'seller/Saccount/setPwd'?>">修改密码</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_SESSION['sid'])){?>
                    <li><a href="<?php echo $base_url.'seller/Saccount/logout'?>">退出</a></li>         
                    <?php }?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
