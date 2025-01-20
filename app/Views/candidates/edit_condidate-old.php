<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header") ?>


<?= $this->section("body") ?>
<?php
      if(isset($_SESSION['msg'])){
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
            <h1>Candidate Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('/candidate?fdate=&todate=&trickid=1') ?>">Candidate List</a></li>
              <li class="breadcrumb-item active">Candidate Profile</li>
            </ol>
          </div>
        
          
            <?php
                if($session->getFlashdata('candidatemsg'))
                {?>
                <div class="col-sm-6">
                   <div class="alert alert-warning bg-orange alert-dismissible fade show" role="alert">
                        <strong><?= $session->getFlashdata('candidatemsg') ?></strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php }  ?>

            
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">                    
                    <!-- Profile Image -->
                    <div class="card card-orange card-outline">
                        <div class="card-body box-profile">                           
                            <a href="<?php echo site_url('edit_Candi_profile?canId='.$candidate_details[0]['CandidateId']) ?>" class="float-right"><i class="fa-solid fa-pen-to-square"></i></a>
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
                                    <b>Interview Status</b> <a class="float-right"><?= $candidate_details[0]['NS_Reasons']?></a>
                                </li>
                            </ul>

                            
                            <?php if(empty($candidate_details[0]['CandidateResume'])){?>
                                <div class="cv " style="padding-top: 8px; ">
                                    <a href="<?= site_url('/provious_rounds?canId='.$candidate_details[0]['CandidateId'])?>" class="btn btn-sm bg-orange " ><b>Overview</b></a>
                                    <a href="" class="btn btn-sm bg-orange " id="resume_link"><b>Upload Resume</b> </a> 
                                            <p id="filelimit" style="color: red;padding-left: 15px;"> </p>
                                    <div id="myProgress">
                                                <div id="progressBar"></div>
                                            </div>
                                            <div id="progresstick">
                                                <i class="fa-solid fa-check"></i>
                                            </div>
                                            
                                </div>
                            <?php } else{?>
                                <div class="cv" style="padding-top: 8px; ">
                                    <a href="<?= site_url('/provious_rounds?canId='.$candidate_details[0]['CandidateId'])?>" class="btn btn-sm bg-orange " ><b>Overview</b></a>
                                    <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$candidate_details[0]['CandidateResume']); ?>" target="_black" class="btn btn-sm bg-orange "><b> View Resume</b></a> 
                                    <a href="" class="btn btn-sm bg-orange " id="resume_link"><b>Upload New</b> </a> 
                                            <p id="filelimit" style="color: red;padding-left: 15px;"> </p>
                                            <!-- <input type="file" name="CandidateResume"  id="file" style="visibility: hidden" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"> -->
                                </div>

                            <?php }?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    
                </div>
                <!-- /.col -->


                <div class="col-lg-8">
                    <div class="card card-orange card-outline">                                            
                        <div class="card-header">
                            <h3 class="profile-username ">Candidate On Interview Day</h3>
                            <div  style="padding: 5px 10px 8px 4px;">                                    
                                <input type="radio"  name="scheduled" class="yshow" /> Arrived 
                                <input type="radio"  name="scheduled" class="zshow" /> Re-Schedule
                                <input type="radio"  name="scheduled" class="xshow" /> Cancel 
                            </div> 
                        </div>
                        <?php if(($candidate_details[0]['ScheduleStatus'] == 1 )){?>

                        <div class="arrived">
                            <form action="<?= site_url('/update_candidateArrived') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                                <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <input type="hidden" name="CandidateName" value="<?= $candidate_details[0]['CandidateName'] ?>">
                                <input type="file" name="CandidateResume"  id="file" style="visibility: hidden" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"  >
                                <input type="hidden"  name="scheduled" value="10"/>

                                <input type="hidden" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate"data-target="#reservationdatetime" placeholder="Interview Date" value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                                <div class="card-body" style="margin-top: -40px;">                                
                                    <div class="form-row">
                                        <div class="col-lg-12 mt-2">
                                            Residing Location: <textarea class="form-control" placeholder="Residing Location"
                                                name="CandidateLocation" required ><?= $candidate_details[0]['CandidateLocation'] ?></textarea>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            Education: <input type="text" class="form-control" name="CandidateEducation" value="<?php echo $candidate_details[0]['CandidateEducation']; ?>" placeholder="Education Qualification" required>
                                        </div>
                                        <div class="col-lg-3 mt-2">
                                            Experience:<select class="form-control" name="exp" id="type">
                                                            <option value="1" id="fresher">Fresher</option>
                                                            <option value="2" id="experience">Experienced</option>
                                                        </select>
                                        </div>
                                        <div class="col-lg-3 mt-2" id="totalExp">
                                            Total Experience: <input type="number" step="any"  min="0" class="form-control" name="TotalExperience" value="<?php echo $candidate_details[0]['TotalExperience']; ?>" placeholder="Years/Months">
                                        </div>
                                        <div class="col-lg-6 mt-2" id="lastComp">
                                            Last Company:<input type="text" class="form-control" name="LastCompany"
                                                value="<?php echo $candidate_details[0]['LastCompany']; ?>"
                                                placeholder="Last Company">
                                        </div>
                                        <div class="col-lg-3 mt-2" id="NoticeP">
                                            Notice Peroid: <input type="number" step="any"  min="0" class="form-control" name="NoticePeroid" value="<?php echo $candidate_details[0]['NoticePeroid']; ?>" placeholder="Notice Peroid">
                                        </div>
                                        <div class="col-lg-3 mt-2" id="CurrCTC">
                                            Current Salary:<input type="number" step="any"  min="0" class="form-control" name="CandidateCurrentCTC"
                                                value="<?php echo $candidate_details[0]['CandidateCurrentCTC']; ?>"
                                                placeholder="Current Salary">
                                        </div>
                                        <div class="col-lg-3 mt-2">
                                            Expected Salary:<input type="number" step="any"  min="0" class="form-control" name="CandidateExpectedCTC"
                                                value="<?php echo $candidate_details[0]['CandidateExpectedCTC']; ?>"
                                                placeholder="Expected Salary" required>
                                        </div>
                                        
                                        <div class="col-lg-3 mt-2" >
                                            Immediate Joiner: 
                                            <div class="form-group" style="padding: 5px 10px 8px 4px;">
                                                
                                                <input type="radio"  name="ImmediateJoiner" class="yshow" value="Yes" <?php if($candidate_details[0]['ImmediateJoiner']=='Yes'){ echo "checked"; } ?>/> Yes
                                                <input type="radio"  name="ImmediateJoiner" class="yshow ashow" value="No" <?php if($candidate_details[0]['ImmediateJoiner']=='No'){ echo "checked"; } ?>/> No
                                            </div>
                                        </div>                               
                                        <div class="col-lg-3 mt-2 joingdays" >
                                            Days Required to Join: 
                                            <div class="form-group" >                                            
                                                <input type="text" class="form-control" name="DaysRequired" placeholder="Days Required" value="<?= $candidate_details[0]['DaysRequired'] ?>" /> 
                                            </div>
                                        </div>                               
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-sm bg-orange float-right" onclick="return myFunction()">Start Process</button>
                                </div>
                            </form>
                        </div>
                        <div class="reschedule">
                            <form action="<?= site_url('/update_candidate_reschedule') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                                <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <!-- <input type="file" name="CandidateResume"  id="file" style="visibility: hidden" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"> -->
                                <input type="hidden"  name="scheduled" value="1"/>

                                <input type="hidden" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate"data-target="#reservationdatetime" placeholder="Interview Date" value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                                <div class="card-body" >      
                                    <div class="form-row">                                
                                        <div class="col-lg-2.5 mt-2">
                                            Interview Date:<div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate" data-target="#reservationdatetime" placeholder="Interview Date"  value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-sm bg-orange float-right">Update</button>
                                </div>
                            </form>                            
                        </div>
                        <div class="cancel">
                            <form action="<?= site_url('/update_candidate_cancel') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                                <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <!-- <input type="file" name="CandidateResume"  id="file" style="visibility: hidden" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"> -->
                                <input type="hidden"  name="scheduled" value="1"/>

                                <input type="hidden" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate"data-target="#reservationdatetime" placeholder="Interview Date" value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                                
                                <div class="card-body ">
                                    <div class="form-group" style="display: flex; flex-wrap: wrap;">
                                        <?php if($notScheduleReasons){
                                            foreach ($notScheduleReasons as $row ) {?>
                                            <b class="canelradio"> <input class="xshow bshow" type="radio"  value="<?php echo $row["NS_IDPK"] ?>" name="scheduled" id="scheduled1" > <?php echo $row["NS_Reasons"] ?> &nbsp;&nbsp;&nbsp; </b>
                                        <?php } }?>
                                    </div>
                                    <div class="form-row callbackdate">
                                        <div class="col-lg-2.5 mt-2 ">
                                            <div class="input-group date" id="reservationdatetime1" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="CallBackDateTime" data-target="#reservationdatetime1" placeholder="Call Back Date and Time" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-sm bg-orange float-right">Update</button>
                                </div>
                            </form>
                        </div>


                        <?php } elseif(($candidate_details[0]['ScheduleStatus'] >= 2) && ($candidate_details[0]['ScheduleStatus'] != 10) && ($candidate_details[0]['ScheduleStatus'] != 12)){?>
                            
                        <div class="reschedule">
                            <form action="<?= site_url('/update_candidate_reschedule') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                                <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <!-- <input type="file" name="CandidateResume"  id="file" style="visibility: hidden" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"> -->
                                <input type="hidden"  name="scheduled" Value="1"/>

                                <input type="hidden" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate"data-target="#reservationdatetime" placeholder="Interview Date" value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                            
                                <div class="card-body" >
                                    <div class="form-row">
                                        
                                        <div class="col-lg-2.5 mt-2">
                                            Interview Date:<div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate" data-target="#reservationdatetime" placeholder="Interview Date"  value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                                            </div>
                                            
                                        </div> 
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-sm bg-orange float-right">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="cancel">
                            <form action="<?= site_url('/update_candidate_cancel') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                                <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <!-- <input type="file" name="CandidateResume"  id="file" style="visibility: hidden" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"> -->
                                <input type="hidden"  name="scheduled" Value="1"/>

                                <input type="hidden" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate"data-target="#reservationdatetime" placeholder="Interview Date" value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                            
                                <div class="card-body ">
                                    <div class="form-group" style="display: flex; flex-wrap: wrap;">
                                        <?php if($notScheduleReasons){
                                            foreach ($notScheduleReasons as $row ) {?>
                                            <b class="canelradio"> <input class="xshow bshow" type="radio"  value="<?php echo $row["NS_IDPK"] ?>" name="scheduled" id="scheduled11" > <?php echo $row["NS_Reasons"] ?> &nbsp;&nbsp;&nbsp; </b>
                                        <?php } }?>
                                    </div>
                                    <div class="form-row callbackdate">
                                        <div class="col-lg-2.5 mt-2 ">
                                            <div class="input-group date" id="reservationdatetime1" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="CallBackDateTime" data-target="#reservationdatetime1" placeholder="Call Back Date and Time" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-sm bg-orange float-right">Update</button>
                                </div>
                            </form>
                        </div>
                        
                        <?php } ?>
 
                            
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
    $(document).ready(function() {
        // alert('hi');
        
        $("input[id='scheduled1']").click(function(e){
            var junk = $('input:radio[id=scheduled1]:checked').val();
            // alert(junk);
            if((junk === "11") || (junk === "3") || (junk === "7") || (junk === "8")){
                $('.callbackdate').hide();
                $('input:text[name=CallBackDateTime]').removeAttr('required');
            }else{
                $('input:text[name=CallBackDateTime]').attr('required','required');
                $('.callbackdate').show();                
            }
        });
        $("input[id='scheduled11']").click(function(e){
            var junk = $('input:radio[id=scheduled11]:checked').val();
            // alert(junk);
            if((junk === "11") || (junk === "3") || (junk === "7") || (junk === "8")){
                $('.callbackdate').hide();
                $('input:text[name=CallBackDateTime]').removeAttr('required');
            }else{
                $('input:text[name=CallBackDateTime]').attr('required','required');
                $('.callbackdate').show();                
            }
        });
        
    });
