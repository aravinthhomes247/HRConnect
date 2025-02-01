<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>

<div class="holiday ms-4 mt-3">
    <div class="row ms-0 me-0 mt-3 pt-2">
        <div class="col col-lg-9 mt-1">
            <h4><?= $department[0]['deptName'] ?></h4>
        </div>
        <div class="col col-lg-3 buttons">
            <a href="<?php echo site_url('/departments') ?>" class="ms-5 cancel"> Cancel</a>
            <a href="javascript:void(0);" id="AddDepartmentformsubmit" class="ms-2"> Update</a>
        </div>
    </div>


    <div class="row ms-1 me-1 mt-3 pt-2 add-holiday">
        <form action="<?php echo site_url('/update-department/'.$department[0]['IDPK']) ?>" method="post" id="AddDepartmentForm">
            <input type="hidden" name="IDPK" value="<?= $department[0]['IDPK'] ?>">
            <div class="row ms-5 mt-3">
                <div class="col col-lg-3">
                    <div class="mb-3">
                        <label for="DepartmentName" class="form-label">Department Name</label>
                        <input type="text" class="form-control" name="DepartmentName" id="DepartmentName" placeholder="HR & Operation" value="<?= $department[0]['deptName'] ?>" required>
                        <div class="invalid-feedback">
                            Please provide a valid Name.
                        </div>
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="mb-3">
                        <label for="CasualLeave" class="form-label">No. of Casual Leave per Month</label>
                        <select class="form-select" name="CasualLeave" id="CasualLeave">
                            <option value="0" <?= ($department[0]['CLPM'] == 0)? 'selected':'' ?>>0</option>
                            <option value="1" <?= ($department[0]['CLPM'] == 1)? 'selected':'' ?>>1</option>
                            <option value="2" <?= ($department[0]['CLPM'] == 2)? 'selected':'' ?>>2</option>
                            <option value="3" <?= ($department[0]['CLPM'] == 3)? 'selected':'' ?>>3</option>
                            <option value="4" <?= ($department[0]['CLPM'] == 4)? 'selected':'' ?>>4</option>
                            <option value="5" <?= ($department[0]['CLPM'] == 5)? 'selected':'' ?>>5</option>
                            <option value="6" <?= ($department[0]['CLPM'] == 6)? 'selected':'' ?>>6</option>
                            <option value="7" <?= ($department[0]['CLPM'] == 7)? 'selected':'' ?>>7</option>
                            <option value="8" <?= ($department[0]['CLPM'] == 8)? 'selected':'' ?>>8</option>
                            <option value="9" <?= ($department[0]['CLPM'] == 9)? 'selected':'' ?>>9</option>
                            <option value="10" <?= ($department[0]['CLPM'] == 10)? 'selected':'' ?>>10</option>
                        </select>
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="mb-3">
                        <label for="SickLeave" class="form-label">No. of Sick Leave per Month</label>
                        <select class="form-select" name="SickLeave" id="SickLeave">
                            <option value="0" <?= ($department[0]['SLPM'] == 0)? 'selected':'' ?>>0</option>
                            <option value="1" <?= ($department[0]['SLPM'] == 1)? 'selected':'' ?>>1</option>
                            <option value="2" <?= ($department[0]['SLPM'] == 2)? 'selected':'' ?>>2</option>
                            <option value="3" <?= ($department[0]['SLPM'] == 3)? 'selected':'' ?>>3</option>
                            <option value="4" <?= ($department[0]['SLPM'] == 4)? 'selected':'' ?>>4</option>
                            <option value="5" <?= ($department[0]['SLPM'] == 5)? 'selected':'' ?>>5</option>
                            <option value="6" <?= ($department[0]['SLPM'] == 6)? 'selected':'' ?>>6</option>
                            <option value="7" <?= ($department[0]['SLPM'] == 7)? 'selected':'' ?>>7</option>
                            <option value="8" <?= ($department[0]['SLPM'] == 8)? 'selected':'' ?>>8</option>
                            <option value="9" <?= ($department[0]['SLPM'] == 9)? 'selected':'' ?>>9</option>
                            <option value="10" <?= ($department[0]['SLPM'] == 10)? 'selected':'' ?>>10</option>
                        </select>
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="mb-3">
                        <label for="PaidLeave" class="form-label">No. of Paid Leave per Month</label>
                        <select class="form-select" name="PaidLeave" id="PaidLeave">
                            <option value="0" <?= ($department[0]['PLPM'] == 0)? 'selected':'' ?>>0</option>
                            <option value="1" <?= ($department[0]['PLPM'] == 1)? 'selected':'' ?>>1</option>
                            <option value="2" <?= ($department[0]['PLPM'] == 2)? 'selected':'' ?>>2</option>
                            <option value="3" <?= ($department[0]['PLPM'] == 3)? 'selected':'' ?>>3</option>
                            <option value="4" <?= ($department[0]['PLPM'] == 4)? 'selected':'' ?>>4</option>
                            <option value="5" <?= ($department[0]['PLPM'] == 5)? 'selected':'' ?>>5</option>
                            <option value="6" <?= ($department[0]['PLPM'] == 6)? 'selected':'' ?>>6</option>
                            <option value="7" <?= ($department[0]['PLPM'] == 7)? 'selected':'' ?>>7</option>
                            <option value="8" <?= ($department[0]['PLPM'] == 8)? 'selected':'' ?>>8</option>
                            <option value="9" <?= ($department[0]['PLPM'] == 9)? 'selected':'' ?>>9</option>
                            <option value="10" <?= ($department[0]['PLPM'] == 10)? 'selected':'' ?>>10</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row ms-5 mt-3 mb-5">
                <h6>Select Week Off Day</h6>
                <div class="col col-lg-12 weekoff">
                    <input type="hidden" name="wo1" id="wo1" value="<?= $department[0]['WO1'] ?>">
                    <input type="hidden" name="wo2" id="wo2" value="<?= $department[0]['WO2'] ?>">
                    <input type="hidden" name="wo3" id="wo3" value="<?= $department[0]['WO3'] ?>">
                    <input type="hidden" name="wo4" id="wo4" value="<?= $department[0]['WO4'] ?>">
                    <input type="hidden" name="wo5" id="wo5" value="<?= $department[0]['WO5'] ?>">
                    <input type="hidden" name="wo6" id="wo6" value="<?= $department[0]['WO6'] ?>">
                    <input type="hidden" name="wo7" id="wo7" value="<?= $department[0]['WO7'] ?>">
                    <span class="<?= ($department[0]['WO1'] == 1)? 'active':'' ?>" data-day="1">Sunday <i class="fa-solid <?= ($department[0]['WO1'] == 1)? 'fa-check':'fa-plus' ?>"></i></span>
                    <span class="ms-2 <?= ($department[0]['WO2'] == 1)? 'active':'' ?>" data-day="2">Monday <i class="fa-solid <?= ($department[0]['WO2'] == 1)? 'fa-check':'fa-plus' ?>"></i></span>
                    <span class="ms-2 <?= ($department[0]['WO3'] == 1)? 'active':'' ?>" data-day="3">Tuesday <i class="fa-solid <?= ($department[0]['WO3'] == 1)? 'fa-check':'fa-plus' ?>"></i></span>
                    <span class="ms-2 <?= ($department[0]['WO4'] == 1)? 'active':'' ?>" data-day="4">Wednesday <i class="fa-solid <?= ($department[0]['WO4'] == 1)? 'fa-check':'fa-plus' ?>"></i></span>
                    <span class="ms-2 <?= ($department[0]['WO5'] == 1)? 'active':'' ?>" data-day="5">Thursday <i class="fa-solid <?= ($department[0]['WO5'] == 1)? 'fa-check':'fa-plus' ?>"></i></span>
                    <span class="ms-2 <?= ($department[0]['WO6'] == 1)? 'active':'' ?>" data-day="6">Friday <i class="fa-solid <?= ($department[0]['WO6'] == 1)? 'fa-check':'fa-plus' ?>"></i></span>
                    <span class="ms-2 <?= ($department[0]['WO7'] == 1)? 'active':'' ?>" data-day="7">Saturday <i class="fa-solid <?= ($department[0]['WO7'] == 1)? 'fa-check':'fa-plus' ?>"></i></span>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Select all span elements inside the weekoff container
    const weekoffSpans = document.querySelectorAll('.weekoff span');
    weekoffSpans.forEach(span => {
        span.addEventListener('click', function() {
            this.classList.toggle('active');
            const icon = this.querySelector('i');
            const val = this.getAttribute('data-day');
            const input = document.getElementById('wo' + val);
            if (input) {
                input.value = input.value === '1' ? '0' : '1';
            }
            if (icon) {
                if (icon.classList.contains('fa-check')) {
                    icon.classList.replace('fa-check', 'fa-plus');
                } else {
                    icon.classList.replace('fa-plus', 'fa-check');
                }
            }
        });
    });

    $('#AddDepartmentformsubmit').on('click',function(){
        let name = $('#DepartmentName').val().trim();
        if (!name) {
            $('#DepartmentName').addClass('is-invalid');
        }else{
        $('#AddDepartmentForm').submit();
        }
    });

</script>

<?= $this->endSection() ?>