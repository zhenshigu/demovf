<html>
    <body>
        <input type="button" value="Say hello" onClick="showAndroidToast('Hello Android!')" />

<script type="text/javascript">
    function showAndroidToast(toast) {
//        alert(demo.getToken());
        demo.toast(toast);
    }
</script>
    </body>
</html>