<?php
error_reporting(0);
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1){
    echo"<meta http-equiv='refresh' content='0; url=http://'".$_SERVER['HTTP_HOST']."'>"; 
    exit("Direct access not permitted.");
}
$query = mysql_query("SELECT * FROM download ORDER BY id DESC");

?>
<div class="row">
<div class="container" style="margin-top: 20px;">
<div class="col-xs-12 col-md-9">
  <div class="panel panel-default">
      <div class="panel-heading"><i class="fa fa-cloud-download"></i> Download</div>
      <table class="table table-hover table-striped table-condensed">
      <thead>
        <tr>
          <th>NAMA FILE</th>
          <th>DIUNDUH</th>
          <th width="40px" class="text-center"><i class="fa fa-download"></i></th>
        </tr>
      </thead>
      <tbody>
        <?php
        while($r = mysql_fetch_array($query)){
        ?>        
          <tr>
            <td><?php echo $r['judul'];?></td>
            <td><i class="fa fa-industry"></i>&nbsp;<?php echo $r['hits'];?> kali</td>
            <td class="text-center">
          <button type="button" class="btn btn-xs btn-info" title="Download <?php echo $r['judul'];?>" onclick="window.location.href='downlot.php?file=<?php echo $r['nama_file'];?>'"><i class="fa fa-download"></i> Download </button>       
            </td>
          </tr>
        <?php } ?>
       </tbody>
    </table>
  </div>
 
</div>
<!-- SIDEBAR  -->
<?php include "sidebar.php"; ?>
<!-- SIDEBAR END -->