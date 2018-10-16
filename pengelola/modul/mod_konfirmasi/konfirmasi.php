<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header">
<h3 class="box-title">Konfirmasi Pembayaran</h3>
</div>
<?php include "../config/status.php";?>
<div class="box">
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
			<th>No.Order</th>
      <th>Tgl & Jam Konfirmasi </th>
      <th>Jumlah Transfer </th>
      <th>Status Konfirmasi </th>
      <th>Bukti Pembayaran</th>
      <th></th>
      </tr>
      </thead>
      <tbody>
	<?php
	$sql = mysql_query("SELECT * FROM konfirmasi ORDER BY id DESC");
	while($r = mysql_fetch_array($sql)){
	?>
    <tr>
		<td><?php echo $r['id_orders'];?></td>
    <td><?php echo tgl_indo($r['tgl_konfirmasi']);?> - <?php echo $r['jam_konfirmasi'];?></td>
    <td>Rp. <?php echo format_rupiah($r['nominal']);?></td>
    <td>
      <?php if($r['status'] == '00'){ ?>
      <span class="label label-info ">Konfirmasi Pembayaran Baru</span>
      <?php } elseif($r['status'] == '99') { ?>
      <span class="label label-success">Konfirmasi telah diproses.
        Pesanan Invoice <b><?php echo $r['id_orders'];?></b> telah diubah ke status Lunas.
      </span>
      <?php } ?>
    </td>
    <td>
        <a class="fancybox" data-fancybox-group="gallery" href="../template/upload/featured_konfirmasi/<?php echo $r['bukti_konfirmasi'];?>">
            <img src="../template/upload/featured_konfirmasi/small_<?php echo $r['bukti_konfirmasi'];?>"/>
        </a>
    </td>
      <td>
          <a href="#" id="<?php echo $r['id'];?>" class="detail_konfirmasi label label-info"><i class="fa fa-eye"></i> Detail</a>
          <?php if($r['status'] == '00'){ ?>
          <button type="button" class="btn btn-xs btn-danger" title="Update Status Order" onclick="window.location.href='?modul=aksikonfirmasi&act=edit&id=<?php echo $r['id_orders'];?>'"><i class="fa fa-sign-out"></i> Update Lunas</button>
          <?php } ?>
	  </td>
      </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- modal -->
<div class="modal fade" id="modal_konfirmasi">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div id="konfirmasidetail"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>
