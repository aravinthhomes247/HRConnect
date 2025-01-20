<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?> 

<style>
    .user-block b {
    float: left;
    height: 40px;
    width: 40px;
    }

    .name-circle {
        border-radius: 50%;
    }
    .name-bordered-sm {
        border: 2px solid #6e7d83;
        padding: 2px;
        background-color: #e5652e;
        text-align: center;
        font-size: 20px;
        color: #ffffff;
    }
    b {
        vertical-align: middle;
        border-style: none;
    }




    td span{
        display:inline-block;
        width:555px;
        white-space: nowrap;
        overflow:hidden !important;
        text-overflow: ellipsis;
    }

    .user-block span{
        display:inline-block;
        width:200px;
        white-space: nowrap;
        overflow:hidden !important;
        text-overflow: ellipsis;
    }

    @media screen and (max-height: 450px) {
    /* .sidenav {padding-top: 15px;} */
    /* .sidenav a {font-size: 18px;} */
    }



</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card card-orange card-outline">
                    <div class="card-header">
                        <?php
                            $fdate=date("Y-m-d");
                            $todate=date("Y-m-d");
                        ?>
                        <h3 class="card-title"> Subject : <?= $empleaveRequest[0]['LeaveReason']; ?></h3>
                        <div class="card-tools">
                            <a  href="<?php  echo site_url('/leaveRequest?&fdate='.$fdate.'&todate='.$todate.'&trickid=1') ?>" class="btn btn-default"><i class="fas fa-reply"></i> Back </a>
                        </div>               
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                        <div class="mailbox-read-info">
                            <h5><?= $empleaveRequest[0]['EmployeeName']; ?></h5>
                            <h6>Designation: <?= $empleaveRequest[0]['designations']; ?>
                            <span class="mailbox-read-time float-right"><?php echo $empleaveRequest[0]['createdAt']; ?></span></h6>
                        </div>
                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message">
                            <p>Leave Request  Date: <?php echo $empleaveRequest[0]['absentDate']; ?></p>
                            <p><?php echo $empleaveRequest[0]['Reason']; ?></p>
                            
                        </div>
                        <!-- /.mailbox-read-message -->
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
                        
                                <textarea class="form-control " name="replyMsg" placeholder="Reply"></textarea>
                                <script>  CKEDITOR.replace('replyMsg');  </script>
                            
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

