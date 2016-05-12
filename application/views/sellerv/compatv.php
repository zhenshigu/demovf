
<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
<title>ie8</title>
    <link rel="stylesheet" type="text/css" href=<?php echo "http://192.168.31.181:8011/static/css/bootstrap.min.css"?>>

    <script src="http://cdn.bootcss.com/jquery/1.12.1/jquery.min.js"></script>
    <script type="text/javascript" src=<?php echo "http://192.168.31.181:8011/static/js/bootstrap.min.js"?>></script>
<!--[if lte IE 9]>
<script src="http://192.168.31.181:8011/static/js/respond.js"></script>
<script src="http://192.168.31.181:8011/static/js/html5shiv.min.js"></script>
<![endif]-->
</head>
<body>
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form >
                    <div class="form-group">
                        <label for="name">name </label>
                        <input type="text" class="form-control" id="name" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="price">price</label>
                        <input type="text" class="form-control" id="price" placeholder="price">
                    </div>
                    <div class="form-group">
                        <label for="description">description</label>
                        <input type="text" class="form-control" id="description" placeholder="description">
                    </div>
                    <div class="form-group">
                        <label for="content">content</label>
                        <textarea class="form-control" rows="13"  wrap="physical" id="content" name="content"><?php echo $content;?></textarea>
                    </div>
                    <!--
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                    <div class="form-group">
                        <label for="pic">File input</label>
                        <input type="file" id="pic" name="pic[]">
                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                    <div class="form-group">
                        <label for="pic">File input</label>
                        <input type="file" id="pic" name="pic[]">
                        <p class="help-block">Example block-level help text here.</p>
                    </div>-->
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

