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
$sql=mysql_query("SELECT * FROM kustomer WHERE email_kustomer = '".$_SESSION['email']."'");
$d=mysql_fetch_array($sql);
?> 

  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
        <div class="col-main">
          <div class="page-title">
            <h2>Edit Data Pribadi</h2>
          </div>
          <div class="static-contain">
            <fieldset class="group-select">
              <form action="<?php echo BASE_URL;?>/update" method="post">
                <input type="hidden" name="id" value="<?php echo $d['id'];?>">
                    <ul>
                      <li>
                        <div class="customer-name">
                          <div class="input-box name-firstname">
                            <label for="billing:firstname"> Nama Lengkap<span class="required">*</span></label>
                            <br>
                            <input type="text" name="nama_kustomer"  class="input-text" value="<?php echo $d['nama_kustomer'];?>" required>
                          </div>
                          <div class="input-box name-lastname">
                            <label for="billing:lastname"> Email  <span class="required">(email tidak bisa diubah)</span> </label>
                            <br>
                            <input type="email" name="email_kustomer"  class="input-text" value="<?php echo $d['email_kustomer'];?>" readonly>
                          </div>
                        </div>
                      </li>
                      <li class="">
                        <label for="comment">Alamat Lengkap<em class="required">*</em></label>
                        <br>
                        <div style="float:none" class="">
                          <textarea name="alamat_kustomer" class="required-entry input-text" cols="5" rows="3" required><?php echo $d['alamat_kustomer'];?></textarea>
                        </div>
                      </li>
                      <li>
                        <div class="input-box">
                          <label for="billing:company">Provinsi <span class="required">*</span></label>
                          <br>
                          <select name="provinsi_id_kustomer" class="input-text select2" style="width: 100%;" id="provinsi_id" required>
                              <option>pilih</option>
                              <?php
                                $sql=mysql_query("SELECT * FROM provinsi ORDER BY nama_provinsi DESC");
                                while($p=mysql_fetch_array($sql)){
                              ?>
                              <option value="<?php echo $p['id'];?>" <?php if($p['id'] == $d['provinsi_id_kustomer'] ){ echo "selected"; }?>><?php echo $p['nama_provinsi'];?></option>
                              <?php } ?>
                          </select>
                        </div>
                      </li>
                      <li>
                        <div class="input-box">
                          <label for="billing:company">Kabupaten <span class="required">*</span></label>
                          <br>
                          <select name="kabupaten_id_kustomer" class="input-text select2" style="width: 100%;" id="kabupaten_id" required>
                              <option>pilih</option>
                              <?php
                                $sql=mysql_query("SELECT * FROM kabupaten ORDER BY nama_kabupaten DESC");
                                while($k=mysql_fetch_array($sql)){
                              ?>
                              <option value="<?php echo $k['id'];?>" <?php if($k['id'] == $d['kabupaten_id_kustomer'] ){ echo "selected"; }?>><?php echo $k['nama_kabupaten'];?></option>
                              <?php } ?>
                          </select>
                        </div>
                      </li>
                      <li>
                        <div class="input-box">
                          <label for="billing:company">Kodepos</label>
                          <br>
                          <input type="text"  name="kodepos_kustomer"  class="input-text" value="<?php echo $d['kodepos_kustomer'];?>" required>
                        </div>
                      </li>
                    </ul>
                <div class="buttons-set">
                  <button type="submit" title="Submit" class="button"> <span> Submit </span> </button>
                  &nbsp;<button type="button" title="Back" class="button" onclick="window.location.href='<?php echo BASE_URL;?>/akun'"> <span> Kembali </span> </button>
                </div>
              </form>
                </fieldset>
          </div></div>
        </section>
      </div>
    </div>
  </div>
  <?php } ?>