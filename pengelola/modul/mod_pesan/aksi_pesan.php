<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{

  $act=$_GET['act'];
  if($act == 'balas'){

        $sql_mailer = mysql_query("SELECT * FROM phpmailer_seting");
        $m=mysql_fetch_array($sql_mailer);
        $host = $m['host'];
        $username=$m['username'];
        $password = $m['password'];
        $port=$m['port'];
        
        require '../config/PHPMailer/PHPMailerAutoload.php';
        $pesan  = $_POST['pesan_balas'];
        $subjek = $_POST['subjek'];
        $email  = $_POST['email'];
        $nama  = $_POST['nama'];
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
        $mail->Body       = $pesan;
        $mail->AltBody    = $pesan;
        //$to = $emailpenerima; // Who is addressed the email to
        $mail->AddAddress($email, $nama);
         
        if(!$mail->send()) {
          echo "<script>document.location.href='?modul=pesan&status=16'";
          echo "</script>";  
        }
        else{
          mysql_query("UPDATE pesan SET status = '99' WHERE id = '".$val->validasi($_POST['id'],'sql')."'");
          echo "<script>document.location.href='?modul=pesan&status=17'";
          echo "</script>";      
        }

 }


// proses hapus mulai
  elseif($act == 'hapus'){
     $sql = mysql_query("DELETE FROM pesan WHERE id='".$val->validasi($_GET['id'],'sql')."'");
     if($sql){
        echo "<script>document.location.href='?modul=pesan&status=6'";
       echo "</script>";
    }else{
      echo "<script>document.location.href='?modul=pesan&status=4'";
      echo "</script>";
      }
    }

}
?>