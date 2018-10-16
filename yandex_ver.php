<?php
error_reporting(0);
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1){echo"<meta http-equiv='refresh' content='0; url=https://$_SERVER[HTTP_HOST]'>"; exit("Direct access not permitted.");}
$sql = mysql_query("SELECT yandex_verifikasi FROM serp_manage LIMIT 1");
$r=mysql_fetch_array($sql);
echo $r[yandex_verifikasi];
?>


