<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>

<div class="holiday ms-4 mt-3">
    <div class="row ms-0 me-0 mt-3 pt-2">
        <div class="col col-lg-9 mt-1">
            <h4><?= $holiday[0]['Name'] ?></h4>
        </div>
        <div class="col col-lg-3 buttons">
            <a href="<?php echo site_url('/holidays') ?>" class="ms-5 cancel"> Cancel</a>
            <a href="javascript:void(0);" id="AddDepartmentformsubmit" class="ms-2"> Update</a>
        </div>
    </div>


    <div class="row ms-1 me-1 mt-3 pt-2 add-holiday">
        <form action="<?php echo site_url('/update-holiday/' . $holiday[0]['IDPK']) ?>" method="post" id="AddDepartmentForm">
            <input type="hidden" name="IDPK" value="<?= $holiday[0]['IDPK'] ?>">
            <input type="hidden" name="AllDept" id="AllDept" value="<?= $holiday[0]['AllDept'] ?>">
            <div class="row ms-5 mt-3">
                <div class="col col-lg-4">
                    <div class="mb-3">
                        <label for="holidayname" class="form-label">Holiday Name</label>
                        <input type="text" class="form-control" name="holidayname" id="holidayname" placeholder="New Year" value="<?= $holiday[0]['Name'] ?>">
                        <div class="invalid-feedback">
                            Please provide a valid Name.
                        </div>
                    </div>
                </div>
                <div class="col col-lg-3 ms-3">
                    <div class="mb-3">
                        <label for="holidaydate" class="form-label">Holiday Date</label>
                        <input class="form-control" type="date" name="holidaydate" id="holidaydate" value="<?= $holiday[0]['Date'] ?>">
                        <div class="invalid-feedback">
                            Please provide a valid Date.
                        </div>
                    </div>
                </div>
                <div class="col col-lg-3 ms-3">
                    <div class="mb-3">
                        <label for="SameDate" class="form-label">Every Year Same Date</label>
                        <select class="form-control" name="SameDate" id="SameDate">
                            <option value="1" <?= ($holiday[0]['SameDate'] == 1) ? 'selected' : '' ?>>Yes</option>
                            <option value="0" <?= ($holiday[0]['SameDate'] == 0) ? 'selected' : '' ?>>No</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row ms-5 mt-3 mb-5">
                <h6>Select Departments</h6>
                <?php $departmentIDs = json_decode($holiday[0]['DepartmentIDFK'], true); ?>
                <div class="col col-lg-12 weekoff mt-2">
                    <?php foreach ($departments as $index => $department) { ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="departments[]" id="do<?= $index ?>" value="<?= $department['IDPK'] ?>" <?= in_array($department['IDPK'], $departmentIDs) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="do<?= $index ?>"><?= $department['deptName'] ?></label>
                        </div>
                    <?php } ?>
                    <div class="invalid-feedback-dept" style="display:none;color:#dc3545;">
                        Please select at least one department.
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#AddDepartmentformsubmit').on('click', function() {
        $('.invalid-feedback-dept').hide();
        $('input[name="departments[]"], #holidayname, #holidaydate').removeClass('is-invalid');
        let name = $('#holidayname').val().trim();
        let date = $('#holidaydate').val();
        let checkedCount = $('input[name="departments[]"]:checked').length;
        $('#AllDept').val(checkedCount === $('input[name="departments[]"]').length ? 1 : 0);
        if (!name) {
            $('#holidayname').addClass('is-invalid');
        }
        if (!date) {
            $('#holidaydate').addClass('is-invalid');
        }
        if (checkedCount === 0) {
            $('input[name="departments[]"]').addClass('is-invalid');
            $('.invalid-feedback-dept').show();
        }
        if (name && date && checkedCount > 0) {
        $('#AddDepartmentForm').submit();
        }
    });
</script>

<?= $this->endSection() ?>