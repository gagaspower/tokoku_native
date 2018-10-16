<?php
session_start();
$img = imagecreatefrompng('template/front/images/captcha.png');
$numero = rand(1000,9999);
$_SESSION['captcha_session']	= ($numero);
$white = imagecolorallocate($img, 0, 0, 0);
imagestring($img, 10, 8, 3, $numero, $white);
header ("Content-type: image/png"); imagepng($img);
?>