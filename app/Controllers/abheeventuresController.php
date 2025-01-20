<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class abheeventuresController extends BaseController
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

    public function careersmail()
    {
        $name = $_POST["username"];
        $email = $_POST["email"];
        $phoneno = $_POST["contactno"];
        $position = $_POST["position"];
        $uploadFile = $_POST["uploadFile"];
      
        //   print_r($uploadFile);exit();
        
        require_once '../vendor/autoload.php';    
        
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com',465,'ssl'))
            ->setUsername('indiaestatehomes@gmail.com')
            ->setPassword('ffpc xuul oyxb nint');
        // $transport = (new \Swift_SmtpTransport('smtppro.zoho.in',465,'ssl'))
        //     ->setUsername('sales@indiaestates.in')
        //     ->setPassword('Test#247');
        $body="<p style='font-size:18px; margin-bottom:0px;'>Dear Admin,</p>"."<br />
            "."<p style='margin-bottom:0px; margin-top:0px;'>We have received a request for call back from ". $name ."</p><br />"."
            <p style='margin:0px;'>Details are as below.</p><br />"."Name : $name <br />
            "."Phone Number : $phoneno <br />"."Email : $email <br />"."Position : $position <br />
            "."Resume : ".$uploadFile['name']." <br />
            <p style='margin-bottom:0px;'> Regards,</p><br/>
            "."<h3 style='margin-top:0px;'>Abhee ventures</h3>";
            
            // Create the Mailer using your created Transport
            $mailer = new \Swift_Mailer($transport);
            // Create a message
            $message = (new \Swift_Message('Job Application from Abhee ventures'));
            $message ->setFrom(array('indiaestatehomes@gmail.com' => 'Job Application from Abhee ventures'));
            $message ->setTo('murali@homes247.in');
            $message ->setSubject('Job Application from Abhee ventures');
            $message ->setBody($body, 'text/html');
            // attach(\Swift_Attachment::fromPath("../public/Uploads/mail_img/2.png"));
            $message->attach(\Swift_Attachment::fromPath($uploadFile['tmp_name'])->setFilename($uploadFile['name']));

            // Assuming $target_dir is the defined location for storing uploaded files
            // $target_dir = 'Uploads/abhee';
            // $target_file = $target_dir . basename($uploadFile['name']);
            // $file = $this->request->getFile('uploadFile');
            // // print_r($file);exit();
            // if ($file->isValid() && !$file->hasMoved()) {
            //     $fileName = $file->getClientName();
            //     $type = $file->getClientMimeType();
            //     $file->move('Uploads/abhee/'.$fileName);
            

            // // Move the uploaded file to the target location
            // if (move_uploaded_file($uploadFile['tmp_name'], $target_file)) {
                // $message->attach(\Swift_Attachment::fromPath($uploadFile['tmp_name'])->setFilename($uploadFile['name']));
            // } else {
            // // Handle upload error
            //     echo "Sorry, there was an error uploading your file.";
            // }
            // print_r($message);exit();
        
            $result = $mailer->send($message);
            
            $data['status']='True';
            $data['code']='0';
            $data['message']='successfully added';
            $data['success']='success';
            // echo json_encode($data);
        return $data;

    }
    public function landpartnersmail()
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phoneno = $_POST["phone"];
        $city = $_POST["city"];
        $location = $_POST["location"];
        $property_details = $_POST["property_details"];
        $uploadFile = $_POST["document"];

	print_r('hi');exit();
      
        //   print_r($uploadFile);exit();
        
        require_once '../vendor/autoload.php';    
        
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com',465,'ssl'))
            ->setUsername('indiaestatehomes@gmail.com')
            ->setPassword('ffpc xuul oyxb nint');
        // $transport = (new \Swift_SmtpTransport('smtppro.zoho.in',465,'ssl'))
        //     ->setUsername('sales@indiaestates.in')
        //     ->setPassword('Test#247');
        $body="<p style='font-size:18px; margin-bottom:0px;'>Dear Admin,</p>"."<br />
            "."<p style='margin-bottom:0px; margin-top:0px;'>We have received a request for Land Partner from ". $name ."</p><br />
            "."<p style='margin:0px;'>Details are as below.</p><br />
            "."Name : $name <br />
            "."Phone Number : $phoneno <br />
            "."Email : $email <br />
            "."City : $city <br />
            "."Location : $location <br />
            "."Property Details : $property_details <br /> 
            "."Resume : ".$uploadFile['name']." <br />
            <p style='margin-bottom:0px;'> Regards,</p><br/>
            "."<h3 style='margin-top:0px;'>Abhee ventures</h3>";
            
            // Create the Mailer using your created Transport
            $mailer = new \Swift_Mailer($transport);
            // Create a message
            $message = (new \Swift_Message('Job Application from Abhee ventures'));
            $message ->setFrom(array('indiaestatehomes@gmail.com' => 'Job Application from Abhee ventures'));
            $message ->setTo(array('murali@homes247.in','naveen@homes247.in'));
            $message ->setSubject('Job Application from Abhee ventures');
            $message ->setBody($body, 'text/html');
            // attach(\Swift_Attachment::fromPath("../public/Uploads/mail_img/2.png"));
            $message->attach(\Swift_Attachment::fromPath($uploadFile['tmp_name'])->setFilename($uploadFile['name']));

            // Assuming $target_dir is the defined location for storing uploaded files
            // $target_dir = 'Uploads/abhee';
            // $target_file = $target_dir . basename($uploadFile['name']);
            // $file = $this->request->getFile('uploadFile');
            // // print_r($file);exit();
            // if ($file->isValid() && !$file->hasMoved()) {
            //     $fileName = $file->getClientName();
            //     $type = $file->getClientMimeType();
            //     $file->move('Uploads/abhee/'.$fileName);
            

            // // Move the uploaded file to the target location
            // if (move_uploaded_file($uploadFile['tmp_name'], $target_file)) {
                // $message->attach(\Swift_Attachment::fromPath($uploadFile['tmp_name'])->setFilename($uploadFile['name']));
            // } else {
            // // Handle upload error
            //     echo "Sorry, there was an error uploading your file.";
            // }
            // print_r($message);exit();
        
            $result = $mailer->send($message);
            
            $data['status']='True';
            $data['code']='0';
            $data['message']='successfully added';
            $data['success']='success';
            // echo json_encode($data);
        return $data;

    }

    

}