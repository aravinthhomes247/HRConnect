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

    .fa-solid.fa-arrow-left {
        top: 35%;
        left: 35%;
        position: relative;
        font-size: x-large;
        color: #8146d4;
        cursor: pointer;
    }

    .fa-solid.fa-arrow-right {
        top: 35%;
        right: 20%;
        position: relative;
        font-size: x-large;
        color: #8146d4;
        cursor: pointer;
    }
</style>


<div class="Employees ms-4 mt-1">
    <div class="row ms-0 me-0 mt-2 pt-2">
        <div class="col col-lg-9">
            <input type="hidden" name="trickid" id="trickid" value="<?= $trickid ?>">
            <a href="<?= site_url('/reportemp?trickid=1&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 1) ? 'active' : '' ?>">All</a>
            <a href="<?= site_url('/reportemp?trickid=2&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 2) ? 'active' : '' ?>">Late Comers - <?= $lateComers ?></a>
            <a href="<?= site_url('/reportemp?trickid=3&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 3) ? 'active' : '' ?>">Early Exiters - <?= $earlylogout ?></a>
            <a href="<?= site_url('/reportemp?trickid=4&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 4) ? 'active' : '' ?>">Abnormal Time Log - <?= $abnormal ?></a>
        </div>
        <div class="col col-lg-3">
            <div class="action">
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
    </div>

    <div class="row ms-1 me-1 mt-2 pt-2 mb-3">
        <div class="col-1 namehead">
            <?php if ($PrevEmp != 0) { ?>
                <a href="<?= base_url('/reportempdia?id=' . $PrevEmp . '&trickid=1&fdate=' . $fdate . '&todate=' . $todate) ?>"><i class="fa-solid fa-arrow-left"></i></a>
            <?php } else { ?>
                <a href="javascript:void(0);"><i class="fa-solid fa-arrow-left" style="color: #DEDEDE;"></i></a>
            <?php } ?>
        </div>
        <div class="col-10 text-center namehead">
            <h4 class="mt-2"><?= $EmpName ?></h4>
            <p><?= $EmpDesig ?></p>
        </div>
        <div class="col-1 namehead">
            <?php if ($NextEmp != 0) { ?>
                <a href="<?= base_url('/reportempdia?id=' . $NextEmp . '&trickid=1&fdate=' . $fdate . '&todate=' . $todate) ?>"><i class="fa-solid fa-arrow-right"></i></a>
            <?php } else { ?>
                <a href="javascript:void(0);"><i class="fa-solid fa-arrow-right" style="color: #DEDEDE;"></i>></i></a>
            <?php } ?>
        </div>
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



<script>
    const menuTriggers = document.querySelectorAll('.menu-trigger');
    menuTriggers.forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            event.stopPropagation();
            document.querySelectorAll('.dropdown').forEach((dropdown) => {
                dropdown.style.display = 'none';
            });
            const dropdown = trigger.nextElementSibling;
            dropdown.style.display = 'block';
        });
    });
    document.addEventListener('click', () => {
        document.querySelectorAll('.dropdown').forEach((dropdown) => {
            dropdown.style.display = 'none';
        });
    });

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
        var EmpID = <?= $EmpID ?>;
        var daterange = document.getElementById("reportrange").value;
        var temp1 = daterange.split('-').pop();
        var dateString1 = temp1.replaceAll('/', "-");
        var todateid = moment(dateString1).format('YYYY-MM-DD');
        var temp2 = daterange.slice(0, 10);
        var dateString2 = temp2.replaceAll('/', "-");
        var fromdateid = moment(dateString2).format('YYYY-MM-DD');
        window.location.href = `reportempdia?id=${EmpID}&trickid=1&fdate=${fromdateid}&todate=${todateid}`;
    }
</script>

<?= $this->endSection() ?>