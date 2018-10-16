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

elseif(empty($_POST['ekspedisi_id'])){

      echo "<script>
      setTimeout(function () { 
       swal({
                  title: 'alert',
                  text:  'Anda belum memilih ekspedisi pengiriman',
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
else{

$sql = "SELECT * FROM kustomer WHERE email_kustomer='".$_SESSION['email']."' AND password='".$_SESSION['password']."'";
$hasil = mysql_query($sql);
$r = mysql_fetch_array($hasil);


// ambil ekspedisi
$sql_ekspedisi = mysql_query("SELECT * FROM ekspedisi WHERE id = '".$_POST['ekspedisi_id']."'");
$e = mysql_fetch_array($sql_ekspedisi);

function isi_keranjang(){
  $isikeranjang = array();
  $sql = mysql_query("SELECT * FROM orders_temp WHERE id_session='".$_SESSION['email']."'");
  
  while ($r=mysql_fetch_array($sql)) {
    $isikeranjang[] = $r;
  }
  return $isikeranjang;
}

$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");

$id = mysql_fetch_array(mysql_query("SELECT id,kabupaten_id_kustomer FROM kustomer WHERE email_kustomer='".$_SESSION['email']."' AND password='".$_SESSION['password']."'"));

$id_kustomer=$id['id'];


$query = "SELECT max(id) as maxKode FROM orders";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$kodeBeli = $data['maxKode'];

$noUrut = (int) substr($kodeBeli, 3, 3);


$noUrut++;

$char = date('Ymd');
$newID = $char . sprintf("%03s", $noUrut);


mysql_query("INSERT INTO orders(id,tgl_order,jam_order,id_kustomer,ekspedisi_id) VALUES
                                ('".$newID."','".$tgl_skrg."','".$jam_skrg."','".$id_kustomer."','".$_POST['ekspedisi_id']."')");

  

$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);


for ($i = 0; $i < $jml; $i++){
  mysql_query("INSERT INTO orders_detail(id_orders, id_produk, jumlah) 
               VALUES('".$newID."',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']})");
}
  

for ($i = 0; $i < $jml; $i++) {
  mysql_query("DELETE FROM orders_temp
               WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
}
?>

<section class="main-container col1-layout">
    <div class="main container">
      <div class="col-main">
        <div class="product-shop col-md-9">
          <div class="cart wow bounceInUp animated">
            <div class="page-title">
              <h2>Bukti Pembelian</h2>
            </div>
            <br>
            <div class="table-responsive">
                <fieldset>
                  <table width="680px" cellspacing="0" cellpadding="5">
                  <tr>
                  <td>No. Invoice   </td><td> : <b>#<?php echo $newID;?></b> </td>
                  </tr>
                  <tr>
                  <td>Nama Lengkap   </td><td> : <b><?php echo $r['nama_kustomer'];?></b> </td>
                  </tr>
                  <tr>
                  <td>Alamat Lengkap </td><td> : <?php echo $r['alamat_kustomer'];?> </td>
                  </tr>
                  <tr>
                  <td>Ekspedisi Pengiriman </td><td> : <?php echo $e['nama_ekspedisi'];?> </td>
                  </tr>
                  </table>
                  <br>
                  <hr>
                  <table class="data-table cart-table" id="shopping-cart-table">
                    <thead>
                      <tr class="first last">
                        <th >Product</th>
                        <th>Unit Price</th>
                        <th >Qty</th>
                        <th >Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no=1;
                    $sql=mysql_query("SELECT * FROM orders_detail,produk 
                    WHERE produk.id = orders_detail.id_produk
                    AND orders_detail.id_orders='".$newID."'");
                    while($r=mysql_fetch_array($sql)){
                    $subtotal = $r['harga_produk'] * $r['jumlah']; 
                    $harga     = format_rupiah($r['harga_produk']);
                    $disc      = ($r['diskon_produk']/100)*$r['harga_produk'];
                    $hargadisc = number_format(($r['harga_produk']-$disc),0,",",".");
                    $total       = $total + $subtotal; 
                    $subtotalberat = $r['berat_produk'] * $r['jumlah'];
                    $totalberat  = $totalberat + $subtotalberat; // dalam gram
                    $beratkg = $totalberat/1000;

                    ?>
                      <tr>
                        <td><?php echo $r['nama_produk'];?></td>
                        <td><span class="cart-price"> <span class="price">Rp. <?php echo $hargadisc;?></span> </span></td>
                        <td><span class="cart-price"> <span class="price"><?php echo $r['jumlah'];?></span> </span></td>
                        <td ><span class="cart-price"> <span class="price">Rp. <?php echo format_rupiah($subtotal);?> </span> </span></td>
                      </tr>
                      <?php $no++; }  ?>
                    </tbody>
                  </table>
                </fieldset>
            </div>
            <!-- BEGIN CART COLLATERALS -->
<?php
$kabupaten =$id['kabupaten_id_kustomer'];
$ekspedisi =$_POST['ekspedisi_id'];
// var_dump($ekspedisi);exit;
$ongkir = mysql_query("SELECT ongkos FROM ongkos_kirim WHERE kabupaten_id = '".$kabupaten."' AND ekspedisi_id = '".$_POST['ekspedisi_id']."'");
$o=mysql_fetch_array($ongkir);
$ongkos = $o['ongkos'] * $beratkg;
$totalbiaya=$total + $ongkos;
?>
            <div class="cart-collaterals row">
              <div class="col-sm-4 pull-right">
              <div class="totals">
                <h3>Total</h3>
                <div class="inner">
                  <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                    <colgroup>
                    <col>
                    <col width="1">
                    </colgroup>
                    <tfoot>
                      <tr>
                        <td colspan="1" class="a-left" style=""><strong>Total Berat</strong></td>
                        <td class="a-right" style=""><span class="price"><?php echo $beratkg;?> (Kg)</span></td>
                      </tr>
                      <tr>
                        <td colspan="1" class="a-left" style=""><strong>Total Ongkir</strong></td>
                        <td class="a-right" style=""><span class="price">Rp. <?php echo format_rupiah($ongkos);?></span></td>
                      </tr>
                      <tr>
                        <td colspan="1" class="a-left" style=""><strong>Grand Total</strong></td>
                        <td class="a-right" style=""><strong><span class="price">Rp. <?php echo format_rupiah($totalbiaya);?></span></strong></td>
                      </tr>
                    </tfoot>
                  </table>
                  <ul class="checkout">
                    <li>
                      <button class="button btn-continue pull-right" title="Print Invoice" type="button" onClick="window.open('cetak.php?id=<?php echo $newID;?>');"><i class="fa fa-print"></i> <span>Cetak Bukti</span></button>
                    </li>
                  </ul>
                </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>
<?php 
    $sql_mailer = mysql_query("SELECT * FROM phpmailer_seting");
    $m=mysql_fetch_array($sql_mailer);
    $host = $m['host'];
    $username=$m['username'];
    $password = $m['password'];
    $port=$m['port'];
    $kabupaten =$id['kabupaten_id_kustomer'];
    $ekspedisi =$_POST['ekspedisi_id'];
    $ongkir = mysql_query("SELECT ongkos FROM ongkos_kirim WHERE kabupaten_id = '".$kabupaten."' AND ekspedisi_id = '".$_POST['ekspedisi_id']."'");
    $o=mysql_fetch_array($ongkir);
    $ongkos = $o['ongkos'] * $beratkg;
    $totalbiaya=$total + $ongkos; 

    $sql_kustomer = mysql_query("SELECT * FROM kustomer WHERE email_kustomer = '".$_SESSION['email']."'");
    $kus=mysql_fetch_array($sql_kustomer);   
    require 'config/PHPMailer/PHPMailerAutoload.php';
    $message .="<html>
                    <body style='font-size:14px';>
                        Hi...".$kus['nama_kustomer']."<br /><br/>
                        Berikut ini adalah detail order anda:<br />
                        <table border='0' cellspacing='0' cellpadding='5'>
                          <tr><td>No. Invoice<td><td>:</td><td>".$newID."</td></tr>
                          <tr><td>Nama Penerima<td><td>:</td><td>".$kus['nama_kustomer']."</td></tr>
                          <tr><td>Alamat Penerima<td><td>:</td><td>".$kus['alamat_kustomer']."</td></tr>
                          <tr><td>Ekspedisi Pengiriman<td><td>:</td><td>".$e['nama_ekspedisi']."</td></tr>
                          <tr><td>Total Berat<td><td>:</td><td>".$beratkg.".Kg<td></tr>
                          <tr><td>Total Ongkos Kirim<td><td>:</td><td>Rp.".format_rupiah($ongkos)."<td></tr>
                          <tr><td>Grand Total<td><td>:</td><td>Rp.".format_rupiah($totalbiaya)."<td></tr>
                        </table><br/><br/>
                        Silahkan melakukan proses pembayaran ke rek. Bank dibawah ini dengan total:&nbsp;&nbsp;<strong>Rp.".format_rupiah($totalbiaya)."</strong><br/><br/>
                        Silahkan melakukan pembayaran ke rekening yang ada pada halaman order anda.<br><br>
                        Terima kasih sudah order.
                    </body>
                </html>";
        $subjek = "Invoice Order";
        $mail = new PHPMailer();
        $mail->SMTPDebug =0;
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $username; // ganti dengan alamat gmail anda sendiri
        $mail->Password = $password;        // password email,
        $mail->SMTPSecure = 'tls';
        $mail->Port =$port;          
        $mail->SetFrom('pahlitamanata@gmail.com', 'Admin Toko');  // email anda yang akan ditampilkan sebagai pengirim silahkan ganti
        $mail->AddReplyTo("admin@toko.com","No Replay");  //email alternative anda.
        $mail->Subject    = $subjek;
        $mail->Body       = $message;
        $mail->AltBody    = $message;
        $mail->AddAddress($_SESSION['email'],$r['nama_kustomer']);   
        $mail->send();
  }

?>
