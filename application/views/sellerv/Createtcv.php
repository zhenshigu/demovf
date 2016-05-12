<div class="content">
         <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="page-header">
                    <h1>新建婚纱套餐<small></small></h1>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div id="result" class="alert alert-danger" role="alert" >
                <?php echo validation_errors(); 
                if(isset($msg)){
                    echo $msg;
                }
?>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <?php echo form_open_multipart('seller/Goodsmanage/createNewtc',array('onsubmit'=>"return checkPic()")); ?>
                    <div class="form-group">
                        <label for="name">婚纱套餐名称 </label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>" placeholder="在这里输入婚纱套餐的名称">
                    </div>
                    <div class="form-group">
                        <label for="price">婚纱套餐价格(元)</label>
                        <input type="text" class="form-control" id="price" name="price" value="<?php echo set_value('price'); ?>" placeholder="在这里输入婚纱套餐的价格,必须为数字">
                    </div>
                    <div class="form-group">
                        <label for="description">婚纱套餐简短描述</label>
                        <input type="text" class="form-control" id="description" name="description" value="<?php echo set_value('description'); ?>" placeholder="在这里输入婚纱套餐的简短描述,用一两句话">
                    </div>
                    <div class="form-group">
                        <label for="content">婚纱套餐包含的东西(注意:按enter回车键进行换行)</label>
                        <textarea class="form-control" rows="13"  wrap="physical" id="content" name="content" value="<?php echo set_value('content'); ?>" placeholder="在这里输入套餐包含的内容"></textarea>
                    </div>
                    <div class="well well-lg">
                        <div id='upload_err' class="alert alert-danger" role="alert" ></div>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                    <div class="row">
                        <div id="upload_area" class="col-md-10">
                         <div class="form-group">
                        <label for="pic">婚纱套餐图片上传</label>
                        <input type="file"  class="pic" name="pic[]">
                        <p class="help-block">点击选择文件上传按钮,查找本机婚纱图片进行上传.图片应该满足一定的宽高比,图片格式要求是JPG格式</p>
                            </div>
                            
                        </div>
                       <div class="col-md-2">
                           <button class="btn btn-danger" type="button" id="addPic">增加图片</button>
                           
                        </div>
                    </div>
                    </div>                  
                    <button type="submit" class="btn btn-info col-md-offset-5" >创建婚纱套餐</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#addPic').click(function(event) {
            var str='<div class="form-group">'+
                        '<label for="pic">婚纱套餐图片上传</label>'+
                        '<input type="file" class="pic" name="pic[]">'+
                        '<p class="help-block">点击选择文件上传按钮,查找本机婚纱图片进行上传.图片应该满足一定的宽高比,图片格式要求是JPG格式</p></div>';
            $('#upload_area').append(str);
        });
        function checkPic(){
            var result=true;
            $('.pic').each(function(){
                if($(this).val()==''){
                    $('#upload_err').html('文件上传不能只上传一部分,所有上传框都必须填满');
                    result=false;
                    return false;
                }              
            })
            return result;
        }
    </script>
</body>
</html>