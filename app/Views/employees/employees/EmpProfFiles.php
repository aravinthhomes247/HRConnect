<?php $session = \Config\Services::session(); ?>
<?php echo ($this->extend("layouts/header-new")) ?>
<?php echo ($this->section("body")) ?>

<style>
    .profile-container i.imageedit {
        background-color: #8146D4;
        border-radius: 50%;
        padding: 4px 4px;
        top: 75%;
        cursor: pointer;
        right: 0px;
        position: absolute;
    }
</style>

<div class="profile-container mt-2 ms-4 ps-1 pt-1 pe-1">
    <div class="row me-0">
        <div class="col col-lg-1 col-md-1" style="position: relative;">
            <?php if (empty($BasicDetails['Image'])) { ?>
                <img class="img-circle elevation-2" src="<?php echo base_url('public/images/default-profile.png') ?>">
            <?php } else { ?>
                <img class="img-circle elevation-2" src="<?php echo base_url('public/Uploads/ProfilePhotosuploads/' . $BasicDetails['Image']); ?>" alt="<?php echo $BasicDetails['EmployeeName']; ?>">
            <?php } ?>
            <i class="fa-solid fa-pencil imageedit" style="color: #ffffff;"></i>
        </div>
        <div class="col col-lg-9 col-md-9">
            <div class="row">
                <span><b><?= $BasicDetails['EmployeeName'] ?></b> - <?= $BasicDetails['EmployeeCode'] ?> - <b><?= $BasicDetails['EmployeeTypeName'] ?></b></span>
                <span><?= $BasicDetails['designations'] ?></span>
                <?php if ($BasicDetails['Status'] == "Working") { ?>
                    <span class="active">Active 🟢</span>
                <?php } else { ?>
                    <span class="inactive">InActive 🔴</span>
                <?php } ?>
            </div>
        </div>
        <div class="col col-lg-2 col-md-1 rep">
            <span>Reporting To</span><br>
            <span><strong><?= $BasicDetails['ReportingPerson'] ?></strong></span><br>
            <span><?= $BasicDetails['ReportingDesignation'] ?></span>
        </div>
    </div>
    <hr class="mt-1 md-1">
    <div class="row me-0 ms-0 mt-1">
        <nav class="nav nav-pills flex-column flex-sm-row">
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId']); ?>">Basic Details</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=2'); ?>">Work Details</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=3'); ?>" >Tickets</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=4'); ?>" >Attanance</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=5'); ?>" >Late Entry</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=6'); ?>" >Time Logs</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=7'); ?>" >Pay slip</a>
            <a class="flex-sm-fill text-sm-center nav-link active" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=8'); ?>">Files</a>
        </nav>
    </div>
</div>

