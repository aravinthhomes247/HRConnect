<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>

<?php
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
}
?>

<style>
  .holiday{
    width: 97%;
  }

  .add-holiday, .tabstate{
    height: max-content;
  }

  .add-holiday .tabstate .col {
    justify-content: center !important;
    display: flex !important;
  }

  .add-holiday .tabstate .col hr.line {
    width: 15%;
    border: none;
    border-top: 3px dashed #8146D4;
    opacity: 1 !important;
    margin-top: 1% !important;
    height: 20px;
  }

  .add-holiday .tabstate .col hr.line.over {
    width: 15%;
    border: none;
    border-top: 3px solid #8146D4;
    opacity: 1 !important;
  }

  .add-holiday .tabstate .col .st {
    color: #8146D4;
    border: 1px solid #8146D4;
    border-radius: 50%;
    padding: 0px 9px;
    width: 30px;
    height: 30px;
  }

  .add-holiday .tabstate .col .st.over {
    color: white;
    background-color: #8146D4;
    border: 1px solid #8146D4;
    border-radius: 50%;
    padding: 0px 7px;
    width: 30px;
    height: 30px;
  }

  .add-holiday .tabstate .col span.active {
    color: #8146D4;
  }

  a.btn.next {
    border: 1px solid #8146D4 !important;
    border-radius: 3px !important;
    background-color: white !important;
    color: #8146D4 !important;
    width: max-content !important;
    margin-left: 0% !important;
  }

  a.btn.next:hover {
    border: 1px solid #8146D4 !important;
    border-radius: 3px !important;
    background-color: #8146D4 !important;
    color: white !important;
    width: max-content !important;
  }

  a.btn.next:hover i {
    color: white;
  }

  button.sub {
    border: 1px solid #8146D4 !important;
    border-radius: 3px !important;
    background-color: white !important;
    color: #8146D4 !important;
    width: max-content !important;
  }

  button.sub:hover {
    border: 1px solid #8146D4 !important;
    border-radius: 3px !important;
    background-color: #8146D4 !important;
    color: white !important;
    width: max-content !important;
  }

  button.sub:hover i {
    color: white;
  }

  .row .buttons {
    text-align: end !important;
  }

  .files .upload .file {
    border: 0.5px solid #8146D4 !important;
    border-radius: 2px !important;
    width: 85% !important;
    padding-left: 0% !important;
    padding-top: 0% !important;
    padding-bottom: 0% !important;
    padding-right: 0% !important;
    display: flex !important;
    margin-bottom: 2px !important;
  }

  .files .upload .file .name {
    width: 90% !important;
    background-color: #C7BCD747 !important;
    padding-left: 2% !important;
  }

  .files .upload a.addfile {
    background-color: white !important;
    padding: 0% !important;
  }

  .files .upload .file a {
    width: 10% !important;
    text-align: center !important;
    background-color: white;
    padding: 0% !important;
  }

  .files .upload .file .x {
    border-left: 0.5px solid #8146D4 !important;
  }

  .form-control{
    font-size: smaller;
  }

  .input-group{
    font-size: smaller;
  }

  .tab{
    font-size: smaller;
  }
</style>


