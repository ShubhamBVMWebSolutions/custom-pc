 @php $currRouteName  = Route::currentRouteName(); @endphp

 <!-- Loader -->
  <div id="preloader" class="pre_loader_loading" style="display: none;">
    <div class="spinner"></div>
  </div>
  
  <footer class="main-footer">
    <strong>Copyright © 2022 SOI ADMIN</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

<!-- <script>window.jQuery || document.write('<script src="../src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script> -->
<script src="{{url('public/admin-panel/plugins/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{url('public/admin-panel/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!--<script src="{{url('public/admin-panel/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>-->
<script src="{{url('public/admin-panel/plugins/screenfull/dist/screenfull.js')}}"></script>
<!--<script src="{{url('public/admin-panel/dist/js/theme.min.js')}}"></script>-->
<script src="{{url('public/admin-panel/js/form-components.js')}}"></script>
<!--<script src="{{url('public/admin-panel/plugins/sparklines/sparkline.js')}}"></script>-->
<!--<script src="{{url('public/admin-panel/plugins/jqvmap/jquery.vmap.min.js')}}"></script>-->
<!--<script src="{{url('public/admin-panel/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>-->
<script src="{{url('public/admin-panel/plugins/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<script src="{{url('public/admin-panel/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('public/admin-panel/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{url('public/admin-panel/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
<script src="{{url('public/admin-panel/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{url('public/admin-panel/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{url('public/admin-panel/dist/js/adminlte.js')}}"></script>
<script src="{{url('public/admin-panel/dist/js/demo.js')}}"></script>
<!--<script src="{{url('public/admin-panel/dist/js/pages/dashboard.js')}}"></script>-->

<script src="{{url('public/admin-panel/admin_custom_js.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script src="{{url('public/admin-panel/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('public/admin-panel/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('public/admin-panel/js/datatables.js')}}"></script>
<script src="{{url('public/admin-panel/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('public/admin-panel/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>





<script src="{{url('public/admin-panel/plugins/moment/moment.js')}}"></script>
<script src="{{url('public/admin-panel/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{url('public/admin-panel/plugins/d3/dist/d3.min.js')}}"></script>
<script src="{{url('public/admin-panel/plugins/c3/c3.min.js')}}"></script>
<script src="{{url('public/admin-panel/js/tables.js')}}"></script>

<script src="{{url('public/admin-panel/js/charts.js')}}"></script>




@if($currRouteName=='admin.coupon.add' )

<script src="{{url('public/datetime_picker/js/bootstrap-datetimepicker.js')}}"></script>
<script type="text/javascript">
   $('.form_datetime').datetimepicker({
 });
</script>
@endif

 @if($currRouteName=='admin.course.discount.add.update')
    <script src="{{url('public/select2/js/select2.min.js')}}"></script>
    <script type="text/javascript">
      $(".select2").select2({
          placeholder: "Select",
          allowClear: true
      });
    </script>
 @endif

<script type="text/javascript">
    $('.number').keypress(function(event) {
      if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
      }
    });
</script>

 


<script type="text/javascript">
var giftcard_expiry_date="";
$('.expiry_date').change(function(event) {
  // var expiry_date =$('.expiry_date').val();
  giftcard_expiry_date =$(this).val();

});


$('.submitexpirydate').click(function(event) {
        event.preventDefault();
     
          if (confirm('Are you sure, you want to change this date?')) {
             

var giftcardid =$('.submitexpirydate').val();


if(giftcard_expiry_date!=''){


  const today = new Date(giftcard_expiry_date);

const yyyy = today.getFullYear();
let mm = today.getMonth() + 1; // Months start at 0!
let dd = today.getDate();

if (dd < 10) dd = '0' + dd;
if (mm < 10) mm = '0' + mm;
  const formattedToday = yyyy + '-' + mm + '-' + dd;

  $.ajaxSetup({
          headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
        $.ajax({
        type: 'POST',
        dataType:'json',
          data:{formattedToday:formattedToday,giftcard_id:giftcardid},
            url:SITE_URL_ADMIN+"/update-giftcard",
          success:function(data) {
            if(data == 1){
        $('.alert-success-ajax').show();
        $('.alert-danger-ajax').hide();
        // alert('Successfully updated date!');
      }else{
        $('.alert-success-ajax').hide();
        $('.alert-danger-ajax').show();
       
        // alert('Please try again not update date.');
      }
          
          }
        }); 
      }else{
        return false;
      }

  
        return true;
          } else {
            
            return false;
          }
     


// alert(expiry_date);
    });
</script>







<script src="{{url('public/sweet-alert/js/sweetalert.min.js')}}"></script>
<link rel="stylesheet" href="{{url('public/sweet-alert/css/sweetalert.min.css')}}">
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script> 