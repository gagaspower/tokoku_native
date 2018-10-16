<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
$act=$_GET['act'];
if($act == 'simpan'){
$nama  = $val->validasi($_POST['nama_level'],'xss');
//var_dump($pass);exit;
 $cek = mysql_num_rows(mysql_query("SELECT nama_level FROM levels WHERE nama_level = '".$nama."'"));
 if($cek > 0){
  echo " <script>document.location.href='?modul=grup&status=11'";
            echo "</script>";

 }
  else{ 
    $sql = mysql_query("INSERT INTO levels (nama_level) VALUES ('".trim($nama)."') ");
    if($sql){
            echo " <script>document.location.href='?modul=grup&status=2'";
            echo "</script>";
        }            
    else{
        echo " <script>document.location.href='?modul=grup&status=1'";
            echo "</script>";
        }
    }
 }// proses simpan produk selesai 


elseif($act == 'edit'){
$id = $val->validasi($_POST['id'],'sql');
$nama  = $val->validasi($_POST['nama_level'],'xss');
//var_dump($pass);exit;
$sql = mysql_query("UPDATE levels SET nama_level='".$nama."' WHERE id ='".$id."'");
if($sql){
        echo " <script>document.location.href='?modul=grup&status=2'";
        echo "</script>";
    }            
else{
    echo " <script>document.location.href='?modul=grup&status=1'";
        echo "</script>";
    }
}// proses simpan produk selesai 
	
// proses hapus mulai
  elseif($act == 'hapus'){
     $sql = mysql_query("DELETE FROM levels WHERE id='".$val->validasi($_GET['id'],'sql')."'");
     if($sql){
        echo "<script>document.location.href='?modul=grup&status=6'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=grup&status=4'";
      echo "</script>";
      }
    }

}
?>