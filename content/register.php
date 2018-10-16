  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
        <div class="col-main">
          <div class="page-title">
            <h2>Daftar Pelanggan Baru</h2>
          </div>
          <div class="static-contain">
            <fieldset class="group-select">
              <form action="?module=aksidaftar" method="POST">
                    <ul>
                      <li>
                        <div class="customer-name">
                          <div class="input-box name-firstname">
                            <label for="billing:firstname"> Nama Lengkap<span class="required">*</span></label>
                            <br>
                            <input type="text" name="nama_kustomer" value="" class="input-text " required>
                          </div>
                          <div class="input-box name-lastname">
                            <label for="billing:lastname"> Email  <span class="required">*</span> </label>
                            <br>
                            <input type="email" name="email_kustomer" value="" class="input-text" required>
                          </div>
                        </div>
                      </li>
                      <li class="">
                        <label for="comment">Alamat Lengkap<em class="required">*</em></label>
                        <br>
                        <div style="float:none" class="">
                          <textarea name="alamat_kustomer" class="required-entry input-text" cols="5" rows="3" required></textarea>
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
                              <option value="<?php echo $p['id'];?>"><?php echo $p['nama_provinsi'];?></option>
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
                          </select>
                        </div>
                      </li>
                      <li>
                        <div class="input-box">
                          <label for="billing:company">Kodepos</label>
                          <br>
                          <input type="text"  name="kodepos_kustomer" value="" class="input-text" required>
                        </div>
                      </li>
                      <li>
                        <div class="input-box">
                          <label for="billing:company">Password</label>
                          <br>
                          <input type="password"  name="password" value="" class="input-text" required>
                        </div>
                      </li>
                    </ul>
                <div class="buttons-set">
                  <button type="submit" title="Submit" class="button submit"> <span> Submit </span> </button>
                </div>
              </form>
                </fieldset>
          </div></div>
        </section>
      </div>
    </div>
  </div>