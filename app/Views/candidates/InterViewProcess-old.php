<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header") ?>
<?= $this->section("body") ?>

<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Interview Started</h1>
                </div>
                <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div> -->
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-lg-4">
                    <!-- Profile Image -->
                    <div class="card card-orange card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center"><?= $candidate_details[0]['CandidateName'] ?></h3>

                            <p class="text-muted text-center"><?= $candidate_details[0]['designations'] ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"><?= $candidate_details[0]['CandidateEmail'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Mobile No</b> <a class="float-right"><?= $candidate_details[0]['CandidateContactNo'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Source</b> <a class="float-right"><?= $candidate_details[0]['SM_Name'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Interview Date</b> <a class="float-right"><?= $candidate_details[0]['InterviewDate'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b>
                                    <a class="float-right">
                                        <?php if ($candidate_details[0]['ScheduleStatus'] == 10) {
                                            echo 'Processing';
                                        } elseif ($candidate_details[0]['ScheduleStatus'] == 0) {
                                            echo 'Selected';
                                        } else {
                                            echo 'Not Started';
                                        } ?>
                                    </a>
                                </li>
                            </ul>
                            <div class="cv text-center" style="padding-top: 8px; ">
                                <a href="<?php echo site_url('public/Uploads/candidates/' . $candidate_details[0]['CandidateId'] . '-' . $candidate_details[0]['CandidateName'] . '/' . $candidate_details[0]['CandidateResume']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> View Resume</b></a>
                                <a href="<?= site_url('/provious_rounds?canId=' . $candidate_details[0]['CandidateId']) ?>" class="btn btn-sm bg-orange mt-1"><b>Overview</b></a>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
                <?php if (($candidate_details[0]['ScheduleStatus'] == 10) || ($candidate_details[0]['ScheduleStatus'] == 0)) { ?>

                    <?php if ((empty($roundList[0]['InterviewStatus']) || $roundList[0]['InterviewStatus'] != 2)) { ?>

                        <?php if (empty($roundList)) { ?>
                            <div class="col-md-8">
                                <div class="card card-orange card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-four-round1-tab" data-toggle="pill" href="#custom-tabs-four-round1" role="tab" aria-controls="custom-tabs-four-round1" aria-selected="true">Round 1</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-four-tabContent">
                                            <div class="tab-pane fade show active" id="custom-tabs-four-round1" role="tabpanel" aria-labelledby="custom-tabs-four-round1-tab">

                                                <form action="<?= site_url('/update_interviewpro') ?>" method="post">
                                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                                    <input type="hidden" name="RoundID" value="1">
                                                    <div class="form-row">
                                                        <div class="col-lg-6 mt-2 text-center">
                                                            <select class="form-control col-lg-7" style="margin-left: 80px;" name="InterviewerIDFK">
                                                                <option> Select Interviewer </option>
                                                                <?php foreach ($getInterviewerList as $row) { ?>
                                                                    <option value="<?php echo  $row["EmployeeId"] ?>">
                                                                        <?php echo $row["EmployeeName"]; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <span class="text-danger mt-2 error-msg" style="display:none">Please select an interviewer.</span>
                                                        </div>
                                                        <div class="col-lg-6 mt-2 text-center align-self-center">
                                                            <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                        </div>
                                                        <div class="col-md-6 mt-2 ">
                                                            <table class=" text-right " align="center">
                                                                <tr>
                                                                    <td>Communication </td>
                                                                    <td>
                                                                        <div class="Communication ">
                                                                            <input type="radio" id="Cstar5" name="Communication" value="5" />
                                                                            <label for="Cstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Cstar4" name="Communication" value="4" />
                                                                            <label for="Cstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Cstar3" name="Communication" value="3" />
                                                                            <label for="Cstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Cstar2" name="Communication" value="2" />
                                                                            <label for="Cstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Cstar1" name="Communication" value="1" />
                                                                            <label for="Cstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Attitude </td>
                                                                    <td>
                                                                        <div class="Attitude ">
                                                                            <input type="radio" id="Astar5" name="Attitude" value="5" />
                                                                            <label for="Astar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Astar4" name="Attitude" value="4" />
                                                                            <label for="Astar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Astar3" name="Attitude" value="3" />
                                                                            <label for="Astar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Astar2" name="Attitude" value="2" />
                                                                            <label for="Astar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Astar1" name="Attitude" value="1" />
                                                                            <label for="Astar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Discipline </td>
                                                                    <td>
                                                                        <div class="Discipline ">
                                                                            <input type="radio" id="Dstar5" name="Discipline" value="5" />
                                                                            <label for="Dstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Dstar4" name="Discipline" value="4" />
                                                                            <label for="Dstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Dstar3" name="Discipline" value="3" />
                                                                            <label for="Dstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Dstar2" name="Discipline" value="2" />
                                                                            <label for="Dstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Dstar1" name="Discipline" value="1" />
                                                                            <label for="Dstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>DressCode </td>
                                                                    <td>
                                                                        <div class="DressCode ">
                                                                            <input type="radio" id="DCstar5" name="DressCode" value="5" />
                                                                            <label for="DCstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="DCstar4" name="DressCode" value="4" />
                                                                            <label for="DCstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="DCstar3" name="DressCode" value="3" />
                                                                            <label for="DCstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="DCstar2" name="DressCode" value="2" />
                                                                            <label for="DCstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="DCstar1" name="DressCode" value="1" />
                                                                            <label for="DCstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Knowledge </td>
                                                                    <td>
                                                                        <div class="Knowledge ">
                                                                            <input type="radio" id="Kstar5" name="Knowledge" value="5" />
                                                                            <label for="Kstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Kstar4" name="Knowledge" value="4" />
                                                                            <label for="Kstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Kstar3" name="Knowledge" value="3" />
                                                                            <label for="Kstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Kstar2" name="Knowledge" value="2" />
                                                                            <label for="Kstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Kstar1" name="Knowledge" value="1" />
                                                                            <label for="Kstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-6 mt-2 text-center">
                                                            <table class=" text-right " align="center">
                                                                <tr>
                                                                    <td>OverAllRating </td>
                                                                    <td>

                                                                        <fieldset class="rate">
                                                                            <input type="radio" id="rating10" name="OverAllRating" value="5" disabled />
                                                                            <label for="rating10" title="5 stars"></label>
                                                                            <input type="radio" id="rating9" name="OverAllRating" value="4.5" disabled />
                                                                            <label class="half" for="rating9" title="4 1/2 stars"></label>

                                                                            <input type="radio" id="rating8" name="OverAllRating" value="4" disabled />
                                                                            <label for="rating8" title="4 stars"></label>
                                                                            <input type="radio" id="rating7" name="OverAllRating" value="3.5" disabled />
                                                                            <label class="half" for="rating7" title="3 1/2 stars"></label>

                                                                            <input type="radio" id="rating6" name="OverAllRating" value="3" disabled />
                                                                            <label for="rating6" title="3 stars"></label>
                                                                            <input type="radio" id="rating5" name="OverAllRating" value="2.5" disabled />
                                                                            <label class="half" for="rating5" title="2 1/2 stars"></label>

                                                                            <input type="radio" id="rating4" name="OverAllRating" value="2" disabled />
                                                                            <label for="rating4" title="2 stars"></label>
                                                                            <input type="radio" id="rating3" name="OverAllRating" value="1.5" disabled />
                                                                            <label class="half" for="rating3" title="1 1/2 stars"></label>

                                                                            <input type="radio" id="rating2" name="OverAllRating" value="1" disabled />
                                                                            <label for="rating2" title="1 star"></label>
                                                                            <input type="radio" id="rating1" name="OverAllRating" value="0.5" disabled />
                                                                            <label class="half" for="rating1" title="1/2 star"></label>
                                                                        </fieldset>

                                                                    </td>
                                                                </tr>
                                                                <tr>

                                                                    <td colspan='2' align="center">
                                                                        <p id="result"></p>
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                            <a class="btn btn-sm bg-orange mt-3" id="calculateRate">Calculate</a>

                                                            <textarea class="form-control mt-2" placeholder="Remark's" name="InterviewRemarks" required></textarea>


                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="1">
                                                                <label class="form-check-label">Pass Next Round</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="2">
                                                                <label class="form-check-label">Selected</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="3">
                                                                <label class="form-check-label">Hold</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="4">
                                                                <label class="form-check-label">Rejected</label>
                                                            </div>
                                                            <div class="modal fade bd-example-modal-sm" id="interviewdate" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                                    <div class="modal-content ">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Next Round DateTime</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-12 ">
                                                                                <div class="wrapper-select-size">
                                                                                    <input type="radio" name="IVdate" value="" id="option-1">
                                                                                    <input type="radio" name="IVdate" value="" id="option-2">
                                                                                    <label for="option-1" class="option option-1"><span>Today</span></label>
                                                                                    <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-row interdate">
                                                                                <div class="input-group date" id="reservationdatetime1" data-target-input="nearest">
                                                                                    <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate" id="IVdate" data-target="#reservationdatetime1" placeholder="Interview Date" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-primary" name="IVdateClose" data-dismiss="modal" disabled>OK</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm bg-orange float-right disabled submit-btn">Submit</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } elseif ($roundList[0]['RoundID'] == 1) { ?>
                            <div class="col-md-8">
                                <div class="card card-orange card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link " id="custom-tabs-four-round1-tab" data-toggle="pill" href="#custom-tabs-four-round1" role="tab" aria-controls="custom-tabs-four-round1" aria-selected="true">Round 1</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-four-round2-tab" data-toggle="pill" href="#custom-tabs-four-round2" role="tab" aria-controls="custom-tabs-four-round2" aria-selected="false">Round 2</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-four-tabContent">
                                            <div class="tab-pane fade " id="custom-tabs-four-round1" role="tabpanel" aria-labelledby="custom-tabs-four-round1-tab">

                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[0]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[0]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <!-- <i class="fa-regular fa-star-half-stroke star"></i>  -->
                                                                            <!-- <i class="fa-duotone fa-star-half"></i> -->

                                                                        <?php } else if ($roundDetails[0]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[0]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[0]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[0]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[0]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[0]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[0]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[0]['InterviewRemarks'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show active" id="custom-tabs-four-round2" role="tabpanel" aria-labelledby="custom-tabs-four-round2-tab">
                                                <form action="<?= site_url('/update_interviewpro') ?>" method="post">
                                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                                    <input type="hidden" name="RoundID" value="2">

                                                    <div class="form-row">
                                                        <div class="col-lg-6 mt-2 text-center ">
                                                            <select class="form-control col-lg-7" style="margin-left: 80px;" name="InterviewerIDFK">
                                                                <option> Select Interviewer </option>
                                                                <?php foreach ($getInterviewerList as $row) { ?>
                                                                    <option value="<?php echo  $row["EmployeeId"] ?>">
                                                                        <?php echo $row["EmployeeName"]; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <span class="text-danger mt-2 error-msg" style="display:none">Please select an interviewer.</span>
                                                        </div>

                                                        <div class="col-lg-6 mt-2 text-center align-self-center">
                                                            <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                        </div>
                                                        <div class="col-md-6 mt-2 ">
                                                            <table class=" text-right " align="center">
                                                                <tr>
                                                                    <td>Communication </td>
                                                                    <td>
                                                                        <div class="Communication ">
                                                                            <input type="radio" id="Cstar5" name="Communication" value="5" />
                                                                            <label for="Cstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Cstar4" name="Communication" value="4" />
                                                                            <label for="Cstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Cstar3" name="Communication" value="3" />
                                                                            <label for="Cstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Cstar2" name="Communication" value="2" />
                                                                            <label for="Cstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Cstar1" name="Communication" value="1" />
                                                                            <label for="Cstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Attitude </td>
                                                                    <td>
                                                                        <div class="Attitude ">
                                                                            <input type="radio" id="Astar5" name="Attitude" value="5" />
                                                                            <label for="Astar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Astar4" name="Attitude" value="4" />
                                                                            <label for="Astar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Astar3" name="Attitude" value="3" />
                                                                            <label for="Astar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Astar2" name="Attitude" value="2" />
                                                                            <label for="Astar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Astar1" name="Attitude" value="1" />
                                                                            <label for="Astar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Discipline </td>
                                                                    <td>
                                                                        <div class="Discipline ">
                                                                            <input type="radio" id="Dstar5" name="Discipline" value="5" />
                                                                            <label for="Dstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Dstar4" name="Discipline" value="4" />
                                                                            <label for="Dstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Dstar3" name="Discipline" value="3" />
                                                                            <label for="Dstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Dstar2" name="Discipline" value="2" />
                                                                            <label for="Dstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Dstar1" name="Discipline" value="1" />
                                                                            <label for="Dstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>DressCode </td>
                                                                    <td>
                                                                        <div class="DressCode ">
                                                                            <input type="radio" id="DCstar5" name="DressCode" value="5" />
                                                                            <label for="DCstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="DCstar4" name="DressCode" value="4" />
                                                                            <label for="DCstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="DCstar3" name="DressCode" value="3" />
                                                                            <label for="DCstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="DCstar2" name="DressCode" value="2" />
                                                                            <label for="DCstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="DCstar1" name="DressCode" value="1" />
                                                                            <label for="DCstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Knowledge </td>
                                                                    <td>
                                                                        <div class="Knowledge ">
                                                                            <input type="radio" id="Kstar5" name="Knowledge" value="5" />
                                                                            <label for="Kstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Kstar4" name="Knowledge" value="4" />
                                                                            <label for="Kstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Kstar3" name="Knowledge" value="3" />
                                                                            <label for="Kstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Kstar2" name="Knowledge" value="2" />
                                                                            <label for="Kstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Kstar1" name="Knowledge" value="1" />
                                                                            <label for="Kstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-6 mt-2 text-center">
                                                            <table class=" text-right " align="center">
                                                                <tr>
                                                                    <td>OverAllRating </td>
                                                                    <td>

                                                                        <fieldset class="rate">
                                                                            <input type="radio" id="rating10" name="OverAllRating" value="5" disabled />
                                                                            <label for="rating10" title="5 stars"></label>
                                                                            <input type="radio" id="rating9" name="OverAllRating" value="4.5" disabled />
                                                                            <label class="half" for="rating9" title="4 1/2 stars"></label>
                                                                            
                                                                            <input type="radio" id="rating8" name="OverAllRating" value="4" disabled />
                                                                            <label for="rating8" title="4 stars"></label>
                                                                            <input type="radio" id="rating7" name="OverAllRating" value="3.5" disabled />
                                                                            <label class="half" for="rating7" title="3 1/2 stars"></label>

                                                                            <input type="radio" id="rating6" name="OverAllRating" value="3" disabled />
                                                                            <label for="rating6" title="3 stars"></label>
                                                                            <input type="radio" id="rating5" name="OverAllRating" value="2.5" disabled />
                                                                            <label class="half" for="rating5" title="2 1/2 stars"></label>

                                                                            <input type="radio" id="rating4" name="OverAllRating" value="2" disabled />
                                                                            <label for="rating4" title="2 stars"></label>
                                                                            <input type="radio" id="rating3" name="OverAllRating" value="1.5" disabled />
                                                                            <label class="half" for="rating3" title="1 1/2 stars"></label>

                                                                            <input type="radio" id="rating2" name="OverAllRating" value="1" disabled />
                                                                            <label for="rating2" title="1 star"></label>
                                                                            <input type="radio" id="rating1" name="OverAllRating" value="0.5" disabled />
                                                                            <label class="half" for="rating1" title="1/2 star"></label>
                                                                        </fieldset>

                                                                    </td>
                                                                </tr>
                                                                <tr>

                                                                    <td colspan='2' align="center">
                                                                        <p id="result"></p>
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                            <a class="btn btn-sm bg-orange mt-3" id="calculateRate">Calculate</a>

                                                            <textarea class="form-control mt-2" placeholder="Remark's" name="InterviewRemarks" required></textarea>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="1">
                                                                <label class="form-check-label">Pass Next Round</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="2">
                                                                <label class="form-check-label">Selected</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="3">
                                                                <label class="form-check-label">Hold</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="4">
                                                                <label class="form-check-label">Rejected</label>
                                                            </div>

                                                            <div class="modal fade bd-example-modal-sm" id="interviewdate" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                                    <div class="modal-content ">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Next Round DateTime</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-12 ">
                                                                                <div class="wrapper-select-size">
                                                                                    <input type="radio" name="IVdate" value="" id="option-1">
                                                                                    <input type="radio" name="IVdate" value="" id="option-2">
                                                                                    <label for="option-1" class="option option-1"><span>Today</span></label>
                                                                                    <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-row interdate">
                                                                                <div class="input-group date" id="reservationdatetime1" data-target-input="nearest">
                                                                                    <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate" id="IVdate" data-target="#reservationdatetime1" placeholder="Interview Date" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-primary" name="IVdateClose" data-dismiss="modal" disabled>OK</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm bg-orange float-right disabled submit-btn">Submit</button>


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } elseif ($roundList[0]['RoundID'] == 2) { ?>
                            <div class="col-md-8">
                                <div class="card card-orange card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-round1-tab" data-toggle="pill" href="#custom-tabs-four-round1" role="tab" aria-controls="custom-tabs-four-round1" aria-selected="true">Round 1</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-round2-tab" data-toggle="pill" href="#custom-tabs-four-round2" role="tab" aria-controls="custom-tabs-four-round2" aria-selected="false">Round 2</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link active" id="custom-tabs-four-round3-tab" data-toggle="pill" href="#custom-tabs-four-round3" role="tab" aria-controls="custom-tabs-four-round3" aria-selected="false">Round 3</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-four-tabContent">
                                            <div class="tab-pane fade " id="custom-tabs-four-round1" role="tabpanel" aria-labelledby="custom-tabs-four-round1-tab">

                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[0]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[0]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <!-- <i class="fa-regular fa-star-half-stroke star"></i>  -->
                                                                            <!-- <i class="fa-duotone fa-star-half"></i> -->

                                                                        <?php } else if ($roundDetails[0]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[0]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[0]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[0]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[0]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[0]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[0]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[0]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-four-round2" role="tabpanel" aria-labelledby="custom-tabs-four-round2-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[1]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[1]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[1]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[1]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[1]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[1]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[1]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[1]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[1]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show active" id="custom-tabs-four-round3" role="tabpanel" aria-labelledby="custom-tabs-four-round3-tab">
                                                <form action="<?= site_url('/update_interviewpro') ?>" method="post">
                                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                                    <input type="hidden" name="RoundID" value="3">
                                                    <div class="form-row">
                                                        <div class="col-lg-6 mt-2 text-center ">
                                                            <select class="form-control col-lg-7" style="margin-left: 80px;" name="InterviewerIDFK">
                                                                <option> Select Interviewer </option>
                                                                <?php foreach ($getInterviewerList as $row) { ?>
                                                                    <option value="<?php echo  $row["EmployeeId"] ?>">
                                                                        <?php echo $row["EmployeeName"]; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <span class="text-danger mt-2 error-msg" style="display:none">Please select an interviewer.</span>
                                                        </div>

                                                        <div class="col-lg-6 mt-2 text-center align-self-center">
                                                            <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                        </div>
                                                        <div class="col-md-6 mt-2 ">
                                                            <table class=" text-right " align="center">
                                                                <tr>
                                                                    <td>Communication </td>
                                                                    <td>
                                                                        <div class="Communication ">
                                                                            <input type="radio" id="Cstar5" name="Communication" value="5" />
                                                                            <label for="Cstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Cstar4" name="Communication" value="4" />
                                                                            <label for="Cstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Cstar3" name="Communication" value="3" />
                                                                            <label for="Cstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Cstar2" name="Communication" value="2" />
                                                                            <label for="Cstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Cstar1" name="Communication" value="1" />
                                                                            <label for="Cstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Attitude </td>
                                                                    <td>
                                                                        <div class="Attitude ">
                                                                            <input type="radio" id="Astar5" name="Attitude" value="5" />
                                                                            <label for="Astar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Astar4" name="Attitude" value="4" />
                                                                            <label for="Astar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Astar3" name="Attitude" value="3" />
                                                                            <label for="Astar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Astar2" name="Attitude" value="2" />
                                                                            <label for="Astar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Astar1" name="Attitude" value="1" />
                                                                            <label for="Astar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Discipline </td>
                                                                    <td>
                                                                        <div class="Discipline ">
                                                                            <input type="radio" id="Dstar5" name="Discipline" value="5" />
                                                                            <label for="Dstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Dstar4" name="Discipline" value="4" />
                                                                            <label for="Dstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Dstar3" name="Discipline" value="3" />
                                                                            <label for="Dstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Dstar2" name="Discipline" value="2" />
                                                                            <label for="Dstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Dstar1" name="Discipline" value="1" />
                                                                            <label for="Dstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>DressCode </td>
                                                                    <td>
                                                                        <div class="DressCode ">
                                                                            <input type="radio" id="DCstar5" name="DressCode" value="5" />
                                                                            <label for="DCstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="DCstar4" name="DressCode" value="4" />
                                                                            <label for="DCstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="DCstar3" name="DressCode" value="3" />
                                                                            <label for="DCstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="DCstar2" name="DressCode" value="2" />
                                                                            <label for="DCstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="DCstar1" name="DressCode" value="1" />
                                                                            <label for="DCstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Knowledge </td>
                                                                    <td>
                                                                        <div class="Knowledge ">
                                                                            <input type="radio" id="Kstar5" name="Knowledge" value="5" />
                                                                            <label for="Kstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Kstar4" name="Knowledge" value="4" />
                                                                            <label for="Kstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Kstar3" name="Knowledge" value="3" />
                                                                            <label for="Kstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Kstar2" name="Knowledge" value="2" />
                                                                            <label for="Kstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Kstar1" name="Knowledge" value="1" />
                                                                            <label for="Kstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-6 mt-2 text-center">
                                                            <table class=" text-right " align="center">
                                                                <tr>
                                                                    <td>OverAllRating </td>
                                                                    <td>

                                                                        <fieldset class="rate">
                                                                            <input type="radio" id="rating10" name="OverAllRating" value="5" disabled />
                                                                            <label for="rating10" title="5 stars"></label>
                                                                            <input type="radio" id="rating9" name="OverAllRating" value="4.5" disabled />
                                                                            <label class="half" for="rating9" title="4 1/2 stars"></label>

                                                                            <input type="radio" id="rating8" name="OverAllRating" value="4" disabled />
                                                                            <label for="rating8" title="4 stars"></label>
                                                                            <input type="radio" id="rating7" name="OverAllRating" value="3.5" disabled />
                                                                            <label class="half" for="rating7" title="3 1/2 stars"></label>

                                                                            <input type="radio" id="rating6" name="OverAllRating" value="3" disabled />
                                                                            <label for="rating6" title="3 stars"></label>
                                                                            <input type="radio" id="rating5" name="OverAllRating" value="2.5" disabled />
                                                                            <label class="half" for="rating5" title="2 1/2 stars"></label>

                                                                            <input type="radio" id="rating4" name="OverAllRating" value="2" disabled />
                                                                            <label for="rating4" title="2 stars"></label>
                                                                            <input type="radio" id="rating3" name="OverAllRating" value="1.5" disabled />
                                                                            <label class="half" for="rating3" title="1 1/2 stars"></label>

                                                                            <input type="radio" id="rating2" name="OverAllRating" value="1" disabled />
                                                                            <label for="rating2" title="1 star"></label>
                                                                            <input type="radio" id="rating1" name="OverAllRating" value="0.5" disabled />
                                                                            <label class="half" for="rating1" title="1/2 star"></label>
                                                                        </fieldset>

                                                                    </td>
                                                                </tr>
                                                                <tr>

                                                                    <td colspan='2' align="center">
                                                                        <p id="result"></p>
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                            <a class="btn btn-sm bg-orange mt-3" id="calculateRate">Calculate</a>

                                                            <textarea class="form-control mt-2" placeholder="Remark's" name="InterviewRemarks" required></textarea>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="1">
                                                                <label class="form-check-label">Pass Next Round</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="2">
                                                                <label class="form-check-label">Selected</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="3">
                                                                <label class="form-check-label">Hold</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="4">
                                                                <label class="form-check-label">Rejected</label>
                                                            </div>
                                                            <div class="modal fade bd-example-modal-sm" id="interviewdate" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                                    <div class="modal-content ">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Next Round DateTime</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-12 ">
                                                                                <div class="wrapper-select-size">
                                                                                    <input type="radio" name="IVdate" value="" id="option-1">
                                                                                    <input type="radio" name="IVdate" value="" id="option-2">
                                                                                    <label for="option-1" class="option option-1"><span>Today</span></label>
                                                                                    <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-row interdate">
                                                                                <div class="input-group date" id="reservationdatetime1" data-target-input="nearest">
                                                                                    <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate" id="IVdate" data-target="#reservationdatetime1" placeholder="Interview Date" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-primary" name="IVdateClose" data-dismiss="modal" disabled>OK</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm bg-orange float-right disabled submit-btn">Submit</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } elseif ($roundList[0]['RoundID'] == 3) { ?>
                            <div class="col-md-8">
                                <div class="card card-orange card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-round1-tab" data-toggle="pill" href="#custom-tabs-four-round1" role="tab" aria-controls="custom-tabs-four-round1" aria-selected="true">Round 1</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-round2-tab" data-toggle="pill" href="#custom-tabs-four-round2" role="tab" aria-controls="custom-tabs-four-round2" aria-selected="false">Round 2</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link " id="custom-tabs-four-round3-tab" data-toggle="pill" href="#custom-tabs-four-round3" role="tab" aria-controls="custom-tabs-four-round3" aria-selected="false">Round 3</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-four-round4-tab" data-toggle="pill" href="#custom-tabs-four-round4" role="tab" aria-controls="custom-tabs-four-round4" aria-selected="false">Round 4</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-four-tabContent">
                                            <div class="tab-pane fade " id="custom-tabs-four-round1" role="tabpanel" aria-labelledby="custom-tabs-four-round1-tab">

                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[0]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[0]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <!-- <i class="fa-regular fa-star-half-stroke star"></i>  -->
                                                                            <!-- <i class="fa-duotone fa-star-half"></i> -->

                                                                        <?php } else if ($roundDetails[0]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[0]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[0]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[0]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[0]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[0]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[0]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[0]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-four-round2" role="tabpanel" aria-labelledby="custom-tabs-four-round2-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[1]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[1]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[1]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[1]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[1]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[1]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[1]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[1]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[1]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-four-round3" role="tabpanel" aria-labelledby="custom-tabs-four-round3-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[2]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[2]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[2]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[2]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[2]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[2]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[2]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[2]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[2]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show active" id="custom-tabs-four-round4" role="tabpanel" aria-labelledby="custom-tabs-four-round4-tab">
                                                <form action="<?= site_url('/update_interviewpro') ?>" method="post">
                                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                                    <input type="hidden" name="RoundID" value="4">
                                                    <div class="form-row">
                                                        <div class="col-lg-6 mt-2 text-center ">
                                                            <select class="form-control col-lg-7" style="margin-left: 80px;" name="InterviewerIDFK">
                                                                <option> Select Interviewer </option>
                                                                <?php foreach ($getInterviewerList as $row) { ?>
                                                                    <option value="<?php echo  $row["EmployeeId"] ?>">
                                                                        <?php echo $row["EmployeeName"]; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <span class="text-danger mt-2 error-msg" style="display:none">Please select an interviewer.</span>
                                                        </div>

                                                        <div class="col-lg-6 mt-2 text-center align-self-center">
                                                            <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                        </div>
                                                        <div class="col-md-6 mt-2 ">
                                                            <table class=" text-right " align="center">
                                                                <tr>
                                                                    <td>Communication </td>
                                                                    <td>
                                                                        <div class="Communication ">
                                                                            <input type="radio" id="Cstar5" name="Communication" value="5" />
                                                                            <label for="Cstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Cstar4" name="Communication" value="4" />
                                                                            <label for="Cstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Cstar3" name="Communication" value="3" />
                                                                            <label for="Cstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Cstar2" name="Communication" value="2" />
                                                                            <label for="Cstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Cstar1" name="Communication" value="1" />
                                                                            <label for="Cstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Attitude </td>
                                                                    <td>
                                                                        <div class="Attitude ">
                                                                            <input type="radio" id="Astar5" name="Attitude" value="5" />
                                                                            <label for="Astar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Astar4" name="Attitude" value="4" />
                                                                            <label for="Astar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Astar3" name="Attitude" value="3" />
                                                                            <label for="Astar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Astar2" name="Attitude" value="2" />
                                                                            <label for="Astar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Astar1" name="Attitude" value="1" />
                                                                            <label for="Astar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Discipline </td>
                                                                    <td>
                                                                        <div class="Discipline ">
                                                                            <input type="radio" id="Dstar5" name="Discipline" value="5" />
                                                                            <label for="Dstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Dstar4" name="Discipline" value="4" />
                                                                            <label for="Dstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Dstar3" name="Discipline" value="3" />
                                                                            <label for="Dstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Dstar2" name="Discipline" value="2" />
                                                                            <label for="Dstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Dstar1" name="Discipline" value="1" />
                                                                            <label for="Dstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>DressCode </td>
                                                                    <td>
                                                                        <div class="DressCode ">
                                                                            <input type="radio" id="DCstar5" name="DressCode" value="5" />
                                                                            <label for="DCstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="DCstar4" name="DressCode" value="4" />
                                                                            <label for="DCstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="DCstar3" name="DressCode" value="3" />
                                                                            <label for="DCstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="DCstar2" name="DressCode" value="2" />
                                                                            <label for="DCstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="DCstar1" name="DressCode" value="1" />
                                                                            <label for="DCstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Knowledge </td>
                                                                    <td>
                                                                        <div class="Knowledge ">
                                                                            <input type="radio" id="Kstar5" name="Knowledge" value="5" />
                                                                            <label for="Kstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Kstar4" name="Knowledge" value="4" />
                                                                            <label for="Kstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Kstar3" name="Knowledge" value="3" />
                                                                            <label for="Kstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Kstar2" name="Knowledge" value="2" />
                                                                            <label for="Kstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Kstar1" name="Knowledge" value="1" />
                                                                            <label for="Kstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-6 mt-2 text-center">
                                                            <table class=" text-right " align="center">
                                                                <tr>
                                                                    <td>OverAllRating </td>
                                                                    <td>

                                                                        <fieldset class="rate">
                                                                            <input type="radio" id="rating10" name="OverAllRating" value="5" disabled />
                                                                            <label for="rating10" title="5 stars"></label>
                                                                            <input type="radio" id="rating9" name="OverAllRating" value="4.5" disabled />
                                                                            <label class="half" for="rating9" title="4 1/2 stars"></label>

                                                                            <input type="radio" id="rating8" name="OverAllRating" value="4" disabled />
                                                                            <label for="rating8" title="4 stars"></label>
                                                                            <input type="radio" id="rating7" name="OverAllRating" value="3.5" disabled />
                                                                            <label class="half" for="rating7" title="3 1/2 stars"></label>

                                                                            <input type="radio" id="rating6" name="OverAllRating" value="3" disabled />
                                                                            <label for="rating6" title="3 stars"></label>
                                                                            <input type="radio" id="rating5" name="OverAllRating" value="2.5" disabled />
                                                                            <label class="half" for="rating5" title="2 1/2 stars"></label>

                                                                            <input type="radio" id="rating4" name="OverAllRating" value="2" disabled />
                                                                            <label for="rating4" title="2 stars"></label>
                                                                            <input type="radio" id="rating3" name="OverAllRating" value="1.5" disabled />
                                                                            <label class="half" for="rating3" title="1 1/2 stars"></label>

                                                                            <input type="radio" id="rating2" name="OverAllRating" value="1" disabled />
                                                                            <label for="rating2" title="1 star"></label>
                                                                            <input type="radio" id="rating1" name="OverAllRating" value="0.5" disabled />
                                                                            <label class="half" for="rating1" title="1/2 star"></label>
                                                                        </fieldset>

                                                                    </td>
                                                                </tr>
                                                                <tr>

                                                                    <td colspan='2' align="center">
                                                                        <p id="result"></p>
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                            <a class="btn btn-sm bg-orange mt-3" id="calculateRate">Calculate</a>

                                                            <textarea class="form-control mt-2" placeholder="Remark's" name="InterviewRemarks" required></textarea>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="1">
                                                                <label class="form-check-label">Pass Next Round</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="2">
                                                                <label class="form-check-label">Selected</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="3">
                                                                <label class="form-check-label">Hold</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="4">
                                                                <label class="form-check-label">Rejected</label>
                                                            </div>
                                                            <div class="modal fade bd-example-modal-sm" id="interviewdate" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                                    <div class="modal-content ">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Next Round DateTime</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-12 ">
                                                                                <div class="wrapper-select-size">
                                                                                    <input type="radio" name="IVdate" value="" id="option-1">
                                                                                    <input type="radio" name="IVdate" value="" id="option-2">
                                                                                    <label for="option-1" class="option option-1"><span>Today</span></label>
                                                                                    <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-row interdate">
                                                                                <div class="input-group date" id="reservationdatetime1" data-target-input="nearest">
                                                                                    <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate" id="IVdate" data-target="#reservationdatetime1" placeholder="Interview Date" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-primary" name="IVdateClose" data-dismiss="modal" disabled>OK</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <button type="submit" class="btn btn-sm bg-orange float-right disabled submit-btn">Submit</button>


                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } elseif ($roundList[0]['RoundID'] == 4) { ?>
                            <div class="col-md-8">
                                <div class="card card-orange card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-round1-tab" data-toggle="pill" href="#custom-tabs-four-round1" role="tab" aria-controls="custom-tabs-four-round1" aria-selected="true">Round 1</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-round2-tab" data-toggle="pill" href="#custom-tabs-four-round2" role="tab" aria-controls="custom-tabs-four-round2" aria-selected="false">Round 2</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link " id="custom-tabs-four-round3-tab" data-toggle="pill" href="#custom-tabs-four-round3" role="tab" aria-controls="custom-tabs-four-round3" aria-selected="false">Round 3</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " id="custom-tabs-four-round4-tab" data-toggle="pill" href="#custom-tabs-four-round4" role="tab" aria-controls="custom-tabs-four-round4" aria-selected="false">Round 4</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-four-round5-tab" data-toggle="pill" href="#custom-tabs-four-round5" role="tab" aria-controls="custom-tabs-four-round5" aria-selected="false">Round 5</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-four-tabContent">
                                            <div class="tab-pane fade " id="custom-tabs-four-round1" role="tabpanel" aria-labelledby="custom-tabs-four-round1-tab">

                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[0]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[0]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <!-- <i class="fa-regular fa-star-half-stroke star"></i>  -->
                                                                            <!-- <i class="fa-duotone fa-star-half"></i> -->

                                                                        <?php } else if ($roundDetails[0]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[0]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[0]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[0]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[0]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[0]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[0]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[0]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-four-round2" role="tabpanel" aria-labelledby="custom-tabs-four-round2-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[1]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[1]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[1]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[1]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[1]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[1]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[1]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[1]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[1]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-four-round3" role="tabpanel" aria-labelledby="custom-tabs-four-round3-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[2]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[2]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[2]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[2]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[2]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[2]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[2]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[2]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[2]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade " id="custom-tabs-four-round4" role="tabpanel" aria-labelledby="custom-tabs-four-round4-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[3]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[3]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[3]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[3]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[3]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[3]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[3]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[3]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[3]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show active" id="custom-tabs-four-round5" role="tabpanel" aria-labelledby="custom-tabs-four-round5-tab">
                                                <form action="<?= site_url('/update_interviewpro') ?>" method="post">
                                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                                    <input type="hidden" name="RoundID" value="5">
                                                    <div class="form-row">
                                                        <div class="col-lg-6 mt-2 text-center ">
                                                            <select class="form-control col-lg-7" style="margin-left: 80px;" name="InterviewerIDFK">
                                                                <option> Select Interviewer </option>
                                                                <?php foreach ($getInterviewerList as $row) { ?>
                                                                    <option value="<?php echo  $row["EmployeeId"] ?>">
                                                                        <?php echo $row["EmployeeName"]; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <span class="text-danger mt-2 error-msg" style="display:none">Please select an interviewer.</span>
                                                        </div>

                                                        <div class="col-lg-6 mt-2 text-center align-self-center">
                                                            <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                        </div>
                                                        <div class="col-md-6 mt-2 ">
                                                            <table class=" text-right " align="center">
                                                                <tr>
                                                                    <td>Communication </td>
                                                                    <td>
                                                                        <div class="Communication ">
                                                                            <input type="radio" id="Cstar5" name="Communication" value="5" />
                                                                            <label for="Cstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Cstar4" name="Communication" value="4" />
                                                                            <label for="Cstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Cstar3" name="Communication" value="3" />
                                                                            <label for="Cstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Cstar2" name="Communication" value="2" />
                                                                            <label for="Cstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Cstar1" name="Communication" value="1" />
                                                                            <label for="Cstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Attitude </td>
                                                                    <td>
                                                                        <div class="Attitude ">
                                                                            <input type="radio" id="Astar5" name="Attitude" value="5" />
                                                                            <label for="Astar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Astar4" name="Attitude" value="4" />
                                                                            <label for="Astar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Astar3" name="Attitude" value="3" />
                                                                            <label for="Astar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Astar2" name="Attitude" value="2" />
                                                                            <label for="Astar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Astar1" name="Attitude" value="1" />
                                                                            <label for="Astar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Discipline </td>
                                                                    <td>
                                                                        <div class="Discipline ">
                                                                            <input type="radio" id="Dstar5" name="Discipline" value="5" />
                                                                            <label for="Dstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Dstar4" name="Discipline" value="4" />
                                                                            <label for="Dstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Dstar3" name="Discipline" value="3" />
                                                                            <label for="Dstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Dstar2" name="Discipline" value="2" />
                                                                            <label for="Dstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Dstar1" name="Discipline" value="1" />
                                                                            <label for="Dstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>DressCode </td>
                                                                    <td>
                                                                        <div class="DressCode ">
                                                                            <input type="radio" id="DCstar5" name="DressCode" value="5" />
                                                                            <label for="DCstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="DCstar4" name="DressCode" value="4" />
                                                                            <label for="DCstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="DCstar3" name="DressCode" value="3" />
                                                                            <label for="DCstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="DCstar2" name="DressCode" value="2" />
                                                                            <label for="DCstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="DCstar1" name="DressCode" value="1" />
                                                                            <label for="DCstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Knowledge </td>
                                                                    <td>
                                                                        <div class="Knowledge ">
                                                                            <input type="radio" id="Kstar5" name="Knowledge" value="5" />
                                                                            <label for="Kstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Kstar4" name="Knowledge" value="4" />
                                                                            <label for="Kstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Kstar3" name="Knowledge" value="3" />
                                                                            <label for="Kstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Kstar2" name="Knowledge" value="2" />
                                                                            <label for="Kstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Kstar1" name="Knowledge" value="1" />
                                                                            <label for="Kstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-6 mt-2 text-center">
                                                            <table class=" text-right " align="center">
                                                                <tr>
                                                                    <td>OverAllRating </td>
                                                                    <td>

                                                                        <fieldset class="rate">
                                                                            <input type="radio" id="rating10" name="OverAllRating" value="5" disabled />
                                                                            <label for="rating10" title="5 stars"></label>
                                                                            <input type="radio" id="rating9" name="OverAllRating" value="4.5" disabled />
                                                                            <label class="half" for="rating9" title="4 1/2 stars"></label>

                                                                            <input type="radio" id="rating8" name="OverAllRating" value="4" disabled />
                                                                            <label for="rating8" title="4 stars"></label>
                                                                            <input type="radio" id="rating7" name="OverAllRating" value="3.5" disabled />
                                                                            <label class="half" for="rating7" title="3 1/2 stars"></label>

                                                                            <input type="radio" id="rating6" name="OverAllRating" value="3" disabled />
                                                                            <label for="rating6" title="3 stars"></label>
                                                                            <input type="radio" id="rating5" name="OverAllRating" value="2.5" disabled />
                                                                            <label class="half" for="rating5" title="2 1/2 stars"></label>

                                                                            <input type="radio" id="rating4" name="OverAllRating" value="2" disabled />
                                                                            <label for="rating4" title="2 stars"></label>
                                                                            <input type="radio" id="rating3" name="OverAllRating" value="1.5" disabled />
                                                                            <label class="half" for="rating3" title="1 1/2 stars"></label>

                                                                            <input type="radio" id="rating2" name="OverAllRating" value="1" disabled />
                                                                            <label for="rating2" title="1 star"></label>
                                                                            <input type="radio" id="rating1" name="OverAllRating" value="0.5" disabled />
                                                                            <label class="half" for="rating1" title="1/2 star"></label>
                                                                        </fieldset>

                                                                    </td>
                                                                </tr>
                                                                <tr>

                                                                    <td colspan='2' align="center">
                                                                        <p id="result"></p>
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                            <a class="btn btn-sm bg-orange mt-3" id="calculateRate">Calculate</a>

                                                            <textarea class="form-control mt-2" placeholder="Remark's" name="InterviewRemarks" required></textarea>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="1">
                                                                <label class="form-check-label">Pass Next Round</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="2">
                                                                <label class="form-check-label">Selected</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="3">
                                                                <label class="form-check-label">Hold</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="4">
                                                                <label class="form-check-label">Rejected</label>
                                                            </div>
                                                            <div class="modal fade bd-example-modal-sm" id="interviewdate" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                                    <div class="modal-content ">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Next Round DateTime</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-12 ">
                                                                                <div class="wrapper-select-size">
                                                                                    <input type="radio" name="IVdate" value="" id="option-1">
                                                                                    <input type="radio" name="IVdate" value="" id="option-2">
                                                                                    <label for="option-1" class="option option-1"><span>Today</span></label>
                                                                                    <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-row interdate">
                                                                                <div class="input-group date" id="reservationdatetime1" data-target-input="nearest">
                                                                                    <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate" id="IVdate" data-target="#reservationdatetime1" placeholder="Interview Date" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-primary" name="IVdateClose" data-dismiss="modal" disabled>OK</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm bg-orange float-right disabled submit-btn">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } elseif ($roundList[0]['RoundID'] == 5) { ?>
                            <div class="col-md-8">
                                <div class="card card-orange card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-round1-tab" data-toggle="pill" href="#custom-tabs-four-round1" role="tab" aria-controls="custom-tabs-four-round1" aria-selected="true">Round 1</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-round2-tab" data-toggle="pill" href="#custom-tabs-four-round2" role="tab" aria-controls="custom-tabs-four-round2" aria-selected="false">Round 2</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link " id="custom-tabs-four-round3-tab" data-toggle="pill" href="#custom-tabs-four-round3" role="tab" aria-controls="custom-tabs-four-round3" aria-selected="false">Round 3</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " id="custom-tabs-four-round4-tab" data-toggle="pill" href="#custom-tabs-four-round4" role="tab" aria-controls="custom-tabs-four-round4" aria-selected="false">Round 4</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " id="custom-tabs-four-round5-tab" data-toggle="pill" href="#custom-tabs-four-round5" role="tab" aria-controls="custom-tabs-four-round5" aria-selected="false">Round 5</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-four-round6-tab" data-toggle="pill" href="#custom-tabs-four-round6" role="tab" aria-controls="custom-tabs-four-round6" aria-selected="false">Round 6</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-four-tabContent">
                                            <div class="tab-pane fade " id="custom-tabs-four-round1" role="tabpanel" aria-labelledby="custom-tabs-four-round1-tab">

                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[0]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[0]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <!-- <i class="fa-regular fa-star-half-stroke star"></i>  -->
                                                                            <!-- <i class="fa-duotone fa-star-half"></i> -->

                                                                        <?php } else if ($roundDetails[0]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[0]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[0]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Discipline'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[0]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[0]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[0]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[0]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[0]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[0]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[0]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-four-round2" role="tabpanel" aria-labelledby="custom-tabs-four-round2-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[1]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[1]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[1]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[1]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[1]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[1]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[1]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[1]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[1]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-four-round3" role="tabpanel" aria-labelledby="custom-tabs-four-round3-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[2]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[2]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[2]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[2]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[2]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[2]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[2]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[2]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[2]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade " id="custom-tabs-four-round4" role="tabpanel" aria-labelledby="custom-tabs-four-round4-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[3]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[3]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[3]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[3]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[3]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[3]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[3]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[3]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[3]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade " id="custom-tabs-four-round5" role="tabpanel" aria-labelledby="custom-tabs-four-round5-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[4]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[4]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[4]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[4]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[4]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[4]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[4]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[4]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[4]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade show active" id="custom-tabs-four-round6" role="tabpanel" aria-labelledby="custom-tabs-four-round6-tab">
                                                <form action="<?= site_url('/update_interviewpro') ?>" method="post">
                                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                                    <input type="hidden" name="RoundID" value="6">
                                                    <div class="form-row">
                                                        <div class="col-lg-6 mt-2 text-center ">
                                                            <select class="form-control col-lg-7" style="margin-left: 80px;" name="InterviewerIDFK">
                                                                <option> Select Interviewer </option>
                                                                <?php foreach ($getInterviewerList as $row) { ?>
                                                                    <option value="<?php echo  $row["EmployeeId"] ?>">
                                                                        <?php echo $row["EmployeeName"]; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <span class="text-danger mt-2 error-msg" style="display:none">Please select an interviewer.</span>
                                                        </div>

                                                        <div class="col-lg-6 mt-2 text-center align-self-center">
                                                            <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                        </div>
                                                        <div class="col-md-6 mt-2 ">
                                                            <table class=" text-right " align="center">
                                                                <tr>
                                                                    <td>Communication </td>
                                                                    <td>
                                                                        <div class="Communication ">
                                                                            <input type="radio" id="Cstar5" name="Communication" value="5" />
                                                                            <label for="Cstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Cstar4" name="Communication" value="4" />
                                                                            <label for="Cstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Cstar3" name="Communication" value="3" />
                                                                            <label for="Cstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Cstar2" name="Communication" value="2" />
                                                                            <label for="Cstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Cstar1" name="Communication" value="1" />
                                                                            <label for="Cstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Attitude </td>
                                                                    <td>
                                                                        <div class="Attitude ">
                                                                            <input type="radio" id="Astar5" name="Attitude" value="5" />
                                                                            <label for="Astar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Astar4" name="Attitude" value="4" />
                                                                            <label for="Astar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Astar3" name="Attitude" value="3" />
                                                                            <label for="Astar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Astar2" name="Attitude" value="2" />
                                                                            <label for="Astar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Astar1" name="Attitude" value="1" />
                                                                            <label for="Astar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Discipline </td>
                                                                    <td>
                                                                        <div class="Discipline ">
                                                                            <input type="radio" id="Dstar5" name="Discipline" value="5" />
                                                                            <label for="Dstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Dstar4" name="Discipline" value="4" />
                                                                            <label for="Dstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Dstar3" name="Discipline" value="3" />
                                                                            <label for="Dstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Dstar2" name="Discipline" value="2" />
                                                                            <label for="Dstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Dstar1" name="Discipline" value="1" />
                                                                            <label for="Dstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>DressCode </td>
                                                                    <td>
                                                                        <div class="DressCode ">
                                                                            <input type="radio" id="DCstar5" name="DressCode" value="5" />
                                                                            <label for="DCstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="DCstar4" name="DressCode" value="4" />
                                                                            <label for="DCstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="DCstar3" name="DressCode" value="3" />
                                                                            <label for="DCstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="DCstar2" name="DressCode" value="2" />
                                                                            <label for="DCstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="DCstar1" name="DressCode" value="1" />
                                                                            <label for="DCstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Knowledge </td>
                                                                    <td>
                                                                        <div class="Knowledge ">
                                                                            <input type="radio" id="Kstar5" name="Knowledge" value="5" />
                                                                            <label for="Kstar5" title="text">5 stars</label>
                                                                            <input type="radio" id="Kstar4" name="Knowledge" value="4" />
                                                                            <label for="Kstar4" title="text">4 stars</label>
                                                                            <input type="radio" id="Kstar3" name="Knowledge" value="3" />
                                                                            <label for="Kstar3" title="text">3 stars</label>
                                                                            <input type="radio" id="Kstar2" name="Knowledge" value="2" />
                                                                            <label for="Kstar2" title="text">2 stars</label>
                                                                            <input type="radio" id="Kstar1" name="Knowledge" value="1" />
                                                                            <label for="Kstar1" title="text">1 star</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-6 mt-2 text-center">
                                                            <table class=" text-right " align="center">
                                                                <tr>
                                                                    <td>OverAllRating </td>
                                                                    <td>

                                                                        <fieldset class="rate">
                                                                            <input type="radio" id="rating10" name="OverAllRating" value="5" disabled />
                                                                            <label for="rating10" title="5 stars"></label>
                                                                            <input type="radio" id="rating9" name="OverAllRating" value="4.5" disabled />
                                                                            <label class="half" for="rating9" title="4 1/2 stars"></label>

                                                                            <input type="radio" id="rating8" name="OverAllRating" value="4" disabled />
                                                                            <label for="rating8" title="4 stars"></label>
                                                                            <input type="radio" id="rating7" name="OverAllRating" value="3.5" disabled />
                                                                            <label class="half" for="rating7" title="3 1/2 stars"></label>

                                                                            <input type="radio" id="rating6" name="OverAllRating" value="3" disabled />
                                                                            <label for="rating6" title="3 stars"></label>
                                                                            <input type="radio" id="rating5" name="OverAllRating" value="2.5" disabled />
                                                                            <label class="half" for="rating5" title="2 1/2 stars"></label>

                                                                            <input type="radio" id="rating4" name="OverAllRating" value="2" disabled />
                                                                            <label for="rating4" title="2 stars"></label>
                                                                            <input type="radio" id="rating3" name="OverAllRating" value="1.5" disabled />
                                                                            <label class="half" for="rating3" title="1 1/2 stars"></label>

                                                                            <input type="radio" id="rating2" name="OverAllRating" value="1" disabled />
                                                                            <label for="rating2" title="1 star"></label>
                                                                            <input type="radio" id="rating1" name="OverAllRating" value="0.5" disabled />
                                                                            <label class="half" for="rating1" title="1/2 star"></label>
                                                                        </fieldset>

                                                                    </td>
                                                                </tr>
                                                                <tr>

                                                                    <td colspan='2' align="center">
                                                                        <p id="result" style=" margin-bottom: 6px;"></p>
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                            <a class="btn btn-sm bg-orange mt-3" id="calculateRate">Calculate</a>

                                                            <textarea class="form-control mt-2" placeholder="Remark's" name="InterviewRemarks" required></textarea>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="2">
                                                                <label class="form-check-label">Selected</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="3">
                                                                <label class="form-check-label">Hold</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="InterviewStatus" value="4">
                                                                <label class="form-check-label">Rejected</label>
                                                            </div>
                                                            <div class="modal fade bd-example-modal-sm" id="interviewdate" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                                    <div class="modal-content ">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Next Round DateTime</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-12 ">
                                                                                <div class="wrapper-select-size">
                                                                                    <input type="radio" name="IVdate" value="" id="option-1">
                                                                                    <input type="radio" name="IVdate" value="" id="option-2">
                                                                                    <label for="option-1" class="option option-1"><span>Today</span></label>
                                                                                    <label for="option-2" class="option option-2 xshow"><span>Next Day</span></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-row interdate">
                                                                                <div class="input-group date" id="reservationdatetime1" data-target-input="nearest">
                                                                                    <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate" id="IVdate" data-target="#reservationdatetime1" placeholder="Interview Date" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-primary" name="IVdateClose" data-dismiss="modal" disabled>OK</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm bg-orange float-right disabled submit-btn">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } elseif ($roundList[0]['InterviewStatus'] == 2) { ?>
                        <div class="col-md-8">
                            <div class="card card-orange card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-round1-tab" data-toggle="pill" href="#custom-tabs-four-round1" role="tab" aria-controls="custom-tabs-four-round1" aria-selected="true">Round 1</a>
                                        </li>
                                        <?php if (!empty($roundList[1])) { ?>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-round2-tab" data-toggle="pill" href="#custom-tabs-four-round2" role="tab" aria-controls="custom-tabs-four-round2" aria-selected="false">Round 2</a>
                                            </li>
                                        <?php } ?>
                                        <?php if (!empty($roundList[2])) { ?>
                                            <li class="nav-item ">
                                                <a class="nav-link " id="custom-tabs-four-round3-tab" data-toggle="pill" href="#custom-tabs-four-round3" role="tab" aria-controls="custom-tabs-four-round3" aria-selected="false">Round 3</a>
                                            </li>
                                        <?php } ?>
                                        <?php if (!empty($roundList[3])) { ?>
                                            <li class="nav-item">
                                                <a class="nav-link " id="custom-tabs-four-round4-tab" data-toggle="pill" href="#custom-tabs-four-round4" role="tab" aria-controls="custom-tabs-four-round4" aria-selected="false">Round 4</a>
                                            </li>
                                        <?php } ?>
                                        <?php if (!empty($roundList[4])) { ?>
                                            <li class="nav-item">
                                                <a class="nav-link " id="custom-tabs-four-round5-tab" data-toggle="pill" href="#custom-tabs-four-round5" role="tab" aria-controls="custom-tabs-four-round5" aria-selected="false">Round 5</a>
                                            </li>
                                        <?php } ?>
                                        <?php if (!empty($roundList[5])) { ?>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-round6-tab" data-toggle="pill" href="#custom-tabs-four-round6" role="tab" aria-controls="custom-tabs-four-round6" aria-selected="false">Round 6</a>
                                            </li>
                                        <?php } ?>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-four-onboard-tab" data-toggle="pill" href="#custom-tabs-four-onboard" role="tab" aria-controls="custom-tabs-four-onboard" aria-selected="false">Documents Verification</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade " id="custom-tabs-four-round1" role="tabpanel" aria-labelledby="custom-tabs-four-round1-tab">

                                            <div class="form-row">
                                                <div class="col-lg-6 mt-2 text-center ">
                                                    <b>Interviewer : <?= $roundDetails[0]['InterviewerName'] ?></b>
                                                </div>
                                                <div class="col-lg-6 mt-2 text-center ">
                                                    <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                </div>
                                                <div class="col-md-6 mt-2 ">
                                                    <table class=" text-right " align="center">
                                                        <tr>
                                                            <td>Communication </td>
                                                            <td>
                                                                <div class="Communication ">
                                                                    <?php if ($roundDetails[0]['Communication'] == 5) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <!-- <i class="fa-regular fa-star-half-stroke star"></i>  -->
                                                                        <!-- <i class="fa-duotone fa-star-half"></i> -->

                                                                    <?php } else if ($roundDetails[0]['Communication'] == 4) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['Communication'] == 3) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['Communication'] == 2) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['Communication'] == 1) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } ?>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Attitude </td>
                                                            <td>
                                                                <div class="Attitude ">
                                                                    <?php if ($roundDetails[0]['Attitude'] == 5) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                    <?php } else if ($roundDetails[0]['Attitude'] == 4) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['Attitude'] == 3) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['Attitude'] == 2) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['Attitude'] == 1) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Discipline </td>
                                                            <td>
                                                                <div class="Discipline ">
                                                                    <?php if ($roundDetails[0]['Discipline'] == 5) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                    <?php } else if ($roundDetails[0]['Discipline'] == 4) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['Discipline'] == 3) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['Discipline'] == 2) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['Discipline'] == 1) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>DressCode </td>
                                                            <td>
                                                                <div class="DressCode ">
                                                                    <?php if ($roundDetails[0]['DressCode'] == 5) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                    <?php } else if ($roundDetails[0]['DressCode'] == 4) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['DressCode'] == 3) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['DressCode'] == 2) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['DressCode'] == 1) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } ?>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Knowledge </td>
                                                            <td>
                                                                <div class="Knowledge ">
                                                                    <?php if ($roundDetails[0]['Knowledge'] == 5) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                    <?php } else if ($roundDetails[0]['Knowledge'] == 4) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['Knowledge'] == 3) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['Knowledge'] == 2) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } else if ($roundDetails[0]['Knowledge'] == 1) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                    <?php } ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6 mt-2 text-center">
                                                    <table class=" text-right " align="center">
                                                        <tr>
                                                            <td>OverAllRating </td>
                                                            <td>
                                                                <div class="OverAllRating ">
                                                                    <?php if ($roundDetails[0]['OverAllRating'] == 5) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>

                                                                    <?php } else if ($roundDetails[0]['OverAllRating'] == 4.5) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-solid fa-star-half-stroke star"></i>
                                                                    <?php } else if ($roundDetails[0]['OverAllRating'] == 4) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                    <?php } else if ($roundDetails[0]['OverAllRating'] == 3.5) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <i class="fa-regular fa-star star"></i>

                                                                    <?php } else if ($roundDetails[0]['OverAllRating'] == 3) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                    <?php } else if ($roundDetails[0]['OverAllRating'] == 2.5) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                    <?php } else if ($roundDetails[0]['OverAllRating'] == 2) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                    <?php } else if ($roundDetails[0]['OverAllRating'] == 1.5) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                    <?php } else if ($roundDetails[0]['OverAllRating'] == 1) { ?>
                                                                        <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                        <i class="fa-regular fa-star star"></i>
                                                                    <?php } ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="text-center">
                                                            <td colspan="2">Rating : <?= $roundDetails[0]['OverAllRating'] ?> </td>
                                                        </tr>
                                                    </table>
                                                    <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[0]['InterviewRemarks'] ?></textarea>

                                                </div>
                                            </div>

                                        </div>
                                        <?php if (!empty($roundList[1])) { ?>
                                            <div class="tab-pane fade" id="custom-tabs-four-round2" role="tabpanel" aria-labelledby="custom-tabs-four-round2-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[1]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[1]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[1]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[1]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Discipline'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[1]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[1]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[1]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[1]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[1]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[1]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[1]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>
                                            </div> <?php } ?>
                                        <?php if (!empty($roundList[2])) { ?>
                                            <div class="tab-pane fade" id="custom-tabs-four-round3" role="tabpanel" aria-labelledby="custom-tabs-four-round3-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[2]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[2]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[2]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[2]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[2]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[2]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[2]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[2]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[2]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[2]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[2]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>
                                            </div> <?php } ?>
                                        <?php if (!empty($roundList[3])) { ?>
                                            <div class="tab-pane fade " id="custom-tabs-four-round4" role="tabpanel" aria-labelledby="custom-tabs-four-round4-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[3]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[3]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[3]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[3]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[3]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[3]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[3]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[3]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[3]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[3]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[3]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>
                                            </div> <?php } ?>
                                        <?php if (!empty($roundList[4])) { ?>
                                            <div class="tab-pane fade " id="custom-tabs-four-round5" role="tabpanel" aria-labelledby="custom-tabs-four-round5-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[4]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[4]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[4]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[4]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[4]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[4]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[4]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[4]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[4]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[4]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[4]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>

                                            </div> <?php } ?>
                                        <?php if (!empty($roundList[5])) { ?>
                                            <div class="tab-pane fade " id="custom-tabs-four-round6" role="tabpanel" aria-labelledby="custom-tabs-four-round6-tab">
                                                <div class="form-row">
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Interviewer : <?= $roundDetails[5]['InterviewerName'] ?></b>
                                                    </div>
                                                    <div class="col-lg-6 mt-2 text-center ">
                                                        <b>Candidate Name : <?= $candidate_details[0]['CandidateName'] ?></b>
                                                    </div>
                                                    <div class="col-md-6 mt-2 ">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>Communication </td>
                                                                <td>
                                                                    <div class="Communication ">
                                                                        <?php if ($roundDetails[5]['Communication'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[5]['Communication'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['Communication'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['Communication'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['Communication'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Attitude </td>
                                                                <td>
                                                                    <div class="Attitude ">
                                                                        <?php if ($roundDetails[5]['Attitude'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[5]['Attitude'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['Attitude'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['Attitude'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['Attitude'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discipline </td>
                                                                <td>
                                                                    <div class="Discipline ">
                                                                        <?php if ($roundDetails[5]['Discipline'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[5]['Discipline'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['Discipline'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['Discipline'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DressCode </td>
                                                                <td>
                                                                    <div class="DressCode ">
                                                                        <?php if ($roundDetails[5]['DressCode'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[5]['DressCode'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['DressCode'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['DressCode'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['DressCode'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Knowledge </td>
                                                                <td>
                                                                    <div class="Knowledge ">
                                                                        <?php if ($roundDetails[5]['Knowledge'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                        <?php } else if ($roundDetails[5]['Knowledge'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['Knowledge'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['Knowledge'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } else if ($roundDetails[5]['Knowledge'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                            <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 mt-2 text-center">
                                                        <table class=" text-right " align="center">
                                                            <tr>
                                                                <td>OverAllRating </td>
                                                                <td>
                                                                    <div class="OverAllRating ">
                                                                        <?php if ($roundDetails[5]['OverAllRating'] == 5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>

                                                                        <?php } else if ($roundDetails[5]['OverAllRating'] == 4.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                        <?php } else if ($roundDetails[5]['OverAllRating'] == 4) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[5]['OverAllRating'] == 3.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>

                                                                        <?php } else if ($roundDetails[5]['OverAllRating'] == 3) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[5]['OverAllRating'] == 2.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[5]['OverAllRating'] == 2) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[5]['OverAllRating'] == 1.5) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-solid fa-star-half-stroke star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } else if ($roundDetails[5]['OverAllRating'] == 1) { ?>
                                                                            <i class="fa-sharp fa-solid fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                            <i class="fa-regular fa-star star"></i>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td colspan="2">Rating : <?= $roundDetails[5]['OverAllRating'] ?> </td>
                                                            </tr>
                                                        </table>
                                                        <textarea class="form-control mt-2" name="InterviewRemarks"><?= $roundDetails[5]['InterviewRemarks'] ?></textarea>

                                                    </div>
                                                </div>
                                            </div> <?php } ?>


                                        <div class="tab-pane fade show active" id="custom-tabs-four-onboard" role="tabpanel" aria-labelledby="custom-tabs-four-onboard-tab">
                                            <div class=" text-center">
                                                <!-- <h3 class="text-center onboard_text">Congratulations <?= $candidate_details[0]['CandidateName'] ?> Selected</h3>
                                                <a href="<?php echo site_url('onboarding_process?canId=' . $candidate_details[0]['CandidateId']) ?>" class="btn btn-sm bg-orange text-center mt-5 mb-5"> Upload Documents</a> -->
                                                <form action="<?= site_url('/send_documentVerification_mail') ?>" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                                    <input type="hidden" name="CandidateEmail" value="<?= $candidate_details[0]['CandidateEmail'] ?>">
                                                    <textarea class="form-control " name="docmailBody">
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
                                                    <script>
                                                        CKEDITOR.replace('docmailBody');
                                                    </script>

                                                    <button type="submit" class="btn btn-sm bg-orange mt-2 float-right" value="1" name="DVStatus"><b> Send </b></button>
                                                </form>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } elseif ($roundList[0]['InterviewStatus'] == 4) { ?>
                        <div class="col-md-8">
                            <div class="card card-orange card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-four-round1-tab" data-toggle="pill" href="#custom-tabs-four-round1" role="tab" aria-controls="custom-tabs-four-round1" aria-selected="true">Candidate</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade " id="custom-tabs-four-round1" role="tabpanel" aria-labelledby="custom-tabs-four-round1-tab">

                                            <div class="form-row">

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                <?php } ?>


                <!-- /.col -->
                <div class="col-lg-12">
                    <!-- About Me Box -->
                    <div class="card card-orange card-outline">
                        <div class="card-header">
                            <h3 class="profile-username">About</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <strong><i class="fas fa-book mr-1"></i> Education</strong>
                                    <p class="text-muted"><?= $candidate_details[0]['CandidateEducation'] ?></p>
                                    <hr>

                                    <strong><i class="fa-solid fa-shield-halved mr-1"></i>Experience</strong>
                                    <p class="text-muted"><?php if ($candidate_details[0]['CandidateExperience'] == 1) {
                                                                echo 'Fresher';
                                                            } else {
                                                                echo $candidate_details[0]['TotalExperience'] . ' Years';
                                                            }  ?></p>
                                    <hr>

                                    <strong><i class="fa-regular fa-money-bill-1 mr-1"></i> Expected CTC</strong>
                                    <p class="text-muted"><?= $candidate_details[0]['CandidateExpectedCTC'] ?> Salary</p>
                                    <hr>


                                </div>

                                <?php if ($candidate_details[0]['CandidateExperience'] == 2) { ?>
                                    <div class="col-lg-3">
                                        <strong><i class="fas fa-pencil-alt mr-1"></i> Last Company</strong>
                                        <p class="text-muted"> <?= $candidate_details[0]['LastCompany'] ?> </p>
                                        <hr>

                                        <strong><i class="fa-solid fa-file-signature mr-1"></i> Notice Peroid</strong>
                                        <p class="text-muted"><?= $candidate_details[0]['NoticePeroid'] ?> Days</p>
                                        <hr>

                                        <strong><i class="fa-regular fa-money-bill-1 mr-1"></i> Current CTC</strong>
                                        <p class="text-muted"><?= $candidate_details[0]['CandidateCurrentCTC'] ?> Salary</p>
                                        <hr>
                                    </div>
                                <?php } ?>

                                <div class="col-lg-6">
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Residing Address</strong>
                                    <p class="text-muted"> <?= $candidate_details[0]['CandidateLocation'] ?> </p>
                                    <hr>
                                    <?php if ($candidate_details[0]['ImmediateJoiner'] == 'Yes') { ?>
                                        <strong><i class="far fa-file-alt mr-1"></i> Immediate Joiner</strong>
                                        <p class="text-muted"> <?= $candidate_details[0]['ImmediateJoiner'] ?> </p>
                                        <hr>
                                    <?php } elseif ($candidate_details[0]['ImmediateJoiner'] == 'No') { ?>
                                        <strong><i class="far fa-file-alt mr-1"></i> Immediate Joiner</strong>
                                        <p class="text-muted"><?= $candidate_details[0]['ImmediateJoiner'] ?></p>
                                        <hr>
                                        <strong><i class="fa-solid fa-calendar-week mr-1"></i> Days Required to Join</strong>
                                        <p class="text-muted"><?= $candidate_details[0]['DaysRequired'] ?> Days</p>
                                        <hr>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>

<script>
    $(document).ready(function() {
        $('.interdate').hide();
        $("input[id$='option-2']").click(function() {
            $('.interdate').show();
            $('button[name=IVdateClose]').removeAttr('disabled');
        });

        $("input[id$='option-1']").click(function() {
            $('.interdate').hide();
            $('button[name=IVdateClose]').removeAttr('disabled');
        });
    });
</script>

<style>
    .canelradio {
        /* background: #e5652e; */
        border-radius: 3px;
        padding: 0px 16px;
        margin: 3px;
        color: #000;
    }

    .onboard {
        background-color: #000;
        height: 350px;
        background-image: url(<?php echo base_url('public/images/confetti-40.webp'); ?>);
        border-radius: 10px;
        color: #fff;
    }

    .onboard_text {
        font-family: Snell Roundhand, cursive;
        font-weight: 900;
        padding-top: 105px;
    }

    .wrapper-select-size {
        display: inline-flex;
        align-items: center;
        justify-content: space-evenly;
        width: 100%;
        height: 40px;
    }

    .wrapper-select-size .option {
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        border-radius: 4px;
        cursor: pointer;
        border: 2px solid #dc6502;
        transition: all 0.3s ease;
        margin-right: 4px;
    }

    .wrapper-select-size .option .dot::before {
        position: absolute;
        content: "";
        top: 4px;
        left: 4px;
        width: 12px;
        height: 12px;
        background: #dc6502;
        border-radius: 50%;
        opacity: 0;
        transform: scale(1.5);
        transition: all 0.3s ease;
    }

    input[name="IVdate"] {
        display: none;
    }

    #option-1:checked:checked~.option-1,
    #option-2:checked:checked~.option-2 {
        border-color: #dc6502;
        background: #dc6502;
    }

    .wrapper-select-size .option span {
        font-size: 16px;
        color: #0b3544;
    }

    #option-1:checked:checked~.option-1 span,
    #option-2:checked:checked~.option-2 span {
        color: #fff;
    }

    #option-1:checked:checked~.option-1 {}
</style>

<script>
    $(document).ready(function() {
        $('input[name="InterviewStatus"]').change(function() {
            if ($(this).is(':checked') && $(this).val() == '1') {
                $('#interviewdate').modal('show');
            }

            const selectedValue = $("select[name='InterviewerIDFK']").val();
            if (selectedValue === "Select Interviewer") {
                $(".error-msg").show();
                $('.submit-btn').addClass('disabled');
            } else {
                $(".error-msg").hide();
                $('.submit-btn').removeClass('disabled');
            }
        });


        $("select[name='InterviewerIDFK']").on("change", function() {
            let v = $(this).val();
            if (v === 'Select Interviewer') {
                $(".error-msg").show();
                $('.submit-btn').addClass('disabled');
            } else {
                $(".error-msg").hide();
                $('.submit-btn').removeClass('disabled');
            }
        });

        $(".error-msg").hide();
    });
</script>

<!-- Rating Calculation  -->
<script>
    let Cstar5 = document.querySelector('#Cstar5');
    let Cstar4 = document.querySelector('#Cstar4');
    let Cstar3 = document.querySelector('#Cstar3');
    let Cstar2 = document.querySelector('#Cstar2');
    let Cstar1 = document.querySelector('#Cstar1');
    let Commstar;

    let Astar5 = document.querySelector('#Astar5');
    let Astar4 = document.querySelector('#Astar4');
    let Astar3 = document.querySelector('#Astar3');
    let Astar2 = document.querySelector('#Astar2');
    let Astar1 = document.querySelector('#Astar1');
    let Astar;

    let Dstar5 = document.querySelector('#Dstar5');
    let Dstar4 = document.querySelector('#Dstar4');
    let Dstar3 = document.querySelector('#Dstar3');
    let Dstar2 = document.querySelector('#Dstar2');
    let Dstar1 = document.querySelector('#Dstar1');
    let Dstar;

    let DCstar5 = document.querySelector('#DCstar5');
    let DCstar4 = document.querySelector('#DCstar4');
    let DCstar3 = document.querySelector('#DCstar3');
    let DCstar2 = document.querySelector('#DCstar2');
    let DCstar1 = document.querySelector('#DCstar1');
    let DCstar;

    let Kstar5 = document.querySelector('#Kstar5');
    let Kstar4 = document.querySelector('#Kstar4');
    let Kstar3 = document.querySelector('#Kstar3');
    let Kstar2 = document.querySelector('#Kstar2');
    let Kstar1 = document.querySelector('#Kstar1');
    let Kstar;

    let Ostar5 = document.querySelector('#Ostar5');
    let Ostar4 = document.querySelector('#Ostar4');
    let Ostar3 = document.querySelector('#Ostar3');
    let Ostar2 = document.querySelector('#Ostar2');
    let Ostar1 = document.querySelector('#Ostar1');
    let Ostar;


    let rating10 = document.querySelector('#rating10');
    let rating9 = document.querySelector('#rating9');
    let rating8 = document.querySelector('#rating8');
    let rating7 = document.querySelector('#rating7');
    let rating6 = document.querySelector('#rating6');
    let rating5 = document.querySelector('#rating5');
    let rating4 = document.querySelector('#rating4');
    let rating3 = document.querySelector('#rating3');
    let rating2 = document.querySelector('#rating2');
    let rating1 = document.querySelector('#rating1');
    let rating;

    const calculateRate = document.querySelector('#calculateRate');

    calculateRate.addEventListener('click', function() {
        if (Cstar5.checked) {
            Commstar = Cstar5.value;
        } else if (Cstar4.checked) {
            Commstar = Cstar4.value;
        } else if (Cstar3.checked) {
            Commstar = Cstar3.value;
        } else if (Cstar2.checked) {
            Commstar = Cstar2.value;
        } else if (Cstar1.checked) {
            Commstar = Cstar1.value;
        } else {
            Commstar = 0;
        }
        // alert(Commstar);

        if (Astar5.checked) {
            Astar = Astar5.value;
        } else if (Astar4.checked) {
            Astar = Astar4.value;
        } else if (Astar3.checked) {
            Astar = Astar3.value;
        } else if (Astar2.checked) {
            Astar = Astar2.value;
        } else if (Astar1.checked) {
            Astar = Astar1.value;
        }

        if (Dstar5.checked) {
            Dstar = Dstar5.value;
        } else if (Dstar4.checked) {
            Dstar = Dstar4.value;
        } else if (Dstar3.checked) {
            Dstar = Dstar3.value;
        } else if (Dstar2.checked) {
            Dstar = Dstar2.value;
        } else if (Dstar1.checked) {
            Dstar = Dstar1.value;
        }

        if (DCstar5.checked) {
            DCstar = DCstar5.value;
        } else if (DCstar4.checked) {
            DCstar = DCstar4.value;
        } else if (DCstar3.checked) {
            DCstar = DCstar3.value;
        } else if (DCstar2.checked) {
            DCstar = DCstar2.value;
        } else if (DCstar1.checked) {
            DCstar = DCstar1.value;
        }

        if (Kstar5.checked) {
            Kstar = Kstar5.value;
        } else if (Kstar4.checked) {
            Kstar = Kstar4.value;
        } else if (Kstar3.checked) {
            Kstar = Kstar3.value;
        } else if (Kstar2.checked) {
            Kstar = Kstar2.value;
        } else if (Kstar1.checked) {
            Kstar = Kstar1.value;
        }

        if (rating10.checked) {
            rating = rating10.value;
        } else if (rating9.checked) {
            rating = rating9.value;
        } else if (rating8.checked) {
            rating = rating8.value;
        } else if (rating7.checked) {
            rating = rating7.value;
        } else if (rating6.checked) {
            rating = rating6.value;
        } else if (rating5.checked) {
            rating = rating5.value;
        } else if (rating4.checked) {
            rating = rating4.value;
        } else if (rating3.checked) {
            rating = rating3.value;
        } else if (rating2.checked) {
            rating = rating2.value;
        } else if (rating1.checked) {
            rating = rating1.value;
        }


        // console.log(`Communication: ${Commstar}`);
        // console.log(`attitude: ${Astar}`);
        // console.log(`Discplin: ${Dstar}`);
        // console.log(`DressCode: ${DCstar}`);
        // console.log(`Knowlage: ${Kstar}`);
        // console.log(`OverAllRating: ${rating}`);

        const array = [{
            Rating: `${Commstar}`
        }, {
            Rating: `${Astar}`
        }, {
            Rating: `${Dstar}`
        }, {
            Rating: `${DCstar}`
        }, {
            Rating: `${Kstar}`
        }];

        console.log("Array - ", array);
        console.log("Array with one object - ", array[0].Rating);

        var fivestar = '5';
        var fivestarcount = array.filter((obj) => obj.Rating === fivestar).length;
        var fourstar = '4';
        var fourstarcount = array.filter((obj) => obj.Rating === fourstar).length;
        var threestar = '3';
        var threestarcount = array.filter((obj) => obj.Rating === threestar).length;
        var twostar = '2';
        var twostarcount = array.filter((obj) => obj.Rating === twostar).length;
        var onestar = '1';
        var onestarcount = array.filter((obj) => obj.Rating === onestar).length;

        // console.log("Total Five star - ",fivestarcount);
        // console.log("Total Four star - ",fourstarcount);
        // console.log("Total Three star - ",threestarcount);
        // console.log("Total Two star - ",twostarcount);
        // console.log("Total One star - ",onestarcount);

        const totalratings = fivestarcount + fourstarcount + threestarcount + twostarcount + onestarcount;
        // let totalratings;
        // const totalratings = parseInt(fivestarcount) + parseInt(fourstarcount) + parseInt(threestarcount) + parseInt(twostarcount) + parseInt(onestarcount);

        console.log("Total rating - ", totalratings);

        const averagerating = (Math.round(5 * parseInt(fivestarcount) + 4 * parseInt(fourstarcount) + 3 * parseInt(threestarcount) + 2 * parseInt(twostarcount) + 1 * parseInt(onestarcount)) / totalratings);

        console.log("Average rating - ", averagerating);

        // const maxRate=5;

        // const averageratingold = (parseInt(Commstar)/maxRate) + (parseInt(Astar)/maxRate)+(parseInt(Dstar)/maxRate)+(parseInt(DCstar)/maxRate)+(parseInt(Kstar)/maxRate);

        // console.log("Average rating old - ",averageratingold);

        // alert(averagerating);
        document.getElementById("result").innerHTML = "Over All Rating : " + averagerating.toFixed(1);

        // if(averagerating == 5){
        //     document.getElementById('rating10').checked = true;
        //     document.getElementById('rating10').disabled = false;
        // }
        // if((averagerating == 4) || (averagerating < 5)){
        //     document.getElementById('rating8').checked = true;
        //     document.getElementById('rating8').disabled = false;
        // }
        // if((averagerating == 3) || (averagerating < 4)){
        //     document.getElementById('rating6').checked = true;
        //     document.getElementById('rating6').disabled = false;
        // }
        // if((averagerating == 2) || (averagerating < 3)){
        //     document.getElementById('rating4').checked = true;
        //     document.getElementById('rating4').disabled = false;
        // }
        // if((averagerating == 1) || (averagerating < 2)){
        //     document.getElementById('rating2').checked = true;
        //     document.getElementById('rating2').disabled = false;
        // }


        if (averagerating == 5) {
            document.getElementById('rating10').checked = true;
            document.getElementById('rating10').disabled = false;
        } else if ((averagerating >= 4.5) && (averagerating <= 4.9)) {
            document.getElementById('rating9').checked = true;
            document.getElementById('rating9').disabled = false;
        } else if ((averagerating >= 4) && (averagerating < 4.5)) {
            document.getElementById('rating8').checked = true;
            document.getElementById('rating8').disabled = false;
        } else if ((averagerating >= 3.5) && (averagerating < 4)) {
            document.getElementById('rating7').checked = true;
            document.getElementById('rating7').disabled = false;
        } else if ((averagerating >= 3) && (averagerating < 3.5)) {
            document.getElementById('rating6').checked = true;
            document.getElementById('rating6').disabled = false;
        } else if ((averagerating >= 2.5) && (averagerating < 3)) {
            document.getElementById('rating5').checked = true;
            document.getElementById('rating5').disabled = false;
        } else if ((averagerating >= 2) && (averagerating < 2.5)) {
            document.getElementById('rating4').checked = true;
            document.getElementById('rating4').disabled = false;
        } else if ((averagerating >= 1.5) && (averagerating < 2)) {
            document.getElementById('rating3').checked = true;
            document.getElementById('rating3').disabled = false;
        } else if ((averagerating >= 1) && (averagerating < 1.5)) {
            document.getElementById('rating2').checked = true;
            document.getElementById('rating2').disabled = false;
        } else if ((averagerating >= 0.5) && (averagerating < 1)) {
            document.getElementById('rating1').checked = true;
            document.getElementById('rating1').disabled = false;
        }

    });


    // const fivestar = '5';
    // const fivestarcount = this.reviews.filter((obj) => obj.Rating === fivestar).length;
    // const fourstar = '4';
    // const fourstarcount = this.reviews.filter((obj) => obj.Rating === fourstar).length;
    // const thirdstar = '3';
    // const threestarcount = this.reviews.filter((obj) => obj.Rating === thirdstar).length;
    // const twostar = '2';
    // const twostarcount = this.reviews.filter((obj) => obj.Rating === twostar).length;
    // const onestar = '1';
    // const onestarcount = this.reviews.filter((obj) => obj.Rating === onestar).length;

    // const totalratings = fivestarcount + fourstarcount + threestarcount + twostarcount + onestarcount;
    // this.totaluserratings = totalratings;
    // this.averagerating = (Math.round(5 * fivestarcount + 4 * fourstarcount + 3 * threestarcount + 2 * twostarcount + 1 * onestarcount) / totalratings).toFixed(1);
    // if (isNaN(parseFloat(this.averagerating))) {
    //   this.numbernan = true;
    //   this.averagerating = '0';
    //   this.totaluserratings = '0';
    // }
</script>




<?= $this->endSection() ?>