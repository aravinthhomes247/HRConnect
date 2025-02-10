<?php

namespace App\Controllers;

use App\Models\LogModel;
use App\Models\AdminModel;
use App\Models\EventsModel;
use CodeIgniter\Files\File;
use App\Models\EmployeeModel;
use App\Models\CandidateModel;
use App\Models\LeaveReasonModel;
use App\Models\InterviewersModel;
use App\Models\EmpBankDetailsModel;
use App\Controllers\BaseController;

class CandidateController extends BaseController
{

    private $admin;
    private $session;
    private $db;
    private $logModel;
    private $eveModel;
    private $empModel;
    private $LRModel;
    private $candidateModel;
    private $interviewerModel;
    private $empBankDetailsModel;
    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = session();
        $this->admin = new AdminModel();
        $this->logModel = new LogModel();
        $this->eveModel = new EventsModel();
        $this->empModel = new EmployeeModel();
        $this->db = \Config\Database::connect();
        $this->LRModel = new LeaveReasonModel();
        $this->candidateModel = new CandidateModel();
        $this->interviewerModel = new InterviewersModel();
        $this->empBankDetailsModel = new EmpBankDetailsModel();
        // $this->db1 = \Config\Database::connect($homesGroup);
    }

    public function register()
    {
        return view('register');
    }

    public function createAdmin()
    {
        $inputs = $this->validate(
            [
                'user_name' => 'required|min_length[5]',
                'admin_login_password' => 'required|min_length[5]',
                'admin_login_email' => 'required|valid_email|is_unique[admin_login.admin_login_email]',
            ]
        );

        if (!$inputs) {
            return view('register',['validation' => $this->validator]);
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

    public function Candidatelogin()
    {
        return view('candidateProfile/Candidatelogin');
    }

    public function CandidateloginValidate()
    {
        $email = $this->request->getVar('admin_login_email');
        $password = $this->request->getVar('admin_login_password');
        $user = $this->candidateModel->where('CandidateEmail', $email)->first();

        if ($user) {
            $pass = $user['CandidatePassword'];
            $authPassword = password_verify($password, $pass);

            if ($password == $pass ) {
                $sessionData = [
                    'loggedIn' => true,
                    'CandidateId' => $user['CandidateId'],
                    'CandidateName' => $user['CandidateName'],                    
                    'CandidateEmail' => $user['CandidateEmail'],
                    'CandidatePassword' => $user['CandidatePassword'],                    
                ];
                if ($sessionData['CandidateEmail'] == $email ) {
                    $this->session->set($sessionData);
                    return redirect()->to('/CandidateDashboard');                    
                } else{
                    session()->setFlashdata('failed', 'Failed! User not Allowed');
                    return redirect()->to(site_url('/Candidatelogin'));
                }
            }

            session()->setFlashdata('failed', 'Failed! incorrect password');
            return redirect()->to(site_url('/Candidatelogin'));
        }

        session()->setFlashdata('failed', 'Failed! incorrect email');
        return redirect()->to(site_url('/Candidatelogin'));
    }
    public function candidatelogout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/Candidatelogin');
    }
    public function CandidateDashboard(){
        $session = session();
        $data['showHR'] = $this->empModel->getHR();
        $data['canId'] = $session->get('CandidateId');
        $data['selectdesignation'] = $this->empModel->selectdesignationM();
        $data['socialMedia'] = $this->candidateModel->Social_Media_ListM();
        $data['candidate_details'] = $this->candidateModel->Candidate_DetailsM($data);
        return view('candidateProfile/candidateDashboard',$data);
    }
    public function update_change_passwordC(){
        $session = session();
        $canId = $session->get('CandidateId');
        $currentpassword = $this->request->getPost('currentpassword');
        $data['CandidatePassword'] = $this->request->getVar('newpassword');

        $candidate = $this->candidateModel->where('CandidateId', $canId)->first();   
        $oldPassword = $candidate['CandidatePassword'];

        if($currentpassword == $oldPassword){
            $this->candidateModel->update($canId,$data);
            session()->setFlashdata('successchanged', 'Password Updated Successfully');
            return redirect()->to(site_url('/CandidateDashboard'));
        }else{
            session()->setFlashdata('failedchanged', 'InValid Current Password');
            return redirect()->to(site_url('/CandidateDashboard'));
        }
    }
    function candidates_applicationC(){
        $session = session();
        $data['showHR'] = $this->empModel->getHR();
        $data['canId'] = $session->get('CandidateId'); 
        $data['selectdesignation'] = $this->empModel->selectdesignationM();
        $data['socialMedia'] = $this->candidateModel->Social_Media_ListM();
        $data['candidate_details'] = $this->candidateModel->Candidate_DetailsM($data);
        return view('candidateProfile/candidatesApplication',$data);
    }

    public function update_candidateApplicationC()
    {
        $session = session();        
        $canId = $this->request->getPost('CandidateId');
        $file = $this->request->getFile('CandidateResume');        
        $target_dir = "Uploads/candidates/$canId/";
        
		if (!file_exists($target_dir))
        {
            mkdir('./Uploads/candidates/'.$canId, 0777, true );
        }
        
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getClientName();
            $file->move('Uploads/candidates/'.$canId.'/', $fileName);
        }

        $data = [
            'CandidateResume' => $fileName,
            'Source' => $this->request->getPost('Source'),
            'CandidateExperience' => $this->request->getPost('exp'),
            'LastCompany' => $this->request->getPost('LastCompany'),
            'CandidateId' => $this->request->getPost('CandidateId'),            
            'DaysRequired' => $this->request->getPost('DaysRequired'),
            'NoticePeroid' => $this->request->getPost('NoticePeroid'),
            'CandidateName' => $this->request->getPost('CandidateName'),            
            'CandidateEmail' => $this->request->getPost('CandidateEmail'),            
            'ImmediateJoiner' => $this->request->getPost('ImmediateJoiner'),
            'TotalExperience' => $this->request->getPost('TotalExperience'),
            'CandidateLocation' => $this->request->getPost('CandidateLocation'),
            'CandidatePosition' => $this->request->getPost('CandidatePosition'),
            'CandidateContactNo' => $this->request->getPost('CandidateContactNo'),            
            'CandidateEducation' => $this->request->getPost('CandidateEducation'),
            'CandidateCurrentCTC' => $this->request->getPost('CandidateCurrentCTC'),
            'CandidateExpectedCTC' => $this->request->getPost('CandidateExpectedCTC'),
        ];

        $this->candidateModel->update($canId,$data);
        session()->setFlashdata('successSent', 'Application Filled Successfully');
        return $this->response->redirect(site_url('/CandidateDashboard'));
    }

    public function updateResume(){
        print_r("Hi Success");exit();
    }
}