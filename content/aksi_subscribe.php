	<?php

	function anti_injection($data){
	  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	  return $filter;
	}

	$nama 		 	= anti_injection(trim($_POST['nama']));
	$email 			= anti_injection(trim($_POST['email']));
	$kar1=strstr($email, "@");
	$kar2=strstr($email, ".");


	if(!preg_match("/^[a-zA-Z ]*$/",$nama)){
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Gagal',
				            text:  'Nama hanya mengandung huruf. Mohon ulangi',
				            type: 'error',
				            timer: 1000,
				            showConfirmButton: false
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				 window.location.replace('".BASE_URL."');
				 } ,1000);
        	 </script>";
	}

	elseif (strlen($kar1)==0 OR strlen($kar2)==0){
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Gagal',
				            text:  'Email tidak valid. Mohon ulangi',
				            type: 'error',
				            timer: 1000,
				            showConfirmButton: false
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				 window.location.replace('".BASE_URL."');
				 } ,1000);
        	 </script>";
	}
	else{
	$sql = mysql_query("INSERT INTO subscribe (nama,email) 
						VALUES ('".$val->validasi($_POST['nama'],'xss')."',
								'".mysql_real_escape_string($_POST['email'])."')
								");
	if($sql){
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Sukses',
				            text:  'Terima kasih telah berlangganan.',
				            type: 'success',
				            timer: 1000,
				            showConfirmButton: false
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('".BASE_URL."');
				 } ,1000);
        	 </script>";
	}
	else{
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Gagal',
				            text:  'Tidak bisa melakukan request anda.',
				            type: 'error',
				            timer: 1000,
				            showConfirmButton: false
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('".BASE_URL."');
				 } ,1000);
        	 </script>";
		}
	}
	?>
