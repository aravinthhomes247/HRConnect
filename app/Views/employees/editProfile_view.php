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
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit <?php echo $emp_obj['EmployeeName']; ?> Profile</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">         
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills"> 
                  <li class="nav-item"><a class="nav-link active" href="#generalinfo" data-toggle="tab">General Info</a></li>
                  <li class="nav-item"><a class="nav-link " href="#address" data-toggle="tab">Address</a></li>
                  <li class="nav-item"><a class="nav-link " href="#employement" data-toggle="tab">Employement</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form method="post" id="update_emp" name="update_emp" action="<?= site_url('/update') ?>" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="EmployeeId" id="EmployeeId" value="<?php echo $emp_obj['EmployeeId']; ?>">
                <div class="tab-content">
                  <div class="active tab-pane " id="generalinfo">
                    <table class="table ">                      
                      <tbody>                         
                        <tr>
                            <td><b>Employee Name</b></td>
                            <td><input type="text" name="EmployeeName" class="form-control" value="<?php echo $emp_obj['EmployeeName']; ?>" placeholder="Employee Name" ></td>
                        </tr>
                        <tr>
                            <td><b>Employee Code</b></td>
                            <td>
                                <input type="text" name="EmployeeCode" id="EmployeeCode" class="form-control" value="<?php echo $emp_obj['EmployeeCode']; ?>" placeholder="Employee Code">
                                <span id="error_EmployeeCode" class="text-danger"></span>
                            </td>
                        </tr>                        
                        <tr>
                            <td><b>Gender</b></td>
                            <td>
                            <select class="form-control" name="Gender" >
                                <?php
                                  if ($emp_obj['Gender'] == 'Male') {

                                      echo "<option value='Male' selected>Male</option>";
                                      echo "<option value='Female'>Female</option>";

                                  } else {
                                      echo "<option value='Female' selected>Female</option>";
                                      echo "<option value='Male'>Male</option>";
                                  }
                                ?>
                            </select>
                            
                            </td>
                        </tr>                        
                        <tr>
                            <td><b>DOB</b></td>
                            <td>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="DOB" value="<?php echo $emp_obj['DOB']; ?>" data-target="#reservationdate"  placeholder="Select DOB" />                                       
                                      </div>
                            </td>
                        </tr>                        
                        <tr>
                            <td><b>Contact No</b></td>
                            <td><input type="text" name="ContactNo" class="form-control" value="<?php echo $emp_obj['ContactNo']; ?>" placeholder="Contact No"></td>
                        </tr>                        
                        <tr>
                            <td><b>Emergency Contact No</b></td>
                            <td><input type="text" name="AltContactno" class="form-control" value="<?php echo $emp_obj['AltContactno']; ?>" placeholder="Emergency Contact No"></td>
                        </tr>                        
                        <tr>
                            <td><b>Official Email Id </b></td>
                            <td><input type="text" name="Email" class="form-control" value="<?php echo $emp_obj['Email']; ?>" placeholder="Official Email Id"></td>
                        </tr>                        
                        <tr>
                            <td><b>Personal Email Id </b></td>
                            <td><input type="text" name="PersonalMail" class="form-control" value="<?php echo $emp_obj['PersonalMail']; ?>" placeholder="Personal Email Id"></td>
                        </tr>                        
                        <tr>
                            <td><b>Place Of Birth</b></td>
                            <td><input type="text" name="PlaceOfBirth" class="form-control" value="<?php echo $emp_obj['PlaceOfBirth']; ?>" placeholder="Place Of Birth"></td>
                        </tr>                        
                        <tr>
                            <td><b>Blood Group</b></td>
                            <td><input type="text" name="BLOODGROUP" class="form-control" value="<?php echo $emp_obj['BLOODGROUP'];?>" placeholder="Blood Group"></td>
                        </tr>                        
                                                
                      </tbody>
                    </table> 
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="address">
                    <table class="table ">                      
                      <tbody>                        
                        <tr>
                            <td><b>Mother Name</b></td>
                            <td><input type="text" name="MotherName" class="form-control" value="<?php echo $emp_obj['MotherName']; ?>" placeholder="Mother Name" ></td>
                        </tr>
                        <tr>
                            <td><b>Father Name</b></td>
                            <td><input type="text" name="FatherName" class="form-control" value="<?php echo $emp_obj['FatherName']; ?>" placeholder="Father Name"></td>
                        </tr>
                        
                        <tr>
                            <td><b>Residential Address</b></td>
                            <td>
                              <textarea class="form-control" name="ResidentialAddress" placeholder="Residential Address"><?php echo $emp_obj['ResidentialAddress']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Permanent Address</b></td>
                            <td>
                              <textarea class="form-control" name="PermanentAddress" placeholder="Permanent Address" ><?php echo $emp_obj['PermanentAddress']; ?></textarea>  
                            </td>
                        </tr>
                                               
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-pane -->

                 
                  <div class="tab-pane" id="employement">
                    <table class="table ">                      
                      <tbody> 
                        <tr>
                          <td><b>Department</b></td>
                          <td>
                            <select class="form-control" name="DepartmentId">
                              <option value="default"> Please Select </option>
                              <?php  foreach($selectdepart as $row){ ?>
                              <option  value="<?php echo  $row["IDPK"] ?>"  
                                <?php if($emp_obj['DepartmentId']==$row["IDPK"]){ echo "selected"; } ?>>
                                <?php echo $row["deptName"]; ?></option>
                              <?php } ?>
                            </select>                              
                          </td>
                        </tr>                        
                        <tr>
                          <td><b>Designation</b></td>
                          <td>
                            <select class="form-control" name="DesignationIDFK">
                              <option value="default"> Please Select </option>
                              <?php  foreach($selectdesignation as $row){ ?>
                              <option  value="<?php echo  $row["IDPK"] ?>"  
                              <?php if($emp_obj['DesignationIDFK']==$row["IDPK"]){ echo "selected"; } ?>>
                              <?php echo $row["designations"]; ?></option>
                              <?php }?>
                            </select>                              
                          </td>
                        </tr>                        
                                              
                        <tr>
                          <td><b>Profile Photo</b></td>
                          <td>
                            <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" name="Image" class="custom-file-input" id="Image" onchange="readURL(this);" accept=".png, .jpg, .jpeg" value="<?php echo $emp_obj['Image']; ?>" />
                                  
                                  <label class="custom-file-label" >Choose file</label>
                                </div>                                  
                              </div>                                  
                              
                              <div class="widget-user-image">
                                <?php
                                  if ($emp_obj['Image'] == NULL){?>
                                  <div class="form-group col-md-6">
                                    <img id="blah"  name="Image" src="<?php echo base_url('Uploads/ProfilePhotosuploads/'.$emp_obj['Image']); ?>" alt="<?php echo $emp_obj['EmployeeName'].' No Image'; ?>" width="200" height="150"/>
                                  </div> 
                                <?php }else{?>
                                    <img class="img-circle elevation-2 profileImg_size" src="<?php echo base_url('Public/Uploads/ProfilePhotosuploads/'.$emp_obj['Image']); ?>" alt="<?php echo $emp_obj['EmployeeName']; ?>">
                                    <?php
                                  }
                                ?>
                              </div>
                          </td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                             <td>
                                <select class="form-control" name="Status" id='inactive'>
                                  <?php
                                    if ($emp_obj['Status'] == 'Working') {?>

                                       <option value='Working' selected>Active</option>
                                       <option value='InActive' >InActive</option>
                                       <option value='Abscond'>Abscond</option>

                                    <?php } elseif($emp_obj['Status'] == 'InActive') {?>
                                       <option value='InActive' selected  >InActive</option>
                                       <option value='Working'>Active</option>
                                       <option value='Abscond'>Abscond</option>
                                    
                                    <?php } else {?>
                                       <option value='Abscond'>Abscond</option>
                                       <option value='InActive' selected  >InActive</option>
                                       <option value='Working'>Active</option>
                                    <?php }
                                  ?>
                                </select>
                        </tr>
                        <tr>
                            <td><b>Employement Type</b></td>
                             <td>
                              <select class="form-control" name="EmployementType">
                                <option value="default"> Please Select </option>
                                <?php  foreach($selectEmpType as $row){ ?>
                                <option  value="<?php echo  $row["IDPK"] ?>"  
                                <?php if($emp_obj['EmployementType']==$row["IDPK"]){ echo "selected"; } ?>>
                                <?php echo $row["EmployeeTypeName"]; ?></option>
                                <?php } ?>
                              </select>                                
                            </td>
                        </tr>                        
                                               
                        <tr>
                            <td><b>Date of Joining</b></td>
                            <td>
                                <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="DOJ" value="<?php echo $emp_obj['DOJ']; ?>" data-target="#reservationdate1"  placeholder="Select DOJ" required/>                                       
                                </div>
                            
                            </td>
                        </tr>                        
                        <tr id="dor">
                            <td><b>Date of Resign</b></td>
                            <td>
                                <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="DOR" value="<?php echo $emp_obj['DOR']; ?>" data-target="#reservationdate2"  placeholder="Select DOR" /> 
                                </div>
                            
                            </td>
                        </tr>                        
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="input-group-append">
                    <button type="submit" class="btn bg-orange">Update</button>
                    <a class="btn btn-outline-warning ml-2" href="<?php echo base_url('editEmp-view/'.$emp_obj['EmployeeId']);?> " >Cancel</a>
                    <button type="reset" class="btn btn-danger ml-2">Clear</button>
                  </div>
                </div>
                </form>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <!-- /.col -->
               
              
          
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </section>
    <!-- /.content -->

