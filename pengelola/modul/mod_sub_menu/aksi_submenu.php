<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
$act=$_GET['act'];
if($act == 'simpan'){
$nama  = trim($val->validasi($_POST['nama_sub'],'xss'));
$link  = mysql_real_escape_string($_POST['link_sub']);
$parent= $val->validasi($_POST['main_id'],'sql');

 $cek = mysql_num_rows(mysql_query("SELECT nama_sub FROM submenu WHERE nama_sub = '".$nama."'"));
 if($cek > 0){
  echo "<script>document.location.href='?modul=submenu&status=11'";
  echo "</script>";
 }
  else{ 
    $sql0 = mysql_query("INSERT INTO submenu (main_id,nama_sub,link_sub) VALUES ('".$parent."','".$nama."','".$link."') ");
    if($sql0){
            echo " <script>document.location.href='?modul=submenu&status=2'";
            echo "</script>";
        }            
    else{
        echo " <script>document.location.href='?modul=submenu&status=1'";
            echo "</script>";
        }
    }
 }// proses simpan produk selesai 


elseif($act == 'edit'){
$id = $val->validasi($_POST['id'],'sql');
$nama  = trim($val->validasi($_POST['nama_sub'],'xss'));
$link  = mysql_real_escape_string($_POST['link_sub']);
$parent= $val->validasi($_POST['main_id'],'sql');
//var_dump($pass);exit;
$sql1 = mysql_query("UPDATE submenu SET main_id = '".$parent."' ,nama_sub='".$nama."', link_sub = '".$link."' WHERE id ='".$id."'");
if($sql1){
        echo " <script>document.location.href='?modul=submenu&status=2'";
        echo "</script>";
    }            
else{
    echo " <script>document.location.href='?modul=submenu&status=1'";
        echo "</script>";
    }
}// proses simpan produk selesai 
	
// proses hapus mulai
  elseif($act == 'hapus'){
     $sql2 = mysql_query("DELETE FROM submenu WHERE id='".$val->validasi($_GET['id'],'sql')."'");
     if($sql2){
        echo "<script>document.location.href='?modul=submenu&status=6'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=submenu&status=4'";
      echo "</script>";
      }
    }

  elseif($act == 'matikan'){
     $sql3 = mysql_query("UPDATE submenu SET aktif = 'N' WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
     if($sql3){
        echo "<script>document.location.href='?modul=submenu&status=14'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=submenu&status=1'";
      echo "</script>";
      }
    }

  elseif($act == 'aktifkan'){
     $sql4 = mysql_query("UPDATE submenu SET aktif = 'Y' WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
     if($sql4){
        echo "<script>document.location.href='?modul=submenu&status=15'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=submenu&status=1'";
      echo "</script>";
      }
    }

}
?>