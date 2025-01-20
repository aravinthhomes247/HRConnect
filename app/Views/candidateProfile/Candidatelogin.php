<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Homes247.in</title>
  <!-- <link rel="icon" type="image/png" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/public/favicon.png"> -->
  <!-- <link rel="icon" type="image/png" href="<?php echo base_url('../public/favicon.png'); ?>"> -->
  <link rel="icon" type="image/png" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/favicon.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Theme style -->
  <link rel="stylesheet" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/css/adminlte.min.css">
  <link rel="stylesheet" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/css/adminStyle.css">

  <style>
    .card-blues.card-outline {
        border-top: 3px solid #0b3544 !important;
    }

    .bg-blues {
        background-color: #0b3544!important;
        /* color: #fff; */
    }
    .login-page {
        /* background-image: #0b3544!important; */
        background: url("https://wallpaperaccess.com/full/1393442.jpg") no-repeat !important;
        background-size: cover;
        /* color: #fff; */
    }


  </style>



</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-blues">
    <div class="card-header text-center">
      <a href="#"><img src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/images/Logo-New.png" alt="Homes247.in" ></a>
    </div>
    <div class="card-body">
      <!-- <p class="login-box-msg text-white">Think<span class="text-color"></span> Home Think Us</p> -->
      <?php if (session()->getFlashdata('failed')) : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button> -->
                        <?php echo session()->getFlashdata('failed') ?>
                    </div>
                <?php endif; ?>
      <?php $validation =  \Config\Services::validation(); ?>
    <form action="<?= base_url('Candidatelogin') ?>" method="post">

        <?= csrf_field() ?>
        <!-- <span>Your Email as UserName</span> -->
        <div class="input-group mb-3">
          <!-- <input type="email" class="form-control" placeholder="Email"> -->
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <input type="text" class="form-control <?php if ($validation->getError('admin_login_email')) : ?>is-invalid<?php endif ?>" name="admin_login_email" placeholder="Your Email as UserName" value="<?php echo set_value('admin_login_email'); ?>" />
            <?php if ($validation->getError('admin_login_email')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('admin_login_email') ?>
                </div>
            <?php endif; ?>
        </div>
      
        <div class="input-group mb-3">
            <input type="password" class="form-control <?php if ($validation->getError('admin_login_password')) : ?>is-invalid <?php endif ?>" name="admin_login_password" placeholder="Your Contact No as Password" value="<?php echo set_value('admin_login_email'); ?>" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <?php if ($validation->getError('admin_login_password')) : ?>
            <div class="invalid-feedback">
                <?= $validation->getError('admin_login_password') ?>
            </div>
          <?php endif; ?>
        </div>
       
        <div class="row">          
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn bg-blues btn-block text-white">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
    </form>

      

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/js/adminlte.min.js"></script>
</body>
</html>
