<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
$act=$_GET['act'];
if($act == 'update'){
$lokasi_file       = $_FILES['fupload']['tmp_name'];
$tipe_file         = $_FILES['fupload']['type'];
$nama_file         = $_FILES['fupload']['name'];
$id                = $val->validasi($_POST['id'],'sql');
$judul             = trim($val->validasi($_POST['nama_website'],'xss'));
$url               = trim($_POST['url_website']);
$keyword           = trim($val->validasi($_POST['meta_keyword'],'xss'));
$deskripsi         = trim($val->validasi($_POST['meta_deskripsi'],'xss'));
 // jika gambar tidak diubah
 if(empty($lokasi_file)){
 $sql = mysql_query("UPDATE identitas 
                        SET
                        nama_website  = '".$judul."',
                        url_website   = '".$url."',
                        meta_keyword  = '".$keyword."',
                        meta_deskripsi= '".$deskripsi."'
                        WHERE 
                        id ='".$id."'");

    //jika update tanpa ganti gambar berhasil
    echo " <script>document.location.href='?modul=pengaturan&status=5'";
    echo "</script>";
    exit();
    }
    else{

    // validasi jika ekstensi gambar baru bukan tipe jpeg
    if ($tipe_file != "image/png"){
    echo " <script>document.location.href='?modul=pengaturan&status=8'";
    echo "</script>";
    exit();
    }

    else{
    // jika ekstensi gambar sudah sesuai, dan berganti gambar maka ambil gambar lama dari direktori berdasarkan id produk yang di kirimkan
    $data=mysql_fetch_array(mysql_query("SELECT logo FROM identitas WHERE id ='".$id."'"));
    unlink("../template/upload/website_logo/".$data['logo']."");   
    unlink("../template/upload/website_logo/medium_".$data['logo'].""); 

    
     UploadLogo($nama_file);
    // setelah penghapusan gambar lama, langsung eksekusi proses penyimpanan
 $sql = mysql_query("UPDATE identitas 
                        SET
                        nama_website  = '".trim($judul)."',
                        url_website   = '".trim($url)."',
                        meta_keyword  = '".trim($keyword)."',
                        meta_deskripsi= '".trim($deskripsi)."',
                        logo          = '".$nama_file."'
                        WHERE 
                        id ='".$id."'");
    echo " <script>document.location.href='?modul=pengaturan&status=5'";
    echo "</script>";
    exit();
        }
    }
} // proses update produk selesai
}
?>