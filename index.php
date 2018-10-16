<?php
error_reporting(0);
include "config/fungsi_kompresi.php";
ob_start("kompresi_output"); 
session_start();
include "rss.php";
include "config/koneksi.php";
include "config/fungsi_tanggal.php";
include "config/fungsi_seo.php";
include "config/library.php";
include "config/class_paging.php";
include "config/fungsi_autolink.php";
include "config/fungsi_rupiah.php";

$id = mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
if($id['cache']=='Y'){
    include "config/class_cache.php";
    AutoCache::Hash($_SERVER['REQUEST_URI']); //Buat cache baru
    AutoCache::PullOrPush(3600); //Cache dalam satuan detik, artinya 3600 detik = 1 jam
}
define('BASE_URL', ''.$id['url_website'].'');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title><?php include "dina_titel.php"; ?></title>
<meta name="keywords" content="<?php echo include "dina_meta2.php"; ?>">
<meta name="description" content="<?php echo include "dina_meta1.php"; ?> ">
<!-- Facebook Open Graph --> 
<meta property="og:type" content="ecommerce" />
<meta property="og:url" content="<?php include "dina_meta4.php"; ?>" /> 
<meta property="og:title" content="<?php include "dina_titel.php"; ?>" />
<meta property="og:image" content="<?php include "dina_meta3.php"; ?>" />
<meta property="og:description" content="<?php include "dina_meta1.php"; ?>" />
<meta name="google-site-verification" content="<?php include "google_ver.php"; ?>" />
<meta name="msvalidate.01" content="<?php include "bing_ver.php"; ?>" />
<meta name="yandex-verification" content="<?php include "yandex_ver.php"; ?>" />
<meta name="robots" content="index, follow">
<meta name="author" content="yatoreh.com">
<meta http-equiv="imagetoolbar" content="no">
<meta name="language" content="Indonesia">
<meta name="revisit-after" content="7">
<meta name="webcrawlers" content="all">
<meta name="rating" content="general">
<meta name="spiders" content="all">
<link href='favicon.ico' rel='icon' type='image/x-icon' />
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="">

<!-- Favicons Icon -->
<link rel="icon" href="favicon.ico" type="<?php echo BASE_URL;?>/template/front/image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="<?php echo BASE_URL;?>/template/front/image/x-icon" />
<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS Style -->
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>/template/front/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>/template/front/css/font-awesome.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>/template/front/css/simple-line-icons.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>/template/front/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>/template/front/css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>/template/front/css/jquery.bxslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>/template/front/css/jquery.mobile-menu.css">
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>/template/front/css/revslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>/template/front/css/style.css" media="all">
<link href="<?php echo BASE_URL;?>/template/front/css/sweetalert.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo BASE_URL;?>/template/backend/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>/template/front/css/blog.css">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600,800,400|Raleway:400,300,600,500,700,800' rel='stylesheet' type='text/css'>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.xml" />
</head>

<body class="cms-index-index cms-home-page">
<div id="page"> 
  <!-- Header -->
  <header>
    <div class="header-container">
      <div class="header-top">
        <div class="container">
          <div class="row"> 
            <!-- Header Language -->
            <div class="col-xs-12 col-sm-6">
            </div>
            <div class="col-xs-6 hidden-xs"> 
              <!-- Header Top Links -->
              <div class="toplinks pull-right">
                <div class="links">
                  <?php if(empty($_SESSION['email'])){ ?>
                  <div class="login"><a href="<?php echo BASE_URL;?>/login"><span class="hidden-xs"><i class="fa fa-lock"></i> Log In</span></a> </div>
                  <?php } else { ?>
                  <div class="myaccount"><a title="My Account" href="<?php echo BASE_URL;?>/akun"><span class="hidden-xs"> <i class="fa fa-user"></i> My Account</span></a> </div>
                  <div class="login"><a href="logout.php"> <span class="hidden-xs"><i class="fa fa-sign-out"></i> Log Out</span></a> </div>
                  <?php } ?>
                </div>
              </div>
              <!-- End Header Top Links --> 
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 logo-block"> 
            <!-- Header Logo -->
            <?php
              $logos=mysql_fetch_array(mysql_query("SELECT nama_website,logo FROM identitas"));
            ?>
            <div class="logo"> 
              <a title="Magento Commerce" href="<?php echo BASE_URL;?>"><img alt="<?php echo $logos['nama_website'];?>" src="<?php echo BASE_URL;?>/template/upload/website_logo/<?php echo $logos['logo'];?>"> 
              </a> 
            </div>
            <!-- End Header Logo --> 
          </div>
