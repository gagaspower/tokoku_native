<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header with-border">
  <h3 class="box-title">Edit Halaman</h3>
</div>
<?php
$sql = mysql_query("SELECT * FROM halamanstatis WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
$r = mysql_fetch_array($sql);
?>
<form action="?modul=aksihalaman&act=edit" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $r['id'];?>">
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="<?php echo $r['judul'];?>">
              </div>
              <div class="form-group">
                <label>Konten</label>
                <textarea id="loko" name="isi_halaman"><?php echo $r['isi_halaman'];?></textarea>
              </div>
            </div>
      </div>
    <div class="box-footer text-center">
      <button type="button" class="btn btn-default" onclick="window.location.href='?modul=halaman'"><i class="fa fa-arrow-circle-left "></i> Kembali</button>
      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>
</div>
</form> 
<?php } ?>