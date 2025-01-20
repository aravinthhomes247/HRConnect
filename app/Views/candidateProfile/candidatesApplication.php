<?php $session = \Config\Services::session(); ?>

<?php $this->extend("layouts/CandidateAppHeader"); ?>

<?php $this->section("body"); ?>
<?php
    //   if(isset($_SESSION['msg'])){
    //      echo $_SESSION['msg'];
    //      }

        //  $msg = $session->getFlashdata('candidatemsg');
        //  print_r($msg);
?>
        <!-- if( $session->getFlashdata('candidatemsg')) {   ?>
            <script>
                Swal.fire({
                    timer: 3000,
                    icon: 'info',
                    toast: true,
                    position: 'top-end',
                    title:'Thank you for Your Update',
                    showConfirmButton: false,
                    
                })
            </script> 
        -->
<style>
    .blink {
        animation: blinker 1.5s linear infinite;
        color: red;
        font-family: sans-serif;
    }
    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
    .font400{
        font-weight: 400 !important;
    }
</style>
        


    <section class="content-wrapper">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <marquee class="blink">Fill details carefully only once you can fill details. </marquee>
                    <div class="card">
                        <div class="card-header">
                            <label>Candidate Application   </label> 
                            <?php
                                if($session->getFlashdata('candidatemsg'))
                                {?>
                                <div class="col-sm-6 float-right">
                                <div class="alert alert-warning bg-orange alert-dismissible fade show" role="alert">
                                        <strong><?= $session->getFlashdata('candidatemsg') ?></strong> 
                                        <a href="">Start Process</a>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            <?php }  ?>                             
                        </div>
                        
                        <div class="card-body ">
                            <form action="<?= site_url('/update_candidateApplication') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data" readonly>
                                <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                
                               
                                
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label >Candidate Name</label>
                                        <input type="text" class="form-control" name="CandidateName" placeholder="Candidate Name" value="<?= $candidate_details[0]['CandidateName'] ?>" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label >Contact Number</label>
                                        <input type="number" class="form-control" name="CandidateContactNo" placeholder="Contact Number" value="<?= $candidate_details[0]['CandidateContactNo'] ?>" readonly> 
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label >Email</label>                                        
                                        <input type="email" class="form-control" name="CandidateEmail" placeholder="Email" value=" <?= $candidate_details[0]['CandidateEmail'] ?>" readonly>                                        
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label >Residing Location</label>
                                        <div class="input-group">
                                            <textarea class="form-control" aria-label="With textarea" name="CandidateLocation" placeholder="Residing Location" ><?= $candidate_details[0]['CandidateLocation'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label >Source</label>
                                        <select class="custom-select "  name="Source">
                                            <option>--Select-- </option>
                                            
                                            <?php  foreach($socialMedia as $row){ ?>
                                            <option  value="<?php echo  $row["SM_IDPK"] ?>"  
                                            <?php if($candidate_details[0]['Source']==$row["SM_IDPK"]){ echo "selected"; } ?>>
                                            <?php echo $row["SM_Name"]; ?></option>
                                            <?php }?>
                                        </select>    
                                                                            
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label >Position Applied for</label>
                                        <select class="custom-select "  name="CandidatePosition">
                                            <option>--Select-- </option>                                            
                                            <?php  foreach($selectdesignation as $row){ ?>
                                            <option  value="<?php echo  $row["IDPK"] ?>"  
                                            <?php if($candidate_details[0]['CandidatePosition']==$row["IDPK"]){ echo "selected"; } ?>>
                                            <?php echo $row["designations"]; ?></option>
                                            <?php }?>
                                        </select>  
                                                                                
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label >Education Qualification</label>                                        
                                        <input type="text" class="form-control"  name="CandidateEducation" placeholder="Education Qualification" value="<?= $candidate_details[0]['CandidateEducation'] ?>" required>
                                    </div>
                                </div>
                                
                                <div class="form-row "> 
                                    <div class="col-md-2 mb-2">                                            
                                        <label >Experience</label>
                                        <select class="custom-select" name="exp" id="type">
                                            <option value="1" id="fresher" <?php if($candidate_details[0]['CandidateExperience']=='1'){ echo "selected"; } ?>>Fresher</option>
                                            <option value="2" id="experience" <?php if($candidate_details[0]['CandidateExperience']=='2'){ echo "selected"; } ?>>Experienced</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3 Experience">
                                        <label >Total Experience</label> 
                                        <input type="text" class="form-control" name="TotalExperience" value="<?php echo $candidate_details[0]['TotalExperience']; ?>" placeholder="Total Experience" >                                     
                                    </div>
                                    <div class="col-md-5 mb-3 Experience">
                                        <label >Present/Last Company</label> 
                                        <input type="text" class="form-control"  name="LastCompany"
                                        value="<?php echo $candidate_details[0]['LastCompany']; ?>" placeholder="Present/Last Company" > 
                                    </div>
                                    <div class="col-md-2 mb-3 Experience">
                                        <label >Notice Peroid</label> 
                                        <input type="text" class="form-control"  name="NoticePeroid" value="<?php echo $candidate_details[0]['NoticePeroid']; ?>" placeholder="Notice Peroid" > 
                                    </div>
                                    <div class="col-md-2 mb-3 Experience">
                                        <label >Current CTC</label> 
                                        <input type="text" class="form-control"  name="CandidateCurrentCTC"
                                        value="<?php echo $candidate_details[0]['CandidateCurrentCTC']; ?>"
                                        placeholder="Current CTC"> 
                                    </div>
                                    <div class="col-md-2 mb-3 ">
                                        <label >Expected CTC</label> 
                                        <input type="text" class="form-control"  name="CandidateExpectedCTC"
                                        value="<?php echo $candidate_details[0]['CandidateExpectedCTC']; ?>"
                                        placeholder="Expected CTC" required>
                                    </div>
                                    
                                    <div class="col-md-2 mb-3">
                                        <label class="mr-3">Immediate Joiner</label>
                                        <div class="custom-control custom-radio custom-control-inline ">
                                            <input type="radio"  name="ImmediateJoiner" id="ImmediateJoiner" value="Yes" class=" custom-control-input">
                                            <label class="custom-control-label font400" for="ImmediateJoiner" >Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline ">
                                            <input type="radio"  name="ImmediateJoiner" id="ImmediateJoiner1" value="No" class="xshow  custom-control-input">
                                            <label class="custom-control-label font400" for="ImmediateJoiner1" >No</label>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-2 mb-3  ImmdJoining">
                                        <label >Days Required</label> 
                                        <input type="text" class="form-control" placeholder="Days Required " value=" <?= $candidate_details[0]['DaysRequired'] ?>" >  
                                    </div>
                                    <div class="col-md-4 mb-3 ">
                                        <label >Upload Resume</label> 
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="CandidateResume" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" required>
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <p id="filelimit" style="color: red;padding-left: 15px;"> </p>
                                    </div>
                                    <!-- <input type="file" name="CandidateResume"  id="file" style="visibility: hidden" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"  > -->

                                    
                                    <div class="col-md-12 align-self-center text-center">
                                    <?php if(!empty($candidate_details[0]['CandidateLocation'])){?>
                                    
                                        <button class="btn btn-primary" type="submit" disabled > Update </button>
                                    <?php }else{ ?>
                                    <button class="btn btn-primary" type="submit"  > Update </button>
                                    <?php } ?>
                                    </div>
                                </div>
                            </form>

                          

                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
   


<script>
    $(function() {
        $('.Experience').hide(); 
        $('#type').change(function(){
            if($('#type').val() == 2) {
                $('.Experience').show(); 
                
            } else {
                $('.Experience').hide();                  
            } 
        });  
    });
    
    
    $(".ImmdJoining").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('xshow');
        $(".ImmdJoining").toggle(isChecked && isShow);
    });
    
</script>


<!-- Resume Start  -->
<script>
    function myFunction(){
        let filecheck = document.getElementById("customFile").value;
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
</script>
<script>
    var uploadField = document.getElementById("customFile");
    uploadField.onchange = function() {
        if (this.files[0].size > 2020555 ) {
            limits = "File Size more than 2MB";
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

    $('#customFile').on( 'change', function() {
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
            ftype = "File Size is more than 2MB or File Type is InVaild ";
            this.value = "";
            document.getElementById("filelimit").innerHTML = ftype;
            setTimeout(function() {
                document.getElementById("filelimit").innerHTML = "";

            }, 5000);
    }
    });
</script>

<?= $this->endSection() ?>