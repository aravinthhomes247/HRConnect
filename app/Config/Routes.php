<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


// NO auth
$routes->get('/permission-denied','HRController::NoPermission');
$routes->get('index', 'HRController::index');
$routes->get('register', 'HRController::register');
$routes->post('register', 'HRController::createAdmin');
$routes->get('login', 'HRController::login');
$routes->post('login', 'HRController::loginValidate');
$routes->get('logout', 'HRController::logout');

$routes->get('Candidatelogin', 'CandidateController::Candidatelogin');
$routes->post('Candidatelogin', 'CandidateController::CandidateloginValidate');
$routes->get('candidatelogout', 'CandidateController::candidatelogout');


// AUTH

// $routes->group('auth', ['filter' => 'auth'], function ($routes) {
//     // $routes->get('users', 'AdminController::users');
//     // $routes->get('settings', 'AdminController::settings');
//     $routes->get('dashboard', 'HRController::dashboard', ['filter' => 'superadmin','filter' => 'auth']);
// });


$routes->get('/CandidateDashboard', 'CandidateController::CandidateDashboard', ['filter' => 'auth']);

$routes->get('/candidates_application', 'CandidateController::candidates_applicationC', ['filter' => 'auth']);
$routes->post('/update_change_password', 'CandidateController::update_change_passwordC', ['filter' => 'auth']);
$routes->post('/update_candidateApplication', 'CandidateController::update_candidateApplicationC', ['filter' => 'auth']);
$routes->post('/updateResume', 'CandidateController::updateResume');

$routes->get('/dashboard', 'HRController::dashboard', ['filter' => 'superoradminorexe']);
$routes->get('/HRBasedDashboard', 'HRController::HRBasedDashboard', ['filter' => 'superadmin']);
$routes->get('/HRadmin_individual_candidate_List', 'HRController::HRadmin_individual_candidate_ListC', ['filter' => 'superoradminorexe']);
$routes->get('/DSdaterangeV', 'HRController::selecteddaterangeC', ['filter' => 'superoradminorexe']);

$routes->get('/HRdashboard', 'HRController::HRdashboard', ['filter' => 'adminorexeorrec']);

$routes->get('/presents', 'HRController::presentsListC', ['filter' => 'superoradminorexe']);
$routes->get('/absents', 'HRController::absentsListC', ['filter' => 'superoradminorexe']);
$routes->get('/lateComers', 'HRController::lateComersListC', ['filter' => 'superoradminorexe']);

$routes->get('/allevents', 'HRController::allevents', ['filter' => 'suporadminorexeorrec']);
$routes->get('/getevent/(:any)', 'HRController::GetEvent/$1', ['filter' => 'suporadminorexeorrec']);
$routes->get('/deleteevent/(:any)', 'HRController::DeleteEvent/$1', ['filter' => 'suporadminorexeorrec']);
$routes->post('/eventsform', 'HRController::storeEvents', ['filter' => 'suporadminorexeorrec']);
$routes->post('/addevent', 'HRController::storeEvent', ['filter' => 'suporadminorexeorrec']);
$routes->post('/updatevent', 'HRController::UpdateEvent', ['filter' => 'suporadminorexeorrec']);

$routes->get('/workAnniversary', 'HRController::workAnniversary', ['filter' => 'auth']);
$routes->get('/allbirthdays', 'HRController::allbirthdays', ['filter' => 'auth']);

$routes->get('/totalEmps', 'HRController::allEmpslist', ['filter' => 'superoradminorexe']);
$routes->get('/add_emp', 'HRController::createEmp', ['filter' => 'superoradminorexe']);
$routes->post('/check-EmpCode-availability', 'HRController::check_EmpCode_availability',['filter'=>'superoradminorexe']);
$routes->post('/store-emp', 'HRController::storeEmp', ['filter' => 'superoradminorexe']);

$routes->get('/editEmp-view/(:num)', 'HRController::singleEmployee/$1', ['filter' => 'superoradminorexe']);
$routes->get('/editProfile-view/(:num)', 'HRController::editEmpProfile/$1', ['filter' => 'superoradminorexe']);
$routes->post('/update', 'HRController::updateEmp', ['filter' => 'superoradminorexe']);