</script>


<style>
    .canelradio{
        /* background: #e5652e; */
        border-radius: 3px;
        padding: 10px;
        margin: 3px;
        color: #000;
    }

    .swal2-popup.swal2-toast .swal2-title {
        margin: 10px !important;
        color: #6c757d;
    }


    #myProgress {
        width: 90%;
        background-color: #ddd;
        float:left;
        border-radius: 10px;
    }
    #mytick {
        width: 18%;
        margin-top: -26px;
        float: right;
        font-size: 30px;
        color: #369317;
    }
    #progresstick {
        width: 10%;
        margin-top: -26px;
        float: right;
        font-size: 30px;
        color: #979595;
    }

    #myBar {
        width: 100%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    }
    #progressBar {
        width: 1%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    }
</style>


<!-- <script>
    function myFunction(){
        let filecheck = document.getElementById("file").value;
        if(filecheck == '')
        {        
            Swal.fire({
                timer: 3000,
                icon: 'info',
                // toast: true,
                // position: 'top-end',
                title:'Please Select The Resume',
                showConfirmButton: false,

            })
            return false;

        }
    }

</script> -->

<!-- Resume file size and limit  -->
<!-- <script>
    var uploadField = document.getElementById("file");
    uploadField.onchange = function() {
        if (this.files[0].size > 1520555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("filelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("filelimit").innerHTML = "";
            }, 5000);
        };

    };

    var myfile="";

    $('#resume_link').click(function( e ) {
        e.preventDefault();
        $('#file').trigger('click');
    });

    $('#file').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="docx" || ext=="doc"){
        //    alert(ext);
    } else{
            ftype = "File Size is more than 1.5MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("filelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("filelimit").innerHTML = "";
            }, 5000);
    }
    });
