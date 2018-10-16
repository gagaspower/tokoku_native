<?php
error_reporting(0);
session_start();
if(empty($_SESSION['email']) && empty($_SESSION['password'])){
    echo "<center>Anda tidak berhak mengakses halaman ini<br />
            <a href='index.php'><b>Login dulu!!</b></center>";
}else{
?>
<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">Laporan Penjualan</h3>
  </div>
  <form action="#" method="post">
  <div class="box-body">
    <div class="row">
      <div class="col-xs-3">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right datepicker" id="tanggal_awal" name="tanggal_awal" placeholder="Tanggal awal">
          </div>
      </div>
      <div class="col-xs-3">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right datepicker" id="tanggal_akhir" name="tanggal_akhir" placeholder="Tanggal akhir">
          </div>
      </div>
      <div class="col-xs-5">
        <button type="button" class="btn btn-info" id="submit_query">Submit</button>
      </div>
    </div>
  </div>
</form>
</div>
<div class="box">
  <div class="box-body">
    <table id="table"
   class="table table-striped"
   data-toggle="table" 
   data-pagination="false"  
   data-show-export="true"
   data-toolbar="#toolbar">
      <thead>
      <tr>
      <th>No.Order</th>
      <th>Nama Pembeli</th>
      <th>Tgl & Jam transaksi </th>
      <th>Status Order </th>
      </tr>
      </thead>
      <tbody id="result_report">
      </tbody>
    </table>
  </div>
</div>
<?php } ?>