<!--           <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12 hidden-xs">
            <div class="search-box">
              <form action="#" method="POST" id="search_mini_form" name="Categories">
                <input type="text" placeholder="Search entire store here..."  maxlength="70" name="search" id="search">
                <button type="button" class="search-btn-bg"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
              </form>
            </div>
          </div> -->
          <!-- shoping chart -->
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12"> 
            <div class="top-cart-contain pull-right"> 
              <!-- Top Cart -->
              <div class="mini-cart">
                <?php 
                    $sql=mysql_query("SELECT * FROM orders_temp,produk 
                    WHERE produk.id = orders_temp.id_produk
                    AND id_session = '".$_SESSION['email']."'");
                    $count=mysql_num_rows($sql);
                    ?>
                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> 
                    <a href="#"> <span class="cart_count"><?php echo $count; ?></span>
                        <span class="price">Shopping Cart</span> 
                    </a> 
                </div>
                <div>
                  <div class="top-cart-content"> 
                    
                    <!--block-subtitle-->
                    <ul class="mini-products-list" id="cart-sidebar">
                    <?php
                    if($count < 1 ){ ?>
                        <p>Keranjang belanja kosong</p>
                    <?php 
                    }else{
                    while($r=mysql_fetch_array($sql)){
                    $subtotal = $r['harga_produk'] * $r['jumlah']; 
                    $harga     = format_rupiah($r['harga_produk']);
                    $disc      = ($r['diskon_produk']/100)*$r['harga_produk'];
                    $hargadisc = number_format(($r['harga_produk']-$disc),0,",",".");
                    ?>                      
                      <li class="item first">
                        <div class="item-inner"> 
                            <a class="product-image" title="<?php echo $r['nama_produk'];?>" href="#l">
                                <img alt="<?php echo $r['nama_produk'];?>" src="<?php echo BASE_URL;?>/template/upload/featured_produk/small_<?php echo $r['gambar_produk'];?>"> 
                            </a>
                          <div class="product-details">
                            <div class="access">
                                <a class="btn-remove1" title="Remove This Item" href="<?php echo BASE_URL;?>/hapuskeranjang/<?php echo $r['id_orders_temp'];?>" id="hapus_keranjang">Remove</a> 
                            </div>
                            <strong><?php echo $r['jumlah'];?></strong> x <span class="price"><?php echo $hargadisc; ?></span>
                            <p class="product-name"><a href="#"><?php echo $r['nama_produk'];?></a> </p>
                          </div>
                        </div>
                      </li>
                    <?php }  ?>
                    </ul>
                    
                    <!--actions-->
                    <div class="actions">
                      <a href="<?php echo BASE_URL;?>/keranjang-belanja" class="view-cart"><span>View Cart</span></a> 
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <!-- Top Cart -->
              <div id="ajaxconfig_info" style="display:none"> <a href="#/"></a>
                <input value="" type="hidden">
                <input id="enable_module" value="1" type="hidden">
                <input class="effect_to_cart" value="1" type="hidden">
                <input class="title_shopping_cart" value="Go to shopping cart" type="hidden">
              </div>
            </div>
          </div>
          <!-- shoping chart selesai -->
        </div>
      </div>
    </div>
    <nav>
      <div class="container">
        <div class="mm-toggle-wrap">
          <div class="mm-toggle"><i class="fa fa-bars"></i><span class="mm-label">Menu</span> </div>
        </div>
        <div class="nav-inner"> 
            <ul id="nav" class="hidden-xs">
              <?php
                $categories=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori DESC");
                while($c=mysql_fetch_array($categories)){
              ?>
                <li class="mega-menu">
                  <a href="<?php echo BASE_URL;?>/kategori/<?php echo $c['kategori_slug'];?>" class="level-top">
                    <span><?php echo $c['nama_kategori'];?></span>
                  </a>
                </li>  
              <?php } ?>            
              <?php //include "topmenu.php"; ?>
            </ul>
        </div>
      </div>
    </nav>
  </header>
<br>
<div class="content-page">
    <div class="container">
        <div class="row"> 
            <div class="col-md-9">
            <!-- dinamic konten -->
            <?php
            if(isset($_GET['module']))
            $module=$_GET['module'];
            switch ($module)
            {
                default:
                include "content/home.php";
                break;
                case "produkdetail":
                include "content/product_details.php";
                break;
                case "keranjangbelanja":
                include "content/keranjangbelanja.php";
                break;
                case "updatekeranjang":
                include "content/update_keranjang.php";
                break;
                case "hapuskeranjang":
                include "content/hapus_keranjang.php";
                break;
                case "beli":
                include "beli.php";
                break;
                case "login":
                include "content/login_register.php";
                break;
                case "ceklogin":
                include "cek_login.php";
                break;
                case "daftar":
                include "content/register.php";
                break;
                case "aksidaftar":
                include "content/aksi_register.php";
                break;
                case "hubungi":
                include "content/hubungi.php";
                break;
                case "aksihubungi":
                include "content/aksi_hubungi.php";
                break;
                case "download":
                include "content/download.php";
                break;
                case "halaman":
                include "content/halaman_statis.php";
                break;
                case "akun":
                include "content/my_account.php";
                break;
                case "update_akun":
                include "content/aksi_update_akun.php";
                break;
                case "editakun":
                include "content/edit_akun.php";
                break;
                case "gantipassword":
                include "content/update_password.php";
                break;
                case "selesaibelanja":
                include "content/selesaibelanja.php";
                break;
                case "konfirmasi":
                include "content/konfirmasi.php";
                break;
                case "kirimkonfirmasi":
                include "content/aksi_konfirmasi.php";
                break;
                case "blog":
                include "content/blog_post.php";
                break;
                case "blogdetail":
                include "content/blog_detail.php";
                break;
                case "kategori":
                include "content/product_category.php";
                break;
                case "aksi_subscribe":
                include "content/aksi_subscribe.php";
                break;
            }
            ?>            
            </div>
            <!-- dinamyc konten selesai  -->
            <!-- sidebar -->
            <?php include "sidebar.php"; ?>
            <!-- sidebar selesai -->
        </div>
    </div>
</div>

<!-- footer -->
  <footer>
    <div class="footer-inner">
      <div class="container">
        <div class="row">
        
          <div class="col-sm-8 col-xs-12 col-lg-9">
            <!-- footer kolom 1 -->
            <div class="footer-column pull-left">
              <h4>Company</h4>
              <ul class="links">
                <?php
                $main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' AND posisi = 'footer'");
                $cek_main = mysql_num_rows($main);
                if($cek_main > 0 ){ ?>
                <li class="first"><a href="<?php echo BASE_URL;?>"> Home</a></li>
                <?php
                }
                while($bottom=mysql_fetch_array($main)){
                ?>
                <li class="first"><a href="<?php echo BASE_URL;?>/<?php echo $bottom['link'];?>"><?php echo $bottom['nama_menu'];?></a></li>
                <?php } ?>
              </ul>
            </div>

            <div class="footer-column pull-left">
              <h4>QUICK LINKS</h4>
              <ul class="links">
                <li><a href="<?php echo BASE_URL;?>/sitemap.xml" target="_blank">sitemap.xml</a></li>
                <li><a href="<?php echo BASE_URL;?>/rss.xml" target="_blank">rss.xml</a></li>
              </ul>
            </div>
            <!-- footer kolom 3 selesai -->
          </div>
          
          <!-- footer kolom 4 -->
          <div class="col-xs-12 col-lg-3 col-sm-4">
            <div class="footer-column-last">
              <div class="newsletter-wrap">
                <div class="app-img" style="color: #fff">copyright &copy; <?php echo date('Y'); ?> All right reserved.</div>
              </div>
              <div class="payment-accept">
                <div>
                  <?php
                    $eks=mysql_query("SELECT * FROM ekspedisi");
                    while($e=mysql_fetch_array($eks)){
                  ?>
                    <img src="<?php echo BASE_URL;?>/template/upload/featured_ekspedisi/small_<?php echo $e['logo_ekspedisi'];?>" alt="payment1"> 
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <!-- footer kolom 4 selsai -->
        </div>
      </div>
    </div>
</footer>
<!-- footer selesai -->
</div>
<!-- page selesai -->
<!-- mobile menu -->
<div id="mobile-menu">
  <ul>
    <li>
      <div class="mm-search">
        <form id="search1" name="search">
          <div class="input-group">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> </button>
            </div>
            <input type="text" class="form-control simple" placeholder="Search ..." name="srch-term" id="srch-term">
          </div>
        </form>
      </div>
    </li>
    <?php include "topmenu.php"; ?>
  </ul>
  <div class="top-links">
    <ul class="links">
      <?php if(empty($_SESSION['email'])){ ?>
      <li class="last"><a title="Login" href="?module=login"><i class="fa fa-lock"></i> Login</a> </li>
      <?php } else{  ?>
      <li><a title="My Account" href="#">My Account</a> </li>
      <li class="last"><a title="Login" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
      <?php } ?>
    </ul>
  </div>
</div>

<!-- JavaScript --> 
<script type="text/javascript" src="<?php echo BASE_URL;?>/template/front/js/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo BASE_URL;?>/template/front/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo BASE_URL;?>/template/front/js/sweetalert.js"></script>
<script src="<?php echo BASE_URL;?>/template/backend/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>/template/front/js/revslider.js"></script> 
<script type="text/javascript" src="<?php echo BASE_URL;?>/template/front/js/common.js"></script> 
<script type="text/javascript" src="<?php echo BASE_URL;?>/template/front/js/owl.carousel.min.js"></script> 
<script type="text/javascript" src="<?php echo BASE_URL;?>/template/front/js/jquery.mobile-menu.min.js"></script> 
<script type="text/javascript" src="<?php echo BASE_URL;?>/template/front/js/countdown.js"></script> 
<script type="text/javascript" src="<?php echo BASE_URL;?>/template/front/js/cloud-zoom.js"></script>
 <script type="text/javascript" src="<?php echo BASE_URL;?>/fungsi.js"></script> 
<script type='text/javascript'>
jQuery(document).ready(function() {
    jQuery('#rev_slider_4').show().revolution({
    dottedOverlay: 'none',
    delay: 5000,
    startwidth: 600,
    startheight: 461,
    hideThumbs: 200,
    thumbWidth: 200,
    thumbHeight: 50,
    thumbAmount: 2,
    navigationType: 'thumb',
    navigationArrows: 'solo',
    navigationStyle: 'round',
    touchenabled: 'on',
    onHoverStop: 'on',
    swipe_velocity: 0.7,
    swipe_min_touches: 1,
    swipe_max_touches: 1,
    drag_block_vertical: false,
    spinner: 'spinner0',
    keyboardNavigation: 'off',
    navigationHAlign: 'center',
    navigationVAlign: 'bottom',
    navigationHOffset: 0,
    navigationVOffset: 20,
    soloArrowLeftHalign: 'left',
    soloArrowLeftValign: 'center',
    soloArrowLeftHOffset: 20,
    soloArrowLeftVOffset: 0,
    soloArrowRightHalign: 'right',
    soloArrowRightValign: 'center',
    soloArrowRightHOffset: 20,
    soloArrowRightVOffset: 0,
    shadow: 0,
    fullWidth: 'on',
    fullScreen: 'off',
    stopLoop: 'off',
    stopAfterLoops: -1,
    stopAtSlide: -1,
    shuffle: 'off',
    autoHeight: 'off',
    forceFullWidth: 'on',
    fullScreenAlignForce: 'off',
    minFullScreenHeight: 0,
    hideNavDelayOnMobile: 1500,
    hideThumbsOnMobile: 'off',
    hideBulletsOnMobile: 'off',
    hideArrowsOnMobile: 'off',
    hideThumbsUnderResolution: 0,
    hideSliderAtLimit: 0,
    hideCaptionAtLimit: 0,
    hideAllCaptionAtLilmit: 0,
    startWithSlide: 0,
    fullScreenOffsetContainer: ''
});


});
</script> 
<!-- Hot Deals Timer 1--> 
<script type="text/javascript">
var dthen1 = new Date("12/25/17 11:59:00 PM");
    start = "05/09/15 03:02:11 AM";
    start_date = Date.parse(start);
    var dnow1 = new Date(start_date);
    if (CountStepper > 0)
    ddiff = new Date((dnow1) - (dthen1));
    else
    ddiff = new Date((dthen1) - (dnow1));
    gsecs1 = Math.floor(ddiff.valueOf() / 1000);
    
    var iid1 = "countbox_1";
    CountBack_slider(gsecs1, "countbox_1", 1);

  $(document).ready(function(){
    $('.select2').select2();
  });

    
</script>
</body>
</html>
<?php ob_end_flush(); ?>