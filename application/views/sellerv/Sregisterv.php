
         <div class="container">
             <div class="row">
                 <div class="page-header">
                        <h1>商家注册<small> 说明:先利用邮箱进行注册,系统自动发激活邮件到注册邮箱,去邮箱进行账号激活</small></h1>
                    </div>
             </div>
             <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <?php echo validation_errors(); ?>
            <?php echo form_open('seller/Saccount/register',array('class'=>"form-horizontal")); ?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="在这里输入邮箱作为您的账号">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="在这里输入密码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">确认密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3" name="passconf" placeholder="在这里输入密码进行确认">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">注册</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
             
    </body>
</html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

