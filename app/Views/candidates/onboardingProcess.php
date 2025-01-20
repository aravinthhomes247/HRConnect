<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header") ?>



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
          <div class="col-sm-12">
            <h1> Background and Documents Verification</h1>
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
                                    <b>Status</b> <a class="float-right">
                                        <?php if($roundList[0]['InterviewStatus']==2) {?>
                                            <span class="text">Documents Processing</span>
                                        <?php }elseif($roundList[0]['InterviewStatus']==3) {?>
                                            <span >Hold</span>
                                        <?php }elseif($roundList[0]['InterviewStatus']==4) {?>
                                            <span class="text-red">Rejected</span>
                                        <?php }?> </a>
                                </li>
                            </ul>

                            
                            
                            <div class="cv text-center" style="padding-top: 8px; ">
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$candidate_details[0]['CandidateResume']); ?>" target="_black" class="btn btn-sm bg-orange "><b> View Resume</b></a> 
                                <!-- <a href="" class="btn btn-sm bg-orange " id="resume_link" ><b>Upload New</b> </a> 
                                        <p id="filelimit" style="color: red;padding-left: 15px;"> </p>
                                        <input type="file" name="CandidateResume"  id="file" style="visibility: hidden" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"> -->
                                <a href="<?= site_url('/provious_rounds?canId='.$candidate_details[0]['CandidateId'])?>" class="btn btn-sm bg-orange " ><b>Overview</b></a>

                            </div>

                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    
                </div>
                <!-- /.col -->

                
                <div class="col-lg-8 ">
                    <div class="card card-orange card-outline">                                               
                        <div class="card-header">
                            <div class="row">
                                <h3 class="profile-username text-center">Upload Documents </h3>
                            </div>
                        </div>                        

                        <?php if(($candidate_details[0]['ScheduleStatus'] == 10) || ($candidate_details[0]['ScheduleStatus'] == 0)){?>

                            <?php   if($roundList[0]['InterviewStatus'] == 2 ){?>
                                <?php if($candidate_details[0]['CandidateExperience']==1){?> 
                                <form  action="<?= site_url('/insert_freshers_documents') ?>" method="post" enctype="multipart/form-data"> 
                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                    <input type="hidden" name="CandidateName" value="<?= $candidate_details[0]['CandidateName'] ?>">
                                    
                                <div class="card-body ">
                                    <div class="form-row">
                                        <div class="col-lg-6">
                                            <div class="drop-zone" id="disabled-input">
                                                <span class="drop-zone__prompt">Disabled Click on <i class="fa-solid fa-hand-point-right"></i> </span>
                                                <input type="file" name="" class="drop-zone__input" disabled >
                                            </div>
                                            <div class="drop-zone" id="sslc-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload SSLC Marks Card</span>
                                                <input type="file" name="SSLCMarksCard" class="drop-zone__input" id="SSLCMarksCard" >
                                            </div>
                                            <div class="drop-zone" id="puc-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload PUC Marks Card</span>
                                                <input type="file" name="PUCMarksCard" class="drop-zone__input" id="PUCMarksCard">
                                            </div>
                                            <div class="drop-zone" id="degree-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Degree Marks Card</span>
                                                <input type="file" name="DegreeMarksCard" class="drop-zone__input" id="DegreeMarksCard" >
                                            </div>
                                            <div class="drop-zone" id="aadhar-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Aadhar Card</span>
                                                <input type="file" name="AadharCard" class="drop-zone__input" id="AadharCard">
                                            </div>
                                            <div class="drop-zone" id="pan-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload PAN Card</span>
                                                <input type="file" name="PanCard" class="drop-zone__input" id="PanCard">
                                            </div>                                            
                                        </div>
                                        <div class="col-lg-6">
                                            <ul >
                                                <?php if(empty($documents[0]['SSLCMarksCard'])){?>
                                                    <li class="uploadcard"><a id="sslc" >SSLC Marks Card </a> </li>
                                                    <div id="myProgress">
                                                        <div id="sslcBar"></div>
                                                    </div>
                                                    <div id="sslctick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="SSLCMarksCardfilelimit" style="color: red; width:100%"> </span> 
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="sslc" >SSLC Marks Card </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="SSLCMarksCardfilelimit" style="color: red;"> </span>
                                                <?php }?>

                                                <?php if(empty($documents[0]['PUCMarksCard'])){?>
                                                    <li class="uploadcard"><a id="puc">PUC Marks Card</a></li>
                                                    <div id="myProgress">
                                                        <div id="pucBar"></div>
                                                    </div>
                                                    <div id="puctick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="PUCMarksCardfilelimit" style="color: red; "> </span>
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="puc" >PUC Marks Card </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="PUCMarksCardfilelimit" style="color: red;"> </span>
                                                <?php } ?>

                                                <?php if(empty($documents[0]['DegreeMarksCard'])){?>
                                                    <li class="uploadcard"><a id="degree">Degree Marks Card</a></li>
                                                    <div id="myProgress">
                                                        <div id="degreeBar"></div>
                                                    </div>
                                                    <div id="degreetick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="DegreeMarksCardfilelimit" style="color: red; "> </span>
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="degree" >Degree Marks Card </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="DegreeMarksCardfilelimit" style="color: red;"> </span>
                                                <?php } ?>

                                                <?php if(empty($documents[0]['AadharCard'])){?>
                                                    <li class="uploadcard"><a id="aadhar">Aadhar Card</a></li>
                                                    <div id="myProgress">
                                                        <div id="aadharBar"></div>
                                                    </div>
                                                    <div id="aadhartick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="AadharCardfilelimit" style="color: red; "> </span>
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="aadhar" >Aadhar Card </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="AadharCardfilelimit" style="color: red;"> </span>
                                                <?php } ?>

                                                <?php if(empty($documents[0]['PanCard'])){?>
                                                    <li class="uploadcard"><a id="pan">PAN Card</a></li>
                                                    <div id="myProgress">
                                                        <div id="panBar"></div>
                                                    </div>
                                                    <div id="pantick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="PanCardfilelimit" style="color: red; "> </span>
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="pan" >PAN Card </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="PanCardfilelimit" style="color: red;"> </span>
                                                <?php } ?>

                                                <textarea name="DVRemarks1" class="form-control" placeholder="Remarks" required><?php if(!empty($data['documents'])){ echo $documents[0]['DVRemarks'];} ?></textarea>

                                            
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php } elseif($candidate_details[0]['CandidateExperience']==2){?>
                                <form  action="<?= site_url('/insert_experience_documents') ?>" method="post" enctype="multipart/form-data"> 
                                    <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                    <input type="hidden" name="CandidateName" value="<?= $candidate_details[0]['CandidateName'] ?>">
                                    
                                <div class="card-body ">
                                    <div class="form-row">
                                        <div class="col-lg-6">
                                            <div class="drop-zone" id="disabled-input">
                                                <span class="drop-zone__prompt">Disabled Click on <i class="fa-solid fa-hand-point-right"></i> </span>
                                                <input type="file" name="" class="drop-zone__input" disabled >
                                            </div>
                                            <div class="drop-zone" id="sslc-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload SSLC Marks Card</span>
                                                <input type="file" name="SSLCMarksCard" class="drop-zone__input" id="SSLCMarksCard" >
                                            </div>
                                            <div class="drop-zone" id="puc-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload PUC Marks Card</span>
                                                <input type="file" name="PUCMarksCard" class="drop-zone__input" id="PUCMarksCard">
                                            </div>
                                            <div class="drop-zone" id="degree-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Degree Marks Card</span>
                                                <input type="file" name="DegreeMarksCard" class="drop-zone__input" id="DegreeMarksCard" >
                                            </div>
                                            <div class="drop-zone" id="aadhar-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Aadhar Card</span>
                                                <input type="file" name="AadharCard" class="drop-zone__input" id="AadharCard">
                                            </div>
                                            <div class="drop-zone" id="pan-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload PAN Card</span>
                                                <input type="file" name="PanCard" class="drop-zone__input" id="PanCard">
                                            </div>
                                            <div class="drop-zone" id="expletter-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Experience Letter </span>
                                                <input type="file" name="ExperienceLetter" class="drop-zone__input" id="ExperienceLetter" >
                                            </div>
                                            <div class="drop-zone" id="payslip-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Pay Slip</span>
                                                <input type="file" name="PaySlip" class="drop-zone__input" id="PaySlip">
                                            </div>
                                            <div class="drop-zone" id="bankstatement-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Bank Statement</span>
                                                <input type="file" name="BankStatement" class="drop-zone__input" id="BankStatement">
                                            </div>
                                            <div class="drop-zone" id="otherdocument-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Other Document</span>
                                                <input type="file" name="OtherDocument" class="drop-zone__input" id="OtherDocument">
                                            </div>
                                            <div class="drop-zone" id="employerconformation-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Employer Conformation</span>
                                                <input type="file" name="EmployerConformation" class="drop-zone__input" id="EmployerConformation">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <ul >
                                            
                                                <?php if(empty($documents[0]['SSLCMarksCard'])){?>
                                                    <li class="uploadcard"><a id="sslc" >SSLC Marks Card </a> </li>
                                                    <div id="myProgress">
                                                        <div id="sslcBar"></div>
                                                    </div>
                                                    <div id="sslctick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="SSLCMarksCardfilelimit" style="color: red; width:100%"> </span> 
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="sslc" >SSLC Marks Card </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="SSLCMarksCardfilelimit" style="color: red;"> </span>
                                                <?php }?>

                                                <?php if(empty($documents[0]['PUCMarksCard'])){?>
                                                    <li class="uploadcard"><a id="puc">PUC Marks Card</a></li>
                                                    <div id="myProgress">
                                                        <div id="pucBar"></div>
                                                    </div>
                                                    <div id="puctick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="PUCMarksCardfilelimit" style="color: red; "> </span>
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="puc" >PUC Marks Card </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="PUCMarksCardfilelimit" style="color: red;"> </span>
                                                <?php } ?>

                                                <?php if(empty($documents[0]['DegreeMarksCard'])){?>
                                                    <li class="uploadcard"><a id="degree">Degree Marks Card</a></li>
                                                    <div id="myProgress">
                                                        <div id="degreeBar"></div>
                                                    </div>
                                                    <div id="degreetick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="DegreeMarksCardfilelimit" style="color: red; "> </span>
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="degree" >Degree Marks Card </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="DegreeMarksCardfilelimit" style="color: red;"> </span>
                                                <?php } ?>

                                                <?php if(empty($documents[0]['AadharCard'])){?>
                                                    <li class="uploadcard"><a id="aadhar">Aadhar Card</a></li>
                                                    <div id="myProgress">
                                                        <div id="aadharBar"></div>
                                                    </div>
                                                    <div id="aadhartick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="AadharCardfilelimit" style="color: red; "> </span>
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="aadhar" >Aadhar Card </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="AadharCardfilelimit" style="color: red;"> </span>
                                                <?php } ?>

                                                <?php if(empty($documents[0]['PanCard'])){?>
                                                    <li class="uploadcard"><a id="pan">PAN Card</a></li>
                                                    <div id="myProgress">
                                                        <div id="panBar"></div>
                                                    </div>
                                                    <div id="pantick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="PanCardfilelimit" style="color: red; "> </span>
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="pan" >PAN Card </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="PanCardfilelimit" style="color: red;"> </span>
                                                <?php } ?>
                                                <?php if(empty($documents[0]['ExperienceLetter'])){?>
                                                    <li class="uploadcard"><a id="expletter">Experience Letter </a></li>
                                                    <div id="myProgress">
                                                        <div id="expletterBar"></div>
                                                    </div>
                                                    <div id="explettertick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="ExperienceLetterfilelimit" style="color: red; "> </span>
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="expletter" >Experience Letter </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="ExperienceLetterfilelimit" style="color: red;"> </span>
                                                <?php } ?>

                                                <?php if(empty($documents[0]['PaySlip'])){?>
                                                    <li class="uploadcard"><a id="payslip">Pay Slip</a></li>
                                                    <div id="myProgress">
                                                        <div id="payslipBar"></div>
                                                    </div>
                                                    <div id="paysliptick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="PaySlipfilelimit" style="color: red; "> </span>
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="payslip" >Pay Slip </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="PaySlipfilelimit" style="color: red;"> </span>
                                                <?php } ?>

                                                <?php if(empty($documents[0]['BankStatement'])){?>
                                                    <li class="uploadcard"><a id="bankstatement">Bank Statement</a></li>
                                                    <div id="myProgress">
                                                        <div id="bankstatementBar"></div>
                                                    </div>
                                                    <div id="bankstatementtick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="BankStatementfilelimit" style="color: red; "> </span>
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="bankstatement" >Bank Statement </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="BankStatementfilelimit" style="color: red;"> </span>
                                                <?php } ?>

                                                <?php if(empty($documents[0]['OtherDocument'])){?>
                                                    <li class="uploadcard"><a id="otherdocument">Other Documents</a></li>
                                                    <div id="myProgress">
                                                        <div id="otherdocumentBar"></div>
                                                    </div>
                                                    <div id="otherdocumenttick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="OtherDocumentfilelimit" style="color: red; "> </span>
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="otherdocument" >Other Documents </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="OtherDocumentfilelimit" style="color: red;"> </span>
                                                <?php } ?>

                                                <?php if(empty($documents[0]['EmployerConformation'])){?>
                                                    <li class="uploadcard"><a id="employerconformation">Employer Conformation</a></li>
                                                    <div id="myProgress">
                                                        <div id="employerconformationBar"></div>
                                                    </div>
                                                    <div id="employerconformationtick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="EmployerConformationfilelimit" style="color: red; "> </span>
                                                <?php } else{?>
                                                    <li class="uploadcard"><a id="sslc" >Employer Conformation </a> </li>
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                    <span id="EmployerConformationfilelimit" style="color: red;"> </span>
                                                <?php } ?>
                                                <textarea name="DVRemarks1" class="form-control" placeholder="Remarks" required><?php if(!empty($data['documents'])){ echo $documents[0]['DVRemarks'];} ?></textarea>

                                            
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <?php }?>
                                <div class="card-footer">
                                    <button class="btn btn-sm bg-orange float-right" name="DVStatus" value="2">Approve</button>
                                    <button class="btn btn-sm btn-danger" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">   Reject  </button>                                 
                                    <div class=" collapse mt-1" id="collapseExample">
                                            <textarea class="form-control " name="DVRemarks"> <?php if(!empty($data['documents'])){ echo $documents[0]['DVRemarks'];} ?> </textarea>
                                            <script>  CKEDITOR.replace('DVRemarks');  </script>
                                            <button type="submit" class="btn btn-sm bg-orange" value="1" name="DVStatus">    Submit</button>
                                    </div>
                                </div>
                                </form>
                    

                            <?php   }elseif($roundList[0]['InterviewStatus'] == 4){?>
                                <div class="card-body ">
                                    <div class="form-row">
                                    
                                        <div class="col-lg-12 mt-2 text-center  bg-orange rounded"> 
                                            <h5> Candidate Rejected </h5>
                                        </div>
                                    </div>
                                </div>
                            <?php   }elseif($roundList[0]['InterviewStatus'] == 3){?>
                                <div class="card-body ">
                                    <div class="form-row">                                        
                                        <div class="col-lg-12 mt-2 text-center  bg-orange rounded"> 
                                            <h5> Candidate on Hold </h5>
                                        </div>
                                    </div>
                                </div>
                            <?php   } ?>                                        
                        <?php  }?>
                    </div>
                </div>
                

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
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>

