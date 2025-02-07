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
</style>

<div class="container mt-3">
    <div class="row">
        <div class="col text-start">
            <h4>Leaves</h4>
        </div>
        <div class="col text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#LeaveAddModel"><i class="fa-solid fa-plus"></i> Apply Leave</button>
            <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TicketAddModel"><i class="fa-solid fa-plus"></i> Raise a Ticket</button> -->
        </div>
    </div>
</div>
<div class="container mt-3">
    <table class="table table-hover" id="examp1">
        <thead class="table-secondary">
            <tr>
                <th>S.No</th>
                <th>Leave Type</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Date</th>
                <th>Raised On</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php if ($leaves): ?>
                <?php foreach ($leaves as $leave): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $leave['Name'] ?></td>
                        <td><?= $leave['Reason'] ?></td>
                        <?php if ($leave['Status'] == 0) {
                            $text = 'Pending';
                            $color = '#F06400';
                        } else if ($leave['Status'] == 1) {
                            $text = 'Approved';
                            $color = '#029008';
                        } else if ($leave['Status'] == 2) {
                            $text = 'Rejected';
                            $color = '#F94343';
                        } ?>
                        <td style="color:<?= $color ?>"><?= $text ?></td>
                        <td><?= date('d-M-Y', strtotime($leave['Date'])) ?></td>
                        <td><?= date('d-M-Y', strtotime($leave['Created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>




<div class="modal" id="LeaveAddModel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apply Leave</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('add-leave') ?>" method="post" id="LeaveForm">
                    <input type="hidden" name="EmployeeIDFK" value="<?= $EmpId ?>">
                    <div class="row mb-2">
                        <div class="col-3">
                            <h6 class="mt-2">Leave Type</h6>
                        </div>
                        <div class="col-9">
                            <select class="form-select" name="TypeIDFK" id="LeaveType" required>
                                <?php if ($leavetype): ?>
                                    <option value="">Select Type</option>
                                    <?php foreach ($leavetype as $item): ?>
                                        <?php if ($item['IDPK'] == 1) {
                                            if ($LeaveFlag['CLPM'] == 1) { ?>
                                                <option value="<?= $item['IDPK'] ?>"><?= $item['Name'] ?></option>
                                            <?php }
                                        } else if ($item['IDPK'] == 2) {
                                            if ($LeaveFlag['SLPM'] == 1) { ?>
                                                <option value="<?= $item['IDPK'] ?>"><?= $item['Name'] ?></option>
                                            <?php }
                                        } else if ($item['IDPK'] == 3) {
                                            if ($LeaveFlag['PLPM'] == 1) { ?>
                                                <option value="<?= $item['IDPK'] ?>"><?= $item['Name'] ?></option>
                                            <?php }
                                        } else { ?>
                                            <option value="<?= $item['IDPK'] ?>"><?= $item['Name'] ?></option>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2 COMPOFF" style="display:none;">
                        <div class="col-3">
                            <h6 class="mt-2">Comp. Date</h6>
                        </div>
                        <div class="col-9">
                            <input type="date" class="form-control" name="CompDate" id="CompDate">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h6 class="mt-2">Leave Date</h6>
                        </div>
                        <div class="col-9">
                            <input type="date" class="form-control" name="Date" id="Date" required>
                        </div>
                    </div>
                    <div class="row mb-2 HRSPER" style="display:none;">
                        <div class="col-3">
                            <h6 class="mt-2">Start Time</h6>
                        </div>
                        <div class="col-9"><input type="time" class="form-control mb-2" name="Start_time" id="Start_time"></div>
                    </div>
                    <div class="row mb-2 HRSPER" style="display:none;">
                        <div class="col-3">
                            <h6 class="mt-2">End Time</h6>
                        </div>
                        <div class="col-9"><input type="time" class="form-control" name="End_time" id="End_time"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h6 class="mt-2">Reason</h6>
                        </div>
                        <div class="col-9">
                            <textarea name="Reason" id="Reason" class="form-control" placeholder="Explain..."></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col text-center">
                            <button type="button" id="smt-btn" class="btn btn-primary w-50">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        var error = '<? session()->getFlashdata('Error') ?? '' ?>';
        error = error.trim();
        if(error){
            Swal.fire(error);
        }

        $('#examp1').dataTable({});

        $('#LeaveType').on("change", function() {
            var type = $(this).val();
            $('.COMPOFF, .HRSPER').hide();
            if (type == 4) { //compoff
                $('.COMPOFF').show();
            } else if (type == 6) { //permission
                $('.HRSPER').show();
            }
        });

        $('#smt-btn').on("click", function() {
            var type = $('#LeaveType').val();
            var date = $('#Date').val();
            var cmpdate = $('#CompDate').val();
            var sdate = $('#Start_time').val();
            var edate = $('#End_time').val();
            var reason = $('#Reason').val().trim();
            var flag = true;
            $('#LeaveType').removeClass('is-invalid');
            $('#Date').removeClass('is-invalid');
            $('#CompDate').removeClass('is-invalid');
            $('#Start_time').removeClass('is-invalid');
            $('#End_time').removeClass('is-invalid');
            $('#Reason').removeClass('is-invalid');
            if (type == '') {
                $('#LeaveType').addClass('is-invalid');
                flag = false;
            }
            if (date == '') {
                $('#Date').addClass('is-invalid');
                flag = false;
            }
            if (type == 4) {
                if ($('#CompDate').val() == '') {
                    $('#CompDate').addClass('is-invalid');
                    flag = false;
                }
                if (date == cmpdate) {
                    $('#Date').addClass('is-invalid');
                    $('#CompDate').addClass('is-invalid');
                    flag = false;
                }
            } else if (type == 6) {
                if ($('#Start_time').val() == '') {
                    $('#Start_time').addClass('is-invalid');
                    flag = false;
                }
                if ($('#End_time').val() == '') {
                    $('#End_time').addClass('is-invalid');
                    flag = false;
                }
                if (sdate == edate) {
                    $('#Start_time').addClass('is-invalid');
                    $('#End_time').addClass('is-invalid');
                    flag = false;
                }
            }
            if (reason == '') {
                $('#Reason').addClass('is-invalid');
                flag = false;
            }
            if (flag) {
                $('#LeaveForm').submit();
            }
        });
    });
</script>

<?= $this->endSection() ?>