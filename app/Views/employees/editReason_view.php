<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?>
<?php
      if(isset($_SESSION['msg'])){
         echo $_SESSION['msg'];
         }
      ?>
         
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12 col-lg-5">
            
            <div class="card mt-2">
              <div class="card-header">
                <h3 class="card-title">Edit Leave Reason</h3>
                
              </div>
             
              <!-- /.card-header -->
              <form action="<?= site_url('/update_reason') ?>" method="post" autocomplete="off"  enctype="multipart/form-data">
                <input type="hidden" name="EmployeeId" class="form-control"  value="<?php echo $showAbsentEmpDetails[0]['EmployeeId']; ?>" >                
                <input type="hidden" name="IDPK" class="form-control"  value="<?php echo $ALRid[0]['IDPK']; ?>" >                
                <input type="hidden" name="Mail_IDPK" class="form-control"  value="<?php echo $EmpLeaveTaken[0]['Mail_IDPK']; ?>" >                
                <div class="card-body ">
                  <div class="form-group">
                      <div class="form-group">
                          <label >Employee Code</label>
                          <input type="text" name="EmployeeCode" class="form-control" value="<?php echo $showAbsentEmpDetails[0]['EmployeeCode']; ?>" readonly>
                      </div>
                      <div class="form-group">
                          <label >Employee Name</label>
                          <input type="text" name="EmployeeName" class="form-control" value="<?php echo $showAbsentEmpDetails[0]['EmployeeName']; ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Absent Date</label>                  
                        <input type="text" name="AbsentDate" class="form-control"  value="<?php echo $showAbsentEmpDetails[0]['AbsentDate']; ?>" readonly> 
                      </div>
                      <div class="form-group">
                        <label>Select Reason</label>
                        <select class="form-control " name="LeaveReason">
                          <!-- <option value="<?php //echo $showleavereason["IDPK"] ?>" ><?php// $showleavereason['LeaveReason'] ?></option> -->
                          <option >--Select Reason--</option> 
                            <?php
                              if($selectleavereason){
                                foreach ($selectleavereason as $row) {?>
                                <option  value="<?php echo $row["IDPK"] ?>"><?php echo $row["LeaveReason"] ?> </option>
                                <?php
                                } }?>                                         
                        </select>
                      </div>
                      <div class="form-group">
                        <textarea name="Reason" id="word_count" class="form-control " placeholder='Enter Reason' required ></textarea>
                         
                          Total word count: <span id="display_count">0</span> words. Words left: <span id="word_left">50</span>
                      </div>
                      <button type="submit" class="btn btn-block bg-orange  mt-4">Save</button>
                  </div>
                </div>
              </form>
              
                
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

          <div class="col-12 col-lg-7 ">
            
            <div class="card mt-2">
              <div class="card-header">
                <h3 class="card-title"><?php echo $showAbsentEmpDetails[0]['EmployeeName']; ?> Leave History</h3>                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example" class="table  table-striped table-hover ">
                  <thead>
                     <tr>
                        <th>Sl No</th>
                        <th>Leave Reason</th>
                        <th>Reason</th>
                        <th>Leave Date</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i=1; if($EmpLeaveTaken): ?>
                     <?php foreach($EmpLeaveTaken as $row): ?>
                     <tr>                         
                        <td><?php echo $i++; ?></td>
                        <td><a href="<?php echo base_url('editReason/'.$row['EmployeeIDFK'].'/'.$row['AbsentDate'].'/'.$row['IDPK']);?>" ><?php echo $row['LeaveReason']; ?></a></td>
                        <td>
                          <!-- <span id="module" >   
                            <p class="collapse" id="collapseExample" aria-expanded="false"> -->
                              <?php echo $row['Reason']; ?>
                            <!-- </p>
                            <a role="button" class="collapsed" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"></a>
                          </span> -->
                        </td>
                        <td><?php echo $row['AbsentDate']; ?></td>
                        
                        
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
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </section>
    <!-- /.content -->

</div>

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>  
      
      
     
    
    <script>
        $(document).ready( function () {
          $('#events-list').DataTable({
            // "scrollX": true       
          });

      });
    </script> -->


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

<?= $this->endSection() ?>

