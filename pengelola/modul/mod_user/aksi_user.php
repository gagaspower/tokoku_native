<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{

$act=$_GET['act'];
if($act == 'simpan'){
$nama  = trim($val->validasi($_POST['nama_lengkap'],'xss'));
$email = trim(mysql_real_escape_string($_POST['email']));
$level = $val->validasi($_POST['level_id'],'sql');
$bcrypt = new Bcrypt(16);
$hash = $bcrypt->hash($_POST['password']);
//var_dump($pass);exit;
 $cek = mysql_num_rows(mysql_query("SELECT email FROM users WHERE email = '".$email."'"));
 if($cek > 0){
  echo " <script>document.location.href='?modul=user&status=11'";
            echo "</script>";

 }
  else{ 
    $sql = mysql_query("INSERT INTO users (password,nama_lengkap,email,level_id) 
                        VALUES 
                                          ('".$hash."','".$nama."','".$email."','".$level."') ");
    if($sql){

    $sql1=mysql_query("SELECT url_website FROM identitas");
    $i = mysql_fetch_array($sql1);
    $url=$i['url_website'];
    
    $sql_mailer = mysql_query("SELECT * FROM phpmailer_seting");
    $m=mysql_fetch_array($sql_mailer);
    $host = $m['host'];
    $username=$m['username'];
    $password = $m['password'];
    $port=$m['port'];
    require '../config/PHPMailer/PHPMailerAutoload.php';
    $message = "<html>
                    <body style='font-size:14px';>
                        Klik link dibawah ini untuk mengaktifkan akun anda :<br />
                        $url/aktifasi.php?email=$email
                    </body>
                </html>";
        $subjek = "Aktifasi akun";
        $mail = new PHPMailer();
        $mail->SMTPDebug =0;
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $username; // ganti dengan alamat gmail anda sendiri
        $mail->Password = $password;        // password email,
        $mail->SMTPSecure = 'tls';
        $mail->Port =$port;          
        $mail->SetFrom('pahlitamanata@gmail.com', 'Yatoreh Activation');  // email anda yang akan ditampilkan sebagai pengirim silahkan ganti
        $mail->AddReplyTo("admin@yatoreh.com","No Replay");  //email alternative anda.
        $mail->Subject    = $subjek;
        $mail->Body       = $message;
        $mail->AltBody    = $message;
        $mail->AddAddress($email,$nama);
        $mail->send();   
          echo " <script>document.location.href='?modul=user&status=2'";
          echo "</script>";
        }            
        else{
        echo " <script>document.location.href='?modul=user&status=1'";
            echo "</script>";
        }
    }
 }// proses simpan produk selesai 


elseif($act == 'edit'){
$id = $val->validasi($_POST['id'],'sql');
$nama  = trim($val->validasi($_POST['nama_lengkap'],'xss'));
$email = trim($val->validasi($_POST['email'],'xss'));
$level = $val->validasi($_POST['level_id'],'sql');
$bcrypt = new Bcrypt(16);
$hash = $bcrypt->hash($_POST['password']);
//var_dump($pass);exit;
if(empty($_POST['password'])){
  $sql = mysql_query("UPDATE users SET nama_lengkap='".$nama."',email='".$email."',level_id='".$level."' WHERE id ='".$id."'");
if($sql){
        echo " <script>document.location.href='?modul=user&status=2'";
        echo "</script>";
    }            
else{
    echo " <script>document.location.href='?modul=user&status=1'";
        echo "</script>";
    }
}else{
  $sql = mysql_query("UPDATE users SET password = '".$hash."',
                                       nama_lengkap = '".$nama."',
                                       email = '".$email."',
                                       level_id = '".$level."'
                                       WHERE id ='".$id."'");
if($sql){
        echo " <script>document.location.href='?modul=user&status=2'";
        echo "</script>";
    }            
else{
    echo " <script>document.location.href='?modul=user&status=1'";
        echo "</script>";
    }
 }
}// proses simpan produk selesai 
	
// proses hapus mulai
  elseif($act == 'hapus'){
     $sql = mysql_query("DELETE FROM users WHERE id='".$val->validasi($_GET['id'],'sql')."'");
     if($sql){
        echo "<script>document.location.href='?modul=user&status=6'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=user&status=4'";
      echo "</script>";
      }
    }

  elseif($act == 'blokir'){
     $sql = mysql_query("UPDATE users SET blokir = 'Y' WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
     if($sql){
        echo "<script>document.location.href='?modul=user&status=12'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=user&status=1'";
      echo "</script>";
      }
    }

  elseif($act == 'aktifkan'){
     $sql = mysql_query("UPDATE users SET blokir = 'N' WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
     if($sql){
        echo "<script>document.location.href='?modul=user&status=13'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=user&status=1'";
      echo "</script>";
      }
    }

}
?>