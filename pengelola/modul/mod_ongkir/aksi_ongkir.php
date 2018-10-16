<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
$act=$_GET['act'];
if($act == 'simpan'){
$kabupaten  = trim($val->validasi($_POST['kabupaten_id'],'sql'));
$ekspedisi  = trim($val->validasi($_POST['ekspedisi_id'],'sql'));
$ongkos     = trim(mysql_real_escape_string($_POST['ongkos']));
//var_dump($pass);exit;
 
    $sql = mysql_query("INSERT INTO ongkos_kirim (kabupaten_id,ekspedisi_id,ongkos) VALUES ('".$kabupaten."','".$ekspedisi."','".$ongkos."') ");
    if($sql){
            echo " <script>document.location.href='?modul=ongkir&status=2'";
            echo "</script>";
        }            
    else{
        echo " <script>document.location.href='?modul=ongkir&status=1'";
            echo "</script>";
        }
 }// proses simpan produk selesai 


elseif($act == 'edit'){
$id = $val->validasi($_POST['id'],'sql');
$kabupaten  = trim($val->validasi($_POST['kabupaten_id'],'sql'));
$ekspedisi  = trim($val->validasi($_POST['ekspedisi_id'],'sql'));
$ongkos     = trim(mysql_real_escape_string($_POST['ongkos']));
//var_dump($pass);exit;
$sql = mysql_query("UPDATE ongkos_kirim SET kabupaten_id='".$kabupaten."', ekspedisi_id='".$ekspedisi."', ongkos='".$ongkos."' WHERE id ='".$id."'");
if($sql){
        echo " <script>document.location.href='?modul=ongkir&status=2'";
        echo "</script>";
    }            
else{
    echo " <script>document.location.href='?modul=ongkir&status=1'";
        echo "</script>";
    }
}// proses simpan produk selesai 
	
// proses hapus mulai
  elseif($act == 'hapus'){
     $sql = mysql_query("DELETE FROM ongkos_kirim WHERE id='".$val->validasi($_GET['id'],'sql')."'");
     if($sql){
        echo "<script>document.location.href='?modul=ongkir&status=6'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=ongkir&status=4'";
      echo "</script>";
      }
    }

}
?>