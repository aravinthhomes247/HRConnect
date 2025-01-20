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
          <div class="col-12 col-lg-6">
            
            <div class="card mt-2">
              <div class="card-header">
                <h3 class="card-title">Add Upcoming Events</h3>
                
              </div>
              <!-- /.card-header -->
              <form method="post"  action="<?= site_url('eventsform') ?>" autocomplete="off">
                <div class="card-body ">
                  <div class="form-group">
                      <div class="form-group">
                          <label >Event Name</label>
                          <input type="text" class="form-control"  name="EventName" placeholder="Enter Event Name" required/>
                      </div>
                      <!-- <div class="form-group">
                        <label>Event Date:</label>                  
                        <input class="date form-control"  name="EventDate" type="text" placeholder="Select Event Date"  required/> 
                      </div> -->
                      <div class="form-group">
                        <label>Event Date:</label>
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="EventDate" data-target="#reservationdate" placeholder="Select Event Date" required/>
                            <!-- <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div> -->
                          </div>
                      </div>
                      <button type="submit" class="btn btn-block bg-orange  mt-4">Add Event</button>
                  </div>
                </div>
                </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-12 col-lg-6 ">
            
            <div class="card mt-2">
              <div class="card-header">
                <h3 class="card-title">Upcoming Events List</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="events-list" class="table  table-striped table-hover ">
                  <thead>
                     <tr>
                        <th>Sl No</th>
                        <th>EventName</th>
                        <th>EventDate</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i=1; if($alleventsDetailsTable): ?>
                     <?php foreach($alleventsDetailsTable as $row): ?>
                     <tr>                         
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['EventName']; ?></td>
                        <td><?php echo $row['EventDate']; ?></td>
                        
                        
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
      
      
     
    <script type="text/javascript">  
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

<?= $this->endSection() ?>

