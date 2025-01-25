<?php $session = \Config\Services::session(); ?>
<?php echo ($this->extend("layouts/header-new")) ?>
<?php echo ($this->section("body")) ?>

<style>
    .dt-column-title,
    .dt-column-order {
        background-color: transparent !important;
        color: black !important;
    }

    a.file-download.dissabled {
        background-color: #98A2B3;
        pointer-events: none;
        color: white;
        border-color: black;
    }
</style>


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
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=3'); ?>">Approvals</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=4'); ?>">Attanance</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=5'); ?>">Late Entry</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=6'); ?>">Time Logs</a>
            <a class="flex-sm-fill text-sm-center nav-link active" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=7'); ?>">Pay slip</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=8'); ?>">Files</a>
        </nav>
    </div>
</div>


<div class="attendence ms-4 mt-3">
    <div class="row ms-0 me-0 mt-3 pt-2">
        <div class="col col-lg-4 mt-1">
        </div>
        <div class="col col-lg-8">
            <!-- <div class="action">
                <i class="fa-solid fa-calendar-days"></i>
                <input class="form-control"
                    type="text"
                    value="September, 2024"
                    name="month"
                    style="padding-left: 35px; box-sizing: border-box;">
                <button class="btn btn-primary" id="applyfilter" style="margin-left: 10px;">Check</button>
            </div> -->
        </div>
    </div>
    <table class="table table-hover mt-2" id="dataTable">
        <thead class="table-secondary">
            <tr>
                <td class="ps-3">S.No</td>
                <td>Payment Month</td>
                <td>No of Absent</td>
                <td>Salary Credited</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
            <?php foreach ($PaySlip as $pay): ?>
                <?php 
                    $sl_date = date('Y-m-', strtotime($pay['Date'])).$pay['Salary_date'];
                    $sl_date = date('Y-m-d', strtotime($sl_date));
                ?>
                <tr>
                    <td class="ps-3"><?= $i++ ?></td>
                    <td><?= date('F Y', strtotime($pay['Date'])) ?></td>
                    <td><?= $pay['LOP'] ?> Days</td>
                    <td>₹ <?= number_format($pay['Net_salary'], 0) ?></td>
                    <td>
                        <?php if ($mode == 1) { ?>
                            <?php if ($sl_date < date('Y-m-d') && $pay['Status'] != 0): ?>
                                <a href="<?= base_url('payslip-download/' . $pay['IDPK']); ?>" class="file-download" target="_blank">
                                    Download <i class="fa-solid fa-file-arrow-down"></i>
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('payslip-download/' . $pay['IDPK']); ?>" class="file-download dissabled" target="_blank">
                                    Download <i class="fa-solid fa-file-arrow-down"></i>
                                </a>
                            <?php endif; ?>
                        <?php } else { ?>
                            <?php if ($pay['Status'] != 0): ?>
                                <a href="<?= base_url('payslip-download/' . $pay['IDPK']); ?>" class="file-download" target="_blank">
                                    Download <i class="fa-solid fa-file-arrow-down"></i>
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('payslip-download/' . $pay['IDPK']); ?>" class="file-download dissabled" target="_blank">
                                    Download <i class="fa-solid fa-file-arrow-down"></i>
                                </a>
                            <?php endif; ?>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php echo ($this->endSection()) ?>