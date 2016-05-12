<!--
上传头像<input type="file" name="pic" value="" />
<input type="submit" value="上传头像" name="sethead" /><br>-->

 <div class="content">
         <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div id="result" class="alert alert-danger" role="alert" >
                <?php if(isset($msg))  echo $msg;?>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h1>上传新头像<small></small></h1>
                </div>
            </div>
        </div>
     <div class="row">
         <div class="col-md-8 col-md-offset-2">
         <div>
        <input type="file" name="pic" id="pic" />
        <a href="javascript:$('#pic').uploadify('upload')">上传图片</a>
        </div>
        <div id="imgZone">
        <img id="ferret" src="" style="float:left;display:none" /> 
        </div>           
         </div>
         <div id="cropform" class="col-md-2 ">
             <?php echo form_open_multipart('seller/saccount/setHeadImg',array('onsubmit'=>"return checkCoords()")); ?>
            <input type="hidden"  id="x" name="desx" />
            <input type="hidden"  id="y" name="desy" />
            <input type="hidden" id="w" name="desw" />
            <input type="hidden"  id="h" name="desh" />
              <input type="hidden" name="crophead" value="1">
              <button type="submit" class="btn btn-info" id="croping">裁剪头像</button>
            </form>      
         </div>
    </div>
     <div id="myprogress"></div>
 </div>
