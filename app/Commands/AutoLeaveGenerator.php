<?php namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\EmployeeModel;

class AutoLeaveGenerator extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'leave:generate';
    protected $description = 'Automatically generates leaves for absent employees.';

    public function run(array $params)
    {
        $leaveModel = new EmployeeModel();
        $leaveModel->AutoLeaveGenerater();
        CLI::write('Auto Leave Generation Completed!', 'green');
    }
}
