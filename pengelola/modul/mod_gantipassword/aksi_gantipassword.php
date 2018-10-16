<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{

$act=$_GET['act'];
if($act == 'edit'){
$bcrypt = new Bcrypt(16);
$hash = $bcrypt->hash($_POST['password']);
  if($bcrypt->verify($_POST['password_verifikasi'], $hash)){
      mysql_query("UPDATE users SET password = '".$hash."' WHERE id = '".$_SESSION['id_user']."'");
      echo " <script>document.location.href='?modul=gantipassword&status=5'";
      echo "</script>";
    }else{
      echo " <script>document.location.href='?modul=gantipassword&status=19'";
      echo "</script>";
    }
  }// proses simpan produk selesai 
}
?>