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
$routes->get('/index', 'HRController::index');

$routes->get('register', 'HRController::register');
$routes->post('register', 'HRController::createAdmin');
$routes->get('login', 'HRController::login');
$routes->post('login', 'HRController::loginValidate');
$routes->get('logout', 'HRController::logout');

$routes->get('Candidatelogin', 'CandidateController::Candidatelogin');
$routes->post('Candidatelogin', 'CandidateController::CandidateloginValidate');
$routes->get('candidatelogout', 'CandidateController::candidatelogout');
$routes->get('CandidateDashboard', 'CandidateController::CandidateDashboard', ['filter' => 'auth']);

$routes->post('/update_change_password', 'CandidateController::update_change_passwordC', ['filter' => 'auth']);
$routes->get('/candidates_application', 'CandidateController::candidates_applicationC', ['filter' => 'auth']);
$routes->post('/update_candidateApplication', 'CandidateController::update_candidateApplicationC', ['filter' => 'auth']);

$routes->post('updateResume', 'CandidateController::updateResume');

$routes->get('HRdashboard', 'HRController::HRdashboard', ['filter' => 'auth']);
// $routes->get('HRcandidate_List', 'HRController::HRcandidate_ListC', ['filter' => 'auth']);

$routes->get('dashboard', 'HRController::dashboard', ['filter' => 'auth']);

$routes->get('HRBasedDashboard', 'HRController::HRBasedDashboard', ['filter' => 'auth']);
$routes->get('HRadmin_individual_candidate_List', 'HRController::HRadmin_individual_candidate_ListC', ['filter' => 'auth']);

$routes->get('/DSdaterangeV', 'HRController::selecteddaterangeC', ['filter' => 'auth']);

$routes->get('/presents', 'HRController::presentsListC', ['filter' => 'auth']);
$routes->get('/absents', 'HRController::absentsListC', ['filter' => 'auth']);
$routes->get('/lateComers', 'HRController::lateComersListC', ['filter' => 'auth']);

$routes->get('/allevents', 'HRController::allevents', ['filter' => 'auth']);
$routes->post('eventsform', 'HRController::storeEvents', ['filter' => 'auth']);
$routes->post('addevent', 'HRController::storeEvent', ['filter' => 'auth']);
$routes->get('/getevent/(:any)', 'HRController::GetEvent/$1', ['filter' => 'auth']);
$routes->post('/updatevent', 'HRController::UpdateEvent', ['filter' => 'auth']);
$routes->get('deleteevent/(:any)', 'HRController::DeleteEvent/$1', ['filter' => 'auth']);

$routes->get('/workAnniversary', 'HRController::workAnniversary', ['filter' => 'auth']);
$routes->get('/allbirthdays', 'HRController::allbirthdays', ['filter' => 'auth']);

// $routes->get('/attendanceReport', 'HRController::attendanceListC', ['filter' => 'auth']);

$routes->get('/totalEmps', 'HRController::allEmpslist', ['filter' => 'auth']);
$routes->post('/check-EmpCode-availability', 'HRController::check_EmpCode_availability');
$routes->get('/add_emp', 'HRController::createEmp', ['filter' => 'auth']);
$routes->post('/store-emp', 'HRController::storeEmp', ['filter' => 'auth']);

$routes->get('editEmp-view/(:num)', 'HRController::singleEmployee/$1', ['filter' => 'auth']);
$routes->get('editProfile-view/(:num)', 'HRController::editEmpProfile/$1', ['filter' => 'auth']);
$routes->post('update', 'HRController::updateEmp', ['filter' => 'auth']);

$routes->get('addReason/(:num)/(:any)', 'HRController::createLR/$1/$2',['filter' => 'auth']);
$routes->get('editReason/(:num)/(:any)/(:num)', 'HRController::editViewLRC/$1/$2/$3',['filter' => 'auth']);
$routes->post('add_reason', 'HRController::storeLeavereason',['filter' => 'auth']);
$routes->get('leaveHistory/(:num)/(:any)', 'HRController::leaveHistory/$1/$2',['filter' => 'auth']);
$routes->post('update_reason', 'HRController::updateLR', ['filter' => 'auth']);
// $routes->get('delete/(:num)', 'HRController::delete/$1');

$routes->get('/reportemp', 'HRController::reportSearchAllLog', ['filter' => 'auth']);
$routes->get('/reportempdia', 'HRController::reportSearchAllLogDia', ['filter' => 'auth']);
$routes->get('logHistory', 'HRController::logHistory',['filter' => 'auth']);
$routes->get('latecomingHistory', 'HRController::latecomingHistory',['filter' => 'auth']);

