<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header with-border">
  <h3 class="box-title">Balas Pesan</h3>
</div>
<?php
$sql = mysql_query("SELECT * FROM pesan WHERE id = '".$val->validasi($_GET['id'],'sql')."'");
$r = mysql_fetch_array($sql);
?>
<form action="?modul=aksipesan&act=balas" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $r['id'];?>">
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $r['nama'];?>" readonly>
              </div>
              <div class="form-group">
                <label>Ke:</label>
                <input type="text" name="email" class="form-control" value="<?php echo $r['email'];?>" readonly>
              </div>
              <div class="form-group">
                <label>Subjek:</label>
                <input type="text" name="subjek" class="form-control" value="Re: <?php echo $r['subjek'];?>" readonly>
              </div>
              <div class="form-group">
                <label>Pesan</label>
                <textarea class="form-control" readonly=""><?php echo $r['pesan'];?></textarea>
              </div>
              <div class="form-group">
                <label>Balasan</label>
                <textarea id="loko" name="pesan_balas"></textarea>
              </div>
            </div>
      </div>
    <div class="box-footer text-center">
      <button type="button" class="btn btn-default" onclick="window.location.href='?modul=pesan'"><i class="fa fa-arrow-circle-left "></i> Kembali</button>
      <button type="submit" class="btn btn-info"><i class="fa fa-paper-plane-o"></i> Balas</button>
    </div>
  </div>
</div>
</form> 
<?php } ?>