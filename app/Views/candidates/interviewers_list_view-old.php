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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Interviewer List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#" class="btn bg-orange"title="Add New Interviewer" > <b><i class="fa-solid fa-plus"></i> </b></a></li> -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fa-solid fa-plus"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Interviewer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= site_url('/store_interviewer') ?>" method="post">
                                <select class="form-control" name="InterviewerIDFK">
                                    <option>--Select-- </option>
                                    <?php
                                        if($select_interviewer){
                                            foreach ($select_interviewer as $row) {?>
                                            <option value="<?php echo $row["EmployeeId"] ?>">
                                                <?php echo $row["EmployeeName"] ?> </option>
                                    <?php } }?>
                                </select>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 
    
<!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">         
          <!-- /.col -->
          

          <div class="col-lg-12 mt-2">
            <div class="card">
            
            
                
                <div class="card-body table-responsive "> 
                  <table class="table table-hover " id="example">   
                    <thead>
                        <tr>
                            <th>Sl no</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Action</th>     
                        </tr>
                    </thead>                   
                    <tbody>
                        <?php $i=1; if($interviewerList): ?>
                        <?php foreach($interviewerList as $row): ?>                        
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $row['EmployeeName']; ?> </td>
                                <td><?= $row['EmployeeCode']; ?></td>  
                                <td>                                   
                                    <a class="btn btn-sm " href="<?= site_url('delete_interviewer/'.$row['EmployeeId']) ?>"><i class="fa-solid fa-trash"></i></a></a>
                                </td>
                            </tr>    
                        <?php endforeach; ?> 
                        <?php endif; ?>    
                    </tbody>
                  </table>
                     
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



<?= $this->endSection() ;?>

