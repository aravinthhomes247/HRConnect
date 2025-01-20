<?php $session = \Config\Services::session(); ?>

<?php $this->extend("layouts/header") ?>

<?php $this->section("body") ?>

<input type="hidden" id="trickid" value="<?php echo $trickid ?>">
<input type="hidden" id="filter_designation" value="<?= $filter_designation ?>">
<input type="hidden" id="filter_source" value="<?= $filter_source ?>">
<input type="hidden" id="filter_hr" value="<?= $filter_hr ?>">

<input type="hidden" id="filter_s_date_1" value="<?= $filter_s_date_1 ?>">
<input type="hidden" id="filter_e_date_1" value="<?= $filter_e_date_1 ?>">
<input type="hidden" id="filter_s_date_2" value="<?= $filter_s_date_2 ?>">
<input type="hidden" id="filter_e_date_2" value="<?= $filter_s_date_2 ?>">

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
        width: 5px;
    }

    .reportrange-column .daterangepicker {
        position: absolute;
    }

    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc:after {
        display: none !important;
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

    .Search{
        appearance: none;           /* Standard */
        -webkit-appearance: none;   /* Chrome & Safari */
        -moz-appearance: none;      /* Firefox */

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

    .select-wrapper{
        position: relative; 
        display: inline-block;
        width: 100%;
    }

    .dataTF-icon{
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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="d-flex justify-content ">
                                        <h4>Upcoming Scheduled (<span id="Tit-count"></span>)</h4>
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
                                <?php
                                if ($session->getFlashdata('CandidateSuccessMsg')) { ?>
                                    <div class="col-lg-12">
                                        <div class="alert alert-success bg-orange alert-dismissible fade show" role="alert">
                                            <strong><?= $session->getFlashdata('CanidateSuccessMsg') ?></strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover " id="example11">
                                <thead>
                                    <tr>
                                        <th>Sl no</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Source</th>
                                        <th>Interview Date
                                            <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                            <input type="text" class="reportrange-column" id="rangepicker-1" data-ffor="InterviewDate" data-fsfor="Interview Date" />
                                        </th>
                                        <!-- <th>Scheduled By</th> -->
                                        <th>Uploaded Date
                                            <i class="far fa-calendar-alt calendar-icon" data-id="2" style="cursor: pointer;"></i>
                                            <input type="text" class="reportrange-column" id="rangepicker-2" data-ffor="UploadDate" data-fsfor="Uploaded Date" />
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
        var trickid = document.getElementById("trickid").value;
        var DESIGNATIONS = <?php echo json_encode($DESIGNATIONS); ?>;
        var SOURCES = <?php echo json_encode($SOURCES); ?>;
        var HRS = <?php echo json_encode($HRS); ?>;
        var HTML = '';

        if ($('#filter_s_date_1').val() != '') {
            HTML = `<div class="chip fc-date-1">
                            ` + 'Updated On ' + $('#filter_s_date_1').val() + ` to ` + $('#filter_e_date_1').val() + `<span class="closebtn" data-element="#rangepicker-1" onclick="this.parentElement.style.display='none'">&times;</span>
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
        if ($('#filter_s_date_2').val() != '') {
            FSD2FOR = 'Uploaded Date';
            HTML = `<div class="chip fc-date-2">
                        ` + FSD2FOR + ' ' + $('#filter_s_date_2').val() + ` to ` + $('#filter_e_date_2').val() + `<span class="closebtn" data-element="#rangepicker-2" onclick="this.parentElement.style.display='none'">&times;</span>
                    </div>`;
            $('#filter-group').append(HTML);
        }

        $('#rangepicker-1').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            },
            minDate: moment().add(1, 'days'),
            ranges: {
                    // 'Today': [moment(), moment()],
                    'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
                    'Next 7 Days': [moment(), moment().add(6, 'days')],
                    'Next 30 Days': [moment(), moment().add(29, 'days')],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
            }
        });

        $('#rangepicker-2').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            },
            maxDate:moment(),
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
                "url": "<?= base_url().'/data-candidate/load/HR-candidate_list/' . $trickid ?>",
                "type": "GET",
                "data": function(d) {
                    d.d_value = $('#filter_designation').val();
                    d.s_value = $('#filter_source').val();
                    d.h_value = $('#filter_hr').val();
                    d.s_date_1 = $('#filter_s_date_1').val();
                    d.e_date_1 = $('#filter_e_date_1').val();
                    d.s_date_2 = $('#filter_s_date_2').val();
                    d.e_date_2 = $('#filter_e_date_2').val();
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
                        return `<a href="<?php echo site_url('edit_candidate_view?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
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
                    "data": "InterviewDate"
                },
                // {
                //     "data": "HRName"
                // },
                {
                    "data": "Created_at"
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
                    var select = $('<select class="Search SelectedFiltervalue-1" data-col="CandidatePosition" ><option value=""> Designations</option></select>');
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
                    var select = $('<select class="Search SelectedFiltervalue-2" data-col="Source" ><option value=""> Sources</option></select>');
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
                //     var select = $('<select class="Search SelectedFiltervalue-3" data-col="HRName" ><option value=""> Scheduled By</option></select>');
                //     var select_w = $('<div class="select-wrapper"></div>')
                //                         .append(select)
                //                         .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                //                         .appendTo($(column.header()).empty());
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
                            ` + $(this).data('fsfor') + ` ` + picker.startDate.format('YYYY/MM/DD') + ` to ` + picker.endDate.format('YYYY/MM/DD') + `<span class="closebtn" data-element="#rangepicker-1" onclick="this.parentElement.style.display='none'">&times;</span>
                        </div>`;
            $('#filter-group').append(HTML);
            url_change();
            table.ajax.reload();
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
        });
        $('#rangepicker-1').on('cancel.daterangepicker', function(ev, picker) {
            $('#filter_s_date_1').val('');
            $('#filter_e_date_1').val('');
            picker.setStartDate(moment());
            picker.setEndDate(moment());
            url_change();
            $('.fc-date-1').hide();
            table.ajax.reload();
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
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
            table.ajax.reload();
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
        });
        $('#rangepicker-2').on('cancel.daterangepicker', function(ev, picker) {
            $('#filter_s_date_2').val('');
            $('#filter_e_date_2').val('');
            picker.setStartDate(moment());
            picker.setEndDate(moment());
            $('.fc-date-2').hide();
            url_change();
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
                var HTML = `<div class="chip fc-designation">
                                ` + $(this).val() + `<span class="closebtn" data-element=".SelectedFiltervalue-1" onclick="this.parentElement.style.display='none'">&times;</span>
                            </div>`;
            }
            $('#filter-group').append(HTML);
            url_change();
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
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
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
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
            table.on('xhr.dt', function(e, settings, json, xhr) {
                if (json && json.recordsFiltered !== undefined) {
                    $('#Tit-count').html(json.recordsFiltered);
                }
            });
            table.ajax.reload();
        });

        $('#filter-group').on("click", '.closebtn', function(ev, picker) {
            var element = $(this).data('element');
            if (element === '.SelectedFiltervalue-1') {
                $(element + ' option:first').prop('selected', true);
                $('#filter_designation').val('');
                url_change();
                table.on('xhr.dt', function(e, settings, json, xhr) {
                    if (json && json.recordsFiltered !== undefined) {
                        $('#Tit-count').html(json.recordsFiltered);
                    }
                });
                table.ajax.reload();
            } else if (element === '.SelectedFiltervalue-2') {
                $(element + ' option:first').prop('selected', true);
                $('#filter_source').val('');
                url_change();
                table.on('xhr.dt', function(e, settings, json, xhr) {
                    if (json && json.recordsFiltered !== undefined) {
                        $('#Tit-count').html(json.recordsFiltered);
                    }
                });
                table.ajax.reload();
            } else if (element === '.SelectedFiltervalue-3') {
                $(element + ' option:first').prop('selected', true);
                $('#filter_hr').val('');
                url_change();
                table.on('xhr.dt', function(e, settings, json, xhr) {
                    if (json && json.recordsFiltered !== undefined) {
                        $('#Tit-count').html(json.recordsFiltered);
                    }
                });
                table.ajax.reload();
            } else if (element === '#rangepicker-1') {
                $('#filter_s_date_1').val('');
                $('#filter_e_date_1').val('');
                $(element).data('daterangepicker').setStartDate(moment());
                $(element).data('daterangepicker').setEndDate(moment());
                $('.fc-date-1').hide();
                url_change();
                table.on('xhr.dt', function(e, settings, json, xhr) {
                    if (json && json.recordsFiltered !== undefined) {
                        $('#Tit-count').html(json.recordsFiltered);
                    }
                });
                table.ajax.reload();
            } else if (element === '#rangepicker-2') {
                $('#filter_s_date_2').val('');
                $('#filter_e_date_2').val('');
                $(element).data('daterangepicker').setStartDate(moment());
                $(element).data('daterangepicker').setEndDate(moment());
                $('.fc-date-2').hide();
                url_change();
                table.on('xhr.dt', function(e, settings, json, xhr) {
                    if (json && json.recordsFiltered !== undefined) {
                        $('#Tit-count').html(json.recordsFiltered);
                    }
                });
                table.ajax.reload();
            }
        });
    });

    function url_change() {
        window.history.replaceState(null, '', 'candidate?trickid=' + $('#trickid').val() + '&fs=' + $('#filter_source').val() + '&fd=' + $('#filter_designation').val() + '&hr=' + $('#filter_hr').val() + '&fsd-1=' + $('#filter_s_date_1').val() + '&fed-1=' + $('#filter_e_date_1').val() + '&fsd-2=' + $('#filter_s_date_2').val() + '&fed-2=' + $('#filter_e_date_2').val());
    }
</script>

<?php $this->endSection(); ?>