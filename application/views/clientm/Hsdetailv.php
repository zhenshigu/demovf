<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">   
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/apm.css';?>">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    
</head>

<body>
    <div class="page-group">
        <div class="page page-current">
         <header class="bar bar-nav">
             <a id="icon-left" class="icon icon-left pull-left"></a>
            <a class="icon icon-refresh pull-right"></a>
            <h1 class="title">套餐详情</h1>
          </header>

         <!-- 这里是页面内容区 -->
            <div class="content">
                <ul class="nav_guidance">
        <li><?php echo $gname;?></li>
        <li>价格:<?php echo $gprice;?>元</li>
        <li style="height: 4rem">描述:<?php echo $gdescription?></li>
        <?php if(!$ordered){?>
        <li id="yuyue"><a href="#" class="button button-big button-round">预约</a></li>
        <?php }else{?>
        <li id="qxyuyue"><a href="#" class="button button-big button-round button-danger">取消预约</a></li>
        <?php }?>
    </ul>
                <div style="position: relative;top: 10.3rem">
    <div class="buttons-tab">
    <a href="#tab1" class="tab-link active button">美图</a>
    <a id="toTab2" href="#tab2" class="tab-link button">参数</a>
    <a id="toTab3" href="#tab3" class="tab-link button">评论</a>
  </div>

    <div class="tabs">
      <div id="tab1" class="tab active">
          <ul class="nav_c">
            <?php 
                if($gimg){
                    foreach ($gimg as $one){
                        echo "<li><img src=$one></li>";
                    }
                }  else {
                    echo '<li>无图无真相</li>';
                }             
            ?>
        </ul>
      </div>
      <div id="tab2" class="tab">

          <ul class="nav_content">
            <li><?php echo $gname;?></li>
            <li><?php echo $gprice;?>元</li>
            <li class="hs_param"><?php echo $gcontent;?></li>
        </ul>

      </div>
      <div id="tab3" class="tab">

          <ul class="nav_comment">
        </ul>

      </div>
    </div>
                </div>
    <input type="hidden" id="_gid" value="<?php echo $gid;?>">
    <input type="hidden" id="_base_url" value="<?php echo $base_url; ?>">
    <input type="hidden" id="order_id" value="<?php echo $ordered;?>">
            </div>
       
        </div>
            <script type="text/javascript" src="http://static.viewfuns.com/static/js/zepto.js"></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
    </div>
    

    <script>$.init()</script>
<script type="text/javascript">
//提交订单
var gid = $('#_gid').val();
var base_url = $('#_base_url').val();
var oid=$('#order_id').val();
$('#yuyue').click(function() {
    $.ajax({
        url: base_url + 'phone/Goods/addOrder',
        type: 'post',
        data: {
            gid: gid
        },
        success: function(data) {
            if(data==1||data=="1"){
                $.toast('预约成功');
                history.go(0);
            }else if(data==-1){
                $.toast('请先登录');
            }
//            $.toast('预约成功');
        }
    })
})
$('#qxyuyue').click(function() {
    $.ajax({
        url: base_url + 'phone/Goods/setStatus',
        type: 'post',
        data: {
            oid: oid,
            ostatus:2
        },
        success: function(data) {
            if(data==1||data=="1"){
                $.toast('取消预约成功');
                history.go(0);
            }else if(data==-1){
                $.toast('请先登录');
            }
        }
    })
})
$('.pull-right').click(function(){
    history.go(0);
})
$('.pull-left').click(function(){
    history.go(-1);
})
$('#toTab3').click(function(){
    $.ajax({
        url: base_url + 'phone/Goods/hsComment',
        type: 'post',
        data: {
            gid: gid
        },
        success: function(data) {
            if(data){
                var str='';
                $.each(data,function(index,item){                   
                    str+='<li><span style="width: 67%"><img src='+item['headimg']+' width="30px" height="30px">';
                    str+=item['username']+' </span><span style="text-align: right;width: 33%">'+item['odate']+'</span>';
                    str+='<p>'+item['criticism']+'</p></li>';                   
                })
                $('.nav_comment').html(str);
            }
        }
    })
})
$(function(){
    var hs_param=$("li[class='hs_param']");
    hs_param.html(hs_param.text().replace(/\n/g,'<br/>'));   
})
</script>
</body>
</html>

