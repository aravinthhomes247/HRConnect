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
       

          <div class="col-12 col-lg-12 ">            
            <div class="card mt-2">
              <div class="card-header">
                <h3 class="card-title"><?php echo $showAbsentEmpDetails[0]['EmployeeName']; ?> Leave History</h3>                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="events-list" class="table  table-striped table-hover ">
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
                        <td><?php echo $row['Reason']; ?> </td>
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
       -->
      
     
    <!-- <script type="text/javascript">  
        $('.date').datepicker({  
           format: 'yyyy-mm-dd',  
         });  
    </script>   -->
    <script>
        $(document).ready( function () {
          $('#events-list').DataTable({
            // "scrollX": true       
          });

      });
    </script>


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

