<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
$act=$_GET['act'];
if($act == 'simpan'){
$lokasi_file       = $_FILES['fupload']['tmp_name'];
$tipe_file         = $_FILES['fupload']['type'];
$nama_file         = $_FILES['fupload']['name'];
$nama              = trim($val->validasi($_POST['nama_ekspedisi'],'xss'));
//var_dump($pass);exit;
 
 // jika gambar tidak kosong
 if (!empty($lokasi_file)){
 // melakukan fungsi validasi upload gambar hanya boleh ekstensi jpg
 if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){

            echo " <script>document.location.href='?modul=ekspedisi&status=7'";
            echo "</script>";
    }
    else{
    // panggil fungsi UploadEkspedisi untuk memulai proses penyimpanan dan rezise
    UploadEkspedisi($nama_file);
    $sql = mysql_query("INSERT INTO ekspedisi (nama_ekspedisi,logo_ekspedisi) 
                        VALUES 
                        ('".$nama."','".$nama_file."')");
    if($sql){
            echo " <script>document.location.href='?modul=ekspedisi&status=2'";
            echo "</script>";
        }            
    else{
        echo " <script>document.location.href='?modul=ekspedisi&status=1'";
            echo "</script>";
        }
    }
 }
 else{
    // jika gambar tidak di isi
    $sql = mysql_query("INSERT INTO ekspedisi (nama_ekspedisi) 
                        VALUES 
                        ('".$nama."')");
    echo " <script>document.location.href='?modul=ekspedisi&status=2'";
            echo "</script>";
    }
} // proses simpan produk selesai 


elseif($act == 'edit'){
$lokasi_file       = $_FILES['fupload']['tmp_name'];
$tipe_file         = $_FILES['fupload']['type'];
$nama_file         = $_FILES['fupload']['name'];
$id                = $val->validasi($_POST['id'],'sql');
$nama              = trim($val->validasi($_POST['nama_ekspedisi'],'xss'));
//var_dump($pass);exit;
 
 // jika gambar tidak diubah
 if(empty($lokasi_file)){
 $sql = mysql_query("UPDATE ekspedisi 
                        SET
                        nama_ekspedisi         = '".$nama."'
                        WHERE 
                        id ='".$id."'");

    //jika update tanpa ganti gambar berhasil
    echo " <script>document.location.href='?modul=ekspedisi&status=5'";
    echo "</script>";
    exit();
    }
    else{

    // validasi jika ekstensi gambar baru bukan tipe jpeg
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo " <script>document.location.href='?modul=ekspedisi&status=3'";
    echo "</script>";
    exit();
    }

    else{
    // jika ekstensi gambar sudah sesuai, dan berganti gambar maka ambil gambar lama dari direktori berdasarkan id produk yang di kirimkan
    $data=mysql_fetch_array(mysql_query("SELECT logo_ekspedisi FROM ekspedisi WHERE id ='".$id."'"));
    unlink("../template/upload/featured_ekspedisi/".$data['logo_ekspedisi']."");   
    unlink("../template/upload/featured_ekspedisi/small_".$data['logo_ekspedisi'].""); 
    
     UploadEkspedisi($nama_file);
    // setelah penghapusan gambar lama, langsung eksekusi proses penyimpanan
 $sql = mysql_query("UPDATE ekspedisi 
                        SET
                        nama_ekspedisi         = '".$nama."',
                        logo_ekspedisi         = '".$nama_file."'
                        WHERE 
                        id ='".$id."'");
    echo " <script>document.location.href='?modul=ekspedisi&status=5'";
    echo "</script>";
    exit();
        }
    }
} // proses update produk selesai
	
// proses hapus mulai
elseif($act == 'hapus'){

  $del =  mysql_query("DELETE FROM ekspedisi WHERE id='".$val->validasi($_GET['id'],'sql')."'");
  if($del){
    echo "<script>document.location.href='?modul=ekspedisi&status=6'";
     echo "</script>";
  }else{
    echo "<script>document.location.href='?modul=ekspedisi&status=4'";
    echo "</script>";
  }
}


}
?>