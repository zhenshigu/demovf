<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/apm.css';?>">
    <script type="text/javascript" src="<?php echo $base_url.'static/js/zepto.js'?>"></script>
</head>

<body>
    <ul class="myorder_head">
        <li style="text-align: center;">我的订单</li>
    </ul>
    <ul class="myorder_list">
        <?php 
            if($res){
                foreach ($res as $one){                   
                    ?>
                <li>
                    <p class="myorder_white"><a href="<?php echo $base_url.'phone/Goods/storedetail/'.$one['sid']; ?>"> <?php echo $one['nickname'];?></a></p>
                    <a href="<?php echo $base_url.'phone/Goods/hsdetail/'.$one['gid'].'/'.$one['sid']; ?>">
                    <div>
                    <div class="myorder_d1">
                        <img src="<?php echo $one['thumbnail'];?>" >
                    </div>
                    <div class="myorder_d2">
                        
                        <span><?php echo $one['oname'];?></span><span style="float: right;"><?php echo $one['oprice'];?></span>
                        <p><?php echo $one['odescription'];?></p>
                        
                    </div>
                    </div>
                    </a>
                    <div class="myorder_clearboth">
                        <div class="buts_right">
                            <input type="hidden" value="<?php echo $one['oid'];?>">
                         <?php if($one['ostatus']==1){ ?>
                        <span class="orange_button confirm_but">确认收货</span>
                        <span class="orange_button cancel_but">取消订单</span>                            
                         <?php }elseif ($one['ostatus']==3) {?>
                                    <span class="orange_button comment_but">评价</span>
                            <?php }elseif ($one['ostatus']==2) {?>
                                    <span class="orange_button">已取消</span>                                                
                                <?php  }
                                 ?>
                        
                    </div>
                    </div>
                </li>
        <?php
                }
            }
        ?>

    </ul>
    <input type="hidden" id="_base_url" value="<?php echo $base_url; ?>">
</body>
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
                    current.prev().remove();
                    current.removeClass('cancel_but').html('已取消').off('tap');                   
                }
            }
        })
      
    })
</script>

</html>
