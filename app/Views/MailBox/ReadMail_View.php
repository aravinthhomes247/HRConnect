<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header") ?>



<?= $this->section("body") ?> 

<div class="content-wrapper">
    <input type="hidden" name="trickid" id="trickid" value="<?= $trickid ?>">
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
                    <button class="btn bg-orange" >Check</button>
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
          <a href="<?php echo base_url('/mailBox?&fdate='.$fdate.'&todate='.$todate.'&trickid=1')?>" class="btn bg-orange btn-block mb-3">Back to Inbox</a>

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
                  <a href="<?php echo base_url('/mailBox?&fdate='.$fdate.'&todate='.$todate.'&trickid=1')?>" class="nav-link link1">
                    <i class="fas fa-inbox"></i> Inbox
                    <!-- <span class="badge bg-orange float-right" data-card-widget="collapse1">12</span> -->
                  </a>
                  
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('/mailBox?&fdate='.$fdate.'&todate='.$todate.'&trickid=3')?>" class="nav-link link1">
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
                        <?php
                            $fdate=date("Y-m-d");
                            $todate=date("Y-m-d");
                        ?>
                        <h3 class="card-title"> Subject : <?= $empleaveRequest[0]['LeaveReason']; ?></h3>
                        <div class="card-tools">
                            <a  href="<?php  echo site_url('/mailBox?&fdate='.$fdate.'&todate='.$todate.'&trickid=1') ?>" class="btn btn-default"><i class="fas fa-reply"></i> Back </a>
                        </div>               
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                        <div class="mailbox-read-info">
                            <h5><?= $empleaveRequest[0]['EmployeeName']; ?></h5>
                            <h6>Designation: <?= $empleaveRequest[0]['designations']; ?>
                            <span class="mailbox-read-time float-right"><?php echo $empleaveRequest[0]['createdAt']; ?></span></h6>
                        </div>
                        <div class="mailbox-read-message">
                            <p>Leave Request  Date: <?php echo $empleaveRequest[0]['absentDate']; ?></p>
                            <p><?php echo $empleaveRequest[0]['Reason']; ?></p>                            
                        </div>
                    </div>
                    <?php if($empleaveRequest[0]['leaveStatus']==0){?>
                    <!-- /.card-footer -->
                    <div class="card-footer">
                        <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">  <i class="fas fa-reply"></i> Reply  </button>                                 
                        <div class=" collapse mt-1" id="collapseExample">
                            <form action="<?= site_url('/updateReply') ?>" method="POST"  >
                                <input type="text" name="IDPK" value="<?= $empleaveRequest[0]['IDPK'] ?>" >

                                <input type="text" name="Mail_Base_IDFK" value="<?= $empleaveRequest[0]['Mail_IDPK']; ?>" >
                                <input type="text" name="SenderId" value="<?= $empleaveRequest[0]['ReceiverId']; ?> " >
                                <input type="text" name="ReceiverId" value="<?= $empleaveRequest[0]['SenderId']; ?>" >
                        
                                <textarea class="form-control " name="Mail_Reply_Msg" placeholder="Reply"></textarea>
                                <script>  CKEDITOR.replace('Mail_Reply_Msg');  </script>
                            
                                <div class="btn-group mt-1 " role="group" aria-label="Basic example">                                    
                                
                                    <button type="submit" class="btn bg-orange" value="1" name="approve"><i class="fa-solid fa-check" ></i> Aprrove</button>
                                    <button type="submit" class="btn btn-danger"  value="2" name="approve"><i class="fa-solid fa-xmark"></i> Reject</button>
                                </div>
                            </form>
                        </div>
                    </div> 
                    <?php
                    }elseif($empleaveRequest[0]['leaveStatus'] > 0){?>

                    
                </div>
                <!-- /.card -->
                <div class="card card-orange card-outline">
                    <div class="card-header">
                        Leave Reply:                         
                    </div>
                    <div class="card-body pt-0">
                        
                        <?php if($empleaveReply){ ?>
                                    <?php foreach($empleaveReply as $row){ ?> 
                        <div class="row border-top p-2" >
                            <div class="col-md-3 mt-1">
                               
                                <div class="user-block " >
                                    <?php
                                        if ($row['Image'] == NULL){?>

                                            <b class="name-circle name-bordered-sm text-uppercase" >
                                            <?php $str=$row['SenderName'];
                                                            $name=substr($str, 0, 1); 
                                                            print_r($name); ?>
                                                                </b>
                                            <?php
                                        }else{?>
                                            <img class="img-circle img-bordered-sm" src="<?php echo base_url('Public/Uploads/ProfilePhotosuploads/'.$row['Image']); ?>" alt="<?php echo $row['SenderName']; ?>">
                                            <?php
                                        }
                                    ?>                                        
                                    <span class="username"><a href="#"><?php echo $row['SenderName']; ?></a> </span>
                                    <span class="description"><?php echo $row['created_at']; ?></span>                                        
                                </div>
                            </div> 
                            <div class="col-md-9 mt-1">
                               <span class="align-middle"><?php echo $row['Mail_Reply_Msg']; ?></span> 
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                               
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-default float-left" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">  <i class="fas fa-reply"></i> Reply  </button>           
                                    
                        <div class=" collapse mt-5" id="collapseExample">
                        <?php $hrId= $session->get('sEmail');  ?>
                            <form action="<?= site_url('/hrReply') ?>" method="post" autocomplete="off">
                                <input type="text" name="IDPK" value="<?= $empleaveRequest[0]['IDPK'] ?>" >
                                <input type="text" name="Mail_Base_IDFK" value="<?= $empleaveRequest[0]['Mail_IDPK']; ?>" >
                                <input type="text" name="SenderId" value="<?= $empleaveRequest[0]['ReceiverId']; ?> " >
                                <input type="text" name="ReceiverId" value="<?= $empleaveRequest[0]['SenderId']; ?>" >
                                    <textarea class="form-control " name="ReplyMsg1" ></textarea>
                                    <script>  CKEDITOR.replace('ReplyMsg1');  </script>
                                
                                    <div class="btn-group mt-1 " role="group" aria-label="Basic example">                                    
                                    
                                        <button type="submit" class="btn bg-orange"><i class="fa-solid fa-paper-plane"></i> Reply</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>  
                <?php        
                }
            ?>
            </div>
          <!-- /.col -->
                                     
                
            <!-- /.card -->
        <?php } elseif($trickid == 2) {?>
            <div class="card card-orange card-outline"> 
                    <div class="card-header">
                        <h3 class="card-title">Read Sent Mail</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">   
                        <div class="mailbox-read-info">
                              <h5><?= $HRSentBox[0]['ReceiverName'] ?> </h5>  
                              <h6>Sent by : <?= $HRSentBox[0]['SenderName'] ?>
                              <span class="mailbox-read-time float-right"><?php echo $HRSentBox[0]['created_at']; ?></span></h6>
                        </div>  
                        <div class="mailbox-read-message border-top">
                           
                           <?php echo $HRSentBox[0]['Mail_Msg']; ?>
                            
                        </div>              
                    </div>
                    <!-- /.card-body -->
                    <?php if($empleaveRequest[0]['leaveStatus']==0){?>
                    <!-- /.card-footer -->
                    <!-- <div class="card-footer">
                        <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">  <i class="fas fa-reply"></i> Reply  </button>                                 
                        <div class=" collapse mt-1" id="collapseExample">
                            <form action="<?= site_url('/updateReply') ?>" method="POST"  >
                                <input type="text" name="IDPK" value="<?= $empleaveRequest[0]['IDPK'] ?>" >

                                <input type="text" name="Mail_Base_IDFK" value="<?= $empleaveRequest[0]['Mail_IDPK']; ?>" >
                                <input type="text" name="SenderId" value="<?= $empleaveRequest[0]['ReceiverId']; ?> " >
                                <input type="text" name="ReceiverId" value="<?= $empleaveRequest[0]['SenderId']; ?>" >
                        
                                <textarea class="form-control " name="replyMsg" placeholder="Reply"></textarea>
                                <script>  CKEDITOR.replace('replyMsg');  </script>
                            
                                <div class="btn-group mt-1 " role="group" aria-label="Basic example">                                    
                                
                                    <button type="submit" class="btn bg-orange" value="1" name="approve"><i class="fa-solid fa-check" ></i> Aprrove</button>
                                    <button type="submit" class="btn btn-danger"  value="2" name="approve"><i class="fa-solid fa-xmark"></i> Reject</button>
                                </div>
                            </form>
                        </div>
                    </div>  -->
                    <?php
                    }elseif($empleaveRequest[0]['leaveStatus'] > 0){?>

                    
                </div>
                <!-- /.card -->
                <div class="card card-orange card-outline">
                    <div class="card-header">
                        Leave Reply:                         
                    </div>
                    <div class="card-body">
                        
                        <?php if($empleaveReply){ ?>
                                    <?php foreach($empleaveReply as $row){ ?> 
                        <div class="row border-top p-2" >
                            <div class="col-md-3 mt-1">
                               
                                <div class="user-block " >
                                    <?php
                                        if ($row['Image'] == NULL){?>

                                            <b class="name-circle name-bordered-sm text-uppercase" >
                                            <?php $str=$row['SenderName'];
                                                            $name=substr($str, 0, 1); 
                                                            print_r($name); ?>
                                                                </b>
                                            <?php
                                        }else{?>
                                            <img class="img-circle img-bordered-sm" src="<?php echo base_url('Public/Uploads/ProfilePhotosuploads/'.$row['Image']); ?>" alt="<?php echo $row['SenderName']; ?>">
                                            <?php
                                        }
                                    ?>                                        
                                    <span class="username"><a href="#"><?php echo $row['SenderName']; ?></a> </span>
                                    <span class="description"><?php echo $row['created_at']; ?></span>                                        
                                </div>
                            </div> 
                            <div class="col-md-9 mt-1">
                               <span class="align-middle"><?php echo $row['Mail_Reply_Msg']; ?></span> 
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                               
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-default float-left" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">  <i class="fas fa-reply"></i> Reply  </button>           
                                    
                        <div class=" collapse mt-5" id="collapseExample">
                        <?php $hrId= $session->get('sEmail');  ?>
                            <form action="<?= site_url('/hrReply') ?>" method="post" autocomplete="off">
                                <input type="text" name="IDPK" value="<?= $empleaveRequest[0]['IDPK'] ?>" >
                                <input type="text" name="Mail_Base_IDFK" value="<?= $empleaveRequest[0]['Mail_IDPK']; ?>" >
                                <input type="text" name="SenderId" value="<?= $empleaveRequest[0]['ReceiverId']; ?> " >
                                <input type="text" name="ReceiverId" value="<?= $empleaveRequest[0]['SenderId']; ?>" >
                                    <textarea class="form-control " name="ReplyMsg1" ></textarea>
                                    <script>  CKEDITOR.replace('ReplyMsg1');  </script>
                                
                                    <div class="btn-group mt-1 " role="group" aria-label="Basic example">                                    
                                    
                                        <button type="submit" class="btn bg-orange"><i class="fa-solid fa-check" ></i> Reply</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>  
                <?php        
                }
            ?>
                <?php        
                }
            ?>
            </div>
          <!-- /.col -->
        
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <script>
      $(document).ready(function() {
  /** add active class and stay opened when selected */
        var url = window.location;
        // alert(url);
        // for sidebar menu entirely but not cover treeview
        $('a.link1').filter(function() {
            return this.href == url;
        }).addClass('liactiveclass');
    })
</script>

<?= $this->endSection() ?>