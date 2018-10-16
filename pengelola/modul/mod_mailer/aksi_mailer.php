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
$host  = trim(mysql_real_escape_string($_POST['host']));
$email = trim(mysql_real_escape_string($_POST['username']));
$password = trim(mysql_real_escape_string($_POST['password']));
$port = trim(mysql_real_escape_string($_POST['port']));


$sql = mysql_query("UPDATE phpmailer_seting SET host='".$host."',username='".$email."',password='".$password."', port='".$port."' WHERE id ='".$id."'");
if($sql){
        echo " <script>document.location.href='?modul=mailer&status=2'";
        echo "</script>";
    }            
else{
    echo " <script>document.location.href='?modul=mailer&status=1'";
        echo "</script>";
    }
    }
 }
?>