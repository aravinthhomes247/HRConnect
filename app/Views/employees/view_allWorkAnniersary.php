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
          <div class="col-12">
            
            <div class="card mt-2">
              <div class="card-header">
                <h3 class="card-title">Upcoming Employee Work Anniversary List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="emps-list" class="table  table-striped table-hover ">
                  <thead>
                     <tr>
                        <th>Sl No</th>
                        <th>EmployeeCode</th>
                        <th>EmployeeName</th>
                        <th>Joining Date</th>
                        <th>Experience</th>
                        
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i=1; if($allworkAnniversaryDetailsTable): ?>
                     <?php foreach($allworkAnniversaryDetailsTable as $row): ?>
                     <tr>                         
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['EmployeeCode']; ?></td>
                        <td><?php echo $row['EmployeeName']; ?></td>
                        <td><?php echo $row['DOJ']; ?></td>
                        <td><?php echo  $row['years'].' Years '.$row['months'].' Months '. $row['days'].' Days '; ?></td>
                        
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




<?= $this->endSection() ?>

