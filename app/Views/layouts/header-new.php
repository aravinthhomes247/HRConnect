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

    <body>
        <div class="layout">
            <?php
            $fdate = date("Y-m-d");
            $todate = date("Y-m-d");
            $currentpage = uri_string();
            $currentpage = preg_replace('/\/\d+$/', '', $currentpage)
            // print_r($currentpage);exit(0);
            ?>
            <?php if ($session->get('user_level') == 42) { ?>
                <div class="sidebar">
                    <img src="<?php echo base_url('../public/images/hr-connect.png'); ?>">
                    <ul class="list-group">
                        <a href="<?php echo base_url('/dashboard') ?>">
                            <li class="list-group-item <?= ($currentpage == 'dashboard' || $currentpage == 'holidays' || $currentpage == 'add-holiday' || $currentpage == 'edit-holiday' || $currentpage == 'presents' || $currentpage == 'absents') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/calendar-lines.ico'); ?>" class="sidemenu-img-1"><span>Attanance</span></li>
                        </a>
                        <a href="<?php echo base_url('/HRBasedDashboard?fdate=' . $fdate . '&todate=' . $todate . '&HRid=default') ?>">
                            <li class="list-group-item <?= ($currentpage == 'HRBasedDashboard' || $currentpage == 'allevents') ? 'active' : '' ?>"><img src="<?php echo base_url('../public/images/img/hr-group.ico'); ?>" class="sidemenu-img-2"><span>HR Dashboard</span></li>
                        </a>
                        <a href="<?php echo base_url('/departments') ?>">
                            <li class="list-group-item <?= ($currentpage == 'departments' || $currentpage == 'add-department' || $currentpage == 'edit-department') ? 'active' : '' ?>"><img src="<?php echo base_url('../public/images/img/corporate.png'); ?>" class="sidemenu-img-10"><span>Departments</span></li>
                        </a>
                        <a href="<?php echo base_url('/login-accounts') ?>">
                            <li class="list-group-item <?= ($currentpage == 'login-accounts' || $currentpage == 'edit-account') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/key_blur.png'); ?>" class="sidemenu-img-12"><span>Accounts</span></li>
                        </a>
                        <a href="<?php echo base_url('/totalEmps?trickid=1') ?>">
                            <li class="list-group-item <?= ($currentpage == 'totalEmps' || $currentpage == 'editEmp-view' || $currentpage == 'add_emp') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/department.ico'); ?>" class="sidemenu-img-3"><span>Employees</span></li>
                        </a>
                        <a href="<?php echo base_url('/reportemp?trickid=1&fdate=' . $fdate . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'reportemp') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/time-fast.ico'); ?>" class="sidemenu-img-4"><span>Time Logs</span></li>
                        </a>
                        <a href="<?php echo base_url('tickets?trickid=1&fdate=' . $fdate . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'tickets') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/Vector.ico'); ?>" class="sidemenu-img-5"><span>Tickets</span></li>
                        </a>
                        <a href="<?php echo base_url('payrolls?trickid=1&fdate=' . date('Y-m-d', strtotime('-1 month', strtotime($fdate)))) ?>">
                            <li class="list-group-item <?= ($currentpage == 'payrolls') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/calendar-salary.ico'); ?>" class="sidemenu-img-6"><span>Payrolls</span></li>
                        </a>
                        <a href="<?php echo base_url('/leave?trickid=1&fdate=' . $fdate . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'leave') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/department.ico'); ?>" class="sidemenu-img-3"><span>Leaves</span></li>
                        </a>
                        <a href="<?php echo base_url('careers?&fdate=' . date("2020-01-01") . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'careers' || $currentpage == 'applicants' || $currentpage == 'add-career' || $currentpage == 'edit-career') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/career.ico'); ?>" class="sidemenu-img-7"><span>Careers</span></li>
                        </a>
                        <a href="<?php echo base_url('/interviewers_list') ?>">
                            <li class="list-group-item <?= ($currentpage == 'interviewers_list') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/interview.ico'); ?>" class="sidemenu-img-8"><span>Interviewers</span></li>
                        </a>
                        <a href="javascript:void(0);">
                            <li class="list-group-item candidates-menu <?= in_array($currentpage, ['candidate', 'my_overdues', 'todays_activity']) ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/candi.ico'); ?>" class="sidemenu-img-9"><span>Candidates<i class="fa-solid fa-angle-down down-icon"></i><i class="fa-solid fa-angle-up up-icon hidden"></i></span></li>
                        </a>
                        <ul class="sublist <?= in_array($currentpage, ['candidate', 'my_overdues', 'todays_activity']) ? '' : 'hidden' ?>">
                            <a href="<?php echo site_url('/candidate?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item  <?= ($currentpage == 'candidate' && $trickid != 11 && $trickid != 9) ? 'active' : '' ?>">Track Candidates</li>
                            </a>
                            <a href="<?php echo site_url('/candidate?trickid=11&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item <?= ($currentpage == 'candidate' && $trickid == 11) ? 'active' : '' ?>">Today Scheduled</li>
                            </a>
                            <a href="<?php echo site_url('/candidate?trickid=9&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item <?= ($currentpage == 'candidate' && $trickid == 9) ? 'active' : '' ?>">Upcoming Scheduled</li>
                            </a>
                            <a href="<?php echo site_url('/my_overdues?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item <?= ($currentpage == 'my_overdues') ? 'active' : '' ?>">My Overdues</li>
                            </a>
                            <a href="<?php echo site_url('/todays_activity?fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item <?= ($currentpage == 'todays_activity') ? 'active' : '' ?>">Track Activities</li>
                            </a>
                        </ul>
                        <a href="<?php echo base_url('/settings') ?>">
                            <li class="list-group-item <?= ($currentpage == 'settings') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/setting.ico'); ?>" class="sidemenu-img-11"><span>Settings</span></li>
                        </a>
                    </ul>
                </div>
            <?php } else if ($session->get('user_level') == 1 || $session->get('user_level') == 18) { ?>
                <div class="sidebar">
                    <img src="<?php echo base_url('../public/images/hr-connect.png'); ?>">
                    <ul class="list-group">
                        <a href="<?php echo base_url('/dashboard') ?>">
                            <li class="list-group-item <?= ($currentpage == 'dashboard' || $currentpage == 'holidays' || $currentpage == 'add-holiday' || $currentpage == 'edit-holiday' || $currentpage == 'presents' || $currentpage == 'absents') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/calendar-lines.ico'); ?>" class="sidemenu-img-1"><span>Attanance</span></li>
                        </a>
                        <a href="<?php echo base_url('/HRdashboard?fdate=' . $fdate . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'HRdashboard' || $currentpage == 'allevents') ? 'active' : '' ?>"><img src="<?php echo base_url('../public/images/img/hr-group.ico'); ?>" class="sidemenu-img-2"><span>Dashboard</span></li>
                        </a>
                        <a href="<?php echo base_url('/departments') ?>">
                            <li class="list-group-item <?= ($currentpage == 'departments' || $currentpage == 'add-department' || $currentpage == 'edit-department') ? 'active' : '' ?>"><img src="<?php echo base_url('../public/images/img/corporate.png'); ?>" class="sidemenu-img-10"><span>Departments</span></li>
                        </a>
                        <a href="<?php echo base_url('/login-accounts') ?>">
                            <li class="list-group-item <?= ($currentpage == 'login-accounts' || $currentpage == 'edit-account') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/key_blur.png'); ?>" class="sidemenu-img-12"><span>Accounts</span></li>
                        </a>
                        <a href="<?php echo base_url('/totalEmps?trickid=1') ?>">
                            <li class="list-group-item <?= ($currentpage == 'totalEmps' || $currentpage == 'editEmp-view' || $currentpage == 'add_emp') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/department.ico'); ?>" class="sidemenu-img-3"><span>Employees</span></li>
                        </a>
                        <a href="<?php echo base_url('careers?&fdate=' . date("2020-01-01") . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'careers' || $currentpage == 'applicants' || $currentpage == 'add-career' || $currentpage == 'edit-career') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/career.ico'); ?>" class="sidemenu-img-7"><span>Careers</span></li>
                        </a>
                        <a href="<?php echo base_url('/leave?trickid=1&fdate=' . $fdate . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'leave') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/department.ico'); ?>" class="sidemenu-img-3"><span>Leaves</span></li>
                        </a>
                        <a href="javascript:void(0);">
                            <li class="list-group-item candidates-menu"> <img src="<?php echo base_url('../public/images/img/candi.ico'); ?>" class="sidemenu-img-9"><span>Candidates<i class="fa-solid fa-angle-down down-icon"></i><i class="fa-solid fa-angle-up up-icon hidden"></i></span></li>
                        </a>
                        <ul class="sublist <?= in_array($currentpage, ['HRcandidate_List', 'HRmy_overdues', 'HRtodays_activity']) ? '' : 'hidden' ?>">
                            <a href="<?php echo base_url('/HRcandidate_List?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item <?= ($currentpage == 'HRcandidate_List' && $trickid != 11 && $trickid != 9) ? 'active' : '' ?>">Track Candidates</li>
                            </a>
                            <a href="<?php echo site_url('/HRcandidate_List?trickid=11&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item <?= ($currentpage == 'HRcandidate_List' && $trickid == 11) ? 'active' : '' ?>">Today Scheduled</li>
                            </a>
                            <a href="<?php echo site_url('/HRcandidate_List?trickid=9&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item <?= ($currentpage == 'HRcandidate_List' && $trickid == 9) ? 'active' : '' ?>">Upcoming Scheduled</li>
                            </a>
                            <a href="<?php echo site_url('/HRmy_overdues?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item <?= ($currentpage == 'HRmy_overdues') ? 'active' : '' ?>">My Overdues</li>
                            </a>
                            <a href="<?php echo base_url('/HRtodays_activity?&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item <?= ($currentpage == 'HRtodays_activity') ? 'active' : '' ?>">Track Activities</li>
                            </a>
                        </ul>
                        <a href="<?php echo base_url('HRTickets') ?>">
                            <li class="list-group-item <?= ($currentpage == 'HRTickets') ? 'active' : '' ?>"><img src="<?php echo base_url('../public/images/img/Vector.ico'); ?>" class="sidemenu-img-5"><span>My Tickets</span></li>
                        </a>
                        <a href="<?php echo base_url('/HRpayroll?&fdate=' . date("2020-01-01") . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'HRpayroll') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/calendar-salary.ico'); ?>" class="sidemenu-img-6"><span>My Payrolls</span></li>
                        </a>
                        <a href="<?php echo base_url('/HRleave?fdate=' . $fdate . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'HRleave') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/department.ico'); ?>" class="sidemenu-img-3"><span>My Leaves</span></li>
                        </a>
                    </ul>
                </div>
            <?php } else if ($session->get('user_level') == 24) { ?>
                <div class="sidebar">
                    <img src="<?php echo base_url('../public/images/hr-connect.png'); ?>">
                    <ul class="list-group">
                        <a href="<?php echo base_url('/HRdashboard?fdate=' . $fdate . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'HRdashboard' || $currentpage == 'allevents') ? 'active' : '' ?>"><img src="<?php echo base_url('../public/images/img/hr-group.ico'); ?>" class="sidemenu-img-2"><span>Dashboard</span></li>
                        </a>
                        <a href="<?php echo base_url('careers?&fdate=' . date("2020-01-01") . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'careers' || $currentpage == 'applicants' || $currentpage == 'add-career' || $currentpage == 'edit-career') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/career.ico'); ?>" class="sidemenu-img-7"><span>Careers</span></li>
                        </a>
                        <a href="javascript:void(0);">
                            <li class="list-group-item candidates-menu"> <img src="<?php echo base_url('../public/images/img/candi.ico'); ?>" class="sidemenu-img-9"><span>Candidates<i class="fa-solid fa-angle-down down-icon"></i><i class="fa-solid fa-angle-up up-icon hidden"></i></span></li>
                        </a>
                        <ul class="sublist <?= in_array($currentpage, ['HRcandidate_List', 'HRmy_overdues', 'HRtodays_activity']) ? '' : 'hidden' ?>">
                            <a href="<?php echo base_url('/HRcandidate_List?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item <?= ($currentpage == 'HRcandidate_List' && $trickid != 11 && $trickid != 9) ? 'active' : '' ?>">Track Candidates</li>
                            </a>
                            <a href="<?php echo site_url('/HRcandidate_List?trickid=11&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item <?= ($currentpage == 'HRcandidate_List' && $trickid == 11) ? 'active' : '' ?>">Today Scheduled</li>
                            </a>
                            <a href="<?php echo site_url('/HRcandidate_List?trickid=9&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item <?= ($currentpage == 'HRcandidate_List' && $trickid == 9) ? 'active' : '' ?>">Upcoming Scheduled</li>
                            </a>
                            <a href="<?php echo site_url('/HRmy_overdues?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item <?= ($currentpage == 'HRmy_overdues') ? 'active' : '' ?>">My Overdues</li>
                            </a>
                            <a href="<?php echo base_url('/HRtodays_activity?&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=') ?>">
                                <li class="list-group-item <?= ($currentpage == 'HRtodays_activity') ? 'active' : '' ?>">Track Activities</li>
                            </a>
                        </ul>
                        <a href="<?php echo base_url('HRTickets') ?>">
                            <li class="list-group-item <?= ($currentpage == 'HRTickets') ? 'active' : '' ?>"><img src="<?php echo base_url('../public/images/img/Vector.ico'); ?>" class="sidemenu-img-5"><span>Tickets</span></li>
                        </a>
                        <a href="<?php echo base_url('/HRpayroll?&fdate=' . date("2020-01-01") . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'HRpayroll') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/calendar-salary.ico'); ?>" class="sidemenu-img-6"><span>Payroll</span></li>
                        </a>
                        <a href="<?php echo base_url('/HRleave?fdate=' . $fdate . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'HRleave') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/department.ico'); ?>" class="sidemenu-img-3"><span>Leave</span></li>
                        </a>
                    </ul>
                </div>
            <?php } else { ?>
                <div class="sidebar">
                    <img src="<?php echo base_url('../public/images/hr-connect.png'); ?>">
                    <ul class="list-group">
                        <a href="<?php echo base_url('/user-dashboard?fdate=' . $fdate . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'user-dashboard') ? 'active' : '' ?>"><img src="<?php echo base_url('../public/images/img/calendar-lines.ico'); ?>" class="sidemenu-img-1"><span>Dashboard</span></li>
                        </a>
                        <!-- <a href="<?php echo base_url('/user-attendance?fdate=' . date("2020-01-01") . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'user-attendance') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/hr-group.ico'); ?>" class="sidemenu-img-2"><span>Attendence</span></li>
                        </a> -->
                        <a href="<?php echo base_url('/user-leave?fdate=' . $fdate . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'user-leave') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/department.ico'); ?>" class="sidemenu-img-3"><span>Leave</span></li>
                        </a>
                        <a href="<?php echo base_url('/user-timelog?&fdate=' . $fdate . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'user-timelog') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/time-fast.ico'); ?>" class="sidemenu-img-4"><span>Time Log</span></li>
                        </a>
                        <a href="<?php echo base_url('/user-ticket?fdate=' . $fdate . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'user-ticket') ? 'active' : '' ?>"><img src="<?php echo base_url('../public/images/img/Vector.ico'); ?>" class="sidemenu-img-5"><span>Tickets</span></li>
                        </a>
                        <a href="<?php echo base_url('/user-payroll?&fdate=' . date("2020-01-01") . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'user-payroll') ? 'active' : '' ?>"> <img src="<?php echo base_url('../public/images/img/calendar-salary.ico'); ?>" class="sidemenu-img-6"><span>Payroll</span></li>
                        </a>
                        <a href="<?php echo base_url('/user-event?fdate=' . $fdate . '&todate=' . $todate) ?>">
                            <li class="list-group-item <?= ($currentpage == 'user-event') ? 'active' : '' ?>"><img src="<?php echo base_url('../public/images/img/calendar-salary.ico'); ?>" class="sidemenu-img-6"><span>Events</span></li>
                        </a>
                    </ul>
                </div>
            <?php } ?>

            <div class="page-content">
                <nav class="navbar">
                    <div class="container-fluid">
                        <form class="d-flex">
                            <!-- <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input class="form-control main-search-box" type="search" placeholder="Search employee" aria-label="Search">
                            </div> -->
                        </form>
                        <div class="nav-myprofile">
                            <?php
                            if (empty($session->get('Image')) || $session->get('Image') == null) { ?>
                                <img class="circular--landscape" src="<?php echo base_url('public/images/default-profile.png') ?>">
                            <?php } else { ?>
                                <img class="circular--landscape" src="<?php echo base_url('public/Uploads/ProfilePhotosuploads/' . $session->get('Image')); ?>" alt="demo">
                            <?php } ?>

                            <div class="dropdown-container">
                                <button class="btn pb-0" type="button" id="dropdownButton">
                                    <?= $session->get('EmployeeName') ?? $session->get('user_name'); ?> <i class="fa-solid fa-angle-down"></i>
                                </button><br>
                                <span><?= $session->get('Designation') ?? 'NA'; ?></span>
                                <ul class="dropdown-item" id="dropdownItem">
                                    <ul>
                                        <a href="#">Notifications <i class="fa-regular fa-bell nav-bar-icon"></i></a>
                                    </ul>
                                    <?php if ($session->get('user_level') == 42) { ?>
                                        <ul>
                                            <a href="<?php echo base_url('/settings') ?>">Settings <i class="fa-solid fa-gear nav-bar-icon"></i></a>
                                        </ul>
                                    <?php } ?>
                                    <ul>
                                        <a href="<?php echo (base_url('logout')) ?>">
                                            Logout <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        </a>
                                    </ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                <?php echo ($this->renderSection("body")) ?>
            </div>
        </div>
    </body>


    <!-- datetimepicker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="<?php echo base_url('../public/js/timepicker-bs4.js'); ?>"></script>

    <?php if ($currentpage == 'payrolls') { ?>
        <!-- monthpicker -->
        <script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('../public/js/monthpicker.js'); ?>"></script>
    <?php } ?>

    <!-- DataTable bootstrup 5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/b-3.2.0/b-html5-3.2.0/datatables.min.js"></script>


    <!-- tiny editor -->
    <?php

    use App\Models\CareerModel;

    $this->careerModel = new CareerModel();
    $ret_arr = $this->careerModel->get_tinyMCE_code();
    ?>
    <script src="https://cdn.tiny.cloud/1/<?= $ret_arr['tinyMCE_API']; ?>/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        document.getElementById('dropdownButton').addEventListener('click', function() {
            const dropdownItem = document.getElementById('dropdownItem');
            dropdownItem.style.display = dropdownItem.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function(event) {
            const button = document.getElementById('dropdownButton');
            const dropdownItem = document.getElementById('dropdownItem');
            if (!button.contains(event.target) && !dropdownItem.contains(event.target)) {
                dropdownItem.style.display = 'none';
            }
        });


        $(document).ready(function() {
            const downIcon = $('.candidates-menu .down-icon');
            const upIcon = $('.candidates-menu .up-icon');
            if ($('.sublist').hasClass('hidden')) {
                downIcon.css('display', 'inline-block');
                upIcon.css('display', 'none');
            } else {
                downIcon.css('display', 'none');
                upIcon.css('display', 'inline-block');
            }

            $('.candidates-menu').on('click', function() {
                const sublist = $('.sublist').toggleClass('hidden');
                if ($('.sublist').hasClass('hidden')) {
                    downIcon.css('display', 'inline-block');
                    upIcon.css('display', 'none');
                } else {
                    downIcon.css('display', 'none');
                    upIcon.css('display', 'inline-block');
                }
            });
        });

        $(document).ready(function() {
            $('#dataTable').DataTable({
                columnDefs: [{
                    className: 'align-left',
                    targets: '_all'
                }]
            });
        });

        tinymce.init({
            selector: 'textarea.TinyMCE',
        });
    </script>
    </lang>

    </html>