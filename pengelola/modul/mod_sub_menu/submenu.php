<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box-header">
<h3 class="box-title">Submenu Website</h3>
</div>
<button type="button" class="btn btn-info" onclick="window.location.href='?modul=tambahsubmenu'">
<i class="fa fa-plus-square"></i> Tambah</button><br><br>
<?php include "../config/status.php";?>
<div class="box">
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
  			<th>Submenu </th>
        <th>Linksub </th>
  			<th>Menu parent</th>
        <th>Status</th>
        <th></th>
      </tr>
      </thead>
      <tbody>
	<?php
	$sql = mysql_query("SELECT submenu.id,submenu.nama_sub,submenu.link_sub,submenu.aktif,mainmenu.nama_menu FROM submenu
                     LEFT JOIN mainmenu ON mainmenu.id = submenu.main_id
                     ORDER BY submenu.id DESC");
	while($r = mysql_fetch_array($sql)){
	?>
    <tr>
		<td><?php echo $r['nama_sub'];?></td>
    <td><?php echo $r['link_sub'];?></td>
    <td><?php echo $r['nama_menu'];?></td>
    <td>
      <?php if($r['aktif'] == 'Y'){ ?>
      <span class="label label-info ">Aktif</span>
      <?php } else { ?>
      <span class="label label-warning">Tidak Aktif</span>
      <?php } ?>
    </td>
      <td>
          <button type="button" class="btn btn-xs btn-info" title="Edit Menu" onclick="window.location.href='?modul=editsubmenu&id=<?php echo $r['id'];?>'"><i class="fa fa-pencil-square-o"></i></button>
          <?php if($r['aktif'] == 'Y') { ?>
          <button type="button" class="btn btn-xs btn-warning" title="Matikan Menu" onclick="window.location.href='?modul=aksisubmenu&act=matikan&id=<?php echo $r['id'];?>'"><i class="fa fa-lock"></i></button>
          <?php }else { ?>
          <button type="button" class="btn btn-xs btn-info" title="Aktifkan Menu" onclick="window.location.href='?modul=aksisubmenu&act=aktifkan&id=<?php echo $r['id'];?>'"><i class="fa fa-unlock"></i></button>
          <?php } ?>
          <button type="button" class="btn btn-xs btn-danger" title="Hapus Menu" onclick="window.location.href='?modul=aksisubmenu&act=hapus&id=<?php echo $r['id'];?>'"><i class="fa fa-trash"></i></button>
	  </td>
      </tr>
      <?php  } ?>
      </tbody>
    </table>
  </div>
</div>

<?php } ?>
