<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?>

<input type="hidden" id="filter_status" value="<?= $filter_status ?>">
<input type="hidden" id="filter_designation" value="<?= $filter_designation ?>">
<input type="hidden" id="filter_hr" value="<?= $filter_hr ?>">
<input type="hidden" id="filter_s_date" value="<?= $filter_s_date ?>">
<input type="hidden" id="filter_e_date" value="<?= $filter_e_date ?>">

<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <style>
        table.table-hover.dataTable.no-footer{
            width: 100% !important;
        }
        .reportrange-column {
            position: relative;
            visibility: hidden;
            width: 5px;
        }

        .reportrange-column .daterangepicker {
            position: absolute;
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
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="d-flex justify-content ">
                                        <div class="form-group ml-1 ">
                                            <h4>Track Activities (<span id="Tit-count"></span>)</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="d-flex justify-content-end ">
                                        <div class="form-group ml-1 mt-1">
                                            <div class="input-group" id="filter-group">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <a href="#" class="btn btn-sm bg-orange mt-1 activeclass" id="date-btn-today">Today</a>
                                    <a href="#" class="btn btn-sm bg-orange mt-1" id="date-btn-yesterday">Yesterday</a>
                                    <a href="#" class="btn btn-sm bg-orange mt-1" id="date-btn-lsdays">Last 7 days</a>
                                    <a href="#" class="btn btn-sm bg-orange mt-1" id="date-btn-ltdays">Last 30 days</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover " id="example11">
                                <thead>
                                    <tr>
                                        <th>Sl no</th>
                                        <th>Name</th>
                                        <th>Position Applied</th>
                                        <th>Status</th>
                                        <!-- <th>Action By</th> -->
                                        <th>Remarks</th>
                                        <th>Activity Date
                                            <i class="far fa-calendar-alt calendar-icon" style="cursor: pointer;"></i>
                                            <input type="text" class="reportrange-column" id="rangepicker-1" data-ffor="added_date" data-fsfor="Activity Date" />
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- autocomplete function  -->
<script type='text/javascript'>
    $(document).ready(function() {
        var DESIGNATIONS = <?php echo json_encode($DESIGNATIONS); ?>;
        var STATUS = <?php echo json_encode($STATUS); ?>;
        var HRS = <?php echo json_encode($HRS); ?>;
        var HTML = '';

        if ($('#filter_s_date').val() != '') {
            HTML = `<div class="chip fc-date">
                            ` + 'Activity Date ' + $('#filter_s_date').val() + ` to ` + $('#filter_e_date').val() + `<span class="closebtn" data-element="#rangepicker-1" onclick="this.parentElement.style.display='none'">&times;</span>
                        </div>`;
            $('#filter-group').append(HTML);
        }
        if ($('#filter_designation').val() != '') {
            HTML = `<div class="chip fc-designation">
                            ` + $('#filter_designation').val() + `<span class="closebtn" data-element=".SelectedFiltervalue-1" onclick="this.parentElement.style.display='none'">&times;</span>
                        </div>`;
            $('#filter-group').append(HTML);
        }
        if ($('#filter_hr').val() != '') {
            HTML = `<div class="chip fc-hr">
                            ` + $('#filter_hr').val() + `<span class="closebtn" data-element=".SelectedFiltervalue-3" onclick="this.parentElement.style.display='none'">&times;</span>
                        </div>`;
            $('#filter-group').append(HTML);
        }
        if ($('#filter_status').val() != '') {
            HTML = `<div class="chip fc-status">
                        ` + $('#filter_status').val() + `<span class="closebtn" data-element=".SelectedFiltervalue-2" onclick="this.parentElement.style.display='none'">&times;</span>
                    </div>`;
            $('#filter-group').append(HTML);
        }

        $('#rangepicker-1').daterangepicker({
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

        var table = $('#example11').DataTable({
            "paging": true,
            "info": true,
            "processing": true,
            "serverSide": true,
            "deferRender": true,
            "columnDefs": [{
                "orderable": false,
                "targets": '_all'
            }],
            "ajax": {
                "url": "<?= base_url('/data-candidate/load/HR-today_activity') ?>",
                "type": "GET",
                "data": function(d) {
                    d.s_value = $('#filter_status').val();
                    d.d_value = $('#filter_designation').val();
                    d.h_value = $('#filter_hr').val();
                    d.s_date = $('#filter_s_date').val();
                    d.e_date = $('#filter_e_date').val();
                },
                "error": function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error:", textStatus, errorThrown);
                }
            },
            "columns": [{
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
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
                    "data": "designations"
                },
                {
                    "data": "Status"
                },
                // {
                //     "data": "EmployeeName"
                // },
                {
                    "data": "Remarks"
                },
                {
                    "data": "added_date"
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
                    var select = $('<select class="Search  SelectedFiltervalue-1" ><option value=""> Designations</option></select>');
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
                // Create dropdown filter for "Status" (Column 3)
                this.api().columns(3).every(function() {
                    var column = this;
                    var select = $('<select class="Search  SelectedFiltervalue-2" ><option value=""> Status</option></select>');
                    var select_w = $('<div class="select-wrapper"></div>')
                        .append(select)
                        .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                        .appendTo($(column.header()).empty());
                    STATUS.forEach(function(d) {
                        if ($('#filter_status').val() === d.Status) {
                            select.append('<option value="' + d.Status + '" selected>' + d.Status + '</option>');
                        } else {
                            select.append('<option value="' + d.Status + '">' + d.Status + '</option>');
                        }
                    });
                });
                // Create dropdown filter for "HR" (Column 4)
                // this.api().columns(4).every(function() {
                //     var column = this;
                //     var select = $('<select class="Search  SelectedFiltervalue-3" ><option value=""> Action By</option></select>');
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
            if (json && json.recordsFiltered !== undefined) {
                $('#Tit-count').html(json.recordsFiltered);
            }
        });


        $('.calendar-icon').on('click', function() {
            $('#rangepicker-1').trigger('click');
        });
        $('#rangepicker-1').on('apply.daterangepicker', function(ev, picker) {
            $('#filter_s_date').val(picker.startDate.format('YYYY/MM/DD'));
            $('#filter_e_date').val(picker.endDate.format('YYYY/MM/DD'));
            $('.fc-date').hide();
            var HTML = `<div class="chip fc-date">
                            ` + $(this).data('fsfor') + ` ` + picker.startDate.format('YYYY/MM/DD') + ` to ` + picker.endDate.format('YYYY/MM/DD') + `<span class="closebtn" data-element="#rangepicker-1" onclick="this.parentElement.style.display='none'">&times;</span>
                        </div>`;
            $('#filter-group').append(HTML);
            url_change();
            button_active($('#filter_s_date').val(), $('#filter_e_date').val());
            table.ajax.reload();
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
        });
        $('#rangepicker-1').on('cancel.daterangepicker', function(ev, picker) {
            $('#filter_s_date').val('');
            $('#filter_e_date').val('');
            picker.setStartDate(moment());
            picker.setEndDate(moment());
            url_change();
            button_active($('#filter_s_date').val(), $('#filter_e_date').val());
            $('.fc-date').hide();
            table.ajax.reload();
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
        });

        $('.table-hover').on('change', '.SelectedFiltervalue-1', function() {
            $('#filter_designation').val($(this).val());
            if ($(this).val() == null || $(this).val() === '') {
                $('.fc-designation').hide();
                HTML = '';
            } else {
                $('.fc-designation').hide();
                HTML = `<div class="chip fc-designation">
                                    ` + $(this).val() + `<span class="closebtn" data-element=".SelectedFiltervalue-1" onclick="this.parentElement.style.display='none'">&times;</span>
                                </div>`;
            }
            $('#filter-group').append(HTML);
            url_change();
            button_active($('#filter_s_date').val(), $('#filter_e_date').val());
            table.ajax.reload();
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
        });

        $('.table-hover').on('change', '.SelectedFiltervalue-2', function() {
            $('#filter_status').val($(this).val());
            if ($(this).val() == null || $(this).val() === '') {
                $('.fc-status').hide();
                HTML = '';
            } else {
                $('.fc-status').hide();
                HTML = `<div class="chip fc-status">
                                    ` + $(this).val() + `<span class="closebtn" data-element=".SelectedFiltervalue-2" onclick="this.parentElement.style.display='none'">&times;</span>
                                </div>`;
            }
            $('#filter-group').append(HTML);
            url_change();
            button_active($('#filter_s_date').val(), $('#filter_e_date').val());
            table.ajax.reload();
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
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
            button_active($('#filter_s_date').val(), $('#filter_e_date').val());
            table.ajax.reload();
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
        });

        $('#filter-group').on("click", '.closebtn', function(ev, picker) {
            var element = $(this).data('element');
            if (element === '.SelectedFiltervalue-1') {
                $(element + ' option:first').prop('selected', true);
                $('#filter_designation').val('');
            } else if (element === '.SelectedFiltervalue-2') {
                $(element + ' option:first').prop('selected', true);
                $('#filter_status').val('');
            } else if (element === '.SelectedFiltervalue-3') {
                $(element + ' option:first').prop('selected', true);
                $('#filter_hr').val('');
            } else if (element === '#rangepicker-1') {
                $('#filter_s_date').val('');
                $('#filter_e_date').val('');
                $(element).data('daterangepicker').setStartDate(moment());
                $(element).data('daterangepicker').setEndDate(moment());
            }
            url_change();
            button_active($('#filter_s_date').val(), $('#filter_e_date').val());
            table.ajax.reload();
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
        });

        $("#date-btn-today").on("click", function() {
            $(this).addClass('activeclass');
            $("#date-btn-yesterday").removeClass('activeclass');
            $("#date-btn-lsdays").removeClass('activeclass');
            $("#date-btn-ltdays").removeClass('activeclass');
            var sd = moment();
            var ed = moment();
            $('#rangepicker-1').data('daterangepicker').setStartDate(sd);
            $('#rangepicker-1').data('daterangepicker').setEndDate(ed);
            $('#filter_s_date').val(sd.format('YYYY-MM-DD'));
            $('#filter_e_date').val(ed.format('YYYY-MM-DD'));
            url_change();
            button_active($('#filter_s_date').val(), $('#filter_e_date').val());
            $('.fc-date').hide();
            var HTML = `<div class="chip fc-date">
                            `+'Activity Date '+` ` + sd.format('YYYY/MM/DD') + ` to ` + ed.format('YYYY/MM/DD') + `<span class="closebtn" data-element="#rangepicker-1" onclick="this.parentElement.style.display='none'">&times;</span>
                        </div>`;
            $('#filter-group').append(HTML);
            table.ajax.reload();
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
        });

        $("#date-btn-yesterday").on("click", function() {
            $(this).addClass('activeclass');
            $("#date-btn-today").removeClass('activeclass');
            $("#date-btn-lsdays").removeClass('activeclass');
            $("#date-btn-ltdays").removeClass('activeclass');
            var sd = moment().subtract(1, 'days');
            var ed = moment().subtract(1, 'days');
            $('#rangepicker-1').data('daterangepicker').setStartDate(sd);
            $('#rangepicker-1').data('daterangepicker').setEndDate(ed);
            $('#filter_s_date').val(sd.format('YYYY-MM-DD'));
            $('#filter_e_date').val(ed.format('YYYY-MM-DD'));
            url_change();
            button_active($('#filter_s_date').val(), $('#filter_e_date').val());
            $('.fc-date').hide();
            var HTML = `<div class="chip fc-date">
                            `+'Activity Date '+` ` + sd.format('YYYY/MM/DD') + ` to ` + ed.format('YYYY/MM/DD') + `<span class="closebtn" data-element="#rangepicker-1" onclick="this.parentElement.style.display='none'">&times;</span>
                        </div>`;
            $('#filter-group').append(HTML);
            table.ajax.reload();
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
        });

        $("#date-btn-lsdays").on("click", function() {
            $(this).addClass('activeclass');
            $("#date-btn-yesterday").removeClass('activeclass');
            $("#date-btn-today").removeClass('activeclass');
            $("#date-btn-ltdays").removeClass('activeclass');
            var sd = moment().subtract(6, 'days');
            var ed = moment();
            $('#rangepicker-1').data('daterangepicker').setStartDate(sd);
            $('#rangepicker-1').data('daterangepicker').setEndDate(ed);
            $('#filter_s_date').val(sd.format('YYYY-MM-DD'));
            $('#filter_e_date').val(ed.format('YYYY-MM-DD'));
            url_change();
            button_active($('#filter_s_date').val(), $('#filter_e_date').val());
            $('.fc-date').hide();
            var HTML = `<div class="chip fc-date">
                            `+'Activity Date '+` ` + sd.format('YYYY/MM/DD') + ` to ` + ed.format('YYYY/MM/DD') + `<span class="closebtn" data-element="#rangepicker-1" onclick="this.parentElement.style.display='none'">&times;</span>
                        </div>`;
            $('#filter-group').append(HTML);
            table.ajax.reload();
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
        });

        $("#date-btn-ltdays").on("click", function() {
            $(this).addClass('activeclass');
            $("#date-btn-yesterday").removeClass('activeclass');
            $("#date-btn-lsdays").removeClass('activeclass');
            $("#date-btn-today").removeClass('activeclass');
            var sd = moment().subtract(29, 'days');
            var ed = moment();
            $('#rangepicker-1').data('daterangepicker').setStartDate(sd);
            $('#rangepicker-1').data('daterangepicker').setEndDate(ed);
            $('#filter_s_date').val(sd.format('YYYY-MM-DD'));
            $('#filter_e_date').val(ed.format('YYYY-MM-DD'));
            url_change();
            button_active($('#filter_s_date').val(), $('#filter_e_date').val());
            $('.fc-date').hide();
            var HTML = `<div class="chip fc-date">
                            `+'Activity Date '+` ` + sd.format('YYYY/MM/DD') + ` to ` + ed.format('YYYY/MM/DD') + `<span class="closebtn" data-element="#rangepicker-1" onclick="this.parentElement.style.display='none'">&times;</span>
                        </div>`;
            $('#filter-group').append(HTML);
            table.ajax.reload();
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
        });

        button_active($('#filter_s_date').val(), $('#filter_e_date').val());
    });


    function url_change() {
        window.history.replaceState(null, '', 'HRtodays_activity?fs=' + $('#filter_status').val() + '&fd=' + $('#filter_designation').val() + '&hr=' + $('#filter_hr').val() + '&fsd=' + $('#filter_s_date').val() + '&fed=' + $('#filter_e_date').val());
    }

    function button_active(sd, ed) {
        var startDate = moment(sd);
        var endDate = moment(ed);

        $("#date-btn-today").removeClass('activeclass');
        $("#date-btn-yesterday").removeClass('activeclass');
        $("#date-btn-lsdays").removeClass('activeclass');
        $("#date-btn-ltdays").removeClass('activeclass');

        if (startDate.isSame(moment(), 'day') && endDate.isSame(moment(), 'day')) {
            $("#date-btn-today").addClass('activeclass');
        } else if (startDate.isSame(moment().subtract(1, 'days'), 'day') && endDate.isSame(moment().subtract(1, 'days'), 'day')) {
            $("#date-btn-yesterday").addClass('activeclass');
        } else if (startDate.isSame(moment().subtract(6, 'days'), 'day') && endDate.isSame(moment(), 'day')) {
            $("#date-btn-lsdays").addClass('activeclass');
        } else if (startDate.isSame(moment().subtract(29, 'days'), 'day') && endDate.isSame(moment(), 'day')) {
            $("#date-btn-ltdays").addClass('activeclass');
        } else if(sd == '' || sd == null){
            $("#date-btn-today").addClass('activeclass');
        }
    }
</script>

<?= $this->endSection(); ?>