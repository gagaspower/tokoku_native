<?php
error_reporting(0);
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1){echo"<meta http-equiv='refresh' content='0; url=https://$_SERVER[HTTP_HOST]'>"; exit("Direct access not permitted.");}

$sql3 = mysql_query("SELECT url_website FROM identitas");
$r=mysql_fetch_array($sql3);
if (isset($_GET['produk_slug'])){
  $sql = mysql_query("select gambar_produk from produk where produk_slug='".$val->validasi($_GET['produk_slug'],'xss')."'");
  $j   = mysql_fetch_array($sql);
	echo "$r[url_website]/template/upload/featured_produk/medium_$j[gambar_produk]";
}
else{
      $sql2 = mysql_query("select logo from identitas LIMIT 1");
      $j2   = mysql_fetch_array($sql2);
	  echo "".$r['url_website']."/template/upload/website_logo/".$j2['logo']."";
}
?>

