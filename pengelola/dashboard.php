    <section class="content">
      <div class="row">
        <div class="col-md-12">
        <?php 
          $iden_cache = mysql_fetch_array(mysql_query("SELECT id,cache FROM identitas LIMIT 1"));
          if($iden_cache['cache'] == 'Y'){
        ?>
              <div class="alert alert-info alert-dismissible">
              <!-- <h4><i class="icon fa fa-info"></i> Alert!</h4> -->
                <i class="icon fa fa-bullhorn"></i> <strong>Cache Enable !</strong> <br>Click for Disable cache: &nbsp;
                <a href="?modul=aksicache&act=disable&id=<?php echo $iden_cache['id'];?>" style="text-decoration: none;"><strong><i class="fa fa-plug"></i> Disable cache</strong></a>
              </div>
        <?php } else{ ?>
              <div class="alert alert-danger alert-dismissible">
              <!-- <h4><i class="icon fa fa-info"></i> Alert!</h4> -->
               <i class="icon fa fa-bullhorn"></i> <strong>Cache Disable !</strong> <br>Click for Enable cache: &nbsp;
               <a href="?modul=aksicache&act=enable&id=<?php echo $iden_cache['id'];?>" style="text-decoration: none;"><strong><i class="fa fa-plug"></i> Enable cache </strong></a>
              </div>
        <?php } ?>
      </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php $count_news=mysql_num_rows(mysql_query("SELECT * FROM berita")); echo $count_news; ?></h3>
              <p>Artikel</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php $count_user=mysql_num_rows(mysql_query("SELECT * FROM users")); echo $count_user; ?></h3>
              <p>User</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php $count_pesan=mysql_num_rows(mysql_query("SELECT * FROM pesan")); echo $count_pesan; ?></h3>
              <p>Pesan</p>
            </div>
            <div class="icon">
              <i class="ion ion-email"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php $count_subscriber=mysql_num_rows(mysql_query("SELECT * FROM subscribe")); echo $count_subscriber; ?></h3>
              <p>Subscriber</p>
            </div>
            <div class="icon">
              <i class="ion ion-speakerphone"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php $count_order=mysql_num_rows(mysql_query("SELECT * FROM orders")); echo $count_order; ?></h3>
              <p>Order Masuk</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php $count_order_cancel=mysql_num_rows(mysql_query("SELECT * FROM orders where status_order='Batal'")); echo $count_order_cancel; ?></h3>
              <p>Order Dibatalkan</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert-circled"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php $count_order_sukses=mysql_num_rows(mysql_query("SELECT * FROM orders where status_order='Lunas'")); echo $count_order_sukses; ?></h3>
              <p>Order Sukses</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-cart"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php $count_payment_success=mysql_num_rows(mysql_query("SELECT * FROM konfirmasi where status='99'")); echo $count_payment_success; ?></h3>
              <p>Pembayaran Berhasil</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
          </div>
        </div>
<!-- LATEST ACTIVITY POST -->
    <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Sering dibeli</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                    <?php
                    $iden = mysql_fetch_array(mysql_query("SELECT url_website FROM identitas LIMIT 1"));
                    $latest_post = mysql_query("SELECT * FROM produk ORDER BY dibeli DESC LIMIT 0,6");
                    while($latest=mysql_fetch_array($latest_post)){
                    ?>
                  <tr>
                    <th><a href="<?php echo $iden['url_website'];?>/produk/detail/<?php echo $latest['produk_slug'];?>" target="_blank"><?php echo $latest['nama_produk'];?></a></th>
                    <th><?php echo tgl_indo($latest['tanggal']);?></th>
                    <th><?php echo $latest['dibeli'];?>x dibeli</th>
                  </tr>
                    <?php } ?>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
<!-- LATEST ACTIVITY POST SELESAI -->
<!-- POPULAR POST -->
    <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Popular Post</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <tbody>
                    <?php
                    $iden = mysql_fetch_array(mysql_query("SELECT url_website FROM identitas LIMIT 1"));
                    $popular_post = mysql_query("SELECT * FROM berita ORDER BY dibaca DESC LIMIT 0,6");
                    while($popular=mysql_fetch_array($popular_post)){
                    ?>
                  <tr>
                    <th><a href="<?php echo $iden['url_website'];?>/blog/detail/<?php echo $popular['judul_seo'];?>" target="_blank"><?php echo $popular['judul'];?></a></th>
                    <th><i class="fa fa-eye"></i> &nbsp; <?php echo $popular['dibaca'];?></th>
                  </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
<!-- POPULAR POST SELESAI -->

      </div>
    </section>