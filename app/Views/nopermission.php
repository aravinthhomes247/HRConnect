<?php $session = \Config\Services::session(); ?>

<!DOCTYPE html>
<lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Homes24/7.in</title>

        <!-- <link rel="icon" type="image/png" href="https://duzblbyuf5ibr.cloudfront.net/hrpanel/favicon.png"> -->
        <link rel="icon" type="image/x-icon" href="<?php echo base_url('../public/images/favicon.ico'); ?>">

        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Bootsrup 5.3 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

        <!-- Custom CSS  -->
        <link rel="stylesheet" href="<?php echo base_url('../public/dist/css/style.css'); ?>">

        <!-- JQuery -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

        <!-- Date Range Picker -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <!-- Month Picker -->
        <link rel="stylesheet" href="<?php echo base_url('../public/dist/css/MonthPicker.min.css'); ?>">
        <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />

        <!-- DataTable bootsrup 5 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">

        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
        <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/b-3.2.0/b-html5-3.2.0/datatables.min.css" rel="stylesheet">

        <!-- Sweet Alerts -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css">

    </head>

    <style>

        h1 {
            color: red;
            font-size: xx-large;
        }

        h2{
            color: #925EDD;
        }

        i{
            color: #e60505;
            font-size: xxx-large;
        }
    </style>

    <body>

        <div class="container mt-5 pt-5 text-center">
            <i class="fa-solid fa-circle-xmark mt-5 mb-3"></i>
            <h1>403</h1>
            <h2>Access Denied</h2>
            <h3>You don't have permission to view this site.</h3>
            <h6>Go back or <a href="<?= base_url('login') ?>">Login</a> Again!</h6>
        </div>

    </body>
    </lang>

    </html>