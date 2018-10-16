<?php
error_reporting(0);
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1){
    echo"<meta http-equiv='refresh' content='0; url=http://'".$_SERVER['HTTP_HOST']."'>"; 
    exit("Direct access not permitted.");
}

?>
<div class="row">
<div class="container" style="margin-top: 20px;">
<div class="col-xs-12 col-md-9">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-phone"></i> HUBUNGI KAMI</h3>
    </div>
    <div class="panel-body">
      <form class="form-horizontal" action="<?php echo BASE_URL;?>/kirim" method="post">
        <div class="form-group">
          <label for="comment_author" class="col-sm-3 control-label">Nama <span style="color: red">*</span></label>
          <div class="col-sm-9">
            <input type="text" class="form-control input-sm" id="comment_author" name="nama" required>
          </div>
        </div>
        <div class="form-group">
          <label for="comment_email" class="col-sm-3 control-label">Email <span style="color: red">*</span></label>
          <div class="col-sm-9">
            <input type="text" class="form-control input-sm" id="comment_email" name="email" required>
          </div>
        </div>
        <div class="form-group">
          <label for="comment_email" class="col-sm-3 control-label">Subjek</label>
          <div class="col-sm-9">
            <input type="text" class="form-control input-sm" id="comment_subject" name="subjek">
          </div>
        </div>
        <div class="form-group">
          <label for="comment_content" class="col-sm-3 control-label">Pesan <span style="color: red">*</span></label>
          <div class="col-sm-9">
            <textarea rows="5" class="form-control input-sm" id="comment_content" name="pesan" required></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label"></label>
          <div class="col-sm-9">
            <img src="captcha.php"/>
          </div>
        </div>
        <div class="form-group">
          <label for="comment_email" class="col-sm-3 control-label">Captcha <span style="color: red">*</span></label>
          <div class="col-sm-9">
            <input type="text" class="form-control input-sm" id="comment_captcha" name="captcha" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> KIRIM</button>
          </div>
        </div>
      </form>
    </div>
  </div>
 
</div>
<!-- SIDEBAR  -->
<?php include "sidebar.php"; ?>
<!-- SIDEBAR END -->