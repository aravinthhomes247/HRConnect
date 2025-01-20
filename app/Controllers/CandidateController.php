<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\EmployeeModel;
use App\Models\LogModel;
use App\Models\EventsModel;
use App\Models\LeaveReasonModel;
use App\Models\CandidateModel;

use App\Models\InterviewersModel;
use App\Models\EmpBankDetailsModel;
// use App\Models\HRModel;

use CodeIgniter\Files\File;


use App\Controllers\BaseController;


class CandidateController extends BaseController
{

    private $admin;
    private $session;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->admin = new AdminModel();
        $this->session = session();

        $this->db      = \Config\Database::connect();
        // $this->db1      = \Config\Database::connect($homesGroup);
        // $db      = \Config\Database::connect();


        $this->empModel = new EmployeeModel();
        $this->logModel = new LogModel();
        $this->eveModel = new EventsModel();
        $this->LRModel = new LeaveReasonModel();
        $this->candidateModel = new CandidateModel();

        $this->interviewerModel = new InterviewersModel();
        $this->empBankDetailsModel = new EmpBankDetailsModel();
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
    public function Candidatelogin()
    {
        return view('candidateProfile/Candidatelogin');
    }

    /**
     * login validate
     */
    public function CandidateloginValidate()
    {

        $email = $this->request->getVar('admin_login_email');
        $password = $this->request->getVar('admin_login_password');
        // print_r($email);print_r($password);exit();

        $user = $this->candidateModel->where('CandidateEmail', $email)->first();
        // print_r($user);exit();
        if ($user) {

            $pass = $user['CandidatePassword'];
            $authPassword = password_verify($password, $pass);
            // print_r($pass .'/'.$password);exit();
            // print_r($authPassword);exit();

            if ($password == $pass ) {
                $sessionData = [
                    'CandidateId' => $user['CandidateId'],
                    'CandidateEmail' => $user['CandidateEmail'],
                    'CandidateName' => $user['CandidateName'],                    
                    'CandidatePassword' => $user['CandidatePassword'],                    
                    'loggedIn' => true,
                ];
                // print_r($sessionData);exit();
                // $this->session->set($sessionData);
                if ($sessionData['CandidateEmail'] == $email ) {
                    $this->session->set($sessionData);
                    // print_r($sessionData['CandidateEmail']);exit();
                    return redirect()->to('/CandidateDashboard');                    
                
                } else{
                    // $this->session->set($sessionData);
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
        // $HRid = $session->get('CandidateId');
        $data = [
            'canId' => $session->get('CandidateId'),
        ];

        
        $data['candidate_details'] = $this->candidateModel->Candidate_DetailsM($data);
        $data['showHR'] = $this->empModel->getHR();
        $data['selectdesignation'] = $this->empModel->selectdesignationM();
        $data['socialMedia'] = $this->candidateModel->Social_Media_ListM();
        // print_r($data['showHR']);exit();
        return view('candidateProfile/candidateDashboard',$data);
    }

    public function update_change_passwordC(){
        $session = session();
        $canId = $session->get('CandidateId');
        $candidate = $this->candidateModel->where('CandidateId', $canId)->first();
        
        $oldPassword = $candidate['CandidatePassword'];        
        $currentpassword = $this->request->getPost('currentpassword');
       
        $data = [
            'CandidatePassword' => $this->request->getVar('newpassword'), 
        ];

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
        // $canId = $session->get('CandidateId');
        $data = [
            'canId' => $session->get('CandidateId'),
        ];
        
        $data['candidate_details'] = $this->candidateModel->Candidate_DetailsM($data);
        $data['showHR'] = $this->empModel->getHR();
        $data['selectdesignation'] = $this->empModel->selectdesignationM();
        $data['socialMedia'] = $this->candidateModel->Social_Media_ListM();
        // print_r($data['showHR']);exit();
        return view('candidateProfile/candidatesApplication',$data);
    }

    public function update_candidateApplicationC()
    {
        // $data = [
        //     'canId' => $_GET['canId'], 
        // ];
        // print_r($data);exit();
        $session = session();
        
        
        $canId = $this->request->getPost('CandidateId');
        // $canName = $this->request->getPost('CandidateName');
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
        // print_r($target_dir);exit();


        $data = [
            'CandidateId' => $this->request->getPost('CandidateId'),            
            'CandidateName' => $this->request->getPost('CandidateName'),            
            'CandidateContactNo' => $this->request->getPost('CandidateContactNo'),            
            'CandidateEmail' => $this->request->getPost('CandidateEmail'),            
            'CandidateLocation' => $this->request->getPost('CandidateLocation'),
            'Source' => $this->request->getPost('Source'),
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

        // print_r($data);exit();
        $this->candidateModel->update($canId,$data);
        session()->setFlashdata('successSent', 'Application Filled Successfully');
        return $this->response->redirect(site_url('/CandidateDashboard'));
        
        // $save = $this->candidateModel->update_candidate_arrivedM($data);

        // if($data['scheduled']==1){
            // return $this->response->redirect(site_url('/candidates_application?canId='. $canId));
        // }else{
        //     return $this->response->redirect(site_url('/edit_candidate_view?canId='. $canId));
        //     // $session->setFlashdata('candidatemsg', 'Thank you for Your Update');
        // }


    }

    public function updateResume(){

        print_r("Hi Success");exit();
    }








}