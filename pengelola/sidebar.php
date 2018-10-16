<aside class="main-sidebar">
  <section class="sidebar">
     <ul class="sidebar-menu" data-widget="tree">
        <li
        <?php 
        if($_GET['modul'] == 'home') { echo "class='active'"; }?>
        ><a href="?modul=home"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
        <div style="border-bottom: 2px solid #3c8dbc;"></div>
   <!--      <li class="header">KOTAK MASUK</li> -->
        <li class="treeview
        <?php 
        if($_GET['modul'] == 'provinsi') { echo 'active'; }
        elseif($_GET['modul'] == 'tambahprovinsi') { echo 'active'; }
        elseif($_GET['modul'] == 'editprovinsi') { echo 'active'; } 
        elseif($_GET['modul'] == 'kabupaten') { echo 'active'; }
        elseif($_GET['modul'] == 'tambahkabupaten') { echo 'active'; }
        elseif($_GET['modul'] == 'editkabupaten') { echo 'active'; }
        elseif($_GET['modul'] == 'bank') { echo 'active'; }
        elseif($_GET['modul'] == 'tambahbank') { echo 'active'; }
        elseif($_GET['modul'] == 'editbank') { echo 'active'; }
        elseif($_GET['modul'] == 'ekspedisi') { echo 'active'; }
        elseif($_GET['modul'] == 'tambahekspedisi') { echo 'active'; }
        elseif($_GET['modul'] == 'editekspedisi') { echo 'active'; }
        elseif($_GET['modul'] == 'ongkir') { echo 'active'; }
        elseif($_GET['modul'] == 'tambahongkir') { echo 'active'; }
        elseif($_GET['modul'] == 'editongkir') { echo 'active'; }
        ?>
        "><a href="#">
            <i class="fa fa-database"></i> <span>MASTER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <li
        <?php 
        if($_GET['modul'] == 'provinsi') { echo "class='active'"; }
        elseif($_GET['modul'] == 'tambahprovinsi') { echo "class='active'"; }
        elseif($_GET['modul'] == 'editprovinsi') { echo "class='active'"; } ?>
        ><a href="?modul=provinsi"><i class="fa fa-circle-o"></i> <span>Provinsi</span></a></li>
        <li
        <?php 
        if($_GET['modul'] == 'kabupaten') { echo "class='active'"; }
        elseif($_GET['modul'] == 'tambahkabupaten') { echo "class='active'"; }
        elseif($_GET['modul'] == 'editkabupaten') { echo "class='active'"; } ?>
        ><a href="?modul=kabupaten"><i class="fa fa-circle-o"></i> <span>Kabupaten</span></a></li>
        <li
        <?php 
        if($_GET['modul'] == 'bank') { echo "class='active'"; }
        elseif($_GET['modul'] == 'tambahbank') { echo "class='active'"; }
        elseif($_GET['modul'] == 'editbank') { echo "class='active'"; } ?>
        ><a href="?modul=bank"><i class="fa fa-circle-o"></i> <span>Bank</span></a></li>
        <li
        <?php 
        if($_GET['modul'] == 'ekspedisi') { echo "class='active'"; }
        elseif($_GET['modul'] == 'tambahekspedisi') { echo "class='active'"; }
        elseif($_GET['modul'] == 'editekspedisi') { echo "class='active'"; } ?>
        ><a href="?modul=ekspedisi"><i class="fa fa-circle-o"></i> <span>Ekspedisi Pengiriman</span></a></li>
        <li
        <?php 
        if($_GET['modul'] == 'ongkir') { echo "class='active'"; }
        elseif($_GET['modul'] == 'tambahongkir') { echo "class='active'"; }
        elseif($_GET['modul'] == 'editongkir') { echo "class='active'"; } ?>
        ><a href="?modul=ongkir"><i class="fa fa-circle-o"></i> <span>Ongkir</span></a></li>
          </ul>
        </li>
        <!-- <li class="header">MANAJEMEN PRODUK</li>  -->
        <li class="treeview
        <?php 
        if($_GET['modul'] == 'kategori') { echo 'active'; }
        elseif($_GET['modul'] == 'tambahkategori') { echo 'active'; }
        elseif($_GET['modul'] == 'editkategori') { echo 'active'; } 
        elseif($_GET['modul'] == 'produk') { echo 'active'; }
        elseif($_GET['modul'] == 'tambahproduk') { echo 'active'; }
        elseif($_GET['modul'] == 'editproduk') { echo 'active'; }
        ?>
        "><a href="#">
            <i class="fa  fa-archive"></i> <span>MANAJEMEN PRODUK</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <li
        <?php 
        if($_GET['modul'] == 'produk') { echo "class='active'"; }
        elseif($_GET['modul'] == 'tambahproduk') { echo "class='active'"; }
        elseif($_GET['modul'] == 'editproduk') { echo "class='active'"; } 
        ?>
        ><a href="?modul=produk"><i class="fa fa-circle-o"></i> <span>Semua Produk</span></a></li>
        <li
        <?php 
        if($_GET['modul'] == 'kategori') { echo "class='active'"; }
        elseif($_GET['modul'] == 'tambahkategori') { echo "class='active'"; }
        elseif($_GET['modul'] == 'editkategori') { echo "class='active'"; } 
        ?>
        ><a href="?modul=kategori"><i class="fa fa-circle-o"></i> <span>Kategori</span></a></li>
          </ul>
        </li>


        <li class="treeview
        <?php 
        if($_GET['modul'] == 'order') { echo 'active'; }
        elseif($_GET['modul'] == 'detailorder') { echo 'active'; }
        elseif($_GET['modul'] == 'konfirmasi') { echo 'active'; } 
        ?>
        "><a href="#">
            <i class="fa fa-cart-plus"></i> <span>ORDER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <li
        <?php 
        if($_GET['modul'] == 'order') { echo "class='active'"; }
        elseif($_GET['modul'] == 'detailorder') { echo "class='active'"; }
        ?>
        ><a href="?modul=order"><i class="fa fa-circle-o"></i> <span>Semua Order</span></a></li>
        <li
        <?php 
        if($_GET['modul'] == 'konfirmasi') { echo "class='active'"; }
        ?>
        ><a href="?modul=konfirmasi"><i class="fa fa-circle-o"></i> <span>Konfirmasi Pembayaran</span></a></li>
          </ul>
        </li>
        <!-- <li class="header">MANAJEMEN KONTEN</li> -->
        <li class="treeview
        <?php 
        if($_GET['modul'] == 'artikel') { echo 'active'; }
        elseif($_GET['modul'] == 'tambahartikel') { echo 'active'; }
        elseif($_GET['modul'] == 'editartikel') { echo 'active'; } 
        elseif($_GET['modul'] == 'halaman') { echo 'active'; }
        elseif($_GET['modul'] == 'tambahhalaman') { echo 'active'; }
        elseif($_GET['modul'] == 'edithalaman') { echo 'active'; }
        ?>
        "><a href="#">
            <i class="fa fa-newspaper-o"></i> <span>MANAJEMEN KONTEN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <li
        <?php 
        if($_GET['modul'] == 'artikel') { echo "class='active'"; }
        elseif($_GET['modul'] == 'tambahartikel') { echo "class='active'"; }
        elseif($_GET['modul'] == 'editartikel') { echo "class='active'"; } 
        ?>
        ><a href="?modul=artikel"><i class="fa fa-circle-o"></i> <span>Artikel</span></a></li>
        <li
        <?php 
        if($_GET['modul'] == 'halaman') { echo "class='active'"; }
        elseif($_GET['modul'] == 'tambahhalaman') { echo "class='active'"; }
        elseif($_GET['modul'] == 'edithalaman') { echo "class='active'"; } 
        ?>
        ><a href="?modul=halaman"><i class="fa fa-circle-o"></i> <span>Halaman</span></a></li>
          </ul>
        </li>
        <!-- <li class="header">MEDIA</li>  -->
        <li
        <?php 
        if($_GET['modul'] == 'file') { echo "class='active'"; }
        elseif($_GET['modul'] == 'tambahfile') { echo "class='active'"; }
        elseif($_GET['modul'] == 'editfile') { echo "class='active'"; } 
        ?>
        ><a href="?modul=file"><i class="fa fa-cloud-download"></i> <span>FILE DOWNLOAD</span></a></li>

        <!-- <li class="header">MANAJEMEN USER</li> -->
        <li class="treeview
        <?php 
        if($_GET['modul'] == 'user') { echo 'active'; }
        elseif($_GET['modul'] == 'tambahuser') { echo 'active'; }
        elseif($_GET['modul'] == 'edituser') { echo 'active'; } 
        elseif($_GET['modul'] == 'grup') { echo 'active'; }
        elseif($_GET['modul'] == 'tambahgrup') { echo 'active'; }
        elseif($_GET['modul'] == 'editgrup') { echo 'active'; }
        elseif($_GET['modul'] == 'pelanggan') { echo 'active'; }
        ?>
        "><a href="#">
            <i class="fa fa-users"></i> <span>MANAJEMEN USER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <li
        <?php 
        if($_GET['modul'] == 'user') { echo "class='active'"; }
        elseif($_GET['modul'] == 'tambahuser') { echo "class='active'"; }
        elseif($_GET['modul'] == 'edituser') { echo "class='active'"; } ?>
        ><a href="?modul=user"><i class="fa fa-circle-o"></i> <span>User</span></a></li>
        <li
        <?php 
        if($_GET['modul'] == 'grup') { echo "class='active'"; }
        elseif($_GET['modul'] == 'tambahgrup') { echo "class='active'"; }
        elseif($_GET['modul'] == 'editgrup') { echo "class='active'"; } ?>
        ><a href="?modul=grup"><i class="fa fa-circle-o"></i> <span>User Grup</span></a></li>
        <li
        <?php 
        if($_GET['modul'] == 'pelanggan') { echo "class='active'"; }
         ?>
        ><a href="?modul=pelanggan"><i class="fa fa-circle-o"></i> <span>Pelanggan</span></a></li>
          </ul>
        </li>
        <li 
        <?php if($_GET['modul'] == 'pesan') { echo "class='active'"; }
           elseif($_GET['modul'] == 'balaspesan') { echo "class='active'"; }
        ?>>
            <a href="?modul=pesan">
                <i class="fa fa-envelope-o"></i><span>INBOX</span>
            </a>
        </li>
        <li
        <?php if($_GET['modul'] == 'newsletter') { echo "class='active'"; }
        ?>
        ><a href="?modul=newsletter"><i class="fa fa-envelope"></i><span>NEWS LETTER</span></a></li>

        <!-- <li class="header">PENGATURAN</li> -->
        <li class="treeview
        <?php 
        if($_GET['modul'] == 'pengaturan') { echo 'active'; }
        elseif($_GET['modul'] == 'mailer') { echo 'active'; }
        elseif($_GET['modul'] == 'sitemap') { echo 'active'; } 
        elseif($_GET['modul'] == 'seo') { echo 'active'; }
        elseif($_GET['modul'] == 'database') { echo 'active'; }
        elseif($_GET['modul'] == 'menuutama') { echo 'active'; }
        elseif($_GET['modul'] == 'tambahmenuutama') { echo 'active'; }
        elseif($_GET['modul'] == 'editmenuutama') { echo 'active'; }
        elseif($_GET['modul'] == 'submenu') { echo 'active'; }
        elseif($_GET['modul'] == 'tambahsubmenu') { echo 'active'; }
        elseif($_GET['modul'] == 'editsubmenu') { echo 'active'; }
        ?>
        "><a href="#">
            <i class="fa fa-cogs"></i> <span>PENGATURAN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li 
        <?php 
        if($_GET['modul'] == 'menuutama') { echo "class='active'"; }
        elseif($_GET['modul'] == 'tambahmenuutama') { echo "class='active'"; }
        elseif($_GET['modul'] == 'editmenuutama') { echo "class='active'"; } 
        ?>
            ><a href="?modul=menuutama"><i class="fa fa-circle-o"></i> <span>Menuutama</span></a></li>
            <li 
        <?php 
        if($_GET['modul'] == 'submenu') { echo "class='active'"; }
        elseif($_GET['modul'] == 'tambahsubmenu') { echo "class='active'"; }
        elseif($_GET['modul'] == 'editsubmenu') { echo "class='active'"; } 
        ?>
            ><a href="?modul=submenu"><i class="fa fa-circle-o"></i> <span>Submenu</span></a></li>
        <li
        <?php if($_GET['modul'] == 'pengaturan') { echo "class='active'"; }?>
        ><a href="?modul=pengaturan"><i class="fa fa-circle-o "></i> <span>Pengaturan</span></a></li>
        <li
        <?php if($_GET['modul'] == 'mailer') { echo "class='active'"; }?>
        ><a href="?modul=mailer"><i class="fa fa-circle-o"></i> <span>Konfigurasi Mailer</span></a></li>
        <li
        <?php 
        if($_GET['modul'] == 'sitemap') { echo "class='active'"; }
        ?>
        ><a href="?modul=sitemap"><i class="fa fa-circle-o"></i><span>Sitemap Generator</span></a></li>
        <li
        <?php if($_GET['modul'] == 'seo') { echo "class='active'"; }?>
        ><a href="?modul=seo"><i class="fa  fa-circle-o"></i> <span>Search Engine Verifikasi</span></a></li>
        <li
        <?php 
        if($_GET['modul'] == 'database') { echo "class='active'"; }
        ?>
        ><a href="?modul=database"><i class="fa fa-circle-o"></i> <span>Backup Database</span></a></li>
          </ul>
        </li>
        <li
        <?php 
        if($_GET['modul'] == 'report') { echo "class='active'"; }
        ?>
        ><a href="?modul=report"><i class="fa fa-print"></i> <span>LAPORAN PENJUALAN</span></a></li>
      </ul>
  </section>
</aside>