$routes->get('/addReason/(:num)/(:any)', 'HRController::createLR/$1/$2',['filter' => 'superoradminorexe']);
$routes->get('/editReason/(:num)/(:any)/(:num)', 'HRController::editViewLRC/$1/$2/$3',['filter' => 'superoradminorexe']);
$routes->get('/leaveHistory/(:num)/(:any)', 'HRController::leaveHistory/$1/$2',['filter' => 'superoradminorexe']);
$routes->post('/add_reason', 'HRController::storeLeavereason',['filter' => 'superoradminorexe']);
$routes->post('/update_reason', 'HRController::updateLR', ['filter' => 'superoradminorexe']);
// $routes->get('/delete/(:num)', 'HRController::delete/$1');

$routes->get('/reportemp', 'HRController::reportSearchAllLog', ['filter' => 'superadmin']);
$routes->get('/reportempdia', 'HRController::reportSearchAllLogDia', ['filter' => 'superadmin']);
$routes->get('/logHistory', 'HRController::logHistory',['filter' => 'superadmin']);
$routes->get('/latecomingHistory', 'HRController::latecomingHistory',['filter' => 'superadmin']);

$routes->get('/leaveRequest', 'HRController::LeaveRequestListC', ['filter' => 'superoradminorexe']);
// $routes->post('/store_LeaveRequest', 'HRController::storeLeaveRequest',['filter' => 'superoradminorexe']);
$routes->get('/ReadLeaveRequest/(:num)', 'HRController::ReadLeaveRequestC/$1', ['filter' => 'superoradminorexe']);
$routes->post('/updateReply', 'HRController::storeLeaveRequestReply',['filter' => 'superoradminorexe']);
$routes->post('/hrReply', 'HRController::storehrReply',['filter' => 'adminorexeorrec']);
// $routes->post('/empReply', 'HRController::storehrReply',['filter' => 'auth']);

$routes->get('/mailBox', 'HRController::MailBoxC', ['filter' => 'auth']);
$routes->post('/getemployees', 'HRController::get_Emp_autocompleteC', ['filter' => 'auth']);
$routes->post('/HRComposeMail', 'HRController::insert_HRcompose', ['filter' => 'adminorexeorrec']);
$routes->get('/ReadMail', 'HRController::Read_MailC', ['filter' => 'auth']);

$routes->get('/todays_activity', 'HRController::todays_candidate_activityC', ['filter' => 'suporadminorexeorrec']);
// $routes->get('/HRtodays_activity', 'HRController::HRtodays_candidate_activityC', ['filter' => 'auth']);

$routes->get('/candidate', 'HRController::candidate_ListC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/getcandidates', 'HRController::get_Candidate_autocompleteC', ['filter' => 'suporadminorexeorrec']);
$routes->get('/add_candidate_view', 'HRController::add_candidateC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/store_candidate', 'HRController::insert_candidateC', ['filter' => 'suporadminorexeorrec']);
$routes->get('/edit_candidate_view', 'HRController::edit_candidateC', ['filter' => 'suporadminorexeorrec']);

$routes->get('/edit_Candi_profile', 'HRController::edit_Candi_profileC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/update_CandiProfile', 'HRController::update_CandiProfileC', ['filter' => 'suporadminorexeorrec']);

$routes->post('/store_candidate_excelfile', 'HRController::store_candidate_excelfileC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/source_count', 'HRController::source_count', ['filter' => 'suporadminorexeorrec']);
$routes->post('/assignCandidates', 'HRController::assignCandidatesC', ['filter' => 'superoradminorexe']);
$routes->post('/reassignCandidates', 'HRController::reassignCandidatesC', ['filter' => 'superoradminorexe']);

$routes->post('/update_candidateSchedule', 'HRController::update_candidateScheduleC', ['filter' => 'suporadminorexeorrec']);

$routes->post('/update_candidateArrived', 'HRController::update_candidateArrivedC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/update_candidate_reschedule', 'HRController::update_candidate_rescheduleC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/update_candidate_cancel', 'HRController::update_candidate_cancelC', ['filter' => 'suporadminorexeorrec']);

