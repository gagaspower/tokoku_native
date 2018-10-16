<?php
error_reporting(0);
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1){
    echo"<meta http-equiv='refresh' content='0; url=http://'".$_SERVER['HTTP_HOST']."'>"; 
    exit("Direct access not permitted.");
}
$sql_kategori_name = mysql_fetch_array(mysql_query("SELECT nama_kategori FROM kategori WHERE kategori_slug='".$val->validasi($_GET['kategori_slug'],'xss')."'"));
?>

          <article class="col-main">
            <h2 class="page-heading"> <span class="page-heading-title"><?php echo $sql_kategori_name['nama_kategori'];?></span> </h2>
            <div class="category-products">
              <ul class="products-grid">
                <?php
                $p      = new Paging2;
                $batas  = 8;
                $posisi = $p->cariPosisi($batas);
                  $sql=mysql_query("SELECT
                                      produk.id,
                                      produk.nama_produk,
                                      produk.produk_slug,
                                      produk.deskripsi_produk,
                                      produk.harga_produk,
                                      produk.stok_produk,
                                      produk.diskon_produk,
                                      produk.berat_produk,
                                      produk.deskripsi_seo_produk,
                                      produk.tag_produk,
                                      produk.gambar_produk,
                                      produk.dibeli,
                                      produk.tanggal,
                                      kategori.nama_kategori,
                                      kategori.kategori_slug
                                      FROM
                                      produk
                                      INNER JOIN kategori ON kategori.id = produk.kategori_id
                                      WHERE
                                      kategori.kategori_slug = '".$val->validasi($_GET['kategori_slug'],'xss')."'
                                      ORDER BY produk.id DESC LIMIT $posisi,$batas");
                  $cek=mysql_num_rows($sql);
                  while($k=mysql_fetch_array($sql)){
                  $harga     = format_rupiah($k['harga_produk']);
                  $disc      = ($k['diskon_produk']/100)*$k['harga_produk'];
                  $hargadisc = number_format(($k['harga_produk']-$disc),0,",",".");
                ?>
                <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                  <div class="item-inner">
                    <div class="item-img">
                      <div class="item-img-info"><a href="<?php echo BASE_URL;?>/produk/detail/<?php echo $k['produk_slug'];?>" title="Food Processor" class="product-image"><img src="<?php echo BASE_URL;?>/template/upload/featured_produk/medium_<?php echo $k['gambar_produk'];?>" alt="Retis lapen casen"></a>
                        <?php if($k['diskon_produk'] != 0){ ?>
                        <div class="new-label new-top-left">Save <?php echo $k['diskon_produk'];?>%</div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="item-info">
                      <div class="info-inner">
                        <div class="item-title"> <a title="Food Processor" href="<?php echo BASE_URL;?>/produk/detail/<?php echo $k['produk_slug'];?>"> <?php echo $k['nama_produk'];?> </a> </div>
                        <div class="item-content">
                          <div class="item-price">
                            <div class="price-box">
                              <?php if($k['diskon_produk'] != 0){ ?>
                              <p class="old-price"><span class="price-label">Regular Price:</span> <span class="price">Rp. <?php echo $harga;?> </span> </p>
                              <p class="special-price"><span class="price-label">Special Price</span> <span class="price">Rp. <?php echo $hargadisc;?> </span> </p>
                              <?php }else { ?>
                              <p class="special-price"><span class="price-label">Regular Price:</span> <span class="price">Rp. <?php echo $harga;?> </span> </p> 
                              <?php } ?>                             
                            </div>
                          </div>
                          <div class="action">
                            <?php if($k['stok_produk'] != 0 ){ ?>
                            <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"  onclick="window.location.href='<?php echo BASE_URL;?>/beli/produk/<?php echo $k['id'];?>/<?php echo $k['produk_slug'];?>'"><span>Add to Cart</span></button>
                            <?php } else { ?>
                            <button class="button btn-cart" type="button" data-original-title="Habis"><span>Stok Habis</span></button>  
                            <?php } ?>                          
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <?php } ?>
              </ul>
            </div>
            <?php if($cek > 0 ) { ?>
            <div class="toolbar">
              <div class="row">
                <div class="col-lg-6 col-sm-7 col-md-5">
                  <div class="pager">
                    <div class="pages">
                      <ul class="pagination">
                         <?php
                          $jmldata= mysql_num_rows(mysql_query("SELECT * FROM produk,kategori 
                            WHERE kategori.id = produk.kategori_id 
                            AND kategori.kategori_slug = '".$val->validasi($_GET['kategori_slug'],'xss')."'"));
                          $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                          $linkHalaman = $p->navHalaman($_GET['page'], $jmlhalaman);
                          echo "$linkHalaman";
                          ?> 
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } else { 
                    echo "<div class='alert alert-warning'>
                          <center><strong>Oops...</strong> Belum ada produk.</center>
                      </div>";
                } 
            ?>
          </article>
