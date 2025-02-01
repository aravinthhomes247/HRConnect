<?php

namespace App\Models;

use Codeigniter\Controller\HRController;
use CodeIgniter\Model;
use DateTime;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EmployeeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'employees';
    protected $primaryKey       = 'EmployeeId';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'EmployeeId',
        'EmployeeName',
        'EmployeeCode',
        'EmployeeCodeInDevice',
        'StringCode',
        'NumericCode',
        'Gender',
        'DepartmentId',
        'Designation',
        'DesignationIDFK',
        'ReportManagerIDFK',
        'DOJ',
        'EmployementType',
        'Status',
        'FatherName',
        'MotherName',
        'ResidentialAddress',
        'PermanentAddress',
        'ContactNo',
        'AltContactno',
        'EContactNo',
        'Email',
        'PersonalMail',
        'DOB',
        'DOR',
        'PlaceOfBirth',
        'BLOODGROUP',
        'Image',
        'Salary_date',
        'RecordStatus',
        'ContractPeriod',
        'Aadhar_No',
        'PAN_No',
        'UAN_No'
    ];
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected $bio;

    public function __construct()
    {
        parent::__construct();
        $this->db      = \Config\Database::connect('default');
        $this->bio = \Config\Database::connect('biometric');
    }

    function get_EmpCode($EmpCode)
    {
        $sql = "SELECT * FROM employees WHERE EmployeeCode = ? LIMIT 1";
        $query = $this->db->query($sql, [$EmpCode]);

        $row = $query->getRow();

        if ($row) {
            return true;
        }

        return false;
    }

    public function insert_employeesHomes($data)
    {
        $EmployeeName = $data['EmployeeName'];
        $EmployeeCode = $data['EmployeeCode'];
        $EmployeeCodeInDevice = $data['EmployeeCodeInDevice'];
        $StringCode = $data['StringCode'];
        $NumericCode = $data['NumericCode'];
        $Gender = $data['Gender'];
        $DepartmentId = $data['DepartmentId'];
        $DesignationIDFK = $data['DesignationIDFK'];
        $DOJ =  $data['DOJ'];
        $DOR = '3000-01-01 00:00:00';
        $EmployementType =  'Permanent';
        $Status = 'Working';
        $FatherName =  $data['FatherName'];
        $MotherName = $data['MotherName'];
        $ResidentialAddress = $data['ResidentialAddress'];
        $PermanentAddress = $data['PermanentAddress'];
        $ContactNo =  $data['ContactNo'];
        $AltContactno =  $data['AltContactno'];
        $Email = $data['Email'];
        $PersonalMail = $data['PersonalMail'];
        $DOB = $data['DOB'];
        $PlaceOfBirth =  $data['PlaceOfBirth'];
        $BLOODGROUP = $data['BLOODGROUP'];
        $Image = $data['Image'];
        $DOC = '1900-01-01 00:00:00';
        $EContactNo = $data['EContactNo'];

        $sql = "INSERT INTO biometric.employees(`EmployeeName`, `EmployeeCode`, `EmployeeCodeInDevice`, `StringCode`, `NumericCode`, `Gender`, `DepartmentId`,  
                                                `DesignationIDFK`, `DOJ` , `DOR` , `EmployementType` , `Status`, `FatherName`, `MotherName`, `ResidentialAddress`, 
                                                `PermanentAddress`, `ContactNo`,`AltContactno`, `Email` ,`PersonalMail`, `DOB`, `PlaceOfBirth` ,  `BLOODGROUP`, `Image`,
                                                `RecordStatus`,`CompanyId`, `CategoryId`, `EmployeeDeviceGroup`,`DOC`)  
                VALUES('$EmployeeName','$EmployeeCode', '$EmployeeCodeInDevice', '$StringCode', '$NumericCode', '$Gender', '$DepartmentId',  '$DesignationIDFK', 
                       '$DOJ' , '$DOR' , '$EmployementType' , '$Status', '$FatherName', '$MotherName', '$ResidentialAddress', '$PermanentAddress', '$ContactNo',
                       '$AltContactno', '$Email' ,'$PersonalMail', '$DOB', '$PlaceOfBirth' ,  '$BLOODGROUP', '$Image', '1', '1', '1', '1','$DOC')";

        $this->db->query($sql);
    }

    public function insertsalaryinfo($data)
    {
        $PF = $data['PF'];
        $PT = $data['PT'];
        $HRA = $data['HRA'];
        $FBP = $data['FBP'];
        $PF_VOL = $data['PF_VOL'];
        $Insurance = $data['Insurance'];
        $Grativity = $data['Grativity'];
        $NetSalary = $data['NetSalary'];
        $BasicSalary = $data['BasicSalary'];
        $GrossSalary = $data['GrossSalary'];
        $EmployeeIDFK = $data['EmployeeIDFK'];

        $sql = "INSERT INTO `salary_info`(`EmployeeIDFK`, `BasicSalary`, `HRA`, `FBP`, `PF`, `PT`, `PF_VOL`, `Insurance`, `Grativity`, `GrossSalary`, `NetSalary`) 
              VALUES ($EmployeeIDFK,$BasicSalary,$HRA,$FBP,$PF,$PT,$PF_VOL,$Insurance,$Grativity,$GrossSalary,$NetSalary)";

        $this->db->query($sql);
    }

    public function insertbankaccinfo($data)
    {
        $EmployeeIDFK = $data['EmployeeIDFK'];
        $AccountHolderName = $data['AccountHolderName'];
        $BankName = $data['BankName'];
        $AccountNo = $data['AccountNo'];
        $IFSCode = $data['IFSCode'];
        $BankBranch = $data['BankBranch'];
        $Mode = $data['Mode'];
        $Type = $data['Type'];

        $sql = "INSERT INTO `emp_bank_details`(`EmployeeIDFK`, `AccountHolderName`, `BankName`, `AccountNo`, `IFSCode`, `BankBranch`, `Mode`, `Type`) 
                VALUES ($EmployeeIDFK,'$AccountHolderName','$BankName','$AccountNo','$IFSCode','$BankBranch',$Mode,$Type)";
        $this->db->query($sql);
    }

    public function update_employeesHomes($data, $EmployeeId)
    {
        $EmployeeName = $data['EmployeeName'];
        $EmployeeCode = $data['EmployeeCode'];
        $EmployeeCodeInDevice = $data['EmployeeCodeInDevice'];
        $StringCode = $data['StringCode'];
        $NumericCode = $data['NumericCode'];
        $Gender = $data['Gender'];
        $DepartmentId = $data['DepartmentId'];
        $DesignationIDFK = $data['DesignationIDFK'];
        $DOJ =  $data['DOJ'];
        $DOR = '3000-01-01 00:00:00';
        $EmployementType =  'Permanent';
        $Status = 'Working';
        $FatherName =  $data['FatherName'];
        $MotherName = $data['MotherName'];
        $ResidentialAddress = $data['ResidentialAddress'];
        $PermanentAddress = $data['PermanentAddress'];
        $ContactNo =  $data['ContactNo'];
        $AltContactno =  $data['AltContactno'];
        $Email = $data['Email'];
        $PersonalMail = $data['PersonalMail'];
        $DOB = $data['DOB'];
        $PlaceOfBirth =  $data['PlaceOfBirth'];
        $BLOODGROUP = $data['BLOODGROUP'];
        $Image = $data['Image'];
        $DOC = '1900-01-01 00:00:00';
        $Salary_date = $data['Salary_date'] ?? 5;
        $RecordStatus = $data['RecordStatus'] ?? null;
        $ContractPeriod = $data['ContractPeriod'] ?? '0 years';
        $Aadhar_No = $data['Aadhar_No'] ?? null;
        $PAN_No = $data['PAN_No'] ?? null;
        $UAN_No = $data['UAN_No'] ?? null;

        $sql = "UPDATE  biometric.employees SET `EmployeeName` = '$EmployeeName', `EmployeeCode` = '$EmployeeCode', `EmployeeCodeInDevice`='$EmployeeCodeInDevice', `StringCode`='$StringCode', `NumericCode`='$NumericCode', `Gender`='$Gender', `DepartmentId`='$DepartmentId',  `DesignationIDFK`='$DesignationIDFK', `DOJ`='$DOJ' , `DOR`='$DOR' , `EmployementType`='$EmployementType' , `Status`='$Status', `FatherName`='$FatherName', `MotherName`='$MotherName', `ResidentialAddress`='$ResidentialAddress', `PermanentAddress`='$PermanentAddress', `ContactNo`='$ContactNo',`AltContactno`='$AltContactno', `Email` ='$Email',`PersonalMail`='$PersonalMail', `DOB`='$DOB', `PlaceOfBirth`='$PlaceOfBirth' ,  `BLOODGROUP`='$BLOODGROUP', `Image`='$Image',`DOC`='$DOC',`RecordStatus`='1',`CompanyId`='1', `CategoryId`='1', `EmployeeDeviceGroup`='1', `Salary_date` = $Salary_date,`ContractPeriod` = '$ContractPeriod',`Aadhar_No` = '$Aadhar_No',`PAN_No` = '$PAN_No',`UAN_No`='$UAN_No' WHERE `employees`.`EmployeeId` = '$EmployeeId' ";


        // print_r($sql);exit();

        // $data['neweEmp'] =
        $this->db->query($sql);
    }


    public function allEmpsCountM()
    {

        $sql = "SELECT * FROM `employees` A LEFT JOIN `designation` ON designation.IDPK=A.DesignationIDFK 
        Where A.Status = 'Working' ORDER BY A.`EmployeeName` ASC";
        $data['allEmpsCount'] = $this->db->query($sql)->getResultArray();
        return $data['allEmpsCount'];
    }
    public function allEmpsListM($data)
    {
        $trickid = $data['trickid'];
        if ($data['trickid'] == 1) {
            $trick = "Where A.Status = 'Working'";
        } elseif ($data['trickid'] == 2) {
            $trick = "Where A.Status = 'InActive'";
        } elseif ($data['trickid'] == 3) {
            $trick = " ";
        } elseif ($data['trickid'] == 4) {
            $trick = "Where A.Status = 'Abscond' ";
        } elseif ($data['trickid'] == 5) {
            $trick = "Where (G.GrossSalary = 0 OR G.GrossSalary is NULL) AND A.Status = 'Working'";
        }

        $sql = "SELECT D.CandidateId ,A.EmployeeId ,A.EmployeeName, A.EmployeeCode, A.Gender, B.designations, 
                       C.EmployeeTypeName,E.DV_IDPK,E.DVStatus, E.OfferLetterImage , E.INT_CON_Letter, F.EBD_IDPK,
                       F.EmployeeIDFK, A.last_working, A.settlement_day, A.final_set_status, A.final_set_amound, G.GrossSalary 
                FROM `employees` A 
                LEFT JOIN `designation` B ON B.IDPK=A.DesignationIDFK 
                LEFT JOIN employement_type C ON C.IDPK= A.EmployementType 
                LEFT JOIN candidates D ON D.EmployeeIDFK = A.EmployeeID
                LEFT JOIN document_verification E ON E.CandidateIDFK = D.CandidateId
                LEFT JOIN emp_bank_details F ON F.EmployeeIDFK = A.EmployeeId
                LEFT JOIN salary_info G ON G.EmployeeIDFK = A.EmployeeId
                $trick ORDER BY A.`EmployeeName` ASC";

        $data['allEmpsList'] = $this->db->query($sql)->getResultArray(); //run the query

        // print_r($data['allEmpsList']);exit;
        return $data['allEmpsList'];
    }

    public function MissingSalaryCountM()
    {
        $sql = "SELECT count(Status) as missing 
                FROM `employees` A
                LEFT JOIN salary_info B ON B.EmployeeIDFK = A.EmployeeId
                WHERE (B.GrossSalary = 0 OR B.GrossSalary is NULL) AND A.Status = 'Working'";
        $data['missing'] = $this->db->query($sql)->getResultArray(); //run the query
        return $data['missing'];
    }
    public function activeCountM()
    {
        $sql = "SELECT COUNT(Status) as active FROM `employees` Where Status='Working' ";
        $data['active'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data);      exit;
        return $data['active'];
    }
    public function inActiveCountM()
    {
        $sql = "SELECT COUNT(Status) as inactive FROM `employees` Where Status='InActive' ";
        $data['inactive'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data);      exit;
        return $data['inactive'];
    }
    public function abscondCountM()
    {
        $sql = "SELECT COUNT(Status) as abscond FROM `employees` Where Status='Abscond' ";
        $data['abscond'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data);      exit;
        return $data['abscond'];
    }
    public function allEmpCountM()
    {
        $sql = "SELECT COUNT(Status) as count FROM `employees` ";
        $data['allEmpCount'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data);      exit;
        return $data['allEmpCount'];
    }
    public function birthdayDetails()
    {
        $sql = "SELECT EmployeeName, EmployeeCode, Image, Date(DOB) as DOB, CURRENT_DATE() as today, 
                       TIMESTAMPDIFF(YEAR, DOB, CURRENT_DATE()) as years, TIMESTAMPDIFF(MONTH, DOB, CURRENT_DATE()) % 12 as months, 
                       FLOOR(TIMESTAMPDIFF(DAY, DOB, CURRENT_DATE()) % 30.4375) as days, B.designations
                FROM employees A LEFT JOIN `designation` B ON B.IDPK = A.DesignationIDFK
                WHERE A.Status = 'Working' AND ((MONTH(DOB) = MONTH(CURRENT_DATE()) AND DAY(DOB) >= DAY(CURRENT_DATE())) 
                OR MONTH(DOB) = MONTH(CURRENT_DATE() + INTERVAL 1 MONTH))
                ORDER BY months DESC, days DESC";
        $data['birthdayDetailsTable'] = $this->db->query($sql)->getResultArray(); //run the query
        return $data['birthdayDetailsTable'];
        // print_r($data['birthdayDetailsTable']);  // exit;
    }

    public function workAnniversaryDetails()
    {
        $sql = "SELECT EmployeeName,EmployeeCode, Date(DOJ) as DOJ , CURRENT_DATE() as today , TIMESTAMPDIFF( YEAR, DOJ, CURRENT_DATE ) as years , TIMESTAMPDIFF( MONTH, DOJ, CURRENT_DATE ) % 12 as months , FLOOR( TIMESTAMPDIFF( DAY, DOJ, CURRENT_DATE ) % 30.4375 ) as days FROM employees A Where A.Status='Working' ORDER BY months DESC, days DESC LIMIT 4";
        $data['workAnniversaryDetailsTable'] = $this->db->query($sql)->getResultArray(); //run the query

        // print_r($data['workAnniversaryDetailsTable']);  // exit;

        return $data['workAnniversaryDetailsTable'];
    }
    public function allworkAnniversaryDetails()
    {

        $sql = "SELECT EmployeeName,EmployeeCode, Date(DOJ) as DOJ , CURRENT_DATE() as today , TIMESTAMPDIFF( YEAR, DOJ, CURRENT_DATE ) as years , TIMESTAMPDIFF( MONTH, DOJ, CURRENT_DATE ) % 12 as months , FLOOR( TIMESTAMPDIFF( DAY, DOJ, CURRENT_DATE ) % 30.4375 ) as days FROM employees A Where A.Status='Working' ORDER BY months DESC, days DESC";

        $data['allworkAnniversaryDetailsTable'] = $this->db->query($sql)->getResultArray(); //run the query

        return $data['allworkAnniversaryDetailsTable'];
    }

    public function allBrirthdaysDetails()
    {

        $sql = "SELECT EmployeeName,EmployeeCode, Date(DOB) as DOB, CURRENT_DATE() as today , TIMESTAMPDIFF( YEAR, DOB, CURRENT_DATE ) as years , TIMESTAMPDIFF( MONTH, DOB, CURRENT_DATE ) % 12 as months , FLOOR( TIMESTAMPDIFF( DAY, DOB, CURRENT_DATE ) % 30.4375 ) as days FROM employees A where A.Status='Working'  ORDER BY months DESC, `days` DESC";

        $data['allbirthdaysDetailsTable'] = $this->db->query($sql)->getResultArray(); //run the query

        return $data['allbirthdaysDetailsTable'];
    }

    public function eventsDetails()
    {
        $sql = "SELECT EventName,EventDate,EventDescription FROM events WHERE MONTH(EventDate)=MONTH(now()) OR DATE(EventDate)>=CURRENT_DATE() ORDER BY EventDate ASC LIMIT 3";
        $data['eventsDetailsTable'] = $this->db->query($sql)->getResultArray(); //run the query
        return $data['eventsDetailsTable'];
    }

    public function selectEmpTypeM()
    {
        $sql = "SELECT * FROM `employement_type` ORDER BY EmployeeTypeName ASC";
        $data['selectEmpType'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['selectdepart']); exit();
        return $data['selectEmpType'];
    }
    public function selectdepartM()
    {
        $sql = "SELECT * FROM `departments` ORDER BY deptName ASC";
        $data['selectdepart'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['selectdepart']); exit();
        return $data['selectdepart'];
    }
    public function selectdesignationM()
    {
        $sql = "SELECT * FROM `designation` ORDER BY designations ASC";
        $data['selectdesignation'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['selectdesignation']); exit();
        return $data['selectdesignation'];
    }
    public function getdesignationM($desname)
    {

        $sql = "SELECT A.EmployeeCode, A.EmployeeName, designation.IDPK, designations FROM `employees` A 
                LEFT JOIN designation ON designation.IDPK = A.DesignationIDFK 
                Where IDPK='$desname' ";
        $data['showdesignation'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['showdesignation']); exit();
        return $data['showdesignation'];
    }

    public function getHR()
    {
        $sql = "SELECT A.EmployeeId, A.EmployeeCode, A.EmployeeName, designation.IDPK, designations FROM `employees` A 
                LEFT JOIN designation ON designation.IDPK = A.DesignationIDFK 
                Where (DesignationIDFK = 18 OR DesignationIDFK = 24) AND `Status` = 'Working' ";
        $data['showHR'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['showdesignation']); exit();
        return $data['showHR'];
    }

    public function showAbsentEmpM($id, $AbsentDate)
    {
        // print_r($AbsentDate); exit();
        $sql = "SELECT e.EmployeeId AS EmployeeId, e.EmployeeCode AS `EmployeeCode`, e.EmployeeName, '$AbsentDate' as AbsentDate
        FROM  employees e 
        WHERE e.EmployeeId='$id' ";

        $data['showAbsentEmpDetails'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['showAbsentEmpDetails']); exit();
        return $data['showAbsentEmpDetails'];
    }

    public function getEmpLeaveTaken($id)
    {
        // print_r($id); exit();
        $sql = "SELECT mail_base.Mail_IDPK , absents_leave_request.IDPK as IDPK,absents_leave_request.EmployeeIDFK,leavereason.LeaveReason as LeaveReason, absentDate as AbsentDate ,mail_base.Mail_Msg as Reason
                FROM `absents_leave_request` 
                LEFT JOIN leavereason ON leavereason.IDPK = leaveReasonIDFK 
                LEFT JOIN mail_base ON mail_base.Mail_IDPK = absents_leave_request.Mail_Base_IDFK
               WHERE absents_leave_request.EmployeeIDFK= '$id' ";

        $data['EmpLeaveTaken'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['EmpLeaveTaken']); exit();
        return $data['EmpLeaveTaken'];
    }
    public function getEmpALRid($id, $idpk)
    {
        // print_r($idpk); exit();
        $sql = "SELECT absents_leave_request.IDPK as IDPK ,leavereason.LeaveReason as LeaveReason, absentDate as AbsentDate, mail_base.Mail_Msg as Reason,EmployeeIDFK FROM `absents_leave_request` LEFT JOIN leavereason ON leavereason.IDPK = leaveReasonIDFK LEFT JOIN mail_base ON mail_base.Mail_IDPK = absents_leave_request.Mail_Base_IDFK WHERE EmployeeIDFK= '$id' and absents_leave_request.IDPK = '$idpk'";

        $data['ALRid'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['ALRid']); exit();
        return $data['ALRid'];
    }

    // public function getLeaveReasonM(){

    //     $sql="SELECT * FROM `absents_leave_request` 
    //             LEFT JOIN leavereason ON `leavereason`.`IDPK` = absents_leave_request.leaveReasonIDFK
    //             LEFT JOIN employees C ON C.`EmployeeId` = absents_leave_request.EmployeeIDFK ";
    //     $data['showleavereason'] = $this->db->query($sql)->getResultArray(); //run the query
    //     // print_r($data['showleavereason']); exit();
    //     return $data['showleavereason'];     
    // }

    public function selectleaveReasonM()
    {
        $sql = "SELECT * FROM `leavereason` ";
        $data['selectleavereason'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['selectleavereason']); exit();
        return $data['selectleavereason'];
    }

    public function getLeaveRequest($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $trickid = $data['trickid'];
        // print_r($trickid);exit;
        if ($trickid == 2) {
            $trick = "AND alr.leaveStatus = 1";    //Approved
        } elseif ($trickid == 3) {
            $trick = "AND alr.leaveStatus = 2";    //Rejected
        } elseif ($trickid == 4) {
            $trick = "AND alr.leaveStatus = 0";   //pending
        } elseif ($trickid == 1) {
            $trick = " ";
        }

        $sql = "SELECT alr.`IDPK`, mb.Mail_IDPK, lr.LeaveReason,e.Image, e.EmployeeCode,e.EmployeeName, alr.absentDate, mb.Mail_Msg AS Reason,  alr.leaveStatus, alr.createdAt,mb.readStatus FROM `absents_leave_request` alr
                LEFT JOIN `leavereason` lr ON lr.IDPK = alr.leaveReasonIDFK
                LEFT JOIN employees e ON e.EmployeeId = alr.EmployeeIDFK
                LEFT JOIN mail_base mb ON mb.Mail_IDPK = alr.Mail_Base_IDFK
                WHERE DATE(alr.createdAt) BETWEEN '$fdate' AND '$todate' and mb.Mail_TypeId = 2 $trick 
                ORDER BY mb.created_at DESC";
        $data['leaveRequest'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['leaveRequest']); exit();
        return $data['leaveRequest'];
    }
    public function allLRCountM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $sql = "SELECT COUNT(leaveStatus) as counts FROM absents_leave_request WHERE DATE(createdAt) BETWEEN '$fdate' AND '$todate' ";
        $data['allLrCount'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['allLrCount']); exit();
        return $data['allLrCount'];
    }
    public function approveLRCountM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $sql = "SELECT COUNT(leaveStatus) as counts FROM absents_leave_request WHERE leaveStatus = 1 AND DATE(createdAt) BETWEEN '$fdate' AND '$todate'";
        $data['approveLrCount'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['approveLrCount']); exit();
        return $data['approveLrCount'];
    }
    public function rejectLRCountM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $sql = "SELECT COUNT(leaveStatus) as counts FROM absents_leave_request WHERE leaveStatus = 2 AND DATE(createdAt) BETWEEN '$fdate' AND '$todate'";
        $data['rejectLrCount'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['rejectLrCount']); exit();
        return $data['rejectLrCount'];
    }
    public function pendingLRCountM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $sql = "SELECT COUNT(leaveStatus) as counts FROM absents_leave_request WHERE leaveStatus = 0 AND DATE(createdAt) BETWEEN '$fdate' AND '$todate' ";
        $data['pendingLrCount'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['pendingLrCount']); exit();
        return $data['pendingLrCount'];
    }

    public function getEmpLeaveRequest($id)
    { //remove id and add data
        $id = $id['mailId'];

        $sqlread = "UPDATE `mail_base` SET `readStatus`= 1 WHERE `Mail_IDPK`= $id";
        $this->db->query($sqlread);

        $sql = "SELECT alr.`IDPK`,mb.Mail_IDPK, lr.LeaveReason,e.Image, e.Email, e.EmployeeId ,e.EmployeeCode,e.EmployeeName,d.designations,alr.absentDate, mb.Mail_Msg as Reason,  alr.leaveStatus,mb.readStatus, alr.createdAt , F.EmployeeId as SenderId, G.EmployeeId as ReceiverId
                FROM `absents_leave_request` alr
                LEFT JOIN `leavereason` lr ON lr.IDPK = alr.leaveReasonIDFK
                LEFT JOIN employees e ON e.EmployeeId = alr.EmployeeIDFK 
                LEFT JOIN designation d ON d.IDPK = e.DesignationIDFK
                LEFT JOIN mail_base mb ON mb.Mail_IDPK = alr.Mail_Base_IDFK
                LEFT JOIN employees F ON F.EmployeeId = mb.SenderId
                LEFT JOIN employees G ON G.EmployeeId = mb.ReceiverId
                WHERE alr.Mail_Base_IDFK = $id  ";
        $data['empleaveRequest'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['empleaveRequest']); exit();
        return $data['empleaveRequest'];
    }

    public function getEmpLeaveReply($id)
    { //remove id and add data

        $id = $id['mailId'];
        $sql = "SELECT D.EmployeeId, D.EmployeeName, A.SenderId, D.EmployeeName as SenderName, A.ReceiverId, E.EmployeeName as ReceiverName , A.Mail_Reply_Msg,A.created_at
        FROM `mail_reply` A
        LEFT JOIN mail_base B ON B.Mail_IDPK = A.Mail_Base_IDFK 
        LEFT JOIN absents_leave_request C ON C.Mail_Base_IDFK = B.Mail_IDPK 
        LEFT JOIN employees D ON D.EmployeeId = A.SenderId
        LEFT JOIN employees E ON E.EmployeeId = A.ReceiverId
        WHERE C. IDPK = $id ORDER BY A.created_at ASC";
        $data['empleaveReply'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['empleaveReply']); exit();
        return $data['empleaveReply'];
    }


    public function mailEmpSelect($data)
    {
        $deptsid = $data['deptsid'];
        // print_r($deptsid);exit();
        if ($deptsid == 'all' || empty($deptsid)) {
            $depts = " ";
        } elseif ($deptsid >= 1) {
            $depts = "WHERE DepartmentId = $deptsid ";
        }

        $sql = "SELECT EmployeeName as Name, EmployeeId as Id, Email, DepartmentId FROM `employees` $depts ";
        $data['mailempselect'] = $this->db->query($sql)->getResultArray();
        // print_r($data['mailempselect']);exit();

        return $data['mailempselect'];
    }


    public function HR_sent_box($data, $hrId)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];

        $sql = "SELECT mb.Mail_IDPK, mb.SenderId, e.EmployeeName as SenderName, ee.EmployeeName as ReceiverName, mb.Mail_Msg, mb.created_at FROM `mail_base` mb 
                LEFT JOIN employees e ON e.EmployeeId=mb.SenderId
                LEFT JOIN employees ee ON ee.EmployeeId = mb.ReceiverId
                WHERE mb.SenderId = $hrId and DATE(created_at) BETWEEN '$fdate' AND '$todate' 
                ORDER BY mb.created_at DESC";
        // $sql="SELECT mb.Mail_IDPK, mb.SenderId, e.EmployeeName as SenderName, e.EmployeeName as ReceiverName, mb.Mail_Msg, mb.created_at 
        // FROM `mail_base` mb 
        // LEFT JOIN employees e ON e.EmployeeId=mb.SenderId
        // LEFT JOIN employees ee ON ee.EmployeeId = mb.ReceiverId
        // LEFT JOIN mail_reply mr ON mr.Mail_Base_IDFK = mb.Mail_IDPK
        // WHERE mb.ReceiverId = $hrId or mr.SenderId= $hrId and DATE(mb.created_at) BETWEEN '$fdate' AND '$todate' 
        // GROUP BY mb.Mail_IDPK
        // ORDER BY mb.created_at DESC";
        $data['HRSentBox'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['HRSentBox']); exit();
        return $data['HRSentBox'];
    }
    public function HR_readsent_box($data, $hrId)
    {
        $mailId = $data['mailId'];

        $sql = "SELECT mb.Mail_IDPK, mb.SenderId, e.EmployeeName as SenderName, ee.EmployeeName as ReceiverName, mb.Mail_Msg, mb.created_at FROM `mail_base` mb 
                LEFT JOIN employees e ON e.EmployeeId=mb.SenderId
                LEFT JOIN employees ee ON ee.EmployeeId = mb.ReceiverId
                WHERE mb.SenderId = $hrId  AND mb.Mail_IDPK = $mailId 
                ORDER BY mb.created_at DESC";
        $data['HRSentBox'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['HRSentBox']); exit();
        return $data['HRSentBox'];
    }

    public function getHRadminList()
    {
        // print_r($adminId);exit();
        $sql = "SELECT EmployeeId, EmployeeName FROM employees Where DesignationIDFK = 1 and Status= 'Working' ";
        $data['adminId'] = $this->db->query($sql)->getResultArray();
        // print_r($data['adminId']);exit();
        return $data['adminId'];
    }
    public function getHRList()
    {
        $sql = "SELECT EmployeeId, EmployeeName FROM employees Where (DesignationIDFK = 18 or DesignationIDFK = 24 or DesignationIDFK = 1) and Status= 'Working' ";
        $data['HRList'] = $this->db->query($sql)->getResultArray();
        // print_r($data['HRList']);exit();
        return $data['HRList'];
    }

    public function getEmployee($id)
    {
        $sql = "SELECT B.designations, C.EmployeeTypeName, A.Image, A.EmployeeId, A.EmployeeName, A.EmployeeCode, A.Status, A.Gender, A.DOB, A.BLOODGROUP,
                       A.FatherName, A.MotherName, A.PlaceOfBirth, A.ResidentialAddress, A.PermanentAddress, A.ContactNo, A.AltContactno, A.EContactNo,
                       A.Email, A.PersonalMail, A.Salary_date, D.EmployeeName as ReportingPerson, E.designations as ReportingDesignation, A.Aadhar_No, A.PAN_No, A.PF_No, A.ESI_No
                FROM `employees` A
                LEFT JOIN `designation` B ON B.IDPK = A.DesignationIDFK
                LEFT JOIN `employement_type` C ON C.IDPK= A.EmployementType
                LEFT JOIN `employees` D ON D.EmployeeId = A.ReportManagerIDFK
                LEFT JOIN `designation` E ON E.IDPK = D.DesignationIDFK
                WHERE A.EmployeeId = $id";

        $data['Employee'] = $this->db->query($sql)->getRowArray();
        return $data['Employee'];
    }

    public function getEmployeeWorkDetails($id)
    {
        $sql = "SELECT A.DOJ, B.deptName, A.UAN_No, A.PAN_No, A.Aadhar_No, A.ContractPeriod, C.EmployeeName
                FROM `employees` A
                LEFT JOIN `departments` B ON B.IDPK = A.DepartmentId
                LEFT JOIN `employees` C ON C.EmployeeId = A.ReportManagerIDFK
                WHERE A.EmployeeId = $id";
        $data['Employement'] = $this->db->query($sql)->getRowArray();

        $sql = "SELECT AccountHolderName, BankName, AccountNo, IFSCode, BankBranch, Type, Mode
                FROM `emp_bank_details`
                WHERE EmployeeIDFK = $id AND Type = 1";
        $data['Official'] = $this->db->query($sql)->getRowArray();

        $sql = "SELECT AccountHolderName, BankName, AccountNo, IFSCode, BankBranch, Type, Mode
                FROM `emp_bank_details`
                WHERE EmployeeIDFK = $id AND Type = 2";
        $data['Personal'] = $this->db->query($sql)->getRowArray();

        $sql = "SELECT * FROM `salary_info` WHERE EmployeeIDFK = $id ORDER BY `Updated_on` DESC LIMIT 1";
        $data['Salary'] = $this->db->query($sql)->getRowArray();

        return $data;
    }

    public function getEmployeeApprovals($id)
    {
        $sql = "SELECT A.Subject, A.Status, A.Raised_On, B.Name, C.EmployeeName
                FROM tickets A 
                LEFT JOIN ticket_types B ON B.IDPK = A.TypeIDFK
                LEFT JOIN employees C ON C.EmployeeId = A.EmployeeIDFK
                WHERE A.EmployeeIDFK = $id";
        $data = $this->db->query($sql)->getResultArray();
        return $data;
    }






    public function getEmployeeAttendence($id, $date_start, $date_end)
    {
        $sql = "SELECT A.*, B.Name
                FROM leaves A
                LEFT JOIN leavetype B ON B.IDPK = A.TypeIDFK
                WHERE A.EmployeeIDFK = $id AND (DATE(A.Date) BETWEEN '$date_start' AND '$date_end')";
        $leaves = $this->db->query($sql)->getResultArray();
        return $leaves;
    }

    public function getEmployeeTotalWorkDays($id, $date_start, $date_end)
    {
        $TOTALDAYS = $this->NoFDays($date_start, $date_end);
        $sql = "SELECT DepartmentId FROM employees WHERE EmployeeId = $id";
        $department = $this->db->query($sql)->getRow()->DepartmentId;
        $sql = "SELECT WO1, WO2, WO3, WO4, WO5, WO6, WO7 FROM departments WHERE IDPK = $department";
        $data['WOD'] = $this->db->query($sql)->getRowArray();
        $TOTALWEEKOFF = 0;
        for ($i = 1; $i < count($data['WOD']); $i++) {
            if ($data['WOD']['WO' . $i] == 1) {
                $TOTALWEEKOFF += $this->checkweekoff($i - 1, $date_start, $date_end);
            }
        }
        $sql = "SELECT CASE WHEN SameDate = 1 THEN
                            -- Create a date using current year and the month/day from Date
                            CASE
                                WHEN DATE_FORMAT(CONCAT(YEAR(CURRENT_DATE()), '-', MONTH(Date), '-', DAY(Date)), '%Y-%m-%d') < CURRENT_DATE()
                                THEN DATE_FORMAT(CONCAT(YEAR(CURRENT_DATE()), '-', MONTH(Date), '-', DAY(Date)), '%Y-%m-%d')
                                ELSE DATE_FORMAT(CONCAT(YEAR(CURRENT_DATE()), '-', MONTH(Date), '-', DAY(Date)), '%Y-%m-%d')  -- If date is in the future or today, use this year
                            END
                        ELSE
                            -- Use the original date for SameDate != 1
                            Date
                        END AS AdjustedDate
                FROM holidays 
                WHERE DepartmentIDFK LIKE '%\"$department\"%'";
        $holidays = $this->db->query($sql)->getResultArray();
        $TOTALHOLIDAYS = 0;
        foreach ($holidays as $holiday) {
            $HOLIWEEKOFF = 0;
            if ($this->checkholiday($holiday['AdjustedDate'], $date_start, $date_end) == 1) {
                for ($i = 1; $i < count($data['WOD']); $i++) {
                    if ($data['WOD']['WO' . $i] == 1) {
                        $HOLIWEEKOFF += $this->checkweekoff($i - 1, $holiday['AdjustedDate'], $holiday['AdjustedDate']);
                    }
                }
                if ($HOLIWEEKOFF == 0) {
                    $TOTALHOLIDAYS++;
                }
            }
        }
        $TOTALDAYS = $TOTALDAYS - ($TOTALWEEKOFF + $TOTALHOLIDAYS);
        return $TOTALDAYS;
    }
    public function NoFDays($fdate, $todate)
    {
        $startDate = new DateTime($fdate);
        $endDate = new DateTime($todate);
        $endDate->modify('+1 day');
        $interval = $startDate->diff($endDate);
        $days = $interval->days;
        return $days;
    }
    public function checkweekoff($Day, $fdate, $todate)
    {
        $start = new DateTime($fdate);
        $end = new DateTime($todate);
        $end->modify('+1 day'); // Include the end date in the range
        $interval = new \DateInterval('P1D'); // 1-day interval
        $daterange = new \DatePeriod($start, $interval, $end);
        $Count = 0;
        foreach ($daterange as $date) {
            if ($date->format('w') == $Day) { // 'w' gives the day of the week (0 for Sunday)
                $Count++;
            }
        }
        return $Count;
    }
    public function checkholiday($date, $date_start, $date_end)
    {
        $date_start = new DateTime($date_start);
        $date = new DateTime($date);
        $date_end = new DateTime($date_end);
        if ($date >= $date_start && $date <= $date_end) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getEmployeeTotalAbsend($id, $date_start, $date_end)
    {
        $sql = "SELECT count(*) as count
                FROM leaves
                WHERE EmployeeIDFK = $id
                AND Status = 1
                AND TypeIDFK != 6 
                AND (DATE(Date) BETWEEN '$date_start' AND '$date_end')";
        $leaves = $this->db->query($sql)->getRow()->count;
        // $this->AutoLeaveGenerater();
        return $leaves;
    }

    public function AutoLeaveGenerater()
    {
        $yesdate = date('Y-m-d', strtotime('-1 day'));

        // Check biometric logs
        $logCount = $this->bio->query("SELECT COUNT(*) AS count FROM biometric.devicelogs_processed WHERE DATE(LogDate) = ?", [$yesdate])->getRow()->count;
        if ($logCount == 0){
            return true;
        }

        // Check for holidays
        $holidays = $this->db->query("SELECT CASE WHEN SameDate = 1 THEN 
                                                                    DATE_FORMAT(CONCAT(YEAR(CURRENT_DATE()), '-', MONTH(Date), '-', DAY(Date)), '%Y-%m-%d') 
                                                                ELSE 
                                                                    Date 
                                                                END AS AdjustedDate 
                                            FROM holidays 
                                            WHERE AllDept = 1")->getResultArray();
        $isHoliday = in_array($yesdate, array_column($holidays, 'AdjustedDate'));
        if(!$isHoliday){
            return true;
        }

        $sql = "SELECT A.EmployeeId, A.EmployeeCode, A.DepartmentId
                FROM employees A
                LEFT JOIN biometric.devicelogs_processed B 
                    ON B.UserId = A.EmployeeCode AND DATE(B.LogDate) = '$yesdate'
                WHERE A.Status = 'Working' AND B.UserId IS NULL";
        $employees = $this->bio->query($sql)->getResultArray();

        foreach ($employees as $emp) {
            $id = $emp['EmployeeId'];
            $code = $emp['EmployeeCode'];
            $department = $emp['DepartmentId'];
            
            // Check biometric logs
            // $logCount = $this->bio->query("SELECT COUNT(*) AS count FROM biometric.devicelogs_processed WHERE UserId = ? AND DATE(LogDate) = ?", [$code, $yesdate])->getRow()->count;
            // if ($logCount > 0) continue;
            
            // Check if leave already exists
            $existingLeave = $this->db->query("SELECT COUNT(*) AS flag FROM leaves WHERE EmployeeIDFK = ? AND Status = 1 AND TypeIDFK = 5 AND DATE(Date) = ?", [$id, $yesdate])->getRow()->flag;
            if ($existingLeave > 0) continue;
            
            // Check for other leaves
            $otherLeave = $this->db->query("SELECT COUNT(*) AS count FROM leaves WHERE EmployeeIDFK = ? AND Status = 1 AND TypeIDFK != 6 AND DATE(Date) = ?", [$id, $yesdate])->getRow()->count;
            if ($otherLeave > 0) continue;
            
            // Check for holidays
            $holidays = $this->db->query("SELECT CASE WHEN SameDate = 1 THEN DATE_FORMAT(CONCAT(YEAR(CURRENT_DATE()), '-', MONTH(Date), '-', DAY(Date)), '%Y-%m-%d') ELSE Date END AS AdjustedDate FROM holidays WHERE DepartmentIDFK LIKE ?", ["%\"$department\"%"])->getResultArray();
            $isHoliday = in_array($yesdate, array_column($holidays, 'AdjustedDate'));
            if (!$isHoliday) continue;

            // Check for week-off
            $weekOffDays = $this->db->query("SELECT WO1, WO2, WO3, WO4, WO5, WO6, WO7 FROM departments WHERE IDPK = ?", [$department])->getRowArray();
            $weekOff = 0;
            foreach ($weekOffDays as $index => $isWeekOff) {
                if ($isWeekOff) {
                    $weekOff += $this->checkweekoff($index, $yesdate, $yesdate);
                }
            }
            if ($weekOff > 0) continue;

            // Insert UnProperLeave if conditions are met
            if ($weekOff == 0 && !$isHoliday && $otherLeave == 0) {
                $this->db->query("INSERT INTO leaves (EmployeeIDFK, TypeIDFK, Date, Reason, Status) VALUES (?, ?, ?, ?, ?)", [$id, 5, $yesdate, 'UnProperLeave', 1]);
            }
        }
        return true;
    }

    public function getEmployeeLateEntry($id, $date_start, $date_end)
    {
        $sql = "SELECT EmployeeCode FROM employees WHERE EmployeeId = $id";
        $data = $this->db->query($sql)->getRowArray();
        $EmployeeCode = $data['EmployeeCode'];
        $date_start .= " 00:00:00";
        $date_end .= " 23:59:59";

        $sql = "SELECT * FROM (SELECT UserId, DATE(LogDate) AS LogDateDay, MIN(LogDate) AS FirstLogDate 
                          FROM devicelogs_processed 
                          WHERE UserId = '$EmployeeCode'
                          AND LogDate BETWEEN '$date_start' AND '$date_end'
                          GROUP BY DATE(LogDate)
                          ORDER BY LogDateDay ASC) AS SubQuery
                WHERE TIME(FirstLogDate) > '09:45:59' ";

        $data['LateEntry'] = $this->bio->query($sql)->getResultArray();
        return $data['LateEntry'];
    }

    public function getEmployeeTimeLogs($id, $date_start, $date_end)
    {
        $result = [];
        $sql = "SELECT B.LogDate, Min(B.LogDate) as First, Max(B.LogDate) as Last,
                (CASE WHEN TIME(Min(B.LogDate)) > '09:45:59' THEN 1 ELSE 0 END) AS Late_Login, 
                (CASE WHEN TIME(Max(B.LogDate)) < '18:30:00' THEN 1 ELSE 0 END) AS Early_Logout,
                TIMEDIFF( MAX(B.LogDate), MIN(B.LogDate)) as workingHours
                FROM homes247_backend.employees A 
                LEFT JOIN biometric.devicelogs_processed B ON B.UserId = A.EmployeeCode
                WHERE A.EmployeeId = $id AND DATE(B.LogDate) BETWEEN '$date_start' AND '$date_end'
                GROUP BY YEAR(B.LogDate),MONTH(B.LogDate),DAY(B.LogDate)";
        $MinMax = $this->bio->query($sql)->getResultArray();
        foreach ($MinMax as $row) {
            $date = date('Y-m-d', strtotime($row['LogDate']));
            $result[$date]['DayInfo'] = [
                'Day' => strtoupper(date('D', strtotime($row['LogDate']))),
                'd' => date('d', strtotime($row['LogDate'])),
                'WHS' => $row['workingHours']
            ];
            $result[$date]['minmax'] = [
                'LogDate' => $row['LogDate'],
                'First' => date('h:i A', strtotime($row['First'])),
                'Last' => date('h:i A', strtotime($row['Last'])),
                'Late_Login' => $row['Late_Login'],
                'Early_Logout' => $row['Early_Logout']
            ];
        }
        $sql = "SELECT LogDate
                FROM homes247_backend.employees A 
                LEFT JOIN biometric.devicelogs_processed B ON B.UserId = A.EmployeeCode 
                WHERE A.EmployeeId = $id AND DATE(B.LogDate) BETWEEN '$date_start' AND '$date_end'
                GROUP BY DATE_FORMAT(B.LogDate, '%Y-%m-%d %H:%i')
                ORDER BY LogDate";
        $logs = $this->bio->query($sql)->getResultArray();
        $groupedlogs = [];
        foreach ($logs as $row) {
            $date = date('Y-m-d', strtotime($row['LogDate']));
            $groupedlogs[$date][] = [
                'LogDate' => $row['LogDate'],
                'LogTime' => date('H:i:s', strtotime($row['LogDate'])),
            ];
        }
        $points = [];
        foreach ($groupedlogs as $date => $bunchs) {
            $points[$date][] = ['time' => '07:00:00', 'auto' => 1];  //Total Time Line Start
            foreach ($bunchs as $i => $bunch) {
                $points[$date][] = ['time' => $bunch['LogTime'], 'auto' => 0];
            }
            $points[$date][] = ['time' => '23:00:00', 'auto' => 1];  //Total Time Line End
        }
        $pointresult = [];
        foreach ($points as $date => $point) {
            for ($i = 0; $i < count($point) - 1; $i++) {
                if ($i == 0) {
                    $pointresult[$date][] = $this->point_distence($point[$i]['time'], $point[$i]['auto'], $point[$i + 1]['time'], $point[$i + 1]['auto']);
                } else {
                    if ($point[$i - 1]['auto'] == 0 && $point[$i]['auto'] == 0) {
                        $point[$i]['auto'] = 1;
                        // $point[$i+1]['auto'] = 1;
                    }
                    $pointresult[$date][] = $this->point_distence($point[$i]['time'], $point[$i]['auto'], $point[$i + 1]['time'], $point[$i + 1]['auto']);
                }
            }
        }
        foreach ($pointresult as $date => $bunchs) {
            $result[$date]['Points'] = $bunchs;
        }
        foreach ($result as $date => $info) {
            for ($key = 0; $key < count($info['Points']); $key++) {
                if ($key != 0 && $key != count($info['Points']) - 1) {
                    if (($info['Points'][$key - 1]['s_auto'] == 0 && $info['Points'][$key - 1]['e_auto'] == 0) && ($info['Points'][$key + 1]['s_auto'] == 0 && $info['Points'][$key + 1]['e_auto'] == 0)) {
                        $result[$date]['Points'][$key]['color'] = 0;
                        $result[$date]['Points'][$key]['s_auto'] = 1;
                        $result[$date]['Points'][$key]['e_auto'] = 1;
                    }
                }
            }
        }
        return $result;
    }
    public function point_distence($start, $sa, $end, $ea)
    {
        $s = new DateTime($start);
        $e = new DateTime($end);
        $diff = $s->diff($e);
        $Mins = ($diff->h * 60) + ($diff->i);
        return array(
            'percentage' => round(($Mins / 960) * 100), // 16 Hrs (7:00 to 10:59)
            // 'percentage' => round(($Mins / 1440) * 100), // 24 Hrs (12:00 to 11:59)
            // 'percentage' => round(($Mins / 540) * 100), // 9 Hrs (9:30 to 6:30)
            'start' => date('h:i A', strtotime($start)),
            'end' => date('h:i A', strtotime($end)),
            's_auto' => $sa,
            'e_auto' => $ea,
            'color' => ($sa == 0 && $ea == 0) ? 1 : 0,
        );
    }

    public function getEmployeePaySlip($id)
    {
        $sql = "SELECT B.Salary_date, A.LOP, A.Date, A.IDPK, A.Status, A.Net_salary 
                FROM payslips A
                INNER JOIN employees B ON B.EmployeeId = A.EmployeeIDFK 
                WHERE EmployeeIDFK = $id 
                AND (MONTH(Date) != MONTH(CURRENT_DATE()) OR YEAR(Date) != YEAR(CURRENT_DATE()))";
        $data = $this->db->query($sql)->getResultArray();
        // print_r($data);exit(0);
        return $data;
    }

    public function getPayslip($id)
    {
        $sql = "SELECT A.LOP, A.Date, A.SD1, A.Acc_Type, A.Net_salary, A.EmployeeIDFK, B.GrossSalary, B.BasicSalary, B.HRA, B.FBP, B.PF, B.PT, B.PF_VOL, B.TDS, B.Insurance
                FROM payslips A
                LEFT JOIN salary_info B ON B.EmployeeIDFK = A.EmployeeIDFK
                LEFT JOIN emp_bank_details C ON C.EmployeeIDFK = A.EmployeeIDFK
                LEFT JOIN leaves D ON D.EmployeeIDFK = A.EmployeeIDFK
                WHERE A.IDPK = $id";
        $data = $this->db->query($sql)->getRowArray();
        $empid = $data['EmployeeIDFK'];
        $pdate = $data['Date'];

        $sql = "SELECT COUNT(*) as lop FROM leaves 
                WHERE EmployeeIDFK = $empid
                AND TypeIDFK = 5
                AND (MONTH(Date) = MONTH('$pdate') AND YEAR(Date) = YEAR('$pdate'))";
        $LOP = $this->db->query($sql)->getRow()->lop;

        if ($data['LOP'] == 0) {
            $data['LOP'] = $LOP;
        }

        $sql = "SELECT BankName, Type FROM emp_bank_details WHERE EmployeeIDFK = $empid";
        $accs = $this->db->query($sql)->getResultArray();
        $data['Accounts'] = $accs;

        return $data;
    }

    public function UpdatePayslip($id, $data)
    {
        $sql = "UPDATE `payslips` SET `LOP`=?, `Acc_Type`=?,`Gross`=?,`Basic`=?,`HRA`=?,`FBP`=?,`SD1`=?,`PF`=?,
                                      `PT`=?,`PFVOL`=?,`SD2`=?,`Insurance`=?,`Net_salary`=?,`Status`=? 
                WHERE IDPK = $id";
        $this->db->query($sql, [$data['LOP'], $data['Acc_Type'], $data['Gross'], $data['Basic'], $data['HRA'], $data['FBP'], $data['SD1'], $data['PF'], $data['PT'], $data['PFVOL'], $data['SD2'], $data['Insurance'], $data['Net_salary'], $data['Status']]);

        return true;
    }

    public function PayslipManualSave($data)
    {
        $fdate = $data['fdate'];
        $trickId = ($data['trickid'] == 1) ? 'B.Salary_date = 5' : 'B.Salary_date = 10';
        $sql = "UPDATE payslips A
                INNER JOIN employees B ON B.EmployeeId = A.EmployeeIDFK
                SET A.Status = 2
                WHERE (YEAR(A.Date) = YEAR('$fdate') AND MONTH(A.Date) = MONTH('$fdate')) AND $trickId";
        $this->db->query($sql);
        return true;
    }

    public function DownloadPayslipExcel($data)
    {
        $fdate = $data['fdate'];
        $trick = ($data['trickid'] == 1) ? 'B.Salary_date = 5' : 'B.Salary_date = 10';
        $sql = "SELECT A.*,
                        B.EmployeeId, B.EmployeeName, B.DOJ, B.last_working,
                        C.deptName,
                        D.designations,
                        (SELECT COUNT(*) 
                        FROM leaves 
                        WHERE EmployeeIDFK = A.EmployeeIDFK 
                            AND YEAR(Date) = YEAR('$fdate') AND MONTH(Date) = MONTH('$fdate')) 
                        AS leave_count
                FROM payslips A
                LEFT JOIN employees B ON B.EmployeeId = A.EmployeeIDFK
                LEFT JOIN departments C ON C.IDPK = B.DepartmentId
                LEFT JOIN designation D ON D.IDPK = B.DesignationIDFK  
                WHERE $trick AND (YEAR(A.Date) = YEAR('$fdate') AND MONTH(A.Date) = MONTH('$fdate'))";
        $records = $this->db->query($sql)->getResultArray();

        $tempdata = [];
        $data = [];
        foreach ($records as $i => $record) {
            $tempdata[] = $i + 1;
            $tempdata[] = $record['EmployeeId'] ?? " ";
            $tempdata[] = $record['EmployeeName'] ?? " ";
            $tempdata[] = ($record['DOJ']) ? date('Y-m-d', strtotime($record['DOJ'])) : " ";
            $tempdata[] = ($record['last_working']) ? date('Y-m-d', strtotime($record['last_working'])) : " ";
            $tempdata[] = $record['deptName'] ?? " ";
            $tempdata[] = $record['designations'] ?? " ";
            $date = new DateTime($record['Date']);
            $date->modify('last day of this month');
            $lastDay = $date->format('d');
            $lastDay = (int)$lastDay;
            $tempdata[] = $lastDay ?? 30;
            $tempdata[] = $record['leave_count'] ?? 30;
            $tempdata[] = $record['LOP'] ?? 0;
            $tempdata[] = $record['Gross'] ?? 0.00;
            $tempdata[] = $record['Basic'] ?? 0.00;
            $tempdata[] = $record['HRA'] ?? 0.00;
            $tempdata[] = $record['FBP'] ?? 0.00;
            $tempdata[] = $record['SD1'] ?? 0.00;
            $tempdata[] = ($record['Basic'] + $record['HRA'] + $record['FBP'] + $record['SD1']) ?? 0.00;
            $tempdata[] = $record['PF'] ?? 0.00;
            $tempdata[] = $record['PT'] ?? 0.00;
            $tempdata[] = $record['PFVOL'] ?? 0.00;
            $tempdata[] = $record['TDS'] ?? 0.00;
            $tempdata[] = $record['Insurance'] ?? 0.00;
            $tempdata[] = $record['SD2'] ?? 0.00;
            $tempdata[] = ($record['PF'] + $record['PT'] + $record['PFVOL'] + $record['TDS'] + $record['Insurance'] + $record['SD2']) ?? 0.00;
            $tempdata[] = $record['Net_salary'] ?? 0.00;
            $tempdata[] = " ";

            $data[] = $tempdata;
            $tempdata = [];
        }

        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column names
        $sheet->setCellValue('A1', 'VSNAP TECHNOLOGY SOLUTIONS PRIVATE LIMITED');
        $filedate = date('M/Y', strtotime($fdate));
        $sheet->setCellValue('A4', 'Salary Sheet Report for the month of ' . $filedate);

        $sheet->setCellValue('A5', 'Sl.No');
        $sheet->setCellValue('B5', 'Emp ID');
        $sheet->setCellValue('C5', 'Employee Name');
        $sheet->setCellValue('D5', 'Date of Joining');
        $sheet->setCellValue('E5', 'Date of Leaving');
        $sheet->setCellValue('F5', 'Department');
        $sheet->setCellValue('G5', 'Designation');

        $sheet->setCellValue('H5', 'Calendar Days');
        $sheet->setCellValue('I5', 'Leave Days');
        $sheet->setCellValue('J5', 'LOP Days');

        $sheet->setCellValue('K5', 'Gross Salary');
        $sheet->setCellValue('L5', 'BASIC');
        $sheet->setCellValue('M5', 'HRA');
        $sheet->setCellValue('N5', 'FBP');
        $sheet->setCellValue('O5', 'Special Earning');
        $sheet->setCellValue('P5', 'Total Earning');

        $sheet->setCellValue('Q5', 'PF');
        $sheet->setCellValue('R5', 'PT');
        $sheet->setCellValue('S5', 'PFVOL');
        $sheet->setCellValue('T5', 'TDS');
        $sheet->setCellValue('U5', 'Health Insurance');
        $sheet->setCellValue('V5', 'Special Deduction');
        $sheet->setCellValue('W5', 'Total Deduction');

        $sheet->setCellValue('X5', 'Net Amount');
        $sheet->setCellValue('Y5', 'Remarks if any and Signature');

        // Populate data
        $row = 6;
        foreach ($data as $rec) {
            $sheet->setCellValue('A' . $row, $rec[0]);
            $sheet->setCellValue('B' . $row, $rec[1]);
            $sheet->setCellValue('C' . $row, $rec[2]);
            $sheet->setCellValue('D' . $row, $rec[3]);
            $sheet->setCellValue('E' . $row, $rec[4]);
            $sheet->setCellValue('F' . $row, $rec[5]);
            $sheet->setCellValue('G' . $row, $rec[6]);
            $sheet->setCellValue('H' . $row, $rec[7]);
            $sheet->setCellValue('I' . $row, $rec[8]);
            $sheet->setCellValue('J' . $row, $rec[9]);
            $sheet->setCellValue('K' . $row, $rec[10]);
            $sheet->setCellValue('L' . $row, $rec[11]);
            $sheet->setCellValue('M' . $row, $rec[12]);
            $sheet->setCellValue('N' . $row, $rec[13]);
            $sheet->setCellValue('O' . $row, $rec[14]);
            $sheet->setCellValue('P' . $row, $rec[15]);
            $sheet->setCellValue('Q' . $row, $rec[16]);
            $sheet->setCellValue('R' . $row, $rec[17]);
            $sheet->setCellValue('S' . $row, $rec[18]);
            $sheet->setCellValue('T' . $row, $rec[19]);
            $sheet->setCellValue('U' . $row, $rec[20]);
            $sheet->setCellValue('V' . $row, $rec[21]);
            $sheet->setCellValue('W' . $row, $rec[22]);
            $sheet->setCellValue('X' . $row, $rec[23]);
            $sheet->setCellValue('Y' . $row, $rec[24]);
            $row++;
        }

        // Create a writer instance
        $writer = new Xlsx($spreadsheet);

        // Set headers to download the file
        $filedate = date('M-y', strtotime($fdate));
        $fileName = "Salary Register_" . $filedate . ".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        // Output the Excel file to the browser
        $writer->save('php://output');

        return true;
    }

    public function getAllPayslips($dat)
    {
        $this->autopayslipmaker();

        $fdate = $dat['fdate'];
        $trickCondition = ($dat['trickid'] == 1) ? 'B.Salary_date = 5' : 'B.Salary_date = 10';

        // Query 1: Fetch employee and payslip details
        $sql = "SELECT B.EmployeeName, B.Salary_date, A.LOP, A.Net_salary, A.Date, A.Status, A.IDPK
                FROM payslips A
                LEFT JOIN employees B ON B.EmployeeId = A.EmployeeIDFK
                WHERE YEAR(A.Date) = YEAR('$fdate') AND MONTH(A.Date) = MONTH('$fdate') AND $trickCondition";
        $data['results'] = $this->db->query($sql)->getResultArray();

        // Query 2: Count payslips by status (combine into one query)
        $sql = "SELECT A.Status,COUNT(*) AS count
                FROM payslips A
                LEFT JOIN employees B ON B.EmployeeId = A.EmployeeIDFK
                WHERE YEAR(Date) = YEAR('$fdate') AND MONTH(Date) = MONTH('$fdate') AND $trickCondition 
                GROUP BY Status";
        $statusCounts = $this->db->query($sql)->getResultArray();
        $data['mode0'] = 0;
        $data['mode1'] = 0;
        $data['mode2'] = 0;
        foreach ($statusCounts as $row) {
            $data['mode' . $row['Status']] = $row['count'];
        }

        // Query 3: Count employees by salary date condition (combine into one query)
        $sql = "SELECT SUM(CASE WHEN B.Salary_date = 5 THEN 1 ELSE 0 END) AS trick1_count,
                       SUM(CASE WHEN B.Salary_date = 10 THEN 1 ELSE 0 END) AS trick2_count
                FROM payslips A
                LEFT JOIN employees B ON B.EmployeeId = A.EmployeeIDFK
                WHERE YEAR(A.Date) = YEAR('$fdate') AND MONTH(A.Date) = MONTH('$fdate')";
        $trickCounts = $this->db->query($sql)->getRowArray();
        $data['trick1_count'] = $trickCounts['trick1_count'] ?? 0;
        $data['trick2_count'] = $trickCounts['trick2_count'] ?? 0;

        return $data;
    }


    public function autopayslipmaker()
    {
        $sql = "SELECT A.EmployeeId 
                FROM employees A
                LEFT JOIN payslips B ON B.EmployeeIDFK = A.EmployeeId 
                                        AND MONTH(B.Date) = MONTH(CURRENT_DATE()) 
                                        AND YEAR(B.Date) = YEAR(CURRENT_DATE())
                WHERE A.Status = 'Working' AND B.EmployeeIDFK IS NULL";
        $data = $this->db->query($sql)->getResultArray();

        foreach ($data as $i => $value) {
            $sql = "INSERT INTO `payslips`(`EmployeeIDFK`, `LOP`, `Basic`, `HRA`, `FBP`, `SD1`, `PF`, `PT`, `PFVOL`, `SD2`, `Insurance`, `Net_salary`, `Status`) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $this->db->query($sql, [$value['EmployeeId'], 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0]);
        }
    }

    public function getEmployeePaySlipSpecific($id)
    {
        $sql = "SELECT A.Basic, A.HRA, A.FBP, A.PF, A.PT, A.PFVOL, A.SD2, A.SD1, A.Insurance, A.Net_salary, A.Date, A.LOP, A.Net_salary,
                       B.PF_No, B.ESI_No, B.DOJ, B.EmployeeCode, B.EmployeeName, B.PAN_No, B.UAN_No,
                       C.designations,
                       D.deptName,
                       E.AccountNo, E.Mode
                FROM payslips A 
                LEFT JOIN `employees` B ON B.EmployeeId = A.EmployeeIDFK
                LEFT JOIN `designation` C ON C.IDPK = B.DesignationIDFK
                LEFT JOIN `departments` D ON D.IDPK = B.DepartmentId
                LEFT JOIN `emp_bank_details` E ON E.EmployeeIDFK = A.EmployeeIDFK and E.Type = A.Acc_Type
                WHERE A.IDPK = $id";
        $data = $this->db->query($sql)->getRowArray();
        return $data;
    }

    public function getEmployeeFiles($id)
    {
        $sql = "SELECT IDPK, Doc_CategoryIDFK, Document_Name FROM documents WHERE EmployeeIDFK = $id";
        $data = $this->db->query($sql)->getResultArray();
        // print_r($data);exit(0);
        return $data;
    }

    public function getEmployeeProFilesStore($data)
    {
        foreach ($data as $record) {
            $EmployeeIDFK = $record['EmployeeIDFK'];
            $Doc_CategoryIDFK = $record['Doc_CategoryIDFK'];
            $Document_Name = $record['Document_Name'];
            $sql = "INSERT INTO documents(`EmployeeIDFK`, `Doc_CategoryIDFK`, `Document_Name`) VALUES('$EmployeeIDFK', '$Doc_CategoryIDFK', '$Document_Name')";
            $this->db->query($sql);
        }
    }

    public function getEmployeeProFilesRemove($id, $path)
    {
        $sql = "SELECT Document_Name FROM documents WHERE IDPK = $id";
        $name = $this->db->query($sql)->getRowArray();
        $filePath = $path . $name['Document_Name']; // Path to the file you want to delete
        if (file_exists($filePath)) {
            unlink($filePath); // Delete the file
        } else {
            echo "File not found.";
        }
        $sql = "DELETE FROM documents WHERE IDPK = $id";
        $this->db->query($sql);
        // print_r($filePath);exit(0);
        return $name;
    }

    public function UpdateSingleEmployee($id, $data, $acctype)
    {
        // Ensure $data is not empty
        if (empty($data)) {
            return false; // No data to update
        }

        // Construct the SET clause dynamically
        foreach ($data as $key => $value) {
            $setClause = "`$key` = '" . $value . "'";
            $column = $key;
            $record = $value;
        }

        // Construct the SQL query
        $employee_table = ["ReportManagerIDFK", "Salary_date", "ContractPeriod", "Aadhar_No", "PAN_No", "UAN_No", "EContactNo", "ESI_No", "PF_No"];
        $salary_info = ["BasicSalary", "HRA", "FBP", "PF", "PT", "PF_VOL", "Insurance", "Grativity", "GrossSalary", "NetSalary", "TDS"];
        $emp_bank_table = ["AccountHolderName", "BankName", "BankBranch", "AccountNo", "IFSCode", "Mode"];
        $bio_employee_table = ["EmployeeName", "EmployeeCode", "Gender", "DOB", "BLOODGROUP", "FatherName", "MotherName", "PlaceOfBirth", "ResidentialAddress", "PermanentAddress", "ContactNo", "AltContactno", "Email", "PersonalMail", "DepartmentId", "DesignationIDFK", "Status", "EmployementType", "DOJ", "Image"];

        if (in_array($column, $bio_employee_table)) {
            $sql1 = "UPDATE biometric.employees SET $setClause WHERE `EmployeeId` = ?";
            $sql2 = "UPDATE `employees` SET $setClause WHERE `EmployeeId` = ?";
            $this->db->query($sql1, $id);
            $this->db->query($sql2, $id);
            if ($column == "Status") {
            }
        } else if (in_array($column, $employee_table)) {
            $sql3 = "UPDATE `employees` SET $setClause WHERE `EmployeeId` = ?";
            $this->db->query($sql3, $id);
        } else if (in_array($column, $salary_info)) {
            $sql6 = "SELECT * FROM salary_info WHERE EmployeeIDFK = ?";
            $salary = $this->db->query($sql6, $id)->getResultArray();
            $sal = count($salary);
            $salary = $salary[0];

            if ($sal > 0) {
                $Gross = $salary['GrossSalary'] ?? 0.00;
                $Pf = $salary['PF'] ?? 0.00;
                $Pt = $salary['PT'] ?? 0.00;
                $Pfvol = $salary['PF_VOL'] ?? 0.00;
                $TDS = $salary['TDS'] ?? 0.00;
                $Ins = $salary['Insurance'] ?? 0.00;
                $Grati = $salary['Grativity'] ?? 0.00;
                $Esi = $salary['ESI'] ?? 0;
                $Esi_vol = ($Esi == 1) ? ($Gross / 100) * 4 : 0;
                if ($column == "PF") {
                    $Pf = $record;
                } else if ($column == "PT") {
                    $Pt = $record;
                } else if ($column == "PF_VOL") {
                    $Pfvol = $record;
                } else if ($column == "TDS") {
                    $TDS = $record;
                } else if ($column == "Insurance") {
                    $Ins = $record;
                } else if ($column == "Grativity") {
                    $Grati = $record;
                } else if ($column == "GrossSalary") {
                    $Gross = $record;
                }
                $Gross_earn = $Gross - ($Pf + $Pfvol + $TDS + $Pt + $Ins + $Grati + $Esi_vol);
                $Basic = ($Gross / 100) * 40;
                $Hra   = ($Basic / 100) * 40;
                $Fbp   = $Gross_earn - ($Basic + $Hra);
                $Netsal = ($Basic + $Hra + $Fbp) - ($Pf + $Pfvol + $TDS + $Pt + $Ins + $Grati + $Esi_vol);
                $sql4 = "UPDATE `salary_info` SET `BasicSalary`=?,`HRA`=?,`FBP`=?,`PF`=?,`PT`=?,`PF_VOL`=?, `TDS`=?,
                                                  `Insurance`=?,`Grativity`=?,`ESI`=?,`GrossSalary`=?,`NetSalary`=? 
                         WHERE `EmployeeIDFK` = ?";
                $this->db->query($sql4, [$Basic, $Hra, $Fbp, $Pf, $Pt, $Pfvol, $TDS, $Ins, $Grati, $Esi, $Gross, $Netsal, $id]);
            } else {
                $sql7 = "INSERT INTO `salary_info`(`EmployeeIDFK`, `BasicSalary`, `HRA`, `FBP`, `PF`, `PT`, `PF_VOL`, `TDS`, `Insurance`, `Grativity`, `GrossSalary`, `NetSalary`, `ESI`) 
                         VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                $this->db->query($sql7, [$id, 0.00, 0.00, 0.00, 1800.00, 200.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0]);

                $sql6 = "SELECT * FROM salary_info WHERE EmployeeIDFK = ?";
                $salary = $this->db->query($sql6, $id)->getRowArray();

                $Gross = $salary['GrossSalary'] ?? 0.00;
                $Pf = $salary['PF'] ?? 0.00;
                $Pt = $salary['PT'] ?? 0.00;
                $Pfvol = $salary['PF_VOL'] ?? 0.00;
                $TDS = $salary['TDS'] ?? 0.00;
                $Ins = $salary['Insurance'] ?? 0.00;
                $Grati = $salary['Grativity'] ?? 0.00;
                $Esi = $salary['ESI'] ?? 0;
                $Esi_vol = ($Esi == 1) ? ($Gross / 100) * 4 : 0;
                if ($column == "PF") {
                    $Pf = $record;
                } else if ($column == "PT") {
                    $Pt = $record;
                } else if ($column == "PF_VOL") {
                    $Pfvol = $record;
                } else if ($column == "TDS") {
                    $TDS = $record;
                } else if ($column == "Insurance") {
                    $Ins = $record;
                } else if ($column == "Grativity") {
                    $Grati = $record;
                } else if ($column == "GrossSalary") {
                    $Gross = $record;
                }
                $Gross_earn = $Gross - ($Pf + $Pfvol + $TDS + $Pt + $Ins + $Grati + $Esi_vol);
                $Basic = ($Gross / 100) * 40;
                $Hra   = ($Basic / 100) * 40;
                $Fbp   = $Gross_earn - ($Basic + $Hra);
                $Netsal = ($Basic + $Hra + $Fbp) - ($Pf + $Pfvol + $TDS + $Pt + $Ins + $Grati + $Esi_vol);
                $sql4 = "UPDATE `salary_info` SET `BasicSalary`=?,`HRA`=?,`FBP`=?,`PF`=?,`PT`=?,`PF_VOL`=?, `TDS`=?,
                                                  `Insurance`=?,`Grativity`=?,`ESI`=?,`GrossSalary`=?,`NetSalary`=? 
                         WHERE `EmployeeIDFK` = ?";
                $this->db->query($sql4, [$Basic, $Hra, $Fbp, $Pf, $Pt, $Pfvol, $TDS, $Ins, $Grati, $Esi, $Gross, $Netsal, $id]);
            }
        } else if (in_array($column, $emp_bank_table)) {
            $sql5 = "UPDATE `emp_bank_details` SET $setClause WHERE `EmployeeIDFK`=? AND `Type`= $acctype";
            $this->db->query($sql5, $id);
        }
        return true;
    }


    public function UpdateSingleAbsEmployee($id, $data)
    {
        $sql3 = "UPDATE `employees` 
                 SET last_working=?,settlement_day=?,final_set_status=?,final_set_amound=? 
                 WHERE `EmployeeId` = ?";
        $this->db->query($sql3, [$data['last_working'], $data['settlement_day'], $data['final_set_status'], $data['final_set_amound'], $id]);

        return true;
    }

    public function AllTickets($trickid, $data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        if ($trickid == 1) {
            $trick = "";
        } else if ($trickid == 2) {
            $trick = "AND A.Status = 0";
        } else if ($trickid == 3) {
            $trick = "AND A.Status = 1";
        } else if ($trickid == 4) {
            $trick = "AND A.Status = 2";
        } else if ($trickid == 5) {
            $trick = "AND A.Status = 3";
        }

        $sql = "SELECT A.*, B.Name, C.EmployeeName
                FROM tickets A 
                LEFT JOIN ticket_types B ON B.IDPK = A.TypeIDFK
                LEFT JOIN employees C ON C.EmployeeId = A.EmployeeIDFK
                WHERE DATE(Raised_On) BETWEEN '$fdate' AND '$todate' $trick";
        $records = $this->db->query($sql)->getResultArray();

        return $records;
    }

    public function GetIssueTypes()
    {
        $sql = "SELECT * FROM ticket_types";
        $records = $this->db->query($sql)->getResultArray();
        return $records;
    }

    public function CreateTicket($data)
    {
        $sql = "INSERT INTO `tickets`(`EmployeeIDFK`, `TypeIDFK`, `Subject`, `Description`, `Priority`) 
                VALUES (?,?,?,?,?)";
        $this->db->query($sql, [$data['EmployeeIDFK'], $data['TypeIDFK'], $data['Subject'], $data['Description'], $data['Priority']]);
        return true;
    }

    public function EditTicket($id)
    {
        $sql = "SELECT A.Subject, A.Description, A.Priority, A.Raised_On, A.Status, B.EmployeeName
                FROM tickets A
                LEFT JOIN employees B ON B.EmployeeId = A.EmployeeIDFK
                WHERE A.IDPK = ?";
        $data = $this->db->query($sql, $id)->getRowArray();
        return $data;
    }

    public function StatusChangeTicket($id, $status)
    {
        $sql = "UPDATE tickets SET Status=? WHERE IDPK=?";
        $this->db->query($sql, [$status, $id]);
        return true;
    }

    public function UserWeekTimelog($data)
    {
        $fdate = date("Y-m-d", strtotime("monday this week"));
        $todate = date("Y-m-d", strtotime("saturday this week"));
        $id = $data['EmpId'];

        $sqltemptable = "DROP TEMPORARY TABLE if exists `temptable`";
        $sql_select11 = "CREATE TEMPORARY TABLE temptable
                SELECT LogDate, MIN(LogDate) as login, MAX(LogDate) as logout, TIMEDIFF( MAX(LogDate), MIN(LogDate)) as workingHours
                FROM biometric.`devicelogs_processed` 
                LEFT JOIN employees B ON B.EmployeeCode = biometric.devicelogs_processed.UserId 
                WHERE B.EmployeeId = $id AND DATE(LogDate) BETWEEN '$fdate' AND '$todate'
                GROUP BY UserId, YEAR(LogDate), MONTH(LogDate), DAY(LogDate)  
                ORDER BY LogDate asc";
        $sql_select = "SELECT * FROM `temptable` WHERE workingHours != '00:00:00'";

        $this->db->query($sqltemptable);
        $this->db->query($sql_select11);
        $data['selectedemps'] = $this->db->query($sql_select)->getResultArray(); //run the query
        return $data['selectedemps'];
    }

    public function UserTodayTimelog($data)
    {
        $date = date('Y-m-d');
        $id = $data['EmpId'];

        $sqltemptable = "DROP TEMPORARY TABLE if exists `temptable`";
        $sql_select11 = "CREATE TEMPORARY TABLE temptable
                SELECT MIN(LogDate) as login
                FROM biometric.`devicelogs_processed` 
                LEFT JOIN employees B ON B.EmployeeCode = biometric.devicelogs_processed.UserId
                WHERE B.EmployeeId = $id AND DATE(LogDate) = '$date'";
        $sql_select = "SELECT * FROM `temptable`";

        $this->db->query($sqltemptable);
        $this->db->query($sql_select11);
        $data['selectedemps'] = $this->db->query($sql_select)->getRow()->login; //run the query

        return $data['selectedemps'];
    }

    public function UserTickets($id)
    {
        $sql = "SELECT A.*, B.Name, C.EmployeeName
                FROM tickets A 
                LEFT JOIN ticket_types B ON B.IDPK = A.TypeIDFK
                LEFT JOIN employees C ON C.EmployeeId = A.EmployeeIDFK
                WHERE C.EmployeeId = $id";
        $records = $this->db->query($sql)->getResultArray();

        return $records;
    }

    public function selectleaveType()
    {
        $sql = "SELECT * FROM `leavetype` ";
        $data['selectleavetype'] = $this->db->query($sql)->getResultArray();
        return $data['selectleavetype'];
    }

    public function GetAllLeaves($trickid, $data, $sac)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        if ($trickid == 1) {
            $trick = "";
        } else if ($trickid == 2) {
            $trick = "AND A.Status = 0";
        } else if ($trickid == 3) {
            $trick = "AND A.Status = 1";
        } else if ($trickid == 4) {
            $trick = "AND A.Status = 2";
        }

        if ($sac == 1) {
            $trick2 = "";
        } else {
            $trick2 = "AND (B.DesignationIDFK != 2 AND B.DesignationIDFK != 18)";
        }

        $sql = "SELECT A.*, B.EmployeeName ,C.Name 
                FROM leaves A
                LEFT JOIN employees B ON B.EmployeeId = A.EmployeeIDFK
                LEFT JOIN leavetype C ON C.IDPK = A.TypeIDFK
                WHERE DATE(Date) BETWEEN '$fdate' AND '$todate' $trick $trick2";
        $leaves = $this->db->query($sql)->getResultArray();
        return $leaves;
    }

    public function leaveDetails($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];

        $sql = "SELECT A.Date, B.EmployeeCode, B.EmployeeName, C.Name 
                FROM leaves A
                LEFT JOIN employees B ON B.EmployeeId = A.EmployeeIDFK
                LEFT JOIN leavetype C ON C.IDPK = A.TypeIDFK
                WHERE DATE(Date) BETWEEN '$fdate' AND '$todate' AND A.Status != 2";
        $leaves = $this->db->query($sql)->getResultArray();
        return $leaves;
    }


    public function GetLeave($id)
    {
        $sql = "SELECT A.*, B.EmployeeName ,C.Name 
                FROM leaves A
                LEFT JOIN employees B ON B.EmployeeId = A.EmployeeIDFK
                LEFT JOIN leavetype C ON C.IDPK = A.TypeIDFK
                WHERE A.IDPK = $id";
        $leaves = $this->db->query($sql)->getRowArray();
        return $leaves;
    }

    public function StatusLeaveUpdate($id, $status)
    {
        $sql = "UPDATE `leaves` SET `Status`= $status WHERE IDPK = $id";
        $this->db->query($sql);
        return true;
    }

    public function ApplyLeave($data)
    {
        $sql = "INSERT INTO `leaves`(`EmployeeIDFK`, `TypeIDFK`, `Date`, `CompDate`, `Reason`, `Start_time`, `End_time`) 
                VALUES (?,?,?,?,?,?,?)";
        $this->db->query($sql, [$data['EmployeeIDFK'], $data['TypeIDFK'], $data['Date'], $data['CompDate'], $data['Reason'], $data['Start_time'], $data['End_time']]);
        return true;
    }

    public function GetUserLeaves($id)
    {
        $sql = "SELECT A.*, B.Name
                FROM leaves A
                LEFT JOIN leavetype B ON B.IDPK = A.TypeIDFK
                WHERE A.EmployeeIDFK = $id";
        $leaves = $this->db->query($sql)->getResultArray();
        return $leaves;
    }

    public function CasualCheck($id)
    {
        $sql = "SELECT A.CLPM, A.SLPM, A.PLPM 
                FROM departments A
                LEFT JOIN employees B ON B.DepartmentId = A.IDPK
                WHERE B.EmployeeId = ?";
        $limits = $this->db->query($sql, [$id])->getRowArray();
        $sql = "SELECT TypeIDFK, COUNT(*) AS leave_count 
                FROM leaves 
                WHERE EmployeeIDFK = ? 
                AND DATE(Date) BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND LAST_DAY(NOW()) 
                GROUP BY TypeIDFK";
        $leaves = $this->db->query($sql, [$id])->getResultArray();

        $leaveCounts = [1 => 0, 2 => 0, 3 => 0]; // Assuming TypeIDFK: 1 = CL, 2 = SL, 3 = PL
        foreach ($leaves as $leave) {
            $leaveCounts[$leave['TypeIDFK']] = $leave['leave_count'];
        }
        return [
            'CLPM' => ($leaveCounts[1] < $limits['CLPM']) ? 1 : 0,
            'SLPM' => ($leaveCounts[2] < $limits['SLPM']) ? 1 : 0,
            'PLPM' => ($leaveCounts[3] < $limits['PLPM']) ? 1 : 0
        ];
    }
}
