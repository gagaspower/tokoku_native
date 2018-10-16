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
$acak              = rand(1,99);
$nama_file_unik    = $acak.$nama_file; 
$nama              = trim($val->validasi($_POST['nama_produk'],'xss'));
$slug              = seotitle($nama);
$kategori          = $val->validasi($_POST['kategori_id'],'sql');
$harga             = trim(mysql_real_escape_string($_POST['harga_produk']));
$stok              = trim(mysql_real_escape_string($_POST['stok_produk']));
$berat              = trim(mysql_real_escape_string($_POST['berat_produk']));
$diskon            = trim(mysql_real_escape_string($_POST['diskon_produk']));
$detail            = stripslashes(htmlspecialchars($_POST['deskripsi_produk'],ENT_QUOTES));
$deskripsi_seo     = trim($val->validasi($_POST['deskripsi_seo_produk'],'xss'));
$tgl_sekarang      = date('Ymd');
//var_dump($pass);exit;
 
 // jika gambar tidak kosong
 if (!empty($lokasi_file)){
 // melakukan fungsi validasi upload gambar hanya boleh ekstensi jpg
 if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){

            echo " <script>document.location.href='?modul=produk&status=7'";
            echo "</script>";
    }
    else{
    // panggil fungsi UploadProduk untuk memulai proses penyimpanan dan rezise
    UploadProduk($nama_file_unik);
    $sql = mysql_query("INSERT INTO produk (kategori_id,user_id,nama_produk,produk_slug,deskripsi_produk,harga_produk,stok_produk,diskon_produk,berat_produk,deskripsi_seo_produk,tag_produk,gambar_produk,tanggal) 
                        VALUES 
                        ('".$kategori."','".$_SESSION['id_user']."','".$nama."','".$slug."','".$detail."','".$harga."','".$stok."','".$diskon."','".$berat."','".$deskripsi_seo."','".$_POST['tag_produk']."','".$nama_file_unik."','".$tgl_sekarang."')");
    if($sql){
            echo " <script>document.location.href='?modul=produk&status=2'";
            echo "</script>";
        }            
    else{
        echo " <script>document.location.href='?modul=produk&status=1'";
            echo "</script>";
        }
    }
 }
 else{
    // jika gambar tidak di isi
    $sql = mysql_query("INSERT INTO produk (kategori_id,user_id,nama_produk,produk_slug,deskripsi_produk,harga_produk,stok_produk,diskon_produk,berat_produk,deskripsi_seo_produk,tag_produk,tanggal) 
                        VALUES 
                        ('".$kategori."','".$_SESSION['id_user']."','".$nama."','".$slug."','".$detail."','".$harga."','".$stok."','".$diskon."','".$berat."','".$deskripsi_seo."','".implode(',',$_POST['tag_produk'])."','".$tgl_sekarang."')");
    echo " <script>document.location.href='?modul=produk&status=2'";
            echo "</script>";
    }
} // proses simpan produk selesai 


