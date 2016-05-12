<div class="container">
            <div class="row">
            <div class="col-md-12">
             <?php if(isset($msg)){
                    if($msg=='10013'){ ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>警告</strong> 账号或者密码错误,请重新输入
          </div>
             <?php       }
            } ?>
            </div>
            </div>
        <div class="row">
            <div class="col-md-8">
                <div class="jumbotron">
                    <h1>摄影套餐管理系统</h1>
                    <p>欢迎使用摄影套餐管理系统</p>
                    <p><a class="btn btn-info btn-lg" href="#" role="button">了解更多...</a></p>
                </div>
            </div>
            <div class="col-md-4 col-sm-3 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">登录区</h3>
                    </div>
                    <div class="panel-body">
                    <?php echo validation_errors(); ?>
                    <?php echo form_open('seller/Saccount/login',array('class'=>"form-horizontal")); ?>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> 记住我
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-info">登录</button>
                                    <a class="btn btn-info col-md-offset-1" href="<?php echo $base_url."seller/Saccount/register" ?>" role="button">注册</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="well">陈登世开发</div>
    </div>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

