  <div class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="list-group">
                    <?php 
                          foreach ($res as &$tc){
                     ?>
                    <a href="<?php echo $base_url.'seller/goodsmanage/tcdetail/'.$tc['gid'] ?>" class="list-group-item ">                  
                        <div class='row'>
                            <div class='col-md-2'>
                                <img src="<?php echo $tc['thumbnail']?>" alt="图片不存在" class="img-thumbnail">
                            </div>
                            <div class="col-md-8">
                                <h4 class="list-group-item-heading"><?php echo $tc['gname'];?></h4>
                                <p class="list-group-item-text"><?php echo $tc['gdescription'];?></p>
                            </div>
                        </div>
                    </a>
                   <?php }?>
                </div>
            </div>
        </div>
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
                <?php  echo $nevigation; ?>
          </div>
      </div>
    </div>