<?php
 require_once('fungsi_validasi.php');

 $host="localhost";
 $user="root";
 $pass="";
 $db="ameliade_tokoku";

// Koneksi dan memilih database di server
mysql_connect($host,$user,$pass) or die ("Koneksi gagal");
mysql_select_db($db) or die("Database tidak bisa dibuka");
$val = new Valid;

?>




