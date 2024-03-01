/*
 * Admin custom javascript
 */
/* Dynamic change status */
$(document).on('click', '.category_change_status', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var  statusFor    = explode_btnid[0];
      var  idFor        = explode_btnid[1];
      var  statusNew    = explode_btnid[2];

      if(statusNew=='inactive')
      {
         var statusTex = 'Do you want update status as inactive?';
      }

       if(statusNew=='active')
      {
         var statusTex = 'Do you want to update status as active?';
      }

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/update-status-category",
                data:{statusFor:statusFor,idFor:idFor,statusNew:statusNew},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Status updated successfully!", "success");

                  if(statusNew=='inactive')
                   {
                     $("#span_status_"+idFor).html('');
                     $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="category_change_status" id="'+statusFor+'_'+idFor+'_active"><i class=" fas fa-times-circle fa-2x" style="color:red"></i></a>');
                   }else{
                        $("#span_status_"+idFor).html(''); 
                        $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="category_change_status" id="'+statusFor+'_'+idFor+'_inactive"> <i class=" fas fa-check-circle fa-2x" style="color:green"></i></a>');
                   }
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//change payment method status
$(document).on('click', '.method_change_status', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var  statusFor    = explode_btnid[0];
      var  idFor        = explode_btnid[1];
      var  statusNew    = explode_btnid[2];

      if(statusNew=='inactive')
      {
         var statusTex = 'Do you want to make it Disable?';
      }

       if(statusNew=='active')
      {
         var statusTex = 'Do you want to to make it Enable?';
      }

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/update-status-method",
                data:{statusFor:statusFor,idFor:idFor,statusNew:statusNew},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Status updated successfully!", "success");

                  if(statusNew=='inactive')
                   {
                     $("#span_status_"+idFor).html('');
                     $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="category_change_status" id="'+statusFor+'_'+idFor+'_active"><i class=" fas fa-times-circle fa-2x" style="color:red"></i></a>');
                   }else{
                        $("#span_status_"+idFor).html(''); 
                        $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="category_change_status" id="'+statusFor+'_'+idFor+'_inactive"> <i class=" fas fa-check-circle fa-2x" style="color:green"></i></a>');
                   }
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//product change status
$(document).on('click', '.product_change_status', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var  statusFor    = explode_btnid[0];
      var  idFor        = explode_btnid[1];
      var  statusNew    = explode_btnid[2];

      if(statusNew=='inactive')
      {
         var statusTex = 'Do you want update status as inactive?';
      }

       if(statusNew=='active')
      {
         var statusTex = 'Do you want to update status as active?';
      }

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/update-status-product",
                data:{statusFor:statusFor,idFor:idFor,statusNew:statusNew},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Status updated successfully!", "success");

                  if(statusNew=='inactive')
                   {
                     $("#span_status_"+idFor).html('');
                     $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="product_change_status" id="'+statusFor+'_'+idFor+'_active"><i class=" fas fa-times-circle fa-2x" style="color:red"></i></a>');
                   }else{
                        $("#span_status_"+idFor).html(''); 
                        $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="product_change_status" id="'+statusFor+'_'+idFor+'_inactive"> <i class=" fas fa-check-circle fa-2x" style="color:green"></i></a>');
                   }
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});




//coupon change status
$(document).on('click', '.coupon_change_status', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var  statusFor    = explode_btnid[0];
      var  idFor        = explode_btnid[1];
      var  statusNew    = explode_btnid[2];

      if(statusNew=='inactive')
      {
         var statusTex = 'Do you want update status as inactive?';
      }

       if(statusNew=='active')
      {
         var statusTex = 'Do you want to update status as active?';
      }

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/update-status-coupon",
                data:{statusFor:statusFor,idFor:idFor,statusNew:statusNew},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Status updated successfully!", "success");

                  if(statusNew=='inactive')
                   {
                     $("#span_status_"+idFor).html('');
                     $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="coupon_change_status" id="'+statusFor+'_'+idFor+'_active"><i class=" fas fa-times-circle fa-2x" style="color:red"></i></a>');
                   }else{
                        $("#span_status_"+idFor).html(''); 
                        $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="coupon_change_status" id="'+statusFor+'_'+idFor+'_inactive"> <i class=" fas fa-check-circle fa-2x" style="color:green"></i></a>');
                   }
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});