<div class="holiday ms-4 mt-1">
  <div class="row ms-0 me-0 mt-2">
    <div class="col col-lg-9 mt-1">
      <h4>Add New Employee</h4>
    </div>
  </div>

  <div class="row ms-1 me-1 pt-2 add-holiday">
    <div class="row ms-1 mb-2 tabstate">
      <div class="col col-lg-12">
        <div class="st" id="st-1">1</div>
        <hr class="line mt-3" id="hr-1">
        <div class="st" id="st-2">2</div>
        <hr class="line mt-3" id="hr-2">
        <div class="st" id="st-3">3</div>
        <hr class="line mt-3" id="hr-3">
        <div class="st">4</div>
      </div>
      <div class="col col-lg-12 mt-2">
        <div class="col col-lg-3">
        </div>
        <div class="col col-lg-2">
          <span class="active ps-2" id="stt-1" style="font-size: smaller;">Personal Information</span>
        </div>
        <div class="col col-lg-2">
          <span class="ps-4" id="stt-2" style="font-size: smaller;">Work Information</span>
        </div>
        <div class="col col-lg-2">
          <span id="stt-3" style="font-size: smaller;">Bank Information</span>
        </div>
        <div class="col col-lg-2">
          <span class="ps-2" id="stt-4" style="font-size: smaller;">Files</span>
        </div>
        <div class="col col-lg-3">
        </div>
      </div>
    </div>

    <form action="<?= site_url('/store-emp') ?>" method="POST" id="AddEmployeeForm" enctype="multipart/form-data" autofill="none">
      <input type="file" name="Image" id="Image" style="display:none;">

      <div class="tab" id="tab1">
        <div class="row ms-4 mt-1">
          <h5>Personal Information</h5>
          <div class="row row-lg-12">
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Employee Name</label>
                <input type="text" class="form-control" name="EmployeeName" id="EmployeeName" placeholder="Enter Employee Name">
                <div class="invalid-feedback">Please provide a valid Employee Name.</div>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Employee Code</label>
                <input type="text" class="form-control" name="EmployeeCode" id="EmployeeCode" placeholder="Enter Employee Code">
                <span id="error_EmployeeCode"></span>
                <div class="invalid-feedback">Please provide a valid Employee Code.</div>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Gender</label>
                <select class="form-control" name="Gender" id="Gender">
                  <option value="">Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Transgender">Transgender</option>
                </select>
                <div class="invalid-feedback">Please select a valid Gender.</div>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Date Of Birth</label>
                <input type="date" class="form-control" name="DOB" id="DOB">
                <div class="invalid-feedback">Please provide a valid Date of Birth.</div>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Blood Group</label>
                <select class="form-control" name="BLOODGROUP" id="BLOODGROUP">
                  <option value="">Select Blood Group</option>
                  <option value="A+ve">A+ve</option>
                  <option value="A-ve">A-ve</option>
                  <option value="B+ve">B+ve</option>
                  <option value="B-ve">B-ve</option>
                  <option value="O+ve">O+ve</option>
                  <option value="O-ve">O-ve</option>
                  <option value="AB+ve">AB+ve</option>
                  <option value="AB-ve">AB-ve</option>
                </select>
                <div class="invalid-feedback">Please select a valid Blood Group.</div>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Father Name</label>
                <input type="text" class="form-control" name="FatherName" id="FatherName" placeholder="Enter Father's Name">
                <div class="invalid-feedback">Please provide a valid Father Name.</div>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Mother Name</label>
                <input type="text" class="form-control" name="MotherName" id="MotherName" placeholder="Enter Mother's Name">
                <div class="invalid-feedback">Please provide a valid Mother Name.</div>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Place of Birth</label>
                <input type="text" class="form-control" name="PlaceOfBirth" id="PlaceOfBirth" placeholder="Enter Place of Birth">
                <div class="invalid-feedback">Please provide a valid Place of Birth.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="row ms-4 mt-1">
          <h5>Contact Information</h5>
          <div class="row row-lg-12">
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Contact Number</label>
                <input type="text" class="form-control" name="ContactNo" id="ContactNo" placeholder="Enter Contact Number">
                <div class="invalid-feedback">Please provide a valid Contact Number.</div>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Alternate Number</label>
                <input type="text" class="form-control" name="AltContactno" id="AltContactno" placeholder="Enter Alternate Number">
                <div class="invalid-feedback">Please provide a valid Alternate Number.</div>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Emergency Number</label>
                <input type="text" class="form-control" name="EContactNo" id="EContactNo" placeholder="Enter Emergency Number">
                <div class="invalid-feedback">Please provide a valid Emergency Number.</div>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Personal Mail ID</label>
                <input type="email" class="form-control" name="PersonalMail" id="PersonalMail" placeholder="Enter Personal Mail">
                <div class="invalid-feedback">Please provide a valid Personal Mail.</div>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Official Mail ID</label>
                <input type="email" class="form-control" name="Email" id="Email" placeholder="Enter Official Mail">
                <div class="invalid-feedback">Please provide a valid Official Mail.</div>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Residential Address</label>
                <textarea class="form-control" name="ResidentialAddress" id="ResidentialAddress" placeholder="Enter Residential Address"></textarea>
                <div class="invalid-feedback">Please provide a valid Residential Address.</div>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Permanent Address</label>
                <textarea class="form-control" name="PermanentAddress" id="PermanentAddress" placeholder="Enter Permanent Address"></textarea>
                <div class="invalid-feedback">Please provide a valid Permanent Address.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="row ms-4 mt-2 mb-2 pb-1 me-5">
          <div class="buttons">
            <a href="javascript:void(0);" class="btn next p-1" data-tab="2" data-next="1"> Next <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>
      </div>

      <div class="tab" id="tab2" style="display:none;">
        <div class="row ms-4 mt-1">
          <h5>Employment Information</h5>
          <div class="row row-lg-12">
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Department</label>
                <select class="form-control" name="DepartmentId" id="DepartmentId">
                  <option value="">Select Department</option>
                  <?php foreach ($selectdepart as $department): ?>
                    <option value="<?= $department['IDPK'] ?>"><?= $department['deptName'] ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Please select a valid Department.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Designation</label>
                <select class="form-control" name="DesignationIDFK" id="DesignationIDFK">
                  <option value="">Select Designation</option>
                  <?php foreach ($selectdesignation as $designation): ?>
                    <option value="<?= $designation['IDPK'] ?>"><?= $designation['designations'] ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Please select a valid Designation.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Status</label>
                <select class="form-control" name="Status" id="Status">
                  <option value="">Select Status</option>
                  <option value="Working">Working</option>
                  <option value="InActive">InActive</option>
                  <option value="Abscond">Abscond</option>
                </select>
                <div class="invalid-feedback">Please select a valid status.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Employment Type</label>
                <select class="form-control" name="EmployementType" id="EmployementType">
                  <option value="">Select EmployementType</option>
                  <?php foreach ($selectEmpType as $type): ?>
                    <option value="<?= $type['IDPK'] ?>"><?= $type['EmployeeTypeName'] ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Please select a valid Employement Type.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Date of Joining</label>
                <input type="date" class="form-control" name="DOJ" id="DOJ">
                <div class="invalid-feedback">Please provide a valid Date of Joining.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Reporting To</label>
                <select class="form-control" name="ReportManagerIDFK" id="ReportManagerIDFK">
                  <option value="">Select Manager</option>
                  <?php foreach ($Managers as $manager): ?>
                    <option value="<?= $manager['EmployeeId'] ?>"><?= $manager['EmployeeName'] ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Please select a valid Reporting Person.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Contract Period</label>
                <input type="text" class="form-control" name="ContractPeriod" id="ContractPeriod" placeholder="Ex.2 years">
                <div class="invalid-feedback">Please provide a valid Contract Period.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Salary Date (Every Month)</label>
                <select class="form-control" name="Salary_date" id="Salary_date">
                  <option value="">Select Day</option>
                  <option value="1">01</option>
                  <option value="2">02</option>
                  <option value="3">03</option>
                  <option value="4">04</option>
                  <option value="5">05</option>
                  <option value="6">06</option>
                  <option value="7">07</option>
                  <option value="8">08</option>
                  <option value="9">09</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
                  <option value="17">17</option>
                  <option value="18">18</option>
                  <option value="19">19</option>
                  <option value="20">20</option>
                  <option value="21">21</option>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                </select>
                <div class="invalid-feedback">Please select a valid Salary Day.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Aadhar No</label>
                <input type="text" class="form-control" name="Aadhar_No" id="Aadhar_No" placeholder="Ex.9999 8888 7777 6666">
                <div class="invalid-feedback">Please provide a valid Aadhar Number.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">PAN No</label>
                <input type="text" class="form-control" name="PAN_No" id="PAN_No" placeholder="Ex.AAAA9876B">
                <div class="invalid-feedback">Please provide a valid PAN Number.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">UAN Number</label>
                <input type="text" class="form-control" name="UAN_No" id="UAN_No" placeholder="Enter UAN">
                <div class="invalid-feedback">Please provide a valid UAN Number.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="row ms-4 mt-1">
          <h5>Salary Information</h5>
          <div class="row row-lg-12">
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Basic Salary</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">₹</div>
                  </div>
                  <input type="number" class="form-control" name="BasicSalary" id="BasicSalary" placeholder="Ex.15000.00">
                </div>
                <span id="error_BasicSalary" class="text-danger danger2"></span>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">HRA</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">₹</div>
                  </div>
                  <input type="number" class="form-control" name="HRA" id="HRA" placeholder="Ex.500.00">
                </div>
                <span id="error_HRA" class="text-danger danger2"></span>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">FBP</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">₹</div>
                  </div>
                  <input type="number" class="form-control" name="FBP" id="FBP" placeholder="Ex.300.00">
                </div>
                <span id="error_FBP" class="text-danger danger2"></span>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">PF</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">₹</div>
                  </div>
                  <input type="number" class="form-control" name="PF" id="PF" placeholder="Ex.250.00">
                </div>
                <span id="error_PF" class="text-danger danger2"></span>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">PT</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">₹</div>
                  </div>
                  <input type="number" class="form-control" name="PT" id="PT" placeholder="Ex.250.00">
                </div>
                <span id="error_PT" class="text-danger danger2"></span>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">PF Vol</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">₹</div>
                  </div>
                  <input type="number" class="form-control" name="PF_VOL" id="PF_VOL" placeholder="Ex.500.00">
                </div>
                <span id="error_PF_VOL" class="text-danger danger2"></span>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Insurance</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">₹</div>
                  </div>
                  <input type="number" class="form-control" name="Insurance" id="Insurance" placeholder="Ex.160.00">
                </div>
                <span id="error_Insurance" class="text-danger danger2"></span>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">SD</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">₹</div>
                  </div>
                  <input type="number" class="form-control" name="SD" id="SD" placeholder="Ex.100.00">
                </div>
                <span id="error_SD" class="text-danger danger2"></span>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Gross Salary</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">₹</div>
                  </div>
                  <input type="number" class="form-control" name="GrossSalary" id="GrossSalary" placeholder="Ex.16000.00">
                </div>
                <span id="error_GrossSalary" class="text-danger danger2"></span>
              </div>
            </div>
            <div class="col col-lg-3">
              <div class="mb-2">
                <label class="ps-0">Net Salary</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">₹</div>
                  </div>
                  <input type="number" class="form-control" name="NetSalary" id="NetSalary" placeholder="Ex.14840.00">
                </div>
                <span id="error_NetSalary" class="text-danger danger2"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="row ms-4 mt-2 mb-2 pb-1 me-5">
          <div class="buttons">
            <a href="javascript:void(0);" class="btn next p-1 me-2" data-tab="1"> <i class="fa-solid fa-arrow-left"></i> Back</a>
            <a href="javascript:void(0);" class="btn next p-1" data-tab="3" data-next="1"> Next <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>
      </div>

      <div class="tab" id="tab3" style="display:none;">
        <div class="row ms-4 mt-1">
          <h5>Personal Bank</h5>
          <div class="row row-lg-12">
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Account Holder Name</label>
                <input type="text" class="form-control" name="P_AccountHolderName" id="P_AccountHolderName" placeholder="Enter Account Holder Name">
                <div class="invalid-feedback">Please provide a valid Account Holder Name.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Bank Name</label>
                <input type="text" class="form-control" name="P_BankName" id="P_BankName" placeholder="Enter Bank Name">
                <div class="invalid-feedback">Please provide a valid Bank Name.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Bank Branch</label>
                <input type="text" class="form-control" name="P_BankBranch" id="P_BankBranch" placeholder="Enter Bank Branch">
                <div class="invalid-feedback">Please provide a valid Branch Name.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Account Number</label>
                <input type="text" class="form-control" name="P_AccountNo" id="P_AccountNo" placeholder="Enter Account Number">
                <div class="invalid-feedback">Please provide a valid Account Number.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">IFSC Code</label>
                <input type="text" class="form-control" name="P_IFSCode" id="P_IFSCode" placeholder="Enter IFSC Code">
                <div class="invalid-feedback">Please provide a valid IFSC Code.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Payment Mode</label>
                <select class="form-control" name="P_Mode" id="P_Mode">
                  <option value="">Select Payment Mode</option>
                  <option value="1">Bank Transfer</option>
                  <option value="2">Cash</option>
                  <option value="3">UPI</option>
                  <option value="4">Check</option>
                </select>
                <div class="invalid-feedback">Please select a valid Payment Mode.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="row ms-4 mt-1">
          <h5>Official Bank</h5>
          <div class="row row-lg-12">
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Account Holder Name</label>
                <input type="text" class="form-control" name="O_AccountHolderName" id="O_AccountHolderName" placeholder="Enter Account Holder Name">
                <div class="invalid-feedback">Please provide a valid Account Holder Name.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Bank Name</label>
                <input type="text" class="form-control" name="O_BankName" id="O_BankName" placeholder="Enter Bank Name">
                <div class="invalid-feedback">Please provide a valid Bank Name.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Bank Branch</label>
                <input type="text" class="form-control" name="O_BankBranch" id="O_BankBranch" placeholder="Enter Bank Branch">
                <div class="invalid-feedback">Please provide a valid Branch Name.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Account Number</label>
                <input type="text" class="form-control" name="O_AccountNo" id="O_AccountNo" placeholder="Enter Account Number">
                <div class="invalid-feedback">Please provide a valid Account Number.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">IFSC Code</label>
                <input type="text" class="form-control" name="O_IFSCode" id="O_IFSCode" placeholder="Enter IFSC Code">
                <div class="invalid-feedback">Please provide a valid IFSC Code.</div>
              </div>
            </div>
            <div class="col col-lg-4">
              <div class="mb-2">
                <label class="ps-0">Payment Mode</label>
                <select class="form-control" name="O_Mode" id="O_Mode">
                  <option value="">Select Payment Mode</option>
                  <option value="1">Bank Transfer</option>
                  <option value="2">Cash</option>
                  <option value="3">UPI</option>
                  <option value="4">Check</option>
                </select>
                <div class="invalid-feedback">Please provide a valid Payment Mode.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="row ms-4 mt-2 mb-2 pb-1 me-5">
          <div class="buttons">
            <a href="javascript:void(0);" class="btn next p-1 me-2" data-tab="2"> <i class="fa-solid fa-arrow-left"></i> Back</a>
            <a href="javascript:void(0);" class="btn next p-1" data-tab="4" data-next="1"> Next <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>
      </div>

      <div class="tab files" id="tab4" style="display:none;">
        <div class="row ms-4 mt-1">
          <h5>Employee Files</h5>
          <div class="row mt-4">
            <div class="col upload">
              <span>SSLC mark Sheet <a href="javascript:void(0);" class="addfile" data-cat="1"><i class="fa-solid fa-circle-plus"></i></a></span>
              <input type="file" name="file1[]" id="file1" style="display:none;" multiple>
              <div class="file1-contaniner" id="file1-container"></div>
            </div>

            <div class="col upload">
              <span>PUC mark Sheet <a href="javascript:void(0);" class="addfile" data-cat="2"><i class="fa-solid fa-circle-plus"></i></a></span>
              <input type="file" name="file2[]" id="file2" style="display:none;" multiple>
              <div class="file2-contaniner" id="file2-container"></div>
            </div>

            <div class="col upload">
              <span>Degree Certificate <a href="javascript:void(0);" class="addfile" data-cat="3"><i class="fa-solid fa-circle-plus"></i></a></span>
              <input type="file" name="file3[]" id="file3" style="display:none;" multiple>
              <div class="file3-contaniner" id="file3-container"></div>
            </div>

            <div class="col upload">
              <span>Aadhar Card <a href="javascript:void(0);" class="addfile" data-cat="4"><i class="fa-solid fa-circle-plus"></i></a></span>
              <input type="file" name="file4[]" id="file4" style="display:none;" multiple>
              <div class="file4-contaniner" id="file4-container"></div>
            </div>
          </div>

          <div class="row mt-4">

            <div class="col upload">
              <span>PAN Card <a href="javascript:void(0);" class="addfile" data-cat="5"><i class="fa-solid fa-circle-plus"></i></a></span>
              <input type="file" name="file5[]" id="file5" style="display:none;" multiple>
              <div class="file5-contaniner" id="file5-container"></div>
            </div>

            <div class="col upload">
              <span>Experience letter <a href="javascript:void(0);" class="addfile" data-cat="6"><i class="fa-solid fa-circle-plus"></i></a></span>
              <input type="file" name="file6[]" id="file6" style="display:none;" multiple>
              <div class="file6-contaniner" id="file6-container"></div>
            </div>

            <div class="col upload">
              <span>Pay Slip <a href="javascript:void(0);" class="addfile" data-cat="7"><i class="fa-solid fa-circle-plus"></i></a></span>
              <input type="file" name="file7[]" id="file7" style="display:none;" multiple>
              <div class="file7-contaniner" id="file7-container"></div>
            </div>

            <div class="col upload">
              <span>Bank Statement <a href="javascript:void(0);" class="addfile" data-cat="8"><i class="fa-solid fa-circle-plus"></i></a></span>
              <input type="file" name="file8[]" id="file8" style="display:none;" multiple>
              <div class="file8-contaniner" id="file8-container"></div>
            </div>
          </div>

          <div class="row mt-4">

            <div class="col upload">
              <span>Employer Confirmation <a href="javascript:void(0);" class="addfile" data-cat="9"><i class="fa-solid fa-circle-plus"></i></a></span>
              <input type="file" name="file9[]" id="file9" style="display:none;" multiple>
              <div class="file9-contaniner" id="file9-container"></div>
            </div>

            <div class="col upload">
              <span>Other Documents <a href="javascript:void(0);" class="addfile" data-cat="10"><i class="fa-solid fa-circle-plus"></i></a></span>
              <input type="file" name="file10[]" id="file10" style="display:none;" multiple>
              <div class="file10-contaniner" id="file10-container"></div>
            </div>

            <div class="col upload">
              <div class="file-list" id="fileList"></div>
            </div>

            <div class="col upload"></div>
          </div>

        </div>
        <div class="row ms-4 mt-2 mb-2 pb-1 me-5">
          <div class="buttons">
            <a href="javascript:void(0);" class="btn next p-1 me-2" data-tab="3"> <i class="fa-solid fa-arrow-left"></i> Back</a>
            <button class="sub p-2" type="submit"> Save </button>
          </div>
        </div>
      </div>

    </form>
  </div>