$routes->get('/leaveRequest', 'HRController::LeaveRequestListC', ['filter' => 'auth']);
// $routes->post('store_LeaveRequest', 'HRController::storeLeaveRequest',['filter' => 'auth']);
$routes->get('/ReadLeaveRequest/(:num)', 'HRController::ReadLeaveRequestC/$1', ['filter' => 'auth']);
$routes->post('/updateReply', 'HRController::storeLeaveRequestReply',['filter' => 'auth']);

$routes->post('hrReply', 'HRController::storehrReply',['filter' => 'auth']);
// $routes->post('empReply', 'HRController::storehrReply',['filter' => 'auth']);

$routes->get('/mailBox', 'HRController::MailBoxC', ['filter' => 'auth']);
$routes->post('getemployees', 'HRController::get_Emp_autocompleteC', ['filter' => 'auth']);
$routes->post('HRComposeMail', 'HRController::insert_HRcompose', ['filter' => 'auth']);
$routes->get('/ReadMail', 'HRController::Read_MailC', ['filter' => 'auth']);

$routes->get('/todays_activity', 'HRController::todays_candidate_activityC', ['filter' => 'auth']);
// $routes->get('/HRtodays_activity', 'HRController::HRtodays_candidate_activityC', ['filter' => 'auth']);

$routes->get('/candidate', 'HRController::candidate_ListC', ['filter' => 'auth']);
$routes->post('getcandidates', 'HRController::get_Candidate_autocompleteC', ['filter' => 'auth']);
$routes->get('/add_candidate_view', 'HRController::add_candidateC', ['filter' => 'auth']);
$routes->post('/store_candidate', 'HRController::insert_candidateC', ['filter' => 'auth']);
$routes->get('/edit_candidate_view', 'HRController::edit_candidateC', ['filter' => 'auth']);

$routes->get('/edit_Candi_profile', 'HRController::edit_Candi_profileC', ['filter' => 'auth']);
$routes->post('/update_CandiProfile', 'HRController::update_CandiProfileC', ['filter' => 'auth']);

$routes->post('/store_candidate_excelfile', 'HRController::store_candidate_excelfileC', ['filter' => 'auth']);
$routes->post('/source_count', 'HRController::source_count', ['filter' => 'auth']);
$routes->post('/assignCandidates', 'HRController::assignCandidatesC', ['filter' => 'auth']);
$routes->post('/reassignCandidates', 'HRController::reassignCandidatesC', ['filter' => 'auth']);

$routes->post('/update_candidateSchedule', 'HRController::update_candidateScheduleC', ['filter' => 'auth']);

$routes->post('/update_candidateArrived', 'HRController::update_candidateArrivedC', ['filter' => 'auth']);
$routes->post('/update_candidate_reschedule', 'HRController::update_candidate_rescheduleC', ['filter' => 'auth']);
$routes->post('/update_candidate_cancel', 'HRController::update_candidate_cancelC', ['filter' => 'auth']);

$routes->get('/scheducleCandidate', 'HRController::scheducleCandidateC', ['filter' => 'auth']);
$routes->post('/interviewScheduled', 'HRController::interviewScheduledC', ['filter' => 'auth']);
$routes->post('/interviewNotScheduled', 'HRController::interviewNotScheduledC', ['filter' => 'auth']);
$routes->get('/interview_process', 'HRController::interview_processC', ['filter' => 'auth']);

$routes->post('/update_interviewpro', 'HRController::insert_interview_processC', ['filter' => 'auth']);

$routes->get('/provious_rounds', 'HRController::provious_roundsC', ['filter' => 'auth']);
$routes->get('/onboarding_process', 'HRController::onboarding_processC', ['filter' => 'auth']);

$routes->post('/send_documentVerification_mail', 'HRController::send_documentVerification_mailC', ['filter' => 'auth']);

 
// $routes->post('/insert_documents', 'HRController::insert_documentC', ['filter' => 'auth']);
$routes->post('/insert_freshers_documents', 'HRController::insert_freshers_documentsC', ['filter' => 'auth']);
$routes->post('/insert_experience_documents', 'HRController::insert_experience_documentsC', ['filter' => 'auth']);

$routes->post('/experienced_update_documents', 'HRController::experienced_update_documentC', ['filter' => 'auth']);
$routes->post('/fresher_update_documents', 'HRController::fresher_update_documentC', ['filter' => 'auth']);

$routes->get('/interviewers_list', 'HRController::interviewers_listC', ['filter' => 'auth']);
$routes->post('/store_interviewer', 'HRController::store_interviewerC', ['filter' => 'auth']);
$routes->get('delete_interviewer/(:num)', 'HRController::delete_interviewerC/$1', ['filter' => 'auth']);

