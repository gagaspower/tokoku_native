<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
if (empty($_SESSION['email']) AND empty($_SESSION['password'])){
echo "<script>window.location = 'index.php'</script>";
}
else{
$aksi="modul/mod_database/aksi_database.php";
switch($_GET[aksi]){
default:
$path="modul/mod_database/backup/";

if($_GET['act']=="backup")
{
	include "fungsi.php";
	backup_tables(); // Cuma backup tabel doang buat keperluan restore
    echo "<script>
            setTimeout(function () { 
             swal({
                        title: 'Sukses',
                        text:  'Database Telah di backup',
                        type: 'success',
                        timer: 1000,
                        showConfirmButton: true
                    });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('media.php?modul=database');
             } ,1000);
         </script>";
}

elseif($_GET['act']=="full")
{
	// Backup semua tabel tanpa kecuali
	include "fungsi.php";
	backup_tables_full();
	include "class_backup.php"; // Bungkus semua file ke dalam zip dan file maelostore.zip disimpan ke root
  echo "<script>
          setTimeout(function () { 
           swal({
                      title: 'Sukses',
                      text:  'Website Telah di backup',
                      type: 'success',
                      timer: 1000,
                      showConfirmButton: true
                  });  
           },10); 
           window.setTimeout(function(){ 
            window.location.replace('media.php?modul=database');
           } ,1000);
       </script>";
}

elseif ($_GET['act']=="restore")
{
        $path="modul/mod_database/backup/";
				// Restore Tabel
				$filename = $path.$_GET['file']; // Path File
				$templine = ''; // Temporary variable, used to store current query
				$lines = file($filename); // Read in entire file
				foreach ($lines as $line) // Loop through each line
				{
					if (substr($line, 0, 2) == '--' || $line == '') // Skip it if it’s a comment
						continue;
					$templine .= $line; // Add this line to the current segment
					if (substr(trim($line), -1, 1) == ';') // If it has a semicolon at the end, it’s the end of the query
					{
						mysql_query($templine); // Perform the query
						$templine = ''; // Reset temp variable to empty
					}
				}

    echo "<script>
            setTimeout(function () { 
             swal({
                        title: 'Sukses',
                        text:  'Restore Database Berhasil',
                        type: 'success',
                        timer: 1000,
                        showConfirmButton: true
                    });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('media.php?modul=database');
             } ,1000);
         </script>";
}

elseif ($_GET['act']=="hapus")
{
	if(unlink($path.$_GET['file'])){

    echo "<script>
            setTimeout(function () { 
             swal({
                        title: 'Sukses',
                        text:  'Backup telah di hapus.',
                        type: 'success',
                        timer: 1000,
                        showConfirmButton: true
                    });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('media.php?modul=database');
             } ,1000);
         </script>";
	}else{

    echo "<script>
            setTimeout(function () { 
             swal({
                        title: 'Gagal',
                        text:  'Gagal menghapus backup data',
                        type: 'error',
                        timer: 1000,
                        showConfirmButton: true
                    });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('media.php?modul=database');
             } ,1000);
         </script>";
	}
}

elseif ($_GET['act']=="hapusbackup")
{
	if(unlink('../tokoku.zip')){
    echo "<script>
            setTimeout(function () { 
             swal({
                        title: 'Sukses',
                        text:  'Backup telah di hapus.',
                        type: 'success',
                        timer: 1000,
                        showConfirmButton: true
                    });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('media.php?modul=database');
             } ,1000);
         </script>";
	}else{
    echo "<script>
            setTimeout(function () { 
             swal({
                        title: 'Gagal',
                        text:  'Gagal menghapus backup data',
                        type: 'error',
                        timer: 1000,
                        showConfirmButton: true
                    });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('media.php?modul=database');
             } ,1000);
         </script>";
	}
}

if ($handle = opendir($path)) {
echo "
	<form method='post'>
    <div id='page-wrapper' >
            <div class='row'>
                <div class='col-md-12'>
                    <div class='panel panel-default'>
                        <div class='panel-body'>";
							if(file_exists("../tokoku.zip"))
							{echo"<button type=\"button\" class=\"btn btn-info\" onclick=\"window.location.href='dl.php?file=tokoku.zip'\">
							<i class=\"fa fa-download\"></i> Download Full Website (.zip)</button>

							<a href='media.php?modul=database&act=hapusbackup' class=\"btn btn-info\"  id=\"website_delete\">
							<i class=\"fa fa-trash\"></i> Hapus Backup</a>";}

							else{echo "<a href='media.php?modul=database&act=full' class=\"btn btn-default\" id=\"backup_full_website\">
							<i class=\"fa fa-download\"></i> Backup Full Website</a>";}

							echo"<button type=\"button\" class=\"btn btn-default\" onclick=\"window.location.href='media.php?modul=database&aksi=cek'\">
							<i class=\"fa fa-check-square-o\"></i> Check Database</button>

							<a class='btn btn-warning square-btn-adjust' href='media.php?modul=database&aksi=upload'><i class='fa fa-upload'></i> Upload Database</a>

							<a class='btn btn-info square-btn-adjust' href='media.php?modul=database&act=backup'><i class='fa fa-download'></i> Backup Tabel</a>";
							include "../config/status.php";
                                echo "<table id=\"example2\" class=\"table table-bordered table-striped\">
                                    <thead>
                                        <tr>
                                            <th>No</th>
											                      <th>Nama</th>
                                            <th>Dibuat Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
											";
											$no = 1;
											while (false !== ($file = readdir($handle)))
												if ($file != "." && $file != ".." && strpos($file, ".sql",1) && $s = explode("-",$file))
											echo"
											<tr>
												<td style='text-align:center'>".$no++."</td>
												<td><a href='download.php?file=$file'>$file</a></td>
												<td>".@date('d M Y H:i:s',$s[2])."</td>
												<td style='text-align:center'><a class='btn btn-success square-btn-adjust' href='media.php?modul=database&act=restore&file=$file' id=\"db_restore\"><i class='fa fa-upload'></i> Restore</a>
													<a class='btn btn-danger square-btn-adjust' href='media.php?modul=database&act=hapus&file=$file' id=\"db_delete\">
													<i class='fa fa-trash'></i> HAPUS</a>
												</td>
											</tr>";
											closedir($handle);
									echo"</tbody>
									</table>
                        		</div>
                    		</div>
                		</div>
            		</div>
    			</div>
			</form>";    
}
break;

case "upload":
echo "
    <div id='page-wrapper' >
            <div class='row'>
                <div class='col-md-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>Upload Database</div>
                        	<div class='panel-body'>
                            	<div class='row'>
                                	<div class='col-md-12'>
                                    	<form method='post' action='media.php?modul=aksidatabase&act=upload' enctype='multipart/form-data'>
                                        	<div class='form-group'>
												<label>File SQL</label>
												<input type='file' name='fupload'></input>
                                        	</div>
									</div>
                            	</div>
                        	</div>
							<div class='panel-footer'>
                            	<button type='submit' class='btn btn-primary square-btn-adjust'><i class='fa fa-check'></i> 
                            	Upload</button>
								<a class='btn btn-default square-btn-adjust' onClick='self.history.back()'><i class='fa fa-close'></i>Batal</a>
                        	</form>
                        </div>
                    </div>
                </div>
			</div>
    	</div>";
break;

case "cek":
echo "
	<form method='post'>
    <div id='page-wrapper' >
            <div class='row'>
                <div class='col-md-12'>
                    <div class='panel panel-default'>
                        <div class='panel-body'>

								<form method='post' action='?modul=database&aksi=repair'>
									<button type='submit' name='repair' class='btn btn-warning square-btn-adjust'><i class='fa fa-wrench'></i> Repair</button>
								</form>
									<a class='btn btn-default square-btn-adjust' href='media.php?modul=database'><i class='fa fa-close'></i> Kembali</a>
						
                                <table id=\"example2\" class=\"table table-bordered table-striped\">
                                    <thead>
                                        <tr>
                                            <th style='text-align:center' data-hide='phone'>No</th>
											<th data-hide='phone'>Tabel</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
											";
											$no = 1;
											$sql_3 = "SHOW TABLES";
											$q_3 = mysql_query($sql_3);
											while($r_3=mysql_fetch_array( $q_3 )){
											   $table_name = $r_3[0];
											   $sql_4 = "CHECK TABLE `$table_name`";
											   $q_4 = mysql_query($sql_4);
											   while( $r_4 = mysql_fetch_array( $q_4 ) ){
											echo"
											<tr>
												<td style='text-align:center'>".$no++."</td>
												<td>$table_name</td>
												<td>".$r_4['Msg_text']."</td>
											</tr>
											";											
											   }
											}
											echo"
                                    </tbody>
                                </table>
                        	</div>
                    	</div>
                	</div>
            	</div>
    		</div>
		</form>";    
break;

case "repair":
echo "
	<form method='post'>
    <div id='page-wrapper' >
            <div class='row'>
                <div class='col-md-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>Check Database<span style='float:right'><a href='#help' data-toggle='modal'>?</a></span></div>
                            <div class='modal fade' id='help' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                            <h4 class='modal-title' id='myModalLabel'>Bantuan</h4>
                                        </div>
                                        <div class='modal-body'>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class='panel-body'>
							<p>Search: <input id='filter' type='text'/>&nbsp; <a href='#clear' class='clear-filter' title='clear filter'>[clear]</a>&nbsp; <span class='row-count'></span>
							<span style='float: right;'>
								<form method='post' action='?modul=database&aksi=repair'>
									<button type='submit' name='repair' class='btn btn-warning square-btn-adjust'><i class='fa fa-wrench'></i> Repair</button>
								</form>
									<a class='btn btn-default square-btn-adjust' href='media.php?modul=database'><i class='fa fa-close'></i> Kembali</a>
							</span>
							</p>
											";
											if( isset( $_POST[repair] ) ){
											sleep(5);
											echo"
                                <table id=\"example2\" class=\"table table-bordered table-striped\">
                                    <thead>
                                        <tr>
                                            <th style='text-align:center' data-hide='phone'>No</th>
											<th data-hide='phone'>Tabel</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
											";
											$no = 1;
											$sql_1 = "SHOW TABLES";
											$q_1 = mysql_query($sql_1);
											while($r_1=mysql_fetch_array( $q_1 )){
											   $table_name = $r_1[0];
											   $sql_2 = "REPAIR TABLE `$table_name`";
											   $q_2 = mysql_query($sql_2);
											   while( $r_2 = mysql_fetch_array( $q_2 ) ){
											echo"
											<tr>
												<td style='text-align:center'>".$no++."</td>
												<td>$table_name</td>
												<td>".$r_2['Msg_text']."</td>
											</tr>
											";
											   }
											}
											echo"
                                    </tbody>
                                </table>";
								}
								echo"</div>
                    		</div>
                		</div>
            		</div>
    			</div>
			</form>";    
break;
}//penutup switch
}//penutup session

?>