<script>
$(document).ready(function(){
	$("#disabled-input").show();
    $("#sslc-input").hide();
    $("#puc-input").hide();
    $("#degree-input").hide();
    $("#aadhar-input").hide();
    $("#pan-input").hide();
    $("#expletter-input").hide();
    $("#payslip-input").hide();
    $("#bankstatement-input").hide();
    $("#otherdocument-input").hide();
    $("#employerconformation-input").hide();


  $("#sslc").click(function(){
    $("#disabled-input").hide();
    $("#sslc-input").show();
    $("#puc-input").hide();
    $("#degree-input").hide();
    $("#aadhar-input").hide();
    $("#pan-input").hide();
    $("#expletter-input").hide();
    $("#payslip-input").hide();
    $("#bankstatement-input").hide();
    $("#otherdocument-input").hide();
    $("#employerconformation-input").hide();
  });
  $("#puc").click(function(){
    $("#disabled-input").hide();
    $("#sslc-input").hide();
    $("#puc-input").show();
    $("#degree-input").hide();
    $("#aadhar-input").hide();
    $("#pan-input").hide();
    $("#expletter-input").hide();
    $("#payslip-input").hide();
    $("#bankstatement-input").hide();
    $("#otherdocument-input").hide();
    $("#employerconformation-input").hide();
  });
  $("#degree").click(function(){
    $("#disabled-input").hide();
    $("#sslc-input").hide();
    $("#puc-input").hide();
    $("#degree-input").show();
    $("#aadhar-input").hide();
    $("#pan-input").hide();
    $("#expletter-input").hide();
    $("#payslip-input").hide();
    $("#bankstatement-input").hide();
    $("#otherdocument-input").hide();
    $("#employerconformation-input").hide();
  });
  $("#aadhar").click(function(){
    $("#disabled-input").hide();
    $("#sslc-input").hide();
    $("#puc-input").hide();
    $("#degree-input").hide();
    $("#aadhar-input").show();
    $("#pan-input").hide();
    $("#expletter-input").hide();
    $("#payslip-input").hide();
    $("#bankstatement-input").hide();
    $("#otherdocument-input").hide();
    $("#employerconformation-input").hide();
  });
  $("#pan").click(function(){
    $("#disabled-input").hide();
    $("#sslc-input").hide();
    $("#puc-input").hide();
    $("#degree-input").hide();
    $("#aadhar-input").hide();
    $("#pan-input").show();
    $("#expletter-input").hide();
    $("#payslip-input").hide();
    $("#bankstatement-input").hide();
    $("#otherdocument-input").hide();
    $("#employerconformation-input").hide();
  });
  $("#expletter").click(function(){
    $("#disabled-input").hide();
    $("#sslc-input").hide();
    $("#puc-input").hide();
    $("#degree-input").hide();
    $("#aadhar-input").hide();
    $("#pan-input").hide();
    $("#expletter-input").show();
    $("#payslip-input").hide();
    $("#bankstatement-input").hide();
    $("#otherdocument-input").hide();
    $("#employerconformation-input").hide();
  });
  $("#payslip").click(function(){
    $("#disabled-input").hide();
    $("#sslc-input").hide();
    $("#puc-input").hide();
    $("#degree-input").hide();
    $("#aadhar-input").hide();
    $("#pan-input").hide();
    $("#expletter-input").hide();
    $("#payslip-input").show();
    $("#bankstatement-input").hide();
    $("#otherdocument-input").hide();
    $("#employerconformation-input").hide();
  });
  $("#bankstatement").click(function(){
    $("#disabled-input").hide();
    $("#sslc-input").hide();
    $("#puc-input").hide();
    $("#degree-input").hide();
    $("#aadhar-input").hide();
    $("#pan-input").hide();
    $("#expletter-input").hide();
    $("#payslip-input").hide();
    $("#bankstatement-input").show();
    $("#otherdocument-input").hide();
    $("#employerconformation-input").hide();
  });
  $("#otherdocument").click(function(){
    $("#disabled-input").hide();
    $("#sslc-input").hide();
    $("#puc-input").hide();
    $("#degree-input").hide();
    $("#aadhar-input").hide();
    $("#pan-input").hide();
    $("#expletter-input").hide();
    $("#payslip-input").hide();
    $("#bankstatement-input").hide();
    $("#otherdocument-input").show();
    $("#employerconformation-input").hide();
  });
  $("#employerconformation").click(function(){
    $("#disabled-input").hide();
    $("#sslc-input").hide();
    $("#puc-input").hide();
    $("#degree-input").hide();
    $("#aadhar-input").hide();
    $("#pan-input").hide();
    $("#expletter-input").hide();
    $("#payslip-input").hide();
    $("#bankstatement-input").hide();
    $("#otherdocument-input").hide();
    $("#employerconformation-input").show();
  });
});
</script>


