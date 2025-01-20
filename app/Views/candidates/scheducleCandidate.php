<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>

<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
}
?>

<style>
    b.canelradio {
        padding: 10px;
    }

    input[type="time"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }

    input[type="time"] {
        text-indent: 1px;
    }

    .modal-header .close {
        color: #8045d2;
        border-radius: 50%;
        padding: 3px 10px;
        border-color: #8045d2;
    }

    .modal-header {
        background-color: #925EDD14;
    }

    .modal-footer,
    .modal-body {
        justify-content: center;
    }

    .ProfileEditBtn {
        color: #8146d4;
        border: 1px solid #8146d4;
        padding: 2px 15px !important;
        border-radius: 17px;
    }
</style>


<div class="schedule">
    <div class="row profile mt-2 mb-2 ms-3 me-4">
        <div class="col col-lg-4 mt-2">
            <h2><?= $candidate_details[0]['CandidateName'] ?? 'NA' ?></h2>
            <h5 class="mb-4"><?= $candidate_details[0]['designations'] ?? 'NA' ?></h5>
            <span><?= $candidate_details[0]['NS_Reasons'] ?? 'NA' ?></span>
        </div>
        <div class="col col-lg-6 mt-2">
            <div class="row">
                <div class="col">
                    <h5>Email</h5>
                    <p><?= $candidate_details[0]['CandidateEmail'] ?? 'NA' ?></p>
                </div>
                <div class="col">
                    <h5>Source</h5>
                    <p><?= $candidate_details[0]['SM_Name'] ?? 'NA' ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h5>Mobile Number</h5>
                    <p><?= $candidate_details[0]['CandidateContactNo'] ?? 'NA' ?></p>
                </div>
                <div class="col">
                    <h5>Interview Date</h5>
                    <p><?= $candidate_details[0]['InterviewDate'] ?? 'NA' ?></p>
                </div>
            </div>
        </div>
        <div class="col col-lg-2 mt-2">
            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#EditCandidate" class="ProfileEditBtn mb-3"><i class="fa-regular fa-pen-to-square"></i> Edit Details</a>
            <br>
            <br>
            <a href="<?= site_url('/public/Uploads/candidates/' . $candidate_details[0]['CandidateId'] . '/' . $candidate_details[0]['CandidateResume']) ?>" target="_blank" class="<?= ($candidate_details[0]['CandidateResume']) ? '':'disabled'?>"><span class="resume"><i class="fa-regular fa-eye"></i> View Resume</span></a>
        </div>
    </div>
    <div class="row status mt-2 ms-3 me-4 pb-3">
        <h4 class="mt-2">Update Candidate Status</h4>
        <div class="tabs ms-3">
            <button type="button" class="btn active" id="scheduleBtn">Schedule a Interview</button>
            <button type="button" class="btn " id="notScheduledBtn">Not Scheduled</button>
        </div>

        <form autocomplete="off" action="interviewScheduled" method="post">
            <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
            <div class="sint mt-4 ms-3" id="sint">
                <div class="row">
                    <input type="hidden" name="InterviewDate" id="InterviewDate" />
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                        <input type="text" id="IntDate1" class="form-control IntDate" placeholder="Select a Date">
                    </div>
                    <div class="input-group ms-4">
                        <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                        <input type="time" id="IntTime1" class="form-control IntTime" placeholder="Select a Time">
                    </div>
                </div>
                <div class="submit mt-3">
                    <button type="submit" class="btn smt">Submit</button>
                </div>
            </div>
        </form>

        <form action="interviewNotScheduled" method="post" autocomplete="off">
            <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
            <div class="nint" id="nint" style="display: none;">
                <div class="mb-3 mt-3 ms-1">
                    <?php
                    $i = 1;
                    if ($notScheduleReasons) {
                        foreach ($notScheduleReasons as $row) { ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="scheduled" id="scheduled<?= $i++ ?>" value="<?php echo $row["NS_IDPK"] ?>">
                                <label class="form-check-label" for="inlineRadio1"><?php echo $row["NS_Reasons"] ?></label>
                            </div>
                    <?php   }
                    } ?>
                </div>
                <div class="row">
                    <div class="col col-lg-5 callback" id="callback" style="display: none;">
                        <h5 class="ms-1">Call Back Date</h5>
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
                    <div class="col col-lg-7">
                        <h5 class="ms-1">Candidate Remarks</h5>
                        <textarea class="form-control ms-1" name="CandidateReason" rows="4" id="remarks" placeholder="Write a Remark..."></textarea>
                    </div>
                </div>
                <div class="submit mt-3">
                    <button type="submit" class="btn smt">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>



