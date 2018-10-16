<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header with-border">
  <h3 class="box-title">Tambah Kabupaten</h3>
</div>
<form action="?modul=aksikabupaten&act=simpan" method="post" enctype="multipart/form-data" class="form-horizontal">
  <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Nama Kabupaten</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="nama_kabupaten" required="required">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Provinsi</label>
                <div class="col-sm-8">
                <select class="form-control select2" style="width: 100%; height: 34px;" name="provinsi_id">
                  <option value="0">pilih</option>
                  <?php
                  $sql=mysql_query("SELECT * FROM provinsi ORDER BY nama_provinsi DESC");
                  while($p=mysql_fetch_array($sql)){
                  ?>
                  <option value="<?php echo $p['id'];?>"><?php echo $p['nama_provinsi'];?></option>
                  <?php } ?>
                </select>
              </div>
              </div>
             </div>
        </div>
      </div>
    <div class="box-footer text-center">
      <button type="button" class="btn btn-default" onclick="window.location.href='?modul=kabupaten'"><i class="fa fa-arrow-circle-left "></i> Kembali</button>
      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>
</form> 
<?php } ?>