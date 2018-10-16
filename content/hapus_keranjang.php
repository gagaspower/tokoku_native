<?php
session_start();
error_reporting(0);
if (empty($_SESSION['email']) AND empty($_SESSION['password'])) {
	echo "<script>
			setTimeout(function () { 
			 swal({
			            title: 'Peringatan',
			            text:  'Silahkan login terlebih dahulu',
			            type: 'error',
			            timer: 1500,
			            showConfirmButton: false
			        });  
			 },10); 
			 window.setTimeout(function(){ 
			  window.location.replace('".BASE_URL."');
			 } ,1500);
    	 </script>";
}
else {

	mysql_query("DELETE FROM orders_temp WHERE id_orders_temp='".abs((int)$_GET[id])."'");
	echo "<script>
			setTimeout(function () { 
			 swal({
			            title: 'Sukses',
			            text:  'Item telah dihapus.',
			            type: 'success',
			            timer: 1500,
			            showConfirmButton: false
			        });  
			 },10); 
			 window.setTimeout(function(){ 
			  window.location.replace('".BASE_URL."/keranjang-belanja');
			 } ,1500);
    	 </script>";
	}			
 ?>