<div class="modal" tabindex="-1" id="EditCandidate">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center">Edit Candidate</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= site_url('/update_CandiProfile') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                <input type="hidden" name="returnurl" value="scheducleCandidate">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="CandidateName" value="<?= $candidate_details[0]['CandidateName'] ?>" placeholder="Enter Candidate Name" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Contact No</label>
                            <input type="number" class="form-control" name="CandidateContactNo" value="<?= $candidate_details[0]['CandidateContactNo'] ?>" placeholder="Enter Contact Number" required>
                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="CandidateEmail" value="<?= $candidate_details[0]['CandidateEmail'] ?>" placeholder="Enter Email" required>
                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label">Position applied for</label>
                            <select class="form-control" name="CandidatePosition" required>
                                <option value="">--Select--</option>
                                <?php if ($selectdesignation) {
                                    foreach ($selectdesignation as $row) { ?>
                                        <option value="<?= $row["IDPK"] ?>" <?= ($candidate_details[0]['CandidatePosition'] == $row["IDPK"]) ? "selected" : '' ?>><?= $row["designations"]; ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label">Education</label>
                            <input type="text" class="form-control" name="CandidateEducation" value="<?php echo $candidate_details[0]['CandidateEducation']; ?>" placeholder="Enter Education Qualification" required>
                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label">Experience</label>
                            <select class="form-control" name="exp" id="exp-type" required>
                                <option value="">--Select--</option>
                                <option value="1" id="fresher" <?= ($candidate_details[0]['CandidateExperience'] == 1) ? "selected" : '' ?>>Fresher</option>
                                <option value="2" id="experience" <?= ($candidate_details[0]['CandidateExperience'] == 2) ? "selected" : '' ?>>Experienced</option>
                            </select>
                        </div>

                        <div class="col-6 mb-3 EXP">
                            <input type="hidden" name="TotalExperience" id="TotalExperience" value="<?php echo $candidate_details[0]['TotalExperience'] ?>">
                            <?php
                            $val = isset($candidate_details[0]['TotalExperience']) ? $candidate_details[0]['TotalExperience'] : 0;
                            $a = floor($val); // Whole years
                            $b = round(($val - $a) * 12); // Remaining months, rounded to avoid precision issues
                            ?>
                            <label for="T-Experience" class="form-label">Total Experience</label>
                            <div class="input-group">
                                <!-- Year Dropdown -->
                                <select class="form-control" name="T-year" id="T-year" required>
                                    <option value="">Select Year</option>
                                    <?php for ($i = 1; $i <= 10; $i++): ?>
                                        <option value="<?= $i ?>" <?= ($a == $i) ? 'selected' : '' ?>>
                                            <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>
                                        </option>
                                    <?php endfor; ?>
                                    <option value="11" <?= ($a > 10) ? 'selected' : '' ?>>10+</option>
                                </select>
                                <!-- Month Dropdown -->
                                <select class="form-control" name="T-month" id="T-month" required>
                                    <option value="">Select Month</option>
                                    <?php for ($i = 0; $i <= 11; $i++): ?>
                                        <option value="<?= $i ?>" <?= ($b == $i) ? 'selected' : '' ?>>
                                            <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>


                        <div class="col-6 mb-3 EXP">
                            <label class="form-label">Last Company</label>
                            <input type="text" class="form-control" name="LastCompany" value="<?php echo $candidate_details[0]['LastCompany']; ?>" placeholder="Enter Last Company" required>
                        </div>
                        <div class="col-6 mb-3 EXP">
                            <label class="form-label">Notice Period (in Days)</label>
                            <input type="number" step="any" min="0" class="form-control" name="NoticePeroid" value="<?php echo $candidate_details[0]['NoticePeroid']; ?>" placeholder="Enter Notice Period" required>
                        </div>

                        <div class="col-6 mb-3 EXP">
                            <label for="CurrentSalary" class="form-label">Current Salary</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="any" min="0" class="form-control" name="CandidateCurrentCTC" value="<?php echo $candidate_details[0]['CandidateCurrentCTC'] ?>" required>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Expected Salary</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="any" min="0" class="form-control" name="CandidateExpectedCTC" value="<?php echo $candidate_details[0]['CandidateExpectedCTC']; ?>" required>
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Immediate Joiner</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ImmediateJoiner" id="ImmediateJoiner1" value="Yes" <?= ($candidate_details[0]['ImmediateJoiner'] == 'Yes') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="ImmediateJoiner1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ImmediateJoiner" id="ImmediateJoiner2" value="No" <?= ($candidate_details[0]['ImmediateJoiner'] == 'No') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="ImmediateJoiner2">No</label>
                                    </div>
                                </div>
                                <div class="col-6 mb-3" id="daysreq">
                                    <label for="DaysRequired" class="form-label">Days Required to Join</label>
                                    <input type="text" class="form-control" name="DaysRequired" placeholder="Enter No. of Days" value="<?= $candidate_details[0]['DaysRequired'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3" id="Resilocation">
                            <label class="form-label">Residing Location</label>
                            <textarea class="form-control" placeholder="Enter Location" name="CandidateLocation" required><?= $candidate_details[0]['CandidateLocation'] ?></textarea>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Upload Resume</label>
                            <input class="form-control" type="file" name="CandidateResume" id="customFile" value="<?= $candidate_details[0]['CandidateResume'] ?>" <?= ($candidate_details[0]['CandidateResume'])?'':'required'?>>
                            <?php if ($candidate_details[0]['CandidateResume']) { ?>
                                <span style="font-size:smaller;">Current file: <?= $candidate_details[0]['CandidateResume'] ?></span>
                            <?php } ?>
                            <input type="hidden" name="OldResumeName" value="<?= $candidate_details[0]['CandidateResume'] ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        if ($('#exp-type').val() == 1) {
            $('.EXP').hide();
        }
        if ($('#ImmediateJoiner1').prop('checked')) {
            $('#daysreq').hide();
        } else {
            $('#daysreq').show();
        }
        $('#exp-type').on("change", function() {
            if ($(this).val() == 1) {
                $('.EXP').hide();
            } else {
                $('.EXP').show();
            }
        });
        $('#T-year').on('change', function() {
            var val = parseFloat($(this).val() + '.' + $('#T-month').val()).toFixed(2);
            $('#TotalExperience').val(val);
        });
        $('#T-month').on('change', function() {
            var val = parseFloat($('#T-year').val() + '.' + $(this).val()).toFixed(2);
            $('#TotalExperience').val(val);
        });
        $('[name="ImmediateJoiner"]').on("change", function() {
            const isImmediateJoiner = $(this).val() === 'Yes';
            console.log(isImmediateJoiner);
            const $daysReq = $('#daysreq');
            $daysReq.toggle(!isImmediateJoiner);
        });
    });
</script>

<script>
    $(document).ready(function() {
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
    });

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
    });

    document.getElementById('notScheduledBtn').addEventListener('click', function() {
        this.classList.add('active');
        document.getElementById('scheduleBtn').classList.remove('active');
        document.getElementById('sint').style.display = 'none';
        document.getElementById('nint').style.display = 'block';
    });

    const radioButtons = document.getElementsByName('scheduled');
    const callbackDiv = document.getElementById('callback');
    radioButtons.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.id === 'scheduled4' || this.id === 'scheduled5' || this.id === 'scheduled6') {
                callbackDiv.style.display = 'block';
            } else {
                callbackDiv.style.display = 'none';
            }
        });
    });
</script>

<?= $this->endSection() ?>