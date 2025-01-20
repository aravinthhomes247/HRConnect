<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header-new") ?>

<?= $this->section("body") ?>
<?php
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add New Careers Details</h1>
        </div><!-- /.col -->
        <br>

        <?php if (session('msg')) : ?>
          <div class="alert alert-info alert-dismissible">
            <?= session('msg') ?>
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
          </div>
        <?php endif ?>

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <form id="create_career_form" action="<?php echo(site_url('/update-career/'.$career['job_IDPK'])) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active">
                    <div class="panel panel-default">
                      <div class="panel-body addCareer">
                        <div class="row">
                          <div class="col-lg-3">
                            <b>Job Title </b> <i class="fa-solid fa-star-of-life starimp"></i>
                            <input type="text" name="JobTitle" id="JobTitle" class="form-control" value="<?php echo($career['job_Title']) ?>">
                            <span id="error_JobTitle" class="text-danger"></span>
                          </div>
                          <div class="col-lg-3">
                            <b>Job Type </b> <i class="fa-solid fa-star-of-life starimp"></i>
                            <select class="form-control" name="JobType" id="JobType">
                              <option value="1" <?php echo ($career['job_type'] == 1) ? 'selected' : ''; ?>>Full Time</option>
                              <option value="2" <?php echo ($career['job_type'] == 2) ? 'selected' : ''; ?>>Part Time</option> 
                            </select>
                          </div>
                          <div class="col-lg-3">
                            <b>Job Category </b> <i class="fa-solid fa-star-of-life starimp"></i>
                            <select class="form-control" name="JobCategory" id="JobCategory">
                              <!-- <option value="">Select Category</option> -->
                              <?php foreach ($selectCareerCat as $category): ?>
                                <option value="<?php echo $category['job_cat_IDPK']; ?>" 
                                    <?php echo ($career['job_cat_IDFK'] == $category['job_cat_IDPK']) ? 'selected' : ''; ?>>
                                    <?php echo $category['job_cat_name']; ?>
                                </option>
                            <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="col-lg-3">
                            <b>Job Experience </b> <i class="fa-solid fa-star-of-life starimp"></i>
                            <input type="text" name="JobExperience" id="JobExperience" class="form-control" value="<?php echo($career['job_experience']) ?>">
                            <span id="error_JobExperience" class="text-danger"></span>
                          </div>
                        </div><br>
                        <div class="row">
                          <div class="col">
                            <b>Company Profile</b></i>
                            <textarea name="profile" class="form-control TinyMCE" placeholder="Company Profile"><?= $career['company_profile'] ?></textarea>
                          </div>
                          <div class="col">
                            <b>Job Overview</b></i>
                            <textarea name="overview" class="form-control TinyMCE" placeholder="Job Overview"><?= $career['job_overview'] ?></textarea>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col qualifications">
                            <b>Qualifications</b></i>
                            <?php
                              $i=1; 
                              $Qualifications = json_decode($career['qualifications'], true);
                              // print_r($Qualifications);exit(0);
                            ?>
                            <?php if($Qualifications): ?>
                              <?php foreach($Qualifications as $Qualification): ?>
                              <?php if($i == 1): ?>
                                <div class="d-flex align-items-center mt-2">
                                  <input name="qualifications[]" id="qualifications" class="form-control" style="margin-right: 10px;" value="<?= $Qualification['qualification'] ?>">
                                  <button type="button" class="btn btn-success add-button">+</button>
                                </div>
                                <?php $i++; ?>
                              <?php else: ?>
                                <div class="d-flex align-items-center mt-2">
                                  <input name="qualifications[]" id="qualifications" class="form-control" style="margin-right: 10px;" value="<?= $Qualification['qualification'] ?>">
                                  <button type="button" class="btn btn-success add-button" style="margin-right: 10px;">+</button>
                                  <button type="button" class="btn btn-danger remove-button">-</button>
                                </div>
                              <?php endif;endforeach; ?>
                            <?php else: ?>
                              <div class="d-flex align-items-center mt-2">
                                <input name="qualifications[]" id="qualifications" class="form-control" style="margin-right: 10px;" value="">
                                <button type="button" class="btn btn-success add-button">+</button>
                              </div>
                            <?php endif; ?>
                          </div>
                          <div class="col skills">
                            <b>Skills</b></i>
                            <?php
                              $i=1; 
                              $Skills = json_decode($career['skills'], true);
                            ?>
                            <?php if($Skills){ ?>
                              <?php foreach($Skills as $Skill){ ?>
                              <?php if($i == 1){ ?>
                                <div class="d-flex align-items-center mt-2">
                                  <input name="skills[]" id="skills" class="form-control" style="margin-right: 10px;" value="<?= $Skill['skill'] ?>">
                                  <button type="button" class="btn btn-success add-button">+</button>
                                </div>
                                <?php $i++; ?>
                              <?php }else{ ?>
                                <div class="d-flex align-items-center mt-2">
                                  <input name="skills[]" id="skills" class="form-control" style="margin-right: 10px;" value="<?= $Skill['skill'] ?>">
                                  <button type="button" class="btn btn-success add-button" style="margin-right: 10px;">+</button>
                                  <button type="button" class="btn btn-danger remove-button">-</button>
                                </div>
                            <?php }}}else{ ?>
                              <div class="d-flex align-items-center mt-2">
                                <input name="skills[]" id="skills" class="form-control" style="margin-right: 10px;" value="">
                                <button type="button" class="btn btn-success add-button">+</button>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col roles">
                            <b>Roles & Responsibilities</b>
                            <?php
                              $i=1; 
                              $Roles = json_decode($career['roles'], true);
                            ?>
                            <?php if($Roles){ ?>
                            <?php foreach($Roles as $Role){ ?>
                            <?php if($i == 1){ ?>
                              <div class="d-flex align-items-center mt-2">
                                <input name="roles[]" id="roles" class="form-control" style="margin-right: 10px;" value="<?= $Role['role'] ?>">
                                <button type="button" class="btn btn-success add-button">+</button>
                              </div>
                              <?php $i++; ?>
                            <?php }else{ ?>
                              <div class="d-flex align-items-center mt-2">
                                <input name="roles[]" id="roles" class="form-control" style="margin-right: 10px;" value="<?= $Role['role'] ?>">
                                <button type="button" class="btn btn-success add-button" style="margin-right: 10px;">+</button>
                                <button type="button" class="btn btn-danger remove-button">-</button>
                              </div>
                            <?php }}}else{ ?>
                              <div class="d-flex align-items-center mt-2">
                                <input name="roles[]" id="roles" class="form-control" style="margin-right: 10px;" value="">
                                <button type="button" class="btn btn-success add-button">+</button>
                              </div>
                            <?php } ?>
                          </div>
                        </div><br>
                        <div align="center">
                          <button type="button" id="btn_career_submit" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  $(document).ready(function() {

    $('#btn_career_submit').click(function() {
      var error_JobTitle = '';
      var error_JobExperience = '';
      if ($.trim($('#JobTitle').val()).length == 0) {
        error_JobTitle = 'Job Title is required';
        $('#error_JobTitle').text(error_JobTitle);
        $('#JobTitle').addClass('has-error');
      } else {
        error_JobTitle = '';
        $('#error_JobTitle').text(error_JobTitle);
        $('#JobTitle').removeClass('has-error');
      }
      if ($.trim($('#JobExperience').val()).length == 0) {
        error_JobExperience = 'Job Experience is required';
        $('#error_JobExperience').text(error_JobExperience);
        $('#JobExperience').addClass('has-error');
      } else {
        error_JobExperience = '';
        $('#error_JobExperience').text(error_JobExperience);
        $('#JobExperience').removeClass('has-error');
      }
      if (error_JobTitle != '' || error_JobExperience != '') {
        console.log("false");
        return false;
      } else {
        console.log("true");
        $('#btn_career_submit').attr("disabled", "disabled");
        $(document).css('cursor', 'prgress');
        $("#create_career_form").submit();
      }
    });


    $('.qualifications').on('click', '.add-button', function() {
      const inputHtml =`<div class="d-flex align-items-center mt-2">
                          <input name="qualifications[]" id="qualifications" class="form-control" style="margin-right: 10px;" placeholder="Qualifications">
                          <button type="button" class="btn btn-success add-button" style="margin-right: 10px;">+</button>
                          <button type="button" class="btn btn-danger remove-button">-</button>
                        </div>`;
      $('.qualifications').append(inputHtml);
    });

    $('.skills').on('click', '.add-button', function() {
      const inputHtml =`<div class="d-flex align-items-center mt-2">
                          <input name="skills[]" id="skills" class="form-control" style="margin-right: 10px;" placeholder="Skills">
                          <button type="button" class="btn btn-success add-button" style="margin-right: 10px;">+</button>
                          <button type="button" class="btn btn-danger remove-button">-</button>
                        </div>`;
      $('.skills').append(inputHtml);
    });

    $('.roles').on('click', '.add-button', function() {
      const inputHtml =`<div class="d-flex align-items-center mt-2">
                          <input name="roles[]" id="roles" class="form-control" style="margin-right: 10px;" placeholder="Roles & Responsibilities">
                          <button type="button" class="btn btn-success add-button" style="margin-right: 10px;">+</button>
                          <button type="button" class="btn btn-danger remove-button">-</button>
                        </div>`;
      $('.roles').append(inputHtml);
    });

    // Remove input box
    $('.qualifications').on('click', '.remove-button', function() {
      $(this).closest('.d-flex').remove();
    });

    $('.skills').on('click', '.remove-button', function() {
      $(this).closest('.d-flex').remove();
    });

    $('.roles').on('click', '.remove-button', function() {
      $(this).closest('.d-flex').remove();
    });

  });
</script>





<?= $this->endSection() ?>