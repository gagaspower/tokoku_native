<?php
error_reporting(0);
session_start();
if (empty($_SESSION['email']) && empty($_SESSION['password'])) {
      echo "<script>
      setTimeout(function () { 
       swal({
                  title: 'alert',
                  text:  'Silahkan login untuk melakukan transaksi',
                  type: 'error',
                  timer: 1500,
                  showConfirmButton: false
              });  
       },10); 
       window.setTimeout(function(){ 
        window.location.replace('".BASE_URL."/login');
       } ,1500);
       </script>";  
}else{ 
	function anti_injection($data){
	  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	  return $filter;
	}
	$nama 		 	= anti_injection(trim($_POST['nama_kustomer']));
	$alamat 		= anti_injection(trim($_POST['alamat_kustomer']));
	$kodepos 		= anti_injection(trim($_POST['kodepos_kustomer']));
	$provinsi 	    = $val->validasi($_POST['provinsi_id_kustomer'],'sql');
	$kabupaten 	    = $val->validasi($_POST['kabupaten_id_kustomer'],'sql');
	$tgl_sekarang = date('Y-m-d');
	// var_dump($email);exit;

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
				  window.location.replace('?module=editakun');
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
				  window.location.replace('?module=editakun');
				 } ,1500);
        	 </script>";		
	}
	else{	
	$sql = mysql_query("UPDATE kustomer SET nama_kustomer = '".$nama."',
											alamat_kustomer = '".$alamat."',
											provinsi_id_kustomer = '".$provinsi."',
											kabupaten_id_kustomer = '".$kabupaten."',
											kodepos_kustomer = '".$kodepos."',
											tanggal_registrasi_kustomer = '".$tgl_sekarang."'
											WHERE id = '".$val->validasi($_POST['id'],'sql')."'");
	if($sql){
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Sukses',
				            text:  'Data berhasil diubah.',
				            type: 'success',
				            timer: 1500,
				            showConfirmButton: true
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('?module=editakun');
				 } ,1500);
        	 </script>";

		}
	else{
		echo "<script>
				setTimeout(function () { 
				 swal({
				            title: 'Gagal',
				            text:  'Terjadi kesalahan saat menyimpan perubahan',
				            type: 'error',
				            timer: 1500,
				            showConfirmButton: true
				        });  
				 },10); 
				 window.setTimeout(function(){ 
				  window.location.replace('?module=editakun');
				 } ,1500);
        	 </script>";
        	}
        }

	}
?>