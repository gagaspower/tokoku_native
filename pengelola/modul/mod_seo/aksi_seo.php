<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
$act=$_GET['act'];
if($act == 'update'){
$id =   $val->validasi($_POST['id'],'sql');
$google  = trim(mysql_real_escape_string($_POST['google_verifikasi']));
$bing = trim(mysql_real_escape_string($_POST['bing_verifikasi']));
$yandex = trim(mysql_real_escape_string($_POST['yandex_verifikasi']));


$sql = mysql_query("UPDATE serp_manage SET google_verifikasi='".$google."',bing_verifikasi='".$bing."',yandex_verifikasi='".$yandex."' WHERE id ='".$id."'");
if($sql){
        echo " <script>document.location.href='?modul=seo&status=2'";
        echo "</script>";
    }            
else{
    echo " <script>document.location.href='?modul=seo&status=1'";
        echo "</script>";
    }
    }
 }
?>