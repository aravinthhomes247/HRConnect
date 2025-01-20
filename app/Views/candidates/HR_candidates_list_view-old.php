<?php $session = \Config\Services::session(); ?>

<?php $this->extend("layouts/header") ?>

<?php $this->section("body") ?>
<input type="hidden" id="trickid" value="<?php echo $trickid ?>">
<input type="hidden" id="filter_s_date_1" value="<?= $filter_s_date_1 ?>">
<input type="hidden" id="filter_e_date_1" value="<?= $filter_e_date_1 ?>">
<input type="hidden" id="filter_s_date_2" value="<?= $filter_s_date_2 ?>">
<input type="hidden" id="filter_e_date_2" value="<?= $filter_e_date_2 ?>">
<input type="hidden" id="filter_hr" value="<?= $filter_hr ?>">
<input type="hidden" id="filter_designation" value="<?= $filter_designation ?>">
<input type="hidden" id="filter_source" value="<?= $filter_source ?>">
<input type="hidden" id="filter_reason" value="<?= $filter_reason ?>">

<?php
    if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    }
    ?>

    <style>
        table.table-hover.dataTable.no-footer{
            width: 100% !important;
        }

     
        .reportrange-column {
            position: relative;
            visibility: hidden;
            width: 1px;
        }

        .reportrange-column .daterangepicker {
            position: absolute;
        }

        .table-hover .dates {
            position: absolute;
            top: 9px;
        }

        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_desc:after {
            display: none !important;
        }

        table.dataTable {
            border-collapse: collapse;
            width: 100%;
        }

        /* Add borders to each table header and cell */
        table.dataTable th,
        table.dataTable td {
            border: 1px solid #ced4da;
            padding: 5px;
        }

        .chip {
            display: inline-block;
        padding: 0px 5px;
        /* height: 27px; */
        /* font-size: 15px; */
        line-height: 25px;
        border-radius: 25px;
        color: #8146D4;
        background-color: #F0E5FF;
        margin-right: 4px;
        /* margin-top: 4px; */
        }

        .closebtn {
            padding-left: 10px;
            color: #fff;
            font-weight: 900;
            float: right;
            font-size: 15px;
            cursor: pointer;
        }

        .closebtn:hover {
            color: #000;
        }


        .Search {
            appearance: none;
            /* Standard */
            -webkit-appearance: none;
            /* Chrome & Safari */
            -moz-appearance: none;
            /* Firefox */

            font-weight: 700;
            border: none;
            color: #0b3544;
            text-align: left;
            padding-left: 0.2em;
            
            cursor: pointer;
        }

        .Search:focus {
            outline: none;
            border: none;
            box-shadow: none;
        }

        .select-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .dataTF-icon {
            position: absolute;
            right: 2px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-lg-12 mt-2">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="d-flex justify-content ">
                                            <?php if ($trickid != 11 && $trickid != 9) { ?>
                                                <div class="form-group ml-1 mt-1 ">
                                                    <a href="<?php echo site_url('/add_candidate_view') ?>" class=" btn  btn-sm bg-orange " title="Add New Candidate">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="d-flex justify-content-end ">
                                            <div class="form-group ml-1 mt-1">
                                                <div class="input-group" id="filter-group">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if ($session->getFlashdata('CanidateSuccessMsg')) { ?>
                                        <div class="col-lg-12">
                                            <div class="alert alert-success bg-orange alert-dismissible fade show" role="alert">
                                                <strong><?= $session->getFlashdata('CanidateSuccessMsg') ?></strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-lg-12">
                                        <?php if ($trickid != 11 && $trickid != 9) { ?>
                                            <a href="#" class="btn btn-sm bg-orange mt-1 disabled" id="trackid-12" data-trackid="12"></data-trackid>Untouched <span class="badge badge-light" id="Tit-count-12"></span></a>
                                            <a href="#" class="btn btn-sm bg-orange mt-1 disabled" id="trackid-1" data-trackid="1">Scheduled <span class="badge badge-light" id="Tit-count-1"></span></a>
                                            <a href="#" class="btn btn-sm bg-orange mt-1 disabled" id="trackid-15" data-trackid="15">Arrived <span class="badge badge-light" id="Tit-count-15"></span></a>
                                            <a href="#" class="btn btn-sm bg-orange mt-1 disabled" id="trackid-2" data-trackid="2">Not Scheduled <span class="badge badge-light" id="Tit-count-2"></span></a>
                                            <a href="#" class="btn btn-sm bg-orange mt-1 disabled" id="trackid-4" data-trackid="4">Selected <span class="badge badge-light" id="Tit-count-4"></span></a>
                                            <a href="#" class="btn btn-sm bg-orange mt-1 disabled" id="trackid-6" data-trackid="6">Hold <span class="badge badge-light" id="Tit-count-6"></span></a>
                                            <a href="#" class="btn btn-sm bg-orange mt-1 disabled" id="trackid-5" data-trackid="5">Rejected <span class="badge badge-light" id="Tit-count-5"></span></a>
                                            <!-- <a href="#" class="btn btn-sm bg-orange mt-1 disabled" id="trackid-7" data-trackid="7">Offered <span class="badge badge-light" id="Tit-count-7"></span></a> -->
                                            <a href="#" class="btn btn-sm bg-orange mt-1 disabled" id="trackid-8" data-trackid="8">Joined <span class="badge badge-light" id="Tit-count-8"></span></a>
                                            <a href="#" class="btn btn-sm bg-orange mt-1 disabled" id="trackid-3" data-trackid="3">Junk <span class="badge badge-light" id="Tit-count-3"></span></a>
                                        <?php } else { ?>
                                            <h4><?php echo ($trickid == 11) ? 'Today Scheduled' : 'Upcoming Scheduled' ?> (<span id="Tit-count"></span>)</h4>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <?php if (($trickid == 1)  || ($trickid == 9) || ($trickid == 10) || ($trickid == 11)) { ?>
                                    <table class="table table-hover " id="example11">
                                        <thead>
                                            <tr>
                                                <th>Sl no</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Source</th>
                                                <th>
                                                    <p class="dates">
                                                        Interview Date
                                                        <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                                        <input type="text" class="reportrange-column" id="rangepicker-1" data-ffor="InterviewDate" data-fsfor="Interview Date" />
                                                    </p>
                                                </th>
                                                <!-- <th>Scheduled By</th> -->
                                                <th>
                                                    <p class="dates">
                                                        Uploaded Date
                                                        <i class="far fa-calendar-alt calendar-icon" data-id="2" style="cursor: pointer;"></i>
                                                        <input type="text" class="reportrange-column" id="rangepicker-2" data-ffor="Created_at" data-fsfor="Uploaded Date" />
                                                    </p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                <?php
                                } else if ($trickid == 15) { ?>
                                    <table class="table table-hover " id="example11">
                                        <thead>
                                            <tr>
                                                <th>Sl no</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Source</th>
                                                <th>
                                                    <p class="dates">
                                                        Interview Date
                                                        <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                                        <input type="text" class="reportrange-column" id="rangepicker-1" data-fsfor="Interview Date" />
                                                    </p>
                                                </th>
                                                <th>Interview Status</th>
                                                <!-- <th>Scheduled By</th> -->
                                                <th>
                                                    <p class="dates">
                                                        Uploaded Date
                                                        <i class="far fa-calendar-alt calendar-icon" data-id="2" style="cursor: pointer;"></i>
                                                        <input type="text" class="reportrange-column" id="rangepicker-2" data-fsfor="Uploaded Date" />
                                                    </p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                <?php
                                } else if (($trickid == 12) || ($trickid == 13) || ($trickid == 14)) { ?>
                                    <table class="table table-hover" id="example11">
                                        <thead>
                                            <tr>
                                                <th>Sl no</th>
                                                <th>Name</th>
                                                <th>Designations</th>
                                                <th>Sources</th>
                                                <th>
                                                    <p class="dates">
                                                        Uploaded Date
                                                        <i class="far fa-calendar-alt calendar-icon" data-id="2" style="cursor: pointer;"></i>
                                                        <input type="text" class="reportrange-column" id="rangepicker-2" data-ffor="UploadDate" data-fsfor="Uploaded Date" />
                                                    </p>
                                                </th>
                                                <!-- <th>Uploaded By</th> -->
                                                <!-- <th>Assign To</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                <?php
                                } else if (($trickid == 2) || ($trickid == 16) || ($trickid == 17) || ($trickid == 18) || ($trickid == 3)) { ?>
                                    <table class="table table-hover " id="example11">
                                        <thead>
                                            <tr>
                                                <th>Sl no</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Source</th>
                                                <?php if ($trickid == 3) { ?>
                                                    <th>
                                                        <p class="dates">
                                                            Pushed Date
                                                            <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                                            <input type="text" class="reportrange-column" id="rangepicker-1" data-ffor="CallBackDateTime" data-fsfor="Pushed Date" />
                                                        </p>
                                                    </th>
                                                <?php } else { ?>
                                                    <th>Reason </th>
                                                    <th>
                                                        <p class="dates">
                                                            Follow up
                                                            <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                                            <input type="text" class="reportrange-column" id="rangepicker-1" data-ffor="CallBackDateTime" data-fsfor="Follow up" />
                                                        </p>
                                                    </th>
                                                <?php } ?>
                                                <!-- <th>Schedule By</th> -->
                                                <th>
                                                    <p class="dates">
                                                        Uploaded Date
                                                        <i class="far fa-calendar-alt calendar-icon" data-id="2" style="cursor: pointer;"></i>
                                                        <input type="text" class="reportrange-column" id="rangepicker-2" data-ffor="Created_at" data-fsfor="Uploaded Date" />
                                                    </p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                <?php
                                } else if (($trickid == 4) || ($trickid == 5) || ($trickid == 6)) { ?>
                                    <table class="table table-hover " id="example11">
                                        <thead>
                                            <tr>
                                                <th>Sl no</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Source</th>
                                                <!-- <th>Mobile No</th> -->
                                                <!-- <th>Position Applied</th>  -->
                                                <th>Candidate Status</th>
                                                <!-- <?php if ($trickid == 4) {
                                                            echo '<th><p class="dates">Selection Date <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                                            <input type="text" class="reportrange-column" id="rangepicker-1" data-ffor="D.Create_at" data-fsfor="Selection Date"/>
                                                        </p></th>';
                                                        } elseif ($trickid == 5) {
                                                            echo '<th><p class="dates">Rejected Date <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                                            <input type="text" class="reportrange-column" id="rangepicker-1" data-ffor="D.Create_at" data-fsfor="Rejected Date"/>
                                                        </p></th>';
                                                        } elseif ($trickid == 6) {
                                                            echo '<th><p class="dates">Hold Date <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                                            <input type="text" class="reportrange-column" id="rangepicker-1" data-ffor="D.Create_at" data-fsfor="Hold Date"/>
                                                        </p></th>';
                                                        }
                                                        ?> -->
                                                <th>
                                                    <p class="dates">
                                                        Interview Date
                                                        <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                                        <input type="text" class="reportrange-column" id="rangepicker-1" data-fsfor="Interview Date" />
                                                    </p>
                                                </th>
                                                <!-- <th>Scheduled By</th> -->
                                                <th>
                                                    <p class="dates">
                                                        Uploaded Date
                                                        <i class="far fa-calendar-alt calendar-icon" data-id="2" style="cursor: pointer;"></i>
                                                        <input type="text" class="reportrange-column" id="rangepicker-2" data-ffor="Created_at" data-fsfor="Uploaded Date" />
                                                    </p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                <?php
                                } else if ($trickid == 8) { ?>
                                    <table class="table table-hover " id="example11">
                                        <thead>
                                            <tr>
                                                <th>Sl no</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Source</th>
                                                <!-- <th>Mobile No</th> -->
                                                <!-- <th>Position Applied</th>  -->
                                                <th>
                                                    <p class="dates">
                                                        Interview Date
                                                        <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                                        <input type="text" class="reportrange-column" id="rangepicker-1" data-ffor="A.InterviewDate" data-fsfor="Interview Date" />
                                                    </p>
                                                </th>
                                                <th>Joined Status</th>
                                                <!-- <th>Added By</th> -->
                                                <th>
                                                    <p class="dates">Joining Date
                                                        <i class="far fa-calendar-alt calendar-icon" data-id="2" style="cursor: pointer;"></i>
                                                        <input type="text" class="reportrange-column" id="rangepicker-2" data-ffor="D.JoiningDate" data-fsfor="Joining Date" />
                                                    </p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    <!-- autocomplete function  -->
    <script type='text/javascript'>
        $(document).ready(function() {
            // Initialize....
            var trickid = document.getElementById("trickid").value;
            var DESIGNATIONS = <?php echo json_encode($DESIGNATIONS); ?>;
            var SOURCES = <?php echo json_encode($SOURCES); ?>;
            var HRS = <?php echo json_encode($HRS); ?>;
            var REASONS = <?php echo json_encode($REASONS); ?>;
            var INT_STATUS = <?php echo json_encode($INT_STATUS); ?>;
            var HTML = '';
            var FSD1FOR = '';
            var FSD2FOR = '';

            // console.log(INT_STATUS);


            if ($('#filter_s_date_1').val() != '') {
                if (trickid == 13) {
                    FSD1FOR = 'Uploaded Date';
                } else if (trickid == 1) {
                    FSD1FOR = 'Interview Date';
                } else if (trickid == 2) {
                    FSD1FOR = 'Follow up';
                } else if (trickid == 3) {
                    FSD1FOR = 'Pushed Date';
                } else if (trickid == 4) {
                    FSD1FOR = 'Interview Date';
                } else if (trickid == 5) {
                    FSD1FOR = 'Interview Date';
                } else if (trickid == 15) {
                    FSD1FOR = 'Interview Date';
                } else if (trickid == 6) {
                    FSD1FOR = 'Interview Date';
                } else if (trickid == 8) {
                    FSD1FOR = 'Interview Date';
                }
                HTML = `<div class="chip fc-date-1">
                        ` + FSD1FOR + ' ' + $('#filter_s_date_1').val() + ` to ` + $('#filter_e_date_1').val() + `<span class="closebtn" data-element="#rangepicker-1" onclick="this.parentElement.style.display='none'">&times;</span>
                    </div>`;
                $('#filter-group').append(HTML);
            }
            if ($('#filter_s_date_2').val() != '') {
                if(trickid == 8){
                    FSD2FOR = 'Joining Date';
                }else{
                    FSD2FOR = 'Uploaded Date';
                }
                HTML = `<div class="chip fc-date-2">
                        ` + FSD2FOR + ' ' + $('#filter_s_date_2').val() + ` to ` + $('#filter_e_date_2').val() + `<span class="closebtn" data-element="#rangepicker-2" onclick="this.parentElement.style.display='none'">&times;</span>
                    </div>`;
                $('#filter-group').append(HTML);
            }
            if ($('#filter_designation').val() != '') {
                HTML = `<div class="chip fc-designation">
                        ` + $('#filter_designation').val() + `<span class="closebtn" data-element=".SelectedFiltervalue-1" onclick="this.parentElement.style.display='none'">&times;</span>
                    </div>`;
                $('#filter-group').append(HTML);
            }
            if ($('#filter_source').val() != '') {
                HTML = `<div class="chip fc-source">
                        ` + $('#filter_source').val() + `<span class="closebtn" data-element=".SelectedFiltervalue-2" onclick="this.parentElement.style.display='none'">&times;</span>
                    </div>`;
                $('#filter-group').append(HTML);
            }
            if ($('#filter_hr').val() != '') {
                HTML = `<div class="chip fc-hr">
                        ` + $('#filter_hr').val() + `<span class="closebtn" data-element=".SelectedFiltervalue-3" onclick="this.parentElement.style.display='none'">&times;</span>
                    </div>`;
                $('#filter-group').append(HTML);
            }
            if ($('#filter_reason').val() != '') {
                if (trickid == 15) {
                    var val = $('#filter_reason').val();
                    if (val == 10) {
                        var text = 'Initial Review';
                    } else if (val == 1) {
                        var text = 'Round 1';
                    } else if (val == 2) {
                        var text = 'Round 2';
                    } else if (val == 3) {
                        var text = 'Round 3';
                    } else if (val == 4) {
                        var text = 'Round 4';
                    } else if (val == 5) {
                        var text = 'Round 5';
                    } else if (val == 6) {
                        var text = 'Round 6';
                    }
                    HTML = `<div class="chip fc-reason">
                        ` + text + `<span class="closebtn" data-element=".SelectedFiltervalue-4" onclick="this.parentElement.style.display='none'">&times;</span>
                    </div>`;
                } else {
                    HTML = `<div class="chip fc-reason">
                        ` + $('#filter_reason').val() + `<span class="closebtn" data-element=".SelectedFiltervalue-4" onclick="this.parentElement.style.display='none'">&times;</span>
                    </div>`;
                }
                $('#filter-group').append(HTML);
            }

            $('a.bg-orange').filter(function() {
                return $(this).data('trackid') == trickid;
            }).addClass('activeclass');

            // Initialize Daterangepicker on the hidden input
            // if(trickid == 1 || trickid == 2){
            //     $('#rangepicker-1').daterangepicker({
            //         autoUpdateInput: false,
            //         locale: {
            //             cancelLabel: 'Clear'
            //         },
            //         minDate:moment(),
            //         ranges: {
            //             'Today': [moment(), moment()],
            //             'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
            //             'Next 7 Days': [moment(), moment().add(6, 'days')],
            //             'Next 30 Days': [moment(), moment().add(29, 'days')],
            //             'This Month': [moment().startOf('month'), moment().endOf('month')],
            //             'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
            //         }
            //     });
            // }else{
            $('#rangepicker-1').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });
            // }

            $('#rangepicker-2').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                },
                maxDate: moment(),
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });

            if ((trickid == 1) || (trickid == 9) || (trickid == 10) || (trickid == 11)) {
                var table = $('#example11').DataTable({
                    "paging": true,
                    "info": true,
                    "processing": true,
                    "serverSide": true,
                    "deferRender": true,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": '_all'
                        } // specify the column indexes to disable sorting
                    ],
                    "ajax": {
                        "url": "<?= base_url().'/data-candidate/load/HR-candidate_list/' . $trickid ?>",
                        "type": "GET",
                        "data": function(d) { // Pass additional parameters in the request
                            d.s_date_1 = $('#filter_s_date_1').val();
                            d.e_date_1 = $('#filter_e_date_1').val();
                            d.s_date_2 = $('#filter_s_date_2').val();
                            d.e_date_2 = $('#filter_e_date_2').val();
                            d.d_value = $('#filter_designation').val();
                            d.s_value = $('#filter_source').val();
                            d.h_value = $('#filter_hr').val();
                        },
                        "error": function(jqXHR, textStatus, errorThrown) {
                            console.error("AJAX Error:", textStatus, errorThrown);
                        }
                    },
                    "columns": [{
                            "data": null,
                            "render": function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1; // Serial number calculation
                            },
                        },
                        {
                            "data": "CandidateName",
                            "render": function(data, type, row) {
                                if (row.ScheduleStatus == 10) {
                                    return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                            <br>
                                            <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                                } else {
                                    return `<a href="<?php echo site_url('edit_candidate_view?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                            <br>
                                            <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                                }
                            }
                        },
                        {
                            "data": "CandidatePosition"
                        },
                        {
                            "data": "Source"
                        },
                        {
                            "data": "InterviewDate",
                            "render": function(data, type, row) {
                                const date = new Date(data);
                                if (isNaN(date)) return data;
                                const options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                let formattedDate = date.toLocaleDateString('en-US', options);
                                if (date.getHours() || date.getMinutes()) {
                                    const hours = date.getHours() % 12 || 12;
                                    const minutes = date.getMinutes().toString().padStart(2, '0');
                                    const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                    formattedDate += ` ${hours}:${minutes}${ampm}`;
                                }
                                return formattedDate;
                            }
                        },
                        // {
                        //     "data": "HRName"
                        // },
                        {
                            "data": "Created_at",
                            "render": function(data, type, row) {
                                const date = new Date(data);
                                if (isNaN(date)) return data;
                                const options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                let formattedDate = date.toLocaleDateString('en-US', options);
                                if (date.getHours() || date.getMinutes()) {
                                    const hours = date.getHours() % 12 || 12;
                                    const minutes = date.getMinutes().toString().padStart(2, '0');
                                    const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                    formattedDate += ` ${hours}:${minutes}${ampm}`;
                                }
                                return formattedDate;
                            }
                        }
                    ],
                    "drawCallback": function(settings) {
                        // Hide the header if no data is found
                        if (table.data().count() === 0) {
                            $('#example11 thead').hide();
                        } else {
                            $('#example11 thead').show();
                        }
                    },
                    "initComplete": function() {
                        // Create dropdown filter for "CandidatePosition" (Column 2)
                        this.api().columns(2).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-1" data-col="C.designations" ><option value=""> Designations</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            DESIGNATIONS.forEach(function(d) {
                                if ($('#filter_designation').val() === d.designations) {
                                    select.append('<option value="' + d.designations + '" selected>' + d.designations + '</option>');
                                } else {
                                    select.append('<option value="' + d.designations + '">' + d.designations + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Source" (Column 3)
                        this.api().columns(3).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-2" data-col="SM_Name" ><option value=""> Sources</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            SOURCES.forEach(function(d) {
                                if ($('#filter_source').val() === d.SM_Name) {
                                    select.append('<option value="' + d.SM_Name + '" selected>' + d.SM_Name + '</option>');
                                } else {
                                    select.append('<option value="' + d.SM_Name + '">' + d.SM_Name + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Scheduled By" (Column 5)
                        // this.api().columns(5).every(function() {
                        //     var column = this;
                        //     var select = $('<select class="Search SelectedFiltervalue-3" data-col="UploadBy" ><option value=""> Uploaded By </option></select>');
                        //     var select_w = $('<div class="select-wrapper"></div>')
                        //         .append(select)
                        //         .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                        //         .appendTo($(column.header()).empty());
                        //     HRS.forEach(function(d) {
                        //         if ($('#filter_hr').val() === d.EmployeeName) {
                        //             select.append('<option value="' + d.EmployeeName + '" selected>' + d.EmployeeName + '</option>');
                        //         } else {
                        //             select.append('<option value="' + d.EmployeeName + '">' + d.EmployeeName + '</option>');
                        //         }
                        //     });
                        // });
                    }
                });

                // Listen to the xhr event to get the response and update #Tit-count
                table.on('xhr.dt', function(e, settings, json, xhr) {
                    if (json && json.recordsTotal !== undefined) {
                        $('#Tit-count').html(json.recordsTotal);
                    }
                });
            } else if (trickid == 15) {
                var table = $('#example11').DataTable({
                    "paging": true,
                    "info": true,
                    "processing": true,
                    "serverSide": true,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": '_all'
                        } // specify the column indexes to disable sorting
                    ],
                    "ajax": {
                        "url": "<?= base_url().'/data-candidate/load/HR-candidate_list/' . $trickid ?>",
                        "type": "GET",
                        "data": function(d) { // Pass additional parameters in the request
                            d.s_date_1 = $('#filter_s_date_1').val();
                            d.e_date_1 = $('#filter_e_date_1').val();
                            d.s_date_2 = $('#filter_s_date_2').val();
                            d.e_date_2 = $('#filter_e_date_2').val();
                            d.d_value = $('#filter_designation').val();
                            d.s_value = $('#filter_source').val();
                            d.h_value = $('#filter_hr').val();
                            d.reason = $('#filter_reason').val();
                        }
                    },
                    "columns": [{
                            "data": null,
                            "render": function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1; // Serial number calculation
                            },
                        },
                        {
                            "data": "CandidateName",
                            "render": function(data, type, row) {
                                if (row.ScheduleStatus == 10) {
                                    return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                            <br>
                                            <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                                } else {
                                    return `<a href="<?php echo site_url('edit_candidate_view?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                            <br>
                                            <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                                }
                            }
                        },
                        {
                            "data": "CandidatePosition"
                        },
                        {
                            "data": "Source"
                        },
                        {
                            "data": "InterviewDate",
                            "render": function(data, type, row) {
                                const date = new Date(data);
                                if (isNaN(date)) return data;
                                const options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                let formattedDate = date.toLocaleDateString('en-US', options);
                                if (date.getHours() || date.getMinutes()) {
                                    const hours = date.getHours() % 12 || 12;
                                    const minutes = date.getMinutes().toString().padStart(2, '0');
                                    const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                    formattedDate += ` ${hours}:${minutes}${ampm}`;
                                }
                                return formattedDate;
                            }
                        },
                        {
                            "data": "ScheduleStatus",
                            "render": function(data, type, row) {
                                if (row.ScheduleStatus == 10 && row.RoundID == 1) {
                                    return 'Round 1 Completed';
                                } else if (row.ScheduleStatus == 10 && row.RoundID == 2) {
                                    return 'Round 2 Completed';
                                } else if (row.ScheduleStatus == 10 && row.RoundID == 3) {
                                    return 'Round 3 Completed';
                                } else if (row.ScheduleStatus == 10 && row.RoundID == 4) {
                                    return 'Round 4 Completed';
                                } else if (row.ScheduleStatus == 10 && row.RoundID == 5) {
                                    return 'Round 5 Completed';
                                } else if (row.ScheduleStatus == 10 && row.RoundID == 6) {
                                    return 'Round 6 Completed';
                                } else if (row.ScheduleStatus == 10) {
                                    return 'Initial Review';
                                }
                            }
                        },
                        // {
                        //     "data": "HRName"
                        // },
                        {
                            "data": "Created_at",
                            "render": function(data, type, row) {
                                const date = new Date(data);
                                if (isNaN(date)) return data;
                                const options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                let formattedDate = date.toLocaleDateString('en-US', options);
                                if (date.getHours() || date.getMinutes()) {
                                    const hours = date.getHours() % 12 || 12;
                                    const minutes = date.getMinutes().toString().padStart(2, '0');
                                    const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                    formattedDate += ` ${hours}:${minutes}${ampm}`;
                                }
                                return formattedDate;
                            }
                        }
                    ],
                    "drawCallback": function(settings) {
                        // Hide the header if no data is found
                        if (table.data().count() === 0) {
                            $('#example11 thead').hide();
                        } else {
                            $('#example11 thead').show();
                        }
                    },
                    "initComplete": function() {
                        // Create dropdown filter for "CandidatePosition" (Column 2)
                        this.api().columns(2).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-1" data-col="C.designations" ><option value=""> Designations</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            DESIGNATIONS.forEach(function(d) {
                                if ($('#filter_designation').val() === d.designations) {
                                    select.append('<option value="' + d.designations + '" selected>' + d.designations + '</option>');
                                } else {
                                    select.append('<option value="' + d.designations + '">' + d.designations + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Source" (Column 3)
                        this.api().columns(3).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-2" data-col="SM_Name" ><option value=""> Sources</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            SOURCES.forEach(function(d) {
                                if ($('#filter_source').val() === d.SM_Name) {
                                    select.append('<option value="' + d.SM_Name + '" selected>' + d.SM_Name + '</option>');
                                } else {
                                    select.append('<option value="' + d.SM_Name + '">' + d.SM_Name + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Status" (Column 4)
                        this.api().columns(5).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-4" data-col="SM_Name" ><option value=""> Interview Status</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            INT_STATUS.forEach(function(d) {
                                if ($('#filter_reason').val() === d.id) {
                                    select.append('<option value="' + d.id + '" selected>' + d.text + '</option>');
                                } else {
                                    select.append('<option value="' + d.id + '">' + d.text + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Uploaded By" (Column 5)
                        // this.api().columns(6).every(function() {
                        //     var column = this;
                        //     var select = $('<select class="Search SelectedFiltervalue-3" data-col="UploadBy" ><option value=""> Scheduled By </option></select>');
                        //     var select_w = $('<div class="select-wrapper"></div>')
                        //         .append(select)
                        //         .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                        //         .appendTo($(column.header()).empty());
                        //     HRS.forEach(function(d) {
                        //         if ($('#filter_hr').val() === d.EmployeeName) {
                        //             select.append('<option value="' + d.EmployeeName + '" selected>' + d.EmployeeName + '</option>');
                        //         } else {
                        //             select.append('<option value="' + d.EmployeeName + '">' + d.EmployeeName + '</option>');
                        //         }
                        //     });
                        // });
                    }
                });
            } else if ((trickid == 12) || (trickid == 13) || (trickid == 14)) {
                var table = $('#example11').DataTable({
                    "paging": true,
                    "info": true,
                    "processing": true,
                    "serverSide": true,
                    "columnDefs": [{
                        "orderable": false,
                        "targets": '_all' // Disable sorting for all columns
                    }],
                    "ajax": {
                        "url": "<?= base_url().'/data-candidate/load/HR-candidate_list/' . $trickid ?>",
                        "type": "GET",
                        "data": function(d) {
                            d.s_date_1 = $('#filter_s_date_1').val();
                            d.e_date_1 = $('#filter_e_date_1').val();
                            d.s_date_2 = $('#filter_s_date_2').val();
                            d.e_date_2 = $('#filter_e_date_2').val();
                            d.d_value = $('#filter_designation').val();
                            d.s_value = $('#filter_source').val();
                            d.h_value = $('#filter_hr').val();
                        }
                    },
                    "columns": [{
                            "data": "CandidateName",
                            "render": function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            "data": "CandidateName",
                            "render": function(data, type, row) {
                                return `<a href="<?php echo site_url('scheducleCandidate?canId=') ?>${row.CandidateId}">${row.CandidateName}</a>
                                                <br>
                                                <span class="phone-no">${row.CandidateContactNo}</span>`;
                            }
                        },
                        {
                            "data": "CandidatePosition"
                        },
                        {
                            "data": "Source"
                        },
                        {
                            "data": "UploadDate",
                            "render": function(data, type, row) {
                                const date = new Date(data);
                                if (isNaN(date)) return data;
                                const options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                let formattedDate = date.toLocaleDateString('en-US', options);
                                if (date.getHours() || date.getMinutes()) {
                                    const hours = date.getHours() % 12 || 12;
                                    const minutes = date.getMinutes().toString().padStart(2, '0');
                                    const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                    formattedDate += ` ${hours}:${minutes}${ampm}`;
                                }
                                return formattedDate;
                            }
                        },
                        // {
                        //     "data": "UploadBy"
                        // }
                    ],
                    "drawCallback": function(settings) {
                        // Hide the header if no data is found
                        if (table.data().count() === 0) {
                            $('#example11 thead').hide();
                        } else {
                            $('#example11 thead').show();
                        }
                    },
                    "initComplete": function() {
                        // Create dropdown filter for "CandidatePosition" (Column 2)
                        this.api().columns(2).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-1" data-col="C.designations">' +
                                '<option value="">Designations</option>' +
                                '</select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            DESIGNATIONS.forEach(function(d) {
                                if ($('#filter_designation').val() === d.designations) {
                                    select.append('<option value="' + d.designations + '" selected>' + d.designations + '</option>');
                                } else {
                                    select.append('<option value="' + d.designations + '">' + d.designations + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Source" (Column 3)
                        this.api().columns(3).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-2" data-col="SM_Name" ><option value=""> Sources</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            SOURCES.forEach(function(d) {
                                if ($('#filter_source').val() === d.SM_Name) {
                                    select.append('<option value="' + d.SM_Name + '" selected>' + d.SM_Name + '</option>');
                                } else {
                                    select.append('<option value="' + d.SM_Name + '">' + d.SM_Name + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Uploaded By" (Column 5)
                        // this.api().columns(5).every(function() {
                        //     var column = this;
                        //     var select = $('<select class="Search SelectedFiltervalue-3" data-col="UploadBy" ><option value=""> Uploaded By </option></select>');
                        //     var select_w = $('<div class="select-wrapper"></div>')
                        //         .append(select)
                        //         .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                        //         .appendTo($(column.header()).empty());
                        //     HRS.forEach(function(d) {
                        //         if ($('#filter_hr').val() === d.EmployeeName) {
                        //             select.append('<option value="' + d.EmployeeName + '" selected>' + d.EmployeeName + '</option>');
                        //         } else {
                        //             select.append('<option value="' + d.EmployeeName + '">' + d.EmployeeName + '</option>');
                        //         }
                        //     });
                        // });
                    }
                });
            } else if ((trickid == 2) || (trickid == 16) || (trickid == 17) || (trickid == 18)) {
                var table = $('#example11').DataTable({
                    "paging": true,
                    "info": true,
                    "processing": true,
                    "serverSide": true,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": '_all'
                        } // specify the column indexes to disable sorting
                    ],
                    "ajax": {
                        "url": "<?= base_url().'/data-candidate/load/HR-candidate_list/' . $trickid ?>",
                        "type": "GET",
                        "data": function(d) { // Pass additional parameters in the request
                            d.s_date_1 = $('#filter_s_date_1').val();
                            d.e_date_1 = $('#filter_e_date_1').val();
                            d.s_date_2 = $('#filter_s_date_2').val();
                            d.e_date_2 = $('#filter_e_date_2').val();
                            d.d_value = $('#filter_designation').val();
                            d.s_value = $('#filter_source').val();
                            d.h_value = $('#filter_hr').val();
                            d.reason = $('#filter_reason').val();
                        }
                    },
                    "columns": [{
                            "data": null,
                            "render": function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1; // Serial number calculation
                            },
                        },
                        {
                            "data": "CandidateName",
                            "render": function(data, type, row) {
                                return `<a href="<?php echo site_url('scheducleCandidate?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                            <br>
                                            <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                            }
                        },
                        {
                            "data": "CandidatePosition"
                        },
                        {
                            "data": "Source"
                        },
                        {
                            "data": "NS_Reasons"
                        },
                        {
                            "data": "CallBack",
                            "render": function(data, type, row) {
                                const date = new Date(data);
                                if (isNaN(date)) return data;
                                const options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                let formattedDate = date.toLocaleDateString('en-US', options);
                                if (date.getHours() || date.getMinutes()) {
                                    const hours = date.getHours() % 12 || 12;
                                    const minutes = date.getMinutes().toString().padStart(2, '0');
                                    const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                    formattedDate += ` ${hours}:${minutes}${ampm}`;
                                }
                                return formattedDate;
                            }
                        },
                        // {
                        //     "data": "assignTo"
                        // },
                        {
                            "data": "Created_at",
                            "render": function(data, type, row) {
                                const date = new Date(data);
                                if (isNaN(date)) return data;
                                const options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                let formattedDate = date.toLocaleDateString('en-US', options);
                                if (date.getHours() || date.getMinutes()) {
                                    const hours = date.getHours() % 12 || 12;
                                    const minutes = date.getMinutes().toString().padStart(2, '0');
                                    const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                    formattedDate += ` ${hours}:${minutes}${ampm}`;
                                }
                                return formattedDate;
                            }
                        }
                    ],
                    "drawCallback": function(settings) {
                        // Hide the header if no data is found
                        if (table.data().count() === 0) {
                            $('#example11 thead').hide();
                        } else {
                            $('#example11 thead').show();
                        }
                    },
                    "initComplete": function() {
                        // Create dropdown filter for "CandidatePosition" (Column 2)
                        this.api().columns(2).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-1" data-col="C.designations" ><option value=""> Designations</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            DESIGNATIONS.forEach(function(d) {
                                if ($('#filter_designation').val() === d.designations) {
                                    select.append('<option value="' + d.designations + '" selected>' + d.designations + '</option>');
                                } else {
                                    select.append('<option value="' + d.designations + '">' + d.designations + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Source" (Column 3)
                        this.api().columns(3).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-2" data-col="SM_Name" ><option value=""> Sources</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            SOURCES.forEach(function(d) {
                                if ($('#filter_source').val() === d.SM_Name) {
                                    select.append('<option value="' + d.SM_Name + '" selected>' + d.SM_Name + '</option>');
                                } else {
                                    select.append('<option value="' + d.SM_Name + '">' + d.SM_Name + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Reason" (Column 4)
                        this.api().columns(4).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-4" data-col="NS_Reasons" ><option value=""> Reasons</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            REASONS.forEach(function(d) {
                                if ($('#filter_reason').val() === d.NS_Reasons) {
                                    select.append('<option value="' + d.NS_Reasons + '" selected>' + d.NS_Reasons + '</option>');
                                } else {
                                    select.append('<option value="' + d.NS_Reasons + '">' + d.NS_Reasons + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Scheduled By" (Column 5)
                        // this.api().columns(6).every(function() {
                        //     var column = this;
                        //     var select = $('<select class="Search SelectedFiltervalue-3" data-col="UploadBy" ><option value=""> Schedule By </option></select>');
                        //     var select_w = $('<div class="select-wrapper"></div>')
                        //         .append(select)
                        //         .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                        //         .appendTo($(column.header()).empty());
                        //     HRS.forEach(function(d) {
                        //         if ($('#filter_hr').val() === d.EmployeeName) {
                        //             select.append('<option value="' + d.EmployeeName + '" selected>' + d.EmployeeName + '</option>');
                        //         } else {
                        //             select.append('<option value="' + d.EmployeeName + '">' + d.EmployeeName + '</option>');
                        //         }
                        //     });
                        // });
                    }
                });
            } else if (trickid == 3) {
                var table = $('#example11').DataTable({
                    "paging": true,
                    "info": true,
                    "processing": true,
                    "serverSide": true,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": '_all'
                        } // specify the column indexes to disable sorting
                    ],
                    "ajax": {
                        "url": "<?= base_url().'/data-candidate/load/HR-candidate_list/' . $trickid ?>",
                        "type": "GET",
                        "data": function(d) { // Pass additional parameters in the request
                            d.s_date_1 = $('#filter_s_date_1').val();
                            d.e_date_1 = $('#filter_e_date_1').val();
                            d.s_date_2 = $('#filter_s_date_2').val();
                            d.e_date_2 = $('#filter_e_date_2').val();
                            d.d_value = $('#filter_designation').val();
                            d.s_value = $('#filter_source').val();
                            d.h_value = $('#filter_hr').val();
                        }
                    },
                    "columns": [{
                            "data": null,
                            "render": function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1; // Serial number calculation
                            },
                        },
                        {
                            "data": "CandidateName",
                            "render": function(data, type, row) {
                                return `<a href="<?php echo site_url('scheducleCandidate?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                            <br>
                                            <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                            }
                        },
                        {
                            "data": "CandidatePosition"
                        },
                        {
                            "data": "Source"
                        },
                        {
                            "data": "CallBack",
                            "render": function(data, type, row) {
                                const date = new Date(data);
                                if (isNaN(date)) return data;
                                const options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                let formattedDate = date.toLocaleDateString('en-US', options);
                                if (date.getHours() || date.getMinutes()) {
                                    const hours = date.getHours() % 12 || 12;
                                    const minutes = date.getMinutes().toString().padStart(2, '0');
                                    const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                    formattedDate += ` ${hours}:${minutes}${ampm}`;
                                }
                                return formattedDate;
                            }
                        },
                        // {
                        //     "data": "assignTo"
                        // },
                        {
                            "data": "Created_at",
                            "render": function(data, type, row) {
                                const date = new Date(data);
                                if (isNaN(date)) return data;
                                const options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                let formattedDate = date.toLocaleDateString('en-US', options);
                                if (date.getHours() || date.getMinutes()) {
                                    const hours = date.getHours() % 12 || 12;
                                    const minutes = date.getMinutes().toString().padStart(2, '0');
                                    const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                    formattedDate += ` ${hours}:${minutes}${ampm}`;
                                }
                                return formattedDate;
                            }
                        }
                    ],
                    "drawCallback": function(settings) {
                        // Hide the header if no data is found
                        if (table.data().count() === 0) {
                            $('#example11 thead').hide();
                        } else {
                            $('#example11 thead').show();
                        }
                    },
                    "initComplete": function() {
                        // Create dropdown filter for "CandidatePosition" (Column 2)
                        this.api().columns(2).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-1" data-col="C.designations" ><option value=""> Designations</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            DESIGNATIONS.forEach(function(d) {
                                if ($('#filter_designation').val() === d.designations) {
                                    select.append('<option value="' + d.designations + '" selected>' + d.designations + '</option>');
                                } else {
                                    select.append('<option value="' + d.designations + '">' + d.designations + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Source" (Column 3)
                        this.api().columns(3).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-2" data-col="SM_Name" ><option value=""> Sources</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            SOURCES.forEach(function(d) {
                                if ($('#filter_source').val() === d.SM_Name) {
                                    select.append('<option value="' + d.SM_Name + '" selected>' + d.SM_Name + '</option>');
                                } else {
                                    select.append('<option value="' + d.SM_Name + '">' + d.SM_Name + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Added By" (Column 5)
                        // this.api().columns(5).every(function() {
                        //     var column = this;
                        //     var select = $('<select class="Search SelectedFiltervalue-3" data-col="UploadBy" ><option value=""> Added By </option></select>');
                        //     var select_w = $('<div class="select-wrapper"></div>')
                        //         .append(select)
                        //         .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                        //         .appendTo($(column.header()).empty());
                        //     HRS.forEach(function(d) {
                        //         if ($('#filter_hr').val() === d.EmployeeName) {
                        //             select.append('<option value="' + d.EmployeeName + '" selected>' + d.EmployeeName + '</option>');
                        //         } else {
                        //             select.append('<option value="' + d.EmployeeName + '">' + d.EmployeeName + '</option>');
                        //         }
                        //     });
                        // });
                    }
                });
            } else if ((trickid == 4) || (trickid == 5) || (trickid == 6)) {
                var table = $('#example11').DataTable({
                    "paging": true,
                    "info": true,
                    "processing": true,
                    "serverSide": true,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": '_all'
                        } // specify the column indexes to disable sorting
                    ],
                    "ajax": {
                        "url": "<?= base_url().'/data-candidate/load/HR-candidate_list/' . $trickid ?>",
                        "type": "GET",
                        "data": function(d) { // Pass additional parameters in the request
                            d.s_date_1 = $('#filter_s_date_1').val();
                            d.e_date_1 = $('#filter_e_date_1').val();
                            d.s_date_2 = $('#filter_s_date_2').val();
                            d.e_date_2 = $('#filter_e_date_2').val();
                            d.d_value = $('#filter_designation').val();
                            d.s_value = $('#filter_source').val();
                            d.h_value = $('#filter_hr').val();
                        }
                    },
                    "columns": [{
                            "data": null,
                            "render": function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1; // Serial number calculation
                            },
                        },
                        {
                            "data": "CandidateName",
                            "render": function(data, type, row) {
                                if ((row.InterviewStatus == 2) && (row.DVStatus == 2) || (row.OL_Status == 1)) {
                                    return `<a href="<?php echo site_url('offer_letter_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                                    <br>
                                                    <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                                } else if ((row.InterviewStatus == 2) && (row.DVStatus == 2)) {
                                    return `<a href="<?php echo site_url('offer_letter_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                                    <br>
                                                    <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                                } else if ((row.InterviewStatus == 2 || 3 || 4) || (row.DVStatus == 1)) {
                                    return `<a href="<?php echo site_url('onboarding_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                                    <br>
                                                    <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                                }
                            }
                        },
                        {
                            "data": "CandidatePosition"
                        },
                        {
                            "data": "Source"
                        },
                        {
                            "data": "JoiningStatus",
                            "render": function(data, type, row) {
                                if (row.JoiningStatus == 2) {
                                    return '<span class="text-red">Candidate Not Joined</span>';
                                } else if (row.ConfirmStatus == 1) {
                                    return '<span class="text-red">Waiting for Joining</span>';
                                } else if (row.ConfirmStatus == 2) {
                                    return '<span class="text-red">Candidate Not-Confirmed</span>';
                                } else if ((row.DVStatus == 2) && (row.OL_Status == 1)) {
                                    return '<span class="text-green">Offer Letter Sent</span>';
                                } else if (row.DVStatus == 2) {
                                    return '<span class="text-green">Documents Verified</span>';
                                } else if (row.DVStatus == 1) {
                                    return '<span class="text-red">Documents Rejected</span>';
                                } else if (row.InterviewStatus == 2) {
                                    return '<span class="text-green">Selected by ' + row.InterviewerName + '</span>';
                                } else if (row.InterviewStatus == 3) {
                                    return '<span class="text-orange">Hold by ' + row.InterviewerName + '</span>';
                                } else if (row.InterviewStatus == 4) {
                                    return '<span class="text-red">Rejected by ' + row.InterviewerName + '</span>';
                                }
                            }
                        },
                        {
                            "data": "InterviewDate",
                            "render": function(data, type, row) {
                                const date = new Date(data);
                                if (isNaN(date)) return data;
                                const options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                let formattedDate = date.toLocaleDateString('en-US', options);
                                if (date.getHours() || date.getMinutes()) {
                                    const hours = date.getHours() % 12 || 12;
                                    const minutes = date.getMinutes().toString().padStart(2, '0');
                                    const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                    formattedDate += ` ${hours}:${minutes}${ampm}`;
                                }
                                return formattedDate;
                            }
                        },
                        // {
                        //     "data": "HRName"
                        // },
                        {
                            "data": "Created_at",
                            "render": function(data, type, row) {
                                const date = new Date(data);
                                if (isNaN(date)) return data;
                                const options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                let formattedDate = date.toLocaleDateString('en-US', options);
                                if (date.getHours() || date.getMinutes()) {
                                    const hours = date.getHours() % 12 || 12;
                                    const minutes = date.getMinutes().toString().padStart(2, '0');
                                    const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                    formattedDate += ` ${hours}:${minutes}${ampm}`;
                                }
                                return formattedDate;
                            }
                        }
                    ],
                    "drawCallback": function(settings) {
                        // Hide the header if no data is found
                        if (table.data().count() === 0) {
                            $('#example11 thead').hide();
                        } else {
                            $('#example11 thead').show();
                        }
                    },
                    "initComplete": function() {
                        // Create dropdown filter for "CandidatePosition" (Column 2)
                        this.api().columns(2).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-1" data-col="C.designations" ><option value=""> Designations</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            DESIGNATIONS.forEach(function(d) {
                                if ($('#filter_designation').val() === d.designations) {
                                    select.append('<option value="' + d.designations + '" selected>' + d.designations + '</option>');
                                } else {
                                    select.append('<option value="' + d.designations + '">' + d.designations + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Source" (Column 3)
                        this.api().columns(3).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-2" data-col="SM_Name" ><option value=""> Sources</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            SOURCES.forEach(function(d) {
                                if ($('#filter_source').val() === d.SM_Name) {
                                    select.append('<option value="' + d.SM_Name + '" selected>' + d.SM_Name + '</option>');
                                } else {
                                    select.append('<option value="' + d.SM_Name + '">' + d.SM_Name + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Scheduled By" (Column 5)
                        // this.api().columns(6).every(function() {
                        //     var column = this;
                        //     var select = $('<select class="Search SelectedFiltervalue-3" data-col="UploadBy" ><option value=""> Uploaded By </option></select>');
                        //     var select_w = $('<div class="select-wrapper"></div>')
                        //         .append(select)
                        //         .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                        //         .appendTo($(column.header()).empty());
                        //     HRS.forEach(function(d) {
                        //         if ($('#filter_hr').val() === d.EmployeeName) {
                        //             select.append('<option value="' + d.EmployeeName + '" selected>' + d.EmployeeName + '</option>');
                        //         } else {
                        //             select.append('<option value="' + d.EmployeeName + '">' + d.EmployeeName + '</option>');
                        //         }
                        //     });
                        // });
                    }
                });
            } else if (trickid == 8) {
                var table = $('#example11').DataTable({
                    "paging": true,
                    "info": true,
                    "processing": true,
                    "serverSide": true,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": '_all'
                        } // specify the column indexes to disable sorting
                    ],
                    "ajax": {
                        "url": "<?= base_url().'/data-candidate/load/HR-candidate_list/' . $trickid ?>",
                        "type": "GET",
                        "data": function(d) { // Pass additional parameters in the request
                            d.s_date_1 = $('#filter_s_date_1').val();
                            d.e_date_1 = $('#filter_e_date_1').val();
                            d.s_date_2 = $('#filter_s_date_2').val();
                            d.e_date_2 = $('#filter_e_date_2').val();
                            d.d_value = $('#filter_designation').val();
                            d.s_value = $('#filter_source').val();
                            d.h_value = $('#filter_hr').val();
                        }
                    },
                    "columns": [{
                            "data": null,
                            "render": function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1; // Serial number calculation
                            },
                        },
                        {
                            "data": "CandidateName",
                            "render": function(data, type, row) {
                                return `<a href="<?php echo site_url('offer_letter_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                        <br>
                                        <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                            }
                        },
                        {
                            "data": "CandidatePosition"
                        },
                        {
                            "data": "Source"
                        },
                        {
                            "data": "InterviewDate",
                            "render": function(data, type, row) {
                                const date = new Date(data);
                                if (isNaN(date)) return data;
                                const options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                let formattedDate = date.toLocaleDateString('en-US', options);
                                if (date.getHours() || date.getMinutes()) {
                                    const hours = date.getHours() % 12 || 12;
                                    const minutes = date.getMinutes().toString().padStart(2, '0');
                                    const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                    formattedDate += ` ${hours}:${minutes}${ampm}`;
                                }
                                return formattedDate;
                            }
                        },
                        {
                            "data": "WorkingStatus",
                            "render": function(data, type, row) {
                                if (row.WorkingStatus == 1) {
                                    return '<span class="text-green"> Active</span>';
                                } else if (row.WorkingStatus == 2) {
                                    return '<span class="text-orange"> InActive</span>';
                                } else if (row.WorkingStatus == 3) {
                                    return '<span class="text-red"> Abscond</span>';
                                } else if (row.JoiningStatus == 1) {
                                    return '<span class="text-green"> Joined</span>';
                                }
                            }
                        },
                        // {
                        //     "data": "HRName"
                        // },
                        {
                            "data": "JoiningDate",
                            "render": function(data, type, row) {
                                const date = new Date(data);
                                if (isNaN(date)) return data;
                                const options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                let formattedDate = date.toLocaleDateString('en-US', options);
                                if (date.getHours() || date.getMinutes()) {
                                    const hours = date.getHours() % 12 || 12;
                                    const minutes = date.getMinutes().toString().padStart(2, '0');
                                    const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                    formattedDate += ` ${hours}:${minutes}${ampm}`;
                                }
                                return formattedDate;
                            }
                        },
                    ],
                    "drawCallback": function(settings) {
                        // Hide the header if no data is found
                        if (table.data().count() === 0) {
                            $('#example11 thead').hide();
                        } else {
                            $('#example11 thead').show();
                        }
                    },
                    "initComplete": function() {
                        // Create dropdown filter for "CandidatePosition" (Column 2)
                        this.api().columns(2).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-1" data-col="C.designations" ><option value=""> Designations</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            DESIGNATIONS.forEach(function(d) {
                                if ($('#filter_designation').val() === d.designations) {
                                    select.append('<option value="' + d.designations + '" selected>' + d.designations + '</option>');
                                } else {
                                    select.append('<option value="' + d.designations + '">' + d.designations + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Source" (Column 3)
                        this.api().columns(3).every(function() {
                            var column = this;
                            var select = $('<select class="Search SelectedFiltervalue-2" data-col="SM_Name" ><option value=""> Sources</option></select>');
                            var select_w = $('<div class="select-wrapper"></div>')
                                .append(select)
                                .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                                .appendTo($(column.header()).empty());
                            SOURCES.forEach(function(d) {
                                if ($('#filter_source').val() === d.SM_Name) {
                                    select.append('<option value="' + d.SM_Name + '" selected>' + d.SM_Name + '</option>');
                                } else {
                                    select.append('<option value="' + d.SM_Name + '">' + d.SM_Name + '</option>');
                                }
                            });
                        });
                        // Create dropdown filter for "Added By" (Column 5)
                        // this.api().columns(6).every(function() {
                        //     var column = this;
                        //     var select = $('<select class="Search SelectedFiltervalue-3" data-col="UploadBy" ><option value=""> Added By </option></select>');
                        //     var select_w = $('<div class="select-wrapper"></div>')
                        //         .append(select)
                        //         .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                        //         .appendTo($(column.header()).empty());
                        //     HRS.forEach(function(d) {
                        //         if ($('#filter_hr').val() === d.EmployeeName) {
                        //             select.append('<option value="' + d.EmployeeName + '" selected>' + d.EmployeeName + '</option>');
                        //         } else {
                        //             select.append('<option value="' + d.EmployeeName + '">' + d.EmployeeName + '</option>');
                        //         }
                        //     });
                        // });
                    }
                });
            }

            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.alltrackidcounts !== undefined) {
                    const trickIds = [1, 2, 3, 4, 5, 6, 8, 12, 15];
                    trickIds.forEach(id => {
                        const countElement = $('#Tit-count-' + id);
                        if (trickid === id) {
                            countElement.html(json.recordsFiltered);
                        } else {
                            countElement.html(json.alltrackidcounts['t' + id]);
                        }
                    });
                }
                // enable_tabs();
            });

            // Listen to the xhr event to get the response and update #Tit-count
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count-' + trickid).html(json.recordsFiltered);
                }
                enable_tabs();
                
            });

            $('.calendar-icon').on('click', function() {
                var id = $(this).data('id');
                if (id == 1) {
                    $('#rangepicker-1').trigger('click');
                } else {
                    $('#rangepicker-2').trigger('click');
                }
            });
            $('#rangepicker-1').on('apply.daterangepicker', function(ev, picker) {
                $('#filter_s_date_1').val(picker.startDate.format('YYYY/MM/DD'));
                $('#filter_e_date_1').val(picker.endDate.format('YYYY/MM/DD'));
                $('.fc-date-1').hide();
                var HTML = `<div class="chip fc-date-1">
                            ` + $(this).data('fsfor') + ` ` + $('#filter_s_date_1').val() + ` to ` + $('#filter_e_date_1').val() + `<span class="closebtn" data-element="#rangepicker-1" onclick="this.parentElement.style.display='none'">&times;</span>
                        </div>`;
                $('#filter-group').append(HTML);
                url_change();
                disable_tabs();
                
                table.ajax.reload();
            });
            $('#rangepicker-1').on('cancel.daterangepicker', function(ev, picker) {
                $('#filter_s_date_1').val('');
                $('#filter_e_date_1').val('');
                picker.setStartDate(moment());
                picker.setEndDate(moment());
                $('.fc-date-1').hide();
                url_change();
                disable_tabs();
                
                table.ajax.reload();
            });
            $('#rangepicker-2').on('apply.daterangepicker', function(ev, picker) {
                $('#filter_s_date_2').val(picker.startDate.format('YYYY/MM/DD'));
                $('#filter_e_date_2').val(picker.endDate.format('YYYY/MM/DD'));
                $('.fc-date-2').hide();
                var HTML = `<div class="chip fc-date-2">
                            ` + $(this).data('fsfor') + ` ` + $('#filter_s_date_2').val() + ` to ` + $('#filter_e_date_2').val() + `<span class="closebtn" data-element="#rangepicker-2" onclick="this.parentElement.style.display='none'">&times;</span>
                        </div>`;
                $('#filter-group').append(HTML);
                url_change();
                disable_tabs();
                
                table.ajax.reload();
            });
            $('#rangepicker-2').on('cancel.daterangepicker', function(ev, picker) {
                $('#filter_s_date_2').val('');
                $('#filter_e_date_2').val('');
                picker.setStartDate(moment());
                picker.setEndDate(moment());
                $('.fc-date-2').hide();
                url_change();
                disable_tabs();
                
                table.ajax.reload();
            });

            $('.table-hover').on('change', '.SelectedFiltervalue-1', function() {
                $('#filter_designation').val($(this).val());
                if ($(this).val() == null || $(this).val() === '') {
                    $('.fc-designation').hide();
                    HTML = '';
                } else {
                    $('.fc-designation').hide();
                    var HTML = `<div class="chip fc-designation">
                                ` + $(this).val() + `<span class="closebtn" data-element=".SelectedFiltervalue-1" onclick="this.parentElement.style.display='none'">&times;</span>
                            </div>`;
                }
                $('#filter-group').append(HTML);
                url_change();
                disable_tabs();
                
                table.ajax.reload();
            });
            $('.table-hover').on('change', '.SelectedFiltervalue-2', function() {
                $('#filter_source').val($(this).val());
                if ($(this).val() == null || $(this).val() === '') {
                    $('.fc-source').hide();
                    HTML = '';
                } else {
                    $('.fc-source').hide();
                    var HTML = `<div class="chip fc-source">
                                ` + $(this).val() + `<span class="closebtn" data-element=".SelectedFiltervalue-2" onclick="this.parentElement.style.display='none'">&times;</span>
                            </div>`;
                }
                $('#filter-group').append(HTML);
                url_change();
                disable_tabs();
                
                table.ajax.reload();
            });
            $('.table-hover').on('change', '.SelectedFiltervalue-3', function() {
                $('#filter_hr').val($(this).val());
                if ($(this).val() == null || $(this).val() === '') {
                    $('.fc-hr').hide();
                    HTML = '';
                } else {
                    $('.fc-hr').hide();
                    var HTML = `<div class="chip fc-hr">
                                ` + $(this).val() + `<span class="closebtn" data-element=".SelectedFiltervalue-3" onclick="this.parentElement.style.display='none'">&times;</span>
                            </div>`;
                }
                $('#filter-group').append(HTML);
                url_change();
                disable_tabs();
                
                table.ajax.reload();
            });
            $('.table-hover').on('change', '.SelectedFiltervalue-4', function() {
                $('#filter_reason').val($(this).val());
                if ($(this).val() == null || $(this).val() === '') {
                    $('.fc-reason').hide();
                    HTML = '';
                } else {
                    $('.fc-reason').hide();
                    if (trickid == 15) {
                        var val = $('#filter_reason').val();
                        if (val == 10) {
                            var text = 'Initial Review';
                        } else if (val == 1) {
                            var text = 'Round 1';
                        } else if (val == 2) {
                            var text = 'Round 2';
                        } else if (val == 3) {
                            var text = 'Round 3';
                        } else if (val == 4) {
                            var text = 'Round 4';
                        } else if (val == 5) {
                            var text = 'Round 5';
                        } else if (val == 6) {
                            var text = 'Round 6';
                        }
                        var HTML = `<div class="chip fc-reason">
                                ` + text + `<span class="closebtn" data-element=".SelectedFiltervalue-4" onclick="this.parentElement.style.display='none'">&times;</span>
                            </div>`;
                    } else {
                        var HTML = `<div class="chip fc-reason">
                                ` + $(this).val() + `<span class="closebtn" data-element=".SelectedFiltervalue-4" onclick="this.parentElement.style.display='none'">&times;</span>
                            </div>`;
                    }
                }
                $('#filter-group').append(HTML);
                url_change();
                disable_tabs();
                
                table.ajax.reload();
            });

            $('#filter-group').on("click", '.closebtn', function(ev, picker) {
                var element = $(this).data('element');
                if (element === '#rangepicker-1') {
                    $('#filter_s_date_1').val('');
                    $('#filter_e_date_1').val('');
                    $(element).data('daterangepicker').setStartDate(moment());
                    $(element).data('daterangepicker').setEndDate(moment());
                    $('.fc-date-1').hide();
                } else if (element === '#rangepicker-2') {
                    $('#filter_s_date_2').val('');
                    $('#filter_e_date_2').val('');
                    $(element).data('daterangepicker').setStartDate(moment());
                    $(element).data('daterangepicker').setEndDate(moment());
                    $('.fc-date-2').hide();
                } else if (element === '.SelectedFiltervalue-1') {
                    $(element + ' option:first').prop('selected', true);
                    $('#filter_designation').val('');
                } else if (element === '.SelectedFiltervalue-2') {
                    $(element + ' option:first').prop('selected', true);
                    $('#filter_source').val('');
                } else if (element === '.SelectedFiltervalue-3') {
                    $(element + ' option:first').prop('selected', true);
                    $('#filter_hr').val('');
                } else if (element === '.SelectedFiltervalue-4') {
                    $(element + ' option:first').prop('selected', true);
                    $('#filter_reason').val('');
                }
                url_change();
                disable_tabs();
                
                table.ajax.reload();
            });
            url_change();
            disable_tabs();
            
        });

        function url_change() {
            window.history.replaceState(null, '', 'HRcandidate_List?trickid=' + $('#trickid').val() + '&fs=' + $('#filter_source').val() + '&fd=' + $('#filter_designation').val() + '&hr=' + $('#filter_hr').val() + '&fsd-1=' + $('#filter_s_date_1').val() + '&fed-1=' + $('#filter_e_date_1').val() + '&fsd-2=' + $('#filter_s_date_2').val() + '&fed-2=' + $('#filter_e_date_2').val() + '&res=' + $('#filter_reason').val());

            $('#trackid-15').attr('href', "<?= site_url('/HRcandidate_List?trickid=15') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=" + $('#filter_s_date_1').val() + "&fed-1=" + $('#filter_e_date_1').val() + "&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
            $('#trackid-6').attr('href', "<?= site_url('/HRcandidate_List?trickid=6') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=" + $('#filter_s_date_1').val() + "&fed-1=" + $('#filter_e_date_1').val() + "&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
            $('#trackid-5').attr('href', "<?= site_url('/HRcandidate_List?trickid=5') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=" + $('#filter_s_date_1').val() + "&fed-1=" + $('#filter_e_date_1').val() + "&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
            $('#trackid-4').attr('href', "<?= site_url('/HRcandidate_List?trickid=4') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=" + $('#filter_s_date_1').val() + "&fed-1=" + $('#filter_e_date_1').val() + "&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
            $('#trackid-1').attr('href', "<?= site_url('/HRcandidate_List?trickid=1') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=" + $('#filter_s_date_1').val() + "&fed-1=" + $('#filter_e_date_1').val() + "&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());

            $('#trackid-3').attr('href', "<?= site_url('/HRcandidate_List?trickid=3') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=&fed-1=&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
            $('#trackid-2').attr('href', "<?= site_url('/HRcandidate_List?trickid=2') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=&fed-1=&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
            $('#trackid-12').attr('href', "<?= site_url('/HRcandidate_List?trickid=12') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=&fed-1=&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
        
            $('#trackid-8').attr('href', "<?= site_url('/HRcandidate_List?trickid=8') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=" + $('#filter_s_date_1').val() + "&fed-1=" + $('#filter_e_date_1').val() + "&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
        }

        function enable_tabs() {
            var trickid = document.getElementById("trickid").value;
            if(($('#filter_s_date_1').val() == '' || $('#filter_s_date_1').val() == null) || (trickid == 2 || trickid == 3 || trickid == 12)){
                $('#trackid-12').removeClass('disabled');
                $('#trackid-2').removeClass('disabled');
                $('#trackid-3').removeClass('disabled');
            }
            if($('#filter_s_date_2').val() == '' || $('#filter_s_date_2').val() == null || trickid == 8){
                $('#trackid-8').removeClass('disabled');
                console.log("enbaled 8");
            }
            $('#trackid-15').removeClass('disabled');
            $('#trackid-6').removeClass('disabled');
            $('#trackid-5').removeClass('disabled');
            $('#trackid-4').removeClass('disabled');
            $('#trackid-1').removeClass('disabled');
        }

        function disable_tabs() {
            var trickid = document.getElementById("trickid").value;
            if(($('#filter_s_date_1').val() != '' || $('#filter_s_date_1').val() != null) && (trickid != 2 && trickid != 3 && trickid != 12)){
                $('#trackid-12').addClass('disabled');
                $('#trackid-2').addClass('disabled');
                $('#trackid-3').addClass('disabled');
            }
            if(($('#filter_s_date_2').val() != '' || $('#filter_s_date_2').val() != null) && trickid != 8){
                    $('#trackid-8').addClass('disabled');
                    console.log("dissaled 8");
            }
        }
    </script>

    <?php $this->endSection(); ?>