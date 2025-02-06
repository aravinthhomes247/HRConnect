<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\EmployeeModel;
use App\Models\LogModel;
use App\Models\EventsModel;
use App\Models\LeaveReasonModel;
use App\Models\CandidateModel;
use App\Models\CareerModel;

use App\Models\InterviewersModel;
use App\Models\EmpBankDetailsModel;
// use App\Models\HRModel;

use CodeIgniter\Files\File;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\IOFactory;

use Dompdf\Dompdf;
use Dompdf\Options;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;

class HRController extends BaseController
{

    private $admin;
    private $session;
    private $careerModel;
    private $PhpMailer;
    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->admin = new AdminModel();
        $this->session = session();

        $this->db      = \Config\Database::connect();
        // $this->db1      = \Config\Database::connect($homesGroup);

        $this->careerModel = new CareerModel();
        $this->empModel = new EmployeeModel();
        $this->logModel = new LogModel();
        $this->eveModel = new EventsModel();
        $this->LRModel = new LeaveReasonModel();
        $this->candidateModel = new CandidateModel();


        $this->interviewerModel = new InterviewersModel();
        $this->empBankDetailsModel = new EmpBankDetailsModel();

        $this->PhpMailer = \Config\Services::email();
    }



    public function register()
    {
        return view('register');
    }

    /**
     * register
     */
    public function createAdmin()
    {
        $inputs = $this->validate(
            [
                'user_name' => 'required|min_length[5]',
                'admin_login_email' => 'required|valid_email|is_unique[admin_login.admin_login_email]',
                'admin_login_password' => 'required|min_length[5]'
            ]
        );

        if (!$inputs) {
            return view(
                'register',
                [
                    'validation' => $this->validator
                ]
            );
        }

        $this->admin->save(
            [
                'user_name' => $this->request->getVar('user_name'),
                'admin_login_email' => $this->request->getVar('admin_login_email'),
                'admin_login_password' => password_hash($this->request->getVar('admin_login_password'), PASSWORD_DEFAULT)
            ]
        );
        session()->setFlashdata('success', 'Success! registration completed.');
        return redirect()->to(site_url('/register'));
    }

    /**
     * login form
     */
    public function login()
    {
        return view('login');
    }

    /**
     * login validate
     */
    public function loginValidate()
    {
        $fdate = date("Y-m-d");
        $todate = date("Y-m-d");

        $email = $this->request->getVar('admin_login_email');
        $password = $this->request->getVar('admin_login_password');
        $user = $this->admin->where('admin_login_email', $email)->where('login_access', 1)->first();

        $employee = $this->empModel->where('EmployeeId', $user['EmpIDFK'])->select('Image, EmployeeName, EmployeeId')->first();
        $Desig = $this->empModel->getdesignationM($user['EmpIDFK']);
        // print_r([$user,$employee,$Desig]);exit(0);

        if ($user) {
            $pass = $user['admin_login_password'];
            if ($password == $pass) {
                $sessionData = [
                    'admin_login_IDPK' => $user['admin_login_IDPK'],
                    'EmpIDFK' => $user['EmpIDFK'],
                    'user_name' => $user['user_name'],
                    'user_level' => $user['user_level'],
                    'admin_login_email' => $user['admin_login_email'],
                    'loggedIn' => true,
                    'Image' => $employee['Image'],
                    'EmployeeName' => $employee['EmployeeName'],
                    'Designation' => $Desig[0]['designations'],
                ];
                if ($sessionData['user_level'] == 42) {
                    $this->session->set($sessionData);
                    return redirect()->to('dashboard');
                } elseif ($sessionData['user_level'] == 1 || $sessionData['user_level'] == 18) {
                    $this->session->set($sessionData);
                    return redirect()->to('HRdashboard?fdate=' . $fdate . '&todate=' . $todate);
                } elseif ($sessionData['user_level'] == 24) {
                    $this->session->set($sessionData);
                    return redirect()->to('HRdashboard?fdate=' . $fdate . '&todate=' . $todate);
                } else if (!empty($sessionData['user_level']) && isset($sessionData['user_level'])) {
                    $this->session->set($sessionData);
                    return redirect()->to('user-dashboard?fdate=' . $fdate . '&todate=' . $todate);
                } else {
                    session()->setFlashdata('failed', 'Failed! User not Allowed');
                    return redirect()->to(site_url('/login'));
                }
            }
            session()->setFlashdata('failed', 'Failed! incorrect password');
            return redirect()->to(site_url('/login'));
        }
        session()->setFlashdata('failed', 'Failed! incorrect email');
        return redirect()->to(site_url('/login'));
    }

    // public function loginValidate()
    // {
    //     $sId=1;
    //     $sName='HR Executive';
    //     $sEmail='hr@homes247.in';
    //     $sPassword='HR@247';
    //     // print_r($sName);print_r($sEmail);print_r($sPassword);exit();

    // 	$inputs = $this->validate([
    // 		'admin_login_email' => 'required|valid_email',
    // 		'admin_login_password' => 'required|min_length[5]'
    // 	]);

    // 	if (!$inputs) {
    // 		return view('login', [
    // 			'validation' => $this->validator
    // 		]);
    // 	}

    // 	$email = $this->request->getVar('admin_login_email');
    // 	$password = $this->request->getVar('admin_login_password');

    // 	$user = $sEmail == $email;
    // 	$user1 = $password == $sPassword;

    // 	if ($user && $user1) {
    // 		$pass = $user1 && $user;            
    // 		if ($pass) {
    // 			$sessionData = [
    //                 'sId'=>$sId,
    //                 'sName'=>$sName,   
    //                 'sEmail'=>$sEmail,                 
    // 				'admin_login_email' => $user,
    // 				'loggedIn' => true,
    // 			];

    // 			$this->session->set($sessionData);
    // 			return redirect()->to('dashboard');
    // 		}

    // 		session()->setFlashdata('failed', 'Failed! incorrect password');
    // 		return redirect()->to(site_url('/login'));
    // 	}else{
    //         session()->setFlashdata('failed', 'Failed! Invalid Credentials');
    // 		return redirect()->to(site_url('/login'));
    //     }

    // 	session()->setFlashdata('failed', 'Failed! incorrect email');
    // 	return redirect()->to(site_url('/login'));
    // }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('login');
    }

    // DashBoard Page Controllers 
    public function dashboard()
    {
        $date['fdate'] = $_GET['fdate'] ?? date('Y-m-d');
        $date['todate'] = $_GET['todate'] ?? date('Y-m-d');
        $data['badge'] = $_GET['badge'] ?? 0;
        $data['badge'] = ($data['badge'] == -1) ? 0 : $data['badge'];
        $data['count'] = count($this->empModel->allEmpsCountM());

        $logModel = new LogModel();
        $data['presents'] = count($logModel->presentslog());
        $data['absent'] = $data['count'] - $data['presents'];
        $data['lateComers'] = count($logModel->lateComerslog());
        $data['showHR'] = $this->empModel->getHR();
        $data['workAnniversaryDetailsTable'] = $this->empModel->workAnniversaryDetails();
        $data['birthdayDetailsTable'] = $this->empModel->birthdayDetails();
        $data['eventsDetailsTable'] = $this->empModel->eventsDetails();
        $data['abnormalDetails'] = $logModel->AbnormalListM($data);
        $data['leaves'] = $this->empModel->leaveDetails($data);
        $data['holidays'] = $this->admin->AttendanceHolidays($data['badge']);

        // print_r($data['presents']);exit(0);

        return view('dashboard', $data);
    }

    public function cronjobs(){
        $cron = $this->admin->cronjobs();
        if(!$cron){
            $this->admin->AutoRemoveHolidays();
            $this->empModel->autopayslipmaker();
            $this->empModel->AutoLeaveGenerater();
        }
        return $this->response->setJSON(['status' => 'success']);
    }

    function HRBasedDashboard()
    {
        $session = session();
        $data = [
            'fdate' => $_GET['fdate'] ?? date('Y-m-d'),
            'todate' => $_GET['todate'] ?? date('Y-m-d'),
            'HRid' => $_GET['HRid'],
            'userLevel' => $session->get('user_level'),
        ];
        $HRid = $_GET['HRid'];
        $this->admin->AutoRemoveHolidays();
        $candidateModel = new CandidateModel();
        $data['showHR'] = $this->empModel->getHR();
        $data['HRassignedCandidatesCount'] = count($candidateModel->getHRassignedCandidatesCount($HRid, $data));
        $data['HRscheduledCount'] = count($candidateModel->getHRscheduledCount($HRid, $data));
        $data['HRnotScheduledCount'] = count($candidateModel->getHRnotScheduledCount($HRid, $data));
        $data['HRtotalCandidatesCount'] = count($candidateModel->getHRCandidatesCount($HRid, $data));
        $data['HRSelectedCandidatesCount'] = count($candidateModel->getHRSelectedCandidatesCount($HRid, $data));
        $data['HRJoinedCandidatesCount'] = count($candidateModel->getHRJoinedCandidatesCount($HRid, $data));
        $data['HRrejectedCandidatesCount'] = count($candidateModel->getHRrejectedCandidatesCount($HRid, $data));

        $data['allCareerList'] = $this->careerModel->ShowAll($data);
        $data['workAnniversarys'] = $this->empModel->workAnniversaryDetails();
        $data['birthdays'] = $this->empModel->birthdayDetails();
        $data['events'] = $this->empModel->eventsDetails();

        return view('HRBasedDashboard', $data);
    }

    public function selecteddaterangeC()
    {
        $logModel = new LogModel();
        $data['badge'] = $_GET['badge'] ?? 0;
        $data['badge'] = ($data['badge'] == -1) ? 0 : $data['badge'];
        $data1 = ['fdate' => $_GET['fdate'] ?? date('Y-m-d'), 'todate' => $_GET['todate'] ?? date('Y-m-d')];

        $this->admin->AutoRemoveHolidays();
        $data['showHR'] = $this->empModel->getHR();
        $data['eventsDetailsTable'] = $this->empModel->eventsDetails();
        $data['count'] = count($this->empModel->allEmpsCountM());
        $data['birthdayDetailsTable'] = $this->empModel->birthdayDetails();
        $data['holidays'] = $this->admin->AttendanceHolidays($data['badge']);
        $data['workAnniversaryDetailsTable'] = $this->empModel->workAnniversaryDetails();
        $data['abnormalDetails'] = $logModel->AbnormalListM($data1);
        $data['leaves'] = $this->empModel->leaveDetails($data);

        // Presents 
        $data['presents'] = count($logModel->selectDRpresentsM($data1));
        // absents
        $data2['absent'] = count($logModel->selectDRabsentsM($data1));
        // LateComers 
        $data3['lateComers'] = count($logModel->selectDRlateComersM($data1));
        // print_r($data3['lateComers']);exit();

        $data = $data + $data1 + $data2 + $data3;
        return view('dashboard', $data);
    }

    public function presentsListC()
    {
        $data = [
            'LRID' => $_GET['LRID'] ?? 'NA',
            'fdate' => $_GET['fdate'],
            'todate' => $_GET['todate'],
            'trickid' => $_GET['trickid'] ?? 1,
        ];
        $logModel = new LogModel();

        $data['presentsdetailslog'] = $logModel->presentsListM($data);

        $data['presents'] = count($logModel->presentsListM($data));
        $data['absent'] = count($logModel->absentsListM($data));
        $data['countFilter'] = $logModel->filterCountM($data);

        return view('employees/presents_view', $data);
    }

    public function absentsListC()
    {
        $data = [
            'LRID' => $_GET['LRID'] ?? 0,
            'fdate' => $_GET['fdate'],
            'todate' => $_GET['todate'],
            'trickid' => $_GET['trickid'],
        ];

        $data1 = [
            'LRID' => $_GET['LRID'] ?? 0,
            'fdate' => $_GET['fdate'],
            'todate' => $_GET['todate'],
            'trickid' => 1,
        ];

        $logModel = new LogModel();

        $data['selectReason'] = $logModel->selectReasonM();
        $data['selectleavereason'] = $this->empModel->selectleaveReasonM();
        $data['absentsdetailslog'] = $logModel->absentsListM($data);
        $data['presents'] = count($logModel->presentsListM($data));
        $data['countFilter'] = $logModel->filterCountM($data);
        $data['absent'] = count($logModel->absentsListM($data1));
        return view('employees/absents_view', $data);
    }

    public function lateComersListC()
    {
        $data = [
            'fdate' => $_GET['fdate'],
            'todate' => $_GET['todate'],
        ];
        $logModel = new LogModel();
        $data['lateComersDetailsLog'] = $logModel->lateComersListM($data);
        $data['lateComers'] = count($logModel->lateComersListM($data));

        // print_r($data['lateComersDetailsLog']);exit();
        return view('employees/lateComers_view', $data);
    }


    // Events page Controllera 
    public function allevents()
    {
        $eveModel = new EventsModel();
        $data['alleventsDetailsTable'] = $eveModel->EventsDetails();
        return view('events/view_events', $data);
    }
    public function storeEvents()
    {
        $eventModel = new EventsModel();
        $data = [
            'EventName' => $this->request->getVar('EventName'),
            'EventDescription' => $this->request->getVar('EventDescription'),
            'EventDate' => $this->request->getVar('EventDate'),
            'Type' => $this->request->getVar('Type'),
        ];
        $eventModel->insert($data);
        return $this->response->redirect(site_url('/allevents'));
    }

    public function storeEvent()
    {
        $eventModel = new EventsModel();
        $data = [
            'EventName' => $this->request->getVar('EventName'),
            'EventDescription' => $this->request->getVar('EventDescription'),
            'EventDate' => $this->request->getVar('EventDate'),
            'Type' => $this->request->getVar('Type'),
        ];

        $eventModel->insert($data);
        return redirect()->back();
    }

    public function GetEvent($id)
    {
        $eventModel = new EventsModel();
        $data['event'] = $eventModel->EventDetails($id);
        // print_r($data['event']);exit(0);
        return $this->response->setJSON(['status' => 'success', 'files' => $data['event']]);
    }

    public function UpdateEvent()
    {
        $eventModel = new EventsModel();
        $data['EventId'] = $_POST['id'];
        $data['EventName'] = $_POST['EventName'];
        $data['EventDescription'] = $_POST['EventDescription'];
        $data['EventDate'] = $_POST['EventDate'];
        $data['Type'] = $_POST['Type'];
        $result = $eventModel->UpdateEvent($data);
        return $this->response->redirect(site_url('/allevents'));
    }

    public function DeleteEvent($id)
    {
        $eventModel = new EventsModel();
        $result = $eventModel->DeleteEvent($id);
        return $this->response->redirect(site_url('/allevents'));
    }


    // Employess pages controllers 
    public function workAnniversary()
    {

        $data['allworkAnniversaryDetailsTable'] = $this->empModel->allworkAnniversaryDetails();

        return view('employees/view_allWorkAnniersary', $data);
    }
    public function allbirthdays()
    {

        $data['allbirthdaysDetailsTable'] = $this->empModel->allBrirthdaysDetails();
        return view('employees/view_birthdays', $data);
    }

    public function allEmpslist()
    {
        $data = [
            'trickid' => $_GET['trickid'],
        ];


        $data['active'] = $this->empModel->activeCountM();
        $data['inactive'] = $this->empModel->inActiveCountM();
        $data['abscond'] = $this->empModel->abscondCountM();
        $data['allEmpCount'] = $this->empModel->allEmpCountM();
        $data['missing'] = $this->empModel->MissingSalaryCountM();

        $data['allEmpsList'] = $this->empModel->allEmpsListM($data);
        // $data['allEmpsList'] = $this->empModel->orderBy('EmployeeName', 'ASC')->findAll();
        return view('employees/emp_view', $data);
    }

    // public function attendanceListC()
    // {
    //     $data = [
    //         'fdate' => $_GET['fdate'],
    //         'todate' => $_GET['todate'],
    //     ];
    //     $logModel = new LogModel();

    //     $data['attendanceList'] = $logModel->attendanceListM($data);

    //     return view('employees/attendance_view', $data);
    // }

    public function createEmp()
    {
        $data['selectdesignation'] = $this->empModel->selectdesignationM();
        $data['selectdepart'] = $this->empModel->selectdepartM();
        $data['selectEmpType'] = $this->empModel->selectEmpTypeM();
        $data['Managers'] = $this->interviewerModel->getReportingManager();

        return view('employees/add_emp', $data);
    }

    public function check_EmpCode_availability()
    {
        $requestBody = json_decode($this->request->getBody());

        $EmpCode = $requestBody->EmpCode;

        if ('post' === $this->request->getMethod() && $EmpCode) {
            // $model = new UserModel();

            $result = $this->empModel->get_EmpCode($EmpCode);

            if ($result === true) {
                echo '<span style="color:red;">Employee Code already taken</span>';
            } else {
                echo '<span style="color:green;">Employee Code Available</span>';
            }
        } else {
            echo '<span style="color:red;">You must enter Employee Code</span>';
        }
    }

    public function storeEmp()
    {
        $file = $this->request->getFile('Image');
        if (empty($_FILES['Image']['name'])) {
            $imageName = "default.png";
        } elseif ($file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getClientName();
            $file->move('Uploads/ProfilePhotosuploads/', $imageName);
        }
        $EmpCode = $_POST['EmployeeCode'];
        $EmployementType = $_POST['EmployementType'];
        if ($EmployementType == 1) {
            $id = $EmpCode;
            $code = '';
        } else {
            $EmpCode = $_POST['EmployeeCode'];
            $id = substr($EmpCode, 7);
            $code = substr($EmpCode, 0, 7);
        }

        $data['Employee'] = [
            'StringCode' => $code,
            'NumericCode' => $id,
            'Image' => $imageName,
            'DOB' => $_POST['DOB'],
            'DOJ' => $_POST['DOJ'],
            'Email' => $_POST['Email'],
            'Gender' => $_POST['Gender'],
            'Status' => $_POST['Status'],
            'PAN_No' => $_POST['PAN_No'],
            'UAN_No' => $_POST['UAN_No'],
            'Aadhar_No' => $_POST['Aadhar_No'],
            'ContactNo' => $_POST['ContactNo'],
            'BLOODGROUP' => $_POST['BLOODGROUP'],
            'FatherName' => $_POST['FatherName'],
            'MotherName' => $_POST['MotherName'],
            'EContactNo' => $_POST['EContactNo'],
            'Salary_date' => $_POST['Salary_date'],
            'EmployeeName' => $_POST['EmployeeName'],
            'EmployeeCode' => $_POST['EmployeeCode'],
            'PlaceOfBirth' => $_POST['PlaceOfBirth'],
            'AltContactno' => $_POST['AltContactno'],
            'PersonalMail' => $_POST['PersonalMail'],
            'DepartmentId' => $_POST['DepartmentId'],
            'ContractPeriod' => $_POST['ContractPeriod'],
            'DesignationIDFK' => $_POST['DesignationIDFK'],
            'EmployementType' => $_POST['EmployementType'],
            'EmployeeCodeInDevice' => $_POST['EmployeeCode'],
            'PermanentAddress' => $_POST['PermanentAddress'],
            'ReportManagerIDFK' => $_POST['ReportManagerIDFK'],
            'ResidentialAddress' => $_POST['ResidentialAddress']
        ];

        $this->empModel->insert_employeesHomes($data['Employee']);
        $this->empModel->insert($data['Employee']);
        $EmployeeId = $this->db->insertID();

        $data['salary'] = [
            'EmployeeIDFK' => $EmployeeId,
            'PF' => $_POST['PF'] ?? 0,
            'PT' => $_POST['PT'] ?? 0,
            'Grativity' => $_POST['Grativity'] ?? 0,
            'HRA' => $_POST['HRA'] ?? 0,
            'FBP' => $_POST['FBP'] ?? 0,
            'PF_VOL' => $_POST['PF_VOL'] ?? 0,
            'Insurance' => $_POST['Insurance'] ?? 0,
            'NetSalary' => $_POST['NetSalary'] ?? 0,
            'BasicSalary' => $_POST['BasicSalary'] ?? 0,
            'GrossSalary' => $_POST['GrossSalary'] ?? 0
        ];
        $this->empModel->insertsalaryinfo($data['salary']);
        $data['official'] = [
            'EmployeeIDFK' => $EmployeeId,
            'Type' => 1,
            'Mode' => $_POST['O_Mode'],
            'IFSCode' => $_POST['O_IFSCode'],
            'BankName' => $_POST['O_BankName'],
            'AccountNo' => $_POST['O_AccountNo'],
            'BankBranch' => $_POST['O_BankBranch'],
            'AccountHolderName' => $_POST['O_AccountHolderName']
        ];
        $data['personal'] = [
            'EmployeeIDFK' => $EmployeeId,
            'Type' => 2,
            'Mode' => $_POST['P_Mode'],
            'IFSCode' => $_POST['P_IFSCode'],
            'BankName' => $_POST['P_BankName'],
            'AccountNo' => $_POST['P_AccountNo'],
            'BankBranch' => $_POST['P_BankBranch'],
            'AccountHolderName' => $_POST['P_AccountHolderName']
        ];
        $this->empModel->insertbankaccinfo($data['official']);
        $this->empModel->insertbankaccinfo($data['personal']);


        $Allfiles = $this->request->getFiles();
        $target_dir = "Uploads/employees/$EmployeeId/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $i = $j = 0;
        if ($Allfiles && count($Allfiles) > 0) {
            foreach ($Allfiles as $Catfiles) {
                if ($j != 0) {
                    if (isset($Catfiles) && count($Catfiles) > 0) {
                        foreach ($Catfiles as $file) {
                            if ($file->isValid() && !$file->hasMoved()) {
                                $originalFileName = $file->getClientName();
                                echo ("file= " . $originalFileName);
                                $filePath = $target_dir . $originalFileName;
                                $fileName = $originalFileName;
                                $pathInfo = pathinfo($originalFileName);
                                $name = $pathInfo['filename'];
                                $extension = isset($pathInfo['extension']) ? '.' . $pathInfo['extension'] : '';
                                $counter = 1;
                                while (file_exists($filePath)) {
                                    $fileName = $name . '_' . $counter++ . $extension;
                                    $filePath = $target_dir . $fileName;
                                }
                                $file->move($target_dir, $fileName);
                                $imagedata[$i++] = [
                                    'CandidateIDFK' => null,
                                    'EmployeeIDFK' => $EmployeeId,
                                    'Doc_CategoryIDFK' => $j,
                                    'Document_Name' => $fileName,
                                    'Type' => 2
                                ];
                            }
                        }
                    }
                }
                $j++;
            }
            if (isset($imagedata)) {
                $this->empModel->getEmployeeProFilesStore($imagedata);
            }
        }

        // print_r($data);exit(0);

        return $this->response->redirect(site_url('/totalEmps?trickid=1'));
    }
    public function singleEmployee($id = null)
    {
        $trickId = $_GET['trickId'] ?? 1;
        $date_start = $_GET['fsd'] ?? date('Y-m-d');
        $date_end = $_GET['fed'] ?? date('Y-m-d');
        $data['id'] = $id;
        $data['BasicDetails'] = $this->empModel->getEmployee($id);
        $data['Designations'] = $this->empModel->selectdesignationM();
        $data['Departments'] = $this->empModel->selectdepartM();
        $data['EmpTypes'] = $this->empModel->selectEmpTypeM();
        $data['Managers'] = $this->interviewerModel->getReportingManager();

        if ($trickId == 2) {
            $data['WorkDetails'] = $this->empModel->getEmployeeWorkDetails($id);
            return view('employees/employees/EmpProfWorkDetails', $data);
        } elseif ($trickId == 3) {
            $data['issuetypes'] = $this->empModel->GetIssueTypes();
            $data['Approvals'] = $this->empModel->getEmployeeApprovals($id);
            return view('employees/employees/EmpProfApprovals', $data);
        } elseif ($trickId == 4) {
            $data['Attendence'] = $this->empModel->getEmployeeAttendence($id, $date_start, $date_end);
            $data['TotalDays'] = $this->empModel->getEmployeeTotalWorkDays($id, $date_start, $date_end) ?? 0;
            $data['TotalAbsend'] = $this->empModel->getEmployeeTotalAbsend($id, $date_start, $date_end) ?? 0;

            $data['fsd'] = $date_start;
            $data['fed'] = $date_end;
            return view('employees/employees/EmpProfAttendence', $data);
        } elseif ($trickId == 5) {
            $data['LateEntry'] = $this->empModel->getEmployeeLateEntry($id, $date_start, $date_end);
            $data['fsd'] = $date_start;
            $data['fed'] = $date_end;
            return view('employees/employees/EmpProfLateEntry', $data);
        } elseif ($trickId == 6) {
            $data['TimeLogs'] = $this->empModel->getEmployeeTimeLogs($id, $date_start, $date_end);
            $data['fsd'] = $date_start;
            $data['fed'] = $date_end;
            return view('employees/employees/EmpProfTimeLogs', $data);
        } elseif ($trickId == 7) {
            $data['PaySlip'] = $this->empModel->getEmployeePaySlip($id);
            $data['mode'] = $this->admin->getSettingsSpecific('payrol-function');
            $data['mode'] = $data['mode']['Value'];
            return view('employees/employees/EmpProfPaySlip', $data);
        } elseif ($trickId == 8) {
            $data['Files'] = $this->empModel->getEmployeeFiles($id,2);
            return view('employees/employees/EmpProfFiles', $data);
        } else {
            return view('employees/employees/EmpProfBasicProfile', $data);
        }
    }

    public function Uploadfiles($type)
    {
        $canId = $this->request->getPost('empid');
        $canName = $this->request->getPost('empname');
        $cat = $this->request->getPost('cat');
        $target_dir1 = "Uploads/candidates/$canId/";
        $target_dir2 = "Uploads/employees/$canId/";
        if ($type == 1) {
            $target_dir = $target_dir1;
        } else {
            $target_dir = $target_dir2;
        }

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $i = 1;
        $files = $this->request->getFileMultiple('files');
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $originalFileName = $file->getClientName();
                    $filePath = $target_dir . $originalFileName;
                    $fileName = $originalFileName;
                    $pathInfo = pathinfo($originalFileName);
                    $name = $pathInfo['filename'];
                    $extension = isset($pathInfo['extension']) ? '.' . $pathInfo['extension'] : '';
                    $counter = 1;
                    while (file_exists($filePath)) {
                        $fileName = $name . '_' . $counter++ . $extension;
                        $filePath = $target_dir . $fileName;
                    }
                    $file->move($target_dir, $fileName);
                    $data[$i++] = [
                        'EmployeeIDFK' => $canId,
                        'Doc_CategoryIDFK' => $cat,
                        'Document_Name' => $fileName,
                        'Type' => $type
                    ];
                } else {
                    echo "Error uploading file: " . $file->getErrorString();
                }
            }
            $store = $this->empModel->getEmployeeProFilesStore($data);
            // Optionally return the data array as JSON
            return $this->response->setJSON(['status' => 'success', 'files' => $data]);
        } else {
            // echo "No files were uploaded.";
        }
    }
    public function Removefiles($type)
    {
        $id = $this->request->getPost('id');
        $canId = $this->request->getPost('empid');

        $target_dir1 = "Uploads/candidates/$canId/";
        $target_dir2 = "Uploads/employees/$canId/";
        if ($type == 1) {
            $remove = $this->empModel->getEmployeeProFilesRemove($id, $target_dir1);
        } else {
            $remove = $this->empModel->getEmployeeProFilesRemove($id, $target_dir2);
        }
    }
    public function Replacefiles($type)
    {
        $id = $this->request->getPost('id');
        $cat = $this->request->getPost('cat');
        $canId = $this->request->getPost('empid');
        $target_dir1 = "Uploads/candidates/$canId/";
        $target_dir2 = "Uploads/employees/$canId/";
        if ($type == 1) {
            $target_dir = $target_dir1;
            $remove = $this->empModel->getEmployeeProFilesRemove($id, $target_dir1);
        } else {
            $target_dir = $target_dir2;
            $remove = $this->empModel->getEmployeeProFilesRemove($id, $target_dir2);
        }
        // $remove = $this->empModel->getEmployeeProFilesRemove($id, $target_dir);

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $i = 1;
        if ($file = $this->request->getFile('file')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $originalFileName = $file->getClientName();
                $filePath = $target_dir . $originalFileName;
                $fileName = $originalFileName;
                $pathInfo = pathinfo($originalFileName);
                $name = $pathInfo['filename'];
                $extension = isset($pathInfo['extension']) ? '.' . $pathInfo['extension'] : '';
                $counter = 1;
                while (file_exists($filePath)) {
                    $fileName = $name . '_' . $counter++ . $extension;
                    $filePath = $target_dir . $fileName;
                }
                $file->move($target_dir, $fileName);
                $data[$i++] = [
                    'EmployeeIDFK' => $canId,
                    'Doc_CategoryIDFK' => $cat,
                    'Document_Name' => $fileName,
                    'Type' => $type
                ];
            } else {
                echo "Error uploading file: " . $file->getErrorString();
            }
            $store = $this->empModel->getEmployeeProFilesStore($data);
            // Optionally return the data array as JSON
            return $this->response->setJSON(['status' => 'success', 'files' => $data]);
        } else {
            // echo "No files were uploaded.";
        }
    }

    public function payrolls()
    {
        $data['fdate'] = $_GET['fdate'] ?? date('Y-m-d');
        $data['trickid'] = $_GET['trickid'] ?? 1;
        $data['mode'] = $this->admin->getSettingsSpecific('payrol-function');
        $data['mode'] = $data['mode']['Value'];
        $results = $this->empModel->getAllPayslips($data);
        $data['payslips'] = $results['results'];
        $data['state0'] = $results['mode0'];
        $data['state1'] = $results['mode1'];
        $data['state2'] = $results['mode2'];
        $data['trick1_count'] = $results['trick1_count'];
        $data['trick2_count'] = $results['trick2_count'];
        return view('report/payrolls', $data);
    }

    public function payroll_edit($id)
    {
        $data = $this->empModel->getPayslip($id);
        return $this->response->setJSON(['status' => 'success', 'files' => $data]);
    }

    public function DownloadPayslipExcel()
    {
        $data['trickid'] = $_GET['trickid'];
        $data['fdate'] = $_GET['fdate'];
        $this->empModel->DownloadPayslipExcel($data);
        return true;
    }

    public function payroll_update()
    {
        $fdate = $_POST['fdate'] ?? date('Y-m-d');
        $trickid = $_POST['trickid'] ?? 1;

        $id = $_POST['id'];
        $data['LOP'] = $_POST['LOP'];
        $data['Acc_Type'] = $_POST['Acc_Type'];
        $data['Basic'] = $_POST['Basic'];
        $data['Gross'] = $_POST['Gross'];
        $data['HRA'] = $_POST['HRA'];
        $data['FBP'] = $_POST['FBP'];
        $data['SD1'] = $_POST['SD1'];
        $data['PF'] = $_POST['PF'];
        $data['PT'] = $_POST['PT'];
        $data['PFVOL'] = $_POST['PFVOL'];
        $data['SD2'] = $_POST['SD2'];
        $data['Insurance'] = $_POST['Insurance'];
        $data['Net_salary'] = $_POST['Net_salary'];
        $data['Status'] = 1;

        $this->empModel->UpdatePayslip($id, $data);
        return $this->response->redirect(site_url('/payrolls?trickid=' . $trickid . '&fdate=' . $fdate));
    }

    public function payroll_save()
    {
        $data['fdate'] = $_GET['fdate'];
        $data['trickid'] = $_GET['trickid'];
        $this->empModel->PayslipManualSave($data);
        return true;
    }

    public function payslipDownload($payslipid)
    {
        $Res = $this->empModel->getEmployeePaySlipSpecific($payslipid);

        $date = date('d-m-Y', strtotime($Res['Date']));
        $date = \DateTime::createFromFormat("d-m-Y", $date);
        $maxDays = $date->format("t");

        $data['EmpID'] = $Res['EmployeeCode'] ?? '-';
        $data['PFNo'] = $Res['PF_No'] ?? '-';
        $data['NOD'] = $maxDays ?? '-';
        $data['Designation'] = $Res['designations'] ?? '-';
        $data['AcNo'] = $Res['AccountNo'] ?? '-';
        $data['ModeofPay'] = $Res['Mode'] ?? 1;
        $data['LOP'] = $Res['LOP'] ?? 0;
        $data['EmployeeName'] = $Res['EmployeeName'] ?? '-';
        $data['ESINo'] = $Res['ESI_No'] ?? '-';
        $data['DOJ'] = $Res['DOJ'] ?? '-';
        $data['Department'] = $Res['deptName'] ?? '-';
        $data['PAN'] = $Res['PAN_No'] ?? '-';
        $data['UANNo'] = $Res['UAN_No'] ?? '-';
        $data['BASIC'] = $Res['Basic'] ?? 0.00;
        $data['HRA'] = $Res['HRA'] ?? 0.00;
        $data['FBP'] = $Res['FBP'] ?? 0.00;
        $data['SpecialEarnings'] = $Res['SD1'] ?? 0.00;
        $data['PF'] = $Res['PF'] ?? 0.00;
        $data['PT'] = $Res['PT'] ?? 0.00;
        $data['PFVoluntary'] = $Res['PFVOL'] ?? 0.00;
        $data['TDS'] = $Res['TDS'] ?? 0.00;
        $data['Insurance'] = $Res['Insurance'] ?? 0.00;
        $data['SpecialDeductions'] = $Res['SD2'] ?? 0.00;
        $data['Credited_Salary'] = $Res['Net_salary'] ?? '-';
        $data['Date'] = $Res['Date'] ?? '-';

        // return view('report/payslip_format',$data);

        $NAME = $data['EmpID'] . '-' . date('F-Y', strtotime($data['Date'])) . '.pdf';
        $html = view('report/payslip_format', $data);
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($NAME, array("Attachment" => 1)); // 1 for download, 0 to view in browser
    }

    public function editEmpProfile($id = null)
    {
        $data['emp_obj'] = $this->empModel->where('EmployeeId', $id)->first();
        $data['selectdesignation'] = $this->empModel->selectdesignationM();
        $data['selectdepart'] = $this->empModel->selectdepartM();
        $data['selectEmpType'] = $this->empModel->selectEmpTypeM();
        $desname = $data['emp_obj']['DesignationIDFK'];
        $data['showdesignation'] = $this->empModel->getdesignationM($desname);
        // print_r($data['showdesignation']);exit();
        return view('employees/editProfile_view', $data);
    }
    // update Emp data
    public function updateEmp()
    {

        $EmployeeId = $this->request->getVar('EmployeeId');
        $data['emp_obj'] = $this->empModel->where('EmployeeId', $EmployeeId)->first();

        $oldimgName = $data['emp_obj']['Image'];

        // print_r($data['emp_obj']['Image']);exit();

        // if ($file->isValid() && ! $file->hasMoved()) {
        //     $imageName = $file->getClientName();
        //     $file->move('Uploads/ProfilePhotosuploads/',$imageName);
        // }


        $file = $this->request->getFile('Image');
        if ($file->isValid() && !$file->hasMoved()) {
            if (!file_exists('Uploads/ProfilePhotosuploads/' . $oldimgName)) {
                unlink('Uploads/ProfilePhotosuploads/' . $oldimgName);
            }
            $imageName = $file->getClientName();
            $file->move('Uploads/ProfilePhotosuploads/', $imageName);
        } else {
            $imageName =  $oldimgName;
        }
        $EmpCode = $this->request->getPost('EmployeeCode');
        $EmployementType = $this->request->getPost('EmployementType');

        if ($EmployementType == 1) {
            $EmployeeCode = $this->request->getPost('EmployeeCode');
            $id = $EmpCode;
            $code = '';
        } else {
            $EmpCode = $this->request->getPost('EmployeeCode');
            $id = substr($EmpCode, 7);
            $code = substr($EmpCode, 0, 7);
        }


        $data = [
            // 'EmployeeId' => $this->request->getVar('EmployeeId'),
            'EmployeeName' => $this->request->getVar('EmployeeName'),
            'EmployeeCode' => $this->request->getVar('EmployeeCode'),
            'EmployeeCodeInDevice' => $this->request->getPost('EmployeeCode'),
            'StringCode' => $code,
            'NumericCode' => $id,
            'Gender' => $this->request->getVar('Gender'),
            'DOB' => $this->request->getVar('DOB'),
            'ContactNo' => $this->request->getVar('ContactNo'),
            'AltContactno' => $this->request->getVar('AltContactno'),
            'Email' => $this->request->getVar('Email'),
            'PersonalMail' => $this->request->getVar('PersonalMail'),
            'PlaceOfBirth' => $this->request->getVar('PlaceOfBirth'),
            'BLOODGROUP' => $this->request->getVar('BLOODGROUP'),
            'FatherName' => $this->request->getVar('FatherName'),
            'MotherName' => $this->request->getVar('MotherName'),
            'ResidentialAddress' => $this->request->getVar('ResidentialAddress'),
            'PermanentAddress' => $this->request->getVar('PermanentAddress'),
            'DepartmentId' => $this->request->getVar('DepartmentId'),
            'DesignationIDFK' => $this->request->getVar('DesignationIDFK'),
            'Status' => $this->request->getVar('Status'),
            'EmployementType' => $this->request->getVar('EmployementType'),
            'DOJ' => $this->request->getVar('DOJ'),
            'DOR' => $this->request->getVar('DOR'),
            'LeaveReason' => $this->request->getVar('LeaveReason'),
            'Image'  => $imageName,

        ];
        // print_r($EmployeeId);exit();
        $this->empModel->update_employeesHomes($data, $EmployeeId);
        $save = $this->empModel->update($EmployeeId, $data);
        // print_r($save);exit();
        return $this->response->redirect(site_url('/totalEmps?trickid=1'));
    }



    // Employee Bank Account Details 
    public function insert_empBankDetailsC()
    {

        $id = $this->request->getVar('EmployeeIDFK');

        $data = [
            'EmployeeIDFK' => $this->request->getVar('EmployeeIDFK'),
            'AccountHolderName' => $this->request->getVar('AccountHolderName'),
            'BankName' => $this->request->getVar('BankName'),
            'AccountNo' => $this->request->getVar('AccountNo'),
            'IFSCode' => $this->request->getVar('IFSCode'),
            'BankBranch' => $this->request->getVar('BankBranch'),

        ];
        $data['empBank'] = $this->empBankDetailsModel->where('EmployeeIDFK', $id)->first();

        // print_r($data['empBank']['EmployeeIDFK']);exit();

        if (empty($data['empBank']['EmployeeIDFK'])) {
            $this->empBankDetailsModel->insert($data);
        } elseif (!empty($data['empBank']['EmployeeIDFK'])) {
            $this->empBankDetailsModel->update($id, $data);
        }


        // return view('employees/edit_view');
        echo "<script>window.history.go(-1)</script> ";
    }

    // added absent leaveReason 
    public function createLR($id, $AbsentDate)
    {

        $LRModel = new LeaveReasonModel();
        $data['selectleavereason'] = $this->empModel->selectleaveReasonM();
        $data['showAbsentEmpDetails'] = $this->empModel->showAbsentEmpM($id, $AbsentDate);
        $data['EmpLeaveTaken'] = $this->empModel->getEmpLeaveTaken($id);

        return $this->response->setJSON($data);
        // return view('employees/addReason_view', $data);
    }
    public function storeLeavereason()
    {
        $LRModel = new LeaveReasonModel();
        $data['id'] = $_SESSION['EmpIDFK'];
        if ($data['id']) {
            $data1 = [
                'Mail_TypeId' => 2,
                'SenderId' => $this->request->getVar('EmployeeId'),
                'ReceiverId' => $_SESSION['EmpIDFK'],
                'Mail_Msg' => $this->request->getVar('Reason'),
            ];
            $data2 = [
                'leaveReasonIDFK' => $this->request->getVar('LeaveReason'),
                'EmployeeIDFK' => $this->request->getVar('EmployeeId'),
                'absentDate' => $this->request->getVar('AbsentDate'),
            ];

            $save = $LRModel->addReasons($data1, $data2);

            // echo "<script>window.history.go(-2)</script> ";

            return $this->response->redirect(site_url('/absents?trickid=1&LRID=0&fdate=' . date('Y-m-d') . '&todate=' . date('Y-m-d')));
        } else {
            redirect()->to('login');
        }
    }
    public function leaveHistory($id, $AbsentDate)
    {
        $LRModel = new LeaveReasonModel();
        $data['showAbsentEmpDetails'] = $this->empModel->showAbsentEmpM($id, $AbsentDate);
        $data['EmpLeaveTaken'] = $this->empModel->getEmpLeaveTaken($id);
        return view('employees/leaveHistory_view', $data);
    }
    public function editViewLRC($id, $AbsentDate, $idpk)
    {
        $data['selectleavereason'] = $this->empModel->selectleaveReasonM();
        $data['showAbsentEmpDetails'] = $this->empModel->showAbsentEmpM($id, $AbsentDate);
        $data['EmpLeaveTaken'] = $this->empModel->getEmpLeaveTaken($id, $idpk);
        $data['ALRid'] = $this->empModel->getEmpALRid($id, $idpk);
        return $this->response->setJSON($data);

        // return view('employees/editReason_view', $data);
    }
    public function updateLR()
    {
        $IDPK = $this->request->getVar('IDPK');
        $LRModel = new LeaveReasonModel();
        $data = [
            'IDPK' => $this->request->getVar('IDPK'),
            'Mail_IDPK' => $this->request->getVar('Mail_IDPK'),
            'leaveReasonIDFK' => $this->request->getVar('LeaveReason'),
            'Mail_Msg' => $this->request->getVar('Reason'),
        ];
        $LRModel->editReasons($data);

        // echo "<script>window.history.go(-3)</script> ";

        return redirect()->back();
    }

    // Delete Employee
    // public function delete($EmployeeId = null){      
    //     $data['empdet'] = $this->empModel->where('EmployeeId', $EmployeeId)->delete($EmployeeId);
    //     return $this->response->redirect(site_url('/totalEmps'));
    // }

    // Employees Report pages Controllers 
    public function logHistory()
    {
        $data1 = [
            'fdate' => $_GET['fdate'],
            'todate' => $_GET['todate'],
            'empid' => $_GET['empid'],
        ];

        // print_r($data1['empid']);
        $logModel = new LogModel();
        // $data1['empLog'] = $data1['empid'];        
        $data1['empLog'] = $logModel->getEmpAllLog($data1);
        // print_r($data1['empLog']);exit;

        return view('report/empReport_view', $data1);
    }
    public function latecomingHistory()
    {
        $data1 = [
            'fdate' => $_GET['fdate'],
            'todate' => $_GET['todate'],
            'empid' => $_GET['empid'],
            'trickid' => $_GET['trickid'],
        ];

        // print_r($data1['empid']);exit();
        $logModel = new LogModel();
        // $data1['empLog'] = $data1['empid'];        
        $data1['empLatecomer'] = $logModel->getEmpAllLateComing($data1);
        // print_r($data1['empLatecomer']);exit;

        return view('report/empLCReport_view', $data1);
    }
    public function reportSearchAllLog()
    {
        $data1 = [
            'fdate' => $_GET['fdate'] ?? date('Y-m-d'),
            'todate' => $_GET['todate'] ?? date('Y-m-d'),
            'trickid' => $_GET['trickid'] ?? 1,
        ];

        $logModel = new LogModel();
        $data1['lateComers'] = count($logModel->lateComersListM($data1)) ?? 0;
        $data1['earlylogout'] = count($logModel->EarlyoutListM($data1)) ?? 0;
        $data1['abnormal'] = count($logModel->AbnormalListM($data1)) ?? 0;

        if ($data1['trickid'] == 1) {
            $data1['selectedemps'] = $logModel->getSearchAllLog($data1);
        }
        if ($data1['trickid'] == 2) {
            $data1['lateComersDetailsLog'] = $logModel->lateComersListM($data1);
        }
        if ($data1['trickid'] == 3) {
            $data1['earlylogoutDetails'] = $logModel->EarlyoutListM($data1);
        }
        if ($data1['trickid'] == 4) {
            $data1['abnormalDetails'] = $logModel->AbnormalListM($data1);
        }

        return view('report/report_view', $data1);
    }

    public function reportSearchAllLogDia()
    {
        $id = $_GET['id'];
        $data = [
            'fdate' => $_GET['fdate'] ?? date('Y-m-d'),
            'todate' => $_GET['todate'] ?? date('Y-m-d'),
            'trickid' => 1,
        ];
        $logModel = new LogModel();
        $data['lateComers'] = count($logModel->lateComersListM($data)) ?? 0;
        $data['earlylogout'] = count($logModel->EarlyoutListM($data)) ?? 0;
        $data['abnormal'] = count($logModel->AbnormalListM($data)) ?? 0;
        $data['TimeLogs'] = $this->empModel->getEmployeeTimeLogs($id, $data['fdate'], $data['todate']);
        $data['selectedemps'] = $logModel->getSearchAllLog($data);
        $userids = [];
        foreach ($data['selectedemps'] as $user) {
            if (!in_array($user['EmployeeId'], $userids)) {
                $userids[] = $user['EmployeeId'];
            }
            if ($user['EmployeeId'] == $id) {
                $data['EmpName'] = $user['name'];
                $data['EmpDesig'] = $user['designations'];
            }
        }
        $position = array_search($id, $userids);
        $data['PrevEmp'] = $userids[$position - 1] ?? 0;
        $data['NextEmp'] = $userids[$position + 1] ?? 0;
        $data['EmpID'] = $id;
        return view('report/report_view_dia', $data);
    }

    public function LeaveRequestListC()
    {
        $data = [
            'fdate' => $_GET['fdate'],
            'todate' => $_GET['todate'],
            'trickid' => $_GET['trickid'],
        ];
        $data['selectleavereason'] = $this->empModel->selectleaveReasonM();
        $data['leaveRequest'] = $this->empModel->getLeaveRequest($data);
        $data['allLrCount'] = $this->empModel->allLRCountM($data);
        $data['approveLrCount'] = $this->empModel->approveLRCountM($data);
        $data['rejectLrCount'] = $this->empModel->rejectLRCountM($data);
        $data['pendingLrCount'] = $this->empModel->pendingLRCountM($data);
        return view('employees/leaveRequest_view', $data);
    }
    public function ReadLeaveRequestC($id)
    {
        // $data['selectleavereason'] = $this->empModel->selectleaveReasonM();
        $data['empleaveRequest'] = $this->empModel->getEmpLeaveRequest($id);
        $data['empleaveReply'] = $this->empModel->getEmpLeaveReply($id);
        // print_r($data['empleaveReply']);exit();
        return view('employees/leaveRequestRead_view', $data);
    }
    public function storeLeaveRequestReply()
    {
        $LRModel = new LeaveReasonModel();
        $data = [
            // 'LeaveRequestDate' => $this->request->getVar('LeaveRequestDate'),               
            'IDPK' => $this->request->getVar('IDPK'),
            'approve' => $this->request->getVar('approve'),
            'Mail_Base_IDFK' => $this->request->getVar('Mail_Base_IDFK'),
            'SenderId' => $this->request->getVar('SenderId'),
            'ReceiverId' => $this->request->getVar('ReceiverId'),
            'Mail_Reply_Msg' => $this->request->getVar('Mail_Reply_Msg'),
        ];
        $save = $LRModel->updateLeaveRequestReply($data);
        echo "<script>window.history.go(-1)</script> ";
        // return $this->response->redirect(site_url('/leaveRequest'));  
    }

    public function storehrReply()
    {
        // print_r($id);exit(); 
        $LRModel = new LeaveReasonModel();

        $data = [
            'Mail_Base_IDFK' => $this->request->getVar('Mail_Base_IDFK'),
            'SenderId' => $this->request->getVar('SenderId'),
            'ReceiverId' => $this->request->getVar('ReceiverId'),
            'Mail_Reply_Msg' => $this->request->getVar('ReplyMsg1'),
        ];
        // print_r($data);exit();
        $save = $LRModel->addLrReply($data);
        echo "<script>window.history.go(-1)</script> ";
    }

    // public function storeLeaveRequest(){ 
    //     // print_r($id);exit(); 
    //     $LRModel = new LeaveReasonModel();          

    //     $data = [          
    //         'EmployeeIDFK' => $this->request->getVar('EmployeeIDFK'),               
    //         'EmployeeCodeFK' => $this->request->getVar('EmployeeCodeFK'),               
    //         'absentDate' => $this->request->getVar('absentDate'),               
    //         'LeaveReasonIDFK'  => $this->request->getVar('LeaveReasonIDFK'),    
    //         'Reason'  => $this->request->getVar('Reason'),               
    //     ];
    //     $save = $LRModel->addLeaveRequest($data);
    //     echo "<script>window.history.go(-1)</script> ";
    // }

    public function MailBoxC()
    {

        $data = [
            'fdate' => $_GET['fdate'],
            'todate' => $_GET['todate'],
            'trickid' => $_GET['trickid'],
            'deptsid' => $_GET['deptsid'],
        ];
        $hrId = $_SESSION['EmpIDFK'];
        // print_r($data['deptsid']);exit();



        if ($data['trickid'] == 1) {
            $data['selectleavereason'] = $this->empModel->selectleaveReasonM();
            $data['leaveRequest'] = $this->empModel->getLeaveRequest($data);
            // $data['allLrCount'] = $this->empModel->allLRCountM($data);
            // $data['approveLrCount'] = $this->empModel->approveLRCountM($data);
            // $data['rejectLrCount'] = $this->empModel->rejectLRCountM($data);
            // $data['pendingLrCount'] = $this->empModel->pendingLRCountM($data);
        } elseif ($data['trickid'] == 2 || $data['deptsid'] >= 1 || $data['deptsid'] == 'all') {
            $data['selectdepart'] = $this->empModel->selectdepartM();
            $data['mailempselect'] = $this->empModel->mailEmpSelect($data);
        } elseif ($data['trickid'] == 3) {

            $data['HRSentBox'] = $this->empModel->HR_sent_box($data, $hrId);
            // print_r($data['HR_sent_box']);exit();
        }



        return view('MailBox/MailBox_View', $data);
    }

    function get_Emp_autocompleteC()
    {
        $request = service('request');
        $postData = $request->getPost();
        $response = array();
        // Read new token and assign in $response['token']
        $response['token'] = csrf_hash();
        $data = array();
        if (isset($postData['search'])) {
            $search = $postData['search'];
            // Fetch record

            $empList = $this->empModel->select('EmployeeId,EmployeeName,Email')->like('Email', $search)->orderBy('Email')->findAll();
            // print_r($empList);exit();
            foreach ($empList as $emp) {
                $data[] = array(
                    "value" => $emp['EmployeeId'],
                    "label" => $emp['Email'],
                );
            }
        }
        $response['data'] = $data;
        return $this->response->setJSON($response);
    }

    function insert_HRcompose()
    {
        $data['id'] = $_SESSION['EmpIDFK'];
        $LRModel = new LeaveReasonModel();
        $data = [
            'SenderId' => $_SESSION['EmpIDFK'],
            'ReceiverId' => $this->request->getVar('ReceiverId'),
            'Mail_Msg' => $this->request->getVar('replyMsg'),
        ];
        $i = 0;
        // foreach($data['ReceiverId'] as $key){
        //     print_r($data['ReceiverId']);
        //     $i++;
        // }
        // exit();
        $save = $LRModel->addHRMail($data);
        // return view('MailBox/MailBox_View',$data);
        return $this->response->redirect(site_url('/mailBox?fdate=&todate=&trickid=1'));
    }

    public function Read_MailC()
    {
        $data = [
            'trickid' => $_GET['trickid'],
            'mailId' => $_GET['mailId'],
        ];
        $hrId = $_SESSION['EmpIDFK'];
        if ($data['trickid'] == 1) {
            $data['empleaveRequest'] = $this->empModel->getEmpLeaveRequest($data);
            $data['empleaveReply'] = $this->empModel->getEmpLeaveReply($data);
            // print_r($data['empleaveRequest']);exit();
        } elseif ($data['trickid'] == 2) {
            $data['HRSentBox'] = $this->empModel->HR_readsent_box($data, $hrId);
            // $data['empleaveRequest'] = $this->empModel->getEmpLeaveRequest($data);
            // $data['empleaveReply'] = $this->empModel->getEmpLeaveReply($data);
            // print_r($data['empleaveRequest']);exit();
        }
        return view('MailBox/ReadMail_View', $data);
    }


    // Stars interviewers list 
    public function interviewers_listC()
    {

        $data['select_interviewer'] = $this->interviewerModel->select_interviewerM();
        $data['interviewerList'] = $this->interviewerModel->interviewer_listM();

        return view('candidates/interviewers_list_view', $data);
    }

    public function store_interviewerC()
    {
        $interviewerModel = new InterviewersModel();
        $data = [
            'InterviewerIDFK' => $this->request->getPost('InterviewerIDFK') ?? 0,
        ];
        if ($data['InterviewerIDFK'] != 0) {
            $interviewerModel->insert($data);
        }
        return $this->response->redirect(site_url('/interviewers_list'));
    }

    public function delete_interviewerC($id)
    {
        // print_r($id);exit();

        $interviewerModel = new InterviewersModel();
        $interviewerModel->where('InterviewerIDFK', $id);
        $interviewerModel->delete();
        return $this->response->redirect(site_url('/interviewers_list'));
    }





    //*******************************************// Starts Candidates //***********************************************************************//

    // public function candidate_ListC()
    // {
    //     $session = session();
    //     $adminId = $session->get('EmpIDFK');
    //      // print_r($adminId);exit();
    //     $data = [
    //         'trickid' => $_GET['trickid'],
    //         'fdate' => $_GET['fdate'],
    //         'todate' => $_GET['todate'],
    //     ];


    //     $data['totalCountList'] = $this->candidateModel->TotatCount_List_CandidatesM($data);

    //     $data['candidate_list'] = $this->candidateModel->List_CandidatesM($data);
    //     // print_r($data['candidate_list']);exit();

    //     $data['candidateStatus_list'] = $this->candidateModel->getCandidateInterviewStatusM($data);
    //     $data['candiadtecounts'] = $this->candidateModel->CandidateCountsM($data);


    //     $data['notScheduledList'] = $this->candidateModel->getNotScheduledList($data);
    //     $data['freshList'] = $this->candidateModel->getFreshList($data);

    //     $data['socialMedia'] = $this->candidateModel->Candidate_Source_ListM();

    //     $data['yetToAssignCount'] = $this->candidateModel->getYettoAssignListCount($adminId);
    //     $data['HRList'] = $this->empModel->getHRList();
    //     $data['adminId'] = $this->empModel->getHRadminList();

    //     // $sourceId = $_POST['sourceId'];
    //     // // print_r($sourceId);exit();
    //     // $data['sourceCount'] = $this->candidateModel->getSourceCount($sourceId);


    //     $data['candidateOfferStatus_list'] = $this->candidateModel->getCandidateOfferStatusM($data);
    //     // print_r($data['notScheduledList']); exit();


    //     return view('candidates/candidates_list_view', $data);
    // }
    // public function todays_candidate_activityC(){

    //     $data = [
    //         'trickid' => $_GET['trickid'],
    //         'HR_IDFK' => $_GET['HR_IDFK'],
    //     ];

    //     $data['showHR'] = $this->empModel->getHR();
    //     // print_r($data['showHR']); exit();
    //     $data['curentDayActivity'] = $this->candidateModel->getCurrentdayActivity($data);
    //     $data['curentDayCount'] = $this->candidateModel->getCurrentdayCount($data);

    //     return view('candidates/todays_candidate_activity',$data);
    // }

    public function add_candidateC()
    {


        $data['selectdesignation'] = $this->empModel->selectdesignationM();
        $data['socialMedia'] = $this->candidateModel->Candidate_Source_ListM();
        $data['notScheduleReasons'] = $this->candidateModel->notschedule_reasons_ListM();
        // print_r($data['notScheduleReasons']);exit();


        return view('candidates/add_new_candidate', $data);
    }
    function get_Candidate_autocompleteC()
    {
        $request = service('request');
        $postData = $request->getPost();
        $response = array();
        // Read new token and assign in $response['token']
        $response['token'] = csrf_hash();
        $data = array();
        if (isset($postData['search'])) {
            $search = $postData['search'];
            // Fetch record
            // $arr = ['CandidateContactNo'=>$search, 'CandidateName'=>$search];
            $empList = $this->candidateModel->select('CandidateId,CandidateName,CandidateContactNo,ScheduleStatus,Created_at,CallBackDateTime')->like('CandidateContactNo', $search)->orLike('CandidateName', $search)->orderBy('CandidateContactNo')->findAll();
            // print_r($empList);exit();
            foreach ($empList as $emp) {
                $fdate = date('Y-m-d', strtotime($emp['Created_at']));
                $callback = date('Y-m-d', strtotime($emp['CallBackDateTime']));
                $data[] = array(
                    "value" => $emp['CandidateId'],
                    "label" => $emp['CandidateName'],
                    "schedulestatus" => $emp['ScheduleStatus'],
                    "fdate" => $fdate,
                    "callback" => $callback,
                );
            }
        }
        $response['data'] = $data;
        return $this->response->setJSON($response);
    }
    public function insert_candidateC()
    {
        $session = session();
        // 'HR_IDFK' => $session->get('EmpIDFK'),
        $fdate = date("Y-m-d");
        $todate = date("Y-m-d");

        $callBack = $this->request->getPost('CallBackDateTime');
        if (empty($callBack)) {
            $callBackdb = date('Y-m-d H:i:s');
        } else {
            $callBackdb = $callBack;
        }

        $file = $this->request->getFile('Resumefileinput');
        if ($file->isValid() && !$file->hasMoved()) {
            $originalFileName = $file->getClientName();
        } else {
            $originalFileName = 'NA';
        }

        $data = [
            'CandidateName' => $this->request->getPost('CandidateName'),
            'HR_IDFK' => $session->get('EmpIDFK'),
            'CandidateContactNo' => $this->request->getPost('CandidateContactNo'),
            'CandidateEmail' => $this->request->getPost('CandidateEmail'),
            'Source' => $this->request->getPost('Source'),
            'scheduled' => $this->request->getPost('scheduled'),
            'NotScheduled' => $this->request->getPost('NotScheduled'),
            'CallBackDateTime' => $callBackdb,
            'CandidatePosition' => $this->request->getPost('CandidatePosition'),
            'InterviewDate' =>  $this->request->getPost('InterviewDate'),
            'CandidateReason' => $this->request->getPost('CandidateReason'),
            'CandidateResume' => $originalFileName
        ];

        // print_r($data); exit();
        $data['save'] = $this->candidateModel->insert_candidateM($data, $file);

        $userLevel = $session->get('user_level');
        // print_r($data['user_level']); exit();
        if ($data['save'] == 1) {
            if ($userLevel == 42) {
                return $this->response->redirect(site_url('/candidate?fdate=' . $fdate . '&todate=' . $todate . '&trickid=1'));
            } else {
                return $this->response->redirect(site_url('/HRcandidate_List?fdate=' . $fdate . '&todate=' . $todate . '&trickid=1'));
            }
        } else {
            $candId = $data['save'][0]['CandidateId'];
            // print_r($candId); exit();

            $session->setFlashdata('candidatemsg', 'Candaidate Already Exists ');

            // return view('candidates/add_new_candidate', $data);
            return $this->response->redirect(site_url('/edit_candidate_view?canId=' . $candId));
        }
    }
    public function uploadFile($path, $file_name)
    {
        if (!is_dir($path))
            mkdir($path, 0777, TRUE);
        if ($file_name->isValid() && ! $file_name->hasMoved()) {
            $newName = $file_name->getClientName();
            $file_name->move('./' . $path, $newName);
            return $path . $file_name->getName();
        }
        return "";
    }
    public function store_candidate_excelfileC()
    {
        $session = session();
        $HR_IDFK = $session->get('EmpIDFK');
        // print_r($HR_IDFK);exit();
        $fdate = date("Y-m-d");
        $todate = date("Y-m-d");
        $userLevel = $session->get('user_level');
        // $socialMedia = $this->candidateModel->Candidate_Source_ListM();
        // print_r($socialMedia[0]['SM_IDPK']);exit();


        $path             = 'Uploads/new_candidate/';
        $json             = [];
        $file_name         = $this->request->getFile('file');
        $file_name         = $this->uploadFile($path, $file_name);
        $arr_file         = explode('.', $file_name);
        $extension         = end($arr_file);

        if ('csv' == $extension) {
            $reader     = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            // $reader 	= new \PhpOffice\PhpSpreadsheet\IOFactory::createReader($extension);
        }
        // else {
        // $reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        //     $session->setFlashdata('CanidateSuccessMsg','Upload CSV file format only.');
        // }
        $spreadsheet     = $reader->load($file_name);
        $sheet_data     = $spreadsheet->getActiveSheet()->toArray();

        $list = [];
        $i = 0;
        $j = 0;

        foreach ($sheet_data as $key => $val) {
            if ($val[2] != null or !empty($val[2]) or $val[2] != 0 or $val[2] != '') {
                $result = $this->candidateModel->getCandidates(["CandidateContactNo" => $val[2]]);
                if (!empty($result)) {
                    $i = $i + 1;
                } else {
                    $j = $j + 1;
                    $sourcefield = $val[4];
                    $position = $val[5];
                    $sourceidpk = $this->candidateModel->getSourceIdpk($sourcefield);
                    $positionidpk = $this->candidateModel->getPositionIdpk($position);
                    // print_r($sourceidpk[0]['SM_IDPK']);exit();
                    $sourceid = $sourceidpk[0]['SM_IDPK'];
                    $position = $positionidpk[0]['IDPK'];
                    // print_r($position); exit();

                    if (!empty($sourceid)) {
                        $source = $sourceidpk[0]['SM_IDPK'];
                    } else {
                        $source = 10;
                    }
                    $list[] = [
                        'CandidateName'                    => $val[1],
                        'CandidateContactNo'            => $val[2],
                        'CandidateEmail'                => $val[3],
                        'Source'                        => $source,
                        'CandidatePosition'                => $position,
                        'HR_IDFK'                        => $HR_IDFK,
                        'user_level'                    => $userLevel
                    ];
                }
            }
        }


        if (file_exists($file_name))
            unlink($file_name);
        if (count($list) > 0) {
            $result = $this->candidateModel->candidatesBulkInsert($list, $HR_IDFK);
            if ($result == 1) {
                $session->setFlashdata('CanidateSuccessMsg', 'All candidate records have been successfully updated with a total of ' . $i . ' existing records and ' . $j . ' new records added.');
                if ($userLevel == 1) {
                    return $this->response->redirect(site_url('/candidate?fdate=' . $fdate . '&todate=' . $todate . '&trickid=12'));
                } else {
                    return $this->response->redirect(site_url('/HRcandidate_List?fdate=' . $fdate . '&todate=' . $todate . '&trickid=12'));
                }
            } else {

                $session->setFlashdata('CanidateSuccessMsg', 'Something went wrong. Please try again.');
                if ($userLevel == 1) {
                    return $this->response->redirect(site_url('/candidate?fdate=' . $fdate . '&todate=' . $todate . '&trickid=12'));
                } else {
                    return $this->response->redirect(site_url('/HRcandidate_List?fdate=' . $fdate . '&todate=' . $todate . '&trickid=12'));
                }
            }
        } else {
            $session->setFlashdata('CanidateSuccessMsg', 'No new record is found.');
            if ($userLevel == 1) {
                return $this->response->redirect(site_url('/candidate?fdate=' . $fdate . '&todate=' . $todate . '&trickid=12'));
            } else {
                return $this->response->redirect(site_url('/HRcandidate_List?fdate=' . $fdate . '&todate=' . $todate . '&trickid=12'));
            }
        }

        // print_r($json);exit();
        // return redirect('add_candidateC');

        // echo json_encode($json);
    }
    public function source_count()
    {
        $session = session();
        $adminId = $session->get('EmpIDFK');
        $sourceId = $_POST['sourceId'];
        $data['sourceCount'] = $this->candidateModel->getSourceCount($sourceId, $adminId);
        // print_r($data['sourceCount'][0]['Count']);exit();
        return $data['sourceCount'][0]['Count'];
    }

    public function assignCandidatesC()
    {
        $session = session();
        $data = [
            'Source' => $this->request->getPost('assignSource'),
            'assignto' => $this->request->getPost('assignto'),
            'assignCount' => $this->request->getPost('assignCount'),
            'adminId' => $session->get('EmpIDFK')
        ];

        // print_r($data);exit();
        $count = $this->candidateModel->update_assignToM($data);
        $session->setFlashdata('candidatemsg', 'Assigned Successfully');
        return $this->response->redirect(site_url('/candidate?fdate=&todate=&trickid=12'));
    }

    public function reassignCandidatesC()
    {
        $session = session();
        // $adminId = $session->get('EmpIDFK');
        $data = [
            'assignfrom' => $this->request->getPost('assignfrom') ?? '',
            'Source' => $this->request->getPost('assignSource'),
            'assignto' => $this->request->getPost('assignto'),
            'assignCount' => $this->request->getPost('assignCount'),
            'assignas' => $this->request->getPost('reassignstatus') ?? 0,
            'trickid'  => $this->request->getPost('trickid') ?? 0,
        ];

        // print_r($data);exit();
        $count = $this->candidateModel->update_reassignToM($data);
        $session->setFlashdata('candidatemsg', 'Re Assigned Successfully');
        return $this->response->redirect(site_url('/candidate?fdate=&todate=&trickid=12'));
    }

    public function scheducleCandidateC()
    {
        $data = [
            'canId' => $_GET['canId'],
        ];

        $data['candidate_details'] = $this->candidateModel->Candidate_DetailsM($data);
        $data['notScheduleReasons'] = $this->candidateModel->notschedule_reasons_ListM();
        $data['selectdesignation'] = $this->empModel->selectdesignationM();

        return view('candidates/scheducleCandidate', $data);
    }
    public function interviewScheduledC()
    {
        $session = session();
        $fdate = date('Y-m-d');
        $todate = date('Y-m-d');

        $canId = $this->request->getPost('CandidateId');

        // $InterviewDate = $this->request->getPost('InterviewDate');
        // $stringdate = "2023/03/21 1:00 PM";
        // $timestemp = strtotime($InterviewDate);
        // $InterviewDate = date('Y-m-d H:i', $timestemp);
        // print_r($InterviewDate);exit();

        $data2 = [
            'HR_IDFK' => $session->get('EmpIDFK'),
            'CandidateId' => $this->request->getPost('CandidateId'),
            'InterviewDate' => $this->request->getPost('InterviewDate'),
            'CandidateReason' => $this->request->getPost('CandidateReason'),
            // 'CandidateResume' => $fileName,
        ];

        $save = $this->candidateModel->interviewScheduledM($data2);


        $userLevel = $session->get('user_level');
        if ($userLevel == 42) {
            return $this->response->redirect(site_url('/candidate?fdate=' . $fdate . '&todate=' . $todate . '&trickid=1'));
        } elseif ($userLevel == 18 || $userLevel == 1) {
            return $this->response->redirect(site_url('/HRcandidate_List?fdate=' . $fdate . '&todate=' . $todate . '&trickid=1'));
        }
    }
    public function interviewNotScheduledC()
    {
        $session = session();

        $fdate = date('Y-m-d');
        $todate = date('Y-m-d');

        $callBack = $this->request->getPost('CallBackDateTime');
        if (empty($callBack)) {
            $callBackdb = date('Y-m-d H:i:s');
        } else {
            $callBackdb = $callBack;
        }
        $data2 = [
            'HR_IDFK' => $session->get('EmpIDFK'),
            'CandidateId' => $this->request->getPost('CandidateId'),
            'scheduled' => $this->request->getPost('scheduled'),
            'CallBackDateTime' => $callBackdb,
            // 'CandidateResume' => $fileName,
        ];

        $save = $this->candidateModel->interviewNotScheduledM($data2);


        $userLevel = $session->get('user_level');
        if ($userLevel == 42) {
            return $this->response->redirect(site_url('/candidate?fdate=' . $fdate . '&todate=' . $todate . '&trickid=12'));
        } elseif ($userLevel == 18 || $userLevel == 1) {
            return $this->response->redirect(site_url('/HRcandidate_List?fdate=' . $fdate . '&todate=' . $todate . '&trickid=12'));
        }
    }
    public function edit_Candi_profileC()
    {
        $data = [
            'canId' => $_GET['canId'],
        ];

        $data['selectdesignation'] = $this->empModel->selectdesignationM();
        $data['candidate_details'] = $this->candidateModel->Candidate_DetailsM($data);
        $data['notScheduleReasons'] = $this->candidateModel->notschedule_reasons_ListM();

        return view('candidates/edit_Candidate_profile', $data);
    }
    public function update_CandiProfileC()
    {
        $canId = $this->request->getPost('CandidateId');

        $file = $this->request->getFile('CandidateResume');
        $target_dir = "Uploads/candidates/$canId/";
        if (!file_exists($target_dir)) {
            mkdir('./Uploads/candidates/' . $canId, 0777, true);
        }
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getClientName();
            $type = $file->getClientMimeType();
            $file->move('Uploads/candidates/' . $canId . '/', $fileName);
        } else {
            $fileName = $this->request->getPost('OldResumeName') ?? '';
        }

        $data = [
            'CandidateId' => $this->request->getPost('CandidateId'),
            'CandidateName' => $this->request->getPost('CandidateName'),
            'CandidateContactNo' => $this->request->getPost('CandidateContactNo'),
            'CandidateEmail' => $this->request->getPost('CandidateEmail'),
            'CandidateLocation' => $this->request->getPost('CandidateLocation'),
            'CandidatePosition' => $this->request->getPost('CandidatePosition'),
            'CandidateEducation' => $this->request->getPost('CandidateEducation'),
            'CandidateExperience' => $this->request->getPost('exp'),
            'TotalExperience' => $this->request->getPost('TotalExperience'),
            'LastCompany' => $this->request->getPost('LastCompany'),
            'NoticePeroid' => $this->request->getPost('NoticePeroid'),
            'CandidateCurrentCTC' => $this->request->getPost('CandidateCurrentCTC'),
            'CandidateExpectedCTC' => $this->request->getPost('CandidateExpectedCTC'),
            'ImmediateJoiner' => $this->request->getPost('ImmediateJoiner'),
            'DaysRequired' => $this->request->getPost('DaysRequired'),
            'CandidateResume' => $fileName,
        ];

        $save = $this->candidateModel->edit_Candi_profileM($data);
        return $this->response->redirect(site_url('/' . $this->request->getPost('returnurl') . '?canId=' . $canId));
        // return $this->response->redirect(site_url('/edit_Candi_profile?canId=' . $canId));
    }
    public function edit_candidateC()
    {
        $data = [
            'canId' => $_GET['canId'],
        ];

        $data['candidate_details'] = $this->candidateModel->Candidate_DetailsM($data);
        $data['notScheduleReasons'] = $this->candidateModel->notschedule_reasons_ListM();
        $data['selectdesignation'] = $this->empModel->selectdesignationM();

        return view('candidates/edit_condidate', $data);
    }

    // public function update_candidateApplicatioArrivedC()
    // {
    //     // $data = [
    //     //     'canId' => $_GET['canId'], 
    //     // ];
    //     // print_r($data);exit();
    //     $session = session();


    //     $canId = $this->request->getPost('CandidateId');
    //     // $canName = $this->request->getPost('CandidateName');
    //     $file = $this->request->getFile('CandidateResume');

    //     $target_dir = "Uploads/candidates/$canId/";

    // 	if (!file_exists($target_dir))
    //     {
    //         mkdir('./Uploads/candidates/'.$canId, 0777, true );
    //     }

    //     if ($file->isValid() && !$file->hasMoved()) {
    //         $fileName = $file->getClientName();
    //         $type = $file->getClientMimeType();
    //         $file->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $fileName);
    //     }
    //     // print_r($target_dir);exit();


    //     $data = [
    //         'CandidateId' => $this->request->getPost('CandidateId'),
    //         'scheduled' => $this->request->getPost('scheduled'),
    //         'CandidateLocation' => $this->request->getPost('CandidateLocation'),
    //         'CandidateEducation' => $this->request->getPost('CandidateEducation'),
    //         'CandidateExperience' => $this->request->getPost('exp'),
    //         'TotalExperience' => $this->request->getPost('TotalExperience'),
    //         'LastCompany' => $this->request->getPost('LastCompany'),
    //         'NoticePeroid' => $this->request->getPost('NoticePeroid'),
    //         'CandidateCurrentCTC' => $this->request->getPost('CandidateCurrentCTC'),
    //         'CandidateExpectedCTC' => $this->request->getPost('CandidateExpectedCTC'),
    //         'ImmediateJoiner' => $this->request->getPost('ImmediateJoiner'),
    //         'DaysRequired' => $this->request->getPost('DaysRequired'),
    //         'InterviewDate' => $this->request->getPost('InterviewDate'),
    //         'CandidateResume' => $fileName,
    //     ];

    //     // print_r($data);exit();

    //     $save = $this->candidateModel->update_candidate_arrivedM($data);

    //     if($data['scheduled']==10){
    //         return $this->response->redirect(site_url('/candidates_application?canId='. $canId));
    //     }else{
    //         return $this->response->redirect(site_url('/edit_candidate_view?canId='. $canId));
    //         // $session->setFlashdata('candidatemsg', 'Thank you for Your Update');
    //     }


    // }
    public function update_candidateArrivedC()
    {
        // $data = [
        //     'canId' => $_GET['canId'], 
        // ];
        // print_r($data);exit();
        $session = session();


        $canId = $this->request->getPost('CandidateId');
        $canName = $this->request->getPost('CandidateName');
        $file = $this->request->getFile('CandidateResume');

        $target_dir = "Uploads/candidates/$canId-$canName/";

        // if (!file_exists($target_dir))
        // {
        //     mkdir('./Uploads/candidates/'.$canId.'-'.$canName, 0777, true );
        // }

        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getClientName();
            $type = $file->getClientMimeType();
            $file->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $fileName);
        } else {
            $fileName = '';
        }
        // print_r($target_dir);exit();

        // $canId = $this->request->getPost('CandidateId');        
        // $InterviewDate = $this->request->getPost('InterviewDate');
        // // print_r($InterviewDate);exit();
        // $InterviewDate = strtotime($InterviewDate); 
        // $InterviewDate = date("Y-m-d H:i:s", $InterviewDate);

        $data = [
            'CandidateId' => $this->request->getPost('CandidateId'),
            'scheduled' => $this->request->getPost('scheduled'),
            'CandidateLocation' => $this->request->getPost('CandidateLocation'),
            'CandidateEducation' => $this->request->getPost('CandidateEducation'),
            'CandidateExperience' => $this->request->getPost('exp'),
            'TotalExperience' => $this->request->getPost('TotalExperience'),
            'LastCompany' => $this->request->getPost('LastCompany'),
            'NoticePeroid' => $this->request->getPost('NoticePeroid'),
            'CandidateCurrentCTC' => $this->request->getPost('CandidateCurrentCTC'),
            'CandidateExpectedCTC' => $this->request->getPost('CandidateExpectedCTC'),
            'ImmediateJoiner' => $this->request->getPost('ImmediateJoiner'),
            'DaysRequired' => $this->request->getPost('DaysRequired'),
            'InterviewDate' => $this->request->getPost('InterviewDate'),
            'CandidateResume' => $fileName,
        ];

        // print_r($data);exit();

        $save = $this->candidateModel->update_candidate_arrivedM($data);

        if ($data['scheduled'] == 10) {
            $session->setFlashdata('candidatemsg', 'Thank you for Your Update');
            return $this->response->redirect(site_url('/interview_process?canId=' . $canId));
        } else {
            return $this->response->redirect(site_url('/edit_candidate_view?canId=' . $canId));
        }
    }
    public function update_candidate_rescheduleC()
    {
        // $data = [
        //     'canId' => $_GET['canId'],
        // ];
        // print_r($data);exit();
        $fdate = date('Y-m-d');
        $todate = date('Y-m-d');


        $canId = $this->request->getPost('CandidateId');

        // $InterviewDate = $this->request->getPost('InterviewDate');
        // // print_r($InterviewDate);exit();
        // $InterviewDate = strtotime($InterviewDate); 
        // $InterviewDate = date("Y-m-d H:i", $InterviewDate);

        // $stringdate = $this->request->getPost('InterviewDate');
        // $timestemp = strtotime($stringdate);
        // $date = date('Y-m-d H:i', $timestemp);

        // print_r($date);exit();

        $data1 = [
            'CandidateId' => $this->request->getPost('CandidateId'),
            'scheduled' => $this->request->getPost('scheduled'),
            'InterviewDate' => $this->request->getPost('InterviewDate'),
            'CandidateReason' => $this->request->getPost('Reason'),
            // 'CandidateResume' => $fileName,
        ];

        // print_r($data1);exit();

        $save = $this->candidateModel->update_candidate_rescheduleM($data1);
        $session = session();
        $userLevel = $session->get('user_level');
        if ($userLevel == 42) {
            return $this->response->redirect(site_url('/candidate?fdate=' . $fdate . '&todate=' . $todate . '&trickid=1'));
        } elseif ($userLevel == 18 || $userLevel == 1) {
            return $this->response->redirect(site_url('/HRcandidate_List?fdate=' . $fdate . '&todate=' . $todate . '&trickid=1'));
        }
    }
    public function update_candidate_cancelC()
    {
        // $data = [
        //     'canId' => $_GET['canId'],
        // ];
        // print_r($data);exit();
        $fdate = date('Y-m-d');
        $todate = date('Y-m-d');


        $canId = $this->request->getPost('CandidateId');
        $callBack = $this->request->getPost('CallBackDateTime');
        if (empty($callBack)) {
            $callBackdb = date('Y-m-d H:i:s');
        } else {
            $callBackdb = $callBack;
        }

        $data2 = [
            'CandidateId' => $this->request->getPost('CandidateId'),
            'scheduled' => $this->request->getPost('scheduled'),
            'CallBackDateTime' => $callBackdb,
            'CandidateReason' => $this->request->getPost('remarks'),
            // 'CandidateResume' => $fileName,
        ];
        // print_r($data2);exit();

        $save = $this->candidateModel->update_candidate_cancelM($data2);

        $session = session();
        $userLevel = $session->get('user_level');
        if ($userLevel == 42) {
            return $this->response->redirect(site_url('/candidate?fdate=' . $fdate . '&todate=' . $todate . '&trickid=1'));
        } elseif ($userLevel == 18 || $userLevel == 1) {
            return $this->response->redirect(site_url('/HRcandidate_List?fdate=' . $fdate . '&todate=' . $todate . '&trickid=1'));
        }
    }
    public function interview_processC()
    {
        $data = [
            'canId' => $_GET['canId'],
        ];

        $data['candidate_details'] = $this->candidateModel->Candidate_DetailsM($data);
        $data['notScheduleReasons'] = $this->candidateModel->notschedule_reasons_ListM();
        $data['roundList'] = $this->candidateModel->round_listM($data);
        $data['Max_round'] = $this->candidateModel->Max_round($data);
        $data['getInterviewerList'] = $this->interviewerModel->getInterviewerListM($data);
        $data['document_mail_verification'] = $this->candidateModel->document_mail_verification($data);
        $data['roundDetails'] = $this->candidateModel->roundDetailsM($data);
        $data['documents'] = $this->candidateModel->getDocM($data);
        $data['offerLetter'] = $this->candidateModel->getOfferLetterM($data);
        $data['CanHistory'] = $this->candidateModel->getCanHistoryM($data);

        $data['Files'] = $this->empModel->getEmployeeFiles($_GET['canId'],1);
        $data['File_counts'] = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0];
        foreach ($data['Files'] as $file) {
            $category = $file['Doc_CategoryIDFK'];
            if (isset($data['File_counts'][$category])) {
                $data['File_counts'][$category]++;
            }
        }

        $data['selectdesignation'] = $this->empModel->selectdesignationM();
        $data['selectdepart'] = $this->empModel->selectdepartM();
        $data['reportManager'] = $this->interviewerModel->getReportingManager();
        $data['selectEmpType'] = $this->empModel->selectEmpTypeM();

        return view('candidates/InterViewProcess', $data);
    }
    public function insert_interview_processC()
    {
        $canId = $this->request->getPost('CandidateId');
        $data = [
            'CandidateId' => $this->request->getPost('CandidateId'),
            'InterviewerIDFK' => $this->request->getPost('InterviewerIDFK'),
            'RoundID' => $this->request->getPost('RoundID'),
            'Communication' => $this->request->getPost('Communication'),
            'Attitude' => $this->request->getPost('Attitude'),
            'Discipline' => $this->request->getPost('Discipline'),
            'DressCode' => $this->request->getPost('DressCode'),
            'Knowledge' => $this->request->getPost('Knowledge'),
            'OverAllRating' => $this->request->getPost('OverAllRating'),
            'InterviewRemarks' => $this->request->getPost('InterviewRemarks'),
            'InterviewStatus' => $this->request->getPost('InterviewStatus'),
            // 'DaysRequired' => $this->request->getPost('DaysRequired'),
            'InterviewDate' => $this->request->getPost('InterviewDate'),
            'Holdaction' => $this->request->getPost('Holdaction'),
        ];
        $this->candidateModel->update_interview_processM($data);
        if ($data['InterviewStatus'] == 3 || $data['InterviewStatus'] == 4) {
            return $this->response->redirect(site_url('/interview_process?canId=' . $canId));
        } else {
            return $this->response->redirect(site_url('/interview_process?canId=' . $canId));
        }
    }
    public function provious_roundsC()
    {
        $data = [
            'canId' => $_GET['canId'],
        ];

        $data['candidate_details'] = $this->candidateModel->Candidate_DetailsM($data);
        // $data['notScheduleReasons'] = $this->candidateModel->notschedule_reasons_ListM();
        // $data['select_interviewer'] = $this->candidateModel->select_interviewerM();
        $data['roundDetails'] = $this->candidateModel->roundDetailsM($data);
        $data['roundList'] = $this->candidateModel->round_listM($data);
        $data['documents'] = $this->candidateModel->getDocM($data);
        $data['offerLetter'] = $this->candidateModel->getOfferLetterM($data);
        $data['CanHistory'] = $this->candidateModel->getCanHistoryM($data);
        // print_r($data['CanHistory']);exit();

        return view('candidates/previousRound', $data);
    }
    public function background_docC()
    {
        $data = [
            'canId' => $_GET['canId'],
        ];


        $data['candidate_details'] = $this->candidateModel->Candidate_DetailsM($data);
        $data['roundDetails'] = $this->candidateModel->roundDetailsM($data);
        $data['roundList'] = $this->candidateModel->round_listM($data);
        $data['documents'] = $this->candidateModel->getDocM($data);

        // $data['docFormats'] =[
        //     'sslc' =>strstr($data['documents'][0]['SSLCMarksCard'],"." ),
        //     'puc' => strstr($data['documents'][0]['PUCMarksCard'],"." ),
        //     'degree' => strstr($data['documents'][0]['DegreeMarksCard'],"." ),
        //     'aadhar' => strstr($data['documents'][0]['AadharCard'],"." ),
        //     'pan' => strstr($data['documents'][0]['PanCard'],"." ),
        //     'expLetter' => strstr($data['documents'][0]['ExperienceLetter'],"." ),
        //     'paySlip' => strstr($data['documents'][0]['PaySlip'],"." ),
        //     'bankStatement' => strstr($data['documents'][0]['BankStatement'],"." ),
        //     'otherDocument' => strstr($data['documents'][0]['OtherDocument'],"." ),
        //     'empConfirm' => strstr($data['documents'][0]['EmployerConformation'],"." ),
        // ];       


        // print_r($data['documents']);exit();

        return view('candidates/background_doc', $data);
    }
    public function onboarding_processC()
    {
        $data = [
            'canId' => $_GET['canId'],
        ];

        $data['candidate_details'] = $this->candidateModel->Candidate_DetailsM($data);
        $data['roundDetails'] = $this->candidateModel->roundDetailsM($data);
        $data['roundList'] = $this->candidateModel->round_listM($data);
        $data['documents'] = $this->candidateModel->getDocM($data);

        $data['selectdesignation'] = $this->empModel->selectdesignationM();
        $data['selectdepart'] = $this->empModel->selectdepartM();
        $data['reportManager'] = $this->interviewerModel->getReportingManager();



        // print_r($data['roundList']);exit();

        // $sslc = $data['documents'][0]['SSLCMarksCard'];
        // print_r($sslc);exit();

        return view('candidates/onboardingProcess', $data);
    }
    public function send_documentVerification_mailC()
    {
        $canId = $this->request->getPost('CandidateId');
        $fdate = date('Y-m-d');
        $todate = date('Y-m-d');
        $to = $this->request->getPost('CandidateEmail');
        $subject = 'Document Verification from Homes247.in';
        $body = $this->request->getPost('docmailBody');

        require_once '../vendor/autoload.php';

        // Create the Transport
        // $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
        //     ->setUsername('indiaestatehomes@gmail.com')
        //     ->setPassword('ffpc xuul oyxb nint');
        // $mailer = new \Swift_Mailer($transport);
        // $message = (new \Swift_Message('Wonderful Subject'))
        //     ->setFrom(['indiaestatehomes@gmail.com' => 'Homes247.in'])
        //     ->setTo([$to])
        //     ->setSubject($subject)
        //     ->setBody($body, 'text/html');
        // $result = $mailer->send($message);

        $PhpMailer = \Config\Services::email();
        $PhpMailer->setFrom('indiaestatehomes@gmail.com', 'Homes247');
        $PhpMailer->setTo([$to]);
        $PhpMailer->setSubject($subject);
        $PhpMailer->setMessage($body);
        $PhpMailer->send();

        $data['status'] = 'True';
        $data['code'] = '0';
        $data['message'] = 'successfully added';
        $data['success'] = 'success';

        $data = [
            'CandidateId' => $canId,
            'CandidateEmail' => $to,
            'docmailSubject' => $subject,
            'docmailBody' => $body,
        ];

        $save = $this->candidateModel->send_documentVerification_mailM($data);
        return $this->response->redirect(site_url('/interview_process?canId=' . $canId));
    }

    public function insert_freshers_documentsC()
    {
        $data = [
            // 'canId' => $_GET['canId'],
            'canId' => $this->request->getPost('CandidateId'),
        ];


        $data['documents'] = $this->candidateModel->getDocM($data);
        if (!empty($data['documents'])) {
            $oldSSLCMarksCard =  $data['documents'][0]['SSLCMarksCard'];
            $oldPUCMarksCard =  $data['documents'][0]['PUCMarksCard'];
            $oldDegreeMarksCard =  $data['documents'][0]['DegreeMarksCard'];
            $oldAadharCard =  $data['documents'][0]['AadharCard'];
            $oldPanCard =  $data['documents'][0]['PanCard'];
            // $oldExperienceLetter =  $data['documents'][0]['ExperienceLetter'];
            // $oldPaySlip =  $data['documents'][0]['PaySlip'];
            // $oldBankStatement =  $data['documents'][0]['BankStatement'];
            // $oldOtherDocument =  $data['documents'][0]['OtherDocument'];
            // $oldEmployerConformation =  $data['documents'][0]['EmployerConformation'];
            // print_r($oldPaySlip);exit();
        }

        $canId = $this->request->getPost('CandidateId');
        $canName = $this->request->getPost('CandidateName');


        $SSLCMarksCardfile = $this->request->getFile('SSLCMarksCard');
        $PUCMarksCardfile = $this->request->getFile('PUCMarksCard');
        $DegreeMarksCardfile = $this->request->getFile('DegreeMarksCard');
        $AadharCardfile = $this->request->getFile('AadharCard');
        $PanCardfile = $this->request->getFile('PanCard');
        // $ExperienceLetterfile = $this->request->getFile('ExperienceLetter');
        // $PaySlipfile = $this->request->getFile('PaySlip');
        // $BankStatementfile = $this->request->getFile('BankStatement');
        // $OtherDocumentfile = $this->request->getFile('OtherDocument');
        // $EmployerConformationfile = $this->request->getFile('EmployerConformation');



        // print_r($SSLCMarksCardfile);exit();
        // print_r($PUCMarksCardfile);exit();



        $target_dir = "Uploads/candidates/$canId-$canName/";
        if (!file_exists($target_dir)) {
            mkdir('./Uploads/candidates/' . $canId . '-' . $canName, 0777, true);
        }

        if ($SSLCMarksCardfile->isValid() && !$SSLCMarksCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['SSLCMarksCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldSSLCMarksCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldSSLCMarksCard);
                }
            }
            $SSLCMarksCardfileName = $SSLCMarksCardfile->getClientName();
            $SSLCMarksCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $SSLCMarksCardfileName);
        } else {
            if (!empty($data['documents'][0]['SSLCMarksCard'])) {
                $SSLCMarksCardfileName =  $oldSSLCMarksCard;
            } else {
                $SSLCMarksCardfileName = $this->request->getFile('SSLCMarksCard');
            }
        }


        if ($PUCMarksCardfile->isValid() && !$PUCMarksCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['PUCMarksCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldPUCMarksCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldPUCMarksCard);
                }
            }
            $PUCMarksCardfileName = $PUCMarksCardfile->getClientName();
            $PUCMarksCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $PUCMarksCardfileName);
        } else {
            if (!empty($data['documents'][0]['PUCMarksCard'])) {
                $PUCMarksCardfileName =  $oldPUCMarksCard;
            } else {
                $PUCMarksCardfileName = $this->request->getFile('PUCMarksCard');
            }
        }
        if ($DegreeMarksCardfile->isValid() && !$DegreeMarksCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['DegreeMarksCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldDegreeMarksCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldDegreeMarksCard);
                }
            }
            $DegreeMarksCardfileName = $DegreeMarksCardfile->getClientName();
            $DegreeMarksCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $DegreeMarksCardfileName);
        } else {
            if (!empty($data['documents'][0]['DegreeMarksCard'])) {
                $DegreeMarksCardfileName =  $oldDegreeMarksCard;
            } else {
                $DegreeMarksCardfileName = $this->request->getFile('DegreeMarksCard');
            }
        }
        if ($AadharCardfile->isValid() && !$AadharCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['AadharCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldAadharCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldAadharCard);
                }
            }
            $AadharCardfileName = $AadharCardfile->getClientName();
            $AadharCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $AadharCardfileName);
        } else {
            if (!empty($data['documents'][0]['AadharCard'])) {
                $AadharCardfileName =  $oldAadharCard;
            } else {
                $AadharCardfileName = $this->request->getFile('AadharCard');
            }
        }
        if ($PanCardfile->isValid() && !$PanCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['PanCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldPanCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldPanCard);
                }
            }
            $PanCardfileName = $PanCardfile->getClientName();
            $PanCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $PanCardfileName);
        } else {
            if (!empty($data['documents'][0]['PanCard'])) {
                $PanCardfileName =  $oldPanCard;
            } else {
                $PanCardfileName = $this->request->getFile('PanCard');
            }
        }
        // if($ExperienceLetterfile->isValid() && !$ExperienceLetterfile->hasMoved()) {
        //     if(!empty($data['documents'])){
        //     if(!file_exists("Uploads/candidates/$canId-$canName/".$oldExperienceLetter)){
        //         unlink("Uploads/candidates/$canId-$canName/".$oldExperienceLetter);
        //     }}
        //     $ExperienceLetterfileName = $ExperienceLetterfile->getClientName();
        //     $ExperienceLetterfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $ExperienceLetterfileName);
        // }else{
        //     if(!empty($data['documents'])){
        //     $ExperienceLetterfileName =  $oldExperienceLetter;
        //     }else{
        //         $ExperienceLetterfileName = $this->request->getFile('ExperienceLetter');
        //     }
        // }
        // if($PaySlipfile->isValid() && !$PaySlipfile->hasMoved()) {
        //     if(!empty($data['documents'])){
        //     if(!file_exists("Uploads/candidates/$canId-$canName/".$oldPaySlip)){
        //         unlink("Uploads/candidates/$canId-$canName/".$oldPaySlip);
        //     }}
        //     $PaySlipfileName = $PaySlipfile->getClientName();
        //     $PaySlipfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $PaySlipfileName);
        // }else{
        //     if(!empty($data['documents'])){
        //     $PaySlipfileName =  $oldPaySlip;
        //     }else{
        //         $PaySlipfileName = $this->request->getFile('PaySlip');
        //     }
        // }

        // if($BankStatementfile->isValid() && !$BankStatementfile->hasMoved()) {
        //     if(!empty($data['documents'])){
        //     if(!file_exists("Uploads/candidates/$canId-$canName/".$oldBankStatement)){
        //         unlink("Uploads/candidates/$canId-$canName/".$oldBankStatement);
        //     }}
        //     $BankStatementfileName = $BankStatementfile->getClientName();
        //     $BankStatementfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $BankStatementfileName);
        // }else{
        //     if(!empty($data['documents'])){
        //     $BankStatementfileName =  $oldBankStatement;
        //     }else{
        //         $BankStatementfileName = $this->request->getFile('BankStatement');
        //     }
        // }
        // if($OtherDocumentfile->isValid() && !$OtherDocumentfile->hasMoved()) {
        //     if(!empty($data['documents'])){
        //     if(!file_exists("Uploads/candidates/$canId-$canName/".$oldOtherDocument)){
        //         unlink("Uploads/candidates/$canId-$canName/".$oldOtherDocument);
        //     }}
        //     $OtherDocumentfileName = $OtherDocumentfile->getClientName();
        //     $OtherDocumentfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $OtherDocumentfileName);
        // }else{
        //     if(!empty($data['documents'])){
        //     $OtherDocumentfileName =  $oldOtherDocument;
        //     }else{
        //         $OtherDocumentfileName = $this->request->getFile('OtherDocument');
        //     }
        // }
        // if($EmployerConformationfile->isValid() && !$EmployerConformationfile->hasMoved()) {
        //     if(!empty($data['documents'])){
        //     if(!file_exists("Uploads/candidates/$canId-$canName/".$oldEmployerConformation)){
        //         unlink("Uploads/candidates/$canId-$canName/".$oldEmployerConformation);
        //     }}
        //     $EmployerConformationfileName = $EmployerConformationfile->getClientName();
        //     $EmployerConformationfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $EmployerConformationfileName);
        // }else{
        //     if(!empty($data['documents'])){
        //     $EmployerConformationfileName =  $oldEmployerConformation;
        //     }else{
        //         $EmployerConformationfileName = $this->request->getFile('EmployerConformation');
        //     }
        // }

        $data = [
            'CandidateId' => $this->request->getPost('CandidateId'),
            'SSLCMarksCard' => $SSLCMarksCardfileName,
            'PUCMarksCard' => $PUCMarksCardfileName,
            'DegreeMarksCard' => $DegreeMarksCardfileName,
            'AadharCard' => $AadharCardfileName,
            'PanCard' => $PanCardfileName,
            // 'ExperienceLetter' => $ExperienceLetterfileName,
            // 'PaySlip' => $PaySlipfileName,
            // 'BankStatement' => $BankStatementfileName,
            // 'OtherDocument' => $OtherDocumentfileName,
            // 'EmployerConformation' => $EmployerConformationfileName,
            'DVStatus' => $this->request->getPost('DVStatus'),
            'DVRemarks' => $this->request->getPost('DVRemarks1'),
            'DVRemarks' => $this->request->getPost('DVRemarks'),
        ];
        // print_r($data);exit();

        $this->candidateModel->insert_freshers_documentsM($data);

        if ($data['DVStatus'] == 2) {

            return $this->response->redirect(site_url('/offer_letter_process?canId=' . $canId));
        } else {
            return $this->response->redirect(site_url('/onboarding_process?canId=' . $canId));
        }
    }
    public function insert_experience_documentsC()
    {
        $data = [
            // 'canId' => $_GET['canId'],
            'canId' => $this->request->getPost('CandidateId'),
        ];


        $data['documents'] = $this->candidateModel->getDocM($data);
        if (!empty($data['documents'])) {
            $oldSSLCMarksCard =  $data['documents'][0]['SSLCMarksCard'];
            $oldPUCMarksCard =  $data['documents'][0]['PUCMarksCard'];
            $oldDegreeMarksCard =  $data['documents'][0]['DegreeMarksCard'];
            $oldAadharCard =  $data['documents'][0]['AadharCard'];
            $oldPanCard =  $data['documents'][0]['PanCard'];
            $oldExperienceLetter =  $data['documents'][0]['ExperienceLetter'];
            $oldPaySlip =  $data['documents'][0]['PaySlip'];
            $oldBankStatement =  $data['documents'][0]['BankStatement'];
            $oldOtherDocument =  $data['documents'][0]['OtherDocument'];
            $oldEmployerConformation =  $data['documents'][0]['EmployerConformation'];
            // print_r($oldPaySlip);exit();
        }

        $canId = $this->request->getPost('CandidateId');
        $canName = $this->request->getPost('CandidateName');


        $SSLCMarksCardfile = $this->request->getFile('SSLCMarksCard');
        $PUCMarksCardfile = $this->request->getFile('PUCMarksCard');
        $DegreeMarksCardfile = $this->request->getFile('DegreeMarksCard');
        $AadharCardfile = $this->request->getFile('AadharCard');
        $PanCardfile = $this->request->getFile('PanCard');
        $ExperienceLetterfile = $this->request->getFile('ExperienceLetter');
        $PaySlipfile = $this->request->getFile('PaySlip');
        $BankStatementfile = $this->request->getFile('BankStatement');
        $OtherDocumentfile = $this->request->getFile('OtherDocument');
        $EmployerConformationfile = $this->request->getFile('EmployerConformation');



        // print_r($SSLCMarksCardfile);exit();
        // print_r($PUCMarksCardfile);exit();



        $target_dir = "Uploads/candidates/$canId-$canName/";
        if (!file_exists($target_dir)) {
            mkdir('./Uploads/candidates/' . $canId . '-' . $canName, 0777, true);
        }

        if ($SSLCMarksCardfile->isValid() && !$SSLCMarksCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['SSLCMarksCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldSSLCMarksCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldSSLCMarksCard);
                }
            }
            $SSLCMarksCardfileName = $SSLCMarksCardfile->getClientName();
            $SSLCMarksCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $SSLCMarksCardfileName);
        } else {
            if (!empty($data['documents'][0]['SSLCMarksCard'])) {
                $SSLCMarksCardfileName =  $oldSSLCMarksCard;
            } else {
                $SSLCMarksCardfileName = $this->request->getFile('SSLCMarksCard');
            }
        }


        if ($PUCMarksCardfile->isValid() && !$PUCMarksCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['PUCMarksCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldPUCMarksCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldPUCMarksCard);
                }
            }
            $PUCMarksCardfileName = $PUCMarksCardfile->getClientName();
            $PUCMarksCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $PUCMarksCardfileName);
        } else {
            if (!empty($data['documents'][0]['PUCMarksCard'])) {
                $PUCMarksCardfileName =  $oldPUCMarksCard;
            } else {
                $PUCMarksCardfileName = $this->request->getFile('PUCMarksCard');
            }
        }
        if ($DegreeMarksCardfile->isValid() && !$DegreeMarksCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['DegreeMarksCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldDegreeMarksCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldDegreeMarksCard);
                }
            }
            $DegreeMarksCardfileName = $DegreeMarksCardfile->getClientName();
            $DegreeMarksCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $DegreeMarksCardfileName);
        } else {
            if (!empty($data['documents'][0]['DegreeMarksCard'])) {
                $DegreeMarksCardfileName =  $oldDegreeMarksCard;
            } else {
                $DegreeMarksCardfileName = $this->request->getFile('DegreeMarksCard');
            }
        }
        if ($AadharCardfile->isValid() && !$AadharCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['AadharCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldAadharCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldAadharCard);
                }
            }
            $AadharCardfileName = $AadharCardfile->getClientName();
            $AadharCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $AadharCardfileName);
        } else {
            if (!empty($data['documents'][0]['AadharCard'])) {
                $AadharCardfileName =  $oldAadharCard;
            } else {
                $AadharCardfileName = $this->request->getFile('AadharCard');
            }
        }
        if ($PanCardfile->isValid() && !$PanCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['PanCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldPanCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldPanCard);
                }
            }
            $PanCardfileName = $PanCardfile->getClientName();
            $PanCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $PanCardfileName);
        } else {
            if (!empty($data['documents'][0]['PanCard'])) {
                $PanCardfileName =  $oldPanCard;
            } else {
                $PanCardfileName = $this->request->getFile('PanCard');
            }
        }
        if ($ExperienceLetterfile->isValid() && !$ExperienceLetterfile->hasMoved()) {
            if (!empty($data['documents'][0]['ExperienceLetter'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldExperienceLetter)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldExperienceLetter);
                }
            }
            $ExperienceLetterfileName = $ExperienceLetterfile->getClientName();
            $ExperienceLetterfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $ExperienceLetterfileName);
        } else {
            if (!empty($data['documents'][0]['ExperienceLetter'])) {
                $ExperienceLetterfileName =  $oldExperienceLetter;
            } else {
                $ExperienceLetterfileName = $this->request->getFile('ExperienceLetter');
            }
        }
        if ($PaySlipfile->isValid() && !$PaySlipfile->hasMoved()) {
            if (!empty($data['documents'][0]['PaySlip'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldPaySlip)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldPaySlip);
                }
            }
            $PaySlipfileName = $PaySlipfile->getClientName();
            $PaySlipfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $PaySlipfileName);
        } else {
            if (!empty($data['documents'][0]['PaySlip'])) {
                $PaySlipfileName =  $oldPaySlip;
            } else {
                $PaySlipfileName = $this->request->getFile('PaySlip');
            }
        }

        if ($BankStatementfile->isValid() && !$BankStatementfile->hasMoved()) {
            if (!empty($data['documents'][0]['BankStatement'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldBankStatement)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldBankStatement);
                }
            }
            $BankStatementfileName = $BankStatementfile->getClientName();
            $BankStatementfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $BankStatementfileName);
        } else {
            if (!empty($data['documents'][0]['BankStatement'])) {
                $BankStatementfileName =  $oldBankStatement;
            } else {
                $BankStatementfileName = $this->request->getFile('BankStatement');
            }
        }
        if ($OtherDocumentfile->isValid() && !$OtherDocumentfile->hasMoved()) {
            if (!empty($data['documents'][0]['OtherDocument'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldOtherDocument)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldOtherDocument);
                }
            }
            $OtherDocumentfileName = $OtherDocumentfile->getClientName();
            $OtherDocumentfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $OtherDocumentfileName);
        } else {
            if (!empty($data['documents'][0]['OtherDocument'])) {
                $OtherDocumentfileName =  $oldOtherDocument;
            } else {
                $OtherDocumentfileName = $this->request->getFile('OtherDocument');
            }
        }
        if ($EmployerConformationfile->isValid() && !$EmployerConformationfile->hasMoved()) {
            if (!empty($data['documents'][0]['EmployerConformation'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldEmployerConformation)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldEmployerConformation);
                }
            }
            $EmployerConformationfileName = $EmployerConformationfile->getClientName();
            $EmployerConformationfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $EmployerConformationfileName);
        } else {
            if (!empty($data['documents'][0]['EmployerConformation'])) {
                $EmployerConformationfileName =  $oldEmployerConformation;
            } else {
                $EmployerConformationfileName = $this->request->getFile('EmployerConformation');
            }
        }



        $data = [
            'CandidateId' => $this->request->getPost('CandidateId'),
            'SSLCMarksCard' => $SSLCMarksCardfileName,
            'PUCMarksCard' => $PUCMarksCardfileName,
            'DegreeMarksCard' => $DegreeMarksCardfileName,
            'AadharCard' => $AadharCardfileName,
            'PanCard' => $PanCardfileName,
            'ExperienceLetter' => $ExperienceLetterfileName,
            'PaySlip' => $PaySlipfileName,
            'BankStatement' => $BankStatementfileName,
            'OtherDocument' => $OtherDocumentfileName,
            'EmployerConformation' => $EmployerConformationfileName,
            'DVStatus' => $this->request->getPost('DVStatus'),
            'DVRemarks' => $this->request->getPost('DVRemarks1'),
            'DVRemarks' => $this->request->getPost('DVRemarks'),
        ];
        // print_r($data);exit();

        $this->candidateModel->insert_experience_documentsM($data);

        if ($data['DVStatus'] == 2) {

            return $this->response->redirect(site_url('/offer_letter_process?canId=' . $canId));
        } else {
            return $this->response->redirect(site_url('/onboarding_process?canId=' . $canId));
        }
    }
    // public function insert_documentC(){
    //     $data = [
    //         // 'canId' => $_GET['canId'],
    //         'canId' =>$this->request->getPost('CandidateId'),
    //     ];


    //     $data['documents'] = $this->candidateModel->getDocM($data);
    //     if(!empty($data['documents'])){
    //         $oldSSLCMarksCard =  $data['documents'][0]['SSLCMarksCard'];
    //         $oldPUCMarksCard =  $data['documents'][0]['PUCMarksCard'];
    //         $oldDegreeMarksCard =  $data['documents'][0]['DegreeMarksCard'];
    //         $oldAadharCard =  $data['documents'][0]['AadharCard'];
    //         $oldPanCard =  $data['documents'][0]['PanCard'];
    //         $oldExperienceLetter =  $data['documents'][0]['ExperienceLetter'];
    //         $oldPaySlip =  $data['documents'][0]['PaySlip'];
    //         $oldBankStatement =  $data['documents'][0]['BankStatement'];
    //         $oldOtherDocument =  $data['documents'][0]['OtherDocument'];
    //         $oldEmployerConformation =  $data['documents'][0]['EmployerConformation'];
    //         // print_r($oldPaySlip);exit();
    //     }

    //     $canId = $this->request->getPost('CandidateId');


    //     $SSLCMarksCardfile = $this->request->getFile('SSLCMarksCard');    
    //     $PUCMarksCardfile = $this->request->getFile('PUCMarksCard');
    //     $DegreeMarksCardfile = $this->request->getFile('DegreeMarksCard');
    //     $AadharCardfile = $this->request->getFile('AadharCard');
    //     $PanCardfile = $this->request->getFile('PanCard');
    //     $ExperienceLetterfile = $this->request->getFile('ExperienceLetter');
    //     $PaySlipfile = $this->request->getFile('PaySlip');
    //     $BankStatementfile = $this->request->getFile('BankStatement');
    //     $OtherDocumentfile = $this->request->getFile('OtherDocument');
    //     $EmployerConformationfile = $this->request->getFile('EmployerConformation');



    //     // print_r($SSLCMarksCardfile);exit();
    //     // print_r($PUCMarksCardfile);exit();



    //     $target_dir = "Uploads/candidates/$canId-$canName/";        
    // 	if(!file_exists($target_dir))
    //     {
    //         mkdir('./Uploads/candidates/'.$canId, 0777, true );
    //     }

    //     if($SSLCMarksCardfile->isValid() && !$SSLCMarksCardfile->hasMoved()) {
    //         if(!empty($data['documents'])){
    //             if(!file_exists("Uploads/candidates/$canId-$canName/".$oldSSLCMarksCard)){
    //                 unlink("Uploads/candidates/$canId-$canName/".$oldSSLCMarksCard);
    //             }
    //         }
    //         $SSLCMarksCardfileName = $SSLCMarksCardfile->getClientName();
    //         $SSLCMarksCardfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $SSLCMarksCardfileName);
    //     }else{
    //         if(!empty($data['documents'])){
    //         $SSLCMarksCardfileName =  $oldSSLCMarksCard;
    //         }else{
    //             $SSLCMarksCardfileName = $this->request->getFile('SSLCMarksCard');
    //         }
    //     }


    //     if($PUCMarksCardfile->isValid() && !$PUCMarksCardfile->hasMoved()) {
    //         if(!empty($data['documents'])){
    //         if(!file_exists("Uploads/candidates/$canId-$canName/".$oldPUCMarksCard)){
    //             unlink("Uploads/candidates/$canId-$canName/".$oldPUCMarksCard);
    //         }}
    //         $PUCMarksCardfileName = $PUCMarksCardfile->getClientName();
    //         $PUCMarksCardfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $PUCMarksCardfileName);
    //     }else{
    //         if(!empty($data['documents'])){
    //         $PUCMarksCardfileName =  $oldPUCMarksCard;
    //         }else{
    //             $PUCMarksCardfileName = $this->request->getFile('PUCMarksCard');
    //         }
    //     }
    //     if($DegreeMarksCardfile->isValid() && !$DegreeMarksCardfile->hasMoved()) {
    //         if(!empty($data['documents'])){
    //         if(!file_exists("Uploads/candidates/$canId-$canName/".$oldDegreeMarksCard)){
    //             unlink("Uploads/candidates/$canId-$canName/".$oldDegreeMarksCard);
    //         }}
    //         $DegreeMarksCardfileName = $DegreeMarksCardfile->getClientName();
    //         $DegreeMarksCardfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $DegreeMarksCardfileName);
    //     }else{
    //         if(!empty($data['documents'])){
    //         $DegreeMarksCardfileName =  $oldDegreeMarksCard;
    //         }else{
    //             $DegreeMarksCardfileName = $this->request->getFile('DegreeMarksCard');
    //         }
    //     }
    //     if($AadharCardfile->isValid() && !$AadharCardfile->hasMoved()) {
    //         if(!empty($data['documents'])){
    //         if(!file_exists("Uploads/candidates/$canId-$canName/".$oldAadharCard)){
    //             unlink("Uploads/candidates/$canId-$canName/".$oldAadharCard);
    //         }}
    //         $AadharCardfileName = $AadharCardfile->getClientName();
    //         $AadharCardfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $AadharCardfileName);
    //     }else{
    //         if(!empty($data['documents'])){
    //         $AadharCardfileName =  $oldAadharCard;
    //         }else{
    //             $AadharCardfileName = $this->request->getFile('AadharCard');
    //         }
    //     }
    //     if($PanCardfile->isValid() && !$PanCardfile->hasMoved()) {
    //         if(!empty($data['documents'])){
    //         if(!file_exists("Uploads/candidates/$canId-$canName/".$oldPanCard)){
    //             unlink("Uploads/candidates/$canId-$canName/".$oldPanCard);
    //         }}
    //         $PanCardfileName = $PanCardfile->getClientName();
    //         $PanCardfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $PanCardfileName);
    //     }else{
    //         if(!empty($data['documents'])){
    //         $PanCardfileName =  $oldPanCard;
    //         }else{
    //             $PanCardfileName = $this->request->getFile('PanCard');
    //         }
    //     }
    //     if($ExperienceLetterfile->isValid() && !$ExperienceLetterfile->hasMoved()) {
    //         if(!empty($data['documents'])){
    //         if(!file_exists("Uploads/candidates/$canId-$canName/".$oldExperienceLetter)){
    //             unlink("Uploads/candidates/$canId-$canName/".$oldExperienceLetter);
    //         }}
    //         $ExperienceLetterfileName = $ExperienceLetterfile->getClientName();
    //         $ExperienceLetterfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $ExperienceLetterfileName);
    //     }else{
    //         if(!empty($data['documents'])){
    //         $ExperienceLetterfileName =  $oldExperienceLetter;
    //         }else{
    //             $ExperienceLetterfileName = $this->request->getFile('ExperienceLetter');
    //         }
    //     }
    //     if($PaySlipfile->isValid() && !$PaySlipfile->hasMoved()) {
    //         if(!empty($data['documents'])){
    //         if(!file_exists("Uploads/candidates/$canId-$canName/".$oldPaySlip)){
    //             unlink("Uploads/candidates/$canId-$canName/".$oldPaySlip);
    //         }}
    //         $PaySlipfileName = $PaySlipfile->getClientName();
    //         $PaySlipfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $PaySlipfileName);
    //     }else{
    //         if(!empty($data['documents'])){
    //         $PaySlipfileName =  $oldPaySlip;
    //         }else{
    //             $PaySlipfileName = $this->request->getFile('PaySlip');
    //         }
    //     }

    //     if($BankStatementfile->isValid() && !$BankStatementfile->hasMoved()) {
    //         if(!empty($data['documents'])){
    //         if(!file_exists("Uploads/candidates/$canId-$canName/".$oldBankStatement)){
    //             unlink("Uploads/candidates/$canId-$canName/".$oldBankStatement);
    //         }}
    //         $BankStatementfileName = $BankStatementfile->getClientName();
    //         $BankStatementfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $BankStatementfileName);
    //     }else{
    //         if(!empty($data['documents'])){
    //         $BankStatementfileName =  $oldBankStatement;
    //         }else{
    //             $BankStatementfileName = $this->request->getFile('BankStatement');
    //         }
    //     }
    //     if($OtherDocumentfile->isValid() && !$OtherDocumentfile->hasMoved()) {
    //         if(!empty($data['documents'])){
    //         if(!file_exists("Uploads/candidates/$canId-$canName/".$oldOtherDocument)){
    //             unlink("Uploads/candidates/$canId-$canName/".$oldOtherDocument);
    //         }}
    //         $OtherDocumentfileName = $OtherDocumentfile->getClientName();
    //         $OtherDocumentfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $OtherDocumentfileName);
    //     }else{
    //         if(!empty($data['documents'])){
    //         $OtherDocumentfileName =  $oldOtherDocument;
    //         }else{
    //             $OtherDocumentfileName = $this->request->getFile('OtherDocument');
    //         }
    //     }
    //     if($EmployerConformationfile->isValid() && !$EmployerConformationfile->hasMoved()) {
    //         if(!empty($data['documents'])){
    //         if(!file_exists("Uploads/candidates/$canId-$canName/".$oldEmployerConformation)){
    //             unlink("Uploads/candidates/$canId-$canName/".$oldEmployerConformation);
    //         }}
    //         $EmployerConformationfileName = $EmployerConformationfile->getClientName();
    //         $EmployerConformationfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $EmployerConformationfileName);
    //     }else{
    //         if(!empty($data['documents'])){
    //         $EmployerConformationfileName =  $oldEmployerConformation;
    //         }else{
    //             $EmployerConformationfileName = $this->request->getFile('EmployerConformation');
    //         }
    //     }



    //     $data= [
    //         'CandidateId' => $this->request->getPost('CandidateId'),
    //         'SSLCMarksCard' => $SSLCMarksCardfileName,
    //         'PUCMarksCard' => $PUCMarksCardfileName,
    //         'DegreeMarksCard' => $DegreeMarksCardfileName,
    //         'AadharCard' => $AadharCardfileName,
    //         'PanCard' => $PanCardfileName,
    //         'ExperienceLetter' => $ExperienceLetterfileName,
    //         'PaySlip' => $PaySlipfileName,
    //         'BankStatement' => $BankStatementfileName,
    //         'OtherDocument' => $OtherDocumentfileName,
    //         'EmployerConformation' => $EmployerConformationfileName,
    //         'DVStatus' => $this->request->getPost('DVStatus'),
    //         'DVRemarks' => $this->request->getPost('DVRemarks1'),
    //         'DVRemarks' => $this->request->getPost('DVRemarks'),
    //     ];
    //     // print_r($data);exit();

    //     $this->candidateModel->insert_documentM($data);

    //     if($data['DVStatus']==2){

    //         return $this->response->redirect(site_url('/offer_letter_process?canId='. $canId));
    //     }else{
    //         return $this->response->redirect(site_url('/onboarding_process?canId='. $canId));

    //     }


    // }

    public function fresher_update_documentC()
    {
        $data = [
            // 'canId' => $_GET['canId'],
            'canId' => $this->request->getPost('CandidateId'),
        ];


        $data['documents'] = $this->candidateModel->getDocM($data);
        // print_r($data['documents']);exit();
        if (!empty($data['documents'])) {
            $oldSSLCMarksCard =  $data['documents'][0]['SSLCMarksCard'];
            $oldPUCMarksCard =  $data['documents'][0]['PUCMarksCard'];
            $oldDegreeMarksCard =  $data['documents'][0]['DegreeMarksCard'];
            $oldAadharCard =  $data['documents'][0]['AadharCard'];
            $oldPanCard =  $data['documents'][0]['PanCard'];
            // $oldExperienceLetter =  $data['documents'][0]['ExperienceLetter'];
            // $oldPaySlip =  $data['documents'][0]['PaySlip'];
            // $oldBankStatement =  $data['documents'][0]['BankStatement'];
            $oldOtherDocument =  $data['documents'][0]['OtherDocument'];
            $oldOfferLetterImage =  $data['documents'][0]['OfferLetterImage'];
            $oldINT_CON_Letter =  $data['documents'][0]['INT_CON_Letter'];
            // $oldEmployerConformation =  $data['documents'][0]['EmployerConformation'];
            // print_r($oldEmployerConformation);exit();
        }

        // print_r('Hi'.$data['documents'][0]['OtherDocument']);exit();


        $canId = $this->request->getPost('CandidateId');
        $canName = $this->request->getPost('CandidateName');


        $SSLCMarksCardfile = $this->request->getFile('SSLCMarksCard');
        $PUCMarksCardfile = $this->request->getFile('PUCMarksCard');
        $DegreeMarksCardfile = $this->request->getFile('DegreeMarksCard');
        $AadharCardfile = $this->request->getFile('AadharCard');
        $PanCardfile = $this->request->getFile('PanCard');
        // $ExperienceLetterfile = $this->request->getFile('ExperienceLetter');
        // $PaySlipfile = $this->request->getFile('PaySlip');
        // $BankStatementfile = $this->request->getFile('BankStatement');
        $OtherDocumentfile = $this->request->getFile('OtherDocument');
        $OfferLetterImagefile = $this->request->getFile('OfferLetter');
        $INT_CON_Letterfile = $this->request->getFile('InternContract');
        // $EmployerConformationfile = $this->request->getFile('EmployerConformation');



        // print_r($SSLCMarksCardfile);exit();

        $target_dir = "Uploads/candidates/$canId-$canName/";
        if (!file_exists($target_dir)) {
            // print_r($target_dir);exit();
            mkdir('./Uploads/candidates/' . $canId . '-' . $canName, 0777, true);
        }

        if ($SSLCMarksCardfile->isValid() && !$SSLCMarksCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['SSLCMarksCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldSSLCMarksCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldSSLCMarksCard);
                }
            }
            $SSLCMarksCardfileName = $SSLCMarksCardfile->getClientName();
            $SSLCMarksCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $SSLCMarksCardfileName);
        } else {
            if (!empty($data['documents'][0]['SSLCMarksCard'])) {
                $SSLCMarksCardfileName =  $oldSSLCMarksCard;
            } else {
                $SSLCMarksCardfileName = $this->request->getFile('SSLCMarksCard');
            }
        }


        if ($PUCMarksCardfile->isValid() && !$PUCMarksCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['PUCMarksCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldPUCMarksCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldPUCMarksCard);
                }
            }
            $PUCMarksCardfileName = $PUCMarksCardfile->getClientName();
            $PUCMarksCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $PUCMarksCardfileName);
        } else {
            if (!empty($data['documents'][0]['PUCMarksCard'])) {
                $PUCMarksCardfileName =  $oldPUCMarksCard;
            } else {
                $PUCMarksCardfileName = $this->request->getFile('PUCMarksCard');
            }
        }
        if ($DegreeMarksCardfile->isValid() && !$DegreeMarksCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['DegreeMarksCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldDegreeMarksCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldDegreeMarksCard);
                }
            }
            $DegreeMarksCardfileName = $DegreeMarksCardfile->getClientName();
            $DegreeMarksCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $DegreeMarksCardfileName);
        } else {
            if (!empty($data['documents'][0]['DegreeMarksCard'])) {
                $DegreeMarksCardfileName =  $oldDegreeMarksCard;
            } else {
                $DegreeMarksCardfileName = $this->request->getFile('DegreeMarksCard');
            }
        }
        if ($AadharCardfile->isValid() && !$AadharCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['AadharCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldAadharCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldAadharCard);
                }
            }
            $AadharCardfileName = $AadharCardfile->getClientName();
            $AadharCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $AadharCardfileName);
        } else {
            if (!empty($data['documents'][0]['AadharCard'])) {
                $AadharCardfileName =  $oldAadharCard;
            } else {
                $AadharCardfileName = $this->request->getFile('AadharCard');
            }
        }
        if ($PanCardfile->isValid() && !$PanCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['PanCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldPanCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldPanCard);
                }
            }
            $PanCardfileName = $PanCardfile->getClientName();
            $PanCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $PanCardfileName);
        } else {
            if (!empty($data['documents'][0]['PanCard'])) {
                $PanCardfileName =  $oldPanCard;
            } else {
                $PanCardfileName = $this->request->getFile('PanCard');
            }
        }
        // if($ExperienceLetterfile->isValid() && !$ExperienceLetterfile->hasMoved()) {
        //     if(!empty($data['documents'])){
        //         if(!file_exists("Uploads/candidates/$canId-$canName/".$oldExperienceLetter)){
        //             unlink("Uploads/candidates/$canId-$canName/".$oldExperienceLetter);
        //         }
        //     }
        //     $ExperienceLetterfileName = $ExperienceLetterfile->getClientName();
        //     $ExperienceLetterfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $ExperienceLetterfileName);
        // }else{
        //     if(!empty($data['documents'])){
        //         $ExperienceLetterfileName =  $oldExperienceLetter;
        //     }else{
        //         $ExperienceLetterfileName = $this->request->getFile('ExperienceLetter');
        //     }
        // }
        // if($PaySlipfile->isValid() && !$PaySlipfile->hasMoved()) {
        //     if(!empty($data['documents'])){
        //     if(!file_exists("Uploads/candidates/$canId-$canName/".$oldPaySlip)){
        //         unlink("Uploads/candidates/$canId-$canName/".$oldPaySlip);
        //     }}
        //     $PaySlipfileName = $PaySlipfile->getClientName();
        //     $PaySlipfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $PaySlipfileName);
        // }else{
        //     if(!empty($data['documents'])){
        //         $PaySlipfileName =  $oldPaySlip;
        //     }else{
        //         $PaySlipfileName = $this->request->getFile('PaySlip');
        //     }
        // }

        // if($BankStatementfile->isValid() && !$BankStatementfile->hasMoved()) {
        //     if(!empty($data['documents'])){
        //     if(!file_exists("Uploads/candidates/$canId-$canName/".$oldBankStatement)){
        //         unlink("Uploads/candidates/$canId-$canName/".$oldBankStatement);
        //     }}
        //     $BankStatementfileName = $BankStatementfile->getClientName();
        //     $BankStatementfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $BankStatementfileName);
        // }else{
        //     if(!empty($data['documents'])){
        //         $BankStatementfileName =  $oldBankStatement;
        //     }else{
        //         $BankStatementfileName = $this->request->getFile('BankStatement');
        //     }
        // }
        if ($OtherDocumentfile->isValid() && !$OtherDocumentfile->hasMoved()) {
            if (!empty($data['documents'][0]['OtherDocument'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldOtherDocument)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldOtherDocument);
                }
            }
            $OtherDocumentfileName = $OtherDocumentfile->getClientName();
            $OtherDocumentfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $OtherDocumentfileName);
        } else {
            if (!empty($data['documents'][0]['OtherDocument'])) {
                $OtherDocumentfileName =  $oldOtherDocument;
            } else {
                $OtherDocumentfileName = $this->request->getFile('OtherDocument');
            }
        }
        if ($OfferLetterImagefile->isValid() && !$OfferLetterImagefile->hasMoved()) {
            if (!empty($data['documents'][0]['OfferLetterImage'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldOfferLetterImage)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldOfferLetterImage);
                }
            }
            $OfferLetterImagefileName = $OfferLetterImagefile->getClientName();
            $OfferLetterImagefile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $OfferLetterImagefileName);
        } else {
            if (!empty($data['documents'][0]['OfferLetterImage'])) {
                $OfferLetterImagefileName =  $oldOfferLetterImage;
            } else {
                $OfferLetterImagefileName = $this->request->getFile('OfferLetterImage');
            }
        }
        if ($INT_CON_Letterfile->isValid() && !$INT_CON_Letterfile->hasMoved()) {
            if (!empty($data['documents'][0]['INT_CON_Letter'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldINT_CON_Letter)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldINT_CON_Letter);
                }
            }
            $INT_CON_LetterfileName = $INT_CON_Letterfile->getClientName();
            $INT_CON_Letterfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $INT_CON_LetterfileName);
        } else {
            if (!empty($data['documents'][0]['INT_CON_Letter'])) {
                $INT_CON_LetterfileName =  $oldINT_CON_Letter;
            } else {
                $INT_CON_LetterfileName = $this->request->getFile('INT_CON_Letter');
            }
        }
        // if($EmployerConformationfile->isValid() && !$EmployerConformationfile->hasMoved()) {
        //     if(!empty($data['documents'])){
        //     if(!file_exists("Uploads/candidates/$canId-$canName/".$oldEmployerConformation)){
        //         unlink("Uploads/candidates/$canId-$canName/".$oldEmployerConformation);
        //     }}
        //     $EmployerConformationfileName = $EmployerConformationfile->getClientName();
        //     $EmployerConformationfile->move('Uploads/candidates/'.$canId.'-'.$canName.'/', $EmployerConformationfileName);
        // }else{
        //     if(!empty($data['documents'])){
        //         $EmployerConformationfileName =  $oldEmployerConformation;
        //     }else{
        //         $EmployerConformationfileName = $this->request->getFile('EmployerConformation');
        //     }

        // }



        $data = [
            'CandidateId' => $this->request->getPost('CandidateId'),
            'SSLCMarksCard' => $SSLCMarksCardfileName,
            'PUCMarksCard' => $PUCMarksCardfileName,
            'DegreeMarksCard' => $DegreeMarksCardfileName,
            'AadharCard' => $AadharCardfileName,
            'PanCard' => $PanCardfileName,
            // 'ExperienceLetter' => $ExperienceLetterfileName,
            // 'PaySlip' => $PaySlipfileName,
            // 'BankStatement' => $BankStatementfileName,
            'OtherDocument' => $OtherDocumentfileName,
            'OfferLetterImage' => $OfferLetterImagefileName,
            'INT_CON_Letter' => $INT_CON_LetterfileName,
            // 'EmployerConformation' => $EmployerConformationfileName,
            'DVStatus' => $this->request->getPost('DVStatus'),
            'DVRemarks' => $this->request->getPost('DVRemarks1'),
            'DVRemarks' => $this->request->getPost('DVRemarks'),
        ];
        // print_r($data);exit();

        $this->candidateModel->fresher_update_documentM($data);


        return $this->response->redirect(site_url('/background_doc?canId=' . $canId));
    }
    public function experienced_update_documentC()
    {
        $data = [
            // 'canId' => $_GET['canId'],
            'canId' => $this->request->getPost('CandidateId'),
        ];


        $data['documents'] = $this->candidateModel->getDocM($data);
        // print_r($data['documents']);exit();
        if (!empty($data['documents'])) {
            $oldSSLCMarksCard =  $data['documents'][0]['SSLCMarksCard'];
            $oldPUCMarksCard =  $data['documents'][0]['PUCMarksCard'];
            $oldDegreeMarksCard =  $data['documents'][0]['DegreeMarksCard'];
            $oldAadharCard =  $data['documents'][0]['AadharCard'];
            $oldPanCard =  $data['documents'][0]['PanCard'];
            $oldExperienceLetter =  $data['documents'][0]['ExperienceLetter'];
            $oldPaySlip =  $data['documents'][0]['PaySlip'];
            $oldBankStatement =  $data['documents'][0]['BankStatement'];
            $oldOtherDocument =  $data['documents'][0]['OtherDocument'];
            $oldOfferLetterImage =  $data['documents'][0]['OfferLetterImage'];
            $oldINT_CON_Letter =  $data['documents'][0]['INT_CON_Letter'];
            $oldEmployerConformation =  $data['documents'][0]['EmployerConformation'];
            // print_r($oldEmployerConformation);exit();
        }


        $canId = $this->request->getPost('CandidateId');
        $canName = $this->request->getPost('CandidateName');


        $SSLCMarksCardfile = $this->request->getFile('SSLCMarksCard');
        $PUCMarksCardfile = $this->request->getFile('PUCMarksCard');
        $DegreeMarksCardfile = $this->request->getFile('DegreeMarksCard');
        $AadharCardfile = $this->request->getFile('AadharCard');
        $PanCardfile = $this->request->getFile('PanCard');
        $ExperienceLetterfile = $this->request->getFile('ExperienceLetter');
        $PaySlipfile = $this->request->getFile('PaySlip');
        $BankStatementfile = $this->request->getFile('BankStatement');
        $OtherDocumentfile = $this->request->getFile('OtherDocument');
        $OfferLetterImagefile = $this->request->getFile('OfferLetter');
        $INT_CON_Letterfile = $this->request->getFile('InternContract');
        $EmployerConformationfile = $this->request->getFile('EmployerConformation');



        // print_r($SSLCMarksCardfile);exit();
        // print_r($PUCMarksCardfile);exit();

        $target_dir = "Uploads/candidates/$canId-$canName/";
        if (!file_exists($target_dir)) {
            mkdir('./Uploads/candidates/' . $canId . '-' . $canName, 0777, true);
        }

        if ($SSLCMarksCardfile->isValid() && !$SSLCMarksCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['SSLCMarksCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldSSLCMarksCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldSSLCMarksCard);
                }
            }
            $SSLCMarksCardfileName = $SSLCMarksCardfile->getClientName();
            $SSLCMarksCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $SSLCMarksCardfileName);
        } else {
            if (!empty($data['documents'][0]['SSLCMarksCard'])) {
                $SSLCMarksCardfileName =  $oldSSLCMarksCard;
            } else {
                $SSLCMarksCardfileName = $this->request->getFile('SSLCMarksCard');
            }
        }


        if ($PUCMarksCardfile->isValid() && !$PUCMarksCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['PUCMarksCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldPUCMarksCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldPUCMarksCard);
                }
            }
            $PUCMarksCardfileName = $PUCMarksCardfile->getClientName();
            $PUCMarksCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $PUCMarksCardfileName);
        } else {
            if (!empty($data['documents'][0]['PUCMarksCard'])) {
                $PUCMarksCardfileName =  $oldPUCMarksCard;
            } else {
                $PUCMarksCardfileName = $this->request->getFile('PUCMarksCard');
            }
        }
        if ($DegreeMarksCardfile->isValid() && !$DegreeMarksCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['DegreeMarksCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldDegreeMarksCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldDegreeMarksCard);
                }
            }
            $DegreeMarksCardfileName = $DegreeMarksCardfile->getClientName();
            $DegreeMarksCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $DegreeMarksCardfileName);
        } else {
            if (!empty($data['documents'][0]['DegreeMarksCard'])) {
                $DegreeMarksCardfileName =  $oldDegreeMarksCard;
            } else {
                $DegreeMarksCardfileName = $this->request->getFile('DegreeMarksCard');
            }
        }
        if ($AadharCardfile->isValid() && !$AadharCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['AadharCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldAadharCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldAadharCard);
                }
            }
            $AadharCardfileName = $AadharCardfile->getClientName();
            $AadharCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $AadharCardfileName);
        } else {
            if (!empty($data['documents'][0]['AadharCard'])) {
                $AadharCardfileName =  $oldAadharCard;
            } else {
                $AadharCardfileName = $this->request->getFile('AadharCard');
            }
        }
        if ($PanCardfile->isValid() && !$PanCardfile->hasMoved()) {
            if (!empty($data['documents'][0]['PanCard'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldPanCard)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldPanCard);
                }
            }
            $PanCardfileName = $PanCardfile->getClientName();
            $PanCardfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $PanCardfileName);
        } else {
            if (!empty($data['documents'][0]['PanCard'])) {
                $PanCardfileName =  $oldPanCard;
            } else {
                $PanCardfileName = $this->request->getFile('PanCard');
            }
        }
        if ($ExperienceLetterfile->isValid() && !$ExperienceLetterfile->hasMoved()) {
            if (!empty($data['documents'][0]['ExperienceLetter'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldExperienceLetter)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldExperienceLetter);
                }
            }
            $ExperienceLetterfileName = $ExperienceLetterfile->getClientName();
            $ExperienceLetterfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $ExperienceLetterfileName);
        } else {
            if (!empty($data['documents'][0]['ExperienceLetter'])) {
                $ExperienceLetterfileName =  $oldExperienceLetter;
            } else {
                $ExperienceLetterfileName = $this->request->getFile('ExperienceLetter');
            }
        }
        if ($PaySlipfile->isValid() && !$PaySlipfile->hasMoved()) {
            if (!empty($data['documents'][0]['PaySlip'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldPaySlip)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldPaySlip);
                }
            }
            $PaySlipfileName = $PaySlipfile->getClientName();
            $PaySlipfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $PaySlipfileName);
        } else {
            if (!empty($data['documents'][0]['PaySlip'])) {
                $PaySlipfileName =  $oldPaySlip;
            } else {
                $PaySlipfileName = $this->request->getFile('PaySlip');
            }
        }

        if ($BankStatementfile->isValid() && !$BankStatementfile->hasMoved()) {
            if (!empty($data['documents'][0]['BankStatement'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldBankStatement)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldBankStatement);
                }
            }
            $BankStatementfileName = $BankStatementfile->getClientName();
            $BankStatementfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $BankStatementfileName);
        } else {
            if (!empty($data['documents'][0]['BankStatement'])) {
                $BankStatementfileName =  $oldBankStatement;
            } else {
                $BankStatementfileName = $this->request->getFile('BankStatement');
            }
        }
        if ($OtherDocumentfile->isValid() && !$OtherDocumentfile->hasMoved()) {
            if (!empty($data['documents'][0]['OtherDocument'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldOtherDocument)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldOtherDocument);
                }
            }
            $OtherDocumentfileName = $OtherDocumentfile->getClientName();
            $OtherDocumentfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $OtherDocumentfileName);
        } else {
            if (!empty($data['documents'][0]['OtherDocument'])) {
                $OtherDocumentfileName =  $oldOtherDocument;
            } else {
                $OtherDocumentfileName = $this->request->getFile('OtherDocument');
            }
        }
        if ($OfferLetterImagefile->isValid() && !$OfferLetterImagefile->hasMoved()) {
            if (!empty($data['documents'][0]['OfferLetterImage'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldOfferLetterImage)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldOfferLetterImage);
                }
            }
            $OfferLetterImagefileName = $OfferLetterImagefile->getClientName();
            $OfferLetterImagefile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $OfferLetterImagefileName);
        } else {
            if (!empty($data['documents'][0]['OfferLetterImage'])) {
                $OfferLetterImagefileName =  $oldOfferLetterImage;
            } else {
                $OfferLetterImagefileName = $this->request->getFile('OfferLetterImage');
            }
        }
        if ($INT_CON_Letterfile->isValid() && !$INT_CON_Letterfile->hasMoved()) {
            if (!empty($data['documents'][0]['INT_CON_Letter'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldINT_CON_Letter)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldINT_CON_Letter);
                }
            }
            $INT_CON_LetterfileName = $INT_CON_Letterfile->getClientName();
            $INT_CON_Letterfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $INT_CON_LetterfileName);
        } else {
            if (!empty($data['documents'][0]['INT_CON_Letter'])) {
                $INT_CON_LetterfileName =  $oldINT_CON_Letter;
            } else {
                $INT_CON_LetterfileName = $this->request->getFile('INT_CON_Letter');
            }
        }
        if ($EmployerConformationfile->isValid() && !$EmployerConformationfile->hasMoved()) {
            if (!empty($data['documents'][0]['EmployerConformation'])) {
                if (file_exists("Uploads/candidates/$canId-$canName/" . $oldEmployerConformation)) {
                    unlink("Uploads/candidates/$canId-$canName/" . $oldEmployerConformation);
                }
            }
            $EmployerConformationfileName = $EmployerConformationfile->getClientName();
            $EmployerConformationfile->move('Uploads/candidates/' . $canId . '-' . $canName . '/', $EmployerConformationfileName);
        } else {
            if (!empty($data['documents'][0]['EmployerConformation'])) {
                $EmployerConformationfileName =  $oldEmployerConformation;
            } else {
                $EmployerConformationfileName = $this->request->getFile('EmployerConformation');
            }
        }



        $data = [
            'CandidateId' => $this->request->getPost('CandidateId'),
            'SSLCMarksCard' => $SSLCMarksCardfileName,
            'PUCMarksCard' => $PUCMarksCardfileName,
            'DegreeMarksCard' => $DegreeMarksCardfileName,
            'AadharCard' => $AadharCardfileName,
            'PanCard' => $PanCardfileName,
            'ExperienceLetter' => $ExperienceLetterfileName,
            'PaySlip' => $PaySlipfileName,
            'BankStatement' => $BankStatementfileName,
            'OtherDocument' => $OtherDocumentfileName,
            'OfferLetterImage' => $OfferLetterImagefileName,
            'INT_CON_Letter' => $INT_CON_LetterfileName,
            'EmployerConformation' => $EmployerConformationfileName,
            'DVStatus' => $this->request->getPost('DVStatus'),
            'DVRemarks' => $this->request->getPost('DVRemarks1'),
            'DVRemarks' => $this->request->getPost('DVRemarks'),
        ];
        // print_r($data);exit();

        $this->candidateModel->update_documentM($data);


        return $this->response->redirect(site_url('/background_doc?canId=' . $canId));
    }
    public function insert_offer_letterC()
    {
        $data = [
            'canId' => $this->request->getPost('CandidateIDFK'),
        ];

        $canId = $this->request->getPost('CandidateIDFK');
        $canName = $this->request->getPost('CandidateName');
        $to = $this->request->getPost('CandidateEmail');
        $subject = $canName . ' - Offer Letter - Homes247.in';
        $body = $this->request->getPost('OL_OfferMsg');
        require_once '../vendor/autoload.php';

        // Create the Transport
        // $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
        //     ->setUsername('indiaestatehomes@gmail.com')
        //     ->setPassword('ffpc xuul oyxb nint');
        // $mailer = new \Swift_Mailer($transport);
        // $message = (new \Swift_Message('Wonderful Subject'))
        //     ->setFrom(['indiaestatehomes@gmail.com' => 'Homes247.in'])
        //     ->setTo([$to])
        //     ->setSubject($subject)
        //     ->setBody($body, 'text/html');
        // $result = $mailer->send($message);

        $PhpMailer = \Config\Services::email();
        $PhpMailer->setFrom('indiaestatehomes@gmail.com', 'Homes247');
        $PhpMailer->setTo([$to]);
        $PhpMailer->setSubject($subject);
        $PhpMailer->setMessage($body);
        $PhpMailer->send();

        $data['status'] = 'True';
        $data['code'] = '0';
        $data['message'] = 'successfully added';
        $data['success'] = 'success';

        $data = [
            'CandidateIDFK' => $this->request->getPost('CandidateIDFK'),
            'DepartmentIDFK' => $this->request->getPost('DepartmentIDFK'),
            'DesignationIDFK' => $this->request->getPost('DesignationIDFK'),
            'ReportManagerIDFK' => $this->request->getPost('ReportManagerIDFK'),
            'TakeOmSalary' => $this->request->getPost('TakeOmSalary'),
            'JoiningDate' => $this->request->getPost('JoiningDate'),
            'OL_OfferMsg' => $this->request->getPost('OL_OfferMsg'),

        ];
        // print_r($data);exit();
        $this->candidateModel->insert_offer_letterM($data);

        return $this->response->redirect(site_url('/interview_process?canId=' . $canId));
    }
    public function offer_letter_processC()
    {
        $data = [
            'canId' => $_GET['canId'],
        ];


        $data['candidate_details'] = $this->candidateModel->Candidate_DetailsM($data);
        $data['offerLetter'] = $this->candidateModel->getOfferLetterM($data);
        $data['documents'] = $this->candidateModel->getDocM($data);

        $data['selectdesignation'] = $this->empModel->selectdesignationM();
        $data['selectdepart'] = $this->empModel->selectdepartM();
        $data['reportManager'] = $this->interviewerModel->getReportingManager();
        $data['selectEmpType'] = $this->empModel->selectEmpTypeM();

        return view('candidates/offer_letter', $data);
    }
    public function update_confirmationC()
    {
        // $data = [
        //     'canId' => $_GET['canId'],
        // ];
        $canId = $this->request->getPost('CandidateIDFK');
        $fdate = date('Y-m-d');
        $todate = date('Y-m-d');


        $data = [
            'CandidateIDFK' => $this->request->getPost('CandidateIDFK'),
            'CandidateConfirmation' => $this->request->getPost('CandidateConfirmation'),

        ];

        // print_r($data);exit();
        $this->candidateModel->update_confirmationM($data);

        // return $this->response->redirect(site_url('/candidate?fdate='.$fdate.'&todate='.$todate.'&trickid=4'));
        $session = session();
        $userLevel = $session->get('user_level');
        if ($userLevel == 42) {
            return $this->response->redirect(site_url('/interview_process?canId=' . $canId));
        } elseif ($userLevel == 18 || $userLevel == 1) {
            return $this->response->redirect(site_url('/HRcandidate_List?fdate=' . $fdate . '&todate=' . $todate . '&trickid=4'));
        }
    }
    public function joined_candidate_viewC()
    {
        $data = [
            'canId' => $_GET['canId'],
        ];


        $data['candidate_details'] = $this->candidateModel->Candidate_DetailsM($data);
        // $data['notScheduleReasons'] = $this->candidateModel->notschedule_reasons_ListM();
        // $data['select_interviewer'] = $this->candidateModel->select_interviewerM();
        $data['roundDetails'] = $this->candidateModel->roundDetailsM($data);
        $data['roundList'] = $this->candidateModel->round_listM($data);

        $data['offerLetter'] = $this->candidateModel->getOfferLetterM($data);
        $data['documents'] = $this->candidateModel->getDocM($data);
        // print_r($data['documents']);exit();

        return view('candidates/joined_candidate_view', $data);
    }
    public function update_JoinStatusC()
    {
        $data = [
            'canId' => $this->request->getPost('CandidateIDFK'),
        ];
        $fdate = date("Y-m-d");
        $todate = date("Y-m-d");
        $canId = $this->request->getPost('CandidateIDFK');


        // $data['roundList'] = $this->candidateModel->round_listM($data);
        // print_r($data['roundList'][0]);exit();

        $data = [
            'CandidateIDFK' => $this->request->getPost('CandidateIDFK'),
            'JoiningStatus' => $this->request->getPost('JoiningStatus'),

        ];

        // print_r($data);exit();
        $save = $this->candidateModel->update_JoinStatusM($data);

        // if($data['JoiningStatus']==2){

        //     return $this->response->redirect(site_url('/candidate?fdate='.$fdate.'&todate='.$todate.'&trickid=4'));
        // }else{

        //     return $this->response->redirect(site_url('/candidate?fdate='.$fdate.'&todate='.$todate.'&trickid=8'));
        // }

        $session = session();
        $userLevel = $session->get('user_level');
        if ($userLevel == 42) {
            if ($data['JoiningStatus'] == 2) {
                return $this->response->redirect(site_url('/interview_process?canId=' . $canId));
            } else {
                return $this->response->redirect(site_url('/interview_process?canId=' . $canId));
            }
        } elseif ($userLevel == 18 || $userLevel == 1) {
            // return $this->response->redirect(site_url('/HRcandidate_List?fdate='.$fdate.'&todate='.$todate.'&trickid=1'));
            if ($data['JoiningStatus'] == 2) {
                return $this->response->redirect(site_url('/HRcandidate_List?fdate=' . $fdate . '&todate=' . $todate . '&trickid=4'));
            } else {
                return $this->response->redirect(site_url('/HRcandidate_List?fdate=' . $fdate . '&todate=' . $todate . '&trickid=8'));
            }
        }
    }
    public function update_WorkingStatusC()
    {
        $data = [
            'canId' => $this->request->getPost('CandidateIDFK'),
        ];
        $fdate = date("Y-m-d");
        $todate = date("Y-m-d");
        $canId = $this->request->getPost('CandidateIDFK');

        $data = [
            'CandidateIDFK' => $this->request->getPost('CandidateIDFK'),
            'WorkingStatus' => $this->request->getPost('WorkingStatus'),
            'EmployementType' => $this->request->getPost('EmployementType'),

        ];

        // print_r($data);exit();
        $save = $this->candidateModel->update_WorkingStatusM($data);

        // return $this->response->redirect(site_url('/candidate?fdate='.$fdate.'&todate='.$todate.'&trickid=8'));
        $session = session();
        $userLevel = $session->get('user_level');
        if ($userLevel == 42) {
            return $this->response->redirect(site_url('/interview_process?canId=' . $canId));
        } elseif ($userLevel == 18 || $userLevel == 1) {
            return $this->response->redirect(site_url('/HRcandidate_List?fdate=' . $fdate . '&todate=' . $todate . '&trickid=8'));
        }
    }


    // function candidates_applicationC(){
    //     $data = [
    //         'canId' => $_GET['canId'],
    //     ];

    //     $data['candidate_details'] = $this->candidateModel->Candidate_DetailsM($data);
    //     $data['showHR'] = $this->empModel->getHR();
    //     $data['selectdesignation'] = $this->empModel->selectdesignationM();
    //     $data['socialMedia'] = $this->candidateModel->Candidate_Source_ListM();
    //     // print_r($data['showHR']);exit();
    //     return view('candidates/candidatesApplication',$data);
    // }



    // ******************************************** Individual_HR *************************************************************************// 

    public function HRdashboard()
    {
        $candidateModel = new CandidateModel();
        $session = session();
        $HRid = $session->get('EmpIDFK');
        $data['HRid'] = $HRid;

        $data = [
            'fdate' => $_GET['fdate'],
            'todate' => $_GET['todate'],
        ];
        // print_r($HRid);exit();
        $data['HRassignedCandidatesCount'] = count($candidateModel->getHRassignedCandidatesCount($HRid, $data));
        $data['HRtotalCandidatesCount'] = count($candidateModel->getHRCandidatesCount($HRid, $data));
        $data['HRscheduledCount'] = count($candidateModel->getHRscheduledCount($HRid, $data));
        $data['HRnotScheduledCount'] = count($candidateModel->getHRnotScheduledCount($HRid, $data));
        $data['HRSelectedCandidatesCount'] = count($candidateModel->getHRSelectedCandidatesCount($HRid, $data));
        $data['HRJoinedCandidatesCount'] = count($candidateModel->getHRJoinedCandidatesCount($HRid, $data));
        $data['HRrejectedCandidatesCount'] = count($candidateModel->getHRrejectedCandidatesCount($HRid, $data));
        // print_r($data['HRassignedCandidatesCount']);exit();
        $this->admin->AutoRemoveHolidays();

        $data['allCareerList'] = $this->careerModel->ShowAll($data);
        $data['workAnniversarys'] = $this->empModel->workAnniversaryDetails();
        $data['birthdays'] = $this->empModel->birthdayDetails();
        $data['events'] = $this->empModel->eventsDetails();

        return view('HR/HRdashboard', $data);
    }

    // public function HRtodays_candidate_activityC(){
    //     $session = session();
    //     $data = [
    //         'trickid' => $_GET['trickid'],
    //         // 'fdate' => $_GET['fdate'],
    //         // 'todate' => $_GET['todate'],
    //         // 'HR_IDFK' => $_GET['HR_IDFK'],
    //         'HR_IDFK' => $session->get('EmpIDFK'),
    //         'userLevel' => $session->get('user_level'),
    //     ];

    //     $data['curentDayActivity'] = $this->candidateModel->getCurrentdayActivity($data);
    //     $data['curentDayCount'] = $this->candidateModel->getCurrentdayCount($data);
    //     // $data['freshlistcount'] = $this->candidateModel->getCurrentdayActivity($data);

    //     // print_r($data['curentDayCount']);exit();


    //     return view('HR/HRtodays_activity', $data);
    // }

    // public function HRcandidate_ListC()
    // {
    //     $session = session();
    //     $data = [
    //         'trickid' => $_GET['trickid'],
    //         'fdate' => $_GET['fdate'],
    //         'todate' => $_GET['todate'],
    //         'HR_IDFK' => $session->get('EmpIDFK'),
    //         'userLevel' => $session->get('user_level'),
    //     ];
    //     $userLevel = $session->get('user_level');

    //     $data['freshCandidate_list'] = $this->candidateModel->HR_fresh_List_CandidatesM($data);
    //     $data['candidate_list'] = $this->candidateModel->HR_List_CandidatesM($data);
    //     $data['candidateStatus_list'] = $this->candidateModel->getHRCandidateInterviewStatusM($data);
    //     $data['candiadtecounts'] = $this->candidateModel->HR_CandidateCountsM($data);
    //     $data['notScheduledList'] = $this->candidateModel->getHRNotScheduledList($data);            
    //     $data['candidateOfferStatus_list'] = $this->candidateModel->getHRCandidateOfferStatusM($data);    

    //     return view('HR/HRcandidates_list_view', $data);
    // }
    public function HRadmin_individual_candidate_ListC()
    {
        $session = session();
        $data = [
            'trickid' => $_GET['trickid'],
            'fdate' => $_GET['fdate'],
            'todate' => $_GET['todate'],
            'HR_IDFK' => $_GET['HR_IDFK'],
            // 'HR_IDFK' => $session->get('EmpIDFK'),
            'userLevel' => $session->get('user_level'),
        ];
        $userLevel = $session->get('user_level');

        $data['showHR'] = $this->empModel->getHR();
        $data['freshCandidate_list'] = $this->candidateModel->HR_fresh_List_CandidatesM($data);
        $data['candidate_list'] = $this->candidateModel->HR_List_CandidatesM($data);
        $data['candidateStatus_list'] = $this->candidateModel->getHRCandidateInterviewStatusM($data);
        $data['candiadtecounts'] = $this->candidateModel->HR_CandidateCountsM($data);
        $data['notScheduledList'] = $this->candidateModel->getHRNotScheduledList($data);
        $data['candidateOfferStatus_list'] = $this->candidateModel->getHRCandidateOfferStatusM($data);

        // print_r($data['candidateOfferStatus_list']);exit();
        return view('HR/HRadmin_individual_candidate_List', $data);
    }

    // ============================================== Aravinth code ==========================================

    public function Careers()
    {
        $data = [
            'fdate' => $_GET['fdate'] ?? date('Y-m-d'),
            'todate' => $_GET['todate'] ?? date('Y-m-d')
        ];
        $data['allCareerList'] = $this->careerModel->ShowAll($data);
        // print_r(json_encode($data['allCareerList']));
        // exit(0);
        return view('careers/careers_view', $data);
    }

    public function AddCareer()
    {
        $data['selectCareerCat'] = $this->careerModel->ShowAllCat();
        $data['options'] = $this->candidateModel->GetJobExperience();
        return view('careers/add_career', $data);
    }

    public function Storecareer()
    {
        $data = [
            'job_cat_IDFK' => $this->request->getPost('JobCategory'),
            'job_Title' => $this->request->getPost('JobTitle'),
            'job_type' => $this->request->getPost('JobType'),
            'job_experience' => $this->request->getPost('JobExperience'),
            'active_Id' => 0,
            'company_profile' => $this->request->getPost('profile'),
            'job_overview' => $this->request->getPost('overview'),
            'qualifications' => json_encode($this->formatToAssociativeArray($this->request->getPost('qualifications'), 'qualification')),
            'skills' => json_encode($this->formatToAssociativeArray($this->request->getPost('skills'), 'skill')),
            'roles' => json_encode($this->formatToAssociativeArray($this->request->getPost('roles'), 'role')),
        ];
        // print_r($data);exit(0);
        $this->careerModel->insert($data);
        return $this->response->redirect(site_url('/careers'));
    }

    private function formatToAssociativeArray($items, $keyName)
    {
        $formatted = [];
        foreach ($items as $item) {
            $formatted[] = [$keyName => $item];
        }
        return $formatted;
    }

    public function EditCareer($id)
    {
        $data['career'] = $this->careerModel->FindCareer($id);
        // print_r($data);exit(0);
        $data['selectCareerCat'] = $this->careerModel->ShowAllCat();
        $data['options'] = $this->candidateModel->GetJobExperience();
        return view('careers/edit_career', $data);
    }

    public function Updatecareer($id)
    {
        $data = [
            'job_cat_IDFK' => $this->request->getPost('JobCategory'),
            'job_type' => $this->request->getPost('JobType'),
            'job_Title' => $this->request->getPost('JobTitle'),
            'job_description' => $this->request->getPost('JobDescription'),
            'job_experience' => $this->request->getPost('JobExperience'),
            'company_profile' => $this->request->getPost('profile'),
            'job_overview' => $this->request->getPost('overview'),
            'qualifications' => json_encode($this->formatToAssociativeArray($this->request->getPost('qualifications'), 'qualification')),
            'skills' => json_encode($this->formatToAssociativeArray($this->request->getPost('skills'), 'skill')),
            'roles' => json_encode($this->formatToAssociativeArray($this->request->getPost('roles'), 'role')),
        ];
        // print_r($data);exit();
        $this->careerModel->update($id, $data);
        return $this->response->redirect(site_url('/careers'));
    }

    public function StatusCareer($id)
    {
        $status = $this->careerModel->FindCareerStatus($id);
        // print_r($status['active_Id']);exit(0);
        if ($status['active_Id']) {
            $data = ['active_Id' => 0];
        } else {
            $data = ['active_Id' => 1];
        }
        $this->careerModel->update($id, $data);
        return $this->response->redirect(site_url('/careers'));
    }

    public function delete_career($id)
    {
        $CModel = new CareerModel();
        $CModel->where('job_IDPK', $id);
        $CModel->delete();
        return $this->response->redirect(site_url('/careers'));
    }

    public function Applicants($id)
    {
        $data = [
            'fdate' => $_GET['fdate'],
            'todate' => $_GET['todate']
        ];
        $data['designation'] = $this->careerModel->PositionName($id);
        $data['designation_id'] = $id;
        $data['Tapplicants'] = count($this->careerModel->AllApplicants($id, $data));
        $data['applicants'] = $this->careerModel->UniqueApplicants($id, $data);
        // print_r($data);exit(0);
        return view('careers/applicants_view', $data);
    }

    //*******************************************// Starts Candidates //***********************************************************************//

    public function candidate_ListC()
    {
        $session = session();
        $adminId = $session->get('EmpIDFK');

        $data['fdate'] = $_GET['fdate'] ?? '';
        $data['todate'] = $_GET['todate'] ?? '';
        $data['trickid'] = $_GET['trickid'] ?? '';
        $data['filter_designation'] = $_GET['fd'] ?? '';
        $data['filter_source'] = $_GET['fs'] ?? '';
        $data['filter_hr'] = $_GET['hr'] ?? '';
        $data['filter_s_date_1'] = $_GET['fsd-1'] ?? '';
        $data['filter_e_date_1'] = $_GET['fed-1'] ?? '';
        $data['filter_s_date_2'] = $_GET['fsd-2'] ?? '';
        $data['filter_e_date_2'] = $_GET['fed-2'] ?? '';
        $data['filter_reason'] = $_GET['res'] ?? '';
        $data['int_s_date'] = $_GET['int-s'] ?? '';
        $data['int_e_date'] = $_GET['int-e'] ?? '';
        $data['INT_STATUS'] = [
            ['id' => '10', 'text' => 'Initial Review',],
            ['id' => '1', 'text' => 'Round 1'],
            ['id' => '2', 'text' => 'Round 2'],
            ['id' => '3', 'text' => 'Round 3'],
            ['id' => '4', 'text' => 'Round 4'],
            ['id' => '5', 'text' => 'Round 5'],
            ['id' => '6', 'text' => 'Round 6']
        ];
        $data['HRS'] = $this->empModel->getHRList();
        $data['DESIGNATIONS'] = $this->candidateModel->getDesignationList();
        $data['SOURCES'] = $this->candidateModel->getSourceList();
        $data['REASONS'] = $this->candidateModel->getReasonsList();
        $data['socialMedia'] = $this->candidateModel->Candidate_Source_ListM();
        $data['yetToAssignCount'] = $this->candidateModel->getYettoAssignListCount($adminId);
        $data['HRList'] = $this->empModel->getHRList();
        $data['selectdesignation'] = $this->empModel->selectdesignationM();
        $data['socialMedia'] = $this->candidateModel->Candidate_Source_ListM();
        $data['notScheduleReasons'] = $this->candidateModel->notschedule_reasons_ListM();

        if ($_GET['trickid'] == 11) {
            return view('candidates/candidates_today_scheduled', $data);
        } else if ($_GET['trickid'] == 9) {
            return view('candidates/candidates_upcoming_scheduled', $data);
        } else {
            return view('candidates/candidates_list_view', $data);
        }
    }
    public function candidate_ListCDT($trickid)
    {
        $HRid = null;
        $options_d = [
            'start' => $_GET['start'] ?? 0,
            'length' => $_GET['length'] ?? 10,
            'search' => $_GET['search']['value'] ?? '',
            'start_date_1' => $_GET['s_date_1'] ?? '',
            'end_date_1' => $_GET['e_date_1'] ?? '',
            'start_date_2' => $_GET['s_date_2'] ?? '',
            'end_date_2' => $_GET['e_date_2'] ?? '',
            'source' => $_GET['s_value'] ?? '',
            'designation' => $_GET['d_value'] ?? '',
            'hr' => $_GET['h_value'] ?? '',
            'reason' => $_GET['reason'] ?? '',
            'overdue' => $_GET['overdue'] ?? '',
        ];
        $options_t = [
            'start' => '',
            'length' => '',
            'search' => '',
            'start_date_1' => '',
            'end_date_1' => '',
            'start_date_2' => '',
            'end_date_2' => '',
            'source' => '',
            'designation' => '',
            'hr' => '',
            'reason' => '',
            'overdue' => $_GET['overdue'] ?? ''
        ];
        $options_f = [
            'start' => '',
            'length' => '',
            'search' => $_GET['search']['value'] ?? '',
            'start_date_1' => $_GET['s_date_1'] ?? '',
            'end_date_1' => $_GET['e_date_1'] ?? '',
            'start_date_2' => $_GET['s_date_2'] ?? '',
            'end_date_2' => $_GET['e_date_2'] ?? '',
            'source' => $_GET['s_value'] ?? '',
            'designation' => $_GET['d_value'] ?? '',
            'reason' => $_GET['reason'] ?? '',
            'hr' => $_GET['h_value'] ?? '',
            'overdue' => $_GET['overdue'] ?? ''
        ];

        if ($trickid != 8) {
            $options_limit = [
                'start' => '',
                'length' => '',
                'search' => '',
                'start_date_1' => '',
                'end_date_1' => '',
                'reason' => '',
                'start_date_2' => $_GET['s_date_2'] ?? '',
                'end_date_2' => $_GET['e_date_2'] ?? '',
                'source' => $_GET['s_value'] ?? '',
                'designation' => $_GET['d_value'] ?? '',
                'hr' => $_GET['h_value'] ?? '',
                'overdue' => $_GET['overdue'] ?? ''
            ];

            $options_limit_8 = [
                'start' => '',
                'length' => '',
                'search' => '',
                'reason' => '',
                'start_date_1' => $_GET['s_date_1'] ?? '',
                'end_date_1' => $_GET['e_date_1'] ?? '',
                'start_date_2' => '',
                'end_date_2' => '',
                'source' => $_GET['s_value'] ?? '',
                'designation' => $_GET['d_value'] ?? '',
                'hr' => $_GET['h_value'] ?? '',
                'overdue' => $_GET['overdue'] ?? ''
            ];

            $options_limit_456 = [
                'start' => '',
                'length' => '',
                'search' => '',
                'reason' => '',
                'start_date_1' => $_GET['s_date_1'] ?? '',
                'end_date_1' => $_GET['e_date_1'] ?? '',
                'start_date_2' => $_GET['s_date_2'] ?? '',
                'end_date_2' => $_GET['e_date_2'] ?? '',
                'source' => $_GET['s_value'] ?? '',
                'designation' => $_GET['d_value'] ?? '',
                'hr' => $_GET['h_value'] ?? '',
                'overdue' => $_GET['overdue'] ?? ''
            ];
        } else {
            $options_limit = [
                'start' => '',
                'length' => '',
                'search' => '',
                'start_date_1' => '',
                'end_date_1' => '',
                'reason' => '',
                'start_date_2' => '',
                'end_date_2' => '',
                'source' => $_GET['s_value'] ?? '',
                'designation' => $_GET['d_value'] ?? '',
                'hr' => $_GET['h_value'] ?? '',
                'overdue' => $_GET['overdue'] ?? ''
            ];

            $options_limit_456 = [
                'start' => '',
                'length' => '',
                'search' => '',
                'reason' => '',
                'start_date_1' => $_GET['s_date_1'] ?? '',
                'end_date_1' => $_GET['e_date_1'] ?? '',
                'start_date_2' => '',
                'end_date_2' => '',
                'source' => $_GET['s_value'] ?? '',
                'designation' => $_GET['d_value'] ?? '',
                'hr' => $_GET['h_value'] ?? '',
                'overdue' => $_GET['overdue'] ?? ''
            ];

            $options_limit_8 = [
                'start' => '',
                'length' => '',
                'search' => '',
                'reason' => '',
                'start_date_1' => $_GET['s_date_1'] ?? '',
                'end_date_1' => $_GET['e_date_1'] ?? '',
                'start_date_2' => $_GET['s_date_2'] ?? '',
                'end_date_2' => $_GET['e_date_2'] ?? '',
                'source' => $_GET['s_value'] ?? '',
                'designation' => $_GET['d_value'] ?? '',
                'hr' => $_GET['h_value'] ?? '',
                'overdue' => $_GET['overdue'] ?? ''
            ];
        }
        if ($trickid == 2 || $trickid == 3) {
            $options_limit_456 = [
                'start' => '',
                'length' => '',
                'search' => '',
                'reason' => '',
                'start_date_1' => '',
                'end_date_1' => '',
                'start_date_2' => $_GET['s_date_2'] ?? '',
                'end_date_2' => $_GET['e_date_2'] ?? '',
                'source' => $_GET['s_value'] ?? '',
                'designation' => $_GET['d_value'] ?? '',
                'hr' => $_GET['h_value'] ?? '',
                'overdue' => $_GET['overdue'] ?? ''
            ];
        }

        $All_trackids_count = [
            't1' => count($this->candidateModel->List_CandidatesM($HRid, 1, $options_limit_456)),
            't2' => count($this->candidateModel->getNotScheduledList($HRid, 2, $options_limit)),
            't3' => count($this->candidateModel->getNotScheduledList($HRid, 3, $options_limit)),
            't4' => count($this->candidateModel->getCandidateInterviewStatusM($HRid, 4, $options_limit_456)),
            't5' => count($this->candidateModel->getCandidateInterviewStatusM($HRid, 5, $options_limit_456)),
            't6' => count($this->candidateModel->getCandidateInterviewStatusM($HRid, 6, $options_limit_456)),
            't8' => count($this->candidateModel->getCandidateOfferStatusM($HRid, 8, $options_limit_8)),
            't12' => count($this->candidateModel->getFreshList($HRid, 12, $options_limit)),
            't15' => count($this->candidateModel->List_CandidatesM($HRid, 15, $options_limit_456))
        ];

        if (($trickid == 1)  || ($trickid == 9) || ($trickid == 10) || ($trickid == 11) || ($trickid == 15)) {
            $totalRecords = count($this->candidateModel->List_CandidatesM($HRid, $trickid, $options_t));
            $data = $this->candidateModel->List_CandidatesM($HRid, $trickid, $options_d);
            $filteredRecords = count($this->candidateModel->List_CandidatesM($HRid, $trickid, $options_f));
        } else if (($trickid == 12) || ($trickid == 13) || ($trickid == 14)) {
            $totalRecords = count($this->candidateModel->getFreshList($HRid, $trickid, $options_t));
            $data = $this->candidateModel->getFreshList($HRid, $trickid, $options_d);
            $filteredRecords = count($this->candidateModel->getFreshList($HRid, $trickid, $options_f));
        } else if (($trickid == 2) || ($trickid == 16) || ($trickid == 17) || ($trickid == 18) || ($trickid == 3)) {
            $totalRecords = count($this->candidateModel->getNotScheduledList($HRid, $trickid, $options_t));
            $data = $this->candidateModel->getNotScheduledList($HRid, $trickid, $options_d);
            $filteredRecords = count($this->candidateModel->getNotScheduledList($HRid, $trickid, $options_f));
        } else if (($trickid == 4) || ($trickid == 5) || ($trickid == 6)) {
            $totalRecords = count($this->candidateModel->getCandidateInterviewStatusM($HRid, $trickid, $options_t));
            $data = $this->candidateModel->getCandidateInterviewStatusM($HRid, $trickid, $options_d);
            $filteredRecords = count($this->candidateModel->getCandidateInterviewStatusM($HRid, $trickid, $options_f));
        } else if ($trickid == 8) {
            $totalRecords = count($this->candidateModel->getCandidateOfferStatusM($HRid, $trickid, $options_t));
            $data = $this->candidateModel->getCandidateOfferStatusM($HRid, $trickid, $options_d);
            $filteredRecords = count($this->candidateModel->getCandidateOfferStatusM($HRid, $trickid, $options_f));
        } else {
            $data = [];
        }

        $response = [
            'draw' => $_GET['draw'],
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
            'alltrackidcounts' => $All_trackids_count
        ];

        return $this->response->setJSON($response);
    }
    public function My_Overdues()
    {
        $session = session();
        $adminId = $session->get('EmpIDFK');
        $data['fdate'] = $_GET['fdate'] ?? '';
        $data['todate'] = $_GET['todate'] ?? '';
        $data['trickid'] = $_GET['trickid'] ?? '12';
        $data['filter_designation'] = $_GET['fd'] ?? '';
        $data['filter_source'] = $_GET['fs'] ?? '';
        $data['filter_hr'] = $_GET['hr'] ?? '';
        $data['filter_reason'] = $_GET['res'] ?? '';
        $data['filter_s_date_1'] = $_GET['fsd-1'] ?? '';
        $data['filter_e_date_1'] = $_GET['fed-1'] ?? '';
        $data['filter_s_date_2'] = $_GET['fsd-2'] ?? '';
        $data['filter_e_date_2'] = $_GET['fed-2'] ?? '';
        $data['HRS'] = $this->empModel->getHRList();
        $data['DESIGNATIONS'] = $this->candidateModel->getDesignationList();
        $data['SOURCES'] = $this->candidateModel->getSourceList();
        $data['REASONS'] = $this->candidateModel->getReasonsList();

        return view('candidates/candidates_my_overdues', $data);
    }
    public function todays_candidate_activityC()
    {
        $data['filter_status'] = $_GET['fs'] ?? '';
        $data['filter_designation'] = $_GET['fd'] ?? '';
        $data['filter_hr'] = $_GET['hr'] ?? '';
        $data['filter_s_date'] = $_GET['fsd'] ?? '';
        $data['filter_e_date'] = $_GET['fed'] ?? '';
        $data['HRS'] = $this->empModel->getHRList();
        $data['DESIGNATIONS'] = $this->candidateModel->getDesignationList();
        $data['STATUS'] = $this->candidateModel->getStatusList();

        return view('candidates/todays_candidate_activity', $data);
    }
    public function today_activityDT()
    {
        $HRid = null;
        $options_d = [
            'start' => $_GET['start'] ?? 0,
            'length' => $_GET['length'] ?? 10,
            'search' => $_GET['search']['value'] ?? '',
            'hr' => $_GET['h_value'] ?? '',
            'designation' => $_GET['d_value'] ?? '',
            'status' => $_GET['s_value'] ?? '',
            'start_date' => $_GET['s_date'] ?? '',
            'end_date' => $_GET['e_date'] ?? '',
        ];
        $options_t = [
            'start' => '',
            'length' => '',
            'search' => '',
            'hr' => '',
            'designation' => '',
            'status' => '',
            'start_date' => '',
            'end_date' => '',
        ];
        $options_f = [
            'start' => '',
            'length' => '',
            'search' => $_GET['search']['value'] ?? '',
            'hr' => $_GET['h_value'] ?? '',
            'designation' => $_GET['d_value'] ?? '',
            'status' => $_GET['s_value'] ?? '',
            'start_date' => $_GET['s_date'] ?? '',
            'end_date' => $_GET['e_date'] ?? '',
        ];
        $totalRecords = count($this->candidateModel->getCurrentdayActivity($HRid, $options_t));
        $data = $this->candidateModel->getCurrentdayActivity($HRid, $options_d);
        $filteredRecords = count($this->candidateModel->getCurrentdayActivity($HRid, $options_f));
        $response = [
            'draw' => $_GET['draw'],
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ];
        return $this->response->setJSON($response);
    }

    //*******************************************// Starts HR Candidates //***********************************************************************//

    public function HRcandidate_ListC()
    {
        $session = session();
        $HRid = $session->get('EmpIDFK');

        $data['fdate'] = $_GET['fdate'] ?? '';
        $data['todate'] = $_GET['todate'] ?? '';
        $data['trickid'] = $_GET['trickid'] ?? '';
        $data['filter_designation'] = $_GET['fd'] ?? '';
        $data['filter_source'] = $_GET['fs'] ?? '';
        $data['filter_hr'] = $_GET['hr'] ?? '';
        $data['filter_s_date_1'] = $_GET['fsd-1'] ?? '';
        $data['filter_e_date_1'] = $_GET['fed-1'] ?? '';
        $data['filter_s_date_2'] = $_GET['fsd-2'] ?? '';
        $data['filter_e_date_2'] = $_GET['fed-2'] ?? '';
        $data['filter_reason'] = $_GET['res'] ?? '';
        $data['int_s_date'] = $_GET['int-s'] ?? '';
        $data['int_e_date'] = $_GET['int-e'] ?? '';
        $data['INT_STATUS'] = [
            ['id' => '10', 'text' => 'Initial Review',],
            ['id' => '1', 'text' => 'Round 1'],
            ['id' => '2', 'text' => 'Round 2'],
            ['id' => '3', 'text' => 'Round 3'],
            ['id' => '4', 'text' => 'Round 4'],
            ['id' => '5', 'text' => 'Round 5'],
            ['id' => '6', 'text' => 'Round 6']
        ];
        $data['HRS'] = $this->empModel->getHRList();
        $data['DESIGNATIONS'] = $this->candidateModel->getDesignationList();
        $data['selectdesignation'] = $this->candidateModel->getDesignationList();
        $data['SOURCES'] = $this->candidateModel->getSourceList();
        $data['REASONS'] = $this->candidateModel->getReasonsList();
        $data['socialMedia'] = $this->candidateModel->Candidate_Source_ListM();
        // $data['yetToAssignCount'] = $this->candidateModel->getYettoAssignListCount($adminId);
        $data['HRList'] = $this->empModel->getHRList();
        $data['notScheduleReasons'] = $this->candidateModel->notschedule_reasons_ListM();

        if ($_GET['trickid'] == 11) {
            return view('candidates/HR_candidates_today_scheduled', $data);
        } else if ($_GET['trickid'] == 9) {
            return view('candidates/HR_candidates_upcoming_scheduled', $data);
        } else {
            return view('candidates/HR_candidates_list_view', $data);
        }
    }
    public function HRcandidate_ListCDT($trickid)
    {
        $session = session();
        $HRid = $session->get('EmpIDFK');

        $options_d = [
            'start' => $_GET['start'] ?? 0,
            'length' => $_GET['length'] ?? 10,
            'search' => $_GET['search']['value'] ?? '',
            'start_date_1' => $_GET['s_date_1'] ?? '',
            'end_date_1' => $_GET['e_date_1'] ?? '',
            'start_date_2' => $_GET['s_date_2'] ?? '',
            'end_date_2' => $_GET['e_date_2'] ?? '',
            'source' => $_GET['s_value'] ?? '',
            'designation' => $_GET['d_value'] ?? '',
            'hr' => $_GET['h_value'] ?? '',
            'reason' => $_GET['reason'] ?? '',
            'overdue' => $_GET['overdue'] ?? '',
        ];
        $options_t = [
            'start' => '',
            'length' => '',
            'search' => '',
            'start_date_1' => '',
            'end_date_1' => '',
            'start_date_2' => '',
            'end_date_2' => '',
            'source' => '',
            'designation' => '',
            'hr' => '',
            'reason' => '',
            'overdue' => $_GET['overdue'] ?? ''
        ];
        $options_f = [
            'start' => '',
            'length' => '',
            'search' => $_GET['search']['value'] ?? '',
            'start_date_1' => $_GET['s_date_1'] ?? '',
            'end_date_1' => $_GET['e_date_1'] ?? '',
            'start_date_2' => $_GET['s_date_2'] ?? '',
            'end_date_2' => $_GET['e_date_2'] ?? '',
            'source' => $_GET['s_value'] ?? '',
            'designation' => $_GET['d_value'] ?? '',
            'reason' => $_GET['reason'] ?? '',
            'hr' => $_GET['h_value'] ?? '',
            'overdue' => $_GET['overdue'] ?? ''
        ];

        if ($trickid != 8) {
            $options_limit = [
                'start' => '',
                'length' => '',
                'search' => '',
                'start_date_1' => '',
                'end_date_1' => '',
                'reason' => '',
                'start_date_2' => $_GET['s_date_2'] ?? '',
                'end_date_2' => $_GET['e_date_2'] ?? '',
                'source' => $_GET['s_value'] ?? '',
                'designation' => $_GET['d_value'] ?? '',
                'hr' => $_GET['h_value'] ?? '',
                'overdue' => $_GET['overdue'] ?? ''
            ];

            $options_limit_8 = [
                'start' => '',
                'length' => '',
                'search' => '',
                'reason' => '',
                'start_date_1' => $_GET['s_date_1'] ?? '',
                'end_date_1' => $_GET['e_date_1'] ?? '',
                'start_date_2' => '',
                'end_date_2' => '',
                'source' => $_GET['s_value'] ?? '',
                'designation' => $_GET['d_value'] ?? '',
                'hr' => $_GET['h_value'] ?? '',
                'overdue' => $_GET['overdue'] ?? ''
            ];

            $options_limit_456 = [
                'start' => '',
                'length' => '',
                'search' => '',
                'reason' => '',
                'start_date_1' => $_GET['s_date_1'] ?? '',
                'end_date_1' => $_GET['e_date_1'] ?? '',
                'start_date_2' => $_GET['s_date_2'] ?? '',
                'end_date_2' => $_GET['e_date_2'] ?? '',
                'source' => $_GET['s_value'] ?? '',
                'designation' => $_GET['d_value'] ?? '',
                'hr' => $_GET['h_value'] ?? '',
                'overdue' => $_GET['overdue'] ?? ''
            ];
        } else {
            $options_limit = [
                'start' => '',
                'length' => '',
                'search' => '',
                'start_date_1' => '',
                'end_date_1' => '',
                'reason' => '',
                'start_date_2' => '',
                'end_date_2' => '',
                'source' => $_GET['s_value'] ?? '',
                'designation' => $_GET['d_value'] ?? '',
                'hr' => $_GET['h_value'] ?? '',
                'overdue' => $_GET['overdue'] ?? ''
            ];

            $options_limit_456 = [
                'start' => '',
                'length' => '',
                'search' => '',
                'reason' => '',
                'start_date_1' => $_GET['s_date_1'] ?? '',
                'end_date_1' => $_GET['e_date_1'] ?? '',
                'start_date_2' => '',
                'end_date_2' => '',
                'source' => $_GET['s_value'] ?? '',
                'designation' => $_GET['d_value'] ?? '',
                'hr' => $_GET['h_value'] ?? '',
                'overdue' => $_GET['overdue'] ?? ''
            ];

            $options_limit_8 = [
                'start' => '',
                'length' => '',
                'search' => '',
                'reason' => '',
                'start_date_1' => $_GET['s_date_1'] ?? '',
                'end_date_1' => $_GET['e_date_1'] ?? '',
                'start_date_2' => $_GET['s_date_2'] ?? '',
                'end_date_2' => $_GET['e_date_2'] ?? '',
                'source' => $_GET['s_value'] ?? '',
                'designation' => $_GET['d_value'] ?? '',
                'hr' => $_GET['h_value'] ?? '',
                'overdue' => $_GET['overdue'] ?? ''
            ];
        }
        if ($trickid == 2 || $trickid == 3) {
            $options_limit_456 = [
                'start' => '',
                'length' => '',
                'search' => '',
                'reason' => '',
                'start_date_1' => '',
                'end_date_1' => '',
                'start_date_2' => $_GET['s_date_2'] ?? '',
                'end_date_2' => $_GET['e_date_2'] ?? '',
                'source' => $_GET['s_value'] ?? '',
                'designation' => $_GET['d_value'] ?? '',
                'hr' => $_GET['h_value'] ?? '',
                'overdue' => $_GET['overdue'] ?? ''
            ];
        }

        $All_trackids_count = [
            't1' => count($this->candidateModel->List_CandidatesM($HRid, 1, $options_limit_456)),
            't2' => count($this->candidateModel->getNotScheduledList($HRid, 2, $options_limit)),
            't3' => count($this->candidateModel->getNotScheduledList($HRid, 3, $options_limit)),
            't4' => count($this->candidateModel->getCandidateInterviewStatusM($HRid, 4, $options_limit_456)),
            't5' => count($this->candidateModel->getCandidateInterviewStatusM($HRid, 5, $options_limit_456)),
            't6' => count($this->candidateModel->getCandidateInterviewStatusM($HRid, 6, $options_limit_456)),
            't8' => count($this->candidateModel->getCandidateOfferStatusM($HRid, 8, $options_limit_8)),
            't12' => count($this->candidateModel->getFreshList($HRid, 12, $options_limit)),
            't15' => count($this->candidateModel->List_CandidatesM($HRid, 15, $options_limit_456))
        ];

        if (($trickid == 1)  || ($trickid == 9) || ($trickid == 10) || ($trickid == 11) || ($trickid == 15)) {
            $totalRecords = count($this->candidateModel->List_CandidatesM($HRid, $trickid, $options_t));
            $data = $this->candidateModel->List_CandidatesM($HRid, $trickid, $options_d);
            $filteredRecords = count($this->candidateModel->List_CandidatesM($HRid, $trickid, $options_f));
        } else if (($trickid == 12) || ($trickid == 13) || ($trickid == 14)) {
            $totalRecords = count($this->candidateModel->getFreshList($HRid, $trickid, $options_t));
            $data = $this->candidateModel->getFreshList($HRid, $trickid, $options_d);
            $filteredRecords = count($this->candidateModel->getFreshList($HRid, $trickid, $options_f));
        } else if (($trickid == 2) || ($trickid == 16) || ($trickid == 17) || ($trickid == 18) || ($trickid == 3)) {
            $totalRecords = count($this->candidateModel->getNotScheduledList($HRid, $trickid, $options_t));
            $data = $this->candidateModel->getNotScheduledList($HRid, $trickid, $options_d);
            $filteredRecords = count($this->candidateModel->getNotScheduledList($HRid, $trickid, $options_f));
        } else if (($trickid == 4) || ($trickid == 5) || ($trickid == 6)) {
            $totalRecords = count($this->candidateModel->getCandidateInterviewStatusM($HRid, $trickid, $options_t));
            $data = $this->candidateModel->getCandidateInterviewStatusM($HRid, $trickid, $options_d);
            $filteredRecords = count($this->candidateModel->getCandidateInterviewStatusM($HRid, $trickid, $options_f));
        } else if ($trickid == 8) {
            $totalRecords = count($this->candidateModel->getCandidateOfferStatusM($HRid, $trickid, $options_t));
            $data = $this->candidateModel->getCandidateOfferStatusM($HRid, $trickid, $options_d);
            $filteredRecords = count($this->candidateModel->getCandidateOfferStatusM($HRid, $trickid, $options_f));
        } else {
            $data = [];
        }
        $response = [
            'draw' => $_GET['draw'],
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
            'alltrackidcounts' => $All_trackids_count
        ];

        return $this->response->setJSON($response);
    }
    public function HRMy_Overdues()
    {
        $session = session();
        $HRid = $session->get('EmpIDFK');
        $data['fdate'] = $_GET['fdate'] ?? '';
        $data['todate'] = $_GET['todate'] ?? '';
        $data['trickid'] = $_GET['trickid'] ?? '12';
        $data['filter_designation'] = $_GET['fd'] ?? '';
        $data['filter_source'] = $_GET['fs'] ?? '';
        $data['filter_hr'] = $_GET['hr'] ?? '';
        $data['filter_reason'] = $_GET['res'] ?? '';
        $data['filter_s_date_1'] = $_GET['fsd-1'] ?? '';
        $data['filter_e_date_1'] = $_GET['fed-1'] ?? '';
        $data['filter_s_date_2'] = $_GET['fsd-2'] ?? '';
        $data['filter_e_date_2'] = $_GET['fed-2'] ?? '';
        $data['HRS'] = $this->empModel->getHRList();
        $data['DESIGNATIONS'] = $this->candidateModel->getDesignationList();
        $data['SOURCES'] = $this->candidateModel->getSourceList();
        $data['REASONS'] = $this->candidateModel->getReasonsList();

        return view('candidates/HR_candidates_my_overdues', $data);
    }
    public function HR_todays_candidate_activityC()
    {
        $data['filter_status'] = $_GET['fs'] ?? '';
        $data['filter_designation'] = $_GET['fd'] ?? '';
        $data['filter_hr'] = $_GET['hr'] ?? '';
        $data['filter_s_date'] = $_GET['fsd'] ?? '';
        $data['filter_e_date'] = $_GET['fed'] ?? '';
        $data['HRS'] = $this->empModel->getHRList();
        $data['DESIGNATIONS'] = $this->candidateModel->getDesignationList();
        $data['STATUS'] = $this->candidateModel->getStatusList();

        return view('candidates/HR_todays_candidate_activity', $data);
    }
    public function HRtoday_activityDT()
    {
        $session = session();
        $HRid = $session->get('EmpIDFK');

        $options_d = [
            'start' => $_GET['start'] ?? 0,
            'length' => $_GET['length'] ?? 10,
            'search' => $_GET['search']['value'] ?? '',
            'hr' => $_GET['h_value'] ?? '',
            'designation' => $_GET['d_value'] ?? '',
            'status' => $_GET['s_value'] ?? '',
            'start_date' => $_GET['s_date'] ?? '',
            'end_date' => $_GET['e_date'] ?? '',
        ];
        $options_t = [
            'start' => '',
            'length' => '',
            'search' => '',
            'hr' => '',
            'designation' => '',
            'status' => '',
            'start_date' => '',
            'end_date' => '',
        ];
        $options_f = [
            'start' => '',
            'length' => '',
            'search' => $_GET['search']['value'] ?? '',
            'hr' => $_GET['h_value'] ?? '',
            'designation' => $_GET['d_value'] ?? '',
            'status' => $_GET['s_value'] ?? '',
            'start_date' => $_GET['s_date'] ?? '',
            'end_date' => $_GET['e_date'] ?? '',
        ];
        $totalRecords = count($this->candidateModel->getCurrentdayActivity($HRid, $options_t));
        $data = $this->candidateModel->getCurrentdayActivity($HRid, $options_d);
        $filteredRecords = count($this->candidateModel->getCurrentdayActivity($HRid, $options_f));
        $response = [
            'draw' => $_GET['draw'],
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ];
        return $this->response->setJSON($response);
    }
    public function Assign_ListCDT()
    {
        $options_d = [
            'start' => $_GET['start'] ?? 0,
            'length' => $_GET['length'] ?? 10,
            'source' => $_GET['source'] ?? '',
        ];
        $options_t = [
            'start' => '',
            'length' => '',
            'source' => $_GET['source'] ?? '',
        ];
        $options_f = [
            'start' => '',
            'length' => '',
            'source' => $_GET['source'] ?? '',
        ];
        $totalRecords = count($this->candidateModel->getAssign($options_t));
        $data = $this->candidateModel->getAssign($options_d);
        $filteredRecords = count($this->candidateModel->getAssign($options_f));
        $response = [
            'draw' => $_GET['draw'],
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ];
        return $this->response->setJSON($response);
    }



    public function getTotalCandidateCount($trickid)
    {
        $HRid = null;
        $options_t = [
            'start' => '',
            'length' => '',
            'search' => '',
            'start_date_1' => '',
            'end_date_1' => '',
            'start_date_2' => '',
            'end_date_2' => '',
            'source' => '',
            'designation' => '',
            'hr' => '',
            'reason' => '',
            'overdue' => $_GET['overdue'] ?? ''
        ];

        if (($trickid == 1)  || ($trickid == 9) || ($trickid == 10) || ($trickid == 11) || ($trickid == 15)) {
            $totalRecords = count($this->candidateModel->List_CandidatesM($HRid, $trickid, $options_t));
        } else if (($trickid == 12) || ($trickid == 13) || ($trickid == 14)) {
            $totalRecords = count($this->candidateModel->getFreshList($HRid, 12, $options_t));
        } else if (($trickid == 2) || ($trickid == 16) || ($trickid == 17) || ($trickid == 18) || ($trickid == 3)) {
            $totalRecords = count($this->candidateModel->getNotScheduledList($HRid, $trickid, $options_t));
        } else if (($trickid == 4) || ($trickid == 5) || ($trickid == 6)) {
            $totalRecords = count($this->candidateModel->getCandidateInterviewStatusM($HRid, $trickid, $options_t));
        } else if ($trickid == 8) {
            $totalRecords = count($this->candidateModel->getCandidateOfferStatusM($HRid, $trickid, $options_t));
        } else {
            $data = [];
        }
        return $totalRecords;
    }

    public function settings()
    {
        $results = $this->admin->getAllSettings();
        $data['settings'] = [];
        foreach ($results as $result) {
            $data['settings'] += [$result['Name'] => $result['Value']];
        }
        $data['options'] = $this->candidateModel->GetJobExperience();
        $data['ticket_types'] = $this->admin->getTicketTypes();
        return view('settings', $data);
    }

    public function UpdateSettings()
    {
        $data = [$_POST['name'] => $_POST['value']];
        $this->admin->updateSettings($data);
        return $this->response->redirect(site_url('/settings'));
    }

    public function Doucument_verification_update()
    {
        $data = [
            "CandidateIDFK" => $_POST['CandidateIDFK'],
            "DVRemarks" => $_POST['DVRemarks'],
            "DVStatus" => $_POST['DVStatus']
        ];
        $this->candidateModel->DoucumentVerificationUpdate($data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function Departments()
    {
        $data['departments'] = $this->admin->AllDepartments();
        $this->admin->AutoRemoveHolidays();
        return view('departments/Departments', $data);
    }

    public function AddDepartment()
    {
        return view('departments/AddDepartment');
    }

    public function StoreDepartment()
    {
        $data1 = [
            "deptName" => $_POST['DepartmentName'],
            "CLPM" => $_POST['CasualLeave'],
            "SLPM" => $_POST['SickLeave'],
            "PLPM" => $_POST['PaidLeave'],
            "WO1" => $_POST['wo1'],
            "WO2" => $_POST['wo2'],
            "WO3" => $_POST['wo3'],
            "WO4" => $_POST['wo4'],
            "WO5" => $_POST['wo5'],
            "WO6" => $_POST['wo6'],
            "WO7" => $_POST['wo7'],
        ];
        $this->admin->AddDepartment($data1);
        return $this->response->redirect(site_url('/departments'));
    }

    public function EditDepartment($id)
    {
        $data = $this->admin->EditDepartment($id);
        return view('departments/EditDepartment', $data);
    }

    public function UpdateDepartment($id)
    {
        $data1 = [
            "IDPK" => $_POST['IDPK'],
            "deptName" => $_POST['DepartmentName'],
            "CLPM" => $_POST['CasualLeave'],
            "SLPM" => $_POST['SickLeave'],
            "PLPM" => $_POST['PaidLeave'],
            "WO1" => $_POST['wo1'],
            "WO2" => $_POST['wo2'],
            "WO3" => $_POST['wo3'],
            "WO4" => $_POST['wo4'],
            "WO5" => $_POST['wo5'],
            "WO6" => $_POST['wo6'],
            "WO7" => $_POST['wo7'],
        ];
        $id = $this->admin->UpdateDepartment($data1);
        // return $this->response->redirect(site_url('edit-department/' . $id));
        return $this->response->redirect(site_url('/departments'));
    }

    public function DeleteDepartment($id)
    {
        $this->admin->DeleteDepartment($id);
        return $this->response->redirect(site_url('/departments'));
    }


    public function AllHolidays()
    {
        $this->admin->AutoRemoveHolidays();
        $data['holidays'] = $this->admin->AllHolidays();
        return view('departments/Holidays', $data);
    }

    public function AddHoliday()
    {
        $data['departments'] = $this->admin->AllDepartments();
        return view('departments/AddHoliday', $data);
    }

    public function StoreHoliday()
    {
        $data = [
            "DepartmentIDFK" => $_POST['departments'],
            "Name" => $_POST['holidayname'],
            "Date" => $_POST['holidaydate'],
            "AllDept" => $_POST['AllDept'],
            "SameDate" => $_POST['SameDate']
        ];
        $this->admin->AddHolidays($data);
        return $this->response->redirect(site_url('/holidays'));
    }

    public function EditHoliday($id)
    {
        $data['departments'] = $this->admin->AllDepartments();
        $data['holiday'] = $this->admin->EditHoliday($id);
        return view('departments/EditHoliday', $data);
    }

    public function UpdateHoliday($id)
    {
        $data = [
            "DepartmentIDFK" => $_POST['departments'],
            "Name" => $_POST['holidayname'],
            "Date" => $_POST['holidaydate'],
            "AllDept" => $_POST['AllDept'],
            "SameDate" => $_POST['SameDate']
        ];
        $this->admin->UpdateHolidays($data, $id);
        // return $this->response->redirect(site_url('/edit-holiday/' . $id));
        return $this->response->redirect(site_url('/holidays'));
    }

    public function DeleteHoliday($id)
    {
        $this->admin->DeleteHoliday($id);
        return $this->response->redirect(site_url('/holidays'));
    }

    public function UpdateJobExperience()
    {
        $data['options'] = $_POST['options'];
        $data['remove'] = $_POST['remove'];
        $this->candidateModel->UpdateJobExperience($data);
        return $this->response->redirect(site_url('/settings'));
    }

    public function UpdateTicketOptions()
    {
        $data['Name'] = $_POST['Name'];
        $data['remove'] = $_POST['remove'];
        $this->admin->setTicketTypes($data);
        return $this->response->redirect(site_url('/settings'));
    }

    public function UpdateEmployee($id)
    {

        $file = $this->request->getFile('Image');
        if (empty($_FILES['Image']['name'])) {
            $imageName = "default.png";
            $name = $this->request->getPost('Name');
            $data[$name] = $this->request->getPost($name);
        } elseif ($file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getClientName();
            $file->move('Uploads/ProfilePhotosuploads/', $imageName);
            $name = 'Image';
            $data[$name] = $imageName;
        }

        $acctype = $this->request->getPost('acc-type');

        $this->empModel->UpdateSingleEmployee($id, $data, $acctype);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function UpdateAbsEmployee($id)
    {
        $data['last_working'] = $_POST['last_working'] ?? NULL;
        $data['settlement_day'] = $_POST['settlement_day'] ?? NULL;
        $data['final_set_status'] = $_POST['final_set_status'];
        $data['final_set_amound'] = $_POST['final_set_amound'];

        $this->empModel->UpdateSingleAbsEmployee($id, $data);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function ReApproveCandidate($id)
    {
        $this->candidateModel->ReApproveCandidate($id);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function Tickets()
    {
        $data['fdate'] = $_GET['fdate'] ?? date('Y-m-d');
        $data['todate'] = $_GET['todate'] ?? date('Y-m-d');
        $trickid = $_GET['trickid'] ?? 1;
        $data['trickid'] = $trickid;

        $data['All'] = count($this->empModel->AllTickets(1, $data));
        $data['Pending'] = count($this->empModel->AllTickets(2, $data));
        $data['In_Progress'] = count($this->empModel->AllTickets(3, $data));
        $data['Resolved'] = count($this->empModel->AllTickets(4, $data));
        $data['Escalated'] = count($this->empModel->AllTickets(5, $data));

        $data['tickets'] = $this->empModel->AllTickets($trickid, $data);

        $data['issuetypes'] = $this->empModel->GetIssueTypes();

        return view('tickets/tickets', $data);
    }

    public function AddTicket()
    {
        $data['EmployeeIDFK'] = $_POST['EmployeeIDFK'];
        $data['TypeIDFK'] = $_POST['TypeIDFK'];
        $data['Subject'] = $_POST['Subject'];
        $data['Description'] = $_POST['Description'];
        $data['Priority'] = $_POST['Priority'];
        $this->empModel->CreateTicket($data);
        return redirect()->back();
    }

    public function EditTicket($id)
    {
        $data = $this->empModel->EditTicket($id);
        return $this->response->setJSON(['status' => 'success', 'data' => $data]);
    }

    public function StatusTicketUpdate()
    {
        $id = $_POST['Ticid'];
        $status = $_POST['Status'];
        $this->empModel->StatusChangeTicket($id, $status);
        return $this->response->redirect(site_url('/tickets'));
    }

    public function StatusTicketsUpdate($id, $status)
    {
        $this->empModel->StatusChangeTicket($id, $status);
        return redirect()->back();
    }


    public function UserDashboard()
    {
        $data['fdate'] = $_GET['fdate'];
        $data['todate'] = $_GET['todate'];
        $data['EmpId'] = session()->get('EmpIDFK');
        $data['badge'] = $_GET['badge'] ?? 0;
        $data['badge'] = ($data['badge'] == -1) ? 0 : $data['badge'];

        $data['holidays'] = $this->admin->AttendanceHolidays($data['badge']);
        $data['birthdays'] = $this->empModel->birthdayDetails();
        $data['events'] = $this->empModel->eventsDetails();
        $data['weeklogs'] = $this->empModel->UserWeekTimelog($data);

        $data['login'] = $this->empModel->UserTodayTimelog($data);

        return view('users/empdashboard', $data);
    }

    public function UserAttendance()
    {
        $id = session()->get('EmpIDFK');
        $data['issuetypes'] = $this->empModel->GetIssueTypes();
        $data['EmpId'] = $id;

        return view('users/attendance', $data);
    }

    public function UserLeave()
    {
        $id = session()->get('EmpIDFK');
        $data['issuetypes'] = $this->empModel->GetIssueTypes();
        $data['leavetype'] = $this->empModel->selectleaveType();
        $data['EmpId'] = $id;
        $data['leaves'] = $this->empModel->GetUserLeaves($id);
        $data['LeaveFlag'] = $this->empModel->CasualCheck($id);
        return view('users/leave', $data);
    }

    public function HRLeave()
    {
        $id = session()->get('EmpIDFK');
        $data['issuetypes'] = $this->empModel->GetIssueTypes();
        $data['leavetype'] = $this->empModel->selectleaveType();
        $data['EmpId'] = $id;
        $data['leaves'] = $this->empModel->GetUserLeaves($id);
        $data['LeaveFlag'] = $this->empModel->CasualCheck($id);
        return view('HR/leave', $data);
    }

    public function UserTimelog()
    {
        $id = session()->get('EmpIDFK');
        $data = [
            'fdate' => $_GET['fdate'] ?? date('Y-m-d'),
            'todate' => $_GET['todate'] ?? date('Y-m-d'),
        ];
        $data['issuetypes'] = $this->empModel->GetIssueTypes();
        $data['EmpId'] = $id;
        $data['TimeLogs'] = $this->empModel->getEmployeeTimeLogs($id, $data['fdate'], $data['todate']);
        return view('users/timelog', $data);
    }

    public function UserTicket()
    {
        $id = session()->get('EmpIDFK');
        $data['tickets'] = $this->empModel->UserTickets($id);
        $data['issuetypes'] = $this->empModel->GetIssueTypes();
        $data['EmpId'] = $id;
        return view('users/tickets', $data);
    }

    public function UserPayroll()
    {
        $id = session()->get('EmpIDFK');
        $data['issuetypes'] = $this->empModel->GetIssueTypes();
        $data['EmpId'] = $id;
        $data['PaySlip'] = $this->empModel->getEmployeePaySlip($id);
        $data['mode'] = $this->admin->getSettingsSpecific('payrol-function');
        $data['mode'] = $data['mode']['Value'];
        return view('users/payroll', $data);
    }

    public function HRPayroll()
    {
        $id = session()->get('EmpIDFK');
        $data['issuetypes'] = $this->empModel->GetIssueTypes();
        $data['EmpId'] = $id;
        $data['PaySlip'] = $this->empModel->getEmployeePaySlip($id);
        $data['mode'] = $this->admin->getSettingsSpecific('payrol-function');
        $data['mode'] = $data['mode']['Value'];
        return view('HR/payroll', $data);
    }

    public function UserEvent()
    {
        $id = session()->get('EmpIDFK');
        $data['issuetypes'] = $this->empModel->GetIssueTypes();
        $data['EmpId'] = $id;

        $data['events'] = $data['events'] = $this->empModel->eventsDetails();
        return view('users/events', $data);
    }

    public function HRTickets()
    {
        $id = session()->get('EmpIDFK');
        $data['tickets'] = $this->empModel->UserTickets($id);
        $data['issuetypes'] = $this->empModel->GetIssueTypes();
        $data['EmpId'] = $id;
        return view('HR/tickets', $data);
    }

    public function Leaves()
    {
        $data['trickid'] = $_GET['trickid'] ?? 1;
        $data['fdate'] = $_GET['fdate'] ?? date('Y-m-d');
        $data['todate'] = $_GET['todate'] ?? date('Y-m-d');
        if (session()->get('user_level') == 42) {
            $sac = 1;
        } else {
            $sac = 0;
        }
        $data['issuetypes'] = $this->empModel->GetIssueTypes();
        $data['All'] = count($this->empModel->GetAllLeaves(1, $data, $sac));
        $data['Pending'] = count($this->empModel->GetAllLeaves(2, $data, $sac));
        $data['Approved'] = count($this->empModel->GetAllLeaves(3, $data, $sac));
        $data['Rejected'] = count($this->empModel->GetAllLeaves(4, $data, $sac));
        $data['leaves'] = $this->empModel->GetAllLeaves($data['trickid'], $data, $sac);
        return view('leaves/leave', $data);
    }

    public function GetLeave($id)
    {
        $data = $this->empModel->GetLeave($id);
        return $this->response->setJSON(['status' => 'success', 'data' => $data]);
    }

    public function StatusLeaveUpdate()
    {
        $id = $_POST['id'];
        $status = $_POST['Status'];
        $this->empModel->StatusLeaveUpdate($id, $status);
        return $this->response->redirect(site_url('/leave'));
    }

    public function StatusLeavesUpdate($id, $status)
    {
        $this->empModel->StatusLeaveUpdate($id, $status);
        return redirect()->back();
    }

    public function AddLeave()
    {
        $data['EmployeeIDFK'] = $_POST['EmployeeIDFK'];
        $data['TypeIDFK'] = $_POST['TypeIDFK'];
        $data['CompDate'] = $_POST['CompDate'] ?? null;
        $data['Date'] = $_POST['Date'];
        $data['Start_time'] = $_POST['Start_time'] ?? '00:00:00';
        $data['End_time'] = $_POST['End_time'] ?? '00:00:00';
        $data['Reason'] = $_POST['Reason'] ?? '';
        $this->empModel->ApplyLeave($data);
        return redirect()->back();
    }

    public function Accounts(){
        $data['accounts'] = $this->admin->AllAccounts();
        return view('account/accounts',$data);
    }

    public function AddAccount(){
        $data['designations'] = $this->candidateModel->getDesignationList();
        $data['employees'] = $this->empModel->getAllEmpWiOutLog(); 
        return view('account/addaccount',$data);
    }

    public function StoreAccount(){
        $data = [
            'EmpIDFK' => $_POST['EmpIDFK'],
            'user_name' => $_POST['user_name'],
            'admin_login_email'=> $_POST['admin_login_email'],
            'admin_login_password'=> $_POST['admin_login_password'],
            'user_level' => $_POST['user_level'],
            'active_status' => $_POST['active_status'],
            'login_access' => $_POST['login_access']
        ];
        $this->admin->StoreAccounts($data);
        return $this->response->redirect(site_url('/login-accounts'));
    }

    public function EditAccount($id){
        $data['designations'] = $this->candidateModel->getDesignationList();
        $data['account'] = $this->admin->GetAccount($id);
        return view('account/editaccount',$data);
    }

    public function UpdateAccount($id){
        $data = [
            'EmpIDFK' => $_POST['EmpIDFK'],
            'user_name' => $_POST['user_name'],
            'admin_login_email'=> $_POST['admin_login_email'],
            'admin_login_password'=> $_POST['admin_login_password'],
            'user_level' => $_POST['user_level'],
            'active_status' => $_POST['active_status'],
            'login_access' => $_POST['login_access']
        ];
        $this->admin->UpdateAccount($id,$data);
        return $this->response->redirect(site_url('/login-accounts'));
    }

    public function ActDactAccount($id){
        $this->admin->ActDactAccount($id);
        return $this->response->redirect(site_url('/login-accounts'));
    }
}
