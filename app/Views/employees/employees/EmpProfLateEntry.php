<?php $session = \Config\Services::session(); ?>
<?php echo ($this->extend("layouts/header-new")) ?>
<?php echo ($this->section("body")) ?>




<div class="profile-container mt-2 ms-4 ps-1 pt-1 pe-1">
    <div class="row me-0">
        <div class="col col-lg-1 col-md-1">
            <?php if (empty($BasicDetails['Image'])) { ?>
                <img class="img-circle elevation-2" src="<?php echo base_url('public/images/default-profile.png') ?>">
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
            <span><strong>Abijith</strong></span><br>
            <span>Product Head</span>
        </div>
    </div>
    <hr class="mt-1 md-1">
    <div class="row me-0 ms-0 mt-1">
        <nav class="nav nav-pills flex-column flex-sm-row">
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId']); ?>">Basic Details</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=2'); ?>">Work Details</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=3'); ?>">Approvals</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=4'); ?>">Attanance</a>
            <a class="flex-sm-fill text-sm-center nav-link active" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=5&fsd='.date('Y/m/d').'&fed='.date('Y/m/d')); ?>">Late Entry</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=6'); ?>">Time Logs</a>
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
    <table class="table table-hover mt-2">
        <thead class="table-secondary">
            <tr>
                <td class="ps-3">S.No</td>
                <td>Date</td>
                <td>Check-in Timing</td>
                <td>Late by</td>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; ?>
            <?php $fixedTime = new DateTime("09:45:00"); ?>
            <?php $fixedTime->setDate(2000, 1, 1); ?>
            <?php 
                if($LateEntry){
                    foreach($LateEntry as $late): ?>
                        <tr>
                            <td class="ps-3"><?= $i++ ?></td>
                            <td><?= date("d F Y", strtotime($late['LogDateDay'])) ?></td>
                            <td><?= date("h:i A", strtotime($late['FirstLogDate'])) ?></td>
                            <?php 
                                $firstLogTime = new DateTime($late['FirstLogDate']);
                                $firstLogTime->setDate(2000, 1, 1);
                                $diff = $fixedTime->diff($firstLogTime);
                                $diffInMinutes = ($diff->h * 60) + $diff->i;
                            ?>
                            <td><?= $diffInMinutes ?> Mins</td>
                        </tr>
            <?php endforeach;
                } else{ ?>
                    <tr>
                        <td style="text-align:center;" colspan="4">No Data Available</td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<script>
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
        var newUrl = '<?php echo $BasicDetails['EmployeeId']; ?>' + '?trickId=5&fsd=' + encodeURIComponent(fsd) + '&fed=' + encodeURIComponent(fed);
        window.location.replace(newUrl);
    });

</script>

<?php echo ($this->endSection()) ?>