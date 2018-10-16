<?php
error_reporting(0);
session_start();
include "../config/koneksi.php";
include "../config/Bcrypt.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}
$kar1 =strstr($_POST['email'], '@');
$kar2 =strstr($_POST['email'], '.');
$username = anti_injection($_POST['email']);
$password = anti_injection($_POST['password']);

if (strlen($kar1) == 0 OR strlen($kar2) == 0){
      echo " <script>document.location.href='index.php?status=18'";
      echo "</script>";
  }
elseif (!ctype_alnum($password)){
      echo " <script>document.location.href='index.php?status=18'";
      echo "</script>";
}
else{
$login=mysql_query("SELECT * FROM users WHERE email='".$username."' AND blokir = 'N'");
$cek = mysql_num_rows($login);
if($cek > 0 ){
  $r = mysql_fetch_array($login);
  $pass_db = $r['password'];
  $bcrypt = new Bcrypt(16);
  if($bcrypt->verify($_POST['password'],$pass_db)){
    $_SESSION['email']= $r['email'];
    $_SESSION['password'] = $r['password'];
    $_SESSION['nama_lengkap']  = $r['nama_lengkap'];
    $_SESSION['id_user'] = $r['id'];
    $_SESSION['level'] = $r['level_id'];
    echo " <script>document.location.href='media.php'";
    echo "</script>";    
  }else{
      echo " <script>document.location.href='index.php?status=18'";
      echo "</script>";    
  }
}
  else{
      echo " <script>document.location.href='index.php?status=18'";
      echo "</script>";
  }
}
?>