    <div class="content">
         <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h1>查看婚纱套餐内容<small></small></h1>
                </div>
            </div>
            <div class="col-md-2">
                        <div class="row">
                           <div>
                            <button id='editTc' type="button" class="btn btn-default">编辑套餐</button>
                           </div>
                            <div>
                                <a class="btn btn-default" href="<?php echo $base_url.'seller/goodsmanage/upimg/'.$gid?>" role="button">上传图片</a>
                            </div>
                            <div>
                                <a class="btn btn-default" href="<?php echo $base_url.'seller/goodsmanage/showAlltc'?>"  role="button">套餐列表</a>
                            </div>
                        </div>       
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                 <div id="slides">
                     <?php 
                        if(!empty($gimg)){
                            foreach ($gimg as $imgUrl){ 
                                    echo "<img src='$imgUrl'>";
                            }
                        }
                    ?>      
                     <button class="btn btn-default slidesjs-previous slidesjs-navigation" type="button">上一张</button>
                     <button class="btn btn-default col-md-offset-10 slidesjs-next slidesjs-navigation" type="button">下一张</button>
                     
                  </div>
                
            </div>
        </div>
                <div class="row edit-e">
                <div class=" list-group col-md-8 col-md-offset-2">
                <?php
                    if(!empty($gimg)){
                        foreach ($gimg as $imgUrl){ ?>
                                   <div class="row">
                                    <div class=" col-md-8 ">                               
                                 <?php   echo "<img src='$imgUrl' class='list-group-item img-thumbnail'>";?>
                                   </div>
                                       <div>
                                           <input type="hidden" value="<?php echo $imgUrl;?>">
                                           <button  type="button" class="btn btn-danger delimg">删除</button></div>
                                    </div>
                        <?php   }}      ?>
                      
                </div>
        </div>
        <p></p>
         <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="result" class="alert alert-danger" role="alert" style="display:none"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <form>
                    <div class="form-group">
                        <label for="name">婚纱套餐名称 </label>
                        <input type="text" class="form-control" id="name"  value="<?php echo $gname;?>" placeholder="name" disabled>
                    </div>
                    <div class="form-group">
                        <label for="price">婚纱套餐价格</label>
                        <input type="text" class="form-control" id="price" value="<?php echo $gprice; ?>" placeholder="price" disabled>
                    </div>
                    <div class="form-group">
                        <label for="description">婚纱套餐描述</label>
                        <input type="text" class="form-control" id="description" value="<?php echo $gdescription;?>" placeholder="description" disabled>
                    </div>
                    <div class="form-group">
                        <label for="content">婚纱套餐内容</label>
                        <textarea class="form-control" rows="13" id="content" name="content" disabled><?php echo $gcontent;?></textarea>
                    </div>
                    <button type="button" class="btn btn-info" id="editBut" style="display: none">提交</button>
                </form>
            </div>
        </div>

    </div>
<input type="hidden" id="_gid" value="<?php echo $gid; ?>">
<input type="hidden" id="_base_url" value="<?php echo $base_url?>">
<script src=<?php echo $base_url."static/js/jquery.slides.min.js"?>></script>
 <script>
    $(function(){
      $("#slides").slidesjs({
          navigation:false,
          pagination: {
            active: false
          }
      });
    });
    //提交修改套餐文字内容
    $('#editBut').click(function(){

            var gid=$('#_gid').val();
             var base_url=$('#_base_url').val();
            var name=$('#name').val();
            var price=$('#price').val();
            var description=$('#description').val();
            var content=$('#content').val();
            var editBut=1;
              $.ajax({
                    url:base_url+'seller/goodsmanage/tcdetail/'+gid,
                    type: 'post',

                    data: {name: name,price:price,description:description,content:content,editBut:editBut},
                    success:function(data){
                        if(data==10019){                          
                                location.reload();
                                $('#result').html('套餐资料更新成功').show();
//                            $('.edit-e').hide();
//                            $('#editBut').hide();
//                            $('#name').attr('disabled','disabled');
//                            $('#price').attr('disabled','disabled');
//                            $('#description').attr('disabled','disabled');
//                            $('#content').attr('disabled','disabled');
                        }else if(data==10020){
                            $('#result').html('套餐资料更新失败').show();
                        }else if(data==10018){
                            $('#result').html('资料填写不完整,请重新填写').show();
                        }                   
                    }
                })
    })
    //编辑套餐
   $('#editTc').click(function(){
       $('#slides').hide();
       $('.edit-e').show();
       $('#editBut').show();
       $('#name').removeAttr('disabled');
        $('#price').removeAttr('disabled');
        $('#description').removeAttr('disabled');
        $('#content').removeAttr('disabled');
   })
   $('.delimg').click(function(){
       var gid=$('#_gid').val();
       var base_url=$('#_base_url').val();
       var imgUrl=$(this).prev().val();
       var curNode=$(this);
       $.ajax({
                    url:base_url+'seller/goodsmanage/deltcImg',
                    type: 'post',
                    data: {gid: gid,imgUrl:imgUrl},
                    success:function(data){
                        if(data==10021){
                            $('#result').html('图片删除成功').show();
                            curNode.parent().parent().remove();
                        }else if(data==10022){
                            $('#result').html('图片删除失败').show();
                        }else if(data==10018){
                            $('#result').html('缺少参数').show();
                        }else if(data=10023){
                            $('#result').html('数据库错误').show();
                        }
                    }
                })
   })
  </script>
