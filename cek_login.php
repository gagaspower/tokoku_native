<?php
error_reporting(0);
session_start();
include "config/koneksi.php";
include "config/Bcrypt.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}
$kar1 =strstr($_POST['email'], '@');
$kar2 =strstr($_POST['email'], '.');
$username = anti_injection($_POST['email']);
$password = anti_injection($_POST['password']);

if (strlen($kar1) == 0 OR strlen($kar2) == 0){
  echo "<script>
      setTimeout(function () { 
       swal({
                  title: 'Gagal',
                  text:  'Email tidak valid. Mohon ulangi',
                  type: 'error',
                  timer: 1500,
                  showConfirmButton: true
              });  
       },10); 
       window.setTimeout(function(){ 
        window.location.replace('".BASE_URL."/login');
       } ,1500);
       </script>";
  }
elseif (!ctype_alnum($password)){
  echo "<script>
      setTimeout(function () { 
       swal({
                  title: 'Gagal',
                  text:  'Kombinasi password hanya huruf dan angka',
                  type: 'error',
                  timer: 1500,
                  showConfirmButton: true
              });  
       },10); 
       window.setTimeout(function(){ 
        window.location.replace('".BASE_URL."/login');
       } ,1500);
       </script>";
}
else{
$login=mysql_query("SELECT * FROM kustomer WHERE email_kustomer ='".$username."' AND aktif='Y'");
$cek = mysql_num_rows($login);
if($cek > 0 ){
  $r = mysql_fetch_array($login);
  $pass_db = $r['password'];
  $bcrypt = new Bcrypt(16);
  if($bcrypt->verify($_POST['password'],$pass_db)){
    $_SESSION['email']= $r['email_kustomer'];
    $_SESSION['password'] = $r['password'];
    $_SESSION['nama_lengkap']  = $r['nama_kustomer'];
    $_SESSION['id_user'] = $r['id'];
      echo "<script>
      setTimeout(function () { 
       swal({
                  title: 'Berhasil Login',
                  text:  'Selamat datang ".$r['nama_kustomer']."',
                  type: 'success',
                  timer: 1500,
                  showConfirmButton: false
              });  
       },10); 
       window.setTimeout(function(){ 
        window.location.replace('".BASE_URL."/akun');
       } ,1500);
       </script>";    
  }
}else{
      echo "<script>
      setTimeout(function () { 
       swal({
                  title: 'Gagal',
                  text:  'Kustomer tidak ditemukan',
                  type: 'error',
                  timer: 1500,
                  showConfirmButton: true
              });  
       },10); 
       window.setTimeout(function(){ 
        window.location.replace('".BASE_URL."/login');
       } ,1500);
       </script>"; 
  }
}
?>