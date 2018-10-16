<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header with-border">
  <h3 class="box-title">Edit Ekspedisi Pengiriman</h3>
</div>
<?php
$sql=mysql_query("SELECT * FROM ekspedisi WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
$r=mysql_fetch_array($sql);
?>
<form action="?modul=aksiekspedisi&act=edit" method="post" enctype="multipart/form-data" class="form-horizontal">
  <input type="hidden" name="id" value="<?php echo $r['id'];?>">
  <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Nama Ekspedisi</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="nama_ekspedisi" required="required" value="<?php echo $r['nama_ekspedisi'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Logo Lama</label>
                <div class="col-sm-8">
                    <?php if($r['logo_ekspedisi'] != null ){ ?>
                    <img src="../template/upload/featured_ekspedisi/small_<?php echo $r['logo_ekspedisi'];?>">
                    <?php } else { echo "Tidak ada logo"; } ?>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Logo Ekspedisi</label>
                <div class="col-sm-8">
                  <input type="file" class="form-control" name="fupload" >
                </div>
              </div>
             </div>
        </div>
      </div>
    <div class="box-footer text-center">
      <button type="button" class="btn btn-default" onclick="window.location.href='?modul=ekspedisi'"><i class="fa fa-arrow-circle-left "></i> Kembali</button>
      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>
</form> 
<?php } ?>