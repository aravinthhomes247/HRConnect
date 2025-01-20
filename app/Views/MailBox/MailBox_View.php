<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header") ?>


<?= $this->section("body") ?> 

<div class="content-wrapper"><input type="hidden" name="trickid" id="trickid" value="<?= $trickid ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-8">
            <h1>MailBox</h1>
          </div>
          <div class="col-sm-4">
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
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content ml-2 mr-2">
      <div class="row">
        <div class="col-md-3">
          <a href="<?php echo base_url('/mailBox?&fdate='.$fdate.'&todate='.$todate.'&trickid=2&deptsid=')?>" class="btn bg-orange btn-block mb-3">Compose</a>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Folders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="<?php echo base_url('/mailBox?&fdate='.$fdate.'&todate='.$todate.'&trickid=1&deptsid=')?>" class="nav-link link1">
                    <i class="fas fa-inbox"></i> Inbox
                    <!-- <span class="badge bg-orange float-right" data-card-widget="collapse1">12</span> -->
                  </a>
                  
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('/mailBox?&fdate='.$fdate.'&todate='.$todate.'&trickid=3&deptsid=')?>" class="nav-link link1">
                    <i class="far fa-envelope"></i> Sent
                  </a>
                </li>
                
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
        <?php if($trickid == 1){?>

            <div class="card card-orange card-outline">
              <div class="card-header">
                <h3 class="card-title">Inbox</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body ">              
                <div class="table-responsive mailbox-messages">
                  <table id="example" class="table table-hover " style="width:100%">  
                      <thead >                        
                          <tr>
                              <th>EmployeeName</th>
                              <th>Leave Reason</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i=1; if($leaveRequest): ?>
                          <?php foreach($leaveRequest as $row): ?>
                            <?php if($row['readStatus'] == 0) {?>
                              <tr class="read">
                            <?php }else{?>
                              <tr >                         
                            <?php } ?>
                              <td>
                                  <div class="user-block" >
                                      <?php if ($row['Image'] == NULL){?>
                                              <b class="name-circle name-bordered-sm" >
                                              <?php $str=$row['EmployeeName'];$name=substr($str, 0, 1);print_r($name); ?></b>
                                      <?php }else{ ?>
                                              <img class="img-circle img-bordered-sm" src="<?php echo base_url('Public/Uploads/ProfilePhotosuploads/'.$row['Image']); ?>" alt="<?php echo $row['EmployeeName']; ?>">
                                      <?php } ?>
                                      <span class="username"><a href="<?php  echo site_url('/ReadMail?trickid=1&mailId='.$row['Mail_IDPK']) ?>"><?php echo $row['EmployeeName']; ?></a> </span>
                                      <span class="description"><?php echo $row['createdAt']; ?></span>                                        
                                  </div>
                              </td>
                              <td><span class="wrap"><?php echo $row['LeaveReason']; ?> - <?php echo $row['Reason']; ?></span> </td>
                             
                              
                          </tr></span>
                          <?php endforeach; ?> 
                          <?php endif; ?>
                      </tbody>
                  </table>
                  <!-- /.table -->
                </div>
                <!-- /.mail-box-messages -->
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
        <?php } elseif($trickid == 2){?>
            <div class="card card-orange card-outline">
                <form method="post" action="<?= site_url('HRComposeMail') ?>" enctype="multipart/form-data" >
                
                    <div class="card-header">
                        <h3 class="card-title">Compose New Message</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-check form-check-inline">                      
                          <?php if($mailempselect[0]['DepartmentId'] == 3){?>
                            <input class="form-check-input" type="checkbox" id="depts_3" name="depts_3" value="3" checked> Accounts &nbsp;&nbsp;
                            <?php }else{?>
                            <input class="form-check-input" type="checkbox" id="depts_3" name="depts_3" value="3" > Accounts &nbsp;&nbsp;
                          <?php } ?>

                          <?php if($mailempselect[0]['DepartmentId'] == 6){?>
                            <input class="form-check-input" type="checkbox" id="depts_6" name="depts_6" value="6" checked> Backend Operations &nbsp;&nbsp;
                            <?php }else{?>
                              <input class="form-check-input" type="checkbox" id="depts_6" name="depts_6" value="6" > Backend Operations &nbsp;&nbsp;
                          <?php } ?>

                          <?php if($mailempselect[0]['DepartmentId'] == 4){?>
                            <input class="form-check-input" type="checkbox" id="depts_4" name="depts_4" value="4" checked> IT &nbsp;&nbsp;
                            <?php }else{?>
                              <input class="form-check-input" type="checkbox" id="depts_4" name="depts_4" value="4" > IT &nbsp;&nbsp;
                          <?php } ?>
                              
                          <?php if($deptsid == 'all'){?>
                            <input class="form-check-input" type="checkbox" id="depts_all" name="depts_all" value="all" checked> All &nbsp;&nbsp;
                            <?php }else{?>
                              <input class="form-check-input" type="checkbox" id="depts_all" name="depts_all" value="all" > All &nbsp;&nbsp;
                          <?php } ?>

                        </div>
                        
                        <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <?php if ( $deptsid >= 1 || $deptsid === "all") : ?>
                          <div class="form-group">
                            <?php foreach($mailempselect as $row) {?>
                              <input type="text" name="ReceiverId[]" value="<?=$row['Id'];?>" >
                            <?php }?>
                          </div> 

                        <?php elseif ($deptsid < 1) : ?>                          
                          <div class="form-group">
                            <input type="text" id="autocompleteemp"  class="form-control" placeholder = "To : ">
                            <input type="text" id="empid" name="ReceiverId[]" value='0' >
                          </div>                             
                        <?php endif; ?>
                        

                        <div class="form-group">
                            <textarea class="form-control " name="replyMsg" placeholder="Reply"></textarea>
                                <script>  CKEDITOR.replace('replyMsg');  </script>
                        </div>                
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="float-right">
                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                        </div>
                        <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        <?php } elseif($trickid == 3){?>
            <div class="card card-orange card-outline">
              <div class="card-header">
                <h3 class="card-title">Sent</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body ">              
                <div class="table-responsive mailbox-messages">
                  <table id="example" class="table table-hover " style="width:100%">  
                      <thead >                        
                          <tr>
                              <th>EmployeeName</th>
                              <th>Leave Reason</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i=1; if($HRSentBox): ?>
                          <?php foreach($HRSentBox as $row): ?>
                            
                            <tr>
                              <td>
                                  <div class="user-block" >
                                      <?php if ($row['Image'] == NULL){?>
                                              <b class="name-circle name-bordered-sm" >
                                              <?php $str=$row['ReceiverName'];
                                                              $name=substr($str, 0, 1); 
                                                              print_r($name); ?>
                                                              </b>
                                      <?php }else{ ?>
                                              <img class="img-circle img-bordered-sm" src="<?php echo base_url('Public/Uploads/ProfilePhotosuploads/'.$row['Image']); ?>" alt="<?php echo $row['ReceiverName']; ?>">
                                      <?php } ?>
                                      <span class="username"><a href="<?php  echo site_url('/ReadMail?trickid=2&mailId='.$row['Mail_IDPK']) ?>"><?php echo $row['ReceiverName']; ?></a> </span>
                                      <span class="description"><?php echo $row['created_at']; ?></span>                                        
                                  </div>
                              </td>
                              <td><span><?php echo $row['Mail_Msg']; ?></span> </td>
                             
                              
                          </tr></span>
                          <?php endforeach; ?> 
                          <?php endif; ?>
                      </tbody>
                  </table>
                  <!-- /.table -->
                </div>
                <!-- /.mail-box-messages -->
              </div>
              <!-- /.card-body -->
              
            </div>
        <?php } ?>
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script>
  $('#depts_all').click(function() {
    if($(this).is(':checked'))
    {
      var deptsid=document.getElementById("depts_all").value;          
      var fromdateid=document.getElementById("fdate").value;          
      var todateid=document.getElementById("todate").value; 
      var trickid=document.getElementById("trickid").value;    
      
        window.location.href = 'mailBox?fdate='+fromdateid+'&todate='+todateid+'&trickid='+trickid+'&deptsid='+deptsid;
      
    }
  });
  $('#depts_3').click(function() {
    if($(this).is(':checked'))
    {
      var deptsid=document.getElementById("depts_3").value;          
      var fromdateid=document.getElementById("fdate").value;          
      var todateid=document.getElementById("todate").value; 
      var trickid=document.getElementById("trickid").value;         
      // alert(deptsid);
      window.location.href = 'mailBox?fdate='+fromdateid+'&todate='+todateid+'&trickid='+trickid+'&deptsid='+deptsid;
    }
  });
  $('#depts_6').click(function() {
    if($(this).is(':checked'))
    {
      var deptsid=document.getElementById("depts_6").value;  
      var fromdateid=document.getElementById("fdate").value;          
      var todateid=document.getElementById("todate").value;   
      var trickid=document.getElementById("trickid").value;     
      // alert(deptsid);
      window.location.href = 'mailBox?fdate='+fromdateid+'&todate='+todateid+'&trickid='+trickid+'&deptsid='+deptsid;
    }
  });
  $('#depts_4').click(function() {
    if($(this).is(':checked'))
    {
      var deptsid=document.getElementById("depts_4").value; 
      var fromdateid=document.getElementById("fdate").value;          
      var todateid=document.getElementById("todate").value; 
      var trickid=document.getElementById("trickid").value;        
      // alert(deptsid);
      window.location.href = 'mailBox?fdate='+fromdateid+'&todate='+todateid+'&trickid='+trickid+'&deptsid='+deptsid;
    }
  });
