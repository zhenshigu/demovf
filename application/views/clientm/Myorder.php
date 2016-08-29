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
    <?php echo $commonCss; ?>
</head>

<body>
        <div class="page-group">
        <!-- 单个page ,第一个.page默认被展示-->
        <div class="page">
            <!-- 标题栏 -->
           <header class="bar bar-nav">
            <a class="icon icon-left pull-left"></a>
            <a class="icon icon-refresh pull-right"></a>
            <h1 class="title">我的订单</h1>
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
                     <?php 
            if($res){
                foreach ($res as $one){                   
                    ?>
              <div class="card">
                <div class="card-header"><a href="<?php echo $base_url.'phone/Goods/storedetail/'.$one['sid']; ?>"> <?php echo $one['nickname'];?></a></div>
                <div class="card-content">
                  <div class="list-block media-list">
                    <ul>
                        
                      <li class="item-content">
                        <div class="item-media">
                            <a external href="<?php echo $base_url.'phone/Goods/hsdetail/'.$one['gid'].'/'.$one['sid']; ?>">
                          <img src="<?php echo $one['thumbnail'];?>" width="44">
                            </a>
                        </div>
                        <div class="item-inner">
                          <div class="item-title-row">
                            <div class="item-title"><span><?php echo $one['oname'];?></span><span style="float: right;"><?php echo $one['oprice'];?></span></div>
                          </div>
                          <div class="item-subtitle"><?php echo $one['odescription'];?></div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="card-footer">
                  <span>2015/01/15</span>
                  <span>
                            <input type="hidden" value="<?php echo $one['oid'];?>">
                         <?php if($one['ostatus']==1){ ?>
                         <a href="#" class="button confirm_but">确认收货</a>
                        <a href="#" class="button cancel_but">取消订单</a>                          
                         <?php }elseif ($one['ostatus']==3) {?>
                                   <a external href="/phone/goods/showcomment/<?php echo $one['oid'];?>" class="button">评价</a>
                            <?php }elseif ($one['ostatus']==2) {?>
                                   <a href="#" class="button button-dark">已取消</a>                                                
                                <?php  }
                                 ?>
                        
                 </span>
                </div>
                </div>  
                        <?php
                }
            }
        ?>
                 
            </div>
        </div>
    </div>

   
    <input type="hidden" id="_base_url" value="<?php echo $base_url; ?>">
    <script type="text/javascript" src="<?php echo $base_url.'static/js/zepto.js'?>"></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
<script type="text/javascript">
    var base_url=$('#_base_url').val();
    //确认收货
    $('.confirm_but').tap(function(){
        var oid=$(this).prev().val();
        var current=$(this);
         $.ajax({
            url:base_url+'phone/Goods/setStatus',
            type: 'post',           
            data: {oid: oid,userid:1,ostatus:3},
            success:function(data){
                if(data==1){
                    current.removeClass('confirm_but').addClass('comment_but').html('评价');
                    current.next('').remove();
                }
            }
        })
    })
    //取消订单
    $('.cancel_but').tap(function(){
        var oid=$(this).prev().prev().val();
        var current=$(this);
         $.ajax({
            url:base_url+'phone/Goods/setStatus',
            type: 'post',           
            data: {oid: oid,userid:1,ostatus:2},
            success:function(data){
                if(data==1){
//                    current.prev().remove();
//                    current.removeClass('cancel_but').html('已取消').off('tap');     
                      history.go(-1);
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
