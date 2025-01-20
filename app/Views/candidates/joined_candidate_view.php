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
            <h1>Candidate Profile</h1>
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
                                    <b>Joining Date</b> <a class="float-right"><?= $offerLetter[0]['JoiningDate'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right">
                                        <?php   if($offerLetter[0]['CandidateConfirmation']==1){
                                                    echo 'Confirmed'; 
                                                }else{
                                                    echo 'Not Confirmed';                                            
                                                }?>
                                    </a>
                                </li>
                            </ul>
                            <div class="cv text-center">
                                <a href="<?= site_url('/background_doc?canId='.$candidate_details[0]['CandidateId'])?>" class="btn  btn-sm bg-orange mt-1" ><b>Documents</b></a>
                                <a href="<?= site_url('/provious_rounds?canId='.$candidate_details[0]['CandidateId'])?>" class="btn btn-sm bg-orange mt-1" ><b>Overview</b></a>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'/'.$candidate_details[0]['CandidateResume']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> View Resume</b></a> 
                            </div>

                           
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                                   
                </div>
                <!-- /.col -->
                <div class="col-lg-8">
                    <div class="card card-orange card-outline">
                        <div class="card-header">
                            <h3 class="profile-username">Action</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('/update_JoinStatus') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                            <input type="hidden" name="CandidateIDFK" value="<?= $candidate_details[0]['CandidateId'] ?>">
                            <div class="form-group" style="display: flex; flex-wrap: wrap;justify-content: center;">
                                <?php if($offerLetter[0]['JoinStatus']==1){?>
                                    <b class="canelradio"> <input  type="radio"  value="1" name="JoinStatus" checked> Active &nbsp;&nbsp;&nbsp; </b>
                                <?php }else{?>
                                    <b class="canelradio"> <input  type="radio"  value="1" name="JoinStatus" > Active &nbsp;&nbsp;&nbsp; </b>
                                <?php } ?>
                                <?php if($offerLetter[0]['JoinStatus']==2){?>
                                    <b class="canelradio"> <input  type="radio"  value="2" name="JoinStatus" checked> InActive &nbsp;&nbsp;&nbsp; </b>
                                <?php }else{?>
                                    <b class="canelradio"> <input  type="radio"  value="2" name="JoinStatus" > InActive &nbsp;&nbsp;&nbsp; </b>
                                <?php } ?>
                                <?php if($offerLetter[0]['JoinStatus']==3){?>
                                    <b class="canelradio"> <input  type="radio"  value="3" name="JoinStatus" checked > Abscond &nbsp;&nbsp;&nbsp; </b>
                                <?php }else{?>
                                    <b class="canelradio"> <input  type="radio"  value="3" name="JoinStatus" > Abscond &nbsp;&nbsp;&nbsp; </b>
                                <?php } ?>
                            </div>
                            <div class="form-group text-center" >
                                <button class="btn btn-sm bg-orange "><b>Submit</b></button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="card card-orange card-outline">
                        <div class="card-header">
                            <h3 class="profile-username">Documents</h3>
                        </div>
                        <div class="card-body p-0 pb-3">
                            <div class="cv text-center" style="padding-top: 8px; ">
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'/'.$documents[0]['SSLCMarksCard']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> SSLC Marks Card</b></a> 
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'/'.$documents[0]['PUCMarksCard']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> PUC/Diploma Marks Card</b></a> 
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'/'.$documents[0]['DegreeMarksCard']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> Degree Marks Card</b></a> 
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'/'.$documents[0]['AadharCard']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> Aadhar Card</b></a> 
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'/'.$documents[0]['PanCard']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> Pan Card</b></a> 
                                <?php if($candidate_details[0]['CandidateExperience'] == 2){?>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'/'.$documents[0]['ExperienceLetter']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> Experience Letter</b></a> 
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'/'.$documents[0]['PaySlip']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> PaySlip</b></a> 
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'/'.$documents[0]['BankStatement']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> Bank Statement</b></a> 
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'/'.$documents[0]['OtherDocument']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> Other Document</b></a> 
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'/'.$documents[0]['EmployerConformation']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> Employer Conformation</b></a> 
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card card-orange card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                
                                
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-round1-tab" data-toggle="pill" href="#custom-tabs-four-round1" role="tab" aria-controls="custom-tabs-four-round1" aria-selected="true">Round 1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-round2-tab" data-toggle="pill" href="#custom-tabs-four-round2" role="tab" aria-controls="custom-tabs-four-round2" aria-selected="false">Round 2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-round3-tab" data-toggle="pill" href="#custom-tabs-four-round3" role="tab" aria-controls="custom-tabs-four-round3" aria-selected="false">Round 3</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-round4-tab" data-toggle="pill" href="#custom-tabs-four-round4" role="tab" aria-controls="custom-tabs-four-round4" aria-selected="false">Round 4</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-round5-tab" data-toggle="pill" href="#custom-tabs-four-round5" role="tab" aria-controls="custom-tabs-four-round5" aria-selected="false">Round 5</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-round6-tab" data-toggle="pill" href="#custom-tabs-four-round6" role="tab" aria-controls="custom-tabs-four-round6" aria-selected="false">Round 6</a>
                                </li>
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
                                                                <!-- <i class="fa-regular fa-star-half-stroke star"></i>  -->
                                                                <!-- <i class="fa-duotone fa-star-half"></i> -->
                                                                
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
                                            </table>
                                            <textarea class="form-control mt-2"  name="InterviewRemarks" ><?= $roundDetails[0]['InterviewRemarks']?></textarea>

                                        </div>
                                    </div>                                                  
                                </div>
                                
                                <div class="tab-pane fade" id="custom-tabs-four-round2" role="tabpanel" aria-labelledby="custom-tabs-four-round2-tab">
                                    
                                    <div class="form-row">                                                    
                                        <div class="col-lg-6 mt-2 text-center ">                                                 
                                            <b>Interviewer : <?= $roundDetails[1]['InterviewerName']?></b>
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
                                            </table>
                                            <textarea class="form-control mt-2"  name="InterviewRemarks" ><?= $roundDetails[1]['InterviewRemarks']?></textarea>

                                        </div>
                                    </div>  
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-round3" role="tabpanel" aria-labelledby="custom-tabs-four-round3-tab">
                                    
                                    <div class="form-row">                                                    
                                        <div class="col-lg-6 mt-2 text-center ">                                                 
                                            <b>Interviewer : <?= $roundDetails[2]['InterviewerName']?></b>
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
                                            </table>
                                            <textarea class="form-control mt-2"  name="InterviewRemarks" ><?= $roundDetails[2]['InterviewRemarks']?></textarea>

                                        </div>
                                    </div>                                                     
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-round4" role="tabpanel" aria-labelledby="custom-tabs-four-round4-tab">
                                    
                                    <div class="form-row">                                                    
                                        <div class="col-lg-6 mt-2 text-center ">                                                 
                                            <b>Interviewer : <?= $roundDetails[3]['InterviewerName']?></b>
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
                                            </table>
                                            <textarea class="form-control mt-2"  name="InterviewRemarks" ><?= $roundDetails[3]['InterviewRemarks']?></textarea>

                                        </div>
                                    </div>                                                 
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-round5" role="tabpanel" aria-labelledby="custom-tabs-four-round5-tab">
                                    
                                    <div class="form-row">                                                    
                                        <div class="col-lg-6 mt-2 text-center ">                                                 
                                            <b>Interviewer : <?= $roundDetails[4]['InterviewerName']?></b>
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
                                            </table>
                                            <textarea class="form-control mt-2"  name="InterviewRemarks" ><?= $roundDetails[4]['InterviewRemarks']?></textarea>

                                        </div>
                                    </div>    
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-round6" role="tabpanel" aria-labelledby="custom-tabs-four-round6-tab">
                                    
                                    <div class="form-row">                                                    
                                        <div class="col-lg-6 mt-2 text-center ">                                                 
                                            <b>Interviewer : <?= $roundDetails[5]['InterviewerName']?></b>
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
                                            </table>
                                            <textarea class="form-control mt-2"  name="InterviewRemarks" ><?= $roundDetails[5]['InterviewRemarks']?></textarea>

                                        </div>
                                    </div>      

                                        
                                </div>
                            </div><br><br><br>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                
                <div class="col-lg-12">
                    <div class="card card-orange card-outline">
                        <div class="card-header">
                            <h3 class="profile-username">Offer Letter</h3>
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
                                    <p class="text-muted"><?= $candidate_details[0]['CandidateExpectedCTC'] ?> LPA</p>
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
                                    <p class="text-muted"><?= $candidate_details[0]['CandidateCurrentCTC'] ?> LPA</p>        
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
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>








<?= $this->endSection() ?>