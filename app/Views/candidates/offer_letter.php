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
            <h1>On-Boarding Process</h1>
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
                                    <b>Joining Date</b> <a class="float-right"><?php if(!empty($offerLetter)){ echo $offerLetter[0]['JoiningDate'];} ?></a>
                                </li>                                
                            </ul>
                            <div class="cv text-center">
                                <a href="<?= site_url('/background_doc?canId='.$candidate_details[0]['CandidateId'])?>" class="btn  btn-sm bg-orange mt-1" ><b>Documents</b></a>
                                <a href="<?= site_url('/provious_rounds?canId='.$candidate_details[0]['CandidateId'])?>" class="btn btn-sm bg-orange mt-1" ><b>Overview</b></a>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$candidate_details[0]['CandidateResume']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> View Resume</b></a> 
                            </div>  
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    
                    
                </div>
                <!-- /.col -->
                
                <?php if(!empty($offerLetter)){?>
                <div class="col-lg-8 ">
                    <?php if(($offerLetter[0]['OL_Status'] == 1) && (empty($offerLetter[0]['CandidateConfirmation'])) || ($offerLetter[0]['CandidateConfirmation']==2)){?>
                    
                        <div class="card card-orange card-outline">
                            <div class="card-header">
                                <h3 class="profile-username">Candidate Conformation</h3>
                            </div>
                            <div class="card-body box-profile"> 
                                <form  action="<?= site_url('/update_confirmation') ?>" method="post" enctype="multipart/form-data" autocomplete="off"> 
                                <input type="hidden" name="CandidateIDFK" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <p class="text-muted text-center">
                                    <?php if($offerLetter[0]['CandidateConfirmation']==1){?>
                                        <input type="radio" name="CandidateConfirmation" value="1" checked > Confirm &nbsp; &nbsp; 
                                    <?php }else{?>
                                        <input type="radio" name="CandidateConfirmation" value="1" > Confirm &nbsp; &nbsp; 
                                    <?php } ?>
                                    <?php if($offerLetter[0]['CandidateConfirmation']==2){?>
                                        <input type="radio" name="CandidateConfirmation" value="2" checked > Not-Confirm  
                                    <?php }else{?>
                                        <input type="radio" name="CandidateConfirmation" value="2" > Not-Confirm 
                                    <?php } ?>
                                </p>
    
                                <div class="cv text-center" >
                                    <button class="btn btn-sm bg-orange"><b>Submit</b></button>
                                </div> 
                                </form> 
                            </div>
                            <!-- /.card-body -->
                        </div>
                    <?php } elseif(($offerLetter[0]['CandidateConfirmation'] == 1) && (empty($offerLetter[0]['JoiningStatus'])) || ($offerLetter[0]['JoiningStatus']==2)){?>
                        
                        <div class="card card-orange card-outline">
                            <div class="card-header">
                                <h3 class="profile-username">Candidate Joining</h3>
                            </div>
                            <div class="card-body box-profile"> 
                                <!-- <h3 class="profile-username text-center">Candidate Joining</h3> -->
                                <form  action="<?= site_url('/update_JoinStatus') ?>" method="post" enctype="multipart/form-data" autocomplete="off"> 
                                <input type="hidden" name="CandidateIDFK" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <p class="text-muted text-center">
                                    <?php if($offerLetter[0]['JoiningStatus']==1){?>
                                        <input type="radio" name="JoiningStatus" value="1" checked > Joined &nbsp; &nbsp; 
                                    <?php }else{?>
                                        <input type="radio" name="JoiningStatus" value="1" > Joined &nbsp; &nbsp; 
                                    <?php } ?>
                                    <?php if($offerLetter[0]['JoiningStatus']==2){?>
                                        <input type="radio" name="JoiningStatus" value="2" checked > Not-Joined  
                                    <?php }else{?>
                                        <input type="radio" name="JoiningStatus" value="2" > Not-Joined 
                                    <?php } ?>
                                </p>
    
                                <div class="cv text-center" >
                                    <button class="btn btn-sm bg-orange"><b>Submit</b></button>
                                </div> 
                                </form> 
                            </div>
                        </div>
                    <?php } elseif($offerLetter[0]['JoiningStatus'] == 1 ){?>

                        <div class="card card-orange card-outline">
                            <div class="card-header">
                                <h3 class="profile-username">Candidate Working</h3>
                            </div>
                            <div class="card-body">
                                <form action="<?= site_url('/update_WorkingStatus') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                                <input type="hidden" name="CandidateIDFK" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <div class="form-group" style="display: flex; flex-wrap: wrap;justify-content: center;">
                                    <?php if($offerLetter[0]['WorkingStatus']==1){?>
                                        <!-- <b class="canelradio"> <input  type="radio"  value="1" name="WorkingStatus" checked class="xshow"> Active &nbsp;&nbsp;&nbsp; </b> -->
                                    <?php }else{?>
                                        <b class="canelradio"> <input  type="radio"  value="1" name="WorkingStatus" class="xshow" > Active &nbsp;&nbsp;&nbsp; </b>
                                    <?php } ?>
                                    <?php if($offerLetter[0]['WorkingStatus']==2){?>
                                        <b class="canelradio"> <input  type="radio"  value="2" name="WorkingStatus" checked> InActive &nbsp;&nbsp;&nbsp; </b>
                                    <?php }else{?>
                                        <b class="canelradio"> <input  type="radio"  value="2" name="WorkingStatus" > InActive &nbsp;&nbsp;&nbsp; </b>
                                    <?php } ?>
                                    <?php if($offerLetter[0]['WorkingStatus']==3){?>
                                        <b class="canelradio"> <input  type="radio"  value="3" name="WorkingStatus" checked > Abscond &nbsp;&nbsp;&nbsp; </b>
                                    <?php }else{?>
                                        <b class="canelradio"> <input  type="radio"  value="3" name="WorkingStatus" > Abscond &nbsp;&nbsp;&nbsp; </b>
                                    <?php } ?>
                                </div>

                                <div class="form-group row justify-content-center Active">
                                    <select class="form-control col-3" name="EmployementType">
                                        <option>--Select-- </option>
                                            <?php
                                            if($selectEmpType){
                                              foreach ($selectEmpType as $row) {?>
                                              <option value="<?php echo $row["IDPK"] ?>"><?php echo $row["EmployeeTypeName"] ?> </option>
                                              <?php
                                             } }?>
                                      </select>
                                </div>
                                <div class="form-group text-center" >
                                    <button class="btn btn-sm bg-orange "><b>Submit</b></button>
                                </div>
                                </form>
                            </div>
                        </div>
                    <?php } ?>                    
                </div>
                
                <?php } ?>



                <?php if(empty($offerLetter)){?>
                <div class="col-lg-8 ">
                    <div class="card card-orange card-outline">                                               
                        <div class="card-header">
                            <div class="row">
                                <h3 class="profile-username ">Send Offer Letter </h3>
                            </div>
                        </div>
                        

                        <form  action="<?= site_url('/insert_offer_letter') ?>" method="post" enctype="multipart/form-data" autocomplete="off"> 
                            <input type="hidden" name="CandidateIDFK" value="<?= $candidate_details[0]['CandidateId'] ?>">
                            <input type="hidden" name="CandidateName" value="<?= $candidate_details[0]['CandidateName'] ?>">
                            <input type="hidden" name="CandidateEmail" value="<?= $candidate_details[0]['CandidateEmail'] ?>">
                        <div class="card-body ">
                            <div class="form-row">
                                <div class="form-group col-lg-4">
                                    
                                    <select class="form-control" name="DepartmentIDFK">
                                        <option>Select Departement </option>
                                        <?php
                                        if($selectdepart){
                                        foreach ($selectdepart as $row) {?>
                                        <option  value="<?php echo $row["IDPK"] ?>"><?php echo $row["deptName"] ?> </option>
                                        <?php
                                        } }?>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">                                                
                                    <select class="form-control" name="DesignationIDFK">
                                    <option>Select Designation </option>
                                        <?php
                                        if($selectdesignation){
                                        foreach ($selectdesignation as $row) {?>
                                        <option  value="<?php echo $row["IDPK"] ?>"><?php echo $row["designations"] ?> </option>
                                        <?php
                                        } }?>
                                    </select> 
                                </div>
                                <div class="form-group col-lg-4">
                                    
                                    <select class="form-control" name="ReportManagerIDFK" >
                                        <option>Reporting Manager </option>
                                        <?php
                                        if($reportManager){
                                        foreach ($reportManager as $row) {?>
                                        <option  value="<?php echo $row["EmployeeId"] ?>"><?php echo $row["EmployeeName"] ?> </option>
                                        <?php
                                        } }?>
                                    </select> 
                                </div>
                                <div class="form-group col-lg-3">
                                    
                                    <input type="text" class="form-control" name="TakeOmSalary" placeholder="Rs.30,000 " required>
                                </div>
                                <div class="form-group col-lg-3">
                                    
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="JoiningDate" data-target="#reservationdate" placeholder="Joining Date"  required />
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    
                                    <textarea  class="form-control" rows="5" name="OL_OfferMsg" >
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
                                    <script>  CKEDITOR.replace('OL_OfferMsg');  </script>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn  btn-sm bg-orange float-right" >Send</button>
                            
                        </div>
                        </form>
                    </div>

                               

                </div>
                
                <?php }else{?>
                <!-- /.col -->               
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
                <?php }?>


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


<style>
    .canelradio{
        /* background: #e5652e; */
        border-radius: 3px;
        padding: 10px;
        margin: 3px;
        color: #0b3544;
    }

    .onboard{
        background-color: #000;
        height: 350px;
        background-image: url(public/images/confetti-40.webp);
        border-radius: 10px;
        color:#fff;
    }
    .onboard_text{
        font-family: Snell Roundhand, cursive;
        font-weight: 900;
        padding-top: 105px;
    }
</style>



<script>
    $(".Active").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('xshow');
        $(".Active").toggle(isChecked && isShow);
    });
</script>




<?= $this->endSection() ?>