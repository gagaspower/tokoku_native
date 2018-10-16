<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header">
<h3 class="box-title">Pengguna</h3>
</div>
<button type="button" class="btn btn-info" onclick="window.location.href='?modul=tambahuser'">
<i class="fa fa-plus-square"></i> Tambah</button><br><br>
<?php include "../config/status.php";?>
<div class="box">
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
			<th>No.</th>
			<th>Nama </th>
			<th>Email</th>
			<th>Level</th>
			<th>Status User</th>
			<th></th>
      </tr>
      </thead>
      <tbody>
	<?php
	$sql = mysql_query("SELECT users.id,users.nama_lengkap,users.email,users.blokir,levels.nama_level FROM users INNER JOIN levels ON levels.id = users.level_id ORDER BY users.id DESC");
	$no=1;
	while($r = mysql_fetch_array($sql)){
	?>
    <tr>
		<td><?php echo $no;?></td>
		<td><?php echo $r['nama_lengkap'];?></td>
		<td><?php echo $r['email'];?></td>
		<td><?php echo $r['nama_level'];?></td>
		<td>
			<?php if($r['blokir'] == 'Y'){ ?>
			<span class="label label-warning ">Diblokir</span>
			<?php } else { ?>
			<span class="label label-info">Aktif</span>
			<?php } ?>
		</td>
      <td>
          <button type="button" class="btn btn-xs btn-info" title="Edit User" onclick="window.location.href='?modul=edituser&id=<?php echo $r['id'];?>'"><i class="fa fa-pencil-square-o"></i></button>
          <?php if($r['blokir'] == 'Y') { ?>
          <button type="button" class="btn btn-xs btn-info" title="Aktifkan User" onclick="window.location.href='?modul=aksiuser&act=aktifkan&id=<?php echo $r['id'];?>'"><i class="fa fa-unlock"></i></button>
          <?php }else { ?>
          <button type="button" class="btn btn-xs btn-warning" title="Blokir User" onclick="window.location.href='?modul=aksiuser&act=blokir&id=<?php echo $r['id'];?>'"><i class="fa fa-lock"></i></button>
          <?php } ?>
          <button type="button" class="btn btn-xs btn-danger" title="Hapus User" onclick="window.location.href='?modul=aksiuser&act=hapus&id=<?php echo $r['id'];?>'"><i class="fa fa-trash"></i></button>

      </td>
      </tr>
      <?php $no++; } ?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>