$routes->get('/scheducleCandidate', 'HRController::scheducleCandidateC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/interviewScheduled', 'HRController::interviewScheduledC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/interviewNotScheduled', 'HRController::interviewNotScheduledC', ['filter' => 'suporadminorexeorrec']);
$routes->get('/interview_process', 'HRController::interview_processC', ['filter' => 'suporadminorexeorrec']);

$routes->post('/update_interviewpro', 'HRController::insert_interview_processC', ['filter' => 'suporadminorexeorrec']);

$routes->get('/provious_rounds', 'HRController::provious_roundsC', ['filter' => 'suporadminorexeorrec']);
$routes->get('/onboarding_process', 'HRController::onboarding_processC', ['filter' => 'suporadminorexeorrec']);

$routes->post('/send_documentVerification_mail', 'HRController::send_documentVerification_mailC', ['filter' => 'suporadminorexeorrec']);
 
// $routes->post('/insert_documents', 'HRController::insert_documentC', ['filter' => 'auth']);
$routes->post('/insert_freshers_documents', 'HRController::insert_freshers_documentsC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/insert_experience_documents', 'HRController::insert_experience_documentsC', ['filter' => 'suporadminorexeorrec']);

$routes->post('/experienced_update_documents', 'HRController::experienced_update_documentC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/fresher_update_documents', 'HRController::fresher_update_documentC', ['filter' => 'suporadminorexeorrec']);

$routes->get('/interviewers_list', 'HRController::interviewers_listC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/store_interviewer', 'HRController::store_interviewerC', ['filter' => 'suporadminorexeorrec']);
$routes->get('/delete_interviewer/(:num)', 'HRController::delete_interviewerC/$1', ['filter' => 'suporadminorexeorrec']);

$routes->post('/insert_offer_letter', 'HRController::insert_offer_letterC', ['filter' => 'suporadminorexeorrec']);
$routes->get('/offer_letter_process', 'HRController::offer_letter_processC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/update_confirmation', 'HRController::update_confirmationC', ['filter' => 'suporadminorexeorrec']);

$routes->get('/joined_candidate', 'HRController::joined_candidate_viewC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/update_JoinStatus', 'HRController::update_JoinStatusC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/update_WorkingStatus', 'HRController::update_WorkingStatusC', ['filter' => 'suporadminorexeorrec']);

$routes->get('/background_doc', 'HRController::background_docC', ['filter' => 'suporadminorexeorrec']);
$routes->post('/empBankDetails', 'HRController::insert_empBankDetailsC', ['filter' => 'superoradminorexe']);

$routes->post('/client_api', 'HRController::client_api'); 
$routes->post('/crm_addcp', 'indiaestatesController::crm_addcp'); 
$routes->post('/cp_clientreg', 'indiaestatesController::cp_clientreg'); 
$routes->post('/cp_Details', 'indiaestatesController::cp_Details'); 
$routes->post('/builder_Details', 'indiaestatesController::builder_Details'); 
$routes->post('/Download_Brochures', 'indiaestatesController::Download_Brochures'); 
$routes->post('/contact_Detailes', 'indiaestatesController::contact_Detailes'); 
$routes->post('/careersmail', 'abheeventuresController::careersmail'); 
$routes->post('/landpartnersmail', 'abheeventuresController::landpartnersmail'); 




// Aravinth
// career
$routes->get('/careers', 'HRController::Careers', ['filter' => 'suporadminorexeorrec']);
$routes->get('/add-career', 'HRController::AddCareer', ['filter' => 'suporadminorexeorrec']);
$routes->post('/store-career', 'HRController::Storecareer', ['filter' => 'suporadminorexeorrec']);
$routes->get('/edit-career/(:num)', 'HRController::EditCareer/$1', ['filter' => 'suporadminorexeorrec']);
$routes->post('/update-career/(:num)', 'HRController::Updatecareer/$1', ['filter' => 'suporadminorexeorrec']);
$routes->get('/deact-act-career/(:num)', 'HRController::StatusCareer/$1', ['filter' => 'suporadminorexeorrec']);
$routes->get('delete-career/(:num)', 'HRController::delete_career/$1', ['filter' => 'suporadminorexeorrec']);
$routes->get('/applicants/(:num)','HRController::Applicants/$1', ['filter' => 'suporadminorexeorrec']);

