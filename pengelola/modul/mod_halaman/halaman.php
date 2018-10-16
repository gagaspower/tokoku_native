<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header">
<h3 class="box-title">Halaman</h3>
</div>
<button type="button" class="btn btn-info" onclick="window.location.href='?modul=tambahhalaman'">
<i class="fa fa-plus-square"></i> Tambah</button><br><br>
<?php include "../config/status.php";?>   
<div class="box">
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
            <th>ID.</th>
            <th>Judul</th>
            <th>Slug</th>
            <th>Link</th>
            <th></th>
      </tr>
      </thead>
      <tbody>
    <?php
    $sql = mysql_query("SELECT * FROM halamanstatis ORDER BY id DESC");
    while($r = mysql_fetch_array($sql)){
    ?>
    <tr>
    <td><?php echo $r['id'];?></td>
    <td><?php echo $r['judul'];?></td>
    <td><?php echo $r['judul_seo'];?></td>
    <td>halaman-<?php echo $r['id'];?>-<?php echo $r['judul_seo'];?>.html</td>
    <td>
        <button type="button" class="btn btn-xs btn-info" title="Edit Kategori" onclick="window.location.href='?modul=edithalaman&id=<?php echo $r['id'];?>'"><i class="fa fa-pencil-square-o"></i></button>
        <button type="button" class="btn btn-xs btn-danger" title="Hapus Kategori" onclick="window.location.href='?modul=aksihalaman&act=hapus&id=<?php echo $r['id'];?>'"><i class="fa fa-trash"></i></button>
    </td>
      </tr>
      <?php  } ?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>
