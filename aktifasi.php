	<?php
	include "config/koneksi.php";
	$sql = mysql_query("UPDATE users SET blokir ='N' WHERE email='".mysql_real_escape_string($_GET['email'])."'");
	if($sql){
		echo "Akun anda telah diaktifkan. Silahkan login untuk melanjutkan";
	}
	else{
		echo "Tidak bisa mengirimkan permintaan.";
	}
	?>
