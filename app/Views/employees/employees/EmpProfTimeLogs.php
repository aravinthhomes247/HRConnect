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
                <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/'.$BasicDetails['EmployeeId'].'?trickId=4');?>">Attanance</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/'.$BasicDetails['EmployeeId'].'?trickId=5');?>">Late Entry</a>
                <a class="flex-sm-fill text-sm-center nav-link active" href="<?php echo base_url('editEmp-view/'.$BasicDetails['EmployeeId'].'?trickId=6');?>">Time Logs</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/'.$BasicDetails['EmployeeId'].'?trickId=7');?>">Pay slip</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="<?php echo base_url('editEmp-view/'.$BasicDetails['EmployeeId'].'?trickId=8');?>">Files</a>
            </nav>
        </div>
    </div>


    <div class="attendence ms-4 mt-3">
                <div class="row ms-0 me-0 mt-3 pt-2">
                    <div class="col col-lg-4 mt-1">
                    </div>
                    <div class="col col-lg-8">
                        <div class="action">
                            <i class="fa-solid fa-calendar-days"></i>
                            <input class="form-control" type="text" value="11/08/2024 - 11/08/2024"
                                style="padding-left: 35px; box-sizing: border-box;">
                            <button class="btn btn-primary" style="margin-left: 10px;">Check</button>
                        </div>
                    </div>
                </div>
                <table class="table table-hover mt-4 time-log">
                    <tbody>
                        <tr>
                            <td>
                                <div class="row ms-0 me-0">
                                    <div class="log-days-1">
                                        <span><b>SAT 09</b></span>
                                    </div>
                                    <div class="log-chart">
                                        <div class="row">
                                            <div class="info-dots ms-0 me-0 p-0">
                                                <div class="dots-start ms-2" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in 🟢"></div>
                                            </div>
                                            <div class="lines ms-0 me-0 p-0">
                                                <div class="progress-stacked">
                                                    <div class="progress" style="width: 15%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                    <div class="progress" style="width: 30%">
                                                        <div class="progress-bar gap"></div>
                                                    </div>
                                                    <div class="progress" style="width: 30%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                    <div class="progress" style="width: 20%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                    <div class="progress" style="width: 05%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="info-dots me-0 ms-0 p-0">
                                                <div class="dots-start ms-3" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="log-days-2">
                                        <span><b>08:30</b> Work Hrs</span>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="row ms-0 me-0">
                                    <div class="log-days-1">
                                        <span><b>SAT 09</b></span>
                                    </div>
                                    <div class="log-chart">
                                        <div class="row">
                                            <div class="info-dots ms-0 me-0 p-0">
                                                <div class="dots-end ms-2" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in 🔴"></div>
                                            </div>
                                            <div class="lines ms-0 me-0 p-0">
                                                <div class="progress-stacked">
                                                    <div class="progress" style="width: 15%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                    <div class="progress" style="width: 30%">
                                                        <div class="progress-bar gap"></div>
                                                    </div>
                                                    <div class="progress" style="width: 30%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                    <div class="progress" style="width: 20%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                    <div class="progress" style="width: 05%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="info-dots me-0 ms-0 p-0">
                                                <div class="dots-start ms-3" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="log-days-2">
                                        <span><b>08:30</b> Work Hrs</span>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="row ms-0 me-0">
                                    <div class="log-days-1">
                                        <span><b>SAT 09</b></span>
                                    </div>
                                    <div class="log-chart">
                                        <div class="row">
                                            <div class="info-dots ms-0 me-0 p-0">
                                                <div class="dots-start ms-2" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                            </div>
                                            <div class="lines ms-0 me-0 p-0">
                                                <div class="progress-stacked">
                                                    <div class="progress" style="width: 15%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                    <div class="progress" style="width: 30%">
                                                        <div class="progress-bar gap"></div>
                                                    </div>
                                                    <div class="progress" style="width: 30%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                    <div class="progress" style="width: 20%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                    <div class="progress" style="width: 05%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="info-dots me-0 ms-0 p-0">
                                                <div class="dots-end ms-3" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="log-days-2">
                                        <span><b>08:30</b> Work Hrs</span>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="row ms-0 me-0">
                                    <div class="log-days-1">
                                        <span><b>SAT 09</b></span>
                                    </div>
                                    <div class="log-chart">
                                        <div class="row">
                                            <div class="info-dots ms-0 me-0 p-0">
                                                <div class="dots-start ms-2" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                            </div>
                                            <div class="lines ms-0 me-0 p-0">
                                                <div class="progress-stacked">
                                                    <div class="progress" style="width: 15%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                    <div class="progress" style="width: 30%">
                                                        <div class="progress-bar gap"></div>
                                                    </div>
                                                    <div class="progress" style="width: 30%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                    <div class="progress" style="width: 20%">
                                                        <div class="dot-start" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                        <div class="progress-bar"></div>
                                                        <div class="dot-end" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                    <div class="progress" style="width: 05%">
                                                        <div class="progress-bar gap"></div>
                                                        <div class="dot-auto" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="info-dots me-0 ms-0 p-0">
                                                <div class="dots-auto ms-3" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-title="<h5>09:50AM</h5>Check-in "></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="log-days-2">
                                        <span><b>08:30</b> Work Hrs</span>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function () {
                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
                const tooltipList = [...tooltipTriggerList].map(el => {
                    const tooltip = new bootstrap.Tooltip(el, {
                        customClass: `${el.classList[0]}-tooltip`
                    });
                    return tooltip;
                });
            });
        </script>

<?php echo ($this->endSection()) ?>