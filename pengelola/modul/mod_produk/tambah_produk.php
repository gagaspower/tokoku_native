<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header with-border">
  <h3 class="box-title">Tambah Produk</h3>
</div>
<form action="?modul=aksiproduk&act=simpan" enctype="multipart/form-data" method="post">
  <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" required="required" id="nama">
              </div>
              <div class="form-group">
                <label>Harga Produk</label>
                <input type="number" name="harga_produk" class="form-control" required="required" id="harga" min="0">
              </div>
              <div class="form-group">
                <label>Stok Produk</label>
                <input type="number" name="stok_produk" class="form-control" required="required" id="stok" min="0">
              </div>
              <div class="form-group">
                <label>Berat Produk</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      gr
                    </div>
                    <input type="number" name="berat_produk" class="form-control" required="required" id="berat" min="0">
                  </div>
              </div>
              <div class="form-group">
                <label>Diskon Produk</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-percent"></i>
                    </div>
                    <input type="number" name="diskon_produk" class="form-control"  id="diskon" min="0">
                  </div>
              </div>
              <div class="form-group">
                <label>Detail Produk</label>
                <textarea id="loko" name="deskripsi_produk"></textarea>
              </div>
            </div>


          <div class="col-md-3">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Kategori</h3>
            </div>
              <div class="form-group">
                  <select name="kategori_id" class="form-control select2" required>
                    <option value="0">Pilih</option>
                   <?php
                    $sql1 = mysql_query("SELECT * FROM kategori");
                    while($r=mysql_fetch_array($sql1)){ ?>
                      <option value="<?php echo $r['id'];?>"><?php echo $r['nama_kategori'];?></option>
                  <?php } ?>                   
                  </select>
              </div>
          </div>
           <br>
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Tag</h3>
            </div>
              <div class="form-group">
                <input type="text" class="form-control" name="tag_produk" id="input-tags">
              </div>
          </div>
           <br>
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Deskripsi SEO Produk</h3>
            </div>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="deskripsi_seo_produk"></textarea>
              </div>
          </div>
          <br>
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Featured Image</h3>
            </div>
              <div class="form-group">
                <input type="file" class="form-control" name="fupload" >
              </div>
          </div>
        </div>
      </div>
    <div class="box-footer text-center">
      <button type="button" class="btn btn-default" onclick="window.location.href='?modul=produk'"><i class="fa fa-arrow-circle-left "></i> Kembali</button>
      <button type="submit" class="btn btn-info" id="simpan"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>
</form> 
<?php } ?>