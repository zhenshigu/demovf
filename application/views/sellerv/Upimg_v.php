<div class="content">
         <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="page-header">
                    <h1>上传新图片<small></small></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <?php echo form_open_multipart('seller/Goodsmanage/upimg/'.$gid,array('onsubmit'=>"return checkPic()")); ?>
                   
                    <div class="well well-lg">
                        <div id='upload_err' class="alert alert-danger" role="alert" ><?php if(isset($msg)){
                                switch ($msg){
                                    case 10019:echo '图片上传成功';
                                                     break;
                                    case 10020:echo '图片上传失败';
                                                                  break;
                                    case 10018:echo '参数不能为空';
                                                     break;
                                }
                        }?></div>
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
                <input type="hidden" name="editBut" value="1">
                    <button type="submit" class="btn btn-info col-md-offset-5" >上传新图片</button>
                    <a class="btn btn-default" href="<?php echo $base_url.'seller/goodsmanage/tcdetail/'.$gid?>" role="button">返回套餐</a>
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