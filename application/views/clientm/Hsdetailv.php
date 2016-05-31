<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/apm.css';?>">
    
</head>

<body>
    <ul class="nav_guidance">
        <li style="text-align: center;"><?php echo $gname;?></li>
        <li>价格:<?php echo $gprice;?>元</li>
        <li>描述:<?php echo $gdescription?></li>
        <li><span id="love">收藏</span ><span id='yuyue'>预约</span></li>
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
    <script type="text/javascript" src="<?php echo $base_url.'static/js/zepto.js'?>"></script>

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
    var userid=demo.getUserid();
    var signString=demo.getSign();
    $.ajax({
        url: base_url + 'phone/Goods/addOrder/'+signString,
        type: 'post',
        data: {
            userid:userid,
            gid: gid
        },
        success: function(data) {
            if(data==1||data=="1"){
                demo.showToast('预约成功');
            }else if(data==-1){
                demo.ToLogin();
            }
//            demo.showToast('预约成功');
        }
    })
})
$('#love').tap(function(){
    demo.showToast('预约成功');
//    alert(demo.getSign());
})
</script>
</body>
</html>

