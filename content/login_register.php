  <section class="main-container col1-layout">
    <div class="main container">
      <div class="product-shop col-lg-9 col-sm-9 col-xs-9">
          <div class="account-login">
            <div class="page-title">
              <h2>Login Register Akun</h2>
            </div>
            <fieldset class="col2-set">
              <div class="col-1 new-users"><strong>Pelanggan baru?</strong>
                <div class="content">
                  <p>Siahkan klik tombol dibawah untuk mulai mendaftar akun baru dan lengkapi data diri anda.</p>
                  <div class="buttons-set">
                    <button onclick="window.location='<?php echo BASE_URL;?>/daftar'" class="button create-account" type="button"><span>Create an Account</span></button>
                  </div>
                </div>
              </div>
              <div class="col-2 registered-users"><strong>Login</strong>
                <div class="content">
                  <p>Sudah punya akun ? silahkan login.</p>
                  <form action="<?php echo BASE_URL;?>/login_verifikasi" method="post">
                  <ul class="form-list">
                    <li>
                      <label for="email">Email <span class="required">*</span></label>
                      <br>
                      <input type="email" title="Email" class="input-text required-entry" id="email" value="" name="email">
                    </li>
                    <li>
                      <label for="pass">Password <span class="required">*</span></label>
                      <br>
                      <input type="password" title="Password" id="pass" class="input-text required-entry" name="password">
                    </li>
                  </ul>
                  <p class="required">* Required Fields</p>
                  <div class="buttons-set">
                    <button id="send2" type="submit" class="button login"><span>Login</span></button>
                 </div>
               </form>
                </div>
              </div>
            </fieldset>
          </div>
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>
  </section>