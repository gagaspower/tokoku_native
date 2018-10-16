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
$sql=mysql_query("SELECT * FROM orders_temp,produk 
WHERE produk.id = orders_temp.id_produk
AND id_session = '".$_SESSION['email']."'");
$cek_data=mysql_num_rows($sql);
if($cek_data < 1){
        echo "<script>
      setTimeout(function () { 
       swal({
                  title: 'alert',
                  text:  'Keranjang belanja masih kosong',
                  type: 'error',
                  timer: 1500,
                  showConfirmButton: false
              });  
       },10); 
       window.setTimeout(function(){ 
        window.location.replace('".BASE_URL."');
       } ,1500);
       </script>";
}else{
?>
<section class="main-container col1-layout">
    <div class="main container">
      <div class="col-main">
        <div class="product-shop col-md-9 ">
          <div class="cart wow bounceInUp animated">
            <div class="page-title">
              <h2>Keranjang Belanja</h2>
            </div>
            <form action="<?php echo BASE_URL;?>/selesaibelanja" method="post">
            <div class="input-box">
              <label for="billing:company"><strong>Pilih Ekspedisi</strong> <span class="required">*</span></label>
              <br>
              <?php 
                  $sql_kab = mysql_query("SELECT * FROM kustomer WHERE email_kustomer = '".$_SESSION['email']."'");
                  $kab=mysql_fetch_array($sql_kab);
              ?>
              <select name="ekspedisi_id" class="input-text" style="width: 100%;">
                  <option value="">pilih</option>
                  <?php

                  $sql_ekspedisi=mysql_query("SELECT
                                  ekspedisi.nama_ekspedisi,
                                  ekspedisi.id
                                  FROM
                                  ekspedisi
                                  LEFT JOIN ongkos_kirim ON ekspedisi.id = ongkos_kirim.ekspedisi_id
                                  WHERE
                                  ongkos_kirim.kabupaten_id ='".$kab['kabupaten_id_kustomer']."'");
                  while($k=mysql_fetch_array($sql_ekspedisi)){
                  ?>
                  <option value="<?php echo $k['id'];?>" ><?php echo $k['nama_ekspedisi'];?></option>
                  <?php } ?>
              </select>
            </div>
            <div class="table-responsive">
                <fieldset>
                  <table class="data-table cart-table" id="shopping-cart-table">
                    <thead>
                      <tr class="first last">
                        <th >Product</th>
                        <th>Unit Price</th>
                        <th >Qty</th>
                        <th >Subtotal</th>
                        <th >&nbsp;</th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php 
                    while($r=mysql_fetch_array($sql)){
                    $subtotal = $r['harga_produk'] * $r['jumlah']; 
                    $harga     = format_rupiah($r['harga_produk']);
                    $disc      = ($r['diskon_produk']/100)*$r['harga_produk'];
                    $hargadisc = number_format(($r['harga_produk']-$disc),0,",",".");
                    $total       = $total + $subtotal; 
                    $subtotalberat = $r['berat_produk'] * $r['jumlah'];
                    $totalberat  = $totalberat + $subtotalberat;
                    $stok_temp  = $r['stok_temp'];
                    ?>
                      <tr>
                        </td>
                        <td>
                            <a title="<?php echo $r['nama_produk'];?>" href="#">
                              <img width="100px" alt="<?php echo $r['nama_produk'];?>" src="<?php echo BASE_URL;?>/template/upload/featured_produk/small_<?php echo $r['gambar_produk'];?>">
                            </a><?php echo $r['nama_produk'];?>
                        </td>
                        <!-- <td class="a-center"><a title="Edit item parameters" class="edit-bnt" href="#configure/id/15945/"></a></td> -->
                        <td><span class="cart-price"> <span class="price">Rp. <?php echo $hargadisc;?></span> </span></td>
                        <td><?php echo $r['jumlah'];?></td>
                        <td ><span class="cart-price"> <span class="price">Rp. <?php echo format_rupiah($subtotal);?> </span> </span></td>
                        <td>
                        <a href="<?php echo BASE_URL;?>/hapuskeranjang/<?php echo $r['id_orders_temp'];?>" id="hapus_keranjang"><button type="button" class="button btn-warning"><i class="fa fa-trash"></i> hapus </button></a>
                        <button type="button" class="button btn-warning updatekeranjang" id="<?php echo $r['id_orders_temp'];?>"><i class="fa fa-check-square-o"></i> ubah jumlah </button>
                        </td>
                      </tr>
                      <?php  } } ?>
                    <tfoot>
                      <tr class="first last">
                        <td class="a-right last" colspan="50">
                          <button class="button btn-continue pull-right" title="Continue Shopping" type="button" onclick="window.location.href='<?php echo BASE_URL;?>'"><span>Continue Shopping</span></button>
                        </td>
                      </tr>
                    </tfoot>
                    </tbody>
                  </table>
                </fieldset>
            </div>
            <!-- BEGIN CART COLLATERALS -->
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
                        <td class="a-right" style=""><span class="price"><?php echo $totalberat;?> (gr)</span></td>
                      </tr>
                      <tr>
                        <td colspan="1" class="a-left" style=""><strong>Grand Total</strong></td>
                        <td class="a-right" style=""><strong><span class="price">Rp. <?php echo format_rupiah($total);?></span></strong></td>
                      </tr>
                    </tfoot>
                  </table>
                  <ul class="checkout">
                    <li>
                      <button class="button btn-continue pull-right" title="Proceed to Checkout" type="submit"><i class="fa fa-sign-out"></i> <span>Selesai Belanja</span></button>
                    </li>
                  </ul>
                </div>
                </div>
              </form>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>


  <div class="modal fade" id="edit_qty">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Jumlah Produk</h4>
      </div>
      <div class="modal-body">
        <div id="qtydetail"></div>
      </div>
<!--       <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>
<?php } ?>