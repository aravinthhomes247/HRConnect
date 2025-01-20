<?php $session = \Config\Services::session(); ?>
<?php echo ($this->extend("layouts/header-new")) ?>
<?php echo ($this->section("body")) ?>

<style>
    .fa-regular{
        vertical-align: middle;
    }

    .edit-icon{
        cursor: pointer;
    }

    .Action-btn {
        width: min-content;
        height: min-content;
        border-radius: 50%;
        border: 1px solid transparent;
        background-color: transparent;
    }

    .action-btns{
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
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId']); ?>">Basic Details</a>
            <a class="flex-sm-fill text-sm-center nav-link active" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=2'); ?>">Work Details</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=3'); ?>" style="pointer-events:none;">Approvals <span style="font-size:xx-small;color:red;">Coming Soon</span></a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=4'); ?>" style="pointer-events:none;">Attanance <span style="font-size:xx-small;color:red;">Coming Soon</span></a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=5'); ?>" style="pointer-events:none;">Late Entry <span style="font-size:xx-small;color:red;">Coming Soon</span></a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=6'); ?>" style="pointer-events:none;">Time Logs <span style="font-size:xx-small;color:red;">Coming Soon</span></a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=7'); ?>" style="pointer-events:none;">Pay slip <span style="font-size:xx-small;color:red;">Coming Soon</span></a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/' . $BasicDetails['EmployeeId'] . '?trickId=8'); ?>">Files</a>
        </nav>
    </div>
</div>


