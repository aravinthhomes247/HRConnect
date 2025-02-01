<?php $session = \Config\Services::session(); ?>
<?php echo ($this->extend("layouts/header-new")) ?>
<?php echo ($this->section("body")) ?>

<style>
    .approvals a.btn {
        width: max-content !important;
        padding: 5px 10px !important;
        border: 1px solid #8146d4;
        color: white;
        background-color: #8146d4;
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
            <a class="flex-sm-fill text-sm-center nav-link active" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=3'); ?>">Tickets</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=4'); ?>">Attanance</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=5'); ?>">Late Entry</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=6'); ?>">Time Logs</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=7'); ?>">Pay slip</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=8'); ?>">Files</a>
        </nav>
    </div>
</div>


<div class="approvals ms-4 mt-3">
    <div class="row">
        <!-- <div class="col-12 text-end mb-2">
            <a href="javascript:void(0);" class="btn mt-2 me-2" data-bs-toggle="modal" data-bs-target="#TicketAddModel">Raise Ticket</a>
        </div> -->
    </div>
    <table class="table table-hover" id="examp1">
        <thead class="table-secondary">
            <tr>
                <td class="ps-3">Ticket Subject</td>
                <td>Ticket Type</td>
                <td>Raised On</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Approvals as $Approval): ?>
                <tr>
                    <td class="ps-3"><?= $Approval['Subject'] ?></td>
                    <td><?= $Approval['Name'] ?></td>
                    <td><?= date('d-M-Y', strtotime($Approval['Raised_On'])) ?></td>
                    <?php
                    if ($Approval['Status'] == 0) {
                        $color = '#F06400';
                        $text = 'Pending';
                    } else if ($Approval['Status'] == 1) {
                        $color = '#017BB8';
                        $text = 'In Progress';
                    } else if ($Approval['Status'] == 2) {
                        $color = '#029008';
                        $text = 'Resolved';
                    } else if ($Approval['Status'] == 3) {
                        $color = '#F94343';
                        $text = 'Escalated';
                    }
                    ?>
                    <td style="color:<?= $color ?>"><?= $text ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
                    <input type="hidden" name="EmployeeIDFK" value="<?= $BasicDetails['EmployeeId'] ?>">
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
    $(document).ready(function() {
        $('#examp1').DataTable({});
    });
</script>


<?php echo ($this->endSection()) ?>