$routes->post('/insert_offer_letter', 'HRController::insert_offer_letterC', ['filter' => 'auth']);
$routes->get('/offer_letter_process', 'HRController::offer_letter_processC', ['filter' => 'auth']);
$routes->post('/update_confirmation', 'HRController::update_confirmationC', ['filter' => 'auth']);

$routes->get('/joined_candidate', 'HRController::joined_candidate_viewC', ['filter' => 'auth']);
$routes->post('/update_JoinStatus', 'HRController::update_JoinStatusC', ['filter' => 'auth']);
$routes->post('/update_WorkingStatus', 'HRController::update_WorkingStatusC', ['filter' => 'auth']);

$routes->get('/background_doc', 'HRController::background_docC', ['filter' => 'auth']);

$routes->post('/empBankDetails', 'HRController::insert_empBankDetailsC', ['filter' => 'auth']);
$routes->post('/client_api', 'HRController::client_api'); 


$routes->post('/crm_addcp', 'indiaestatesController::crm_addcp'); 
$routes->post('/cp_clientreg', 'indiaestatesController::cp_clientreg'); 
$routes->post('/cp_Details', 'indiaestatesController::cp_Details'); 
$routes->post('/builder_Details', 'indiaestatesController::builder_Details'); 
$routes->post('/Download_Brochures', 'indiaestatesController::Download_Brochures'); 
$routes->post('/contact_Detailes', 'indiaestatesController::contact_Detailes'); 


$routes->post('/careersmail', 'abheeventuresController::careersmail'); 
$routes->post('/landpartnersmail', 'abheeventuresController::landpartnersmail'); 

// career
$routes->get('/careers', 'HRController::Careers', ['filter' => 'auth']);
$routes->get('/add-career', 'HRController::AddCareer', ['filter' => 'auth']);
$routes->post('/store-career', 'HRController::Storecareer', ['filter' => 'auth']);
$routes->get('/edit-career/(:num)', 'HRController::EditCareer/$1', ['filter' => 'auth']);
$routes->post('/update-career/(:num)', 'HRController::Updatecareer/$1', ['filter' => 'auth']);
$routes->get('/deact-act-career/(:num)', 'HRController::StatusCareer/$1', ['filter' => 'auth']);
$routes->get('delete-career/(:num)', 'HRController::delete_career/$1', ['filter' => 'auth']);
$routes->get('/applicants/(:num)','HRController::Applicants/$1', ['filter' => 'auth']);

// Candidate list ajax..........
$routes->get('/data-candidate/load/candidate_list/(:any)', 'HRController::candidate_ListCDT/$1');
$routes->get('/data-candidate/load/today_activity', 'HRController::today_activityDT');
$routes->get('/todays_activity', 'HRController::todays_candidate_activityC', ['filter' => 'auth']);
$routes->get('/my_overdues', 'HRController::My_Overdues', ['filter' => 'auth']);
$routes->get('/HRmy_overdues', 'HRController::HRMy_Overdues', ['filter' => 'auth']);

$routes->get('HRcandidate_List', 'HRController::HRcandidate_ListC', ['filter' => 'auth']);
$routes->get('/data-candidate/load/HR-candidate_list/(:any)', 'HRController::HRcandidate_ListCDT/$1', ['filter' => 'auth']);
$routes->get('/data-candidate/load/HR-today_activity', 'HRController::HRtoday_activityDT', ['filter' => 'auth']);
$routes->get('/HRtodays_activity', 'HRController::HR_todays_candidate_activityC', ['filter' => 'auth']);
$routes->get('/HRmy_overdues', 'HRController::HRMy_Overdues', ['filter' => 'auth']);
$routes->get('/data-candidate/load/Assign', 'HRController::Assign_ListCDT', ['filter' => 'auth']);

$routes->get('/settings', 'HRController::settings', ['filter' => 'auth']);
$routes->post('/update-settings', 'HRController::UpdateSettings', ['filter' => 'auth']);

$routes->get('/payslip-download/(:any)', 'HRController::payslipDownload/$1',['filter' => 'auth']);
$routes->post('/upload-files/(:any)', 'HRController::Uploadfiles/$1',['filter' => 'auth']);
$routes->post('/remove-files/(:any)', 'HRController::Removefiles/$1',['filter' => 'auth']);
$routes->post('/replace-files/(:any)', 'HRController::Replacefiles/$1',['filter' => 'auth']);
$routes->post('/doucument-verification-update', 'HRController::Doucument_verification_update',['filter' => 'auth']);
$routes->get('/reapprovecandidate/(:any)', 'HRController::ReApproveCandidate/$1',['filter' => 'auth']);


