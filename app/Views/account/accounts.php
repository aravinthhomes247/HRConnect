<?php $session = \Config\Services::session(); ?>
<?php echo ($this->extend("layouts/header-new")) ?>
<?php echo ($this->section("body")) ?>


<style>
    .career .action-dropdown {
        display: none;
        position: absolute;
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: max-content;
        /* padding: 5px 5px; */
    }

    .career .action-dropdown a {
        color: #8146D4 !important;
        display: block;
        /* color: black !important; */
        /* text-decoration: none !important; */
        width: 100% !important;
        padding: 5px 10px !important;
    }

    .career .action-dropdown a:hover {
        background-color: #F0E5FF;
    }
</style>

<div class="career ms-4 mt-1">
    <div class="row ms-0 me-0 pt-2">
        <div class="col col-lg-8 ps-4 mt-1">
            <a href="<?php echo site_url('/add-account') ?>"><i class="fa-solid fa-plus"></i> Add Login</a>
        </div>
        <div class="col col-lg-4 ps-5">
        </div>
    </div>
    <div class="row ms-1 me-1 pt-2">
        <table class="table table-hover ms-2" id="dataTable">
            <thead class="table-secondary">
                <tr>
                    <td>S.No</td>
                    <td>Email</td>
                    <td>Level</td>
                    <td>Status</td>
                    <td>Login</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                if ($accounts): ?>
                    <?php foreach ($accounts as $account): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $account['admin_login_email'] ?></td>
                            <td><?= $account['user_level'] ?></td>
                            <td><?= ($account['active_status'] == 1)? 'Active':'Inactive' ?></td>
                            <td><?= ($account['login_access'] == 1)? 'Allow':'Denied' ?></td>
                            <td>
                                <a href="javascript:void(0);" class="menu-trigger">
                                    <img src="<?= base_url('public/images/img/Group.png'); ?>" alt="menu" id="menu-icon">
                                </a>
                                <div class="action-dropdown" style="display: none;">
                                    <a href="<?= base_url('edit-account/' . $account['admin_login_IDPK']); ?>" class="ps-1 pe-1">Edit</a>
                                    <a href="<?= base_url('deactactaccount/' . $account['admin_login_IDPK']) ?>" class="ps-1 pe-1"><?= ($account['login_access'] == 1)? 'To Denied':'To Allow' ?></a>
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
            document.querySelectorAll('.action-dropdown').forEach((dropdown) => {
                dropdown.style.display = 'none';
            });
            const dropdown = trigger.nextElementSibling;
            dropdown.style.display = 'block';
        });
    });

    document.addEventListener('click', () => {
        document.querySelectorAll('.action-dropdown').forEach((dropdown) => {
            dropdown.style.display = 'none';
        });
    });

</script>

<?php echo ($this->endSection()) ?>