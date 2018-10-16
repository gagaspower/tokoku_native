  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
        <div class="col-main">
          <div class="page-title">
            <h2>Hubungi Kami</h2>
          </div>
          <div class="static-contain">
            <fieldset class="group-select">
              <form action="<?php echo BASE_URL;?>/kirim-hubungi" method="POST">
                    <ul>
                      <li>
                        <div class="customer-name">
                          <div class="input-box name-firstname">
                            <label for="billing:firstname"> Nama<span class="required">*</span></label>
                            <br>
                            <input type="text" name="nama" value="" class="input-text " required>
                          </div>
                          <div class="input-box name-lastname">
                            <label for="billing:lastname"> Email  <span class="required">*</span> </label>
                            <br>
                            <input type="email" name="email" value="" class="input-text" required>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="input-box">
                          <label for="billing:company">Subjek</label>
                          <br>
                          <input type="text"  name="subjek" value="" class="input-text">
                        </div>
                      </li>
                      <li class="">
                        <label for="comment"> Pesan<em class="required">*</em></label>
                        <br>
                        <div style="float:none" class="">
                          <textarea name="pesan" class="required-entry input-text" cols="5" rows="3" required></textarea>
                        </div>
                      </li>
                      <li>
                        <div class="input-box">
                            <img src="captcha.php"/>
                        </div>
                      </li>
                      <li>
                        <div class="input-box">
                          <label for="billing:company">Captcha <span class="required">*</span></label>
                          <br>
                          <input type="text"  name="captcha" value="" class="input-text" required>
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