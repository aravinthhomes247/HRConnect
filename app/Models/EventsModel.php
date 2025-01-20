<?php

namespace App\Models;

use Codeigniter\Controller\HRController;
use CodeIgniter\Model;




class EventsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'events';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['EventId','EventDate','EventName','EventDescription','Type'];

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
 

    public function EventsDetails(){

        $sql="SELECT EventId,EventName,EventDate,Type,EventDescription FROM events WHERE MONTH(EventDate)=MONTH(now()) OR DATE(EventDate)>=CURRENT_DATE() ORDER BY EventDate ASC;";
        // $sql="SELECT EventName,EventDate FROM events WHERE MONTH(EventDate)=MONTH(now())  ORDER BY EventDate ASC;";

        $data['alleventsDetailsTable'] = $this->db->query($sql)->getResultArray(); //run the query
        
        // print_r($sql); exit();
        return $data['alleventsDetailsTable'];

    }

    public function EventDetails($id){
        $sql = "SELECT EventId,EventName,EventDate,Type,EventDescription FROM events WHERE EventId = $id";
        $data = $this->db->query($sql)->getRow(); //run the query
        // print_r($data); exit();
        return $data;
    }

    public function UpdateEvent($data){
        $sql = "UPDATE events SET EventName=?, EventDate=?,Type=?, EventDescription=? WHERE EventId = ?";
        $data = $this->db->query($sql,[$data['EventName'],$data['EventDate'],$data['Type'],$data['EventDescription'],$data['EventId']]); //run the query
        // print_r($data); exit();
        return true;
    }

    public function DeleteEvent($id){
        $sql = "DELETE FROM events WHERE EventId = ?";
        $data = $this->db->query($sql, $id); //run the query
        // print_r($data); exit();
        return true;
    }
}




