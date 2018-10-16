<?php
include "config/Bcrypt.php";
$bcrypt = new Bcrypt(16);
$hash = $bcrypt->hash($_POST['password']);
  if($bcrypt->verify($_POST['ulangi_password'], $hash)){
      mysql_query("UPDATE kustomer SET password = '".$hash."' WHERE email_kustomer = '".$_SESSION['email']."'");
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Sukses',
				            text:  'Password telah diubah.',
				            type: 'success',
				            timer: 1500,
				            showConfirmButton: false
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('?module=akun');
				 } ,1500);
        	 </script>";
    }else{
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Gagal',
				            text:  'Tidak bisa merubah password.',
				            type: 'error',
				            timer: 1500,
				            showConfirmButton: false
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('?module=akun');
				 } ,1500);
        	 </script>";
    }
?>