<?php
include "config/koneksi.php";
echo "<option>pilih kecamatan</option>";
$sql=mysql_query("SELECT * FROM kecamatan WHERE kabupaten_id = '".$val->validasi($_POST['kabupaten_id'],'sql')."'");
while($k=mysql_fetch_array($sql)){ ?>
	<option value="<?php echo $k['id'];?>"><?php echo $k['nama_kecamatan'];?></option>
<?php	
}
?> 
