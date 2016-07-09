<html>

<head>
    <title>index</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style type="text/css">
    .align_right {
        text-align: right;
    }
    
    .articleImg {
        width: 202px;
    }
    </style>

    <body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">视范</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="/">首页 <span class="sr-only">(current)</span></a></li>
        <li class="active"><a href="/pc/article">发现</a></li>
        <li><a href="/pc/article/aboutus">关于我们</a></li>
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-md-8">
                    <div class="row">
                        <div class="list-group ">
                            <?php if($res){
                                foreach($res as $one){
                                    
                                    ?>
                            
                                
                            
                            <a href="<?php echo $one['url']?>" class="list-group-item ">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <h4 class="list-group-item-heading"><?php echo $one['title'];?></h4>
                                        <p class="list-group-item-text"></p>
                                    </div>
                                    <div class="col-sm-5 align_right">
                                        <img src="<?php echo $one['headimg']?>" alt="..." class="img-rounded articleImg">
                                    </div>
                                </div>
                            </a>
                                <?php }
                            }?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="margin-bottom:12px">
                        <button type="button" class="btn btn-info col-sm-12" id="loadmore">点击加载更多</button>
                    </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                </div>
            </div>
        </div>
        <input type="hidden" id="_base_url" value="<?php echo $base_url;?>">
        <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
    var base_url = $('#_base_url').val();
    $('#loadmore').click(function(){
        var offset=$('.list-group a').length;
        $.ajax({
            url:base_url+'pc/article/ajaxIndex',
            type: 'post',           
            data: {offset:offset},
            success:function(data){
                var str='';
                $.each(data,function(index,item){
                    str+='<a class="list-group-item" href='+item['url']+'><div class="row"><div class="col-sm-7"><h4 class="list-group-item-heading">'+item['title']+'</h4><p class="list-group-item-text"></p></div><div class="col-sm-5 align_right"><img src='+item['headimg']+' alt="..." class="img-rounded articleImg"></div></div></a>'
                })
                $('.list-group').append(str);               
            },
            error:function(){
               
            }
        })
    })   
</script>
    </body>
</head>
