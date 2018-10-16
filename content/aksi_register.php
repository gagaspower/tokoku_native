	<?php
	include "config/Bcrypt.php";
	function anti_injection($data){
	  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	  return $filter;
	}

	$nama 		 	= anti_injection(trim($_POST['nama_kustomer']));
	$email 			= anti_injection(trim($_POST['email_kustomer']));
	$alamat 		= anti_injection(trim($_POST['alamat_kustomer']));
	$telpon 		= anti_injection(trim($_POST['telpon_kustomer']));
	$kodepos 		= anti_injection(trim($_POST['kodepos_kustomer']));
	$provinsi 	    = $val->validasi($_POST['provinsi_id_kustomer'],'sql');
	$kabupaten 	    = $val->validasi($_POST['kabupaten_id_kustomer'],'sql');
	$kar1=strstr($email, "@");
	$kar2=strstr($email, ".");
	$tgl_sekarang = date('Y-m-d');

	$cek=mysql_num_rows(mysql_query("SELECT email_kustomer FROM kustomer WHERE email_kustomer = '".$email."'"));
	if($cek > 0){
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Gagal',
				            text:  'Email sudah terdaftar',
				            type: 'error',
				            timer: 1500,
				            showConfirmButton: true
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('?module=daftar');
				 } ,1500);
        	 </script>";		
	}else{
	if(!preg_match("/^[a-zA-Z ]*$/",$nama)){
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Gagal',
				            text:  'Nama hanya mengandung huruf. Mohon ulangi',
				            type: 'error',
				            timer: 1500,
				            showConfirmButton: true
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('?module=daftar');
				 } ,1500);
        	 </script>";
	}

	elseif (strlen($kar1)==0 OR strlen($kar2)==0){
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Gagal',
				            text:  'Email tidak valid. Mohon ulangi',
				            type: 'error',
				            timer: 1500,
				            showConfirmButton: true
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('?module=daftar');
				 } ,1500);
        	 </script>";
	}
	elseif(!is_numeric($kodepos)) {
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Gagal',
				            text:  'Kodepos Harus angka',
				            type: 'error',
				            timer: 1500,
				            showConfirmButton: true
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('?module=daftar');
				 } ,1500);
        	 </script>";		
	}
	elseif(!ctype_alnum($_POST['password'])){
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Gagal',
				            text:  'Kombinasi password hanya huruf dan angka',
				            type: 'error',
				            timer: 1500,
				            showConfirmButton: true
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('?module=daftar');
				 } ,1500);
        	 </script>";		
	}
	else{
	$bcrypt = new Bcrypt(16);
	$hash = $bcrypt->hash($_POST['password']);		
	$sql = mysql_query("INSERT INTO kustomer (password,
											nama_kustomer,
											alamat_kustomer,
											email_kustomer,
											provinsi_id_kustomer,
											kabupaten_id_kustomer,
											kodepos_kustomer,
											tanggal_registrasi_kustomer) 
								VALUES ('".$hash."',
										'".$nama."',
										'".$alamat."',
										'".$email."',
										'".$provinsi."',
										'".$kabupaten."',
										'".$kodepos."',
										'".$tgl_sekarang."')
										");
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
    require 'config/PHPMailer/PHPMailerAutoload.php';
    $message = "<html>
                    <body style='font-size:14px';>
                        Klik link dibawah ini untuk mengaktifkan akun anda :<br />
                        $url/user_aktifasi.php?email=$email
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

		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Sukses',
				            text:  'Registrasi berhasil. Silahkan cek email untuk verifikasi',
				            type: 'success',
				            timer: 1500,
				            showConfirmButton: true
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('?module=daftar');
				 } ,1500);
        	 </script>";

		}
	else{
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Gagal',
				            text:  'Pendaftaran gagal diproses. Mohon ulangi',
				            type: 'error',
				            timer: 1500,
				            showConfirmButton: true
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('?module=daftar');
				 } ,1500);
        	 </script>";
        }

	}
}
?>