<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header">
<h3 class="box-title">List Order</h3>
</div>
<?php include "../config/status.php";?>
<div class="box">
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
			<th>No.Order</th>
      <th>Nama Pembeli</th>
      <th>Tgl & Jam transaksi </th>
      <th>Status Order </th>
      <th></th>
      </tr>
      </thead>
      <tbody>
	<?php
	$sql = mysql_query("SELECT
                      orders.id,
                      orders.status_order,
                      orders.tgl_order,
                      orders.jam_order,
                      kustomer.nama_kustomer
                      FROM
                      orders
                      INNER JOIN kustomer ON kustomer.id = orders.id_kustomer
                      ORDER BY orders.id DESC");
	while($r = mysql_fetch_array($sql)){
  $lama =3;
  if($r['tgl_order'] > $lama){
      mysql_query("UPDATE orders SET status_order='Batal' WHERE DATEDIFF(CURDATE(), tgl_order) > $lama");
    }
	?>
    <tr>
		<td><?php echo $r['id'];?></td>
    <td><?php echo $r['nama_kustomer'];?></td>
    <td><?php echo tgl_indo($r['tgl_order']);?> - <?php echo $r['jam_order'];?></td>
    <td>
      <?php if($r['status_order'] == 'Baru'){ ?>
      <span class="label label-warning ">Baru => Pesanan baru dibuat</span>
      <?php } elseif($r['status_order'] == 'Terbayar') { ?>
      <span class="label label-info">Terbayar => Pembeli telah melakukan konfirmasi pembayaran</span>
      <?php } elseif($r['status_order'] == 'Lunas') {?>      
      <span class="label label-success">Lunas => Pembayaran telah diterima</span>
      <?php } elseif($r['status_order'] == 'Batal') {?>  
      <span class="label label-danger">Batal => lewat jatuh tempo ( melewati 3 hari )</span>
      <?php } ?>
    </td>
      <td>
          <a href="#" id="<?php echo $r['id'];?>" class="detail_orders label label-info"><i class="fa fa-eye"></i> Detail</a>
	  </td>
      </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- modal -->
<div class="modal fade" id="modal_orders">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div id="orderdetail"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>
