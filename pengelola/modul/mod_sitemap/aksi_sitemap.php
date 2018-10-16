<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{

$act=$_GET['act'];
if($act == 'ping'){

date_default_timezone_set('Asia/Jakarta');

$time = explode(" ",microtime());
$time = $time[1];
include "../config/class_sitemap.php";

$iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

$sitemap = new SitemapGenerator("$iden[url_website]/");
$sitemap->createGZipFile = false;
$sitemap->maxURLsPerSitemap = 10000;
$sitemap->sitemapFileName = "sitemap.xml";
$sitemap->robotsFileName = "robots.txt";


    $artikel=mysql_query("SELECT * FROM berita ORDER BY id DESC");
    $sitemap->addUrl("$iden[url_website]/", date('c'));
    while ($r=mysql_fetch_array($artikel)){
    $sitemap->addUrl("$iden[url_website]/blog/detail/$r[judul_seo]", date('c'));
    }
    $produks=mysql_query("SELECT * FROM produk ORDER BY id DESC");
    while($p=mysql_fetch_array($produks)){
      $sitemap->addUrl("$iden[url_website]/produk/detail/$p[produk_slug]", date('c'));  
    }
    echo "<div class='alert alert-success'>";
   try {
                                    $sitemap->createSitemap();
                                    $sitemap->writeSitemap();
                                    $sitemap->updateRobots();
                                    $result = $sitemap->submitSitemap("yahooAppId");
                                    // tampilkan status kiriman tiap search engine
                                    echo "<pre>";
                                    print_r($result);
                                    echo "</pre>";
                                }
                                catch (Exception $exc) {
                                    echo $exc->getTraceAsString();
                                }
                                echo "
                                Pemakaian memori maksimal : ".number_format(memory_get_peak_usage()/(1024*1024),2)."MB
                                ";
                                $time2 = explode(" ",microtime());
                                $time2 = $time2[1];
                                echo "
                                <br />Waktu eksekusi: ".number_format($time2-$time)." detik
                        </div>
                        <button type=\"button\" class=\"btn btn-danger\" onclick=\"window.location.href='?modul=sitemap'\"><i class='fa fa-arrow-circle-left'></i> Kembali</button>";

}// proses ping selesai

}
?>