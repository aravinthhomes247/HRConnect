<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>


<style>
    .input-group input.form-control{
        padding: 5px;
    }

    .input-group button.btn.btn-outline-secondary{
        background-color: transparent;
        border: none;
    }
</style>

<div class="holiday ms-4 mt-3">
    <div class="row ms-0 me-0 mt-3 pt-2">
        <div class="col col-lg-9 mt-1">
            <h4>Add New Login Details</h4>
        </div>
        <div class="col col-lg-3 buttons">
            <a href="<?php echo site_url('login-accounts') ?>" class="ms-5 cancel"> Cancel</a>
            <a href="javascript:void(0);" id="FormSubmit" class="ms-2"> Save</a>
        </div>
    </div>


    <div class="row ms-1 me-1 mt-3 pt-2 add-holiday">
        <form action="<?php echo site_url('/store-account') ?>" method="post" id="AddForm">
            <div class="row ms-3 mt-3 me-2">
                <div class="col-lg-3">
                    <label>Select Employee </label>
                    <select name="EmpIDFK" id="EmpIDFK" class="form-select">
                        <option value="">Select Employee</option>
                        <?php foreach ($employees as $employee) { ?>
                            <option value="<?= $employee['EmployeeId'] ?>"><?= $employee['EmployeeName'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label>User Name </label>
                    <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter User Name">
                </div>
                <div class="col-lg-3">
                    <label>Login Email </label>
                    <input type="email" class="form-control" name="admin_login_email" id="admin_login_email" placeholder="Enter Login Email">
                </div>
                <div class="col-lg-3">
                    <label>Login Password </label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="admin_login_password" id="admin_login_password" placeholder="Enter Login Password">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="col-lg-3 mt-2">
                    <label>Designation </label>
                    <select name="user_level" id="user_level" class="form-select">
                        <option value="">Select Designation</option>
                        <?php foreach ($designations as $designation) { ?>
                            <option value="<?= $designation['IDPK'] ?>"><?= $designation['designations'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-3 mt-2">
                    <label>Employee Status </label><br>
                    <div class="form-check form-check-inline mt-2">
                        <input class="form-check-input" type="radio" name="active_status" id="active_status1" value="1" checked>
                        <label class="form-check-label" for="active_status1">Active</label>
                    </div>
                    <div class="form-check form-check-inline mt-2">
                        <input class="form-check-input" type="radio" name="active_status" id="active_status2" value="2">
                        <label class="form-check-label" for="active_status2">Inactive</label>
                    </div>
                </div>
                <div class="col-lg-3 mt-2">
                    <label>Login Permission </label><br>
                    <div class="form-check form-check-inline mt-2">
                        <input class="form-check-input" type="radio" name="login_access" id="login_access1" value="1" checked>
                        <label class="form-check-label" for="login_access1">Allow</label>
                    </div>
                    <div class="form-check form-check-inline mt-2">
                        <input class="form-check-input" type="radio" name="login_access" id="login_access2" value="2">
                        <label class="form-check-label" for="login_access2">Denied</label>
                    </div>
                </div>
            </div>
            <br>
        </form>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        var passwordInput = document.getElementById('admin_login_password');
        var icon = this.querySelector('i');

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    });

    $(document).ready(function() {

        $('#FormSubmit').click(function() {
            $('#user_level,#admin_login_password,#admin_login_email,#user_name,#EmpIDFK').removeClass('is-invalid');
            let flag = [];
            let EmpIDFK = $('#EmpIDFK').val();
            let user_name = $('#user_name').val().trim();
            let admin_login_email = $('#admin_login_email').val().trim();
            let admin_login_password = $('#admin_login_password').val().trim();
            let user_level = $('#user_level').val();

            if (!EmpIDFK) {
                $('#EmpIDFK').addClass('is-invalid');
                flag[0] = false;
            }
            if (!user_name) {
                $('#user_name').addClass('is-invalid');
                flag[1] = false;
            }
            if (!admin_login_email) {
                $('#admin_login_email').addClass('is-invalid');
                flag[2] = false;
            }
            if (!admin_login_password) {
                $('#admin_login_password').addClass('is-invalid');
                flag[3] = false;
            }
            if (!user_level) {
                $('#user_level').addClass('is-invalid');
                flag[4] = false;
            }
            for (let index = 0; index < flag.length; index++) {
                if (flag[index] == false) {
                    console.log("trigger");
                    return false;
                }
            }
            $('#AddForm').submit();
        });

    });
</script>

<?= $this->endSection() ?>