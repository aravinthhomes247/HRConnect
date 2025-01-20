<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header") ?>
<!-- https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.js -->
<!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.js"></script> -->

<style>
/* .Communication {
    float: left;
    height: 46px;
    padding: 0 10px;
} */


</style>

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
            <h1>Candidate Overview</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('/candidate?fdate=&todate=&trickid=1') ?>">Candidate List</a></li>
              <li class="breadcrumb-item active">Candidate Overview</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
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
                                    <b>Status</b> <a class="float-right">
                                        <?php   if($candidate_details[0]['ScheduleStatus']==10){
                                                    echo 'Processing'; 
                                                }elseif($candidate_details[0]['ScheduleStatus']==0){
                                                    echo 'Selected';                                            
                                                }else{
                                                    echo 'Not Started';                                            
                                                }?>
                                    </a>
                                </li>
                            </ul>
                            <div class="cv text-center" style="padding-top: 8px; ">
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$candidate_details[0]['CandidateResume']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> View Resume</b></a> 
                            </div>
                        </div>
                    </div>               
                </div>

                <div class="col-lg-8">
                    <!-- History Me Box -->
                    <div class="card card-orange card-outline">
                        <div class="card-header">
                            <h3 class="profile-username">Candidate History</h3>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <h1 class="candidateName"><?= $candidate_details[0]['CandidateName'] ?></h1>
                                <ul>
                                <?php foreach($CanHistory as $val){ ?>                                    
                                    <li>
                                        <div class="contents">
                                            <h5><?=$val['Status']?></h5>
                                            <p><?=$val['Remarks']?> </p>
                                        </div>
                                        <div class="time">
                                            <h4> <?=$val['added_date']?></h4>
                                        </div>
                                    </li>
                                <?php } ?>
                                    <div style="clear:both;"></div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>



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
                                    <p class="text-muted"><?php if($candidate_details[0]['CandidateExperience']==1){
                                                                    echo 'Fresher';
                                                                }else{
                                                                echo $candidate_details[0]['TotalExperience'].' Years';
                                                                }  ?></p>        
                                    <hr>   

                                    <strong><i class="fa-regular fa-money-bill-1 mr-1"></i> Expected CTC</strong>        
                                    <p class="text-muted"><?= $candidate_details[0]['CandidateExpectedCTC'] ?> Salary</p>
                                    <hr>

                                    
                                </div>
                                <?php if($candidate_details[0]['CandidateExperience']==2){ ?>
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
                                <?php if($candidate_details[0]['ImmediateJoiner']=='Yes'){ ?>
                                    <strong><i class="far fa-file-alt mr-1"></i> Immediate Joiner</strong>        
                                    <p class="text-muted"> <?= $candidate_details[0]['ImmediateJoiner'] ?> </p>
                                    <hr>
                                <?php }elseif($candidate_details[0]['ImmediateJoiner']=='No'){?>
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



                <?php if(!empty($roundList)){?>
                <div class="col-lg-12">
                    <div class="card card-orange card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-round1-tab" data-toggle="pill" href="#custom-tabs-four-round1" role="tab" aria-controls="custom-tabs-four-round1" aria-selected="true">Round 1</a>
                                </li>
                                <?php if(!empty($roundList[1])){?>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-round2-tab" data-toggle="pill" href="#custom-tabs-four-round2" role="tab" aria-controls="custom-tabs-four-round2" aria-selected="false">Round 2</a>
                                </li>
                                <?php } ?>
                                <?php if(!empty($roundList[2])){?>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-round3-tab" data-toggle="pill" href="#custom-tabs-four-round3" role="tab" aria-controls="custom-tabs-four-round3" aria-selected="false">Round 3</a>
                                </li>
                                <?php } ?>
                                <?php if(!empty($roundList[3])){?>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-round4-tab" data-toggle="pill" href="#custom-tabs-four-round4" role="tab" aria-controls="custom-tabs-four-round4" aria-selected="false">Round 4</a>
                                </li>
                                <?php } ?>
                                <?php if(!empty($roundList[4])){?>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-round5-tab" data-toggle="pill" href="#custom-tabs-four-round5" role="tab" aria-controls="custom-tabs-four-round5" aria-selected="false">Round 5</a>
                                </li>
                                <?php } ?>
                                <?php if(!empty($roundList[5])){?>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-round6-tab" data-toggle="pill" href="#custom-tabs-four-round6" role="tab" aria-controls="custom-tabs-four-round6" aria-selected="false">Round 6</a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-four-round1" role="tabpanel" aria-labelledby="custom-tabs-four-round1-tab">
                                    <div class="form-row">                                                    
                                        <div class="col-lg-6 mt-2 text-center ">                                                 
                                            <b>Interviewer : <?= $roundDetails[0]['InterviewerName']?></b>
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
                                                            <?php if($roundDetails[0]['Communication']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                            <?php }else if($roundDetails[0]['Communication']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['Communication']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['Communication']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['Communication']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>                                          
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Attitude </td>
                                                    <td>
                                                        <div class="Attitude ">                                                 
                                                            <?php if($roundDetails[0]['Attitude']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[0]['Attitude']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['Attitude']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['Attitude']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['Attitude']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Discipline </td>
                                                    <td>
                                                        <div class="Discipline ">                                                 
                                                            <?php if($roundDetails[0]['Discipline']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[0]['Discipline']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['Discipline']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['Discipline']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['Discipline']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>DressCode </td>
                                                    <td>
                                                        <div class="DressCode ">                                                 
                                                            <?php if($roundDetails[0]['DressCode']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[0]['DressCode']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['DressCode']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['DressCode']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['DressCode']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Knowledge </td>
                                                    <td>
                                                        <div class="Knowledge ">                                                 
                                                            <?php if($roundDetails[0]['Knowledge']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[0]['Knowledge']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['Knowledge']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['Knowledge']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[0]['Knowledge']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
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
                                                            <?php if($roundDetails[0]['OverAllRating']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                              
                                                            <?php }else if($roundDetails[0]['OverAllRating']==4.5) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>                                                                       
                                                            <?php }else if($roundDetails[0]['OverAllRating']==4) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>                                                                       
                                                            <?php }else if($roundDetails[0]['OverAllRating']==3.5) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>                                                                       
                                                            <?php }else if($roundDetails[0]['OverAllRating']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[0]['OverAllRating']==2.5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[0]['OverAllRating']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[0]['OverAllRating']==1.5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[0]['OverAllRating']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }?>
                                                        </div>                                                                
                                                    </td>
                                                </tr>  
                                                <tr class="text-center">
                                                    <td colspan="2">Rating : <?= $roundDetails[0]['OverAllRating']?> </td>                                                                
                                                </tr> 
                                            </table>
                                            <textarea class="form-control mt-2"  name="InterviewRemarks" ><?= $roundDetails[0]['InterviewRemarks']?></textarea>

                                        </div>
                                    </div>                                                  
                                </div>
                                <?php if(!empty($roundList[1])){?>
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
                                                            <?php if($roundDetails[1]['Communication']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[1]['Communication']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['Communication']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['Communication']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['Communication']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>                                          
                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Attitude </td>
                                                    <td>
                                                        <div class="Attitude ">                                                 
                                                            <?php if($roundDetails[1]['Attitude']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[1]['Attitude']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['Attitude']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['Attitude']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['Attitude']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Discipline </td>
                                                    <td>
                                                        <div class="Discipline ">                                                 
                                                            <?php if($roundDetails[1]['Discipline']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[1]['Discipline']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['Discipline']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['Discipline']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['Discipline']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>DressCode </td>
                                                    <td>
                                                        <div class="DressCode ">                                                 
                                                            <?php if($roundDetails[1]['DressCode']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[1]['DressCode']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['DressCode']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['DressCode']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['DressCode']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            
                                                <tr>
                                                    <td>Knowledge </td>
                                                    <td>
                                                        <div class="Knowledge ">                                                 
                                                            <?php if($roundDetails[1]['Knowledge']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[1]['Knowledge']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['Knowledge']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['Knowledge']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                        
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[1]['Knowledge']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                        
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
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
                                                            <?php if($roundDetails[1]['OverAllRating']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>          
                                                                                                                            
                                                            <?php }else if($roundDetails[1]['OverAllRating']==4.5) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>                                                                       
                                                            <?php }else if($roundDetails[1]['OverAllRating']==4) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>                                                                       
                                                            <?php }else if($roundDetails[1]['OverAllRating']==3.5) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>                                                                       

                                                            <?php }else if($roundDetails[1]['OverAllRating']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[1]['OverAllRating']==2.5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[1]['OverAllRating']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[1]['OverAllRating']==1.5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[1]['OverAllRating']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }?>
                                                        </div>                                                                
                                                    </td>
                                                </tr>  
                                                <tr class="text-center">
                                                    <td colspan="2">Rating : <?= $roundDetails[1]['OverAllRating']?> </td>                                                                
                                                </tr> 
                                            </table>
                                            <textarea class="form-control mt-2"  name="InterviewRemarks" ><?= $roundDetails[1]['InterviewRemarks']?></textarea>

                                        </div>
                                    </div>  
                                </div> <?php } ?>
                                <?php if(!empty($roundList[2])){?>
                                <div class="tab-pane fade" id="custom-tabs-four-round3" role="tabpanel" aria-labelledby="custom-tabs-four-round3-tab">
                                    
                                    <div class="form-row">                                                    
                                        <div class="col-lg-6 mt-2 text-center ">                                                 
                                            <b>Interviewer : <?php if(!empty($roundDetails[2])){echo $roundDetails[2]['InterviewerName'];}?></b>
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
                                                            <?php if($roundDetails[2]['Communication']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[2]['Communication']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['Communication']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['Communication']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['Communication']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>                                          
                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Attitude </td>
                                                    <td>
                                                        <div class="Attitude ">                                                 
                                                            <?php if($roundDetails[2]['Attitude']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[2]['Attitude']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['Attitude']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['Attitude']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['Attitude']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Discipline </td>
                                                    <td>
                                                        <div class="Discipline ">                                                 
                                                            <?php if($roundDetails[2]['Discipline']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[2]['Discipline']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['Discipline']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['Discipline']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['Discipline']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>DressCode </td>
                                                    <td>
                                                        <div class="DressCode ">                                                 
                                                            <?php if($roundDetails[2]['DressCode']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[2]['DressCode']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['DressCode']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['DressCode']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['DressCode']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            
                                                <tr>
                                                    <td>Knowledge </td>
                                                    <td>
                                                        <div class="Knowledge ">                                                 
                                                            <?php if($roundDetails[2]['Knowledge']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[2]['Knowledge']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['Knowledge']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['Knowledge']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                        
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[2]['Knowledge']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                        
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
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
                                                            <?php if($roundDetails[2]['OverAllRating']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>          
                                                                                                                            
                                                            <?php }else if($roundDetails[2]['OverAllRating']==4.5) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>                                                                       
                                                            <?php }else if($roundDetails[2]['OverAllRating']==4) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>                                                                       
                                                            <?php }else if($roundDetails[2]['OverAllRating']==3.5) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>                                                                       

                                                            <?php }else if($roundDetails[2]['OverAllRating']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[2]['OverAllRating']==2.5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[2]['OverAllRating']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[2]['OverAllRating']==1.5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[2]['OverAllRating']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }?>
                                                        </div>                                                                
                                                    </td>
                                                </tr>  
                                                <tr class="text-center">
                                                    <td colspan="2">Rating : <?= $roundDetails[2]['OverAllRating']?> </td>                                                                
                                                </tr> 
                                            </table>
                                            <textarea class="form-control mt-2"  name="InterviewRemarks" ><?= $roundDetails[2]['InterviewRemarks']?></textarea>

                                        </div>
                                    </div>                                                     
                                </div> <?php } ?>
                                <?php if(!empty($roundList[3])){?>
                                <div class="tab-pane fade" id="custom-tabs-four-round4" role="tabpanel" aria-labelledby="custom-tabs-four-round4-tab">
                                    
                                    <div class="form-row">                                                    
                                        <div class="col-lg-6 mt-2 text-center ">                                                 
                                            <b>Interviewer : <?php if(!empty($roundDetails[3])){ echo $roundDetails[3]['InterviewerName'];}?></b>
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
                                                            <?php if($roundDetails[3]['Communication']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[3]['Communication']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['Communication']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['Communication']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['Communication']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>                                          
                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Attitude </td>
                                                    <td>
                                                        <div class="Attitude ">                                                 
                                                            <?php if($roundDetails[3]['Attitude']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[3]['Attitude']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['Attitude']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['Attitude']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['Attitude']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Discipline </td>
                                                    <td>
                                                        <div class="Discipline ">                                                 
                                                            <?php if($roundDetails[3]['Discipline']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[3]['Discipline']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['Discipline']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['Discipline']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['Discipline']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>DressCode </td>
                                                    <td>
                                                        <div class="DressCode ">                                                 
                                                            <?php if($roundDetails[3]['DressCode']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[3]['DressCode']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['DressCode']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['DressCode']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['DressCode']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            
                                                <tr>
                                                    <td>Knowledge </td>
                                                    <td>
                                                        <div class="Knowledge ">                                                 
                                                            <?php if($roundDetails[3]['Knowledge']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[3]['Knowledge']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['Knowledge']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['Knowledge']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                        
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[3]['Knowledge']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                        
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
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
                                                            <?php if($roundDetails[3]['OverAllRating']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>          
                                                                                                                            
                                                            <?php }else if($roundDetails[3]['OverAllRating']==4.5) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>                                                                       
                                                            <?php }else if($roundDetails[3]['OverAllRating']==4) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>                                                                       
                                                            <?php }else if($roundDetails[3]['OverAllRating']==3.5) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>                                                                       

                                                            <?php }else if($roundDetails[3]['OverAllRating']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[3]['OverAllRating']==2.5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[3]['OverAllRating']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[3]['OverAllRating']==1.5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[3]['OverAllRating']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }?>
                                                        </div>                                                                
                                                    </td>
                                                </tr>  
                                                <tr class="text-center">
                                                    <td colspan="2">Rating : <?= $roundDetails[3]['OverAllRating']?> </td>                                                                
                                                </tr> 
                                            </table>
                                            <textarea class="form-control mt-2"  name="InterviewRemarks" ><?= $roundDetails[3]['InterviewRemarks']?></textarea>

                                        </div>
                                    </div>                                                 
                                </div> <?php } ?>
                                <?php if(!empty($roundList[4])){?>
                                <div class="tab-pane fade" id="custom-tabs-four-round5" role="tabpanel" aria-labelledby="custom-tabs-four-round5-tab">
                                    
                                    <div class="form-row">                                                    
                                        <div class="col-lg-6 mt-2 text-center ">                                                 
                                            <b>Interviewer : <?php if(!empty($roundDetails[4])){ echo $roundDetails[4]['InterviewerName'];}?></b>
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
                                                            <?php if($roundDetails[4]['Communication']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[4]['Communication']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['Communication']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['Communication']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['Communication']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>                                          
                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Attitude </td>
                                                    <td>
                                                        <div class="Attitude ">                                                 
                                                            <?php if($roundDetails[4]['Attitude']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[4]['Attitude']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['Attitude']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['Attitude']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['Attitude']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Discipline </td>
                                                    <td>
                                                        <div class="Discipline ">                                                 
                                                            <?php if($roundDetails[4]['Discipline']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[4]['Discipline']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['Discipline']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['Discipline']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['Discipline']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>DressCode </td>
                                                    <td>
                                                        <div class="DressCode ">                                                 
                                                            <?php if($roundDetails[4]['DressCode']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[4]['DressCode']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['DressCode']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['DressCode']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['DressCode']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            
                                                <tr>
                                                    <td>Knowledge </td>
                                                    <td>
                                                        <div class="Knowledge ">                                                 
                                                            <?php if($roundDetails[4]['Knowledge']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[4]['Knowledge']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['Knowledge']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['Knowledge']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                        
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[4]['Knowledge']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                        
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
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
                                                            <?php if($roundDetails[4]['OverAllRating']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>          
                                                                                                                            
                                                            <?php }else if($roundDetails[4]['OverAllRating']==4.5) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>                                                                       
                                                            <?php }else if($roundDetails[4]['OverAllRating']==4) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>                                                                       
                                                            <?php }else if($roundDetails[4]['OverAllRating']==3.5) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>                                                                       

                                                            <?php }else if($roundDetails[4]['OverAllRating']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[4]['OverAllRating']==2.5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[4]['OverAllRating']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[4]['OverAllRating']==1.5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[4]['OverAllRating']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }?>
                                                        </div>                                                                
                                                    </td>
                                                </tr>  
                                                <tr class="text-center">
                                                    <td colspan="2">Rating : <?= $roundDetails[4]['OverAllRating']?> </td>                                                                
                                                </tr> 
                                            </table>
                                            <textarea class="form-control mt-2"  name="InterviewRemarks" ><?= $roundDetails[4]['InterviewRemarks']?></textarea>

                                        </div>
                                    </div>    
                                </div> <?php } ?>
                                <?php if(!empty($roundList[5])){?>

                                <div class="tab-pane fade" id="custom-tabs-four-round6" role="tabpanel" aria-labelledby="custom-tabs-four-round6-tab">
                                    
                                    <div class="form-row">                                                    
                                        <div class="col-lg-6 mt-2 text-center ">                                                 
                                            <b>Interviewer : <?php if(!empty($roundDetails[5])){ echo $roundDetails[5]['InterviewerName'];}?></b>
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
                                                            <?php if($roundDetails[5]['Communication']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[5]['Communication']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['Communication']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['Communication']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['Communication']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>                                          
                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Attitude </td>
                                                    <td>
                                                        <div class="Attitude ">                                                 
                                                            <?php if($roundDetails[5]['Attitude']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[5]['Attitude']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['Attitude']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['Attitude']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['Attitude']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Discipline </td>
                                                    <td>
                                                        <div class="Discipline ">                                                 
                                                            <?php if($roundDetails[5]['Discipline']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[5]['Discipline']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['Discipline']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['Discipline']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['Discipline']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>DressCode </td>
                                                    <td>
                                                        <div class="DressCode ">                                                 
                                                            <?php if($roundDetails[5]['DressCode']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[5]['DressCode']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['DressCode']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['DressCode']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['DressCode']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            
                                                <tr>
                                                    <td>Knowledge </td>
                                                    <td>
                                                        <div class="Knowledge ">                                                 
                                                            <?php if($roundDetails[5]['Knowledge']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                      
                                                            <?php }else if($roundDetails[5]['Knowledge']==4){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['Knowledge']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['Knowledge']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                        
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }else if($roundDetails[5]['Knowledge']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>                                                                        
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                                <i class="fa-sharp fa-solid fa-star unstar"></i>
                                                            <?php }?>
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
                                                            <?php if($roundDetails[5]['OverAllRating']==5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>          
                                                                                                                            
                                                            <?php }else if($roundDetails[5]['OverAllRating']==4.5) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>                                                                       
                                                            <?php }else if($roundDetails[5]['OverAllRating']==4) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>                                                                       
                                                            <?php }else if($roundDetails[5]['OverAllRating']==3.5) {?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>                                                                       

                                                            <?php }else if($roundDetails[5]['OverAllRating']==3){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[5]['OverAllRating']==2.5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[5]['OverAllRating']==2){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[5]['OverAllRating']==1.5){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-solid fa-star-half-stroke star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }else if($roundDetails[5]['OverAllRating']==1){?>
                                                                <i class="fa-sharp fa-solid fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                                <i class="fa-regular fa-star star"></i>
                                                            <?php }?>
                                                        </div>                                                                
                                                    </td>
                                                </tr>  
                                                <tr class="text-center">
                                                    <td colspan="2">Rating : <?= $roundDetails[5]['OverAllRating']?> </td>                                                                
                                                </tr> 
                                            </table>
                                            <textarea class="form-control mt-2"  name="InterviewRemarks" ><?= $roundDetails[5]['InterviewRemarks']?></textarea>

                                        </div>
                                    </div> 
                                
                                </div> <?php } ?>

                                
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <?php } ?>
                
                <?php if(!empty($documents)){?>
                <div class="col-lg-12">
                    
                    <div class="card card-orange card-outline">
                        <div class="card-header">
                            <h3 class="profile-username">Documents </h3>
                        </div>
                        <div class="card-body p-0 pb-3">
                            <div class="cv text-center" style="padding-top: 8px; ">
                            <?php if( strstr($documents[0]['SSLCMarksCard'],".pdf") == ".pdf"){   ?>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['SSLCMarksCard']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b>  SSLC Marks Card</b></a> 
                            <?php }?>
                            <?php if( strstr($documents[0]['PUCMarksCard'],".pdf") == ".pdf"){   ?>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['PUCMarksCard']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b>  PUC/Diploma Marks Card</b></a> 
                            <?php }?>
                            <?php if( strstr($documents[0]['DegreeMarksCard'],".pdf") == ".pdf"){   ?>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['DegreeMarksCard']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b>  Degree Marks Card</b></a> 
                            <?php }?>
                            <?php if( strstr($documents[0]['AadharCard'],".pdf") == ".pdf"){   ?>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['AadharCard']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b>  Aadhar Card</b></a> 
                            <?php }?>
                            <?php if( strstr($documents[0]['PanCard'],".pdf") == ".pdf"){   ?>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['PanCard']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b>  Pan Card</b></a> 
                            <?php }?>
                                <?php if($candidate_details[0]['CandidateExperience'] == 2){?>
                            <?php if( strstr($documents[0]['ExperienceLetter'],".pdf") == ".pdf"){   ?>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['ExperienceLetter']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b>  Experience Letter</b></a> 
                            <?php }?>
                            <?php if( strstr($documents[0]['PaySlip'],".pdf") == ".pdf"){   ?>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['PaySlip']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b>  PaySlip</b></a> 
                            <?php }?>
                            <?php if( strstr($documents[0]['BankStatement'],".pdf") == ".pdf"){   ?>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['BankStatement']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b>  Bank Statement</b></a> 
                            <?php }?>
                            <?php if( strstr($documents[0]['OtherDocument'],".pdf") == ".pdf"){   ?>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['OtherDocument']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b>  Other Document</b></a> 
                            <?php }?>
                            <?php if( strstr($documents[0]['EmployerConfirmation'],".pdf") == ".pdf"){   ?>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['EmployerConfirmation']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b>  Employer Confirmation</b></a> 
                            <?php }?>
                                <?php } ?>
                            </div>
                        </div>
                    
                        <div class="card-body p-0 pb-3">

                            <div id="gf-BtnContainer" class="filter">
                                
                            </div>
                            <div class="gallery sets">
                            <?php if( !empty(strstr($documents[0]['SSLCMarksCard'],".pdf") != ".pdf")){   ?>
                                <div class="gf-column bollywood">
                                    <img src="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['SSLCMarksCard']); ?>" title="SSLC Marks Card" /> SSLC Marks Card
                                </div>         
                            <?php }?>
                            <?php if( strstr($documents[0]['PUCMarksCard'],".pdf") != ".pdf"){   ?>                      

                                <div class="gf-column bollywood">
                                    <img src="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['PUCMarksCard']); ?>" /> PUC Marks Card
                                </div>
                            <?php }?>
                            <?php if( strstr($documents[0]['DegreeMarksCard'],".pdf") != ".pdf"){   ?>  

                                <div class="gf-column bollywood">
                                    <img src="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['DegreeMarksCard']); ?>" /> Degree Marks Card
                                </div>
                            <?php }?>
                            <?php if( strstr($documents[0]['AadharCard'],".pdf") != ".pdf"){   ?> 

                                <div class="gf-column bollywood">
                                    <img src="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['AadharCard']); ?>" />Aadhar Card
                                </div>
                            <?php }?>
                            <?php if( strstr($documents[0]['PanCard'],".pdf") != ".pdf"){   ?> 
                                <div class="gf-column bollywood">
                                    <img src="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['PanCard']); ?>" />Pan Card
                                </div>
                            <?php }?>
                                <?php if($candidate_details[0]['CandidateExperience'] == 2){?>
                            <?php if( strstr($documents[0]['ExperienceLetter'],".pdf") != ".pdf"){   ?> 
                                <div class="gf-column bollywood">
                                    <img src="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['ExperienceLetter']); ?>" />Experience Letter
                                </div>
                            <?php }?>
                            <?php if( strstr($documents[0]['PaySlip'],".pdf") != ".pdf"){   ?> 
                                <div class="gf-column bollywood">
                                    <img src="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['PaySlip']); ?>" />Pay Slip
                                </div>   
                            <?php }?>
                            <?php if(!empty(strstr($documents[0]['BankStatement'],".pdf") != ".pdf")){   ?>                              
                                <div class="gf-column bollywood">
                                    <img src="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['BankStatement']); ?>" />Bank Statement
                                </div>
                            <?php }?>
                            <?php if( strstr($documents[0]['OtherDocument'],".pdf") != ".pdf"){   ?> 
                                <div class="gf-column bollywood">
                                    <img src="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['OtherDocument']); ?>" />Other Document
                                </div>
                            <?php }?>
                            <?php if( strstr($documents[0]['EmployerConfirmation'],".pdf") != ".pdf"){   ?> 
                                <div class="gf-column bollywood">
                                    <img src="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['EmployerConfirmation']); ?>" />Employer Confirmation
                                </div>
                            <?php }?> 
                                <?php }?> 
                            </div>
                        </div>
                    </div>
                </div> 
                <?php } ?>

                <?php if(!empty($offerLetter)){?>
                <div class="col-lg-12 ">
                    <div class="card card-orange card-outline">                                               
                        <div class="card-header">
                            <div class="row">
                                <h3 class="profile-username">Offer Letter </h3>
                            </div>
                        </div>
                        <div class="card-body ">
                            <h6>Take Home Salary: <?= $offerLetter[0]['TakeOmSalary']?></h6>
                            <h6>Joining Date: <?= $offerLetter[0]['JoiningDate']?></h6>
                            <h6>Reporting Manage: <?= $offerLetter[0]['ReportingManageName']?></h6>
                            <h6>Designation: <?= $offerLetter[0]['designations']?></h6><br>
                            Dear <?= $offerLetter[0]['CandidateName']?>,
                            <?= $offerLetter[0]['OL_OfferMsg']?> <br>
                            
                        </div>
                    </div>
                </div>
                <?php } ?>

                
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>


<style>
  /* @import url('https://fonts.googleapis.com/css?family=Montserrat:400,500,600');
  body{
    padding:0;
    margin:0;
    font-family: 'Montserrat', sans-serif;
  }*/
.candidateName{
    font-size:26px;
    text-align:center;
    /* margin: 47px 249px 21px 260px; */
    padding:5px 15px;
    background:#0b3544;
    color:#fff;
    border-radius:12px;
    box-shadow:3px 4px 5px 3px #0b354447;
  } 
  .timeline{
    position:relative;
    /* margin:22px auto; */
    /* padding:40px 0; */
    /* width:1000px; */
    box-sizing:border-box;
  }
  .timeline:before{
    content:'';
    position:absolute;
    left:50%;
    top: 70px;
    width:2px;
    /* height:100%; */
    background:#c5c5c5;
    /* margin: 98px 0px 1px 0px; */
  }
  .timeline ul{
    padding:0;
    margin:0;
  }
  .timeline ul li{
    list-style:none;
    position:relative;
    width:50%;
    padding:10px 10px;
    box-sizing:border-box;
  }
  .timeline ul li:nth-child(odd){
    float:left;
    text-align:right;
    clear:both;
  }
  .timeline ul li:nth-child(even){
    float:right;
    text-align:left;
    clear:both;
  }
  .contents{
    background: #0b3544;
    color: #fff;
    padding: 10px;
    border-radius: 10px;
  }
  .timeline ul li:nth-child(odd):before
  {
    content:'';
    position:absolute;
    width:10px;
    height:10px;
    top:24px;
    right:-6px;
    background:rgb(229 101 46);
    border-radius:50%;
    box-shadow:0px 0px 0px 3px #dbe1e3eb;
  }
  .timeline ul li:nth-child(even):before
  {
    content:'';
    position:absolute;
    width:10px;
    height:10px;
    top:24px;
    left:-4px;
    background:rgb(229 101 46);
    border-radius:50%;
    box-shadow:0px 0px 0px 3px #dbe1e3eb;
  }
  .timeline ul li h5{
    padding:0;
    margin:0;
    color:rgb(251 127 72);
    font-weight:600;
  }
  .timeline ul li p{
    margin: 0 0;
    padding:0;
  }
  .timeline ul li .time h4{
    margin:0;
    padding:0;
    font-size:14px;
  }
  .timeline ul li:nth-child(odd) .time
  {
    position:absolute;
    top:12px;
    right:-172px;
    margin:0;
    padding:8px 16px;
    background:rgb(229 101 46);
    color:#fff;
    border-radius:18px;
    box-shadow:3px 4px 5px 3px #0b354447;
  }
  .timeline ul li:nth-child(even) .time
  {
    position:absolute;
    top:12px;
    left:-170px;
    margin:0;
    padding:8px 16px;
    background:rgb(229 101 46);
    color:#fff;
    border-radius:18px;
    box-shadow:3px 4px 5px 3px #0b354447;
  }
  @media(max-width:1000px)
  {
    .timeline{
      width:100%;
    }
  }
  @media(max-width:767px){
    .timeline{
      width:100%;
      padding-bottom:0;
    }
    h1{
      font-size:40px;
      text-align:center;
    }
    .timeline:before{
      left:20px;
      /* height:100%; */
    }
    .timeline ul li:nth-child(odd),
    .timeline ul li:nth-child(even)
    {
      width:100%;
      text-align:left;
      top:40px;
      padding-left:50px;
      padding-bottom:50px;
    }
    .timeline ul li:nth-child(odd):before,
    .timeline ul li:nth-child(even):before
    {
      top:-18px;
      left:16px;
    }
    .timeline ul li:nth-child(odd) .time,
    .timeline ul li:nth-child(even) .time{
      top:-30px;
      left:50px;
      right:inherit;
    }
  }

  .propname {
    position:absolute;
    top:12px;
    right:-165px;
    margin:0;
    padding:8px 16px;
    background:rgb(229 101 46);
    color:#fff;
    border-radius:18px;
    box-shadow:3px 4px 5px 3px #0b354447;
  }
</style>



<style>
    .section-ajeet-title {
        position: relative;
        font-size: 30px;
        font-weight: 600;
        font-family: "Poppins", sans-serif;
        margin: 0 0 35px;
        }
        .gallery-sec {
        padding: 90px 0 40px;
        }

        .gf-column {
        float: left;
        display: none; /* Hide all elements by default */
        }

        /* The "show" class is added to the filtered elements */
        .show {
        /* display: block; */
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        .filter {
        /* padding: 20px 2px 10px; */
        text-align: center;
        max-width: 1050px;
        margin: auto;
        object-fit: cover;
        }

        .gf-btn {
        padding: 10px 20px;
        margin: 5px 4px 4px 0;
        display: inline-block;
        color: #000;
        background: #fff;
        font-size: 18px;
        font-weight: 500;
        border: 1px solid #265df2;
        text-decoration: none;
        transition: all 0.2s;
        border-radius: 9px;
        cursor: pointer;
        }
        .gf-btn:hover,
        .gf-btn-active {
        background: #265df2;
        color: #fff;
        -webkit-transform: translateY(3px);
        -ms-transform: translateY(3px);
        transform: translateY(3px);
        }

        .gallery {
        display: flex;
        justify-content: center;
        width: fit-content;
        max-width: 1320px;
        flex-wrap: wrap;
        margin: 25px auto;
        /* gap: 14px; */
        }
        .gallery img {
        /* width: 200px; */
        /* height: 260px; */
        width: 100px;
        height: 130px;
        object-fit: cover;
        /* background: center center/cover no-repeat #ddd; */
        transition: 0.3s ease-in-out;
        border-radius: 12px;
        overflow: hidden;
        margin: 10px 10px;
        }
        .gallery img:hover::after {
        content: "E";
        }

        .gallery img:hover,
        video:hover {
        transform: scale(1.1);
        }

        .butonsSection {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 7px 15px;
        gap: 15px;
        }
        .closeBtn {
        font-size: 22px;
        letter-spacing: 2px;
        color: #fff;
        transition: all 0.4s linear;
        padding: 8px 50px;
        border-radius: 25px;
        background: #e5652e;
        border: 0;
        outline-offset: -5px;
        outline: 2px solid #fff;
        }
        .closeBtn:hover {
        cursor: auto;
        background: white;
        color: black;
        padding: 8px 45px;
        outline-offset: 4px;
        outline: 2px solid #fff;
        }

        .openDiv {
        width: 100%;
        height: 100vh;
        background: #000000e7;
        position: fixed;
        top: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        left: 0;
        z-index: 9999;
        }
        .imgPreview {
        /*    width: 70%;  */
        object-fit: scale-down;
        max-height: 80vh;
        height: auto;
        }

        .sets .hide,
        .sets .pophide {
        width: 0%;
        opacity: 0;
        }

        .all-btn {
        text-align: center;
        background-color: #265df2;
        border-radius: 30px;
        margin: -15px auto 0;
        font-size: 1rem;
        width: 100%;
        max-width: 300px;
        padding: 5px 10px;
        letter-spacing: 1px;
        cursor: pointer;
        }

        .all-btn:active {
        transform: translateY(2px);
        }

        /* Responsive css Code Start */

        @media (max-width: 767px) {
        .gallery img {
            margin: 8px 8px;
            width: 175px;
        }

        .closeBtn {
            padding: 8px 25px;
        }

        .imgPreview {
            width: 80%;
            height: auto;
        }
        }

        @media (max-width: 575px) {
        .gallery img {
            margin: 8px 6px;
            width: 155px;
        }

        .gf-btn {
            font-size: 15px;
        }

        .closeBtn {
            font-size: 18px;
            padding: 8px 25px;
            border-radius: 15px;
        }
        .closeBtn:hover {
            padding: 8px 20px;
        }

        .imgPreview {
            width: 90%;
            /* max-height: 50vh; */
            height: auto;
        }
        }

</style>

<script>
    filterSelection("bollywood");
    function filterSelection(c) {
    var x, i;
    x = document.getElementsByClassName("gf-column");
    if (c == "all") c = "";
    for (i = 0; i < x.length; i++) {
        w3RemoveClass(x[i], "show");
        if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
    }
    }

    function w3AddClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
        if (arr1.indexOf(arr2[i]) == -1) {
        element.className += " " + arr2[i];
        }
    }
    }

    function w3RemoveClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
        while (arr1.indexOf(arr2[i]) > -1) {
        arr1.splice(arr1.indexOf(arr2[i]), 1);
        }
    }
    element.className = arr1.join(" ");
    }

    // Highlight active button and current button
    var btnContainer = document.getElementById("gf-BtnContainer");
    var btns = btnContainer.getElementsByClassName("gf-btn");
    for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function () {
        var current = document.getElementsByClassName("gf-btn-active");
        current[0].className = current[0].className.replace(" gf-btn-active", "");
        this.className += " gf-btn-active";
    });
    }

    // Popup Gallery Script

    let imgs = document.querySelectorAll("img");
    let count;
    imgs.forEach((img, index) => {
    img.addEventListener("click", function (e) {
        if (e.target == this) {
        count = index;
        let openDiv = document.createElement("div");
        let imgPreview = document.createElement("img");
        let butonsSection = document.createElement("div");
        butonsSection.classList.add("butonsSection");
        let closeBtn = document.createElement("button");

        closeBtn.classList.add("closeBtn");
        closeBtn.innerText = "Close";
        closeBtn.addEventListener("click", function () {
            openDiv.remove();
        });

        imgPreview.classList.add("imgPreview");
        imgPreview.src = this.src;

        //   butonsSection.append(prevButton, nextBtn);
        openDiv.append(imgPreview, butonsSection, closeBtn);

        openDiv.classList.add("openDiv");

        document.querySelector("body").append(openDiv);
        }
    });
    });

</script>





<?= $this->endSection() ?>