<?php
error_reporting(0);
if(count(get_included_files())==1){
    echo"<meta http-equiv='refresh' content='0; url=url=http://'".$_SERVER['HTTP_HOST']."'>"; 
    exit("Direct access not permitted.");
}
?>
<!-- JUMBOTRON HEADER -->
<div class="jumbotron text-center">
    <div class="container">
        <?php 
        $n = mysql_fetch_array(mysql_query("SELECT nama_website,logo FROM identitas LIMIT 1"));
        ?>
        <img src="<?php echo BASE_URL;?>/template/upload/website_logo/<?php echo $n['logo'];?>" width="160" height="auto" class="img-responsive img-circle img-thumbnail" alt="<?php echo $n['nama_website'];?>">
        <h2>Web Developer | Blogger</h2>

    </div>
</div>
<!-- JUMBOTRON SELESAI -->

<!-- LATEST BLOG -->
<section class="artikel" id="artikel">
    <div class="container">
        <h3 class="text-center" style="color: #777;"><strong> LATEST BLOG</strong></h3> <hr style="border-top: 3px solid #f90; width: 30%; margin-top: -3px;">  
            <div class="row">
<?php
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
                             ORDER BY berita.id DESC LIMIT 0,3");
$cek=mysql_num_rows($query);
if($cek < 1){
echo "<div class='alert alert-warning'>
        <strong>Oops...</strong> Halaman yang anda cari tidak ditemukan.
    </div>";
}else{
while($r=mysql_fetch_array($query)){
$tanggal = tgl_indo($r['tanggal']);
$isi_berita = htmlspecialchars_decode($r['isi_berita']); 
$isi = substr($isi_berita,0,150); 
$isi = substr($isi_berita,0,strrpos($isi," ")); 
$konten = html_entity_decode(strip_tags($isi));
?> 
                <div class="col-md-4 col-sm-6">
                    <div class="thumbnail">
                        <a href="<?php echo $id['url_website'];?>/<?php echo $r['judul_seo'];?>/">
                            <img src="<?php echo $id['url_website'];?>/template/upload/featured_image/medium_<?php echo $r['gambar'];?>" style="width: 100%; display: block;" alt="<?php echo $r['judul'];?>">
                        </a>
                        <div class="caption">
                            <h1><a href="<?php echo $id['url_website'];?>/<?php echo $r['judul_seo'];?>/"><?php echo $r['judul'];?></a></h1>
                            <p class="by-author">
                                <span class="text-primary"><i class="fa fa-calendar"></i></span>
                                <?php echo $r['hari'];?>, <?php echo $tanggal;?>&nbsp; 
                                <span class="text-primary"><i class="fa fa-calendar"></i></span> <?php echo $r['nama_lengkap'];?>
                            </p>
                            <p align="justify"><?php echo $konten;?></p>

                            <p>
                                <a href="<?php echo $id['url_website'];?>/<?php echo $r['judul_seo'];?>/" class="btn btn-primary btn-sm" role="button">Selengkapnya <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
<?php } } ?>
        </div>
        <div class="col-md-12">
            <div class="thumbnail">
                <center><button type="button" class="btn btn-info btn-sm" onclick="window.location.href='<?php echo BASE_URL;?>/blog'"><i class="fas fa-rocket"></i>&nbsp;<strong>Semua Artikel</strong></button> </center>
            </div>
        </div>
</section>
<!-- LATEST BLOG SELESAI -->

<!-- MAINAN SAYA -->
<div class="demo text-center">
    <div class="container">
        <h3 class="text-center" style="color: #FFF;"><strong> MAINAN SAYA</strong></h3> <hr style="border-top: 3px solid #f90; width: 30%; margin-top: -3px;">
        <div class="row">

            <div class="col-sm-3 text-center">
                <a href="#">
                    <div class="panel panel-demo">
                        <i class='fas fa-code'></i>                      
                        <h4>PHP</h4>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="#">
                    <div class="panel panel-demo">
                        <i class='fab fa-html5'></i>                        
                        <h4>HTML</h4>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="#">
                    <div class="panel panel-demo">
                        <i class='fab fa-css3'></i>                     
                        <h4>CSS</h4>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="#">
                    <div class="panel panel-demo">
                        <i class='fas fa-coffee'></i>                      
                        <h4>JQUERY</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- MAINAN SELESAI -->