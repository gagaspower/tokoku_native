<?php
include "config/koneksi.php";
echo "<option>pilih kabupaten</option>";
$sql=mysql_query("SELECT * FROM kabupaten WHERE provinsi_id = '".$val->validasi($_POST['provinsi'],'sql')."'");
while($k=mysql_fetch_array($sql)){ ?>
	<option value="<?php echo $k['id'];?>"><?php echo $k['nama_kabupaten'];?></option>
<?php	
}
?> 
