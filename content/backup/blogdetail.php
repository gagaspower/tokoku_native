<?php
error_reporting(0);
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1){
    echo"<meta http-equiv='refresh' content='0; url=http://'".$_SERVER['HTTP_HOST']."'>"; 
    exit("Direct access not permitted.");
}
$query = mysql_query("SELECT berita.id, 
                             berita.judul,
                             berita.judul_seo, 
                             berita.user_id, 
                             berita.isi_berita,
                             berita.hari,
                             berita.tanggal, 
                             berita.dibaca, 
                             berita.tag, 
                             berita.meta_deskripsi, 
                             berita.gambar, 
                             berita.kategori_id, 
                             kategori.nama_kategori,
                             kategori.kategori_seo,
                             users.nama_lengkap 
                             FROM berita 
                             INNER JOIN kategori ON kategori.id = berita.kategori_id  
                             INNER JOIN users ON users.id = berita.user_id
                             WHERE berita.judul_seo = '".$val->validasi($_GET['judul_seo'],'xss')."'");
$cek=mysql_num_rows($query);
if($cek < 1){
echo "<div class='alert alert-warning'>
    <strong>Oops...</strong> Artikel yang anda cari tidak ada.
</div>"; 
}else{
$r=mysql_fetch_array($query);
$tanggal = tgl_indo($r['tanggal']);
$isi_berita = htmlspecialchars_decode($r['isi_berita']); // membuat paragraf pada isi berita dan mengabaikan tag html
mysql_query("UPDATE berita SET dibaca= '".$r['dibaca']."'+ 1 
WHERE judul_seo='".$val->validasi($_GET['judul_seo'],'xss')."'"); 
?>
<div class="row">
<div class="header2">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <h2 class="animated bounceInLeft" style="font-size: 30px; padding: 2px; color: #fff;"><?php echo $r['judul'];?></h2>
                <p class="by-author" style="font-size: 18px; color: #fff;">
                <i class="fa fa-calendar"></i> <?php echo $r['hari'];?>, <?php echo $tanggal;?>&nbsp; <i class="fa fa-user"></i> <?php echo $r['nama_lengkap'];?>&nbsp; <i class="fa fa-eye"></i> <?php echo $r['dibaca'];?> Kali
            </p>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin-top: 20px;">
<div class="col-xs-12 col-md-9">
    <div class="thumbnail no-border">
        <div class="caption">
            <p><?php echo $isi_berita;?></p>         
            <div id="share1"></div>
        </div>
    </div>
  <?php
  $sql_ad = mysql_query("SELECT ads_kode_artikel_bottom FROM ads_manage LIMIT 1");
  $a=mysql_num_rows($sql_ad);
  if($a > 0 ){ ?>

    <div class="thumbnail no-border">
        <div class="caption">
        <?php
            $ads2 =mysql_fetch_array($sql_ad);
            echo htmlspecialchars_decode($ads2['ads_kode_artikel_bottom']);
        ?>
        </div>
    </div>
    <?php } ?>
    <!-- ARTIKEL TERKAIT -->
   <?php
    $pisah_kata  = explode(",",$r['tag']);
    // echo $r['tag'];exit;
    $jml_katakan = (integer)count($pisah_kata);
    // echo $jml_katakan;exit;
    $jml_kata = $jml_katakan-1; 
    $ambil_judul = substr($val->validasi($_GET['judul_seo'],'xss'),0,50);

    $cari = "SELECT * FROM berita WHERE (judul_seo < '$ambil_judul') AND ( judul_seo != '$ambil_judul') AND (" ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "tag LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
    $cari .= ") ORDER BY id DESC LIMIT 4";
    $hasil  = mysql_query($cari);
    $cek = mysql_num_rows($hasil);
    if($cek > 0 ){ ?>
    <ol class="breadcrumb post-header">
        <li><i class="fa fa-book"></i> BACA JUGA</li>
    </ol>
    <div class="row">
    <?php  
    while($h=mysql_fetch_array($hasil)){
    ?>
        <div class="col-md-6">
            <ul class="media-list main-list">
                <li class="media">
                    <a class="pull-left" href="<?php echo BASE_URL;?>/<?php echo $h['judul_seo'];?>/">
                        <img class="media-object" src="<?php echo BASE_URL;?>/template/upload/featured_image/small_<?php echo $h['gambar'];?>" alt="<?php echo $h['judul'];?>" style="width: 100%; display: block;">
                    </a>
                    <div class="media-body">
                        <h4><a href="<?php echo BASE_URL;?>/<?php echo $h['judul_seo'];?>/"><?php echo $h['judul'];?></a></h4>
                        <p class="by-author"><i class="fa fa-calendar"></i> <?php echo $h['hari'];?>, <?php echo tgl_indo($h['tanggal']);?></p>
                    </div>
                </li>
            </ul>
        </div>

    <?php
        }
    ?>
</div>
<?php }else{ echo ""; } ?>
 <!-- ARTIKEL TERKAIT SELESAI -->
</div>
<?php } ?>
<!-- SIDEBAR  -->
<?php include "sidebar.php"; ?>
<!-- SIDEBAR END -->