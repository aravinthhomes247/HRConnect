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

    .resume span.history {
        padding: 1% 5%;
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

    .modal-footer{
        justify-content: center;
    }
</style>

<div class="details">
    <div class="row profile mt-2 mb-2 ms-3 me-4">
        <div class="col col-lg-4 mt-2">
            <h2><?= $candidate_details[0]['CandidateName'] ?? 'NA' ?></h2>
            <h5 class="mb-4"><?= $candidate_details[0]['designations'] ?? 'NA' ?></h5>
            <span>
                <?php
                switch ($candidate_details[0]['ScheduleStatus']) {
                    case 10:
                        echo 'Processing';
                        break;
                    case 0:
                        echo 'Selected';
                        break;
                    default:
                        echo 'Not Started';
                }
                ?>
            </span>
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
            <div class="row mb-4 resume">
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#EditCandidate" class="ProfileEditBtn mb-3"><i class="fa-regular fa-pen-to-square"></i> Edit Details</a>
            </div>
            <div class="row mb-3 resume">
                <a href="<?= site_url('/public/Uploads/candidates/' . $candidate_details[0]['CandidateId'] . '/' . $candidate_details[0]['CandidateResume']) ?>" target="_blank" class="<?= ($candidate_details[0]['CandidateResume']) ? '':'disabled'?>"><span class="resume"><i class="fa-regular fa-eye"></i> View Resume</span></a>
            </div>
            <div class="row mt-4 resume">
                <a href="javascript:void(0);"><span class="mt-3 history" data-bs-toggle="modal" data-bs-target="#candidate_history"><i class="fa-solid fa-list"></i> View History</span></a>
            </div>
        </div>
    </div>

    <div class="row info mt-2 mb-2 ms-3 me-4">
        <div class="row">
            <div class="col col-lg-11 mt-2">
                <p style="color: #8146D4;">Candiate Details</p>
            </div>
            <div class="col col-lg-1 mt-2">
                <i class="fa-solid fa-angle-up" id="drop-up" style="display: none;"></i>
                <i class="fa-solid fa-angle-down" id="drop-down"></i>
            </div>
        </div>
        <div class="row ms-1" style="display: none;" id="info-body">
            <div class="data">
                <label>Education</label>
                <p><?= $candidate_details[0]['CandidateEducation'] ?></p>
            </div>
            <div class="data">
                <label>Residing Address</label>
                <p><?= $candidate_details[0]['CandidateLocation'] ?></p>
            </div>
            <div class="data">
                <label>Experience</label>
                <p>
                    <?php
                    if ($candidate_details[0]['CandidateExperience'] == 1) {
                        echo 'Fresher';
                    } else {
                        $years = floor($candidate_details[0]['TotalExperience']);
                        $months = sprintf('%02d', ($candidate_details[0]['TotalExperience'] - $years) * 100);
                        $months = ($months < 11) ? $months + 01 : $months;
                        echo $years . ' Years ' . $months . ' Months';
                    }
                    ?>
                </p>
            </div>
            <?php if ($candidate_details[0]['CandidateExperience'] == 2) { ?>
                <div class="data">
                    <label>Last Company</label>
                    <p><?= $candidate_details[0]['LastCompany'] ?></p>
                </div>
                <div class="data">
                    <label>Notice Period</label>
                    <p><?= $candidate_details[0]['NoticePeroid'] ?> Days</p>
                </div>
                <div class="data">
                    <label>Current CTC</label>
                    <p>₹ <?= $candidate_details[0]['CandidateCurrentCTC'] ?></p>
                </div>
            <?php } ?>
            <div class="data">
                <label>Expected CTC</label>
                <p>₹ <?= $candidate_details[0]['CandidateExpectedCTC'] ?></p>
            </div>
            <div class="data">
                <label>Immediate Joiner</label>
                <p><?= $candidate_details[0]['ImmediateJoiner'] ?></p>
            </div>
            <?php if ($candidate_details[0]['ImmediateJoiner'] == 'No') { ?>
                <div class="data">
                    <label>Days Required to Join</label>
                    <p><?= $candidate_details[0]['DaysRequired'] ?> Days</p>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="row rounds mt-2 mb-2 ms-3 me-4">
        <div class="col col-lg-12 ps-0">
            <?php
            $ACTIVE = array_fill(0, 9, 0);
            $STYLE = array_fill(0, 9, 0);
            if (isset($roundDetails[0])) {
                // $STYLE = array_fill(0, 9, 0);
                foreach ($roundDetails as $index => $round) {
                    $ACTIVE = array_fill(0, 9, 0);
                    switch ($round['InterviewStatus']) {
                        case 1:
                            $ACTIVE[$index + 1] = 1;
                            $STYLE = array_fill($index + 2, max(0, 7 - $index), 1);
                            break;
                        case 2:
                            $ACTIVE[6] = 1;
                            $STYLE = array_fill($index + 1, max(0, 5 - $index), 1);
                            break;
                        case 3:
                            $ACTIVE[$index] = 1;
                            $STYLE = array_fill($index + 1, max(0, 8 - $index), 1);
                            break;
                        case 4:
                            $ACTIVE[$index] = 1;
                            $STYLE = array_fill($index + 1, max(0, 8 - $index), 1);
                            break;
                    }
                }

                $selected = false;
                $doc_verified = false;
                $offfer_send = false;
                for ($i = 0; $i < 6; $i++) {
                    if (isset($roundDetails[$i]['InterviewStatus']) && ($roundDetails[$i]['InterviewStatus'] == 2 || $roundDetails[$i]['InterviewStatus'] == 0)) {
                        $selected = true;
                    }
                }

                if (!empty($documents) && $documents[0]['DVStatus'] == 2) {
                    $doc_verified = true;
                }
                if (!empty($offerLetter)) {
                    $offfer_send = true;
                }
                if ($selected == true && $doc_verified == true && $offfer_send == true) {
                    $ACTIVE[8] = 1;
                    $Max_round = 8;
                    $ACTIVE[6] = $ACTIVE[7] = 0;
                    $STYLE[6] = $STYLE[7] = $STYLE[8] = 0;
                } else if ($selected == true && $doc_verified == true && $offfer_send == false) {
                    $Max_round = 7;
                    $ACTIVE[7] = $STYLE[8] = 1;
                    $ACTIVE[6] = $STYLE[6] = $STYLE[7] = 0;
                } else if ($selected == true && $doc_verified == false && $offfer_send == false) {
                    $STYLE[6] = 0;
                    $ACTIVE[6] = 1;
                    $STYLE[7] = $STYLE[8] = 1;
                }
            } else {
                $ACTIVE[0] = 1;
                $STYLE = array_fill(1, 8, 1);
            }
            ?>
            <button type="button" class="btn tab ms-0 me-0 <?= ($ACTIVE[0] == 1) ? 'active' : '' ?>" <?= ($STYLE[0] == 1) ? 'style="display:none"' : '' ?> data-target="tab-round-1">Round 1 <?= ($Max_round > 0) ? '<i class="fa-regular fa-circle-check ms-2"></i>' : '' ?></button>
            <button type="button" class="btn tab ms-0 me-0 <?= ($ACTIVE[1] == 1) ? 'active' : '' ?>" <?= ($STYLE[1] == 1) ? 'style="display:none"' : '' ?> data-target="tab-round-2">Round 2 <?= ($Max_round > 1) ? '<i class="fa-regular fa-circle-check ms-2"></i>' : '' ?></button>
            <button type="button" class="btn tab ms-0 me-0 <?= ($ACTIVE[2] == 1) ? 'active' : '' ?>" <?= ($STYLE[2] == 1) ? 'style="display:none"' : '' ?> data-target="tab-round-3">Round 3 <?= ($Max_round > 2) ? '<i class="fa-regular fa-circle-check ms-2"></i>' : '' ?></button>
            <button type="button" class="btn tab ms-0 me-0 <?= ($ACTIVE[3] == 1) ? 'active' : '' ?>" <?= ($STYLE[3] == 1) ? 'style="display:none"' : '' ?> data-target="tab-round-4">Round 4 <?= ($Max_round > 3) ? '<i class="fa-regular fa-circle-check ms-2"></i>' : '' ?></button>
            <button type="button" class="btn tab ms-0 me-0 <?= ($ACTIVE[4] == 1) ? 'active' : '' ?>" <?= ($STYLE[4] == 1) ? 'style="display:none"' : '' ?> data-target="tab-round-5">Round 5 <?= ($Max_round > 4) ? '<i class="fa-regular fa-circle-check ms-2"></i>' : '' ?></button>
            <button type="button" class="btn tab ms-0 me-0 <?= ($ACTIVE[5] == 1) ? 'active' : '' ?>" <?= ($STYLE[5] == 1) ? 'style="display:none"' : '' ?> data-target="tab-round-6">Round 6 <?= ($Max_round > 5) ? '<i class="fa-regular fa-circle-check ms-2"></i>' : '' ?></button>
            <button type="button" class="btn tab ms-0 me-0 <?= ($ACTIVE[6] == 1) ? 'active' : '' ?>" <?= ($STYLE[6] == 1) ? 'style="display:none"' : '' ?> data-target="tab-round-7">Document Verification <?= ($Max_round > 6) ? '<i class="fa-regular fa-circle-check ms-2"></i>' : '' ?></button>
            <button type="button" class="btn tab ms-0 me-0 <?= ($ACTIVE[7] == 1) ? 'active' : '' ?>" <?= ($STYLE[7] == 1) ? 'style="display:none"' : '' ?> data-target="tab-round-8">Offer Letter <?= ($Max_round > 7) ? '<i class="fa-regular fa-circle-check ms-2"></i>' : '' ?></button>
            <button type="button" class="btn tab ms-0 me-0 <?= ($ACTIVE[8] == 1) ? 'active' : '' ?>" <?= ($STYLE[8] == 1) ? 'style="display:none"' : '' ?> data-target="tab-round-9">Onboarding <?= ($Max_round > 8) ? '<i class="fa-regular fa-circle-check ms-2"></i>' : '' ?></button>
        </div>


        <div class="col col-lg-12 round" id="tab-round-1">
            <?php if (empty($roundList)) { ?>
                <form action="<?= site_url('/update_interviewpro') ?>" method="post" class="RoundForm" id="RoundForm1">
                    <div class="row">
                        <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                        <input type="hidden" id="RoundID" name="RoundID" value="1">
                        <input type="hidden" id="Communication1" name="Communication" />
                        <input type="hidden" id="Attitude1" name="Attitude" />
                        <input type="hidden" id="Discipline1" name="Discipline" />
                        <input type="hidden" id="DressCode1" name="DressCode" />
                        <input type="hidden" id="Knowledge1" name="Knowledge" />
                        <div class="col col-lg-5 mt-4 ms-5">
                            <div class="row w-75">
                                <select class="form-control" name="InterviewerIDFK" id="interviwer" required>
                                    <option value="">Select Interviewer</option>
                                    <?php foreach ($getInterviewerList as $row) { ?>
                                        <option value="<?= $row["EmployeeId"] ?>"><?= $row["EmployeeName"] ?></option>
                                    <?php } ?>
                                </select>
                                <table class="table table-borderless mt-2">
                                    <tbody>
                                        <tr>
                                            <td>Communication</td>
                                            <td class="star-container-1" style="width: 37%;">
                                                <i class="fa-solid fa-star com star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star com star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star com star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star com star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star com star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-1-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Attitude</td>
                                            <td class="star-container-2" style="width: 37%;">
                                                <i class="fa-solid fa-star att star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star att star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star att star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star att star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star att star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-2-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Discipline</td>
                                            <td class="star-container-3" style="width: 37%;">
                                                <i class="fa-solid fa-star dis star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star dis star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star dis star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star dis star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star dis star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-3-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Dress Code</td>
                                            <td class="star-container-4" style="width: 37%;">
                                                <i class="fa-solid fa-star dre star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star dre star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star dre star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star dre star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star dre star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-4-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Knowledge</td>
                                            <td class="star-container-5" style="width: 37%;">
                                                <i class="fa-solid fa-star kno star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star kno star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star kno star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star kno star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star kno star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-5-warning">Please give Rating</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col col-lg-5 mt-4 ms-5 action">
                            <div class="row">
                                <table class="table table-borderless w-75 ms-5">
                                    <tbody>
                                        <tr>
                                            <td>Overall Performance</td>
                                            <td>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="hidden" id="OverAllRating" name="OverAllRating" />
                                <p>Candidate Rating - <span id="OverAllRatingspan"></span></p>
                                <textarea class="form-control mt-3 ms-4" name="InterviewRemarks" id="InterviewRemarks" placeholder="Write a remark..." required></textarea>
                                <div class="col col-12 mt-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus1" value="1" required>
                                        <label class="form-check-label" for="inlineRadio1">Pass Next Round</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus2" value="2" required>
                                        <label class="form-check-label" for="inlineRadio2">Selected</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus3" value="3" required>
                                        <label class="form-check-label" for="inlineRadio3">Hold</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus4" value="4" required>
                                        <label class="form-check-label" for="inlineRadio4">Rejected</label>
                                    </div>
                                </div>
                                <div class="modal fade bd-example-modal-sm" id="interviewdatemodel1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Next Round DateTime</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12 ">
                                                    <div class="wrapper-select-size">
                                                        <input type="radio" name="IVdate" value="" id="option-1">
                                                        <label for="option-1" class="option option-1"><span>Today</span></label>
                                                        <input type="radio" name="IVdate" value="" id="option-2">
                                                        <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                    </div>
                                                </div>
                                                <div class="form-row interdate">
                                                    <input type="hidden" name="InterviewDate" id="InterviewDate1" />
                                                    <div class="input-group ms-2 mt-2">
                                                        <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                                        <input type="text" id="IntDate1" class="form-control IntDate" placeholder="Select a Date">
                                                    </div>
                                                    <div class="input-group ms-2 mt-3">
                                                        <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                                        <input type="time" id="IntTime1" class="form-control IntTime" placeholder="Select a Time">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn model" name="IVdateClose" data-bs-dismiss="modal" disabled>OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn sub mt-2 mb-2">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php } elseif ($roundList[0]['RoundID'] >= 1) { ?>
                <div class="row">
                    <div class="col col-lg-5 mt-4 ms-5">
                        <div class="row w-75">
                            <div class="over">
                                <span style="color: #8146D4;">Interviewer : </span><strong><?= $roundDetails[0]['InterviewerName'] ?></strong>
                            </div>
                            <table class="table table-borderless mt-2">
                                <tbody>
                                    <tr>
                                        <td>Communication</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[0]['Communication']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Attitude</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[0]['Attitude']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Discipline</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[0]['Discipline']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dress Code</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[0]['DressCode']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Knowledge</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[0]['Knowledge']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col col-lg-5 mt-4 ms-5 action">
                        <div class="row">
                            <?php if ($roundDetails[0]['InterviewStatus'] == 1) { ?>

                            <?php } else if ($roundDetails[0]['InterviewStatus'] == 2 || $roundDetails[0]['InterviewStatus'] == 0) { ?>
                                <div class="selected">
                                    <span><i class="fa-solid fa-check"></i> SELECTED</span>
                                </div>
                            <?php } else if ($roundDetails[0]['InterviewStatus'] == 3) { ?>
                                <div class="hold">
                                    <span><i class="fa-solid fa-pause"></i> HOLD</span>
                                </div>
                            <?php } else if ($roundDetails[0]['InterviewStatus'] == 4) { ?>
                                <div class="rejected">
                                    <span><i class="fa-solid fa-xmark"></i> REJECTED</span>
                                </div>
                            <?php } ?>
                            <table class="table table-borderless w-75 ms-5 mt-2">
                                <tbody>
                                    <tr>
                                        <td>Overall Performance</td>
                                        <td>
                                            <?php
                                            for ($i = 1, $j = $roundDetails[0]['OverAllRating']; $i <= 5; $i++) {
                                                if ($i <= $j && ($i + 0.5) != $j) {
                                                    echo '<i class="fa-solid fa-star over active"></i>';
                                                } elseif (($i + 0.5) == $j) {
                                                    echo '<i class="fa-solid fa-star-half-stroke over active"></i>';
                                                } else {
                                                    echo '<i class="fa-solid fa-star"></i>';
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>Candidate Rating - <strong><?= $roundDetails[0]['OverAllRating'] ?></strong></p>
                            <?php if ($roundDetails[0]['InterviewStatus'] == 3) { ?>
                                <form action="<?= site_url('/update_interviewpro') ?>" method="post" class="RoundForm" id="RoundForm1">
                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                    <input type="hidden" name="RoundID" value="1" id="RoundID"> <!-- value="3" -->
                                    <input type="hidden" name="InterviewerIDFK" value="<?= $roundDetails[0]['InterviewerId'] ?>">
                                    <input type="hidden" id="Communication1" name="Communication" value="<?= $roundDetails[0]['Communication'] ?>" />
                                    <input type="hidden" id="Attitude1" name="Attitude" value="<?= $roundDetails[0]['Attitude'] ?>" />
                                    <input type="hidden" id="Discipline1" name="Discipline" value="<?= $roundDetails[0]['Discipline'] ?>" />
                                    <input type="hidden" id="DressCode1" name="DressCode" value="<?= $roundDetails[0]['DressCode'] ?>" />
                                    <input type="hidden" id="Knowledge1" name="Knowledge" value="<?= $roundDetails[0]['Knowledge'] ?>" />
                                    <input type="hidden" name="OverAllRating" value="<?= $roundDetails[0]['OverAllRating'] ?>">
                                    <input type="hidden" name="Holdaction" value="1">
                                <?php } ?>
                                <textarea class="form-control mt-3 ms-4" name="InterviewRemarks" id="remarks" required><?= $roundDetails[0]['InterviewRemarks'] ?></textarea>
                                <?php if ($roundDetails[0]['InterviewStatus'] == 3) { ?>
                                    <div class="col col-12 mt-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus1" value="1" required>
                                            <label class="form-check-label" for="inlineRadio1">Pass Next Round</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus2" value="2" required>
                                            <label class="form-check-label" for="inlineRadio2">Selected</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus4" value="4" required>
                                            <label class="form-check-label" for="inlineRadio4">Rejected</label>
                                        </div>
                                    </div> <!-- id="interviewdate3" -->
                                    <div class="modal fade bd-example-modal-sm" id="interviewdatemodel1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Next Round DateTime</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-12 ">
                                                        <div class="wrapper-select-size">
                                                            <input type="radio" name="IVdate" value="" id="option-1">
                                                            <label for="option-1" class="option option-1"><span>Today</span></label>
                                                            <input type="radio" name="IVdate" value="" id="option-2">
                                                            <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row interdate"> <!-- InterviewDate3 -->
                                                        <input type="hidden" name="InterviewDate" id="InterviewDate1" />
                                                        <div class="input-group ms-2 mt-2">
                                                            <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                                            <input type="text" id="IntDate1" class="form-control IntDate" placeholder="Select a Date">
                                                        </div> <!-- IntDate3 -->
                                                        <div class="input-group ms-2 mt-3">
                                                            <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                                            <input type="time" id="IntTime1" class="form-control IntTime" placeholder="Select a Time">
                                                        </div> <!-- IntTime3 -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn model" name="IVdateClose" data-bs-dismiss="modal" disabled>OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-lg-8">
                                        <button type="submit" class="btn sub mt-2 mb-2">Submit</button>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="col col-lg-12 round" id="tab-round-2">
            <?php if ($roundList[0]['RoundID'] == 1) { ?>
                <form action="<?= site_url('/update_interviewpro') ?>" method="post" class="RoundForm" id="RoundForm2">
                    <div class="row">
                        <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                        <input type="hidden" id="RoundID" name="RoundID" value="2">
                        <input type="hidden" id="Communication2" name="Communication" />
                        <input type="hidden" id="Attitude2" name="Attitude" />
                        <input type="hidden" id="Discipline2" name="Discipline" />
                        <input type="hidden" id="DressCode2" name="DressCode" />
                        <input type="hidden" id="Knowledge2" name="Knowledge" />
                        <div class="col col-lg-5 mt-4 ms-5">
                            <div class="row w-75">
                                <select class="form-control" name="InterviewerIDFK" id="interviwer" required>
                                    <option value="">Select Interviewer</option>
                                    <?php foreach ($getInterviewerList as $row) { ?>
                                        <option value="<?= $row["EmployeeId"] ?>"><?= $row["EmployeeName"] ?></option>
                                    <?php } ?>
                                </select>
                                <table class="table table-borderless mt-2">
                                    <tbody>
                                        <tr>
                                            <td>Communication</td>
                                            <td class="star-container-1" style="width: 37%;">
                                                <i class="fa-solid fa-star com star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star com star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star com star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star com star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star com star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-1-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Attitude</td>
                                            <td class="star-container-2" style="width: 37%;">
                                                <i class="fa-solid fa-star att star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star att star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star att star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star att star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star att star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-2-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Discipline</td>
                                            <td class="star-container-3" style="width: 37%;">
                                                <i class="fa-solid fa-star dis star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star dis star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star dis star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star dis star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star dis star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-3-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Dress Code</td>
                                            <td class="star-container-4" style="width: 37%;">
                                                <i class="fa-solid fa-star dre star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star dre star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star dre star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star dre star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star dre star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-4-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Knowledge</td>
                                            <td class="star-container-5" style="width: 37%;">
                                                <i class="fa-solid fa-star kno star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star kno star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star kno star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star kno star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star kno star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-5-warning">Please give Rating</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col col-lg-5 mt-4 ms-5 action">
                            <div class="row">
                                <table class="table table-borderless w-75 ms-5">
                                    <tbody>
                                        <tr>
                                            <td>Overall Performance</td>
                                            <td>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="hidden" id="OverAllRating" name="OverAllRating" />
                                <p>Candidate Rating - <span id="OverAllRatingspan"></span></p>
                                <textarea class="form-control mt-3 ms-4" name="InterviewRemarks" id="InterviewRemarks" placeholder="Write a remark..." required></textarea>
                                <div class="col col-12 mt-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus1" value="1" required>
                                        <label class="form-check-label" for="inlineRadio1">Pass Next Round</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus2" value="2" required>
                                        <label class="form-check-label" for="inlineRadio2">Selected</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus3" value="3" required>
                                        <label class="form-check-label" for="inlineRadio3">Hold</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus4" value="4" required>
                                        <label class="form-check-label" for="inlineRadio4">Rejected</label>
                                    </div>
                                </div>
                                <div class="modal fade bd-example-modal-sm" id="interviewdatemodel2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Next Round DateTime</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12 ">
                                                    <div class="wrapper-select-size">
                                                        <input type="radio" name="IVdate" value="" id="option-1">
                                                        <label for="option-1" class="option option-1"><span>Today</span></label>
                                                        <input type="radio" name="IVdate" value="" id="option-2">
                                                        <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                    </div>
                                                </div>
                                                <div class="form-row interdate">
                                                    <input type="hidden" name="InterviewDate" id="InterviewDate2" />
                                                    <div class="input-group ms-2 mt-2">
                                                        <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                                        <input type="text" id="IntDate2" class="form-control IntDate" placeholder="Select a Date">
                                                    </div>
                                                    <div class="input-group ms-2 mt-3">
                                                        <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                                        <input type="time" id="IntTime2" class="form-control IntTime" placeholder="Select a Time">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn model" name="IVdateClose" data-bs-dismiss="modal" disabled>OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn sub mt-2 mb-2">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php } elseif ($roundList[0]['RoundID'] >= 2) { ?>
                <div class="row">
                    <div class="col col-lg-5 mt-4 ms-5">
                        <div class="row w-75">
                            <div class="over">
                                <span style="color: #8146D4;">Interviewer : </span><strong><?= $roundDetails[1]['InterviewerName'] ?></strong>
                            </div>
                            <table class="table table-borderless mt-2">
                                <tbody>
                                    <tr>
                                        <td>Communication</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[1]['Communication']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Attitude</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[1]['Attitude']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Discipline</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[1]['Discipline']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dress Code</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[1]['DressCode']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Knowledge</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[1]['Knowledge']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col col-lg-5 mt-4 ms-5 action">
                        <div class="row">
                            <?php if ($roundDetails[1]['InterviewStatus'] == 1) { ?>

                            <?php } else if ($roundDetails[1]['InterviewStatus'] == 2 || $roundDetails[1]['InterviewStatus'] == 0) { ?>
                                <div class="selected">
                                    <span><i class="fa-solid fa-check"></i> SELECTED</span>
                                </div>
                            <?php } else if ($roundDetails[1]['InterviewStatus'] == 3) { ?>
                                <div class="hold">
                                    <span><i class="fa-solid fa-pause"></i> HOLD</span>
                                </div>
                            <?php } else if ($roundDetails[1]['InterviewStatus'] == 4) { ?>
                                <div class="rejected">
                                    <span><i class="fa-solid fa-xmark"></i> REJECTED</span>
                                </div>
                            <?php } ?>
                            <table class="table table-borderless w-75 ms-5 mt-2">
                                <tbody>
                                    <tr>
                                        <td>Overall Performance</td>
                                        <td>
                                            <?php
                                            for ($i = 1, $j = $roundDetails[1]['OverAllRating']; $i <= 5; $i++) {
                                                if ($i <= $j && ($i + 0.5) != $j) {
                                                    echo '<i class="fa-solid fa-star over active"></i>';
                                                } elseif (($i + 0.5) == $j) {
                                                    echo '<i class="fa-solid fa-star-half-stroke over active"></i>';
                                                } else {
                                                    echo '<i class="fa-solid fa-star"></i>';
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>Candidate Rating - <strong><?= $roundDetails[1]['OverAllRating'] ?></strong></p>
                            <?php if ($roundDetails[1]['InterviewStatus'] == 3) { ?>
                                <form action="<?= site_url('/update_interviewpro') ?>" method="post" class="RoundForm" id="RoundForm2">
                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                    <input type="hidden" name="RoundID" value="2" id="RoundID"> <!-- value="3" -->
                                    <input type="hidden" name="InterviewerIDFK" value="<?= $roundDetails[1]['InterviewerId'] ?>">
                                    <input type="hidden" id="Communication2" name="Communication" value="<?= $roundDetails[1]['Communication'] ?>" />
                                    <input type="hidden" id="Attitude2" name="Attitude" value="<?= $roundDetails[1]['Attitude'] ?>" />
                                    <input type="hidden" id="Discipline2" name="Discipline" value="<?= $roundDetails[1]['Discipline'] ?>" />
                                    <input type="hidden" id="DressCode2" name="DressCode" value="<?= $roundDetails[1]['DressCode'] ?>" />
                                    <input type="hidden" id="Knowledge2" name="Knowledge" value="<?= $roundDetails[1]['Knowledge'] ?>" />
                                    <input type="hidden" name="OverAllRating" value="<?= $roundDetails[1]['OverAllRating'] ?>">
                                    <input type="hidden" name="Holdaction" value="1">
                                <?php } ?>
                                <textarea class="form-control mt-3 ms-4" name="InterviewRemarks" id="remarks" required><?= $roundDetails[1]['InterviewRemarks'] ?></textarea>
                                <?php if ($roundDetails[1]['InterviewStatus'] == 3) { ?>
                                    <div class="col col-12 mt-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus1" value="1" required>
                                            <label class="form-check-label" for="inlineRadio1">Pass Next Round</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus2" value="2" required>
                                            <label class="form-check-label" for="inlineRadio2">Selected</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus4" value="4" required>
                                            <label class="form-check-label" for="inlineRadio4">Rejected</label>
                                        </div>
                                    </div> <!-- id="interviewdate3" -->
                                    <div class="modal fade bd-example-modal-sm" id="interviewdatemodel2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Next Round DateTime</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-12 ">
                                                        <div class="wrapper-select-size">
                                                            <input type="radio" name="IVdate" value="" id="option-1">
                                                            <label for="option-1" class="option option-1"><span>Today</span></label>
                                                            <input type="radio" name="IVdate" value="" id="option-2">
                                                            <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row interdate"> <!-- InterviewDate3 -->
                                                        <input type="hidden" name="InterviewDate" id="InterviewDate2" />
                                                        <div class="input-group ms-2 mt-2">
                                                            <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                                            <input type="text" id="IntDate2" class="form-control IntDate" placeholder="Select a Date">
                                                        </div> <!-- IntDate3 -->
                                                        <div class="input-group ms-2 mt-3">
                                                            <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                                            <input type="time" id="IntTime2" class="form-control IntTime" placeholder="Select a Time">
                                                        </div> <!-- IntTime3 -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn model" name="IVdateClose" data-bs-dismiss="modal" disabled>OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-lg-8">
                                        <button type="submit" class="btn sub mt-2 mb-2">Submit</button>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="col col-lg-12 round" id="tab-round-3">
            <?php if ($roundList[0]['RoundID'] == 2) { ?>
                <form action="<?= site_url('/update_interviewpro') ?>" method="post" class="RoundForm" id="RoundForm3">
                    <div class="row">
                        <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                        <input type="hidden" id="RoundID" name="RoundID" value="3">
                        <input type="hidden" id="Communication3" name="Communication" />
                        <input type="hidden" id="Attitude3" name="Attitude" />
                        <input type="hidden" id="Discipline3" name="Discipline" />
                        <input type="hidden" id="DressCode3" name="DressCode" />
                        <input type="hidden" id="Knowledge3" name="Knowledge" />
                        <div class="col col-lg-5 mt-4 ms-5">
                            <div class="row w-75">
                                <select class="form-control" name="InterviewerIDFK" id="interviwer" required>
                                    <option value="">Select Interviewer</option>
                                    <?php foreach ($getInterviewerList as $row) { ?>
                                        <option value="<?= $row["EmployeeId"] ?>"><?= $row["EmployeeName"] ?></option>
                                    <?php } ?>
                                </select>
                                <table class="table table-borderless mt-2">
                                    <tbody>
                                        <tr>
                                            <td>Communication</td>
                                            <td class="star-container-1" style="width: 37%;">
                                                <i class="fa-solid fa-star com star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star com star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star com star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star com star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star com star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-1-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Attitude</td>
                                            <td class="star-container-2" style="width: 37%;">
                                                <i class="fa-solid fa-star att star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star att star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star att star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star att star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star att star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-2-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Discipline</td>
                                            <td class="star-container-3" style="width: 37%;">
                                                <i class="fa-solid fa-star dis star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star dis star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star dis star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star dis star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star dis star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-3-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Dress Code</td>
                                            <td class="star-container-4" style="width: 37%;">
                                                <i class="fa-solid fa-star dre star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star dre star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star dre star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star dre star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star dre star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-4-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Knowledge</td>
                                            <td class="star-container-5" style="width: 37%;">
                                                <i class="fa-solid fa-star kno star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star kno star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star kno star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star kno star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star kno star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-5-warning">Please give Rating</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col col-lg-5 mt-4 ms-5 action">
                            <div class="row">
                                <table class="table table-borderless w-75 ms-5">
                                    <tbody>
                                        <tr>
                                            <td>Overall Performance</td>
                                            <td>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="hidden" id="OverAllRating" name="OverAllRating" />
                                <p>Candidate Rating - <span id="OverAllRatingspan"></span></p>
                                <textarea class="form-control mt-3 ms-4" name="InterviewRemarks" id="InterviewRemarks" placeholder="Write a remark..." required></textarea>
                                <div class="col col-12 mt-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus1" value="1" required>
                                        <label class="form-check-label" for="inlineRadio1">Pass Next Round</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus2" value="2" required>
                                        <label class="form-check-label" for="inlineRadio2">Selected</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus3" value="3" required>
                                        <label class="form-check-label" for="inlineRadio3">Hold</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus4" value="4" required>
                                        <label class="form-check-label" for="inlineRadio4">Rejected</label>
                                    </div>
                                </div>
                                <div class="modal fade bd-example-modal-sm" id="interviewdatemodel3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Next Round DateTime</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12 ">
                                                    <div class="wrapper-select-size">
                                                        <input type="radio" name="IVdate" value="" id="option-1">
                                                        <label for="option-1" class="option option-1"><span>Today</span></label>
                                                        <input type="radio" name="IVdate" value="" id="option-2">
                                                        <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                    </div>
                                                </div>
                                                <div class="form-row interdate">
                                                    <input type="hidden" name="InterviewDate" id="InterviewDate3" />
                                                    <div class="input-group ms-2 mt-2">
                                                        <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                                        <input type="text" id="IntDate3" class="form-control IntDate" placeholder="Select a Date">
                                                    </div>
                                                    <div class="input-group ms-2 mt-3">
                                                        <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                                        <input type="time" id="IntTime3" class="form-control IntTime" placeholder="Select a Time">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn model" name="IVdateClose" data-bs-dismiss="modal" disabled>OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn sub mt-2 mb-2">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php } elseif ($roundList[0]['RoundID'] >= 3) { ?>
                <div class="row">
                    <div class="col col-lg-5 mt-4 ms-5">
                        <div class="row w-75">
                            <div class="over">
                                <span style="color: #8146D4;">Interviewer : </span><strong><?= $roundDetails[2]['InterviewerName'] ?></strong>
                            </div>
                            <table class="table table-borderless mt-2">
                                <tbody>
                                    <tr>
                                        <td>Communication</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[2]['Communication']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Attitude</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[2]['Attitude']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Discipline</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[2]['Discipline']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dress Code</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[2]['DressCode']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Knowledge</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[2]['Knowledge']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col col-lg-5 mt-4 ms-5 action">
                        <div class="row">
                            <?php if ($roundDetails[2]['InterviewStatus'] == 1) { ?>

                            <?php } else if ($roundDetails[2]['InterviewStatus'] == 2 || $roundDetails[2]['InterviewStatus'] == 0) { ?>
                                <div class="selected">
                                    <span><i class="fa-solid fa-check"></i> SELECTED</span>
                                </div>
                            <?php } else if ($roundDetails[2]['InterviewStatus'] == 3) { ?>
                                <div class="hold">
                                    <span><i class="fa-solid fa-pause"></i> HOLD</span>
                                </div>
                            <?php } else if ($roundDetails[2]['InterviewStatus'] == 4) { ?>
                                <div class="rejected">
                                    <span><i class="fa-solid fa-xmark"></i> REJECTED</span>
                                </div>
                            <?php } ?>
                            <table class="table table-borderless w-75 ms-5 mt-2">
                                <tbody>
                                    <tr>
                                        <td>Overall Performance</td>
                                        <td>
                                            <?php
                                            for ($i = 1, $j = $roundDetails[2]['OverAllRating']; $i <= 5; $i++) {
                                                if ($i <= $j && ($i + 0.5) != $j) {
                                                    echo '<i class="fa-solid fa-star over active"></i>';
                                                } elseif (($i + 0.5) == $j) {
                                                    echo '<i class="fa-solid fa-star-half-stroke over active"></i>';
                                                } else {
                                                    echo '<i class="fa-solid fa-star"></i>';
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>Candidate Rating - <strong><?= $roundDetails[2]['OverAllRating'] ?></strong></p>

                            <?php if ($roundDetails[2]['InterviewStatus'] == 3) { ?>
                                <form action="<?= site_url('/update_interviewpro') ?>" method="post" class="RoundForm" id="RoundForm3">
                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                    <input type="hidden" name="RoundID" value="3" id="RoundID"> <!-- value="3" -->
                                    <input type="hidden" name="InterviewerIDFK" value="<?= $roundDetails[2]['InterviewerId'] ?>">
                                    <input type="hidden" id="Communication3" name="Communication" value="<?= $roundDetails[2]['Communication'] ?>" />
                                    <input type="hidden" id="Attitude3" name="Attitude" value="<?= $roundDetails[2]['Attitude'] ?>" />
                                    <input type="hidden" id="Discipline3" name="Discipline" value="<?= $roundDetails[2]['Discipline'] ?>" />
                                    <input type="hidden" id="DressCode3" name="DressCode" value="<?= $roundDetails[2]['DressCode'] ?>" />
                                    <input type="hidden" id="Knowledge3" name="Knowledge" value="<?= $roundDetails[2]['Knowledge'] ?>" />
                                    <input type="hidden" name="OverAllRating" value="<?= $roundDetails[2]['OverAllRating'] ?>">
                                    <input type="hidden" name="Holdaction" value="1">
                                <?php } ?>
                                <textarea class="form-control mt-3 ms-4" name="InterviewRemarks" id="remarks" required><?= $roundDetails[2]['InterviewRemarks'] ?></textarea>
                                <?php if ($roundDetails[2]['InterviewStatus'] == 3) { ?>
                                    <div class="col col-12 mt-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus1" value="1" required>
                                            <label class="form-check-label" for="inlineRadio1">Pass Next Round</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus2" value="2" required>
                                            <label class="form-check-label" for="inlineRadio2">Selected</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus4" value="4" required>
                                            <label class="form-check-label" for="inlineRadio4">Rejected</label>
                                        </div>
                                    </div> <!-- id="interviewdate3" -->
                                    <div class="modal fade bd-example-modal-sm" id="interviewdatemodel3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Next Round DateTime</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-12 ">
                                                        <div class="wrapper-select-size">
                                                            <input type="radio" name="IVdate" value="" id="option-1">
                                                            <label for="option-1" class="option option-1"><span>Today</span></label>
                                                            <input type="radio" name="IVdate" value="" id="option-2">
                                                            <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row interdate"> <!-- InterviewDate3 -->
                                                        <input type="hidden" name="InterviewDate" id="InterviewDate3" />
                                                        <div class="input-group ms-2 mt-2">
                                                            <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                                            <input type="text" id="IntDate3" class="form-control IntDate" placeholder="Select a Date">
                                                        </div> <!-- IntDate3 -->
                                                        <div class="input-group ms-2 mt-3">
                                                            <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                                            <input type="time" id="IntTime3" class="form-control IntTime" placeholder="Select a Time">
                                                        </div> <!-- IntTime3 -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn model" name="IVdateClose" data-bs-dismiss="modal" disabled>OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-lg-8">
                                        <button type="submit" class="btn sub mt-2 mb-2">Submit</button>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="col col-lg-12 round" id="tab-round-4">
            <?php if ($roundList[0]['RoundID'] == 3) { ?>
                <form action="<?= site_url('/update_interviewpro') ?>" method="post" class="RoundForm" id="RoundForm4">
                    <div class="row">
                        <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                        <input type="hidden" id="RoundID" name="RoundID" value="4">
                        <input type="hidden" id="Communication4" name="Communication" />
                        <input type="hidden" id="Attitude4" name="Attitude" />
                        <input type="hidden" id="Discipline4" name="Discipline" />
                        <input type="hidden" id="DressCode4" name="DressCode" />
                        <input type="hidden" id="Knowledge4" name="Knowledge" />
                        <div class="col col-lg-5 mt-4 ms-5">
                            <div class="row w-75">
                                <select class="form-control" name="InterviewerIDFK" id="interviwer" required>
                                    <option value="">Select Interviewer</option>
                                    <?php foreach ($getInterviewerList as $row) { ?>
                                        <option value="<?= $row["EmployeeId"] ?>"><?= $row["EmployeeName"] ?></option>
                                    <?php } ?>
                                </select>
                                <table class="table table-borderless mt-2">
                                    <tbody>
                                        <tr>
                                            <td>Communication</td>
                                            <td class="star-container-1" style="width: 37%;">
                                                <i class="fa-solid fa-star com star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star com star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star com star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star com star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star com star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-1-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Attitude</td>
                                            <td class="star-container-2" style="width: 37%;">
                                                <i class="fa-solid fa-star att star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star att star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star att star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star att star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star att star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-2-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Discipline</td>
                                            <td class="star-container-3" style="width: 37%;">
                                                <i class="fa-solid fa-star dis star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star dis star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star dis star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star dis star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star dis star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-3-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Dress Code</td>
                                            <td class="star-container-4" style="width: 37%;">
                                                <i class="fa-solid fa-star dre star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star dre star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star dre star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star dre star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star dre star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-4-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Knowledge</td>
                                            <td class="star-container-5" style="width: 37%;">
                                                <i class="fa-solid fa-star kno star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star kno star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star kno star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star kno star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star kno star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-5-warning">Please give Rating</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col col-lg-5 mt-4 ms-5 action">
                            <div class="row">
                                <table class="table table-borderless w-75 ms-5">
                                    <tbody>
                                        <tr>
                                            <td>Overall Performance</td>
                                            <td>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="hidden" id="OverAllRating" name="OverAllRating" />
                                <p>Candidate Rating - <span id="OverAllRatingspan"></span></p>
                                <textarea class="form-control mt-3 ms-4" name="InterviewRemarks" id="InterviewRemarks" placeholder="Write a remark..." required></textarea>
                                <div class="col col-12 mt-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus1" value="1" required>
                                        <label class="form-check-label" for="inlineRadio1">Pass Next Round</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus2" value="2" required>
                                        <label class="form-check-label" for="inlineRadio2">Selected</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus3" value="3" required>
                                        <label class="form-check-label" for="inlineRadio3">Hold</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus4" value="4" required>
                                        <label class="form-check-label" for="inlineRadio4">Rejected</label>
                                    </div>
                                </div>
                                <div class="modal fade bd-example-modal-sm" id="interviewdatemodel4" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Next Round DateTime</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12 ">
                                                    <div class="wrapper-select-size">
                                                        <input type="radio" name="IVdate" value="" id="option-1">
                                                        <label for="option-1" class="option option-1"><span>Today</span></label>
                                                        <input type="radio" name="IVdate" value="" id="option-2">
                                                        <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                    </div>
                                                </div>
                                                <div class="form-row interdate">
                                                    <input type="hidden" name="InterviewDate" id="InterviewDate4" />
                                                    <div class="input-group ms-2 mt-2">
                                                        <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                                        <input type="text" id="IntDate4" class="form-control IntDate" placeholder="Select a Date">
                                                    </div>
                                                    <div class="input-group ms-2 mt-3">
                                                        <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                                        <input type="time" id="IntTime4" class="form-control IntTime" placeholder="Select a Time">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn model" name="IVdateClose" data-bs-dismiss="modal" disabled>OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn sub mt-2 mb-2">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php } elseif ($roundList[0]['RoundID'] >= 4) { ?>
                <div class="row">
                    <div class="col col-lg-5 mt-4 ms-5">
                        <div class="row w-75">
                            <div class="over">
                                <span style="color: #8146D4;">Interviewer : </span><strong><?= $roundDetails[3]['InterviewerName'] ?></strong>
                            </div>
                            <table class="table table-borderless mt-2">
                                <tbody>
                                    <tr>
                                        <td>Communication</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[3]['Communication']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Attitude</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[3]['Attitude']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Discipline</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[3]['Discipline']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dress Code</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[3]['DressCode']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Knowledge</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[3]['Knowledge']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col col-lg-5 mt-4 ms-5 action">
                        <div class="row">
                            <?php if ($roundDetails[3]['InterviewStatus'] == 1) { ?>

                            <?php } else if ($roundDetails[3]['InterviewStatus'] == 2 || $roundDetails[3]['InterviewStatus'] == 0) { ?>
                                <div class="selected">
                                    <span><i class="fa-solid fa-check"></i> SELECTED</span>
                                </div>
                            <?php } else if ($roundDetails[3]['InterviewStatus'] == 3) { ?>
                                <div class="hold">
                                    <span><i class="fa-solid fa-pause"></i> HOLD</span>
                                </div>
                            <?php } else if ($roundDetails[3]['InterviewStatus'] == 4) { ?>
                                <div class="rejected">
                                    <span><i class="fa-solid fa-xmark"></i> REJECTED</span>
                                </div>
                            <?php } ?>
                            <table class="table table-borderless w-75 ms-5 mt-2">
                                <tbody>
                                    <tr>
                                        <td>Overall Performance</td>
                                        <td>
                                            <?php
                                            for ($i = 1, $j = $roundDetails[3]['OverAllRating']; $i <= 5; $i++) {
                                                if ($i <= $j && ($i + 0.5) != $j) {
                                                    echo '<i class="fa-solid fa-star over active"></i>';
                                                } elseif (($i + 0.5) == $j) {
                                                    echo '<i class="fa-solid fa-star-half-stroke over active"></i>';
                                                } else {
                                                    echo '<i class="fa-solid fa-star"></i>';
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>Candidate Rating - <strong><?= $roundDetails[3]['OverAllRating'] ?></strong></p>
                            <?php if ($roundDetails[3]['InterviewStatus'] == 3) { ?>
                                <form action="<?= site_url('/update_interviewpro') ?>" method="post" class="RoundForm" id="RoundForm4">
                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                    <input type="hidden" name="RoundID" value="4" id="RoundID"> <!-- value="3" -->
                                    <input type="hidden" name="InterviewerIDFK" value="<?= $roundDetails[3]['InterviewerId'] ?>">
                                    <input type="hidden" id="Communication4" name="Communication" value="<?= $roundDetails[3]['Communication'] ?>" />
                                    <input type="hidden" id="Attitude4" name="Attitude" value="<?= $roundDetails[3]['Attitude'] ?>" />
                                    <input type="hidden" id="Discipline4" name="Discipline" value="<?= $roundDetails[3]['Discipline'] ?>" />
                                    <input type="hidden" id="DressCode4" name="DressCode" value="<?= $roundDetails[3]['DressCode'] ?>" />
                                    <input type="hidden" id="Knowledge4" name="Knowledge" value="<?= $roundDetails[3]['Knowledge'] ?>" />
                                    <input type="hidden" name="OverAllRating" value="<?= $roundDetails[3]['OverAllRating'] ?>">
                                    <input type="hidden" name="Holdaction" value="1">
                                <?php } ?>
                                <textarea class="form-control mt-3 ms-4" name="InterviewRemarks" id="remarks" required><?= $roundDetails[3]['InterviewRemarks'] ?></textarea>
                                <?php if ($roundDetails[3]['InterviewStatus'] == 3) { ?>
                                    <div class="col col-12 mt-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus1" value="1" required>
                                            <label class="form-check-label" for="inlineRadio1">Pass Next Round</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus2" value="2" required>
                                            <label class="form-check-label" for="inlineRadio2">Selected</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus4" value="4" required>
                                            <label class="form-check-label" for="inlineRadio4">Rejected</label>
                                        </div>
                                    </div> <!-- id="interviewdate3" -->
                                    <div class="modal fade bd-example-modal-sm" id="interviewdatemodel4" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Next Round DateTime</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-12 ">
                                                        <div class="wrapper-select-size">
                                                            <input type="radio" name="IVdate" value="" id="option-1">
                                                            <label for="option-1" class="option option-1"><span>Today</span></label>
                                                            <input type="radio" name="IVdate" value="" id="option-2">
                                                            <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row interdate"> <!-- InterviewDate3 -->
                                                        <input type="hidden" name="InterviewDate" id="InterviewDate4" />
                                                        <div class="input-group ms-2 mt-2">
                                                            <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                                            <input type="text" id="IntDate4" class="form-control IntDate" placeholder="Select a Date">
                                                        </div> <!-- IntDate3 -->
                                                        <div class="input-group ms-2 mt-3">
                                                            <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                                            <input type="time" id="IntTime4" class="form-control IntTime" placeholder="Select a Time">
                                                        </div> <!-- IntTime3 -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn model" name="IVdateClose" data-bs-dismiss="modal" disabled>OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-lg-8">
                                        <button type="submit" class="btn sub mt-2 mb-2">Submit</button>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="col col-lg-12 round" id="tab-round-5">
            <?php if ($roundList[0]['RoundID'] == 4) { ?>
                <form action="<?= site_url('/update_interviewpro') ?>" method="post" class="RoundForm" id="RoundForm5">
                    <div class="row">
                        <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                        <input type="hidden" id="RoundID" name="RoundID" value="5">
                        <input type="hidden" id="Communication5" name="Communication" />
                        <input type="hidden" id="Attitude5" name="Attitude" />
                        <input type="hidden" id="Discipline5" name="Discipline" />
                        <input type="hidden" id="DressCode5" name="DressCode" />
                        <input type="hidden" id="Knowledge5" name="Knowledge" />
                        <div class="col col-lg-5 mt-4 ms-5">
                            <div class="row w-75">
                                <select class="form-control" name="InterviewerIDFK" id="interviwer" required>
                                    <option value="">Select Interviewer</option>
                                    <?php foreach ($getInterviewerList as $row) { ?>
                                        <option value="<?= $row["EmployeeId"] ?>"><?= $row["EmployeeName"] ?></option>
                                    <?php } ?>
                                </select>
                                <table class="table table-borderless mt-2">
                                    <tbody>
                                        <tr>
                                            <td>Communication</td>
                                            <td class="star-container-1" style="width: 37%;">
                                                <i class="fa-solid fa-star com star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star com star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star com star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star com star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star com star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-1-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Attitude</td>
                                            <td class="star-container-2" style="width: 37%;">
                                                <i class="fa-solid fa-star att star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star att star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star att star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star att star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star att star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-2-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Discipline</td>
                                            <td class="star-container-3" style="width: 37%;">
                                                <i class="fa-solid fa-star dis star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star dis star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star dis star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star dis star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star dis star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-3-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Dress Code</td>
                                            <td class="star-container-4" style="width: 37%;">
                                                <i class="fa-solid fa-star dre star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star dre star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star dre star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star dre star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star dre star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-4-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Knowledge</td>
                                            <td class="star-container-5" style="width: 37%;">
                                                <i class="fa-solid fa-star kno star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star kno star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star kno star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star kno star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star kno star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-5-warning">Please give Rating</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col col-lg-5 mt-4 ms-5 action">
                            <div class="row">
                                <table class="table table-borderless w-75 ms-5">
                                    <tbody>
                                        <tr>
                                            <td>Overall Performance</td>
                                            <td>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="hidden" id="OverAllRating" name="OverAllRating" />
                                <p>Candidate Rating - <span id="OverAllRatingspan"></span></p>
                                <textarea class="form-control mt-3 ms-4" name="InterviewRemarks" id="InterviewRemarks" placeholder="Write a remark..." required></textarea>
                                <div class="col col-12 mt-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus1" value="1" required>
                                        <label class="form-check-label" for="inlineRadio1">Pass Next Round</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus2" value="2" required>
                                        <label class="form-check-label" for="inlineRadio2">Selected</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus3" value="3" required>
                                        <label class="form-check-label" for="inlineRadio3">Hold</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus4" value="4" required>
                                        <label class="form-check-label" for="inlineRadio4">Rejected</label>
                                    </div>
                                </div>
                                <div class="modal fade bd-example-modal-sm" id="interviewdatemodel5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Next Round DateTime</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12 ">
                                                    <div class="wrapper-select-size">
                                                        <input type="radio" name="IVdate" value="" id="option-1">
                                                        <label for="option-1" class="option option-1"><span>Today</span></label>
                                                        <input type="radio" name="IVdate" value="" id="option-2">
                                                        <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                    </div>
                                                </div>
                                                <div class="form-row interdate">
                                                    <input type="hidden" name="InterviewDate" id="InterviewDate5" />
                                                    <div class="input-group ms-2 mt-2">
                                                        <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                                        <input type="text" id="IntDate5" class="form-control IntDate" placeholder="Select a Date">
                                                    </div>
                                                    <div class="input-group ms-2 mt-3">
                                                        <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                                        <input type="time" id="IntTime5" class="form-control IntTime" placeholder="Select a Time">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn model" name="IVdateClose" data-bs-dismiss="modal" disabled>OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn sub mt-2 mb-2">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php } elseif ($roundList[0]['RoundID'] >= 5) { ?>
                <div class="row">
                    <div class="col col-lg-5 mt-4 ms-5">
                        <div class="row w-75">
                            <div class="over">
                                <span style="color: #8146D4;">Interviewer : </span><strong><?= $roundDetails[4]['InterviewerName'] ?></strong>
                            </div>
                            <table class="table table-borderless mt-2">
                                <tbody>
                                    <tr>
                                        <td>Communication</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[4]['Communication']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Attitude</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[4]['Attitude']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Discipline</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[4]['Discipline']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dress Code</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[4]['DressCode']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Knowledge</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[4]['Knowledge']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col col-lg-5 mt-4 ms-5 action">
                        <div class="row">
                            <?php if ($roundDetails[4]['InterviewStatus'] == 1) { ?>

                            <?php } else if ($roundDetails[4]['InterviewStatus'] == 2 || $roundDetails[4]['InterviewStatus'] == 0) { ?>
                                <div class="selected">
                                    <span><i class="fa-solid fa-check"></i> SELECTED</span>
                                </div>
                            <?php } else if ($roundDetails[4]['InterviewStatus'] == 3) { ?>
                                <div class="hold">
                                    <span><i class="fa-solid fa-pause"></i> HOLD</span>
                                </div>
                            <?php } else if ($roundDetails[4]['InterviewStatus'] == 4) { ?>
                                <div class="rejected">
                                    <span><i class="fa-solid fa-xmark"></i> REJECTED</span>
                                </div>
                            <?php } ?>
                            <table class="table table-borderless w-75 ms-5 mt-2">
                                <tbody>
                                    <tr>
                                        <td>Overall Performance</td>
                                        <td>
                                            <?php
                                            for ($i = 1, $j = $roundDetails[4]['OverAllRating']; $i <= 5; $i++) {
                                                if ($i <= $j && ($i + 0.5) != $j) {
                                                    echo '<i class="fa-solid fa-star over active"></i>';
                                                } elseif (($i + 0.5) == $j) {
                                                    echo '<i class="fa-solid fa-star-half-stroke over active"></i>';
                                                } else {
                                                    echo '<i class="fa-solid fa-star"></i>';
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>Candidate Rating - <strong><?= $roundDetails[4]['OverAllRating'] ?></strong></p>
                            <?php if ($roundDetails[4]['InterviewStatus'] == 3) { ?>
                                <form action="<?= site_url('/update_interviewpro') ?>" method="post" class="RoundForm" id="RoundForm5">
                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                    <input type="hidden" name="RoundID" value="5" id="RoundID"> <!-- value="3" -->
                                    <input type="hidden" name="InterviewerIDFK" value="<?= $roundDetails[4]['InterviewerId'] ?>">
                                    <input type="hidden" id="Communication5" name="Communication" value="<?= $roundDetails[4]['Communication'] ?>" />
                                    <input type="hidden" id="Attitude5" name="Attitude" value="<?= $roundDetails[4]['Attitude'] ?>" />
                                    <input type="hidden" id="Discipline5" name="Discipline" value="<?= $roundDetails[4]['Discipline'] ?>" />
                                    <input type="hidden" id="DressCode5" name="DressCode" value="<?= $roundDetails[4]['DressCode'] ?>" />
                                    <input type="hidden" id="Knowledge5" name="Knowledge" value="<?= $roundDetails[4]['Knowledge'] ?>" />
                                    <input type="hidden" name="OverAllRating" value="<?= $roundDetails[4]['OverAllRating'] ?>">
                                    <input type="hidden" name="Holdaction" value="1">
                                <?php } ?>
                                <textarea class="form-control mt-3 ms-4" name="InterviewRemarks" id="remarks" required><?= $roundDetails[4]['InterviewRemarks'] ?></textarea>
                                <?php if ($roundDetails[4]['InterviewStatus'] == 3) { ?>
                                    <div class="col col-12 mt-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus1" value="1" required>
                                            <label class="form-check-label" for="inlineRadio1">Pass Next Round</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus2" value="2" required>
                                            <label class="form-check-label" for="inlineRadio2">Selected</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus4" value="4" required>
                                            <label class="form-check-label" for="inlineRadio4">Rejected</label>
                                        </div>
                                    </div> <!-- id="interviewdate3" -->
                                    <div class="modal fade bd-example-modal-sm" id="interviewdatemodel5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Next Round DateTime</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-12 ">
                                                        <div class="wrapper-select-size">
                                                            <input type="radio" name="IVdate" value="" id="option-1">
                                                            <label for="option-1" class="option option-1"><span>Today</span></label>
                                                            <input type="radio" name="IVdate" value="" id="option-2">
                                                            <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row interdate"> <!-- InterviewDate3 -->
                                                        <input type="hidden" name="InterviewDate" id="InterviewDate5" />
                                                        <div class="input-group ms-2 mt-2">
                                                            <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                                            <input type="text" id="IntDate5" class="form-control IntDate" placeholder="Select a Date">
                                                        </div> <!-- IntDate3 -->
                                                        <div class="input-group ms-2 mt-3">
                                                            <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                                            <input type="time" id="IntTime5" class="form-control IntTime" placeholder="Select a Time">
                                                        </div> <!-- IntTime3 -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn model" name="IVdateClose" data-bs-dismiss="modal" disabled>OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-lg-8">
                                        <button type="submit" class="btn sub mt-2 mb-2">Submit</button>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="col col-lg-12 round" id="tab-round-6">
            <?php if ($roundList[0]['RoundID'] == 5) { ?>
                <form action="<?= site_url('/update_interviewpro') ?>" method="post" class="RoundForm" id="RoundForm6">
                    <div class="row">
                        <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                        <input type="hidden" id="RoundID" name="RoundID" value="6">
                        <input type="hidden" id="Communication6" name="Communication" />
                        <input type="hidden" id="Attitude6" name="Attitude" />
                        <input type="hidden" id="Discipline6" name="Discipline" />
                        <input type="hidden" id="DressCode6" name="DressCode" />
                        <input type="hidden" id="Knowledge6" name="Knowledge" />
                        <div class="col col-lg-5 mt-4 ms-5">
                            <div class="row w-75">
                                <select class="form-control" name="InterviewerIDFK" id="interviwer" required>
                                    <option value="">Select Interviewer</option>
                                    <?php foreach ($getInterviewerList as $row) { ?>
                                        <option value="<?= $row["EmployeeId"] ?>"><?= $row["EmployeeName"] ?></option>
                                    <?php } ?>
                                </select>
                                <table class="table table-borderless mt-2">
                                    <tbody>
                                        <tr>
                                            <td>Communication</td>
                                            <td class="star-container-1" style="width: 37%;">
                                                <i class="fa-solid fa-star com star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star com star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star com star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star com star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star com star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-1-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Attitude</td>
                                            <td class="star-container-2" style="width: 37%;">
                                                <i class="fa-solid fa-star att star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star att star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star att star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star att star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star att star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-2-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Discipline</td>
                                            <td class="star-container-3" style="width: 37%;">
                                                <i class="fa-solid fa-star dis star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star dis star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star dis star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star dis star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star dis star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-3-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Dress Code</td>
                                            <td class="star-container-4" style="width: 37%;">
                                                <i class="fa-solid fa-star dre star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star dre star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star dre star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star dre star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star dre star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-4-warning">Please give Rating</td>
                                        </tr>
                                        <tr>
                                            <td>Knowledge</td>
                                            <td class="star-container-5" style="width: 37%;">
                                                <i class="fa-solid fa-star kno star-1" data-val="1"></i>
                                                <i class="fa-solid fa-star kno star-2" data-val="2"></i>
                                                <i class="fa-solid fa-star kno star-3" data-val="3"></i>
                                                <i class="fa-solid fa-star kno star-4" data-val="4"></i>
                                                <i class="fa-solid fa-star kno star-5" data-val="5"></i>
                                            </td>
                                            <td style="color: red;display:none;width: 32%;font-size: x-small;" id="star-container-5-warning">Please give Rating</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col col-lg-5 mt-4 ms-5 action">
                            <div class="row">
                                <table class="table table-borderless w-75 ms-5">
                                    <tbody>
                                        <tr>
                                            <td>Overall Performance</td>
                                            <td>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                                <i class="fa-solid res fa-star"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="hidden" id="OverAllRating" name="OverAllRating" />
                                <p>Candidate Rating - <span id="OverAllRatingspan"></span></p>
                                <textarea class="form-control mt-3 ms-4" name="InterviewRemarks" id="InterviewRemarks" placeholder="Write a remark..." required></textarea>
                                <div class="col col-12 mt-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus2" value="2" required>
                                        <label class="form-check-label" for="inlineRadio2">Selected</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus3" value="3" required>
                                        <label class="form-check-label" for="inlineRadio3">Hold</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus4" value="4" required>
                                        <label class="form-check-label" for="inlineRadio4">Rejected</label>
                                    </div>
                                </div>
                                <div class="modal fade bd-example-modal-sm" id="interviewdatemodel6" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Next Round DateTime</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12 ">
                                                    <div class="wrapper-select-size">
                                                        <input type="radio" name="IVdate" value="" id="option-1">
                                                        <label for="option-1" class="option option-1"><span>Today</span></label>
                                                        <input type="radio" name="IVdate" value="" id="option-2">
                                                        <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                    </div>
                                                </div>
                                                <div class="form-row interdate">
                                                    <input type="hidden" name="InterviewDate" id="InterviewDate6" />
                                                    <div class="input-group ms-2 mt-2">
                                                        <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                                        <input type="text" id="IntDate6" class="form-control IntDate" placeholder="Select a Date">
                                                    </div>
                                                    <div class="input-group ms-2 mt-3">
                                                        <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                                        <input type="time" id="IntTime6" class="form-control IntTime" placeholder="Select a Time">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn model" name="IVdateClose" data-bs-dismiss="modal" disabled>OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn sub mt-2 mb-2">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php } elseif ($roundList[0]['RoundID'] >= 6) { ?>
                <div class="row">
                    <div class="col col-lg-5 mt-4 ms-5">
                        <div class="row w-75">
                            <div class="over">
                                <span style="color: #8146D4;">Interviewer : </span><strong><?= $roundDetails[5]['InterviewerName'] ?></strong>
                            </div>
                            <table class="table table-borderless mt-2">
                                <tbody>
                                    <tr>
                                        <td>Communication</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[5]['Communication']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Attitude</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[5]['Attitude']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Discipline</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[5]['Discipline']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dress Code</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[5]['DressCode']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Knowledge</td>
                                        <td>
                                            <?php for ($i = 1, $j = $roundDetails[5]['Knowledge']; $i <= 5; $i++) {
                                                if ($i <= $j) { ?>
                                                    <i class="fa-solid fa-star active"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-star"></i>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col col-lg-5 mt-4 ms-5 action">
                        <div class="row">
                            <?php if ($roundDetails[5]['InterviewStatus'] == 1) { ?>

                            <?php } else if ($roundDetails[5]['InterviewStatus'] == 2 || $roundDetails[5]['InterviewStatus'] == 0) { ?>
                                <div class="selected">
                                    <span><i class="fa-solid fa-check"></i> SELECTED</span>
                                </div>
                            <?php } else if ($roundDetails[5]['InterviewStatus'] == 3) { ?>
                                <div class="hold">
                                    <span><i class="fa-solid fa-pause"></i> HOLD</span>
                                </div>
                            <?php } else if ($roundDetails[5]['InterviewStatus'] == 4) { ?>
                                <div class="rejected">
                                    <span><i class="fa-solid fa-xmark"></i> REJECTED</span>
                                </div>
                            <?php } ?>
                            <table class="table table-borderless w-75 ms-5 mt-2">
                                <tbody>
                                    <tr>
                                        <td>Overall Performance</td>
                                        <td>
                                            <?php
                                            for ($i = 1, $j = $roundDetails[5]['OverAllRating']; $i <= 5; $i++) {
                                                if ($i <= $j && ($i + 0.5) != $j) {
                                                    echo '<i class="fa-solid fa-star over active"></i>';
                                                } elseif (($i + 0.5) == $j) {
                                                    echo '<i class="fa-solid fa-star-half-stroke over active"></i>';
                                                } else {
                                                    echo '<i class="fa-solid fa-star"></i>';
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>Candidate Rating - <strong><?= $roundDetails[5]['OverAllRating'] ?></strong></p>
                            <?php if ($roundDetails[5]['InterviewStatus'] == 3) { ?>
                                <form action="<?= site_url('/update_interviewpro') ?>" method="post" class="RoundForm" id="RoundForm6">
                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                    <input type="hidden" name="RoundID" value="6" id="RoundID"> <!-- value="3" -->
                                    <input type="hidden" name="InterviewerIDFK" value="<?= $roundDetails[5]['InterviewerId'] ?>">
                                    <input type="hidden" id="Communication6" name="Communication" value="<?= $roundDetails[5]['Communication'] ?>" />
                                    <input type="hidden" id="Attitude6" name="Attitude" value="<?= $roundDetails[5]['Attitude'] ?>" />
                                    <input type="hidden" id="Discipline6" name="Discipline" value="<?= $roundDetails[5]['Discipline'] ?>" />
                                    <input type="hidden" id="DressCode6" name="DressCode" value="<?= $roundDetails[5]['DressCode'] ?>" />
                                    <input type="hidden" id="Knowledge6" name="Knowledge" value="<?= $roundDetails[5]['Knowledge'] ?>" />
                                    <input type="hidden" name="OverAllRating" value="<?= $roundDetails[5]['OverAllRating'] ?>">
                                    <input type="hidden" name="Holdaction" value="1">
                                <?php } ?>
                                <textarea class="form-control mt-3 ms-4" name="InterviewRemarks" id="remarks" required><?= $roundDetails[5]['InterviewRemarks'] ?></textarea>
                                <?php if ($roundDetails[5]['InterviewStatus'] == 3) { ?>
                                    <div class="col col-12 mt-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus1" value="1" required>
                                            <label class="form-check-label" for="inlineRadio1">Pass Next Round</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus2" value="2" required>
                                            <label class="form-check-label" for="inlineRadio2">Selected</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="InterviewStatus" id="InterviewStatus4" value="4" required>
                                            <label class="form-check-label" for="inlineRadio4">Rejected</label>
                                        </div>
                                    </div> <!-- id="interviewdate3" -->
                                    <div class="modal fade bd-example-modal-sm" id="interviewdatemodel6" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Next Round DateTime</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-12 ">
                                                        <div class="wrapper-select-size">
                                                            <input type="radio" name="IVdate" value="" id="option-1">
                                                            <label for="option-1" class="option option-1"><span>Today</span></label>
                                                            <input type="radio" name="IVdate" value="" id="option-2">
                                                            <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row interdate"> <!-- InterviewDate3 -->
                                                        <input type="hidden" name="InterviewDate" id="InterviewDate6" />
                                                        <div class="input-group ms-2 mt-2">
                                                            <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                                            <input type="text" id="IntDate6" class="form-control IntDate" placeholder="Select a Date">
                                                        </div> <!-- IntDate3 -->
                                                        <div class="input-group ms-2 mt-3">
                                                            <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                                            <input type="time" id="IntTime6" class="form-control IntTime" placeholder="Select a Time">
                                                        </div> <!-- IntTime3 -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn model" name="IVdateClose" data-bs-dismiss="modal" disabled>OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-lg-8">
                                        <button type="submit" class="btn sub mt-2 mb-2">Submit</button>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="col col-lg-12 round" id="tab-round-7">
            <div class="mt-3 ms-3 me-3 mail" id="doc_mail" <?= ($document_mail_verification == 0) ? '' : 'style="display:none"' ?>>
                <form action="<?= site_url('/send_documentVerification_mail') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                    <input type="hidden" name="CandidateEmail" value="<?= $candidate_details[0]['CandidateEmail'] ?>">
                    <textarea class="form-control TinyMCE" name="docmailBody">
                        <p><strong>Hi <?= $candidate_details[0]['CandidateName'] ?>,</strong><br></p>
                        <p><strong>Greetings from Homes247.in,</strong><br></p>
                        <p>We are pleased to state that your profile has been shortlisted from the candidates' list for the&nbsp;role of<strong>&nbsp;<?= $candidate_details[0]['designations'] ?>.</strong><br></p>
                        <p>Hence do share your documents of Former Employment Details&nbsp;<strong>(Experience Letter,Relieving Letter,Payslips, Bank statement &amp; Education qualification certificate)</strong>&nbsp;for verification on or before&nbsp;<strong>XX-XX-&nbsp;2023.</strong><br></p>
                        <p>Once the verification is completed and is found satisfactory, we shall move further ahead to the next stage, i.e final scrutiny. And if the verification is found unsatisfactory, we shall not continue the process.<br></p>
                        <p>Your offer letter/mail will only be dispatched after the final round of the management filtering process.<br></p>
                        <p><br></p>
                        <p><strong>Note: Do note that this mail is not an offer confirmation from Homes247.in</strong><br></p>
                        <p><strong></strong><br></p>
                        <p><strong>Thanks and regards,&nbsp;</strong><br><strong>Human Resources Dept | Homes247.in&nbsp;</strong></p>
                        <p><strong>VSNAP Technology Solutions Pvt Ltd<br>HM Towers,5th Floor, East Wing, #58, Brigade Rd, Bengaluru, 560001&nbsp;<br>+91-9008026247 |&nbsp;<a data-cke-saved-href="mailto:hr@homes247.in" href="mailto:hr@homes247.in" target="_blank">hr@homes247.in</a>&nbsp;|&nbsp;þ</strong><strong>&nbsp;</strong><strong><a data-cke-saved-href="https://www.homes247.in/" href="https://www.homes247.in/" target="_blank">www.homes247.</a></strong><strong>in</strong></p> 
                    </textarea>
                    <button type="submit" class="btn mt-3 mb-3">Send</button>
                </form>
            </div>
            <div class="files ms-3 me-3" id="doc_files" <?= ((empty($documents) && $document_mail_verification != 0) || $documents[0]['DVStatus'] == 2) ? '' : 'style="display:none"' ?>>
                <div class="row mt-4">
                    <input type="file" id="fileUploader" multiple style="display: none;" />
                    <input type="file" id="fileReplacer" style="display: none;" />
                    <div class="col upload">
                        <span id="imp_doc_1">SSLC mark Sheet
                            <a href="javascript:void(0);" class="addfile" data-cat="1">
                                <i class="fa-solid fa-circle-plus"></i>
                            </a>
                        </span>
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
                        <span id="imp_doc_2">PUC mark Sheet
                            <a href="javascript:void(0);" class="addfile" data-cat="2">
                                <i class="fa-solid fa-circle-plus"></i>
                            </a>
                        </span>
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
                        <span id="imp_doc_3">Degree Certificate
                            <a href="javascript:void(0);" class="addfile" data-cat="3">
                                <i class="fa-solid fa-circle-plus"></i>
                            </a>
                        </span>
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
                        <span id="imp_doc_4">Aadhar Card
                            <a href="javascript:void(0);" class="addfile" data-cat="4">
                                <i class="fa-solid fa-circle-plus"></i>
                            </a>
                        </span>
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
                        <span id="imp_doc_5">PAN Card
                            <a href="javascript:void(0);" class="addfile" data-cat="5">
                                <i class="fa-solid fa-circle-plus"></i>
                            </a>
                        </span>
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
                        <span id="imp_doc_6">Experience letter <a href="javascript:void(0);" class="addfile" data-cat="6"><i
                                    class="fa-solid fa-circle-plus"></i></a></span>
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
                        <span id="imp_doc_7">Pay Slip <a href="javascript:void(0);" class="addfile" data-cat="7"><i
                                    class="fa-solid fa-circle-plus"></i></a></span>
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
                        <span id="imp_doc_8">Bank Statement <a href="javascript:void(0);" class="addfile" data-cat="8"><i
                                    class="fa-solid fa-circle-plus"></i></a></span>
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
                    <div class="col col-3 upload">
                        <span id="imp_doc_9">Employer Confirmation <a href="javascript:void(0);" class="addfile"
                                data-cat="9"><i class="fa-solid fa-circle-plus"></i></a></span>
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
                    <div class="col col-3 upload">
                        <span id="imp_doc_10">Other Documents <a href="javascript:void(0);" class="addfile" data-cat="10"><i
                                    class="fa-solid fa-circle-plus"></i></a></spa>
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
                    <div class="col col-6 upload">
                        <textarea class="form-control" name="uploadremark" id="uploadremark" placeholder="Write a remark..."><?= $documents[0]['DVRemarks'] ?? '' ?></textarea>
                    </div>
                </div>
                <div class="row mt-4">
                    <?php if ($documents[0]['DVStatus'] != 2) { ?>
                        <div class="row">
                            <div class="col docresend">
                                <button type="button" class="btn" id="doc_resend_mail"><i class="fa-solid fa-arrow-rotate-right fa-flip-horizontal" style="color: #8146d4;"></i> Resend Mail</button>
                            </div>
                            <div class="col buttons me-5 mb-3">
                                <a href="javascript:void(0);" class="btn btn-reject me-4">Reject <i class="fa-regular fa-circle-xmark"></i></a>
                                <a href="javascript:void(0);" class="btn btn-approve dissabled" id="btn-approve">Approve <i class="fa-regular fa-circle-check"></i></a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col buttons me-5 mb-3">
                            <a href="javascript:void(0);" class="btn btn-approve" style="pointer-events: none;">Approved <i class="fa-regular fa-circle-check"></i></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="docreject mt-3 mb-3 ms-3 me-3" id="doc_reject" <?= ($documents[0]['DVStatus'] == 1) ? '' : 'style="display:none"' ?>>
                <div class="row">
                    <div class="col col-lg-4"></div>
                    <div class="col col-lg-4">
                        <span><i class="fa-solid fa-circle-xmark"></i> REJECTED</span>
                        <textarea class="form-control mt-3" name="reason" id="rej_reason"><?= $documents[0]['DVRemarks'] ?? '' ?></textarea>
                        <div class="mt-3">
                            <button type="button" class="btn" id="doc_resend_mail"><i class="fa-solid fa-arrow-rotate-right fa-flip-horizontal" style="color: #8146d4;"></i> Resend Mail</button>
                            <button type="button" class="btn ms-2 upload" id="reapprovecandidate_btn"><i class="fa-solid fa-arrow-up-from-bracket" style="color: white;"></i> Upload files</button>
                        </div>
                    </div>
                    <div class="col col-lg-4"></div>
                </div>
            </div>
        </div>

        <div class="col col-lg-12 round" id="tab-round-8">
            <?php if (empty($offerLetter)) { ?>
                <form action="<?= site_url('/insert_offer_letter') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="CandidateIDFK" value="<?= $candidate_details[0]['CandidateId'] ?>">
                    <input type="hidden" name="CandidateName" value="<?= $candidate_details[0]['CandidateName'] ?>">
                    <input type="hidden" name="CandidateEmail" value="<?= $candidate_details[0]['CandidateEmail'] ?>">
                    <div class="row mt-3 ms-5">
                        <div class="col col-lg-3 mt-3 ms-2 me-5">
                            <select class="form-control" name="DepartmentIDFK" id="DepartmentIDFK">
                                <option value="">Select Department</option>
                                <?php
                                if ($selectdepart) {
                                    foreach ($selectdepart as $row) { ?>
                                        <option value="<?= $row["IDPK"] ?>"><?= $row["deptName"] ?> </option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="col col-lg-3 mt-3 ms-2 me-5">
                            <select class="form-control" name="DesignationIDFK" id="DesignationIDFK">
                                <option value="">Select Designation</option>
                                <?php
                                if ($selectdesignation) {
                                    foreach ($selectdesignation as $row) { ?>
                                        <option value="<?= $row["IDPK"] ?>"><?= $row["designations"] ?> </option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="col col-lg-3 mt-3 ms-2 me-5">
                            <select class="form-control" name="ReportManagerIDFK" id="ReportManagerIDFK">
                                <option value="">Reporting Manager</option>
                                <?php
                                if ($reportManager) {
                                    foreach ($reportManager as $row) { ?>
                                        <option value="<?= $row["EmployeeId"] ?>"><?= $row["EmployeeName"] ?> </option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="col col-lg-3 mt-3 ms-2 me-5">
                            <input class="form-control" type="text" name="TakeOmSalary" placeholder="Enter Salary">
                        </div>
                        <div class="col col-lg-3 mt-3 ms-2 me-5">
                            <input class="form-control" type="text" name="JoiningDate" id="offer-JoiningDate" placeholder="Enter Joining Date">
                        </div>
                        <div class="col col-lg-3 mt-3 ms-2 me-5">
                        </div>
                        <div class="col col-lg-11 mt-3 ms-2">
                            <textarea class="form-control TinyMCE" name="OL_OfferMsg" id="OL_OfferMsg">
                                <p>Hi <?= $candidate_details[0]['CandidateName'] ?>,<br></p>
                                <p>Congratulations!<br></p>
                                <p><strong>Greetings from VSNAP Technology Solutions Private Limited, Branded as Homes247.in</strong></p>
                                <p>After careful consideration, we are pleased to announce that we’ve decided to offer you the position of&nbsp;<strong>XXXXXXX,</strong>&nbsp;This email will serve as your formal offer. The start date for the position is <strong>XXXXXXXX&nbsp;</strong>as per discussion and you will be reporting to <b>XXXXXXX.</b></p>
                                <p><strong>Your Take Home Salary shall be&nbsp;<strong>XXXXXXX</strong>/- per Month</strong>&nbsp;after the professional tax deduction.&nbsp;<br></p>
                                <p>This position is considered as full time, with 9 hours of work per day which includes breaks, and our standard business hours are<strong>&nbsp;Tuesday</strong><strong>&nbsp;</strong><strong>To</strong><strong>&nbsp;Sunday</strong><strong>&nbsp;</strong><strong>(9:30 AM to 6:30 PM),</strong><strong>&nbsp;Mon</strong><strong>day</strong><strong>&nbsp;</strong><strong>will be the week off.</strong><br></p>   
                                <p>Your Probationary period will be for the first 6 months. The Performance Review Period is a time frame of three months (3) in which the company assesses the employee's quality of performance. If the employee does not qualify as per the company standards, the management will have full authority to terminate the said employee.&nbsp;This period comes under the probationary period of 6 months and starts from the day of joining.<br></p>
                                <p>Give us a confirmation mail on <strong>XXXXXXXX.&nbsp;</strong>If you fail to confirm within the mentioned TAT then you will consider that you are not interested in the opportunity and the offer will be cancelled without any intimation.<br></p>
                                <p>Visit this link for more information about our firm:&nbsp;<a data-cke-saved-href="http://www.homes247.in/" href="http://www.homes247.in/" target="_blank">https://www.homes247.in/</a><br></p>
                                <p><strong>Note:- Please bring original 10th marks card and a photocopy of your Highest qualification 12th or Degree,Aadhar, Pan card&nbsp;&nbsp;Along with 2 photographs.</strong></p>    
                                <p><strong>Thanks and regards,&nbsp;</strong><br><strong>Human Resources Dept | Homes247.in&nbsp;</strong></p>
                                <p><strong>VSNAP Technology Solutions Pvt Ltd<br>HM Towers,5th Floor, East Wing, #58, Brigade Rd, Bengaluru, 560001&nbsp;<br>+91-9008026247 |&nbsp;<a data-cke-saved-href="mailto:hr@homes247.in" href="mailto:hr@homes247.in" target="_blank">hr@homes247.in</a>&nbsp;|&nbsp;þ</strong><strong>&nbsp;</strong><strong><a data-cke-saved-href="https://www.homes247.in/" href="https://www.homes247.in/" target="_blank">www.homes247.</a></strong><strong>in</strong></p>
                            </textarea>
                        </div>
                    </div>
                    <div class="mt-3 mb-3 submit me-5">
                        <button type="submit" class="btn me-5">Send</button>
                    </div>
                </form>
            <?php } else { ?>
                <div class="row mt-3 ms-2">
                    <span>Take Home Salary: <?= $offerLetter[0]['TakeOmSalary'] ?></span>
                    <span>Joining Date: <?= $offerLetter[0]['JoiningDate'] ?></span>
                    <span>Reporting Manager: <?= $offerLetter[0]['ReportingManageName'] ?></span>
                    <span>Designation: <?= $offerLetter[0]['designations'] ?></span>
                    <br><br>
                    <p><?= $offerLetter[0]['OL_OfferMsg'] ?><br></p>
                </div>
            <?php } ?>
        </div>

        <div class="col col-lg-12 round" id="tab-round-9">
            <div class="row mt-5 ms-4">
                <?php if ($offerLetter[0]['OL_Status'] == 1) { ?>
                    <?php if ($offerLetter[0]['CandidateConfirmation'] == 2) { ?>
                        <div class="col col-4 mb-3 pt-3 pb-3 confirm">
                            <h4>Candidate Confirmation Status</h4>
                            <form action="<?= site_url('/update_confirmation') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" name="CandidateIDFK" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <div class="row ms-5 ps-1">
                                    <div class="ms-2 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="CandidateConfirmation" id="CandidateConfirmation1" value="1">
                                            <label class="form-check-label" for="CandidateConfirmation1">CONFIRM</label>
                                        </div>
                                    </div>
                                    <div class="ms-2 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="CandidateConfirmation" id="CandidateConfirmation2" value="2" checked>
                                            <label class="form-check-label" for="CandidateConfirmation2">NOT-CONFIRM</label>
                                        </div>
                                    </div>
                                </div>
                                <button class="submit mt-3 ms-2 dissabled" id="CandidateConfirmationCheck">Submit</button>
                            </form>
                        </div>
                    <?php } else if ($offerLetter[0]['CandidateConfirmation'] == 1) { ?>
                        <div class="col col-4 mb-3 pt-3 pb-3 confirm-final">
                            <h4>Candidate Confirmation Status</h4>
                            <div class="row ms-5 ps-1">
                                <div class="ms-5 options">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" checked>
                                        <label class="form-check-label"> <?= ($offerLetter[0]['CandidateConfirmation'] == 1) ? 'CONFIRM' : 'NOT-CONFIRM' ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col col-4 mb-3 pt-3 pb-3 confirm">
                            <h4>Candidate Confirmation Status</h4>
                            <form action="<?= site_url('/update_confirmation') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" name="CandidateIDFK" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <div class="row ms-5 ps-1">
                                    <div class="ms-2 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="CandidateConfirmation" id="CandidateConfirmation1" value="1">
                                            <label class="form-check-label" for="CandidateConfirmation1">CONFIRM</label>
                                        </div>
                                    </div>
                                    <div class="ms-2 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="CandidateConfirmation" id="CandidateConfirmation2" value="2">
                                            <label class="form-check-label" for="CandidateConfirmation2">NOT-CONFIRM</label>
                                        </div>
                                    </div>
                                </div>
                                <button class="submit mt-3 ms-2 dissabled" id="CandidateConfirmationCheck">Submit</button>
                            </form>
                        </div>
                    <?php } ?>

                    <?php if ($offerLetter[0]['JoiningStatus'] == 1) { ?>
                        <div class="col col-4 mb-3 ms-5 pt-3 pb-3 confirm-final">
                            <h4>Candidate Joining Status</h4>
                            <div class="row ms-5 ps-1">
                                <div class="ms-5 options">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" checked>
                                        <label class="form-check-label"><?= ($offerLetter[0]['JoiningStatus'] == 1) ? 'JOINED' : 'NOT-JOINED' ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else if ($offerLetter[0]['JoiningStatus'] == 2) { ?>
                        <div class="col col-4 mb-3 ms-5 pt-3 pb-3 confirm <?= ($offerLetter[0]['CandidateConfirmation'] != 1) ? 'dissabled' : '' ?>">
                            <h4>Candidate Joining Status</h4>
                            <form action="<?= site_url('/update_JoinStatus') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" name="CandidateIDFK" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <div class="row ms-3 ps-1">
                                    <div class="ms-2 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="JoiningStatus" id="JoiningStatus1" value="1">
                                            <label class="form-check-label" for="JoiningStatus1">JOINED</label>
                                        </div>
                                    </div>
                                    <div class="ms-2 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="JoiningStatus" id="JoiningStatus2" value="2" checked>
                                            <label class="form-check-label" for="JoiningStatus2">NOT-JOINED</label>
                                        </div>
                                    </div>
                                </div>
                                <button class="submit mt-3 ms-2 dissabled" id="JoiningStatusCheck">Submit</button>
                            </form>
                        </div>
                    <?php } else { ?>
                        <div class="col col-4 mb-3 ms-5 pt-3 pb-3 confirm <?= ($offerLetter[0]['CandidateConfirmation'] != 1) ? 'dissabled' : '' ?>">
                            <h4>Candidate Joining Status</h4>
                            <form action="<?= site_url('/update_JoinStatus') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" name="CandidateIDFK" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <div class="row ms-3 ps-1">
                                    <div class="ms-2 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="JoiningStatus" id="JoiningStatus1" value="1">
                                            <label class="form-check-label" for="JoiningStatus1">JOINED</label>
                                        </div>
                                    </div>
                                    <div class="ms-2 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="JoiningStatus" id="JoiningStatus2" value="2">
                                            <label class="form-check-label" for="JoiningStatus2">NOT-JOINED</label>
                                        </div>
                                    </div>
                                </div>
                                <button class="submit mt-3 ms-2 dissabled" id="JoiningStatusCheck">Submit</button>
                            </form>
                        </div>
                    <?php } ?>

                    <?php if ($offerLetter[0]['WorkingStatus'] == 1) { ?>
                        <?php
                        if ($offerLetter[0]['WorkingStatus'] == 1) {
                            $st = "ACTIVE";
                        } else if ($offerLetter[0]['WorkingStatus'] == 2) {
                            $st = "INACTIVE";
                        } else if ($offerLetter[0]['WorkingStatus'] == 3) {
                            $st = "ABSCOND";
                        }
                        ?>
                        <div class="col col-4 mb-3 ms-5 pt-3 pb-3 confirm-final">
                            <h4>Candidate Working Status</h4>
                            <div class="row ms-5 ps-1">
                                <div class="ms-5 options">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" checked>
                                        <label class="form-check-label"><?= $st ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else if ($offerLetter[0]['WorkingStatus'] == 2) { ?>
                        <div class="col col-4 mb-3 ms-5 pt-3 pb-3 confirm <?= ($offerLetter[0]['JoiningStatus'] != 1) ? 'dissabled' : '' ?>">
                            <h4>Candidate Working Status</h4>
                            <form action="<?= site_url('/update_WorkingStatus') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                                <input type="hidden" name="CandidateIDFK" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <div class="row ms-1 ps-1 pe-3">
                                    <div class="ms-1 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="WorkingStatus" id="WorkingStatus1" value="1">
                                            <label class="form-check-label" for="WorkingStatus1">ACTIVE</label>
                                        </div>
                                    </div>
                                    <div class="ms-2 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="WorkingStatus" id="WorkingStatus2" value="2" checked>
                                            <label class="form-check-label" for="WorkingStatus2">INACTIVE</label>
                                        </div>
                                    </div>
                                    <div class="ms-2 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="WorkingStatus" id="WorkingStatus3" value="3">
                                            <label class="form-check-label" for="WorkingStatus3">ABSCOND</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center" id="EmployementType" style="display:none">
                                    <select class="form-control col-2 mt-2 mb-2 w-75" name="EmployementType">
                                        <option>Select EmployementType</option>
                                        <?php if ($selectEmpType) {
                                            foreach ($selectEmpType as $row) { ?>
                                                <option value="<?= $row["IDPK"] ?>"><?= $row["EmployeeTypeName"] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <button class="submit mt-3 ms-2 dissabled" id="WorkingStatusCheck">Submit</button>
                            </form>
                        </div>
                    <?php } else if ($offerLetter[0]['WorkingStatus'] == 3) { ?>
                        <div class="col col-4 mb-3 ms-5 pt-3 pb-3 confirm <?= ($offerLetter[0]['JoiningStatus'] != 1) ? 'dissabled' : '' ?>">
                            <h4>Candidate Working Status</h4>
                            <form action="<?= site_url('/update_WorkingStatus') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                                <input type="hidden" name="CandidateIDFK" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <div class="row ms-1 ps-1 pe-3">
                                    <div class="ms-1 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="WorkingStatus" id="WorkingStatus1" value="1">
                                            <label class="form-check-label" for="WorkingStatus1">ACTIVE</label>
                                        </div>
                                    </div>
                                    <div class="ms-2 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="WorkingStatus" id="WorkingStatus2" value="2">
                                            <label class="form-check-label" for="WorkingStatus2">INACTIVE</label>
                                        </div>
                                    </div>
                                    <div class="ms-2 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="WorkingStatus" id="WorkingStatus3" value="3" checked>
                                            <label class="form-check-label" for="WorkingStatus3">ABSCOND</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center" id="EmployementType" style="display:none">
                                    <select class="form-control col-2 mt-2 mb-2 w-75" name="EmployementType">
                                        <option>Select EmployementType</option>
                                        <?php if ($selectEmpType) {
                                            foreach ($selectEmpType as $row) { ?>
                                                <option value="<?= $row["IDPK"] ?>"><?= $row["EmployeeTypeName"] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <button class="submit mt-3 ms-2 dissabled" id="WorkingStatusCheck">Submit</button>
                            </form>
                        </div>
                    <?php } else { ?>
                        <div class="col col-4 mb-3 ms-5 pt-3 pb-3 confirm <?= ($offerLetter[0]['JoiningStatus'] != 1) ? 'dissabled' : '' ?>">
                            <h4>Candidate Working Status</h4>
                            <form action="<?= site_url('/update_WorkingStatus') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                                <input type="hidden" name="CandidateIDFK" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <div class="row ms-1 ps-1 pe-3">
                                    <div class="ms-1 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="WorkingStatus" id="WorkingStatus1" value="1">
                                            <label class="form-check-label" for="WorkingStatus1">ACTIVE</label>
                                        </div>
                                    </div>
                                    <div class="ms-2 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="WorkingStatus" id="WorkingStatus2" value="2">
                                            <label class="form-check-label" for="WorkingStatus2">INACTIVE</label>
                                        </div>
                                    </div>
                                    <div class="ms-2 options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="WorkingStatus" id="WorkingStatus3" value="3">
                                            <label class="form-check-label" for="WorkingStatus3">ABSCOND</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center" id="EmployementType" style="display:none">
                                    <select class="form-control col-2 mt-2 mb-2 w-75" name="EmployementType">
                                        <option>Select EmployementType</option>
                                        <?php if ($selectEmpType) {
                                            foreach ($selectEmpType as $row) { ?>
                                                <option value="<?= $row["IDPK"] ?>"><?= $row["EmployeeTypeName"] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <button class="submit mt-3 ms-2 dissabled" id="WorkingStatusCheck">Submit</button>
                            </form>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>

    </div>
</div>


<div class="modal candidate_history" id="candidate_history" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Candidate History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php
                $max = count($CanHistory);
                $i = 1;
                foreach ($CanHistory as $val) {
                    if ($i == 1) {
                ?>
                        <div class="card mb-2">
                            <div class="card-body pt-0 pb-0">
                                <div class="row">
                                    <div class="col col-sm-2 pt-2 pb-2">
                                        <span class="date"><?= date('d M Y', strtotime($val['added_date'])) ?></span>
                                        <span class="time"><?= date('h:i A', strtotime($val['added_date'])) ?></span>
                                    </div>
                                    <div class="col col-auto p-0 me-1 ms-1">
                                        <div class="line-end">
                                            <div class="ball"></div>
                                        </div>
                                    </div>
                                    <div class="col pt-2 pb-2">
                                        <span class="state"><?= $val['Status'] ?></span><br>
                                        <span><?= $val['Remarks'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else if ($i == $max) {
                    ?>
                        <div class="card mb-2">
                            <div class="card-body pt-0 pb-0">
                                <div class="row">
                                    <div class="col col-sm-2 pt-2 pb-2">
                                        <span class="date"><?= date('d M Y', strtotime($val['added_date'])) ?></span>
                                        <span class="time"><?= date('h:i A', strtotime($val['added_date'])) ?></span>
                                    </div>
                                    <div class="col col-auto p-0 me-1 ms-1">
                                        <div class="line-start">
                                            <div class="ball"></div>
                                        </div>
                                    </div>
                                    <div class="col pt-2 pb-2">
                                        <span class="state"><?= $val['Status'] ?></span><br>
                                        <span><?= $val['Remarks'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="card mb-2">
                            <div class="card-body pt-0 pb-0">
                                <div class="row">
                                    <div class="col col-sm-2 pt-2 pb-2">
                                        <span class="date"><?= date('d M Y', strtotime($val['added_date'])) ?></span>
                                        <span class="time"><?= date('h:i A', strtotime($val['added_date'])) ?></span>
                                    </div>
                                    <div class="col col-auto p-0 me-1 ms-1">
                                        <div class="line-mid">
                                            <div class="ball"></div>
                                        </div>
                                    </div>
                                    <div class="col pt-2 pb-2">
                                        <span class="state"><?= $val['Status'] ?></span><br>
                                        <span><?= $val['Remarks'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                    $i++;
                }
                ?>
            </div>
        </div>
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
                <input type="hidden" name="returnurl" value="interview_process">
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
                            <input type="email" class="form-control" name="CandidateEmail" value="<?= $candidate_details[0]['CandidateEmail'] ?>" placeholder="Enter Email" readonly>
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
                            <input class="form-control" type="file" name="CandidateResume" id="customFile" value="<?= $candidate_details[0]['CandidateResume'] ?>" <?= ($candidate_details[0]['CandidateResume']) ? '':'required' ?>>
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
    const activeButton = document.querySelector('.btn.tab.active');
    const roundss = document.querySelectorAll('.round');

    if (activeButton) {
        const dataTarget = activeButton.getAttribute('data-target');
        roundss.forEach(round => round.style.display = 'none');
        document.getElementById(dataTarget).style.display = 'block';
    } else {
        console.log('No active Tab found');
    }

    const dropdown = document.getElementById('drop-down');
    const dropup = document.getElementById('drop-up');
    const infobody = document.getElementById('info-body');

    const stars1 = document.querySelectorAll('.com');
    const stars2 = document.querySelectorAll('.att');
    const stars3 = document.querySelectorAll('.dis');
    const stars4 = document.querySelectorAll('.dre');
    const stars5 = document.querySelectorAll('.kno');
    const starsres = document.querySelectorAll('.res');
    const starContainer1 = document.querySelector('.star-container-1');
    const starContainer2 = document.querySelector('.star-container-2');
    const starContainer3 = document.querySelector('.star-container-3');
    const starContainer4 = document.querySelector('.star-container-4');
    const starContainer5 = document.querySelector('.star-container-5');

    const tabs = document.querySelectorAll('.tab');
    const rounds = document.querySelectorAll('.round');

    dropdown.addEventListener('click', function() {
        dropdown.style.display = 'none';
        infobody.style.display = 'flex';
        dropup.style.display = 'inline-block';
    });

    dropup.addEventListener('click', function() {
        dropup.style.display = 'none';
        infobody.style.display = 'none';
        dropdown.style.display = 'inline-block';
    });

    const addActiveClass = (index, stars) => {
        stars.forEach((star, i) => {
            if (i <= index) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
    };

    const addHvrClass = (index, stars) => {
        stars.forEach((star, i) => {
            if (i <= index) {
                star.classList.add('hvr');
            } else {
                star.classList.remove('hvr');
            }
        });
    };

    if (starContainer1) {
        stars1.forEach((star, index) => {
            star.addEventListener('mouseover', () => addHvrClass(index, stars1));
            star.addEventListener('click', () => addActiveClass(index, stars1));
        });

        stars2.forEach((star, index) => {
            star.addEventListener('mouseover', () => addHvrClass(index, stars2));
            star.addEventListener('click', () => addActiveClass(index, stars2));
        });

        stars3.forEach((star, index) => {
            star.addEventListener('mouseover', () => addHvrClass(index, stars3));
            star.addEventListener('click', () => addActiveClass(index, stars3));
        });

        stars4.forEach((star, index) => {
            star.addEventListener('mouseover', () => addHvrClass(index, stars4));
            star.addEventListener('click', () => addActiveClass(index, stars4));
        });

        stars5.forEach((star, index) => {
            star.addEventListener('mouseover', () => addHvrClass(index, stars5));
            star.addEventListener('click', () => addActiveClass(index, stars5));
        });

        starContainer1.addEventListener('mouseout', () => {
            stars1.forEach((star) => star.classList.remove('hvr'));
        });
        starContainer2.addEventListener('mouseout', () => {
            stars2.forEach((star) => star.classList.remove('hvr'));
        });
        starContainer3.addEventListener('mouseout', () => {
            stars3.forEach((star) => star.classList.remove('hvr'));
        });
        starContainer4.addEventListener('mouseout', () => {
            stars4.forEach((star) => star.classList.remove('hvr'));
        });
        starContainer5.addEventListener('mouseout', () => {
            stars5.forEach((star) => star.classList.remove('hvr'));
        });
    }

    const handleTabClick = (event) => {
        tabs.forEach(tab => tab.classList.remove('active'));
        const clickedTab = event.currentTarget;
        clickedTab.classList.add('active');
        rounds.forEach(round => round.style.display = 'none');
        const targetId = clickedTab.getAttribute('data-target');
        document.getElementById(targetId).style.display = 'block';
    };
    tabs.forEach(tab => tab.addEventListener('click', handleTabClick));

    document.querySelectorAll('.IntTime').forEach(function(input) {
        input.addEventListener('click', function() {
            this.showPicker();
        });
    });

    $(document).ready(function() {

        // Form submission handler
        function validateField(fieldId, warningId) {
            const value = $(fieldId).val().trim();
            if (value === '') {
                $(warningId).show();
                $(fieldId).addClass('is-invalid');
                return false;
            } else {
                $(warningId).hide(); // Hide warning
                $(fieldId).removeClass('is-invalid'); // Remove highlight
                return true;
            }
        }
        $('.RoundForm').on("submit", function(e) {
            e.preventDefault(); // Prevent default submission
            const formId = $(this).attr('id'); // Get form ID dynamically
            const roundId = formId.replace('RoundForm', ''); // Extract RoundID from form ID
            let isValid = true;
            isValid &= validateField('#Communication'+roundId, '#star-container-1-warning');
            isValid &= validateField('#Attitude'+roundId, '#star-container-2-warning');
            isValid &= validateField('#Discipline'+roundId, '#star-container-3-warning');
            isValid &= validateField('#DressCode'+roundId, '#star-container-4-warning');
            isValid &= validateField('#Knowledge'+roundId, '#star-container-5-warning');

            console.log("form submit "+isValid+"rid "+roundId);
            if (isValid) {
                $(`#RoundForm${roundId}`).off("submit").submit(); // Submit the form dynamically
            }
        });



        var RoundID = $('#RoundID').val();
        $('input[name="InterviewStatus"]').on('change', function() {
            console.log("triggred=" + RoundID);

            if ($(this).val() == 1) {
                $('#interviewdatemodel' + RoundID).modal('show');
            } else {
                $('#interviewdatemodel' + RoundID).modal('hide');
            }
        });

        $('.interdate').hide();

        $("input[id$='option-2']").click(function() {
            $('.interdate').show();
            $('button[name=IVdateClose]').removeAttr('disabled');
        });

        $("input[id$='option-1']").click(function() {
            $('.interdate').hide();
            $('button[name=IVdateClose]').removeAttr('disabled');
        });

        $('.IntDate').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minDate: moment(),
            locale: {
                format: 'YYYY/MM/DD'
            }
        });

        $('#offer-JoiningDate').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: false,
            minDate: moment(),
            locale: {
                format: 'YYYY/MM/DD',
                cancelLabel: 'Clear'
            }
        });

        $('#offer-JoiningDate').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY/MM/DD'));
        });

        $('#IntDate1').on('change', function() {
            var val = $('#IntDate1').val() + ' ' + $('#IntTime1').val();
            $('#InterviewDate1').val(val);
        });
        $('#IntTime1').on('change', function() {
            var val = $('#IntDate1').val() + ' ' + $('#IntTime1').val();
            $('#InterviewDate1').val(val);
        });

        $('#IntDate2').on('change', function() {
            var val = $('#IntDate2').val() + ' ' + $('#IntTime2').val();
            $('#InterviewDate2').val(val);
        });
        $('#IntTime2').on('change', function() {
            var val = $('#IntDate2').val() + ' ' + $('#IntTime2').val();
            $('#InterviewDate2').val(val);
        });

        $('#IntDate3').on('change', function() {
            var val = $('#IntDate3').val() + ' ' + $('#IntTime3').val();
            $('#InterviewDate3').val(val);
        });
        $('#IntTime3').on('change', function() {
            var val = $('#IntDate3').val() + ' ' + $('#IntTime3').val();
            $('#InterviewDate3').val(val);
        });

        $('#IntDate4').on('change', function() {
            var val = $('#IntDate4').val() + ' ' + $('#IntTime4').val();
            $('#InterviewDate4').val(val);
        });
        $('#IntTime4').on('change', function() {
            var val = $('#IntDate4').val() + ' ' + $('#IntTime4').val();
            $('#InterviewDate4').val(val);
        });

        $('#IntDate5').on('change', function() {
            var val = $('#IntDate5').val() + ' ' + $('#IntTime5').val();
            $('#InterviewDate5').val(val);
        });
        $('#IntTime5').on('change', function() {
            var val = $('#IntDate5').val() + ' ' + $('#IntTime5').val();
            $('#InterviewDate5').val(val);
        });

        $('#IntDate6').on('change', function() {
            var val = $('#IntDate6').val() + ' ' + $('#IntTime6').val();
            $('#InterviewDate6').val(val);
        });
        $('#IntTime6').on('change', function() {
            var val = $('#IntDate6').val() + ' ' + $('#IntTime6').val();
            $('#InterviewDate6').val(val);
        });

        $('.com').on('click', function() {
            var val = $(this).data('val');
            $('#Communication'+RoundID).val(val);
            AverageRating();
        });

        $('.att').on('click', function() {
            var val = $(this).data('val');
            $('#Attitude'+RoundID).val(val);
            AverageRating();
        });

        $('.dis').on('click', function() {
            var val = $(this).data('val');
            $('#Discipline'+RoundID).val(val);
            AverageRating();
        });

        $('.dre').on('click', function() {
            var val = $(this).data('val');
            $('#DressCode'+RoundID).val(val);
            AverageRating();
        });

        $('.kno').on('click', function() {
            var val = $(this).data('val');
            $('#Knowledge'+RoundID).val(val);
            AverageRating();
        });

        // When the icon is clicked, trigger the file input
        $('.addfile').on('click', function() {
            var cat = $(this).data('cat');
            $('#fileUploader').data('cat', cat).click();
        });

        $('#fileUploader').on('change', function() {
            var selectedCategory = $(this).data('cat');
            const files = this.files;
            const formData = new FormData();
            Array.from(files).forEach(file => {
                formData.append('files[]', file);
            });
            formData.append('empid', <?= json_encode($candidate_details[0]['CandidateId']) ?>);
            formData.append('empname', <?= json_encode($candidate_details[0]['CandidateName']) ?>);
            formData.append('cat', selectedCategory);
            $.ajax({
                url: '<?php echo base_url('upload-files/1') ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // $('#doc_files').load(window.location.href + ' #doc_files');
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
            formData.append('empid', <?= json_encode($candidate_details[0]['CandidateId']) ?>);
            formData.append('empname', <?= json_encode($candidate_details[0]['CandidateName']) ?>);
            formData.append('id', id);
            formData.append('cat', selectedCategory);
            $.ajax({
                url: '<?php echo base_url('replace-files/1') ?>',
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
            formData.append('empid', <?= json_encode($candidate_details[0]['CandidateId']) ?>);
            formData.append('empname', <?= json_encode($candidate_details[0]['CandidateName']) ?>);
            formData.append('id', id);
            $.ajax({
                url: '<?php echo base_url('remove-files/1') ?>',
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

        $('.btn-reject').on('click', function() {
            var remarks = $('#uploadremark').val();
            const formData = new FormData();
            formData.append('CandidateIDFK', <?= json_encode($candidate_details[0]['CandidateId']) ?>);
            formData.append('DVRemarks', remarks);
            formData.append('DVStatus', 1);
            $.ajax({
                url: '<?php echo base_url('doucument-verification-update') ?>',
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

        $('.btn-approve').on('click', function() {
            var remarks = $('#uploadremark').val();
            const formData = new FormData();
            formData.append('CandidateIDFK', <?= json_encode($candidate_details[0]['CandidateId']) ?>);
            formData.append('DVRemarks', remarks);
            formData.append('DVStatus', 2);
            $.ajax({
                url: '<?php echo base_url('doucument-verification-update') ?>',
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

        $('.round').on('click', '#reapprovecandidate_btn', function() {
            $.ajax({
                url: '<?php echo base_url('reapprovecandidate/'.$candidate_details[0]['CandidateId']) ?>',
                type: 'GET',
                success: function(response) {
                    location.reload(true);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

        $('.round').on('click', '#doc_resend_mail', function() {
            $('#doc_mail').show();
            $('#doc_files').hide();
            $('#doc_reject').hide();
        });

        $('#doc_upload_doc').on('click', function() {
            $('#doc_mail').hide();
            $('#doc_files').show();
            $('#doc_reject').hide();
        });

        $('input[name="CandidateConfirmation"]').on('change', function() {
            var val = $(this).val();
            if (val) {
                $('#CandidateConfirmationCheck').removeClass('dissabled');
            }
        });

        $('input[name="JoiningStatus"]').on('change', function() {
            var val = $(this).val();
            if (val) {
                $('#JoiningStatusCheck').removeClass('dissabled');
            }
        });

        $('input[name="WorkingStatus"]').on('change', function() {
            var val = $(this).val();
            if (val == 1) {
                $('#EmployementType').show();
                $('#WorkingStatusCheck').removeClass('dissabled');
            } else if (val) {
                $('#EmployementType').hide();
                $('#WorkingStatusCheck').removeClass('dissabled');
            }
        });

        ImportantFiles();
    });

    function AverageRating() {
        let val1 = parseFloat($('#Communication').val()) || 0;
        let val2 = parseFloat($('#Attitude').val()) || 0;
        let val3 = parseFloat($('#Discipline').val()) || 0;
        let val4 = parseFloat($('#DressCode').val()) || 0;
        let val5 = parseFloat($('#Knowledge').val()) || 0;
        let ave = Math.round(((val1 + val2 + val3 + val4 + val5) / 5) * 2) / 2;
        $('#OverAllRating').val(ave);
        $('#OverAllRatingspan').html(ave);
        starsres.forEach((star, i) => {
            if (i < ave - 0.5) {
                star.classList.remove('fa-star-half-stroke');
                star.classList.add('fa-star', 'active');
            } else if (i < ave) {
                star.classList.remove('fa-star');
                star.classList.add('fa-star-half-stroke', 'active');
            } else {
                star.classList.remove('fa-star', 'fa-star-half-stroke', 'active');
                star.classList.add('fa-star');
            }
        });
    }

    function ImportantFiles() {
        var file_count = <?= json_encode($File_counts) ?>;
        var flag = true;
        var limit = <?= ($candidate_details[0]['CandidateExperience'] == 1) ? 5 : 9 ?>;
        for (var i = 1; i <= 10; i++) {
            if (file_count[i] != 0) {
                $('#imp_doc_' + i).css('color', '#029008');
            } else {
                $('#imp_doc_' + i).css('color', '');
            }
            if (file_count[i] == 0 && i <= limit) {
                flag = false;
            }
        }
        if (flag) {
            $('#btn-approve').removeClass('dissabled');
        }
    }
</script>

<?= $this->endSection() ?>