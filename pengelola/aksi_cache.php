<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
$act=$_GET['act'];
if($act == 'enable'){
     $sql = mysql_query("UPDATE identitas SET cache = 'Y' WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
     if($sql){
        echo "<script>
                setTimeout(function () { 
                 swal({
                            title: 'Sukses',
                            text:  'Cache telah diaktifkan',
                            type: 'success',
                            timer: 1500,
                            showConfirmButton: true
                        });  
                 },10); 
                 window.setTimeout(function(){ 
                  window.location.replace('media.php');
                 } ,1500);
             </script>";
    }else{
        echo "<script>
                setTimeout(function () { 
                 swal({
                            title: 'Gagal',
                            text:  'Cache tidak bisa diaktifkan',
                            type: 'error',
                            timer: 1500,
                            showConfirmButton: true
                        });  
                 },10); 
                 window.setTimeout(function(){ 
                  window.location.replace('media.php');
                 } ,1500);
             </script>";
      }
    }

  elseif($act == 'disable'){
     $sql = mysql_query("UPDATE identitas SET cache = 'N' WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
     if($sql){
        echo "<script>
                setTimeout(function () { 
                 swal({
                            title: 'Sukses',
                            text:  'Cache telah di Nonaktifkan',
                            type: 'success',
                            timer: 1500,
                            showConfirmButton: true
                        });  
                 },10); 
                 window.setTimeout(function(){ 
                  window.location.replace('media.php');
                 } ,1500);
             </script>";
    }else{
        echo "<script>
                setTimeout(function () { 
                 swal({
                            title: 'Gagal',
                            text:  'Cache tidak bisa di Nonaktifkan',
                            type: 'error',
                            timer: 1500,
                            showConfirmButton: true
                        });  
                 },10); 
                 window.setTimeout(function(){ 
                  window.location.replace('media.php');
                 } ,1500);
             </script>";
      }
    }
}
?>