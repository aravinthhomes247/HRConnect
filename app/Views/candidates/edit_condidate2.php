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
            <h1>Candidate Profile</h1>
          </div>
          
            <?php
                if($session->getFlashdata('candidatemsg'))
                {?>
                <div class="col-sm-6">
                   <div class="alert alert-warning bg-orange alert-dismissible fade show" role="alert">
                        <strong><?= $session->getFlashdata('candidatemsg') ?></strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php }  ?>

            
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    
                    <!-- Profile Image -->
                    <div class="card card-orange card-outline">
                        <div class="card-body box-profile">                           

                            <h3 class="profile-username text-center"><?= $candidate_details[0]['CandidateName'] ?></h3>

                            <p class="text-muted text-center"><?= $candidate_details[0]['designations'] ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"><?= $candidate_details[0]['CandidateEmail'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Mobile No</b> <a class="float-right"><?= $candidate_details[0]['CandidateContactNo'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Source</b> <a class="float-right"><?= $candidate_details[0]['SM_Name'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Interview Date</b> <a class="float-right"><?= $candidate_details[0]['InterviewDate'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Interview Status</b> <a class="float-right"><?= $candidate_details[0]['NS_Reasons']?></a>
                                </li>
                            </ul>
                            

                            <input type="hidden" name="resume_file_url" id="id_resume_file_url">
                            <section>
                                <div id="dropzone">
                                    <form class="dropzone needsclick demo-upload m-0 p-1"  action="/upload">
                                        <div class="dz-message needsclick m-0">Upload Resume</div>  
                                    </form>
                                </div>
                            </section>
                            <div id="preview-template" style="display: none;">
                                <div class="dz-preview dz-file-preview">
                                    <div class="dz-image"><img data-dz-thumbnail=""></div>
                                    <div class="dz-details">
                                        <div class="dz-filename"><span class="uploading">Uploading - </span><span data-dz-name=""></span></div>
                                    </div>
                                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                    <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    
                </div>
                <!-- /.col -->


                <div class="col-lg-8">
                    <div class="card card-orange card-outline">                                            
                        <div class="card-header">
                            <h3 class="profile-username ">Candidate On Interview Day</h3>
                            <div  style="padding: 5px 10px 8px 4px;">                                    
                                <input type="radio"  name="scheduled" class="yshow" /> Arrived 
                                <input type="radio"  name="scheduled" class="zshow" /> Re-Schedule
                                <input type="radio"  name="scheduled" class="xshow" /> Cancel 
                            </div> 
                        </div>
                        <?php if(($candidate_details[0]['ScheduleStatus'] == 1 )){?>

                        <div class="arrived">
                            <form action="<?= site_url('/update_candidateArrived') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                            <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                            <input type="hidden" name="CandidateName" value="<?= $candidate_details[0]['CandidateName'] ?>">

                            
                            <input type="hidden"  name="scheduled" value="10"/>

                            <input type="hidden" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate"data-target="#reservationdatetime" placeholder="Interview Date" value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                            <div class="card-body" >                                
                                <div class="form-row">
                                    <div class="col-lg-12 mt-2">
                                        Residing Location: <textarea class="form-control" placeholder="Residing Location"
                                            name="CandidateLocation" required ><?= $candidate_details[0]['CandidateLocation'] ?></textarea>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        Education: <input type="text" class="form-control" name="CandidateEducation" value="<?php echo $candidate_details[0]['CandidateEducation']; ?>" placeholder="Education Qualification" required>
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                        Experience:<select class="form-control" name="exp" id="type">
                                                        <option value="1" id="fresher">Fresher</option>
                                                        <option value="2" id="experience">Experienced</option>
                                                    </select>
                                    </div>
                                    <div class="col-lg-3 mt-2" id="totalExp">
                                        Total Experience: <input type="number" class="form-control" name="TotalExperience" value="<?php echo $candidate_details[0]['TotalExperience']; ?>" placeholder="Years/Months">
                                    </div>
                                    <div class="col-lg-6 mt-2" id="lastComp">
                                        Last Company:<input type="text" class="form-control" name="LastCompany"
                                            value="<?php echo $candidate_details[0]['LastCompany']; ?>"
                                            placeholder="Last Company">
                                    </div>
                                    <div class="col-lg-3 mt-2" id="NoticeP">
                                        Notice Peroid: <input type="number" class="form-control" name="NoticePeroid" value="<?php echo $candidate_details[0]['NoticePeroid']; ?>" placeholder="Notice Peroid">
                                    </div>
                                    <div class="col-lg-3 mt-2" id="CurrCTC">
                                        Current CTC:<input type="number" class="form-control" name="CandidateCurrentCTC"
                                            value="<?php echo $candidate_details[0]['CandidateCurrentCTC']; ?>"
                                            placeholder="Current CTC">
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                        Expected CTC:<input type="number" class="form-control" name="CandidateExpectedCTC"
                                            value="<?php echo $candidate_details[0]['CandidateExpectedCTC']; ?>"
                                            placeholder="Expected CTC" required>
                                    </div>
                                    
                                    <div class="col-lg-3 mt-2" >
                                        Immediate Joiner: 
                                        <div class="form-group" style="padding: 5px 10px 8px 4px;">
                                            
                                            <input type="radio"  name="ImmediateJoiner" class="yshow" value="Yes" <?php if($candidate_details[0]['ImmediateJoiner']=='Yes'){ echo "checked"; } ?>/> Yes
                                            <input type="radio"  name="ImmediateJoiner" class="yshow ashow" value="No" <?php if($candidate_details[0]['ImmediateJoiner']=='No'){ echo "checked"; } ?>/> No
                                        </div>
                                    </div>                               
                                    <div class="col-lg-3 mt-2 joingdays" >
                                        Days Required to Join: 
                                        <div class="form-group" >                                            
                                            <input type="text" class="form-control" name="DaysRequired" placeholder="Days Required" value="<?= $candidate_details[0]['DaysRequired'] ?>" /> 
                                        </div>
                                    </div>                               
                                </div>
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-sm bg-orange float-right" onclick="return myFunction()">Start Process</button>
                            </div>
                            </form>
                        </div>
                        <div class="reschedule">
                            <form action="<?= site_url('/update_candidate_reschedule') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                            <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                            <!-- <input type="file" name="CandidateResume"  id="file" style="visibility: hidden" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"> -->
                            <input type="hidden"  name="scheduled" value="1"/>

                            <input type="hidden" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate"data-target="#reservationdatetime" placeholder="Interview Date" value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                            <div class="card-body" >      
                                <div class="form-row">                                
                                    <div class="col-lg-2.5 mt-2">
                                        Interview Date:<div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate" data-target="#reservationdatetime" placeholder="Interview Date"  value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-sm bg-orange float-right">Update</button>
                            </div>
                            </form>
                            
                        </div>
                        <div class="cancel">
                            <form action="<?= site_url('/update_candidate_cancel') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                            <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                            <!-- <input type="file" name="CandidateResume"  id="file" style="visibility: hidden" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"> -->
                            <input type="hidden"  name="scheduled" value="1"/>

                            <input type="hidden" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate"data-target="#reservationdatetime" placeholder="Interview Date" value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                            
                            <div class="card-body ">
                                <div class="form-group" style="display: flex; flex-wrap: wrap;justify-content: center;">
                                    <?php if($notScheduleReasons){
                                        foreach ($notScheduleReasons as $row ) {?>
                                        <b class="canelradio"> <input class="xshow " type="radio"  value="<?php echo $row["NS_IDPK"] ?>" name="scheduled" > <?php echo $row["NS_Reasons"] ?> &nbsp;&nbsp;&nbsp; </b>
                                    <?php } }?>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-sm bg-orange float-right">Update</button>
                            </div>
                            </form>
                        </div>


                        <?php } elseif(($candidate_details[0]['ScheduleStatus'] >= 2) && ($candidate_details[0]['ScheduleStatus'] != 10)){?>
                            
                        <form action="<?= site_url('/update_candidate_cancel') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                        <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                        <!-- <input type="file" name="CandidateResume"  id="file" style="visibility: hidden" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"> -->
                        <input type="hidden"  name="scheduled" Value="1"/>

                        <input type="hidden" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate"data-target="#reservationdatetime" placeholder="Interview Date" value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                        
                        <div class="reschedule">
                            <div class="card-body" >
                                <div class="form-row">
                                    
                                    <div class="col-lg-2.5 mt-2">
                                        Interview Date:<div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate" data-target="#reservationdatetime" placeholder="Interview Date"  value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                                        </div>
                                        
                                    </div> 
                                </div>
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-sm bg-orange float-right">Update</button>
                            </div>
                            </form>
                        </div>
                        <div class="cancel">
                            <form action="<?= site_url('/update_candidate_cancel') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                            <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                            <!-- <input type="file" name="CandidateResume"  id="file" style="visibility: hidden" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"> -->
                            <input type="hidden"  name="scheduled" Value="1"/>

                            <input type="hidden" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="InterviewDate"data-target="#reservationdatetime" placeholder="Interview Date" value="<?php echo $candidate_details[0]['InterviewDate']; ?>" />
                        
                            <div class="card-body ">
                                <div class="form-group" style="display: flex; flex-wrap: wrap;justify-content: center;">
                                    <?php if($notScheduleReasons){
                                        foreach ($notScheduleReasons as $row ) {?>
                                        <b class="canelradio"> <input class="xshow " type="radio"  value="<?php echo $row["NS_IDPK"] ?>" name="scheduled" > <?php echo $row["NS_Reasons"] ?> &nbsp;&nbsp;&nbsp; </b>
                                    <?php } }?>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-sm bg-orange float-right">Update</button>
                            </div>
                            </form>
                        </div>
                        <!-- <div class="card-footer ">
                            <button type="submit" class="btn btn-sm bg-orange float-right">Update</button>
                        </div>
                        </form> -->
                        
                            <?php } ?>
 
                            
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



