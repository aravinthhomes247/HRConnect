<?php $session = \Config\Services::session(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Homes24/7.in</title>
    <!-- <link rel="icon" type="image/png" href="<?php echo base_url('../public/favicon.png'); ?>"> -->
  <link rel="icon" type="image/png" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/favicon.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/css/adminlte.min.css">
  <!-- Custom CSS  -->
  <link rel="stylesheet" href="<?php echo base_url('../public/dist/css/style.css');?>">
  <!-- <link rel="stylesheet" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/css/style.css"> -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/css/tempusdominus-bootstrap-4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/css/bootstrap-4.min.css">

  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url('../public/plugins/toastr/toastr.min.css'); ?>">



<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/moment.min.js"></script>
<!-- jQuery -->
<script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/jquery.min.js"></script>
<!-- CKeditor -->
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link"  href="<?= base_url('candidatelogout') ?>" role="button">
          <i class="fas fa-power-off"></i>
        </a>
      </li>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar main-sidebar-custom sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('/CandidateDashboard')?>" class="brand-link">
      <!-- <img src="<?php //echo base_url('../favicon.png')?>" alt="Homes247.in" class="brand-image img-circle elevation-3"style="opacity: .8;width: 40px; margin-top: 10px;" > -->
      <span class="brand-text font-weight-light"> <img src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/images/Logo-New.png" alt="Homes247.in" ></span>
    </a>
   <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-4 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/images/default.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $session->get('CandidateName');  ?>   </a>
        </div>
      </div>

   

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="<?php echo base_url('/CandidateDashboard')?>" class="nav-link">
              <i class="nav-icon fa-solid fa-grip"></i>
              <p>Dashboard <span class="right badge badge-danger">New</span> </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="<?php echo base_url('/allevents')?>" class="nav-link">
              <i class="nav-icon fa-solid fa-calendar-days"></i>
              <p> Events  </p>
            </a>
          </li> -->
          
          
          
          
           
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    
    <!-- /.sidebar-custom -->
  </aside>
  <?= $this->renderSection("body") ?>

 
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- overlayScrollbars -->
<script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/jquery.overlayScrollbars.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/adminlte.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip --> 
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Select2 -->

<!-- Tempusdominus Bootstrap 4 -->
<script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/bs-custom-file-input.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/dashboard.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <links rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css">

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

<script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/select2.full.min.js"></script>
<link rel="stylesheet" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/css/daterangepicker.css">
<script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/daterangepicker.js"></script>

<!-- SweetAlert2 -->
<script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/sweetalert2.min.js"></script>

<!-- Toastr -->
<script src="<?php echo base_url('public/plugins/toastr/toastr.min.js')?>"></script>

<!-- CKeditor -->
<script type="text/javascript" src="<?php echo base_url('public/dist/js/ckeditor.js')?>"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

   
  });
</script>





<!-- DataRangepicker -->
<script>  
  //Date and time picker
  $('#reservationdatetime').datetimepicker({ 
      icons: { time: 'far fa-clock' },
      format: 'YYYY/MM/DD HH:mm',
      // inline:true,
      // sidebyside:true,
    });
    
  $('#reservationdate').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    // Date of joining 
  $('#reservationdate1').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    // Dateof Resign 
  $('#reservationdate2').datetimepicker({
        format: 'YYYY-MM-DD'
    });
  //Initialize Select2 Elements
  $('.select2').select2()

  
  function dateFormat(inputDate, format) {
    //parse the input date
    const date = new Date(inputDate);

    //extract the parts of the date
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();    

    //replace the month
    format = format.replace("MM", month.toString().padStart(2,"0"));        

    //replace the year
    if (format.indexOf("yyyy") > -1) {
        format = format.replace("yyyy", year.toString());
    } else if (format.indexOf("yy") > -1) {
        format = format.replace("yy", year.toString().substr(2,2));
    }

    //replace the day
    format = format.replace("dd", day.toString().padStart(2,"0"));

    return format;
}


$(function() {	
    // var start = moment().subtract(29, 'days');
    // var end = moment();
	var urlstartdate = $('#fdate').val();
	var urlenddate = $('#todate').val();
	var startdateformatchange = dateFormat(urlstartdate, 'MM/dd/yyyy');
	var enddateformatchange = dateFormat(urlenddate, 'MM/dd/yyyy');
	var start = startdateformatchange;
    var end = enddateformatchange;

    function cb(start, end) {
	
        // $('#reportrange').val(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
    cb(start, end);
});


</script>





<!-- profile image  -->
<script>
   $(function () {
            bsCustomFileInput.init();
          });

  function readURL(input, id) {
    id = id || '#blah';
    if (input.files && input.files[0]) {
        var reader = new FileReader();
 
        reader.onload = function (e) {
            $(id)
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
        };
 
        reader.readAsDataURL(input.files[0]);
    }
 }
</script>



</body>
</html>