</div>

<script>
  $(document).ready(function() {
    
    const selectedFilesMap = {
      1: [],
      2: [],
      3: [],
      4: [],
      5: [],
      6: [],
      7: [],
      8: [],
      9: [],
      10: []
    };
    const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
    document.getElementById('DOB').setAttribute('max', today);
    document.getElementById('DOJ').setAttribute('max', today);

    // Handle tab navigation
    $('.next').on("click", function() {
      const tab = $(this).data('tab');
      const next = $(this).data('next') !== undefined ? $(this).data('next') : 0;
      let res = form_validate(tab - 1);
      if ((res == true && next == 1) || next == 0) {
        $('[id^="tab"]').hide();
        $('#tab' + tab).show();
        for (let i = 1; i < tab; i++) {
          $('#st-' + i).html('<i class="fa-solid fa-check" style="color: #ffffff;"></i>');
          $('#hr-' + i).addClass('over');
          $('#st-' + i).addClass('over');
        }
        $('#stt-' + tab).addClass('active');
      }
    });

    // Trigger file input on icon click
    $('.add-holiday').on('click', '.addfile', function() {
      const cat = $(this).data('cat');
      $('#file' + cat).data('cat', cat).click();
    });

    // Remove file on remove button click
    $('.upload').on('click', '.removefile', function() {
      const cat = $(this).data('cat');
      const index = $(this).data('id');
      removeFiles(cat, index);
    });

    // Update file display
    function updateFiles(files, cat) {
      const container = $('#file' + cat + '-container');
      if (files.length > 0) {
        const HTML = files.map((file, index) => `
          <div class="file">
            <div class="name"><span>${file.name}</span></div>
            <a href="javascript:void(0);" class="x removefile" data-cat="${cat}" data-id="${index}">
              <i class="fa-solid fa-xmark"></i>
            </a>
          </div>`).join('');
        container.html(HTML);
      } else {
        container.html('<p>No files selected</p>');
      }
    }

    // Handle file input change
    $('[id^="file"]').on('change', function() {
      const cat = $(this).data('cat');
      const files = $(this)[0].files;
      selectedFilesMap[cat] = [];
      if (selectedFilesMap[cat]) {
        Array.from(files).forEach(file => selectedFilesMap[cat].push(file));
        updateFiles(selectedFilesMap[cat], cat);
      }
    });

    // Remove specific file
    function removeFiles(cat, index) {
      const files = selectedFilesMap[cat];
      if (!files) return;
      files.splice(index, 1);
      const fileInput = $('#file' + cat);
      const dataTransfer = new DataTransfer();
      files.forEach(file => dataTransfer.items.add(file));
      fileInput[0].files = dataTransfer.files;
      updateFiles(files, cat);
    }

    $("#EmployeeCode").on("input", function(e) {
      $('#error_EmployeeCode').hide();
      if ($('#EmployeeCode').val() == null || $('#EmployeeCode').val() == "") {
        $('#error_EmployeeCode').show();
        $("#error_EmployeeCode").html("EmployeeCode is a required field.").css("color", "red");
      } else {
        $.ajax({
          type: 'post',
          url: "<?= site_url('check-EmpCode-availability') ?>",
          data: JSON.stringify({
            EmpCode: $('#EmployeeCode').val()
          }),
          contentType: 'application/json; charset=utf-8',
          dataType: 'html',
          cache: false,
          beforeSend: function(f) {
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

    function form_validate(tab) {
      if (tab == 1) {
        $('#EmployeeName,#MotherName,#PlaceOfBirth,#FatherName,#PermanentAddress, #ResidentialAddress, #EContactNo, #EmployeeCode, #Gender, #DOB, #BLOODGROUP, #ContactNo, #PersonalMail, #Email, #AltContactno').removeClass('is-invalid');
        var Test=[];
        if ($('#EmployeeName').val().trim() === '') {
          $('#EmployeeName').addClass('is-invalid');
           Test[0] = false;
        }
        if ($('#EmployeeCode').val().trim() === '') {
          $('#EmployeeCode').addClass('is-invalid');
          Test[1] = false;
        }
        if ($('#Gender').val() === null || $('#Gender').val() === '') {
          $('#Gender').addClass('is-invalid');
          Test[2] = false;
        }
        if ($('#DOB').val().trim() === '') {
          $('#DOB').addClass('is-invalid');
          Test[3] = false;
        }
        const contactNo = $('#ContactNo').val().trim();
        var phonePattern = /^(?:\+91[\s]?\d{10}|\d{10}|\+91\d{10}|\+91-\d{10})$/;
        if (!phonePattern.test(contactNo) || isNaN(contactNo)) {
          $('#ContactNo').addClass('is-invalid');
          Test[4] = false;
        }
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const personalMail = $('#PersonalMail').val().trim();
        if (personalMail === '' || !emailPattern.test(personalMail)) {
          $('#PersonalMail').addClass('is-invalid');
          Test[5] = false;
        }
        const workEmail = $('#Email').val().trim();
        if (workEmail === '' || !emailPattern.test(workEmail)) {
          $('#Email').addClass('is-invalid');
          Test[6] = false;
        }
        if ($('#ResidentialAddress').val().trim() === '') {
          $('#ResidentialAddress').addClass('is-invalid');
          Test[7] = false;
        }
        if ($('#PermanentAddress').val().trim() === '') {
          $('#PermanentAddress').addClass('is-invalid');
          Test[8] = false;
        }
        // if ($('#BLOODGROUP').val() === null || $('#BLOODGROUP').val() === '') {
        //   $('#BLOODGROUP').addClass('is-invalid');
        //   Test[] = false;
        // }
        // const altContactNo = $('#AltContactno').val().trim();
        // if (!phonePattern.test(altContactNo) === '' || isNaN(altContactNo)) {
        //   $('#AltContactno').addClass('is-invalid');
        //   Test[] = false;
        // }
        // const eContactNo = $('#EContactNo').val().trim();
        // if (!phonePattern.test(eContactNo) === '' || isNaN(eContactNo)) {
        //   $('#EContactNo').addClass('is-invalid');
        //   Test[] = false;
        // }
        // if ($('#FatherName').val().trim() === '') {
        //   $('#FatherName').addClass('is-invalid');
        //    Test[] = false;
        // }
        // if ($('#MotherName').val().trim() === '') {
        //   $('#MotherName').addClass('is-invalid');
        //    Test[] = false;
        // }
        // if ($('#PlaceOfBirth').val().trim() === '') {
        //   $('#PlaceOfBirth').addClass('is-invalid');
        //    Test[] = false;
        // }

        for (let index = 0; index < Test.length; index++) {
          if(Test[index] == false){
            return false;
          }
        }
        return true;
      } 
      else if (tab == 2) {
        var Test=[];
        $('.danger2').html('');
        $('.danger2').hide();
        $('#DOJ,#Salary_date,#ReportManagerIDFK,#ContractPeriod,#EmployementType,#Status,#DesignationIDFK,#DepartmentId,#UAN_No,#PAN_No,#Aadhar_No').removeClass('is-invalid');
        if ($('#DOJ').val().trim() === '') {
          $('#DOJ').addClass('is-invalid');
           Test[0] = false;
        }
        if ($('#DepartmentId').val() === null || $('#DepartmentId').val() === '') {
          $('#DepartmentId').addClass('is-invalid');
          Test[1] = false;
        }
        if ($('#DesignationIDFK').val() === null || $('#DesignationIDFK').val() === '') {
          $('#DesignationIDFK').addClass('is-invalid');
          Test[2] = false;
        }
        if ($('#Status').val() === null || $('#Status').val() === '') {
          $('#Status').addClass('is-invalid');
          Test[3] = false;
        }
        if ($('#EmployementType').val() === null || $('#EmployementType').val() === '') {
          $('#EmployementType').addClass('is-invalid');
          Test[4] = false;
        }
        if ($('#ReportManagerIDFK').val() === null || $('#ReportManagerIDFK').val() === '') {
          $('#ReportManagerIDFK').addClass('is-invalid');
          Test[5] = false;
        }
        if ($('#Salary_date').val() === null || $('#Salary_date').val() === '') {
          $('#Salary_date').addClass('is-invalid');  
          Test[6] = false;
        }
        if ($('#BasicSalary').val().trim() === '' || isNaN($('#BasicSalary').val().trim())) {
          $('#error_BasicSalary').html('Basic Salary is required.');
          Test[7] = false;
        }
        if ($('#HRA').val().trim() === '' || isNaN($('#HRA').val().trim())) {
          $('#error_HRA').html('HRA is required.');
          Test[8] = false;
        }
        if ($('#FBP').val().trim() === '' || isNaN($('#FBP').val().trim())) {
          $('#error_FBP').html('FBP is required.');
          Test[9] = false;
        }
        if ($('#PF').val().trim() === '' || isNaN($('#PF').val().trim())) {
          $('#error_PF').html('PF is required.');
          Test[10] = false;
        }
        if ($('#PT').val().trim() === '' || isNaN($('#PT').val().trim())) {
          $('#error_PT').html('PT is required.');
          Test[11] = false;
        }
        if ($('#PF_VOL').val().trim() === '' || isNaN($('#PF_VOL').val().trim())) {
          $('#error_PF_VOL').html('PF VOL is required.');
          Test[12] = false;
        }
        if ($('#Insurance').val().trim() === '' || isNaN($('#Insurance').val().trim())) {
          $('#error_Insurance').html('Insurance is required.');
          Test[13] = false;
        }
        if ($('#SD').val().trim() === '' || isNaN($('#SD').val().trim())) {
          $('#error_SD').html('SD is required.');
          Test[14] = false;
        }
        if ($('#GrossSalary').val().trim() === '' || isNaN($('#GrossSalary').val().trim())) {
          $('#error_GrossSalary').html('GrossSalary is required.');
          Test[15] = false;
        }
        if ($('#NetSalary').val().trim() === '' || isNaN($('#NetSalary').val().trim())) {
          $('#error_NetSalary').html('NetSalary is required.');
          Test[16] = false;
        }
        // if ($('#ContractPeriod').val().trim() === '') {
        //   $('#ContractPeriod').addClass('is-invalid');
        //    Test[] = false;
        // }
        // if ($('#Aadhar_No').val().trim() === '') {
        //   $('#Aadhar_No').addClass('is-invalid');
        //    Test[] = false;
        // }
        // if ($('#PAN_No').val().trim() === '') {
        //   $('#PAN_No').addClass('is-invalid');
        //    Test[] = false;
        // }
        // if ($('#UAN_No').val().trim() === '') {
        //   $('#UAN_No').addClass('is-invalid');
        //    Test[] = false;
        // }
        for (let index = 0; index < Test.length; index++) {
          if(Test[index] == false){
            $('.danger2').show();
            return false;
          }
        }
        return true;
      } 
      else if (tab == 3) {
        var Test=[];
        $('#P_AccountHolderName,#P_BankName,#P_BankBranch,#P_AccountNo,#P_IFSCode,#O_AccountHolderName,#O_BankName,#O_BankBranch,#O_AccountNo,#O_IFSCode,#P_Mode,#O_Mode').removeClass('is-invalid');
        if ($('#P_AccountHolderName').val().trim() === '') {
          $('#P_AccountHolderName').addClass('is-invalid');
           Test[0] = false;
        }
        if ($('#P_BankName').val().trim() === '') {
          $('#P_BankName').addClass('is-invalid');
           Test[1] = false;
        }
        if ($('#P_BankBranch').val().trim() === '') {
          $('#P_BankBranch').addClass('is-invalid');
           Test[2] = false;
        }
        if ($('#P_AccountNo').val().trim() === '') {
          $('#P_AccountNo').addClass('is-invalid');
           Test[3] = false;
        }
        if ($('#P_IFSCode').val().trim() === '') {
          $('#P_IFSCode').addClass('is-invalid');
           Test[4] = false;
        }
        if ($('#O_AccountHolderName').val().trim() === '') {
          $('#O_AccountHolderName').addClass('is-invalid');
           Test[5] = false;
        }
        if ($('#O_BankName').val().trim() === '') {
          $('#O_BankName').addClass('is-invalid');
           Test[6] = false;
        }
        if ($('#O_BankBranch').val().trim() === '') {
          $('#O_BankBranch').addClass('is-invalid');
           Test[7] = false;
        }
        if ($('#O_AccountNo').val().trim() === '') {
          $('#O_AccountNo').addClass('is-invalid');
           Test[8] = false;
        }
        if ($('#O_IFSCode').val().trim() === '') {
          $('#O_IFSCode').addClass('is-invalid');
           Test[9] = false;
        }
        if ($('#P_Mode').val() === null || $('#P_Mode').val() === '') {
          $('#P_Mode').addClass('is-invalid');
          Test[10] = false;
        }
        if ($('#O_Mode').val() === null || $('#O_Mode').val() === '') {
          $('#O_Mode').addClass('is-invalid');
          Test[11] = false;
        }
        for (let index = 0; index < Test.length; index++) {
          if(Test[index] == false){
            return false;
          }
        }
        return true;
      }
    }



  });
</script>


<?= $this->endSection() ?>