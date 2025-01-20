<?php

namespace App\Models;

use Codeigniter\Controller\HRController;
use CodeIgniter\Model;


class InterviewersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'interviewer_list';
    protected $primaryKey       = 'I_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['I_ID','InterviewerIDFK','I_create_at'];

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

    public function select_interviewerM(){
        $sql = "SELECT EmployeeName, EmployeeId FROM employees A WHERE Status='Working' AND NOT EXISTS (SELECT * FROM interviewer_list B
        WHERE  B.InterviewerIDFK = A.EmployeeId) ORDER BY EmployeeName ASC";
        $data['select_interviewer'] = $this->db->query($sql)->getResultArray(); //run the query
        return $data['select_interviewer'];
    }

    public function interviewer_listM(){
        $sql = "SELECT B.EmployeeId, B.EmployeeName, B.EmployeeCode From interviewer_list A LEFT JOIN employees B ON B.EmployeeID = A.InterviewerIDFK ";
        $data['interviewerList'] = $this->db->query($sql)->getResultArray();
        return $data['interviewerList'];
    }
    
    public function getInterviewerListM($data){
        $CandidateIDFK = $data['canId'];
        // print_r($CandidateIDFK);exit();
        $sql = "SELECT C.EmployeeId, C.EmployeeName FROM interviewer_list A LEFT JOIN employees C ON C.EmployeeId = A.InterviewerIDFK
                WHERE C.Status='Working' AND NOT EXISTS (SELECT * FROM interview_process B WHERE B.CandidateIDFK = '$CandidateIDFK' AND B.InterviewerIDFK = C.EmployeeId)";

        $data['getInterviewerList'] = $this->db->query($sql)->getResultArray();

        return $data['getInterviewerList'];        

    }

    public function getReportingManager(){
        $sql = "SELECT EmployeeId, EmployeeName FROM interviewer_list A LEFT JOIN employees B ON B.EmployeeId = A.InterviewerIDFK";
        $data['reportManager'] = $this->db->query($sql)->getResultArray();

        // print_r($data['reportManager']);exit();
        return $data['reportManager'];
    }
}