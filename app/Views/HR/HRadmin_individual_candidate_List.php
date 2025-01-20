<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?>
<input type="hidden" name="trickid" id="trickid" value="<?= $trickid ?>">
<input type="hidden" name="HR_IDFK" id="HR_IDFK" value="<?= $HR_IDFK ?>">
<!-- &HR_IDFK=59 -->
<?php
      if(isset($_SESSION['msg'])){
         echo $_SESSION['msg'];
         }
      ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
    
<!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">         
          <!-- /.col -->
          

          <div class="col-lg-12 mt-2">
            <div class="card">
            
            
                <div class="card-header">                    
                    <div class="row" >
                        <div class="col-lg-6 ">
                            <div class="d-flex justify-content " >
                                <div class="form-group mt-1">   
                                    <div class="input-group">     
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm float-right" id="reportrange">  
                                        <?php if(empty($fdate))
                                        {
                                            //year-month-date formate
                                            $fdate=date("Y-m-d");
                                        }
                                        ?>
                                        
                                            <input type="hidden" name="fdate" id="fdate" value="<?=$fdate?>"/>
                                            <?php if(empty($todate))
                                            {
                                                $todate=date("Y-m-d");
                                                // print_r($todate);
                                            }
                                            ?> 
                                        <input type="hidden" name="todate" id="todate" value="<?=$todate?>"/>
                                        <a class="btn btn-sm bg-orange" onclick="datefilter()">Check</a>
                                    </div>
                                </div>
                                <div class="form-group ml-1 mt-1 ">
                                    <a href="<?php echo site_url('/add_candidate_view') ?>" class=" btn  btn-sm bg-orange " title="Add New Candidate" >
                                    <i class="fa-solid fa-plus"></i> 
                                    </a>
                                </div>
                                <div class="form-group ml-1 mt-1">
                                    <select class="form-control-sm bg-orange border-0" name="HRnames" id="HRnames">
                                        <option class="bg-light" value="default"> Please Select </option>
                                        <?php  foreach($showHR as $row){ ?>
                                        <option class="bg-light" value="<?php echo  $row["EmployeeId"] ?>"  
                                        <?php if($HR_IDFK==$row["EmployeeId"]){ echo "selected"; } ?>>
                                        <?php echo $row["EmployeeName"]; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                
                                
                            </div>
                        </div>
                        <?php
                            if($session->getFlashdata('CanidateSuccessMsg'))
                            {?>
                            <div class="col-lg-6">
                            <div class="alert alert-success bg-orange alert-dismissible fade show" role="alert">
                                    <strong><?= $session->getFlashdata('CanidateSuccessMsg') ?></strong> 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        <?php }  ?>
                        

                        <div class="col-lg-12 ">
                            <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=12&HR_IDFK='.$HR_IDFK) ?>" class="btn btn-sm bg-orange activetrick12 mt-1">Fresh List  <span class="badge badge-light"><?= $candiadtecounts[11][0]['FreshListCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=2&HR_IDFK='.$HR_IDFK) ?>" class="btn btn-sm bg-orange activetrick2 mt-1">Not Scheduled List  <span class="badge badge-light"><?= $candiadtecounts[1][0]['NotScheduledCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=1&HR_IDFK='.$HR_IDFK) ?>" class="btn btn-sm bg-orange activetrick1 mt-1">Scheduled List  <span class="badge badge-light"><?= $candiadtecounts[0][0]['ScheduledCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=4&HR_IDFK='.$HR_IDFK) ?>" class="btn btn-sm bg-orange mt-1">Selected List <span class="badge badge-light"><?= $candiadtecounts[3][0]['SelectedCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=6&HR_IDFK='.$HR_IDFK) ?>" class="btn btn-sm bg-orange mt-1">Hold List <span class="badge badge-light"><?= $candiadtecounts[4][0]['HoldCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=5&HR_IDFK='.$HR_IDFK) ?>" class="btn btn-sm bg-orange mt-1">Rejected List <span class="badge badge-light"><?= $candiadtecounts[5][0]['RejectCount'] ?></span></a>
                            <!-- <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=7&HR_IDFK='.$HR_IDFK) ?>" class="btn btn-sm bg-orange mt-1">Offered List <span class="badge badge-light"><?= $candiadtecounts[6][0]['OfferLetterCount'] ?></span></a> -->
                            <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=8&HR_IDFK='.$HR_IDFK) ?>" class="btn btn-sm bg-orange mt-1">Joined List <span class="badge badge-light"><?= $candiadtecounts[7][0]['JoinedCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=3&HR_IDFK='.$HR_IDFK) ?>" class="btn btn-sm bg-orange mt-1">Junk List  <span class="badge badge-light"><?= $candiadtecounts[2][0]['JunkCount']?></span></a>
                        </div>

                        <?php if($trickid==1 || $trickid==9 || $trickid==10 || $trickid==11 || $trickid==15){?> 
                        <div class="col-lg-12 mt-2 pl-4 "> 
                            <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=11&HR_IDFK='.$HR_IDFK) ?>" class=" btn btn-sm bg-orange activetrick11 mt-1">Todays List <span class="badge badge-light"><?= $candiadtecounts[10] ; ?> </span></a>
                            <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=10&HR_IDFK='.$HR_IDFK) ?>" class=" btn btn-sm bg-orange activetrick10 mt-1">Missed List <span class="badge badge-light"><?= $candiadtecounts[9] ?></span></a>
                            <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=9&HR_IDFK='.$HR_IDFK) ?>" class="  btn btn-sm bg-orange activetrick9 mt-1">Upcoming List <span class="badge badge-light"><?= $candiadtecounts[8][0]['upcomingCount'] ?> </span></a>
                            <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=15&HR_IDFK='.$HR_IDFK) ?>" class="  btn btn-sm bg-orange activetrick15 mt-1">Interview Processing List  <span class="badge badge-light"><?= $candiadtecounts[14][0]['InterviewStatusCount'] ?> </span></a>
                            
                        </div>
                        <?php }?>
                        <?php if($trickid==2 || ($trickid == 16) || ($trickid == 17) || ($trickid == 18) ){?> 
                            <div class="col-lg-12 mt-2 pl-4 ">
                                <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=16&HR_IDFK='.$HR_IDFK) ?>" class=" btn btn-sm bg-orange activetrick16 mt-1">Todays List <span class="badge badge-light"><?= $candiadtecounts[15][0]['TodaysNotScheduledCount'] ?></span></a>
                                <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=17&HR_IDFK='.$HR_IDFK) ?>" class=" btn btn-sm bg-orange activetrick17 mt-1">Missed List <span class="badge badge-light"><?= $candiadtecounts[16][0]['MissedNotScheduledCount'] ?></span></a>
                                <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=18&HR_IDFK='.$HR_IDFK) ?>" class=" btn btn-sm bg-orange activetrick18 mt-1">Upcoming List <span class="badge badge-light"><?= $candiadtecounts[17][0]['UpcomingNotScheduledCount'] ?></span></a>
                            </div>
                        <?php }?>
                        <?php if($trickid==12 || $trickid==13 || $trickid==14 ){?> 
                            <div class="col-lg-12 mt-2 pl-4 ">

                            <?php if($fdate == date('Y-m-d') && $todate== date('Y-m-d')){?>                            
                                <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=13&HR_IDFK='.$HR_IDFK) ?>" class=" btn btn-sm bg-orange activetrick13 mt-1">Todays List <span class="badge badge-light"><?= $candiadtecounts[12] ?></span></a>
                            <?php } ?>

                                <a href="<?php  echo site_url('/HRadmin_individual_candidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=14&HR_IDFK='.$HR_IDFK) ?>" class=" btn btn-sm bg-orange activetrick14 mt-1">Pending List <span class="badge badge-light"><?= $candiadtecounts[13] ?></span></a>
                                
                               
                            </div>
                        <?php }?>
                    </div>
                </div>
                <div class="card-body table-responsive ">     
              
                <?php if(($trickid == 1)  || ($trickid==9) || ($trickid==10) || ($trickid==11) ){?>
                  <table class="table table-hover " id="example">   
                    <thead>                            
                        
                        <tr>
                            <th>Sl no</th>
                            <th>Name</th>
                            <th>Interview Date</th>      
                            <th>Uploaded Date</th>      
                        </tr>
                    </thead>                   
                    <tbody>
                        <?php $i=1; if($candidate_list): ?>
                        <?php foreach($candidate_list as $row): ?>                        
                            <tr>
                                <td><?= $i++ ?></td>
                                <td>                                    
                                    <?php if($row['ScheduleStatus'] == 10){ ?>
                                        <a href="<?php echo site_url('interview_process?canId='.$row['CandidateId']) ?>"><?= $row['CandidateName']; ?></a>
                                    <?php } else { ?>
                                        <a href="<?php echo site_url('edit_candidate_view?canId='.$row['CandidateId']) ?>"><?= $row['CandidateName']; ?></a>
                                    <?php } ?>
                                    <br>
                                    <span class="position"><?= $row['CandidatePosition']; ?></span><br>
                                    <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                    <span class="source"><?= $row['Source']; ?></span>
                                </td>
                               
                                
                                <td><?= $row['InterviewDate']; ?></td>
                              
                                <td><?= $row['Created_at']; ?></td>
                                <!-- <td>
                                    <?php if(empty($row['Resume'])){?>
                                        <a href="<?php echo site_url('edit_Candi_profile?canId='.$row['CandidateId']) ?>" style='color:red !important'>Pending</a>
                                    <?php } else{?>
                                        <a href="<?php echo site_url('public/Uploads/candidates/'.$row['CandidateId'].'/'.$row['Resume']); ?>" target="_black" >Uploaded</a>
                                    <?php }?>
                                </td> -->
                            </tr>    
                        <?php endforeach; ?> 
                        <?php endif; ?>    
                    </tbody>
                  </table>
                <?php }else if($trickid==15){?>
                  <table class="table table-hover " id="example">   
                    <thead>                            
                        
                        <tr>
                            <th>Sl no</th>
                            <th>Name</th>
                            <th>Interview Date</th>      
                            <th>Interview Status</th>       
                            <th>Uploaded Date</th>      
                        </tr>
                    </thead>                   
                    <tbody>
                        <?php $i=1; if($candidate_list): ?>
                        <?php foreach($candidate_list as $row): ?>                        
                            <tr>
                                <td><?= $i++ ?></td>
                                <td>                                    
                                    <?php if($row['ScheduleStatus'] == 10){ ?>
                                        <a href="<?php echo site_url('interview_process?canId='.$row['CandidateId']) ?>"><?= $row['CandidateName']; ?></a>
                                    <?php } else { ?>
                                        <a href="<?php echo site_url('edit_candidate_view?canId='.$row['CandidateId']) ?>"><?= $row['CandidateName']; ?></a>
                                    <?php } ?>
                                    <br>
                                    <span class="position"><?= $row['CandidatePosition']; ?></span><br>
                                    <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                    <span class="source"><?= $row['Source']; ?></span>
                                </td>
                               
                                
                                <td><?= $row['InterviewDate']; ?></td>
                                <td><?php 
                                        if(($row['ScheduleStatus']==10) && ($row['RoundID'] == 1)){ 
                                            echo 'Round 1 Completed';
                                        } elseif(($row['ScheduleStatus'] == 10) && ($row['RoundID'] == 2)){
                                            echo 'Round 2 Completed';
                                        } elseif(($row['ScheduleStatus'] == 10) && ($row['RoundID'] == 3)){
                                            echo 'Round 3 Completed';
                                        } elseif(($row['ScheduleStatus'] == 10) && ($row['RoundID'] == 4)){
                                            echo 'Round 4 Completed';
                                        } elseif(($row['ScheduleStatus'] == 10) && ($row['RoundID'] == 5)){
                                            echo 'Round 5 Completed';
                                        } elseif(($row['ScheduleStatus'] == 10) && ($row['RoundID'] == 6)){
                                            echo 'Round 6 Completed';
                                        }elseif($row['ScheduleStatus']==1){
                                            echo "Scheduled";
                                        }elseif($row['ScheduleStatus']==10){ 
                                            echo "Yet to Start";
                                        };
                                    ?>
                                </td>
                                <td><?= $row['Created_at']; ?></td>
                                <!-- <td>
                                    <?php if(empty($row['Resume'])){?>
                                        <a href="<?php echo site_url('edit_Candi_profile?canId='.$row['CandidateId']) ?>" style='color:red !important'>Pending</a>
                                    <?php } else{?>
                                        <a href="<?php echo site_url('public/Uploads/candidates/'.$row['CandidateId'].'/'.$row['Resume']); ?>" target="_black" >Uploaded</a>
                                    <?php }?>
                                </td> -->
                            </tr>    
                        <?php endforeach; ?> 
                        <?php endif; ?>    
                    </tbody>
                  </table>
                <?php } else if(($trickid ==12)||($trickid==13)||($trickid==14)){?>
                  <table class="table table-hover " id="example">   
                    <thead>                            
                        
                        <tr>
                            <th>Sl no</th>
                            <th>Name</th>
                            <!-- <th>Position </th>  -->
                            <th>Uploaded Date</th> 
                            <th>Uploaded By</th> 
                            <th>Assign To</th> 
                        </tr>
                    </thead>                   
                    <tbody>
                        <?php $i=1; if($freshCandidate_list): ?>
                        <?php foreach($freshCandidate_list as $row): ?>                        
                            <tr>
                                <td><?= $i++ ?></td>
                                <td>
                                     <a href="<?php echo site_url('scheducleCandidate?canId='.$row['CandidateId']) ?>"><?= $row['CandidateName']; ?></a>
                                     <br>
                                    <span class="position"><?= $row['CandidatePosition']; ?></span><br>
                                    <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                    <span class="source"><?= $row['Source']; ?></span>
                                </td>
                                <!-- <td><?= $row['CandidatePosition']; ?></td> -->
                                <td><?= $row['UploadedDate']; ?></td>
                                <td><?= $row['UploadBy']; ?></td>
                                <td><?= $row['assignTo']; ?></td>
                                
                            </tr>    
                        <?php endforeach; ?> 
                        <?php endif; ?>    
                    </tbody>
                  </table>
                <?php } else if(($trickid == 2) || ($trickid == 16) || ($trickid == 17) || ($trickid == 18) || ($trickid == 3)){?>
                  <table class="table table-hover " id="example">   
                    <thead>                            
                        
                        <tr>
                            <th>Sl no</th>
                            <th>Name</th>
                            <?php if($trickid == 3){ ?>                                
                                <th>Pushed Date</th>    
                            <?php }else{ ?>
                                <th>Call Back</th>    
                                <th>Reason </th>   
                            <?php } ?> 
                            <th>Uploaded Date</th> 
                        </tr>
                    </thead>                   
                    <tbody>
                        <?php $i=1; if($notScheduledList): ?>
                        <?php foreach($notScheduledList as $row): ?>                        
                            <tr>
                                <td><?= $i++ ?></td>
                                <td>
                                    <a href="<?php echo site_url('edit_candidate_view?canId='.$row['CandidateId']) ?>"><?= $row['CandidateName']; ?></a>
                                    <br>
                                    <span class="position"><?= $row['CandidatePosition']; ?></span><br>
                                    <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                    <span class="source"><?= $row['Source']; ?></span>
                                </td>
                                <td><?= $row['CallBackDateTime']; ?></td>
                                <?php if($trickid == 2 || ($trickid == 16) || ($trickid == 17) || ($trickid == 18)){ ?>                                
                                <td><?= $row['NS_Reasons']; ?></td>    
                                <?php } ?> 
                                
                                <td><?= $row['Created_at']; ?></td>
                                
                            </tr>    
                        <?php endforeach; ?> 
                        <?php endif; ?>    
                    </tbody>
                  </table>
                <?php } else if(($trickid == 4) || ($trickid == 5) || ($trickid == 6) ){?>
                    <table class="table table-hover " id="example">   
                        <thead>
                            <tr>
                                <th>Sl no</th>
                                <th>Name</th>
                                <!-- <th>Mobile No</th> -->
                                <!-- <th>Position Applied</th>  -->
                                <th>Candidate Status</th>
                                   
                                <th>Uploaded Date</th>   
                            </tr>
                        </thead>                   
                        <tbody>
                            <?php $i=1; if($candidateStatus_list){ ?>
                            <?php foreach($candidateStatus_list as $row){ ?>                        
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td>
                                        <?php if(($row['InterviewStatus'] == 2) && ($row['DVStatus'] == 2 ) || ($row['OL_Status'] == 1) ){?>
                                            <a href="<?php echo site_url('offer_letter_process?canId='.$row['CandidateId']) ?>"><?= $row['CandidateName']; ?></a>
                                        <?php }elseif(($row['InterviewStatus'] == 2) && ($row['DVStatus'] == 2 )){?>
                                            <a href="<?php echo site_url('offer_letter_process?canId='.$row['CandidateId']) ?>"><?= $row['CandidateName']; ?></a>

                                        <?php }elseif(($row['InterviewStatus']==2 || 3 || 4) || ($row['DVStatus'] == 1 ) ){ ?>
                                            <a href="<?php echo site_url('onboarding_process?canId='.$row['CandidateId']) ?>"><?= $row['CandidateName']; ?></a>
                                       
                                        <?php } ?>
                                        <br>
                                        <span class="position"><?= $row['CandidatePosition']; ?></span><br>
                                        <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                        
                                    </td>
                                    <!-- <td><?= $row['CandidateContactNo']; ?></td>  -->
                                    <!-- <td><?= $row['CandidatePosition']; ?></td> -->
                                    <td>
                                        <?php $date = date('d-M-Y' , strtotime($row['UpdatedDate'])); 
                                                // echo $date;
                                        ?>
                                        <?php if(  ($row['JoiningStatus'] == 2) ){?>
                                            <span class="text-red">Candidate Not Joined</span>
                                        <?php } elseif(  ($row['ConfirmStatus'] == 1) ){?>
                                            <span class="text-red">Waiting for Joining</span>
                                        <?php }elseif(  ($row['ConfirmStatus'] == 2) ){?>
                                            <span class="text-red">Candidate Not-Confirmed</span>
                                        <?php } elseif( ($row['DVStatus'] == 2) && ($row['OL_Status'] == 1) ){?>
                                            <span class="text-green">Offer Letter Sent</span>
                                        <?php }elseif( ($row['DVStatus'] == 2)){?>
                                            <span class="text-green">Documents Verified</span>
                                        <?php }elseif( ($row['DVStatus'] == 1)){?>
                                            <span class="text-red">Documents Rejected</span>
                                        <?php }elseif($row['InterviewStatus'] == 2){?>
                                            <span class="text-green">Selected by <?=  $row['InterviewerName'].' on '.$date ?>  </span>
                                        <?php }elseif($row['InterviewStatus'] == 3){?>
                                            <span class="text-orange">Hold by <?=  $row['InterviewerName'].' on '.$date ?></span>
                                        <?php }elseif($row['InterviewStatus'] == 4){?>
                                            <span class="text-red">Rejected by <?=  $row['InterviewerName'].' on '.$date ?></span>
                                        
                                        <?php } ?>
                                    
                                    </td>
                                   
                                    <td><?= $row['Created_at']; ?></td>
                                </tr>    
                                <?php } ?> 
                            <?php } ?>    
                        </tbody>
                    </table>
                
                <?php } else if($trickid == 8){?>
                    <table class="table table-hover " id="example">   
                        <thead>
                            <tr>
                                <th>Sl no</th>
                                <th>Name</th>
                                <!-- <th>Mobile No</th> -->
                                <!-- <th>Position Applied</th>  -->
                                <th>Joining Date</th> 
                                <th>Joined Status</th> 
                                <th>Added By</th>    
                            </tr>
                        </thead>                   
                        <tbody>
                            <?php $i=1; if($candidateOfferStatus_list){ ?>
                            <?php foreach($candidateOfferStatus_list as $row){ ?>                        
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td>
                                        <a href="<?php echo site_url('offer_letter_process?canId='.$row['CandidateId']) ?>"><?= $row['CandidateName']; ?></a> 
                                        <br>
                                    <span class="position"><?= $row['CandidatePosition']; ?></span><br>
                                    <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                    </td>
                                    <!-- <td><?= $row['CandidateContactNo']; ?></td> -->
                                    <!-- <td><?= $row['CandidatePosition']; ?></td> -->
                                    <td><?= $row['JoiningDate']; ?></td>
                                    <td>
                                        
                                        <?php if($row['WorkingStatus'] == 1 ){?>
                                            <span class="text-green"> Active</span>
                                        <?php }elseif($row['WorkingStatus'] == 2 ){?>
                                            <span class="text-orange"> InActive</span>
                                        <?php }elseif($row['WorkingStatus'] == 3 ){?>
                                            <span class="text-red"> Abscond</span>
                                        <?php }elseif($row['JoiningStatus'] == 1 ){?>
                                            <span class="text-green"> Joined</span>
                                        
                                                                              
                                        <?php } ?>
                                    
                                    </td>
                                    <td><?= $row['HRName']; ?></td>
                                </tr>    
                                <?php } ?> 
                            <?php } ?>    
                        </tbody>
                    </table>

                <?php }?>
                     
                </div>          
        
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
        var url = window.location;
        $('a.bg-orange ').filter(function() {
            return this.href == url;
        }).addClass('activeclass');
    })
