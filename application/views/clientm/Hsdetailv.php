<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/apm.css';?>">
    
</head>

<body>
    <div class="page-group">
        <div class="page page-current">
         <header class="bar bar-nav">
            <a class="icon icon-left pull-left"></a>
            <a class="icon icon-refresh pull-right"></a>
          </header>

         <!-- 这里是页面内容区 -->
            <div class="content">
                <ul class="nav_guidance">
        <li><?php echo $gname;?></li>
        <li>价格:<?php echo $gprice;?>元</li>
        <li>描述:<?php echo $gdescription?></li>
        <li id="yuyue">预约</li>
    </ul>
    <ul class="s-time">
        <li><span class="act" data-tag="0">美图</span></li>
        <li><span data-tag="1">参数</span></li>
        <li><span data-tag="2">评论</span></li>
    </ul>
    <div id='img_area'>
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
    <div id="hs_params">
        <ul class="nav_content">
            <li><?php echo $gname;?></li>
            <li><?php echo $gprice;?>元</li>
            <li>
                 <?php echo $gcontent;?></li>
        </ul>
    </div>
    <div id="hs_comment">
        <ul class="nav_comment">
            <li>
                <span style="width: 67%"><img src="../img/20160319005129_763.jpg" width="30px" height="30px">我是用户</span><span style="text-align: right;width: 33%">2016-11-11</span>
                <p>
                    朋友推荐到这里的，当时感觉价格略高，然后纠结了很久，但是交了定金之后就会发现真的是一文价钱一文货，交了定金之后就会来电话和短信核实身份，并且告知一些注意事项，然后下了飞机之后会有师傅接机，住宿一晚酒店也是超级豪华，拍照一对一的服务，化妆师安琪，摄影师孔Sir，灯光师张裕，礼服师娇娇，微电影导演陈导，全程服务态度都特别好，非常尽心，拍照效果也是十分满意，完美！
                </p>
            </li>
            <li>
                <span style="width: 67%"><img src="../img/20160319005129_763.jpg" width="30px" height="30px">我是用户</span><span style="text-align: right;width: 33%">2016-11-11</span>
                <p>
                    朋友推荐到这里的，当时感觉价格略高，然后纠结了很久，但是交了定金之后就会发现真的是一文价钱一文货，交了定金之后就会来电话和短信核实身份，并且告知一些注意事项，然后下了飞机之后会有师傅接机，住宿一晚酒店也是超级豪华，拍照一对一的服务，化妆师安琪，摄影师孔Sir，灯光师张裕，礼服师娇娇，微电影导演陈导，全程服务态度都特别好，非常尽心，拍照效果也是十分满意，完美！
                </p>
            </li>
            <li>
                <span style="width: 67%"><img src="../img/20160319005129_763.jpg" width="30px" height="30px">我是用户</span><span style="text-align: right;width: 33%">2016-11-11</span>
                <p>
                    朋友推荐到这里的，当时感觉价格略高，然后纠结了很久，但是交了定金之后就会发现真的是一文价钱一文货，交了定金之后就会来电话和短信核实身份，并且告知一些注意事项，然后下了飞机之后会有师傅接机，住宿一晚酒店也是超级豪华，拍照一对一的服务，化妆师安琪，摄影师孔Sir，灯光师张裕，礼服师娇娇，微电影导演陈导，全程服务态度都特别好，非常尽心，拍照效果也是十分满意，完美！
                </p>
            </li>
            <li>
                <span style="width: 67%"><img src="../img/20160319005129_763.jpg" width="30px" height="30px">我是用户</span><span style="text-align: right;width: 33%">2016-11-11</span>
                <p>
                    朋友推荐到这里的，当时感觉价格略高，然后纠结了很久，但是交了定金之后就会发现真的是一文价钱一文货，交了定金之后就会来电话和短信核实身份，并且告知一些注意事项，然后下了飞机之后会有师傅接机，住宿一晚酒店也是超级豪华，拍照一对一的服务，化妆师安琪，摄影师孔Sir，灯光师张裕，礼服师娇娇，微电影导演陈导，全程服务态度都特别好，非常尽心，拍照效果也是十分满意，完美！
                </p>
            </li>
            <li>
                <span style="width: 67%"><img src="../img/20160319005129_763.jpg" width="30px" height="30px">我是用户</span><span style="text-align: right;width: 33%">2016-11-11</span>
                <p>
                    朋友推荐到这里的，当时感觉价格略高，然后纠结了很久，但是交了定金之后就会发现真的是一文价钱一文货，交了定金之后就会来电话和短信核实身份，并且告知一些注意事项，然后下了飞机之后会有师傅接机，住宿一晚酒店也是超级豪华，拍照一对一的服务，化妆师安琪，摄影师孔Sir，灯光师张裕，礼服师娇娇，微电影导演陈导，全程服务态度都特别好，非常尽心，拍照效果也是十分满意，完美！
                </p>
            </li>
        </ul>
    </div>
    <input type="hidden" id="_gid" value="<?php echo $gid;?>">
    <input type="hidden" id="_base_url" value="<?php echo $base_url; ?>">
    
            </div>
       
        </div>
            <script type="text/javascript" src="http://static.viewfuns.com/static/js/zepto.js"></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
    </div>
    

    <script>$.init()</script>
<script type="text/javascript">
 //标签切换函数
$('.s-time li').tap(function() {
    $('.s-time li span').removeClass("act");
    $(this).children().addClass("act");
    var _tag = $(this).children().data("tag");
    current = _tag;
    switch (_tag) {
        case 0:
            $('#img_area').show();
            $('#hs_params').hide();
            $('#hs_comment').hide();
            break;
        case 1:
            $('#img_area').hide();
            $('#hs_comment').hide();
            $('#hs_params').show();
            break;
        case 2:
            $('#img_area').hide();
            $('#hs_params').hide();
            $('#hs_comment').show();
            break;
    }
})
//提交订单
var gid = $('#_gid').val();
var base_url = $('#_base_url').val();
$('#yuyue').tap(function() {
    $.ajax({
        url: base_url + 'phone/Goods/addOrder',
        type: 'post',
        data: {
            gid: gid
        },
        success: function(data) {
            if(data==1||data=="1"){
                $.toast('预约成功');
            }else if(data==-1){
                $.toast('请先登录');
            }
//            $.toast('预约成功');
        }
    })
})

$('#love').tap(function(){
    $.toast('预约成功');
//    alert(demo.getSign());
});
</script>
</body>
</html>