<div class="row ms-2 me-0">
    <div class="employeeinfo mt-2 ms-3">
        <h5 class="mt-2 ms-2">Employment Information</h5>
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>Department</th>
                    <td class="editable" data-name="DepartmentId" data-type="select-Dep"><?= $WorkDetails['Employement']['deptName'] ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Designation</th>
                    <td class="editable" data-name="DesignationIDFK" data-type="select-Des"><?= $BasicDetails['designations'] ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td class="editable" data-name="Status" data-type="select-status"><?= $BasicDetails['Status'] ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Employment Type</th>
                    <td class="editable" data-name="EmployementType" data-type="select-Emptyp"><?= $BasicDetails['EmployeeTypeName'] ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Date of Joining</th>
                    <?php $date = new DateTime($WorkDetails['Employement']['DOJ']); ?>
                    <td class="editable" data-name="DOJ" data-type="date"><?= $date->format('d/m/Y') ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Reporting To</th>
                    <td class="editable" data-name="ReportManagerIDFK" data-type="select-Man"><?= $WorkDetails['Employement']['EmployeeName'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Contract Period</th>
                    <td class="editable" data-name="ContractPeriod" data-type="text"><?= $WorkDetails['Employement']['ContractPeriod'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Salary Date (Every Month)</th>
                    <td class="editable" data-name="Salary_date" data-type="number"><?= $BasicDetails['Salary_date'] ?? 'NA' ?></td>
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
                    <td class="editable" data-name="Aadhar_No" data-type="number"><?= $WorkDetails['Employement']['Aadhar_No'] ?? 'NA' ?></td>
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
                    <td class="editable" data-name="PAN_No" data-type="text"><?= $WorkDetails['Employement']['PAN_No'] ?? 'NA' ?></td>
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

    <div class="employeeinfo mt-2 ms-3">
        <h5 class="mt-2 ms-2">Salary Information</h5>
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th class="green">Basic Salary</th>
                    <td class="editable" data-name="BasicSalary" data-type="number"><?= $WorkDetails['Salary']['BasicSalary'] ?? 'NA'  ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="green">HRA</th>
                    <td class="editable" data-name="HRA" data-type="number"><?= $WorkDetails['Salary']['HRA'] ?? 'NA'  ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="green">FBP</th>
                    <td class="editable" data-name="FBP" data-type="number"><?= $WorkDetails['Salary']['FBP'] ?? 'NA'  ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="red">PF</th>
                    <td class="editable" data-name="PF" data-type="number"><?= $WorkDetails['Salary']['PF'] ?? 'NA'  ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="red">PT</th>
                    <td class="editable" data-name="PT" data-type="number"><?= $WorkDetails['Salary']['PT'] ?? 'NA'  ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="red">PF Vol</th>
                    <td class="editable" data-name="PF_VOL" data-type="number"><?= $WorkDetails['Salary']['PF_VOL'] ?? 'NA'  ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="red">Insurance</th>
                    <td class="editable" data-name="Insurance" data-type="number"><?= $WorkDetails['Salary']['Insurance'] ?? 'NA'  ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="red">SD</th>
                    <td class="editable" data-name="SD" data-type="number"><?= $WorkDetails['Salary']['SD'] ?? 'NA'  ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr class="highlight">
                    <th>Gross Salary</th>
                    <td class="editable" data-name="GrossSalary" data-type="number"><?= $WorkDetails['Salary']['GrossSalary'] ?? 'NA'  ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr class="highlight">
                    <th>Net Salary</th>
                    <td class="editable" data-name="NetSalary" data-type="number"><?= $WorkDetails['Salary']['NetSalary'] ?? 'NA' ?></td>
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

<div class="row ms-2 me-0">
    <input type="hidden" id="acc-type">
    <div class="employeeinfo mt-2 ms-3">
        <h5 class="mt-2 ms-2">Personal Bank Information</h5>
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>Account Holder Name</th>
                    <td class="editable" data-name="AccountHolderName" data-type="text"><?= $WorkDetails['Personal']['AccountHolderName'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" data-acctype="2" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Bank Name</th>
                    <td class="editable" data-name="BankName" data-type="text" ><?= $WorkDetails['Personal']['BankName'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" data-acctype="2" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Bank Branch</th>
                    <td class="editable" data-name="BankBranch" data-type="text"><?= $WorkDetails['Personal']['BankBranch'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" data-acctype="2" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Account No</th>
                    <td class="editable" data-name="AccountNo" data-type="number"><?= $WorkDetails['Personal']['AccountNo'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" data-acctype="2" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>IFSC Code</th>
                    <td class="editable" data-name="IFSCode" data-type="text"><?= $WorkDetails['Personal']['IFSCode'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" data-acctype="2" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Payment Mode</th>
                    <td class="editable" data-name="Mode" data-type="select-paymode" data-actype="2">
                        <?php switch ($WorkDetails['Personal']['Mode']) {
                            case 1:
                                echo('Bank Transfer');
                                break;
                            case 2:
                                echo('Cash');
                                break;
                            case 3:
                                echo('UPI');
                                break;
                            case 4:
                                echo('Check');
                                break;
                            default:
                                echo('NA');
                                break;
                        }?>
                    </td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" data-acctype="2" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>UAN No</th>
                    <td class="editable" data-name="UAN_No" data-type="text"><?= $WorkDetails['Employement']['UAN_No'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" data-acctype="2" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="employeeinfo mt-2 ms-3">
        <h5 class="mt-2 ms-2">Official Bank Information</h5>
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>Account Holder Name</th>
                    <td class="editable" data-name="AccountHolderName" data-type="text"><?= $WorkDetails['Official']['AccountHolderName'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" data-acctype="1" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Bank Name</th>
                    <td class="editable" data-name="BankName" data-type="text"><?= $WorkDetails['Official']['BankName'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" data-acctype="1" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Bank Branch</th>
                    <td class="editable" data-name="BankBranch" data-type="text"><?= $WorkDetails['Official']['BankBranch'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" data-acctype="1" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Account No</th>
                    <td class="editable" data-name="AccountNo" data-type="number"><?= $WorkDetails['Official']['AccountNo'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" data-acctype="1" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>IFSC Code</th>
                    <td class="editable" data-name="IFSCode" data-type="text"><?= $WorkDetails['Official']['IFSCode'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" data-acctype="1" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Payment Mode</th>
                    <td class="editable" data-name="Mode" data-type="select-paymode" data-actype="1">
                        <?php switch ($WorkDetails['Official']['Mode']) {
                                case 1:
                                    echo('Bank Transfer');
                                    break;
                                case 2:
                                    echo('Cash');
                                    break;
                                case 3:
                                    echo('UPI');
                                    break;
                                case 4:
                                    echo('Check');
                                    break;
                                default:
                                    echo('NA');
                                    break;
                            }?>
                    </td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" data-acctype="1" style="color: #01e305; display:none;"></i></button>
                            <button class="Action-btn"><i class="fa-regular fa-circle-xmark cancel-icon" style="color: #ec0914; display:none;"></i></button>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>UAN No</th>
                    <td class="editable" data-name="UAN_No" data-type="text"><?= $WorkDetails['Employement']['UAN_No'] ?? 'NA' ?></td>
                    <td>
                        <i class="fa-solid fa-pencil edit-icon" style="color: #98A2B3;"></i>
                        <div class="action-btns">
                            <button class="Action-btn"><i class="fa-regular fa-circle-check save-icon" data-acctype="1" style="color: #01e305; display:none;"></i></button>
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
        var DEPARTMENTS = <?= json_encode($Departments) ?>;
        var DESIGNATIONS = <?= json_encode($Designations) ?>;
        var EMPTYPES = <?= json_encode($EmpTypes) ?>;
        var MANAGERS = <?= json_encode($Managers) ?>;

        $('.edit-icon').on('click', function() {
            const row = $(this).closest('tr'); // Get the current row
            const editableTd = row.find('.editable'); // Editable cell
            const saveIcon = row.find('.save-icon'); // Save button
            const cancelIcon = row.find('.cancel-icon'); // Cancel button
            const currentText = editableTd.text().trim(); // Current value
            const inpname = editableTd.data('name'); // Name attribute
            const type = editableTd.data('type'); // Input type (text, date, select)
            const actype = editableTd.data('actype');

            // Generate the input or select element
            if (type === "select-Dep") {
                if (editableTd.find('select').length === 0) {
                    editableTd.html(`<select class="form-control" name="${inpname}">
                                        ${DEPARTMENTS.map(element => `<option value="${element.IDPK}" ${(currentText === element.deptName) ? 'selected' : ''}>${element.deptName}</option>`).join('')}
                                    </select>`);
                }
            } else if(type === "select-Des"){
                if (editableTd.find('select').length === 0) {
                    editableTd.html(`<select class="form-control" name="${inpname}">
                                        ${DESIGNATIONS.map(element => `<option value="${element.IDPK}" ${(currentText === element.designations) ? 'selected' : ''}>${element.designations}</option>`).join('')}
                                    </select>`);
                }
            } else if(type === "select-Emptyp"){
                if (editableTd.find('select').length === 0) {
                    editableTd.html(`<select class="form-control" name="${inpname}">
                                        ${EMPTYPES.map(element => `<option value="${element.IDPK}" ${(currentText === element.EmployeeTypeName) ? 'selected' : ''}>${element.EmployeeTypeName}</option>`).join('')}
                                    </select>`);
                }
            } else if(type === "select-Man"){
                if (editableTd.find('select').length === 0) {
                    editableTd.html(`<select class="form-control" name="${inpname}">
                                        ${MANAGERS.map(element => `<option value="${element.EmployeeId}" ${(currentText === element.EmployeeName) ? 'selected' : ''}>${element.EmployeeName}</option>`).join('')}
                                    </select>`);
                }
            } else if(type === "select-status"){
                if (editableTd.find('select').length === 0) {
                    editableTd.html(`<select class="form-control" name="${inpname}">
                                        <option value="Working" ${(currentText === 'Working') ? 'selected' : ''}>Working</option>
                                        <option value="Abscond" ${(currentText === 'Abscond') ? 'selected' : ''}>Abscond</option>
                                        <option value="InActive" ${(currentText === 'InActive') ? 'selected' : ''}>InActive</option>
                                    </select>`);
                }
            } else if(type === "select-paymode" && actype == 1){
                if (editableTd.find('select').length === 0) {
                    editableTd.html(`<select class="form-control" name="${inpname}">
                                        <option value="1" ${(currentText === 'Bank Transfer') ? 'selected' : ''}>Bank Transfer</option>
                                        <option value="2" ${(currentText === 'Cash') ? 'selected' : ''}>Cash</option>
                                        <option value="3" ${(currentText === 'UPI') ? 'selected' : ''}>UPI</option>
                                        <option value="4" ${(currentText === 'Check') ? 'selected' : ''}>Check</option>
                                    </select>`);
                }
            } else if(type === "select-paymode" && actype == 2){
                if (editableTd.find('select').length === 0) {
                    editableTd.html(`<select class="form-control" name="${inpname}">
                                        <option value="1" ${(currentText === 'Bank Transfer') ? 'selected' : ''}>Bank Transfer</option>
                                        <option value="2" ${(currentText === 'Cash') ? 'selected' : ''}>Cash</option>
                                        <option value="3" ${(currentText === 'UPI') ? 'selected' : ''}>UPI</option>
                                        <option value="4" ${(currentText === 'Check') ? 'selected' : ''}>Check</option>
                                    </select>`);
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
                if($(this).data('acctype')){
                    $('#acc-type').val($(this).data('acctype'));
                }else{
                    $('#acc-type').val('');
                }

                $('#acc-type').val();
                if (type === "select" || type === "select-Dep" || type === "select-Des" || type === "select-Emptyp" || type === "select-Man" || type === "select-status" || type === "select-paymode") {
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
                    data['acc-type'] = $('#acc-type').val();

                    // Perform AJAX request to save data
                    $.ajax({
                        url: '<?= base_url() . '/employee-edit/single/' . $BasicDetails['EmployeeId'] ?>',
                        type: 'POST',
                        data: data,
                        success: function(response) {
                            console.log('Updated successfully:', response);
                            location.reload();
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
                    location.reload();
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