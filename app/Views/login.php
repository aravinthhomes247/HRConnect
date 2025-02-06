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

  <style>
    .login-page {
      /* background-Image: #e5652e !important; */
      /* background: url(<?php echo base_url('public/images/login_background.webp'); ?>) no-repeat !important; */
      background: url(<?php echo base_url('public/images/img/login_background.png'); ?>) no-repeat !important;
      background-size: cover !important;
    }

    .card {
      background-color: #FFFFFF !important;
      border: 2px solid white;
    }

    .btn-block {
      display: block;
      width: 95%;
    }

    .bg-color {
      background-color: #8146D4;
    }

    .input-group-text {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-align: center;
      align-items: center;
      padding: .375rem .75rem;
      margin-bottom: 0;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #8146D4;
      text-align: center;
      white-space: nowrap;
      background-color: white;
      width: 75% !important;
    }

    input.inp {
      border-right: none !important;
    }

    i.passeye {
      vertical-align: middle;
      margin-right: 15px;
      padding-left: 1px;
      width: 22px;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline">
      <div class="card-header text-center">
        <a href="#"><img src="https://duzblbyuf5ibr.cloudfront.net/hrpanel/images/Logo-New.png" alt="Homes247.in"></a>
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
        <form action="<?= base_url('login') ?>" method="post">

          <?= csrf_field() ?>
          <div class="input-group mb-3">
            <!-- <input type="email" class="form-control" placeholder="Email"> -->
            <input type="text" class="form-control inp <?php if ($validation->getError('admin_login_email')) : ?>is-invalid<?php endif ?>" name="admin_login_email" placeholder="Email" value="<?php echo set_value('admin_login_email'); ?>" />
            <div class="input-group-append">
              <div class="input-group-text">
                <!-- <span class="fas fa-envelope"></span> -->
                <img src="<?= base_url('public/images/img/mail.png') ?>" class="w-100" alt="mail">
              </div>
            </div>
            <?php if ($validation->getError('admin_login_email')) : ?>
              <div class="invalid-feedback">
                <?= $validation->getError('admin_login_email') ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="input-group mb-3">
            <input type="password" id="admin_login_password" class="form-control inp <?php if ($validation->getError('admin_login_password')) : ?>is-invalid <?php endif ?>" name="admin_login_password" placeholder="Password" value="<?php echo set_value('admin_login_email'); ?>" />
            <div class="input-group-append">
              <div class="input-group-text" id="togglePassword">
                <i class="fa fa-eye passeye"></i>
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
              <button type="submit" class="btn bg-color btn-block text-white">Log In</button>
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

  <script>
    document.getElementById('togglePassword').addEventListener('click', function() {
      var passwordInput = document.getElementById('admin_login_password');
      var icon = this.querySelector('i');

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    });
  </script>
</body>

</html>