<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>

<div class="holiday ms-4 mt-3">
    <div class="row ms-0 me-0 mt-3 pt-2">
        <div class="col col-lg-9 mt-1">
            <h4>Add New Department</h4>
        </div>
        <div class="col col-lg-3 buttons">
            <a href="<?php echo site_url('/departments') ?>" class="ms-5 cancel"> Cancel</a>
            <a href="javascript:void(0);" id="AddDepartmentformsubmit" class="ms-2"> Save</a>
        </div>
    </div>

    <div class="row ms-1 me-1 mt-3 pt-2 add-holiday">
        <form action="<?php echo site_url('/store-department') ?>" method="post" id="AddDepartmentForm">
            <div class="row ms-5 mt-3">
                <div class="col col-lg-4">
                    <div class="mb-3">
                        <label for="DepartmentName" class="form-label">Department Name</label>
                        <input type="text" class="form-control" name="DepartmentName" id="DepartmentName" placeholder="HR & Operation" required>
                        <div class="invalid-feedback">
                            Please provide a valid Name.
                        </div>
                    </div>
                </div>
                <div class="col col-lg-4 ms-5">
                    <div class="mb-3">
                        <label for="CasualLeave" class="form-label">No. of Casual Leave per Month</label>
                        <select class="form-control" name="CasualLeave" id="CasualLeave">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row ms-5 mt-3 mb-5">
                <h6>Select Week Off Day</h6>
                <div class="col col-lg-12 weekoff">
                    <input type="hidden" name="wo1" id="wo1" value="1">
                    <input type="hidden" name="wo2" id="wo2" value="0">
                    <input type="hidden" name="wo3" id="wo3" value="0">
                    <input type="hidden" name="wo4" id="wo4" value="0">
                    <input type="hidden" name="wo5" id="wo5" value="0">
                    <input type="hidden" name="wo6" id="wo6" value="0">
                    <input type="hidden" name="wo7" id="wo7" value="0">
                    <span class="active" data-day="1">Sunday <i class="fa-solid fa-check"></i></span>
                    <span class="ms-2" data-day="2">Monday <i class="fa-solid fa-plus"></i></span>
                    <span class="ms-2" data-day="3">Tuesday <i class="fa-solid fa-plus"></i></span>
                    <span class="ms-2" data-day="4">Wednesday <i class="fa-solid fa-plus"></i></span>
                    <span class="ms-2" data-day="5">Thursday <i class="fa-solid fa-plus"></i></span>
                    <span class="ms-2" data-day="6">Friday <i class="fa-solid fa-plus"></i></span>
                    <span class="ms-2" data-day="7">Saturday <i class="fa-solid fa-plus"></i></span>
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