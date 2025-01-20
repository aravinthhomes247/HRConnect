<?php $session = \Config\Services::session(); ?>
<?php echo ($this->extend("layouts/header-new")) ?>
<?php echo ($this->section("body")) ?>


    

    <div class="profile-container mt-2 ms-4 ps-1 pt-1 pe-1">
        <div class="row me-0">
            <div class="col col-lg-1 col-md-1">
                <?php if(empty($BasicDetails['Image'])){ ?>
                    <img class="img-circle elevation-2" src="<?php echo base_url('public/images/default-profile.png') ?>" >
                <?php } else { ?>
                    <img class="img-circle elevation-2" src="<?php echo base_url('public/Uploads/ProfilePhotosuploads/'.$BasicDetails['Image']); ?>" alt="<?php echo $BasicDetails['EmployeeName']; ?>">
                <?php } ?>
            </div>
            <div class="col col-lg-9 col-md-9">
                <div class="row">
                    <span><b><?= $BasicDetails['EmployeeName'] ?></b> - <?= $BasicDetails['EmployeeCode'] ?> - <b><?= $BasicDetails['EmployeeTypeName'] ?></b></span>
                    <span><?= $BasicDetails['designations'] ?></span>
                    <?php if($BasicDetails['Status'] == "Working"){ ?>
                        <span class="active">Active 🟢</span>
                    <?php }else{ ?>
                        <span class="inactive">InActive 🔴</span>
                    <?php } ?>
                </div>
            </div>
            <div class="col col-lg-2 col-md-1 rep">
                <span>Reporting To</span><br>
                <span><strong>Abijith</strong></span><br>
                <span>Product Head</span>
            </div>
        </div>
        <hr class="mt-1 md-1">
        <div class="row me-0 ms-0 mt-1">
            <nav class="nav nav-pills flex-column flex-sm-row">
                <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/'.$BasicDetails['EmployeeId']);?>">Basic Details</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/'.$BasicDetails['EmployeeId'].'?trickId=2');?>">Work Details</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/'.$BasicDetails['EmployeeId'].'?trickId=3');?>">Approvals</a>
                <a class="flex-sm-fill text-sm-center nav-link active" href="<?php echo base_url('editEmp-view/'.$BasicDetails['EmployeeId'].'?trickId=4');?>">Attanance</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/'.$BasicDetails['EmployeeId'].'?trickId=5');?>">Late Entry</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/'.$BasicDetails['EmployeeId'].'?trickId=6');?>">Time Logs</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/'.$BasicDetails['EmployeeId'].'?trickId=7');?>">Pay slip</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/'.$BasicDetails['EmployeeId'].'?trickId=8');?>">Files</a>
            </nav>
        </div>
    </div>

    

    <div class="attendence ms-4 mt-3">
                <div class="row ms-0 me-0 mt-3 pt-2">
                    <div class="col col-lg-4 mt-1">
                        <span>Total Working Days <b>40</b></span>
                        <span>Absent <b>04</b></span>
                    </div>
                    <div class="col col-lg-8">
                        <div class="action">
                            <i class="fa-solid fa-calendar-days" 
                                style=""></i>
                            <input class="form-control" 
                                   type="text" 
                                   value="11/08/2024 - 11/08/2024" 
                                   style="padding-left: 35px; box-sizing: border-box;">
                            <button class="btn btn-primary" style="margin-left: 10px;">Check</button>
                        </div>
                    </div>
                </div>
                <table class="table table-hover mt-2">
                    <thead class="table-secondary">
                        <tr>
                            <td class="ps-3">S.No</td>
                            <td>Case Reason</td>
                            <td>Leave Type</td>
                            <td>Leave period</td>
                            <td>Days/Hours Taken</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-3">01</td>
                            <td>Family Function</td>
                            <td>Casual Leave</td>
                            <td>11/11/2024 - 13/11/2024</td>
                            <td>1 days</td>
                        </tr>
                        <tr>
                            <td class="ps-3">02</td>
                            <td>Due to Health Issue</td>
                            <td>Leave</td>
                            <td>11/11/2024 - 13/11/2024</td>
                            <td>3 Days</td>
                        </tr>
                    </tbody>
                </table>
            </div>
   



<?php echo ($this->endSection()) ?>