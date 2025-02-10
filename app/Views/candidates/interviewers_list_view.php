<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>

<?php
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
}
?>

<style>
  button.close {
    color: #8045d2;
    border-radius: 50%;
    padding: 3px 10px;
    border-color: #8045d2;
  }

  .modal-header {
    text-align: center;
    background-color: #925EDD14;
  }
</style>

<div class="career ms-4">
  <div class="row ms-0 me-0 pt-2">
    <div class="col col-lg-9 mt-1">
      <h5>Interviewers List</h5>
    </div>
    <div class="col col-lg-3 mt-1" style="text-align: end;">
      <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> Add New Interviewer</a>
    </div>
  </div>
  <div class="row ms-1 me-1">
    <table class="table table-hover ms-2" id="dataTable">
      <thead class="table-secondary">
        <tr>
          <td>S.No</td>
          <td>Name</td>
          <td>Employee Code</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        if ($interviewerList): ?>
          <?php foreach ($interviewerList as $row): ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= $row['EmployeeName']; ?> </td>
              <td><?= $row['EmployeeCode']; ?></td>
              <td>
                <a class="btn btn-sm " href="<?= site_url('delete_interviewer/' . $row['EmployeeId']) ?>"><i class="fa-regular fa-trash-can"></i></a></a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Add New Interviewer</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('/store_interviewer') ?>" method="post">
          <select class="form-control" name="InterviewerIDFK" required>
            <option value="">--Select-- </option>
            <?php
            if ($select_interviewer) {
              foreach ($select_interviewer as $row) { ?>
                <option value="<?php echo $row["EmployeeId"] ?>"><?php echo $row["EmployeeName"] ?> </option>
            <?php }
            } ?>
          </select>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<script>
  $('#dataTable').dataTable({});
</script>