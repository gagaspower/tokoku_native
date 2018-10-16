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
include "config/fungsi_rupiah.php";
$ids=$_POST['idtemp'];
$sql = mysql_query("SELECT
                          orders.id,
                          orders.status_order,
                          orders.tgl_order,
                          orders.jam_order,
                          kustomer.nama_kustomer,
                          kustomer.alamat_kustomer,
                          kustomer.email_kustomer,
                          kustomer.kabupaten_id_kustomer,
                          ekspedisi.nama_ekspedisi,
                          ekspedisi.id AS id_ekspedisi
                          FROM
                          orders
                          INNER JOIN kustomer ON kustomer.id = orders.id_kustomer
                          INNER JOIN ekspedisi ON ekspedisi.id = orders.ekspedisi_id
                          WHERE
                          orders.id = '".$ids."'");
$r = mysql_fetch_array($sql);
$idorder=$r['id'];
?>
<center><h3>NOTA PEMBELIAN</h3></center>
<hr class="soften"/>	
  <table class="table">
    <tbody>
      <tr>
      <td width="150">Nama Lengkap</td><td>:</td><td><?php echo $r['nama_kustomer'];?></td>
      </tr>
      <tr>
      <td>Alamat Lengkap</td><td>:</td><td><?php echo $r['alamat_kustomer'];?></td>
      </tr>
      <tr>
      <td>Ekspedisi</td><td>:</td><td><?php echo $r['nama_ekspedisi'];?></td>
      </tr>
    </tbody>
  </table>
<br>
<h4>No. Order: <?php echo $idorder;?></h4><br>

  <table class="table table-bordered table-condensed">
    <thead>
      <tr>
        <th>Produk</th>
        <th>Harga Unit</th>
        <th>Qty </th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $sql_produk=mysql_query("SELECT
                          orders_detail.id_orders,
                          orders_detail.jumlah,
                          produk.nama_produk,
                          produk.harga_produk,
                          produk.stok_produk,
                          produk.diskon_produk,
                          produk.berat_produk,
                          produk.id
                          FROM
                          orders_detail
                          LEFT JOIN produk ON produk.id = orders_detail.id_produk
                          WHERE
                          orders_detail.id_orders ='".$ids."'");
      while($d=mysql_fetch_array($sql_produk)){
      $subtotal = $d['harga_produk'] * $d['jumlah']; 
      $harga     = format_rupiah($d['harga_produk']);
      $disc      = ($d['diskon_produk']/100)*$d['harga_produk'];
      $hargadisc = number_format(($d['harga_produk']-$disc),0,",",".");
      $total       = $total + $subtotal; 
      $subtotalberat = $d['berat_produk'] * $d['jumlah'];
      $totalberat  = $totalberat + $subtotalberat; // dalam gram
      $beratkg = $totalberat/1000;
      ?>
  <tr>
      <td><?php echo $d['nama_produk'];?></td>
      <td>Rp. <?php echo $hargadisc;?></td>
      <td align="center"><?php echo $d['jumlah'];?></td>
      <td align="right">Rp. <?php echo format_rupiah($subtotal);?></td>
  </tr>
<?php
}
$id_kota= $r['kabupaten_id_kustomer'];
$ekspedisi = $r['id_ekspedisi'];
// var_dump($id_kota);exit;
$ongkir = mysql_query("SELECT ongkos FROM ongkos_kirim WHERE kabupaten_id = '".$id_kota."' AND ekspedisi_id = '".$ekspedisi."'");
$o=mysql_fetch_array($ongkir);
$ongkos = $o['ongkos'] * $beratkg;
$totalbiaya=$total + $ongkos;
?>
<tr bgcolor=#ddd><td colspan='4'></td></tr>
<tr><td colspan=3 align=right>Total berat:</td><td align=right><b><?php echo $beratkg;?> (Kg)</b></td></tr>
<tr><td colspan=3 align=right>Ongkos Kirim: </td><td align=right><b>Rp. <?php echo format_rupiah($ongkos);?></b></td></tr>
<tr><td colspan=3 align=right>Total Akhir: </td><td align=right><b>Rp. <?php echo format_rupiah($totalbiaya);?></b></td></tr>

</tbody>
</table>
<?php } ?>