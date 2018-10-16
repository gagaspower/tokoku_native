        <div class="col-md-3">
          <!-- hot deal start -->
          <div class="hot-deal">
            <div class="title">Hot Deal</div>
            <ul class="products-grid">
              <?php
              $sql2=mysql_query("SELECT * FROM produk WHERE diskon_produk != '0'  LIMIT 2");
              while ($b=mysql_fetch_array($sql2)){
              $harga     = format_rupiah($b['harga_produk']);
              $disc      = ($b['diskon_produk']/100)*$b['harga_produk'];
              $hargadisc = number_format(($b['harga_produk']-$disc),0,",",".");
              ?>              
              <li class="right-space two-height item">
                <div class="item-inner">
                  <div class="item-img">
                    <div class="item-img-info"> <a href="<?php echo BASE_URL;?>/produk/detail/<?php echo $b['produk_slug'];?>" title="<?php echo $b['nama_produk'];?>" class="product-image"> <img src="<?php echo BASE_URL;?>/template/upload/featured_produk/medium_<?php echo $b['gambar_produk'];?>" alt="<?php echo $b['nama_produk'];?>"> </a>
                      <div class="new-label new-top-right">save <?php echo $b['diskon_produk'];?>%</div>
                  </div>
                  <div class="item-info">
                    <div class="info-inner">
                      <div class="item-title"> <a href="<?php echo BASE_URL;?>/produk/detail/<?php echo $b['produk_slug'];?>" title="<?php echo $b['nama_produk'];?>"> <?php echo $b['nama_produk'];?> </a> </div>
                      <div class="item-content">
                        <div class="item-price">
                          <div class="price-box"> 
                            <span class="regular-price"> 
                              <span class="price">
                                <?php
                                if ($b['diskon_produk'] != 0){
                                  echo "<p style='text-decoration:line-through;'><strong>Rp. ".$harga."</strong></p>
                                        <p style=\"color:#ff6600;\"><strong>Rp.".$hargadisc."</strong></p>";
                                }else{
                                  echo $hargadisc;
                                }                                
                                ?>
                              </span> 
                            </span> 
                          </div>
                        </div>
                        <div class="action">
                          <button data-original-title="Add to Cart" title="" type="button" class="button btn-cart" onclick="window.location.href='<?php echo BASE_URL;?>/beli/produk/<?php echo $b['id'];?>/<?php echo $b['produk_slug'];?>'"><span>Add to Cart</span> </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <?php } ?>

            </ul>
          </div>
          <!-- end hot deal -->
<!-- popular post start -->
<div class="popular-posts widget widget__sidebar wow bounceInUp animated" id="recent-posts-4"> 
  <h3 class="widget-title"><span>Most Popular Post</span></h3>
    <div class="widget-content">
      <ul class="posts-list unstyled clearfix">
        <?php
          $popular=mysql_query("SELECT * FROM berita ORDER BY dibaca DESC LIMIT 6");
          while($p=mysql_fetch_array($popular)){
        ?>
        <li>
          <h4>
            <a title="Pellentesque posuere" href="<?php echo BASE_URL;?>/blog/detail/<?php echo $p['judul_seo'];?>"><?php echo $p['judul'];?></a>
          </h4>
          <p class="post-meta"><i class="icon-calendar"></i>
          <time class="entry-date"><?php echo tgl_indo($p['tanggal']);?></time>
          </p>
        </li>
        <?php } ?>
      </ul>
    </div>
</div>
<!-- popular post end -->
<!-- subscribe -->
<div class="popular-posts widget widget__sidebar wow bounceInUp animated" id="recent-posts-4"> 
  <h3 class="widget-title"><span>News Letter</span></h3>
    <div class="widget-content">
    <form action="<?php echo BASE_URL;?>/subscribe" method="post" enctype="multipart/form-data">
      <ul class="posts-list unstyled clearfix">
        <li>
          <div class="input-box">
            <label for="billing:company">Nama <span class="required">*</span></label>
            <br>
            <input type="text"  name="nama" class="input-text" required style="width: 100%">
          </div>
        </li>
        <li>
          <div class="input-box">
            <label for="billing:company">Email <span class="required">*</span></label>
            <br>
            <input type="email"  name="email" class="input-text" required style="width: 100%">
          </div>
        </li>
      </ul>
      <div class="buttons-set">
        <button type="submit" title="Submit" class="button"> <span> Submit </span> </button>
      </div>
    </form>
    </div>
</div>
<!-- subscribe end -->
</div>