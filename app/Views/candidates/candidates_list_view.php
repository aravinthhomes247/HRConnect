<?php $session = \Config\Services::session(); ?>
<?php echo ($this->extend("layouts/header-new")) ?>
<?php echo ($this->section("body")) ?>

<input type="hidden" id="trickid" value="<?php echo $trickid ?>">
<input type="hidden" id="filter_s_date_1" value="<?= $filter_s_date_1 ?>">
<input type="hidden" id="filter_e_date_1" value="<?= $filter_e_date_1 ?>">
<input type="hidden" id="filter_s_date_2" value="<?= $filter_s_date_2 ?>">
<input type="hidden" id="filter_e_date_2" value="<?= $filter_e_date_2 ?>">
<input type="hidden" id="filter_hr" value="<?= $filter_hr ?>">
<input type="hidden" id="filter_designation" value="<?= $filter_designation ?>">
<input type="hidden" id="filter_source" value="<?= $filter_source ?>">
<input type="hidden" id="filter_reason" value="<?= $filter_reason ?>">
<input type="hidden" id="assign_filter_source">

<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
}
?>

<style>
    /* .dt-container.dt-bootstrap5.dt-empty-footer {
        font-size: x-small;
    } */

    .upload .file .name {
        background-color: #C7BCD747;
        border: 1px solid #8146d4;
        padding: 5px 5px;
        border-radius: 4px;
    }

    .modal-dialog {
        max-width: 80% !important;
    }

    .modal-body label {
        color: #465266;
        font-weight: 500;
    }

    .modal-body .form-group i {
        color: #8045d2;
        cursor: pointer;
    }

    button.close {
        color: #8045d2;
        border-radius: 50%;
        padding: 3px 10px;
        border-color: #8045d2;
    }

    .modal-header {
        text-align: center;
        background-color: #925EDD14;
    }

    .modal-footer,
    .modal-body {
        justify-content: center;
    }

    .form-check {
        width: 145px !important;
    }

    .table-modal {
        text-align: center;
    }

    table.table-hover.dataTable.no-footer {
        width: 100% !important;
    }

    .reportrange-column {
        visibility: hidden;
        width: 1px;
    }

    table.dataTable th.dt-type-numeric,
    table.dataTable th.dt-type-date,
    table.dataTable td.dt-type-numeric,
    table.dataTable td.dt-type-date {
        text-align: left;
    }


    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .dt-column-order:before {
        display: none !important;
    }

    table.dataTable {
        border-collapse: collapse;
        width: 100%;
    }

    table.dataTable th,
    table.dataTable td {
        border: 1px solid #ced4da;
        padding: 5px;
    }

    .chip {
        display: inline-block;
        padding: 0px 5px;
        /* height: 27px; */
        /* font-size: 15px; */
        line-height: 25px;
        border-radius: 25px;
        color: #8146D4;
        background-color: #F0E5FF;
        margin-right: 4px;
        /* margin-top: 4px; */
    }

    .closebtn {
        padding-left: 10px;
        color: #8146D4;
        font-weight: 900;
        float: right;
        font-size: 15px;
        cursor: pointer;
    }

    .closebtn:hover {
        color: #000;
    }

    .Search {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        font-weight: 700;
        border: none;
        color: #0b3544;
        text-align: left;
        padding-left: 0.2em;
        cursor: pointer;
        width: 100%;
        background-color: transparent;
    }

    .Search:focus {
        outline: none;
        border: none;
        box-shadow: none;
    }

    .select-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .dataTF-icon {
        position: absolute;
        right: 2px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .input-group {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
        color: #ccc;
        background-color: #F7F7F8;
        border: none;
    }

    .sheduleoptions {
        display: flex;
        text-align: center;
        width: 100%;
        justify-content: center;
    }

    .sheduleoptions .tabs {
        background-color: #E8E8EA;
        width: max-content;
        border-radius: 6px;
        padding: 0%;
    }

    .sheduleoptions .tabs .active {
        color: white;
        background-color: #98A2B3;
    }

    .sint .input-group input {
        box-shadow: none !important;
    }

    .sint .input-group {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 2px;
        overflow: hidden;
        width: 25%;
        padding: 0;
    }

    .sint i {
        color: #8146D4;
    }

    .nint {
        justify-content: center;
    }

    .nint .callback i {
        color: #8146D4;
    }

    .nint textarea {
        width: 95%;
    }

    .nint .input-group {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 2px;
        overflow: hidden;
        width: 95%;
        padding: 0;
    }

    .nint i {
        color: #8146D4;
    }

    .nint .form-check {
        width: auto !important;
    }

    a.excelfile {
        color: #8146d4;
        border: 1px solid #8146d4;
        width: max-content !important;
        padding: 5px 10px !important;
    }

    a.excelfile:hover {
        color: #8146d4;
        border: 1px solid #8146d4;
        width: max-content !important;
        padding: 5px 10px !important;
    }

    input[type="time"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }

    input[type="time"] {
        text-indent: 1px;
    }
</style>

<div class="career ms-4">
    <div class="row ms-0 me-0 pt-2 mt-2">
        <div class="col col-lg-7">
            <div class="d-flex justify-content-start">
                <div class="form-group ml-1">
                    <div class="input-group" id="filter-group">
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-lg-5 end-buttons">
            <?php if ($trickid != 11 && $trickid != 9) { ?>
                <!-- <a href="javascript:void(0);" class="yta me-2" data-bs-toggle="modal" data-bs-target="#reassignModalCenter"> Re Assign</a> -->
                <a href="javascript:void(0);" class="yta me-2" data-bs-toggle="modal" data-bs-target="#assignModalCenter"> <span><?= $yetToAssignCount[0]['Count'] ?></span> - Yet to Assign</a>
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#AddcandidateModalCenter"><i class="fa-solid fa-plus"></i> Add Candidates</a>
            <?php } ?>
        </div>
    </div>
    <?php
    if ($session->getFlashdata('CanidateSuccessMsg')) { ?>
        <div class="col-lg-12">
            <div class="alert alert-success bg-orange alert-dismissible fade show" role="alert">
                <strong><?= $session->getFlashdata('CanidateSuccessMsg') ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    <?php } ?>
    <div class="cantabs me-0 mt-2 pt-2 pb-2 mt-4">
        <div class="tabs ms-1 me-1">
            <?php if ($trickid != 11 && $trickid != 9) { ?>
                <a href="#" class="tab disabled" id="trackid-12" data-trackid="12">Untouched-<span id="Tit-count-12"></span></a>
                <a href="#" class="tab disabled" id="trackid-1" data-trackid="1">Scheduled-<span id="Tit-count-1"></span></a>
                <a href="#" class="tab disabled" id="trackid-15" data-trackid="15">Arrived-<span id="Tit-count-15"></span></a>
                <a href="#" class="tab disabled" id="trackid-2" data-trackid="2">Not Scheduled-<span id="Tit-count-2"></span></a>
                <a href="#" class="tab disabled" id="trackid-4" data-trackid="4">Selected-<span id="Tit-count-4"></span></a>
                <a href="#" class="tab disabled" id="trackid-6" data-trackid="6">Hold-<span id="Tit-count-6"></span></a>
                <a href="#" class="tab disabled" id="trackid-5" data-trackid="5">Rejected-<span id="Tit-count-5"></span></a>
                <a href="#" class="tab disabled" id="trackid-8" data-trackid="8">Joined-<span id="Tit-count-8"></span></a>
                <a href="#" class="tab disabled" id="trackid-3" data-trackid="3">Junk-<span id="Tit-count-3"></span></a>
            <?php } else { ?>
                <h4><?php echo ($trickid == 11) ? 'Today Scheduled' : 'Upcoming Scheduled' ?> (<span id="Tit-count"></span>)</h4>
            <?php } ?>
        </div>
    </div>

    <div class="row ms-1 me-1 pt-2">
        <?php if (($trickid == 1)  || ($trickid == 9) || ($trickid == 10) || ($trickid == 11)) { ?>
            <table class="table table-hover ms-2" id="datatable">
                <thead class="table-secondary">
                    <tr>
                        <th>Sl No</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Source</th>
                        <th>
                            <div class="dates">
                                Interview Date
                                <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                <input type="text" class="reportrange-column" id="rangepicker-1" data-ffor="InterviewDate" data-fsfor="Interview Date" />
                            </div>
                        </th>
                        <th>Scheduled By</th>
                        <th>
                            <div class="dates">
                                Uploaded Date
                                <i class="far fa-calendar-alt calendar-icon" data-id="2" style="cursor: pointer;"></i>
                                <input type="text" class="reportrange-column" id="rangepicker-2" data-ffor="Created_at" data-fsfor="Uploaded Date" />
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
        <?php } else if ($trickid == 15) { ?>
            <table class="table table-hover ms-2" id="datatable">
                <thead class="table-secondary">
                    <tr>
                        <th>Sl No</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Source</th>
                        <th>
                            <div class="dates">
                                Interview Date
                                <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                <input type="text" class="reportrange-column" id="rangepicker-1" data-fsfor="Interview Date" />
                            </div>
                        </th>
                        <th>Interview Status</th>
                        <th>Scheduled By</th>
                        <th>
                            <div class="dates">
                                Uploaded Date
                                <i class="far fa-calendar-alt calendar-icon" data-id="2" style="cursor: pointer;"></i>
                                <input type="text" class="reportrange-column" id="rangepicker-2" data-fsfor="Uploaded Date" />
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
        <?php } else if (($trickid == 12) || ($trickid == 13) || ($trickid == 14)) { ?>
            <table class="table table-hover ms-2" id="datatable">
                <thead class="table-secondary">
                    <tr>
                        <th>Sl No</th>
                        <th>Name</th>
                        <th>Designations</th>
                        <th>Sources</th>
                        <th>
                            <div class="dates">
                                Uploaded Date
                                <i class="far fa-calendar-alt calendar-icon" data-id="2" style="cursor: pointer;"></i>
                                <input type="text" class="reportrange-column" id="rangepicker-2" data-ffor="UploadDate" data-fsfor="Uploaded Date" />
                            </div>
                        </th>
                        <th>Uploaded By</th>
                    </tr>
                </thead>
            </table>
        <?php } else if (($trickid == 2) || ($trickid == 16) || ($trickid == 17) || ($trickid == 18) || ($trickid == 3)) { ?>
            <table class="table table-hover ms-2" id="datatable">
                <thead class="table-secondary">
                    <tr>
                        <th>Sl No</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Source</th>
                        <?php if ($trickid == 3) { ?>
                            <th>
                                <div class="dates">
                                    Pushed Date
                                    <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                    <input type="text" class="reportrange-column" id="rangepicker-1" data-ffor="CallBackDateTime" data-fsfor="Pushed Date" />
                                </div>
                            </th>
                        <?php } else { ?>
                            <th>Reason </th>
                            <th>
                                <div class="dates">
                                    Follow up
                                    <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                    <input type="text" class="reportrange-column" id="rangepicker-1" data-ffor="CallBackDateTime" data-fsfor="Follow up" />
                                </div>
                            </th>
                        <?php } ?>
                        <th>Schedule By</th>
                        <th>
                            <div class="dates">
                                Uploaded Date
                                <i class="far fa-calendar-alt calendar-icon" data-id="2" style="cursor: pointer;"></i>
                                <input type="text" class="reportrange-column" id="rangepicker-2" data-ffor="Created_at" data-fsfor="Uploaded Date" />
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
        <?php } else if (($trickid == 4) || ($trickid == 5) || ($trickid == 6)) { ?>
            <table class="table table-hover ms-2" id="datatable">
                <thead class="table-secondary">
                    <tr>
                        <th>Sl No</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Source</th>
                        <th>Candidate Status</th>
                        <th>
                            <div class="dates">
                                Interview Date
                                <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                <input type="text" class="reportrange-column" id="rangepicker-1" data-fsfor="Interview Date" />
                            </div>
                        </th>
                        <th>Scheduled By</th>
                        <th>
                            <div class="dates">
                                Uploaded Date
                                <i class="far fa-calendar-alt calendar-icon" data-id="2" style="cursor: pointer;"></i>
                                <input type="text" class="reportrange-column" id="rangepicker-2" data-ffor="Created_at" data-fsfor="Uploaded Date" />
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
        <?php } else if ($trickid == 8) { ?>
            <table class="table table-hover ms-2" id="datatable">
                <thead class="table-secondary">
                    <tr>
                        <th>Sl No</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Source</th>
                        <th>
                            <div class="dates">
                                Interview Date
                                <i class="far fa-calendar-alt calendar-icon" data-id="1" style="cursor: pointer;"></i>
                                <input type="text" class="reportrange-column" id="rangepicker-1" data-ffor="A.InterviewDate" data-fsfor="Interview Date" />
                            </div>
                        </th>
                        <th>Joined Status</th>
                        <th>Added By</th>
                        <th>
                            <div class="dates">Joining Date
                                <i class="far fa-calendar-alt calendar-icon" data-id="2" style="cursor: pointer;"></i>
                                <input type="text" class="reportrange-column" id="rangepicker-2" data-ffor="D.JoiningDate" data-fsfor="Joining Date" />
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
        <?php } ?>
    </div>
</div>

<!-- Yet to Assign Modal -->
<div class="modal fade" id="assignModalCenter" tabindex="-1" role="dialog" aria-labelledby="assignModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="<?= site_url('/assignCandidates') ?>" method="post" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center">Assign the Candidates</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="form-group col-lg-3 me-2">
                        <label for="assignto">Assign To</label>
                        <select class="form-control" id="assignto" name="assignto" Required>
                            <option value="">--Select--</option>
                            <?php foreach ($HRList as $row) { ?>
                                <option value="<?php echo  $row["EmployeeId"] ?>"> <?php echo $row["EmployeeName"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-3 ms-5 me-5">
                        <label for="source">Source</label>
                        <select class="form-control" id="assignSource" name="assignSource" Required>
                            <option value="">--Select--</option>
                            <?php foreach ($socialMedia as $row) { ?>
                                <option value="<?= $row["SM_IDPK"] ?>"><?= $row["SM_Name"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-3 ms-2">
                        <label for="assignCount">Assign Count</label>
                        <select class="form-control" id="assignCount" name="assignCount" Required>
                            <option value="">--Select--</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-10 mt-3">
                        <table class="table table-hover table-modal" id="datatable11">
                            <thead>
                                <tr>
                                    <th>Sl no</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Source</th>
                                    <th>Uploaded By</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-primary" onclick="return funAssign()">Assign </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Re Assign Modal -->
<div class="modal" id="reassignModalCenter" tabindex="-1" aria-labelledby="assignModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= site_url('/reassignCandidates') ?>" method="post" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center">Re-Assign the Candidates</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="form-group col-lg-3">
                        <label for="assignto">Uploaded By</label>
                        <select class="form-control" id="reassignfrom" name="assignfrom">
                            <option>--Select--</option>
                            <?php foreach ($HRList as $row) { ?>
                                <option value="<?php echo  $row["EmployeeId"] ?>"> <?php echo $row["EmployeeName"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="source">Source</label>
                        <select class="form-control" id="reassignSource" name="assignSource">
                            <option>--Select--</option>
                            <?php foreach ($socialMedia as $row) { ?>
                                <option value="<?= $row["SM_IDPK"] ?>"><?= $row["SM_Name"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="assignto">Re Assign To</label>
                        <select class="form-control" id="reassignto" name="assignto">
                            <option>--Select--</option>
                            <?php foreach ($HRList as $row) { ?>
                                <option value="<?php echo  $row["EmployeeId"] ?>"> <?php echo $row["EmployeeName"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-lg">
                        <label for="assignCount">Assign Count</label>
                        <select class="form-control" id="reassignCount" name="assignCount" placeholder="Count">
                            <option value="">--Select--</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="form-group col-lg">
                        <label for="assignCount">Re Assign as</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reassignstatus" value="0" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">Fresh Candidates</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reassignstatus" value="1" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">Current Status</label>
                        </div>
                    </div>
                    <input type="hidden" name="trickid" value="<?= $trickid ?>">
                    <div class="form-group col-lg">
                        <table class="table table-hover table-modal" id="datatable1">
                            <thead>
                                <tr>
                                    <th>Sl no</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Source</th>
                                    <th><?php echo ($trickid != 12) ? 'Assign To' : 'Upload By' ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-primary" onclick="return funAssign() ">Re Assign </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Candidate Modal -->
<div class="modal" id="AddcandidateModalCenter" tabindex="-1" aria-labelledby="addcandidateModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= site_url('/store_candidate') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data" id="new-candidate">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center">Add New Candidate</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="form-group col-lg-3 me-2 mt-3">
                        <label class="form-label">Candidate Name</label>
                        <input class="form-control" type="text" name="CandidateName" id="CandidateName" placeholder="Enter Candidate Name" required>
                    </div>
                    <div class="form-group col-lg-3 ms-5 me-5 mt-3">
                        <label class="form-label">Contact Number</label>
                        <input class="form-control" type="text" name="CandidateContactNo" id="CandidateContactNo" placeholder="Enter Contact Number" required>
                    </div>
                    <div class="form-group col-lg-3 ms-2 mt-3">
                        <label class="form-label">Email ID</label>
                        <input class="form-control" type="email" name="CandidateEmail" id="CandidateEmail" placeholder="Enter Email ID" required>
                    </div>
                    <div class="form-group col-lg-3 me-2 mt-3">
                        <label class="form-label">Source</label>
                        <select class="form-control" name="Source" id="Source" required>
                            <option value="">Select Source</option>
                            <?php
                            if ($socialMedia) {
                                foreach ($socialMedia as $row) { ?>
                                    <option value="<?= $row["SM_IDPK"] ?>"> <?= $row["SM_Name"] ?> </option>
                            <?php   }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-3 ms-5 me-5 mt-3">
                        <label class="form-label">Position Applied For</label>
                        <select class="form-control" name="CandidatePosition" id="CandidatePosition" required>
                            <option value="">Select Position</option>
                            <?php
                            if ($selectdesignation) {
                                foreach ($selectdesignation as $row) { ?>
                                    <option value="<?= $row["IDPK"] ?>"><?= $row["designations"] ?></option>
                            <?php   }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-3 ms-2 mt-3">
                        <label class="form-label">Upload Resume </label> <i class="fa-solid fa-circle-plus addresumebtn"></i>
                        <input class="form-control" type="file" name="Resumefileinput" id="Resumefileinput" accept="application/pdf" style="display:none;" required>
                        <div class="upload" id="upload"></div>
                    </div>
                    <div class="sheduleoptions mt-3">
                        <div class="tabs">
                            <button type="button" class="btn active" id="scheduleBtn">Schedule</button>
                            <button type="button" class="btn" id="notScheduledBtn">Not Schedule</button>
                            <input type="hidden" name="scheduled" id="scheduled" value="1">
                        </div>
                    </div>
                    <div class="sint mt-4 ms-3" id="sint">
                        <div class="pt-1" style="display: flex;justify-content: center;">
                            <input type="hidden" name="InterviewDate" id="InterviewDate">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                <input type="text" id="IntDate1" class="form-control IntDate" placeholder="Select a Date">
                            </div>
                            <div class="input-group ms-4">
                                <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                <input type="time" id="IntTime1" class="form-control IntTime" placeholder="Select a Time">
                            </div>
                        </div>
                    </div>
                    <div class="nint mt-4" id="nint" style="display:none;">
                        <div class="row ms-5 ps-5">
                            <div class="col col-lg-5">
                                <?php
                                $i = 1;
                                if ($notScheduleReasons) {
                                    foreach ($notScheduleReasons as $row) { ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="NotScheduled" id="notscheduled<?= $i++ ?>" value="<?= $row["NS_IDPK"] ?>">
                                            <label class="form-check-label" for="inlineRadio1"><?= $row["NS_Reasons"] ?></label>
                                        </div>
                                <?php }
                                } ?>
                                <div class="callback mt-2" id="callback" style="display: none;">
                                    <h6 class="ms-1">Call Back Date</h6>
                                    <input type="hidden" name="CallBackDateTime" id="CallBackDateTime" />
                                    <div class="input-group ms-2">
                                        <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                        <input type="text" id="IntDate2" class="form-control IntDate" placeholder="Select a Date">
                                    </div>
                                    <div class="input-group ms-2 mt-3">
                                        <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                        <input type="time" id="IntTime2" class="form-control IntTime" placeholder="Select a Time">
                                    </div>
                                </div>
                            </div>

                            <div class="col col-lg-6 ms-2">
                                <h5 class="ms-1">Candidate Remarks</h5>
                                <textarea class="form-control ms-1" name="CandidateReason" rows="4" id="remarks" placeholder="Write a Remark..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col col-lg-5">
                        </div>
                        <div class="col col-lg-1">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div class="col col-lg-5 text-end">
                            <a href="javascript:void(0);" class="btn excelfile" data-bs-toggle="modal" data-bs-target="#upload_excel_file"><i class="fa-solid fa-plus"></i> Add Excel File</a>
                        </div>
                        <div class="col col-lg-1">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Candidate by Excel Modal -->
<div class="modal modal-sm fade" id="upload_excel_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-upload-candidate" action="<?= site_url('/store_candidate_excelfile') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Add New Candidates through Excel File</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body row">
                    <div class="sub-result"></div>
                    <div class="custom-file w-50">
                        <label class="custom-file-label" for="customFile">Choose file (.csv)</label>
                        <input type="file" class="form-control custom-file-input" id="customFile" name="file" accept=".csv" required>
                        <!-- <p class="ml-1 mt-1" id="fileType" style="font-size:14px;color:red;">Upload file format: .csv</p> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnUpload">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.IntTime').forEach(function(input) {
        input.addEventListener('click', function() {
            this.showPicker();
        });
    });

    document.getElementById('scheduleBtn').addEventListener('click', function() {
        this.classList.add('active');
        document.getElementById('notScheduledBtn').classList.remove('active');
        document.getElementById('sint').style.display = 'block';
        document.getElementById('nint').style.display = 'none';
        document.getElementById('scheduled').setAttribute('value', 1);
    });

    document.getElementById('notScheduledBtn').addEventListener('click', function() {
        this.classList.add('active');
        document.getElementById('scheduleBtn').classList.remove('active');
        document.getElementById('sint').style.display = 'none';
        document.getElementById('nint').style.display = 'block';
        document.getElementById('scheduled').setAttribute('value', 2);
    });

    const radioButtons = document.getElementsByName('NotScheduled');
    const callbackDiv = document.getElementById('callback');
    radioButtons.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.id === 'notscheduled4' || this.id === 'notscheduled5' || this.id === 'notscheduled6') {
                callbackDiv.style.display = 'block';
            } else {
                callbackDiv.style.display = 'none';
            }
        });
    });


    $(document).ready(function() {
        // Initialize...
        var error = '<?= session()->getFlashdata('Error') ?? '' ?>';
        error = error.trim();
        if(error){
            Swal.fire(error);
        }
        
        var trickid = document.getElementById("trickid").value;
        var DESIGNATIONS = <?php echo json_encode($DESIGNATIONS); ?>;
        var SOURCES = <?php echo json_encode($SOURCES); ?>;
        var HRS = <?php echo json_encode($HRS); ?>;
        var REASONS = <?php echo json_encode($REASONS); ?>;
        var INT_STATUS = <?php echo json_encode($INT_STATUS); ?>;
        var HTML = '';
        var FSD1FOR = '';
        var FSD2FOR = '';

        $('.excelfile').on("click", function() {
            $('#upload_excel_file').modal('show');
            $('#AddcandidateModalCenter .close').click();
        });

        $('.addresumebtn').on("click", function() {
            $('#Resumefileinput').click();
        });

        $('#Resumefileinput').on("change", function() {
            const files = this.files;
            var name;
            Array.from(files).forEach(file => {
                name = file.name;
            });
            var HTML = `<div class="file">
                            <div class="name"> <span> ` + name + ` </span></div>
                        </div>`;
            $('#upload').html(HTML);
        });

        $('.IntDate').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minDate: moment(),
            locale: {
                format: 'YYYY/MM/DD'
            }
        });

        $('#IntDate1').on('change', function() {
            var val = $('#IntDate1').val() + ' ' + $('#IntTime1').val();
            $('#InterviewDate').val(val);
        });

        $('#IntTime1').on('change', function() {
            var val = $('#IntDate1').val() + ' ' + $('#IntTime1').val();
            $('#InterviewDate').val(val);
        });

        $('#IntDate2').on('change', function() {
            var val = $('#IntDate2').val() + ' ' + $('#IntTime2').val();
            $('#CallBackDateTime').val(val);
        });

        $('#IntTime2').on('change', function() {
            var val = $('#IntDate2').val() + ' ' + $('#IntTime2').val();
            $('#CallBackDateTime').val(val);
        });

        // Active the Tabs......
        $('a.tab').filter(function() {
            return $(this).data('trackid') == trickid;
        }).addClass('active');

        // Filter chips initialize....
        if ($('#filter_s_date_1').val() != '') {
            if (trickid == 13) {
                FSD1FOR = 'Uploaded Date';
            } else if (trickid == 1) {
                FSD1FOR = 'Interview Date';
            } else if (trickid == 2) {
                FSD1FOR = 'Follow up';
            } else if (trickid == 3) {
                FSD1FOR = 'Pushed Date';
            } else if (trickid == 4) {
                FSD1FOR = 'Interview Date';
            } else if (trickid == 5) {
                FSD1FOR = 'Interview Date';
            } else if (trickid == 15) {
                FSD1FOR = 'Interview Date';
            } else if (trickid == 6) {
                FSD1FOR = 'Interview Date';
            } else if (trickid == 8) {
                FSD1FOR = 'Interview Date';
            }
            HTML = `<div class="chip fc-date-1">
                    ` + FSD1FOR + ' ' + $('#filter_s_date_1').val() + ` to ` + $('#filter_e_date_1').val() + `<span class="closebtn" data-element="#rangepicker-1" onclick="this.parentElement.style.display='none'">&times;</span>
                </div>`;
            $('#filter-group').append(HTML);
        }
        if ($('#filter_s_date_2').val() != '') {
            if (trickid == 8) {
                FSD2FOR = 'Joining Date';
            } else {
                FSD2FOR = 'Uploaded Date';
            }
            HTML = `<div class="chip fc-date-2">
                    ` + FSD2FOR + ' ' + $('#filter_s_date_2').val() + ` to ` + $('#filter_e_date_2').val() + `<span class="closebtn" data-element="#rangepicker-2" onclick="this.parentElement.style.display='none'">&times;</span>
                </div>`;
            $('#filter-group').append(HTML);
        }
        if ($('#filter_designation').val() != '') {
            HTML = `<div class="chip fc-designation">
                    ` + $('#filter_designation').val() + `<span class="closebtn" data-element=".SelectedFiltervalue-1" onclick="this.parentElement.style.display='none'">&times;</span>
                </div>`;
            $('#filter-group').append(HTML);
        }
        if ($('#filter_source').val() != '') {
            HTML = `<div class="chip fc-source">
                    ` + $('#filter_source').val() + `<span class="closebtn" data-element=".SelectedFiltervalue-2" onclick="this.parentElement.style.display='none'">&times;</span>
                </div>`;
            $('#filter-group').append(HTML);
        }
        if ($('#filter_hr').val() != '') {
            HTML = `<div class="chip fc-hr">
                    ` + $('#filter_hr').val() + `<span class="closebtn" data-element=".SelectedFiltervalue-3" onclick="this.parentElement.style.display='none'">&times;</span>
                </div>`;
            $('#filter-group').append(HTML);
        }
        if ($('#filter_reason').val() != '') {
            if (trickid == 15) {
                var val = $('#filter_reason').val();
                if (val == 10) {
                    var text = 'Initial Review';
                } else if (val == 1) {
                    var text = 'Round 1';
                } else if (val == 2) {
                    var text = 'Round 2';
                } else if (val == 3) {
                    var text = 'Round 3';
                } else if (val == 4) {
                    var text = 'Round 4';
                } else if (val == 5) {
                    var text = 'Round 5';
                } else if (val == 6) {
                    var text = 'Round 6';
                }
                HTML = `<div class="chip fc-reason">
                    ` + text + `<span class="closebtn" data-element=".SelectedFiltervalue-4" onclick="this.parentElement.style.display='none'">&times;</span>
                </div>`;
            } else {
                HTML = `<div class="chip fc-reason">
                    ` + $('#filter_reason').val() + `<span class="closebtn" data-element=".SelectedFiltervalue-4" onclick="this.parentElement.style.display='none'">&times;</span>
                </div>`;
            }
            $('#filter-group').append(HTML);
        }


        // Initialize TimePickers...
        $('#rangepicker-1').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });
        $('#rangepicker-2').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            },
            maxDate: moment(),
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });


        // Initialize DataTables...
        if ((trickid == 1) || (trickid == 9) || (trickid == 10) || (trickid == 11)) {
            var table = $('#datatable').DataTable({
                "paging": true,
                "info": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }],
                "ajax": {
                    "url": "<?= base_url() . '/data-candidate/load/candidate_list/' . $trickid ?>",
                    "type": "GET",
                    "data": function(d) {
                        d.s_date_1 = $('#filter_s_date_1').val();
                        d.e_date_1 = $('#filter_e_date_1').val();
                        d.s_date_2 = $('#filter_s_date_2').val();
                        d.e_date_2 = $('#filter_e_date_2').val();
                        d.d_value = $('#filter_designation').val();
                        d.s_value = $('#filter_source').val();
                        d.h_value = $('#filter_hr').val();
                    },
                    "error": function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error:", textStatus, errorThrown);
                    }
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        "data": "CandidateName",
                        "render": function(data, type, row) {
                            if (row.ScheduleStatus == 10) {
                                return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                            <br>
                                            <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                            } else {
                                return `<a href="<?php echo site_url('edit_candidate_view?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                            <br>
                                            <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                            }
                        }
                    },
                    {
                        "data": "CandidatePosition"
                    },
                    {
                        "data": "Source"
                    },
                    {
                        "data": "InterviewDate",
                        "render": function(data, type, row) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            const options = {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            };
                            let formattedDate = date.toLocaleDateString('en-US', options);
                            if (date.getHours() || date.getMinutes()) {
                                const hours = date.getHours() % 12 || 12;
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                formattedDate += ` ${hours}:${minutes}${ampm}`;
                            }
                            return formattedDate;
                        }
                    },
                    {
                        "data": "HRName"
                    },
                    {
                        "data": "Created_at",
                        "render": function(data, type, row) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            const options = {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            };
                            let formattedDate = date.toLocaleDateString('en-US', options);
                            if (date.getHours() || date.getMinutes()) {
                                const hours = date.getHours() % 12 || 12;
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                formattedDate += ` ${hours}:${minutes}${ampm}`;
                            }
                            return formattedDate;
                        }
                    }
                ],
                "drawCallback": function(settings) {
                    if (table.data().count() === 0) {
                        $('#datatable thead').hide();
                    } else {
                        $('#datatable thead').show();
                    }
                },
                "initComplete": function() {
                    // Create dropdown filter for "CandidatePosition" (Column 2)
                    this.api().columns(2).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-1" data-col="C.designations" ><option value=""> Designations</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        DESIGNATIONS.forEach(function(d) {
                            if ($('#filter_designation').val() === d.designations) {
                                select.append('<option value="' + d.designations + '" selected>' + d.designations + '</option>');
                            } else {
                                select.append('<option value="' + d.designations + '">' + d.designations + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Source" (Column 3)
                    this.api().columns(3).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-2" data-col="SM_Name" ><option value=""> Sources</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        SOURCES.forEach(function(d) {
                            if ($('#filter_source').val() === d.SM_Name) {
                                select.append('<option value="' + d.SM_Name + '" selected>' + d.SM_Name + '</option>');
                            } else {
                                select.append('<option value="' + d.SM_Name + '">' + d.SM_Name + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Scheduled By" (Column 5)
                    this.api().columns(5).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-3" data-col="UploadBy" ><option value=""> Uploaded By </option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        HRS.forEach(function(d) {
                            if ($('#filter_hr').val() === d.EmployeeName) {
                                select.append('<option value="' + d.EmployeeName + '" selected>' + d.EmployeeName + '</option>');
                            } else {
                                select.append('<option value="' + d.EmployeeName + '">' + d.EmployeeName + '</option>');
                            }
                        });
                    });
                }
            });

            var table111 = $('.modal #datatable1').DataTable({
                "paging": true,
                "info": true,
                "searching": false,
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }],
                "ajax": {
                    "url": "<?= base_url() . '/data-candidate/load/candidate_list/' . $trickid ?>",
                    "type": "GET",
                    "data": function(d) {
                        d.s_date_1 = $('#filter_s_date_1').val();
                        d.e_date_1 = $('#filter_e_date_1').val();
                        d.s_date_2 = $('#filter_s_date_2').val();
                        d.e_date_2 = $('#filter_e_date_2').val();
                        d.d_value = $('#filter_designation').val();
                        d.s_value = $('#filter_source').val();
                        d.h_value = $('#filter_hr').val();
                    },
                    "error": function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error:", textStatus, errorThrown);
                    }
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        "data": "CandidateName",
                        // "render": function(data, type, row) {
                        //     if (row.ScheduleStatus == 10) {
                        //         return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                        //     } else {
                        //         return `<a href="<?php echo site_url('edit_candidate_view?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                        //     }
                        // }
                    },
                    {
                        "data": "CandidatePosition"
                    },
                    {
                        "data": "Source"
                    },
                    {
                        "data": "HRName"
                    },
                ],
                "drawCallback": function(settings) {
                    if (table111.data().count() === 0) {
                        $('#datatable1 thead').hide();
                    } else {
                        $('#datatable1 thead').show();
                    }
                },
            });
        } else if (trickid == 15) {
            var table = $('#datatable').DataTable({
                "paging": true,
                "info": true,
                "processing": true,
                "serverSide": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }],
                "ajax": {
                    "url": "<?= base_url() . '/data-candidate/load/candidate_list/' . $trickid ?>",
                    "type": "GET",
                    "data": function(d) {
                        d.s_date_1 = $('#filter_s_date_1').val();
                        d.e_date_1 = $('#filter_e_date_1').val();
                        d.s_date_2 = $('#filter_s_date_2').val();
                        d.e_date_2 = $('#filter_e_date_2').val();
                        d.d_value = $('#filter_designation').val();
                        d.s_value = $('#filter_source').val();
                        d.h_value = $('#filter_hr').val();
                        d.reason = $('#filter_reason').val();
                    }
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        "data": "CandidateName",
                        "render": function(data, type, row) {
                            if (row.ScheduleStatus == 10) {
                                return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                            <br>
                                            <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                            } else {
                                return `<a href="<?php echo site_url('edit_candidate_view?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                            <br>
                                            <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                            }
                        }
                    },
                    {
                        "data": "CandidatePosition"
                    },
                    {
                        "data": "Source"
                    },
                    {
                        "data": "InterviewDate",
                        "render": function(data, type, row) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            const options = {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            };
                            let formattedDate = date.toLocaleDateString('en-US', options);
                            if (date.getHours() || date.getMinutes()) {
                                const hours = date.getHours() % 12 || 12;
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                formattedDate += ` ${hours}:${minutes}${ampm}`;
                            }
                            return formattedDate;
                        }
                    },
                    {
                        "data": "ScheduleStatus",
                        "render": function(data, type, row) {
                            if (row.ScheduleStatus == 10 && row.RoundID == 1) {
                                return 'Round 1 Completed';
                            } else if (row.ScheduleStatus == 10 && row.RoundID == 2) {
                                return 'Round 2 Completed';
                            } else if (row.ScheduleStatus == 10 && row.RoundID == 3) {
                                return 'Round 3 Completed';
                            } else if (row.ScheduleStatus == 10 && row.RoundID == 4) {
                                return 'Round 4 Completed';
                            } else if (row.ScheduleStatus == 10 && row.RoundID == 5) {
                                return 'Round 5 Completed';
                            } else if (row.ScheduleStatus == 10 && row.RoundID == 6) {
                                return 'Round 6 Completed';
                            } else if (row.ScheduleStatus == 10) {
                                return 'Initial Review';
                            }
                        }
                    },
                    {
                        "data": "HRName"
                    },
                    {
                        "data": "Created_at",
                        "render": function(data, type, row) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            const options = {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            };
                            let formattedDate = date.toLocaleDateString('en-US', options);
                            if (date.getHours() || date.getMinutes()) {
                                const hours = date.getHours() % 12 || 12;
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                formattedDate += ` ${hours}:${minutes}${ampm}`;
                            }
                            return formattedDate;
                        }
                    }
                ],
                "drawCallback": function(settings) {
                    if (table.data().count() === 0) {
                        $('#datatable thead').hide();
                    } else {
                        $('#datatable thead').show();
                    }
                },
                "initComplete": function() {
                    // Create dropdown filter for "CandidatePosition" (Column 2)
                    this.api().columns(2).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-1" data-col="C.designations" ><option value=""> Designations</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        DESIGNATIONS.forEach(function(d) {
                            if ($('#filter_designation').val() === d.designations) {
                                select.append('<option value="' + d.designations + '" selected>' + d.designations + '</option>');
                            } else {
                                select.append('<option value="' + d.designations + '">' + d.designations + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Source" (Column 3)
                    this.api().columns(3).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-2" data-col="SM_Name" ><option value=""> Sources</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        SOURCES.forEach(function(d) {
                            if ($('#filter_source').val() === d.SM_Name) {
                                select.append('<option value="' + d.SM_Name + '" selected>' + d.SM_Name + '</option>');
                            } else {
                                select.append('<option value="' + d.SM_Name + '">' + d.SM_Name + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Status" (Column 4)
                    this.api().columns(5).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-4" data-col="SM_Name" ><option value=""> Interview Status</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        INT_STATUS.forEach(function(d) {
                            if ($('#filter_reason').val() === d.id) {
                                select.append('<option value="' + d.id + '" selected>' + d.text + '</option>');
                            } else {
                                select.append('<option value="' + d.id + '">' + d.text + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Uploaded By" (Column 5)
                    this.api().columns(6).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-3" data-col="UploadBy" ><option value=""> Scheduled By </option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        HRS.forEach(function(d) {
                            if ($('#filter_hr').val() === d.EmployeeName) {
                                select.append('<option value="' + d.EmployeeName + '" selected>' + d.EmployeeName + '</option>');
                            } else {
                                select.append('<option value="' + d.EmployeeName + '">' + d.EmployeeName + '</option>');
                            }
                        });
                    });
                }
            });

            var table111 = $('.modal #datatable1').DataTable({
                "paging": true,
                "info": true,
                "searching": false,
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }],
                "ajax": {
                    "url": "<?= base_url() . '/data-candidate/load/candidate_list/' . $trickid ?>",
                    "type": "GET",
                    "data": function(d) {
                        d.s_date_1 = $('#filter_s_date_1').val();
                        d.e_date_1 = $('#filter_e_date_1').val();
                        d.s_date_2 = $('#filter_s_date_2').val();
                        d.e_date_2 = $('#filter_e_date_2').val();
                        d.d_value = $('#filter_designation').val();
                        d.s_value = $('#filter_source').val();
                        d.h_value = $('#filter_hr').val();
                    },
                    "error": function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error:", textStatus, errorThrown);
                    }
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        "data": "CandidateName",
                        // "render": function(data, type, row) {
                        //     if (row.ScheduleStatus == 10) {
                        //         return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                        //     } else {
                        //         return `<a href="<?php echo site_url('edit_candidate_view?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                        //     }
                        // }
                    },
                    {
                        "data": "CandidatePosition"
                    },
                    {
                        "data": "Source"
                    },
                    {
                        "data": "HRName"
                    },
                ],
                "drawCallback": function(settings) {
                    if (table111.data().count() === 0) {
                        $('#datatable1 thead').hide();
                    } else {
                        $('#datatable1 thead').show();
                    }
                },
            });
        } else if ((trickid == 12) || (trickid == 13) || (trickid == 14)) {
            var table = $('#datatable').DataTable({
                "paging": true,
                "info": true,
                "processing": true,
                "serverSide": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }],
                "ajax": {
                    "url": "<?= base_url() . '/data-candidate/load/candidate_list/' . $trickid ?>",
                    "type": "GET",
                    "data": function(d) {
                        d.s_date_1 = $('#filter_s_date_1').val();
                        d.e_date_1 = $('#filter_e_date_1').val();
                        d.s_date_2 = $('#filter_s_date_2').val();
                        d.e_date_2 = $('#filter_e_date_2').val();
                        d.d_value = $('#filter_designation').val();
                        d.s_value = $('#filter_source').val();
                        d.h_value = $('#filter_hr').val();
                    }
                },
                "columns": [{
                        "data": "CandidateName",
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "CandidateName",
                        "render": function(data, type, row) {
                            return `<a href="<?php echo site_url('scheducleCandidate?canId=') ?>${row.CandidateId}">${row.CandidateName}</a>
                                                <br>
                                                <span class="phone-no">${row.CandidateContactNo}</span>`;
                        }
                    },
                    {
                        "data": "CandidatePosition"
                    },
                    {
                        "data": "Source"
                    },
                    {
                        "data": "UploadDate",
                        "render": function(data, type, row) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            const options = {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            };
                            let formattedDate = date.toLocaleDateString('en-US', options);
                            if (date.getHours() || date.getMinutes()) {
                                const hours = date.getHours() % 12 || 12;
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                formattedDate += ` ${hours}:${minutes}${ampm}`;
                            }
                            return formattedDate;
                        }
                    },
                    {
                        "data": "UploadBy",
                        "render": function(data, type, row) {
                            if (row.UploadBy == null && row.AssignTo == null) {
                                return `Yet To Assign`;
                            } else if (row.UploadBy == null && row.AssignTo != null) {
                                return `Auto Assigned`;
                            } else {
                                return `${row.UploadBy}`;
                            }
                        }
                    }
                ],
                "drawCallback": function(settings) {
                    if (table.data().count() === 0) {
                        $('#datatable thead').hide();
                    } else {
                        $('#datatable thead').show();
                    }
                },
                "initComplete": function() {
                    // Create dropdown filter for "CandidatePosition" (Column 2)
                    this.api().columns(2).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-1" data-col="C.designations">' +
                            '<option value="">Designations</option>' +
                            '</select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        DESIGNATIONS.forEach(function(d) {
                            if ($('#filter_designation').val() === d.designations) {
                                select.append('<option value="' + d.designations + '" selected>' + d.designations + '</option>');
                            } else {
                                select.append('<option value="' + d.designations + '">' + d.designations + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Source" (Column 3)
                    this.api().columns(3).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-2" data-col="SM_Name" ><option value=""> Sources</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        SOURCES.forEach(function(d) {
                            if ($('#filter_source').val() === d.SM_Name) {
                                select.append('<option value="' + d.SM_Name + '" selected>' + d.SM_Name + '</option>');
                            } else {
                                select.append('<option value="' + d.SM_Name + '">' + d.SM_Name + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Uploaded By" (Column 5)
                    this.api().columns(5).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-3" data-col="UploadBy" ><option value=""> Uploaded By </option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        HRS.forEach(function(d) {
                            if ($('#filter_hr').val() === d.EmployeeName) {
                                select.append('<option value="' + d.EmployeeName + '" selected>' + d.EmployeeName + '</option>');
                            } else {
                                select.append('<option value="' + d.EmployeeName + '">' + d.EmployeeName + '</option>');
                            }
                        });
                        select.append('<option value="Auto Assigned"> Auto Assigned </option>');
                        select.append('<option value="Yet To Assign"> Yet to Assign </option>');
                    });
                }
            });

            var table111 = $('.modal #datatable1').DataTable({
                "paging": true,
                "info": true,
                "searching": false,
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }],
                "ajax": {
                    "url": "<?= base_url() . '/data-candidate/load/candidate_list/' . $trickid ?>",
                    "type": "GET",
                    "data": function(d) {
                        d.s_date_1 = $('#filter_s_date_1').val();
                        d.e_date_1 = $('#filter_e_date_1').val();
                        d.s_date_2 = $('#filter_s_date_2').val();
                        d.e_date_2 = $('#filter_e_date_2').val();
                        d.d_value = $('#filter_designation').val();
                        d.s_value = $('#filter_source').val();
                        d.h_value = $('#filter_hr').val();
                    },
                    "error": function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error:", textStatus, errorThrown);
                    }
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        "data": "CandidateName",
                        // "render": function(data, type, row) {
                        //     if (row.ScheduleStatus == 10) {
                        //         return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                        //     } else {
                        //         return `<a href="<?php echo site_url('edit_candidate_view?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                        //     }
                        // }
                    },
                    {
                        "data": "CandidatePosition"
                    },
                    {
                        "data": "Source"
                    },
                    {
                        "data": "UploadBy",
                        "render": function(data, type, row) {
                            if (row.UploadBy == null && row.AssignTo == null) {
                                return `Yet To Assign`;
                            } else if (row.UploadBy == null && row.AssignTo != null) {
                                return `Auto Assigned`;
                            } else {
                                return `${row.UploadBy}`;
                            }
                        }
                    },
                ],
                "drawCallback": function(settings) {
                    if (table111.data().count() === 0) {
                        $('#datatable1 thead').hide();
                    } else {
                        $('#datatable1 thead').show();
                    }
                },
            });
        } else if ((trickid == 2) || (trickid == 16) || (trickid == 17) || (trickid == 18)) {
            var table = $('#datatable').DataTable({
                "paging": true,
                "info": true,
                "processing": true,
                "serverSide": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }],
                "ajax": {
                    "url": "<?= base_url() . '/data-candidate/load/candidate_list/' . $trickid ?>",
                    "type": "GET",
                    "data": function(d) {
                        d.s_date_1 = $('#filter_s_date_1').val();
                        d.e_date_1 = $('#filter_e_date_1').val();
                        d.s_date_2 = $('#filter_s_date_2').val();
                        d.e_date_2 = $('#filter_e_date_2').val();
                        d.d_value = $('#filter_designation').val();
                        d.s_value = $('#filter_source').val();
                        d.h_value = $('#filter_hr').val();
                        d.reason = $('#filter_reason').val();
                    }
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        "data": "CandidateName",
                        "render": function(data, type, row) {
                            return `<a href="<?php echo site_url('scheducleCandidate?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                            <br>
                                            <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                        }
                    },
                    {
                        "data": "CandidatePosition"
                    },
                    {
                        "data": "Source"
                    },
                    {
                        "data": "NS_Reasons"
                    },
                    {
                        "data": "CallBack",
                        "render": function(data, type, row) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            const options = {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            };
                            let formattedDate = date.toLocaleDateString('en-US', options);
                            if (date.getHours() || date.getMinutes()) {
                                const hours = date.getHours() % 12 || 12;
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                formattedDate += ` ${hours}:${minutes}${ampm}`;
                            }
                            return formattedDate;
                        }
                    },
                    {
                        "data": "UploadBy"
                    },
                    {
                        "data": "Created_at",
                        "render": function(data, type, row) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            const options = {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            };
                            let formattedDate = date.toLocaleDateString('en-US', options);
                            if (date.getHours() || date.getMinutes()) {
                                const hours = date.getHours() % 12 || 12;
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                formattedDate += ` ${hours}:${minutes}${ampm}`;
                            }
                            return formattedDate;
                        }
                    }
                ],
                "drawCallback": function(settings) {
                    if (table.data().count() === 0) {
                        $('#datatable thead').hide();
                    } else {
                        $('#datatable thead').show();
                    }
                },
                "initComplete": function() {
                    // Create dropdown filter for "CandidatePosition" (Column 2)
                    this.api().columns(2).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-1" data-col="C.designations" ><option value=""> Designations</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        DESIGNATIONS.forEach(function(d) {
                            if ($('#filter_designation').val() === d.designations) {
                                select.append('<option value="' + d.designations + '" selected>' + d.designations + '</option>');
                            } else {
                                select.append('<option value="' + d.designations + '">' + d.designations + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Source" (Column 3)
                    this.api().columns(3).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-2" data-col="SM_Name" ><option value=""> Sources</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        SOURCES.forEach(function(d) {
                            if ($('#filter_source').val() === d.SM_Name) {
                                select.append('<option value="' + d.SM_Name + '" selected>' + d.SM_Name + '</option>');
                            } else {
                                select.append('<option value="' + d.SM_Name + '">' + d.SM_Name + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Reason" (Column 4)
                    this.api().columns(4).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-4" data-col="NS_Reasons" ><option value=""> Reasons</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        REASONS.forEach(function(d) {
                            if ($('#filter_reason').val() === d.NS_Reasons) {
                                select.append('<option value="' + d.NS_Reasons + '" selected>' + d.NS_Reasons + '</option>');
                            } else {
                                select.append('<option value="' + d.NS_Reasons + '">' + d.NS_Reasons + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Scheduled By" (Column 5)
                    this.api().columns(6).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-3" data-col="UploadBy" ><option value=""> Schedule By </option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        HRS.forEach(function(d) {
                            if ($('#filter_hr').val() === d.EmployeeName) {
                                select.append('<option value="' + d.EmployeeName + '" selected>' + d.EmployeeName + '</option>');
                            } else {
                                select.append('<option value="' + d.EmployeeName + '">' + d.EmployeeName + '</option>');
                            }
                        });
                    });
                }
            });

            var table111 = $('.modal #datatable1').DataTable({
                "paging": true,
                "info": true,
                "searching": false,
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }],
                "ajax": {
                    "url": "<?= base_url() . '/data-candidate/load/candidate_list/' . $trickid ?>",
                    "type": "GET",
                    "data": function(d) {
                        d.s_date_1 = $('#filter_s_date_1').val();
                        d.e_date_1 = $('#filter_e_date_1').val();
                        d.s_date_2 = $('#filter_s_date_2').val();
                        d.e_date_2 = $('#filter_e_date_2').val();
                        d.d_value = $('#filter_designation').val();

                        d.s_value = $('#filter_source').val();
                        d.h_value = $('#filter_hr').val();
                    },
                    "error": function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error:", textStatus, errorThrown);
                    }
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        "data": "CandidateName",
                        // "render": function(data, type, row) {
                        //     if (row.ScheduleStatus == 10) {
                        //         return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                        //     } else {
                        //         return `<a href="<?php echo site_url('edit_candidate_view?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                        //     }
                        // }
                    },
                    {
                        "data": "CandidatePosition"
                    },
                    {
                        "data": "Source"
                    },
                    {
                        "data": "assignTo"
                    },
                ],
                "drawCallback": function(settings) {
                    if (table111.data().count() === 0) {
                        $('#datatable1 thead').hide();
                    } else {
                        $('#datatable1 thead').show();
                    }
                },
            });
        } else if (trickid == 3) {
            var table = $('#datatable').DataTable({
                "paging": true,
                "info": true,
                "processing": true,
                "serverSide": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }],
                "ajax": {
                    "url": "<?= base_url() . '/data-candidate/load/candidate_list/' . $trickid ?>",
                    "type": "GET",
                    "data": function(d) {
                        d.s_date_1 = $('#filter_s_date_1').val();
                        d.e_date_1 = $('#filter_e_date_1').val();
                        d.s_date_2 = $('#filter_s_date_2').val();
                        d.e_date_2 = $('#filter_e_date_2').val();
                        d.d_value = $('#filter_designation').val();
                        d.s_value = $('#filter_source').val();
                        d.h_value = $('#filter_hr').val();
                    }
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        "data": "CandidateName",
                        "render": function(data, type, row) {
                            return `<a href="<?php echo site_url('scheducleCandidate?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                            <br>
                                            <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                        }
                    },
                    {
                        "data": "CandidatePosition"
                    },
                    {
                        "data": "Source"
                    },
                    {
                        "data": "CallBack",
                        "render": function(data, type, row) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            const options = {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            };
                            let formattedDate = date.toLocaleDateString('en-US', options);
                            if (date.getHours() || date.getMinutes()) {
                                const hours = date.getHours() % 12 || 12;
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                formattedDate += ` ${hours}:${minutes}${ampm}`;
                            }
                            return formattedDate;
                        }
                    },
                    {
                        "data": "assignTo"
                    },
                    {
                        "data": "Created_at",
                        "render": function(data, type, row) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            const options = {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            };
                            let formattedDate = date.toLocaleDateString('en-US', options);
                            if (date.getHours() || date.getMinutes()) {
                                const hours = date.getHours() % 12 || 12;
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                formattedDate += ` ${hours}:${minutes}${ampm}`;
                            }
                            return formattedDate;
                        }
                    }
                ],
                "drawCallback": function(settings) {
                    if (table.data().count() === 0) {
                        $('#datatable thead').hide();
                    } else {
                        $('#datatable thead').show();
                    }
                },
                "initComplete": function() {
                    // Create dropdown filter for "CandidatePosition" (Column 2)
                    this.api().columns(2).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-1" data-col="C.designations" ><option value=""> Designations</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        DESIGNATIONS.forEach(function(d) {
                            if ($('#filter_designation').val() === d.designations) {
                                select.append('<option value="' + d.designations + '" selected>' + d.designations + '</option>');
                            } else {
                                select.append('<option value="' + d.designations + '">' + d.designations + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Source" (Column 3)
                    this.api().columns(3).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-2" data-col="SM_Name" ><option value=""> Sources</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        SOURCES.forEach(function(d) {
                            if ($('#filter_source').val() === d.SM_Name) {
                                select.append('<option value="' + d.SM_Name + '" selected>' + d.SM_Name + '</option>');
                            } else {
                                select.append('<option value="' + d.SM_Name + '">' + d.SM_Name + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Added By" (Column 5)
                    this.api().columns(5).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-3" data-col="UploadBy" ><option value=""> Added By </option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        HRS.forEach(function(d) {
                            if ($('#filter_hr').val() === d.EmployeeName) {
                                select.append('<option value="' + d.EmployeeName + '" selected>' + d.EmployeeName + '</option>');
                            } else {
                                select.append('<option value="' + d.EmployeeName + '">' + d.EmployeeName + '</option>');
                            }
                        });
                    });
                }
            });
            var table111 = $('.modal #datatable1').DataTable({
                "paging": true,
                "info": true,
                "searching": false,
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }],
                "ajax": {
                    "url": "<?= base_url() . '/data-candidate/load/candidate_list/' . $trickid ?>",
                    "type": "GET",
                    "data": function(d) {
                        d.s_date_1 = $('#filter_s_date_1').val();
                        d.e_date_1 = $('#filter_e_date_1').val();
                        d.s_date_2 = $('#filter_s_date_2').val();
                        d.e_date_2 = $('#filter_e_date_2').val();
                        d.d_value = $('#filter_designation').val();

                        d.s_value = $('#filter_source').val();
                        d.h_value = $('#filter_hr').val();
                    },
                    "error": function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error:", textStatus, errorThrown);
                    }
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        "data": "CandidateName",
                        // "render": function(data, type, row) {
                        //     if (row.ScheduleStatus == 10) {
                        //         return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                        //     } else {
                        //         return `<a href="<?php echo site_url('edit_candidate_view?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                        //     }
                        // }
                    },
                    {
                        "data": "CandidatePosition"
                    },
                    {
                        "data": "Source"
                    },
                    {
                        "data": "assignTo"
                    },
                ],
                "drawCallback": function(settings) {
                    if (table111.data().count() === 0) {
                        $('#datatable1 thead').hide();
                    } else {
                        $('#datatable1 thead').show();
                    }
                },
            });
        } else if ((trickid == 4) || (trickid == 5) || (trickid == 6)) {
            var table = $('#datatable').DataTable({
                "paging": true,
                "info": true,
                "processing": true,
                "serverSide": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }],
                "ajax": {
                    "url": "<?= base_url() . '/data-candidate/load/candidate_list/' . $trickid ?>",
                    "type": "GET",
                    "data": function(d) {
                        d.s_date_1 = $('#filter_s_date_1').val();
                        d.e_date_1 = $('#filter_e_date_1').val();
                        d.s_date_2 = $('#filter_s_date_2').val();
                        d.e_date_2 = $('#filter_e_date_2').val();
                        d.d_value = $('#filter_designation').val();
                        d.s_value = $('#filter_source').val();
                        d.h_value = $('#filter_hr').val();
                    }
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        "data": "CandidateName",
                        "render": function(data, type, row) {
                            if ((row.InterviewStatus == 2) && (row.DVStatus == 2) || (row.OL_Status == 1)) {
                                return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                                    <br>
                                                    <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                            } else if ((row.InterviewStatus == 2) && (row.DVStatus == 2)) {
                                return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                                    <br>
                                                    <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                            } else if ((row.InterviewStatus == 2 || 3 || 4) || (row.DVStatus == 1)) {
                                return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                                    <br>
                                                    <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                            }
                        }
                    },
                    {
                        "data": "CandidatePosition"
                    },
                    {
                        "data": "Source"
                    },
                    {
                        "data": "JoiningStatus",
                        "render": function(data, type, row) {
                            if (row.JoiningStatus == 2) {
                                return '<span class="text-red">Candidate Not Joined</span>';
                            } else if (row.ConfirmStatus == 1) {
                                return '<span class="text-red">Waiting for Joining</span>';
                            } else if (row.ConfirmStatus == 2) {
                                return '<span class="text-red">Candidate Not-Confirmed</span>';
                            } else if ((row.DVStatus == 2) && (row.OL_Status == 1)) {
                                return '<span class="text-green">Offer Letter Sent</span>';
                            } else if (row.DVStatus == 2) {
                                return '<span class="text-green">Documents Verified</span>';
                            } else if (row.DVStatus == 1) {
                                return '<span class="text-red">Documents Rejected</span>';
                            } else if (row.InterviewStatus == 2) {
                                return '<span class="text-green">Selected by ' + row.InterviewerName + '</span>';
                            } else if (row.InterviewStatus == 3) {
                                return '<span class="text-orange">Hold by ' + row.InterviewerName + '</span>';
                            } else if (row.InterviewStatus == 4) {
                                return '<span class="text-red">Rejected by ' + row.InterviewerName + '</span>';
                            }
                        }
                    },
                    {
                        "data": "InterviewDate",
                        "render": function(data, type, row) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            const options = {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            };
                            let formattedDate = date.toLocaleDateString('en-US', options);
                            if (date.getHours() || date.getMinutes()) {
                                const hours = date.getHours() % 12 || 12;
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                formattedDate += ` ${hours}:${minutes}${ampm}`;
                            }
                            return formattedDate;
                        }
                    },
                    {
                        "data": "HRName"
                    },
                    {
                        "data": "Created_at",
                        "render": function(data, type, row) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            const options = {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            };
                            let formattedDate = date.toLocaleDateString('en-US', options);
                            if (date.getHours() || date.getMinutes()) {
                                const hours = date.getHours() % 12 || 12;
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                formattedDate += ` ${hours}:${minutes}${ampm}`;
                            }
                            return formattedDate;
                        }
                    }
                ],
                "drawCallback": function(settings) {
                    if (table.data().count() === 0) {
                        $('#datatable thead').hide();
                    } else {
                        $('#datatable thead').show();
                    }
                },
                "initComplete": function() {
                    // Create dropdown filter for "CandidatePosition" (Column 2)
                    this.api().columns(2).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-1" data-col="C.designations" ><option value=""> Designations</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        DESIGNATIONS.forEach(function(d) {
                            if ($('#filter_designation').val() === d.designations) {
                                select.append('<option value="' + d.designations + '" selected>' + d.designations + '</option>');
                            } else {
                                select.append('<option value="' + d.designations + '">' + d.designations + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Source" (Column 3)
                    this.api().columns(3).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-2" data-col="SM_Name" ><option value=""> Sources</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        SOURCES.forEach(function(d) {
                            if ($('#filter_source').val() === d.SM_Name) {
                                select.append('<option value="' + d.SM_Name + '" selected>' + d.SM_Name + '</option>');
                            } else {
                                select.append('<option value="' + d.SM_Name + '">' + d.SM_Name + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Scheduled By" (Column 5)
                    this.api().columns(6).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-3" data-col="UploadBy" ><option value=""> Uploaded By </option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        HRS.forEach(function(d) {
                            if ($('#filter_hr').val() === d.EmployeeName) {
                                select.append('<option value="' + d.EmployeeName + '" selected>' + d.EmployeeName + '</option>');
                            } else {
                                select.append('<option value="' + d.EmployeeName + '">' + d.EmployeeName + '</option>');
                            }
                        });
                    });
                }
            });
            var table111 = $('.modal #datatable1').DataTable({
                "paging": true,
                "info": true,
                "searching": false,
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }],
                "ajax": {
                    "url": "<?= base_url() . '/data-candidate/load/candidate_list/' . $trickid ?>",
                    "type": "GET",
                    "data": function(d) {
                        d.s_date_1 = $('#filter_s_date_1').val();
                        d.e_date_1 = $('#filter_e_date_1').val();
                        d.s_date_2 = $('#filter_s_date_2').val();
                        d.e_date_2 = $('#filter_e_date_2').val();
                        d.d_value = $('#filter_designation').val();
                        d.s_value = $('#filter_source').val();
                        d.h_value = $('#filter_hr').val();
                    },
                    "error": function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error:", textStatus, errorThrown);
                    }
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        "data": "CandidateName",
                        // "render": function(data, type, row) {
                        //     if (row.ScheduleStatus == 10) {
                        //         return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                        //     } else {
                        //         return `<a href="<?php echo site_url('edit_candidate_view?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                        //     }
                        // }
                    },
                    {
                        "data": "CandidatePosition"
                    },
                    {
                        "data": "Source"
                    },
                    {
                        "data": "HRName"
                    },
                ],
                "drawCallback": function(settings) {
                    if (table111.data().count() === 0) {
                        $('#datatable1 thead').hide();
                    } else {
                        $('#datatable1 thead').show();
                    }
                },
            });
        } else if (trickid == 8) {
            var table = $('#datatable').DataTable({
                "paging": true,
                "info": true,
                "processing": true,
                "serverSide": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }],
                "ajax": {
                    "url": "<?= base_url() . '/data-candidate/load/candidate_list/' . $trickid ?>",
                    "type": "GET",
                    "data": function(d) {
                        d.s_date_1 = $('#filter_s_date_1').val();
                        d.e_date_1 = $('#filter_e_date_1').val();
                        d.s_date_2 = $('#filter_s_date_2').val();
                        d.e_date_2 = $('#filter_e_date_2').val();
                        d.d_value = $('#filter_designation').val();
                        d.s_value = $('#filter_source').val();
                        d.h_value = $('#filter_hr').val();
                    }
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        "data": "CandidateName",
                        "render": function(data, type, row) {
                            return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>
                                        <br>
                                        <span class="phone-no">` + row.CandidateContactNo + `</span>`;
                        }
                    },
                    {
                        "data": "CandidatePosition"
                    },
                    {
                        "data": "Source"
                    },
                    {
                        "data": "InterviewDate",
                        "render": function(data, type, row) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            const options = {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            };
                            let formattedDate = date.toLocaleDateString('en-US', options);
                            if (date.getHours() || date.getMinutes()) {
                                const hours = date.getHours() % 12 || 12;
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                formattedDate += ` ${hours}:${minutes}${ampm}`;
                            }
                            return formattedDate;
                        }
                    },
                    {
                        "data": "WorkingStatus",
                        "render": function(data, type, row) {
                            if (row.WorkingStatus == 1) {
                                return '<span class="text-green"> Active</span>';
                            } else if (row.WorkingStatus == 2) {
                                return '<span class="text-orange"> InActive</span>';
                            } else if (row.WorkingStatus == 3) {
                                return '<span class="text-red"> Abscond</span>';
                            } else if (row.JoiningStatus == 1) {
                                return '<span class="text-green"> Joined</span>';
                            }
                        }
                    },
                    {
                        "data": "HRName"
                    },
                    {
                        "data": "JoiningDate",
                        "render": function(data, type, row) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            const options = {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            };
                            let formattedDate = date.toLocaleDateString('en-US', options);
                            if (date.getHours() || date.getMinutes()) {
                                const hours = date.getHours() % 12 || 12;
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
                                formattedDate += ` ${hours}:${minutes}${ampm}`;
                            }
                            return formattedDate;
                        }
                    },
                ],
                "drawCallback": function(settings) {
                    if (table.data().count() === 0) {
                        $('#datatable thead').hide();
                    } else {
                        $('#datatable thead').show();
                    }
                },
                "initComplete": function() {
                    // Create dropdown filter for "CandidatePosition" (Column 2)
                    this.api().columns(2).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-1" data-col="C.designations" ><option value=""> Designations</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        DESIGNATIONS.forEach(function(d) {
                            if ($('#filter_designation').val() === d.designations) {
                                select.append('<option value="' + d.designations + '" selected>' + d.designations + '</option>');
                            } else {
                                select.append('<option value="' + d.designations + '">' + d.designations + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Source" (Column 3)
                    this.api().columns(3).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-2" data-col="SM_Name" ><option value=""> Sources</option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        SOURCES.forEach(function(d) {
                            if ($('#filter_source').val() === d.SM_Name) {
                                select.append('<option value="' + d.SM_Name + '" selected>' + d.SM_Name + '</option>');
                            } else {
                                select.append('<option value="' + d.SM_Name + '">' + d.SM_Name + '</option>');
                            }
                        });
                    });
                    // Create dropdown filter for "Added By" (Column 5)
                    this.api().columns(6).every(function() {
                        var column = this;
                        var select = $('<select class="Search SelectedFiltervalue-3" data-col="UploadBy" ><option value=""> Added By </option></select>');
                        var select_w = $('<div class="select-wrapper"></div>')
                            .append(select)
                            .append('<i class="fa fa-filter filter-icon dataTF-icon" aria-hidden="true"></i>')
                            .appendTo($(column.header()).empty());
                        HRS.forEach(function(d) {
                            if ($('#filter_hr').val() === d.EmployeeName) {
                                select.append('<option value="' + d.EmployeeName + '" selected>' + d.EmployeeName + '</option>');
                            } else {
                                select.append('<option value="' + d.EmployeeName + '">' + d.EmployeeName + '</option>');
                            }
                        });
                    });
                }
            });

            var table111 = $('.modal #datatable1').DataTable({
                "paging": true,
                "info": true,
                "searching": false,
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }],
                "ajax": {
                    "url": "<?= base_url() . '/data-candidate/load/candidate_list/' . $trickid ?>",
                    "type": "GET",
                    "data": function(d) {
                        d.s_date_1 = $('#filter_s_date_1').val();
                        d.e_date_1 = $('#filter_e_date_1').val();
                        d.s_date_2 = $('#filter_s_date_2').val();
                        d.e_date_2 = $('#filter_e_date_2').val();
                        d.d_value = $('#filter_designation').val();
                        d.s_value = $('#filter_source').val();
                        d.h_value = $('#filter_hr').val();
                    },
                    "error": function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error:", textStatus, errorThrown);
                    }
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        "data": "CandidateName",
                        // "render": function(data, type, row) {
                        //     if (row.ScheduleStatus == 10) {
                        //         return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                        //     } else {
                        //         return `<a href="<?php echo site_url('edit_candidate_view?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                        //     }
                        // }
                    },
                    {
                        "data": "CandidatePosition"
                    },
                    {
                        "data": "Source"
                    },
                    {
                        "data": "UploadBy",
                        "render": function(data, type, row) {
                            if (row.UploadBy == null && row.AssignTo == null) {
                                return `Yet To Assign`;
                            } else if (row.UploadBy == null && row.AssignTo != null) {
                                return `Auto Assigned`;
                            } else {
                                return `${row.UploadBy}`;
                            }
                        }
                    },
                ],
                "drawCallback": function(settings) {
                    if (table111.data().count() === 0) {
                        $('#datatable1 thead').hide();
                    } else {
                        $('#datatable1 thead').show();
                    }
                },
            });
        }



        // Initialize modele(Assign) DataTables......
        var table1111 = $('.modal #datatable11').DataTable({
            "paging": true,
            "info": true,
            "searching": false,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "deferRender": true,
            "columnDefs": [{
                "orderable": false,
                "targets": '_all'
            }],
            "ajax": {
                "url": "<?= base_url() . '/data-candidate/load/Assign' ?>",
                "type": "GET",
                "data": function(d) {
                    d.source = $('#assign_filter_source').val();
                },
                "error": function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error:", textStatus, errorThrown);
                }
            },
            "columns": [{
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    "data": "CandidateName",
                    // "render": function(data, type, row) {
                    //     if (row.ScheduleStatus == 10) {
                    //         return `<a href="<?php echo site_url('interview_process?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                    //     } else {
                    //         return `<a href="<?php echo site_url('edit_candidate_view?canId=') ?>` + row.CandidateId + `">` + row.CandidateName + `</a>`;
                    //     }
                    // }
                },
                {
                    "data": "CandidatePosition"
                },
                {
                    "data": "Source"
                },
                {
                    "data": "UploadBy",
                    "render": function(data, type, row) {
                        if (row.UploadBy == null && row.AssignTo == null) {
                            return `Yet To Assign`;
                        } else if (row.UploadBy == null && row.AssignTo != null) {
                            return `Auto Assigned`;
                        } else {
                            return `${row.UploadBy}`;
                        }
                    }
                },
            ],
            "drawCallback": function(settings) {
                if (table1111.data().count() === 0) {
                    $('#datatable11 thead').hide();
                } else {
                    $('#datatable11 thead').show();
                }
            },
        });


        // Intialize counts.........
        table.on('xhr.dt', function(e, settings, json, xhr) {
            if (json && json.recordsFiltered !== undefined) {
                $('#Tit-count-' + trickid).html(json.recordsFiltered);
            }
            enable_tabs();

        });
        table.on('xhr.dt', function(e, settings, json, xhr) {
            if (json && json.alltrackidcounts !== undefined) {
                const trickIds = [1, 2, 3, 4, 5, 6, 8, 12, 15];
                trickIds.forEach(id => {
                    const countElement = $('#Tit-count-' + id);
                    if (trickid === id) {
                        countElement.html(json.recordsFiltered);
                    } else {
                        countElement.html(json.alltrackidcounts['t' + id]);
                    }
                });
            }
        });


        // Action for TimePickers........
        $('.calendar-icon').on('click', function() {
            var id = $(this).data('id');
            if (id == 1) {
                $('#rangepicker-1').trigger('click');
            } else {
                $('#rangepicker-2').trigger('click');
            }
        });
        $('#rangepicker-1').on('apply.daterangepicker', function(ev, picker) {
            $('#filter_s_date_1').val(picker.startDate.format('YYYY/MM/DD'));
            $('#filter_e_date_1').val(picker.endDate.format('YYYY/MM/DD'));
            $('.fc-date-1').hide();
            var HTML = `<div class="chip fc-date-1">
                            ` + $(this).data('fsfor') + ` ` + $('#filter_s_date_1').val() + ` to ` + $('#filter_e_date_1').val() + `<span class="closebtn" data-element="#rangepicker-1" onclick="this.parentElement.style.display='none'">&times;</span>
                        </div>`;
            $('#filter-group').append(HTML);
            url_change();
            disable_tabs();
            table.ajax.reload();
            table111.ajax.reload();
            assignfrom();
            source();
        });
        $('#rangepicker-1').on('cancel.daterangepicker', function(ev, picker) {
            $('#filter_s_date_1').val('');
            $('#filter_e_date_1').val('');
            picker.setStartDate(moment());
            picker.setEndDate(moment());
            $('.fc-date-1').hide();
            url_change();
            disable_tabs();
            table.ajax.reload();
            table111.ajax.reload();
            assignfrom();
            source();
        });
        $('#rangepicker-2').on('apply.daterangepicker', function(ev, picker) {
            $('#filter_s_date_2').val(picker.startDate.format('YYYY/MM/DD'));
            $('#filter_e_date_2').val(picker.endDate.format('YYYY/MM/DD'));
            $('.fc-date-2').hide();
            var HTML = `<div class="chip fc-date-2">
                            ` + $(this).data('fsfor') + ` ` + $('#filter_s_date_2').val() + ` to ` + $('#filter_e_date_2').val() + `<span class="closebtn" data-element="#rangepicker-2" onclick="this.parentElement.style.display='none'">&times;</span>
                        </div>`;
            $('#filter-group').append(HTML);
            url_change();
            disable_tabs();
            table.ajax.reload();
            table111.ajax.reload();
            assignfrom();
            source();
        });
        $('#rangepicker-2').on('cancel.daterangepicker', function(ev, picker) {
            $('#filter_s_date_2').val('');
            $('#filter_e_date_2').val('');
            picker.setStartDate(moment());
            picker.setEndDate(moment());
            $('.fc-date-2').hide();
            url_change();
            disable_tabs();

            table.ajax.reload();
            table111.ajax.reload();
            assignfrom();
            source();
        });


        // Filter Actions..............
        $('.table-hover').on('change', '.SelectedFiltervalue-1', function() {
            $('#filter_designation').val($(this).val());
            if ($(this).val() == null || $(this).val() === '') {
                $('.fc-designation').hide();
                HTML = '';
            } else {
                $('.fc-designation').hide();
                var HTML = `<div class="chip fc-designation">
                                ` + $(this).val() + `<span class="closebtn" data-element=".SelectedFiltervalue-1" onclick="this.parentElement.style.display='none'">&times;</span>
                            </div>`;
            }
            $('#filter-group').append(HTML);
            url_change();
            disable_tabs();
            table.ajax.reload();
            table111.ajax.reload();
            assignfrom();
            source();
        });
        $('.table-hover').on('change', '.SelectedFiltervalue-2', function() {
            $('#filter_source').val($(this).val());
            if ($(this).val() == null || $(this).val() === '') {
                $('.fc-source').hide();
                HTML = '';
            } else {
                $('.fc-source').hide();
                var HTML = `<div class="chip fc-source">
                                ` + $(this).val() + `<span class="closebtn" data-element=".SelectedFiltervalue-2" onclick="this.parentElement.style.display='none'">&times;</span>
                            </div>`;
            }
            $('#filter-group').append(HTML);
            url_change();
            disable_tabs();
            table.ajax.reload();
            table111.ajax.reload();
            assignfrom();
            source();
        });
        $('.table-hover').on('change', '.SelectedFiltervalue-3', function() {
            $('#filter_hr').val($(this).val());
            if ($(this).val() == null || $(this).val() === '') {
                $('.fc-hr').hide();
                HTML = '';
            } else {
                $('.fc-hr').hide();
                var HTML = `<div class="chip fc-hr">
                                ` + $(this).val() + `<span class="closebtn" data-element=".SelectedFiltervalue-3" onclick="this.parentElement.style.display='none'">&times;</span>
                            </div>`;
            }
            $('#filter-group').append(HTML);
            url_change();
            disable_tabs();
            table.ajax.reload();
            table111.ajax.reload();
            assignfrom();
            source();
        });
        $('.table-hover').on('change', '.SelectedFiltervalue-4', function() {
            $('#filter_reason').val($(this).val());
            if ($(this).val() == null || $(this).val() === '') {
                $('.fc-reason').hide();
                HTML = '';
            } else {
                $('.fc-reason').hide();
                if (trickid == 15) {
                    var val = $('#filter_reason').val();
                    if (val == 10) {
                        var text = 'Initial Review';
                    } else if (val == 1) {
                        var text = 'Round 1';
                    } else if (val == 2) {
                        var text = 'Round 2';
                    } else if (val == 3) {
                        var text = 'Round 3';
                    } else if (val == 4) {
                        var text = 'Round 4';
                    } else if (val == 5) {
                        var text = 'Round 5';
                    } else if (val == 6) {
                        var text = 'Round 6';
                    }
                    var HTML = `<div class="chip fc-reason">
                                ` + text + `<span class="closebtn" data-element=".SelectedFiltervalue-4" onclick="this.parentElement.style.display='none'">&times;</span>
                            </div>`;
                } else {
                    var HTML = `<div class="chip fc-reason">
                                ` + $(this).val() + `<span class="closebtn" data-element=".SelectedFiltervalue-4" onclick="this.parentElement.style.display='none'">&times;</span>
                            </div>`;
                }
            }
            $('#filter-group').append(HTML);
            url_change();
            disable_tabs();
            table.ajax.reload();
            table111.ajax.reload();
            assignfrom();
            source();
        });
        $('#filter-group').on("click", '.closebtn', function(ev, picker) {
            var element = $(this).data('element');
            if (element === '#rangepicker-1') {
                $('#filter_s_date_1').val('');
                $('#filter_e_date_1').val('');
                $(element).data('daterangepicker').setStartDate(moment());
                $(element).data('daterangepicker').setEndDate(moment());
                $('.fc-date-1').hide();
            } else if (element === '#rangepicker-2') {
                $('#filter_s_date_2').val('');
                $('#filter_e_date_2').val('');
                $(element).data('daterangepicker').setStartDate(moment());
                $(element).data('daterangepicker').setEndDate(moment());
                $('.fc-date-2').hide();
            } else if (element === '.SelectedFiltervalue-1') {
                $(element + ' option:first').prop('selected', true);
                $('#filter_designation').val('');
            } else if (element === '.SelectedFiltervalue-2') {
                $(element + ' option:first').prop('selected', true);
                $('#filter_source').val('');
            } else if (element === '.SelectedFiltervalue-3') {
                $(element + ' option:first').prop('selected', true);
                $('#filter_hr').val('');
            } else if (element === '.SelectedFiltervalue-4') {
                $(element + ' option:first').prop('selected', true);
                $('#filter_reason').val('');
            }
            url_change();
            disable_tabs();
            table.ajax.reload();
            table111.ajax.reload();
            assignfrom();
            source();
        });


        // Assign and Re Assign Model Actions.....................
        $('#assignfrom').on('change', function() {
            let val = $(this).val();
            assignfrom_by(val);
            url_change();
            table.ajax.reload();
            table1111.ajax.reload();
        });
        $('#assignSource').on('change', function() {
            let val = $(this).val();
            assign_source_by(val);
            url_change();
            table.ajax.reload();
            table1111.ajax.reload();
        });
        $('#reassignfrom').on('change', function() {
            let val = $(this).val();
            assignfrom_by(val);
            url_change();
            table.ajax.reload();
            table111.ajax.reload();
        });
        $('#reassignSource').on('change', function() {
            let val = $(this).val();
            source_by(val);
            url_change();
            table.ajax.reload();
            table111.ajax.reload();
        });


        // Data Changing Functions....
        url_change();
        disable_tabs();
        assignfrom();
        source();
    });

    function url_change() {
        window.history.replaceState(null, '', 'candidate?trickid=' + $('#trickid').val() + '&fs=' + $('#filter_source').val() + '&fd=' + $('#filter_designation').val() + '&hr=' + $('#filter_hr').val() + '&fsd-1=' + $('#filter_s_date_1').val() + '&fed-1=' + $('#filter_e_date_1').val() + '&fsd-2=' + $('#filter_s_date_2').val() + '&fed-2=' + $('#filter_e_date_2').val() + '&res=' + $('#filter_reason').val());

        $('#trackid-15').attr('href', "<?= site_url('/candidate?trickid=15') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=" + $('#filter_s_date_1').val() + "&fed-1=" + $('#filter_e_date_1').val() + "&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
        $('#trackid-6').attr('href', "<?= site_url('/candidate?trickid=6') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=" + $('#filter_s_date_1').val() + "&fed-1=" + $('#filter_e_date_1').val() + "&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
        $('#trackid-5').attr('href', "<?= site_url('/candidate?trickid=5') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=" + $('#filter_s_date_1').val() + "&fed-1=" + $('#filter_e_date_1').val() + "&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
        $('#trackid-4').attr('href', "<?= site_url('/candidate?trickid=4') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=" + $('#filter_s_date_1').val() + "&fed-1=" + $('#filter_e_date_1').val() + "&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
        $('#trackid-1').attr('href', "<?= site_url('/candidate?trickid=1') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=" + $('#filter_s_date_1').val() + "&fed-1=" + $('#filter_e_date_1').val() + "&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());

        $('#trackid-3').attr('href', "<?= site_url('/candidate?trickid=3') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=&fed-1=&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
        $('#trackid-2').attr('href', "<?= site_url('/candidate?trickid=2') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=&fed-1=&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
        $('#trackid-12').attr('href', "<?= site_url('/candidate?trickid=12') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=&fed-1=&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());

        $('#trackid-8').attr('href', "<?= site_url('/candidate?trickid=8') ?>" + "&fs=" + $('#filter_source').val() + "&fd=" + $('#filter_designation').val() + "&hr=" + $('#filter_hr').val() + "&fsd-1=" + $('#filter_s_date_1').val() + "&fed-1=" + $('#filter_e_date_1').val() + "&fsd-2=" + $('#filter_s_date_2').val() + "&fed-2=" + $('#filter_e_date_2').val());
    }

    function enable_tabs() {
        var trickid = document.getElementById("trickid").value;
        if (($('#filter_s_date_1').val() == '' || $('#filter_s_date_1').val() == null) || (trickid == 2 || trickid == 3 || trickid == 12)) {
            $('#trackid-12').removeClass('disabled');
            $('#trackid-2').removeClass('disabled');
            $('#trackid-3').removeClass('disabled');
        }
        if ($('#filter_s_date_2').val() == '' || $('#filter_s_date_2').val() == null || trickid == 8) {
            $('#trackid-8').removeClass('disabled');
        }
        $('#trackid-15').removeClass('disabled');
        $('#trackid-6').removeClass('disabled');
        $('#trackid-5').removeClass('disabled');
        $('#trackid-4').removeClass('disabled');
        $('#trackid-1').removeClass('disabled');
    }

    function disable_tabs() {
        var trickid = document.getElementById("trickid").value;
        if (($('#filter_s_date_1').val() != '' || $('#filter_s_date_1').val() != null) && (trickid != 2 && trickid != 3 && trickid != 12)) {
            $('#trackid-12').addClass('disabled');
            $('#trackid-2').addClass('disabled');
            $('#trackid-3').addClass('disabled');
        }
        if (($('#filter_s_date_2').val() != '' || $('#filter_s_date_2').val() != null) && trickid != 8) {
            $('#trackid-8').addClass('disabled');
        }
    }

    function assignfrom() {
        let assignhr = $('#filter_hr').val();
        var HRList = <?php echo json_encode($HRList) ?>;
        HRList.forEach(element => {
            if (element.EmployeeName === assignhr) {
                $('#reassignfrom').val(element.EmployeeId);
            }
        });
    }

    function assignfrom_by(Id) {
        if (Id === '--Select--') {
            $('#filter_hr').val('');
        } else {
            var HRList = <?php echo json_encode($HRList) ?>;
            HRList.forEach(element => {
                if (element.EmployeeId === Id) {
                    $('#filter_hr').val(element.EmployeeName);
                }
            });
        }
    }

    function source() {
        let assignsource = $('#filter_source').val();
        var socialMedia = <?php echo json_encode($socialMedia) ?>;
        socialMedia.forEach(element => {
            if (element.SM_Name === assignsource) {
                $('#reassignSource').val(element.SM_IDPK);
            }
        });
    }

    function source_by(Id) {
        if (Id === '--Select--') {
            $('#filter_source').val('');
        } else {
            var socialMedia = <?php echo json_encode($socialMedia) ?>;
            socialMedia.forEach(element => {
                if (element.SM_IDPK === Id) {
                    $('#filter_source').val(element.SM_Name);
                }
            });
        }
    }

    function assign_source_by(Id) {
        if (Id === '--Select--') {
            $('#assign_filter_source').val('');
        } else {
            var socialMedia = <?php echo json_encode($socialMedia) ?>;
            socialMedia.forEach(element => {
                if (element.SM_IDPK === Id) {
                    $('#assign_filter_source').val(element.SM_Name);
                }
            });
        }
    }
</script>

<?php echo ($this->endSection()) ?>