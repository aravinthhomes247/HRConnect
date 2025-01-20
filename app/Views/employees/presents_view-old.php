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
                <h3 class="card-title">Presenters List <b><?= $presents ?></b></h3>
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
              <div class="card-body table-responsive">
                <table id="example" class="table  table-striped table-hover ">
                  <thead>
                     <tr>
                        <th>Sl No</th>
                        <th>EmployeeId</th>
                        <th>EmployeeName</th>
                        <th>Login Time</th> 
                        <th>LogOut Time</th>                                    
                        <th>Working Time</th>
                        
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i=1; if($presentsdetailslog): ?>
                     <?php foreach($presentsdetailslog as $row): ?>
                     <tr>                         
                        <td><?= $i++; ?></td>
                        <td><?= $row['UserId']; ?></td>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['login']; ?></td>
                        <td><?= $row['logout']; ?></td>
                        <td><?= $row['workingHours']; ?></td>
                        
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
   
    var daterange = document.getElementById("reportrange").value;
    var temp1 = daterange.split('-').pop();
    var	dateString1 = temp1.replaceAll('/', "-");	
    var todateid = moment(dateString1).format('YYYY-MM-DD');	
    var temp2 = daterange.slice(0,10);
    var	dateString2 = temp2.replaceAll('/', "-");
    var fromdateid = moment(dateString2).format('YYYY-MM-DD');
    // alert(todateid);
    window.location.href = 'presents?&fdate='+fromdateid+'&todate='+todateid;
  
}
</script>

<!-- <script>
  $(document).ready( function () {
  
  var table = $('#example').DataTable({
		"order": [[ 1, "desc" ]],
		"oLanguage": {
			"sInfo": "Showing _START_ to _END_ of _TOTAL_ items."
		}
	});

    $("#example thead th").each( function ( i ) {
		
		if ($(this).text() !== '') {
	        var isStatusColumn = (($(this).text() == 'Status') ? true : false);
			var select = $('<select><option value=""></option></select>')
	            .appendTo( $(this).empty() )
	            .on( 'change', function () {
	                var val = $(this).val();
					
	                table.column( i )
	                    .search( val ? '^'+$(this).val()+'$' : val, true, false )
	                    .draw();
	            } );
	 		
			// Get the Status values a specific way since the status is a anchor/image
			if (isStatusColumn) {
				var statusItems = [];
				
                /* ### IS THERE A BETTER/SIMPLER WAY TO GET A UNIQUE ARRAY OF <TD> data-filter ATTRIBUTES? ### */
				table.column( i ).nodes().to$().each( function(d, j){
					var thisStatus = $(j).attr("data-filter");
					if($.inArray(thisStatus, statusItems) === -1) statusItems.push(thisStatus);
				} );
				
				statusItems.sort();
								
				$.each( statusItems, function(i, item){
				    select.append( '<option value="'+item+'">'+item+'</option>' );
				});

			}
            // All other non-Status columns (like the example)
			else {
				table.column( i ).data().unique().sort().each( function ( d, j ) {  
					select.append( '<option value="'+d+'">'+d+'</option>' );
		        } );	
			}
	        
		}
    } );
  
  
  
  
} );

</script> -->


<?= $this->endSection() ?>

