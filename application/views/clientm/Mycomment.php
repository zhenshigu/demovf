<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'static/css/apm.css';?>">
   
</head>

<body>
    <ul class="myorder_head">
        <li style="text-align: center;">评价</li>
    </ul>
    <div class="comment_div">
        <textarea id="comment"></textarea>
        <div><span class="orange_button" id="submit_but">提交</span></div>
    </div>
    <input type="hidden" id="_base_url" value="<?php echo $base_url; ?>">
     <script type="text/javascript" src="<?php echo $base_url.'static/js/zepto.js'?>"></script>

<script type="text/javascript">
    var base_url=$('#_base_url').val();
    $('#submit_but').tap(function(){
        var theComment=$('#comment').val();
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
</script>
</body>
</html>