<style>
    #myProgress {
        width: 80%;
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
    #sslctick {
        width: 18%;
        margin-top: -26px;
        float: right;
        font-size: 30px;
        color: #979595;
    }
    #puctick {
        width: 18%;
        margin-top: -26px;
        float: right;
        font-size: 30px;
        color: #979595;
    }
    #degreetick {
        width: 18%;
        margin-top: -26px;
        float: right;
        font-size: 30px;
        color: #979595;
    }
    #aadhartick {
        width: 18%;
        margin-top: -26px;
        float: right;
        font-size: 30px;
        color: #979595;
    }
    #pantick {
        width: 18%;
        margin-top: -26px;
        float: right;
        font-size: 30px;
        color: #979595;
    }
    #explettertick {
        width: 18%;
        margin-top: -26px;
        float: right;
        font-size: 30px;
        color: #979595;
    }
    #paysliptick {
        width: 18%;
        margin-top: -26px;
        float: right;
        font-size: 30px;
        color: #979595;
    }
    #bankstatementtick {
        width: 18%;
        margin-top: -26px;
        float: right;
        font-size: 30px;
        color: #979595;
    }
    #otherdocumenttick {
        width: 18%;
        margin-top: -26px;
        float: right;
        font-size: 30px;
        color: #979595;
    }
    #employerconformationtick {
        width: 18%;
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
    #sslcBar {
        width: 1%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    }
    #pucBar {
        width: 1%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    }
    #degreeBar {
        width: 1%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    }
    #aadharBar {
        width: 1%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    }
    #panBar {
        width: 1%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    }
    
    #expletterBar {
        width: 1%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    }
    #payslipBar {
        width: 1%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    }
    
    #bankstatementBar {
        width: 1%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    }
    #otherdocumentBar {
        width: 1%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    }
    #employerconformationBar {
        width: 1%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    }

