<?php

namespace App\Models;

use Codeigniter\Controller\HRController;
use CodeIgniter\Model;

class CareerModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'careers_job_lists'; 
    protected $primaryKey       = 'job_IDPK';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['job_IDPK','job_cat_IDFK','job_Title','job_experience', 'active_Id','company_profile','job_overview','qualifications','skills','roles','job_type','pdf_file'];

    
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $updatedField  = 'update_date';

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
    }

    public function ShowAll($data){
        $sql="SELECT B.job_cat_name, A.job_IDPK, C.Options, A.job_Title, A.job_experience, A.active_Id, A.update_date FROM `careers_job_lists` A 
                LEFT JOIN `careers_category` B ON B.job_cat_IDPK = A.job_cat_IDFK
                LEFT JOIN `job_experience` C ON C.IDPK = A.job_experience
                ORDER BY A.`job_Title` ASC";

        $data['careers'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['careers']);exit(0);
        return $data['careers'];
    }

    public function ShowAllCat(){
        $sql = "SELECT job_cat_name, job_cat_IDPK FROM `careers_category`";
        $data['CareersCategory'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['careers']);exit(0);
        return $data['CareersCategory'];
    }

    public function FindCareer($id){
        $sql = "SELECT job_cat_IDFK, job_IDPK, job_Title, job_experience, company_profile, job_overview, qualifications, skills, roles, job_type FROM `careers_job_lists` WHERE job_IDPK = $id";
        $data['career'] = $this->db->query($sql)->getResultArray(); // run the query
        // print_r($data['career'][0]);exit(0);
        return $data['career'][0];   
      }

    public function FindCareerStatus($id){
        $sql = "SELECT active_Id FROM `careers_job_lists` WHERE job_IDPK = $id";
        $data['status'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['status'][0]);exit(0);
        return $data['status'][0];
    }

    public function NofApplicants($id, $data){
        $s = $data['fdate'] ?? '';
        $e = $data['todate'] ?? '';
        if($s != '' || $s != null){
            $dt= "BETWEEN '$s' and '$e'";
        }else{
            $dt= "";
        }
        $date = "AND DATE(date_created) $dt";
        $sql = "SELECT COUNT(*) FROM career_details WHERE job_list_IDFK = $id $date";
        $data['count'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['count'][0]['COUNT(*)']);exit(0);
        return $data['count'][0]['COUNT(*)'];
    }

    public function AllApplicants($id, $data){
        $s = $data['fdate'];
        $e = $data['todate'];
        $date = "AND DATE(date_created) BETWEEN '$s' and '$e'";
        $sql = "SELECT candname, candmail, candnumber, ctc, comments, designation, date_created, pdf_file FROM career_details WHERE job_list_IDFK = $id $date";
        $data['applicants'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['applicants']);exit(0);
        return $data['applicants'];
    }

    public function PositionName($id){
        $sql = "SELECT job_Title FROM careers_job_lists WHERE job_IDPK = $id";
        $data['designation'] = $this->db->query($sql)->getRowArray(); //run the query
        // print_r($data['designation']);exit(0);
        return $data['designation']['job_Title'];
    }

    public function UniqueApplicants($id, $data){
        $s = $data['fdate'];
        $e = $data['todate'];
        $date = "AND DATE(date_created) BETWEEN '$s' and '$e'";
        $sql = "SELECT candname, candmail, candnumber, ctc, comments, designation, date_created, pdf_file
                FROM career_details 
                WHERE job_list_IDFK = $id $date 
                GROUP BY candnumber ORDER BY date_created";
        $data['applicants'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['applicants']);exit(0);
        return $data['applicants'];
    }

    public function TinyHrEditorKey(){
        $sql = "SELECT tiny_mce_hrpanel FROM developement_homes247.tinymce WHERE IDPK = 1";
        $data['key'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['key'][0]['tiny_mce_hrpanel']);exit(0);
        return $data['key'][0]['tiny_mce_hrpanel'];
    }

    function get_tinyMCE_code() {
		$sql_select = "SELECT tiny_mce_hrpanel as tinyMCE_API FROM developement_homes247.tinymce ORDER BY IDPK DESC limit 1";
		$query_select = $this->db->query($sql_select)->getResultArray();
        // print_r($query_select[0]);exit();
		return $query_select[0];
	}

    
}