$routes->get('/departments', 'HRController::Departments',['filter' => 'auth']);
$routes->get('/add-department', 'HRController::AddDepartment',['filter' => 'auth']);
$routes->get('/edit-department/(:any)', 'HRController::EditDepartment/$1',['filter' => 'auth']);
$routes->post('/store-department', 'HRController::StoreDepartment',['filter' => 'auth']);
$routes->post('/update-department/(:any)', 'HRController::UpdateDepartment/$1',['filter' => 'auth']);
$routes->get('/delete-department/(:any)', 'HRController::DeleteDepartment/$1',['filter' => 'auth']);

$routes->get('/holidays', 'HRController::AllHolidays',['filter' => 'auth']);
$routes->get('/add-holiday', 'HRController::AddHoliday',['filter' => 'auth']);
$routes->get('/edit-holiday/(:any)', 'HRController::EditHoliday/$1',['filter' => 'auth']);
$routes->post('/store-holiday', 'HRController::StoreHoliday',['filter' => 'auth']);
$routes->post('/update-holiday/(:any)', 'HRController::UpdateHoliday/$1',['filter' => 'auth']);
$routes->get('/delete-holiday/(:any)', 'HRController::DeleteHoliday/$1',['filter' => 'auth']);
$routes->post('/update-settings-options', 'HRController::UpdateJobExperience', ['filter' => 'auth']);
$routes->post('/update-settings-tikets', 'HRController::UpdateTicketOptions', ['filter' => 'auth']);

$routes->post('/employee-edit/single/(:any)', 'HRController::UpdateEmployee/$1',['filter' => 'auth']);
$routes->post('/employee-edit/single-abs/(:any)', 'HRController::UpdateAbsEmployee/$1',['filter' => 'auth']);

$routes->get('/payrolls', 'HRController::payrolls',['filter' => 'auth']);
$routes->get('/payslip-edit/(:any)', 'HRController::payroll_edit/$1',['filter' => 'auth']);
$routes->post('/payslip-update', 'HRController::payroll_update',['filter' => 'auth']);
$routes->get('/payslip-manual-save', 'HRController::payroll_save',['filter' => 'auth']);

$routes->get('/tickets', 'HRController::Tickets',['filter' => 'auth']);
$routes->post('/add-ticket', 'HRController::AddTicket',['filter' => 'auth']);
$routes->get('/ticket-edit/(:num)', 'HRController::EditTicket/$1',['filter' => 'auth']);
$routes->post('/ticket-update-status', 'HRController::StatusTicketUpdate',['filter' => 'auth']);
$routes->get('/tickets-update-status/(:num)/(:num)', 'HRController::StatusTicketsUpdate/$1/$2',['filter' => 'auth']);

$routes->get('/leave', 'HRController::Leaves',['filter' => 'auth']);
$routes->get('/leave-edit/(:num)', 'HRController::GetLeave/$1',['filter' => 'auth']);
$routes->post('/leave-update-status', 'HRController::StatusLeaveUpdate',['filter' => 'auth']);
$routes->get('/leave-update-status/(:num)/(:num)', 'HRController::StatusLeavesUpdate/$1/$2',['filter' => 'auth']);
$routes->post('/add-leave', 'HRController::AddLeave',['filter' => 'auth']);

$routes->get('/user-dashboard', 'HRController::UserDashboard',['filter' => 'auth']);
$routes->get('/user-attendance', 'HRController::UserAttendance',['filter' => 'auth']);
$routes->get('/user-leave', 'HRController::UserLeave',['filter' => 'auth']);
$routes->get('/user-timelog', 'HRController::UserTimelog',['filter' => 'auth']);
$routes->get('/user-ticket', 'HRController::UserTicket',['filter' => 'auth']);
$routes->get('/user-payroll', 'HRController::UserPayroll',['filter' => 'auth']);
$routes->get('/user-event', 'HRController::UserEvent',['filter' => 'auth']);

$routes->get('/HRTickets', 'HRController::HRTickets',['filter' => 'auth']);
$routes->get('/HRpayroll', 'HRController::HRPayroll',['filter' => 'auth']);
$routes->get('/HRleave', 'HRController::HRLeave',['filter' => 'auth']);

$routes->get('/downloadpayslipexcel', 'HRController::DownloadPayslipExcel',['filter' => 'auth']);

// $routes->get('/HRtodays_activity', 'HRController::HRtodays_candidate_activityC', ['filter' => 'auth']);
// $routes->get('dashboard', 'HRDashboard::presents');
// CRUD RESTful Routes
// $routes->get('emps-list', 'EmployeeContoller::index');
// $routes->group("Individual_HR", ["filter" => "auth"], function ($routes) {
// $routes->get('/', 'HRController::candidate_ListC', ['filter' => 'auth']);

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