<style>
    
    .dropzone {
        background: white;
        border-radius: 5px;
        max-width: 500px;
        margin:50px  auto;
        padding: 0 0;
        height: auto;
        min-height: 0px !important;
        /* min-height: 50px; */
    }
    


    /* Custom css */
    .dropzone.dz-clickable{
        cursor: pointer;
        background: #e5652e;
        color: #fff;
        font-weight: 700;
        letter-spacing: 1px;
        font-family: 'Roboto', sans-serif;
        border:1px solid #e5652e;
        border-radius: 3px;
    }
    .dropzone .camera-img{
        display: inline-block;
        width: 20px;
        height: 20px;
        margin: 0 15px;
        position: absolute;
        left: 0;
    }
    .dropzone .img-circle{position: relative;display: inline-block;padding-left: 45px;}
    .dropzone .camera-img img{
        width: 100%;
        height: 100%;
        display: block;
    }
    .dropzone .dz-preview .dz-details .dz-filename:hover span{
        border: 1px solid transparent; 
    }
    .dropzone .dz-message{margin: 15px;}
    .dropzone .dz-preview .dz-details .dz-size{display: none;}
    .dropzone .dz-preview .dz-details{
        height: 50px;
        min-height: 50px;
        padding:0;
        padding-left: 25px;
        text-align: left;
        display: flex;
        align-items: center;
        opacity: 1;
        justify-content: space-between;
    }

    /* .dropzone .dz-preview .dz-progress {
        opacity: 1;
        z-index: 1000;
        pointer-events: none;
        position: absolute;
        height: 0px !important;
        left: 0% !important;
        top: 0% !important;
        margin-top: 0px !important;
        width:0px !important;
        margin-left: 0px !important;
        background: rgba(255, 255, 255, 0.9);
        -webkit-transform: scale(1);
        border-radius: 8px;
        overflow: hidden;
    } */



    .dropzone .dz-preview.image__open .dz-details{
        padding-left: 55px;
    }
    .dropzone .dz-preview{width: 100%;height: 50px;min-height: 50px;margin: 0;}
    .dropzone .dz-preview .dz-progress{
        left: -1px;
        right: -1px;
        margin: 0;
        top: -5px;
        height: 5px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        width: auto;
    }
    .dropzone .dz-preview .dz-image{
        height: 50px;
        width: 50px;
        border-radius: 0 !important;
        display: none;
    }
    .dropzone .dz-preview .dz-details .dz-filename{display:flex;}
    .dropzone .dz-preview:hover .dz-image img{
        -webkit-transform:none;
        -moz-transform:none;
        -ms-transform:none;
        -o-transform:none;
        transform:none; 
        -webkit-filter: none; 
        filter: none; 
    }
    .dropzone .dz-preview .dz-image img{
        height: 100%;
        width: 100%;
    }
    .dropzone .dz-preview .dz-progress .dz-upload{
        background: #396E90;   
    }
    .dropzone .dz-preview .dz-error-message{
        top: auto;
        left: 0;
        background: linear-gradient(to bottom, #ff0000, #ff0000);
        background: #ff0000;
    }
    .dropzone .dz-preview .dz-error-message:after{
        border-bottom: 6px solid #ff0000;
    }
    .dropzone .dz-preview .dz-remove{
        /* color: #396E90; */
        
        color: #fff !important;
        text-decoration: none;
        padding: 0 25px;
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        z-index: 999999;
    }
    .dropzone .dz-preview .dz-remove:hover{
        text-decoration: none;
    }
    .dropzone .dz-preview.image__open .dz-image{display: block;}
    .dropzone .dz-preview.image__open .uploading{display: none;}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>

<script>
    var dropzone = new Dropzone('.demo-upload', {
  url: "/upload/",      
  maxFilesize: 2,
  addRemoveLinks: true,
  acceptedFiles: ".pdf",
  previewTemplate: document.querySelector('#preview-template').innerHTML,
  parallelUploads: 2,
  thumbnailHeight: 50,
  thumbnailWidth: 50,
  maxFilesize: 2,
  filesizeBase: 100000000000,
  success: function(file, response) {
   file.previewElement.classList.add("image__open");
 },
 thumbnail: function(file, dataUrl) {
  if (file.previewElement) {
    file.previewElement.classList.remove("dz-file-preview");
    var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
    for (var i = 0; i < images.length; i++) {
      var thumbnailElement = images[i];
      thumbnailElement.alt = file.name;
      thumbnailElement.src = dataUrl;
    }
    setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 800);
  }
}

});