<input type="file" id="fileUploader" multiple style="display: none;" />
<input type="file" id="fileReplacer" style="display: none;" />
<input type="file" id="fileImage" style="display: none;" />
<div class="files ms-5 mt-3">
    <div class="row w-100">
        <div class="personal ms-0 me-0">
            <h5>Personal Files</h5>
            <div class="row mt-4">
                <div class="col upload">
                    <span>SSLC mark Sheet <a href="javascript:void(0);" class="addfile" data-cat="1"><i class="fa-solid fa-circle-plus"></i></a></span>
                    <?php foreach ($Files as $file): ?>
                        <?php if ($file['Doc_CategoryIDFK'] == 1): ?>
                            <div class="file">
                                <div class="name"><span><?= $file['Document_Name'] ?></span></div>
                                <a href="javascript:void(0);" class="replacefile" data-id="<?= $file['IDPK'] ?>" data-cat="1"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="javascript:void(0);" class="x removefile" data-id="<?= $file['IDPK'] ?>"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                    <?php endif;
                    endforeach; ?>
                </div>
                <div class="col upload">
                    <span>PUC mark Sheet <a href="javascript:void(0);" class="addfile" data-cat="2"><i class="fa-solid fa-circle-plus"></i></a></span>
                    <?php foreach ($Files as $file): ?>
                        <?php if ($file['Doc_CategoryIDFK'] == 2): ?>
                            <div class="file">
                                <div class="name"><span><?= $file['Document_Name'] ?></span></div>
                                <a href="javascript:void(0);" class="replacefile" data-id="<?= $file['IDPK'] ?>" data-cat="2"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="javascript:void(0);" class="x removefile" data-id="<?= $file['IDPK'] ?>"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                    <?php endif;
                    endforeach; ?>
                </div>
                <div class="col upload">
                    <span>Degree Certificate <a href="javascript:void(0);" class="addfile" data-cat="3"><i class="fa-solid fa-circle-plus"></i></a></span>
                    <?php foreach ($Files as $file): ?>
                        <?php if ($file['Doc_CategoryIDFK'] == 3): ?>
                            <div class="file">
                                <div class="name"><span><?= $file['Document_Name'] ?></span></div>
                                <a href="javascript:void(0);" class="replacefile" data-id="<?= $file['IDPK'] ?>" data-cat="3"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="javascript:void(0);" class="x removefile" data-id="<?= $file['IDPK'] ?>"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                    <?php endif;
                    endforeach; ?>
                </div>
                <div class="col upload">
                    <span>Aadhar Card <a href="javascript:void(0);" class="addfile" data-cat="4"><i class="fa-solid fa-circle-plus"></i></a></span>
                    <?php foreach ($Files as $file): ?>
                        <?php if ($file['Doc_CategoryIDFK'] == 4): ?>
                            <div class="file">
                                <div class="name"><span><?= $file['Document_Name'] ?></span></div>
                                <a href="javascript:void(0);" class="replacefile" data-id="<?= $file['IDPK'] ?>" data-cat="4"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="javascript:void(0);" class="x removefile" data-id="<?= $file['IDPK'] ?>"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                    <?php endif;
                    endforeach; ?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col upload">
                    <span>PAN Card <a href="javascript:void(0);" class="addfile" data-cat="5"><i class="fa-solid fa-circle-plus"></i></a></span>
                    <?php foreach ($Files as $file): ?>
                        <?php if ($file['Doc_CategoryIDFK'] == 5): ?>
                            <div class="file">
                                <div class="name"><span><?= $file['Document_Name'] ?></span></div>
                                <a href="javascript:void(0);" class="replacefile" data-id="<?= $file['IDPK'] ?>" data-cat="5"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="javascript:void(0);" class="x removefile" data-id="<?= $file['IDPK'] ?>"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                    <?php endif;
                    endforeach; ?>
                </div>
                <div class="col upload">
                    <span>Experience letter <a href="javascript:void(0);" class="addfile" data-cat="6"><i class="fa-solid fa-circle-plus"></i></a></span>
                    <?php foreach ($Files as $file): ?>
                        <?php if ($file['Doc_CategoryIDFK'] == 6): ?>
                            <div class="file">
                                <div class="name"><span><?= $file['Document_Name'] ?></span></div>
                                <a href="javascript:void(0);" class="replacefile" data-id="<?= $file['IDPK'] ?>" data-cat="6"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="javascript:void(0);" class="x removefile" data-id="<?= $file['IDPK'] ?>"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                    <?php endif;
                    endforeach; ?>
                </div>
                <div class="col upload">
                    <span>Pay Slip <a href="javascript:void(0);" class="addfile" data-cat="7"><i class="fa-solid fa-circle-plus"></i></a></span>
                    <?php foreach ($Files as $file): ?>
                        <?php if ($file['Doc_CategoryIDFK'] == 7): ?>
                            <div class="file">
                                <div class="name"><span><?= $file['Document_Name'] ?></span></div>
                                <a href="javascript:void(0);" class="replacefile" data-id="<?= $file['IDPK'] ?>" data-cat="7"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="javascript:void(0);" class="x removefile" data-id="<?= $file['IDPK'] ?>"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                    <?php endif;
                    endforeach; ?>
                </div>
                <div class="col upload">
                    <span>Bank Statement <a href="javascript:void(0);" class="addfile" data-cat="8"><i class="fa-solid fa-circle-plus"></i></a></span>
                    <?php foreach ($Files as $file): ?>
                        <?php if ($file['Doc_CategoryIDFK'] == 8): ?>
                            <div class="file">
                                <div class="name"><span><?= $file['Document_Name'] ?></span></div>
                                <a href="javascript:void(0);" class="replacefile" data-id="<?= $file['IDPK'] ?>" data-cat="8"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="javascript:void(0);" class="x removefile" data-id="<?= $file['IDPK'] ?>"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                    <?php endif;
                    endforeach; ?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col upload">
                    <span>Employer Confirmation <a href="javascript:void(0);" class="addfile" data-cat="9"><i class="fa-solid fa-circle-plus"></i></a></span>
                    <?php foreach ($Files as $file): ?>
                        <?php if ($file['Doc_CategoryIDFK'] == 9): ?>
                            <div class="file">
                                <div class="name"><span><?= $file['Document_Name'] ?></span></div>
                                <a href="javascript:void(0);" class="replacefile" data-id="<?= $file['IDPK'] ?>" data-cat="9"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="javascript:void(0);" class="x removefile" data-id="<?= $file['IDPK'] ?>"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                    <?php endif;
                    endforeach; ?>
                </div>
                <div class="col upload">
                    <span>Other Documents <a href="javascript:void(0);" class="addfile" data-cat="10"><i class="fa-solid fa-circle-plus"></i></a></span>
                    <?php foreach ($Files as $file): ?>
                        <?php if ($file['Doc_CategoryIDFK'] == 10): ?>
                            <div class="file">
                                <div class="name"><span><?= $file['Document_Name'] ?></span></div>
                                <a href="javascript:void(0);" class="replacefile" data-id="<?= $file['IDPK'] ?>" data-cat="10"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="javascript:void(0);" class="x removefile" data-id="<?= $file['IDPK'] ?>"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                    <?php endif;
                    endforeach; ?>
                </div>
                <div class="col upload">
                    <div class="file-list" id="fileList"></div>
                </div>
                <div class="col upload"></div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // When the icon is clicked, trigger the file input
        $('.addfile').on('click', function() {
            var cat = $(this).data('cat');
            $('#fileUploader').data('cat', cat).click();
        });

        $('.imageedit').on('click', function() {
            $('#fileImage').click();
        });

        $('#fileImage').on('change', function() {
            const files = this.files;
            const formData = new FormData();
            Array.from(files).forEach(file => {
                formData.append('Image', file);
            });
            $.ajax({
                       url: '<?= base_url() . '/employee-edit/single/' . $BasicDetails['EmployeeId'] ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('Updated successfully:', response);
                    Swal.fire("Profile Updated!").then((result) => {
                            location.reload();
                        });
                },
                error: function(xhr, status, error) {
                    console.log('Failed to update:', error);
                    alert('Failed to update!');
                }
            });
        });

        $('#fileUploader').on('change', function() {
            var selectedCategory = $(this).data('cat');
            const files = this.files;
            const formData = new FormData();
            Array.from(files).forEach(file => {
                formData.append('files[]', file);
            });
            formData.append('empid', <?= json_encode($BasicDetails['EmployeeId']) ?>);
            formData.append('empname', <?= json_encode($BasicDetails['EmployeeName']) ?>);
            formData.append('cat', selectedCategory);
            $.ajax({
                url: '<?php echo base_url('upload-files/2') ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    location.reload(true);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

        $('.replacefile').on('click', function() {
            var id = $(this).data('id');
            var cat = $(this).data('cat');
            $('#fileReplacer').data('id', id).data('cat', cat).click();
        });

        $('#fileReplacer').on('change', function() {
            var selectedCategory = $(this).data('cat');
            var id = $(this).data('id');
            const files = this.files;
            const formData = new FormData();
            Array.from(files).forEach(file => {
                formData.append('file', file);
            });
            formData.append('empid', <?= json_encode($BasicDetails['EmployeeId']) ?>);
            formData.append('empname', <?= json_encode($BasicDetails['EmployeeName']) ?>);
            formData.append('id', id);
            formData.append('cat', selectedCategory);
            $.ajax({
                url: '<?php echo base_url('replace-files/2') ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    location.reload(true);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

        $('.removefile').on('click', function() {
            var id = $(this).data('id');
            const formData = new FormData();
            formData.append('empid', <?= json_encode($BasicDetails['EmployeeId']) ?>);
            formData.append('empname', <?= json_encode($BasicDetails['EmployeeName']) ?>);
            formData.append('id', id);
            $.ajax({
                url: '<?php echo base_url('remove-files/2') ?>', // Backend route to handle uploads
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    location.reload(true);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<?php echo ($this->endSection()) ?>