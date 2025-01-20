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
        text-decoration: none !important;
        width: 100% !important;
    }

    .dropdown a:hover {
        background-color: #f0f0f0;
    }
</style>

<div class="holiday ms-4">
    <div class="row ms-0 me-0 pt-2">
        <div class="col col-lg-9 mt-1">
            <h4>Holidays</h4>
        </div>
        <div class="col col-lg-3 mt-2 add">
            <a href="<?php echo site_url('/add-holiday') ?>" class="ms-5"><i class="fa-solid fa-plus"></i> Add New Holiday</a>
        </div>
    </div>
    <div class="row ms-1 me-1 pt-2">
        <table class="table table-hover ms-2" id="dataTable">
            <thead class="table-secondary">
                <tr>
                    <td>S.No</td>
                    <td>Name</td>
                    <td>Date</td>
                    <td>All Departments</td>
                    <td>Applies All Years</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($holidays as $i => $holiday){ ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= $holiday['Name'] ?></td>
                            <td><?= $holiday['Date'] ?></td>
                            <td><?= ($holiday['AllDept'] == 1)? 'Yes':'No' ?></td>
                            <td><?= ($holiday['SameDate'] == 1)? 'Yes':'No' ?></td>
                            <td>
                                <a href="javascript:void(0);" class="menu-trigger">
                                    <img src="<?php echo base_url('../public/images/img/Group.png') ?>" alt="menu" id="menu-icon">
                                </a>
                                <div class="dropdown" style="display: none;">
                                    <a href="<?php echo site_url('/edit-holiday/'.$holiday['IDPK']) ?>">Edit</a>
                                    <a href="<?php echo site_url('/delete-holiday/'.$holiday['IDPK']) ?>">Delete</a>
                                </div>
                            </td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    // Select all menu-trigger elements
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
</script>

<?= $this->endSection() ?>