// Candidate list ajax..........
$routes->get('/data-candidate/load/candidate_list/(:any)', 'HRController::candidate_ListCDT/$1',['filter' => 'suporadminorexeorrec']);
$routes->get('/data-candidate/load/today_activity', 'HRController::today_activityDT', ['filter' => 'suporadminorexeorrec']);
$routes->get('/todays_activity', 'HRController::todays_candidate_activityC', ['filter' => 'suporadminorexeorrec']);
$routes->get('/my_overdues', 'HRController::My_Overdues', ['filter' => 'suporadminorexeorrec']);
$routes->get('/HRmy_overdues', 'HRController::HRMy_Overdues', ['filter' => 'suporadminorexeorrec']);

$routes->get('/HRcandidate_List', 'HRController::HRcandidate_ListC', ['filter' => 'suporadminorexeorrec']);
$routes->get('/data-candidate/load/HR-candidate_list/(:any)', 'HRController::HRcandidate_ListCDT/$1', ['filter' => 'suporadminorexeorrec']);
$routes->get('/data-candidate/load/HR-today_activity', 'HRController::HRtoday_activityDT', ['filter' => 'suporadminorexeorrec']);
$routes->get('/HRtodays_activity', 'HRController::HR_todays_candidate_activityC', ['filter' => 'suporadminorexeorrec']);
$routes->get('/HRmy_overdues', 'HRController::HRMy_Overdues', ['filter' => 'suporadminorexeorrec']);
$routes->get('/data-candidate/load/Assign', 'HRController::Assign_ListCDT', ['filter' => 'suporadminorexeorrec']);
$routes->post('/doucument-verification-update', 'HRController::Doucument_verification_update',['filter' => 'suporadminorexeorrec']);
$routes->get('/reapprovecandidate/(:any)', 'HRController::ReApproveCandidate/$1',['filter' => 'suporadminorexeorrec']);

// Settings
$routes->get('/settings', 'HRController::settings', ['filter' => 'superadmin']);
$routes->post('/update-settings', 'HRController::UpdateSettings', ['filter' => 'superadmin']);
$routes->post('/update-settings-options', 'HRController::UpdateJobExperience', ['filter' => 'superadmin']);
$routes->post('/update-settings-tikets', 'HRController::UpdateTicketOptions', ['filter' => 'superadmin']);

// Files
$routes->get('/payslip-download/(:any)', 'HRController::payslipDownload/$1',['filter' => 'auth']);
$routes->post('/upload-files/(:any)', 'HRController::Uploadfiles/$1',['filter' => 'auth']);
$routes->post('/remove-files/(:any)', 'HRController::Removefiles/$1',['filter' => 'auth']);
$routes->post('/replace-files/(:any)', 'HRController::Replacefiles/$1',['filter' => 'auth']);

// Departments
$routes->get('/departments', 'HRController::Departments',['filter' => 'superoradminorexe']);
$routes->get('/add-department', 'HRController::AddDepartment',['filter' => 'superoradminorexe']);
$routes->get('/edit-department/(:any)', 'HRController::EditDepartment/$1',['filter' => 'superoradminorexe']);
$routes->post('/store-department', 'HRController::StoreDepartment',['filter' => 'superoradminorexe']);
$routes->post('/update-department/(:any)', 'HRController::UpdateDepartment/$1',['filter' => 'superoradminorexe']);
$routes->get('/delete-department/(:any)', 'HRController::DeleteDepartment/$1',['filter' => 'superoradminorexe']);

// Holidays
$routes->get('/holidays', 'HRController::AllHolidays',['filter' => 'superoradminorexe']);
$routes->get('/add-holiday', 'HRController::AddHoliday',['filter' => 'superoradminorexe']);
$routes->get('/edit-holiday/(:any)', 'HRController::EditHoliday/$1',['filter' => 'superoradminorexe']);
$routes->post('/store-holiday', 'HRController::StoreHoliday',['filter' => 'superoradminorexe']);
$routes->post('/update-holiday/(:any)', 'HRController::UpdateHoliday/$1',['filter' => 'superoradminorexe']);
$routes->get('/delete-holiday/(:any)', 'HRController::DeleteHoliday/$1',['filter' => 'superoradminorexe']);

