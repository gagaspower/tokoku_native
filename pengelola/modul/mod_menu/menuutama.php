<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header">
<h3 class="box-title">Menu Website</h3>
</div>
<button type="button" class="btn btn-info" onclick="window.location.href='?modul=tambahmenuutama'">
<i class="fa fa-plus-square"></i> Tambah</button><br><br>
<?php include "../config/status.php";?>
<div class="box">
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
			<th>No.</th>
			<th>Menu </th>
      <th>Link </th>
			<th>Status</th>
      <th>Posisi</th>
      <th></th>
      </tr>
      </thead>
      <tbody>
	<?php
	$sql = mysql_query("SELECT * FROM mainmenu ORDER BY id DESC");
	$no=1;
	while($r = mysql_fetch_array($sql)){
	?>
    <tr>
		<td><?php echo $no;?></td>
		<td><?php echo $r['nama_menu'];?></td>
    <td><?php echo $r['link'];?></td>
    <td>
      <?php if($r['aktif'] == 'Y'){ ?>
      <span class="label label-info ">Aktif</span>
      <?php } else { ?>
      <span class="label label-warning">Tidak Aktif</span>
      <?php } ?>
    </td>
    <td>
      <?php if($r['posisi'] == 'header'){ ?>
      <span class="label label-success ">Header</span>
      <?php } elseif($r['posisi'] == 'footer') { ?>
      <span class="label label-info">Footer</span>
      <?php }else{ ?>
      <span class="label label-warning">Undifined</span>        
      <?php } ?>
    </td>
      <td>
          <button type="button" class="btn btn-xs btn-info" title="Edit Menu" onclick="window.location.href='?modul=editmenuutama&id=<?php echo $r['id'];?>'"><i class="fa fa-pencil-square-o"></i></button>
          <?php if($r['aktif'] == 'Y') { ?>
          <button type="button" class="btn btn-xs btn-warning" title="Matikan Menu" onclick="window.location.href='?modul=aksimenumain&act=matikan&id=<?php echo $r['id'];?>'"><i class="fa fa-lock"></i></button>
          <?php }else { ?>
          <button type="button" class="btn btn-xs btn-info" title="Aktifkan Menu" onclick="window.location.href='?modul=aksimenumain&act=aktifkan&id=<?php echo $r['id'];?>'"><i class="fa fa-unlock"></i></button>
          <?php } ?>
          <?php if($r['posisi'] == 'header'){ ?>
          <button type="button" class="btn btn-xs btn-success" title="Pindah Footer" onclick="window.location.href='?modul=aksimenumain&act=pindahfooter&id=<?php echo $r['id'];?>'"><i class="fa fa-arrow-down"></i></button>
          <?php } elseif($r['posisi'] == 'footer') {?>
          <button type="button" class="btn btn-xs btn-success" title="Pindah Footer" onclick="window.location.href='?modul=aksimenumain&act=pindahheader&id=<?php echo $r['id'];?>'"><i class="fa fa-arrow-up"></i></button>
          <?php } else{ echo "";  } ?>
          <button type="button" class="btn btn-xs btn-danger" title="Hapus Menu" onclick="window.location.href='?modul=aksimenumain&act=hapus&id=<?php echo $r['id'];?>'"><i class="fa fa-trash"></i></button>
	  </td>
      </tr>
      <?php $no++; } ?>
      </tbody>
    </table>
  </div>
</div>

<?php } ?>
