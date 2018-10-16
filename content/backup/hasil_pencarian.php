<div class="wrap-left-content menukiri">
<?php
error_reporting(0);
if(count(get_included_files())==1){
    echo"<meta http-equiv='refresh' content='0; url=url=http://'".$_SERVER['HTTP_HOST']."'>"; 
    exit("Direct access not permitted.");
}
$kata = trim($_POST['kata']);
// mencegah XSS
$kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);
// pisahkan kata per kalimat lalu hitung jumlah kata
$pisah_kata = explode(" ",$kata);
$jml_katakan = (integer)count($pisah_kata);
$jml_kata = $jml_katakan-1;

$cari = "SELECT * FROM berita WHERE " ;
for ($i=0; $i<=$jml_kata; $i++){
  $cari .= "isi_berita LIKE '%$pisah_kata[$i]%' or judul LIKE '%$pisah_kata[$i]%'";
  if ($i < $jml_kata ){
    $cari .= " OR ";
  }
}
$cari .= " ORDER BY id DESC LIMIT 10";
$hasil  = mysql_query($cari);
$ketemu = mysql_num_rows($hasil);
if($ketemu < 1){ ?>
<div class="judul-fullcari">
	<h2><i class="fa fa-search fa-1x"></i> NOTHING RESULTS FOR <strong><?php echo $kata; ?></strong></h2>
</div>
<?php
}else{
?>
<div class="judul-fullcari">
	<h2><i class="fa fa-search fa-1x"></i> SEARCH RESULTS FOR <strong><?php echo $kata; ?></strong></h2>
</div>
	<div class="row | pr-cari">
		<div class="wrap-berita-cari | clearfix">
			<?php 
			while($r=mysql_fetch_array($hasil)){
			?>
		 	<div class='wrap-isi-cari | clearfix'>
						<div class='col-md-3 | col-sm-3'>
							<div class='img-cari'>
								<a href='<?php echo BASE_URL;?>/<?php echo $r['judul_seo'];?>/' title='<?php echo $r['judul'];?>'><img src='<?php echo BASE_URL;?>/template/upload/featured_image/small_<?php echo $r['gambar'];?>' alt='<?php echo $r['judul'];?>' title='<?php echo $r['judul'];?>'></a>
							</div>
						</div>
						<div class='col-md-9 | col-sm-9 | pr-text-cari'>
							<div class='text-cari'>
								<h3>
									<a href='<?php echo BASE_URL;?>/<?php echo $r['judul_seo'];?>/' title='<?php echo $r['judul'];?>'><?php echo $r['judul'];?>
									</a>
								</h3>
								<p>
									<?php echo $r['hari'];?>, <?php echo tgl_indo($r['tanggal']);?>
								</p>
							</div>
							<div class='btn-artikel-cari'>
								<div class='btn-baca-cari'>
									<a href='<?php echo BASE_URL;?>/<?php echo $r['judul_seo'];?>/'  title='<?php echo $r['judul'];?>'>
										Baca Selengkapnya
									</a>
							</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div><!-- END WRAP CARI ARTIKEL -->
	</div>
	<?php } ?>
</div>