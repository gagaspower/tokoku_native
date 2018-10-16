<?php
$status="";
$pesan="";
//$pesan =$_REQUEST["pesan"];
if (isset($_REQUEST["pesan"]))
$pesan=$_REQUEST["pesan"];
  if (isset($_REQUEST["status"]))
  
      $status = $_REQUEST["status"];
  switch ($status)
  {	

      // peringatan untuk sukses/welcome di halaman admin
		  case "0":
		  echo "<div class='alert alert-block alert-success'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Berhasil !</strong> Selamat datang kembali di halaman administrator.<br />
            </div>";
      break;

      // alert untuk peringatan tidak bisa menyimpan data
      case "1":
      echo "<div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Gagal !</strong> Terjadi kesalahan saat menyimpan data<br />
            </div>";
      break;

      // alert untuk berhasil menyimpan data
      case "2":
      echo "<div class='alert alert-block alert-success'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Berhasil !</strong> Data berhasil disimpan.<br />
            </div>";
      break;

      // alerts untuk gagal edit data
      case "3":
      echo "<div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Gagal !</strong> Terjadi kesalahan saat menyimpan Perubahan<br />
            </div>";
      break;

      //alert untuk gagal menghapus data
      case "4":
      echo "<div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Gagal !</strong> Terjadi kesalahan saat menghapus data<br />
            </div>";
      break;


      // alerts berhasil ubah data
      case "5":
      echo "<div class='alert alert-block alert-success'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Berhasil!</strong> Data berhasil di rubah.<br />
            </div>";
      break;


      //alerts jika berhasil menghapus data
      case "6":
      echo "<div class='alert alert-block alert-success'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Berhasil!</strong> Data Telah di hapus .<br />
            </div>";
      break;

      case "7":
      echo "<div class='alert alert-warning'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Gagal !</strong> Gambar Hanya Berupa *JPG<br />
            </div>";
      break;

      case "8":
      echo "<div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Gagal !</strong> Gambar Hanya Berupa  *PNG<br />
            </div>";
      break;

		  case "9":
      echo "<div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Gagal !</strong> Gambar Yang Di Ijinkan Hanya *jpg<br />
            </div>";
      break;

		  case "10":
      echo "<div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Password Tidak Cocok, silahkan ulangi !</strong> 
            </div>";
      break;

      case "11":
      echo "<div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong>  Data Sudah di Gunakan, Silahkan Ganti.</strong> 
            </div>";
      break;

      case "12":
      echo "<div class='alert alert-warning'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Pengguna Telah Di Blokir.</strong> 
            </div>";
      break;
      case "13":
      echo "<div class='alert alert-info'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong>Pengguna Telah Di Aktifkan.</strong> 
            </div>";
      break;
      case "14":
      echo "<div class='alert alert-warning'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Menu telah di nonaktifkan.</strong> 
            </div>";
      break;
      case "15":
      echo "<div class='alert alert-info'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong>Menu Telah Di Aktifkan.</strong> 
            </div>";
      break;
      case "16":
      echo "<div class='alert alert-warning'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Tidak bisa mengirim pesan.</strong> 
            </div>";
      break;
      case "17":
      echo "<div class='alert alert-info'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong>Pesan Berhasil dikirim.</strong> 
            </div>";
      break;
      case "18":
      echo "<div class='alert alert-warning'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Email atau Password Tidak Cocok. Mohon ulangi</strong> 
            </div>";
      break;
      case "19":
      echo "<div class='alert alert-warning'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Password tidak cocok. Mohon ulangi</strong> 
            </div>";
      break;

      // pesan status hubungi
      case "20":
      echo "<div class='alert alert-warning'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Nama hanya mengandung huruf !</strong> 
            </div>";
      break;
      case "21":
      echo "<div class='alert alert-warning'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Email Tidak Valid !</strong> 
            </div>";
      break;
      case "22":
      echo "<div class='alert alert-warning'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Subjek hanya mengandung huruf !</strong> 
            </div>";
      break;
      case "23":
      echo "<div class='alert alert-info'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Pesan Berhasil dikirim.</strong> 
            </div>";
      break;
      case "24":
      echo "<div class='alert alert-warning'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> News Letter Tidak terkirim.</strong> 
            </div>";
      break;
      case "25":
      echo "<div class='alert alert-info'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> News Letter Berhasil dikirim.</strong> 
            </div>";
      break;
      case "26":
      echo "<div class='alert alert-info'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Terima kasih telah mendaftar.</strong> 
            </div>";
      break;
      case "27":
      echo "<div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Terjadi kesalahan, silahkan coba lagi.</strong> 
            </div>";
      break;
      case "28":
      echo "<div class='alert alert-warning'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Silahkan Masukan Captcha.</strong> 
            </div>";
      break;
      case "29":
      echo "<div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
                <strong> Gagal !</strong> File .php tidak diijinkan.<br />
            </div>";
      break;
  }
?>
