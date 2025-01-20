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
        
          
            <?php if($session->getFlashdata('candidatemsg')) {?>
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
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-lg-8">
                    <div class="card card-orange card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-schedule-tab" data-toggle="pill" href="#custom-tabs-schedule" role="tab" aria-controls="custom-tabs-schedule" aria-selected="true">Schedule</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="custom-tabs-not-schedule-tab" data-toggle="pill" href="#custom-tabs-not-schedule" role="tab" aria-controls="custom-tabs-not-schedule" aria-selected="true">Not Schedule</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-schedule" role="tabpanel" aria-labelledby="custom-tabs-schedule-tab">
                                    <form class="form-row" autocomplete="off"  action="interviewScheduled" method="post" >  
                                        <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">                                     
                                        <div class="col-lg-4 mt-3">                                            
                                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate" data-target="#reservationdatetime" placeholder="Interview Date and Time" required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-sm bg-orange float-right">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade " id="custom-tabs-not-schedule" role="tabpanel" aria-labelledby="custom-tabs-schedule-tab">
                                    <form class="form-row" action="interviewNotScheduled" method="post" autocomplete="off" >
                                        <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                        <div class="col-lg-12">
                                            <div class="form-group" style="display: flex; flex-wrap: wrap;">
                                                <?php if($notScheduleReasons){
                                                    foreach ($notScheduleReasons as $row ) {?>
                                                    <b class="canelradio"> <input type="radio"  value="<?php echo $row["NS_IDPK"] ?>" id="scheduled" name="scheduled" > <?php echo $row["NS_Reasons"] ?> &nbsp;&nbsp;&nbsp; </b>
                                                <?php } }?>
                                            </div>
                                        </div>
                                     
                                        <div class="col-lg-4 mt-3 callbackdate"> 
                                            <label>Call Back Date</label>                                           
                                            <div class="input-group date timedate" id="reservationdatetime1" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input " data-toggle="datetimepicker" name="CallBackDateTime" data-target="#reservationdatetime1" placeholder="Call Back Date and Time" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mt-3 "> 
                                            <label>Candidate Remarks</label>                                           
                                            <div class="input-group "  >
                                                <!-- <input type="text" class="form-control" name="CallBackDateTime" placeholder="Remakers" required /> -->
                                                <textarea class="form-control" name="CandidateReason" placeholder="Remarks"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-sm bg-orange float-right">Submit</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>


</div>

<script>
    $(document).ready(function() {
        // alert('hi');
        
        $("input[name='scheduled']").click(function(e){
            var juck = $('input:radio[name=scheduled]:checked').val();
            // alert(juck);
            if((juck === "11") || (juck === "3") || (juck === "7") || (juck === "8")){
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
    b.canelradio {
        padding: 10px;
    }
</style>

<?= $this->endSection() ?>