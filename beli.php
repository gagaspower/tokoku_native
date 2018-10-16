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
}
else{
	$sid = $_SESSION['email'];
	$sql2 = mysql_query("SELECT stok_produk FROM produk WHERE id='".$val->validasi($_GET['id'],'sql')."'");
	$r=mysql_fetch_array($sql2);
	$stok=$r['stok_produk'];
  
  if ($stok < 1){
	echo "<script>
			setTimeout(function () { 
			 swal({
			            title: 'Alert',
			            text:  'Stok Habis, silahkan pilih produk lain',
			            type: 'error',
			            timer: 1500,
			            showConfirmButton: true
			        });  
			 },10); 
			 window.setTimeout(function(){ 
			  window.location.replace('".BASE_URL."');
			 } ,1500);
    	 </script>";
  }
  else{
	// check if the product is already
	// in cart table for this session
	$sql = mysql_query("SELECT id_produk FROM orders_temp
			WHERE id_produk  ='".$val->validasi($_GET['id'],'sql')."' AND id_session='".$sid."'");
	$ketemu=mysql_num_rows($sql);
	if ($ketemu < 1){
		// put the product in cart table
		mysql_query("INSERT INTO orders_temp (id_produk, id_session, jumlah, tgl_order_temp, jam_order_temp, stok_temp)
				VALUES ('".$val->validasi($_GET['id'],'sql')."', '$sid', 1,'$tgl_sekarang', '$jam_sekarang', '$stok')");
				echo "<script>document.location.href='".BASE_URL."/keranjang-belanja'";
		echo "</script>";
	} else {
		// update product quantity in cart table
		mysql_query("UPDATE orders_temp 
		        SET jumlah = jumlah + 1
				WHERE id_session ='".$sid."' AND id_produk ='".$val->validasi($_GET['id'],'sql')."'");		
		echo "<script>document.location.href='".BASE_URL."/keranjang-belanja'";
		echo "</script>";
	}	
	deleteAbandonedCart();
		echo "<script>document.location.href='".BASE_URL."/keranjang-belanja'";
		echo "</script>";
  }				


  function deleteAbandonedCart(){
	$kemarin = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	mysql_query("DELETE FROM orders_temp 
	        WHERE tgl_order_temp < '$kemarin'");
}
}
?>