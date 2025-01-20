<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?> 
<style>
    .activeclass{
        background-color: #0b3544 !important;
        border-color: #0b3544 !important;
        background-image:none;
    }
    
  
</style>

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
                    <div class="col-9" >
                        <a href="<?php  echo site_url('/totalEmps?&trickid=1') ?>" class="btn bg-orange">Active <span class="badge badge-light"><?= $active[0]['active'] ?></span></a> 
                        <a href="<?php  echo site_url('/totalEmps?&trickid=2') ?>" class="btn bg-orange">InActive  <span class="badge badge-light"><?=$inactive[0]['inactive']?></span></a> 
                        <a href="<?php  echo site_url('/totalEmps?&trickid=4') ?>" class="btn bg-orange">Abscond  <span class="badge badge-light"><?=$abscond[0]['abscond']?></span></a> 
                        <a href="<?php  echo site_url('/totalEmps?&trickid=3') ?>" class="btn bg-orange">Total Employees  <span class="badge badge-light" id="count"><?= $allEmpCount[0]['count'] ?></span></a> 
                        <!-- <h3 class="card-title ml-3">Total Employees <b id="count"></b></h3> -->
                        
                    </div>
                    <div class="col-3">
                        <div class="d-flex justify-content-end mb-2" >
                        <a href="<?php echo site_url('/add_emp') ?>" class="btn bg-orange mb-2">Add NewEmployee</a>
                    </div>

                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
               
               <table class="table  table-striped table-hover  " id="examp1">
                  <thead>
                     <tr>
                        
                        <th>Sl no</th>
                        <th>EmployeeName</th>
                        <th>EmployeeCode</th>                        
                        <th id="gender"> </th>
                        <th id="designations"></th>
                        <th id="roles"></th>
                        
                        
                     </tr> 
                  </thead> 
                  <tbody>
                     <?php $i=1; if($allEmpsList): ?>
                     <?php foreach($allEmpsList as $emp): ?>
                     <tr>
                        
                        <td><?php echo $i++; ?></td>
                        <td><a href="<?php echo base_url('editEmp-view/'.$emp['EmployeeId']);?>" ><?php echo $emp['EmployeeName']; ?></a>
                            <div id="progress-bar">
                                <ol id="progress-steps">
                                    <?php if($emp['DVStatus']==2){?> 
                                        <li class="progress-step" style="width: 25%;" >
                                            <a title="Documents Verified"><span class="count highlight-index"></span></a>
                                        </li>
                                    <?php }else{?>
                                        <li class="progress-step" style="width: 25%;" >
                                            <a title="Documents Verified"><span class="count"></span></a>
                                        </li>
                                    <?php } ?>
                                    <?php if(!empty($emp['OfferLetterImage'])){?>
                                        <li class="progress-step" style="width: 25%;">
                                            <a title="Offer letter"><span class="count highlight-index"></span></a>
                                        </li>
                                    <?php } else { ?>
                                        <li class="progress-step" style="width: 25%;">
                                            <a title="Offer letter"><span class="count "></span></a>
                                        </li>
                                    <?php } ?>
                                    <?php if(!empty($emp['INT_CON_Letter'])){?>
                                        <li class="progress-step" style="width: 25%;">
                                            <a title="Intern/Contract Letter"><span class="count highlight-index"></span></a>
                                        </li>
                                    <?php }else{ ?>
                                        <li class="progress-step" style="width: 25%;">
                                            <a title="Intern/Contract Letter"><span class="count "></span></a>
                                        </li>
                                    <?php } ?>
                                    <?php if(!empty($emp['EmployeeIDFK'])){?>
                                        <li class="progress-step" style="width: 25%;">
                                            <a title="Bank Details"><span class="count highlight-index"></span></a>
                                        </li>
                                    <?php }else{ ?>
                                        <li class="progress-step" style="width: 25%;">
                                            <a title="Bank Details"><span class="count "></span></a>
                                        </li>
                                    <?php } ?>
                                </ol>
                            </div>


                        </td>
                        <td><?php echo $emp['EmployeeCode']; ?></td>                        
                        <td><?php echo $emp['Gender']; ?></td>                       
                        <td><?php echo $emp['designations'] ?></td>
                        <td><?php echo $emp['EmployeeTypeName'] ?></td>
                        
                        
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

<style>
    /* body {
	 padding: 50px;
	 font-family: Arial, Helvetica, sans-serif;
    } */
    .off-screen {
        height: 1px;
        left: -50000px;
        overflow: hidden;
        position: absolute;
        top: 0;
        width: 1px;
    }
    #progress-bar {
        position: relative;
        padding-top: 5px;
        margin: 0.5em 0em;
        color: #4d483f;
        font-family: Arial, Helvetica, sans-serif;
    }
    #progress-bar #progress-steps {
        height: 4px;
        width: 100%;
        margin: 0;
        padding: 0;
        display: block;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        -o-border-radius: 4px;
        border-radius: 4px;
        background-color: #0b3544;
        position: relative;
        list-style-type: none;
        counter-reset: item;
    }
    #progress-bar .progress-step {
        width: 16.66%;
        /* height: 8px; */
        height: 4px;
        /* width: 80%; */
        float: left;
        margin: 0;
        padding: 0;
        position: relative;
    }
    #progress-bar .count:before {
        content: "\2713";
        /* counter-increment: item; */
        display: block;
        width: 20px;
        height: 20px;
        background-color: #0b3544;
        color: #fff;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        -o-border-radius: 50%;
        border-radius: 50%;
        position: absolute;
        /* right: 0px; */
        top: -8px;
        padding: 1px 0 0 5px;
        font-size: 12px;
        font-weight: bold;
        z-index: 999;
    }
    #progress-bar .highlight-index:before {
        background-color: #e5652e;
        color: #fff;
    }
    #progress-bar .highlight-index {
        background-color: #e5652e;
        display: block;
        height: 100%;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        -o-border-radius: 4px;
        border-radius: 4px;
    }
    
    
    #progress-bar .bolded-step {
        font-weight: normal !important;
    }
    #progress-bar #progress-steps a title{
        background-color: #000 !important;
    }

    
</style>


<script>
    $(document).ready(function() {
  /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('a.bg-orange ').filter(function() {
            return this.href == url;
        }).addClass('activeclass');
        
    })
</script>


<script>
   $(document).ready(function () {
        $('#examp1').DataTable({
            paging: false,
            initComplete: function () {
                this.api().columns(5).every(function () {
                    var Roles = this;
                    var select = $('<select class="Search btn btn-sm" style="font-weight: 800;"><option value=""> Roles</option></select>')
                        .appendTo($(Roles.header()))
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            Roles
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    Roles.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
                this.api().columns(4).every(function () {
                    var Designations = this;
                    var select = $('<select class="Search btn btn-sm" style="font-weight: 800;"><option value=""> Designations</option></select>')
                        .appendTo($(Designations.header()))
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            Designations
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    Designations.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
                this.api().columns(3).every(function () {
                    var Gender = this;
                    var select = $('<select class="Search btn btn-sm" style="font-weight: 800;"><option value=""> Gender</option></select>')
                        .appendTo($(Gender.header()))
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            Gender
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    Gender.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
                
            }
        });

        $('.Search').change(function () {               
            if ($("#examp1 > tbody > tr > td").length == 1) {
                $('#count').empty();

                $('#count').append('0' );;
            } else {
                $('#count').empty();
                $('#count').append(' ' + $("#examp1 > tbody > tr").length);
            }
        });
    });
</script>
<?= $this->endSection() ?>

