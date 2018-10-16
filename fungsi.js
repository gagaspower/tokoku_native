 $(document).ready(function(){
 $('#hapus_keranjang').on('click',function(){
      var getLink = $(this).attr('href');
      swal({
              title: 'Peringatan',
              text: 'Anda yakin akan menghapus item ini ?',
              html: true,
              confirmButtonColor: '#d9534f',
              showCancelButton: true,
              },function(){
              window.location.href = getLink
          });
      return false;
  });

$("#provinsi_id").change(function(){
      var provinsi = $("#provinsi_id").val();
       $.ajax({
          type: "post",
          url: "get_kabupaten.php",
          data: {
              provinsi : provinsi
            },
          success: function (data) {
               $('#kabupaten_id').html(data);  
          },
          error: function(data){
              console.log(data);
          }
      });
  });


  $('.updatekeranjang').click(function(){  
       var idtemp = $(this).attr("id"); 
       $.ajax({  
            url:"get_order_temp_qty.php",  
            type:"post",  
            data:{idtemp:idtemp},  
            success:function(data){  
                 $('#qtydetail').html(data);  
                 $('#edit_qty').modal("show");  
            }  
       });  
  });

  $('.view_detail').click(function(){  
       var idtemp = $(this).attr("id"); 
       console.log(idtemp);
       $.ajax({  
            url:"get_detail_order.php",  
            type:"post",  
            data:{idtemp:idtemp},  
            success:function(data){  
                console.log(data);
                 $('#orderdetails').html(data);  
                 $('#orders_data').modal("show");  
            }  
       });  
  });
});


