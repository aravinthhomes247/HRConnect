<?php $session = \Config\Services::session(); ?>
<?php echo ($this->extend("layouts/header-new")) ?>
<?php echo ($this->section("body")) ?>


    

<div class="profile-container mt-2 ms-4 ps-1 pt-1 pe-1">
    <div class="row me-0">
        <div class="col col-lg-1 col-md-1">
                <?php if(empty($BasicDetails['Image'])){ ?>
                    <img class="img-circle elevation-2" src="<?php echo base_url('public/images/default-profile.png') ?>" >
            <?php } else { ?>
                <img class="img-circle elevation-2" src="<?php echo base_url('public/Uploads/ProfilePhotosuploads/' . $BasicDetails['Image']); ?>" alt="<?php echo $BasicDetails['EmployeeName']; ?>">
            <?php } ?>
        </div>
        <div class="col col-lg-9 col-md-9">
            <div class="row">
                <span><b><?= $BasicDetails['EmployeeName'] ?></b> - <?= $BasicDetails['EmployeeCode'] ?> - <b><?= $BasicDetails['EmployeeTypeName'] ?></b></span>
                <span><?= $BasicDetails['designations'] ?></span>
                <?php if ($BasicDetails['Status'] == "Working") { ?>
                    <span class="active">Active 🟢</span>
                <?php } else { ?>
                    <span class="inactive">InActive 🔴</span>
                <?php } ?>
            </div>
        </div>
        <div class="col col-lg-2 col-md-1 rep">
            <span>Reporting To</span><br>
            <span><strong><?= $BasicDetails['ReportingPerson'] ?></strong></span><br>
            <span><?= $BasicDetails['ReportingDesignation'] ?></span>
        </div>
    </div>
    <hr class="mt-1 md-1">
    <div class="row me-0 ms-0 mt-1">
        <nav class="nav nav-pills flex-column flex-sm-row">
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId']); ?>">Basic Details</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=2'); ?>">Work Details</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=3'); ?>">Approvals</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=4'); ?>">Attanance</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=5'); ?>">Late Entry</a>
            <a class="flex-sm-fill text-sm-center nav-link active" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=6'); ?>">Time Logs</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=7'); ?>">Pay slip</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=8'); ?>">Files</a>
        </nav>
    </div>
</div>


<div class="attendence ms-4 mt-3">
    <div class="row ms-0 me-0 mt-3 pt-2">
        <div class="col col-lg-4 mt-1">
        </div>
        <div class="col col-lg-8">
            <div class="action">
                <i class="fa-solid fa-calendar-days"></i>
                <input class="form-control" type="text" name="duration" style="padding-left: 35px; box-sizing: border-box;">
                <button class="btn btn-primary" id="applyfilter" style="margin-left: 10px;">Check</button>
            </div>
        </div>
    </div>
    <table class="table table-hover mt-4 time-log">
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
                                                        <?php if($point['e_auto'] == 0){ ?>
                                                            <div class="<?= ($point['s_auto'] == 0) ? 'dot-start' : 'dot-auto-start' ?>" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5><?= $point['start'] ?></h5>Check-in"></div>
                                                        <?php } ?>
                                                        <div class="progress-bar <?= ($point['color'] == 0) ? 'gap' : '' ?>"></div>
                                                        <?php if($point['s_auto'] == 0){ ?>
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

    $(function() {
        $('input[name="duration"]').daterangepicker({
            format: 'YYYY/MM/DD',
            locale: {
                format: 'YYYY/MM/DD'
            },
            startDate: '<?= date("Y/m/d", strtotime($fsd)) ?>',
            endDate: '<?= date("Y/m/d", strtotime($fed)) ?>',
            // ranges: {
            //             'Today': [moment(), moment()],
            //             'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            //             'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            //             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            //             'This Month': [moment().startOf('month'), moment().endOf('month')],
            //             'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            //         },
        }, function(start, end, label) {
            // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });

    $('#applyfilter').on('click',function(){
        var dateRange = $('input[name="duration"]').val();
        var dates = dateRange.split(' - ');
        var fsd = moment(dates[0]).format('YYYY/MM/DD');
        var fed = moment(dates[1]).format('YYYY/MM/DD');
        var newUrl = '<?php echo $BasicDetails['EmployeeId']; ?>' + '?trickId=6&fsd=' + encodeURIComponent(fsd) + '&fed=' + encodeURIComponent(fed);
        window.location.replace(newUrl);
    });

</script>

<?php echo ($this->endSection()) ?>