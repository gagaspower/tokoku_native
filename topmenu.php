
  <?php
   $main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' AND posisi = 'header'");
   $cek_main = mysql_num_rows($main);
   if($cek_main > 0 ){ ?>
    <li class="mega-menu"><a href="<?php echo BASE_URL;?>" class="level-top"><span>Home</span></a></li>
   <?php
   }
   while($r=mysql_fetch_array($main)){ 
   $botm = mysql_num_rows(mysql_query("SELECT * FROM submenu WHERE main_id = '".$r['id']."' AND aktif ='Y'"));
   if($botm > 0){
    ?>
     <li class="level0 nav-6 level-top drop-menu"><a href="<?php echo BASE_URL;?>/<?php echo $r['link'];?>" class="level-top"><span><?php echo $r['nama_menu'];?></span></a>
            <ul class="level1">
              <?php
    	         $sub=mysql_query("SELECT * FROM submenu, mainmenu  
                                WHERE submenu.main_id=mainmenu.id 
                                AND submenu.main_id= '".$r['id']."' AND submenu.aktif='Y'");
               $count = mysql_num_rows($sub);
               if($count > 0 ){
    	         while($w=mysql_fetch_array($sub)){ ?>
                  <li class="mega-menu"><a href="<?php echo BASE_URL;?>/<?php echo $w['link_sub'];?>" class="level-top"> <span><?php echo $w['nama_sub'];?></span></a></li>
              <?php } } ?>
          </ul>
      </li>
    <?php } else{ ?>
    <li class="mega-menu"><a href="<?php echo BASE_URL;?>/<?php echo $r['link'];?>" class="level-top"><span><?php echo $r['nama_menu'];?></span></a></li>
     <?php } } ?>  



