<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header with-border">
  <h3 class="box-title">Konfigurasi Mailer</h3>
</div>
<?php
$sql = mysql_query("SELECT * FROM phpmailer_seting LIMIT 1");
$r = mysql_fetch_array($sql);
?>
<?php include "../config/status.php"; ?>
<form action="?modul=aksimailer&act=update" method="post" enctype="multipart/form-data" class="form-horizontal">
<input type="hidden" name="id" value="<?php echo $r['id'];?>">
  <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Host/Server</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="host" value="<?php echo $r['host'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Username</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="username" value="<?php echo $r['username'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="password" value="<?php echo $r['password'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Port</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="port" value="<?php echo $r['port'];?>">
                </div>
              </div>
            </div>
        </div>
      </div>
    <div class="box-footer text-center">
      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>
</form> 
<?php } ?>