<aside class="main-sidebar">
  <section class="sidebar">
     <ul class="sidebar-menu" data-widget="tree">
        <li
        <?php 
        if($_GET['modul'] == 'home') { echo "class='active'"; }?>
        ><a href="?modul=home"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
        <div style="border-bottom: 2px solid #3c8dbc;"></div>
        <li class="treeview
        <?php 
        if($_GET['modul'] == 'produk') { echo 'active'; }
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
          </ul>
        </li>

        <li class="treeview
        <?php 
        if($_GET['modul'] == 'artikel') { echo 'active'; }
        elseif($_GET['modul'] == 'tambahartikel') { echo 'active'; }
        elseif($_GET['modul'] == 'editartikel') { echo 'active'; } 
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

        <li class="treeview
        <?php 
        if($_GET['modul'] == 'sitemap') { echo 'active'; } 
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
        if($_GET['modul'] == 'sitemap') { echo "class='active'"; }
        ?>
        ><a href="?modul=sitemap"><i class="fa fa-circle-o"></i><span>Sitemap Generator</span></a></li>
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