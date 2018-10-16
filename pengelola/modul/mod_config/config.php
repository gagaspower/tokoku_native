<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header with-border">
  <h3 class="box-title">Pengaturan</h3>
</div>
<?php
$sql = mysql_query("SELECT * FROM identitas LIMIT 1");
$r = mysql_fetch_array($sql);
?>
<?php include "../config/status.php"; ?>
<form action="?modul=aksipengaturan&act=update" method="post" enctype="multipart/form-data" class="form-horizontal">
<input type="hidden" name="id" value="<?php echo $r['id'];?>">
  <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Nama Website</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="nama_website" value="<?php echo $r['nama_website'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">URL Website</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="url_website" value="<?php echo $r['url_website'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Meta Keyword</label>
                <div class="col-sm-8">
                  <textarea name="meta_keyword" class="form-control"><?php echo $r['meta_keyword'];?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Meta Deskripsi</label>
                <div class="col-sm-8">
                  <textarea name="meta_deskripsi" class="form-control"><?php echo $r['meta_deskripsi'];?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Logo</label>
                <div class="col-sm-8">
                <?php   if($r['logo'] != ''){
                echo "<img src='../template/upload/website_logo/".$r['logo']."'/>"; 
                } else{

                  echo "Tidak ada logo";
                }
                ?>
              </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Logo Website</label>
                <div class="col-sm-4">
                  <input type="file" class="form-control" name="fupload">
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