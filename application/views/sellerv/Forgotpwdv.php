<?php
echo validation_errors();
echo form_open_multipart('seller/Saccount/forgotPwd');?>
<input type="email" name="email">
<input type="submit" name="submit">