<?php if($candidate_details[0]['CandidateExperience']==2){ ?>
    .drop-zone {
    /* max-width: 200px; */
    height: 360px !important;
    padding: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-family: "Quicksand", sans-serif;
    font-weight: 500;
    font-size: 20px;
    cursor: pointer;
    color: #cccccc;
    border: 4px dashed #e4642e;
    border-radius: 10px;
    }
<?php } else{?>

    .drop-zone {
    /* max-width: 200px; */
    height: 235px;
    padding: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-family: "Quicksand", sans-serif;
    font-weight: 500;
    font-size: 20px;
    cursor: pointer;
    color: #cccccc;
    border: 4px dashed #e4642e;
    border-radius: 10px;
    }
<?php }?>
    .drop-zone--over {
    border-style: solid;
    }

    .drop-zone__input {
    display: none;
    }

    .drop-zone__thumb {
    width: 100%;
    height: 100%;
    border-radius: 10px;
    overflow: hidden;
    background-color: #cccccc;
    background-size: cover;
    position: relative;
    }

    .drop-zone__thumb::after {
    content: attr(data-label);
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 5px 0;
    color: #ffffff;
    background: rgba(0, 0, 0, 0.75);
    font-size: 14px;
    text-align: center;
    }

</style>

<script>
    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
    const dropZoneElement = inputElement.closest(".drop-zone");

    dropZoneElement.addEventListener("click", (e) => {
        inputElement.click();
    });

    inputElement.addEventListener("change", (e) => {
        if (inputElement.files.length) {
        updateThumbnail(dropZoneElement, inputElement.files[0]);
        }
    });

    dropZoneElement.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZoneElement.classList.add("drop-zone--over");
    });

    ["dragleave", "dragend"].forEach((type) => {
        dropZoneElement.addEventListener(type, (e) => {
        dropZoneElement.classList.remove("drop-zone--over");
        });
    });

    dropZoneElement.addEventListener("drop", (e) => {
        e.preventDefault();

        if (e.dataTransfer.files.length) {
        inputElement.files = e.dataTransfer.files;
        updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
        }

        dropZoneElement.classList.remove("drop-zone--over");
    });
    });

    /**
     * Updates the thumbnail on a drop zone element.
     *
     * @param {HTMLElement} dropZoneElement
     * @param {File} file
     */
    function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

    // First time - remove the prompt
    if (dropZoneElement.querySelector(".drop-zone__prompt")) {
        dropZoneElement.querySelector(".drop-zone__prompt").remove();
    }

    // First time - there is no thumbnail element, so lets create it
    if (!thumbnailElement) {
        thumbnailElement = document.createElement("div");
        thumbnailElement.classList.add("drop-zone__thumb");
        dropZoneElement.appendChild(thumbnailElement);
    }

    thumbnailElement.dataset.label = file.name;

    // Show thumbnail for image files
    if (file.type.startsWith("image/")) {
        const reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = () => {
        thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
        };
    } else {
        thumbnailElement.style.backgroundImage = null;
    }
    }

