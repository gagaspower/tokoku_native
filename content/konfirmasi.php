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
$sql=mysql_query("SELECT
                      orders.id,
                      kustomer.nama_kustomer
                      FROM
                      orders
                      INNER JOIN kustomer ON kustomer.id = orders.id_kustomer
                      WHERE
                      orders.id = '".$_GET['id']."'");
$d=mysql_fetch_array($sql);
?> 

  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
        <div class="col-main">
          <div class="page-title">
            <h2>Konfirmasi Pembayaran</h2>
          </div>
          <div class="static-contain">
            <fieldset class="group-select">
              <form action="<?php echo BASE_URL;?>/bayar" method="post" enctype="multipart/form-data">
                    <ul>
                      <li>
                          <div class="input-box">
                            <label for="billing:firstname"> Invoice</label>
                            <br>
                            <input type="text" name="id_orders"  class="input-text" value="<?php echo $d['id'];?>" readonly="readonly">
                          </div>
                      </li>
                      <li>
                          <div class="input-box">
                            <label for="billing:firstname"> Nama Penyetor</label>
                            <br>
                            <input type="text" name="nama_kustomer"  class="input-text" value="<?php echo $d['nama_kustomer'];?>" readonly="readonly">
                          </div>
                      </li>
                      <li>
                          <div class="input-box">
                            <label for="billing:firstname"> Jumlah Transfer <span class="required">*</span></label>
                            <br>
                            <input type="number" name="nominal"  class="input-text" min="0" required >
                          </div>
                      </li>
                      <li>
                          <div class="input-box">
                            <label for="billing:firstname"> Bank Penyetor <span class="required">*</span></label>
                            <br>
                            <input type="text" name="bank_penyetor"  class="input-text" required>
                          </div>
                      </li>
                      <li>
                        <div class="input-box">
                          <label for="billing:company">Bank Tujuan <span class="required">*</span></label>
                          <br>
                          <select name="id_bank" class="input-text select2" style="width: 100%;" required>
                              <option>pilih</option>
                              <?php
                                $sql=mysql_query("SELECT * FROM bank ORDER BY nama_bank DESC");
                                while($p=mysql_fetch_array($sql)){
                              ?>
                              <option value="<?php echo $p['id'];?>"><?php echo $p['nama_bank'];?></option>
                              <?php } ?>
                          </select>
                        </div>
                      </li>
                      <li>
                        <div class="input-box">
                          <label for="billing:company">Bukti Pembayaran <span class="required">* (.jpg)</span></label>
                          <br>
                          <input type="file"  name="fupload"  class="input-text" required>
                        </div>
                      </li>
                    </ul>
                <div class="buttons-set">
                  <button type="submit" title="Submit" class="button"> <span> Submit </span> </button>
                </div>
              </form>
                </fieldset>
          </div></div>
        </section>
      </div>
    </div>
  </div>
  <?php } ?>