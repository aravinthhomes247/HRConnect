<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>


<style>
    .modal-footer .btn {
        width: max-content !important;
        background-color: #8146D4;
        color: white;
        border: 1px solid #8146D4;
        border-radius: 2px;
        padding: 3px 5px !important;
    }

    .modal-header {
        background-color: #925EDD14;
        text-align: center;
    }

    button.close {
        border: 1px solid #8146D4;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        color: #8146D4;
    }

    .dropdown {
        display: none;
        position: absolute;
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 120px;
    }

    .dropdown a {
        padding: 5px 10px !important;
        display: block;
        /* color: black !important; */
        text-decoration: none !important;
        width: 100% !important;
    }

    .dropdown a:hover {
        background-color: #f0f0f0;
    }

    .namehead {
        background-color: white;
    }

    .Employees table {
        width: 100%;
    }

    .table.table-hover.time-log {
        border-top: 1px solid #D9D9D9;
    }

    .container.Employees {
        background-color: white;
    }
</style>

<div class="container mt-3">
    <div class="row">
        <div class="col text-start"><h4>Time Logs</h4></div>
        <div class="col text-end"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TicketAddModel"><i class="fa-solid fa-plus"></i> Raise a Ticket</button></div>
    </div>
</div>
<div class="container Employees mt-3">
    <div class="row ms-1 me-1 mt-2 pt-2 mb-3">
        <div class="col-8"></div>
        <div class="col-4">
            <div class="action ms-5">
                <i class="fa-solid fa-calendar-days"></i>
                <input class="form-control" type="text" style="padding-left: 30px; box-sizing: border-box;" id="reportrange">
                <?php
                if (empty($fdate)) {
                    $fdate = date("Y-m-d");
                }
                ?>
                <input type="hidden" name="fdate" id="fdate" value="<?= $fdate ?>" />
                <?php
                if (empty($todate)) {
                    $todate = date("Y-m-d");
                }
                ?>
                <input type="hidden" name="todate" id="todate" value="<?= $todate ?>" />
                <button class="btn btn-primary" style="margin-left: 10px;" onclick="datefilter()">Check</button>
            </div>
        </div>
        <div class="col-12 mt-3">
            <table class="table table-hover time-log mb-2">
                <tbody>
                    <?php
                    if ($TimeLogs):
                        foreach ($TimeLogs as $date => $points): ?>
                            <tr>
                                <td>
                                    <div class="row ms-0 me-0">
                                        <div class="log-days-1">
                                            <span><b><?= $points['DayInfo']['Day'] . ' ' ?><?= $points['DayInfo']['d'] ?></b></span>
                                        </div>
                                        <div class="log-chart">
                                            <div class="row">
                                                <div class="info-dots ms-0 me-0 p-0">
                                                    <div class="<?= ($points['minmax']['Late_Login'] == 0) ? 'dots-start' : 'dots-end' ?> ms-2" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5><?= $points['minmax']['First'] ?></h5>Check-in <?= ($points['minmax']['Late_Login'] == 0) ? '🟢' : '🔴' ?>"></div>
                                                </div>
                                                <div class="lines ms-0 me-0 p-0">
                                                    <div class="progress-stacked">
                                                        <?php foreach ($points['Points'] as $point): ?>
                                                            <div class="progress" style="width: <?= $point['percentage'] ?>%">
                                                                <?php if ($point['e_auto'] == 0) { ?>
                                                                    <div class="<?= ($point['s_auto'] == 0) ? 'dot-start' : 'dot-auto-start' ?>" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5><?= $point['start'] ?></h5>Check-in"></div>
                                                                <?php } ?>
                                                                <div class="progress-bar <?= ($point['color'] == 0) ? 'gap' : '' ?>"></div>
                                                                <?php if ($point['s_auto'] == 0) { ?>
                                                                    <div class="<?= ($point['e_auto'] == 0) ? 'dot-end' : 'dot-auto-end' ?>" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5><?= $point['end'] ?></h5>Check-out"></div>
                                                                <?php } ?>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                                <div class="info-dots me-0 ms-0 p-0">
                                                    <div class="<?= ($points['minmax']['Early_Logout'] == 0) ? 'dots-start' : 'dots-end' ?> ms-3" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5><?= $points['minmax']['Last'] ?></h5>Check-out <?= ($points['minmax']['Early_Logout'] == 0) ? '🟢' : '🔴' ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="log-days-2">
                                            <span><b><?= $points['DayInfo']['WHS'] ?></b> Work Hrs</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td style="text-align:center;">No Logs Available!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal" id="TicketAddModel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Raise a Ticket</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('add-ticket') ?>" method="post">
                    <input type="hidden" name="EmployeeIDFK" value="<?= $EmpId ?>">
                    <div class="row mb-2">
                        <div class="col-3">
                            <h6 class="mt-2">Ticket Subject</h6>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="Subject" placeholder="Enter Subject" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h6 class="mt-2">Issue Type</h6>
                        </div>
                        <div class="col-9">
                            <select name="TypeIDFK" class="form-select" required>
                                <option value="">Select Case Type</option>
                                <?php foreach ($issuetypes as $type): ?>
                                    <option value="<?= $type['IDPK'] ?>"><?= $type['Name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h6 class="mt-2">Priority Level</h6>
                        </div>
                        <div class="col-9">
                            <select name="Priority" class="form-select" required>
                                <option value="">Select Level</option>
                                <option value="0">Low</option>
                                <option value="1">Medium</option>
                                <option value="2">High</option>
                                <option value="3">Critical</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h6 class="mt-2">Description</h6>
                        </div>
                        <div class="col-9">
                            <textarea name="Description" class="form-control" placeholder="Explain..." required></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary w-50">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(el => {
            const tooltip = new bootstrap.Tooltip(el, {
                customClass: `${el.classList[0]}-tooltip`
            });
            return tooltip;
        });
    });

    $(document).ready(function() {
        $('#reportrange').daterangepicker({
            format: 'YYYY/MM/DD',
            locale: {
                format: 'YYYY/MM/DD'
            },
            startDate: '<?= date("Y/m/d", strtotime($fdate)) ?>',
            endDate: '<?= date("Y/m/d", strtotime($todate)) ?>',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
        }, function(start, end, label) {
            // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });

    function datefilter() {
        var daterange = document.getElementById("reportrange").value;
        var temp1 = daterange.split('-').pop();
        var dateString1 = temp1.replaceAll('/', "-");
        var todateid = moment(dateString1).format('YYYY-MM-DD');
        var temp2 = daterange.slice(0, 10);
        var dateString2 = temp2.replaceAll('/', "-");
        var fromdateid = moment(dateString2).format('YYYY-MM-DD');
        window.location.href = `user-timelog?fdate=${fromdateid}&todate=${todateid}`;
    }
</script>


<?= $this->endSection() ?>