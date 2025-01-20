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
            <h1 class="m-0">Add New Employee</h1>
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
          <!-- /.col -->
          

          <div class="col-md-12">
            <div class="card">
            
            
              <form  id="register_form" action="<?= site_url('/store-emp') ?>" method="post" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="card-header p-2">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active_tab1 "  id="list_login_details">General Info</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link inactive_tab1 " id="list_personal_details" >Address</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link inactive_tab1 " id="list_contact_details" >Employement </a>
                    </li>
                  </ul>
                </div>

                <div class="card-body">
                  <div class="tab-content" >
                    <div class="tab-pane active" id="login_details">
                      <div class="panel panel-default">
                       
                        <div class="panel-body">
                          <table class="table ">                      
                            <tbody>                        
                              <tr>
                                  <td><b>Employee Name </b> <i class="fa-solid fa-star-of-life starimp"></i> </td>
                                  <td><input type="text" name="EmployeeName" id="EmployeeName" class="form-control" placeholder="Employee Name">
                                        <span id="error_EmployeeName" class="text-danger"></span>
                                      </td>
                              </tr>
                              <tr>
                                  <td><b>Employee Code</b> <i class="fa-solid fa-star-of-life starimp"></i> </td>
                                  <td><input type="text" name="EmployeeCode" id="EmployeeCode" class="form-control" placeholder="Employee Code" >
                                      <span id="error_EmployeeCode" class="text-danger"></span>
                                      <!-- <div id="msg"></div> -->
                                    </td>
                              </tr>                        
                              <tr>
                                  <td><b>Gender</b></td>
                                  <td>
                                      <select class="form-control" name="Gender">
                                        <option value="Female" >Female</option>                                        
                                        <option value="Male" >Male</option>                                                                          
                                      </select>
                                  </td>
                              </tr>                        
                              <tr>
                                  <td><b>DOB</b> <i class="fa-solid fa-star-of-life starimp"></i> </td>
                                  <td>
                                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="DOB" id="DOB" data-target="#reservationdate" placeholder="Select DOB" required/>
                                      
                                      </div>
                                      
                                      <span id="error_DOB" class="text-danger"></span></td>
                              </tr>                        
                              <tr>
                                  <td><b>Contact No</b> <i class="fa-solid fa-star-of-life starimp"></i> </td>
                                  <td><input type="number" name="ContactNo" id="ContactNo" class="form-control" placeholder=" Contact No" >
                                      <span id="error_ContactNo" class="text-danger"></span></td>
                              </tr>                        
                              <tr>
                                  <td><b>Emergency Contact No</b>  </td>
                                  <td><input type="number" name="AltContactno" id="AltContactno" class="form-control" placeholder="Emergency Contact No" ></td>
                              </tr>                        
                              <tr>
                                  <td><b>Official Email Id </b> <i class="fa-solid fa-star-of-life starimp"></i> </td>
                                  <td><input type="text" name="Email" id="email" class="form-control" placeholder="Official Email ID" >
                                      <span id="error_email" class="text-danger"></span></td>
                              </tr>                        
                              <tr>
                                  <td><b>Personal Email Id </b> <i class="fa-solid fa-star-of-life starimp"></i> </td>
                                  <td><input type="text" name="PersonalMail" id="pemail" class="form-control" placeholder="Personal Email ID" >
                                      <span id="error_pemail" class="text-danger"></span></td>
                              </tr>                        
                              <tr>
                                  <td><b>Place Of Birth</b></td>
                                  <td><input type="text" name="PlaceOfBirth" class="form-control" placeholder=" Place Of Birth" ></td>
                              </tr>                        
                              <tr>
                                  <td><b>Blood Group</b></td>
                                  <td><input type="text" name="BLOODGROUP" class="form-control" placeholder=" Blood Group" ></td>
                              </tr>                        
                                                      
                            </tbody>
                          </table>
                          <div align="center">
                            <button type="button" name="btn_generalinfo" id="btn_generalinfo" class="btn btn-info">Next</button>
                          </div>
                            
                        </div>
                      </div>
                    </div>
                    
                    
                    <div class="tab-pane " id="personal_details">
                      <div class="panel panel-default">
                     
                        <div class="panel-body">
                          <table class="table ">                      
                            <tbody>                        
                              <tr>
                                  <td><b>Mother Name</b> <i class="fa-solid fa-star-of-life starimp"></i></td>
                                  <td><input type="text" name="MotherName" id="MotherName" class="form-control" placeholder=" Mother Name">
                                      <span id="error_MotherName" class="text-danger"></span></td>
                              </tr>
                              <tr>
                                  <td><b>Father Name</b> <i class="fa-solid fa-star-of-life starimp"></i></td>
                                  <td><input type="text" name="FatherName" id="FatherName" class="form-control" placeholder=" Father Name"> 
                                      <span id="error_FatherName" class="text-danger"></span></td>
                              </tr>
                              
                              <tr>
                                  <td><b>Residential Address</b></td>
                                  <td>
                                      <textarea name="ResidentialAddress" class="form-control" placeholder=" ResidentialAddress"></textarea></td>
                              </tr>
                              <tr>
                                  <td><b>Permanent Address</b> <i class="fa-solid fa-star-of-life starimp"></i></td>
                                  <td><textarea name="PermanentAddress" id="PermanentAddress" class="form-control" placeholder=" PermanentAddress"></textarea>
                                      <span id="error_PermanentAddress" class="text-danger"></span></td>
                              </tr>
                                                    
                            </tbody>
                          </table>
                          <div align="center">
                            <button type="button" name="previous_btn_address" id="previous_btn_address" class="btn btn-default ">Previous</button>
                            <button type="button" name="btn_address" id="btn_address" class="btn btn-info ">Next</button>
                          </div>
                          
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane " id="contact_details">
                      <div class="panel panel-default">                        
                        <div class="panel-body">
                          <table class="table ">                      
                            <tbody>  
                            <tr>
                              
                              <tr>
                                  <td><b>Department</b></td>
                                  <td>
                                     
                                      <select class="form-control" name="DepartmentId">
                                        <option>--Select-- </option>
                                            <?php
                                            if($selectdepart){
                                              foreach ($selectdepart as $row) {?>
                                              <option  value="<?php echo $row["IDPK"] ?>"><?php echo $row["deptName"] ?> </option>
                                              <?php
                                             } }?>
                                        </select>     

                                  </td>
                              </tr>                        
                              <tr>
                                  <td><b>Designation</b></td>
                                  <td>
                                     
                                      <select class="form-control" name="DesignationIDFK">
                                        <option>--Select-- </option>
                                            <?php
                                            if($selectdesignation){
                                              foreach ($selectdesignation as $row) {?>
                                              <option  value="<?php echo $row["IDPK"] ?>"><?php echo $row["designations"] ?> </option>
                                              <?php
                                             } }?>
                                        </select>     

                                  </td>
                              </tr>                        
                                                   
                              <tr>
                                  <td><b>Profile Photo</b></td>
                                  <td><div class="input-group">
                                        <div class="custom-file">
                                          <input type="file" name="Image"  class="custom-file-input" id="Image" onchange="readURL(this);" accept=".png, .jpg, .jpeg" required/>
                                          <!-- <input type="file" class="custom-file-input" name="file" > -->
                                          <label class="custom-file-label" >Choose file</label>
                                        </div>                                  
                                      </div>                                  
                                      <div class="form-group col-md-6">
                                        <img id="blah" src="https://www.tutsmake.com/wp-content/uploads/2019/01/no-image-tut.png" class="" width="200" height="150"/>
                                      </div> 
                                  </td>
                              </tr>
                              <tr>
                                  <td><b>Status</b></td>
                                  <td>
                                  <select class="form-control" name="Status">
                                        <option value="Working" >Active</option>
                                        <option value="InActive" >InActive</option>                                        
                                        <option value="Abscond" >Abscond</option>                                        
                                      </select></td>
                              </tr>
                              <tr>
                                  <td><b>Employement Type</b></td>
                                  <td>
                                      <select class="form-control" name="EmployementType" required>
                                        <option>--Select-- </option>
                                            <?php
                                            if($selectEmpType){
                                              foreach ($selectEmpType as $row) {?>
                                              <option  value="<?php echo $row["IDPK"] ?>"><?php echo $row["EmployeeTypeName"] ?> </option>
                                              <?php
                                             } }?>
                                      </select>
                                  </td>
                              </tr>        
                                             
                                                    
                              <tr>
                                  <td><b>Date of Joining</b>  <i class="fa-solid fa-star-of-life starimp"></i></td>
                                  <td>
                                      <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="DOJ" id="DOJ" data-target="#reservationdate1" placeholder="Select DOJ" required/>
                                      
                                      </div>
                                      <span id="error_DOJ" class="text-danger"></td>
                              </tr>                        
                              <tr>
                                  <td><b>Date of Resign</b></td>
                                  <td>
                                      <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="DOR"  data-target="#reservationdate2" placeholder="Select DOR" />
                                      
                                      </div>
                                      
                              </tr>                        
                            </tbody>
                          </table>
                          <div align="center">
                            <button type="button" name="previous_btn_contact_details" id="previous_btn_contact_details" class="btn btn-default ">Previous</button>
                            <button type="submit" name="btn_contact_details" id="btn_contact_details" class="btn btn-success " onclick="return myFunction()">Register</button>
                          </div>                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>

              
           
          
        
            </div>
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