// Now fake the file upload, since GitHub does not handle file uploads
// and returns a 404

var minSteps = 6,
maxSteps = 100,
timeBetweenSteps = 300,
bytesPerStep = 10000;

dropzone.uploadFiles = function(files) {
  var self = this;

  for (var i = 0; i < files.length; i++) {

    var file = files[i];
    totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

    for (var step = 0; step < totalSteps; step++) {
      var duration = timeBetweenSteps * (step + 1);
      setTimeout(function(file, totalSteps, step) {
        return function() {
          file.upload = {
            progress: 100 * (step + 1) / totalSteps,
            total: file.size,
            bytesSent: (step + 1) * file.size / totalSteps
          };

          self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
          if (file.upload.progress == 100) {
            file.status = Dropzone.SUCCESS;
            self.emit("success", file, 'success', null);
            self.emit("complete", file);
            self.processQueue();
          }
        };
      }(file, totalSteps, step), duration);
    }
  }
}
</script>





<!-- <style>
    .progress {
        display: none;
        position: relative;
        margin: 20px 0 0 0;
        /* width: 425px;
        background-color: #ddd;
        border: 1px solid blue;
        padding: 1px;
        left: 40px; */
        border-radius: 3px;
    }
    .percent {
        position: absolute;
        display: inline-block;
        color: #fff;
        font-weight: bold;
        top: 100%;
        left: 50%;
        margin-top: -9px;
        margin-left: -20px;
        -webkit-border-radius: 4px;
    }
    .bar {
        background-color: #409f61;
        width: 0%;
        height: 30px;
        border-radius: 4px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
    }
    
    #status{
        margin: 20px;
        color:#008000;
        font-size:16px;
    }
 
