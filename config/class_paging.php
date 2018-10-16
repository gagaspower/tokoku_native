<?php
// class paging untuk halaman berita (menampilkan semua berita)
class Paging{
function cariPosisi($batas){
if(empty($_GET['page'])){
	$posisi=0;
	$_GET['page']=1;
}
else{
	$posisi = ($_GET['page']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href='".$_SERVER['PHP_SELF']."?page=1' class='button button--small pagination-link pagination-link--older'> &laquo; First </a>
					<a href='".$_SERVER['PHP_SELF']."?page=$prev' class='button button--small pagination-link pagination-link--older'> &laquo; Prev </a> ";
                    
}
else{ 
	$link_halaman .= "<a href='#' class='button button--small pagination-link pagination-link--older'> &laquo Prev</a>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href='".$_SERVER['PHP_SELF']."?page=$i' class='button button--small pagination-link pagination-link--older'>$i</a> ";
  }
	  $angka .= " <a href='#' style='margin-left:7px;margin-right:7px;'>$halaman_aktif</a> ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href='".$_SERVER['PHP_SELF']."?page=$i' class='button button--small pagination-link pagination-link--older'>$i</a> ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... <a href='".$_SERVER['PHP_SELF']."?page=$jmlhalaman' class='button button--small pagination-link pagination-link--older'>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href='".$_SERVER['PHP_SELF']."?page=$next' class='button button--small pagination-link pagination-link--older'> Next &raquo;</a>
					<a href='".$_SERVER['PHP_SELF']."?page=$jmlhalaman' class='button button--small pagination-link pagination-link--older'> Last &raquo;</a>";
                   
}
else{
	$link_halaman .= " <a href='#' class='button button--small pagination-link pagination-link--older'>Next &raquo</a>";
}
return $link_halaman;
}
}


// class paging untuk halaman halkategori (menampilkan berita per halkategori)
class Paging2{
function cariPosisi($batas){
if(empty($_GET['page'])){
	$posisi=0;
	$_GET['page']=1;
}
else{
	$posisi = ($_GET['page']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<li><a href='".BASE_URL."/kategori/$_GET[kategori_slug]/page/$prev'>&laquo; Prev</a></li> ";
}
else{ 
	$link_halaman .= "<li><a href='#'>&laquo;</a></li>";
}

// Link halaman 1,2,3, ...
// $angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href='".BASE_URL."/kategori/$_GET[kategori_slug]/page/$i'>$i</a></li>";
  }
	  $angka .= "<li class='active'><a href='#'>$halaman_aktif</a></li>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<li><a href='".BASE_URL."/kategori/$_GET[kategori_slug]/page/$i'>$i</a></li> ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... <li><a href='".BASE_URL."/kategori/$_GET[kategori_slug]/page/$jmlhalaman'>$jmlhalaman</a></li> " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <li><a href='".BASE_URL."/kategori/$_GET[kategori_slug]/page/$next'>Next &raquo;</a></li> ";
}
else{
	$link_halaman .= " <li><a href='#'> &raquo;</a></li>";
}
return $link_halaman;
}
}

?>