</script> -->

<script>
    var uploadField = document.getElementById("file");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("filelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("filelimit").innerHTML = "";
            }, 5000);
        };
        
    };

    var myfile="";
    $('#resume_link').click(function( e ) {
        e.preventDefault();
        $('#file').trigger('click');
    });

    $('#file').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="docx" || ext=="doc"){
        //    alert(ext);
        var i = 0;
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("progressBar");
            var width = 1;
            var id = setInterval(frame, 10);
            function frame() {
            if (width >= 100) {
                clearInterval(id);
                i = 0;
            } else {
                width++;
                elem.style.width = width + "%";
                if(width == 100){
                    document.getElementById("progresstick").style.color = "#369317";
                }
                
            }
        }
            
        }
        
    } else{
            ftype = "File Size is more than 2MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("filelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("filelimit").innerHTML = "";

            }, 5000);
    }
    });
</script>

<script>
    $(function() {
        $('#totalExp').hide(); 
        $('#lastComp').hide(); 
        $('#NoticeP').hide(); 
        $('#CurrCTC').hide(); 

        $('#type').change(function(){
            if($('#type').val() == 2) {
                $('#totalExp').show(); 
                $('#lastComp').show(); 
                $('#NoticeP').show(); 
                $('#CurrCTC').show(); 
            } else {
                $('#totalExp').hide(); 
                $('#lastComp').hide(); 
                $('#NoticeP').hide(); 
                $('#CurrCTC').hide(); 
            } 
        });
    });


    $(".cancel").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('xshow');
        $(".cancel").toggle(isChecked && isShow);
    });

    $(".arrived").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('yshow');
        $(".arrived").toggle(isChecked && isShow);
    });

    $(".reschedule").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('zshow');
        $(".reschedule").toggle(isChecked && isShow);
    });
    $(".joingdays").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('ashow');
        $(".joingdays").toggle(isChecked && isShow);
    });
    $(".callback").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('bshow');
        $(".callback").toggle(isChecked && isShow);
    });
</script>


<?= $this->endSection() ?>