</style>

<script type="text/javascript">
    $(document).ready(function () {
        // $('#customFileId').click(function () {
            
    
        $('#uploadForm').ajaxForm({
            alert("hi");
            target: '#status',
            url: '<?= site_url('updateResume') ?>',
            type: 'post',
            dataType: "json",
            beforeSend: function() 
            {
                alert("hi");
                $("#status").hide();
                $(".progress").css("display", "block");
                var percentVal = '0%';
                $('.bar').width(percentVal);
                $('.percent').html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) 
            {
                var percentVal = percentComplete + '%';
                $('.bar').width(percentVal);
                $('.percent').html(percentVal);
            },
            complete: function(xhr) {
            $('.bar').width("100%");
            $('.percent').html("100%");
                $("#status").show();
                $("#status").html(xhr.responseText);
            }
        }); 
        // });
    });
 
</script> -->


<style>
    .canelradio{
        border-radius: 3px;
        padding: 10px;
        margin: 3px;
        color: #000;
    }

    .swal2-popup.swal2-toast .swal2-title {
        margin: 10px !important;
        color: #6c757d;
    }


    /* #myProgress {
        width: 80%;
        background-color: #ddd;
        float:left;
        border-radius: 10px;
    }
    #mytick {
        width: 18%;
        margin-top: -26px;
        float: right;
        font-size: 30px;
        color: #369317;
    }
    #progresstick {
        width: 18%;
        margin-top: -26px;
        float: right;
        font-size: 30px;
        color: #979595;
    }

    #myBar {
        width: 100%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    }
    #progressBar {
        width: 1%;
        height: 5px;
        background-color: #369317;
        border-radius: 10px;
    } */
