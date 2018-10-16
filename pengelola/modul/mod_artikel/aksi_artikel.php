<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
$act=$_GET['act'];
if($act == 'simpan'){
$judul             = trim($val->validasi($_POST['judul'],'xss'));
$slug              = seotitle($judul);
$isi               = stripslashes(htmlspecialchars($_POST['isi_berita'],ENT_QUOTES));
$deskripsi         = trim($val->validasi($_POST['meta_deskripsi'],'xss'));
$tgl_sekarang      = date('Ymd');
$jam_sekarang      = date('H:i:s');
//var_dump($pass);exit;
    $sql = mysql_query("INSERT INTO berita (user_id,judul,judul_seo,isi_berita,hari,tanggal,jam,tag,meta_deskripsi) 
                        VALUES 
                        ('".$_SESSION['id_user']."','".$judul."','".$slug."','".$isi."','".$hari_ini."','".$tgl_sekarang."','".$jam_sekarang."','".$_POST['tag']."','".$deskripsi."')");
    if($sql){
            echo " <script>document.location.href='?modul=artikel&status=2'";
            echo "</script>";
        }            
    else{
        echo " <script>document.location.href='?modul=artikel&status=1'";
            echo "</script>";
        }
} // proses simpan produk selesai 


elseif($act == 'edit'){
$id                = $val->validasi($_POST['id'],'sql');
$judul             = trim($val->validasi($_POST['judul'],'xss'));
$slug              = seotitle($judul);
$isi               = stripslashes(htmlspecialchars($_POST['isi_berita'],ENT_QUOTES));
$deskripsi         = trim($val->validasi($_POST['meta_deskripsi'],'xss'));
$tgl_sekarang      = date('Ymd');
$jam_sekarang      = date('H:i:s');
//var_dump($pass);exit;

 $sql = mysql_query("UPDATE berita 
                        SET
                        judul         = '".$judul."',
                        judul_seo     = '".$slug."',
                        isi_berita    = '".$isi."',
                        hari          = '".$hari_ini."',
                        tanggal       = '".$tgl_sekarang."',
                        jam           = '".$jam_sekarang."',
                        tag           = '".$_POST['tag']."',
                        meta_deskripsi= '".$deskripsi."'
                        WHERE 
                        id ='".$id."'");

    if($sql){
    //jika update tanpa ganti gambar berhasil
        echo " <script>document.location.href='?modul=artikel&status=2'";
        echo "</script>";
        exit();
    }else{
        echo " <script>document.location.href='?modul=artikel&status=1'";
        echo "</script>";
        exit();       
    }

} // proses update produk selesai
	
// proses hapus mulai
elseif($act == 'hapus'){

 $del=mysql_query("DELETE FROM berita WHERE id='".$val->validasi($_GET['id'],'sql')."'");
 if($del){
    echo "<script>document.location.href='?modul=artikel&status=6'";
     echo "</script>";
  }else{
    echo "<script>document.location.href='?modul=artikel&status=4'";
    echo "</script>";
  }
}

elseif($act == 'subscribe'){

    $sql2=mysql_query("SELECT * FROM berita WHERE id ='".$val->validasi($_GET['id'],'sql')."'");
    $a=mysql_fetch_array($sql2);
    $link = 'blog/detail/'.$a['judul_seo'].'/';

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
                        Tokoku ada artikel baru lho<br />
                        Klik link dibawah ini untuk baca lebih lengkap :<br />
                        <h3><a href='".$i['url_website'].'/'.$link."'>".$a['judul']."</a></h3><br /><br />
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
         echo "<script>document.location.href='?modul=artikel&status=24'";
         echo "</script>";
        }  
        else{
         echo "<script>document.location.href='?modul=artikel&status=25'";
         echo "</script>";            
        }          
    }
}
?>