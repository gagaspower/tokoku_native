<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header">
<h3 class="box-title">Produk</h3>
</div>
<button type="button" class="btn btn-info" onclick="window.location.href='?modul=tambahproduk'">
<i class="fa fa-plus-square"></i> Tambah</button><br><br>
<?php include "../config/status.php";?>   
<div class="box">
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
            <th>Nama Produk</th>
            <th>Stok Produk</th>
            <th>Harga Produk</th>
            <th>Tanggal</th>
            <th></th>
      </tr>
      </thead>
      <tbody>
    <?php
    if($_SESSION['level'] == '1'){
    $sql = mysql_query("SELECT * FROM produk ORDER BY id DESC");
    }else{
    $sql = mysql_query("SELECT * FROM produk WHERE user_id = '".$_SESSION['id_user']."' ORDER BY id DESC");      
    }
    while($r = mysql_fetch_array($sql)){
    ?>
    <tr>
    <td><?php echo $r['nama_produk'];?></td>
    <td><?php echo $r['stok_produk'];?></td>
    <td><?php echo format_rupiah($r['harga_produk']);?></td>
    <td><?php echo tgl_indo($r['tanggal']);?></td>
    <td>
        <button type="button" class="btn btn-xs btn-info" title="Edit <?php echo $r['nama_produk'];?>" onclick="window.location.href='?modul=editproduk&id=<?php echo $r['id'];?>'"><i class="fa fa-pencil-square-o"></i></button>
        <button type="button" class="btn btn-xs btn-danger" title="Hapus <?php echo $r['nama_produk'];?>" onclick="window.location.href='?modul=aksiproduk&act=hapus&id=<?php echo $r['id'];?>'"><i class="fa fa-trash"></i></button>
        <?php
          $n=mysql_num_rows(mysql_query("SELECT * FROM subscribe"));
          if($n > 0){
        ?>
        <button type="button" class="btn btn-xs btn-warning" title="Subscribe" onclick="window.location.href='?modul=aksiproduk&act=subscribe&id=<?php echo $r['id'];?>'"><i class="fa fa-send"></i> News Letter</button>
        <?php } else { echo ""; } ?>
    </td>
      </tr>
      <?php  } ?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>