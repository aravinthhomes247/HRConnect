<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?>


 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0">Attendance Dashboard</h1>
                        
          </div><!-- /.col -->
          <div class="col-sm-8 pl-0">            
            <div class="d-flex justify-content-end " >  
                
                <div class="form-group">   
                    <div class="input-group">     
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" id="reportrange">  
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
                        <button class="btn bg-orange" onclick="datefilter()">Check</button>
                    </div>
                </div>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Report content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=  $count ?></h3>

                <p>Total Employees</p>
              </div>
              <div class="icon">
              <i class="fa-solid fa-people-line"></i>
         
              </div>
              <a href="<?php echo site_url('/totalEmps?trickid=1') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?=  $presents ?></h3>

                <p>Present</p>
              </div>
              <div class="icon">
             
                <i class="fa-solid fa-file-powerpoint"></i>
              </div>
              <a href="<?php echo site_url('/presents?&fdate='.$fdate.'&todate='.$todate) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $absent ?></h3>

                <p>Absents</p>
              </div>
              <div class="icon">
            
                <i class="fa-solid fa-user-xmark"></i>
              </div>
              <a href="<?php echo site_url('/absents?&LRID=0&fdate='.$fdate.'&todate='.$todate.'&trickid=1') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $lateComers ?></h3>

                <p>Late Comers</p>
              </div>
              <div class="icon">
              
                <i class="fa-solid fa-person-running"></i>
              </div>
              <a href="<?php echo site_url('/lateComers?&fdate='.$fdate.'&todate='.$todate) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
        </div>
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Report content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Events-->
        <div class="row">
            
            <!-- ./col -->
            <div class="col-lg-12 col-12">
                <div class="card mt-2">
                    <div class="card-header  bg-orange">
                        <h3 class="card-title "><b>Upcoming Employee Work Anniversary List</b></h3>                        
                        <a href="<?php echo site_url('/workAnniversary') ?>" class=" d-flex justify-content-end" style="color: #ffffff"><b>View All</b></a>
                        
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table id="" class="table table-bordered table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>EmployeeCode</th>
                                <th>EmployeeName</th>
                                <th>Joining Date</th>
                                <th>Experience</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($workAnniversaryDetailsTable): ?>
                            <?php foreach($workAnniversaryDetailsTable as $row): ?>
                            <tr>                         
                                <td><?php echo $row['EmployeeCode']; ?></td>
                                <td><?php echo $row['EmployeeName']; ?></td>
                                <td><?php echo $row['DOJ']; ?></td>
                                <td><?php echo $row['years'].' Years '.$row['months'].' Months '; ?></td>
                                
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- ./col -->

            <div class="col-lg-5">
                <!-- Birthday LIST -->
                <div class="card">
                  <div class="card-header bg-info">
                    <h3 class="card-title"><b>Upcoming Birthday List</b></h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                      <?php if($birthdayDetailsTable): ?>
                            <?php foreach($birthdayDetailsTable as $row): ?>
                      <li>
                        <?php if($row['Image'] != Null) { ?>                           
                          <img src="<?php echo base_url('Public/Uploads/ProfilePhotosuploads/'.$row['Image']); ?>" alt="<?php echo $row['EmployeeName']; ?>">
                          <?php }else{ ?> 
                            <img src="<?php echo base_url('Public/default.png'); ?>" alt="<?php echo $row['EmployeeName']; ?>">                          
                        <?php }?>
                        <a class="users-list-name" href="#"><?php echo $row['EmployeeName']; ?></a>
                        <span class="users-list-date"><?php echo $row['EmployeeCode']; ?></span>
                        <span class="users-list-date"><b><?php echo $row['DOB']; ?></b></span>
                      </li>
                      
                      <?php endforeach; ?>
                     <?php endif; ?>
                     
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a href="<?php echo site_url('/allbirthdays') ?>">View All Employees</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>
            <!-- /.col -->

            <div class="col-lg-7">
                <!-- Events LIST -->
                <div class="card">
                  <div class="card-header bg-success">
                    <h3 class="card-title"><b>Upcoming Company Events List</b></h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table id="" class="table table-bordered table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>EventName</th>
                                <th>Event Date</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($eventsDetailsTable): ?>
                            <?php foreach($eventsDetailsTable as $row): ?>
                            <tr>                         
                                <td><?php echo $row['EventName']; ?></td>
                                <td><?php echo $row['EventDate']; ?></td>
                                
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a href="<?php echo site_url('/allevents') ?>">View All Events</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>
            <!-- /.col -->
           
            
           
        </div>
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>


  </div>
  <!-- /.content-wrapper -->




<script>


function datefilter()
{
   
    var daterange = document.getElementById("reportrange").value;
    var temp1 = daterange.split('-').pop();
    var	dateString1 = temp1.replaceAll('/', "-");	
    var todateid = moment(dateString1).format('YYYY-MM-DD');	
    var temp2 = daterange.slice(0,10);
    var	dateString2 = temp2.replaceAll('/', "-");
    var fromdateid = moment(dateString2).format('YYYY-MM-DD');
    // alert(todateid);
    window.location.href = 'DSdaterangeV?&fdate='+fromdateid+'&todate='+todateid;
  
}
</script>
 
<?= $this->endSection() ?>