//blog change status
$(document).on('click', '.blog_change_status', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var  statusFor    = explode_btnid[0];
      var  idFor        = explode_btnid[1];
      var  statusNew    = explode_btnid[2];

      if(statusNew=='inactive')
      {
         var statusTex = 'Do you want update status as inactive?';
      }

       if(statusNew=='active')
      {
         var statusTex = 'Do you want to update status as active?';
      }

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/update-status-blog",
                data:{statusFor:statusFor,idFor:idFor,statusNew:statusNew},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Status updated successfully!", "success");

                  if(statusNew=='inactive')
                   {
                     $("#span_status_"+idFor).html('');
                     $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="blog_change_status" id="'+statusFor+'_'+idFor+'_active"><i class=" fas fa-times-circle fa-2x" style="color:red"></i></a>');
                   }else{
                        $("#span_status_"+idFor).html(''); 
                        $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="blog_change_status" id="'+statusFor+'_'+idFor+'_inactive"> <i class=" fas fa-check-circle fa-2x" style="color:green"></i></a>');
                   }
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//slider satusa change

//blog change status
$(document).on('click', '.homeslider_change_status', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var  statusFor    = explode_btnid[0];
      var  idFor        = explode_btnid[1];
      var  statusNew    = explode_btnid[2];

      if(statusNew=='inactive')
      {
         var statusTex = 'Do you want update status as inactive?';
      }

       if(statusNew=='active')
      {
         var statusTex = 'Do you want to update status as active?';
      }

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/update-status-homesilider",
                data:{statusFor:statusFor,idFor:idFor,statusNew:statusNew},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Status updated successfully!", "success");

                  if(statusNew=='inactive')
                   {
                     $("#span_status_"+idFor).html('');
                     $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="homeslider_change_status" id="'+statusFor+'_'+idFor+'_active"><i class=" fas fa-times-circle fa-2x" style="color:red"></i></a>');
                   }else{
                        $("#span_status_"+idFor).html(''); 
                        $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="homeslider_change_status" id="'+statusFor+'_'+idFor+'_inactive"> <i class=" fas fa-check-circle fa-2x" style="color:green"></i></a>');
                   }
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//logo change status
$(document).on('click', '.logo_change_status', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var  statusFor    = explode_btnid[0];
      var  idFor        = explode_btnid[1];
      var  statusNew    = explode_btnid[2];

      if(statusNew=='inactive')
      {
         var statusTex = 'Do you want update status as inactive?';
      }

       if(statusNew=='active')
      {
         var statusTex = 'Do you want to update status as active?';
      }

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/update-status-homelogo",
                data:{statusFor:statusFor,idFor:idFor,statusNew:statusNew},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Status updated successfully!", "success");

                  if(statusNew=='inactive')
                   {
                     $("#span_status_"+idFor).html('');
                     $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="logo_change_status" id="'+statusFor+'_'+idFor+'_active"><i class=" fas fa-times-circle fa-2x" style="color:red"></i></a>');
                   }else{
                        $("#span_status_"+idFor).html(''); 
                        $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="logo_change_status" id="'+statusFor+'_'+idFor+'_inactive"> <i class=" fas fa-check-circle fa-2x" style="color:green"></i></a>');
                   }
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});




/*Dynamic delete variation*/

$(document).on('click', '#delete_variation', function (e) {
      
      var idFor = $(this).val();

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-variation",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#variation_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete RAM
$(document).on('click', '.ajax_delete_ram', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-ram-attribute",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete processor
$(document).on('click', '.ajax_delete_processor', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-processor-attribute",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete type
$(document).on('click', '.ajax_delete_type', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-type-attribute",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete SSD
$(document).on('click', '.ajax_delete_ssd', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-ssd-attribute",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete screen size
$(document).on('click', '.ajax_delete_screen', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-screen-size-attribute",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete hard drive
$(document).on('click', '.ajax_delete_drive', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-drive-attribute",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete hard drive
$(document).on('click', '.ajax_delete_card', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-graphic-attribute",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

/*Dynamic delete testimonial*/

$(document).on('click', '.ajax_delete_testi', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-testimonial",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//testimonial change status
$(document).on('click', '.testi_change_status', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var  statusFor    = explode_btnid[0];
      var  idFor        = explode_btnid[1];
      var  statusNew    = explode_btnid[2];

      if(statusNew=='inactive')
      {
         var statusTex = 'Do you want update status as inactive?';
      }

       if(statusNew=='active')
      {
         var statusTex = 'Do you want to update status as active?';
      }

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/update-status-testimonial",
                data:{statusFor:statusFor,idFor:idFor,statusNew:statusNew},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Status updated successfully!", "success");

                  if(statusNew=='inactive')
                   {
                     $("#span_status_"+idFor).html('');
                     $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="testi_change_status" id="'+statusFor+'_'+idFor+'_active"><i class=" fas fa-times-circle fa-2x" style="color:red"></i></a>');
                   }else{
                        $("#span_status_"+idFor).html(''); 
                        $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="testi_change_status" id="'+statusFor+'_'+idFor+'_inactive"> <i class=" fas fa-check-circle fa-2x" style="color:green"></i></a>');
                   }
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete order
$(document).on('click', '.ajax_delete_order', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-order",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete color attr
$(document).on('click', '.ajax_delete_color', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-color-attribute",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete color attr
$(document).on('click', '.ajax_delete_brand', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-brand-attribute",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete shipping location
$(document).on('click', '.ajax_delete_shiplocation', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-shiplocation",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete slider
$(document).on('click', '.ajax_delete_slider', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-slider",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete location ajax
$(document).on('click', '.ajax_delete_location', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-location",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});


//delete product category ajax
$(document).on('click', '.ajax_delete_category', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-product-category",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete product

$(document).on('click', '.ajax_delete_product', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-product",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete job
$(document).on('click', '.ajax_delete_job', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-job",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete blog
$(document).on('click', '.ajax_delete_blog', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-blog",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete job category
$(document).on('click', '.ajax_delete_jobcat', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-jobCategory",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

$(document).on('click', '.ajax_delete_shipmethod', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-shipmethod",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//admin delete user
$(document).on('click', '.ajax_delete_user', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-user",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//admin delete coupon
$(document).on('click', '.ajax_delete_coupon', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-coupon",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});








/* Something went wrong*/
function SomethingWentWrongTryagain()
 {
  swal({
                 title: "Something went wrong!",
                 text: "Please try again.",
                 type: "warning",
                 //showCancelButton: true,
                 confirmButtonClass: "btn-danger",
                 confirmButtonText: "Okay",
                 closeOnConfirm: false
               },
               function(){
                   window.location.href='';
               });
 }





   

 
 
 $("#edit_gal_img").click(function(){
    
     var img = $(this).val();
    //  console.log(img);
      var prod_id = $("#product_id").val();
      var idFor = $(this).data('id');
    //   console.log(idFor);
     var img_id = $(this).data('id');
     var filetoupload = jQuery('.gallery_'+img_id).val();
     var file_data = $('.gallery_'+img_id).prop('files')[0];
     var form_data = new FormData();
     form_data.append('gallery_img', file_data);
     form_data.append('img', img);
     form_data.append('prod_id', prod_id);
      form_data.append('idFor', idFor);
    $("#preloader").show();
     
     $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
       $.ajax({
			url: SITE_URL_ADMIN+'/ajax/edit-gallery',
			type: 'POST',
			cache       : false,
            contentType : false,
            processData : false,
			data : form_data,
			success : function(data) {
			    
			    if(data != ''){
			        $("#preloader").hide();
					$("#succ_img").html('<p style="color: green;">Image Updated Successfully</p>');
					setTimeout(function () {
                    location.reload();
                    }, 2000);
			    }
				},
			error: function(error){
                console.log("Error:");
                console.log(error);
                 }	
		});       		 
           		 
 });
 
 //delete gallery image
 
 $("div #delete_img").click(function(){
    var img = $(this).val();
    var prod_id = $("#product_id").val();
    
    var idFor = $(this).data('id');
    //alert(idFor);
    
    statusTex = 'Do you want to delete it?';
    
    if(idFor!=''){
        swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-gallery",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#galRecord_"+idFor).hide();
                    setTimeout(function () {
                    location.reload();
                    }, 2000);
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
        
    }
 
 });
 


 

 //user stuts change
 $(document).on('click', '.user_change_status', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var  statusFor    = explode_btnid[0];
      var  idFor        = explode_btnid[1];
      var  statusNew    = explode_btnid[2];

      if(statusNew==0)
      {
         var statusTex = 'Do you want update status as unverified?';
      }

       if(statusNew==1)
      {
         var statusTex = 'Do you want to update status as verified?';
      }

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/update-status-user",
                data:{statusFor:statusFor,idFor:idFor,statusNew:statusNew},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                  //swal("Success!", "Status updated successfully!", "success");
                    location.reload();
                  
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//blog delete
$(document).on('click', '.blog_change_status', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var  statusFor    = explode_btnid[0];
      var  idFor        = explode_btnid[1];
      var  statusNew    = explode_btnid[2];

      if(statusNew=='inactive')
      {
         var statusTex = 'Do you want update status as inactive?';
      }

       if(statusNew=='active')
      {
         var statusTex = 'Do you want to update status as active?';
      }

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/update-status-blog",
                data:{statusFor:statusFor,idFor:idFor,statusNew:statusNew},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                  swal("Success!", "Status updated successfully!", "success");

                  
                  if(statusNew=='inactive')
                   {
                     $("#span_status_"+idFor).html('');
                     $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="blog_change_status" id="'+statusFor+'_'+idFor+'_active"><i class=" fas fa-times-circle fa-2x" style="color:red"></i></a>');
                   }else{
                        $("#span_status_"+idFor).html(''); 
                        $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="blog_change_status" id="'+statusFor+'_'+idFor+'_inactive"> <i class=" fas fa-check-circle fa-2x" style="color:green"></i></a>');
                   }
                  
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});



//block user
 $(document).on('click', '.user_delete', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var  statusFor    = explode_btnid[0];
      var  idFor        = explode_btnid[1];
      var  statusNew    = explode_btnid[2];

    //   if(statusNew=='inactive')
    //   {
    //      var statusTex = 'Do you want update status as inactive?';
    //   }

       if(statusNew=='active')
      {
         var statusTex = 'Do you want to update status as active?';
      }

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
           },
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/update-status-user",
                data:{statusFor:statusFor,idFor:idFor,statusNew:statusNew},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                  swal("Success!", "User is Blocked!", "success");

                  if(statusNew=='inactive')
                  {
                     $("#span_status_"+idFor).html('');
                     $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="user_change_status" id="'+statusFor+'_'+idFor+'_active"><i class=" ik ik-unlock fa-2x" style="color:green"></i></a>');
                  }else{
                        $("#span_status_"+idFor).html(''); 
                        $("#span_status_"+idFor).html('<a href="javascript:void(0)" class="user_change_status" id="'+statusFor+'_'+idFor+'_inactive"> <i class=" ik ik-lock fa-2x" style="color:red"></i></a>');
                  }
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});



//delete level
$(document).on('click', '.ajax_delete_level', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
          },
          function() 
          {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
              });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-product-level",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                  swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete user media



//delete level
$(document).on('click', '.ajax_delete_user_database', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
          },
          function() 
          {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
              });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-user-media",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                  swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});


//delete blog




//delete level
$(document).on('click', '.ajax_delete_blog', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
          },
          function() 
          {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
              });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-blog",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                  swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});


//delete Contact person

$(document).on('click', '.ajax_delete_Contact_person', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
          },
          function() 
          {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
              });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-contact-person",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                  swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete home slider

$(document).on('click', '.ajax_delete_homesider', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
          },
          function() 
          {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
              });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-home-silider",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                  swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});

//delete hole logo
$(document).on('click', '.ajax_delete_logo', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
          },
          function() 
          {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
              });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-home-logo",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                  swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});


// delete support FQA

$(document).on('click', '.ajax_delete_fqa', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
         swal({
              title: "Are you sure!",
              text: statusTex,
              type: "warning",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              showCancelButton: true,
             // dangerMode: true,
                //confirmButtonColor: '#dc3545',
          },
          function() 
          {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
              });
                
            $.ajax({
                url:SITE_URL_ADMIN+"/ajax/delete-FQA",
                data:{idFor:idFor},
                type:"POST",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                  swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});



var rowIdx = 0;

$('#addBtn').on('click', function () {
  
  
        // Adding a row inside the tbody.
        $('#tbl').append(`<tr id="R${++rowIdx}">
             <td><input type="text" name="bank_name[${rowIdx}]" class="form-control"></td>
             <td><input type="text" name="account_name[${rowIdx}]" class="form-control"></td>
             <td><input type="number" name="account_number[${rowIdx}]" class="form-control"></td>
             <td><input type="text" name="iban[${rowIdx}]" class="form-control"></td>
              <td>
                <button class="btn btn-md btn-danger remove" type="button">Remove</button>
                </td>
              </tr>`);
      });
      
      
$('#tbl').on('click', '.remove', function () {
  
        // Getting all the rows next to the row
        // containing the clicked button
        var child = $(this).closest('tr').nextAll();
  
        // Iterating across all the rows 
        // obtained to change the index
        child.each(function () {
  
          // Getting <tr> id.
          var id = $(this).attr('id');
  
          // Getting the <p> inside the .row-index class.
          var idx = $(this).children('.row-index').children('p');
  
          // Gets the row number from <tr> id.
          var dig = parseInt(id.substring(1));
  
          // Modifying row index.
          idx.html(`Row ${dig - 1}`);
  
          // Modifying row id.
          $(this).attr('id', `R${dig - 1}`);
        });
  
        // Removing the current row.
        $(this).closest('tr').remove();
  
        // Decreasing total number of rows by 1.
        rowIdx--;
      });