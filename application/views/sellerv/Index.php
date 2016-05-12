 <div class="content">
        <!--personal profile display area-->
        <div class="row">
            <div class="col-md-4 col-md-offset-1 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                       <h3 class="panel-title">商家资料</h3>
                    </div>
                    <div class="panel-body">
                        <div class='row'>
                            <img src="<?php echo $headimg; ?>" alt="头像加载失败,请设置头像" class="img-thumbnail col-md-5">
                            <ul class="list-group col-md-7">
                                <li class="list-group-item">账号:<?php echo $username;?></li>
                                <li class="list-group-item">昵称:<?php echo $nickname;?></li>
                                <li class="list-group-item">手机号码:<?php echo $cellphone;?></li>
                                <li class="list-group-item">座机号码:<?php echo $sphone;?></li>
                                <li class="list-group-item">地址:<?php echo $address;?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">新预约单刷新窗</h3>                      
                    </div>
                    <div class="panel-body" >
                        <div class="list-group" id="newOl">
                        暂时还没有新的预约单
                        </div>
                    </div>
                    <div class="panel-footer"> 
                        <a class="btn btn-info " href="<?php echo $base_url.'seller/Ordermanage/newOrdersList'?>" role="button">今天新预约单</a>
                        </div>                  
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">我的订单</h3>
                    </div>
                    <div class="panel-body">
                           <div class="list-group">
                                <?php 
                                if(!empty($res)){
                                foreach ($res as &$item){?>
                                <a href="#" class="list-group-item ">
                                    <h4 class="list-group-item-heading"><?php echo $item['oname'];?></h4>
                                    <p class="list-group-item-text">
                                        <span> <?php echo '预约单日期:'.date("Y-m-d H:i:s",$item['odate']); ?></span>
                                        <span><?php echo '价格:'.$item['oprice'];?></span>
                                        <span><?php echo '预约单状态:';
                                                                switch ($item['ostatus']){
                                                                    case 1:echo '进行中'; break;
                                                                    case 2:echo '已取消'; break;
                                                                    case 3:echo '已完成'; break;
                                                                    default :未知;
                                                                }
                                 ?></span>
                                    </p>
                                </a><?php }}?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<input type="hidden" value="<?php echo $base_url; ?>" id="_base_url">
    <script type="text/javascript">
                  var dataa;
                  var base_url=$('#_base_url').val();
    	var intevalId=setInterval(getNewOrders,5000);           
                  //定时查询是否有新的预约单
    	function getNewOrders(){            
    	        $.ajax({
                            url: base_url+'seller/Ordermanage/hasNewOrder',
                            type: 'post',
                            dataType: 'json',
                            data: {},
                            success:function(data){
                                if(data.hasnew>0){
                                    var ordernew=data.ordernew;
                                    var str='';
                                    for(var i=0;i<ordernew.length;i++){
                                        str+='<a href="#" class="list-group-item "><h4 class="list-group-item-heading">';
                                        str+=ordernew[i].oname;
                                        str+='</h4><p class="list-group-item-text"><span>预约单日期:';
                                        str+=ordernew[i].odate;
                                        str+='</span><span>价格:';
                                        str+=ordernew[i].oprice;
                                        str+='</span></p></a>'                                       
                                    }
                                    $('#newOl').html(str);
                                }
                            }
                        })
    	}
    </script>