<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header">
<h3 class="box-title">Master Kabupaten</h3>
</div>
<button type="button" class="btn btn-info" onclick="window.location.href='?modul=tambahkabupaten'">
<i class="fa fa-plus-square"></i> Tambah</button><br><br>
<?php include "../config/status.php";?>
<div class="box">
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
			<th>Nama Kabupaten </th>
      <th></th>
      </tr>
      </thead>
      <tbody>
	<?php
	$sql = mysql_query("SELECT * FROM kabupaten ORDER BY id DESC");
	while($r = mysql_fetch_array($sql)){
	?>
    <tr>
		<td><?php echo $r['nama_kabupaten'];?></td>
      <td>
          <button type="button" class="btn btn-xs btn-info" title="Edit Provinsi" onclick="window.location.href='?modul=editkabupaten&id=<?php echo $r['id'];?>'"><i class="fa fa-pencil-square-o"></i></button>
          <button type="button" class="btn btn-xs btn-danger" title="Hapus Provinsi" onclick="window.location.href='?modul=aksikabupaten&act=hapus&id=<?php echo $r['id'];?>'"><i class="fa fa-trash"></i></button>
	  </td>
      </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>
