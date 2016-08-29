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
                <h1 class="title">商家详情</h1>
              </header>
             <!-- 这里是页面内容区 -->
             <div class="content">
                 <ul class="store_head">
                    <li >
                    <img class="thumb_head" src="<?php echo $res1['headimg'];?>">
                    </li>
                    <li >
                        <?php echo $res1['nickname'];?>
                    </li>
                    <li><?php echo '联系电话:'.$res1['cellphone'].'/ '.$res1['sphone'];?></li>
                    <li><?php echo $res1['board'];?></li>
                </ul>
                <ul class="store_tc" id="sttc">
                     <?php
                        if($res2){
                            foreach ($res2 as &$one){
                                $tcdetail=$base_url.'phone/Goods/hsdetail/'.$one['gid'].'/'.$one['sid'];
                                echo "<li><a external href=$tcdetail><img src={$one['thumbnail']}>";
                                echo '<span class="hs_title_price">'."{$one['gname']} {$one['gprice']}".'</span></a></li>';
                            }
                        }
                    ?>
                </ul>
             </div>
            </div>
        </div>
    
    <input type="hidden" id="_base_url" value="<?php echo $base_url; ?>">
    <input type="hidden" id="_sid" value="<?php echo $res1['sid']; ?>">
    <script type="text/javascript" src="<?php echo $base_url.'static/js/zepto.js'?>"></script>

<script type="text/javascript">
    var base_url=$('#_base_url').val();
    var sid=$('#_sid').val();
    $('#sttc').swipeUp(function(){
        var offset=$('#sttc li').length;
        $.ajax({
            url:base_url+'phone/Goods/ajaxHstcSid',
            type: 'post',           
            data: {sid: sid,offset:offset},
            success:function(data){
                var str='';
                $.each(data,function(index,item){
                    str+='<li><a href='+base_url+'phone/Goods/hsdetail/'+item['gid']+'/'+item['sid']+'><img src="'+item['thumbnail']+'"><span class="hs_title_price">'+item['gname']+ ' '+item['gprice']+'元'+'</span></a></li>'
                })
                $('#sttc').append(str);
            }
        })
    })
$('.pull-right').click(function(){
    history.go(0);
})
$('.pull-left').click(function(){
    history.go(-1);
})    
</script>
</body>
</html>