<!-- profile pic sweet alert  -->
<!-- <script>
    function myFunction(){
        let filecheck = document.getElementById("Image").value;
        if(filecheck == '')
        {        
            Swal.fire({
                timer: 3000,
                icon: 'info',
                // toast: true,
                // position: 'top-end',
                title:'Please Select the Profile Image',
                showConfirmButton: false,

            })
            return false;

        }
    }

</script> -->
     
   

<script>
  $(document).ready(function(){
  
    $('#btn_generalinfo').click(function(){
      
      var error_EmployeeCode = '';
      var error_EmployeeName = '';
      var error_email = '';
      var error_ContactNo = '';
      var error_DOB = '';
      var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      var nameFilter = /^([a-zA-Z_\.\ ])+$/;
      
      if($.trim($('#email').val()).length == 0){
        error_email = 'Email is required';
        $('#error_email').text(error_email);
        $('#email').addClass('has-error');
      }else{
      if (!filter.test($('#email').val())){
        error_email = 'Invalid Email';
        $('#error_email').text(error_email);
        $('#email').addClass('has-error');
      } else {
        error_email = '';
        $('#error_email').text(error_email);
        $('#email').removeClass('has-error');
      }
      }
      if($.trim($('#pemail').val()).length == 0){
        error_pemail = 'Personal Email is required';
        $('#error_pemail').text(error_pemail);
        $('#pemail').addClass('has-error');
      }else{
      if (!filter.test($('#pemail').val())){
        error_pemail = 'Invalid pEmail';
        $('#error_pemail').text(error_pemail);
        $('#pemail').addClass('has-error');
      } else {
        error_pemail = '';
        $('#error_pemail').text(error_pemail);
        $('#pemail').removeClass('has-error');
      }
      }
      
      if($.trim($('#EmployeeCode').val()).length == 0){
        error_EmployeeCode = 'Employee Code is required';
        $('#error_EmployeeCode').text(error_EmployeeCode);
        $('#EmployeeCode').addClass('has-error');
      }else{
        error_EmployeeCode = '';
        $('#error_EmployeeCode').text(error_EmployeeCode);
        $('#EmployeeCode').removeClass('has-error');
      }

      if($.trim($('#EmployeeName').val()).length == 0){
        error_EmployeeName = 'EmployeeName is required';
        $('#error_EmployeeName').text(error_EmployeeName);
        $('#EmployeeName').addClass('has-error');
      }else{
      if (!nameFilter.test($('#EmployeeName').val())){
        error_EmployeeName = 'Invalid EmployeeName';
        $('#error_EmployeeName').text(error_EmployeeName);
        $('#EmployeeName').addClass('has-error');
      } else {
        error_EmployeeName = '';
        $('#error_EmployeeName').text(error_EmployeeName);
        $('#EmployeeName').removeClass('has-error');
      }
      }

      if($.trim($('#ContactNo').val()).length == 0) {
        error_ContactNo = 'Contact No is required';
        $('#error_ContactNo').text(error_ContactNo);
        $('#ContactNo').addClass('has-error');
      }else{
        error_ContactNo = '';
        $('#error_ContactNo').text(error_ContactNo);
        $('#ContactNo').removeClass('has-error');
      }

      if($.trim($('#DOB').val()).length == 0) {
        error_DOB = 'DOB is required';
        $('#error_DOB').text(error_DOB);
        $('#DOB').addClass('has-error');
      }else{
        error_DOB = '';
        $('#error_DOB').text(error_DOB);
        $('#DOB').removeClass('has-error');
      }

      if(error_email != '' || error_EmployeeCode != '' || error_EmployeeName != '' || error_ContactNo != '' || error_DOB != '')
      {
      return false;
      }
      else
      {
      $('#list_login_details').removeClass('active active_tab1');
      $('#list_login_details').removeAttr('href data-toggle');
      $('#login_details').removeClass('active');
      $('#list_login_details').addClass('inactive_tab1');
      $('#list_personal_details').removeClass('inactive_tab1');
      $('#list_personal_details').addClass('active_tab1 active');
      $('#list_personal_details').attr('href', '#personal_details');
      $('#list_personal_details').attr('data-toggle', 'tab');
      $('#personal_details').addClass('active in');
      }
    });
    
    $('#previous_btn_address').click(function(){
      $('#list_personal_details').removeClass('active active_tab1');
      $('#list_personal_details').removeAttr('href data-toggle');
      $('#personal_details').removeClass('active in');
      $('#list_personal_details').addClass('inactive_tab1');
      $('#list_login_details').removeClass('inactive_tab1');
      $('#list_login_details').addClass('active_tab1 active');
      $('#list_login_details').attr('href', '#login_details');
      $('#list_login_details').attr('data-toggle', 'tab');
      $('#login_details').addClass('active in');
    });
    
    $('#btn_address').click(function(){
      var error_MotherName = '';
      var error_FatherName = '';
      var error_PermanentAddress = '';
      var nameFilter = /^([a-zA-Z_\.\ ])+$/;
      

      if($.trim($('#MotherName').val()).length == 0){
        error_MotherName = 'MotherName is required';
        $('#error_MotherName').text(error_MotherName);
        $('#MotherName').addClass('has-error');
      }else{
      if (!nameFilter.test($('#MotherName').val())){
        error_MotherName = 'Invalid MotherName';
        $('#error_MotherName').text(error_MotherName);
        $('#MotherName').addClass('has-error');
      } else {
        error_MotherName = '';
        $('#error_MotherName').text(error_MotherName);
        $('#MotherName').removeClass('has-error');
      }
      }

      if($.trim($('#FatherName').val()).length == 0){
        error_FatherName = 'FatherName is required';
        $('#error_FatherName').text(error_FatherName);
        $('#FatherName').addClass('has-error');
      }else{
      if (!nameFilter.test($('#FatherName').val())){
        error_FatherName = 'Invalid FatherName';
        $('#error_FatherName').text(error_FatherName);
        $('#FatherName').addClass('has-error');
      } else {
        error_FatherName = '';
        $('#error_FatherName').text(error_FatherName);
        $('#FatherName').removeClass('has-error');
      }
      }

      
      if($.trim($('#PermanentAddress').val()).length == 0)
      {
      error_PermanentAddress = 'PermanentAddress is required';
      $('#error_PermanentAddress').text(error_PermanentAddress);
      $('#PermanentAddress').addClass('has-error');
      }
      else
      {
      error_PermanentAddress = '';
      $('#error_PermanentAddress').text(error_PermanentAddress);
      $('#PermanentAddress').removeClass('has-error');
      }

      if(error_MotherName != '' || error_PermanentAddress != '' || error_FatherName != '')
      {
      return false;
      }
      else
      {
      $('#list_personal_details').removeClass('active active_tab1');
      $('#list_personal_details').removeAttr('href data-toggle');
      $('#personal_details').removeClass('active');
      $('#list_personal_details').addClass('inactive_tab1');
      $('#list_contact_details').removeClass('inactive_tab1');
      $('#list_contact_details').addClass('active_tab1 active');
      $('#list_contact_details').attr('href', '#contact_details');
      $('#list_contact_details').attr('data-toggle', 'tab');
      $('#contact_details').addClass('active in');
      }
    });
    
    $('#previous_btn_contact_details').click(function(){
      $('#list_contact_details').removeClass('active active_tab1');
      $('#list_contact_details').removeAttr('href data-toggle');
      $('#contact_details').removeClass('active in');
      $('#list_contact_details').addClass('inactive_tab1');
      $('#list_personal_details').removeClass('inactive_tab1');
      $('#list_personal_details').addClass('active_tab1 active');
      $('#list_personal_details').attr('href', '#personal_details');
      $('#list_personal_details').attr('data-toggle', 'tab');
      $('#personal_details').addClass('active in');
    });
    
    $('#btn_contact_details').click(function(){
      var error_DOJ = '';
      
      // var mobile_validation = /^\d{10}$/;
      if($.trim($('#DOJ').val()).length == 0)
      {
      error_DOJ = 'DOJ is required';
      $('#error_DOJ').text(error_DOJ);
      $('#DOJ').addClass('has-error');
      }
      else
      {
      error_DOJ = '';
      $('#error_DOJ').text(error_DOJ);
      $('#DOJ').removeClass('has-error');
      }
      
      if(error_DOJ != '' )
      {
      return false;
      }
      else
      {
      $('#btn_contact_details').attr("disabled", "disabled");
      $(document).css('cursor', 'prgress');
      $("#register_form").submit();
      }
      
    });
  
  });
</script>

   

 

<?= $this->endSection() ?>

