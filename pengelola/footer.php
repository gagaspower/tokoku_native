<!-- jQuery 3 -->
<script src="../template/backend/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- <script src="../template/backend/bower_components/jquery-ui/jquery-ui.min.js"></script> -->
<script src="../template/backend/bower_components/jquery-input-tags/jquery.tagsinput.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- <script>
  $.widget.bridge('uibutton', $.ui.button);
</script> -->
<!-- Bootstrap 3.3.7 -->
<script src="../template/backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../template/backend/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="../template/backend/bower_components/bootstrap-table/dist/bootstrap-table.min.js"></script>
<!-- <script src="../template/backend/bower_components/dist/locale/bootstrap-table-en-US.min.js"></script> -->
<script src="../template/backend/bower_components/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
<script src="../template/backend/tableExport.js"></script>
<!-- fancybox -->
<script src="../template/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../template/backend/bower_components/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="../template/backend/bower_components/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<script type="text/javascript" src="../template/backend/bower_components/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="../template/backend/bower_components/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="../template/backend/bower_components/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<!-- fancybox end -->
<!-- DataTables -->
<script src="../template/backend/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../template/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- tinyMce -->

<script src="../template/backend/dist/js/adminlte.min.js"></script>
<script src="../template/backend/dist/js/demo.js"></script>
<script>
  $(function () {
      //inisialisasi bootstrap tabel
      $('#table').bootstrapTable();

    $('.datepicker').datepicker({
      format:"yyyy-mm-dd",
      autoclose: true
    })
    // inisialis tags input
      $('#input-tags').tagsInput();
    //Initialize Select2 Elements
        $( ".select2" ).select2({
        theme: "bootstrap",
        placeholder: "Pilih"
        });
        $(".select2").width("100%");
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
    });
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
    });


     $('#db_delete').on('click',function(){
          var getLink = $(this).attr('href');
          swal({
                  title: 'Peringatan',
                  text: 'Anda yakin akan menghapus database ini ?',
                  html: true,
                  confirmButtonColor: '#d9534f',
                  showCancelButton: true,
                  },function(){
                  window.location.href = getLink
              });
          return false;
      });

     $('#db_restore').on('click',function(){
          var getLink = $(this).attr('href');
          swal({
                  title: 'Peringatan',
                  text: 'Anda yakin akan menghapus database ini ?<br> Semua data baru anda akan terhapus.',
                  html: true,
                  confirmButtonColor: '#d9534f',
                  showCancelButton: true,
                  },function(){
                  window.location.href = getLink
              });
          return false;
      });

     $('#website_delete').on('click',function(){
          var getLink = $(this).attr('href');
          swal({
                  title: 'Peringatan',
                  text: 'Anda yakin akan menghapus backup website?',
                  html: true,
                  confirmButtonColor: '#d9534f',
                  showCancelButton: true,
                  },function(){
                  window.location.href = getLink
              });
          return false;
      });

     $('#backup_full_website').on('click',function(){
          var getLink = $(this).attr('href');
          swal({
                  title: 'Peringatan',
                  text: 'Proses backup membutuhkan beberapa waktu. Mohon tunggu',
                  html: true,
                  confirmButtonColor: '#d9534f',
                  showCancelButton: true,
                  },function(){
                  window.location.href = getLink
              });
          return false;
      });


     $('.detail_pelanggan').on('click',function(){
           var idpelanggan = $(this).attr("id"); 
           // alert(idpelanggan);
           console.log(idpelanggan);
           $.ajax({  
                url:"detailpelanggan.php",  
                method:"post",  
                data:{idpelanggan:idpelanggan},  
                success:function(data){  
                     $('#pelanggandetail').html(data);  
                     $('#modal_pelanggan').modal("show");  
                }  
           }); 
      });  

     $('.detail_orders').on('click',function(){
           var idorder = $(this).attr("id"); 
           // alert(idpelanggan);
           console.log(idorder);
           $.ajax({  
                url:"get_detail_order.php",  
                method:"post",  
                data:{idorder:idorder},  
                success:function(data){  
                     $('#orderdetail').html(data);  
                     $('#modal_orders').modal("show");  
                }  
           }); 
      });  


     $('.detail_konfirmasi').on('click',function(){
           var idkonfirmasi = $(this).attr("id"); 
           // alert(idpelanggan);
           console.log(idkonfirmasi);
           $.ajax({  
                url:"get_detail_konfirmasi.php",  
                method:"post",  
                data:{idkonfirmasi:idkonfirmasi},  
                success:function(data){  
                     $('#konfirmasidetail').html(data);  
                     $('#modal_konfirmasi').modal("show");  
                }  
           }); 
      }); 

     $('#submit_query').on('click',function(){
           var tanggal_awal = $("#tanggal_awal").val(); 
           var tanggal_akhir = $("#tanggal_akhir").val(); 
           // alert(tanggal_awal);
           console.log(tanggal_awal);
           console.log(tanggal_akhir);
           $.ajax({  
                url:"get_report_penjualan.php",  
                type:"post",  
                data:{
                  tanggal_awal:tanggal_awal,
                  tanggal_akhir:tanggal_akhir
                },  
                success:function(data){  
                     $('#result_report').html(data);  
                }  
           }); 
      }); 


});

 //fancybox
 $(document).ready(function() {
      $('.fancybox').fancybox();
 });

</script>

