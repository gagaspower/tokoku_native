<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header">
<h3 class="box-title">Grup Pengguna</h3>
</div>
<button type="button" class="btn btn-info" onclick="window.location.href='?modul=tambahgrup'">
<i class="fa fa-plus-square"></i> Tambah</button><br><br>
<?php include "../config/status.php";?>
<div class="box">
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
			<th>No.</th>
			<th>Level </th>
			<th>Aksi</th>
      </tr>
      </thead>
      <tbody>
	<?php
	$sql = mysql_query("SELECT * FROM levels ORDER BY id DESC");
	$no=1;
	while($r = mysql_fetch_array($sql)){
	?>
    <tr>
		<td><?php echo $no;?></td>
		<td><?php echo $r['nama_level'];?></td>
      <td>
          <button type="button" class="btn btn-xs btn-info" title="Edit User" onclick="window.location.href='?modul=editgrup&id=<?php echo $r['id'];?>'"><i class="fa fa-pencil-square-o"></i></button>
          <button type="button" class="btn btn-xs btn-danger" title="Hapus User" onclick="window.location.href='?modul=aksigrup&act=hapus&id=<?php echo $r['id'];?>'"><i class="fa fa-trash"></i></button>
	  </td>
      </tr>
      <?php $no++; } ?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>