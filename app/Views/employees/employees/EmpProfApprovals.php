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
            <span><strong><?= $BasicDetails['ReportingPerson'] ?></strong></span><br>
            <span><?= $BasicDetails['ReportingDesignation'] ?></span>
        </div>
    </div>
    <hr class="mt-1 md-1">
    <div class="row me-0 ms-0 mt-1">
        <nav class="nav nav-pills flex-column flex-sm-row">
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId']); ?>">Basic Details</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=2'); ?>">Work Details</a>
            <a class="flex-sm-fill text-sm-center nav-link active" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=3'); ?>">Approvals</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=4'); ?>">Attanance</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=5'); ?>">Late Entry</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=6'); ?>">Time Logs</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=7'); ?>">Pay slip</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=8'); ?>">Files</a>
        </nav>
    </div>
</div>


<div class="approvals ms-4 mt-3">
    <table class="table table-hover">
        <thead class="table-secondary">
            <tr>
                <td class="ps-3">Ticket Name</td>
                <td>Raised On</td>
                <td colspan="2">Status</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="ps-3"><b>Jagathesh</b> has made a request for <b>attendance regularization</b></td>
                <td>08-Nov-2024</td>
                <td>Pending</td>
                <td><a href=""><img src="<?php echo base_url('public/images/img/Group.png'); ?>" alt="menu"></a></td>
            </tr>
            <tr>
                <td class="ps-3"><b>Jagathesh</b> has made a request for <b>Compensatory Off</b></td>
                <td>08-Nov-2024</td>
                <td style="color: green;">Approved</td>
                <td><a href=""><img src="<?php echo base_url('public/images/img/Group.png'); ?>" alt="menu"></a></td>
            </tr>
            <tr>
                <td class="ps-3"><b>Jagathesh</b> has made a request for <b>Casual Leave</b></td>
                <td>08-Nov-2024</td>
                <td style="color: green;">Approved</td>
                <td><a href=""><img src="<?php echo base_url('public/images/img/Group.png'); ?>" alt="menu"></a></td>
            </tr>
            <tr>
                <td class="ps-3"><b>Jagathesh</b> has made a request for <b>Leave</b></td>
                <td>08-Nov-2024</td>
                <td style="color: red;">Rejected</td>
                <td><a href=""><img src="<?php echo base_url('public/images/img/Group.png'); ?>" alt="menu"></a></td>
            </tr>
            <tr>
                <td class="ps-3"><b>Jagathesh</b> has made a request for <b>Hourly permission</b></td>
                <td>08-Nov-2024</td>
                <td style="color: red;">Rejected</td>
                <td><a href=""><img src="<?php echo base_url('public/images/img/Group.png'); ?>" alt="menu"></a></td>
            </tr>
        </tbody>
    </table>
</div>


<?php echo ($this->endSection()) ?>