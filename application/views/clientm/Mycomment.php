<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">     
</head>

<body>
     <div class="page-group">
        <div class="page">
            <!-- 标题栏 -->
            <header class="bar bar-nav">
                <a class="icon icon-left pull-left"></a>
            <a class="icon icon-refresh pull-right"></a>
                <h1 class="title">订单评价</h1>
            </header>
          <!-- 工具栏 -->
            <nav class="bar bar-tab">
                <a class="tab-item external " href="/phone/shifan">
                    <span class="icon icon-home"></span>
                    <span class="tab-label">首页</span>
                </a>
                <a class="tab-item external" href="/phone/goods/hslist">
                    <span class="icon icon-cart"></span>
                    <span class="tab-label">交易</span>
                </a>
                <a class="tab-item external active" href="/phone/account/myprofile">
                    <span class="icon icon-me"></span>
                    <span class="tab-label">我的</span>
                </a>
            </nav>
         <!-- 这里是页面内容区 -->
            <div class="content">
                  <div class="list-block">
    <ul>
      
      <li class="align-top">
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-comment"></i></div>
          <div class="item-inner">
            <div class="item-title label">评价</div>
            <div class="item-input">
                <textarea id="good_comment"><?php echo isset($good_comment)?$good_comment:'';?></textarea>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
 <?php if(@empty($good_comment)){?>
  <div class="content-block">
    <div class="row">
      <div class="col-50"><a href="javascript:history.go(-1)" class="button button-big button-fill button-danger">取消</a></div>
      <div class="col-50"><a href="#" id="submit_comment" class="button button-big button-fill button-success">提交</a></div>
    </div>
  </div>
 <?php }?>
            </div>
        </div>
    </div>
    <input type="hidden" id="_base_url" value="<?php echo $base_url; ?>">
    <input type="hidden" id="_oid" value="<?php echo $oid; ?>">
    <script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
<script type="text/javascript">
    var base_url=$('#_base_url').val();
    var oid=$('#_oid').val();
    $('#submit_comment').click(function(){
        var theComment=$('#good_comment').val();
        if(theComment==''){
            $.toast('评价不能为空白');
            return;
        }
        $.ajax({
            url:base_url+'phone/Goods/ajaxComment',
            type: 'post',           
            data: {oid: oid,ostatus:3,theComment:theComment},
            success:function(data){
                if(data==1){
                    $.toast('评价成功');
                    history.go(0);
                }else if(data==-1){
                    $.toast('你还没登录');
                }
            }
        })
    })
    $('.pull-left').click(function(){
        history.go(-1);
    })
    $('.pull-right').click(function(){
        history.go(0);
    })
</script>
</body>
</html>
