<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<button type="button" class="btn btn-info" onclick="window.location.href='?modul=aksisitemap&act=ping'">
<i class="fa fa-bullhorn"></i> PING SITEMAP</button><br><br>
<div class="box">
  <div class="box-body">
		<?php 
		$doc = new DOMDocument();
		$doc->load( "../sitemap.xml" );
		?>
    <table id="example2" class="table table-bordered table-striped">
      <thead>
      <tr>
			<th>URL</th>
      </tr>
      </thead>
      <tbody>
			<?php
			$urls = $doc->getElementsByTagName( "url" );
			// melakukan looping penampilan data url
			foreach($urls as $url)
			{
			$locs = $url->getElementsByTagName( "loc" ); 
			$link = $locs->item(0)->nodeValue; 
			?>
		<tr>
			<td><?php echo $link;?></td>
		</tr>
		<?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>

