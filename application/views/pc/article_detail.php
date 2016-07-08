<!DOCTYPE html>
<html>
<head>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<style type="text/css">
    #iframepage{width: 100%}
</style>


</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-8 col-sm-offset-2">
                <iframe src="<?php echo $article;?>" id="iframepage" 
        frameborder="0" scrolling="no" marginheight="0" marginwidth="0" onLoad="iFrameHeight()"></iframe>
            </div>
            
        </div>
    </div>
<script type="text/javascript" language="javascript">
function iFrameHeight() {
var ifm= document.getElementById("iframepage");
var subWeb = document.frames ? document.frames["iframepage"].document : ifm.contentDocument;
if(ifm != null && subWeb != null) {
    ifm.height = subWeb.body.scrollHeight;
    ifm.width = subWeb.body.scrollWidth;
}
}
</script>
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>