 <div class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h1>婚纱订单查看<small></small></h1>
                </div>
            </div>
        </div>
   <div class="row">
   <div class="col-md-8 col-md-offset-2">
       <ul class="nav nav-tabs" style="margin-bottom: 25px">
        <li role="presentation" class=""><a href=<?php echo $base_url."seller/Ordermanage/newOrdersList"?>>新订单</a></li>
        <li role="presentation" class="active"><a href=<?php echo $base_url."seller/Ordermanage/ordersList"?>>所有订单</a></li>
    </ul>
     </div>
   </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open_multipart('seller/Ordermanage/ordersList',array('class'=>"form-inline")); ?>
                            <div class="form-group ">
                                <label for="ostatus" class=" control-label">预约单状态</label>
                                <select class="form-control " id="ostatus" name="ostatus">
                                    <option value="0" >全部</option>
                                    <option value="1">已预约</option>
                                    <option value="2">已取消</option>
                                    <option value="3">已完成</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info">查找</button>
                        </form>
                    </div>
                    <div class="panel-footer"><?php echo '预约单数量:'.$total;?></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
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
             <div class="row">
                 <div class="col-md-6 col-md-offset-3">     
                     <?php  echo $nevigation;?>
                 </div>                   
             </div>

    </div>
<input type="hidden" value="<?php echo $base_url; ?>" id="_base_url">
<input type="hidden" value="<?php echo @$ostatus?$ostatus:0; ?>" id="_ostatus">
<script type="text/javascript">
var base_url=$('#_base_url').val();
var ostatus=$('#_ostatus').val();
switch (ostatus){
    case '1':
    case 1:$('#ostatus option:eq(1)').attr('selected', true);break;
    case '2':
    case 2:$('#ostatus option:eq(2)').attr('selected', true);break;
    case '3':
    case 3:$('#ostatus option:eq(3)').attr('selected', true);break;    
}
</script>
