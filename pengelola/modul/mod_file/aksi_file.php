<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
$act=$_GET['act'];
if($act == 'simpan'){
$lokasi_file = $_FILES['fupload']['tmp_name'];
$nama_file   = $_FILES['fupload']['name'];
$nama  = trim($val->validasi($_POST['judul'],'xss'));
$tgl_sekarang = date('Y-m-d');
//var_dump($pass);exit;
 // jika gambar tidak kosong
 if (!empty($lokasi_file)){
  
  $file_extension = strtolower(substr(strrchr($nama_file,"."),1));

  switch($file_extension){
    case "pdf": $ctype="application/pdf"; break;
    case "exe": $ctype="application/octet-stream"; break;
    case "zip": $ctype="application/zip"; break;
    case "rar": $ctype="application/rar"; break;
    case "doc": $ctype="application/msword"; break;
    case "xls": $ctype="application/vnd.ms-excel"; break;
    case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
    case "jpeg":
    case "jpg": $ctype="image/jpg"; break;
    default: $ctype="application/proses";
  }

  if ($file_extension=='php'){
            echo " <script>document.location.href='?modul=file&status=29'";
            echo "</script>";
  }
    else{
    // panggil fungsi UploadProduk untuk memulai proses penyimpanan dan rezise
    UploadFile($nama_file);
    $sql = mysql_query("INSERT INTO download (judul,nama_file,tgl_posting) 
                        VALUES 
                        ('".$nama."','".$nama_file."','".$tgl_sekarang."')");
    if($sql){
            echo " <script>document.location.href='?modul=file&status=2'";
            echo "</script>";
        }            
    else{
        echo " <script>document.location.href='?modul=file&status=1'";
            echo "</script>";
        }
    }
 }
 else{
    // jika gambar tidak di isi
    $sql = mysql_query("INSERT INTO download (judul,tgl_posting) 
                        VALUES 
                        ('".$nama."','".$tgl_sekarang."')");
    echo " <script>document.location.href='?modul=file&status=2'";
            echo "</script>";
    }
} 



elseif($act == 'edit'){
$id = $val->validasi($_POST['id'],'sql');
$lokasi_file = $_FILES['fupload']['tmp_name'];
$nama_file   = $_FILES['fupload']['name'];
$nama  = trim($val->validasi($_POST['judul'],'xss'));
$tgl_sekarang = date('Y-m-d');
//var_dump($pass);exit;
if(empty($lokasi_file)){
$sql = mysql_query("UPDATE download 
                      SET
                      judul   = '".$nama."',
                      tgl_posting = '".$tgl_sekarang."'
                      WHERE 
                      id ='".$id."'");

  //jika update tanpa ganti gambar berhasil
  echo " <script>document.location.href='?modul=file&status=5'";
  echo "</script>";
  exit();
  }
else{

$file_extension = strtolower(substr(strrchr($nama_file,"."),1));

switch($file_extension){
  case "pdf": $ctype="application/pdf"; break;
  case "exe": $ctype="application/octet-stream"; break;
  case "zip": $ctype="application/zip"; break;
  case "rar": $ctype="application/rar"; break;
  case "doc": $ctype="application/msword"; break;
  case "xls": $ctype="application/vnd.ms-excel"; break;
  case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
  case "gif": $ctype="image/gif"; break;
  case "png": $ctype="image/png"; break;
  case "jpeg":
  case "jpg": $ctype="image/jpg"; break;
  default: $ctype="application/proses";
}

if ($file_extension=='php'){
          echo " <script>document.location.href='?modul=file&status=29'";
          echo "</script>";
}

else{
// jika ekstensi gambar sudah sesuai, dan berganti gambar maka ambil gambar lama dari direktori berdasarkan id produk yang di kirimkan
$data=mysql_fetch_array(mysql_query("SELECT nama_file FROM download WHERE id ='".$id."'"));
unlink("../template/upload/file/".$data['nama_file']."");   
UploadFile($nama_file);
$sql = mysql_query("UPDATE download 
                      SET
                      judul   = '".$nama."',
                      nama_file= '".$nama_file."',
                      tgl_posting = '".$tgl_sekarang."'
                      WHERE 
                      id ='".$id."'");
echo " <script>document.location.href='?modul=file&status=5'";
echo "</script>";
exit();
    }
}
}
// proses simpan produk selesai 
	
// proses hapus mulai
  elseif($act == 'hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT nama_file FROM download WHERE id='".$val->validasi($_GET['id'],'sql')."'"));
  
  if ($data['files'] > 0){
    mysql_query("DELETE FROM download WHERE id='".$val->validasi($_GET['id'],'sql')."'");
  unlink("../template/upload/file/".$data['nama_file'].""); 
     
     echo "<script>document.location.href='?modul=file&status=6'";
     echo "</script>"; 

     // hapus data jika tidak ada gambarnya
  }elseif ($data['files'] == 0){
   mysql_query("DELETE FROM download WHERE id='".$val->validasi($_GET['id'],'sql')."'");
    echo "<script>document.location.href='?modul=file&status=6'";
     echo "</script>";
  }else{
    echo "<script>document.location.href='?modul=file&status=4'";
    echo "</script>";
  }
}

}
?>