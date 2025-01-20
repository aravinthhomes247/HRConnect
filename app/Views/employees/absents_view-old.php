<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?>

<style>
    .activeclass{
        background-color: #0b3544 !important;
        border-color: #0b3544 !important;
        background-image:none;
        border-radius: 5px !important;
    }
    
  
</style>
<?php
      if(isset($_SESSION['msg'])){
         echo $_SESSION['msg'];
         }
      ?>
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
                    <div class="col-6 ">
                        <a href="<?php  echo site_url('/absents?&LRID=0&fdate='.$fdate.'&todate='.$todate.'&trickid=1') ?>" class="btn bg-orange">Absent List  <span class="badge badge-light"><?= $absent ?></span></a> 
                        <a href="<?php  echo site_url('/absents?&LRID=0&fdate='.$fdate.'&todate='.$todate.'&trickid=2') ?>" class="btn bg-orange">Updated  <span class="badge badge-light"><?= $countFilter[0]['updeated'] ?></span></a> 
                        <a href="<?php  echo site_url('/absents?&LRID=0&fdate='.$fdate.'&todate='.$todate.'&trickid=3') ?>" class="btn bg-orange">Pending  <span class="badge badge-light"><?= $countFilter[0]['pending'] ?></span></a>
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
                                    <a class="btn bg-orange" onclick="datefilter()">Check</a>
                                </div>
                            </div>
                            <div class="form-group ml-2">
                                <a href="<?php echo site_url('/absents?&LRID=0&fdate='.$fdate.'&todate='.$todate.'&trickid=1') ?>" class=" btn bg-orange " >
                                <i class="fa-solid fa-arrows-rotate"></i>
                                </a>
                            </div>
                            <div class="form-group ml-2">
                                <a type="button" class=" btn bg-orange toastsDefaultInfo" data-toggle="modal" data-target="#modal-sm">
                                    <i class="fas fa-download"></i>
                                    </a>
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
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive ">
               
               <table class="table  table-striped table-hover " id="absentstable">
                  <thead>
                     <tr>
                        <th>Sl No</th>
                        <th>EmployeeCode</th>
                        <th>EmployeeName</th>
                        <th>Leave Date</th>
                        <th>
                            <select class="Search btn btn-sm" style="font-weight: 800;" id="LRID">
                                <option value="0"> Select Reason</option>
                                    <?php
                                    if($selectReason){
                                        foreach ($selectReason as $row) {?>
                                        <option  value="<?php echo $row["IDPK"] ?>" <?php if($LRID==$row['IDPK']){ echo "selected"; } ?>><?php echo $row["LeaveReason"] ?> </option>
                                        <?php
                                        } }?>
                            </select>   
                            
                        </th>
                        <th>Action</th>
                        <!-- <th>LeaveReason</th> -->
                        
                        
                     </tr>
                  </thead>
                  <tbody>
                     
                     <?php $i=1; if($absentsdetailslog  ): ?>
                     <?php foreach($absentsdetailslog  as $emp): ?>
                     <tr>                        
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $emp['EmployeeCode']; ?></td>
                        <td><?php echo $emp['EmployeeName']; ?></td>
                        <td><?php echo $emp['AbsentDate']; ?></td> 
                        <td><?php echo $emp['Reason']; ?></td>                                                 
                        <td>
                            <?php if($emp['Reason'] ==NULL)   {
                                ?>
                            <a href="<?php echo base_url('addReason/'.$emp['EmployeeId']).'/'.$emp['AbsentDate'];?>" class=" btn-orange" title="AddReason"> <i class="fa-solid fa-square-plus " style="font-size: 2rem;"></i></a>

                                <?php
                            }   else{
                                ?>

                                <a href="<?php echo base_url('leaveHistory/'.$emp['EmployeeId'].'/'.$emp['AbsentDate']);?>" class=" btn-orange" title="EditReason"> <i class="fa-solid fa-square-pen" style="font-size: 2rem;"></i></a>
                                <?php
                            }   ?>
                                
                        </td>      
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
        // var id = document.getElementByI0d('id').value;
        var LRID = document.getElementById('LRID').value;
        var trickid = document.getElementById('trickid').value;
        var daterange = document.getElementById("reportrange").value;
        var temp1 = daterange.split('-').pop();
        var	dateString1 = temp1.replaceAll('/', "-");	
        var todateid = moment(dateString1).format('YYYY-MM-DD');	
        var temp2 = daterange.slice(0,10);
        var	dateString2 = temp2.replaceAll('/', "-");
        var fromdateid = moment(dateString2).format('YYYY-MM-DD');
        // alert(id);
        window.location.href = 'absents?LRID='+LRID+'&fdate='+fromdateid+'&todate='+todateid+'&trickid='+trickid;
    
    }

    
</script>

<script>
    $('#LRID').change(function (){
        var LRID = document.getElementById('LRID').value;
        var trickid = document.getElementById('trickid').value;
        var fromdate = document.getElementById('fdate').value;
        var todate = document.getElementById('todate').value;
        // alert(LRID);
        window.location.href = 'absents?LRID='+LRID+'&fdate='+fromdate+'&todate='+todate+'&trickid='+trickid;
    });
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
 
<script>
   $(document).ready(function () {
    // var count = table.data().count()-1;
    var table = $('#absentstable').DataTable({
            "paging": true,
            "info": true,
            buttons: [
                {
                    extend: 'excel'
                },
                {
                  extend: 'pdfHtml5', 
                  title: ' ',
                  footer:true,
                  customize: function ( doc ) {
                      doc.content.splice( 1, 0, {
                          margin: [ 0, 0, 0, 12 ],
                          width:90,
                          alignment: 'center',
                          image: 'data:image/png;base64,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'
                          
                      } ,
                      {
                          text: 'HM Towers,5th Floor, East Wing, \n #58,Brigade Road, Bengaluru, 560001 \n ', alignment: 'center', bold: true, width: 'auto'
                          //, margin: [0, 10, 0, 0]
                      });
                      doc['footer']=(function(page, pages) {
                        return {
                            columns: [
                                '	© Homes247.in',  
                                {
                                    // This is the right column
                                    alignment: 'right',
                                    text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                                }
                            ],
                            margin: [30, 10]
                        }
                    });
                  }
                },
            ],
            // initComplete: function () {
            //     this.api().columns(4).every(function () {
            //         var Reason = this;
            //         var select = $('<select class="Search btn btn-sm" style="font-weight: 800;"><option value=""> Reason</option></select>')
            //             .appendTo($(Reason.header()))
            //             .on('change', function () {
            //                 var val = $.fn.dataTable.util.escapeRegex(
            //                     $(this).val()
            //                 );
            //                 Reason
            //                     .search(val ? '^' + val + '$' : '', true, false)
            //                     .draw();
            //             });
            //         Reason.data().unique().sort().each(function (d, j) {
            //             select.append('<option value="' + d + '">' + d + '</option>')
            //         });
            //     });
            // }
            
        });
        $('.button_export_excel').click(() => {
            $('#absentstable').DataTable().buttons(0,0).trigger()
        })
        $('.button_export_pdf').click(() => {
            $('#absentstable').DataTable().buttons(0,1).trigger()
        });
        
        $('.Search').change(function () {               
            if ($("#absentstable > tbody > tr > td").length == 1) {
                $('#count').empty();

                $('#count').append('0' );;
            } else {
                $('#count').empty();
                $('#count').append(' ' + $("#absentstable > tbody > tr").length);
            }
        });
    });
</script>



<?= $this->endSection() ?>

