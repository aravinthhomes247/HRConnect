<?php

namespace App\Models;

// $db      = \Config\Database::connect();
// $builder = $db->table('absents_leave_request');

// print_r($builder);exit();


use CodeIgniter\Model;

class LeaveReasonModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = ['absents_leave_request'];
    protected $primaryKey       = 'IDPK';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['IDPK',	'EmployeeIDFK',	'leaveReasonIDFK','Mail_Base_IDFK','absentDate','replyMsg', 'ReasonMsg','leaveStatus','createdAt'];

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

   

    public function addReasons($data1,$data2){

        $Mail_TypeId=$data1['Mail_TypeId'];
        $SenderId=$data1['SenderId'];
        $ReceiverId=$data1['ReceiverId'];
        $Mail_Msg=$data1['Mail_Msg'];

        $leaveReasonIDFK=$data2['leaveReasonIDFK'];
        $EmployeeIDFK=$data2['EmployeeIDFK'];
        $absentDate=$data2['absentDate'];

        // $Reason=$data['Reason'];

        // print_r($IDPK);exit();

        $sql = "INSERT INTO mail_base (Mail_TypeId, SenderId, ReceiverId,Mail_Msg )Values('$Mail_TypeId', '$SenderId', '$ReceiverId','$Mail_Msg') ";

        // $sql = "INSERT INTO absents_leave_request (leaveReasonIDFK, EmployeeIDFK, absentDate)
        //         SELECT * FROM (SELECT '$LRidfk' AS leaveReasonIDFK, '$empIDFK' AS EmployeeIDFK,'$AD' AS absentDate) AS temp
        //         WHERE NOT EXISTS (
        //             SELECT EmployeeIDFK, absentDate FROM absents_leave_request WHERE absentDate = '$AD' and EmployeeIDFK ='$empIDFK'
        //         ) LIMIT 1  ";

        $this->db->query($sql);
        $lastInsertedId= $this->db->insertID();
        
        $sql2="INSERT INTO absents_leave_request (Mail_Base_IDFK,leaveReasonIDFK,EmployeeIDFK,absentDate,ReasonMsg)Values('$lastInsertedId', '$leaveReasonIDFK', '$EmployeeIDFK','$absentDate','$Mail_Msg')";

        $this->db->query($sql2);
        // return $lastInsertedId;

        // $this->on_duplicate('absents_leave_request', $data);
    }
    public function editReasons($data){

        $IDPK=$data['IDPK'];
        $Mail_IDPK=$data['Mail_IDPK'];        
        $leaveReasonIDFK=$data['leaveReasonIDFK'];
        $Mail_Msg=$data['Mail_Msg'];

        // print_r($IDPK);exit();

        $sql="UPDATE absents_leave_request,mail_base SET absents_leave_request.leaveReasonIDFK=$leaveReasonIDFK, absents_leave_request.ReasonMsg='$Mail_Msg', mail_base.Mail_Msg='$Mail_Msg' WHERE absents_leave_request.IDPK = $IDPK AND mail_base.Mail_IDPK = $Mail_IDPK";

        // $sql = "INSERT INTO absents_leave_request (`IDPK`,`leaveReasonIDFK`, `EmployeeIDFK`, `EmployeeCodeFK`, `absentDate`,`Reason`) VALUES('$IDPK','$LRidfk','$empIDFK', '$empCFK', '$AD','$Reason') ON DUPLICATE KEY UPDATE    
        // leaveReasonIDFK='$LRidfk' ,EmployeeIDFK='$empIDFK', absentDate='$AD',Reason='$Reason'  ";


        $data['editAbsentEmpDetails'] = $this->db->query($sql);
        // print_r($sql);exit();
        // $this->on_duplicate('absents_leave_request', $data);
    }

    // public function addLeaveRequest($data){
    //     // $IDPK=$data['IDPK'];
    //     $empCFK=$data['EmployeeCodeFK'];
    //     $empIdFK=$data['EmployeeIDFK'];
    //     $LeaReqdate=$data['absentDate'];
    //     $LRidfk=$data['LeaveReasonIDFK'];
    //     $requestMsg=$data['Reason'];

    //     $sql = "INSERT INTO absents_leave_request (leaveReasonIDFK,EmployeeIDFK, EmployeeCodeFK,absentDate,Reason) 
    //             VALUES ('$LRidfk' ,'$empIdFK', '$empCFK'  ,'$LeaReqdate','$requestMsg') ";
    //     // print_r($sql);exit();
    //     $data['addLeaveRequestDetails'] = $this->db->query($sql);
    // }

    public function updateLeaveRequestReply($data){
        $id=$data['IDPK'];
        $status=$data['approve']; 

        $Mail_Base_IDFK=$data['Mail_Base_IDFK'];
        $SenderId=$data['SenderId'];
        $ReceiverId=$data['ReceiverId'];
        $Mail_Reply_Msg=$data['Mail_Reply_Msg'];
        // $approve=$data['reject'];
        // print_r($approve);exit();
        $sql1= "INSERT INTO `mail_reply`( `Mail_Base_IDFK`, `SenderId`, `ReceiverId`, `Mail_Reply_Msg`) VALUES($Mail_Base_IDFK,$SenderId,$ReceiverId,'$Mail_Reply_Msg')";
        $this->db->query($sql1);
        $sql = "UPDATE `absents_leave_request` SET `leaveStatus`='$status' WHERE IDPK = $id";
        $result = $this->db->query($sql);

    }

    public function addLrReply($data){

        // $IDPK=$data['IDPK'];
        $Mail_Base_IDFK=$data['Mail_Base_IDFK'];
        $SenderId=$data['SenderId'];
        $ReceiverId=$data['ReceiverId'];
        $Mail_Reply_Msg=$data['Mail_Reply_Msg'];
       

        $sql = "INSERT INTO `mail_reply`(`Mail_Base_IDFK`, `SenderId`, `ReceiverId`, `Mail_Reply_Msg`) VALUES ('$Mail_Base_IDFK','$SenderId','$ReceiverId','$Mail_Reply_Msg'  ) ";
        // print_r($sql);exit();
        $data['addLRreply'] = $this->db->query($sql);
    }
    
    function addHRMail($data){
        // print_r($data);exit();
        $Mail_TypeId=1;
        $SenderId=$data['SenderId'];
        $ReceiverId=$data['ReceiverId'];
        $Mail_Msg=$data['Mail_Msg'];
        
        foreach($ReceiverId as $val){            
            $sql="INSERT INTO `mail_base`(`Mail_TypeId`, `SenderId`, `ReceiverId`, `Mail_Msg`)values($Mail_TypeId, $SenderId,$val,'$Mail_Msg')";
            $data['addHRmail'] = $this->db->query($sql);
            $ReceiverId++;
        }

    } 

}