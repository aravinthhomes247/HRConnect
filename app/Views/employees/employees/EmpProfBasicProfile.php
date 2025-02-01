<?php $session = \Config\Services::session(); ?>
<?php echo ($this->extend("layouts/header-new")) ?>
<?php echo ($this->section("body")) ?>

<style>
    .fa-regular {
        vertical-align: middle;
    }

    .edit-icon {
        cursor: pointer;
    }

    .Action-btn {
        width: min-content;
        height: min-content;
        border-radius: 50%;
        border: 1px solid transparent;
        background-color: transparent;
    }

    .action-btns {
        display: flex;
        gap: 5px;
    }

    i.fa-pencil.edit-icon:hover {
        color: #8146D4 !important;
    }

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
        <input type="file" id="fileImage" style="display: none;"/>
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
            <a class="flex-sm-fill text-sm-center nav-link active" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId']); ?>">Basic Details</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=2'); ?>">Work Details</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=3'); ?>" >Tickets</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=4'); ?>" >Attanance</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=5'); ?>" >Late Entry</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=6'); ?>" >Time Logs</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=7'); ?>" >Pay slip</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=8'); ?>">Files</a>
        </nav>
    </div>
</div>


<div class="row ms-2 me-0">
    <input type="hidden" id="Edit_Name">
    <input type="hidden" id="Edit_Value">
    <div class="personalinfo mt-2 ms-3">
        <h5 class="mt-2 ms-2">Personal Information</h5>
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>Employee Name</th>
                    <td class="editable" data-name="EmployeeName" data-type="text"><?= $BasicDetails['EmployeeName'] ?? 'NA' ?> </td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Employee Code</th>
                    <td class="editable" data-name="EmployeeCode" data-type="text"><?= $BasicDetails['EmployeeCode'] ?? 'NA' ?></td>
                    <td>
                        <!-- <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div> -->
                    </td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td class="editable" data-name="Gender" data-type="select"><?= $BasicDetails['Gender'] ?? 'NA' ?> </td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>DOB</th>
                    <td class="editable" data-name="DOB" data-type="date"><?= date('d/m/y', strtotime($BasicDetails['DOB'])) ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Blood Group</th>
                    <td class="editable" data-name="BLOODGROUP" data-type="select"><?= $BasicDetails['BLOODGROUP'] ?? 'NA' ?> </td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Father Name</th>
                    <td class="editable" data-name="FatherName" data-type="text"><?= $BasicDetails['FatherName'] ?? 'NA' ?> </td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Mother Name</th>
                    <td class="editable" data-name="MotherName" data-type="text"><?= $BasicDetails['MotherName'] ?? 'NA' ?> </td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Place of Birth</th>
                    <td class="editable" data-name="PlaceOfBirth" data-type="text"><?= $BasicDetails['PlaceOfBirth'] ?? 'NA' ?> </td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Aadhar No</th>
                    <td class="editable" data-name="Aadhar_No" data-type="number"><?= $BasicDetails['Aadhar_No'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>PAN No</th>
                    <td class="editable" data-name="PAN_No" data-type="text"><?= $BasicDetails['PAN_No'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="contactinfo mt-2 ms-2">
        <h5 class="mt-2 ms-2">Contact Information</h5>
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>Residential Address</th>
                    <td class="editable" data-name="ResidentialAddress" data-type="text"><?= $BasicDetails['ResidentialAddress'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Permanent Address</th>
                    <td class="editable" data-name="PermanentAddress" data-type="text"><?= $BasicDetails['PermanentAddress'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Contact No</th>
                    <td class="editable" data-name="ContactNo" data-type="number"><?= $BasicDetails['ContactNo'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Alternate No</th>
                    <td class="editable" data-name="AltContactno" data-type="number"><?= $BasicDetails['AltContactno'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Emergency Contact No</th>
                    <td class="editable" data-name="EContactNo" data-type="number"><?= $BasicDetails['EContactNo'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Official Mail ID</th>
                    <td class="editable" data-name="Email" data-type="text"><?= $BasicDetails['Email'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Personal Mail ID</th>
                    <td class="editable" data-name="PersonalMail" data-type="text"><?= $BasicDetails['PersonalMail'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<script>
    $(document).ready(function() {
        // When the edit icon is clicked
        $('.edit-icon').on('click', function() {
            const row = $(this).closest('tr'); // Get the current row
            const editableTd = row.find('.editable'); // Editable cell
            const saveIcon = row.find('.save-icon'); // Save button
            const cancelIcon = row.find('.cancel-icon'); // Cancel button
            const currentText = editableTd.text().trim(); // Current value
            const inpname = editableTd.data('name'); // Name attribute
            const type = editableTd.data('type'); // Input type (text, date, select)

            // Generate the input or select element
            if (type === "select" && inpname === "BLOODGROUP") {
                if (editableTd.find('select').length === 0) {
                    editableTd.html(`
                    <select class="form-control" name="${inpname}">
                        <option value="A+ve" ${(currentText === 'A+ve')?'selected':''}>A+ve</option>
                        <option value="A-ve" ${(currentText === 'A-ve')?'selected':''}>A-ve</option>
                        <option value="B+ve" ${(currentText === 'B+ve')?'selected':''}>B+ve</option>
                        <option value="B-ve" ${(currentText === 'B-ve')?'selected':''}>B-ve</option>
                        <option value="O+ve" ${(currentText === 'O+ve')?'selected':''}>O+ve</option>
                        <option value="O-ve" ${(currentText === 'O-ve')?'selected':''}>O-ve</option>
                        <option value="AB+ve" ${(currentText === 'AB+ve')?'selected':''}>AB+ve</option>
                        <option value="AB-ve" ${(currentText === 'AB-ve')?'selected':''}>AB-ve</option>
                    </select>
                `);
                }
            }else if (type === "select") {
                if (editableTd.find('select').length === 0) {
                    editableTd.html(`
                    <select class="form-control" name="${inpname}">
                        <option value="Male" ${(currentText === 'Male') ? 'selected' : ''}>Male</option>
                        <option value="Female" ${(currentText === 'Female') ? 'selected' : ''}>Female</option>
                        <option value="Transgender" ${(currentText === 'Transgender') ? 'selected' : ''}>Transgender</option>
                    </select>
                `);
                }
            } else {
                if (editableTd.find('input').length === 0) {
                    editableTd.html(`<input type="${type}" class="form-control" name="${inpname}" value="${currentText}" />`);
                }
            }

            $(this).hide(); // Hide edit icon
            saveIcon.show(); // Show save button
            cancelIcon.show(); // Show cancel button

            const input = editableTd.find('input');
            const select = editableTd.find('select');

            // Focus the input or select element
            if (type !== "select") {
                input.focus();
            }

            // Handle Enter key press for text input
            if (type === "text") {
                input.on('keydown', function(event) {
                    if (event.key === 'Enter') {
                        saveValue(row, editableTd, inpname, input.val().trim(), currentText, "keydown");
                    }
                });
            }

            // Save action on save icon click
            saveIcon.on('click', function() {
                if (type === "select") {
                    saveValue(row, editableTd, inpname, select.val(), currentText, "saveicon");
                } else {
                    saveValue(row, editableTd, inpname, input.val().trim(), currentText, "saveicon");
                }
            });

            // Cancel action on cancel icon click
            cancelIcon.on('click', function() {
                editableTd.text(currentText); // Restore original value
                row.find('.edit-icon').show(); // Show edit icon
                saveIcon.hide(); // Hide save button
                cancelIcon.hide(); // Hide cancel button
            });

            // Function to save value
            function saveValue(row, editableTd, inpname, newValue, originalValue, action) {
                if (newValue === originalValue || newValue === '') {
                    editableTd.text(originalValue); // Restore original value
                } else {
                    editableTd.text(newValue); // Update cell with new value

                    // Prepare data for AJAX
                    const data = {};
                    data['Name'] = inpname;
                    data[inpname] = newValue;

                    // Perform AJAX request to save data
                    $.ajax({
                        url: '<?= base_url() . '/employee-edit/single/' . $BasicDetails['EmployeeId'] ?>',
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

                // Reset icons
                row.find('.edit-icon').show();
                saveIcon.hide();
                cancelIcon.hide();
            }
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
                    Swal.fire("Employee Updated!").then((result) => {
                            location.reload();
                        });
                },
                error: function(xhr, status, error) {
                    console.log('Failed to update:', error);
                    alert('Failed to update!');
                }
            });
        });
    });
</script>


<?php echo ($this->endSection()) ?>