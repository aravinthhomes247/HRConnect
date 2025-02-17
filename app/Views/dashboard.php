<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>

<style>
  .dashboard .action {
    position: relative;
    display: inline-flex;
  }

  .dashboard .action i {
    position: absolute;
    top: 50%;
    left: 10px;
    transform:
      translateY(-50%);
    color: #8146D4;
  }
</style>

<div class="main-attendence-count-container">
  <div class="row dashboard">
    <div class="col col-lg-8"></div>
    <div class="col col-lg-4 ps-4">
      <div class="action ms-5 mt-2">
        <i class="fa-solid fa-calendar-days"></i>
        <input class="form-control" type="text" style="padding-left: 35px; box-sizing: border-box;" id="reportrange">
        <?php
        if (empty($fdate)) {
          $fdate = date("Y-m-d");
        }
        ?>
        <input type="hidden" name="fdate" id="fdate" value="<?= $fdate ?>" />
        <?php
        if (empty($todate)) {
          $todate = date("Y-m-d");
        }
        ?>
        <input type="hidden" name="todate" id="todate" value="<?= $todate ?>" />
        <button class="btn btn-primary" style="margin-left: 10px;" onclick="datefilter()">Check</button>
      </div>
    </div>
  </div>
  <div class="row row-lg-12 mt-2">
    <div class="counts ms-3">
      <div class="row ms-1">
        <a href="<?php echo site_url('/totalEmps?trickid=1') ?>" class="ms-1">
          <div class="card count-card-1">
            <div class="card-body">
              <div class="row row-lg-11 ms-0 me-0">
                <div class="col-md-8 count-card-title ps-2">
                  Total Employees
                </div>
                <div class="col-md-4 count-card-icon ms-1">
                  <img src="<?php echo base_url('../public/images/img/people.png'); ?>">
                </div>
              </div>
              <div class="count-card-cound ps-3">
                <?= $count ?>
              </div>
            </div>
          </div>
        </a>

        <a href="<?php echo site_url('/presents?&fdate=' . $fdate . '&todate=' . $todate) ?>" class="ms-1">
          <div class="card count-card-2" >
            <div class="card-body">
              <div class="row row-lg-11 ms-0 me-0">
                <div class="col-md-8 count-card-title ps-2">
                  Present Employees
                </div>
                <div class="col-md-4 count-card-icon ms-1">
                  <img src="<?php echo base_url('../public/images/img/user-check.png') ?>">
                </div>
              </div>
              <div class="count-card-cound ps-3">
                <?= $presents ?>
              </div>
            </div>
          </div>
        </a>

        <a href="<?php echo site_url('/absents?&LRID=0&fdate=' . $fdate . '&todate=' . $todate . '&trickid=1') ?>" class="ms-1 mt-2">
          <div class="card count-card-3" >
            <div class="card-body">
              <div class="row row-lg-11 ms-0 me-0">
                <div class="col-md-8 count-card-title ps-2">
                  Absent Employees
                </div>
                <div class="col-md-4 count-card-icon ms-1">
                  <img src="<?php echo base_url('../public/images/img/user-yellow-minus.png') ?>">
                </div>
              </div>
              <div class="count-card-cound ps-3">
                <?= $absent ?>
              </div>
            </div>
          </div>
        </a>

        <a href="<?php echo site_url('/reportemp?trickid=2&fdate=' . $fdate . '&todate=' . $todate) ?>" class="ms-1 mt-2">
          <div class="card count-card-4" >
            <div class="card-body">
              <div class="row row-lg-11 ms-0 me-0">
                <div class="col-md-8 count-card-title ps-2" style="padding-bottom: 1.6rem !important;">
                  Late Entry
                </div>
                <div class="col-md-4 count-card-icon ms-1">
                  <img src="<?php echo base_url('../public/images/img/late-entry.png') ?>">
                </div>
              </div>
              <div class="count-card-cound ps-3">
                <?= $lateComers ?>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="events pt-1 ms-2">
      <div class="row row-lg-12">
        <div class="col-md-8">
          <span>Upcoming Holidays </span> <a href="<?= site_url('/holidays') ?>"><i class="fa-solid fa-pencil fa-xs edit"></i></a>
        </div>
        <div class="col-md-4" style="text-align: end;">
          <?php
          $firstHalf = array_slice($holidays, 0, 5);
          $secondHalf = array_slice($holidays, 5);
          ?>
          <span class="me-1" <?= ($badge == 0) ? 'style="pointer-events: none;"' : '' ?>><a href="<?= site_url('/dashboard?badge=' . ((int)$badge - 1)) ?>"><i class="fa-solid fa-angles-left"></i></a></span>
          <span class="ms-2" <?= (count($secondHalf) < 5) ? 'style="pointer-events: none;"' : '' ?>><a href="<?= site_url('/dashboard?badge=' . ((int)$badge + 1)) ?>"><i class="fa-solid fa-angles-right"></i></a></span>
        </div>
      </div>

      <div class="row row-lg-12">
        <?php foreach ([$firstHalf, $secondHalf] as $index => $holidayGroup) { ?>
          <div class="col-md-6" <?= $index === 0 ? 'style="border-right: 1px solid #727272;"' : '' ?>>
            <table class="table table-hover mt-2 mb-1">
              <tbody>
                <?php foreach ($holidayGroup as $holiday) { ?>
                  <tr>
                    <td ><?= date('M d, Y', strtotime($holiday['AdjustedDate'])) ?></td>
                    <td ><?= date('D', strtotime($holiday['AdjustedDate'])) ?></td>
                    <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 12px; max-width: 150px;" 
                        title="<?= htmlspecialchars($holiday['Name'], ENT_QUOTES, 'UTF-8') ?>">
                        <?= htmlspecialchars($holiday['Name'], ENT_QUOTES, 'UTF-8') ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col col-lg-6 pe-0">
    <div class="att-job-container ms-4 mt-2 pb-2 pt-1">
      <div class="col ms-2">
        <span>Leave / Permission Requests</span>
      </div>
      <div class="mt-5" style="width:100%;text-align: center;">
        <h2 style="color:red;">Coming Soon</h2>
      </div>
      <!-- <table class="table table-hover ms-3">
        <thead>
          <tr>
            <td>EMPLOYEE CODE</td>
            <td>EMPLOYEE NAME</td>
            <td>CASE</td>
            <td>RAISED ON</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>HME234565</td>
            <td>karthick</td>
            <td>hourly permission</td>
            <td>26/08/24</td>
          </tr>
          <tr>
            <td>HME234444</td>
            <td>Gowshik</td>
            <td>casual leave</td>
            <td>26/08/24</td>
          </tr>
        </tbody>
      </table>
      <div class="viewmore">
        <a href="#" class="btn btn-viewmore p-1"><i class="fa-solid fa-angles-down"></i> View More</a>
      </div> -->
    </div>
  </div>
  <div class="col col-lg-6">
    <div class="main-attendence-count-container-birthday-container mt-2 pt-1">
      <div class="col ms-2">
        <span>Abnormal Activities</span>
      </div>

      <div class="mt-5" style="width:100%;text-align: center;">
        <h2 style="color:red;">Coming Soon</h2>
      </div>

      <!-- <table class="table table-hover ms-3">
        <thead>
          <tr>
            <td>EMPLOYEE CODE</td>
            <td>EMPLOYEE NAME</td>
            <td>DATE</td>
            <td>STATUS</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>H2345676</td>
            <td>karthi Karnan</td>
            <td>TODAY</td>
            <td style="color: #029008;">APPROVED</td>
          </tr>
          <tr>
            <td>H2345676</td>
            <td>naveen</td>
            <td>TODAY</td>
            <td style="color: #017BB8;">NO INFO</td>
          </tr>
          <tr>
            <td>H2345676</td>
            <td>jonathan</td>
            <td>TODAY</td>
            <td style="color: #971B47;">NOT APPROVED</td>
          </tr>
        </tbody>
      </table> -->
    
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
    $('#reportrange').daterangepicker({
        format: 'YYYY/MM/DD',
        locale: {
            format: 'YYYY/MM/DD'
        },
        startDate: '<?= date("Y/m/d", strtotime($fdate)) ?>',
        endDate: '<?= date("Y/m/d", strtotime($todate)) ?>',
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
    }, function(start, end, label) {
        // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
  });

  function datefilter()
  {
      var daterange = document.getElementById("reportrange").value;
      var temp1 = daterange.split('-').pop();
      var	dateString1 = temp1.replaceAll('/', "-");	
      var todateid = moment(dateString1).format('YYYY-MM-DD');	
      var temp2 = daterange.slice(0,10);
      var	dateString2 = temp2.replaceAll('/', "-");
      var fromdateid = moment(dateString2).format('YYYY-MM-DD');
      // alert(todateid);
      window.location.href = 'DSdaterangeV?&fdate='+fromdateid+'&todate='+todateid;
  }
</script>

<?= $this->endSection() ?>