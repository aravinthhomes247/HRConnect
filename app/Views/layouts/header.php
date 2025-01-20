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
  <link rel="stylesheet" href="<?php echo base_url('../public/dist/css/style-old.css'); ?>">
  <!-- <link rel="stylesheet" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/css/style.css"> -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/css/tempusdominus-bootstrap-4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/css/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url('../public/plugins/toastr/toastr.min.css'); ?>">

  <!-- Select2 -->
  <!-- <link rel="stylesheet" href="<?php echo base_url('../public/dist/plugins/select2/css/select2.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('../public/dist/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">

<link href="https://cdn.jsdelivr.net/npm/bootstrap4-select2-theme@1.0.3/src/css/bootstrap4-select2-theme.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">



</head>
<!-- <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed"> -->

<body class="sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse">
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
          <a class="nav-link" href="<?= base_url('logout') ?>" role="button">
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
      <a href="<?php echo base_url('/dashboard') ?>" class="brand-link">
        <!-- <img src="<?php echo base_url('public/images/emblem.png') ?>" alt="Homes247.in" class="brand-image img-circle elevation-3"style="opacity: .8;width: 40px; margin-top: 10px;" > -->
        <span class="brand-text font-weight-light"> <img src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/images/Logo-New.png" alt="Homes247.in"></span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-4 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/images/default.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $session->get('user_name');  ?> </a>
          </div>
        </div>

        <?php
        $fdate = date("Y-m-d");
        $todate = date("Y-m-d");
        ?>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php if ($session->get('user_level') == 1) { ?>
              <li class="nav-item">
                <a href="<?php echo base_url('/dashboard') ?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-house"></i>
                  <p>Attendance Dashboard </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/HRBasedDashboard?fdate=' . $fdate . '&todate=' . $todate . '&HRid=default') ?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-grip"></i>
                  <p>HR Dashboard <span class="right badge badge-danger">New</span> </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/allevents') ?>" class="nav-link">
                  <!-- <i class="nav-icon fas fa-calendar"></i> -->
                  <i class="nav-icon fa-solid fa-calendar-days"></i>
                  <p> Events </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/totalEmps?trickid=1') ?>" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p> Employees </p>
                </a>
              </li>
              <li class="nav-item">

                <a href="<?php echo base_url('/reportemp?&fdate=' . $fdate . '&todate=' . $todate) ?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-file-invoice"></i>
                  <p> All LogReports</p>
                </a>

              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('/mailBox?&fdate=' . $fdate . '&todate=' . $todate . '&trickid=1&deptsid=1') ?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-envelope-open-text"></i>
                  <p> MailBox </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('/interviewers_list') ?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-chalkboard-user"></i>
                  <p> Interviewers </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-solid fa-people-carry-box"></i>
                  <p>
                    Candidates
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item ">
                    <a href="<?php echo base_url('/candidate?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>Track Candidates </p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="<?php echo site_url('/candidate?trickid=11&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>Today Scheduled </p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="<?php echo site_url('/candidate?trickid=9&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>Upcoming Scheduled </p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="<?php echo site_url('/my_overdues?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>My Overdues </p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="<?php echo base_url('/todays_activity?fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>Track Activities</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('careers?&fdate=' . date("2020-01-01") . '&todate=' . $todate) ?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-briefcase"></i>
                  <p> Careers </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('settings') ?>" class="nav-link">
                <i class="nav-icon fa-solid fa-wrench"></i>
                  <p> Settings </p>
                </a>
              </li>

            <?php } elseif ($session->get('user_level') == 18) { ?>
              <?php
              $fdate = date("Y-m-d");
              $todate = date("Y-m-d");
              ?>
              <li class="nav-item">
                <a href="<?php echo base_url('/HRdashboard?fdate=' . $fdate . '&todate=' . $todate) ?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-grip"></i>
                  <p>Dashboard <span class="right badge badge-danger">New</span> </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/dashboard') ?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-house"></i>
                  <p>Attendance Dashboard </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/totalEmps?trickid=1') ?>" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p> Employees </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('/reportemp?&fdate=' . $fdate . '&todate=' . $todate) ?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-file-invoice"></i>
                  <p> All LogReports</p>
                </a>
              </li>
              <!-- <li class="nav-item">
            <a href="<?php echo base_url('/HRcandidate_List?&fdate=' . $fdate . '&todate=' . $todate . '&trickid=13') ?>" class="nav-link">           
            <i class="nav-icon fa-solid fa-people-carry-box"></i>
              <p> Candidates </p>
            </a>            
          </li> -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-solid fa-people-carry-box"></i>
                  <p>
                    Candidates
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item ">
                    <a href="<?php echo base_url('/HRcandidate_List?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>Track Candidates </p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="<?php echo site_url('/HRcandidate_List?trickid=11&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>Today Scheduled </p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="<?php echo site_url('/HRcandidate_List?trickid=9&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>Upcoming Scheduled </p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="<?php echo site_url('/HRmy_overdues?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>My Overdues </p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="<?php echo base_url('/HRtodays_activity?&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>Track Activities </p>
                    </a>
                  </li>

                </ul>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('careers?&fdate=' . date("2020-01-01") . '&todate=' . $todate) ?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-briefcase"></i>
                  <p> Careers </p>
                </a>
              </li>


            <?php } elseif ($session->get('user_level') == 24) { ?>
              <?php
              $fdate = date("Y-m-d");
              $todate = date("Y-m-d");
              ?>
              <li class="nav-item">
                <a href="<?php echo base_url('/HRdashboard?fdate=' . $fdate . '&todate=' . $todate) ?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-grip"></i>
                  <p>Dashboard <span class="right badge badge-danger">New</span> </p>
                </a>
              </li>
              <!-- <li class="nav-item">
            <a href="<?php echo base_url('/dashboard') ?>" class="nav-link">
            <i class="nav-icon fa-solid fa-house"></i>
              <p>Attendance Dashboard </p>
            </a>
          </li>          
          <li class="nav-item">
            <a href="<?php echo base_url('/totalEmps?trickid=1') ?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p> Employees </p>
            </a>
          </li> -->
              <!-- <li class="nav-item">            
            <a href="<?php echo base_url('/reportemp?&fdate=' . $fdate . '&todate=' . $todate) ?>" class="nav-link">
              <i class="nav-icon fa-solid fa-file-invoice"></i>
              <p> All LogReports</p>
            </a>            
          </li> -->
              <!-- <li class="nav-item">
            <a href="<?php echo base_url('/HRcandidate_List?&fdate=' . $fdate . '&todate=' . $todate . '&trickid=13') ?>" class="nav-link">           
            <i class="nav-icon fa-solid fa-people-carry-box"></i>
              <p> Candidates </p>
            </a>            
          </li> -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-solid fa-people-carry-box"></i>
                  <p>
                    Candidates
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item ">
                    <a href="<?php echo base_url('/HRcandidate_List?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>Track Candidates </p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="<?php echo site_url('/HRcandidate_List?trickid=11&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>Today Scheduled </p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="<?php echo site_url('/HRcandidate_List?trickid=9&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>Upcoming Scheduled </p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="<?php echo site_url('/HRmy_overdues?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>My Overdues </p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="<?php echo base_url('/HRtodays_activity?&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>" class="nav-link pl-5">
                      <!-- <i class="far fa-circle nav-icon"></i> -->
                      <p>Track Activities </p>
                    </a>
                  </li>

                </ul>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('careers?&fdate=' . date("2020-01-01") . '&todate=' . $todate) ?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-briefcase"></i>
                  <p> Careers </p>
                </a>
              </li>
            <?php } ?>



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
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/select2.full.min.js"></script>

    <link rel="stylesheet" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/css/daterangepicker.css">
    <script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/daterangepicker.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/sweetalert2.min.js"></script>

    <!-- Toastr -->
    <script src="<?php echo base_url('public/plugins/toastr/toastr.min.js') ?>"></script>

    <!-- CKeditor -->
    <script type="text/javascript" src="<?php echo base_url('public/dist/js/ckeditor.js') ?>"></script>


    <!-- tiny editor -->
    <?php

    use App\Models\CareerModel;

    $this->careerModel = new CareerModel();
    ?>
    <?php $ret_arr = $this->careerModel->get_tinyMCE_code(); ?>
    <script src="https://cdn.tiny.cloud/1/<?= $ret_arr['tinyMCE_API']; ?>/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea#JobDescription',
      });
    </script>

    <script>
      $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        });


      });
    </script>



    <!-- exportOptions  -->
    <script>
      $(document).ready(function() {
        var table = $('#example').DataTable({
          "paging": true,
          "info": true,
          // "order":true,

          buttons: [{
              extend: 'excel'
            },
            {
              extend: 'pdfHtml5',
              title: ' ',
              footer: true,
              customize: function(doc) {
                doc.content.splice(1, 0, {
                  margin: [0, 0, 0, 12],
                  width: 90,
                  alignment: 'center',
                  image: 'data:image/png;base64,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'

                }, {
                  text: 'HM Towers,5th Floor, East Wing, \n #58,Brigade Road, Bengaluru, 560001 \n ',
                  alignment: 'center',
                  bold: true,
                  width: 'auto'
                  //, margin: [0, 10, 0, 0]
                });
                doc['footer'] = (function(page, pages) {
                  return {
                    columns: [
                      '	© Homes247.in',
                      {
                        // This is the right column
                        alignment: 'right',
                        text: ['page ', {
                          text: page.toString()
                        }, ' of ', {
                          text: pages.toString()
                        }]
                      }
                    ],
                    margin: [30, 10]
                  }
                });
              }
            },
          ]
        });

        $('.button_export_excel').click(() => {
          $('#example').DataTable().buttons(0, 0).trigger()
        })
        $('.button_export_pdf').click(() => {
          $('#example').DataTable().buttons(0, 1).trigger()
        })
      });
    </script>


    <!-- DataRangepicker -->
    <script>
      //Date and time picker
      $('#reservationdatetime').datetimepicker({
        icons: {
          time: 'far fa-clock'
        },
        format: 'YYYY/MM/DD HH:mm',
        // hoursDisabled: '0,1,2,3,4,5,6,7,8,18,19,20,21,22,23',
        enabledHours: [9, 10, 11, 12, 13, 14, 15, 16, 17, 18],
        // useCurrent:false,
        // format: 'YYYY-MM-DD hh:mm:00',

        // autoclose: true,
        // showMeridian:false,
      });
      // $('#reservationdatetime').datetimepicker({ 
      //     icons: { time: 'far fa-clock' },
      //     format: 'YYYY/MM/DD HH:mm A',
      //     // inline:true,
      //     // sidebyside:true,
      //   });
      $('#reservationdatetime1').datetimepicker({
        icons: {
          time: 'far fa-clock'
        },
        format: 'YYYY/MM/DD HH:mm',
        enabledHours: [9, 10, 11, 12, 13, 14, 15, 16, 17, 18],
        useCurrent: false,
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
        format = format.replace("MM", month.toString().padStart(2, "0"));

        //replace the year
        if (format.indexOf("yyyy") > -1) {
          format = format.replace("yyyy", year.toString());
        } else if (format.indexOf("yy") > -1) {
          format = format.replace("yy", year.toString().substr(2, 2));
        }

        //replace the day
        format = format.replace("dd", day.toString().padStart(2, "0"));

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



    <script>
      $(document).ready(function() {
        $('#emps-list').DataTable({
          // "scrollX": true       
        });
      });
    </script>

    <!-- profile image  -->
    <script>
      $(function() {
        bsCustomFileInput.init();
      });

      function readURL(input, id) {
        id = id || '#blah';
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
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