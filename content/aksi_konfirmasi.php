<?php
error_reporting(0);
session_start();
if (empty($_SESSION['email']) && empty($_SESSION['password'])) {
      echo "<script>
      setTimeout(function () { 
       swal({
                  title: 'alert',
                  text:  'Silahkan login untuk melakukan transaksi',
                  type: 'error',
                  timer: 1500,
                  showConfirmButton: false
              });  
       },10); 
       window.setTimeout(function(){ 
        window.location.replace('".BASE_URL."/login');
       } ,1500);
       </script>";  
}else{ 
 include "config/fungsi_thumb.php";
 $lokasi_file       = $_FILES['fupload']['tmp_name'];
 $tipe_file         = $_FILES['fupload']['type'];
 $nama_file         = $_FILES['fupload']['name'];
 $acak              = rand(1,99);
 $nama_file_unik    = $acak.$nama_file; 
 $tgl_sekarang      = date("Y-m-d");
 $jam_sekarang      = date("H:i:s");
 $idorder           = $_POST['id_orders'];
 $nama              = $val->validasi($_POST['nama_kustomer'],'xss'); // filter xss injection
 $nominal           = $val->validasi($_POST['nominal'],'sql');
 $idbank            = $val->validasi($_POST['id_bank'],'sql');
 $banksetor         = $val->validasi($_POST['bank_penyetor'],'xss');

// var_dump($idorder);exit;

if (!preg_match("/^[a-zA-Z ]*$/",$nama)){
        echo "<script>
                setTimeout(function () { 
                 swal({
                            title: 'Gagal',
                            text:  'Nama hanya mengandung huruf',
                            type: 'error',
                            timer: 1500,
                            showConfirmButton: false
                        });  
                 },10); 
                 window.setTimeout(function(){ 
                  window.location.replace('".BASE_URL."/konfirmasi/".$idorder."');
                 } ,1500);
             </script>";
}

elseif (!preg_match("/^[a-zA-Z ]*$/",$banksetor)){
        echo "<script>
                setTimeout(function () { 
                 swal({
                            title: 'Gagal',
                            text:  'Nama Bank hanya mengandung huruf',
                            type: 'error',
                            timer: 1500,
                            showConfirmButton: false
                        });  
                 },10); 
                 window.setTimeout(function(){ 
                  window.location.replace('".BASE_URL."/konfirmasi/".$idorder."');
                 } ,1500);
             </script>";
}

elseif (!is_numeric($nominal)){
        echo "<script>
                setTimeout(function () { 
                 swal({
                            title: 'Gagal',
                            text:  'Jumlah Transfer hanya menggunakan angka',
                            type: 'error',
                            timer: 1500,
                            showConfirmButton: false
                        });  
                 },10); 
                 window.setTimeout(function(){ 
                  window.location.replace('".BASE_URL."/konfirmasi/".$idorder."');
                 } ,1500);
             </script>";
}
// melakukan fungsi validasi upload gambar hanya boleh ekstensi jpg
elseif($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
        echo "<script>
                setTimeout(function () { 
                 swal({
                            title: 'Gagal',
                            text:  'Bukti Pembayaran hanya *jpg',
                            type: 'error',
                            timer: 1500,
                            showConfirmButton: false
                        });  
                 },10); 
                 window.setTimeout(function(){ 
                  window.location.replace('".BASE_URL."/konfirmasi/".$idorder."');
                 } ,1500);
             </script>";
}

    else{

    // cek kode transaksi
    $sql5 = mysql_num_rows(mysql_query("SELECT id FROM orders WHERE id = '".$_POST['id_orders']."' AND status_order='Terbayar' "));
    if($sql5 > 0){ 
        echo "<script>
                setTimeout(function () { 
                 swal({
                            title: 'Gagal',
                            text:  'Invoice tidak ditemukan atau sudah dibayarkan',
                            type: 'error',
                            timer: 1500,
                            showConfirmButton: false
                        });  
                 },10); 
                 window.setTimeout(function(){ 
                  window.location.replace('".BASE_URL."/konfirmasi/".$idorder."');
                 } ,1500);
             </script>"; 
    }
    else{   
    // panggil fungsi UploadProduk untuk memulai proses penyimpanan dan rezise
    UploadKonfirmasi($nama_file_unik);
    $sql = mysql_query("INSERT INTO konfirmasi (tgl_konfirmasi,jam_konfirmasi,id_orders,nama_penyetor,nominal,bank_penyetor,id_bank,bukti_konfirmasi) 
                        VALUES 
                        ('".$tgl_sekarang."','".$jam_sekarang."','".$_POST['id_orders']."','".$nama."','".$nominal."','".$banksetor."','".$idbank."','".$nama_file_unik."')");
          //UPDATE STATUS ORDER 
    mysql_query("UPDATE orders SET status_order='Terbayar' where id='".$_POST['id_orders']."'");
        echo "<script>
                setTimeout(function () { 
                 swal({
                            title: 'sukses',
                            text:  'Konfirmasi pembayaran telah berhasil.',
                            type: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });  
                 },10); 
                 window.setTimeout(function(){ 
                  window.location.replace('".BASE_URL."/akun');
                 } ,1500);
             </script>"; 
        }            
    }

}

 ?>
 