elseif($act == 'edit'){
$lokasi_file       = $_FILES['fupload']['tmp_name'];
$tipe_file         = $_FILES['fupload']['type'];
$nama_file         = $_FILES['fupload']['name'];
$acak              = rand(1,99);
$nama_file_unik    = $acak.$nama_file; 
$nama              = trim($val->validasi($_POST['nama_produk'],'xss'));
$slug              = seotitle($nama);
$kategori          = $val->validasi($_POST['kategori_id'],'sql');
$harga             = trim(mysql_real_escape_string($_POST['harga_produk']));
$stok              = trim(mysql_real_escape_string($_POST['stok_produk']));
$diskon            = trim(mysql_real_escape_string($_POST['diskon_produk']));
$berat              = trim(mysql_real_escape_string($_POST['berat_produk']));
$detail            = stripslashes(htmlspecialchars($_POST['deskripsi_produk'],ENT_QUOTES));
$deskripsi_seo     = trim($val->validasi($_POST['deskripsi_seo_produk'],'xss'));
$tgl_sekarang      = date('Ymd');
$id                = $val->validasi($_POST['id'],'sql');
//var_dump($pass);exit;
 
 // jika gambar tidak diubah
 if(empty($lokasi_file)){
 $sql = mysql_query("UPDATE produk 
                        SET
                        kategori_id     = '".$kategori."',
                        nama_produk     = '".$nama."',
                        produk_slug     = '".$slug."',
                        deskripsi_produk= '".$detail."',
                        harga_produk    = '".$harga."',
                        stok_produk     = '".$stok."',
                        diskon_produk   = '".$diskon."',
                        berat_produk    = '".$berat."',
                        deskripsi_seo_produk = '".$deskripsi_seo."',
                        tag_produk           = '".$_POST['tag_produk']."',
                        tanggal         = '".$tgl_sekarang."'
                        WHERE 
                        id ='".$id."'");

    //jika update tanpa ganti gambar berhasil
    echo " <script>document.location.href='?modul=produk&status=5'";
    echo "</script>";
    exit();
    }
    else{

    // validasi jika ekstensi gambar baru bukan tipe jpeg
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo " <script>document.location.href='?modul=produk&status=3'";
    echo "</script>";
    exit();
    }

    else{
    // jika ekstensi gambar sudah sesuai, dan berganti gambar maka ambil gambar lama dari direktori berdasarkan id produk yang di kirimkan
    $data=mysql_fetch_array(mysql_query("SELECT gambar_produk FROM produk WHERE id ='".$id."'"));
    unlink("../template/upload/featured_produk/".$data['gambar_produk']."");   
    unlink("../template/upload/featured_produk/medium_".$data['gambar_produk'].""); 
    unlink("../template/upload/featured_produk/small_".$data['gambar_produk'].""); 
    
     UploadProduk($nama_file_unik);
    // setelah penghapusan gambar lama, langsung eksekusi proses penyimpanan
 $sql = mysql_query("UPDATE produk 
                        SET
                        kategori_id     = '".$kategori."',
                        nama_produk     = '".$nama."',
                        produk_slug     = '".$slug."',
                        deskripsi_produk= '".$detail."',
                        harga_produk    = '".$harga."',
                        stok_produk     = '".$stok."',
                        diskon_produk   = '".$diskon."',
                        berat_produk    = '".$berat."',
                        deskripsi_seo_produk = '".$deskripsi_seo."',
                        tag_produk           = '".implode(',',$_POST['tag_produk'])."',
                        gambar_produk   = '".$nama_file_unik."',
                        tanggal         = '".$tgl_sekarang."'
                        WHERE 
                        id ='".$id."'");
    echo " <script>document.location.href='?modul=produk&status=5'";
    echo "</script>";
    exit();
        }
    }
} // proses update produk selesai
	
// proses hapus mulai
elseif($act == 'hapus'){

   $del = mysql_query("DELETE FROM produk WHERE id='".$val->validasi($_GET['id'],'sql')."'");
   if($del){
    echo "<script>document.location.href='?modul=produk&status=6'";
     echo "</script>";
  }else{
    echo "<script>document.location.href='?modul=produk&status=4'";
    echo "</script>";
  }
}

elseif($act == 'subscribe'){

    $sql2=mysql_query("SELECT * FROM produk WHERE id ='".$val->validasi($_GET['id'],'sql')."'");
    $a=mysql_fetch_array($sql2);
    $link = $a['id'].'/'.$a['produk_slug'].'/';

    $sql1=mysql_query("SELECT url_website FROM identitas");
    $i = mysql_fetch_array($sql1);
    
    $sql_mailer = mysql_query("SELECT * FROM phpmailer_seting");
    $m=mysql_fetch_array($sql_mailer);
    $host = $m['host'];
    $username=$m['username'];
    $password = $m['password'];
    $port=$m['port'];
    require '../config/PHPMailer/PHPMailerAutoload.php';
    $message = "<html>
                    <body style='font-size:14px';>
                        Hi...<br />
                        Tokoku ada produk baru lho<br />
                        Klik link dibawah ini untuk baca lebih lengkap :<br />
                        <h3><a href='".$i['url_website'].'/'.$link."'>".$a['nama_produk']."</a></h3><br /><br />
                        Terima kasih sudah berlangganan.
                    </body>
                </html>";
        $subjek = "Tokoku Update";
        $mail = new PHPMailer();
        $mail->SMTPDebug =0;
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $username; // ganti dengan alamat gmail anda sendiri
        $mail->Password = $password;        // password email,
        $mail->SMTPSecure = 'tls';
        $mail->Port =$port;          
        $mail->SetFrom('pahlitamanata@gmail.com', 'Admin Yatoreh');  // email anda yang akan ditampilkan sebagai pengirim silahkan ganti
        $mail->AddReplyTo("admin@yatoreh.com","No Replay");  //email alternative anda.
        $mail->Subject    = $subjek;
        $mail->Body       = $message;
        $mail->AltBody    = $message;

        $sql55=mysql_query("SELECT * FROM subscribe");
        while($r=mysql_fetch_array($sql55)){
        $mail->AddAddress($r['email'],$r['nama']);   
        }   
        if(!$mail->send()) {
         echo "<script>document.location.href='?modul=produk&status=24'";
         echo "</script>";
        }  
        else{
         echo "<script>document.location.href='?modul=produk&status=25'";
         echo "</script>";            
        }          
    }
}
?>