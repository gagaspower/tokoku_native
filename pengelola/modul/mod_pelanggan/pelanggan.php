<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header">
<h3 class="box-title">List Pelanggan</h3>
</div>
<?php include "../config/status.php";?>
<div class="box">
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
			<th>Nama Pelanggan </th>
      <th>Email Pelanggan </th>
      <th>Tgl. Registrasi </th>
      <th></th>
      </tr>
      </thead>
      <tbody>
	<?php
	$sql = mysql_query("SELECT * FROM kustomer ORDER BY id DESC");
	while($r = mysql_fetch_array($sql)){
	?>
    <tr>
		<td><?php echo $r['nama_kustomer'];?></td>
    <td><?php echo $r['email_kustomer'];?></td>
    <td><?php echo tgl_indo($r['tanggal_registrasi_kustomer']);?></td>
      <td>
          <a href="#" id="<?php echo $r['id'];?>" class="detail_pelanggan label label-info"><i class="fa fa-eye"></i> Detail</a>
          <button type="button" class="btn btn-xs btn-danger" title="Hapus Pelanggan" onclick="window.location.href='?modul=aksipelanggan&act=hapus&id=<?php echo $r['id'];?>'"><i class="fa fa-trash"></i></button>
	  </td>
      </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- modal -->
<div class="modal fade" id="modal_pelanggan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Pelanggan</h4>
      </div>
      <div class="modal-body">
        <div id="pelanggandetail"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>
