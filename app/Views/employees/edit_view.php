<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?>
<?php
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
}
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Profile</h1>
        </div>

      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="card card-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-orange">
              <p class="float-left"><?php if ($emp_obj['Status'] == 'Working') {
                                      echo 'Active';
                                    } elseif ($emp_obj['Status'] == 'InActive') {
                                      echo 'InActive';
                                    } else {
                                      echo 'Abscond';
                                    } ?></p>
              <a class="float-right" href="<?php echo base_url('editProfile-view/' . $emp_obj['EmployeeId']); ?> " title="Edit">
                <h2 style="font-size: 20px;"><i class="ion ion-edit "></i></h2>
              </a>
              <h3 class="widget-user-username"><?php echo $emp_obj['EmployeeName']; ?> </h3>

              <?php foreach ($selectdesignation as $row): ?>
                <h5 class="widget-user-desc" <?php if ($row['IDPK'] == $emp_obj['DesignationIDFK']) { ?>>
                <?= $row['designations'];
                                              } ?> </h5>
              <?php endforeach; ?>
            </div>

            <div class="widget-user-image">
              <?php
              if (empty($emp_obj['Image'])) { ?>
                <img class="img-circle elevation-2" src="<?php echo base_url('public/images/default-profile.png') ?>">
              <?php } else { ?>
                <img class="img-circle elevation-2" src="<?php echo base_url('public/Uploads/ProfilePhotosuploads/' . $emp_obj['Image']); ?>" alt="<?php echo $emp_obj['EmployeeName']; ?>">
              <?php
              }
              ?>
            </div>

            <div class="card-footer">
              <div class="row">
                <div class="col-sm-6">
                  <div class="description-block">
                    <span class="description-text">Employee Type</span>
                    <h5 class="description-header"><?= $emp_obj['EmployeeTypeName']; ?></h5>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-6 border-left border-bottom">
                  <div class="description-block">
                    <span class="description-text">Employee Code</span>
                    <h5 class="description-header"><?php echo $emp_obj['EmployeeCode']; ?></h5>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 border-right border-top">
                  <div class="description-block">
                    <span class="description-text">Phone No</span>
                    <h5 class="description-header"><?php echo $emp_obj['ContactNo']; ?></h5>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                  <div class="description-block">
                    <span class="description-text">Email Id</span>
                    <h5 class="description-header"><?php echo $emp_obj['Email']; ?></h5>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->

              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-sm-12 p-0">
                  <div class="description-block">
                    <?php
                    $fdate = date("Y-m-d");
                    $todate = date("Y-m-d");
                    if (empty($documents[0]['CandidateIDFK'])) {
                      $empdocid = '';
                    } else {
                      $empdocid = $documents[0]['CandidateIDFK'];
                    }
                    $empid = $emp_obj['EmployeeId'];
                    ?>
                    <!-- <a href="<?php echo base_url('logHistory?&fdate=' . $fdate . '&todate=' . $todate . '&empid=' . $empid); ?>" class="btn bg-orange">All Log Report</a> -->
                    <a href="<?php echo base_url('background_doc?canId=' . $empdocid); ?>" class="btn btn-sm bg-orange mt-1"><b>Documents</b></a>
                    <a class="btn btn-sm bg-orange mt-1" data-toggle="modal" data-target="#exampleModalCenter"><b>Bank Details</b></a>
                    <a href="<?php $date = date("Y-m-d");
                              echo base_url('leaveHistory/' . $emp_obj['EmployeeId'] . '/' . $date); ?>" class="btn btn-sm bg-orange mt-1"><b>Leave history</b></a>
                    <a href="<?php echo base_url('latecomingHistory?&fdate=' . $fdate . '&todate=' . $todate . '&empid=' . $empid); ?>" class="btn btn-sm bg-orange mt-1"><b>Late Logins</b></a>
                  </div>
                  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Employee Bank Details</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form autocomplete="off" action="<?= site_url('/empBankDetails') ?>" method="post">
                            <input type="hidden" name="EmployeeIDFK" value="<?= $emp_obj['EmployeeId']; ?>">
                            <div class="form-group">
                              <label>Account Holder Name</label>
                              <input type="text" class="form-control" name="AccountHolderName" placeholder="Enter Account Holder Name">
                            </div>
                            <div class="form-group">
                              <label>Bank Name</label>
                              <input type="text" class="form-control" name="BankName" placeholder="Enter Bank Name">
                            </div>
                            <div class="form-group">
                              <label>Account No</label>
                              <input type="number" class="form-control" name="AccountNo" placeholder="Account No">
                            </div>
                            <div class="form-group">
                              <label>IFSC Code</label>
                              <input type="text" class="form-control" name="IFSCode" placeholder="Enter IFSC Code">
                            </div>
                            <div class="form-group">
                              <label>Bank Branch</label>
                              <input type="text" class="form-control" name="BankBranch" placeholder="Enter Bank Branch">
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#generalinfo" data-toggle="tab"> <b>General Info</b></a></li>
                <li class="nav-item"><a class="nav-link " href="#address" data-toggle="tab"><b>Address</b></a></li>
                <li class="nav-item"><a class="nav-link " href="#employement" data-toggle="tab"><b>Employement</b></a></li>
                <?php if (!empty($empBank)) { ?>
                  <li class="nav-item"><a class="nav-link " href="#bank" data-toggle="tab"><b>Bank Dtails</b></a></li>
                <?php } ?>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane " id="generalinfo">
                  <table class="table ">
                    <tbody>
                      <tr>
                        <td><b>Employee Name</b></td>
                        <td><?php echo $emp_obj['EmployeeName']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Employee Code</b></td>
                        <td><?php echo $emp_obj['EmployeeCode']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Gender</b></td>
                        <td><?php echo $emp_obj['Gender']; ?></td>
                      </tr>
                      <tr>
                        <td><b>DOB</b></td>
                        <td><?php $dob = date_create($emp_obj['DOB']);
                            $dob = date_format($dob, "Y-m-d");
                            echo $dob; ?>
                        </td>
                      </tr>
                      <tr>
                        <td><b>Contact No</b></td>
                        <td><?php echo $emp_obj['ContactNo']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Emergency Contact No</b></td>
                        <td><?php echo $emp_obj['AltContactno']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Official Email Id </b></td>
                        <td><?php echo $emp_obj['Email']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Personal Email Id </b></td>
                        <td><?php echo $emp_obj['PersonalMail']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Place Of Birth</b></td>
                        <td><?php echo $emp_obj['PlaceOfBirth']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Blood Group</b></td>
                        <td><?php echo $emp_obj['BLOODGROUP']; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="address">
                  <table class="table ">
                    <tbody>
                      <tr>
                        <td><b>Mother Name</b></td>
                        <td><?php echo $emp_obj['MotherName']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Father Name</b></td>
                        <td><?php echo $emp_obj['FatherName']; ?></td>
                      </tr>

                      <tr>
                        <td><b>Residential Address</b></td>
                        <td><?php echo $emp_obj['ResidentialAddress']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Permanent Address</b></td>
                        <td><?php echo $emp_obj['PermanentAddress']; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <div class="tab-pane" id="employement">
                  <table class="table ">
                    <tbody>
                      <tr>
                        <td><b>Department</b></td>
                        <td
                          <?php foreach ($selectdepart as $row): ?>
                          <?php if ($row['IDPK'] == $emp_obj['DepartmentId']) { ?>>
                        <?php echo $row['deptName'];
                            } ?>
                      <?php endforeach; ?></td>

                      </tr>
                      <tr>
                        <td><b>Designation</b></td>
                        <td
                          <?php foreach ($selectdesignation as $row): ?>
                          <?php if ($row['IDPK'] == $emp_obj['DesignationIDFK']) { ?>>
                        <?php echo $row['designations'];
                            } ?>
                      <?php endforeach; ?></td>
                      </tr>
                      <tr>
                        <td><b>Status</b></td>
                        <td><?php if ($emp_obj['Status'] == 'Working') {
                              echo 'Active';
                            } elseif ($emp_obj['Status'] == 'InActive') {
                              echo 'InActive';
                            } else {
                              echo 'Abscond';
                            } ?></td>
                      </tr>
                      <tr>
                        <td><b>Employement Type</b></td>
                        <td><?php echo $emp_obj['EmployeeTypeName']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Date of Joining</b></td>
                        <td>
                          <?php $doj = date_create($emp_obj['DOJ']);
                          $doj = date_format($doj, "Y-m-d");
                          echo $doj; ?>
                        </td>
                      </tr>
                      <?php if ($emp_obj['Status'] == 'InActive') { ?>
                        <tr>
                          <td><b>Date of Resign</b></td>
                          <td><?php echo $emp_obj['DOR']; ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="bank">
                  <table class="table ">
                    <tbody>
                      <tr>
                        <td><b>Account Holder Name</b></td>
                        <td><?php if (!empty($empBank)) {
                              echo $empBank['AccountHolderName'];
                            } ?>
                        </td>

                      </tr>
                      <tr>
                        <td><b>Bank Name</b></td>
                        <td><?php if (!empty($empBank)) {
                              echo $empBank['BankName'];
                            } ?></td>
                      </tr>
                      <tr>
                        <td><b>Account No</b></td>
                        <td><?php if (!empty($empBank)) {
                              echo $empBank['AccountNo'];
                            } ?></td>
                      </tr>
                      <tr>
                        <td><b>IFSCode</b></td>
                        <td><?php if (!empty($empBank)) {
                              echo $empBank['IFSCode'];
                            } ?></td>
                      </tr>
                      <tr>
                        <td><b>Bank Branch</b></td>
                        <td><?php if (!empty($empBank)) {
                              echo $empBank['BankBranch'];
                            } ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?= $this->endSection() ?>