<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header with-border">
  <h3 class="box-title">Ganti Password</h3>
</div>
<?php include "../config/status.php"; ?>
<form action="?modul=aksipassword&act=edit" method="post" enctype="multipart/form-data" class="form-horizontal">
  <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" name="password">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Verifikasi Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" name="password_verifikasi">
                </div>
              </div>
            </div>
        </div>
      </div>
    <div class="box-footer text-center">
      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i>Simpan</button>
    </div>
  </div>
</form> 
<?php } ?>