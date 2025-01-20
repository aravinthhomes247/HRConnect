<?php

namespace App\Models;

use Codeigniter\Controller\HRController;
use CodeIgniter\Model;

class EmpBankDetailsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'emp_bank_details'; 
    protected $primaryKey       = 'EmployeeIDFK';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['EBD_IDPK','EmployeeIDFK','AccountHolderName','BankName','AccountNo','IFSCode','BankBranch','EBD_Created_at'];
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
    }

}


