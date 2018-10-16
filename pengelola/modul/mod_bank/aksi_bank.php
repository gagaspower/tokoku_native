<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
$act=$_GET['act'];
if($act == 'simpan'){
$namabank  = trim($val->validasi($_POST['nama_bank'],'xss'));
$namapemilik  = trim($val->validasi($_POST['nama_pemilik'],'xss'));
$nomor = trim(mysql_real_escape_string($_POST['rek_bank']));
//var_dump($pass);exit;
 
    $sql = mysql_query("INSERT INTO bank (nama_bank,rek_bank,nama_pemilik) VALUES ('".$namabank."','".$nomor."','".$namapemilik."') ");
    if($sql){
            echo " <script>document.location.href='?modul=bank&status=2'";
            echo "</script>";
        }            
    else{
        echo " <script>document.location.href='?modul=bank&status=1'";
            echo "</script>";
        }
 }// proses simpan produk selesai 


elseif($act == 'edit'){
$id = $val->validasi($_POST['id'],'sql');
$namabank  = trim($val->validasi($_POST['nama_bank'],'xss'));
$namapemilik  = trim($val->validasi($_POST['nama_pemilik'],'xss'));
$nomor = trim(mysql_real_escape_string($_POST['rek_bank']));
//var_dump($pass);exit;
$sql = mysql_query("UPDATE bank SET nama_bank='".$namabank."',rek_bank = '".$nomor."',nama_pemilik = '".$namapemilik."' WHERE id ='".$id."'");
if($sql){
        echo " <script>document.location.href='?modul=bank&status=2'";
        echo "</script>";
    }            
else{
    echo " <script>document.location.href='?modul=bank&status=1'";
        echo "</script>";
    }
}// proses simpan produk selesai 
	
// proses hapus mulai
  elseif($act == 'hapus'){
     $sql = mysql_query("DELETE FROM bank WHERE id='".$val->validasi($_GET['id'],'sql')."'");
     if($sql){
        echo "<script>document.location.href='?modul=bank&status=6'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=bank&status=4'";
      echo "</script>";
      }
    }

}
?>