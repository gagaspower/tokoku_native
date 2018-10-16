<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
$act=$_GET['act'];
if($act == 'simpan'){
$judul = trim($val->validasi($_POST['judul'],'xss'));
$slug  = seotitle($judul);
$isi   = stripslashes(htmlspecialchars($_POST['isi_halaman'],ENT_QUOTES));
$tgl_sekarang = date('Ymd');
//var_dump($pass);exit;
 
    $sql = mysql_query("INSERT INTO halamanstatis (judul,judul_seo,isi_halaman,tgl_posting) VALUES ('".$judul."','".$slug."','".$isi."','".$tgl_sekarang."') ");
    if($sql){
            echo " <script>document.location.href='?modul=halaman&status=2'";
            echo "</script>";
        }            
    else{
        echo " <script>document.location.href='?modul=halaman&status=1'";
            echo "</script>";
        }

 }// proses simpan produk selesai 


elseif($act == 'edit'){
$id = $val->validasi($_POST['id'],'sql');
$judul = trim($val->validasi($_POST['judul'],'xss'));
$slug  = seotitle($judul);
$isi   = stripslashes(htmlspecialchars($_POST['isi_halaman'],ENT_QUOTES));
$tgl_sekarang = date('Ymd');
//var_dump($pass);exit;
$sql = mysql_query("UPDATE halamanstatis SET judul='".$judul."',judul_seo = '".$slug."', isi_halaman = '".$isi."', tgl_posting = '".$tgl_sekarang."' WHERE id ='".$id."'");
if($sql){
        echo " <script>document.location.href='?modul=halaman&status=2'";
        echo "</script>";
    }            
else{
    echo " <script>document.location.href='?modul=halaman&status=1'";
        echo "</script>";
    }
}// proses simpan produk selesai 
	
// proses hapus mulai
  elseif($act == 'hapus'){
     $sql = mysql_query("DELETE FROM halamanstatis WHERE id='".$val->validasi($_GET['id'],'sql')."'");
     if($sql){
        echo "<script>document.location.href='?modul=halaman&status=6'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=halaman&status=4'";
      echo "</script>";
      }
    }

}
?>