<html>

<head>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">     
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
</head>

<body>
    <div class="page-group">
        <div class="page page-current">
            
            <div class="content">
                <div class="list-block">
                    <ul>
                        <li>
                            <div class="item-content">
                              <div class="item-media"><i class="icon icon-form-email"></i></div>
                              <div class="item-inner">
                                <div class="item-title label">邮箱</div>
                                <div class="item-input">
                                    <input id="theEmail" type="email" placeholder="方便我们联系您(可选)">
                                </div>
                              </div>
                            </div>
                        </li>
                        <li class="align-top">
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-comment"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">我的反馈</div>
                                    <div class="item-input">
                                        <textarea id="theResponse"></textarea>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="content-block">
                    <div class="row">
                        <div class="col-50"><a href="#" id="toCancel" class="button button-big button-fill button-danger">取消</a></div>
                        <div class="col-50"><a href="#" id="toSubmit" class="button button-big button-fill button-success">提交</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="_base_url" value="<?php echo $base_url; ?>">
    <?php echo $commonJs;?>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type="text/javascript">
        var base_url=$('#_base_url').val();
        $('#toSubmit').tap(function(){
            var theResponse=$('#theResponse').val();
            var theEmail=$('#theEmail').val();
            $.ajax({
                url: base_url + 'phone/Account/setResponse',
                type: 'post',
                data: {
                    sign_time_id:demo.getSign(),
                    theResponse:theResponse,
                    theEmail:theEmail
                },
                success: function(data) {
                    switch(data.code){
                        case 10006:
                            demo.showToast('邮箱格式错误');
                            break;
                        case 10025:
                            demo.showToast('你还没登录，不能提交反馈');
                            demo.ToLogin();
                            break;
                        case 0:
                            demo.showToast('提交反馈失败');
                            break;
                        case 10018:
                            demo.showToast('反馈信息不能为空');
                            break;
                        case 1:
                            demo.showToast('提交反馈成功');
                            history.go(-1);
                            break;
                    }
                },
                error:function(){
                   demo.showToast('网络错误');
                }
            })
        })
      $('#toCancel').tap(function(){
          history.go(-1);
      })
        
        
    </script>
</body>

</html>