</script>



<script>
    var uploadField = document.getElementById("SSLCMarksCard");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("SSLCMarksCardfilelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("SSLCMarksCardfilelimit").innerHTML = "";
            }, 5000);
        };
        
    };

    var myfile="";

    $('#SSLCMarksCard').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
        //    alert(ext);
        var i = 0;
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("sslcBar");
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
                    document.getElementById("sslctick").style.color = "#369317";
                }
                
            }
        }
            
        }
        
    } else{
            ftype = "File Size is more than 2MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("SSLCMarksCardfilelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("SSLCMarksCardfilelimit").innerHTML = "";

            }, 5000);
    }
    });
</script>

<script>
    var uploadField = document.getElementById("PUCMarksCard");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("PUCMarksCardfilelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("PUCMarksCardfilelimit").innerHTML = "";
            }, 5000);
        };
        
    };

    var myfile="";



    $('#PUCMarksCard').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
        //    alert(ext);
        var i = 0;
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("pucBar");
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
                    document.getElementById("puctick").style.color = "#369317";
                }
            }
            }
        }
    } else{
            ftype = "File Size is more than 2MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("PUCMarksCardfilelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("PUCMarksCardfilelimit").innerHTML = "";
            }, 5000);
    }
    });
</script>

<script>
    var uploadField = document.getElementById("DegreeMarksCard");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("DegreeMarksCardfilelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("DegreeMarksCardfilelimit").innerHTML = "";
            }, 5000);
        };
        
    };

    var myfile="";



    $('#DegreeMarksCard').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
        //    alert(ext);
        var i = 0;
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("degreeBar");
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
                    document.getElementById("degreetick").style.color = "#369317";
                }
            }
            }
        }
    } else{
            ftype = "File Size is more than 2MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("DegreeMarksCardfilelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("DegreeMarksCardfilelimit").innerHTML = "";
            }, 5000);
    }
    });
