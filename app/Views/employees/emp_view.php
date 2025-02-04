<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>

<style>
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

    button.close {
        color: #8045d2;
        border-radius: 50%;
        padding: 3px 10px;
        border-color: #8045d2;
    }

    .modal-header {
        text-align: center;
        background-color: #925EDD14;
    }

    span.salstate-p {
        color: white;
        background-color: #60B664;
        border-radius: 30px;
        padding: 1px 3px 2px 5px;
        font-size: smaller;
    }

    span .icon-p {
        color: #60B664;
        background-color: white;
        border-radius: 50%;
        padding: 2px;
        font-size: x-small;
    }

    span.salstate-f {
        color: white;
        background-color: #FF6071;
        border-radius: 30px;
        padding: 1px 3px 2px 5px;
        font-size: smaller;
    }

    span .icon-f {
        color: #FF6071;
        background-color: white;
        border-radius: 50%;
        padding: 2px 5px;
        font-size: x-small;
    }
</style>

<div class="Employees ms-4">
    <div class="row ms-0 me-0 pt-2">
        <div class="col col-lg-9">
            <input type="hidden" name="trickid" id="trickid" value="<?= $trickid ?>">
            <a href="<?= site_url('/totalEmps?&trickid=1') ?>" class="btn">Active - <?= $active[0]['active'] ?></a>
            <a href="<?= site_url('/totalEmps?&trickid=2') ?>" class="btn">InActive - <?= $inactive[0]['inactive'] ?></a>
            <a href="<?= site_url('/totalEmps?&trickid=4') ?>" class="btn">Abscond - <?= $abscond[0]['abscond'] ?></a>
            <a href="<?= site_url('/totalEmps?&trickid=3') ?>" class="btn">Total Employees - <?= $allEmpCount[0]['count'] ?></a>
            <a href="<?= site_url('/totalEmps?&trickid=5') ?>" class="btn">Missing Salary - <?= $missing[0]['missing'] ?></a>
        </div>
        <div class="col col-lg-3 mt-1 buttons">
            <a href="<?php echo site_url('/add_emp') ?>" class="ms-3"><i class="fa-solid fa-plus"></i> Add New Employee</a>
        </div>
    </div>

    <div class="row ms-1 me-1 pt-2">
        <table class="table table-hover ms-2" id="examp1">
            <thead class="table-secondary">
                <tr>
                    <td>S.No</td>
                    <td>Employee Name</td>
                    <td>Employee Code</td>
                    <!-- <td id="gender"></td> -->
                    <td id="designations"></td>
                    <td id="roles"></td>
                    <?php if ($trickid == 2 || $trickid == 4) { ?>
                        <td id="Settlement">Settlement</td>
                        <td>Amount</td>
                        <td>Date</td>
                    <?php } ?>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($allEmpsList): ?>
                    <?php foreach ($allEmpsList as $index => $emp): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <?php
                                $one = ($emp['DVStatus'] == 2) ? '' : '[Documents Verified] ';
                                $two = (!empty($emp['OfferLetterImage'])) ? '' : ' [Offer letter] ';
                                $three = (!empty($emp['INT_CON_Letter'])) ? '' : ' [Intern/Contract Letter] ';
                                $four = (!empty($emp['EmployeeIDFK'])) ? '' : ' [Bank Details]';
                                $st = ($one == '' || $two == '' || $three == '' || $four == '') ? 1 : 0;

                                // print_r([$emp['DVStatus'],$emp['OfferLetterImage'],$emp['INT_CON_Letter'],$emp['EmployeeIDFK']]);exit(0);
                            ?>
                            <td>
                                <?= $emp['EmployeeName']; ?>
                                <?php if ($trickid != 2 && $trickid != 4) { ?>
                                    <?php if ($st == 1) { ?>
                                        <img src="<?= base_url('../public/images/img/allverified.png') ?>" alt="All Verified">
                                    <?php } else { ?>
                                        <img src="<?= base_url('../public/images/img/allnotverified.png') ?>" alt="All Not Verified" class="highlight-index"
                                            title="<?= $one . $two . $three . $four ?>">
                                    <?php } ?>
                                    <?php if ($emp['GrossSalary'] != 0 && $emp['GrossSalary'] != NULL) { ?>
                                        <span class="salstate-p">Salary <i class="fa-solid fa-check icon-p"></i></span>
                                    <?php } else { ?>
                                        <span class="salstate-f">Salary <i class="fa-solid fa-exclamation icon-f"></i></span>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                            <td><?php echo $emp['EmployeeCode']; ?></td>
                            <td><?php echo $emp['designations'] ?></td>
                            <td><?php echo $emp['EmployeeTypeName'] ?></td>
                            <?php if ($trickid == 2 || $trickid == 4) { ?>
                                <td>
                                    <?php
                                    if ($emp['final_set_status'] == 1) {
                                        echo 'Done';
                                    } else { ?>
                                        Pending <i class="fa-solid fa-pencil editsettlement" data-id="<?= $emp['EmployeeId'] ?>" style="color:#8146D4;cursor:pointer;"></i>
                                    <?php } ?>
                                </td>
                                <td><?= $emp['final_set_amound'] ?? 'NA' ?></td>
                                <td><?= $emp['settlement_day'] ?? 'NA' ?></td>
                            <?php } ?>
                            <td>
                                <a href="javascript:void(0);" class="menu-trigger">
                                    <img src="<?php echo base_url('../public/images/img/Group.png') ?>" alt="menu" id="menu-icon">
                                </a>
                                <div class="dropdown" style="display: none;">
                                    <a href="<?= base_url('editEmp-view/' . $emp['EmployeeId']); ?>">Edit</a>
                                    <!-- <a href="#">Delete</a> -->
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="settlementedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Settlement</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="SettlementForm">
                    <div class="row mt-2">
                        <div class="col form-group">
                            <label for=>Settlement Date</label>
                            <input type="date" class="form-control" id="SettlementDate" required>
                        </div>
                        <div class="col form-group">
                            <label>Settlement Amount</label>
                            <input type="number" class="form-control" id="SettlementAmount" placeholder="1000.00" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="Set-Save">Save</button>
            </div>
        </div>
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

    $(document).ready(function() {
        var trickid = $('#trickid').val();
        var url = window.location;
        $('a.btn ').filter(function() {
            return this.href == url;
        }).addClass('active');

        $('#examp1').DataTable({
            columnDefs: [{
                orderable: false,
                targets: [3, 4]
            }],
            initComplete: function() {
                this.api().columns(4).every(function() {
                    var Roles = this;
                    var select = $('<select class="Search btn btn-sm" style="font-weight: 800;"><option value=""> Roles</option></select>')
                        .appendTo($(Roles.header()))
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            Roles
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    Roles.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
                this.api().columns(3).every(function() {
                    var Designations = this;
                    var select = $('<select class="Search btn btn-sm" style="font-weight: 800;"><option value=""> Designations</option></select>')
                        .appendTo($(Designations.header()))
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            Designations
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    Designations.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
                // if (trickid == 2 || trickid == 4) {
                //     this.api().columns(5).every(function() {
                //         var Settlement = this;
                //         var select = $('<select class="Search btn btn-sm" style="font-weight: 800;"><option value=""> Settlement</option></select>')
                //             .appendTo($(Settlement.header()))
                //             .on('change', function() {
                //                 var val = $.fn.dataTable.util.escapeRegex(
                //                     $(this).val()
                //                 );
                //                 Settlement
                //                     .search(val ? '^' + val + '$' : '', true, false)
                //                     .draw();
                //             });
                //         Settlement.data().unique().sort().each(function(d, j) {
                //             select.append('<option value="' + d + '">' + d + '</option>')
                //         });
                //     });
                // }
            }
        });

        $('.Search').change(function() {
            if ($("#examp1 > tbody > tr > td").length == 1) {
                $('#count').empty();
                $('#count').append('0');;
            } else {
                $('#count').empty();
                $('#count').append(' ' + $("#examp1 > tbody > tr").length);
            }
        });
        var id;
        $('.editsettlement').on('click', function() {
            id = $(this).data('id');
            $('#settlementedit').modal('show');
        });

        $('#Set-Save').on('click', function() {
            var setdate = $('#SettlementDate').val();
            var setAmount = $('#SettlementAmount').val();
            if (setAmount == '') {
                $('#SettlementAmount').addClass('is-invalid');
            }
            if (setdate == '') {
                $('#SettlementDate').addClass('is-invalid');
            }

            if (setAmount && setdate) {
                const data = {};
                data['settlement_day'] = setdate;
                data['final_set_status'] = 1;
                data['final_set_amound'] = setAmount;

                // Perform AJAX request to save data
                $.ajax({
                    url: '<?= base_url() . '/employee-edit/single-abs/' ?>' + id,
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        // console.log('Updated successfully:', response);
                        Swal.fire("Employee Updated!").then((result) => {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('Failed to update:', error);
                        alert('Failed to update!');
                    }
                });
            }
        });

    });
</script>


<?= $this->endSection() ?>