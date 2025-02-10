<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $insertID         = 0;
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $useSoftDeletes   = false;
    protected $DBGroup          = 'default';
    protected $table            = 'admin_login';
    protected $returnType       = 'array';

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

    protected $allowedFields    = [
                                    'user_name',	
                                    'user_level',	
                                    'admin_login_IDPK',	
                                    'admin_login_email',	
                                    'admin_login_created',
                                    'admin_login_password',	
                                ];

    public function cronjobs(){
        $date = date('Y-m-d');
        $sql="SELECT count(*) as count FROM cronjobs WHERE DATE(Date) = '$date'";
        $cron = $this->db->query($sql)->getRow()->count;
        
        if($cron){
            return true;
        }
        
        $sql="INSERT INTO `cronjobs`(`Flag`) VALUES (1)";
        $cron = $this->db->query($sql);
        return false;
    }
    public function getTicketTypes(){
        $sql="SELECT A.*,CASE 
                            WHEN COUNT(B.TypeIDFK) > 0 THEN 0
                            ELSE 1
                        END AS Del
                FROM ticket_types A
                LEFT JOIN tickets B ON B.TypeIDFK = A.IDPK
                GROUP BY A.IDPK, A.Name";
        $result = $this->db->query($sql)->getResultArray();
        return $result;
    }
    public function setTicketTypes($data){
        if($data['remove']){
            foreach($data['remove'] as $id){
                $sql = "DELETE FROM `ticket_types` WHERE IDPK = $id";
                $this->db->query($sql);
            }
        }
        if($data['Name']){
            foreach ($data['Name'] as $dat) {
                $sql = "INSERT INTO `ticket_types`(`Name`) VALUES (?)";
                $this->db->query($sql, [$dat]);
            }
        }
        return true;
    }
    public function getAllSettings(){
        $sql="SELECT IDPK, Name, Value FROM settings";
        $data['settings'] = $this->db->query($sql)->getResultArray();
        return $data['settings'];
    }
    public function getSettingsSpecific($name){
        $sql="SELECT IDPK, Name, Value FROM settings WHERE Name = '$name'";
        $data['settings'] = $this->db->query($sql)->getRowArray();
        return $data['settings'];
    }
    public function updateSettings($data){
        foreach($data as $key => $value){
            $sql="UPDATE `settings` SET `Value`='$value' WHERE Name='$key'";
            $this->db->query($sql);
        }
    }
    public function AllDepartments(){

        // <-------------------  For MYSQL Servers (Version above 5.7)  -------------------->
        // $sql = "SELECT A.IDPK, A.deptName, A.CLPM, A.WO1, A.WO2, A.WO3, A.WO4, A.WO5, A.WO6, A.WO7, COUNT(B.IDPK) AS holidayCount
        //         FROM departments A
        //         LEFT JOIN holidays B ON JSON_CONTAINS(B.DepartmentIDFK, JSON_QUOTE(A.IDPK))
        //         GROUP BY A.IDPK, A.deptName, A.CLPM, A.WO1, A.WO2, A.WO3, A.WO4, A.WO5, A.WO6, A.WO7";

        // <-------------------  For MariaDB Servers Like XAMPP..... ----------------------->
        $sql = "SELECT A.IDPK, A.deptName, A.CLPM, A.SLPM, A.PLPM, A.WO1, A.WO2, A.WO3, A.WO4, A.WO5, A.WO6, A.WO7, COUNT(B.IDPK) AS holidayCount
                FROM departments A
                LEFT JOIN holidays B ON LOCATE(CONCAT('\"', A.IDPK, '\"'), B.DepartmentIDFK) > 0
                GROUP BY A.IDPK, A.deptName, A.CLPM, A.WO1, A.WO2, A.WO3, A.WO4, A.WO5, A.WO6, A.WO7";

        $data['departments'] = $this->db->query($sql)->getResultArray();
        return $data['departments'];
    }
    public function AddDepartment($data){
        $values = "('" . implode("', '", array_values($data)) . "')";
        $sql = "INSERT INTO `departments`(`deptName`, `CLPM`, `SLPM`, `PLPM`, `WO1`, `WO2`, `WO3`, `WO4`, `WO5`, `WO6`, `WO7`) VALUES $values";
        $this->db->query($sql);
        $id = $this->db->insertID();
        return true;
    }
    public function EditDepartment($id){
        $sql = "SELECT IDPK, deptName, CLPM, SLPM, PLPM, WO1, WO2, WO3, WO4, WO5, WO6, WO7 FROM departments WHERE IDPK = $id";
        $data['department'] = $this->db->query($sql)->getResultArray();
        return $data;
    }
    public function UpdateDepartment($data){
        $sql = "UPDATE `departments` SET `deptName`=?,`CLPM`=?,`SLPM`=?,`PLPM`=?,`WO1`=?,`WO2`=?,`WO3`=?,`WO4`=?,`WO5`=?,`WO6`=?,`WO7`=? WHERE IDPK = ?";
        $this->db->query($sql, [$data['deptName'], $data['CLPM'], $data['SLPM'], $data['PLPM'], $data['WO1'], $data['WO2'], $data['WO3'], $data['WO4'], $data['WO5'], $data['WO6'], $data['WO7'], $data['IDPK']]);
        return $data['IDPK'];
    }
    public function DeleteDepartment($id){
        $sql = "DELETE FROM departments WHERE IDPK = ?";
        $this->db->query($sql,$id);
        return true;
    }
    public function AllHolidays(){
        $sql = "SELECT * FROM holidays";
        $holidays = $this->db->query($sql)->getResultArray();
        return $holidays;
    }
    public function AddHolidays($data){
        $sql = "INSERT INTO `holidays`(`DepartmentIDFK`, `Name`, `Date`, `AllDept`, `SameDate`) VALUES (?, ?, ?, ?, ?)";
        $this->db->query($sql, [json_encode($data['DepartmentIDFK']), $data['Name'], $data['Date'], $data['AllDept'], $data['SameDate']]);
        return true;
    }
    public function EditHoliday($id){
        $sql="SELECT * FROM holidays WHERE IDPK = $id";
        $holiday = $this->db->query($sql)->getResultArray();
        return $holiday;
    }
    public function UpdateHolidays($data, $id){
        $sql = "UPDATE `holidays` SET `DepartmentIDFK`=?,`Name`=?,`Date`=?,`AllDept`=?,`SameDate`=? WHERE IDPK = $id";
        $this->db->query($sql, [json_encode($data['DepartmentIDFK']), $data['Name'], $data['Date'], $data['AllDept'], $data['SameDate']]);
        return true;
    }
    public function DeleteHoliday($id){
        $sql = "DELETE FROM holidays WHERE IDPK = ?";
        $this->db->query($sql, $id);
        return true;
    }
    public function AutoRemoveHolidays(){
        $sql = "DELETE FROM holidays WHERE Date < CURRENT_DATE() AND SameDate = 0";
        $this->db->query($sql);
        return true;
    }
    public function AutoRemoveEvents(){
        $sql = "DELETE FROM events WHERE DATE(EventDate) < CURRENT_DATE()";
        $this->db->query($sql);
        return true;
    }
    public function AttendanceHolidays($badge){
        $start = $badge*5;
        $sql = "SELECT Name, Date,
                    CASE
                        WHEN SameDate = 1 THEN
                            CASE
                                WHEN DATE_FORMAT(CONCAT(YEAR(CURRENT_DATE()), '-', MONTH(Date), '-', DAY(Date)), '%Y-%m-%d') < CURRENT_DATE()
                                THEN DATE_FORMAT(CONCAT(YEAR(CURRENT_DATE()) + 1, '-', MONTH(Date), '-', DAY(Date)), '%Y-%m-%d')  -- If date is in the past, use next year
                                ELSE DATE_FORMAT(CONCAT(YEAR(CURRENT_DATE()), '-', MONTH(Date), '-', DAY(Date)), '%Y-%m-%d')  -- If date is in the future or today, use this year
                            END
                        ELSE
                            Date
                    END AS AdjustedDate
                FROM holidays
                ORDER BY AdjustedDate LIMIT 10 OFFSET $start";
        $holidays = $this->db->query($sql)->getResultArray();
        return $holidays;
    }
    public function AllAccounts(){
        $sql ="SELECT * FROM admin_login ORDER BY admin_login_email";
        $data = $this->db->query($sql)->getResultArray();
        return $data;
    }
    public function StoreAccounts($data){
        $sql = "INSERT INTO `admin_login`(`EmpIDFK`, `user_name`, `admin_login_email`, `admin_login_password`, `user_level`, `active_status`, `login_access`) 
                VALUES (?,?,?,?,?,?,?)";
        $data = $this->db->query($sql,[$data['EmpIDFK'],$data['user_name'],$data['admin_login_email'],$data['admin_login_password'],$data['user_level'],$data['active_status'],$data['login_access']]);
        return true;
    }
    public function GetAccount($id){
        $sql ="SELECT * FROM admin_login WHERE admin_login_IDPK = $id";
        $data = $this->db->query($sql)->getRowArray(); 
        $sql="SELECT EmployeeName FROM employees WHERE EmployeeId =?";
        $data['EmployeeName'] = $this->db->query($sql,$data['EmpIDFK'])->getRow()->EmployeeName;
        return $data;
    }
    public function UpdateAccount($id,$data){
        $sql = "UPDATE `admin_login` 
                SET `EmpIDFK`=?,`user_name`=?,`admin_login_email`=?,`admin_login_password`=?,`user_level`=?,
                    `active_status`=?,`login_access`=? 
                WHERE admin_login_IDPK = $id";
        $data = $this->db->query($sql,[$data['EmpIDFK'],$data['user_name'],$data['admin_login_email'],$data['admin_login_password'],$data['user_level'],$data['active_status'],$data['login_access']]);
        return true;
    }
    public function ActDactAccount($id){
        $sql ="SELECT login_access FROM admin_login WHERE admin_login_IDPK = $id";
        $login_access = $this->db->query($sql)->getRow()->login_access;
        
        if($login_access == 1){
            $login_access = 0;
        }else{
            $login_access = 1;
        }
        
        $sql = "UPDATE `admin_login` SET `login_access`=? WHERE admin_login_IDPK = $id";
        $this->db->query($sql,$login_access);
        return true;
    }
    public function updateTinyMCEKey($key){
        $sql = "UPDATE developement_homes247.`tinymce` 
                SET tiny_mce_homes247=?,tiny_mce_backendpanel=?,tiny_mce_hrpanel=?
                WHERE IDPK=1";
        $this->db->query($sql,[$key,$key,$key]);
        return true;
    }
}