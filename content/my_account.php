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
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1){echo"<meta http-equiv='refresh' content='0; url=http://'".$_SERVER['HTTP_HOST']."'>"; exit("Direct access not permitted.");}
?>
<div class="main-container col2-right-layout">
    <div class="main container">
  <?php 
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
                            WHERE kustomer.email_kustomer='".$_SESSION['email']."'");
    $p=mysql_fetch_array($sql);
  ?>
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
        <div class="col-main">
          <div class="page-title">
            <h1>My Account</h1>
          </div>
          <ol class="one-page-checkout" id="checkoutSteps">
            <li id="opc-billing" class="section allow active">
              <div class="step-title"> <span class="number">1</span>
                <h3>Informasi Umum</h3>
                <button  type="button" class="button login pull-right" onclick="window.location.href='<?php echo BASE_URL;?>/editakun'"><span>Edit</span></button> 
                <!-- <a href="#" id="<?php echo $p['id'];?>" class="edit_kustomer label label-info pull-right"><i class="fa fa-eye"></i> Edit</a> --><br>
              </div>
              <div id="checkout-step-billing" class="step a-item" style="">
                <table class="table">
                  <tr><td>Nama :</td><td><?php echo $p['nama_kustomer'];?></td></tr>
                  <tr><td>Email :</td><td><?php echo $p['email_kustomer'];?></td></tr>
                  <tr><td>Alamat :</td><td><?php echo $p['alamat_kustomer'];?></td></tr>
                  <tr><td>Provinsi:</td><td><?php echo $p['nama_provinsi'];?></td></tr>
                  <tr><td>Kabupaten:</td><td><?php echo $p['nama_kabupaten'];?></td></tr>
                  <tr><td>Kodepos:</td><td><?php echo $p['kodepos_kustomer'];?></td></tr>
                </table>
              </div>
            </li>
            <li id="opc-billing" class="section allow active">
              <div class="step-title"> <span class="number">2</span>
                <h3>Ganti Password</h3> 
              </div>
              <div id="checkout-step-billing" class="step a-item" style="">
                  <form action="<?php echo BASE_URL;?>/gantipassword" method="post">
                  <ul>
                    <li>
                      <label for="email">Password <span class="required">*</span></label>
                      <br>
                      <input type="password" title="Email" class="input-text required-entry" id="email" value="" name="password" style="width: 70%" required="required">
                    </li>
                    <li>
                      <label for="pass">Ulangi Password <span class="required">*</span></label>
                      <br>
                      <input type="password" title="Password" id="pass" class="input-text required-entry" name="ulangi_password" style="width: 70%" required="required">
                    </li>
                  </ul>
                  <p class="required">* Required Fields</p>
                  <div class="buttons-set">
                    <button id="send2" type="submit" class="button login"><span>Update</span></button>
                 </div>
               </form>
              </div>
            </li>

            <li id="opc-billing" class="section allow active">
              <div class="step-title"> <span class="number">3</span>
                <h3>Riwayat Order</h3> 
              </div>
              <div id="checkout-step-billing" class="step a-item" style="">
                  <table class="table">
                    <thead>
                      <tr>
                        <td>No.Order</td>
                        <td>Tgl & Jam Order</td>
                        <td>Status Order</td>
                        <td>Aksi</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $sql5=mysql_query("SELECT * FROM orders WHERE id_kustomer='".$_SESSION['id_user']."' ORDER BY id DESC");
                        while($o=mysql_fetch_array($sql5)){
                      ?>
                      <tr>
                          <td><?php echo $o['id'];?></td>
                          <td><?php echo tgl_indo($o['tgl_order']);?> / <?php echo $o['jam_order'];?></td>
                          <td><?php echo $o['status_order'];?></td>
                          <td>
                            <button type="button" title="Detail" class="button view_detail" id="<?php echo $o['id'];?>"> 
                              <i class="fa fa-eye"></i><span> Detail </span> 
                            </button>
                            <button type="button" title="Print" class="button print_order" onclick="window.open('cetak.php?id=<?php echo $o['id']; ?>')"> 
                              <i class="fa fa-print"></i><span> Cetak </span> 
                            </button>
                            <button type="button" title="Bayar" class="button print_order" onclick="window.location.href='<?php echo BASE_URL;?>/konfirmasi/<?php echo $o['id'];?>'"> 
                              <i class="fa fa-money"></i><span> Bayar Sekarang </span> 
                            </button>
                          </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
              </div>
            </li>
          </ol>
        </div>
        </section>
      </div>
    </div>
  </div>

  <div class="modal fade" id="orders_data" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
<!--       <div class="modal-header">
        <h4 class="modal-title">Edit Data Pribadi</h4>
      </div> -->
      <div class="modal-body">
        <div id="orderdetails"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>