<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?>
<input type="hidden" name="trickid" id="trickid" value="<?= $trickid ?>">
<?php
      if(isset($_SESSION['msg'])){
         echo $_SESSION['msg'];
         }

    $fdate= date('Y-m-d');
    $todate= date('Y-m-d');

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
                        <div class="col-lg-8 ">
                            <a href="<?php  echo site_url('/HRtodays_activity?&trickid=1') ?>" class="btn btn-sm bg-orange activetrick12 mt-1">Fresh List  <span class="badge badge-light"><?= $curentDayCount[0] ?></span></a>
                            <a href="<?php  echo site_url('/HRtodays_activity?&trickid=2') ?>" class="btn btn-sm bg-orange activetrick2 mt-1">Not Scheduled List  <span class="badge badge-light"><?= $curentDayCount[1] ?></span></a>
                            <a href="<?php  echo site_url('/HRtodays_activity?&trickid=3') ?>" class="btn btn-sm bg-orange activetrick1 mt-1">Scheduled List  <span class="badge badge-light"><?= $curentDayCount[2] ?></span></a>
                            <a href="<?php  echo site_url('/HRtodays_activity?&trickid=4') ?>" class="btn btn-sm bg-orange activetrick1 mt-1">Interview Processing list  <span class="badge badge-light"><?= $curentDayCount[3] ?></span></a>
                            <a href="<?php echo site_url('/add_candidate_view') ?>" class=" btn  btn-sm bg-orange mt-1" title="Add New Candidate" > <i class="fa-solid fa-plus"></i> </a>
                         
                        </div>
                        

                        <div class="col-lg-4">
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

                    </div>
                </div>
                <div class="card-body table-responsive ">     
              
                <?php if(($trickid == 3)  ){?>
                  <table class="table table-hover " id="example">   
                    <thead> 
                        <tr>
                            <th>Sl no</th>
                            <th>Name</th>
                            <th>Position Applied</th> 
                            <th>Interview Date</th>       
                        </tr>
                    </thead>                   
                    <tbody>
                        <?php $i=1; if($curentDayActivity): ?>
                        <?php foreach($curentDayActivity as $row): ?>                        
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
                                    <span class="source"><?= $row['SM_Name']; ?></span>                                    
                                </td>
                                <td><?= $row['designations']; ?></td>
                                <td><?= $row['InterviewDate']; ?></td>
                                <!-- <td><?php 
                                        if($row['ScheduleStatus']==1){
                                            echo "Scheduled";
                                        }elseif($row['ScheduleStatus']==10){ 
                                            echo "Yet to Start";
                                        };
                                    ?>
                                </td> -->
                            </tr>    
                        <?php endforeach; ?> 
                        <?php endif; ?>    
                    </tbody>
                  </table>
                <?php } elseif($trickid == 4){?>
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
                        <?php $i=1; if($curentDayActivity): ?>
                        <?php foreach($curentDayActivity as $row): ?>                        
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
                                    <span class="source"><?= $row['SM_Name']; ?></span>
                                    
                                </td>
                                <td><?= $row['designations']; ?></td>
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
                <?php }elseif(($trickid == 2)){?>
                  <table class="table table-hover " id="example">   
                    <thead>                            
                        
                        <tr>
                            <th>Sl no</th>
                            <th>Name</th>
                            <th>Position Applied</th> 
                            <th>Call Back</th> 
                            <th>Schedule Status</th>       
                        </tr>
                    </thead>                   
                    <tbody>
                        <?php $i=1; if($curentDayActivity): ?>
                        <?php foreach($curentDayActivity as $row): ?>                        
                            <tr>
                                <td><?= $i++ ?></td>
                                <td>
                                     <a href="<?php echo site_url('edit_candidate_view?canId='.$row['CandidateId']) ?>"><?= $row['CandidateName']; ?></a>
                                    <br>
                                    <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                    <span class="source"><?= $row['SM_Name']; ?></span>
                                </td>
                                <td><?= $row['designations']; ?></td>
                                <td><?= $row['CallBackDateTime']; ?></td>
                                <td><?= $row['NS_Reasons']; ?></td>
                                
                            </tr>    
                        <?php endforeach; ?> 
                        <?php endif; ?>    
                    </tbody>
                  </table>
                
                <?php }elseif(($trickid == 1)){?>
                  <table class="table table-hover " id="example">   
                    <thead>                        
                        <tr>
                            <th>Sl no</th>
                            <th>Name</th>
                            <th>Position Applied</th> 
                            <th>Uploaded Date</th>       
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; if($curentDayActivity): ?>
                        <?php foreach($curentDayActivity as $row): ?>                        
                            <tr>
                                <td><?= $i++ ?></td>
                                <td>
                                    <a href="<?php echo site_url('scheducleCandidate?canId='.$row['CandidateId']) ?>"><?= $row['CandidateName']; ?></a>
                                    <br>
                                    <span class="phone-no"><?= $row['CandidateContactNo']; ?></span>
                                    <span class="source"><?= $row['SM_Name']; ?></span>
                                </td>
                                <td><?= $row['designations']; ?></td>
                                <td><?= $row['Created_at']; ?></td>
                                
                            </tr>    
                        <?php endforeach; ?> 
                        <?php endif; ?>    
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





<?= $this->endSection() ;?>

