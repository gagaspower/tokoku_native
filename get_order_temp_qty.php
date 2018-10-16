<?php
error_reporting(0);
session_start();
if (empty($_SESSION['email']) && empty($_SESSION['password'])) {
      echo "<script>
      setTimeout(function () { 
       swal({
                  title: 'alert',
                  text:  'Silahkan login untuk melakukan transaksi',
                  type: 'error',
                  timer: 1500,
                  showConfirmButton: false
              });  
       },10); 
       window.setTimeout(function(){ 
        window.location.replace('".BASE_URL."/login');
       } ,1500);
       </script>";  
}else{ 
include "config/koneksi.php";

$id = mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
define('BASE_URL', ''.$id['url_website'].'');

$sql=mysql_query("SELECT * FROM orders_temp WHERE id_orders_temp = '".$_POST['idtemp']."'");
$r=mysql_fetch_array($sql);
?> 

<div class="static-contain">
<fieldset class="group-select">
<form action="<?php echo BASE_URL;?>/update-keranjang" method="post">
<input type="hidden" name="id" value="<?php echo $r['id_orders_temp'];?>">
    <ul>
      <li>
        <div class="customer-name">
          <div class="input-box name-firstname">
            <label><strong> Qty</strong><span class="required">*</span></label>
            <br>
            <input type="number" name="jumlah"  class="input-text" value="<?php echo $r['jumlah'];?>" min="1" style="width:100%;">
          </div>
        </div>
      </li>
    </ul>
<hr>
<div class="buttons-set">
	<button type="button" class="button pull-left" data-dismiss="modal">Close</button>&nbsp;
  	<button type="submit" title="Submit" class="button pull-right"> <span> Submit </span> </button>
</div>
</form>
</fieldset>
</div>
<?php } ?>


