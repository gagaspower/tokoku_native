                  <!-- featured product Slider -->
                  <div class="bestsell-pro">
                    <div class="slider-items-products">
                      <div class="bestsell-block">
                        <div class="block-title">
                          <h2>Featured Product</h2>
                        </div>
                        <div id="bestsell-slider" class="product-flexslider hidden-buttons">
                          <div class="slider-items slider-width-col4 products-grid block-content">
                            <?php
                            $sql=mysql_query("SELECT * FROM produk WHERE diskon_produk ='0' ORDER BY id DESC LIMIT 0,8");
                            while ($r=mysql_fetch_array($sql)){
                            $harga     = format_rupiah($r['harga_produk']);
                            ?>
                            <div class="item">
                              <div class="item-inner">
                                <div class="item-img">
                                  <div class="item-img-info"> 
                                    <a class="product-image" title="<?php echo $r['nama_produk'];?>" href="<?php echo BASE_URL;?>/produk/detail/<?php echo $r['produk_slug'];?>"> 
                                      <img alt="<?php echo $r['nama_produk'];?>" src="<?php echo BASE_URL;?>/template/upload/featured_produk/medium_<?php echo $r['gambar_produk'];?>"> 
                                    </a>
                                  </div>
                                </div>
                                <div class="item-info">
                                  <div class="info-inner">
                                    <div class="item-title"> <a title="<?php echo $r['nama_produk'];?>" href="<?php echo BASE_URL;?>/produk/detail/<?php echo $r['produk_slug'];?>"> <?php echo $r['nama_produk'];?> </a> </div>
                                    <div class="item-content">
                                      <div class="item-price">
                                        <div class="price-box"> <span class="regular-price"> <span class="price">Rp. <?php echo $harga;?></span> </span> </div>
                                      </div>
                                      <div class="action">
                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart" onclick="window.location.href='<?php echo BASE_URL;?>/beli/produk/<?php echo $r['id'];?>/<?php echo $r['produk_slug'];?>'">
                                          <span>Add to Cart</span> 
                                        </button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php } ?>
                            <!-- End Item -->                             
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--END featured product Slider --> 

                  <!-- best seller Slider -->
                  <div class="bestsell-pro">
                    <div class="slider-items-products">
                      <div class="bestsell-block">
                        <div class="block-title">
                          <h2>Best Seller</h2>
                        </div>
                        <div id="bestsell-slider" class="product-flexslider hidden-buttons">
                          <div class="slider-items slider-width-col4 products-grid block-content">
                            <?php
                            $sql2=mysql_query("SELECT * FROM produk ORDER BY dibeli DESC LIMIT 4");
                            while ($b=mysql_fetch_array($sql2)){
                            $harga     = format_rupiah($b['harga_produk']);
                            ?>
                            <div class="item">
                              <div class="item-inner">
                                <div class="item-img">
                                  <div class="item-img-info"> 
                                    <a class="product-image" title="<?php echo $b['nama_produk'];?>" href="<?php echo BASE_URL;?>/produk/detail/<?php echo $b['produk_slug'];?>"> 
                                      <img alt="iPhone 6 Plus" src="<?php echo BASE_URL;?>/template/upload/featured_produk/medium_<?php echo $b['gambar_produk'];?>"> 
                                    </a>
                                  </div>
                                </div>
                                <div class="item-info">
                                  <div class="info-inner">
                                    <div class="item-title"> 
                                      <a title="<?php echo $b['nama_produk'];?>" href="<?php echo BASE_URL;?>/produk/detail/<?php echo $b['produk_slug'];?>"> 
                                        <?php echo $b['nama_produk'];?> 
                                      </a> 
                                    </div>
                                    <div class="item-content">
                                      <div class="item-price">
                                        <div class="price-box"> 
                                          <span class="regular-price"> 
                                            <span class="price">Rp. <?php echo $harga;?></span> 
                                          </span> 
                                        </div>
                                      </div>
                                      <div class="action">
                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart" onclick="window.location.href='<?php echo BASE_URL;?>/beli/produk/<?php echo $b['id'];?>/<?php echo $b['produk_slug'];?>'"><span>Add to Cart</span> </button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--END best seller Slider --> 