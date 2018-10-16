<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
$act=$_GET['act'];
if($act == 'simpan'){
$provinsi  = trim($val->validasi($_POST['provinsi_id'],'sql'));
$nama  = trim($val->validasi($_POST['nama_kabupaten'],'xss'));
//var_dump($pass);exit;
 $cek = mysql_num_rows(mysql_query("SELECT nama_kabupaten FROM kabupaten WHERE nama_kabupaten = '".$nama."'"));
 if($cek > 0){
  echo " <script>document.location.href='?modul=kabupaten&status=11'";
            echo "</script>";

 }
  else{ 
    $sql = mysql_query("INSERT INTO kabupaten (provinsi_id,nama_kabupaten) VALUES ('".$provinsi."','".$nama."') ");
    if($sql){
            echo " <script>document.location.href='?modul=kabupaten&status=2'";
            echo "</script>";
        }            
    else{
        echo " <script>document.location.href='?modul=kabupaten&status=1'";
            echo "</script>";
        }
    }
 }// proses simpan produk selesai 


elseif($act == 'edit'){
$id = $val->validasi($_POST['id'],'sql');
$provinsi  = $val->validasi($_POST['provinsi_id'],'sql');
$nama  = trim($val->validasi($_POST['nama_kabupaten'],'xss'));
//var_dump($pass);exit;
$sql = mysql_query("UPDATE kabupaten SET provinsi_id='".$provinsi."', nama_kabupaten='".$nama."' WHERE id ='".$id."'");
if($sql){
        echo " <script>document.location.href='?modul=kabupaten&status=2'";
        echo "</script>";
    }            
else{
    echo " <script>document.location.href='?modul=kabupaten&status=1'";
        echo "</script>";
    }
}// proses simpan produk selesai 
	
// proses hapus mulai
  elseif($act == 'hapus'){
     $sql = mysql_query("DELETE FROM kabupaten WHERE id='".$val->validasi($_GET['id'],'sql')."'");
     if($sql){
        echo "<script>document.location.href='?modul=kabupaten&status=6'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=kabupaten&status=4'";
      echo "</script>";
      }
    }

}
?>