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
</style>

<div class="Employees ms-4">
    <div class="row ms-0 me-0 pt-2">
        <div class="col col-lg-9">
            <input type="hidden" name="trickid" id="trickid" value="<?= $trickid ?>">
            <a href="<?= site_url('/totalEmps?&trickid=1') ?>" class="btn">Active - <?= $active[0]['active'] ?></a>
            <a href="<?= site_url('/totalEmps?&trickid=2') ?>" class="btn">InActive - <?= $inactive[0]['inactive'] ?></a>
            <a href="<?= site_url('/totalEmps?&trickid=4') ?>" class="btn">Abscond - <?= $abscond[0]['abscond'] ?></a>
            <a href="<?= site_url('/totalEmps?&trickid=3') ?>" class="btn">Total Employees - <?= $allEmpCount[0]['count'] ?></a>
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
                    <td id="gender"></td>
                    <td id="designations"></td>
                    <td id="roles"></td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($allEmpsList): ?>
                    <?php foreach ($allEmpsList as $index => $emp): ?>
                        <tr>
                            <td><?= $index+1; ?></td>
                            <?php 
                                $one = ($emp['DVStatus'] == 2)?'':'[Documents Verified] ';
                                $two = (!empty($emp['OfferLetterImage']))?'':' [Offer letter] ';
                                $three = (!empty($emp['INT_CON_Letter']))?'':' [Intern/Contract Letter] ';
                                $four = (!empty($emp['EmployeeIDFK']))?'':' [Bank Details]';
                                $st = ($one == '' || $two == '' || $three == '' || $four == '')?1:0;
                            ?>
                            <td>
                                <?php echo $emp['EmployeeName']; ?>
                                <?php if($st == 1){ ?>
                                    <img src="<?= base_url('../public/images/img/allverified.png') ?>" alt="All Verified">
                                <?php }else{ ?>
                                    <img src="<?= base_url('../public/images/img/allnotverified.png') ?>" alt="All Not Verified" class="highlight-index"
                                    title="<?= $one.$two.$three.$four ?>">
                                <?php } ?>
                            </td>
                            <td><?php echo $emp['EmployeeCode']; ?></td>
                            <td><?php echo $emp['Gender']; ?></td>
                            <td><?php echo $emp['designations'] ?></td>
                            <td><?php echo $emp['EmployeeTypeName'] ?></td>
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

        var url = window.location;
        $('a.btn ').filter(function() {
            return this.href == url;
        }).addClass('active');

        $('#examp1').DataTable({
            columnDefs: [{ orderable: false, targets: [3, 4, 5] }],
            initComplete: function() {
                this.api().columns(5).every(function() {
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
                this.api().columns(4).every(function() {
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
                this.api().columns(3).every(function() {
                    var Gender = this;
                    var select = $('<select class="Search btn btn-sm" style="font-weight: 800;"><option value=""> Gender</option></select>')
                        .appendTo($(Gender.header()))
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            Gender
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    Gender.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
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

    });
</script>


<?= $this->endSection() ?>