// Employee
$routes->post('/employee-edit/single/(:any)', 'HRController::UpdateEmployee/$1',['filter' => 'superoradminorexe']);
$routes->post('/employee-edit/single-abs/(:any)', 'HRController::UpdateAbsEmployee/$1',['filter' => 'superoradminorexe']);

// Payrolls
$routes->get('/payrolls', 'HRController::payrolls',['filter' => 'superadmin']);
$routes->get('/payslip-edit/(:any)', 'HRController::payroll_edit/$1',['filter' => 'superadmin']);
$routes->post('/payslip-update', 'HRController::payroll_update',['filter' => 'superadmin']);
$routes->get('/payslip-manual-save', 'HRController::payroll_save',['filter' => 'superadmin']);
$routes->get('/downloadpayslipexcel', 'HRController::DownloadPayslipExcel',['filter' => 'superadmin']);

// Tickets
$routes->get('/tickets', 'HRController::Tickets',['filter' => 'superoradminorexe']);
$routes->post('/add-ticket', 'HRController::AddTicket',['filter' => 'superoradminorexe']);
$routes->get('/ticket-edit/(:num)', 'HRController::EditTicket/$1',['filter' => 'auth']);
$routes->post('/ticket-update-status', 'HRController::StatusTicketUpdate',['filter' => 'superoradminorexe']);
$routes->get('/tickets-update-status/(:num)/(:num)', 'HRController::StatusTicketsUpdate/$1/$2',['filter' => 'superoradminorexe']);

// Leaves
$routes->get('/leave', 'HRController::Leaves',['filter' => 'superoradminorexe']);
$routes->get('/leave-edit/(:num)', 'HRController::GetLeave/$1',['filter' => 'superoradminorexe']);
$routes->post('/leave-update-status', 'HRController::StatusLeaveUpdate',['filter' => 'superoradminorexe']);
$routes->get('/leave-update-status/(:num)/(:num)', 'HRController::StatusLeavesUpdate/$1/$2',['filter' => 'superoradminorexe']);
$routes->post('/add-leave', 'HRController::AddLeave',['filter' => 'auth']);

// Employee login pages
$routes->get('/user-dashboard', 'HRController::UserDashboard',['filter' => 'employee']);
$routes->get('/user-attendance', 'HRController::UserAttendance',['filter' => 'employee']);
$routes->get('/user-leave', 'HRController::UserLeave',['filter' => 'employee']);
$routes->get('/user-timelog', 'HRController::UserTimelog',['filter' => 'employee']);
$routes->get('/user-ticket', 'HRController::UserTicket',['filter' => 'employee']);
$routes->get('/user-payroll', 'HRController::UserPayroll',['filter' => 'employee']);
$routes->get('/user-event', 'HRController::UserEvent',['filter' => 'employee']);

// HR login Pages
$routes->get('/HRTickets', 'HRController::HRTickets',['filter' => 'adminorexeorrec']);
$routes->get('/HRpayroll', 'HRController::HRPayroll',['filter' => 'adminorexeorrec']);
$routes->get('/HRleave', 'HRController::HRLeave',['filter' => 'adminorexeorrec']);

// Daily auto jobs
$routes->get('/checkcrone', 'HRController::cronjobs',['filter' => 'auth']);

// Login Credentials
$routes->get('/login-accounts', 'HRController::Accounts',['filter' => 'superoradminorexe']);
$routes->get('/add-account', 'HRController::AddAccount',['filter' => 'superoradminorexe']);
$routes->post('/store-account', 'HRController::StoreAccount',['filter' => 'superoradminorexe']);
$routes->get('/edit-account/(:num)', 'HRController::EditAccount/$1',['filter' => 'superoradminorexe']);
$routes->post('/update-account/(:num)', 'HRController::UpdateAccount/$1',['filter' => 'superoradminorexe']);
$routes->get('/deactactaccount/(:any)', 'HRController::ActDactAccount/$1',['filter' => 'superoradminorexe']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */


if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
