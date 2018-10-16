<?php
if(empty($_SESSION['email']) || empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
 $act=$_GET['act'];
 if($act == 'edit'){

      // Update untuk mengurangi stok 
      mysql_query("UPDATE produk,orders_detail SET produk.stok_produk=produk.stok_produk-orders_detail.jumlah 
      WHERE produk.id=orders_detail.id_produk and orders_detail.id_orders='".$_GET['id']."'");
      
      // Update untuk menambahkan produk yang dibeli (best seller = produk yang paling laris)
      mysql_query("UPDATE produk,orders_detail SET produk.dibeli=produk.dibeli+orders_detail.jumlah 
      WHERE produk.id=orders_detail.id_produk and orders_detail.id_orders='".$_GET['id']."'");

       //UPDATE STATUS ORDER 
      mysql_query("UPDATE orders SET status_order='Lunas' where id_orders='".$_GET['id']."'");

      // update status konfirmasi
      mysql_query("UPDATE konfirmasi SET status = '99' WHERE id_orders ='".$_GET['id']."'");
      echo " <script>document.location.href='?modul=order&status=2'";
      echo "</script>";
      exit();
  }//proses atau aksi edit selesai

}

?>