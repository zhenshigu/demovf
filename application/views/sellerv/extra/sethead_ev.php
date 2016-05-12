<link rel="stylesheet" type="text/css" href=<?php echo $base_url."static/css/uploadify.css"?>>
<link rel="stylesheet" type="text/css" href=<?php echo $base_url."static/css/imgareaselect-default.css"?> />
<script type="text/javascript" src=<?php echo $base_url."static/js/jquery.uploadify.min.js"?>></script>
 <script type="text/javascript" src=<?php echo $base_url."static/js/jquery.imgareaselect.pack.js"?>></script>
 <style>
     #myprogress{
         display: none;
     }
     #cropform{display: none}
 </style>
<script type="text/javascript">
  var base_url="<?php echo $base_url;?>";
  function preview(img, selection) {
    var scaleX = 100 / (selection.width || 1);
    var scaleY = 100 / (selection.height || 1);
  
    $('#ferret + div > img').css({
        width: Math.round(scaleX * 400) + 'px',
        height: Math.round(scaleY * 300) + 'px',
        marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
        marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
    });
}
function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('在图片上裁剪先');
    return false;
  };
  jQuery(function($){
  $('#pic').uploadify({
      'auto'  :false,
      'buttonText' : '浏览...',
      'fileObjName' : 'pic',
      'queueID'  : 'myprogress',
      'fileTypeExts' : '*.jpg;',
      'swf':base_url+ 'static/swf/uploadify.swf',
      'uploader' :base_url+ 'seller/saccount/setHeadImg',
      'onSelect' : function(file) {
          $('#result').html('文件 ' + file.name + ' 已经添加,点击上传按钮进行上传');
        },
      'formData':{'uphead':'1'},
      // Your options here
      'onUploadSuccess' : function(file, data, response) {
        $('#mypreview').remove();
        $('#ferret').attr('src',data).show();
        $('#cropform').show();
    $('#ferret').imgAreaSelect({ aspectRatio: '1:1',
        movable:true,
        onSelectEnd: function (img, selection) {
          $('#x').val(selection.x1);
          $('#y').val(selection.y1);
          $('#w').val(selection.width);
          $('#h').val(selection.height);
        }
     });

    } 
  });
  });

</script>


