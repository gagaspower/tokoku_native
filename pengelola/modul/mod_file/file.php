<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header">
<h3 class="box-title">File Download</h3>
</div>
<button type="button" class="btn btn-info" onclick="window.location.href='?modul=tambahfile'">
<i class="fa fa-plus-square"></i> Tambah</button><br><br>
<?php include "../config/status.php";?>
<div class="box">
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
			<th>No.</th>
			<th>Nama File </th>
      <th>File</th>
			<th>Hits</th>
      <th>Tgl.Upload</th>
      <th></th>
      </tr>
      </thead>
      <tbody>
	<?php
	$sql = mysql_query("SELECT * FROM download ORDER BY id DESC");
	$no=1;
	while($r = mysql_fetch_array($sql)){
	?>
    <tr>
		<td><?php echo $no;?></td>
		<td><?php echo $r['judul'];?></td>
    <td><?php echo $r['nama_file'];?></td>
    <td><?php echo $r['hits'];?></td>
    <td><?php echo tgl_indo($r['tgl_posting']);?></td>
      <td>
          <button type="button" class="btn btn-xs btn-info" title="Edit File" onclick="window.location.href='?modul=editfile&id=<?php echo $r['id'];?>'"><i class="fa fa-pencil-square-o"></i></button>
          <button type="button" class="btn btn-xs btn-danger" title="Hapus File" onclick="window.location.href='?modul=aksifile&act=hapus&id=<?php echo $r['id'];?>'"><i class="fa fa-trash"></i></button>
	  </td>
      </tr>
      <?php $no++; } ?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>