</script>


<script>

function datefilter()
{
  var trickid=document.getElementById("trickid").value;
    var daterange = document.getElementById("reportrange").value;
    var temp1 = daterange.split('-').pop();
    var	dateString1 = temp1.replaceAll('/', "-");	
    var todateid = moment(dateString1).format('YYYY-MM-DD');	
	var temp2 = daterange.slice(0,10);
	var	dateString2 = temp2.replaceAll('/', "-");
	var fromdateid = moment(dateString2).format('YYYY-MM-DD');
    // alert(todateid);
    

    window.location.href = 'mailBox?fdate='+fromdateid+'&todate='+todateid+'&trickid='+trickid;
   
}
</script>



<!-- autocomplete function  -->
<script type='text/javascript'>
   $(document).ready(function(){
     // Initialize
     $( "#autocompleteemp" ).autocomplete({
        source: function( request, response ) {
           // CSRF Hash
           var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
           var csrfHash = $('.txt_csrfname').val(); // CSRF hash
           // Fetch data
           $.ajax({
              url: "<?= site_url('getemployees') ?>",
              type: 'post',
              dataType: "json",
              data: {
                 search: request.term,
                 [csrfName]: csrfHash // CSRF Token
              },
              success: function( data ) {
                 // Update CSRF Token
                 $('.txt_csrfname').val(data.token);
                 response( data.data );
              }
           });
        },
        select: function (event, ui) {
           // Set selection
           $('#autocompleteemp').val(ui.item.label); // display the selected text
           $('#empid').val(ui.item.value); // save selected id to input
           return false;
        },
        focus: function(event, ui){
          $( "#autocompleteemp" ).val( ui.item.label );
          $( "#empid" ).val( ui.item.value );
          return false;
        },
      }); 
   }); 
</script> 

<script>
      $(document).ready(function() {
  /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('a.link1').filter(function() {
            return this.href == url;
        }).addClass('liactiveclass');
    })
</script>

<?= $this->endSection() ?>