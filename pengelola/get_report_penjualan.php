<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{ ?>

  <?php
  include "../config/koneksi.php";
  include "../config/fungsi_tanggal.php";
  $mulai = $_POST['tanggal_awal'];
  $selesai=$_POST['tanggal_akhir'];
  $sql = mysql_query("SELECT
                      orders.id,
                      orders.status_order,
                      orders.tgl_order,
                      orders.jam_order,
                      kustomer.nama_kustomer
                      FROM
                      orders
                      INNER JOIN kustomer ON kustomer.id = orders.id_kustomer
                      WHERE orders.status_order = 'Lunas'
                      AND orders.tgl_order BETWEEN '$mulai' AND '$selesai'
                      ORDER BY orders.id DESC");
  while($r = mysql_fetch_array($sql)){
  ?>
  <tr>
      <td data-sortable="true"><?php echo $r['id'];?></td>
      <td data-sortable="true"><?php echo $r['nama_kustomer'];?></td>
      <td><?php echo tgl_indo($r['tgl_order']);?> - <?php echo $r['jam_order'];?></td>
      <td><?php echo $r['status_order']; ?></td>
  </tr>
 <?php } ?>
<?php }  ?>

  
