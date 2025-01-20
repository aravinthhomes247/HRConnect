<?php $session = \Config\Services::session(); ?>

<?php $this->extend("layouts/header"); ?>

<?php $this->section("body"); ?>
<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
}
?>

<style>
    .warning {
        color: red;
        display: none;
        margin: 0;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Candidate</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Add New Candidate</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <!-- <button type="button" class="btn btn-warning toastrDefaultWarning">
                  Launch Warning Toast
                </button> -->

                <div class="col-lg-12 mt-2">
                    <div class="card">
                        <!-- Button trigger modal -->
                        <div class="text-right m-3">
                            <a class="btn btn-sm bg-orange mr-3" data-toggle="modal" data-target="#upload_excel_file"><b>Add Excel File</b> </a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="upload_excel_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Candidates through Excel File</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="form-upload-candidate" action="<?= site_url('/store_candidate_excelfile') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="sub-result"></div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="file" accept=".csv" required>
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                            <p class="ml-1" id="fileType" style="font-size:14px">Upload file format: .csv</p>
                                            <!-- <div class="form-group">
                                                <div class="text-center">
                                                    <div class="user-loader" style="display: none; ">
                                                        <i class="fa fa-spinner fa-spin"></i> <small>Please wait ...</small>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" id="btnUpload">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <form action="<?= site_url('/store_candidate') ?>" method="post" autocomplete="off"
                            accept-charset="utf-8" enctype="multipart/form-data" id="new-candidate">
                            <!-- <div class="card-header">
                                Add New Candidate 
                            </div> -->
                            <div class="card-body pt-0">
                                <table class="table ">
                                    <tbody>
                                        <tr>
                                            <td><b>Cadidate Name</b></td>
                                            <td>
                                                <input type="text" class="form-control" name="CandidateName" id="CandidateName" placeholder="Candidate Name" />
                                                <p class="warning" id="W-CandidateName">Please fill the Candidate Name</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Contact No</b></td>
                                            <td>
                                                <input type="number" class="form-control" name="CandidateContactNo" id="CandidateContactNo" placeholder="Contact No" required>
                                                <p class="warning" id="W-CandidateContactNo">Please fill the Candidate Contact No</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Email Id </b></td>
                                            <td>
                                                <input type="Email" class="form-control" name="CandidateEmail" id="CandidateEmail" placeholder="Email ID">
                                                <!-- <p class="warning">Please fill the Candidate Email</p> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Source</b></td>
                                            <td>
                                                <select class="form-control" name="Source" id="Source">
                                                    <option>--Select-- </option>
                                                    <?php
                                                    if ($socialMedia) {
                                                        foreach ($socialMedia as $row) { ?>
                                                            <option value="<?php echo $row["SM_IDPK"] ?>">
                                                                <?php echo $row["SM_Name"] ?> </option>
                                                    <?php
                                                        }
                                                    } ?>
                                                </select>
                                                <p class="warning" id="W-Source">Please select the Source</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Position Applied For</b></td>
                                            <td>
                                                <select class="form-control" name="CandidatePosition" id="CandidatePosition">
                                                    <option>--Select-- </option>
                                                    <?php
                                                    if ($selectdesignation) {
                                                        foreach ($selectdesignation as $row) { ?>
                                                            <option value="<?php echo $row["IDPK"] ?>">
                                                                <?php echo $row["designations"] ?> </option>
                                                    <?php
                                                        }
                                                    } ?>
                                                </select>
                                                <p class="warning" id="W-CandidatePosition">Please select the Candidate Position</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b><input class="yshow" type="radio" value="1" name="scheduled" id=schedule1 /> Schedule</b>
                                                <p class="warning" id="W-scheduled">Please choose the Schedule Status</p>
                                            </td>
                                            <td><b><input class="xshow" type="radio" value="2" name="scheduled" /> Not Schedule</b> </td>
                                        </tr>
                                        <tr class="notschedule">
                                            <td colspan="2">
                                                <?php if ($notScheduleReasons) {
                                                    foreach ($notScheduleReasons as $row) { ?>
                                                        <b> <input class="xshow ashow" type="radio" value="<?php echo $row["NS_IDPK"] ?>" id="schedule1" name="NotScheduled"> <?php echo $row["NS_Reasons"] ?> &nbsp;&nbsp;&nbsp; </b>
                                                <?php }
                                                } ?>
                                                <p class="warning" id="W-schedule1">Please choose the Notschedule status</p>
                                                <div class="form-row callbackdate ">
                                                    <div class="col-lg-2.5 mt-2 ">
                                                        <div class="input-group date" id="reservationdatetime1" data-target-input="nearest">
                                                            <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="CallBackDateTime" id="CallBackDateTime" data-target="#reservationdatetime1" placeholder="Call Back Date and Time" required />
                                                        </div>
                                                        <p class="warning" id="W-CallBackDateTime">Please choose the callback date and time</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="notschedule">
                                            <td><b>Candidate Remarks</b></td>
                                            <td>
                                                <input type="text" class="form-control" name="CandidateReason" id="CandidateReason" placeholder="Candidate Remarks">
                                                <p class="warning" id="W-CandidateReason">Please fill the Remarks</p>
                                            </td>
                                        </tr>

                                        <tr class="schedule">
                                            <td><b>Interview Date</b></td>
                                            <td>
                                                <div class="form-row">
                                                    <div class="col-lg-2.5 mt-2">
                                                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                            <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate" id="InterviewDate" data-target="#reservationdatetime" placeholder="Interview Date" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr align="center">
                                            <td colspan=2>
                                                <button type="reset" class="btn btn-sm btn-danger mr-2">Clear</button>
                                                <button type="button" class="btn btn-sm bg-orange" id="submit-btn">Submit</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<script>
    var csvfile = document.getElementById("customFile");
    var myfile = "";

    $('#customFile').on('change', function() {
        myfile = $(this).val();
        var ext = myfile.split('.').pop();
        if (ext !== "csv") {
            // alert(ext);
            filetype = "File Type is not Vaild, upload csv file only";
            this.value = "";
            document.getElementById("fileType").innerHTML = filetype;
            document.getElementById("fileType").style.color = "red";
            // setTimeout(function() {
            //     document.getElementById("fileType").innerHTML = "";
            // }, 5000);
        } else {
            $('input:file[name=file]').attr('required', 'required');
        }
    });
</script>

<script>
    $(document).ready(function() {
        // $('.warning').hide();
        $("input[id='schedule1']").click(function(e) {
            var juck = $('input:radio[id=schedule1]:checked').val();
            if ((juck === "11") || (juck === "3") || (juck === "7") || (juck === "8") || (juck === "1")) {
                $('.callbackdate').hide();
                $('input:text[name=CallBackDateTime]').removeAttr('required');
                $('input:text[name=InterviewDate]').removeAttr('required');
            } else {
                $('input:text[name=CallBackDateTime]').attr('required', 'required');
                $('.callbackdate').show();

            }
        });
    });

    $('#submit-btn').on("click", function() {
    var flag = 1;
    var requiredTextFields = ['CandidateName', 'CandidateContactNo'];
    var requiredSelectFields = ['Source', 'CandidatePosition'];
    var scheduled = $('input[name="scheduled"]:checked').val();
    var NotScheduled = $('input[name="NotScheduled"]:checked').val();
    var CandidateReason = $('#CandidateReason').val();
    var CallBackDateTime = $('#CallBackDateTime').val();
    function toggleWarning(selector, condition) {
        $('#W-' + selector).toggle(condition);
        if (condition) flag = 0;
    }
    requiredTextFields.forEach(function(field) {
        toggleWarning(field, !$('#' + field).val());
    });
    requiredSelectFields.forEach(function(field) {
        toggleWarning(field, $('#' + field).val() === '--Select--');
    });
    toggleWarning('scheduled', !scheduled);
    if (scheduled == 2) {
        toggleWarning('schedule1', !NotScheduled);
        toggleWarning('CandidateReason', !CandidateReason);
        if ([4, 5, 6].includes(parseInt(NotScheduled))) {
            toggleWarning('CallBackDateTime', !CallBackDateTime);
        }
    }
    if (flag === 1) $('#new-candidate').submit();
});

</script>





<script>
    $(".notschedule").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('xshow');
        $(".notschedule").toggle(isChecked && isShow);
    });


    $(".schedule").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('yshow');
        $(".schedule").toggle(isChecked && isShow);
    });

    $(".exp").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('zshow');
        $(".exp").toggle(isChecked && isShow);
    });

    $(".callback").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('ashow');
        $(".callback").toggle(isChecked && isShow);
    });
</script>




<?= $this->endSection() ?>