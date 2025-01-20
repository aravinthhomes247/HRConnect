<?php $session = \Config\Services::session(); ?>
<?php $this->extend("layouts/header-new") ?>
<?php $this->section("body") ?>

<input type="hidden" id="trickid" value="<?php echo $trickid ?>">
<input type="hidden" id="filter_designation" value="<?= $filter_designation ?>">
<input type="hidden" id="filter_source" value="<?= $filter_source ?>">
<input type="hidden" id="filter_hr" value="<?= $filter_hr ?>">
<input type="hidden" id="filter_s_date_2" value="<?= $filter_s_date_2 ?>">
<input type="hidden" id="filter_e_date_2" value="<?= $filter_e_date_2 ?>">

<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
}
?>

<style>
    /* .dt-container.dt-bootstrap5.dt-empty-footer {
        font-size: x-small;
    } */

    table.table-hover.dataTable.no-footer {
        width: 100% !important;
    }

    .reportrange-column {
        visibility: hidden;
        width: 1px;
    }

    table.dataTable th.dt-type-numeric,
    table.dataTable th.dt-type-date,
    table.dataTable td.dt-type-numeric,
    table.dataTable td.dt-type-date {
        text-align: left;
    }


    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .dt-column-order:before {
        display: none !important;
    }

    table.dataTable {
        border-collapse: collapse;
        width: 100%;
    }

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
        color: #8146D4;
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
        -webkit-appearance: none;
        -moz-appearance: none;
        font-weight: 700;
        border: none;
        color: #0b3544;
        text-align: left;
        padding-left: 0.2em;
        cursor: pointer;
        width: 100%;
        background-color: transparent;
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

    .input-group {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
        color: #ccc;
        background-color: #F7F7F8;
        border: none;
    }
</style>

<div class="career ms-4">
    <div class="row ms-0 me-0 pt-2">
        <div class="col col-lg-5 mt-1">
            <h4>Today Scheduled (<span id="Tit-count"></span>)</h4>
        </div>
        <div class="col col-lg-7">
            <div class="d-flex justify-content-end">
                <div class="form-group ml-1 mt-1">
                    <div class="input-group" id="filter-group">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row ms-1 me-1 pt-2">
        <table class="table table-hover ms-2" id="example11">
            <thead class="table-secondary">
                <tr>
                    <th>Sl no</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Source</th>
                    <th>Interview Date</th>
                    <!-- <th>Scheduled By</th> -->
                    <th>Uploaded Date
                        <i class="far fa-calendar-alt calendar-icon" data-id="2" style="cursor: pointer;"></i>
                        <input type="text" class="reportrange-column" id="rangepicker-2" data-ffor="UploadDate" data-fsfor="Uploaded Date" />
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- autocomplete function  -->
<script type='text/javascript'>
    $(document).ready(function() {
        var trickid = document.getElementById("trickid").value;
        var DESIGNATIONS = <?php echo json_encode($DESIGNATIONS); ?>;
        var SOURCES = <?php echo json_encode($SOURCES); ?>;
        var HRS = <?php echo json_encode($HRS); ?>;
        var HTML = '';

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
        });
        $('#rangepicker-2').on('cancel.daterangepicker', function(ev, picker) {
            $('#filter_s_date_2').val('');
            $('#filter_e_date_2').val('');
            picker.setStartDate(moment());
            picker.setEndDate(moment());
            $('.fc-date-2').hide();
            url_change();
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