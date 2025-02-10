<?php

namespace App\Models;

use CodeIgniter\Model;

class EventsModel extends Model
{
    protected $insertID         = 0;
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $useSoftDeletes   = false;
    protected $returnType       = 'array';
    protected $table            = 'events';
    protected $DBGroup          = 'default';
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
 

    public function EventsDetails(){
        $sql="SELECT EventId,EventName,EventDate,Type,EventDescription FROM events WHERE MONTH(EventDate)=MONTH(now()) OR DATE(EventDate)>=CURRENT_DATE() ORDER BY EventDate ASC;";
        $data['alleventsDetailsTable'] = $this->db->query($sql)->getResultArray();        
        return $data['alleventsDetailsTable'];
    }
    public function EventDetails($id){
        $sql = "SELECT EventId,EventName,EventDate,Type,EventDescription FROM events WHERE EventId = $id";
        $data = $this->db->query($sql)->getRow();
        return $data;
    }
    public function UpdateEvent($data){
        $sql = "UPDATE events SET EventName=?, EventDate=?,Type=?, EventDescription=? WHERE EventId = ?";
        $data = $this->db->query($sql,[$data['EventName'],$data['EventDate'],$data['Type'],$data['EventDescription'],$data['EventId']]);
        return true;
    }
    public function DeleteEvent($id){
        $sql = "DELETE FROM events WHERE EventId = ?";
        $data = $this->db->query($sql, $id);
        return true;
    }
}




