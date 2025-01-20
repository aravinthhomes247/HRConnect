<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?> 


<!-- Content Wrapper. Contains page content --><input type="hidden" name="trickid" id="trickid" value="<?= $trickid ?>">
<div class="content-wrapper">
<!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <div class="row" >
                            <div class="col-6" >
                                <a href="<?php  echo site_url('/leaveRequest?&fdate='.$fdate.'&todate='.$todate.'&trickid=1') ?>" class="btn bg-orange">All  <span class="badge badge-light"><?= $allLrCount[0]['counts'] ?></span></a> 
                                <a href="<?php  echo site_url('/leaveRequest?&fdate='.$fdate.'&todate='.$todate.'&trickid=2') ?>" class="btn bg-orange">Approved  <span class="badge badge-light"><?= $approveLrCount[0]['counts'] ?></span></a> 
                                <a href="<?php  echo site_url('/leaveRequest?&fdate='.$fdate.'&todate='.$todate.'&trickid=3') ?>" class="btn bg-orange">Rejected  <span class="badge badge-light"><?=$rejectLrCount[0]['counts']?></span></a> 
                                <a href="<?php  echo site_url('/leaveRequest?&fdate='.$fdate.'&todate='.$todate.'&trickid=4') ?>" class="btn bg-orange">Pending  <span class="badge badge-light" id="count"><?= $pendingLrCount[0]['counts'] ?></span></a> 
                                <!-- <h3 class="card-title ml-3">Total Employees <b id="count"></b></h3> -->
                                
                            </div>
                            <div class="col-6">

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
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive"> 
                        <table id="example" class="table table-hover " style="width:100%">  
                            <thead >
                               
                                <tr>
                                    <th>EmployeeName</th>
                                    <th>Leave Reason</th>
                                    <th>Leave Date</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; if($leaveRequest): ?>
                                <?php foreach($leaveRequest as $row): ?>
                                    <?php
                                            if($row['readStatus']==0){?>
                                                <tr class="read" >   
                                <?php }else{
                                        echo '<tr >';
                                    }
                                        ?>                      
                                                         
                                    <td>
                                        <div class="user-block " >
                                            <?php
                                                if ($row['Image'] == NULL){?>
                                                    <b class="name-circle name-bordered-sm" >
                                                    <?php $str=$row['EmployeeName'];
                                                                    $name=substr($str, 0, 1); 
                                                                    print_r($name); ?>
                                                                    </b>
                                                    <?php
                                                }else{?>
                                                    <img class="img-circle img-bordered-sm" src="<?php echo base_url('Public/Uploads/ProfilePhotosuploads/'.$row['Image']); ?>" alt="<?php echo $row['EmployeeName']; ?>">
                                                    <?php
                                                }
                                            ?>
                                            <span class="username"><a href="<?php  echo site_url('ReadLeaveRequest/'.$row['IDPK']) ?>"><?php echo $row['EmployeeName']; ?></a> </span>
                                            <span class="description"><?php echo $row['createdAt']; ?></span>                                        
                                        </div>
                                    </td>
                                    <td><span><?php echo $row['LeaveReason']; ?>- <?php echo $row['Reason']; ?></span></td>
                                    <td><?php echo $row['absentDate']; ?></td>
                                    
                                </tr></span>
                                <?php endforeach; ?> 
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
            <!-- /.card -->
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
  $("#word_count").on('keyup', function() {
    var words = 0;

    if ((this.value.match(/\S+/g)) != null) {
      words = this.value.match(/\S+/g).length;
    }

    if (words > 50) {
      // Split the string on first 50 words and rejoin on spaces
      var trimmed = $(this).val().split(/\s+/, 50).join(" ");
      // Add a space at the end to make sure more typing creates new words
      $(this).val(trimmed + " ");
    }
    else {
      $('#display_count').text(words);
      $('#word_left').text(50-words);
    }
  });
}); 
</script>


<script>

function datefilter()
{
    // var empid1=document.getElementById("UserId").value;
    // var empid="";
    // alert(empid);
    var daterange = document.getElementById("reportrange").value;
    var temp1 = daterange.split('-').pop();
    var	dateString1 = temp1.replaceAll('/', "-");	
    var todateid = moment(dateString1).format('YYYY-MM-DD');	
	var temp2 = daterange.slice(0,10);
	var	dateString2 = temp2.replaceAll('/', "-");
	var fromdateid = moment(dateString2).format('YYYY-MM-DD');
    // alert(todateid);
    

    window.location.href = 'leaveRequest?fdate='+fromdateid+'&todate='+todateid+'&trickid=1';
   
}
</script>
<script>
    $(document).ready(function() {
  /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('a.bg-orange ').filter(function() {
            return this.href == url;
        }).addClass('activeclass');

        // for treeview
        // $('ul.nav-treeview a').filter(function() {
        //     return this.href == url;
        // }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    })
</script>


<?= $this->endSection() ?>

