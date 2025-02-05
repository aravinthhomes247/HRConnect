<?php

namespace App\Models;

use Codeigniter\Controller\HRController;
use CodeIgniter\Model;

class CandidateModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'candidates';
    protected $primaryKey       = 'CandidateId';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [

        'CandidateId',
        'CandidateName',
        'CandidateContactNo',
        'CandidateEmail',
        'CandidatePassword',
        'Source',
        'ScheduleStatus',
        'CandidateLocation',
        'CandidateEducation',
        'TotalExperience',
        'CandidateExperience',
        'LastCompany',
        'CandidateCurrentCTC',
        'CandidateExpectedCTC',
        'ImmediateJoiner',
        'DaysRequired',
        'NoticePeroid',
        'CandidateResume',
        'InterviewDate',
        'CandidateReason',
        'Created_at'
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

    public function __construct()
    {
        parent::__construct();
        // $this->$db      = \Config\Database::connect();
        $this->db      = \Config\Database::connect('default');
        // print_r($db);exit();
    }




    public function getCandidates($data)
    {

        $data = $this->db->table('candidates')
            ->where($data)
            ->get()
            ->getRow();
        // print_r($data);exit();
        return $data;
    }
    public function candidatesBulkInsert($list, $HR_IDFK)
    {
        // print_r($list);exit();
        // $HR_IDFK = $data['HR_IDFK'] ;
        $created_at = date('Y-m-d H:i:s');
        $hrquery = "SELECT EmployeeName FROM employees WHERE employeeId = $HR_IDFK ";
        $hrresult = $this->db->query($hrquery)->getResultArray();
        $hrName = $hrresult[0]['EmployeeName'];

        foreach ($list as $filesop) {
            $name = $filesop['CandidateName'];
            $contactNo = $filesop['CandidateContactNo'];
            $email = $filesop['CandidateEmail'];
            $scheduleStatus = 12;
            $source = $filesop['Source'];
            $candidatePosition = $filesop['CandidatePosition'];
            // $text = preg_replace('/&nbsp;/', ' ', $source);
            // $text2 = preg_replace('/&nbsp;/', ' ', $candidatePosition);
            // $interviewDate = $filesop['InterviewDate'];
            if ($filesop['user_level'] == 42) {
                $UploadBy = $filesop['HR_IDFK'];
                $AssignTo = null;
            } else {
                $UploadBy = $filesop['HR_IDFK'];
                $AssignTo = $filesop['HR_IDFK'];
            }

            // print_r($filesop);exit();

            $run_query = "INSERT INTO candidates (CandidateName, CandidateContactNo, CandidatePassword, CandidateEmail,Source,ScheduleStatus,CandidatePosition, UploadBy, AssignTo, Created_at ) 
            SELECT * FROM (SELECT '$name' as CandidateName, '$contactNo' as CandidateContactNo, '$contactNo' as CandidatePassword, '$email' as CandidateEmail,'$source' as Source, '$scheduleStatus' as ScheduleStatus,'$candidatePosition' as CandidatePosition, '$UploadBy' as UploadBy, '$AssignTo' as AssignTo , '$created_at' as Created_at) AS temp 
            WHERE NOT EXISTS (SELECT CandidateId FROM candidates WHERE CandidateContactNo = '$contactNo' )";
            $this->db->query($run_query);
            $lastInsertedId = $this->db->insertID();

            $Status = 'Fresh List';
            $Remarks = $hrName . ' Uploaded through excel file ';
            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`, `HR_IDFK`, `Updated_by`) VALUES('$lastInsertedId','$Status','$Remarks','$AssignTo','$UploadBy')";
            $this->db->query($query);
        }
        return true;
    }

    // $sql_select ="SELECT A.prop_IDFK, B.property_info_name 
    // FROM property_onpage_parameters A
    // LEFT JOIN Property_info AS B ON B.property_info_IDPK = A.prop_IDFK
    // WHERE B.property_info_name LIKE '%$keyword%'";
    // $query_select = $this->db->query($sql_select);
    // $result=$query_select->result();
    // return $result;

    public function getSourceIdpk($source)
    {
        // print($source);exit();
        $text = preg_replace('/\s+/', '', $source);
        // print($text);exit();
        // $text2 = preg_replace('/&nbsp;/', ' ', $candidatePosition);
        $sql = "SELECT SM_IDPK From candidate_source WHERE SM_Name LIKE '%$text%'";
        $data['sourceidpk'] = $this->db->query($sql)->getResultArray();
        // print_r($sql);exit();
        return $data['sourceidpk'];
    }
    public function getPositionIdpk($position)
    {
        // $text = preg_replace('/\s+/', '', $position);
        $sql = "SELECT IDPK From designation WHERE designations LIKE '%$position%'";
        $data['positionidpk'] = $this->db->query($sql)->getResultArray();
        // print_r($data['positionidpk']);exit();
        return $data['positionidpk'];
    }

    public function Candidate_Source_ListM()
    {
        $sql = "SELECT * From candidate_source ORDER BY SM_Name ASC";
        $data['socialMedia'] = $this->db->query($sql)->getResultArray();
        return $data['socialMedia'];
    }
    public function getYettoAssignListCount($adminId)
    {
        $sql = "SELECT count(*) as Count From candidates where AssignTo is null OR AssignTo = 0";
        $data['yetToAssignCount'] = $this->db->query($sql)->getResultArray();
        // print_r($data['yetToAssignCount']);exit();
        return $data['yetToAssignCount'];
    }

    public function getSourceCount($sourceId, $adminId)
    {
        $sql = "SELECT count(*) as Count From candidates where Source = '$sourceId' and UploadBy = '$adminId' and AssignTo = 0 ";
        $data['sourceCount'] = $this->db->query($sql)->getResultArray();
        // print_r($data['sourceCount']);exit();
        return $data['sourceCount'];
    }

    public function notschedule_reasons_ListM()
    {
        $sql = "SELECT * From notschedule_reasons WHERE ((NS_IDPK != 1) AND (NS_IDPK != 2) AND (NS_IDPK != 9) AND (NS_IDPK != 10) AND (NS_IDPK != 12) AND (NS_IDPK != 11) )  ORDER BY NS_Reasons ASC";
        $data['notScheduleReasons'] = $this->db->query($sql)->getResultArray();
        return $data['notScheduleReasons'];
    }

    public function update_assignToM($data)
    {
        $Source = $data['Source'];
        $assignto = $data['assignto'];
        $assignCount = $data['assignCount'];
        $adminId = $data['adminId'];

        // $updateSql = "UPDATE `candidates` SET `AssignTo`='$assignto', `ScheduleStatus` = 12 WHERE UploadBy = '$adminId' and Source = '$Source' and AssignTo = 0 LIMIT $assignCount ";
        $updateSql = "UPDATE `candidates` SET `AssignTo`='$assignto', `UploadBy`='$adminId', `ScheduleStatus` = 12 
                      WHERE Source = '$Source' AND (AssignTo = 0 OR AssignTo is NULL)
                      LIMIT $assignCount";

        $this->db->query($updateSql);
        $updatedRows = $this->db->affectedRows();
        // print_r($updatedRows);exit();
        return $updatedRows;
    }

    public function update_reassignToM($data)
    {
        $Source = $data['Source'];
        $assignto = $data['assignto'];
        $assignCount = $data['assignCount'];
        $assignfrom = $data['assignfrom'];

        if ($data['assignas'] == 0) {
            $status = '12 AS';
        } else {
            $status = '';
        }
        if ($data['trickid'] == 1) {
            $trick = 'AND c1.ScheduleStatus = 1';
        } else if ($data['trickid'] == 2) {
            $trick = 'AND (c1.ScheduleStatus = 2 OR c1.ScheduleStatus = 4 OR c1.ScheduleStatus = 5 OR c1.ScheduleStatus = 6)';
        } else if ($data['trickid'] == 3) {
            $trick = 'AND (c1.ScheduleStatus = 11 OR c1.ScheduleStatus = 3 OR c1.ScheduleStatus = 8 OR c1.ScheduleStatus = 7)';
        } else if ($data['trickid'] == 4) {
            $trick = '';
        } else if ($data['trickid'] == 5) {
            $trick = '';
        } else if ($data['trickid'] == 6) {
            $trick = '';
        } else if ($data['trickid'] == 8) {
            $trick = '';
        } else if ($data['trickid'] == 12) {
            $trick = 'AND c1.ScheduleStatus = 12';
        } else if ($data['trickid'] == 15) {
            $trick = '';
        }
        if ($assignto != $assignfrom) {
            $insertSql = "INSERT INTO `candidates` (CandidateName, EmployeeIDFK, UploadBy, AssignTo, InterviewDate, ScheduleStatus, CallBackDateTime, CandidateContactNo, 
                                    CandidateEmail, Source, CandidateLocation, CandidatePassword, CandidatePosition, CandidateEducation, TotalExperience, CandidateExperience,
                                    LastCompany, CandidateCurrentCTC, CandidateExpectedCTC, ImmediateJoiner, DaysRequired, NoticePeroid, CandidateResume, CandidateReason,
                                    HR_IDFK, Created_at, Updated_date)
                        SELECT CandidateName, EmployeeIDFK, UploadBy, $assignto AS AssignTo, InterviewDate, $status ScheduleStatus, CallBackDateTime, CandidateContactNo, CandidateEmail, Source, 
                            CandidateLocation, CandidatePassword, CandidatePosition, CandidateEducation, TotalExperience, CandidateExperience, LastCompany, 
                            CandidateCurrentCTC, CandidateExpectedCTC, ImmediateJoiner, DaysRequired, NoticePeroid, CandidateResume, CandidateReason, HR_IDFK, Created_at, 
                            Updated_date
                        FROM `candidates` AS c1
                        WHERE c1.Source = $Source AND c1.AssignTo = $assignfrom $trick
                        AND NOT EXISTS (SELECT 1 FROM `candidates` AS c2 WHERE c2.AssignTo = $assignto AND c2.CandidateContactNo = c1.CandidateContactNo) LIMIT $assignCount";

            $this->db->query($insertSql);
            $insertedRows = $this->db->affectedRows();
            return $insertedRows;
        } else {
            // print_r('0');exit();
            return 0;
        }
    }


    public function interviewScheduledM($data)
    {
        $CandidateId = $data['CandidateId'];
        $scheduled = 1;
        $InterviewDate = $data['InterviewDate'];
        $HR_IDFK = $data['HR_IDFK'];
        $CandidateReason = $data['CandidateReason'];

        $hrquery = "SELECT EmployeeName FROM employees WHERE employeeId = $HR_IDFK ";
        $hrresult = $this->db->query($hrquery)->getResultArray();
        $hrName = $hrresult[0]['EmployeeName'];

        $sql = "UPDATE `candidates` SET `ScheduleStatus`='$scheduled', `InterviewDate`='$InterviewDate', `CandidateReason` = '$CandidateReason' WHERE CandidateId= $CandidateId ";

        $assigned_for = $this->db->query("SELECT AssignTo FROM `candidates` WHERE CandidateId = $CandidateId")->getRow()->AssignTo;

        if ($scheduled = 1) {
            $Status = 'Scheduled';
            $Remarks = $hrName . ' Scheduled an Interview on ' . $InterviewDate;

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateId','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        }
        $this->db->query($sql); //run the query
    }
    public function interviewNotScheduledM($data)
    {
        $CandidateId = $data['CandidateId'];
        $scheduled = $data['scheduled'];
        $CallBackDateTime = $data['CallBackDateTime'];
        $HR_IDFK = $data['HR_IDFK'];

        $hrquery = "SELECT EmployeeName FROM employees WHERE employeeId = $HR_IDFK ";
        $hrresult = $this->db->query($hrquery)->getResultArray();
        $hrName = $hrresult[0]['EmployeeName'];

        $query1 = "SELECT * FROM `notschedule_reasons` WHERE NS_IDPK = '$scheduled' ";
        $result1 = $this->db->query($query1)->getResultArray();
        $scheduledReason = $result1[0]['NS_Reasons'];
        //   print_r($CallBackDateTime);exit();

        $sql = "UPDATE `candidates` SET `ScheduleStatus`='$scheduled', `CallBackDateTime`='$CallBackDateTime' WHERE CandidateId= $CandidateId ";
        // print_r($sql);exit();

        $assigned_for = $this->db->query("SELECT AssignTo FROM `candidates` WHERE CandidateId = $CandidateId")->getRow()->AssignTo;

        if ($scheduled >= 2) {
            $Status = 'Not-Scheduled';
            $Remarks = $hrName . ' Not-Schedule an Interview because of candidate ' . $scheduledReason;

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`, `HR_IDFK`,`Updated_by`) VALUES('$CandidateId','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        }
        $this->db->query($sql); //run the query
    }


    // public function getCandidatesCount($data){
    //     $fdate = $data['fdate'];
    //     $todate = $data['todate'];
    //     if(isset($fdate) && !empty($fdate) && $fdate != "NA" && $fdate != 0 )
    //     {
    //         $dataBasefdate = "WHERE DATE(InterviewDate) BETWEEN '$fdate'";
    //     } else {
    //         $dataBasefdate = "";
    //     }

    //     if(isset($todate) && !empty($todate) && $todate != "NA" && $todate != 0 )
    //     {
    //         $dataBasetodate = "AND '$todate'";
    //     } else {
    //         $dataBasetodate = "";
    //     }

    //     $sql1 = "SELECT CandidateId FROM candidates $dataBasefdate $dataBasetodate";
    //     $result1['totalCandidatesCount'] = $this->db->query($sql1)->getResultArray(); 
    //     // print_r($result1['totalCandidatesCount']);exit();

    //     return $result1['totalCandidatesCount'];
    // }
    // public function getSelectedCandidatesCount($data){
    //     $fdate = $data['fdate'];
    //     $todate = $data['todate'];

    //     if(isset($fdate) && !empty($fdate) && $fdate != "NA" && $fdate != 0 )
    //     {
    //         $dataBasefdate = "AND DATE(InterviewDate) BETWEEN '$fdate'";
    //     } else {
    //         $dataBasefdate = "";
    //     }

    //     if(isset($todate) && !empty($todate) && $todate != "NA" && $todate != 0 )
    //     {
    //         $dataBasetodate = "AND '$todate'";
    //     } else {
    //         $dataBasetodate = "";
    //     }

    //     $sql = "SELECT CandidateId as SelectedCount FROM `interview_process` LEFT JOIN candidates ON CandidateId = CandidateIDFK WHERE  InterviewStatus = 2  $dataBasefdate $dataBasetodate";
    //     $result1['SelectedCandidatesCount'] = $this->db->query($sql)->getResultArray();

    //     // print_r($data['SelectedCandidatesCount']);exit();
    //     return $result1['SelectedCandidatesCount'];
    // }
    // public function getJoinedCandidatesCount($data){
    //     $fdate = $data['fdate'];
    //     $todate = $data['todate'];
    //     if(isset($fdate) && !empty($fdate) && $fdate != "NA" && $fdate != 0 )
    //     {
    //         $dataBasefdate = "AND DATE(JoiningDate) BETWEEN '$fdate'";
    //     } else {
    //         $dataBasefdate = "";
    //     }

    //     if(isset($todate) && !empty($todate) && $todate != "NA" && $todate != 0 )
    //     {
    //         $dataBasetodate = "AND '$todate'";
    //     } else {
    //         $dataBasetodate = "";
    //     }

    //     $sql = "SELECT A.CandidateId as JoinedCount FROM `candidates` A LEFT JOIN offer_letter B ON B.CandidateIDFK = A.CandidateId WHERE B.JoiningStatus = 1 $dataBasefdate $dataBasetodate";
    //     $result1['JoinedCandidatesCount'] = $this->db->query($sql)->getResultArray();

    //     // print_r($data['JoinedCandidatesCount']);exit();
    //     return $result1['JoinedCandidatesCount'];
    // }

    public function getHRassignedCandidatesCount($HRid, $data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        // $userLevel = $data['userLevel'];

        // print_r($HRid);exit();
        if (isset($fdate) && !empty($fdate) && $fdate != "NA" && $fdate != 0) {
            $dataBasefdate = "AND DATE(Created_at) BETWEEN '$fdate'";
        } else {
            $dataBasefdate = "";
        }

        if (isset($todate) && !empty($todate) && $todate != "NA" && $todate != 0) {
            $dataBasetodate = "AND '$todate'";
        } else {
            $dataBasetodate = "";
        }

        if ($HRid == 'default') {
            $sql1 = "SELECT CandidateId FROM candidates WHERE  ScheduleStatus= 12 $dataBasefdate $dataBasetodate";
        } else {
            $sql1 = "SELECT CandidateId FROM candidates WHERE  ScheduleStatus= 12 and AssignTo = '$HRid'  $dataBasefdate $dataBasetodate ";
        }

        $data['HRassignedCandidatesCount'] = $this->db->query($sql1)->getResultArray();

        // print_r($data['HRassignedCandidatesCount']);exit();
        return $data['HRassignedCandidatesCount'];
    }
    public function getHRCandidatesCount($HRid, $data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        // $userLevel = $data['userLevel'];

        // print_r($HRid);exit();
        if (isset($fdate) && !empty($fdate) && $fdate != "NA" && $fdate != 0) {
            $dataBasefdate = "AND DATE(InterviewDate) BETWEEN '$fdate'";
        } else {
            $dataBasefdate = "";
        }

        if (isset($todate) && !empty($todate) && $todate != "NA" && $todate != 0) {
            $dataBasetodate = "AND '$todate'";
        } else {
            $dataBasetodate = "";
        }

        if ($HRid == 'default') {
            $sql1 = "SELECT CandidateId FROM candidates";
        } else {
            $sql1 = "SELECT CandidateId FROM candidates WHERE AssignTo = '$HRid' $dataBasefdate $dataBasetodate";
        }

        $result1['HRtotalCandidatesCount'] = $this->db->query($sql1)->getResultArray();

        // print_r($result1['HRtotalCandidatesCount']);exit();
        return $result1['HRtotalCandidatesCount'];
    }
    public function getHRscheduledCount($HRid, $data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        // $userLevel = $data['userLevel'];
        if (isset($fdate) && !empty($fdate) && $fdate != "NA" && $fdate != 0) {
            $dataBasefdate = "AND DATE(InterviewDate) BETWEEN '$fdate'";
        } else {
            $dataBasefdate = "";
        }
        if (isset($todate) && !empty($todate) && $todate != "NA" && $todate != 0) {
            $dataBasetodate = "AND '$todate'";
        } else {
            $dataBasetodate = "";
        }
        if ($HRid == 'default') {
            $sql1 = "SELECT CandidateId FROM candidates WHERE ScheduleStatus = 1  $dataBasefdate $dataBasetodate";
        } else {
            $sql1 = "SELECT CandidateId FROM candidates WHERE ScheduleStatus = 1  and AssignTo = '$HRid' $dataBasefdate $dataBasetodate";
        }
        $result1['HRscheduledCount'] = $this->db->query($sql1)->getResultArray();
        return $result1['HRscheduledCount'];
    }

    public function getHRnotScheduledCount($HRid, $data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        // $userLevel = $data['userLevel'];

        // print_r($HRid);exit();
        if (isset($fdate) && !empty($fdate) && $fdate != "NA" && $fdate != 0) {
            $dataBasefdate = "AND DATE(Created_at) BETWEEN '$fdate'";
        } else {
            $dataBasefdate = "";
        }

        if (isset($todate) && !empty($todate) && $todate != "NA" && $todate != 0) {
            $dataBasetodate = "AND '$todate'";
        } else {
            $dataBasetodate = "";
        }

        if ($HRid == 'default') {
            $sql1 = "SELECT CandidateId FROM candidates  WHERE (ScheduleStatus != 1 and ScheduleStatus != 10 and ScheduleStatus != 11 and ScheduleStatus != 12 and ScheduleStatus != 0 and ScheduleStatus != 8 AND ScheduleStatus != 7 AND ScheduleStatus != 11 AND ScheduleStatus != 3 ) $dataBasefdate $dataBasetodate ";
        } else {
            $sql1 = "SELECT CandidateId FROM candidates WHERE (ScheduleStatus != 1 and ScheduleStatus != 10 and ScheduleStatus != 11 and ScheduleStatus != 12 and ScheduleStatus != 0 and ScheduleStatus != 8 AND ScheduleStatus != 7 AND ScheduleStatus != 11 AND ScheduleStatus != 3) and AssignTo = $HRid $dataBasefdate $dataBasetodate";
        }

        // print_r($sql1);exit();

        $result1['HRnotScheduledCount'] = $this->db->query($sql1)->getResultArray();

        // print_r($result1['HRnotScheduledCount']);exit();
        return $result1['HRnotScheduledCount'];
    }
    public function getHRSelectedCandidatesCount($HRid, $data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];

        // print_r($fdate);exit();
        if (isset($fdate) && !empty($fdate) && $fdate != "NA" && $fdate != 0) {
            $dataBasefdate = "AND DATE(Created_at) BETWEEN '$fdate'";
        } else {
            $dataBasefdate = "";
        }

        if (isset($todate) && !empty($todate) && $todate != "NA" && $todate != 0) {
            $dataBasetodate = "AND '$todate'";
        } else {
            $dataBasetodate = "";
        }
        if ($HRid == 'default') {
            $sql = "SELECT CandidateId as SelectedCount FROM `interview_process` LEFT JOIN candidates ON CandidateId = CandidateIDFK WHERE  InterviewStatus = 2 $dataBasefdate $dataBasetodate";
        } else {
            $sql = "SELECT CandidateId as SelectedCount FROM `interview_process` LEFT JOIN candidates ON CandidateId = CandidateIDFK WHERE  InterviewStatus = 2 AND candidates.AssignTo = $HRid $dataBasefdate $dataBasetodate";
        }
        $result1['HRSelectedCandidatesCount'] = $this->db->query($sql)->getResultArray();

        // print_r($data['HRSelectedCandidatesCount']);exit();
        return $result1['HRSelectedCandidatesCount'];
    }
    public function getHRrejectedCandidatesCount($HRid, $data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];

        // print_r($fdate);exit();
        if (isset($fdate) && !empty($fdate) && $fdate != "NA" && $fdate != 0) {
            $dataBasefdate = "AND DATE(Created_at) BETWEEN '$fdate'";
        } else {
            $dataBasefdate = "";
        }

        if (isset($todate) && !empty($todate) && $todate != "NA" && $todate != 0) {
            $dataBasetodate = "AND '$todate'";
        } else {
            $dataBasetodate = "";
        }

        if ($HRid == 'default') {

            $sql = "SELECT CandidateId as SelectedCount FROM `interview_process` LEFT JOIN candidates ON CandidateId = CandidateIDFK WHERE  InterviewStatus = 4 $dataBasefdate $dataBasetodate";
        } else {
            $sql = "SELECT CandidateId as SelectedCount FROM `interview_process` LEFT JOIN candidates ON CandidateId = CandidateIDFK WHERE  InterviewStatus = 4 AND candidates.AssignTo = $HRid $dataBasefdate $dataBasetodate";
        }
        $result1['HRrejectedCandidatesCount'] = $this->db->query($sql)->getResultArray();

        // print_r($data['HRrejectedCandidatesCount']);exit();
        return $result1['HRrejectedCandidatesCount'];
    }
    public function getHRJoinedCandidatesCount($HRid, $data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];

        // print_r($fdate);exit();
        if (isset($fdate) && !empty($fdate) && $fdate != "NA" && $fdate != 0) {
            $dataBasefdate = "AND DATE(JoiningDate) BETWEEN '$fdate'";
        } else {
            $dataBasefdate = "";
        }

        if (isset($todate) && !empty($todate) && $todate != "NA" && $todate != 0) {
            $dataBasetodate = "AND '$todate'";
        } else {
            $dataBasetodate = "";
        }

        if ($HRid == 'default') {
            $sql = "SELECT A.CandidateId as JoinedCount FROM `candidates` A LEFT JOIN offer_letter B ON B.CandidateIDFK = A.CandidateId WHERE B.JoiningStatus = 1 $dataBasefdate $dataBasetodate";
        } else {

            $sql = "SELECT A.CandidateId as JoinedCount FROM `candidates` A LEFT JOIN offer_letter B ON B.CandidateIDFK = A.CandidateId WHERE B.JoiningStatus = 1 AND A.AssignTo = $HRid $dataBasefdate $dataBasetodate";
        }
        $result1['HRJoinedCandidatesCount'] = $this->db->query($sql)->getResultArray();

        // print_r($data['HRJoinedCandidatesCount']);exit();
        return $result1['HRJoinedCandidatesCount'];
    }



    public function CandidateCountsM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];

        // if(($fdate == date('Y-m-d')) && ($todate == date('Y-m-d')) ){
        //     $interviewDate = "AND DATE(InterviewDate) < CURRENT_DATE() ";
        // }else if(($fdate != date('Y-m-d')) && ($todate == date('Y-m-d')) ){
        //     $tdate = date('Y-m-d',strtotime("-1 days")) ;
        //     $interviewDate = "AND DATE(InterviewDate) BETWEEN '$fdate' and '$tdate' ";
        // }else{
        //     // $todate = date('Y-m-d',strtotime("-1 days")) ;
        //     $interviewDate = "AND DATE(InterviewDate) BETWEEN '$fdate' and '$todate' ";
        // }


        // print_r($todate);exit();

        $sql1 = "SELECT COUNT(ScheduleStatus) as ScheduledCount FROM `candidates`  WHERE (ScheduleStatus = 1 OR ScheduleStatus = 10)  AND DATE(Created_at) BETWEEN '$fdate' and '$todate' ";
        $sql9 = "SELECT COUNT(CandidateName) as upcomingCount FROM `candidates` A WHERE DATE(A.InterviewDate) > CURRENT_DATE() AND ScheduleStatus = 1  AND DATE(Created_at) BETWEEN '$fdate' and '$todate'";
        $sql10 = "SELECT A.CandidateId as missedCount FROM candidates A  LEFT JOIN interview_process E ON E.CandidateIDFK = A.CandidateId WHERE  ScheduleStatus = 1 AND DATE(InterviewDate) < CURRENT_DATE() AND DATE(Created_at) BETWEEN '$fdate' and '$todate' GROUP BY CandidateId ";
        $sql11 = "SELECT A.CandidateId as todaysCount FROM candidates A  LEFT JOIN interview_process E ON E.CandidateIDFK = A.CandidateId WHERE DATE(InterviewDate) = CURRENT_DATE()  AND ScheduleStatus = 1  AND DATE(Created_at) BETWEEN '$fdate' and '$todate' GROUP BY CandidateId ";
        $sql15 = "SELECT COUNT(ScheduleStatus) as InterviewStatusCount FROM `candidates`  WHERE ScheduleStatus = 10  AND DATE(Created_at) BETWEEN '$fdate' and '$todate' ";

        $NOTscheduleStatus = '(ScheduleStatus = 2 OR ScheduleStatus = 4 OR ScheduleStatus =5 OR ScheduleStatus =6)';
        $sql2 = "SELECT COUNT(ScheduleStatus) as NotScheduledCount FROM `candidates`         WHERE $NOTscheduleStatus AND DATE(Created_at) BETWEEN '$fdate' and '$todate'  ";
        $sql16 = "SELECT COUNT(ScheduleStatus) as TodaysNotScheduledCount FROM `candidates`  WHERE $NOTscheduleStatus AND DATE(CallBackDateTime) = CURRENT_DATE() AND DATE(Created_at) BETWEEN '$fdate' and '$todate'  ";
        $sql17 = "SELECT COUNT(ScheduleStatus) as MissedNotScheduledCount FROM `candidates`  WHERE $NOTscheduleStatus AND DATE(CallBackDateTime) < CURRENT_DATE() AND DATE(Created_at) BETWEEN '$fdate' and '$todate'  ";
        $sql18 = "SELECT COUNT(ScheduleStatus) as UpcomingNotScheduledCount FROM `candidates`  WHERE $NOTscheduleStatus AND DATE(CallBackDateTime) > CURRENT_DATE() AND DATE(Created_at) BETWEEN '$fdate' and '$todate'  ";

        // print_r($sql2);exit();      


        $sql3 = "SELECT COUNT(ScheduleStatus) as JunkCount FROM `candidates`  WHERE (ScheduleStatus = 11 OR ScheduleStatus = 3 OR ScheduleStatus = 8 OR ScheduleStatus = 7) AND DATE(CallBackDateTime) BETWEEN '$fdate' and '$todate' ";

        $sql4 = "SELECT COUNT(InterviewStatus) as SelectedCount FROM `interview_process` LEFT JOIN candidates ON CandidateId = CandidateIDFK WHERE DATE(Created_at) BETWEEN '$fdate' and '$todate' AND InterviewStatus = 2";
        $sql5 = "SELECT COUNT(InterviewStatus) as HoldCount FROM `interview_process`  LEFT JOIN candidates ON CandidateId = CandidateIDFK WHERE DATE(Created_at) BETWEEN '$fdate' and '$todate' AND InterviewStatus = 3";
        $sql6 = "SELECT COUNT(InterviewStatus) as RejectCount FROM `interview_process`  LEFT JOIN candidates ON CandidateId = CandidateIDFK WHERE DATE(Created_at) BETWEEN '$fdate' and '$todate' AND InterviewStatus = 4";

        $sql7 = "SELECT COUNT(DVStatus) as OfferLetterCount FROM `candidates` A LEFT JOIN document_verification B ON B.CandidateIDFK = A.CandidateId WHERE DATE(Create_at) BETWEEN '$fdate' and '$todate' AND B.DVStatus = 2";
        $sql8 = "SELECT COUNT(CandidateConfirmation) as JoinedCount FROM `candidates` A LEFT JOIN offer_letter B ON B.CandidateIDFK = A.CandidateId WHERE DATE(B.JoiningDate) BETWEEN '$fdate' and '$todate' AND B.JoiningStatus = 1";


        $sql12 = "SELECT COUNT(ScheduleStatus) as FreshListCount FROM `candidates`  WHERE ScheduleStatus = 12 AND DATE(Created_at) BETWEEN '$fdate' and '$todate' ";
        $sql13 = "SELECT A.CandidateId as freshlist_todaysCount FROM candidates A  WHERE DATE(Created_at) = CURRENT_DATE()  AND ScheduleStatus = 12";

        // if(($fdate == date('Y-m-d')) && ($todate == date('Y-m-d')) ){
        //     $pendingData = "AND DATE(A.Created_at) < CURRENT_DATE() ";

        // }else if(($fdate != date('Y-m-d')) && ($todate == date('Y-m-d')) ){
        //     $tdate = date('Y-m-d',strtotime("-1 days")) ;
        //     $pendingData = "AND DATE(A.Created_at) BETWEEN '$fdate' and '$tdate' ";        
        // }else{
        //     // $tdate = date('Y-m-d',strtotime("-1 days")) ;
        //     $pendingData = "AND DATE(A.Created_at) BETWEEN '$fdate' and '$todate' ";
        // }
        // $sql14="SELECT A.CandidateId as freshlist_pendingCount FROM candidates A  WHERE AssignTo = '$HRid' AND DATE(Created_at) < CURRENT_DATE()  AND ScheduleStatus = 12";
        $sql14 = "SELECT A.CandidateId as freshlist_pendingCount FROM candidates A  WHERE ScheduleStatus = 12 AND DATE(A.Created_at) BETWEEN '$fdate' and '$todate'  ";


        $result1 = $this->db->query($sql1)->getResultArray();
        $result2 = $this->db->query($sql2)->getResultArray();
        $result3 = $this->db->query($sql3)->getResultArray();
        $result4 = $this->db->query($sql4)->getResultArray();
        $result5 = $this->db->query($sql5)->getResultArray();
        $result6 = $this->db->query($sql6)->getResultArray();
        $result7 = $this->db->query($sql7)->getResultArray();
        $result8 = $this->db->query($sql8)->getResultArray();
        $result9 = $this->db->query($sql9)->getResultArray();
        $result10 = $this->db->query($sql10)->getResultArray();
        $result11 = $this->db->query($sql11)->getResultArray();
        $result12 = $this->db->query($sql12)->getResultArray();
        $result13 = $this->db->query($sql13)->getResultArray();
        $result14 = $this->db->query($sql14)->getResultArray();
        $result15 = $this->db->query($sql15)->getResultArray();
        $result16 = $this->db->query($sql16)->getResultArray();
        $result17 = $this->db->query($sql17)->getResultArray();
        $result18 = $this->db->query($sql18)->getResultArray();

        // print_r($result2);exit();

        // $temp = $result1[0]['ScheduledCount'] + $result2[0]['NotScheduledCount'];
        $result['candiadtecounts'][0] = $result1;
        $result['candiadtecounts'][1] = $result2;
        $result['candiadtecounts'][2] = $result3;
        $result['candiadtecounts'][3] = $result4;
        $result['candiadtecounts'][4] = $result5;
        $result['candiadtecounts'][5] = $result6;
        $result['candiadtecounts'][6] = $result7;
        $result['candiadtecounts'][7] = $result8;
        $result['candiadtecounts'][8] = $result9;
        $result['candiadtecounts'][9] = count($result10);
        $result['candiadtecounts'][10] = count($result11);
        $result['candiadtecounts'][11] = $result12;
        $result['candiadtecounts'][12] = count($result13);
        $result['candiadtecounts'][13] = count($result14);
        $result['candiadtecounts'][14] = $result15;
        $result['candiadtecounts'][15] = $result16;
        $result['candiadtecounts'][16] = $result17;
        $result['candiadtecounts'][17] = $result18;
        // print_r($result['candiadtecounts'][14]);exit();

        return $result['candiadtecounts'];
    }

    public function insert_candidateM($data, $file)
    {
        $HR_IDFK = $data['HR_IDFK'];
        $CandidateName = $data['CandidateName'];
        $CandidateContactNo = $data['CandidateContactNo'];
        $CandidateEmail = $data['CandidateEmail'];
        $CandidatePassword = $data['CandidateContactNo'];
        $Source = $data['Source'];
        if ($data['scheduled'] == 2) {
            $scheduled = $data['NotScheduled'];
        } else {
            $scheduled = $data['scheduled'];
        }
        $created_at = date('Y-m-d H:i:s');
        //print_r($created_at);exit();
        $CallBackDateTime = $data['CallBackDateTime'];
        $InterviewDate = $data['InterviewDate'];
        $CandidatePosition = $data['CandidatePosition'];
        $CandidateReason = $data['CandidateReason'];
        $CandidateResume = $data['CandidateResume'];
        $hrquery = "SELECT EmployeeName FROM employees WHERE employeeId = $HR_IDFK ";
        $hrresult = $this->db->query($hrquery)->getResultArray();
        $hrName = $hrresult[0]['EmployeeName'];
        //print_r($data);exit();
        $query1 = "SELECT * FROM `notschedule_reasons` WHERE NS_IDPK = '$scheduled' ";
        $result1 = $this->db->query($query1)->getResultArray();
        $scheduledReason = $result1[0]['NS_Reasons'];
        $query = "SELECT * FROM candidates WHERE CandidateContactNo = '$CandidateContactNo' ";
        $result = $this->db->query($query)->getResultArray();

        // print_r($result[0]['AssignTo'], );exit();

        if (empty($result) || $result[0]['AssignTo'] != $HR_IDFK) {
            $sql = "INSERT INTO `candidates`(`UploadBy`,`AssignTo`,`CandidateName`, `CandidateContactNo`, `CandidateEmail`,`CandidatePassword`, `Source`,`CallBackDateTime`, `CandidatePosition`, `InterviewDate`,`CandidateReason`, `ScheduleStatus`,`Created_at`,`CandidateResume`) 
                    VALUES ('$HR_IDFK','$HR_IDFK','$CandidateName','$CandidateContactNo','$CandidateEmail','$CandidatePassword','$Source','$CallBackDateTime','$CandidatePosition','$InterviewDate','$CandidateReason','$scheduled','$created_at','$CandidateResume')";
            //   print_r($sql);exit();  
            $this->db->query($sql);
            $lastInsertedId = $this->db->insertID();

            $assigned_for = $this->db->query("SELECT AssignTo FROM `candidates` WHERE CandidateId = $lastInsertedId")->getRow()->AssignTo;

            if ($scheduled == 1) {
                $Status = 'Scheduled';
                $Remarks = $hrName . ' Scheduled an Interview';
                $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$lastInsertedId','$Status','$Remarks','$assigned_for','$HR_IDFK')";
                $this->db->query($query);
            } else {
                $Status = 'Not-Scheduled';
                $Remarks = $hrName . ' Not-Scheduled an Interview because of candidate ' . $scheduledReason;
                $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$lastInsertedId','$Status','$Remarks','$assigned_for','$HR_IDFK')";
                $this->db->query($query);
            }

            $canId = $lastInsertedId;
            $target_dir = "Uploads/candidates/$canId/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            if ($file->isValid() && !$file->hasMoved()) {
                $originalFileName = $file->getClientName();
                $filePath = $target_dir . $originalFileName;
                $fileName = $originalFileName;
                $pathInfo = pathinfo($originalFileName);
                $name = $pathInfo['filename'];
                $extension = isset($pathInfo['extension']) ? '.' . $pathInfo['extension'] : '';
                $counter = 1;
                while (file_exists($filePath)) {
                    $fileName = $name . '_' . $counter++ . $extension;
                    $filePath = $target_dir . $fileName;
                }
                $file->move($target_dir, $fileName);
            }


            return 1;
        } else {
            return $result;
        }
        // print_r($result);exit();
        // return $result;
    }

    public function Candidate_DetailsM($data)
    {
        $canId = $data['canId'];
        $sql = "SELECT * FROM candidates A
        LEFT JOIN designation B On B.IDPK = A.CandidatePosition
        LEFT JOIN candidate_source C ON C.SM_IDPK = A.Source
        LEFT JOIN notschedule_reasons D ON D.NS_IDPK = A.ScheduleStatus
        WHERE A.CandidateId = $canId";
        $data['candidate_details'] = $this->db->query($sql)->getResultArray(); //run the query
        return $data['candidate_details'];
    }

    public function edit_Candi_profileM($data)
    {
        $CandidateId = $data['CandidateId'];
        $CandidateName = $data['CandidateName'];
        $CandidateContactNo = $data['CandidateContactNo'];
        $CandidateEmail = $data['CandidateEmail'];
        $CandidateLocation = $data['CandidateLocation'];
        $CandidatePosition = $data['CandidatePosition'];
        $CandidateEducation = $data['CandidateEducation'];
        $CandidateExperience = $data['CandidateExperience'];
        $TotalExperience = $data['TotalExperience'];
        $LastCompany = $data['LastCompany'];
        $NoticePeroid = $data['NoticePeroid'];
        $CandidateCurrentCTC = $data['CandidateCurrentCTC'];
        $CandidateExpectedCTC = $data['CandidateExpectedCTC'];
        $ImmediateJoiner = $data['ImmediateJoiner'];
        $DaysRequired = $data['DaysRequired'];
        $CandidateResume = $data['CandidateResume'];

        $sql = "UPDATE `candidates` SET `CandidateName`='$CandidateName',`CandidateContactNo`= '$CandidateContactNo', `CandidateEmail` = '$CandidateEmail', `CandidateLocation`='$CandidateLocation', `CandidatePosition`='$CandidatePosition', `CandidateEducation`='$CandidateEducation', `CandidateExperience`='$CandidateExperience',`TotalExperience`='$TotalExperience', `LastCompany`='$LastCompany', `ImmediateJoiner`='$ImmediateJoiner',`DaysRequired` = '$DaysRequired', `NoticePeroid`='$NoticePeroid',`CandidateCurrentCTC`='$CandidateCurrentCTC' , `CandidateExpectedCTC`='$CandidateExpectedCTC' , `CandidateResume`='$CandidateResume' WHERE CandidateId= $CandidateId ";

        $this->db->query($sql); //run the query
    }
    public function update_candidate_arrivedM($data)
    {
        $CandidateId = $data['CandidateId'];
        $CandidateLocation = $data['CandidateLocation'];
        $CandidateEducation = $data['CandidateEducation'];
        $CandidateExperience = $data['CandidateExperience'];
        $TotalExperience = $data['TotalExperience'];
        $LastCompany = $data['LastCompany'];
        $NoticePeroid = $data['NoticePeroid'];
        $CandidateCurrentCTC = $data['CandidateCurrentCTC'];
        $CandidateExpectedCTC = $data['CandidateExpectedCTC'];
        $ImmediateJoiner = $data['ImmediateJoiner'];
        $DaysRequired = $data['DaysRequired'];
        $CandidateResume = $data['CandidateResume'];
        $InterviewDate = $data['InterviewDate'];

        $scheduled = $data['scheduled'];
        $HR_IDFK = session()->get('EmpIDFK');

        $sql = "UPDATE `candidates` SET `CandidateLocation`='$CandidateLocation', `CandidateEducation`='$CandidateEducation', `CandidateExperience`='$CandidateExperience',`TotalExperience`='$TotalExperience', `LastCompany`='$LastCompany', `ImmediateJoiner`='$ImmediateJoiner',`DaysRequired` = '$DaysRequired', `NoticePeroid`='$NoticePeroid',`CandidateCurrentCTC`='$CandidateCurrentCTC' , `CandidateExpectedCTC`='$CandidateExpectedCTC' , `CandidateResume`='$CandidateResume', `InterviewDate`='$InterviewDate',`ScheduleStatus`='$scheduled' WHERE CandidateId= $CandidateId ";
        // print_r($sql);exit();
        $assigned_for = $this->db->query("SELECT AssignTo FROM `candidates` WHERE CandidateId = $CandidateId")->getRow()->AssignTo;
        if ($scheduled == 10) {
            $datetime = date("Y-m-d H:i:s");
            $Status = 'Arrived';
            $Remarks = 'Candidate Arrived to Interview ';
            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateId','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        }

        $this->db->query($sql); //run the query
    }
    public function update_candidate_rescheduleM($data)
    {
        $CandidateId = $data['CandidateId'];
        //    $CandidateResume = $data['CandidateResume'];
        $InterviewDate = $data['InterviewDate'];
        $scheduled = $data['scheduled'];
        //    print_r($InterviewDate);exit();

        $sql = "UPDATE `candidates` SET  `InterviewDate`='$InterviewDate',`ScheduleStatus`='$scheduled' WHERE CandidateId= $CandidateId ";
        $this->db->query($sql); //run the query

        $assigned_for = $this->db->query("SELECT AssignTo FROM `candidates` WHERE CandidateId = $CandidateId")->getRow()->AssignTo;

        $HR_IDFK = session()->get('EmpIDFK');

        if ($scheduled == 1) {
            $Status = 'Re-Scheduled';
            $Remarks = 'HR Re-Scheduled an Interview on ' . $InterviewDate;

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`, `HR_IDFK`,`Updated_by`) VALUES('$CandidateId','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        }
    }
    public function update_candidate_cancelM($data)
    {
        $CandidateId = $data['CandidateId'];
        //    $CandidateResume = $data['CandidateResume'];
        $scheduled = $data['scheduled'];
        $CallBackDateTime = $data['CallBackDateTime'];
        //    print_r($scheduled);exit();
        $query1 = "SELECT * FROM `notschedule_reasons` WHERE NS_IDPK = '$scheduled' ";
        $result1 = $this->db->query($query1)->getResultArray();
        $scheduledReason = $result1[0]['NS_Reasons'];
        //   print_r($scheduledReason);exit();
        $sql = "UPDATE `candidates` SET `ScheduleStatus`='$scheduled', `CallBackDateTime`='$CallBackDateTime' WHERE CandidateId= $CandidateId ";
        $assigned_for = $this->db->query("SELECT AssignTo FROM `candidates` WHERE CandidateId = $CandidateId")->getRow()->AssignTo;
        $HR_IDFK = session()->get('EmpIDFK');
        if ($scheduled >= 2) {
            $Status = 'Cancelled';
            $Remarks = 'HR Cancelled an Interview because of candidate ' . $scheduledReason;
            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateId','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        }
        $this->db->query($sql); //run the query
    }

    // public function select_interviewerM(){
    //     $sql = "SELECT EmployeeName, EmployeeId FROM employees A WHERE Status='Working' AND NOT EXISTS (SELECT * FROM interviewer_list B
    //     WHERE  B.InterviewerIDFK = A.EmployeeId) ORDER BY EmployeeName ASC";
    //     $data['select_interviewer'] = $this->db->query($sql)->getResultArray(); //run the query
    //     return $data['select_interviewer'];
    // }

    // public function store_interviewerM($data){
    //     $InterviewerIDFK = $data['InterviewerIDFK'];
    //     $sql="INSERT INTO interviewer_list(InterviewerIDFK) VALUES($InterviewerIDFK)";
    //     $this->db->query($sql);
    // }
    // public function interviewer_listM(){
    //     $sql = "SELECT B.EmployeeId, B.EmployeeName, B.EmployeeCode From interviewer_list A LEFT JOIN employees B ON B.EmployeeID = A.InterviewerIDFK ";
    //     $data['interviewerList'] = $this->db->query($sql)->getResultArray();
    //     return $data['interviewerList'];
    // }
    // public function delete_interviewerM($id){
    //     $sql = "DELETE FROM interviewer_list WHERE InterviewerIDFK = '$id' ";
    //     $this->db->query($sql);
    // }
    // public function getInterviewerListM($data){
    //     $CandidateIDFK = $data['canId'];
    //     // print_r($CandidateIDFK);exit();
    //     $sql = "SELECT C.EmployeeId, C.EmployeeName FROM interviewer_list A LEFT JOIN employees C ON C.EmployeeId = A.InterviewerIDFK
    //             WHERE C.Status='Working' AND NOT EXISTS (SELECT * FROM interview_process B WHERE B.CandidateIDFK = '$CandidateIDFK' AND B.InterviewerIDFK = C.EmployeeId)";

    //     $data['getInterviewerList'] = $this->db->query($sql)->getResultArray();

    //     return $data['getInterviewerList'];        

    // }

    public function getReportingManager()
    {
        $sql = "SELECT EmployeeId, EmployeeName FROM interviewer_list A LEFT JOIN employees B ON B.EmployeeId = A.InterviewerIDFK";
        $data['reportManager'] = $this->db->query($sql)->getResultArray();

        // print_r($data['reportManager']);exit();
        return $data['reportManager'];
    }

    public function update_interview_processM($data)
    {

        $CandidateId = $data['CandidateId'];
        $InterviewerIDFK = $data['InterviewerIDFK'];
        $RoundID = $data['RoundID'];
        $Communication = $data['Communication'];
        $Attitude = $data['Attitude'];
        $Discipline = $data['Discipline'];
        $DressCode = $data['DressCode'];
        $Knowledge = $data['Knowledge'];
        $OverAllRating = $data['OverAllRating'];
        $InterviewRemarks = $data['InterviewRemarks'];
        $InterviewStatus = $data['InterviewStatus'];
        // $DaysRequired = $data['DaysRequired'];
        $InterviewDate = $data['InterviewDate'];
        // print_r($InterviewStatus);exit();    
        
        if($data['Holdaction'] == 1){
            $delsql = "DELETE FROM `interview_process` WHERE IP_IDPK = (SELECT MAX(IP_IDPK) FROM `interview_process` WHERE CandidateIDFK = $CandidateId)";
            $this->db->query($delsql);
        }

        $query1 = "SELECT * FROM `employees` WHERE EmployeeId = '$InterviewerIDFK' ";
        $result1 = $this->db->query($query1)->getResultArray();
        $InterviewerName = $result1[0]['EmployeeName'];
        //   print_r($InterviewerName);exit(); 

        if ($InterviewStatus == 2 || $InterviewStatus == 3 || $InterviewStatus == 4) {
            $sql1 = "UPDATE `candidates` SET `ScheduleStatus`= 0  WHERE CandidateId= $CandidateId  ";
            $this->db->query($sql1);
        }
        $assigned_for = $this->db->query("SELECT AssignTo FROM `candidates` WHERE CandidateId = $CandidateId")->getRow()->AssignTo;
        $sql = "INSERT INTO `interview_process`( `CandidateIDFK`,`InterviewerIDFK`, `RoundID`, `Communication`, `Attitude`, `Discipline`, `DressCode`, `Knowledge`, `OverAllRating`, `InterviewRemarks`, `InterviewStatus`) VALUES ('$CandidateId','$InterviewerIDFK','$RoundID','$Communication','$Attitude','$Discipline','$DressCode','$Knowledge','$OverAllRating','$InterviewRemarks','$InterviewStatus')";
        // print_r($sql);exit();

        $HR_IDFK = session()->get('EmpIDFK');
        if (!empty($RoundID) && ($InterviewStatus == 1)) {
            $Status = 'Round' . $RoundID;
            $Remarks = 'Passed to next round by ' . $InterviewerName;
            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateId','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        } elseif (!empty($RoundID) && ($InterviewStatus == 2)) {
            $Status = 'Round' . $RoundID;
            $Remarks = 'Candidate is Selected  by ' . $InterviewerName;

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateId','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        } elseif (!empty($RoundID) && ($InterviewStatus == 3)) {
            $Status = 'Round' . $RoundID;
            $Remarks = 'Candidate is on Hold by ' . $InterviewerName;

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateId','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        } elseif (!empty($RoundID) && ($InterviewStatus == 4)) {
            $Status = 'Round' . $RoundID;
            $Remarks = 'Candidate is Rejected by ' . $InterviewerName;

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateId','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        }

        if (!empty($InterviewDate)) {
            $updatequery = "Update `candidates` set `InterviewDate` = '$InterviewDate' where `CandidateId` = '$CandidateId' ";
            // print_r($updatequery);exit();
            $this->db->query($updatequery);
        }


        // print($sql);exit();
        $this->db->query($sql);
    }

    public function round_listM($data)
    {
        $canId = $data['canId'];

        $sql = "SELECT * FROM interview_process WHERE CandidateIDFK = '$canId' ORDER BY `IP_IDPK` DESC";

        $data['roundList'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['roundList']); exit();
        return $data['roundList'];
    }

    public function Max_round($data)
    {
        $canId = $data['canId'];

        $sql = "SELECT MAX(RoundID) FROM interview_process WHERE CandidateIDFK = '$canId' ORDER BY `IP_IDPK` DESC";

        $data['roundList'] = $this->db->query($sql)->getRowArray(); //run the query
        // print_r($data['roundList']['MAX(RoundID)']); exit();
        return $data['roundList']['MAX(RoundID)'] ?? 0;
    }

    public function roundDetailsM($data)
    {
        $canId = $data['canId'];

        $sql = "SELECT B.EmployeeName as InterviewerName, B.EmployeeId as InterviewerId, A.RoundID, A.Communication,A.Attitude, A.Discipline, A.DressCode, A.Knowledge, A.OverAllRating, A.InterviewRemarks, A.InterviewStatus   FROM interview_process A
                LEFT JOIN employees B ON B.EmployeeId = A.InterviewerIDFK 
                WHERE A.CandidateIDFK = '$canId' ";

        $data['roundDetails'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['roundDetails']); exit();
        return $data['roundDetails'];
    }

    public function send_documentVerification_mailM($data)
    {
        $CandidateId = $data['CandidateId'];
        $CandidateEmail = $data['CandidateEmail'];
        $docmailSubject = $data['docmailSubject'];
        $docmailBody = $data['docmailBody'];

        $sql = "INSERT INTO `document_mail_verification` (`CandidateIDFK`, `CandidateEmail`, `DMV_Subject`, `DMV_Body`) VALUES (?, ?, ?, ?)";
        $res = $this->db->query($sql, [$CandidateId, $CandidateEmail, $docmailSubject, $docmailBody]);

        $Status = 'Documents';
        $Remarks = 'Documents Verification Mail has been sent';
        $HR_IDFK = session()->get('EmpIDFK');
        $assigned_for = $this->db->query("SELECT AssignTo FROM `candidates` WHERE CandidateId = $CandidateId")->getRow()->AssignTo;
        $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) 
                  VALUES('$CandidateId','$Status','$Remarks','$assigned_for','$HR_IDFK')";
        $this->db->query($query);
    }

    public function document_mail_verification($data)
    {
        $CandidateId = $data['canId'];
        $sql = "SELECT CandidateIDFK FROM `document_mail_verification` WHERE CandidateIDFK = $CandidateId";
        $count = $this->db->query($sql)->getResultArray();
        $count = count($count) ?? 0;
        // print_r($count);exit(0);
        return $count;
    }

    public function insert_freshers_documentsM($data)
    {
        $CandidateIDFK = $data['CandidateId'];
        $SSLCMarksCard = $data['SSLCMarksCard'];
        $PUCMarksCard = $data['PUCMarksCard'];
        $DegreeMarksCard = $data['DegreeMarksCard'];
        $AadharCard = $data['AadharCard'];
        $PanCard = $data['PanCard'];
        // $ExperienceLetter = $data['ExperienceLetter'];
        // $PaySlip = $data['PaySlip'];
        // $BankStatement = $data['BankStatement'];
        // $OtherDocument = $data['OtherDocument'];
        // $EmployerConformation = $data['EmployerConformation'];
        $DVStatus = $data['DVStatus'];
        $DVRemarks = $data['DVRemarks'];


        $select = "SELECT * FROM document_verification where CandidateIDFK = $CandidateIDFK";
        $run_query = $this->db->query($select)->getResultArray();

        // print_r($run_query);exit();

        if (empty($run_query)) {
            $sql = "INSERT INTO `document_verification`( `CandidateIDFK`, `SSLCMarksCard`, `PUCMarksCard`, `DegreeMarksCard`, `AadharCard`, `PanCard`,`DVStatus`,`DVRemarks`) VALUES ('$CandidateIDFK','$SSLCMarksCard','$PUCMarksCard','$DegreeMarksCard','$AadharCard','$PanCard','$DVStatus','$DVRemarks')";
        } else {
            $sql = "UPDATE `document_verification` SET `SSLCMarksCard`='$SSLCMarksCard',`PUCMarksCard`='$PUCMarksCard',`DegreeMarksCard`='$DegreeMarksCard',`AadharCard`='$AadharCard',`PanCard`='$PanCard',`DVStatus`='$DVStatus',`DVRemarks`='$DVRemarks' WHERE CandidateIDFK = '$CandidateIDFK'";
        }
        $assigned_for = $this->db->query("SELECT AssignTo FROM `candidates` WHERE CandidateId = $CandidateIDFK")->getRow()->AssignTo;
        $HR_IDFK = session()->get('EmpIDFK');
        // print_r($sql);exit();
        if ($DVStatus == 1) {
            $Status = 'Documents';
            $Remarks = 'Documents Verification Rejected because of ' . $DVRemarks;
            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateIDFK','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        } elseif ($DVStatus == 2) {
            $Status = 'Documents';
            $Remarks = 'Documents are verified and Approved ';
            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateIDFK','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        }

        $this->db->query($sql);
    }
    public function insert_experience_documentsM($data)
    {

        $CandidateIDFK = $data['CandidateId'];
        $SSLCMarksCard = $data['SSLCMarksCard'];
        $PUCMarksCard = $data['PUCMarksCard'];
        $DegreeMarksCard = $data['DegreeMarksCard'];
        $AadharCard = $data['AadharCard'];
        $PanCard = $data['PanCard'];
        $ExperienceLetter = $data['ExperienceLetter'];
        $PaySlip = $data['PaySlip'];
        $BankStatement = $data['BankStatement'];
        $OtherDocument = $data['OtherDocument'];
        $EmployerConformation = $data['EmployerConformation'];
        $DVStatus = $data['DVStatus'];
        $DVRemarks = $data['DVRemarks'];


        $select = "SELECT * FROM document_verification where CandidateIDFK = $CandidateIDFK";
        $run_query = $this->db->query($select)->getResultArray();

        // print_r($run_query);exit();

        if (empty($run_query)) {
            $sql = "INSERT INTO `document_verification`( `CandidateIDFK`, `SSLCMarksCard`, `PUCMarksCard`, `DegreeMarksCard`, `AadharCard`, `PanCard`, `ExperienceLetter`, `PaySlip`,`BankStatement`,`OtherDocument`,`EmployerConfirmation`,`DVStatus`,`DVRemarks`) VALUES ('$CandidateIDFK','$SSLCMarksCard','$PUCMarksCard','$DegreeMarksCard','$AadharCard','$PanCard','$ExperienceLetter','$PaySlip','$BankStatement','$OtherDocument','$EmployerConformation','$DVStatus','$DVRemarks')";
        } else {
            $sql = "UPDATE `document_verification` SET `SSLCMarksCard`='$SSLCMarksCard',`PUCMarksCard`='$PUCMarksCard',`DegreeMarksCard`='$DegreeMarksCard',`AadharCard`='$AadharCard',`PanCard`='$PanCard',`ExperienceLetter`='$ExperienceLetter',`PaySlip`='$PaySlip',`BankStatement`='$BankStatement',`OtherDocument`='$OtherDocument',`EmployerConfirmation`='$EmployerConformation',`DVStatus`='$DVStatus',`DVRemarks`='$DVRemarks' WHERE CandidateIDFK = '$CandidateIDFK'";
        }
        $HR_IDFK = session()->get('EmpIDFK');
        $assigned_for = $this->db->query("SELECT AssignTo FROM `candidates` WHERE CandidateId = $CandidateIDFK")->getRow()->AssignTo;
        // print_r($sql);exit();
        if ($DVStatus == 1) {
            $Status = 'Documents';
            $Remarks = 'Documents Verification Rejected because of ' . $DVRemarks;

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateIDFK','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        } elseif ($DVStatus == 2) {
            $Status = 'Documents';
            $Remarks = 'Documents are verified and Approved ';

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateIDFK','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        }

        $this->db->query($sql);
    }


    // public function insert_documentM($data){

    //     $CandidateIDFK = $data['CandidateId'];
    //     $SSLCMarksCard = $data['SSLCMarksCard'];
    //     $PUCMarksCard = $data['PUCMarksCard'];
    //     $DegreeMarksCard = $data['DegreeMarksCard'];
    //     $AadharCard = $data['AadharCard'];
    //     $PanCard = $data['PanCard'];
    //     $ExperienceLetter = $data['ExperienceLetter'];
    //     $PaySlip = $data['PaySlip'];
    //     $BankStatement = $data['BankStatement'];
    //     $OtherDocument = $data['OtherDocument'];
    //     $EmployerConformation = $data['EmployerConformation'];
    //     $DVStatus = $data['DVStatus'];
    //     $DVRemarks = $data['DVRemarks'];


    //     $select="SELECT * FROM document_verification where CandidateIDFK = $CandidateIDFK";
    //     $run_query= $this->db->query($select)->getResultArray();

    //     // print_r($run_query);exit();

    //     if(empty($run_query)){
    //         $sql="INSERT INTO `document_verification`( `CandidateIDFK`, `SSLCMarksCard`, `PUCMarksCard`, `DegreeMarksCard`, `AadharCard`, `PanCard`, `ExperienceLetter`, `PaySlip`,`BankStatement`,`OtherDocument`,`EmployerConfirmation`,`DVStatus`,`DVRemarks`) VALUES ('$CandidateIDFK','$SSLCMarksCard','$PUCMarksCard','$DegreeMarksCard','$AadharCard','$PanCard','$ExperienceLetter','$PaySlip','$BankStatement','$OtherDocument','$EmployerConformation','$DVStatus','$DVRemarks')";
    //     }else{
    //         $sql= "UPDATE `document_verification` SET `SSLCMarksCard`='$SSLCMarksCard',`PUCMarksCard`='$PUCMarksCard',`DegreeMarksCard`='$DegreeMarksCard',`AadharCard`='$AadharCard',`PanCard`='$PanCard',`ExperienceLetter`='$ExperienceLetter',`PaySlip`='$PaySlip',`BankStatement`='$BankStatement',`OtherDocument`='$OtherDocument',`EmployerConfirmation`='$EmployerConformation',`DVStatus`='$DVStatus',`DVRemarks`='$DVRemarks' WHERE CandidateIDFK = '$CandidateIDFK'" ;
    //     }

    //     // print_r($sql);exit();

    //     $this->db->query($sql);

    // }

    public function fresher_update_documentM($data)
    {

        $CandidateIDFK = $data['CandidateId'];
        $SSLCMarksCard = $data['SSLCMarksCard'];
        $PUCMarksCard = $data['PUCMarksCard'];
        $DegreeMarksCard = $data['DegreeMarksCard'];
        $AadharCard = $data['AadharCard'];
        $PanCard = $data['PanCard'];
        // $ExperienceLetter = $data['ExperienceLetter'];
        // $PaySlip = $data['PaySlip'];
        // $BankStatement = $data['BankStatement'];
        $OtherDocument = $data['OtherDocument'];
        $OfferLetterImage = $data['OfferLetterImage'];
        $INT_CON_Letter = $data['INT_CON_Letter'];
        // $EmployerConformation = $data['EmployerConformation'];
        $DVStatus = $data['DVStatus'];
        $DVRemarks = $data['DVRemarks'];


        $select = "SELECT * FROM document_verification where CandidateIDFK = $CandidateIDFK";
        $run_query = $this->db->query($select)->getResultArray();

        // print_r($run_query);exit();

        if (empty($run_query)) {
            $sql = "INSERT INTO `document_verification`( `CandidateIDFK`, `SSLCMarksCard`, `PUCMarksCard`, `DegreeMarksCard`, `AadharCard`, `PanCard`, `OtherDocument`,`OfferLetterImage`,'INT_CON_Letter',`DVStatus`,`DVRemarks`) VALUES ('$CandidateIDFK','$SSLCMarksCard','$PUCMarksCard','$DegreeMarksCard','$AadharCard','$PanCard','$OtherDocument','$OfferLetterImage','$INT_CON_Letter','$DVStatus','$DVRemarks')";
        } else {
            $sql = "UPDATE `document_verification` SET `SSLCMarksCard`='$SSLCMarksCard',`PUCMarksCard`='$PUCMarksCard',`DegreeMarksCard`='$DegreeMarksCard',`AadharCard`='$AadharCard',`PanCard`='$PanCard',`OtherDocument`='$OtherDocument',`OfferLetterImage`='$OfferLetterImage',`INT_CON_Letter`='$INT_CON_Letter',`DVStatus`='$DVStatus',`DVRemarks`='$DVRemarks' WHERE CandidateIDFK = '$CandidateIDFK'";
        }

        // print_r($sql);exit();

        $this->db->query($sql);
    }

    public function update_documentM($data)
    {

        $CandidateIDFK = $data['CandidateId'];
        $SSLCMarksCard = $data['SSLCMarksCard'];
        $PUCMarksCard = $data['PUCMarksCard'];
        $DegreeMarksCard = $data['DegreeMarksCard'];
        $AadharCard = $data['AadharCard'];
        $PanCard = $data['PanCard'];
        $ExperienceLetter = $data['ExperienceLetter'];
        $PaySlip = $data['PaySlip'];
        $BankStatement = $data['BankStatement'];
        $OtherDocument = $data['OtherDocument'];
        $OfferLetterImage = $data['OfferLetterImage'];
        $INT_CON_Letter = $data['INT_CON_Letter'];
        $EmployerConformation = $data['EmployerConformation'];
        $DVStatus = $data['DVStatus'];
        $DVRemarks = $data['DVRemarks'];


        $select = "SELECT * FROM document_verification where CandidateIDFK = $CandidateIDFK";
        $run_query = $this->db->query($select)->getResultArray();

        // print_r($run_query);exit();

        if (empty($run_query)) {
            $sql = "INSERT INTO `document_verification`( `CandidateIDFK`, `SSLCMarksCard`, `PUCMarksCard`, `DegreeMarksCard`, `AadharCard`, `PanCard`, `ExperienceLetter`, `PaySlip`,`BankStatement`,`OtherDocument`,`OfferLetterImage`,'INT_CON_Letter',`EmployerConfirmation`,`DVStatus`,`DVRemarks`) VALUES ('$CandidateIDFK','$SSLCMarksCard','$PUCMarksCard','$DegreeMarksCard','$AadharCard','$PanCard','$ExperienceLetter','$PaySlip','$BankStatement','$OtherDocument','$OfferLetterImage','$INT_CON_Letter','$EmployerConformation','$DVStatus','$DVRemarks')";
        } else {
            $sql = "UPDATE `document_verification` SET `SSLCMarksCard`='$SSLCMarksCard',`PUCMarksCard`='$PUCMarksCard',`DegreeMarksCard`='$DegreeMarksCard',`AadharCard`='$AadharCard',`PanCard`='$PanCard',`ExperienceLetter`='$ExperienceLetter',`PaySlip`='$PaySlip',`BankStatement`='$BankStatement',`OtherDocument`='$OtherDocument',`OfferLetterImage`='$OfferLetterImage',`INT_CON_Letter`='$INT_CON_Letter',`EmployerConfirmation`='$EmployerConformation',`DVStatus`='$DVStatus',`DVRemarks`='$DVRemarks' WHERE CandidateIDFK = '$CandidateIDFK'";
        }

        // print_r($sql);exit();

        $this->db->query($sql);
    }

    public function getDocM($data)
    {

        // $empId = $data['id'];

        if (empty($data['canId'])) {
            $canId = '';
        } else {
            $canId = $data['canId'];
        }
        if (empty($data['id'])) {
            $empId = '';
        } else {
            $empId = $data['id'];
        }

        // print_r($canId);exit();
        $sql = "SELECT * FROM `document_verification` A LEFT JOIN candidates B ON B.CandidateId = A.CandidateIDFK  WHERE (A.CandidateIDFK = '$canId') OR (B.EmployeeIDFK = '$empId') ";

        $data['documents'] = $this->db->query($sql)->getResultArray();

        // print_r($data['documents']);exit();
        return $data['documents'];
    }

    public function insert_offer_letterM($data)
    {
        $CandidateIDFK = $data['CandidateIDFK'];
        $DepartmentIDFK = $data['DepartmentIDFK'];
        $DesignationIDFK = $data['DesignationIDFK'];
        $ReportManagerIDFK = $data['ReportManagerIDFK'];
        $TakeOmSalary = $data['TakeOmSalary'];
        $JoiningDate = $data['JoiningDate'];
        $OL_OfferMsg = $data['OL_OfferMsg'];
        $OL_Status = 1;

        $select = "SELECT * FROM offer_letter where CandidateIDFK = $CandidateIDFK";
        $run_query = $this->db->query($select)->getResultArray();

        $HR_IDFK = session()->get('EmpIDFK');
        $assigned_for = $this->db->query("SELECT AssignTo FROM `candidates` WHERE CandidateId = $CandidateIDFK")->getRow()->AssignTo;
        if (empty($run_query)) {
            // $sql = "INSERT INTO `offer_letter`( `CandidateIDFK`, `DepartmentIDFK`, `DesignationIDFK`, `ReportManagerIDFK`, `TakeOmSalary`, `JoiningDate`, `OL_OfferMsg`,`OL_Status`) 
            //         VALUES ('$CandidateIDFK','$DepartmentIDFK','$DesignationIDFK','$ReportManagerIDFK','$TakeOmSalary','$JoiningDate','$OL_OfferMsg','$OL_Status')";
            $sql = "INSERT INTO `offer_letter`( `CandidateIDFK`, `DepartmentIDFK`, `DesignationIDFK`, `ReportManagerIDFK`, `TakeOmSalary`, `JoiningDate`, `OL_OfferMsg`,`OL_Status`) 
                    VALUES (?,?,?,?,?,?,?,?)";
            $res = $this->db->query($sql, [$CandidateIDFK, $DepartmentIDFK, $DesignationIDFK, $ReportManagerIDFK, $TakeOmSalary, $JoiningDate, $OL_OfferMsg, $OL_Status]);
        } else {
            $sql = "UPDATE `offer_letter` SET `CandidateIDFK`=?,`DepartmentIDFK`=?,`DesignationIDFK`= ?,`ReportManagerIDFK`=?,`TakeOmSalary`=?,`JoiningDate`=?,`OL_OfferMsg`=?  WHERE CandidateIDFK = '$CandidateIDFK'";
            $res = $this->db->query($sql, [$CandidateIDFK, $DepartmentIDFK, $DesignationIDFK, $ReportManagerIDFK, $TakeOmSalary, $JoiningDate, $OL_OfferMsg]);
        }

        if ($OL_Status == 1) {
            $Status = 'Offer Letter ';
            $Remarks = 'Sent Offer letter to Candidate ';
            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateIDFK','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        }
    }

    public function getOfferLetterM($data)
    {
        $CandidateID = $data['canId'];
        // print_r($CandidateID);exit();

        $sql = "SELECT A.CandidateIDFK, C.CandidateName, B.EmployeeName as ReportingManageName, A.DepartmentIDFK, D.designations , A.TakeOmSalary,A.OL_OfferMsg, DATE(A.JoiningDate) as JoiningDate,A.CandidateConfirmation,A.JoiningStatus, A.WorkingStatus ,A.OL_Status FROM `offer_letter` A
        LEFT JOIN employees B ON B.EmployeeID = A.ReportManagerIDFK
        LEFT JOIN Candidates C ON C.CandidateID = A.CandidateIDFK
        LEFT JOIN designation D ON D.IDPK = A.DesignationIDFK
        WHERE `CandidateIDFK` = '$CandidateID' ";
        $data['offerLetter'] = $this->db->query($sql)->getResultArray();

        // print_r($data['offerLetter']);exit();
        return $data['offerLetter'];
    }

    public function update_confirmationM($data)
    {
        $CandidateID = $data['CandidateIDFK'];
        $CandidateConfirmation = $data['CandidateConfirmation'];

        $sql = "UPDATE `offer_letter` SET `CandidateConfirmation`='$CandidateConfirmation'  WHERE CandidateIDFK = '$CandidateID' ";
        // print_r($sql);exit();
        $HR_IDFK = session()->get('EmpIDFK');
        $assigned_for = $this->db->query("SELECT AssignTo FROM `candidates` WHERE CandidateId = $CandidateID")->getRow()->AssignTo;
        if ($CandidateConfirmation == 1) {
            $Status = 'Candidate Confirmation ';
            $Remarks = 'Candidate has Comfirmed to Join ';

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateID','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        } elseif ($CandidateConfirmation == 2) {
            $Status = 'Candidate Confirmation ';
            $Remarks = 'Candidate has Not-Comfirmed to Join ';

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateID','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        }
        $this->db->query($sql);
    }

    public function update_JoinStatusM($data)
    {
        $CandidateID = $data['CandidateIDFK'];
        $JoiningStatus = $data['JoiningStatus'];


        if ($JoiningStatus == 1) {
            $sql2 = "SELECT * FROM interview_process WHERE CandidateIDFK = '$CandidateID' ORDER BY `IP_IDPK` DESC";
            $data['roundList'] = $this->db->query($sql2)->getResultArray(); //run the query

            $changeInterviewStatus = $data['roundList'][0]['IP_IDPK'];

            $sql1 = "UPDATE `interview_process` SET `InterviewStatus`= 0  WHERE IP_IDPK= $changeInterviewStatus  ";
            $this->db->query($sql1);
        }
        // print_r($sql1); exit();

        $sql = "UPDATE `offer_letter` SET `JoiningStatus`='$JoiningStatus'  WHERE CandidateIDFK = '$CandidateID' ";
        // print_r($sql);exit();
        $HR_IDFK = session()->get('EmpIDFK');
        $assigned_for = $this->db->query("SELECT AssignTo FROM `candidates` WHERE CandidateId = $CandidateID")->getRow()->AssignTo;
        if ($JoiningStatus == 1) {
            $Status = 'Joined ';
            $Remarks = 'Candidate has Joined ';

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateID','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        } elseif ($JoiningStatus == 2) {
            $Status = 'Not-Joined ';
            $Remarks = 'Candidate has Not-Joined ';

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateID','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        }
        $this->db->query($sql);
    }

    public function update_WorkingStatusM($data)
    {
        $CandidateID = $data['CandidateIDFK'];
        $WorkingStatus = $data['WorkingStatus'];
        $EmployementType = $data['EmployementType'];

        if ($WorkingStatus == 1) {

            if ($EmployementType == 1) {
                $EmpType = "SELECT EmployeeCode, EmployementType FROM employees WHERE EmployementType = '$EmployementType' ORDER BY EmployeeCode DESC";
                $data['EmpType'] = $this->db->query($EmpType)->getResultArray();

                $lastId = $data['EmpType'][0]['EmployeeCode'];
                $LastID  = $lastId + 1;
                // print_r($LastID);exit();
            } else {
                $EmpType = "SELECT EmployeeCode, EmployementType FROM employees WHERE EmployementType = '$EmployementType' ORDER BY EmployeeCode DESC";
                $data['EmpType'] = $this->db->query($EmpType)->getResultArray();

                $lastId = $data['EmpType'][0]['EmployeeCode'];

                $id = substr($lastId, 7);
                $code = substr($lastId, 0, 7);
                $empCode = sprintf("%02d", $id + 1);
                $LastID  = $code . $empCode;
                // print_r($LastID);exit();
            }




            $select = "SELECT A.CandidateName, A.CandidateContactNo, A.CandidateEmail, A.CandidatePosition,B.JoiningDate  FROM candidates A LEFT JOIN offer_letter B ON CandidateIDFK= A.CandidateId WHERE CandidateId = '$CandidateID' ";
            $data['selectopush'] = $this->db->query($select)->getResultArray();

            $CandidateName = $data['selectopush'][0]['CandidateName'];
            $CandidateContactNo = $data['selectopush'][0]['CandidateContactNo'];
            $CandidateEmail = $data['selectopush'][0]['CandidateEmail'];
            $CandidatePosition = $data['selectopush'][0]['CandidatePosition'];
            $JoiningDate = $data['selectopush'][0]['JoiningDate'];

            $sql1 = "INSERT INTO employees (`EmployeeCode`,`EmployeeName`,`ContactNo`,`Email`,`DesignationIDFK`,`EmployementType`,`Status`,`DOJ`) VALUES('$LastID','$CandidateName', '$CandidateContactNo', '$CandidateEmail', '$CandidatePosition','$EmployementType','Working','$JoiningDate')";

            // print_r($sql1);exit();
            $this->db->query($sql1);
            $lastInsertedId = $this->db->insertID();
            // print_r($lastInsertedId);exit();

            $sql2 = "UPDATE `candidates` SET `EmployeeIDFK` = '$lastInsertedId' WHERE CandidateId = '$CandidateID' ";


            $this->db->query($sql2);

            // $sql3="UPDATE `candidates` SET `EmployeeIDFK` = '$lastInsertedId' WHERE CandidateId = '$CandidateID' ";
            // $this->db->query($sql3);




        }


        $HR_IDFK = session()->get('EmpIDFK');
        $assigned_for = $this->db->query("SELECT AssignTo FROM `candidates` WHERE CandidateId = $CandidateID")->getRow()->AssignTo;

        if ($WorkingStatus == 1) {
            $Status = 'Push to Active Employees';
            $Remarks = 'Candidate has push to Employees ';

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateID','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        } elseif ($WorkingStatus == 2) {
            $Status = 'Not-Active ';
            $Remarks = 'Candidate is Not-Active ';

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateID','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        } elseif ($WorkingStatus == 3) {
            $Status = 'Abscond ';
            $Remarks = 'Candidate has Abscond ';

            $query = "INSERT INTO candidate_history(`CandidateIDFK`, `Status`, `Remarks`,`HR_IDFK`,`Updated_by`) VALUES('$CandidateID','$Status','$Remarks','$assigned_for','$HR_IDFK')";
            $this->db->query($query);
        }
        $sql = "UPDATE `offer_letter` SET `WorkingStatus`='$WorkingStatus'  WHERE CandidateIDFK = '$CandidateID' ";
        // print_r($sql);exit();
        $this->db->query($sql);
    }

    function getCanHistoryM($data)
    {
        $CandidateID = $data['canId'];
        // print_r($CandidateID);exit();

        $sql = "SELECT * FROM `candidate_history` A 
        -- LEFT JOIN employees B ON B.EmployeeId =  C.HR_IDFK
        -- LEFT JOIN candidates C ON C.HR_IDFK = B.EmployeeId
        WHERE `CandidateIDFK` = '$CandidateID' ORDER BY `CH_IDPK` DESC";

        $data['CanHistory'] = $this->db->query($sql)->getResultArray();

        // print_r($data['CanHistory']);exit();
        return $data['CanHistory'];
    }

    public function TotatCount_List_CandidatesM($data)
    {
        $fdate = $data['fdate'];
        $tdate = $data['todate'];
        $sql = "SELECT * FROM candidates Where DATE(Created_at) Between '$fdate' AND '$tdate' ";

        $data['totalCountList'] = $this->db->query($sql)->getResultArray();

        // print_r(count($data['totalCountList']));exit();

        return $data['totalCountList'];
    }



    //******************************************************* / Individual_HR *********************************************************// 

    public function HR_List_CandidatesM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $trickid = $data['trickid'];
        $HRid = $data['HR_IDFK'];
        $userLevel = $data['userLevel'];

        if ($trickid == 1) {
            $trick = "WHERE AssignTo = '$HRid' AND (ScheduleStatus = 1 OR ScheduleStatus = 10) AND DATE(Created_at) BETWEEN '$fdate' and '$todate' GROUP BY CandidateId ";
        } elseif ($trickid == 9) {
            $trick = "WHERE AssignTo = '$HRid' AND ScheduleStatus = 1 AND DATE(InterviewDate) > CURRENT_DATE() AND DATE(Created_at) BETWEEN '$fdate' and '$todate' GROUP BY CandidateId ";
        } elseif ($trickid == 10) {
            $trick = "WHERE AssignTo = '$HRid' AND ScheduleStatus = 1 AND DATE(InterviewDate) < CURRENT_DATE() AND DATE(Created_at) BETWEEN '$fdate' and '$todate' GROUP BY CandidateId";
        } elseif ($trickid == 11) {
            $trick = "WHERE AssignTo = '$HRid' AND ScheduleStatus = 1 AND DATE(InterviewDate) = CURRENT_DATE() AND DATE(Created_at) BETWEEN '$fdate' and '$todate' GROUP BY CandidateId";
        } elseif ($trickid == 15) {
            $trick = "WHERE AssignTo = '$HRid' AND ScheduleStatus = 10 AND DATE(Created_at) BETWEEN '$fdate' and '$todate' GROUP BY CandidateId";
        } else {
            $trick = " ";
        }

        $sqltemptable = "DROP TEMPORARY TABLE if exists `temptable`";
        $sql_select11 = "   CREATE TEMPORARY TABLE temptable
                SELECT E.IP_IDPK, AssignTo, HR_IDFK ,A.CandidateId, A.CandidateName,A.CandidateContactNo, A.CandidateEmail,C.designations as CandidatePosition, SM_Name as Source,  B.NS_Reasons, A.ScheduleStatus, InterviewDate, E.RoundID, E.InterviewStatus, A.Created_at FROM candidates A   
                LEFT JOIN notschedule_reasons B ON B.NS_IDPK = A.ScheduleStatus 
                LEFT JOIN designation C ON C.IDPK = A.CandidatePosition
                LEFT JOIN candidate_source D ON D.SM_IDPK = A.Source
                LEFT JOIN interview_process E ON E.CandidateIDFK = A.CandidateId  

                WHERE A.ScheduleStatus = 10  OR  A.ScheduleStatus = 1         
                ORDER BY E.IP_IDPK DESC";

        $sql_select = " SELECT * FROM `temptable` $trick ";

        // print_r($sql_select);exit();
        $temptable = $this->db->query($sqltemptable);
        $querytemp = $this->db->query($sql_select11);
        $query_select = $this->db->query($sql_select);
        $data['candidate_list'] = $query_select->getResultArray();

        // print_r($data['candidate_list']); exit();

        return $data['candidate_list'];
    }

    public function HR_CandidateCountsM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $HRid = $data['HR_IDFK'];



        // print_r($todate);exit();

        // $sql1="SELECT COUNT(ScheduleStatus) as ScheduledCount FROM `candidates`  WHERE AssignTo = '$HRid' AND (ScheduleStatus = 1 OR ScheduleStatus = 10) AND DATE(InterviewDate) BETWEEN '$fdate' and '$todate'";

        // $sql2="SELECT COUNT(ScheduleStatus) as NotScheduledCount FROM `candidates`  WHERE AssignTo = '$HRid' AND ScheduleStatus >= 2 and ScheduleStatus != 10  AND ScheduleStatus != 11 AND ScheduleStatus != 12 AND ScheduleStatus != 3 AND ScheduleStatus != 8 AND ScheduleStatus != 7 AND DATE(CallBackDateTime) BETWEEN '$fdate' and '$todate' ";

        $sql1 = "SELECT COUNT(ScheduleStatus) as ScheduledCount FROM `candidates`  WHERE AssignTo = '$HRid' AND (ScheduleStatus = 1 OR ScheduleStatus = 10)  AND DATE(Created_at) BETWEEN '$fdate' and '$todate' ";
        $sql9 = "SELECT COUNT(CandidateName) as upcomingCount FROM `candidates` A WHERE AssignTo = '$HRid' AND DATE(A.InterviewDate) > CURRENT_DATE() AND ScheduleStatus = 1  AND DATE(Created_at) BETWEEN '$fdate' and '$todate'";
        $sql10 = "SELECT A.CandidateId as missedCount FROM candidates A  LEFT JOIN interview_process E ON E.CandidateIDFK = A.CandidateId WHERE  AssignTo = '$HRid' AND ScheduleStatus = 1 AND DATE(InterviewDate) < CURRENT_DATE() AND DATE(Created_at) BETWEEN '$fdate' and '$todate' GROUP BY CandidateId ";
        $sql11 = "SELECT A.CandidateId as todaysCount FROM candidates A  LEFT JOIN interview_process E ON E.CandidateIDFK = A.CandidateId WHERE AssignTo = '$HRid' AND DATE(InterviewDate) = CURRENT_DATE()  AND ScheduleStatus = 1  AND DATE(Created_at) BETWEEN '$fdate' and '$todate' GROUP BY CandidateId ";
        $sql15 = "SELECT COUNT(ScheduleStatus) as InterviewStatusCount FROM `candidates`  WHERE AssignTo = '$HRid' AND  ScheduleStatus = 10  AND DATE(Created_at) BETWEEN '$fdate' and '$todate' ";

        // print_r($sql1);exit();

        $NOTscheduleStatus = '(ScheduleStatus = 2 OR ScheduleStatus = 4 OR ScheduleStatus =5 OR ScheduleStatus =6)';
        $sql2 = "SELECT COUNT(ScheduleStatus) as NotScheduledCount FROM `candidates`         WHERE AssignTo = '$HRid' AND $NOTscheduleStatus AND DATE(Created_at) BETWEEN '$fdate' and '$todate'  ";
        $sql16 = "SELECT COUNT(ScheduleStatus) as TodaysNotScheduledCount FROM `candidates`  WHERE AssignTo = '$HRid' AND $NOTscheduleStatus AND DATE(CallBackDateTime) = CURRENT_DATE() AND DATE(Created_at) BETWEEN '$fdate' and '$todate'  ";
        $sql17 = "SELECT COUNT(ScheduleStatus) as MissedNotScheduledCount FROM `candidates`  WHERE AssignTo = '$HRid' AND $NOTscheduleStatus AND DATE(CallBackDateTime) < CURRENT_DATE() AND DATE(Created_at) BETWEEN '$fdate' and '$todate'  ";
        $sql18 = "SELECT COUNT(ScheduleStatus) as UpcomingNotScheduledCount FROM `candidates` WHERE AssignTo = '$HRid' AND $NOTscheduleStatus AND DATE(CallBackDateTime) > CURRENT_DATE() AND DATE(Created_at) BETWEEN '$fdate' and '$todate'  ";


        $sql12 = "SELECT COUNT(ScheduleStatus) as FreshListCount FROM `candidates`  WHERE AssignTo = '$HRid' AND ScheduleStatus = 12 AND DATE(Created_at) BETWEEN '$fdate' and '$todate'";
        $sql3 = "SELECT COUNT(ScheduleStatus) as JunkCount FROM `candidates`  WHERE AssignTo = '$HRid'  AND (ScheduleStatus = 11 OR ScheduleStatus = 3 OR ScheduleStatus = 8 OR ScheduleStatus = 7) AND DATE(CallBackDateTime) BETWEEN '$fdate' and '$todate' ";

        $sql4 = "SELECT COUNT(InterviewStatus) as SelectedCount FROM `interview_process` LEFT JOIN candidates ON CandidateId = CandidateIDFK WHERE AssignTo = '$HRid' AND DATE(Created_at) BETWEEN '$fdate' and '$todate' AND InterviewStatus = 2";
        $sql5 = "SELECT COUNT(InterviewStatus) as HoldCount FROM `interview_process`  LEFT JOIN candidates ON CandidateId = CandidateIDFK WHERE AssignTo = '$HRid' AND DATE(Created_at) BETWEEN '$fdate' and '$todate' AND InterviewStatus = 3";
        $sql6 = "SELECT COUNT(InterviewStatus) as RejectCount FROM `interview_process`  LEFT JOIN candidates ON CandidateId = CandidateIDFK WHERE AssignTo = '$HRid' AND DATE(Created_at) BETWEEN '$fdate' and '$todate' AND InterviewStatus = 4";
        $sql7 = "SELECT COUNT(DVStatus) as OfferLetterCount FROM `candidates` A LEFT JOIN document_verification B ON B.CandidateIDFK = A.CandidateId WHERE AssignTo = '$HRid' AND DATE(Create_at) BETWEEN '$fdate' and '$todate' AND B.DVStatus = 2";
        $sql8 = "SELECT COUNT(CandidateConfirmation) as JoinedCount FROM `candidates` A LEFT JOIN offer_letter B ON B.CandidateIDFK = A.CandidateId WHERE AssignTo = '$HRid' AND DATE(B.JoiningDate) BETWEEN '$fdate' and '$todate' AND B.JoiningStatus = 1";
        // $sql9="SELECT COUNT(CandidateName) as upcomingCount FROM `candidates` A WHERE AssignTo = '$HRid' AND DATE(A.InterviewDate) > CURRENT_DATE() AND A.ScheduleStatus = 1 ";

        // $sql10="SELECT A.CandidateId as missedCount FROM candidates A  LEFT JOIN interview_process E ON E.CandidateIDFK = A.CandidateId WHERE AssignTo = '$HRid'  AND (ScheduleStatus = 1 OR ScheduleStatus = 10) $interviewDate GROUP BY CandidateId ";
        // $sql11="SELECT A.CandidateId as todaysCount FROM candidates A  LEFT JOIN interview_process E ON E.CandidateIDFK = A.CandidateId WHERE AssignTo = '$HRid' AND DATE(InterviewDate) = CURRENT_DATE()  AND (ScheduleStatus = 1 OR ScheduleStatus = 10) GROUP BY CandidateId ";


        $sql13 = "SELECT A.CandidateId as freshlist_todaysCount FROM candidates A  WHERE AssignTo = '$HRid' AND DATE(Created_at) = CURRENT_DATE()  AND ScheduleStatus = 12";


        // if(($fdate == date('Y-m-d')) && ($todate == date('Y-m-d')) ){
        //     $pendingData = "AND DATE(A.Created_at) < CURRENT_DATE() ";

        // }else if(($fdate != date('Y-m-d')) && ($todate == date('Y-m-d')) ){
        //     $tdate = date('Y-m-d',strtotime("-1 days")) ;
        //     $pendingData = "AND DATE(A.Created_at) BETWEEN '$fdate' and '$tdate' ";        
        // }else{
        //     // $tdate = date('Y-m-d',strtotime("-1 days")) ;
        //     $pendingData = "AND DATE(A.Created_at) BETWEEN '$fdate' and '$todate' ";
        // }
        // $sql14="SELECT A.CandidateId as freshlist_pendingCount FROM candidates A  WHERE AssignTo = '$HRid' AND DATE(Created_at) < CURRENT_DATE()  AND ScheduleStatus = 12";
        $sql14 = "SELECT A.CandidateId as freshlist_pendingCount FROM candidates A  WHERE AssignTo = '$HRid'  AND DATE(A.Created_at) BETWEEN '$fdate' and '$todate' AND ScheduleStatus = 12";
        // print_r($sql14);exit();

        $result1 = $this->db->query($sql1)->getResultArray();
        $result2 = $this->db->query($sql2)->getResultArray();
        $result3 = $this->db->query($sql3)->getResultArray();
        $result4 = $this->db->query($sql4)->getResultArray();
        $result5 = $this->db->query($sql5)->getResultArray();
        $result6 = $this->db->query($sql6)->getResultArray();
        $result7 = $this->db->query($sql7)->getResultArray();
        $result8 = $this->db->query($sql8)->getResultArray();
        $result9 = $this->db->query($sql9)->getResultArray();
        $result10 = $this->db->query($sql10)->getResultArray();
        $result11 = $this->db->query($sql11)->getResultArray();
        $result12 = $this->db->query($sql12)->getResultArray();
        $result13 = $this->db->query($sql13)->getResultArray();
        $result14 = $this->db->query($sql14)->getResultArray();
        $result15 = $this->db->query($sql15)->getResultArray();
        $result16 = $this->db->query($sql16)->getResultArray();
        $result17 = $this->db->query($sql17)->getResultArray();
        $result18 = $this->db->query($sql18)->getResultArray();

        // print_r(count($result13));exit();

        // $temp = $result1[0]['ScheduledCount'] + $result2[0]['NotScheduledCount'];
        $result['candiadtecounts'][0] = $result1;
        $result['candiadtecounts'][1] = $result2;
        $result['candiadtecounts'][2] = $result3;
        $result['candiadtecounts'][3] = $result4;
        $result['candiadtecounts'][4] = $result5;
        $result['candiadtecounts'][5] = $result6;
        $result['candiadtecounts'][6] = $result7;
        $result['candiadtecounts'][7] = $result8;
        $result['candiadtecounts'][8] = $result9;
        $result['candiadtecounts'][9] = count($result10);
        $result['candiadtecounts'][10] = count($result11);
        $result['candiadtecounts'][11] = $result12;
        $result['candiadtecounts'][12] = count($result13);
        $result['candiadtecounts'][13] = count($result14);
        $result['candiadtecounts'][14] = $result15;
        $result['candiadtecounts'][15] = $result16;
        $result['candiadtecounts'][16] = $result17;
        $result['candiadtecounts'][17] = $result18;
        // print_r($result['candiadtecounts'][12]);exit();

        return $result['candiadtecounts'];
    }

    public function getHRCandidateInterviewStatusM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $trickid = $data['trickid'];
        $HRid = $data['HR_IDFK'];

        if ($trickid == 4) {
            $trick = "WHERE AssignTo = '$HRid' AND DATE(A.Created_at) BETWEEN '$fdate' and '$todate' AND D.InterviewStatus = 2 ";
        } elseif ($trickid == 5) {
            $trick = "WHERE AssignTo = '$HRid' AND DATE(A.Created_at) BETWEEN '$fdate' and '$todate' AND D.InterviewStatus = 4 ";
        } elseif ($trickid == 6) {
            $trick = "WHERE AssignTo = '$HRid' AND DATE(A.Created_at) BETWEEN '$fdate' and '$todate' AND D.InterviewStatus = 3 ";
            // }elseif($trickid == 7){
            //     $trick = "WHERE F.DVStatus = 2 GROUP BY CandidateId = 1 ";        
        } else {
            $trick = "";
        }

        $sql = "SELECT D.InterviewerIDFK,G.EmployeeName as InterviewerName, A.CandidateId, A.CandidateName,A.CandidateContactNo, A.CandidateEmail,C.designations as CandidatePosition, D.InterviewStatus , E.OL_Status, F.DVStatus, E.CandidateConfirmation as ConfirmStatus,E.JoiningStatus, D.Create_at as UpdatedDate, A.Created_at FROM candidates A
        LEFT JOIN notschedule_reasons B ON B.NS_IDPK = A.ScheduleStatus 
        LEFT JOIN designation C ON C.IDPK = A.CandidatePosition
        LEFT JOIN interview_process D ON D.CandidateIDFK = A.CandidateId
        LEFT JOIN offer_letter E ON E.CandidateIDFK = A.CandidateId
        LEFT JOIN document_verification F ON F.CandidateIDFK = A.CandidateId
        LEFT JOIN employees G ON G.EmployeeId=D.InterviewerIDFK
          $trick 
        ORDER BY DATE(InterviewDate) ASC ";

        $data['candidateStatus_list'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['candidateStatus_list']);exit();

        return $data['candidateStatus_list'];
    }

    public function getHRCandidateOfferStatusM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $trickid = $data['trickid'];
        $HRid = $data['HR_IDFK'];

        // if($trickid == 7){
        //     $trick = "WHERE DATE(Create_at) BETWEEN '$fdate' and '$todate' AND B.DVStatus = 2 ";
        if ($trickid == 8) {
            // print_r($HRid);exit();
            if ($HRid == 'default') {

                $trick = "WHERE DATE(D.JoiningDate) BETWEEN '$fdate' and '$todate' AND D.JoiningStatus = 1 ";
            } else {

                $trick = "WHERE AssignTo = '$HRid' AND DATE(D.JoiningDate) BETWEEN '$fdate' and '$todate' AND D.JoiningStatus = 1 ";
            }
        } else {
            $trick = "";
        }

        $sql = "SELECT A.CandidateId, A.CandidateName, A.CandidateContactNo, C.designations as CandidatePosition, DVStatus, D.CandidateConfirmation as ConfirmStatus,D.JoiningStatus,DATE(JoiningDate) as JoiningDate, D.WorkingStatus FROM `candidates` A 
                LEFT JOIN document_verification B ON B.CandidateIDFK = A.CandidateId
                LEFT JOIN designation C ON C.IDPK = A.CandidatePosition 
                LEFT JOIN offer_letter D ON D.CandidateIDFK = A.CandidateId
                $trick ";

        $data['candidateOfferStatus_list'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['candidateOfferStatus_list']);exit();

        return $data['candidateOfferStatus_list'];
    }

    public function getHRNotScheduledList($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $trickid = $data['trickid'];
        $HRid = $data['HR_IDFK'];

        // if(($trickid == 2) and ($HRid != 'default')){
        //     $trick = "WHERE AssignTo = '$HRid' AND ScheduleStatus >= 2 and ScheduleStatus != 10 AND ScheduleStatus != 11 AND ScheduleStatus != 12 AND ScheduleStatus != 3 AND ScheduleStatus != 8 AND ScheduleStatus != 7 AND DATE(CallBackDateTime) BETWEEN '$fdate' and '$todate' ";

        $NOTscheduleStatus = '(ScheduleStatus = 2 OR ScheduleStatus = 4 OR ScheduleStatus =5 OR ScheduleStatus =6 )';
        if ($trickid == 2) {
            $trick = "WHERE AssignTo = '$HRid' AND $NOTscheduleStatus AND DATE(Created_at) BETWEEN '$fdate' and '$todate' ";
        } elseif ($trickid == 16) {
            $trick = "WHERE AssignTo = '$HRid' AND $NOTscheduleStatus AND DATE(CallBackDateTime) = CURRENT_DATE() AND DATE(Created_at) BETWEEN '$fdate' and '$todate' ";
        } elseif ($trickid == 17) {
            $trick = "WHERE AssignTo = '$HRid' AND $NOTscheduleStatus AND DATE(CallBackDateTime) < CURRENT_DATE() AND DATE(Created_at) BETWEEN '$fdate' and '$todate' ";
        } elseif ($trickid == 18) {
            $trick = "WHERE AssignTo = '$HRid' AND $NOTscheduleStatus AND DATE(CallBackDateTime) > CURRENT_DATE() AND DATE(Created_at) BETWEEN '$fdate' and '$todate' ";
        } elseif ($trickid == 3) {
            $trick = "WHERE AssignTo = '$HRid' AND DATE(CallBackDateTime) BETWEEN '$fdate' and '$todate' AND (ScheduleStatus = 11 OR ScheduleStatus = 3 OR ScheduleStatus = 8 OR ScheduleStatus = 7)";
        } else {
            $trick = "";
        }


        $sql = "SELECT A.CandidateId, A.CandidateName,A.CandidateContactNo, A.CandidateEmail,C.designations as CandidatePosition, SM_Name as Source,  B.NS_Reasons, A.ScheduleStatus, DATE(A.InterviewDate), A.CallBackDateTime, A.Created_at, E.EmployeeName as assignTo  FROM candidates A   
        LEFT JOIN notschedule_reasons B ON B.NS_IDPK = A.ScheduleStatus 
        LEFT JOIN designation C ON C.IDPK = A.CandidatePosition
        LEFT JOIN candidate_source D ON D.SM_IDPK = A.Source
        LEFT JOIN employees E ON E.EmployeeId = A.AssignTo
        $trick ";

        // print_r($sql);exit();
        $data['notScheduledList'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['notScheduledList']);exit();

        return $data['notScheduledList'];
    }
    public function HR_fresh_List_CandidatesM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $trickid = $data['trickid'];
        $HRid = $data['HR_IDFK'];
        // print_r($data);exit();

        // SELECT A.CandidateId as freshlist_pendingCount FROM candidates A  WHERE AssignTo = '$HRid'  $fromDate AND ScheduleStatus = 12
        if (($fdate == date('Y-m-d')) && ($todate == date('Y-m-d'))) {
            $pendingData = "AND DATE(A.Created_at) < CURRENT_DATE() ";
        } else if (($fdate != date('Y-m-d')) && ($todate == date('Y-m-d'))) {
            $tdate = date('Y-m-d', strtotime("-1 days"));
            $pendingData = "AND DATE(A.Created_at) BETWEEN '$fdate' and '$tdate' ";
        } else {
            // $tdate = date('Y-m-d',strtotime("-1 days")) ;
            $pendingData = "AND DATE(A.Created_at) BETWEEN '$fdate' and '$todate' ";
        }

        if (($trickid == 12) and ($HRid != 'default')) {
            $trick = "WHERE A.AssignTo = '$HRid' AND A.ScheduleStatus = 12 AND DATE(Created_at) BETWEEN '$fdate' and '$todate' ";
        } else if (($trickid == 13) and ($HRid != 'default')) {
            $trick = "WHERE A.AssignTo = '$HRid' AND  DATE(Created_at) = CURRENT_DATE() AND A.ScheduleStatus = 12 ";
        } else if (($trickid == 14) and ($HRid != 'default')) {
            $trick = "WHERE A.AssignTo = '$HRid'  $pendingData AND A.ScheduleStatus = 12 ";
        } else {
            $trick = "";
        }


        $sql = "SELECT A.CandidateId, A.CandidateName,A.CandidateContactNo,E.EmployeeName as UploadBy ,F.EmployeeName as assignTo , A.CandidateEmail,C.designations as CandidatePosition, SM_Name as Source,  B.NS_Reasons, A.ScheduleStatus, DATE(A.InterviewDate), DATE(Created_at) as UploadedDate FROM candidates A   
        LEFT JOIN notschedule_reasons B ON B.NS_IDPK = A.ScheduleStatus 
        LEFT JOIN designation C ON C.IDPK = A.CandidatePosition
        LEFT JOIN candidate_source D ON D.SM_IDPK = A.Source
        LEFT JOIN employees E ON E.EmployeeId = A.UploadBy 
        LEFT JOIN employees F ON F.EmployeeId = A.AssignTo 
        $trick ";

        // print_r($sql);exit();

        $data['freshCandidate_list'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['freshCandidate_list']);exit();

        return $data['freshCandidate_list'];
    }

    public function getCurrentdayCount($data)
    {

        $HRid = $data['HR_IDFK'];

        $sql1 = "SELECT CandidateId as freshlistcount FROM candidates  WHERE AssignTo = '$HRid' AND DATE(Created_at) = CURRENT_DATE()  AND ScheduleStatus = 12   GROUP BY CandidateId ";
        $sql2 = "SELECT CandidateId as notschedulecount FROM candidates   WHERE AssignTo = '$HRid' AND DATE(CallBackDateTime) = CURRENT_DATE()  AND (ScheduleStatus = 3 OR ScheduleStatus = 7 OR ScheduleStatus = 8 )  GROUP BY CandidateId ";
        $sql3 = "SELECT CandidateId as schedulecount FROM candidates   WHERE AssignTo = '$HRid' AND DATE(InterviewDate) = CURRENT_DATE()  AND ScheduleStatus = 1 GROUP BY CandidateId ";
        $sql4 = "SELECT CandidateId as interviewcount FROM candidates   WHERE AssignTo = '$HRid' AND DATE(InterviewDate) = CURRENT_DATE()  AND ScheduleStatus = 10 GROUP BY CandidateId ";

        $result1 = $this->db->query($sql1)->getResultArray();
        $result2 = $this->db->query($sql2)->getResultArray();
        $result3 = $this->db->query($sql3)->getResultArray();
        $result4 = $this->db->query($sql4)->getResultArray();

        $result['curentDayCount'][0] = count($result1);
        $result['curentDayCount'][1] = count($result2);
        $result['curentDayCount'][2] = count($result3);
        $result['curentDayCount'][3] = count($result4);

        // print_r($sql1);exit();

        return $result['curentDayCount'];
    }


    // Arivnith 
    public function List_CandidatesM($HRid = null, $trickid, $options)
    {
        if ($options['search'] != null || $options['search'] != '') {
            $s = $options['search'];
            $search = "AND (HRName LIKE '%$s%' 
                        OR CandidateName LIKE '%$s%' 
                        OR InterviewDate LIKE '%$s%'
                        OR CandidateContactNo LIKE '%$s%'
                        OR CandidatePosition LIKE '%$s%'
                        OR Source LIKE '%$s%'
                        OR Created_at LIKE '%$s%')";
            $candidate = "";
            $source = "";
            $filter_1 = "";
            $filter_2 = "";
            $hr = "";
            $status = "";
        } else {
            $search = "";
            if ($options['designation'] != null || $options['designation'] != '') {
                $s = $options['designation'];
                $candidate = "AND CandidatePosition = '$s'";
            } else {
                $candidate = "";
            }
            if ($options['source'] != null || $options['source'] != '') {
                $s = $options['source'];
                $source = "AND Source = '$s'";
            } else {
                $source = "";
            }
            if ($options['hr'] != null || $options['hr'] != '') {
                $s = $options['hr'];
                $hr = "AND HRName = '$s'";
            } else {
                $hr = "";
            }
            if ($options['start_date_1'] != null && $options['start_date_1'] != '') {
                $sd = $options['start_date_1'];
                $ed = $options['end_date_1'];
                $filter_1 = "AND DATE(InterviewDate) BETWEEN '$sd' and '$ed'";
            } else {
                $filter_1 = "";
            }
            if ($options['start_date_2'] != null && $options['start_date_2'] != '') {
                $sd = $options['start_date_2'];
                $ed = $options['end_date_2'];
                $filter_2 = "AND DATE(Created_at) BETWEEN '$sd' and '$ed'";
            } else {
                $filter_2 = "";
            }
            if ($options['reason'] != null && $options['reason'] != '') {
                $s = $options['reason'];
                if ($s == 10) {
                    $status = "AND RoundID is NULL";
                } else {
                    $status = "AND RoundID = $s";
                }
            } else {
                $status = "";
            }
        }
        if ($options['length'] != null && $options['length'] != '') {
            $s = $options['start'];
            $l = $options['length'];
            $limit = "LIMIT $s, $l";
        } else {
            $limit = "";
        }
        if ($options["overdue"] != null && $options["overdue"] != '') {
            $overdue = "AND DATE(InterviewDate) < CURRENT_DATE()";
        } else {
            $overdue = "";
        }
        if ($HRid != null && $HRid != '') {
            $HR = "AND AssignTo = $HRid";
        }else{
            $HR = "";
        }

        if ($trickid == 1) {
            $trick1 = "WHERE A.ScheduleStatus = 1";
            $trick = "WHERE ScheduleStatus = 1 $overdue $search $candidate $source $HR $hr $filter_1 $filter_2 GROUP BY CandidateId";
        } elseif ($trickid == 9) {
            $trick1 = "WHERE A.ScheduleStatus = 1";
            $trick = "WHERE ScheduleStatus = 1 AND DATE(InterviewDate) > CURRENT_DATE() $overdue $search $candidate $source $HR $hr $filter_1 $filter_2 GROUP BY CandidateId";
        } elseif ($trickid == 10) {
            $trick1 = "WHERE A.ScheduleStatus = 1";
            $trick = "WHERE ScheduleStatus = 1 AND DATE(InterviewDate) < CURRENT_DATE() $overdue $search $candidate $source $HR $hr $filter_1 $filter_2 GROUP BY CandidateId";
        } elseif ($trickid == 11) {
            $trick1 = "WHERE A.ScheduleStatus = 1";
            $trick = "WHERE ScheduleStatus = 1 AND DATE(InterviewDate) = CURRENT_DATE() $overdue $search $candidate $source $HR $hr $filter_1 $filter_2 GROUP BY CandidateId";
        } elseif ($trickid == 15) {
            $trick1 = "WHERE A.ScheduleStatus = 10";
            $trick = "WHERE ScheduleStatus = 10 $overdue $search $candidate $source $HR $hr $filter_1 $filter_2 $status GROUP BY CandidateId";
        } else {
            $trick = " ";
        }

        $sqltemptable = "DROP TEMPORARY TABLE if exists `temptable`";
        $sql_select11 = "   CREATE TEMPORARY TABLE temptable
                            SELECT E.IP_IDPK, A.UploadBy as HR_IDFK, F.EmployeeName as HRName,  A.CandidateId, 
                            A.CandidateName, A.CandidateContactNo, A.CandidateEmail,C.designations as CandidatePosition, 
                            SM_Name as Source, A.CandidateResume as Resume,  B.NS_Reasons, A.ScheduleStatus, InterviewDate, 
                            E.RoundID, E.InterviewStatus, A.Created_at, A.Updated_date, A.AssignTo FROM candidates A 
                            LEFT JOIN notschedule_reasons B ON B.NS_IDPK = A.ScheduleStatus 
                            LEFT JOIN designation C ON C.IDPK = A.CandidatePosition
                            LEFT JOIN candidate_source D ON D.SM_IDPK = A.Source
                            LEFT JOIN interview_process E ON E.CandidateIDFK = A.CandidateId
                            LEFT JOIN employees F ON F.EmployeeId = A.UploadBy
                            LEFT JOIN employees G ON G.EmployeeId = A.AssignTo
                            $trick1 ORDER BY E.IP_IDPK DESC";

        $sql_select = "SELECT * FROM `temptable` $trick ORDER BY InterviewDate DESC $limit";

        $temptable = $this->db->query($sqltemptable);
        $querytemp = $this->db->query($sql_select11);
        $query_select = $this->db->query($sql_select);
        $data['candidate_list'] = $query_select->getResultArray();
        return $data['candidate_list'];
    }

    public function getNotScheduledList($HRid = null, $trickid, $options)
    {
        if ($options['search'] != null || $options['search'] != '') {
            $s = $options['search'];
            $search = "AND (CallBackDateTime LIKE '%$s%' 
                        OR CandidateName LIKE '%$s%'
                        OR CandidateContactNo LIKE '%$s%'
                        OR C.designations LIKE '%$s%'
                        OR SM_Name LIKE '%$s%'
                        OR NS_Reasons LIKE '%$s%'
                        OR F.EmployeeName LIKE '%$s%'
                        OR Created_at LIKE '%$s%')";
            $candidate = "";
            $source = "";
            $filter_1 = "";
            $filter_2 = "";
            $hr = "";
            $reason = "";
        } else {
            $search = "";
            if ($options['designation'] != null || $options['designation'] != '') {
                $s = $options['designation'];
                $candidate = "AND C.designations = '$s'";
            } else {
                $candidate = "";
            }
            if ($options['source'] != null || $options['source'] != '') {
                $s = $options['source'];
                $source = "AND SM_Name = '$s'";
            } else {
                $source = "";
            }
            if ($options['hr'] != null || $options['hr'] != '') {
                $s = $options['hr'];
                $hr = "AND E.EmployeeName = '$s'";
            } else {
                $hr = "";
            }
            if ($options['start_date_1'] != null && $options['start_date_1'] != '') {
                $sd = $options['start_date_1'];
                $ed = $options['end_date_1'];
                $filter_1 = "AND DATE(CallBackDateTime) BETWEEN '$sd' and '$ed'";
            } else {
                $filter_1 = "";
            }
            if ($options['start_date_2'] != null && $options['start_date_2'] != '') {
                $sd = $options['start_date_2'];
                $ed = $options['end_date_2'];
                $filter_2 = "AND DATE(Created_at) BETWEEN '$sd' and '$ed'";
            } else {
                $filter_2 = "";
            }
            if ($options['reason'] != null && $options['reason'] != '') {
                $s = $options['reason'];
                $reason = "AND NS_Reasons = '$s'";
            } else {
                $reason = "";
            }
        }
        if ($options['length'] != null && $options['length'] != '') {
            $s = $options['start'];
            $l = $options['length'];
            $limit = "LIMIT $s, $l";
        } else {
            $limit = "";
        }
        if ($options["overdue"] != null && $options["overdue"] != '') {
            $overdue = "AND DATE(CallBackDateTime) < CURRENT_DATE()";
        } else {
            $overdue = "";
        }
        if ($HRid != null && $HRid != '') {
            $HR = "AND A.AssignTo = $HRid";
        }else{
            $HR = "";
        }

        if ($trickid == 2) {
            $trick = "WHERE (ScheduleStatus = 2 OR ScheduleStatus = 4 OR ScheduleStatus =5 OR ScheduleStatus =6 ) $overdue $search $candidate $source $HR $hr $filter_1 $filter_2 $reason";
        } elseif ($trickid == 3) {
            $trick = "WHERE (ScheduleStatus = 11 OR ScheduleStatus = 3 OR ScheduleStatus = 8 OR ScheduleStatus = 7) $overdue $search $candidate $source $HR $hr $filter_1 $filter_2 $reason";
        } else {
            $trick = "";
        }

        $sql = "SELECT A.CandidateId, A.CandidateName, A.UploadBy as HR_IDFK, E.EmployeeName as UploadBy ,
                       F.EmployeeName as assignTo ,A.CandidateContactNo, A.CandidateEmail,C.designations as CandidatePosition, 
                       SM_Name as Source, A.CallBackDateTime as CallBack , B.NS_Reasons, A.ScheduleStatus, DATE(A.InterviewDate), 
                       A.Created_at FROM candidates A   
                LEFT JOIN notschedule_reasons B ON B.NS_IDPK = A.ScheduleStatus 
                LEFT JOIN designation C ON C.IDPK = A.CandidatePosition
                LEFT JOIN candidate_source D ON D.SM_IDPK = A.Source
                LEFT JOIN employees E ON E.EmployeeId = A.UploadBy 
                LEFT JOIN employees F ON F.EmployeeId = A.AssignTo 
                $trick ORDER BY A.CallBackDateTime DESC $limit";

        $data['notScheduledList'] = $this->db->query($sql)->getResultArray();
        return $data['notScheduledList'];
    }

    public function getFreshList($HRid = null, $trickid, $options)
    {
        if ($options['search'] != null || $options['search'] != '') {
            $s = $options['search'];
            $search = "AND (A.CandidateName LIKE '%$s%' 
                        OR A.CandidateContactNo LIKE '%$s%'
                        OR C.designations LIKE '%$s%'
                        OR SM_Name LIKE '%$s%'
                        OR Created_at LIKE '%$s%'
                        OR F.EmployeeName LIKE '%$s%'
                        OR E.EmployeeName LIKE '%$s%')";
            $candidate = "";
            $source = "";
            $hr = "";
            $filter_1 = "";
            $filter_2 = "";
        } else {
            $search = "";
            if ($options['designation'] != null || $options['designation'] != '') {
                $s = $options['designation'];
                $candidate = "AND C.designations = '$s'";
            } else {
                $candidate = "";
            }
            // if ($options['hr'] != null || $options['hr'] != '') {
            //     $s = $options['hr'];
            //     $hr = "AND E.EmployeeName = '$s'";
            if($options['hr'] == "Auto Assigned"){
                $hr = "AND A.UploadBy is NULL AND A.AssignTo is NOT NULL";
            } else if($options['hr'] == "Yet To Assign"){
                $hr = "AND A.UploadBy is NULL AND A.AssignTo is NULL";
            } else if ($options['hr'] != null || $options['hr'] != '') {
                $s = $options['hr'];
                $hr = "AND E.EmployeeName = '$s'";
            } else {
                $hr = "";
            }
            if ($options['source'] != null || $options['source'] != '') {
                $s = $options['source'];
                $source = "AND SM_Name = '$s'";
            } else {
                $source = "";
            }
            if ($options['start_date_1'] != null && $options['start_date_1'] != '') {
                $sd = $options['start_date_1'];
                $ed = $options['end_date_1'];
                $filter_1 = "AND DATE(Created_at) BETWEEN '$sd' and '$ed'";
            } else {
                $filter_1 = "";
            }
            if ($options['start_date_2'] != null && $options['start_date_2'] != '') {
                $sd = $options['start_date_2'];
                $ed = $options['end_date_2'];
                $filter_2 = "AND DATE(Created_at) BETWEEN '$sd' and '$ed'";
            } else {
                $filter_2 = "";
            }
        }
        if ($options['length'] != null && $options['length'] != '') {
            $s = $options['start'];
            $l = $options['length'];
            $limit = "LIMIT $s, $l";
        } else {
            $limit = "";
        }
        if ($options["overdue"] != null && $options["overdue"] != '') {
            $overdue = "AND DATE(Created_at) < CURRENT_DATE()";
        } else {
            $overdue = "";
        }
        if ($HRid != null && $HRid != '') {
            $HR = "AND AssignTo = $HRid";
        }else{
            $HR="";
        }
        if (($trickid == 12 || $trickid == 13 || $trickid == 14)) {
            $trick = "WHERE A.ScheduleStatus = 12 $overdue $search $candidate $source $HR $hr $filter_1 $filter_2";
        } else {
            $trick = "";
        }
        $sql = "SELECT A.CandidateId, A.CandidateName, A.UploadBy as HR_IDFK, E.EmployeeName as UploadBy ,
                       F.EmployeeName as assignTo ,A.CandidateContactNo, A.CandidateEmail,C.designations as CandidatePosition, 
                       SM_Name as Source, A.CallBackDateTime as CallBack , B.NS_Reasons, A.ScheduleStatus, DATE(A.InterviewDate), 
                       Date(Created_at) as UploadDate, A.AssignTo FROM candidates A   
                LEFT JOIN notschedule_reasons B ON B.NS_IDPK = A.ScheduleStatus 
                LEFT JOIN designation C ON C.IDPK = A.CandidatePosition
                LEFT JOIN candidate_source D ON D.SM_IDPK = A.Source
                LEFT JOIN employees E ON E.EmployeeId = A.UploadBy 
                LEFT JOIN employees F ON F.EmployeeId = A.AssignTo
                $trick ORDER BY DATE(UploadDate) DESC $limit";

        $data['freshList'] = $this->db->query($sql)->getResultArray();
        return $data['freshList'];
    }

    public function getCandidateInterviewStatusM($HRid = null, $trickid, $options)
    {
        if ($options['search'] != null || $options['search'] != '') {
            $s = $options['search'];
            $search = "AND (CandidateName LIKE '%$s%' 
                        OR CandidateContactNo LIKE '%$s%'
                        OR C.designations LIKE '%$s%'
                        OR SM_Name LIKE '%$s%'
                        OR H.EmployeeName LIKE '%$s%'
                        OR A.InterviewDate LIKE '%$s%'
                        OR D.Create_at LIKE '%$s%')";
            $candidate = "";
            $source = "";
            $filter_1 = "";
            $filter_2 = "";
            $hr = "";
        } else {
            $search = "";
            if ($options['designation'] != null || $options['designation'] != '') {
                $s = $options['designation'];
                $candidate = "AND C.designations = '$s'";
            } else {
                $candidate = "";
            }
            if ($options['source'] != null || $options['source'] != '') {
                $s = $options['source'];
                $source = "AND SM_Name = '$s'";
            } else {
                $source = "";
            }
            if ($options['hr'] != null || $options['hr'] != '') {
                $s = $options['hr'];
                $hr = "AND J.EmployeeName = '$s'";
            } else {
                $hr = "";
            }
            if ($options['start_date_1'] != null && $options['start_date_1'] != '') {
                $sd = $options['start_date_1'];
                $ed = $options['end_date_1'];
                $filter_1 = "AND DATE(A.InterviewDate) BETWEEN '$sd' and '$ed'";
            } else {
                $filter_1 = "";
            }
            if ($options['start_date_2'] != null && $options['start_date_2'] != '') {
                $sd = $options['start_date_2'];
                $ed = $options['end_date_2'];
                $filter_2 = "AND DATE(A.Created_at) BETWEEN '$sd' and '$ed'";
            } else {
                $filter_2 = "";
            }
        }
        if ($options['length'] != null && $options['length'] != '') {
            $s = $options['start'];
            $l = $options['length'];
            $limit = "LIMIT $s, $l";
        } else {
            $limit = "";
        }
        if ($options["overdue"] != null && $options["overdue"] != '') {
            $overdue = "AND DATE(A.Created_at) < CURRENT_DATE()";
        } else {
            $overdue = "";
        }
        if ($HRid != null && $HRid != '') {
            $HR = "AND A.AssignTo = $HRid";
        }else{
            $HR="";
        }
        if ($trickid == 4) {
            $trick = "WHERE D.InterviewStatus = 2 $overdue $search $candidate $source $HR $hr $filter_1 $filter_2";
        } elseif ($trickid == 5) {
            $trick = "WHERE D.InterviewStatus = 4 $overdue $search $candidate $source $HR $hr $filter_1 $filter_2";
        } elseif ($trickid == 6) {
            $trick = "WHERE D.InterviewStatus = 3 $overdue $search $candidate $source $HR $hr $filter_1 $filter_2";
        } else {
            $trick = "";
        }

        $sql = "SELECT D.InterviewerIDFK, G.EmployeeName as InterviewerName, J.EmployeeName as HRName, A.CandidateId, 
                       A.CandidateName, SM_Name as Source, A.CandidateContactNo, A.CandidateEmail, 
                       C.designations as CandidatePosition, D.InterviewStatus , E.OL_Status, F.DVStatus, 
                       E.CandidateConfirmation as ConfirmStatus, E.JoiningStatus, A.Created_at , D.Create_at as UpdatedDate, 
                       A.InterviewDate FROM candidates A
                LEFT JOIN notschedule_reasons B ON B.NS_IDPK = A.ScheduleStatus 
                LEFT JOIN designation C ON C.IDPK = A.CandidatePosition
                LEFT JOIN interview_process D ON D.CandidateIDFK = A.CandidateId
                LEFT JOIN offer_letter E ON E.CandidateIDFK = A.CandidateId
                LEFT JOIN document_verification F ON F.CandidateIDFK = A.CandidateId
                LEFT JOIN employees G ON G.EmployeeId = D.InterviewerIDFK
                LEFT JOIN employees H ON H.EmployeeId = A.AssignTo
                LEFT JOIN candidate_source I ON I.SM_IDPK = A.Source
                LEFT JOIN employees J ON J.EmployeeId = A.UploadBy
                $trick ORDER BY DATE(D.Create_at) DESC $limit";

        $data['candidateStatus_list'] = $this->db->query($sql)->getResultArray();
        return $data['candidateStatus_list'];
    }

    public function getCandidateOfferStatusM($HRid = null, $trickid, $options)
    {
        if ($options['search'] != null || $options['search'] != '') {
            $s = $options['search'];
            $search = "AND (CandidateName LIKE '%$s%' 
                        OR CandidateContactNo LIKE '%$s%'
                        OR C.designations LIKE '%$s%'
                        OR D.JoiningDate LIKE '%$s%'
                        OR SM_Name LIKE '%$s%'
                        OR Created_at LIKE '%$s%'
                        OR E.EmployeeName LIKE '%$s%')";
            $candidate = "";
            $source = "";
            $filter_1 = "";
            $filter_2 = "";
            $hr = "";
        } else {
            $search = "";
            if ($options['designation'] != null || $options['designation'] != '') {
                $s = $options['designation'];
                $candidate = "AND C.designations = '$s'";
            } else {
                $candidate = "";
            }
            if ($options['source'] != null || $options['source'] != '') {
                $s = $options['source'];
                $source = "AND SM_Name = '$s'";
            } else {
                $source = "";
            }
            if ($options['hr'] != null || $options['hr'] != '') {
                $s = $options['hr'];
                $hr = "AND G.EmployeeName = '$s'";
            } else {
                $hr = "";
            }
            if ($options['start_date_1'] != null && $options['start_date_1'] != '') {
                $sd = $options['start_date_1'];
                $ed = $options['end_date_1'];
                $filter_1 = "AND DATE(A.InterviewDate) BETWEEN '$sd' and '$ed'";
            } else {
                $filter_1 = "";
            }
            if ($options['start_date_2'] != null && $options['start_date_2'] != '') {
                $sd = $options['start_date_2'];
                $ed = $options['end_date_2'];
                $filter_2 = "AND DATE(D.JoiningDate) BETWEEN '$sd' and '$ed'";
            } else {
                $filter_2 = "";
            }
        }
        if ($options['length'] != null && $options['length'] != '') {
            $s = $options['start'];
            $l = $options['length'];
            $limit = "LIMIT $s, $l";
        } else {
            $limit = "";
        }
        if ($HRid != null && $HRid != '') {
            $HR = "AND A.AssignTo = $HRid";
        }else{
            $HR="";
        }

        if ($trickid == 8) {
            $trick = "WHERE D.JoiningStatus = 1 $search $candidate $source $HR $hr $filter_1 $filter_2";
        } else {
            $trick = "";
        }

        $sql = "SELECT A.CandidateId, A.CandidateName, G.EmployeeName as HRName, A.CandidateContactNo, 
                       C.designations as CandidatePosition, SM_Name as Source, DVStatus, D.CandidateConfirmation as ConfirmStatus,
                       D.JoiningStatus,DATE(D.JoiningDate) as JoiningDate, D.WorkingStatus,  Date(Created_at) as UploadDate, 
                       A.InterviewDate FROM `candidates` A 
                LEFT JOIN document_verification B ON B.CandidateIDFK = A.CandidateId
                LEFT JOIN designation C ON C.IDPK = A.CandidatePosition 
                LEFT JOIN offer_letter D ON D.CandidateIDFK = A.CandidateId
                LEFT JOIN employees E ON E.EmployeeId = A.AssignTo
                LEFT JOIN employees G ON G.EmployeeId = A.UploadBy
                LEFT JOIN candidate_source F ON F.SM_IDPK = A.Source
                $trick ORDER BY DATE(D.JoiningDate) DESC $limit";

        $data['candidateOfferStatus_list'] = $this->db->query($sql)->getResultArray();

        return $data['candidateOfferStatus_list'];
    }

    public function getCurrentdayActivity($HRid, $data)
    {
        if ($data['search'] != null || $data['search'] != '') {
            $s = $data['search'];
            $SEARCH = "AND A_sub.CandidateName LIKE '%$s%'
                       OR A_sub.CandidateContactNo LIKE '%$s%'
                       OR C_sub.designations LIKE '%$s%'
                       OR B_sub.Status LIKE '%$s%'
                       OR B_sub.Remarks LIKE '%$s%'
                       OR D_sub.EmployeeName LIKE '%$s%'";
            $HR = '';
            $DESIGNATION = '';
            $STATUS = '';
        } else {
            $SEARCH = '';
            if ($data['start_date'] != null || $data['start_date'] != '') {
                $s = $data['start_date'];
                $e = $data['end_date'];
                $DATE = "WHERE DATE(B_sub.added_date) BETWEEN '$s' and '$e'";
            } else {
                $DATE = 'WHERE DATE(B_sub.added_date) = CURRENT_DATE()';
            }
            if ($data['hr'] != null || $data['hr'] != '') {
                $s = $data['hr'];
                $hr = "AND D_sub.EmployeeName = '$s'";
            } else {
                $hr = '';
            }
            if ($data['designation'] != null || $data['designation'] != '') {
                $s = $data['designation'];
                $DESIGNATION = "AND C_sub.designations = '$s'";
            } else {
                $DESIGNATION = '';
            }
            if ($data['status'] != null || $data['status'] != '') {
                $s = $data['status'];
                $STATUS = "AND B_sub.Status = '$s'";
            } else {
                $STATUS = '';
            }
        }
        if ($data['length'] != null && $data['length'] != '') {
            $s = $data['start'];
            $l = $data['length'];
            $LIMIT = "LIMIT $s, $l";
        } else {
            $LIMIT = "";
        }
        if ($HRid != null && $HRid != '') {
            $s = $HRid;
            $HR = "AND B_sub.Updated_by = $s";
        }else{
            $HR = "";
        }

        $sqltemptable = "DROP TEMPORARY TABLE if exists `temptable`";
        $sql_select11 = "CREATE TEMPORARY TABLE temptable
                        SELECT A.CandidateId, A.CandidateName, A.CandidateContactNo, C.designations, B.Status, B.Remarks, 
                               D.EmployeeName, D.EmployeeId, B.added_date FROM candidate_history B
                        LEFT JOIN candidates A ON A.CandidateId = B.CandidateIDFK
                        LEFT JOIN designation C ON C.IDPK = A.CandidatePosition
                        LEFT JOIN employees D ON D.EmployeeId = B.HR_IDFK
                        INNER JOIN (SELECT CandidateIDFK, MAX(B_sub.added_date) AS latest_date FROM candidate_history B_sub
                                    LEFT JOIN candidates A_sub ON A_sub.CandidateId = B_sub.CandidateIDFK
                                    LEFT JOIN designation C_sub ON C_sub.IDPK = A_sub.CandidatePosition
                                    LEFT JOIN employees D_sub ON D_sub.EmployeeId = B_sub.Updated_by
                                    $DATE $SEARCH $HR $hr $DESIGNATION $STATUS
                                    GROUP BY CandidateIDFK) AS latest_records 
                        ON B.CandidateIDFK = latest_records.CandidateIDFK 
                        AND B.added_date = latest_records.latest_date
                        ORDER BY B.added_date DESC $LIMIT;";

        $sql_select = "SELECT * FROM `temptable` ";
        $temptable = $this->db->query($sqltemptable);
        $querytemp = $this->db->query($sql_select11);
        $query_select = $this->db->query($sql_select);
        $data['curentDayActivity'] = $query_select->getResultArray();
        return $data['curentDayActivity'];
    }



    public function getStatusList()
    {
        $sql = "SELECT DISTINCT Status FROM candidate_history";
        $data['List'] = $this->db->query($sql)->getResultArray();
        // print_r($data['HRList']);exit();
        return $data['List'];
    }

    public function getDesignationList()
    {
        $sql = "SELECT IDPK, designations FROM designation";
        $data['List'] = $this->db->query($sql)->getResultArray();
        // print_r($data['HRList']);exit();
        return $data['List'];
    }

    public function getSourceList()
    {
        $sql = "SELECT SM_IDPK, SM_Name FROM candidate_source";
        $data['List'] = $this->db->query($sql)->getResultArray();
        // print_r($data['HRList']);exit();
        return $data['List'];
    }

    public function getReasonsList()
    {
        $sql = "SELECT DISTINCT NS_Reasons FROM notschedule_reasons";
        $data['List'] = $this->db->query($sql)->getResultArray();
        // print_r($data['HRList']);exit();
        return $data['List'];
    }

    public function getAssign($options)
    {
        if ($options['length'] != null && $options['length'] != '') {
            $s = $options['start'];
            $l = $options['length'];
            $limit = "LIMIT $s, $l";
        } else {
            $limit = "";
        }
        if ($options['source'] != null && $options['source'] != '') {
            $s = $options['source'];
            $source = "AND SM_Name = '$s'";
        } else {
            $source = "";
        }
        $sql = "SELECT A.CandidateId, A.CandidateName, E.EmployeeName as UploadBy, A.CandidateContactNo, 
                       C.designations as CandidatePosition, SM_Name as Source  
                FROM candidates A
                LEFT JOIN designation C ON C.IDPK = A.CandidatePosition
                LEFT JOIN candidate_source D ON D.SM_IDPK = A.Source
                LEFT JOIN employees E ON E.EmployeeId = A.UploadBy
                WHERE A.AssignTo is NULL OR A.AssignTo = 0 $source
                ORDER BY DATE(A.Created_at) DESC $limit";
        $data['assignList'] = $this->db->query($sql)->getResultArray();
        return $data['assignList'];
    }

    public function DoucumentVerificationUpdate($data)
    {
        $id = $data['CandidateIDFK'];
        $remarks = $data['DVRemarks'];
        $status = $data['DVStatus'];

        $sql = "SELECT * FROM document_verification WHERE CandidateIDFK = $id";
        $count = $this->db->query($sql)->getResultArray();
        $count = count($count) ?? 0;

        if ($count != 0) {
            $sql = "UPDATE `document_verification` SET `DVStatus`= $status,`DVRemarks`='$remarks' WHERE CandidateIDFK = $id";
            $this->db->query($sql);
        } else {
            $sql = "INSERT INTO `document_verification`(`CandidateIDFK`, `DVStatus`, `DVRemarks`) VALUES('$id', '$status', '$remarks')";
            $this->db->query($sql);
        }
        return true;
    }

    public function UpdateJobExperience($data)
    {
        if($data['remove']){
            foreach($data['remove'] as $id){
                $sql = "DELETE FROM `job_experience` WHERE IDPK = $id";
                $this->db->query($sql);
            }
        }
        if($data['options']){
            foreach ($data['options'] as $dat) {
                $sql = "INSERT INTO `job_experience`(`Options`) VALUES (?)";
                $this->db->query($sql, [$dat]);
            }
        }
        return true;
    }

    public function GetJobExperience()
    {
        $sql = $sql = "SELECT A.IDPK, A.Options,CASE 
                                                    WHEN COUNT(B.job_experience) > 0 THEN 0
                                                    ELSE 1
                                                END AS Del
                        FROM job_experience A
                        LEFT JOIN careers_job_lists B ON B.job_experience = A.IDPK AND B.active_Id = 1
                        GROUP BY A.IDPK, A.Options";
        $data = $this->db->query($sql)->getResultArray();

        // print_r($data);exit(0);

        return $data;
    }

    public function ReApproveCandidate($id){
        $sql = "DELETE FROM `document_verification` WHERE CandidateIDFK = ?";
        $this->db->query($sql, $id);
        return true;
    }
}
