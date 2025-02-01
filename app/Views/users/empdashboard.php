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

  .main-attendence-count-container .counts .bgwht {
    background-color: white;
  }

  .timebar i {
    font-size: 8px;
  }

  .timebar i.mid {
    font-size: 4px;
    vertical-align: middle;
    padding-top: 2px;
    color: #D9D9D9;
  }

  .timebar i.start {
    color: #5EBC56;
  }

  .timebar i.end {
    color: #D9D9D9;
  }

  .events.user {
    border-radius: 5px;
    width: 95% !important;
    background-color: white;
  }

  img.headicon {
    width: 14px;
    height: 14px;
  }

  .birthday-container {
    width: 95% !important;
  }
</style>

<div class="main-attendence-count-container">
  <div class="row row-lg-12 mt-3">
    <div class="counts ms-3">
      <div class="row ms-1 bgwht">
        <span>Today Time Log</span>
        <div class="mt-2 mb-4 text-center">
          <h2 id="clock">00:00:00 Hrs</h2>
          <h6><?= date("d M Y") ?></h6>
          <span id="suitation"></span>
        </div>
        <hr>
        <br>
        <div class="timebar mt-2">
          <div class="row">
            <div class="col-1 pe-0">
              <i class="fa-solid fa-circle start"></i> <i class="fa-solid fa-circle mid"></i> <i class="fa-solid fa-circle start"></i>
            </div>
            <div class="col-10 pt-2">
              <div class="progress mt-1" style="height: 2px;">
                <div class="progress-bar bg-success" role="progressbar" id="proMins1" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-secondary" role="progressbar" id="proMins2" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <div class="col-1 ps-0">
              <i class="fa-solid fa-circle end"></i> <i class="fa-solid fa-circle mid"></i> <i class="fa-solid fa-circle end"></i>
            </div>
          </div>
          <div class="row mt-2 mb-3">
            <div class="col-2">
              <span>09:30AM</span>
            </div>
            <div class="col-8 text-center">
              <span>Working Hours</span>
            </div>
            <div class="col-2">
              <span>06:30PM</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="events pt-1 ms-2">
      <div class="row row-lg-12">
        <div class="col-md-8">
          <span>Upcoming Holidays </span><img class="headicon" src="<?= base_url('public/images/img/upcomming.png') ?>" alt="">
        </div>
        <div class="col-md-4" style="text-align: end;">
          <?php
          $firstHalf = array_slice($holidays, 0, 5);
          $secondHalf = array_slice($holidays, 5);
          ?>
          <span class="me-1" <?= ($badge == 0) ? 'style="pointer-events: none;"' : '' ?>><a href="<?= site_url('/user-dashboard?badge=' . ((int)$badge - 1)) ?>"><i class="fa-solid fa-angles-left"></i></a></span>
          <span class="ms-2" <?= (count($secondHalf) < 5) ? 'style="pointer-events: none;"' : '' ?>><a href="<?= site_url('/user-dashboard?badge=' . ((int)$badge + 1)) ?>"><i class="fa-solid fa-angles-right"></i></a></span>
        </div>
      </div>
      <div class="row row-lg-12">
        <?php foreach ([$firstHalf, $secondHalf] as $index => $holidayGroup) { ?>
          <div class="col-md-6" <?= $index === 0 ? 'style="border-right: 1px solid #727272;"' : '' ?>>
            <table class="table table-hover mt-2 mb-1">
              <tbody>
                <?php foreach ($holidayGroup as $holiday) { ?>
                  <tr>
                    <td><?= date('M d, Y', strtotime($holiday['AdjustedDate'])) ?></td>
                    <td><?= date('D', strtotime($holiday['AdjustedDate'])) ?></td>
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
        <span>Weekly Attendance</span>
      </div>
      <table class="table table-hover ms-3">
        <thead>
          <tr>
            <td>Day</td>
            <td>Date</td>
            <td>Checkin</td>
            <td>Checkout</td>
            <td>Total</td>
          </tr>
        </thead>
        <tbody>
          <?php if ($weeklogs): ?>
            <?php foreach ($weeklogs as $weeklog): ?>
              <tr>
                <td><?= date("D", strtotime($weeklog['LogDate'])) ?></td>
                <td><?= date("d M", strtotime($weeklog['LogDate'])) ?></td>
                <td><?= date("g:i A", strtotime($weeklog['login'])) ?></td>
                <td><?= date("g:i A", strtotime($weeklog['logout'])) ?></td>
                <td><?= (new DateTime($weeklog['workingHours']))->format("H:i") . ' Hrs' ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="5">No data available in table</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>


  <div class="col col-lg-6">
    <div class="events user mt-2 mb-1 pt-1">
      <div class="row row-lg-12">
        <div class="col-md-8 ms-2">
          <span>Events & Announcements </span><img class="headicon" src="<?= base_url('public/images/img/evtGroup.png') ?>" alt="">
        </div>
      </div>
      <?php foreach ($events as $event): ?>
        <div class="event-data mt-0 ms-2 pb-0">
          <div class="row row-lg-12">
            <div class="col-md-8">
              <span><b><?= $event['EventName'] ?></b></span>
            </div>
            <div class="col-md-4 event-date">
              <span class="me-2"><?= date('d M Y, h:i A', strtotime($event['EventDate'])) ?></span>
            </div>
          </div>
          <div class="row row-lg-12">
            <span><?= $event['EventDescription'] ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="birthday-container mt-2 mb-1 pt-1">
      <div class="col ms-2">
        <span>Upcomming Birthdays </span><img class="headicon" src="<?= base_url('public/images/img/upbirth.png') ?>" alt="">
      </div>
      <div class="table-container">
        <table class="table table-hover">
          <thead>
            <tr>
              <td>EMPLOYEE CODE</td>
              <td>EMPLOYEE NAME</td>
              <td>DESIGNATION</td>
              <td>DOB</td>
            </tr>
          </thead>
          <tbody>
            <?php if ($birthdays):
              foreach ($birthdays as $birthday): ?>
                <tr>
                  <td><?php echo $birthday['EmployeeCode']; ?></td>
                  <td><?php echo $birthday['EmployeeName']; ?></td>
                  <td><?php echo $birthday['designations']; ?></td>
                  <td><?php echo $birthday['DOB']; ?></td>
                </tr>
            <?php endforeach;
            endif;
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<script>

  var login = '<?= $login ?>';
  let hours = 0;
  let minutes = 0;
  let seconds = 0;
  let proMins1 = 0;
  let proMins2 = 0;
  let flag = false;

  if (login != null && login != '') {
    flag = true;
    var loginTime = new Date(login);
    var now = new Date();
    var diffInSeconds = Math.floor((now - loginTime) / 1000);
    hours = Math.floor(diffInSeconds / 3600);
    minutes = Math.floor((diffInSeconds % 3600) / 60);
    seconds = diffInSeconds % 60;

    let proMins1 = Math.floor(((Math.floor(diffInSeconds / 60)) / 540) * 100);
    let proMins2 = 100 - proMins1;

    $('#proMins1').css('width', proMins1 + '%');
    $('#proMins2').css('width', proMins2 + '%');

    var targetTime = new Date(now.toDateString() + ' 09:30 AM'); // Combine today's date with "09:30 AM"
    var diffInMillis = loginTime - targetTime;
    var diffInMinutes = Math.floor(diffInMillis / 1000 / 60);
    if (diffInMinutes > 0) {
      var HTML = "Late by " + diffInMinutes + " Mins";
      $('#suitation').html(HTML);
      if (diffInMinutes > 15) {
        $('#suitation').addClass('text-danger');
      } else {
        $('#suitation').addClass('text-success');
      }
    } else if (diffInMinutes < 0) {
      var HTML = "Early by " + Math.abs(diffInMinutes) + " Mins";
      $('#suitation').html(HTML);
      $('#suitation').addClass('text-success');
    } else {
      var HTML = "Exactly at 09:30 AM";
      $('#suitation').html(HTML);
      $('#suitation').addClass('text-success');
    }
  }

  function updateClock() {
    seconds++;
    if (seconds === 60) {
      seconds = 0;
      minutes++;
    }
    if (minutes === 60) {
      minutes = 0;
      hours++;
    }
    const timeString =
      `${hours.toString().padStart(2, '0')}:` +
      `${minutes.toString().padStart(2, '0')}:` +
      `${seconds.toString().padStart(2, '0')}` + ` Hrs`;
    document.getElementById('clock').innerText = timeString;
  }
  
  if(flag){
    setInterval(updateClock, 1000);
  }

</script>

<?= $this->endSection() ?>