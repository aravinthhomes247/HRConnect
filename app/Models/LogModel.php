<?php

namespace App\Models;

// helper('date');
use CodeIgniter\Database\DatabaseInterface;
use CodeIgniter\Model;
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Query;

class LogModel extends Model
{


    protected $DBGroup          = 'default';
    protected $table            = 'devicelogs_processed';
    protected $primaryKey       = 'DeviceLogId';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'DeviceLogId',
        'DownloadDate',
        'DeviceId',
        'UserId',
        'LogDate',
        'Direction',
        'AttDirection',
        'C1',
        'C2',
        'C3',
        'C4',
        'C5',
        'C6',
        'C7',
        'WorkCode'
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

        $this->db      = \Config\Database::connect('default');
    }

    // public function presentslog()
    // {
    //     $date = date('Y-m-d');
    //     $data['presents'] = $this->db->table('devicelogs_processed') 
    //                         ->distinct()->select('UserId')
    //                         ->where('DATE(LogDate)', $date)                              
    //                        -> get()->getResult();

    //     return $data['presents'];
    // }
    public function presentslog()
    {
        // $date = date('Y-m-d');
        // print_r($date);exit();
        // $data['logtime'] =  $this->db->distinct();
        $sql = "SELECT distinct(UserId) FROM developement_biometric.`devicelogs_processed` 
            LEFT JOIN employees B on B.EmployeeCode = developement_biometric.devicelogs_processed.UserId 
           WHERE B.Status='Working' AND DATE(LogDate) = CURRENT_DATE()";

        $data['presents'] = $this->db->query($sql)->getResultArray();
        // print_r($data['presents']);exit();
        return $data['presents'];
    }
    public function selectDRpresentsM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];

        $sql = "SELECT UserId, B.EmployeeName as name, MIN(LogDate) as login, MAX(LogDate) as logout, TIMEDIFF( MAX(LogDate), MIN(LogDate)) as workingHours FROM developement_biometric.`devicelogs_processed` LEFT JOIN employees B ON B.EmployeeCode = devicelogs_processed.UserId WHERE DATE(LogDate) BETWEEN '$fdate' AND '$todate' GROUP BY UserId, YEAR(LogDate), MONTH(LogDate), DAY(LogDate) ORDER BY `login` ASC";

        $data['presents'] = $this->db->query($sql)->getResultArray(); //run the query

        // print_r($data['presents']); exit();

        return $data['presents'];
    }
    public function selectDRabsentsM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];

        $sql = "  SELECT e.EmployeeCode AS `EmployeeCode` , d.dt AS `AbsentDate`
            FROM ( SELECT DATE(dp.LogDate) AS dt
                     FROM developement_biometric.devicelogs_processed dp
                    WHERE dp.LogDate >= '$fdate' 
                      AND dp.LogDate < DATE_ADD( '$todate' ,INTERVAL 1 DAY)
                    GROUP BY DATE(dp.LogDate)
                    ORDER BY DATE(dp.LogDate)
                 ) d
           
            JOIN employees e
            LEFT
            JOIN  developement_biometric.devicelogs_processed p
              ON p.LogDate >= d.dt
             AND p.LogDate <  d.dt + INTERVAL 1 DAY
             AND p.UserId = e.EmployeeCode
           WHERE e.Status='Working' AND p.UserId IS NULL and DAYNAME(d.dt) NOT IN ('Sunday')";

        $data['absent'] = $this->db->query($sql)->getResultArray(); //run the query

        return $data['absent'];
    }
    public function selectDRlateComersM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];

        $sqltemptable = "DROP TEMPORARY TABLE if exists `temptable`";
        $sql_select11 = "   CREATE TEMPORARY TABLE temptable 
                                SELECT UserId,B.EmployeeName as name, MIN(LogDate) as FirstLogin 
                                FROM developement_biometric.devicelogs_processed 
                                LEFT JOIN employees B ON B.EmployeeCode = developement_biometric.devicelogs_processed.UserId 
                                WHERE  DATE(LogDate) BETWEEN '$fdate ' AND '$todate' 
                                GROUP BY UserId, YEAR(LogDate), MONTH(LogDate), DAY(LogDate) 
                                ORDER BY `FirstLogin` DESC";

        $sql_select = " SELECT * FROM `temptable` where temptable.FirstLogin >= '$fdate'   AND TIME(FirstLogin) >= '09:46:00'  ";

        // print_r($sql_select11);   exit();

        $temptable = $this->db->query($sqltemptable);
        $querytemp = $this->db->query($sql_select11);
        $query_select = $this->db->query($sql_select);
        $data['lateComers'] = $query_select->getResultArray();
        // print_r($data['lateComers']); exit();

        return $data['lateComers'];
    }


    public function presentsListM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];

        $sql = "SELECT UserId, B.EmployeeName as name, MIN(LogDate) as login, MAX(LogDate) as logout, TIMEDIFF( MAX(LogDate), MIN(LogDate)) as workingHours 
                FROM developement_biometric.`devicelogs_processed` 
                LEFT JOIN employees B ON B.EmployeeCode = devicelogs_processed.UserId 
                WHERE DATE(LogDate) BETWEEN '$fdate' AND '$todate' 
                GROUP BY UserId, YEAR(LogDate), MONTH(LogDate), DAY(LogDate) 
                ORDER BY `login` ASC ";
        
        $data['presentsdetailslog'] = $this->db->query($sql)->getResultArray(); //run the query

        // print_r($data['presentsdetailslog']); exit();
        return $data['presentsdetailslog'];
    }

    public function absentsListM($data)
    {
        $lrid = $data['LRID'];
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $trickid = $data['trickid'];
        if (isset($lrid) && !empty($lrid) && $lrid != "NA" && $lrid != 0) {
            $dataBaseReason = "AND l.IDPK = '$lrid'";
        } else {
            $dataBaseReason = "";
        }
        if ($trickid == 1) {
            $trick = "$dataBaseReason AND e.Status='Working' ";
        } elseif ($trickid == 2) {
            // $trick=" and Reason is NOT NULL AND e.Status='Working' ";
            $trick = "$dataBaseReason AND `mb`.`Mail_Msg` is NOT NULL AND e.Status='Working'";
        } elseif ($trickid == 3) {
            // $trick=" and Reason is NULL AND e.Status='Working' ";
            $trick = "$dataBaseReason AND `mb`.`Mail_Msg` is NULL AND e.Status='Working'";
        }
        $sql = "SELECT e.EmployeeId AS EmployeeId, e.EmployeeCode AS EmployeeCode, EmployeeName, d.dt AS `AbsentDate`,l.leaveReason as Reason, DAYNAME(d.dt), a.ReasonMsg, a.IDPK as ReasonIDPK
                    FROM (SELECT DATE (dp.LogDate) AS dt FROM developement_biometric.devicelogs_processed dp
                    WHERE dp.LogDate >= '$fdate' AND dp.LogDate < DATE_ADD( '$todate' ,INTERVAL 1 DAY)
                    GROUP BY DATE (dp.LogDate) ORDER BY DATE (dp.LogDate)) d             
                    CROSS JOIN employees e
                    LEFT JOIN developement_biometric.devicelogs_processed p ON p.LogDate >= d.dt AND p.LogDate <  d.dt + INTERVAL 1 DAY AND p.UserId = e.EmployeeCode
                    LEFT JOIN absents_leave_request a ON (a.EmployeeIDFK,a.absentDate) = (e.EmployeeId,d.dt)
                    LEFT JOIN leavereason l ON l.IDPK = a.leaveReasonIDFK 
                    LEFT JOIN mail_base mb ON mb.Mail_IDPK = a.Mail_Base_IDFK
                    WHERE p.UserId IS NULL  and DAYNAME(d.dt) NOT IN ('Sunday') $trick ";
        $data['absentsdetailslog'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['absentsdetailslog']); exit();
        return $data['absentsdetailslog'];
    }

    public function filterCountM($data)
    {
        $lrid = $data['LRID'];
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        if (isset($lrid) && !empty($lrid) && $lrid != "NA" && $lrid != 0) {
            $dataBaseReason = "AND l.IDPK = '$lrid'";
        } else {
            $dataBaseReason = "";
        }
        $sql = "SELECT SUM(`mb`.`Mail_Msg` is NULL) as pending,SUM(`mb`.`Mail_Msg` is NOT NULL) as updeated
                FROM (SELECT DATE (dp.LogDate) AS dt FROM developement_biometric.devicelogs_processed dp
                WHERE dp.LogDate >= '$fdate' AND dp.LogDate < DATE_ADD( '$todate' ,INTERVAL 1 DAY)
                GROUP BY DATE (dp.LogDate) ORDER BY DATE (dp.LogDate)) d             
                CROSS JOIN employees e
                LEFT JOIN developement_biometric.devicelogs_processed p ON p.LogDate >= d.dt AND p.LogDate <  d.dt + INTERVAL 1 DAY AND p.UserId = e.EmployeeCode
                LEFT JOIN absents_leave_request a ON (a.EmployeeIDFK,a.absentDate) = (e.EmployeeId,d.dt)
                LEFT JOIN leavereason l ON l.IDPK = a.leaveReasonIDFK 
                LEFT JOIN mail_base mb ON mb.Mail_IDPK = a.Mail_Base_IDFK
                WHERE e.Status='Working' AND  p.UserId IS NULL $dataBaseReason  and DAYNAME(d.dt) NOT IN ('Sunday')";

        $data['countFilter'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['countFilter']); exit();
        return $data['countFilter'];
    }
    public function selectReasonM()
    {
        $sql = "SELECT * FROM `leavereason` ORDER BY LeaveReason ASC ";
        $data['selectReason'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['selectdesignation']); exit();
        return $data['selectReason'];
    }
    public function lateComerslog()
    {
        $sqltemptable = "DROP TEMPORARY TABLE if exists `temptable`";
        $sql_select11 = "   CREATE TEMPORARY TABLE temptable SELECT UserId,B.EmployeeName as name, MIN(LogDate) as FirstLogin 
                                FROM developement_biometric.devicelogs_processed 
                                LEFT JOIN employees B ON B.EmployeeCode = developement_biometric.devicelogs_processed.UserId 
                                WHERE DATE(LogDate) = CURRENT_DATE()  
                                GROUP BY UserId, YEAR(LogDate), MONTH(LogDate), DAY(LogDate) 
                                ORDER BY `FirstLogin` DESC";
        $sql_select = " SELECT * FROM `temptable` where temptable.FirstLogin >= CURRENT_DATE()  AND TIME(FirstLogin) >= '09:46:00'  ";

        $temptable = $this->db->query($sqltemptable);
        $querytemp = $this->db->query($sql_select11);
        $query_select = $this->db->query($sql_select);
        $data['lateComers'] = $query_select->getResult();

        return $data['lateComers'];
    }

    // public function attendanceListM($data){
    //     $fdate = $data['fdate'];
    //     $todate = $data['todate'];


    //     $sql = "SELECT UserId, B.EmployeeName as name, MIN(LogDate) as login, MAX(LogDate) as logout, TIMEDIFF( MAX(LogDate), MIN(LogDate)) as workingHours FROM developement_biometric.`devicelogs_processed` LEFT JOIN employees B ON B.EmployeeCode = devicelogs_processed.UserId WHERE DATE(LogDate) BETWEEN '$fdate' AND '$todate' GROUP BY UserId, YEAR(LogDate), MONTH(LogDate), DAY(LogDate) ORDER BY `login` ASC ";
    //     $data['attendanceList'] = $this->db->query($sql)->getResultArray(); //run the query

    //     // print_r($data['attendanceList']); exit();

    //     return $data['attendanceList'];
    // }

    public function getEmpAllLog($data1)
    {

        $fdate = $data1['fdate'];
        $todate = $data1['todate'];
        $id = $data1['empid'];

        $sql1 = "SELECT UserId, B.EmployeeName as name,B.EmployeeId as empId, LogDate  FROM developement_biometric.`devicelogs_processed` 
                LEFT JOIN employees B ON B.EmployeeCode = developement_biometric.devicelogs_processed.UserId                 
                WHERE B.EmployeeId = '$id' AND DATE(LogDate) BETWEEN '$fdate' AND '$todate' ORDER BY LogDate asc";
        // print_r($sql1);exit();


        $data['empLog'] = $this->db->query($sql1)->getResultArray(); //run the query
        // print_r($data['empLog']);
        //     exit;

        return $data['empLog'];
    }
    public function getEmpAllLateComing($data1)
    {

        $fdate = $data1['fdate'];
        $todate = $data1['todate'];
        $id = $data1['empid'];
        // print_r($id);exit();

        $sqltemptable = "   DROP TEMPORARY TABLE if exists `temptable`";
        $sql_select11 = "   CREATE TEMPORARY TABLE temptable SELECT B.EmployeeId as id,UserId,B.EmployeeName as name, MIN(LogDate) as FirstLogin 
            FROM developement_biometric.devicelogs_processed 
            LEFT JOIN employees B ON B.EmployeeCode = developement_biometric.devicelogs_processed.UserId 
            WHERE DATE(LogDate) BETWEEN '$fdate ' AND '$todate' 
            GROUP BY UserId, YEAR(LogDate), MONTH(LogDate), DAY(LogDate) 
            ORDER BY `FirstLogin` ASC";

        $sql_select = " SELECT * FROM `temptable` where temptable.id = '$id' and temptable.FirstLogin >= '$fdate'  AND TIME(FirstLogin) >= '09:46:00' ";

        // print_r($sql_select11);   exit();

        $temptable = $this->db->query($sqltemptable);
        $querytemp = $this->db->query($sql_select11);
        $query_select = $this->db->query($sql_select);
        $data['empLatecomer'] = $query_select->getResultArray();


        // $data['empLog'] = $this->db->query($sql1)->getResultArray(); //run the query
        // print_r($data['empLog']);
        //     exit;

        return $data['empLatecomer'];
    }





    public function getSearchAllLog($data1)
    {
        $fdate = $data1['fdate'];
        $todate = $data1['todate'];

        $sqltemptable = "DROP TEMPORARY TABLE if exists `temptable`";
        $sql_select11 = "CREATE TEMPORARY TABLE temptable
                SELECT UserId, B.EmployeeName as name, B.EmployeeId, LogDate, C.designations, MIN(LogDate) as login, MAX(LogDate) as logout, TIMEDIFF( MAX(LogDate), MIN(LogDate)) as workingHours
                FROM developement_biometric.`devicelogs_processed` 
                LEFT JOIN employees B ON B.EmployeeCode = developement_biometric.devicelogs_processed.UserId 
                LEFT JOIN designation C ON C.IDPK = B.DesignationIDFK
                WHERE DATE(LogDate) BETWEEN '$fdate' AND '$todate'
                GROUP BY UserId, YEAR(LogDate), MONTH(LogDate), DAY(LogDate)  
                ORDER BY LogDate asc";
        $sql_select = "SELECT * FROM `temptable` WHERE workingHours != '00:00:00'";

        $this->db->query($sqltemptable);
        $this->db->query($sql_select11);
        $data['selectedemps'] = $this->db->query($sql_select)->getResultArray(); //run the query
        return $data['selectedemps'];
    }

    public function lateComersListM($data1)
    {
        $fdate = $data1['fdate'];
        $todate = $data1['todate'];

        $sqltemptable = "DROP TEMPORARY TABLE if exists `temptable`";
        $sql_select11 = "CREATE TEMPORARY TABLE temptable 
                            SELECT UserId, B.EmployeeName as name, MIN(LogDate) as FirstLogin, MAX(LogDate) as LastLogin, C.designations, TIMEDIFF( MAX(LogDate), MIN(LogDate)) as workingHours
                            FROM developement_biometric.devicelogs_processed 
                            LEFT JOIN employees B ON B.EmployeeCode = developement_biometric.devicelogs_processed.UserId
                            LEFT JOIN designation C ON C.IDPK = B.DesignationIDFK
                            WHERE DATE(LogDate) BETWEEN '$fdate' AND '$todate'  
                            GROUP BY UserId, YEAR(LogDate), MONTH(LogDate), DAY(LogDate) 
                            ORDER BY `FirstLogin` DESC";
        $sql_select = "SELECT * FROM `temptable` WHERE TIME(FirstLogin) > '09:45:59' AND workingHours != '00:00:00'";

        $this->db->query($sqltemptable);
        $this->db->query($sql_select11);
        $data['lateComersDetailsLog'] = $this->db->query($sql_select)->getResultArray();

        return $data['lateComersDetailsLog'];
    }

    public function EarlyoutListM($data){
        $fdate = $data['fdate'];
        $todate = $data['todate'];

        $sqltemptable = "DROP TEMPORARY TABLE if exists `temptable`";
        $sql_select11 = "CREATE TEMPORARY TABLE temptable 
                            SELECT UserId, B.EmployeeName as name, MIN(LogDate) as FirstLogin, MAX(LogDate) as LastLogin, C.designations, TIMEDIFF( MAX(LogDate), MIN(LogDate)) as workingHours
                            FROM developement_biometric.devicelogs_processed 
                            LEFT JOIN employees B ON B.EmployeeCode = developement_biometric.devicelogs_processed.UserId
                            LEFT JOIN designation C ON C.IDPK = B.DesignationIDFK
                            WHERE DATE(LogDate) BETWEEN '$fdate' AND '$todate'  
                            GROUP BY UserId, YEAR(LogDate), MONTH(LogDate), DAY(LogDate) 
                            ORDER BY `FirstLogin` DESC";
        $sql_select = "SELECT * FROM `temptable` WHERE TIME(LastLogin) < '18:30:00' AND workingHours != '00:00:00'";

        $this->db->query($sqltemptable);
        $this->db->query($sql_select11);
        $query_select = $this->db->query($sql_select);
        $data['early'] = $query_select->getResultArray();

        return $data['early'];
    }

    public function AbnormalListM($data){
        $fdate = $data['fdate'] ?? date('Y-m-d');
        $todate = $data['todate'] ?? date('Y-m-d');

        $sqltemptable = "DROP TEMPORARY TABLE if exists `temptable`";
        $sql_select11 = "CREATE TEMPORARY TABLE temptable
                SELECT UserId, B.EmployeeName as name, LogDate, C.designations, MIN(LogDate) as login, MAX(LogDate) as logout, TIMEDIFF( MAX(LogDate), MIN(LogDate)) as workingHours
                FROM developement_biometric.`devicelogs_processed` 
                LEFT JOIN employees B ON B.EmployeeCode = developement_biometric.devicelogs_processed.UserId 
                LEFT JOIN designation C ON C.IDPK = B.DesignationIDFK
                WHERE DATE(LogDate) BETWEEN '$fdate' AND '$todate'
                GROUP BY UserId, YEAR(LogDate), MONTH(LogDate), DAY(LogDate)  
                ORDER BY LogDate DESC";
        $sql_select = "SELECT *,
                        (CASE WHEN login = logout THEN 1 ELSE 0 END) AS Miss_Bunch,
                        (CASE WHEN TIME(login) > '09:45:59' THEN 1 ELSE 0 END) AS Late_Login,
                        (CASE WHEN TIME(logout) < '18:30:00' THEN 1 ELSE 0 END) AS Early_Logout,
                        (CASE WHEN workingHours < '09:00:00' THEN 1 ELSE 0 END) AS Low_Wh
                       FROM temptable
                       WHERE (login = logout) OR (TIME(login) > '09:45:59') OR (TIME(logout) < '18:30:00') OR (workingHours < '09:00:00')";

        $this->db->query($sqltemptable);
        $this->db->query($sql_select11);
        $data['abnormal'] = $this->db->query($sql_select)->getResultArray(); //run the query

        // echo '<pre>';
        //     print_r($data['abnormal']);
        // echo '</pre>';
        // exit(0);

        return $data['abnormal'];
    }
}
