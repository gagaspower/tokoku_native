<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header">
<h3 class="box-title">Mail List News Letter</h3>
</div>
<?php include "../config/status.php";?>
<div class="box">
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
			<th>No.</th>
			<th>Nama </th>
			<th>Email</th>
      <th></th>
      </tr>
      </thead>
      <tbody>
	<?php
	$sql = mysql_query("SELECT * FROM subscribe ORDER BY id DESC");
	$no=1;
	while($r = mysql_fetch_array($sql)){
	?>
    <tr>
		<td><?php echo $no;?></td>
		<td><?php echo $r['nama'];?></td>
    <td><?php echo $r['email'];?></td>
      <td>
          <button type="button" class="btn btn-xs btn-danger" title="Hapus Tag" onclick="window.location.href='?modul=aksinewsletter&act=hapus&id=<?php echo $r['id'];?>'"><i class="fa fa-trash"></i></button>
	  </td>
      </tr>
      <?php $no++; } ?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>

