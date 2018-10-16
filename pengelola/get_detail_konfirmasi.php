<?php
error_reporting(0);
session_start();
if (empty($_SESSION['email']) && empty($_SESSION['password'])) {
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";  
}else{ 
include "../config/koneksi.php";
include "../config/fungsi_rupiah.php";
include "../config/fungsi_tanggal.php";
$ids=$_POST['idkonfirmasi'];
$sql = mysql_query("SELECT
                    konfirmasi.id,
                    konfirmasi.tgl_konfirmasi,
                    konfirmasi.jam_konfirmasi,
                    konfirmasi.id_orders,
                    konfirmasi.nama_penyetor,
                    konfirmasi.nominal,
                    konfirmasi.bank_penyetor,
                    konfirmasi.bukti_konfirmasi,
                    bank.nama_bank
                    FROM
                    konfirmasi
                    INNER JOIN bank ON bank.id = konfirmasi.id_bank
                    WHERE konfirmasi.id = '".$ids."'");
$r = mysql_fetch_array($sql);
?>
<center><h3>DETAIL KONFIRMASI</h3></center>
<hr class="soften"/>	
  <table class="table">
    <tbody>
      <tr>
      <td>No.Invoice</td><td>:</td><td><?php echo $r['id_orders'];?></td>
      </tr>
      <tr>
      <td>Tgl & Jam Konfirmasi</td><td>:</td><td><?php echo tgl_indo($r['tgl_konfirmasi']);?> - <?php echo $r['jam_konfirmasi'];?></td>
      </tr>
      <tr>
      <td>Nama Penyetor</td><td>:</td><td><?php echo $r['nama_penyetor'];?></td>
      </tr>
      <tr>
      <td>Jumlah Transfer</td><td>:</td><td><?php echo format_rupiah($r['nominal']);?></td>
      </tr>
      <tr>
      <td>Bank Pengirim / Dari bank</td><td>:</td><td><?php echo $r['bank_penyetor'];?></td>
      </tr>
      <tr>
      <td>Bank Penerima / Bank tujuan</td><td>:</td><td><?php echo $r['nama_bank'];?></td>
      </tr>
    </tbody>
  </table>

<?php } ?>