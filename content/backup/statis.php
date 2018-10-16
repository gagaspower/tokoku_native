<?php
error_reporting(0);
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1){echo"<meta http-equiv='refresh' content='0; url=http://'".$_SERVER['HTTP_HOST']."'>"; exit("Direct access not permitted.");}
$query = mysql_query("SELECT * FROM halamanstatis WHERE judul_seo ='".$val->validasi($_GET['judul_seo'],'xss')."'");
$cek=mysql_num_rows($query);
if($cek < 1){
echo "<div class='alert alert-warning'>
        <strong>Oops...</strong> Halaman yang anda cari tidak ditemukan.
    </div>";
}else{
$r=mysql_fetch_array($query);
$isihalaman = htmlspecialchars_decode($r['isi_halaman']); 
?>
<div class="row">
<div class="header2">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <h2 class="animated bounceInLeft" style="font-size: 30px; padding: 2px; color: #fff;"><?php echo $r['judul'];?></h2>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin-top: 20px;">
<div class="col-xs-12 col-md-9">
    <div class="thumbnail no-border">
        <div class="caption">
            <p><?php echo $isihalaman;?></p>         
        </div>
    </div>
 
</div>
<?php } ?>
<!-- SIDEBAR  -->
<?php include "sidebar.php"; ?>
<!-- SIDEBAR END -->