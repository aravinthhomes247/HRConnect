<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <h3 class="card-title"> LateComers Report</h3>
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
                                    }
                                    ?> 
                                    <input type="hidden" name="todate" id="todate" value="<?=$todate?>"/>
                                    <button class="btn bg-orange" onclick="datefilter()">Check</button>
                                </div>
                            </div>
                                    
                            <!-- <div class="form-group col-3"> -->
                             <!--   <select class="form-control  " > <!-- select2 -->
                                <?php //foreach($attendaceReport as $row): ?>
                                    <!-- <option selected="selected"><?php //echo $row['name']; ?></option> -->
                                    
                                    <?php //endforeach; ?> 
                                <!-- </select> -->
                            <!-- </div> -->
                            <div class="form-group ml-2">
                                <button type="button" class=" btn bg-orange toastsDefaultInfo" data-toggle="modal" data-target="#modal-sm">
                                    <i class="fas fa-download"></i>
                                </button>
                                <div class="modal fade" id="modal-sm">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Download Report</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        
                                            <div class="modal-footer justify-content-between">
                                                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                                <!-- <button type="button" class="btn bg-orange" aria-controls="example">PDF</button> -->
                                                <a href="javascript:;"class="btn bg-orange button_export_pdf">Export to PDF</a>
                                                <a href="javascript:;"class="btn bg-orange button_export_excel">Export to Excel</a>
                                                <!-- <button type="button" class="btn bg-orange">Excel</button> -->
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->                                
                            </div>
                        </div>
                        
                    </div>
                    <!-- /.card-header -->


                    <div class="card-body">

                        <table id="example" class="table table-striped table-bordered example" style="width:100%">
                            
                            <thead>
                            
                                <tr>
                                    <th>Sl No</th>
                                    <th>Employee Code</th>
                                    <th>Employee Name</th>
                                    <th>Login Time</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; if($lateComersReportLog): ?>
                                <?php foreach($lateComersReportLog as $row): ?>
                                <tr>
                                    
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['UserId']; ?><input type="hidden" id="UserId" value="<?php echo $row['UserId']; ?>" ></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['FirstLogin']; ?></td>
                                        
                                </tr>
                                <?php endforeach; ?> 
                            <?php endif; ?>
                                
                           
                            <?php $i=1; if($searchedEmpLCReport): ?>
                                <?php foreach($searchedEmpLCReport as $row): ?>
                                <tr>
                                    
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['UserId']; ?><input type="hidden" id="UserId" value="<?php echo $row['UserId']; ?>" ></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['FirstLogin']; ?></td>
                                        
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

<script>

function datefilter()
{
    // var empid=document.getElementById("UserId").value;
    var empid="";
    // alert(empid);
    var daterange = document.getElementById("reportrange").value;
    var temp1 = daterange.split('-').pop();
    var	dateString1 = temp1.replaceAll('/', "-");	
    var todateid = moment(dateString1).format('YYYY-MM-DD');	
  
	var temp2 = daterange.slice(0,10);
	var	dateString2 = temp2.replaceAll('/', "-");
	var fromdateid = moment(dateString2).format('YYYY-MM-DD');
    window.location.href = 'lcreport?&empId='+empid+'&fdate='+fromdateid+'&todate='+todateid;
}
</script>


<?= $this->endSection() ?>

