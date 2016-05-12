
<div class="content">

        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="page-header">
                    <h1>查看商家资料<small></small></h1>
                </div>
            </div>
                    <div class="col-md-2">
                        <div class="row">
                            <button id='editprofile' type="button" class="btn btn-info">编辑资料</button>
                            <a class="btn btn-info" href=<?php echo $base_url."seller/Saccount/setPwd"?> role="button">修改密码</a>
                        </div>
        
        </div>
        </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div id="result" class="alert alert-danger" role="alert" style="display:none"></div>
        </div>
    </div>
       <div class="row">
           <div class="col-md-2 col-md-offset-5">
            <a href=<?php echo $base_url.'seller/saccount/setHeadImg';?>  class=“thumbnail”>
              <img src="<?php echo $headimg;?>" alt="头像加载出错">
          </a>
             <div class="caption">
                 <p>点击图片修改头像</p>
            </div>
        </div>
      </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="nickname" class="col-sm-2 control-label">昵称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nickname" placeholder="nickname" name="nickname" disabled value=<?php 
                            if(isset($nickname)) echo $nickname;?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cellphone" class="col-sm-2 control-label">商家手机号码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cellphone" placeholder="cellphone" name="cellphone" disabled
                                   value=<?php if (isset($cellphone))  echo $cellphone;?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sphone" class="col-sm-2 control-label">商家座机号码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sphone" placeholder="sphone" name="sphone" disabled
                                   value="<?php if (isset($sphone)) echo $sphone;?>">
                        </div>
                    </div>
                    <div id="my-addr" class="form-group">
                        <label for="myaddress" class="col-sm-2 control-label">商家地址</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="myaddress"  disabled
                                   value=<?php @$myaddress=$province.$city.$district.$address;
                                    echo $myaddress; ?>>
                        </div>
                    </div>
                    <div class="form-group edit-e">
                        <label for="seachprov" class="col-sm-2 control-label">所在省</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="seachprov" name="seachprov" onChange="changeComplexProvince(this.value, sub_array, 'seachcity', 'seachdistrict');" disabled></select>
                        </div>
                    </div>
                    <div class="form-group edit-e">
                        <label for="seachcity" class="col-sm-2 control-label">所在市</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="seachcity" name="homecity" onChange="changeCity(this.value,'seachdistrict','seachdistrict');" disabled></select>
                        </div>
                    </div>
                    <div class="form-group edit-e">
                        <label for="seachdistrict" class="col-sm-2 control-label">所在区/县</label>
                        <div class="col-sm-10">
                            <span id="seachdistrict_div"><select  class="form-control" id="seachdistrict" name="seachdistrict" disabled></select></span>
                        </div>
                    </div>
                    <div class="form-group edit-e">
                        <label for="address" class="col-sm-2 control-label">详细地址</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address" name="address" placeholder="address" disabled
                                   value="<?php if (isset($address)) echo $address;?>">
                        </div>
                    </div>
            <div class="form-group edit-e">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button id="setprofile" type="button"  class="btn btn-default" disabled>提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $('#setprofile').click(function(){
        var nickname=$('#nickname').val();
        var cellphone=$('#cellphone').val();
        var sphone=$('#sphone').val();
        var province=$('#seachprov').find("option:selected").text();
        var city=$('#seachcity').find("option:selected").text();
        var district=$('#seachdistrict').find("option:selected").text();

        var address=$('#address').val();
        var setprofile=1;
        var base_url="<?php echo $base_url?>";
        $.ajax({
            url:base_url+'seller/saccount/setprofile',
            type: 'post',
            
            data: {nickname: nickname,cellphone:cellphone,sphone:sphone,province:province,
                        city:city,district:district,address:address,setprofile:setprofile},
            success:function(data){
                if(data==1){
                    $('#result').html('商家资料设置成功').show();
                    $('#nickname').attr('disabled','disabled');
                    $('#cellphone').attr('disabled','disabled');
                    $('#sphone').attr('disabled','disabled');
                    $('#seachprov').attr('disabled','disabled');
                    $('#seachcity').attr('disabled','disabled');
                    $('#seachdistrict').attr('disabled','disabled');
                    $('#address').attr('disabled','disabled');
                    $('#setprofile').attr('disabled','disabled');
                }else if(data==0){
                    $('#result').html('商家资料设置失败').show();
                }else if(data==10018){
                    $('#result').html('资料填写不完整,请重新填写').show();
                }                   
            }
        })
    })
        $('#editprofile').click(function(){
        $('.edit-e').show();
        $('#my-addr').hide();
        $('#my')
        $('#nickname').removeAttr('disabled');
        $('#cellphone').removeAttr('disabled');
        $('#sphone').removeAttr('disabled');
        $('#seachprov').removeAttr('disabled');
        $('#seachcity').removeAttr('disabled');
        $('#seachdistrict').removeAttr('disabled');
        $('#address').removeAttr('disabled');
        $('#setprofile').removeAttr('disabled');
    })
    </script>