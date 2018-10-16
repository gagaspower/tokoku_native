<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
include "../config/koneksi.php";
include "../config/fungsi_tanggal.php";
include "../config/fungsi_seo.php";
include "../config/library.php";
include "../config/fungsi_thumb.php";
include "../config/Bcrypt.php";
include "../config/fungsi_rupiah.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Administrator Panel::.</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../template/backend/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../template/backend/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../template/backend/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../template/backend/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="../template/backend/bower_components/Ionicons/css/ionicons.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../template/backend/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../template/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="../template/backend/bower_components/select2-bootstrap-theme/dist/select2-bootstrap.min.css">
  <link rel="stylesheet" href="../template/backend/bower_components/jquery-input-tags/jquery.tagsinput.min.css">
    <link rel="stylesheet" href="../template/backend/bower_components/bootstrap-table/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="../template/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link href="../template/front/css/sweetalert.css" rel="stylesheet">
  <script src="../template/front/js/sweetalert.js"></script>
  <!-- Google Font -->
<link rel="stylesheet" type="text/css" href="../template/backend/bower_components/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" type="text/css" href="../template/backend/bower_components/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<link rel="stylesheet" type="text/css" href="../template/backend/bower_components/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" /> 
<script src="../editor/jscripts/tinymce.min.js" type="text/javascript"></script>
<script src="../editor/jscripts/tiny_lokomedia.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">CPANEL</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php if($_SESSION['level'] == '1'){ ?>
            <li>
              <a href="#"><i class="fa fa-cart-plus"></i>
                <?php 
                $sql7 = mysql_query("SELECT * FROM orders WHERE status_order = 'Baru'");
                $cek = mysql_num_rows($sql7);
                if($cek > 0){ 
                ?>
                <span class="label label-danger"><?php echo $cek; ?></span>
                <?php } ?>
              </a>
            </li>
            <?php } ?>
          <?php if($_SESSION['level'] == '1'){ ?>
            <li>
              <a href="#"><i class="fa fa-money"></i>
                <?php 
                $sql8 = mysql_query("SELECT * FROM konfirmasi WHERE status = '00'");
                $cek = mysql_num_rows($sql8);
                if($cek > 0){ 
                ?>
                <span class="label label-danger"><?php echo $cek; ?></span>
                <?php } ?>
              </a>
            </li>
            <?php } ?>
          <?php if($_SESSION['level'] == '1'){ ?>
            <li>
              <a href="#"><i class="fa fa-envelope-o"></i>
                <?php 
                $sql5 = mysql_query("SELECT * FROM pesan WHERE status = '00'");
                $cek = mysql_num_rows($sql5);
                if($cek > 0){ 
                ?>
                <span class="label label-danger"><?php echo $cek; ?></span>
                <?php } ?>
              </a>
            </li>
            <?php } ?>
            <li ><a href="?modul=gantipassword"><i class="fa fa-unlock"></i> <span>Ganti Password</span></a></li>
           <li ><a href="/" target="_blank"><i class="fa fa-external-link"></i> <span>Lihat Website</span></a></li>         
          <li ><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <?php 
  // level 1 admin
  if($_SESSION['level'] == '1'){
    include "sidebar.php";
  // level 2 author
  }elseif($_SESSION['level'] == '2'){
    include "sidebar_author.php";
  // undifined
  }else{
    echo "<li class=\"header\">Tidak ada menu</li>"; 
  }
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
         <!-- konten disini -->
            <?php
            if(isset($_GET['modul']))
            $modul=$_GET['modul'];
            switch ($modul)
            {
            default:
            include "dashboard.php";
            break;
            case "artikel":
            include "modul/mod_artikel/artikel.php";
            break;
            case "tambahartikel":
            include "modul/mod_artikel/tambah_artikel.php";
            break;
            case "editartikel":
            include "modul/mod_artikel/edit_artikel.php";
            break;
            case "aksiartikel":
            include "modul/mod_artikel/aksi_artikel.php";
            break;
            //menu kategori
            case "kategori":
            include "modul/mod_kategori/kategori.php";
            break;
            case "tambahkategori":
            include "modul/mod_kategori/tambah_kategori.php";
            break;
            case "aksikategori":
            include "modul/mod_kategori/aksi_kategori.php";
            break;
            case "editkategori":
            include "modul/mod_kategori/edit_kategori.php";
            break;

            //Halaman Statis
            case "halaman":
            include "modul/mod_halaman/halaman.php";
            break;
            case "tambahhalaman":
            include "modul/mod_halaman/tambah_halaman.php";
            break;
            case "edithalaman":
            include "modul/mod_halaman/edit_halaman.php";
            break;
            case "aksihalaman":
            include "modul/mod_halaman/aksi_halaman.php";
            break;
            //menu utama website
            case "menuutama":
            include "modul/mod_menu/menuutama.php";
            break;
            case "tambahmenuutama":
            include "modul/mod_menu/tambah_menuutama.php";
            break;
            case "editmenuutama":
            include "modul/mod_menu/edit_menuutama.php";
            break;
            case "aksimenumain":
            include "modul/mod_menu/aksi_menuutama.php";
            break;

            //submenu
            case "submenu":
            include "modul/mod_sub_menu/submenu.php";
            break;
            case "tambahsubmenu":
            include "modul/mod_sub_menu/tambah_submenu.php";
            break;
            case "aksisubmenu":
            include "modul/mod_sub_menu/aksi_submenu.php";
            break;
            case "editsubmenu":
            include "modul/mod_sub_menu/edit_submenu.php";
            break;
            //identitas website
            case "pengaturan":
            include "modul/mod_config/config.php";
            break;
            case "aksipengaturan":
            include "modul/mod_config/aksi_config.php";
            break;
            //manajemen user
            case "user":
            include "modul/mod_user/user.php";
            break;
            case "tambahuser":
            include "modul/mod_user/tambah_user.php";
            break;
            case "edituser":
            include "modul/mod_user/edit_user.php";
            break;
            case "aksiuser":
            include "modul/mod_user/aksi_user.php";
            break;
            //manajemen grup pengguna
            case "grup":
            include "modul/mod_grup/grup.php";
            break;
            case "tambahgrup":
            include "modul/mod_grup/tambah_grup.php";
            break;
            case "editgrup":
            include "modul/mod_grup/edit_grup.php";
            break;
            case "aksigrup":
            include "modul/mod_grup/aksi_grup.php";
            break; 

            //pesan masuk
            case "pesan":
            include "modul/mod_pesan/pesan.php";
            break;
            case "balaspesan":
            include "modul/mod_pesan/balas_pesan.php";
            break;
            case "aksipesan":
            include "modul/mod_pesan/aksi_pesan.php";
            break;   
            //file donwload
            case "file":
            include "modul/mod_file/file.php";
            break;
            case "tambahfile":
            include "modul/mod_file/tambah_file.php";
            break;
            case "aksifile":
            include "modul/mod_file/aksi_file.php";
            break;
            case "editfile":
            include "modul/mod_file/edit_file.php"; 
            break;

            // manajemen produk
            case "produk":
            include "modul/mod_produk/produk.php";
            break;
            case "tambahproduk":
            include "modul/mod_produk/tambah_produk.php";
            break;
            case "aksiproduk":
            include "modul/mod_produk/aksi_produk.php";
            break;
            case "editproduk":
            include "modul/mod_produk/edit_produk.php";
            break;
            //master provinsi
            case "provinsi":
            include "modul/mod_provinsi/provinsi.php";
            break;
            case "tambahprovinsi":
            include "modul/mod_provinsi/tambah_provinsi.php";
            break;
            case "aksiprovinsi":
            include "modul/mod_provinsi/aksi_provinsi.php";
            break;
            case "editprovinsi":
            include "modul/mod_provinsi/edit_provinsi.php";
            break;

            //master kabupaten
            case "kabupaten":
            include "modul/mod_kabupaten/kabupaten.php";
            break;
            case "tambahkabupaten":
            include "modul/mod_kabupaten/tambah_kabupaten.php";
            break;
            case "aksikabupaten":
            include "modul/mod_kabupaten/aksi_kabupaten.php";
            break;
            case "editkabupaten":
            include "modul/mod_kabupaten/edit_kabupaten.php";
            break;

            // master pelanggan
            case "pelanggan":
            include "modul/mod_pelanggan/pelanggan.php";
            break;
            case "aksipelanggan":
            include "modul/mod_pelanggan/aksi_pelanggan.php";
            break;

            // master bank
            case "bank":
            include "modul/mod_bank/bank.php";
            break;
            case "aksibank":
            include "modul/mod_bank/aksi_bank.php";
            break;
            case "tambahbank":
            include "modul/mod_bank/tambah_bank.php";
            break;
            case "editbank":
            include "modul/mod_bank/edit_bank.php";
            break;

            // ekspedisi pengiriman
            case "ekspedisi":
            include "modul/mod_ekspedisi/ekspedisi.php";
            break;
            case "tambahekspedisi":
            include "modul/mod_ekspedisi/tambah_ekspedisi.php";
            break;
            case "aksiekspedisi":
            include "modul/mod_ekspedisi/aksi_ekspedisi.php";
            break;
            case "editekspedisi":
            include "modul/mod_ekspedisi/edit_ekspedisi.php";
            break;

            // master ongkos kirim
            case "ongkir":
            include "modul/mod_ongkir/ongkir.php";
            break;
            case "tambahongkir":
            include "modul/mod_ongkir/tambah_ongkir.php";
            break;
            case "editongkir":
            include "modul/mod_ongkir/edit_ongkir.php";
            break;
            case "aksiongkir":
            include "modul/mod_ongkir/aksi_ongkir.php";
            break;

            // order list
            case "order":
            include "modul/mod_order/order.php";
            break;

            // konfirmasi
            case "konfirmasi":
            include "modul/mod_konfirmasi/konfirmasi.php";
            break;
            case "aksikonfirmasi":
            include "modul/mod_konfirmasi/aksi_konfirmasi.php";
            break;
            //news letter
            case "newsletter":
            include "modul/mod_newsletter/newsletter.php";
            break;
            case "aksinewsletter":
            include "modul/mod_newsletter/aksi_newsletter.php";
            break;
            //seting mailer
            case "mailer":
            include "modul/mod_mailer/mailer.php";
            break;
            case "aksimailer":
            include "modul/mod_mailer/aksi_mailer.php";
            break;
            //sitemap generator
            case "sitemap":
            include "modul/mod_sitemap/sitemap.php";
            break;
            case "aksisitemap":
            include "modul/mod_sitemap/aksi_sitemap.php";
            break;       
            // ganti password by user
            case "gantipassword":
            include "modul/mod_gantipassword/gantipassword.php";
            break;
            case "aksipassword":
            include "modul/mod_gantipassword/aksi_gantipassword.php";
            break;

            // search engine verifikasi kode
            case "seo":
            include "modul/mod_seo/seo.php";
            break;
            case "aksiseo":
            include "modul/mod_seo/aksi_seo.php";
            break;

            // report
            case "report":
            include "modul/mod_report/report.php";
            break;

            // cahce
            case "aksicache":
            include "aksi_cache.php";
            break;

            // database
            case "database":
            include "modul/mod_database/database.php";
            break;
            case "aksidatabase":
            include "modul/mod_database/aksi_database.php";
            break;
            }
            ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y");?> </strong> - dev.yatoreh.com All right reserved
  </footer>
</div>
<!-- ./wrapper -->
<?php include "footer.php";?>
</body>
</html>
<?php } ?>