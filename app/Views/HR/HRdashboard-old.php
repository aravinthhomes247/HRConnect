<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-4">
          <h1 class="m-0">HR Dashboard</h1>
          <input type="hidden" value="<?php echo $session->get('EmpIDFK'); ?>" id="HRid">
          <input type="hidden" value="<?php echo $session->get('user_name'); ?>" id="HRNAME">
        </div><!-- /.col -->
        <div class="col-sm-8 pl-0">
          <div class="d-flex justify-content-end ">

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="text" class="form-control float-right" id="reportrange">
                <?php if (empty($fdate)) {
                  //year-month-date formate
                  $fdate = date("Y-m-d");
                }
                ?>
                <input type="hidden" name="fdate" id="fdate" value="<?= $fdate ?>" />
                <?php if (empty($todate)) {
                  $todate = date("Y-m-d");
                  // print_r($todate);
                }
                ?>
                <input type="hidden" name="todate" id="todate" value="<?= $todate ?>" />
                <button class="btn bg-orange" onclick="datefilter()">Check</button>
              </div>
            </div>
          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Report content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3><?= $HRassignedCandidatesCount ?></h3>
              <p>Fresh Candidates List</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-people-arrows"></i>
            </div>
            <a href="<?php echo site_url('/HRcandidate_List?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="small-box-footer" id="candidateurl1">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $HRscheduledCount ?></h3>
              <p>Scheduled Candidates</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-users-viewfinder"></i>
            </div>
            <a href="<?php echo site_url('/HRcandidate_List?trickid=1&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="small-box-footer" id="candidateurl2">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-lime-green">
            <div class="inner">
              <h3><?= $HRnotScheduledCount ?></h3>
              <p>Not-Scheduled Candidates</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-layer-group"></i>
            </div>
            <a href="<?php echo site_url('/HRcandidate_List?trickid=2&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="small-box-footer" id="candidateurl3">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $HRSelectedCandidatesCount ?></h3>
              <p>Selected Candidates </p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-person-chalkboard"></i>
            </div>
            <a href="<?php echo site_url('/HRcandidate_List?trickid=4&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="small-box-footer" id="candidateurl4">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $HRrejectedCandidatesCount ?></h3>
              <p>Rejected Candidates</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-users-slash"></i>
            </div>
            <a href="<?php echo site_url('/HRcandidate_List?trickid=5&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="small-box-footer" id="candidateurl5">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $HRJoinedCandidatesCount ?></h3>
              <p>Joined Candidates</p>
            </div>
            <div class="icon">
              <i class="fa-regular fa-id-card"></i>
            </div>
            <a href="<?php echo site_url('/HRcandidate_List?trickid=8&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="small-box-footer" id="candidateurl6">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  $(document).ready(function() {
    for (let i = 1; i <= 6; i++) {
      let candidateUrl = $(`#candidateurl${i}`).attr('href').replaceAll('&hr=', '&hr=' + $('#HRNAME').val().replaceAll(' ', '%20'));
      if (i != 2) {
        candidateUrl = candidateUrl.replaceAll('&fsd-2=', '&fsd-2=' + $('#fdate').val());
        candidateUrl = candidateUrl.replaceAll('&fed-2=', '&fed-2=' + $('#todate').val());
      } else {
        candidateUrl = candidateUrl.replaceAll('&fsd-1=', '&fsd-1=' + $('#fdate').val());
        candidateUrl = candidateUrl.replaceAll('&fed-1=', '&fed-1=' + $('#todate').val());
      }
      $(`#candidateurl${i}`).attr('href', candidateUrl);
    }
  });

  function datefilter() {
    var daterange = document.getElementById("reportrange").value;
    var temp1 = daterange.split('-').pop();
    var dateString1 = temp1.replaceAll('/', "-");
    var todateid = moment(dateString1).format('YYYY-MM-DD');
    var temp2 = daterange.slice(0, 10);
    var dateString2 = temp2.replaceAll('/', "-");
    var fromdateid = moment(dateString2).format('YYYY-MM-DD');
    // alert(todateid);
    window.location.href = 'HRdashboard?&fdate=' + fromdateid + '&todate=' + todateid;

  }
</script>

<?= $this->endSection() ?>