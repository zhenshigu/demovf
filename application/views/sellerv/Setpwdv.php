
<!--老密码<input type="password" name="oldPwd">
新密码<input type="password" name="newPwd">
确认密码<input type="password" name="passconf">
<input type="submit" name="setpwd" value="提交">-->
<div class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h1>修改账号密码<small></small></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-danger" role="alert">
                    <?php echo validation_errors();
                                if(isset($msg))    echo $msg;
                    ?>
                </div>
                    <?php echo form_open_multipart('seller/Saccount/setPwd');?>
                    <div class="form-group">
                        <label for="oldPwd">老密码</label>
                        <input type="password" class="form-control" id="oldPwd" name="oldPwd" placeholder="输入老密码">
                    </div>
                    <div class="form-group">
                        <label for="newPwd">新密码</label>
                        <input type="password" class="form-control" id="newPwd" name="newPwd" placeholder="输入新密码">
                    </div>
                    <div class="form-group">
                        <label for="passconf">新密码确认</label>
                        <input type="password" class="form-control" id="passconf" name="passconf" placeholder="再次输入新密码进行确认">
                    </div>
                    <button type="submit" class="btn btn-default">提交</button>
                </form>
            </div>
        </div>
    </div>