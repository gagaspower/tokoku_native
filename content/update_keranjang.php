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
include "config/koneksi.php";
$id       = $_POST['id'];
$jumlah   = $_POST['jumlah']; // quantity
$sql2 = mysql_query("SELECT stok_temp FROM orders_temp WHERE id_orders_temp='".$id."'");
while($r=mysql_fetch_array($sql2)){
if ($jumlah > $r['stok_temp']){
	echo "<script>
			setTimeout(function () { 
			 swal({
			            title: 'Peringatan',
			            text:  'Stok tersedia hanya ".$r['stok_temp']."',
			            type: 'error',
			            timer: 1500,
			            showConfirmButton: false
			        });  
			 },10); 
			 window.setTimeout(function(){ 
			  window.location.replace('".BASE_URL."/keranjang-belanja');
			 } ,1500);
    	 </script>";
}
elseif($jumlah == 0){
	echo "<script>
			setTimeout(function () { 
			 swal({
			            title: 'Peringatan',
			            text:  'Anda tidak boleh menginpukan angka 0',
			            type: 'error',
			            timer: 1500,
			            showConfirmButton: false
			        });  
			 },10); 
			 window.setTimeout(function(){ 
			  window.location.replace('".BASE_URL."/keranjang-belanja');
			 } ,1500);
    	 </script>";
} // tambahan update ada disini
else{
mysql_query("UPDATE orders_temp SET jumlah = '".$jumlah."'
WHERE id_orders_temp = '".$id."'");
	echo "<script>
			setTimeout(function () { 
			 swal({
			            title: 'Berhasil',
			            text:  'Jumlah item telah diubah',
			            type: 'success',
			            timer: 1000,
			            showConfirmButton: false
			        });  
			 },10); 
			 window.setTimeout(function(){ 
			  window.location.replace('".BASE_URL."/keranjang-belanja');
			 } ,1000);
    	 </script>";
    }
  }
}
 
?>