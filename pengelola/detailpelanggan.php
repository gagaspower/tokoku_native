<?php
error_reporting(0);
session_start();
include "../config/koneksi.php";
include "../config/fungsi_tanggal.php";
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
    $id = $_POST['idpelanggan'];
    $sql=mysql_query("SELECT kustomer.id,
                             kustomer.nama_kustomer,
                             kustomer.email_kustomer,
                             kustomer.alamat_kustomer,
                             kustomer.kodepos_kustomer,
                             provinsi.nama_provinsi,
                             kabupaten.nama_kabupaten
                            FROM
                            kustomer
                            LEFT JOIN provinsi ON provinsi.id = kustomer.provinsi_id_kustomer
                            LEFT JOIN kabupaten ON kabupaten.id = kustomer.kabupaten_id_kustomer
                             WHERE kustomer.id='".$id."'");
    $p=mysql_fetch_array($sql); 
    ?>
    <table class='table'>
        <tr><td>Nama Kustomer</td><td>:</td><td><?php echo $p['nama_kustomer'];?></td></tr>
        <tr><td>Email Kustomer</td><td>:</td><td><?php echo $p['email_kustomer'];?></td></tr>
        <tr><td>Alamat Kustomer</td><td>:</td><td><?php echo $p['alamat_kustomer'];?></td></tr>
        <tr><td>Nama Provinsi</td><td>:</td><td><?php echo $p['nama_provinsi'];?></td></tr>
        <tr><td>Email Kabupaten</td><td>:</td><td><?php echo $p['nama_kabupaten'];?></td></tr>
        <tr><td>Kodepos Kustomer</td><td>:</td><td><?php echo $p['kodepos_kustomer'];?></td></tr>
    </table>
<?php
 }
?>