<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
$act=$_GET['act'];
if($act == 'hapus'){
     $sql = mysql_query("DELETE FROM kustomer WHERE id='".$val->validasi($_GET['id'],'sql')."'");
     if($sql){
        echo "<script>document.location.href='?modul=pelanggan&status=6'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=pelanggan&status=4'";
      echo "</script>";
      }
    }

}
?>