</script>

<script>
    var uploadField = document.getElementById("AadharCard");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("AadharCardfilelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("AadharCardfilelimit").innerHTML = "";
            }, 5000);
        };
        
    };

    var myfile="";



    $('#AadharCard').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
        //    alert(ext);
        var i = 0;
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("aadharBar");
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
                    document.getElementById("aadhartick").style.color = "#369317";
                }
            }
            }
        }
    } else{
            ftype = "File Size is more than 2MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("AadharCardfilelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("AadharCardfilelimit").innerHTML = "";
            }, 5000);
    }
    });
</script>

<script>
    var uploadField = document.getElementById("PanCard");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("PanCardfilelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("PanCardfilelimit").innerHTML = "";
            }, 5000);
        };
        
    };

    var myfile="";



    $('#PanCard').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
        //    alert(ext);
        var i = 0;
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("panBar");
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
                    document.getElementById("pantick").style.color = "#369317";
                }
            }
            }
        }
    } else{
            ftype = "File Size is more than 2MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("PanCardfilelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("PanCardfilelimit").innerHTML = "";
            }, 5000);
    }
    });
</script>

<script>
    var uploadField = document.getElementById("ExperienceLetter");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("ExperienceLetterfilelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("ExperienceLetterfilelimit").innerHTML = "";
            }, 5000);
        };
        
    };

    var myfile="";



    $('#ExperienceLetter').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
        //    alert(ext);
        var i = 0;
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("expletterBar");
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
                    document.getElementById("explettertick").style.color = "#369317";
                }
            }
            }
        }
    } else{
            ftype = "File Size is more than 2MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("ExperienceLetterfilelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("ExperienceLetterfilelimit").innerHTML = "";
            }, 5000);
    }
    });