</div>


<script>
  $(function() {
        $('#dor').hide(); 
         

        $('#inactive').change(function(){
            if($('#inactive').val() == 'InActive') {
                $('#dor').show(); 
                
            } else {
                $('#dor').hide(); 
               
            } 
        });
    });
</script>
<!-- below jquery things triggered on on input event and checks the Employee code availability in the database -->
<script type="text/javascript">
		$(document).ready(function() {
			$("#EmployeeCode").on("input", function(e) {
				$('#error_EmployeeCode').hide();
				if ($('#EmployeeCode').val() == null || $('#EmployeeCode').val() == "") {
					$('#error_EmployeeCode').show();
					$("#error_EmployeeCode").html("EmployeeCode is a required field.").css("color", "red");
				} else {
					$.ajax({
						type: 'post',
						url: "<?= site_url('check-EmpCode-availability')//site_url('user/check_EmpCode_availability') ?>",
						data: JSON.stringify({EmpCode: $('#EmployeeCode').val()}),
						contentType: 'application/json; charset=utf-8',
						dataType: 'html',
						cache: false,
						beforeSend: function (f) {
							$('#error_EmployeeCode').show();
							$('#error_EmployeeCode').html('Checking...');
						},
						success: function(error_EmployeeCode) {
							$('#error_EmployeeCode').show();
							$("#error_EmployeeCode").html(error_EmployeeCode);
						},
						error: function(jqXHR, textStatus, errorThrown) {
							$('#error_EmployeeCode').show();
							$("#error_EmployeeCode").html(textStatus + " " + errorThrown);
						}
					});
				}
			});
		});
</script>

<?= $this->endSection() ?>

