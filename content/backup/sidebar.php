<!-- Sidebar -->
<div class="col-xs-12 col-md-3">
	<!-- ADS SIDEBAR ATAS -->
    <?php
    $sql_a = mysql_query("SELECT ads_kode_sidebar_top FROM ads_manage LIMIT 1");
    $a=mysql_num_rows($sql_a);
    if($a > 0 ){
        $ads1 =mysql_fetch_array($sql_a);
        echo htmlspecialchars_decode($ads1['ads_kode_sidebar_top']);
    }
    ?>
	<!-- ADS SIDEBAR ATAS SELESAI -->
	<!-- Populer -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-bar-chart"></i> SERING DIBACA</h3>
		</div>
		<div class="list-group">
			<?php 
			$sql_popular = mysql_query("SELECT * FROM berita ORDER BY dibaca DESC LIMIT 5");
			while($p=mysql_fetch_array($sql_popular)){
			?>
			<a href="<?php echo BASE_URL;?>/<?php echo $p['judul_seo'];?>/" title="" class="list-group-item"><?php echo $p['judul'];?></a>
			<?php } ?>
		</div>
	</div>
	<!-- Popular selesai -->
	<!-- KATEGORI  -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-list"></i> KATEGORI</h3>
		</div>
		<div class="list-group">
            <?php
            $sql3 = mysql_query("SELECT * FROM kategori");
            $cek = mysql_num_rows($sql3);
            if($cek < 1){
                echo "<div class='alert alert-warning'>
                        <strong>Oops...</strong> Belum ada kategori.
                    </div>";                
            }else{
            while($k=mysql_fetch_array($sql3)){
            ?>
            <a href="<?php echo BASE_URL;?>/kategori/<?php echo $k['kategori_seo'];?>/" class="list-group-item"><i class="fa fa-tags"></i> <?php echo $k['nama_kategori'];?></a>
            <?php } } ?>
		</div>
	</div>
<!-- KATEGORI SELESAI -->
	<!-- ADS SIDEBAR BAWAH -->
                <?php
                $sql_ad = mysql_query("SELECT ads_kode_sidebar_bottom FROM ads_manage LIMIT 1");
                $a=mysql_num_rows($sql_ad);
                if($a > 0 ){
                    $ads2 =mysql_fetch_array($sql_ad);
                    echo htmlspecialchars_decode($ads2['ads_kode_sidebar_bottom']);
                }
                ?>
	<!-- ADS SIDEBAR BAWAH SELESAI -->
<!-- LANGGANAN -->
		<div class="panel panel-default">
		<div class="panel-heading">
  			<h3 class="panel-title"><i class="fa fa-send"></i> LANGGANAN</h3>
		</div>
		<div class="panel-body">
			<form action="<?php echo BASE_URL;?>/subscribe" method="post">
			<div class="form-group">
				<label>Nama <span style="color: red">*</span></label>
			    <input type="text" name="nama" class="form-control" id="nama" required>
			</div>
			<div class="form-group">
				<label>Email <span style="color: red">*</span></label>
			    <input type="email" name="email" class="form-control" required>
			</div>
			<div class="btn-group">
				<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-send"></i> SUBMIT</button>		
			</div>	
			</form>		
		</div>
	</div>
</div>