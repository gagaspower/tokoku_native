<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header">
<h3 class="box-title">Artikel</h3>
</div>
<button type="button" class="btn btn-info" onclick="window.location.href='?modul=tambahartikel'">
<i class="fa fa-plus-square"></i> Tambah</button><br><br>
<?php include "../config/status.php";?>   
<div class="box">
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
            <th>No.</th>
            <th>Judul</th>
            <th>Slug</th>
            <th>Tanggal</th>
            <th></th>
      </tr>
      </thead>
      <tbody>
    <?php
    if($_SESSION['level'] == '1'){
    $sql = mysql_query("SELECT * FROM berita ORDER BY id DESC");
    }else{
    $sql = mysql_query("SELECT * FROM berita WHERE user_id = '".$_SESSION['id_user']."' ORDER BY id DESC");      
    }
    $no=1;
    while($r = mysql_fetch_array($sql)){
    ?>
    <tr>
    <td><?php echo $no;?></td>
    <td><?php echo $r['judul'];?></td>
    <td><?php echo $r['judul_seo'];?></td>
    <td><?php echo tgl_indo($r['tanggal']);?></td>
    <td>
        <button type="button" class="btn btn-xs btn-info" title="Edit Artikel" onclick="window.location.href='?modul=editartikel&id=<?php echo $r['id'];?>'"><i class="fa fa-pencil-square-o"></i></button>
        <button type="button" class="btn btn-xs btn-danger" title="Hapus Artikel" onclick="window.location.href='?modul=aksiartikel&act=hapus&id=<?php echo $r['id'];?>'"><i class="fa fa-trash"></i></button>
        <?php
          $n=mysql_num_rows(mysql_query("SELECT * FROM subscribe"));
          if($n > 0){
        ?>
        <button type="button" class="btn btn-xs btn-warning" title="Subscribe" onclick="window.location.href='?modul=aksiartikel&act=subscribe&id=<?php echo $r['id'];?>'"><i class="fa fa-send"></i> News Letter</button>
        <?php } else { echo ""; } ?>
    </td>
      </tr>
      <?php $no++; } ?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>