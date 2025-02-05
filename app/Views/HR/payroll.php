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

    .container .table a.file-download.dissabled {
        background-color: #98A2B3;
        pointer-events: none;
        color: white;
        border-color: black;
    }

    .container .table a.file-download {
        text-decoration: none !important;
        color: #5408C2;
        background-color: #F9F5FF;
        border: 1px solid #5408C2;
        border-radius: 15px;
        padding: 2px 10px !important;
    }
</style>

<div class="container mt-3">
    <div class="row">
        <div class="col text-start">
            <h4>Payrolls</h4>
        </div>
        <div class="col text-end"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TicketAddModel"><i class="fa-solid fa-plus"></i> Raise a Ticket</button></div>
    </div>
</div>
<div class="container mt-3">
    <table class="table table-hover" id="examp1">
        <thead class="table-secondary">
            <tr>
                <th>S.No</th>
                <th>Payment Month</th>
                <th>No of Absend</th>
                <th>Salary Credited</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php if ($PaySlip): ?>
                <?php foreach ($PaySlip as $pay): ?>
                    <?php
                    $sl_date = date('Y-m-', strtotime($pay['Date'])) . $pay['Salary_date'];
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
            <?php endif; ?>
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
    $(document).ready(function() {
        $('#examp1').DataTable({});
    });
</script>


<?= $this->endSection() ?>