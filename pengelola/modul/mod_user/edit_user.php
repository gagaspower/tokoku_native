<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header with-border">
  <h3 class="box-title">Edit Pengguna</h3>
</div>
<?php
$sql = mysql_query("SELECT * FROM users WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
$r = mysql_fetch_array($sql);
?>
<form action="?modul=aksiuser&act=edit" method="post" enctype="multipart/form-data" class="form-horizontal">
<input type="hidden" name="id" value="<?php echo $r['id'];?>">
  <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Nama Pengguna</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $r['nama_lengkap'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Email Pengguna</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="email" value="<?php echo $r['email'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Grup Pengguna</label>
                <div class="col-sm-5">
                 <select class="form-control select2" style="width: 100%;" name="level_id" required>
                  <option value="0">--pilih level--</option>
                    <?php 
                    $sql = mysql_query("SELECT * FROM levels");
                    while($l = mysql_fetch_array($sql)) { ?>
                    ?>
                    <option value="<?php echo $l['id'];?>" <?php if($l['id'] == $r['level_id'] ) echo "selected"; ?>><?php echo $l['nama_level'];?></option>
                    <?php } ?>
                </select>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" name="password">
                </div>
              </div>

            </div>
        </div>
      </div>
    <div class="box-footer text-center">
      <button type="button" class="btn btn-default" onclick="window.location.href='?modul=user'"><i class="fa fa-arrow-circle-left "></i> Kembali</button>
      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>
</form> 
<?php } ?>