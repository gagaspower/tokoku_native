	<?php

	function anti_injection($data){
	  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	  return $filter;
	}

	$nama 		 	= anti_injection(trim($_POST['nama']));
	$email 			= anti_injection(trim($_POST['email']));
	$subjek 		= anti_injection(trim($_POST['subjek']));
	$pesan 			= anti_injection(trim($_POST['pesan']));
	$kar1=strstr($email, "@");
	$kar2=strstr($email, ".");

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
				  window.location.replace('".BASE_URL."/hubungi-kami');
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
				  window.location.replace('".BASE_URL."/hubungi-kami');
				 } ,1500);
        	 </script>";
	}

	else{
	if($_POST['captcha']==$_SESSION['captcha_session']){
	$sql = mysql_query("INSERT INTO pesan (tanggal,jam,nama,email,subjek,pesan) 
						VALUES ('".date('Y-m-d')."',
								'".date('H:i:s')."',
								'".anti_injection(trim($_POST['nama']))."',
								'".anti_injection(trim($_POST['email']))."',
								'".anti_injection(trim($_POST['subjek']))."',
								'".$val->validasi($_POST['pesan'],'xss')."')
								");
	if($sql){
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Sukses',
				            text:  'Pesan Anda telah terkirim.',
				            type: 'success',
				            timer: 1500,
				            showConfirmButton: true
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('".BASE_URL."/hubungi-kami');
				 } ,1500);
        	 </script>";

		}
	else{
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Gagal',
				            text:  'Pesan tidak terkirim. Mohon ulangi',
				            type: 'error',
				            timer: 1500,
				            showConfirmButton: true
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('".BASE_URL."/hubungi-kami');
				 } ,1500);
        	 </script>";

	}
}else{

		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Gagal',
				            text:  'Captcha tidak cocok. Mohon ulangi',
				            type: 'error',
				            timer: 1500,
				            showConfirmButton: true
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('".BASE_URL."/hubungi-kami');
				 } ,1500);
        	 </script>";	
        	}
}
?>