</script>

<?php if($trickid == 9){?>
    <style>
        .activetrick9{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
        .activetrick1{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
    </style>
<?php }elseif($trickid == 10){?>
    <style>
        .activetrick10{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
        .activetrick1{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
    </style>
<?php }elseif($trickid == 11){?>
    <style>
        .activetrick11{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
        .activetrick1{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
    </style>
<?php }elseif($trickid == 15){?>
    <style>
        .activetrick15{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
        .activetrick1{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
    </style>

<?php }elseif($trickid == 13){?>
    <style>
        .activetrick13{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
        .activetrick12{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
    </style>
<?php }elseif($trickid == 14){?>
    <style>
        .activetrick14{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
        .activetrick12{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
    </style>
<?php }elseif($trickid == 16){?>
    <style>
        .activetrick16{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
        .activetrick2{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
    </style>
<?php }elseif($trickid == 17){?>
    <style>
        .activetrick17{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
        .activetrick2{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
    </style>
<?php }elseif($trickid == 18){?>
    <style>
        .activetrick18{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
        .activetrick2{
            background-color: #0b3544 !important;
            border-color: #0b3544 !important;
            background-image:none;
            border-radius: 5px !important;
            color: #fff !important;
        }
    </style>

<?php } ?>



<script>

$('#HRnames').change( function() {
    var trickid=document.getElementById("trickid").value;
var hr_idfk = document.getElementById("HRnames").value;
var daterange = document.getElementById("reportrange").value;
  var temp1 = daterange.split('-').pop();
  var	dateString1 = temp1.replaceAll('/', "-");	
  var todateid = moment(dateString1).format('YYYY-MM-DD');	
  var temp2 = daterange.slice(0,10);
  var	dateString2 = temp2.replaceAll('/', "-");
  var fromdateid = moment(dateString2).format('YYYY-MM-DD');
window.location.href = 'HRadmin_individual_candidate_List?&fdate='+fromdateid+'&todate='+todateid+'&trickid='+trickid+'&HR_IDFK='+hr_idfk;


});

function datefilter()
{
  var trickid=document.getElementById("trickid").value;
  var hr_idfk=document.getElementById("HR_IDFK").value;
    var daterange = document.getElementById("reportrange").value;
    var temp1 = daterange.split('-').pop();
    var	dateString1 = temp1.replaceAll('/', "-");	
    var todateid = moment(dateString1).format('YYYY-MM-DD');	
	var temp2 = daterange.slice(0,10);
	var	dateString2 = temp2.replaceAll('/', "-");
	var fromdateid = moment(dateString2).format('YYYY-MM-DD');   

    window.location.href = 'HRadmin_individual_candidate_List?fdate='+fromdateid+'&todate='+todateid+'&trickid='+trickid+'&HR_IDFK='+hr_idfk;
   
}
</script>


<?= $this->endSection() ;?>

