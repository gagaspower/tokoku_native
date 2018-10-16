<?php 
// PDF MENGGUNAKAN HTML2PDF PLUGIN.....
// PANGGIL SEMUA FUNGSI YANG DIBUTUHKAN
  ob_start();
  require ("config/html2pdf/html2pdf.class.php");
  include "config/koneksi.php";
  include "config/fungsi_tanggal.php";
  include "config/fungsi_rupiah.php";
  $now = date('Y-m-d');
  //$filename="account.pdf";
  $content = ob_get_clean();
  $content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 190mm;'>
          <tr valign='top'>
            <td style='width: 203mm;' valign='middle'>
              <div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;text-align:center;'>
                INVOICE ORDER
              </div>";

            // mengambil data pelanggan
            $sql = mysql_query("SELECT
                                  orders.jam_order,
                                  orders.tgl_order,
                                  orders.status_order,
                                  orders.id,
                                  kustomer.nama_kustomer,
                                  kustomer.alamat_kustomer,
                                  kustomer.email_kustomer,
                                  ekspedisi.nama_ekspedisi,
                                  ekspedisi.id AS id_ekspedisi,
                                  kustomer.kabupaten_id_kustomer
                                  FROM
                                  orders
                                  INNER JOIN kustomer ON kustomer.id = orders.id_kustomer
                                  INNER JOIN ekspedisi ON ekspedisi.id = orders.ekspedisi_id
                                  WHERE
                                  orders.id ='".$_GET['id']."'");
            $r = mysql_fetch_array($sql);
            $idorder=$r['id'];

            $content .=" <span style='font-size: 10pt;'>Nomor Invoice: <b>$idorder</b></span><br>
            <span style='font-size: 10pt;'>Status Pembayaran: <b>$r[status_order]</b></span>
            </td>
          </tr>
        </table>
        <p style='width: 210mm; font-size: 11pt;'><span style='font-size: 10pt;'>";


        $content .= "Data pemesan beserta ordernya adalah sebagai berikut: <br />
         <table >
      <tr><td>Nama Lengkap   </td><td> : <b>$r[nama_kustomer]</b> </td></tr>
      <tr><td>Alamat Lengkap </td><td> : $r[alamat_kustomer] </td></tr>
      <tr><td>E-mail         </td><td> : $r[email_kustomer] </td></tr>
      <tr><td>Ekspedisi      </td><td> : $r[nama_ekspedisi] </td></tr></table><hr style='width: 45mm;' />

        </span></p>
        <table cellpadding='0' cellspacing='1' style='width: 190mm;'>
          <tr bgcolor='#CCCCCC' style='width:10mm;text-align:center;'>
            <th style='width: 90mm;'>Nama Produk</th>
            <th style='width: 15mm;'>Qty</th>
            <th style='width: 35mm;'>Harga Satuan</th>
            <th style='width: 35mm;'>Subtotal</th>
          </tr>";
          // mengambil data produk
          $daftarproduk=mysql_query("SELECT
                                      orders_detail.id_orders,
                                      orders_detail.jumlah,
                                      produk.nama_produk,
                                      produk.harga_produk,
                                      produk.stok_produk,
                                      produk.diskon_produk,
                                      produk.berat_produk
                                      FROM
                                      orders_detail
                                      INNER JOIN produk ON produk.id = orders_detail.id_produk
                                      WHERE
                                      orders_detail.id_orders ='".$_GET['id']."'");
      
           while ($d=mysql_fetch_array($daftarproduk)){
            $subtotal = $d['harga_produk'] * $d['jumlah']; 
            $harga     = format_rupiah($d['harga_produk']);
            $disc      = ($d['diskon_produk']/100)*$d['harga_produk'];
            $hargadisc = number_format(($d['harga_produk']-$disc),0,",",".");
            $total       = $total + $subtotal; 
            $subtotalberat = $d['berat_produk'] * $d['jumlah'];
            $totalberat  = $totalberat + $subtotalberat; // dalam gram
            $beratkg = $totalberat/1000;
    
      $content.="<tr bgcolor='#FFFFFF'>
                <td>".$d['nama_produk']."</td>
                <td align='center'>".$d['jumlah']."</td>
                <td align='center'>".$harga."</td>
                <td align=center >".format_rupiah($subtotal)."</td>
          </tr>"; 
  
    }
$id_kota= $r['kabupaten_id_kustomer'];
$ekspedisi = $r['id_ekspedisi'];
// var_dump($id_kota);exit;
$ongkir = mysql_query("SELECT ongkos FROM ongkos_kirim WHERE kabupaten_id = '".$id_kota."' AND ekspedisi_id = '".$ekspedisi."'");
$o=mysql_fetch_array($ongkir);
$ongkos = $o['ongkos'] * $beratkg;
$totalbiaya=$total + $ongkos; 
$content.="<tr bgcolor=#6da6b1><td colspan='4'></td></tr>";
$content.="<tr><td colspan=3 align=right>Total berat : Rp. </td><td align=right><b>".$beratkg."(kg)</b></td></tr>
      <tr><td colspan=3 align=right>Ongkos Kirim untuk Tujuan Kota Anda: Rp. </td><td align=right><b>".format_rupiah($ongkos)."</b></td></tr>         
      <tr><td colspan=3 align=right>Grand Total : Rp. </td><td align=right><b>".format_rupiah($totalbiaya)."</b></td></tr>";           
  $content.="</table><br><hr>";
  $content.= "* Silahkan melakukan pembayaran sesuai jumlah nominal yang ada pada nota invoice diatas.<br>
              * Jika dalam waktu maksimal 3 hari anda belum melakukan pembayaran, Order akan otomatis <b>Batal</b> <br />
              * Setelah anda melakukan pembayaran, silahkan melakukan konfirmasi pembayaran melalui halaman member-riwayat belanja- pilih order yang sudah anda bayar dan klik <b>Bayar Sekarang</b><br/><hr>";
  $content.="Anda dapat melakukan pembayaran ke rekening dibawah ini:<br><br>";


  $daftarbank = mysql_query("SELECT * FROM bank");
  while($b=mysql_fetch_array($daftarbank)){
  $content.="
      <table>
          <tr><td>Nama Bank</td><td>:</td><td>".$b['nama_bank']."</td></tr>
          <tr><td>A/n Pemilik</td><td>:</td><td>".$b['nama_pemilik']."</td></tr>
          <tr><td>No.Rekening</td><td>:</td><td>".$b['rek_bank']."</td></tr>
      </table>";
}
             
  ob_end_clean();
  // conversion HTML => PDF
  $filename="INVOICE#".$idorder.".pdf"; 
  try
  {
    $html2pdf = new HTML2PDF('P', 'A4','en', 'false', 'ISO-8859-15',array(5, 10, 5, 2)); 
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
  }
  catch(HTML2PDF_exception $e) { echo $e; }
?>