</script>

<script>
    var uploadField = document.getElementById("PaySlip");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("PaySlipfilelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("PaySlipfilelimit").innerHTML = "";
            }, 5000);
        };
        
    };

    var myfile="";



    $('#PaySlip').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
        //    alert(ext);
        var i = 0;
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("payslipBar");
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
                    document.getElementById("paysliptick").style.color = "#369317";
                }
            }
            }
        }
    } else{
            ftype = "File Size is more than 2MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("PaySlipfilelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("PaySlipfilelimit").innerHTML = "";
            }, 5000);
    }
    });
</script>

<script>
    var uploadField = document.getElementById("BankStatement");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("BankStatementfilelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("BankStatementfilelimit").innerHTML = "";
            }, 5000);
        };
        
    };

    var myfile="";



    $('#BankStatement').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
        //    alert(ext);
        var i = 0;
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("bankstatementBar");
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
                    document.getElementById("bankstatementtick").style.color = "#369317";
                }
            }
            }
        }
    } else{
            ftype = "File Size is more than 2MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("BankStatementfilelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("BankStatementfilelimit").innerHTML = "";
            }, 5000);
    }
    });
</script>

<script>
    var uploadField = document.getElementById("OtherDocument");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("OtherDocumentfilelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("OtherDocumentfilelimit").innerHTML = "";
            }, 5000);
        };
        
    };

    var myfile="";



    $('#OtherDocument').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
        //    alert(ext);
        var i = 0;
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("otherdocumentBar");
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
                    document.getElementById("otherdocumenttick").style.color = "#369317";
                }
            }
            }
        }
    } else{
            ftype = "File Size is more than 2MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("OtherDocumentfilelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("OtherDocumentfilelimit").innerHTML = "";
            }, 5000);
    }
    });
</script>

<script>
    var uploadField = document.getElementById("EmployerConformation");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("EmployerConformationfilelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("EmployerConformationfilelimit").innerHTML = "";
            }, 5000);
        };
        
    };

    var myfile="";



    $('#EmployerConformation').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
        //    alert(ext);
        var i = 0;
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("employerconformationBar");
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
                    document.getElementById("employerconformationtick").style.color = "#369317";
                }
            }
            }
        }
    } else{
            ftype = "File Size is more than 2MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("EmployerConformationfilelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("EmployerConformationfilelimit").innerHTML = "";
            }, 5000);
    }
    });
</script>





<?= $this->endSection() ?>