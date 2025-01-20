<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class indiaestatesController extends BaseController
{

    private $admin;
    private $session;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = session();

        $this->db      = \Config\Database::connect();
        // $this->db1      = \Config\Database::connect($homesGroup);

    }

    // public function cp_clientreg(){
        
    //     header("Content-Type:application/json");
    //     $data = json_decode(file_get_contents("php://input"));
	// 	// print_r($data);

    //     $client = $data->client;
    //     $clientnum = $data->clientnum;
    //     $clientmail = $data->clientmail;
    //     $propertyId = $data->propertyId;
    //     $bhksize = $data->bhksize;
    //     $budgetrange = $data->budgetrange;
    //     $sitevisitdate = $data->sitevisitdate;
    //     $remarks = $data->remarks;
    //     $usermail = $data->usermail;
    //     $username = $data->username;
    //     $userid = $data->userid;

      

	// 	echo json_encode($data);
    //     die;
    // }

    public function cp_Details(){

		// header("Content-Type:application/x-www-form-urlencoded");
		// $data = file_get_contents("php://input");
		header("Content-Type:application/json");
		$data = json_decode(file_get_contents("php://input"));


        $CP_NAME = $data->CP_NAME;
        $contact_person = $data->contact_person;
        $CP_NUMBER = $data->CP_NUMBER;
        $CP_MAIL = $data->CP_MAIL;
        $CP_MAIL02 = $data->CP_MAIL02;
        $rera = $data->rera;
        $gst = $data->gst;
    
        $response['CP_NAME'] = $data->CP_NAME;
        $response['contact_person'] = $data->contact_person;
        $response['CP_NUMBER'] = $data->CP_NUMBER;
        $response['CP_MAIL'] = $data->CP_MAIL;
        $response['CP_MAIL02'] = $data->CP_MAIL02;
        $response['rera'] = $data->rera;
        $response['gst'] = $data->gst;

            require_once '../vendor/autoload.php';
    
                $transport = (new \Swift_SmtpTransport('smtppro.zoho.in',465,'ssl'))
                ->setUsername('sales@indiaestates.in')
                ->setPassword('Test#247');

                // BODY FOR ADMIN
                $body="<img src='https://duzblbyuf5ibr.cloudfront.net/version2.0/images/logo/logo.svg'  style='width:20%;'>
                "."<br />"."<p style='font-size:18px; margin-bottom:0px;'>Dear Admin,</p>"."<br />
                "."<p style='margin-bottom:0px; margin-top:0px;'>New CP is requested for the lead registration access.</p><br />"."
                <p style='margin:0px;'>Details are as below.</p><br />
                "."CP Name : ". $CP_NAME ."<br />
                "."Contact Person : ". $contact_person ."<br />
                "."CP Number : ". $CP_NUMBER ."<br />
                "."CP Mail : ". $CP_MAIL ."<br />
                "."Rera No. : ". $rera ."<br />
                "."GST No. ". $gst ."<br />

                "."<p style='margin-bottom:0px;'>Please feel free to revert if any queries - sales@indiaestates.in </p>
                "."<p style='margin-bottom:0px;'>Looking forward for Better Business Relationship. </p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'>Updated by Admin,</p>
                "."<p style='margin-bottom:15px;margin-top: 0px;'>Thanks and Regards,</p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>Team Indiaestates</strong></p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>Indiaestates.in</strong></p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>#58, 5th Floor, East Wing, HM Towers, Brigade Road, Bengaluru-560001, Karnataka, India</strong></p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>+91-9164247247 | +91-8043714247 | sales@indiaestates.in| <a href='https://www.indiaestates.in/'>www.indiaestates.in</a></strong></p>
                ";
                
                $mailer = new \Swift_Mailer($transport);
                $message    = (new \Swift_Message('Web Lead'));
                $message ->setFrom(array('sales@indiaestates.in' => 'New CP Registration'));
                $message ->setTo(array('reachus@homes247.in'));
                // $message ->setTo(array('murali@homes247.in'));
                // $message ->setTo(array('abijithajayan01@gmail.com'));
                $message ->setCc(array('priyatham@homes247.in','kiran@homes247.in'));
                $message ->setBcc('abijith@homes247.in');
                $message ->setSubject('New CP Requested by '.$CP_NAME);
                $message ->setBody($body, 'text/html');
                $result = $mailer->send($message);
                // BODY FOR ADMIN


                // BODY FOR CP
                $body="<img src='https://duzblbyuf5ibr.cloudfront.net/version2.0/images/logo/logo.svg'  style='width:20%;'>
                "."<br />"."<p style='font-size:18px; margin-bottom:0px;'>Hi ".$CP_NAME.",</p>"."<br />
                <p style='font-size:18px; margin-bottom:0px;'>Greetings from Indiaestates.in</p>"."<br />
                "."<p style='margin-bottom:0px; margin-top:0px;'>Welcome to Indiaestates Lead Registration Portal</p><br />"."
                <p style='margin:0px;'>Here is your Registered details</p>
                "."Registered Name : ". $CP_NAME ."<br />
                "."Registered Person : ". $contact_person ."<br />
                "."Registered No : ". $CP_NUMBER ."<br />
                "."Registered Mail : ". $CP_MAIL ."<br />
                "."Rera No. : ". $rera ."<br /> 
                "."GST No. : ". $gst ."<br /><br />
                "."<h4>We received your request please wait for 24 hours for Account Activation</h4><br />".
                "<p style='margin-bottom:0px; margin-top:0px;'>Here is the Link for Lead registration - <a href='http://indiaestates.in/cp_login'>Lead Registration</a></p><br />"."
                "."<p style='margin-bottom:0px;'>Please feel free to revert if any queries - sales@indiaestates.in </p>
                "."<p style='margin-bottom:0px;'>Looking forward for Better Business Relationship. </p>
                "."<p style='margin-bottom:15px;margin-top: 0px;'>Thanks and Regards,</p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>Team Indiaestates</strong></p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>Indiaestates.in</strong></p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>#58, 5th Floor, East Wing, HM Towers, Brigade Road, Bengaluru-560001, Karnataka, India</strong></p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>+91-9164247247 | +91-8043714247 | sales@indiaestates.in| <a href='https://www.indiaestates.in/'>www.indiaestates.in</a></strong></p>
                ";
                
                $mailer = new \Swift_Mailer($transport);
                $message    = (new \Swift_Message('Web Lead'));
                $message ->setFrom(array('sales@indiaestates.in' => 'CP Registration'));
                $message ->setTo(array($CP_MAIL));
                // $message ->setCc(array('priyatham@homes247.in','reachus@homes247.in'));
                // $message ->setBcc('abijith@homes247.in');
                $message ->setSubject('Greetings From Indiaestates');
                $message ->setBody($body, 'text/html');
                $result = $mailer->send($message);

                // BODY FOR CP
            
            echo json_encode($data);
            die;

	}
    public function crm_addcp(){

		// header("Content-Type:application/x-www-form-urlencoded");
		// $data = file_get_contents("php://input");
		header("Content-Type:application/json");
		$data = json_decode(file_get_contents("php://input"));


        $CP_NAME = $data->CP_NAME;
        $contact_person = $data->contact_person;
        $CP_NUMBER = $data->CP_NUMBER;
        $CP_MAIL = $data->CP_MAIL;
        $CP_MAIL02 = $data->CP_MAIL02;
        $rera = $data->rera;
        $gst = $data->gst;
        $addedby = $data->addedby;
        $CP_PASSWORD = $data->CP_PASSWORD;
    
        $response['CP_NAME'] = $data->CP_NAME;
        $response['contact_person'] = $data->contact_person;
        $response['CP_NUMBER'] = $data->CP_NUMBER;
        $response['CP_MAIL'] = $data->CP_MAIL;
        $response['CP_MAIL02'] = $data->CP_MAIL02;
        $response['rera'] = $data->rera;
        $response['gst'] = $data->gst;
        $response['addedby'] = $data->addedby;
        $response['CP_PASSWORD'] = $data->CP_PASSWORD;

            require_once '../vendor/autoload.php';
    
                $transport = (new \Swift_SmtpTransport('smtppro.zoho.in',465,'ssl'))
                ->setUsername('sales@indiaestates.in')
                ->setPassword('Test#247');

                // BODY FOR ADMIN
                $body="<img src='https://duzblbyuf5ibr.cloudfront.net/version2.0/images/logo/logo.svg'  style='width:20%;'>
                "."<br />"."<p style='font-size:18px; margin-bottom:0px;'>Dear Admin,</p>"."<br />
                "."<p style='margin-bottom:0px; margin-top:0px;'>" . $addedby . " is Successfully registered a New CP.</p><br />"."
                <p style='margin:0px;'>Details are as below.</p><br />"."CP Name : ". $CP_NAME ."<br />"."Contact Person : ". $contact_person ."<br />
                "."CP Number : ". $CP_NUMBER ."<br />"."CP Mail : ". $CP_MAIL ."<br />
                "."Rera No. : ". $rera ."<br />"."GST No. ". $gst ."<br />
                "."<p style='margin-bottom:0px;'>Please feel free to revert if any queries - sales@indiaestates.in </p>
                "."<p style='margin-bottom:0px;'>Looking forward for Better Business Relationship. </p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'>Updated by Admin,</p>
                "."<p style='margin-bottom:15px;margin-top: 0px;'>Thanks and Regards,</p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>Team Indiaestates</strong></p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>Indiaestates.in</strong></p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>#58, 5th Floor, East Wing, HM Towers, Brigade Road, Bengaluru-560001, Karnataka, India</strong></p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>+91-9164247247 | +91-8043714247 | sales@indiaestates.in| <a href='https://www.indiaestates.in/'>www.indiaestates.in</a></strong></p>
                ";
                
                $mailer = new \Swift_Mailer($transport);
                $message    = (new \Swift_Message('Web Lead'));
                $message ->setFrom(array('sales@indiaestates.in' => 'CP Registration'));
                $message ->setTo(array('reachus@homes247.in'));
                // $message ->setTo(array('abijithajayan01@gmail.com'));
                $message ->setCc(array('priyatham@homes247.in','kiran@homes247.in'));
                $message ->setBcc('abijith@homes247.in');
                $message ->setSubject('New CP Registered by '.$addedby);
                $message ->setBody($body, 'text/html');
                $result = $mailer->send($message);
                // BODY FOR ADMIN


                // BODY FOR CP
                $body="<img src='https://duzblbyuf5ibr.cloudfront.net/version2.0/images/logo/logo.svg'  style='width:20%;'>
                "."<br />"."<p style='font-size:18px; margin-bottom:0px;'>Hi ".$CP_NAME.",</p>"."<br />
                <p style='font-size:18px; margin-bottom:0px;'>Greetings from Indiaestates.in</p>"."<br />
                "."<p style='margin-bottom:0px; margin-top:0px;'>Welcome to Indiaestates Lead Registration Portal</p><br />"."
                <p style='margin:0px;'>Here is your Registered details</p>
                "."Registered Name : ". $CP_NAME ."<br />"."Registered Person : ". $contact_person ."<br />"."Registered No : ". $CP_NUMBER ."<br />
                "."Registered Mail : ". $CP_MAIL ."<br />"."Rera No. : ". $rera ."<br />
                "."GST No. : ". $gst ."<br />"."Username : ". $CP_MAIL ."<br />"."Password : ". $CP_PASSWORD ."<br />
                "."<p style='margin-bottom:0px; margin-top:0px;'>Here is the Link for Lead registration - <a href='http://mandate.indiaestates.in/'>Lead Registration</a></p><br />"."
                "."<p style='margin-bottom:0px;'>Please feel free to revert if any queries - sales@indiaestates.in </p>
                "."<p style='margin-bottom:0px;'>Looking forward for Better Business Relationship. </p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'>Updated by Admin,</p>
                "."<p style='margin-bottom:15px;margin-top: 0px;'>Thanks and Regards,</p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>Team Indiaestates</strong></p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>Indiaestates.in</strong></p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>#58, 5th Floor, East Wing, HM Towers, Brigade Road, Bengaluru-560001, Karnataka, India</strong></p>
                "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>+91-9164247247 | +91-8043714247 | sales@indiaestates.in| <a href='https://www.indiaestates.in/'>www.indiaestates.in</a></strong></p>
                ";
                
                $mailer = new \Swift_Mailer($transport);
                $message    = (new \Swift_Message('Web Lead'));
                $message ->setFrom(array('sales@indiaestates.in' => 'CP Registration'));
                $message ->setTo(array($CP_MAIL));
                // $message ->setCc('anand@indiaestates.in');
                // $message ->setBcc('priyatham@homes247.in');
                $message ->setBcc('abijith@homes247.in');
                $message ->setSubject('Greetings From Indiaestates');
                $message ->setBody($body, 'text/html');
                $result = $mailer->send($message);
                // BODY FOR CP

            
            echo json_encode($data);
            die;

	}
    public function builder_Details(){

		// header("Content-Type:application/x-www-form-urlencoded");
		// $data = file_get_contents("php://input");
		header("Content-Type:application/json");
		$data = json_decode(file_get_contents("php://input"));

        // print_r($data);exit();
        $BI_Name = $data->BI_Name;
        $BI_MobileNo = $data->BI_MobileNo;
        $BI_SecondaryMobile = $data->BI_SecondaryMobile;
        $BI_Email = $data->BI_Email;
        $BI_PropertyName = $data->BI_PropertyName;
        $BI_Remarks = $data->BI_Remarks;
     
        

        require_once '../vendor/autoload.php';
        // Create the Transport
        $transport = (new \Swift_SmtpTransport('smtppro.zoho.in',465,'ssl'))
        ->setUsername('sales@indiaestates.in')
        ->setPassword('Test#247');

            // BODY FOR ADMIN
            $body="<img src='https://duzblbyuf5ibr.cloudfront.net/version2.0/images/logo/logo.svg'  style='width:20%;'>
            "."<br />"."<p style='font-size:18px; margin-bottom:0px;'>Dear Admin,</p>"."<br />
            "."<p style='margin-bottom:0px; margin-top:0px;'>Builder Name : ". $BI_Name ."  has successfully registered with IndiaEstates.in. </p><br />
            "."<p style='margin:0px;'>Details are as follows</p><br />
            "."Builder Name : ". $BI_Name ."<br />
            "."Builder Number : ". $BI_MobileNo ."<br />
            "."Builder Mail : ". $BI_Email ."<br />
            "."Builder Alternate Mail : ". $BI_SecondaryMobile ."<br />
            "."Property Name : ". $BI_PropertyName ."<br />
            "."Remarks Form Builder ". $BI_Remarks ."<br /><br />            
            "."<p style='margin-bottom:0px;'>Please feel free to revert if any queries - sales@indiaestates.in </p>
            "."<p style='margin-bottom:0px;'>Looking forward for Better Business Relationship. </p>
            "."<p style='margin-bottom:0px;margin-top: 0px;'>Updated by Admin,</p>
            "."<p style='margin-bottom:15px;margin-top: 0px;'>Thanks and Regards,</p>
            "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>Team Indiaestates</strong></p>
            "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>Indiaestates.in</strong></p>
            "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>#58, 5th Floor, East Wing, HM Towers, Brigade Road, Bengaluru-560001, Karnataka, India</strong></p>
            "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>+91-9164247247 | +91-8043714247 | sales@indiaestates.in| <a href='https://www.indiaestates.in/'>www.indiaestates.in</a></strong></p>
            ";
            
            $mailer     = new \Swift_Mailer($transport);
            $message    = (new \Swift_Message('Web Lead'));
            $message ->setFrom(array('sales@indiaestates.in' => 'Builder Registration - IndiaEstates'));
            $message ->setTo(array('reachus@homes247.in'));
            // $message ->setTo(array('murali@homes247.in'));
            // $message ->setTo(array('abijithajayan01@gmail.com'));
            $message ->setCc(array('priyatham@homes247.in','kiran@homes247.in'));
            $message ->setBcc('abijith@homes247.in');
            $message ->setSubject('Builder '.$BI_Name.'  has successfully registered with IndiaEstates.in.');
            $message ->setBody($body, 'text/html');
            $result = $mailer->send($message);
            // BODY FOR ADMIN

            
            // Body For Builder //
            $builder_body="<img src='https://duzxxeqden9a0.cloudfront.net/images/Logo.png' width='50%' style='margin-bottom:20px'>
            "."<br />"."<p style='font-size:18px; margin-bottom:0px;'>Dear $BI_Name,</p>"."<br />
            
            <p style='margin:0px;'> Congratulations on successful registrating with IndiaEstates.in! Thank you for your interest, our specially dedicated relationship manager will be in contact with you soon.</p><br />
            Best regards,<br />
        
            
            "."<p style='margin-bottom:0px;'>Please feel free to revert if any queries - sales@indiaestates.in </p>
            "."<p style='margin-bottom:0px;'>Looking forward for Better Business Relationship. </p>
            "."<p style='margin-bottom:15px;margin-top: 0px;'>Thanks and Regards,</p>
            "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>Team Indiaestates</strong></p>
            "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>Indiaestates.in</strong></p>
            "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>#58, 5th Floor, East Wing, HM Towers, Brigade Road, Bengaluru-560001, Karnataka, India</strong></p>
            "."<p style='margin-bottom:0px;margin-top: 0px;'><strong>+91-9164247247 | +91-8043714247 | sales@indiaestates.in| <a href='https://www.indiaestates.in/'>www.indiaestates.in</a></strong></p> ";
            
            // Create the Mailer using your created Transport
            $builder_mailer = new \Swift_Mailer($transport);
            
            // Create a message
            $builder_message = (new \Swift_Message('Web Lead'));
            $builder_message ->setFrom(array('sales@indiaestates.in' => 'Congratulations on Successful Registration!' ));
            // ->setTo(array('gowtham@homes247.in'))
            // ->setCc(array('radha@indiaestates.in'))
            $builder_message ->setTo(array($BI_Email));
            // $builder_message ->setTo(array('enquiry@homes247.in'));
            // $builder_message ->setCc(array('murali@homes247.in'));
            $builder_message ->setCc(array('priyatham@homes247.in'));
            $builder_message ->setBcc(array('abijith@homes247.in' => ''));
            $builder_message ->setSubject('Congratulations on Successful Registration!');
            $builder_message ->setBody($builder_body, 'text/html');
            $result = $builder_mailer->send($builder_message);
            // Body For Builder //
            
            // print_r($result);exit();
           

            $response['BI_Name'] = $data->BI_Name;
            $response['BI_MobileNo'] = $data->BI_MobileNo;
            $response['BI_SecondaryMobile'] = $data->BI_SecondaryMobile;
            $response['BI_Email'] = $data->BI_Email;
            $response['BI_PropertyName'] = $data->BI_PropertyName;
            $response['BI_Remarks'] = $data->BI_Remarks;

            echo json_encode($data);
            die;
	}
    public function contact_Detailes(){

		// header("Content-Type:application/x-www-form-urlencoded");
		// $data = file_get_contents("php://input");
		header("Content-Type:application/json");
		$data = json_decode(file_get_contents("php://input"));

        $customer_name = $data->customer_name;
        $customer_number = $data->customer_number;
        $customer_mail = $data->customer_mail;
        $customer_message = $data->customer_message;

		// $customer_name = $_GET['customer_name'];
        // $customer_number = $_GET['customer_number'];
        // $customer_mail = $_GET['customer_mail'];
     
        $response['customer_name'] = $data->customer_name;
        $response['customer_number'] = $data->customer_number;
        $response['customer_mail'] = $data->customer_mail;
        $response['customer_message'] = $data->customer_message;

        require_once '../vendor/autoload.php';
        // Create the Transport
        $transport = (new \Swift_SmtpTransport('smtppro.zoho.in',465,'ssl'))
        ->setUsername('sales@indiaestates.in')
        ->setPassword('Test#247');
            $body="<img src='https://duzxxeqden9a0.cloudfront.net/images/Logo.png' width='50%' style='margin-bottom:20px'>
            "."<br />"."<p style='font-size:18px; margin-bottom:0px;'>Dear Admin,</p>"."<br />
            "."<p style='margin-bottom:0px; margin-top:0px;'>We have received a request for call back from ". $customer_name ."</p><br />"."
            <p style='margin:0px;'>Details are as below.</p><br />"."Name : ". $customer_name ."<br />
            "."Phone Number : ". $customer_number ."<br />"."Email : ". $customer_mail ."<br />
            "."Messages : ". $customer_message ."<br />
            "."<p style='margin-bottom:0px;'> Regards,</p><br/>
            "."<h3 style='margin-top:0px;'>IndiaEstates</h3>";
            
            // Create the Mailer using your created Transport
            $mailer = new \Swift_Mailer($transport);            
            // Create a message
            $message = (new \Swift_Message('Web Lead'));
            $message ->setFrom(array('sales@indiaestates.in' => 'Let us clarify your Query'));
                // ->setTo(array('gowtham@homes247.in'))
                // ->setCc(array('radha@indiaestates.in'))
            // $message->setTo(array('murali@homes247.in'));
            $message->setTo(array('enquiry@homes247.in'));
            $message->setCc(array('priyatham@homes247.in'));
            $message->setBcc(array('abijith@homes247.in'));
            $message->setSubject('Let us clarify your Query');
            $message->setBody($body, 'text/html');
            $result = $mailer->send($message);

        echo json_encode($data);
        die;

	}
    public function Download_Brochures(){

		// header("Content-Type:application/x-www-form-urlencoded");
		// $data = file_get_contents("php://input");
		header("Content-Type:application/json");
		$data = json_decode(file_get_contents("php://input"));

        $customer_name = $data->customer_name;
        $customer_number = $data->customer_number;
        $customer_mail = $data->customer_mail;
        $customer_property = $data->customer_property;

		// $customer_name = $_GET['customer_name'];
        // $customer_number = $_GET['customer_number'];
        // $customer_mail = $_GET['customer_mail'];
     
        

        require_once '../vendor/autoload.php';    
            $transport = (new \Swift_SmtpTransport('smtppro.zoho.in',465,'ssl'))
                        ->setUsername('sales@indiaestates.in')
                        ->setPassword('Test#247');
            
            $body="<img src='https://duzxxeqden9a0.cloudfront.net/images/Logo.png' width='50%' style='margin-bottom:20px'>
            "."<br />"."<p style='font-size:18px; margin-bottom:0px;'>Dear Admin,</p>"."<br />
            "."<p style='margin-bottom:0px; margin-top:0px;'>We have received a request for Download Brochure from ". $customer_name ."</p><br />"."
            <p style='margin:0px;'>Details are as below.</p><br />
            "."Name : ". $customer_name ."<br />
            "."Phone Number : ". $customer_number ."<br />
            "."Email : ". $customer_mail ."<br />
            "."Property Name : ". $customer_property ."<br /><br />
            "."<p style='margin-bottom:0px;'> Regards,</p><br/>
            "."<h3 style='margin-top:0px;'>IndiaEstates</h3>";
                                    
            // Create the Mailer using your created Transport
            $mailer = new \Swift_Mailer($transport);

            // Create a message
            $message = (new \Swift_Message('Web Lead'));
                $message->setFrom(array('sales@indiaestates.in' => 'Brochure Request'));
                // $message->setTo(array('gowtham@homes247.in'));
                // $message->setCc(array('radha@indiaestates.in'));
                // $message->setTo(array('murali@homes247.in'));
                $message->setTo(array('enquiry@homes247.in'));
                $message->setCc(array('priyatham@homes247.in'));
                $message->setBcc(array('abijith@homes247.in'));
                $message->setSubject('Brochure Download');
                $message->setBody($body, 'text/html');
            $result = $mailer->send($message);

        $response['customer_name'] = $data->customer_name;
        $response['customer_number'] = $data->customer_number;
        $response['customer_mail'] = $data->customer_mail;
        $response['customer_property'] = $data->customer_property;

        echo json_encode($data);
        die;

	}


}