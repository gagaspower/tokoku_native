<?php
error_reporting(0);
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1){
    echo"<meta http-equiv='refresh' content='0; url=http://'".$_SERVER['HTTP_HOST']."'>"; 
    exit("Direct access not permitted.");
}
$query = mysql_query("SELECT * FROM download ORDER BY id DESC");
?>
  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
          <div class="col-main">
            <div class="page-title">
              <h2>Download Catalog</h2>
            </div>
              <div class="static-contain">
                <fieldset class="group-select">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nama File</th>
                        <th>Hits</th>
                        <th>Download File</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      while($r=mysql_fetch_array($query)){
                      ?>
                      <tr>
                        <td><?php echo $r['judul'];?></td>
                        <td><i class="fa fa-eye"></i> <?php echo $r['hits'];?> kali download</td>
                        <td><button type="button" class="button btn-info" onclick="window.location.href='downlot.php?file=<?php echo $r['nama_file'];?>'"><i class="fa fa-download"></i> Download</button></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </fieldset>
              </div>
          </div>
        </section>
      </div>
    </div>
  </div>