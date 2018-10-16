<?php
error_reporting(0);
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1){echo"<meta http-equiv='refresh' content='0; url=https://$_SERVER[HTTP_HOST]'>"; exit("Direct access not permitted.");}
  if (isset($_GET['judul_seo'])){
    $sql = mysql_query("select meta_deskripsi from berita where judul_seo='".$val->validasi($_GET['judul_seo'],'xss')."'");
    $j   = mysql_fetch_array($sql);
	  echo "$j[meta_deskripsi]";
  }
elseif (isset($_GET['produk_slug'])){
      $sql3 = mysql_query("select deskripsi_seo_produk from produk where produk_slug ='".$_GET['produk_slug']."'");
      $j3   = mysql_fetch_array($sql3);
      echo "$j3[deskripsi_seo_produk]";;
  }
else{
    $sql4 = mysql_query("select meta_deskripsi from identitas LIMIT 1");
    $j4   = mysql_fetch_array($sql4);
    echo "$j4[meta_deskripsi]"; 
}
?>