</style>


<!-- <script>
    function myFunction(){
        let filecheck = document.getElementById("file").value;
        if(filecheck == '')
        {        
            Swal.fire({
                timer: 3000,
                icon: 'info',
                // toast: true,
                // position: 'top-end',
                title:'Please Select The Resume',
                showConfirmButton: false,

            })
            return false;

        }
    }

</script> -->

<!-- Resume file size and limit  -->
<!-- <script>
    var uploadField = document.getElementById("file");
    uploadField.onchange = function() {
        if (this.files[0].size > 1520555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("filelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("filelimit").innerHTML = "";
            }, 5000);
        };

    };

    var myfile="";

    $('#resume_link').click(function( e ) {
        e.preventDefault();
        $('#file').trigger('click');
    });

    $('#file').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="docx" || ext=="doc"){
        //    alert(ext);
    } else{
            ftype = "File Size is more than 1.5MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("filelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("filelimit").innerHTML = "";
            }, 5000);
    }
    });
</script> -->

<!-- <script>
    var uploadField = document.getElementById("file");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size or Type is not Vaild";
            this.value = "";
            document.getElementById("filelimit").innerHTML = limits;
            setTimeout(function() {
                document.getElementById("filelimit").innerHTML = "";
            }, 5000);
        };
        
    };

    var myfile="";
    $('#resume_link').click(function( e ) {
        e.preventDefault();
        $('#file').trigger('click');
    });

    $('#file').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="pdf" || ext=="docx" || ext=="doc"){
        //    alert(ext);
        var i = 0;
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("progressBar");
            var width = 1;
            var id = setInterval(frame, 10);
            function frame() {
            if (width >= 100) {
                clearInterval(id);
                i = 0;
            } else {
                width++;
                elem.style.width = width + "%";
                if(width == 100){
                    document.getElementById("progresstick").style.color = "#369317";
                }
                
            }
        }
            
        }
        
    } else{
            ftype = "File Size is more than 2MB or File Type is not Vaild ";
            this.value = "";
            document.getElementById("filelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("filelimit").innerHTML = "";

            }, 5000);
    }
    });
</script> -->

<script>
    $(function() {
        $('#totalExp').hide(); 
        $('#lastComp').hide(); 
        $('#NoticeP').hide(); 
        $('#CurrCTC').hide(); 

        $('#type').change(function(){
            if($('#type').val() == 2) {
                $('#totalExp').show(); 
                $('#lastComp').show(); 
                $('#NoticeP').show(); 
                $('#CurrCTC').show(); 
            } else {
                $('#totalExp').hide(); 
                $('#lastComp').hide(); 
                $('#NoticeP').hide(); 
                $('#CurrCTC').hide(); 
            } 
        });
    });


    $(".cancel").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('xshow');
        $(".cancel").toggle(isChecked && isShow);
    });

    $(".arrived").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('yshow');
        $(".arrived").toggle(isChecked && isShow);
    });

    $(".reschedule").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('zshow');
        $(".reschedule").toggle(isChecked && isShow);
    });
    $(".joingdays").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('ashow');
        $(".joingdays").toggle(isChecked && isShow);
    });
</script>


<?= $this->endSection() ?>