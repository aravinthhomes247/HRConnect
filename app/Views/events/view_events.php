<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>

<?php
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
}
?>

<style>
  .dropdown {
    display: none;
    position: absolute;
    background-color: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 120px;
  }

  .dropdown a {
    padding: 5px 10px !important;
    display: block;
    text-decoration: none !important;
    width: 100% !important;
  }

  .dropdown a:hover {
    background-color: #f0f0f0;
  }
</style>



<div class="Employees ms-4 mt-2">
  <div class="row ms-0 me-0 pt-2">
    <div class="col col-lg-8">
      <h5>Upcoming Events/Announcements List</h5>
    </div>
    <div class="col col-lg-4">
    </div>
  </div>

  <div class="row ms-1 me-1 pt-2">
    <table class="table table-hover ms-2" id="events-list">
      <thead class="table-secondary">
        <tr>
          <td>S.No</td>
          <td>Event Name</td>
          <td>Event Description</td>
          <td>Date</td>
          <td>Type</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        if ($alleventsDetailsTable): ?>
          <?php foreach ($alleventsDetailsTable as $row): ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $row['EventName']; ?></td>
              <td><?php echo $row['EventDescription']; ?></td>
              <td><?php echo date('d M Y, h:i A', strtotime($row['EventDate'])) ?></td>
              <td><?php echo ($row['Type'] == 1) ? 'Event' : 'Announcement'; ?></td>
              <td>
                <a href="javascript:void(0);" class="menu-trigger">
                  <img src="<?php echo base_url('../public/images/img/Group.png') ?>" alt="menu" id="menu-icon">
                </a>
                <div class="dropdown" style="display: none;">
                  <a href="javascript:void(0);" class="evtedit" data-id="<?= $row['EventId'] ?>">Edit</a>
                  <a href="<?= base_url('deleteevent/' . $row['EventId']); ?>">Delete</a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Events & Announcements</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= site_url('updatevent') ?>" method="post">
        <input type="hidden" name="id" id="EventId">
        <div class="modal-body">
          <div class="form-check form-check-inline mb-3">
            <input class="form-check-input" type="radio" name="Type" id="type1" value="1" checked>
            <label class="form-check-label" for="type1">Event</label>
          </div>
          <div class="form-check form-check-inline mb-3">
            <input class="form-check-input" type="radio" name="Type" id="type2" value="2">
            <label class="form-check-label" for="type2">Announcement</label>
          </div>
          <div class="mb-3">
            <input class="form-control" name="EventName" id="evt-title" placeholder="Write your subject heading here." required>
          </div>
          <div class="mb-3">
            <textarea class="form-control" name="EventDescription" id="evt-description" rows="5" placeholder="Write a message here to share with employees." required></textarea>
          </div>
          <div class="mb-3">
            <input class="form-control" type="datetime-local" name="EventDate" id="EventDate" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Share <i class="fa-solid fa-paper-plane"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>



<script>
  const menuTriggers = document.querySelectorAll('.menu-trigger');
  menuTriggers.forEach((trigger) => {
    trigger.addEventListener('click', (event) => {
      event.stopPropagation();
      document.querySelectorAll('.dropdown').forEach((dropdown) => {
        dropdown.style.display = 'none';
      });
      const dropdown = trigger.nextElementSibling;
      dropdown.style.display = 'block';
    });
  });
  document.addEventListener('click', () => {
    document.querySelectorAll('.dropdown').forEach((dropdown) => {
      dropdown.style.display = 'none';
    });
  });

  $(document).ready(function() {
    $('#events-list').DataTable({});

    $('.evtedit').on("click", function() {
      let id = $(this).data('id');
      var URL = '<?= base_url('getevent/') ?>';
      $.ajax({
        url: URL + '/' + id,
        type: 'GET',
        success: function(response) {
          console.log(response);
          $('#EventId').val(response.files.EventId);
          if (response.files.Type == 1) {
            $('#type1').attr('checked', 'checked');
          } else if (response.files.Type == 2) {
            $('#type2').attr('checked', 'checked');
          }
          $('#evt-title').val(response.files.EventName);
          $('#evt-description').val(response.files.EventDescription);
          var dateTime = response.files.EventDate;
          var dateTime = dateTime.replace(' ', 'T').substring(0, 16);
          $('#EventDate').val(dateTime);
          $('#exampleModal').modal('show');
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    });

  });
</script>

<?= $this->endSection() ?>