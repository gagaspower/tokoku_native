<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
$act=$_GET['act'];
if($act == 'simpan'){
$nama  = trim($val->validasi($_POST['nama_menu'],'xss'));
$link  = mysql_real_escape_string($_POST['link']);
$posisi= $val->validasi($_POST['posisi'],'xss');

 $cek = mysql_num_rows(mysql_query("SELECT nama_menu FROM mainmenu WHERE nama_menu = '".$nama."'"));
 if($cek > 0){
  echo "<script>document.location.href='?modul=menuutama&status=11'";
  echo "</script>";
 }
  else{ 
    $sql0 = mysql_query("INSERT INTO mainmenu (nama_menu,link,posisi) VALUES ('".$nama."','".$link."','".$posisi."') ");
    if($sql0){
            echo " <script>document.location.href='?modul=menuutama&status=2'";
            echo "</script>";
        }            
    else{
        echo " <script>document.location.href='?modul=menuutama&status=1'";
            echo "</script>";
        }
    }
 }// proses simpan produk selesai 


elseif($act == 'edit'){
$id = $val->validasi($_POST['id'],'sql');
$nama  = trim($val->validasi($_POST['nama_menu'],'xss'));
$link  = mysql_real_escape_string($_POST['link']);
$posisi= $val->validasi($_POST['posisi'],'xss');
//var_dump($pass);exit;
$sql1 = mysql_query("UPDATE mainmenu SET nama_menu='".$nama."', link = '".$link."', posisi = '".$posisi."' WHERE id ='".$id."'");
if($sql1){
        echo " <script>document.location.href='?modul=menuutama&status=2'";
        echo "</script>";
    }            
else{
    echo " <script>document.location.href='?modul=menuutama&status=1'";
        echo "</script>";
    }
}// proses simpan produk selesai 
	
// proses hapus mulai
  elseif($act == 'hapus'){
     $sql2 = mysql_query("DELETE FROM mainmenu WHERE id='".$val->validasi($_GET['id'],'sql')."'");
     if($sql2){
        echo "<script>document.location.href='?modul=menuutama&status=6'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=menuutama&status=4'";
      echo "</script>";
      }
    }

  elseif($act == 'matikan'){
     $sql3 = mysql_query("UPDATE mainmenu SET aktif = 'N' WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
     if($sql3){
        echo "<script>document.location.href='?modul=menuutama&status=14'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=menuutama&status=1'";
      echo "</script>";
      }
    }

  elseif($act == 'aktifkan'){
     $sql4 = mysql_query("UPDATE mainmenu SET aktif = 'Y' WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
     if($sql4){
        echo "<script>document.location.href='?modul=menuutama&status=15'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=menuutama&status=1'";
      echo "</script>";
      }
    }


  elseif($act == 'pindahheader'){
     $sql5 = mysql_query("UPDATE mainmenu SET posisi = 'header' WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
     if($sql5){
        echo "<script>document.location.href='?modul=menuutama&status=2'";
       echo "</script>";
    }
    else{
      echo "<script>document.location.href='?modul=menuutama&status=1'";
      echo "</script>";
      }
  }

  elseif($act == 'pindahfooter'){
     $sql6 = mysql_query("UPDATE mainmenu SET posisi = 'footer' WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
     if($sql6){
        echo "<script>document.location.href='?modul=menuutama&status=2'";
        echo "</script>";
      }
      else{
        echo "<script>document.location.href='?modul=menuutama&status=1'";
        echo "</script>";
      }
    }

}
?>