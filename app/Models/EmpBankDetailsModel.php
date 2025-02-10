<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpBankDetailsModel extends Model
{
    protected $insertID         = 0;
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $useSoftDeletes   = false;
    protected $returnType       = 'array';
    protected $DBGroup          = 'default';
    protected $table            = 'emp_bank_details'; 
    protected $primaryKey       = 'EmployeeIDFK';
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
    protected $cleanValidationRules = true;
    protected $skipValidation       = false;

    // Callbacks
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    protected $allowCallbacks = true;

    public function __construct()
    {
        parent::__construct();
    }

}


