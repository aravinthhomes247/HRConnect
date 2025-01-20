<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?><input type="hidden" name="trickid" id="trickid" value="<?= $trickid ?>">
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
                            </div>
                        </div>
                        

                        <div class="col-lg-6">
                            <div class="d-flex justify-content-end " >
                                <div class="form-group ml-1 mt-1"> 
                                    <div class="input-group">     
                                        <input type="text" id="autocompleteemp"  class="form-control form-control-sm" placeholder = "To : ">
                                        <input type="hidden" id="empid" name="ReceiverId" value='0' >
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($session->getFlashdata('CanidateSuccessMsg')){?>
                            <div class="col-lg-12">
                                <div class="alert alert-success bg-orange alert-dismissible fade show" role="alert">
                                    <strong><?= $session->getFlashdata('CanidateSuccessMsg') ?></strong> 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        <?php }  ?>
                        <div class="col-lg-12 ">
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=13') ?>" class="btn btn-sm bg-orange activetrick12 mt-1">Fresh List  <span class="badge badge-light"><?= $candiadtecounts[11][0]['FreshListCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=2') ?>" class="btn btn-sm bg-orange activetrick2 mt-1">Not Scheduled List  <span class="badge badge-light"><?= $candiadtecounts[1][0]['NotScheduledCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=1') ?>" class="btn btn-sm bg-orange activetrick1 mt-1">Scheduled List  <span class="badge badge-light"><?= $candiadtecounts[0][0]['ScheduledCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=4') ?>" class="btn btn-sm bg-orange mt-1">Selected List <span class="badge badge-light"><?= $candiadtecounts[3][0]['SelectedCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=6') ?>" class="btn btn-sm bg-orange mt-1">Hold List <span class="badge badge-light"><?= $candiadtecounts[4][0]['HoldCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=5') ?>" class="btn btn-sm bg-orange mt-1">Rejected List <span class="badge badge-light"><?= $candiadtecounts[5][0]['RejectCount'] ?></span></a>
                            <!-- <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=7') ?>" class="btn btn-sm bg-orange mt-1">Offered List <span class="badge badge-light"><?= $candiadtecounts[6][0]['OfferLetterCount'] ?></span></a> -->
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=8') ?>" class="btn btn-sm bg-orange mt-1">Joined List <span class="badge badge-light"><?= $candiadtecounts[7][0]['JoinedCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=3') ?>" class="btn btn-sm bg-orange mt-1">Junk List  <span class="badge badge-light"><?= $candiadtecounts[2][0]['JunkCount']?></span></a>
                        </div>

                        <?php if($trickid==1 || $trickid==9 || $trickid==10 || $trickid==11 || $trickid==15 ){?> 
                        <div class="col-lg-12 mt-2 pl-4 ">
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=11') ?>" class=" btn btn-sm bg-orange activetrick11 mt-1">Todays List <span class="badge badge-light"><?= $candiadtecounts[10] ?></span></a>
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=10') ?>" class=" btn btn-sm bg-orange activetrick10 mt-1">Missed List <span class="badge badge-light"><?= $candiadtecounts[9] ?></span></a>
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=9') ?>" class="  btn btn-sm bg-orange activetrick9 mt-1">Upcoming List <span class="badge badge-light"><?= $candiadtecounts[8][0]['upcomingCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=15') ?>" class=" btn btn-sm bg-orange activetrick15 mt-1">Interview Processing List  <span class="badge badge-light"><?= $candiadtecounts[14][0]['InterviewStatusCount'] ?></span></a>
                            
                        </div>
                        <?php }?>
                        <?php if($trickid==2 || ($trickid == 16) || ($trickid == 17) || ($trickid == 18)){?> 
                        <div class="col-lg-12 mt-2 pl-4 ">
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=16') ?>" class=" btn btn-sm bg-orange activetrick16 mt-1">Todays List <span class="badge badge-light"><?= $candiadtecounts[15][0]['TodaysNotScheduledCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=17') ?>" class=" btn btn-sm bg-orange activetrick17 mt-1">Missed List <span class="badge badge-light"><?= $candiadtecounts[16][0]['MissedNotScheduledCount'] ?></span></a>
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=18') ?>" class=" btn btn-sm bg-orange activetrick18 mt-1">Upcoming List <span class="badge badge-light"><?= $candiadtecounts[17][0]['UpcomingNotScheduledCount'] ?></span></a>
                            
                        </div>
                        <?php }?>
                        <?php if($trickid==12 || $trickid==13 || $trickid==14){?> 
                        <div class="col-lg-12 mt-2 pl-4 ">
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=13') ?>" class=" btn btn-sm bg-orange activetrick13 mt-1">Todays List <span class="badge badge-light"><?= $candiadtecounts[12] ?></span></a>
                            <a href="<?php  echo site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=14') ?>" class=" btn btn-sm bg-orange activetrick14 mt-1">Pending List <span class="badge badge-light"><?= $candiadtecounts[13] ?></span></a>
                        </div>
                        <?php }?>
                            
                        
                    </div>
                </div>
                <div class="card-body table-responsive ">     
              
                <?php if(($trickid == 1)  || ($trickid==9) || ($trickid==10) || ($trickid==11)){?>
                  <table class="table table-hover " id="example">   
                    <thead> 
                        <tr>
                            <th>Sl no</th>
                            <th>Name</th>
                            <th>Position Applied</th> 
                            <th>Interview Date</th>      
                            <th>Interview Status</th>      
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
                                    <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                    <span class="source"><?= $row['Source']; ?></span>
                                    
                                </td>
                                <td><?= $row['CandidatePosition']; ?></td>
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
                            </tr>    
                        <?php endforeach; ?> 
                        <?php endif; ?>    
                    </tbody>
                  </table>
                <?php } elseif($trickid == 15){?>
                  <table class="table table-hover " id="example">   
                    <thead> 
                        <tr>
                            <th>Sl no</th>
                            <th>Name</th>
                            <th>Position Applied</th> 
                            <th>Interview Date</th>      
                            <th>Interview Status</th>      
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
                                    <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                    <span class="source"><?= $row['Source']; ?></span>
                                    
                                </td>
                                <td><?= $row['CandidatePosition']; ?></td>
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
                            </tr>    
                        <?php endforeach; ?> 
                        <?php endif; ?>    
                    </tbody>
                  </table>
                <?php }elseif(($trickid == 2) || ($trickid == 16) || ($trickid == 17) || ($trickid == 18)){?>
                  <table class="table table-hover " id="example">   
                    <thead>                            
                        
                        <tr>
                            <th>Sl no</th>
                            <th>Name</th>
                            <!-- <th>Mobile No</th> -->
                            <th>Position Applied</th> 
                            <!-- <th>Source</th>  -->
                            <th>Call Back</th> 
                            <th>Schedule Status</th>       
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
                                    <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                    <span class="source"><?= $row['Source']; ?></span>
                                </td>
                                <!-- <td><?= $row['CandidateContactNo']; ?></td>                               -->
                                <td><?= $row['CandidatePosition']; ?></td>
                                <!-- <td><?= $row['Source']; ?></td> -->
                                <td><?= $row['CallBackDateTime']; ?></td>
                                <td><?= $row['NS_Reasons']; ?></td>
                                
                            </tr>    
                        <?php endforeach; ?> 
                        <?php endif; ?>    
                    </tbody>
                  </table>
                <?php }elseif( $trickid==3 ){?>
                  <table class="table table-hover " id="example">   
                    <thead>                            
                        
                        <tr>
                            <th>Sl no</th>
                            <th>Name</th>
                            <!-- <th>Mobile No</th> -->
                            <th>Position Applied</th> 
                            <!-- <th>Source</th>  -->
                            <th>Reason</th>       
                            <th>Pushed Date</th>       
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
                                    <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                    <span class="source"><?= $row['Source']; ?></span>
                                </td>
                                <td><?= $row['CandidatePosition']; ?></td>
                                <td><?= $row['NS_Reasons']; ?></td>
                                <td><?= $row['CallBackDateTime']; ?></td>
                                
                            </tr>    
                        <?php endforeach; ?> 
                        <?php endif; ?>    
                    </tbody>
                  </table>
                <?php }elseif(($trickid == 12)||($trickid==13)||($trickid==14)){?>
                  <table class="table table-hover " id="example">   
                    <thead>                        
                        <tr>
                            <th>Sl no</th>
                            <th>Name</th>
                            <!-- <th>Mobile No</th> -->
                            <th>Position Applied</th> 
                            <!-- <th>Source</th>  -->
                            <!-- <th>Schedule Status</th>        -->
                            <th>Uploaded Date</th>       
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
                                    <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                    <span class="source"><?= $row['Source']; ?></span>
                                </td>
                                <!-- <td><?= $row['CandidateContactNo']; ?></td>  -->
                                <td><?= $row['CandidatePosition']; ?></td>
                                <!-- <td><?= $row['Source']; ?></td> -->
                                <!-- <td><?= $row['NS_Reasons']; ?></td> -->
                                <td><?= $row['UploadedDate']; ?></td>
                                
                            </tr>    
                        <?php endforeach; ?> 
                        <?php endif; ?>    
                    </tbody>
                  </table>
                <?php }elseif(($trickid == 4)||($trickid == 5)||$trickid == 6){?>
                    <table class="table table-hover " id="example">   
                        <thead>
                            <tr>
                                <th>Sl no</th>
                                <th>Name</th>
                                <!-- <th>Mobile No</th> -->
                                <th>Position Applied</th> 
                                <th>Candidate Status</th>     
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
                                    <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                    
                                        
                                    </td>
                                    <!-- <td><?= $row['CandidateContactNo']; ?></td>                               -->
                                    <td><?= $row['CandidatePosition']; ?></td>
                                    <td>
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
                                            <span class="text-green">Selected by <?=  $row['InterviewerName']?> </span>
                                        <?php }elseif($row['InterviewStatus'] == 3){?>
                                            <span class="text-orange">Hold by <?=  $row['InterviewerName']?></span>
                                        <?php }elseif($row['InterviewStatus'] == 4){?>
                                            <span class="text-red">Rejected by <?=  $row['InterviewerName']?></span>
                                        
                                        <?php } ?>
                                    
                                    </td>
                                </tr>    
                                <?php } ?> 
                            <?php } ?>    
                        </tbody>
                    </table>
                
                <?php }elseif($trickid == 8){?>
                    <table class="table table-hover " id="example">   
                        <thead>
                            <tr>
                                <th>Sl no</th>
                                <th>Name</th>
                                <!-- <th>Mobile No</th> -->
                                <th>Position Applied</th> 
                                <th>Joining Date</th>     
                                <th>Joined Status</th>     
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
                                        <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                    </td>
                                    <!-- <td><?= $row['CandidateContactNo']; ?></td>                               -->
                                    <td><?= $row['CandidatePosition']; ?></td>
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



<!-- autocomplete function  -->
<script type='text/javascript'>
   $(document).ready(function(){
     // Initialize
        var trickid=document.getElementById("trickid").value;
        var juckurl = '<?= base_url('/edit_candidate_view?canId=') ?>' ;
        var url = '<?= base_url('/provious_rounds?canId=') ?>' ;
        $( "#autocompleteemp" ).autocomplete({
            source: function( request, response ) {
            // CSRF Hash
            var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
            var csrfHash = $('.txt_csrfname').val(); // CSRF hash
            // Fetch data
            $.ajax({
                url: "<?= site_url('getcandidates') ?>",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    [csrfName]: csrfHash // CSRF Token
                },
                success: function( data ) {
                    // Update CSRF Token
                    $('.txt_csrfname').val(data.token);
                    response( data.data );
                }
            });
            },
            select: function (event, ui) {
            // Set selection
                $('#autocompleteemp').val(ui.item.label); // display the selected text
                $('#empid').val(ui.item.value); // save selected id to input
                $('#empid').val(ui.item.value); // save selected id to input

                var candid = ui.item.value;                
                var status = ui.item.schedulestatus;  
                var fromdate = ui.item.fdate;  
                var callback = ui.item.callback;  
                    // console.log(fromdate); 
                if(status == 3 || status == 4 || status == 5 || status == 6 || status == 7|| status == 8|| status == 11)   {
                    window.open(juckurl+candid,'_blank');
                }else{
                    window.open(url+candid, '_blank');
                }
                return false;
            },
            focus: function(event, ui){
                $( "#autocompleteemp" ).val( ui.item.label );
                $( "#empid" ).val( ui.item.value );
                return false;
            },
        });
   }); 
</script> 


<script>
    $(document).ready(function() {
        // alert('hi');
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

function datefilter()
{
    var trickid=document.getElementById("trickid").value;
    var daterange = document.getElementById("reportrange").value;
    var temp1 = daterange.split('-').pop();
    var	dateString1 = temp1.replaceAll('/', "-");	
    var todateid = moment(dateString1).format('YYYY-MM-DD');	
	var temp2 = daterange.slice(0,10);
	var	dateString2 = temp2.replaceAll('/', "-");
	var fromdateid = moment(dateString2).format('YYYY-MM-DD');   

    window.location.href = 'HRcandidate_List?fdate='+fromdateid+'&todate='+todateid+'&trickid='+trickid;
   
}
</script>


<?= $this->endSection() ;?>

