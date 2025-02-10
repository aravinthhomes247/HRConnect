<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>
<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
}
?>

<style>
    input[type="time"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }

    input[type="time"] {
        text-indent: 1px;
    }
    .ProfileEditBtn {
        color: #8146d4;
        border: 1px solid #8146d4;
        padding: 2px 15px !important;
        border-radius: 17px;
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
</style>

<div class="arrived">
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
                    <p style="color: #029008;"><?= date("M d, Y", strtotime($candidate_details[0]['InterviewDate'])) ?? 'NA' ?></p>
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

    <div class="row actions mt-2 mb-2 ms-3 me-4">
        <h5 class="mt-2">Candidate On Interview Day</h5>

        <div class="mb-3 mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptionss" id="inlineRadio11" value="1" checked>
                <label class="form-check-label" for="inlineRadio1">Arrived</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptionss" id="inlineRadio22" value="2">
                <label class="form-check-label" for="inlineRadio2">Re-Schedule</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptionss" id="inlineRadio33" value="3">
                <label class="form-check-label" for="inlineRadio3">Cancel</label>
            </div>
        </div>


        <?php if (($candidate_details[0]['ScheduleStatus'] == 1)) { ?>
            <form action="<?= site_url('/update_candidateArrived') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                <input type="hidden" name="CandidateName" value="<?= $candidate_details[0]['CandidateName'] ?>">
                <input type="file" name="CandidateResume" id="file" style="visibility: hidden" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                <input type="hidden" name="scheduled" value="10" />
                <input type="hidden" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate" data-target="#reservationdatetime" placeholder="Interview Date" value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                <div class="col" id="forarrived">
                    <div class="row">
                        <div class="mb-3 act">
                            <label for="Education" class="form-label">Education</label>
                            <input type="text" class="form-control" name="CandidateEducation" value="<?php echo $candidate_details[0]['CandidateEducation']; ?>" placeholder="Enter Education Qualification">
                        </div>
                        <div class="mb-3 act">
                            <label for="Experience" class="form-label">Experience</label>
                            <select class="form-control" name="exp" id="type">
                                <option value="" selected>Select Experience</option>
                                <option value="1">Fresher</option>
                                <option value="2">Experiance</option>
                            </select>
                        </div>
                        <div class="mb-3 act EXP">
                            <input type="hidden" name="TotalExperience" id="TotalExperience" value="<?php echo $candidate_details[0]['TotalExperience']; ?>">
                            <label for="T-Experience" class="form-label">Total Experience</label>
                            <div class="input-group">
                                <select class="form-control" name="T-year" id="T-year">
                                    <option value="0" selected>Select Year</option>
                                    <option value="1">01</option>
                                    <option value="2">02</option>
                                    <option value="3">03</option>
                                    <option value="4">04</option>
                                    <option value="5">05</option>
                                    <option value="6">06</option>
                                    <option value="7">07</option>
                                    <option value="8">08</option>
                                    <option value="9">09</option>
                                    <option value="10">10</option>
                                    <option value="11">10+</option>
                                </select>
                                <select class="form-control" name="T-month" id="T-month">
                                    <option value="00" selected>Select Month</option>
                                    <option value="00">00</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 act EXP">
                            <label for="LastCompany" class="form-label">Last Company</label>
                            <input type="text" class="form-control" name="LastCompany" value="<?php echo $candidate_details[0]['LastCompany']; ?>" placeholder="Enter Education Qualification">
                        </div>
                        <div class="mb-3 act EXP">
                            <label for="NoticePeriod" class="form-label">Notice Period (in Days)</label>
                            <input type="number" step="any" min="0" class="form-control" name="NoticePeroid" value="<?php echo $candidate_details[0]['NoticePeroid']; ?>" placeholder="Enter Notice Period">
                        </div>
                        <div class="mb-3 act EXP">
                            <label for="CurrentSalary" class="form-label">Current Salary</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="any" min="0" class="form-control" name="CandidateCurrentCTC" value="<?php echo $candidate_details[0]['CandidateCurrentCTC']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 act">
                            <label for="ExpectedSalary" class="form-label">Expected Salary</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="any" min="0" class="form-control" name="CandidateExpectedCTC" value="<?php echo $candidate_details[0]['CandidateExpectedCTC']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 act">
                            <label for="ImmediateJoiner" class="form-label">Immediate Joiner</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ImmediateJoiner" id="ImmediateJoiner1" value="Yes" <?= ($candidate_details[0]['ImmediateJoiner'] == 'Yes') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="ImmediateJoiner1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ImmediateJoiner" id="ImmediateJoiner2" value="No" <?= ($candidate_details[0]['ImmediateJoiner'] == 'No') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="ImmediateJoiner2">No</label>
                            </div>
                        </div>
                        <div class="mb-3 act">
                            <label for="ResidingLocation" class="form-label">Residing Location</label>
                            <textarea class="form-control" name="CandidateLocation" placeholder="Enter Location"><?= $candidate_details[0]['CandidateLocation'] ?></textarea>
                        </div>
                        <div class="mb-3 act" id="daysreq" style="display: none;">
                            <label for="DaysRequired" class="form-label">Days Required to Join</label>
                            <input type="text" class="form-control" name="DaysRequired" placeholder="Enter No. of Days" value="<?= $candidate_details[0]['DaysRequired'] ?>">
                        </div>
                    </div>
                    <div class="submit mt-3 mb-3">
                        <button type="submit" class="btn smt">Submit</button>
                    </div>
                </div>
            </form>
        <?php } ?>

        <form action="<?= site_url('/update_candidate_reschedule') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
            <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
            <input type="hidden" name="scheduled" value="1" />
            <input type="hidden" name="InterviewDate" value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
            <div class="row" id="forReschedule" style="display: none;">
                <div class="col col-lg-4 Reschedule">
                    <h6>Reschedule Date & Time</h6>
                    <input type="hidden" name="InterviewDate" id="InterviewDate" value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                    <div class="input-group ms-2">
                        <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                        <input type="text" id="IntDate1" class="form-control IntDate" placeholder="Select a Date">
                    </div>
                    <div class="input-group ms-2 mt-3">
                        <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                        <input type="time" id="IntTime1" class="form-control IntTime" placeholder="Select a Time">
                    </div>
                </div>
                <div class="col col-lg-8 Reschedule">
                    <h6>Reason</h6>
                    <textarea class="form-control" rows="4" name="Reason" id="Reason" placeholder="Write a Remark..."></textarea>
                </div>
                <div class="submit mt-3 mb-3">
                    <button type="submit" class="btn smt">Submit</button>
                </div>
            </div>
        </form>

        <form action="<?= site_url('/update_candidate_cancel') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
            <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
            <input type="hidden" name="scheduled" value="1" />
            <input type="hidden" name="InterviewDate" value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
            <div class="nint" id="forcancel" style="display: none;">
                <div class="mb-3 mt-3 ms-1">
                    <?php $i = 1;
                    if ($notScheduleReasons) {
                        foreach ($notScheduleReasons as $row) { ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="scheduled" id="scheduled<?= $i ?>" value="<?php echo $row["NS_IDPK"] ?>">
                                <label class="form-check-label" for="scheduled<?= $i++ ?>"><?php echo $row["NS_Reasons"] ?></label>
                            </div>
                    <?php }
                    } ?>
                </div>
                <div class="row">
                    <div class="col col-lg-5 callback" id="callback" style="display: none;">
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
                    <div class="col col-lg-7">
                        <h6 class="ms-1">Candidate Remarks</h6>
                        <textarea class="form-control ms-1" name="remarks" rows="4" id="remarks" placeholder="Write a Remark..."></textarea>
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
                <input type="hidden" name="returnurl" value="edit_candidate_view">
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
                            <label class="form-label">Upload Resume</label>
                            <input class="form-control" type="file" name="CandidateResume" id="customFile" value="<?= $candidate_details[0]['CandidateResume'] ?>" <?= ($candidate_details[0]['CandidateResume'])? '':'required'?>>
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
        var error = '<?= session()->getFlashdata('Error') ?? '' ?>';
        error = error.trim();
        if(error){
            Swal.fire(error);
        }

        $('#type').on('change', function() {
            if ($(this).val() == 1) {
                $('.EXP').hide();
            } else {
                $('.EXP').show();
            }
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

        document.querySelectorAll('.IntTime').forEach(function(input) {
            input.addEventListener('click', function() {
                this.showPicker();
            });
        });

        $('#T-year').on('change', function() {
            var val = parseFloat($(this).val() + '.' + $('#T-month').val()).toFixed(2);
            $('#TotalExperience').val(val);
        });
        $('#T-month').on('change', function() {
            var val = parseFloat($('#T-year').val() + '.' + $(this).val()).toFixed(2);
            $('#TotalExperience').val(val);
        });

    });


    const mainradioButtons = document.getElementsByName('inlineRadioOptionss');
    const arrivedDiv = document.getElementById('forarrived');
    const RescheduleDiv = document.getElementById('forReschedule');
    const forcancelDiv = document.getElementById('forcancel');

    mainradioButtons.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.id === 'inlineRadio11') {
                arrivedDiv.style.display = 'block';
            } else {
                arrivedDiv.style.display = 'none';
            }
            if (this.id === 'inlineRadio22') {
                RescheduleDiv.style.display = 'flex';
            } else {
                RescheduleDiv.style.display = 'none';
            }
            if (this.id === 'inlineRadio33') {
                forcancelDiv.style.display = 'block';
            } else {
                forcancelDiv.style.display = 'none';
            }
        });
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

    const ImmediateJoiner = document.getElementsByName('ImmediateJoiner');
    const daysreq = document.getElementById('daysreq');
    ImmediateJoiner.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.id === 'ImmediateJoiner2') {
                daysreq.style.display = 'block';
            } else {
                daysreq.style.display = 'none';
            }
        });
    });
</script>

<?= $this->endSection() ?>