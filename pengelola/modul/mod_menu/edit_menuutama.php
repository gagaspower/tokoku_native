<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header with-border">
  <h3 class="box-title">Edit Menu Website</h3>
</div>
<?php
$sql = mysql_query("SELECT * FROM mainmenu WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
$r = mysql_fetch_array($sql);
?>
<form action="?modul=aksimenumain&act=edit" method="post" enctype="multipart/form-data" class="form-horizontal">
<input type="hidden" name="id" value="<?php echo $r['id'];?>">
  <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Nama Menu</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="nama_menu" value="<?php echo $r['nama_menu'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Link</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="link" value="<?php echo $r['link'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Posisi Menu</label>
                <div class="col-sm-8">
                <?php if($r['posisi'] == 'header'){ ?>
                <label><input type="radio" name="posisi" value="header" class="minimal" checked> Header</label>
                <label><input type="radio" name="posisi" value="footer" class="minimal"> Footer</label>
                <?php } elseif($r['posisi'] == 'footer'){ ?>
                <label><input type="radio" name="posisi" value="header" class="minimal" > Header</label>
                <label><input type="radio" name="posisi" value="footer" class="minimal" checked> Footer</label>
                <?php }else { ?>
                <label><input type="radio" name="posisi" value="header" class="minimal" > Header</label>
                <label><input type="radio" name="posisi" value="footer" class="minimal" > Footer</label>
                <?php } ?>
              </div>
              </div>
             </div>
        </div>
      </div>
    <div class="box-footer text-center">
      <button type="button" class="btn btn-default" onclick="window.location.href='?modul=menuutama'"><i class="fa fa-arrow-circle-left "></i> Kembali</button>
      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>
</form> 
<?php } ?>