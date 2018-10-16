<?php
error_reporting(0);
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1){echo"<meta http-equiv='refresh' content='0; url=http://'".$_SERVER['HTTP_HOST']."'>"; exit("Direct access not permitted.");}
$query = mysql_query("SELECT berita.id,berita.judul,berita.judul_seo,berita.isi_berita,berita.tanggal,berita.jam,berita.dibaca,users.nama_lengkap FROM berita
  LEFT JOIN users ON users.id = berita.user_id WHERE berita.judul_seo = '".$val->validasi($_GET['judul_seo'],'xss')."'");
$cek=mysql_num_rows($query);
if($cek < 1){
echo "<div class='alert alert-warning'>
        <strong>Oops...</strong> Halaman yang anda cari tidak ditemukan.
    </div>";
}else{
$r=mysql_fetch_array($query);
$isihalaman = htmlspecialchars_decode($r['isi_berita']); 
?>  
  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <div class="col-sm-9 wow bounceInUp animated">
          <div class="col-main">
            <div class="blog-wrapper" id="main">
              <div class="site-content" id="primary">
                <div role="main" id="content">
                  <article class="blog_entry clearfix">
                      <header class="blog_entry-header clearfix">
                        <div class="blog_entry-header-inner">
                          <h2 class="blog_entry-title"><?php echo $r['judul'];?></h2>
                        </div>
                        <ul class="list-info">
                          <li><i class="fa fa-user"></i> <?php echo $r['nama_lengkap'];?> </li>
                          <li><i class="fa fa-eye"></i> <?php echo $r['dibaca'];?> </li>
                          <li><i class="fa fa-calendar"></i> <?php echo tgl_indo($r['tanggal']);?> - <?php echo $r['jam'];?></li>
                        </ul>
                      </header>
                    <div class="entry-content">
                      <div class="entry-content">
                        <p><?php echo $isihalaman;?></p>
                      </div>
                    </div>
                  </article>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>