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
            <h1>Edit Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('/candidate?fdate=&todate=&trickid=1') ?>">Candidate List</a></li>
              <li class="breadcrumb-item active">Candidate Profile</li>
            </ol>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">                          
                            <form action="<?= site_url('/update_CandiProfile') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                                <input type="hidden" name="CandidateId" value="<?= $candidate_details[0]['CandidateId'] ?>">
                                <div class="form-row">
                                    <div class="form-group col-lg-4">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="CandidateName" placeholder="Candidate Name" value="<?= $candidate_details[0]['CandidateName'] ?>">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Contact No</label>
                                        <input type="text" readonly class="form-control" name="CandidateContactNo" id="contactNo" value="<?= $candidate_details[0]['CandidateContactNo'] ?>">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="CandidateEmail" placeholder="Candidate Email" value="<?= $candidate_details[0]['CandidateEmail'] ?>">
                                    </div>
                                    <div class="form-group col-lg-12 ">
                                        <label>Residing Location:</label> 
                                        <textarea class="form-control" placeholder="Residing Location" name="CandidateLocation" ><?= $candidate_details[0]['CandidateLocation'] ?></textarea>
                                    </div>
                                    <div class="form-group col-lg-3 ">
                                        <label>Position applied for: </label>
                                        <select class="form-control" name="CandidatePosition">
                                            <option>--Select-- </option>                                            
                                            <?php  foreach($selectdesignation as $row){ ?>
                                            <option  value="<?php echo  $row["IDPK"] ?>"  
                                                <?php if($candidate_details[0]['CandidatePosition']==$row["IDPK"]){ echo "selected"; } ?>>
                                                <?php echo $row["designations"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 ">
                                        <label>Education: </label>
                                        <input type="text" class="form-control" name="CandidateEducation" value="<?php echo $candidate_details[0]['CandidateEducation']; ?>" placeholder="Education Qualification" >
                                    </div>
                                    <div class="form-group col-lg-3 ">
                                        <label>Experience:</label>
                                        <select class="form-control" name="exp" id="type">
                                            <option value="1" id="fresher" <?php if($candidate_details[0]['CandidateExperience']==1){ echo "selected"; } ?> >Fresher</option>
                                            <option value="2" id="experience" <?php if($candidate_details[0]['CandidateExperience']==2){ echo "selected"; } ?>>Experienced</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 " id="totalExp">
                                        <label>Total Experience:</label> 
                                        <input type="number" step="any"  min="0" class="form-control" name="TotalExperience" value="<?php echo $candidate_details[0]['TotalExperience']; ?>" placeholder="Years/Months">
                                    </div>
                                    <div class="form-group col-lg-6 " id="lastComp">
                                        <label>Last Company:</label> 
                                        <input type="text" class="form-control" name="LastCompany" value="<?php echo $candidate_details[0]['LastCompany']; ?>"  placeholder="Last Company">
                                    </div>
                                    <div class="form-group col-lg-3 " id="NoticeP">
                                        <label>Notice Peroid:</label> 
                                        <input type="number" step="any"  min="0" class="form-control" name="NoticePeroid" value="<?php echo $candidate_details[0]['NoticePeroid']; ?>" placeholder="Notice Peroid">
                                    </div>
                                    <div class="form-group col-lg-3 " id="CurrCTC">
                                        <label>Current Salary:</label> 
                                        <input type="number" step="any"  min="0" class="form-control" name="CandidateCurrentCTC" value="<?php echo $candidate_details[0]['CandidateCurrentCTC']; ?>" placeholder="Current Salary">
                                    </div>
                                    <div class="form-group col-lg-3 ">
                                        <label>Expected Salary:</label> 
                                        <input type="number" step="any"  min="0" class="form-control" name="CandidateExpectedCTC" value="<?php echo $candidate_details[0]['CandidateExpectedCTC']; ?>" placeholder="Expected Salary" >
                                    </div>
                                    
                                    <div class="form-group col-lg-3 " >
                                        <label>Immediate Joiner:</label> 
                                        <div class="form-group" style="padding: 5px 10px 8px 4px;">                                            
                                            <input type="radio"  name="ImmediateJoiner" class="yshow" value="Yes" <?php if($candidate_details[0]['ImmediateJoiner']=='Yes'){ echo "checked"; } ?>/> Yes
                                            <input type="radio"  name="ImmediateJoiner" class="yshow ashow" value="No" <?php if($candidate_details[0]['ImmediateJoiner']=='No'){ echo "checked"; } ?>/> No
                                        </div>
                                    </div>                               
                                    <div class="form-group col-lg-3  joingdays" >
                                        <label>Days Required to Join: </label>  
                                        <input type="text" class="form-control" name="DaysRequired" placeholder="Days Required" value="<?= $candidate_details[0]['DaysRequired'] ?>" /> 
                                       
                                    </div>
                                    <div class="form-group col-lg-3   " >
                                        <label>Upload Resume: </label> 
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="CandidateResume" id="customFile" value="<?= $candidate_details[0]['CandidateResume'] ?>">
                                            <label class="custom-file-label" for="customFile"><?= $candidate_details[0]['CandidateResume'] ?></label>
                                        </div>
                                    </div>
                                </div>                                
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

                


</div>


<script>
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
</script>
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
    $(".callback").hide();
    $('input[type=radio]').change(function() {
        var isChecked = $(this).prop('checked');
        var isShow = $(this).hasClass('bshow');
        $(".callback").toggle(isChecked && isShow);
    });
</script>

<?= $this->endSection() ?>