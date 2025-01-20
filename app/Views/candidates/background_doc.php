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
            <h1>Candidate Documents</h1>
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
                                
                            </ul>
                            <div class="cv text-center" style="padding-top: 8px; ">
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$candidate_details[0]['CandidateResume']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b> View Resume</b></a> 
                                <a class="btn btn-sm bg-orange mt-1" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><b> Additional Documents</b></a> 
                                
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
                            <h3 class="profile-username">Documents</h3>
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
                            <?php if( strstr($documents[0]['OfferLetterImage'],".pdf") == ".pdf"){   ?>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['OfferLetterImage']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b>  Offer Letter</b></a> 
                            <?php }?>
                            <?php if( strstr($documents[0]['INT_CON_Letter'],".pdf") == ".pdf"){   ?>
                                <a href="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['INT_CON_Letter']); ?>" target="_black" class="btn btn-sm bg-orange mt-1"><b>  Intern/Contract Letter</b></a> 
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
                                <!-- <button class="gf-btn gf-btn-active" onclick="filterSelection('bollywood')">Bollywood</button>
                                <button class="gf-btn" onclick="filterSelection('hollywood')">Hollywood</button>
                                <button class="gf-btn" onclick="filterSelection('tv')">TV Shows</button> -->
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
                            <?php if( strstr($documents[0]['OtherDocument'],".pdf") != ".pdf"){   ?> 
                                <div class="gf-column bollywood">
                                    <img src="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['OtherDocument']); ?>" />Other Documents
                                </div>
                            <?php }?>
                            <?php if( strstr($documents[0]['OfferLetterImage'],".pdf") != ".pdf"){   ?> 
                                <div class="gf-column bollywood">
                                    <img src="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['OfferLetterImage']); ?>" />Offer letter
                                </div>
                            <?php }?>
                            <?php if( strstr($documents[0]['INT_CON_Letter'],".pdf") != ".pdf"){   ?> 
                                <div class="gf-column bollywood">
                                    <img src="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['INT_CON_Letter']); ?>" />Intership/Contract Letter
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
                
                <div class="col-lg-12">
                    <div class="collapse" id="collapseExample">
                        <div class="card card-orange card-outline">
                            <div class="card-body">
                                <div class="form-row ">
                                <?php if($candidate_details[0]['CandidateExperience']==1){ ?>
                                    <div class="col-lg-6">
                                            <form  action="<?= site_url('/fresher_update_documents') ?>" method="post" enctype="multipart/form-data"> 
                                            <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                            <input type="hidden" name="CandidateName" value="<?= $candidate_details[0]['CandidateName'] ?>">
                                            <div class="drop-zone" id="disabled-input">
                                                <span class="drop-zone__prompt">Disabled Click on <i class="fa-solid fa-hand-point-right"></i> </span>
                                                <input type="file" name="" class="drop-zone__input" disabled >
                                            </div>
                                            <div class="drop-zone" id="sslc-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload SSLC Marks Card</span>
                                                <input type="file" name="SSLCMarksCard" class="drop-zone__input" id="SSLCMarksCard" value="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['SSLCMarksCard']); ?>">
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
                                            <div class="drop-zone" id="otherdocument-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Other Document</span>
                                                <input type="file" name="OtherDocument" class="drop-zone__input" id="OtherDocument">
                                            </div>
                                            <div class="drop-zone" id="offerletter-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Offer Letter</span>
                                                <input type="file" name="OfferLetter" class="drop-zone__input" id="OfferLetter">
                                            </div>
                                            <div class="drop-zone" id="interncontract-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Intern/Contract Letter</span>
                                                <input type="file" name="InternContract" class="drop-zone__input" id="InternContract">
                                            </div>
                                            <!-- <div class="drop-zone" id="expletter-input">
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
                                            <div class="drop-zone" id="employerconformation-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Employer Conformation</span>
                                                <input type="file" name="EmployerConformation" class="drop-zone__input" id="EmployerConformation">
                                            </div> -->
                                        </div>
                                        <div class="col-lg-6 text-left">
                                            
                                            <ul >
                                            
                                                <li class="uploadcard"><a id="sslc" >SSLC Marks Card </a> </li>
                                                <div id="myProgress">
                                                    <div id="sslcBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['SSLCMarksCard'])){?>
                                                    <div id="sslctick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>                                                 
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php }?>
                                                <span id="SSLCMarksCardfilelimit" style="color: red; white-space: nowrap;"> </span>


                                                <li class="uploadcard"><a id="puc">PUC Marks Card</a></li>
                                                <div id="myProgress">
                                                    <div id="pucBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['PUCMarksCard'])){?>
                                                    <div id="puctick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="PUCMarksCardfilelimit" style="color: red; white-space: nowrap;"> </span>



                                                <li class="uploadcard"><a id="degree">Degree Marks Card</a></li>
                                                <div id="myProgress">
                                                    <div id="degreeBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['DegreeMarksCard'])){?>
                                                    <div id="degreetick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="DegreeMarksCardfilelimit" style="color: red; white-space: nowrap;"> </span>



                                                <li class="uploadcard"><a id="aadhar">Aadhar Card</a></li>
                                                <div id="myProgress">
                                                    <div id="aadharBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['AadharCard'])){?>
                                                    <div id="aadhartick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="AadharCardfilelimit" style="color: red; white-space: nowrap;"> </span>



                                                <li class="uploadcard"><a id="pan">PAN Card</a></li>
                                                <div id="myProgress">
                                                    <div id="panBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['PanCard'])){?>
                                                    <div id="pantick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>  
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="PanCardfilelimit" style="color: red; white-space: nowrap; "> </span>



                                                <li class="uploadcard"><a id="otherdocument">Other Documents</a></li>
                                                <div id="myProgress">
                                                    <div id="otherdocumentBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['OtherDocument'])){?>
                                                    <div id="otherdocumenttick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="OtherDocumentfilelimit" style="color: red; white-space: nowrap;"> </span>


                                                <li class="uploadcard"><a id="offerletter">Offer Letter</a></li>
                                                <div id="myProgress">
                                                    <div id="offerletterBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['OfferLetterImage'])){?>
                                                    <div id="offerlettertick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="OfferLetterfilelimit" style="color: red; white-space: nowrap;"> </span>


                                                <li class="uploadcard"><a id="interncontract">Intern/Contract Letter</a></li>
                                                <div id="myProgress">
                                                    <div id="interncontractBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['INT_CON_Letter'])){?>
                                                    <div id="interncontracttick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="InternContractfilelimit" style="color: red; white-space: nowrap;"> </span>


                                            
                                                <!-- <li class="uploadcard"><a id="expletter">Experience Letter </a></li>
                                                <div id="myProgress">
                                                    <div id="expletterBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['ExperienceLetter'])){?>
                                                    <div id="explettertick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>                                                
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="ExperienceLetterfilelimit" style="color: red; white-space: nowrap;"> </span>


                                                <li class="uploadcard"><a id="payslip">Pay Slip</a></li>
                                                <div id="myProgress">
                                                    <div id="payslipBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['PaySlip'])){?>
                                                    <div id="paysliptick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="PaySlipfilelimit" style="color: red; white-space: nowrap;"> </span>



                                                <li class="uploadcard"><a id="bankstatement">Bank Statement</a></li>
                                                <div id="myProgress">
                                                    <div id="bankstatementBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['BankStatement'])){?>
                                                    <div id="bankstatementtick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?> 
                                                <span id="BankStatementfilelimit" style="color: red; white-space: nowrap;"> </span>



                                                <li class="uploadcard"><a id="employerconformation">Employer Conformation</a></li>
                                                <div id="myProgress">
                                                    <div id="employerconformationBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['EmployerConfirmation'])){?>
                                                    <div id="employerconformationtick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="EmployerConformationfilelimit" style="color: red; white-space: nowrap;"> </span> -->
                                                    
                                                
                                                <textarea name="DVRemarks1" class="form-control" placeholder="Remarks" required><?= $documents[0]['DVRemarks']?> </textarea>
                                                <button type="submit" class= "btn btn-sm btn-primary mt-1" name="DVStatus" value="2" >Update Documents</button>
                                            </ul>
                                        </div>
                                    </form>
                                <?php }elseif($candidate_details[0]['CandidateExperience']==2){ ?>
                                    <div class="col-lg-6">
                                            <form  action="<?= site_url('/experienced_update_documents') ?>" method="post" enctype="multipart/form-data"> 
                                            <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                            <div class="drop-zone" id="disabled-input">
                                                <span class="drop-zone__prompt">Disabled Click on <i class="fa-solid fa-hand-point-right"></i> </span>
                                                <input type="file" name="" class="drop-zone__input" disabled >
                                            </div>
                                            <div class="drop-zone" id="sslc-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload SSLC Marks Card</span>
                                                <input type="file" name="SSLCMarksCard" class="drop-zone__input" id="SSLCMarksCard" value="<?php echo site_url('public/Uploads/candidates/'.$candidate_details[0]['CandidateId'].'-'.$candidate_details[0]['CandidateName'].'/'.$documents[0]['SSLCMarksCard']); ?>">
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
                                            <div class="drop-zone" id="otherdocument-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Other Document</span>
                                                <input type="file" name="OtherDocument" class="drop-zone__input" id="OtherDocument">
                                            </div>
                                            <div class="drop-zone" id="offerletter-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Offer Letter</span>
                                                <input type="file" name="OfferLetter" class="drop-zone__input" id="OfferLetter">
                                            </div>
                                            <div class="drop-zone" id="interncontract-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Intern/Contract Letter</span>
                                                <input type="file" name="InternContract" class="drop-zone__input" id="InternContract">
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
                                            <div class="drop-zone" id="employerconformation-input">
                                                <span class="drop-zone__prompt">Drop file here or click to upload Employer Conformation</span>
                                                <input type="file" name="EmployerConformation" class="drop-zone__input" id="EmployerConformation">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 text-left">
                                            
                                            <ul >
                                            
                                                <li class="uploadcard"><a id="sslc" >SSLC Marks Card </a> </li>
                                                <div id="myProgress">
                                                    <div id="sslcBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['SSLCMarksCard'])){?>
                                                    <div id="sslctick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>                                                 
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php }?>
                                                <span id="SSLCMarksCardfilelimit" style="color: red; white-space: nowrap;"> </span>


                                                <li class="uploadcard"><a id="puc">PUC Marks Card</a></li>
                                                <div id="myProgress">
                                                    <div id="pucBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['PUCMarksCard'])){?>
                                                    <div id="puctick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="PUCMarksCardfilelimit" style="color: red; white-space: nowrap;"> </span>



                                                <li class="uploadcard"><a id="degree">Degree Marks Card</a></li>
                                                <div id="myProgress">
                                                    <div id="degreeBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['DegreeMarksCard'])){?>
                                                    <div id="degreetick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="DegreeMarksCardfilelimit" style="color: red; white-space: nowrap;"> </span>



                                                <li class="uploadcard"><a id="aadhar">Aadhar Card</a></li>
                                                <div id="myProgress">
                                                    <div id="aadharBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['AadharCard'])){?>
                                                    <div id="aadhartick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="AadharCardfilelimit" style="color: red; white-space: nowrap;"> </span>



                                                <li class="uploadcard"><a id="pan">PAN Card</a></li>
                                                <div id="myProgress">
                                                    <div id="panBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['PanCard'])){?>
                                                    <div id="pantick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>  
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="PanCardfilelimit" style="color: red; white-space: nowrap; "> </span>



                                                <li class="uploadcard"><a id="otherdocument">Other Documents</a></li>
                                                <div id="myProgress">
                                                    <div id="otherdocumentBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['OtherDocument'])){?>
                                                    <div id="otherdocumenttick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="OtherDocumentfilelimit" style="color: red; white-space: nowrap;"> </span>


                                                <li class="uploadcard"><a id="offerletter">Offer Letter</a></li>
                                                <div id="myProgress">
                                                    <div id="offerletterBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['OfferLetterImage'])){?>
                                                    <div id="offerlettertick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="OfferLetterfilelimit" style="color: red; white-space: nowrap;"> </span>


                                                <li class="uploadcard"><a id="interncontract">Intern/Contract Letter</a></li>
                                                <div id="myProgress">
                                                    <div id="interncontractBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['INT_CON_Letter'])){?>
                                                    <div id="interncontracttick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="InternContractfilelimit" style="color: red; white-space: nowrap;"> </span>


                                            
                                                <li class="uploadcard"><a id="expletter">Experience Letter </a></li>
                                                <div id="myProgress">
                                                    <div id="expletterBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['ExperienceLetter'])){?>
                                                    <div id="explettertick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>                                                
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="ExperienceLetterfilelimit" style="color: red; white-space: nowrap;"> </span>


                                                <li class="uploadcard"><a id="payslip">Pay Slip</a></li>
                                                <div id="myProgress">
                                                    <div id="payslipBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['PaySlip'])){?>
                                                    <div id="paysliptick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="PaySlipfilelimit" style="color: red; white-space: nowrap;"> </span>



                                                <li class="uploadcard"><a id="bankstatement">Bank Statement</a></li>
                                                <div id="myProgress">
                                                    <div id="bankstatementBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['BankStatement'])){?>
                                                    <div id="bankstatementtick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?> 
                                                <span id="BankStatementfilelimit" style="color: red; white-space: nowrap;"> </span>



                                                <li class="uploadcard"><a id="employerconformation">Employer Conformation</a></li>
                                                <div id="myProgress">
                                                    <div id="employerconformationBar"></div>
                                                </div>
                                                <?php if(empty($documents[0]['EmployerConfirmation'])){?>
                                                    <div id="employerconformationtick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } else{?>
                                                    <div id="mytick">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                <?php } ?>
                                                <span id="EmployerConformationfilelimit" style="color: red; white-space: nowrap;"> </span>
                                                    
                                                
                                                <textarea name="DVRemarks1" class="form-control" placeholder="Remarks" required><?= $documents[0]['DVRemarks']?> </textarea>
                                                <button type="submit" class= "btn btn-sm btn-primary mt-1" name="DVStatus" value="2" >Update Documents</button>
                                            </ul>
                                        </div>
                                    </form>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>




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
    $("#offerletter-input").hide();
    $("#interncontract-input").hide();
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
    $("#offerletter-input").hide();
    $("#interncontract-input").hide();
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
    $("#offerletter-input").hide();
    $("#interncontract-input").hide();
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
    $("#offerletter-input").hide();
    $("#interncontract-input").hide();
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
    $("#offerletter-input").hide();
    $("#interncontract-input").hide();
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
    $("#offerletter-input").hide();
    $("#interncontract-input").hide();
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
    $("#offerletter-input").hide();
    $("#interncontract-input").hide();
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
    $("#offerletter-input").hide();
    $("#interncontract-input").hide();
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
    $("#offerletter-input").hide();
    $("#interncontract-input").hide();
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
    $("#offerletter-input").hide();
    $("#interncontract-input").hide();
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
    $("#offerletter-input").hide();
    $("#interncontract-input").hide();
    $("#employerconformation-input").show();
  });
  $("#offerletter").click(function(){
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
    $("#offerletter-input").show();
    $("#interncontract-input").hide();
    $("#employerconformation-input").hide();
  });
  $("#interncontract").click(function(){
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
    $("#offerletter-input").hide();
    $("#interncontract-input").show();
    $("#employerconformation-input").hide();
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
    #offerlettertick {
        width: 18%;
        margin-top: -26px;
        float: right;
        font-size: 30px;
        color: #979595;
    }
    #interncontracttick {
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
    #offerletterBar {
        width: 1%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    }
    #interncontractBar {
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
    var uploadField = document.getElementById("OfferLetter");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("OfferLetterfilelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("OfferLetterfilelimit").innerHTML = "";
            }, 5000);
        };
        
    };

    var myfile="";



    $('#OfferLetter').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
        //    alert(ext);
        var i = 0;
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("offerletterBar");
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
                    document.getElementById("offerlettertick").style.color = "#369317";
                }
            }
            }
        }
    } else{
            ftype = "File Size is more than 2MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("OfferLetterfilelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("OfferLetterfilelimit").innerHTML = "";
            }, 5000);
    }
    });
</script>

<script>
    var uploadField = document.getElementById("InternContract");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("InternContractfilelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("InternContractfilelimit").innerHTML = "";
            }, 5000);
        };
        
    };

    var myfile="";



    $('#InternContract').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
        //    alert(ext);
        var i = 0;
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("interncontractBar");
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
                    document.getElementById("interncontracttick").style.color = "#369317";
                }
            }
            }
        }
    } else{
            ftype = "File Size is more than 2MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("InternContractfilelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("InternContractfilelimit").innerHTML = "";
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