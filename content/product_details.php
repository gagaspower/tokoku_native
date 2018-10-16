<?php
$sql2=mysql_query("SELECT * FROM produk WHERE produk_slug ='".$val->validasi($_GET['produk_slug'],'xss')."'");
$b=mysql_fetch_array($sql2);
$harga     = format_rupiah($b['harga_produk']);
$disc      = ($b['diskon_produk']/100)*$b['harga_produk'];
$hargadisc = number_format(($b['harga_produk']-$disc),0,",",".");
$desc = htmlspecialchars_decode($b['deskripsi_seo_produk']);
?> 
<!-- Main Container -->
  <section class="main-container col1-layout">
    <div class="main">
      <div class="container">
        <div class="row">
          <div class="col-main">
            <div class="product-view">
              <div class="product-essential">
                <form action="#" method="post" id="product_addtocart_form">
                  <input name="form_key" value="6UbXroakyQlbfQzK" type="hidden">
                  <div class="product-img-box col-lg-4 col-sm-4 col-xs-9">
                    <div class="product-image">
                      <div class="product-full"> 
                        <img id="product-zoom" src="<?php echo BASE_URL;?>/template/upload/featured_produk/<?php echo $b['gambar_produk'];?>" data-zoom-image="<?php echo BASE_URL;?>/template/upload/featured_produk/<?php echo $b['gambar_produk'];?>" 
                        alt="<?php echo $b['nama_produk'];?>"/> 
                      </div>
                    </div>
                  </div>
                  <div class="product-shop col-lg-5 col-sm-5 col-xs-9">
                    <div class="product-name">
                      <h1><?php echo $b['nama_produk'];?></h1>
                    </div>
                    <div class="price-block">
                      <div class="price-box">
                                <?php
                                if ($b['diskon_produk'] != 0){
                                  echo "<p class='special-price'> 
                                          <span class='price-label'>Special Price</span> 
                                          <span id='product-price-48' class='price'>
                                          Rp. ".$hargadisc."</span></p>
                                          <p class='old-price'> <span class='price-label'>Regular Price:</span> 
                                          <span class='price'> Rp. ".$harga." </span> </p>";
                                }else{
                                  echo "<p class='special-price'> <span class='price-label'>Regular Price:</span> 
                                          <span class='price'> Rp. ".$harga." </span> </p>";
                                }                               
                                ?>

                              <p class="availability in-stock pull-right">
                                <span>
                                <?php
                                if($b['stok_produk'] != 0){
                                  echo "Ada Stok";
                                }else{
                                  echo "Stok Habis";
                                }
                                ?>
                                </span>
                              </p>
                      </div>
                    </div>
                    <div class="short-description">
                      <h2>Quick Overview</h2>
                      <p><?php echo $desc;?></p>
                    </div>
                    <div class="add-to-box">
                      <div class="add-to-cart">
                        <?php if($b['stok_produk'] != 0) { ?>
                        <button onClick="window.location.href='<?php echo BASE_URL;?>/beli/produk/<?php echo $b['id'];?>/<?php echo $b['produk_slug'];?>'" class="button btn-cart" type="button">
                          Add to Cart
                        </button>
                        <?php } else { ?>
                        <button class="button btn-cart" type="button" disabled>
                          Stok Habis
                        </button>    
                        <?php } ?>                    
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="product-collateral col-lg-9 col-sm-9 col-xs-9">
            <div class="add_info">
              <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                <li class="active"> <a href="#product_tabs_description" data-toggle="tab"> Detail </a> </li>
              </ul>
              <div id="productTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="product_tabs_description">
                  <div class="std">
                    <p><?php echo htmlspecialchars_decode($b['deskripsi_produk']); ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Main Container End --> 