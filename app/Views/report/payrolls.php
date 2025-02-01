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
        padding: 3px 30px !important;
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

    .Employees .file-download {
        text-decoration: none !important;
        color: #5408C2;
        background-color: #F9F5FF;
        border: 1px solid #5408C2;
        border-radius: 15px;
        padding: 2px 10px !important;
    }

    .Employees .file-edit {
        text-decoration: none !important;
        color: #5408C2;
        background-color: #F9F5FF;
        border: 1px solid #5408C2;
        border-radius: 15px;
        padding: 2px 10px !important;
    }

    input:read-only {
        background-color: #F1F1F1;
        color: black;
        border: 1px solid #98A2B3;
    }

    .Employees a.download {
        background-color: white !important;
        border: 1px solid #5408c2;
        border-radius: 5px !important;
        color: #5408c2 !important;
    }
</style>


<div class="Employees ms-4 mt-1">
    <div class="row ms-0 me-0 mt-2 pt-2">
        <div class="col col-lg-6">
            <input type="hidden" name="trickid" id="trickid" value="<?= $trickid ?>">
            <a href="<?= site_url('/payrolls?trickid=1&fdate=' . $fdate) ?>" class="btn <?= ($trickid == 1) ? 'active' : '' ?>">ONROLL - <?= $trick1_count ?></a>
            <a href="<?= site_url('/payrolls?trickid=2&fdate=' . $fdate) ?>" class="btn <?= ($trickid == 2) ? 'active' : '' ?>">OFFROLL - <?= $trick2_count ?></a>
        </div>
        <div class="col col-lg-6 justify-content-end">
            <div class="d-flex justify-content-end">
                <?php if ($mode == 2 && $state0 == 0 && $state1 != 0 && $state2 == 0) { ?><a href="javascript:void(0);" class="download me-1" id="salary_confirmation">Salary Confirmation</a> <?php } ?>
                <?php if ($state0 == 0 && $state1 == 0 && $state2 != 0) { ?><a href="<?= base_url('/downloadpayslipexcel?trickid='.$trickid.'&fdate='.$fdate) ?>" class="download me-2" id="all_payroll">Export Payrolls</a> <?php } ?>
                <div class="action ms-1">
                    <i class="fa-solid fa-calendar-days"></i>
                    <input class="form-control" type="text" style="padding-left: 35px; box-sizing: border-box;" id="reportrange">
                    <?php
                    if (empty($fdate)) {
                        $fdate = date("Y-m-d");
                    }
                    ?>
                    <input type="hidden" name="fdate" id="fdate" value="<?= $fdate ?>" />
                    <button class="btn btn-primary" style="margin-left: 10px;" onclick="datefilter()">Check</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row ms-1 me-1 mt-2 pt-2">
        <table class="table table-hover ms-2" id="examp1">
            <thead class="table-secondary">
                <tr>
                    <td>S.No</td>
                    <td>Employee Name</td>
                    <td>No of Absent</td>
                    <td>Credit Date</td>
                    <td>Salary Credited</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php if ($payslips): ?>
                    <?php foreach ($payslips as $i => $payslip): ?>
                        <?php
                        $sl_date = date('Y-m-', strtotime($fdate)) . $payslip['Salary_date'];
                        $sl_date = date('Y-m-d', strtotime('+1 month', strtotime($sl_date)));
                        $statusText = 'Pending';
                        $statusColor = 'red';
                        if ($mode == 1) {
                            if ($sl_date < date('Y-m-d')) {
                                $statusText = ($payslip['Status'] == 0) ? 'Pending' : 'Credited';
                                $statusColor = ($payslip['Status'] == 0) ? 'red' : 'green';
                            } else {
                                $statusText = ($payslip['Status'] == 0) ? 'Pending' : 'Edited';
                                $statusColor = 'green';
                            }
                        } else {
                            if ($payslip['Status'] == 0) {
                                $statusText = 'Pending';
                                $statusColor = 'red';
                            } else if ($payslip['Status'] == 1) {
                                $statusText = 'Edited';
                                $statusColor = 'green';
                            } else if ($payslip['Status'] == 2) {
                                $statusText = 'Credited';
                                $statusColor = 'green';
                            }
                        }

                        ?>
                        <tr>
                            <td><?= ++$i; ?></td>
                            <td><?= $payslip['EmployeeName'] ?></td>
                            <td><?= $payslip['LOP'] . ' Days' ?></td>
                            <td><?= $payslip['Salary_date'] . 'th of month' ?></td>
                            <td><?= $payslip['Net_salary'] ?></td>
                            <td style="color: <?= $statusColor ?>;"><?= $statusText ?></td>
                            <td>
                                <?php if ($mode == 1) { ?>
                                    <?php if ($sl_date < date('Y-m-d') && $payslip['Status'] != 0): ?>
                                        <a href="<?= base_url('payslip-download/' . $payslip['IDPK']); ?>" class="file-download" target="_blank">
                                            Download <i class="fa-solid fa-file-arrow-down"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="javascript:void(0);" class="file-edit" data-id="<?= $payslip['IDPK'] ?>" data-name="<?= $payslip['EmployeeName'] ?>">
                                            Edit Payslip <i class="fa-solid fa-file-pen"></i>
                                        </a>
                                    <?php endif; ?>
                                <?php } else { ?>
                                    <?php if ($payslip['Status'] == 2): ?>
                                        <a href="<?= base_url('payslip-download/' . $payslip['IDPK']); ?>" class="file-download" target="_blank">
                                            Download <i class="fa-solid fa-file-arrow-down"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="javascript:void(0);" class="file-edit" data-id="<?= $payslip['IDPK'] ?>" data-name="<?= $payslip['EmployeeName'] ?>">
                                            Edit Payslip <i class="fa-solid fa-file-pen"></i>
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
</div>

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100 text-center">Payslip Details</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="FBP">
            <input type="hidden" id="HRA">
            <input type="hidden" id="Basic">
            <input type="hidden" id="PFF">
            <form action="<?= base_url('/payslip-update') ?>" method="post">
                <input type="hidden" name="fdate" value="<?= $fdate ?>">
                <input type="hidden" name="trickid" value="<?= $trickid ?>">
                <input type="hidden" name="id" id="payslipid">
                <input type="hidden" name="Gross" id="Gross">
                <div class="modal-body">
                    <div class="row mt-2">
                        <div class="col-md-4 form-group">
                            <label for="BasicSalary">Basic Salary</label>
                            <input type="text" name="Basic" class="form-control" id="BasicSalary" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="HRAAmount">HRA</label>
                            <input type="text" name="HRA" class="form-control" id="HRAAmount" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="FBPAmount">FBP</label>
                            <input type="text" name="FBP" class="form-control" id="FBPAmount" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 form-group">
                            <label for="PFAmount">PF</label>
                            <input type="text" name="PF" class="form-control" id="PFAmount" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="PTAmount">PT</label>
                            <input type="text" name="PT" class="form-control" id="PTAmount" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="PFVolAmount">PF Voluntary</label>
                            <input type="text" name="PFVOL" class="form-control" id="PFVolAmount" readonly>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4 form-group">
                            <label for="TDS">TDS</label>
                            <input type="text" name="TDS" class="form-control" id="TDS" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="Insurance">Insurance</label>
                            <input type="text" name="Insurance" class="form-control" id="Insurance" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="NetSalary">Net Salary</label>
                            <input type="text" name="Net_salary" class="form-control" id="NetSalary" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 form-group">
                            <label for="SDAmount">Special Earnings</label>
                            <input type="number" name="SD1" class="form-control" id="SDAmount">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="SD2Amount">Special Deduction</label>
                            <input type="number" name="SD2" class="form-control" id="SD2Amount">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="LOP">No. of Days (LOP)</label>
                            <input type="number" name="LOP" class="form-control" id="LOP">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 form-group">
                            <label for="BankAccount">Bank Account</label>
                            <select class="form-select" name="Acc_Type" id="BankAccount">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn ">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $fd = !empty($fdate) && strtotime($fdate) ? date("MMMM, YYYY", strtotime($fdate)) : date('MMMM, YYYY'); ?>
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

    $(document).ready(function() {
        $('#examp1').DataTable({});

        var date2 = $('#fdate').val();
        var d1 = new Date();
        var d2 = new Date(date2);
        var months = (d2.getFullYear() - d1.getFullYear()) * 12 + (d2.getMonth() - d1.getMonth());

        $("#reportrange").MonthPicker({
            Button: false,
            MaxMonth: -1,
            SelectedMonth: months,
            MonthFormat: 'MM, yy'
        });

        $('.file-edit').on("click", function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var HTML = name + '\'s Payroll Details';
            $('.modal-title').html(HTML);
            $('#payslipid').val(id);
            $.ajax({
                url: '<?= base_url() . '/payslip-edit/' ?>' + id,
                type: 'GET',
                success: function(response) {
                    $('#Gross').val(response.files.GrossSalary);
                    $('#LOP').val(response.files.LOP);
                    $('#SDAmount').val(0);
                    $('#Insurance').val(response.files.Insurance);
                    $('#SD2Amount').val(0);
                    $('#PFVolAmount').val(response.files.PF_VOL);
                    $('#TDS').val(response.files.TDS);
                    $('#PTAmount').val(response.files.PT);
                    $('#PFAmount').val(response.files.PF);
                    $('#PFF').val(response.files.PF);

                    $('#FBPAmount').val(response.files.FBP);
                    $('#FBP').val(response.files.FBP);
                    $('#HRAAmount').val(response.files.HRA);
                    $('#HRA').val(response.files.HRA);
                    $('#BasicSalary').val(response.files.BasicSalary);
                    $('#Basic').val(response.files.BasicSalary);

                    $('#NetSalary').val(response.files.Net_salary);
                    HTML = '';
                    response.files.Accounts.forEach(element => {
                        HTML += `<option value="${element.Type}" ${(element.Type == response.files.Acc_Type) ? 'selected' : ''}>${element.BankName}</option>`;
                    });
                    $('#BankAccount').html(HTML);
                    calculate_netsalary();
                    $('#modal-lg').modal('show');
                },
                error: function(xhr, status, error) {
                    console.log('Failed to update:', error);
                    alert('Failed to update! (Please check person\'s salary details!)');
                }
            });
        });

        $('#LOP').on('keyup', function() {
            calculate_netsalary();
        });

        $('#SDAmount').on('keyup', function() {
            calculate_netsalary();
        });

        $('#SD2Amount').on('keyup', function() {
            calculate_netsalary();
        });

        $('#salary_confirmation').on("click", function() {
            var trickid = <?= $trickid ?>;
            var fdate = '<?= $fdate ?>';
            $.ajax({
                url: '<?= base_url() . '/payslip-manual-save' ?>',
                type: 'GET',
                data: {
                    'trickid': trickid,
                    'fdate': fdate,
                },
                success: function(response) {
                    Swal.fire("Payrolls Confirmed!").then((result) => {
                            location.reload();
                        });
                },
                error: function(xhr, status, error) {
                    console.log('Failed to update:', error);
                    alert('Failed to update!');
                }
            });
        });

        $('#all_payroll').on("click", function() {
            var trickid = <?= $trickid ?>;

        })

    });

    function calculate_netsalary() {
        const parseValue = (selector, defaultValue = 0) => parseFloat($(selector).val()) || defaultValue;
        
        const FBP = parseValue('#FBP');
        const HRA = parseValue('#HRA');
        const BASIC = parseValue('#Basic');
        const LOP = parseValue('#LOP', 0);
        const SD = parseValue('#SDAmount', 0);
        const PF = parseValue('#PFF');
        const PT = parseValue('#PTAmount');
        const PFVOL = parseValue('#PFVolAmount');
        const Ins = parseValue('#Insurance');
        const SD2 = parseValue('#SD2Amount');

        // Get the maximum days of the month
        const date = '<?= $fdate ?>'; // "Ex.2025-01-15"
        const maxDays = getMaxDaysOfMonth(date);

        // Deduct LOP from components
        const adjustForLOP = (amount) => amount - ((amount / maxDays) * LOP);
        const adjustedFBP = adjustForLOP(FBP);
        const adjustedHRA = adjustForLOP(HRA);
        const adjustedBASIC = adjustForLOP(BASIC);
        const adjustedPF = adjustForLOP(PF);
        const adjustedPFVOL = adjustForLOP(PFVOL);

        // Calculate salaries
        const Net_sal1 = adjustedFBP + adjustedHRA + adjustedBASIC + SD;
        const Net_sal2 = PF + PT + PFVOL + Ins + SD2;
        const Net_sal = Net_sal1 - Net_sal2;

        // Update the DOM with results
        $('#FBPAmount').val(adjustedFBP.toFixed(2));
        $('#HRAAmount').val(adjustedHRA.toFixed(2));
        $('#BasicSalary').val(adjustedBASIC.toFixed(2));
        $('#PFAmount').val(adjustedPF.toFixed(2));
        $('#PFVolAmount').val(adjustedPFVOL.toFixed(2));
        $('#NetSalary').val(Net_sal.toFixed(2));

    }

    function getMaxDaysOfMonth(dateString) {
        let date = new Date(dateString);
        let year = date.getFullYear();
        let month = date.getMonth();
        let lastDay = new Date(year, month + 1, 0);
        return lastDay.getDate();
    }

    function datefilter() {
        var month = $('#reportrange').MonthPicker('GetSelectedMonth');
        var year = $('#reportrange').MonthPicker('GetSelectedYear');
        var date = month + '/01/' + year;
        date = moment(date).format('YYYY-MM-DD');
        window.location.href = 'payrolls?trickid=' + <?= $trickid ?> + '&fdate=' + encodeURIComponent(date);
    }
</script>

<?= $this->endSection() ?>