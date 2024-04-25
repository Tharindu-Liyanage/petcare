<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    class Doctor extends Controller {

        public function __construct(){

            $this->userModel = $this->model('User');

            $currentTime = time();
            $inactiveTime = 30*60; // 30 minutes in seconds 

            if (!isset($_SESSION['last_activity'])) {
                $_SESSION['last_activity'] = $currentTime; // Set initial last activity time
            }

            if(!isset($_SESSION['user_id'])){

                if(isset($_SESSION['last_activity'])){
                    unset($_SESSION['last_activity']);
                }

                redirect('users/staff');

            }elseif($_SESSION['user_role'] != "Doctor"){

                    // Unauthorized access
                    if(isset($_SESSION['last_activity'])){
                        unset($_SESSION['last_activity']);
                    }
                    
                    redirect('users/staff');
                     
              
            }elseif($currentTime - $_SESSION['last_activity'] > $inactiveTime){

                $this->userModel->updateStaffOnlineStatus($_SESSION['user_email'],0);

                sessionExpire();
                unset($_SESSION['last_activity']);
                $_SESSION['error_msg_from_staff'] ="Session Expired. Please login again.";
                redirect('users/staff');

            }

            // Update last activity time to current time
            $_SESSION['last_activity'] = $currentTime;


            $this->doctorModel = $this->model('DoctorModel');
            $this->dashboardModel = $this->model('Dashboard');
            $this->postModel = $this->model('Post');
            $this->settingsModel= $this->model('Settings') ;

           
        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        public function index(){

            $greetingmsg = $this->getWelcomeGreeting();
            $appointmentDetails = $this->getCurrentAppointment();
            $todayAppointment = $this->doctorModel->getTodayAppointment();

            $data = [
                'greetingmsg' => $greetingmsg,
                'appointmentDetails' =>$appointmentDetails,
                'todayAppointment' => $todayAppointment
            ];
   
            
            $this->view('dashboards/doctor/index', $data);
        }

        public function getWelcomeGreeting(){
            
              

            $currentTime = date('H:i:s'); // Get the current time in 24-hour format

            if ($currentTime >= '00:00:00' && $currentTime < '12:00:00') {
                return "Good morning!";
            } elseif ($currentTime >= '12:00:00' && $currentTime < '17:00:00') {
                return "Good afternoon!";
            } elseif ($currentTime >= '17:00:00' && $currentTime < '20:00:00') {
                return "Good evening!";
            } else {
                return "Good night!";
            }
        

        }


        public function getCurrentAppointment(){

            $time_slots = $this->dashboardModel->getTimeSlots();
            

            $am_pm = date('a');
            if ($am_pm == 'am') {
                $itisAM = true;
            } else {
                $itisAM = false;
            }

            $dateString = date('Y-m-d');
            $timestamp = strtotime($dateString);
            $dayOfWeek = date('l', $timestamp);
           //to make $daysofweek output first letter simple
            $formattedDay = strtolower(substr($dayOfWeek, 0));

            foreach($time_slots as $timeslots){

                if($timeslots->day == $formattedDay && $itisAM == true && $timeslots->part_of_day == "morning" ){

                    $timeIntervel = $timeslots->intervel;

                    // Convert the time string to a unix timestamp eg:- 30 min to 00:30:00

                    $hours = floor($timeIntervel / 60);
                    $minutes = $timeIntervel % 60;
                    $seconds = 0;

                    // Format the result
                    $time_format = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                    break;

                }else if($timeslots->day == $formattedDay && $itisAM == false && $timeslots->part_of_day == "afternoon" ){
                    
                    $timeIntervel = $timeslots->intervel;

                    // Convert the time string to a unix timestamp eg:- 30 min to 00:30:00

                    $hours = floor($timeIntervel / 60);
                    $minutes = $timeIntervel % 60;
                    $seconds = 0;

                    // Format the result
                    $time_format = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                    break;

                } 
            

              
        
            }

            
    
            $appointmentDetails = $this->doctorModel->getCurrentAppointmentDB($time_format);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              //  $jsonData = json_encode($appointmentDetails);

                // Send the JSON response
              //  header('Content-Type: application/json');
             //   echo $jsonData;
            
                $jsonData = json_encode($appointmentDetails);
              

                // Send the JSON response
               header('Content-Type: application/json');
               echo $jsonData;
        
                
            }else{
                return $appointmentDetails;
            }
           

        }

        public function pastReports(){
                
                $data =null;
    
                $this->view('dashboards/doctor/treatment/checkBeforeTreatment',$data);
        }

        public function requestPastMedicalReports($pet_id,$wardOrNot){


                //get pet age
                $petDetails  =$this->doctorModel-> getPetDetailsByPetID($pet_id);
                

                //error handling if user try to access url with wrong pet id
                if($wardOrNot != "ward" && $wardOrNot != "appointment" && $wardOrNot != "emergency"){
                    redirect('doctor/notfound');
                }

                //error handling if user try to access url with wrong pet id
                if(!isset($petDetails)){
                    redirect('doctor/notfound');
                }
                    
                //get treatment details by pet id
                $treatmentDetails = $this->doctorModel->getTreatmentDetailsByPetID($pet_id);
                $closedTreatmentDetails = $this->doctorModel->getClosedTreatmentDetailsByPetID($pet_id);
                $wardDetails = $this->doctorModel->getWardTreatmentDetailsByPetID($pet_id);

                //get latest treatment id by pet id from appointment table
                $latestTreatmentID = $this->doctorModel->getLatestTreatmentID($pet_id);

                //set pet age
                $petDOB = $petDetails->DOB;
                $visitDate = date("Y-m-d");
                $petDetails->DOB = $this->calculateAgeForMedicalReport($petDOB,$visitDate);

               

                $data = [
                    'treatmentDetails' => $treatmentDetails,
                    'closedTreatmentDetails' => $closedTreatmentDetails,
                    'latestTreatmentID' => $latestTreatmentID,
                    'petDetails' => $petDetails,
                    'pet_id' => $pet_id,
                    'wardDetails' => $wardDetails,
                    'wardOrNot' => $wardOrNot
                ];
    
                $this->view('dashboards/doctor/treatment/checkBeforeTreatment',$data);

        }

        public function viewMedicalReport($id){
                
                $medicalReport = $this->doctorModel->getTreatmentDetailsByTreatmentID($id);
                //hospital info from dashboard model 
                $hospitalInfo = $this->dashboardModel->getPetCareDetails();  
                
                if($medicalReport == null){   //if no data found : its mean user try to access url with wrong treatment id(intentionally)
                    redirect('doctor/notfound');
                }
    
                foreach ($medicalReport as $treament) {
                    // Assuming 'DOB' is the property name, replace it with the correct property name if needed
                    $petDOB = isset($treament->DOB) ? $treament->DOB : null;
                    $visitDate = isset($treament->visit_date) ? $treament->visit_date : null;
            
                    $treament->petAge = $this->calculateAgeForMedicalReport($petDOB,$visitDate);
                }
               
    
                $data = [
                    'medicalreportview' => $medicalReport,
                    'petcareInfo' => $hospitalInfo,
                    'treatment_id' => $id
                ];
    
                $this->view('dashboards/doctor/treatment/viewMedicalReport',$data);
        }

        public function viewWardMedicalReport($id){
                
            $medicalReport = $this->doctorModel->getWardTreatmentDetailsByTreatmentID($id);
            //hospital info from dashboard model 
            $hospitalInfo = $this->dashboardModel->getPetCareDetails();  
            
            if($medicalReport == null){   //if no data found : its mean user try to access url with wrong treatment id(intentionally)
                redirect('doctor/animalward');
            }

            foreach ($medicalReport as $treament) {
                // Assuming 'DOB' is the property name, replace it with the correct property name if needed
                $petDOB = isset($treament->DOB) ? $treament->DOB : null;
                $visitDate = isset($treament->lastupdate) ? $treament->lastupdate : null;
        
                $treament->petAge = $this->calculateAgeForMedicalReport($petDOB,$visitDate);
            }
           

            $data = [
                'medicalreportview' => $medicalReport,
                'petcareInfo' => $hospitalInfo,
                'treatment_id' => $id
            ];

            $this->view('dashboards/doctor/treatment/viewWardMedicalReport',$data);
    }

        public function calculateAgeForMedicalReport($birthdate,$visitDate) {

            /* Age cannot be changed in Report so get different between birthDate and VisitDate */

            // Create a DateTime object from the birthdate
            $birthdate = new DateTime($birthdate);
            
            // Get the current date
            $visitDate = new DateTime($visitDate);
            
            // Calculate the difference in years and months
            $ageInterval = $visitDate->diff($birthdate);
        
            $years = $ageInterval->y;
            $months = $ageInterval->m;
            $days = $ageInterval->d;
        
            // Build the age string
            $ageString = '';
            if ($years > 0) {
                $ageString .= "$years" . " Years ";
            }
            if ($months > 0) {
                $ageString .= "$months" . " Months";
            }
            if ($days > 0 && $months == 0 && $years == 0) {
                $ageString .= "$days" . " Days";
            }
        
            return $ageString;
        }


        public function addTreatment($id,$trtID){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                 //get pet details and petowner details by pet id
            $petDetails = $this->doctorModel->getPetDetailsByPetID($id);

            //age calculation
            $petDOB = $petDetails->DOB;
            $visitDate = date("Y-m-d");
            $petDetails->DOB = $this->calculateAgeForMedicalReport($petDOB,$visitDate);

                $data = [
                    'pet_id' => $id,
                    'trtID' => $trtID,
                    'main_err' => '',
                    'diagnosis' => $_POST['diagnosis'],
                    'treatment_plan' => $_POST['treatment-plan'],
                    'prescription' => $_POST['prescription'],
                    'examination' => $_POST['examination'],
                    'follow-up-reason' => $_POST['follow-up-reason'],
                    'instructions' => $_POST['instruction'],
                    'date' => $_POST['follow-up-date'],
                    'status' => $_POST['status'],
                    'petDetails' => $petDetails,
                    'diagnosis_err' => '',
                    'treatment_plan_err' => '',
                    'prescription_err' => '',
                    'examination_err' => '',
                    'follow-up-reason_err' => '',
                    'instructions_err' => '',
                    'date_err' => '',
                    'status_err' => '',
                    'visit_date' => date("Y-m-d"),

                ];
                
                $error_count =0;

                // Validate data
                if (empty($data['diagnosis'])) {
                    $error_count++;
                    $data['diagnosis_err'] = 'Please enter diagnosis';
                }

                if (empty($data['treatment_plan'])) {
                    $error_count++;
                    $data['treatment_plan_err'] = 'Please enter treatment plan';
                }

                if (empty($data['prescription'])) {
                    $error_count++;
                    $data['prescription_err'] = 'Please enter prescription';
                }

                if (empty($data['examination'])) {
                    $error_count++;
                    $data['examination_err'] = 'Please enter examination';
                }

                

                if (empty($data['instructions'])) {
                    $error_count++;
                    $data['instructions_err'] = 'Please enter instructions';

                }

                if (empty($data['status'])) {
                    $error_count++;
                    $data['status_err'] = 'Please select status';

                }



            
              



        
                // Make sure no errors
                if($error_count == 0){
                    // Validated

                    if (empty($data['date']) && $data['status'] == "Ongoing" && empty($data['follow-up-reason'])) {

                        //this if for if user select status as ongoing and not enter follow up date and follow up reason

                        $data['main_err'] = 'You selected status as ongoing. Please enter follow up date and a reson for follow up';
                        $data['follow-up-reason_err'] = 'Please enter follow up reason';
                        $data['date_err'] = 'Please enter follow up date';

                        //load with errors
                        $this->view('dashboards/doctor/treatment/addTreatment',$data);

                    }else if(!empty($data['date']) && $data['status'] == "Ongoing" && empty($data['follow-up-reason'])){

                        //this if for if user select status as ongoing and not enter follow up reason

                        $data['main_err'] = 'You selected status as ongoing. Please enter a reson for follow up';
                        $data['follow-up-reason_err'] = 'Please enter follow up reason';

                        //load with errors
                        $this->view('dashboards/doctor/treatment/addTreatment',$data);

                    }else if(empty($data['date']) && $data['status'] == "Ongoing" && !empty($data['follow-up-reason'])){

                        //this if for if user select status as ongoing and not enter follow up date

                        $data['main_err'] = 'You selected status as ongoing. Please select a follow up date';
                        $data['date_err'] = 'Please enter follow up date';
                        $data['status_err'] = 'Select status as ongoing';

                        //load with errors
                        $this->view('dashboards/doctor/treatment/addTreatment',$data);
                       
                    }else if(!empty($data['date']) && $data['status'] == "Closed" && !empty($data['follow-up-reason'])){

                        //this if for if user select status as closed and enter follow up date and follow up reason

                        $data['main_err'] = 'You selected status as closed. Please remove follow up date and follow up reason';
                        $data['follow-up-reason_err'] = 'Please remove follow up reason';
                        $data['date_err'] = 'Please remove follow up date';

                        //load with errors
                        $this->view('dashboards/doctor/treatment/addTreatment',$data);

                    }else if(!empty($data['date']) && $data['status'] == "Closed" && empty($data['follow-up-reason'])){

                        //this if for if user select status as closed and enter follow up date and not follow up reason

                        $data['main_err'] = 'You selected status as closed. Please remove follow up date';
                        $data['date_err'] = 'Please remove follow up date';

                        //load with errors
                        $this->view('dashboards/doctor/treatment/addTreatment',$data);
                    }else if(empty($data['date']) && $data['status'] == "Closed" && !empty($data['follow-up-reason'])){

                        //this if for if user select status as closed and not enter follow up date and follow up reason

                        $data['main_err'] = 'You selected status as closed. Please remove follow up reason';
                        $data['follow-up-reason_err'] = 'Please remove follow up reason';

                        //load with errors
                        $this->view('dashboards/doctor/treatment/addTreatment',$data);
                    }
                    
                else{
                        // Validated
                        // Execute
                        if($this->doctorModel->addTreatment($data)){

                            $_SESSION['notification'] = 'ok';
                            $_SESSION['notification_msg'] = 'Treatment Added Successfully.';
                            // Redirect to login
                            redirect('doctor/appointment');
                        } else {
                            die('Something went wrong');
                        }
                    }

                }else{

                    //main error with error counts
                    $data['main_err'] = 'Please fill all the fields. You missed '.$error_count.' fields';

                    //load erros
                    $this->view('dashboards/doctor/treatment/addTreatment',$data);

                }

                    



            }else{

            //get pet details and petowner details by pet id
            $petDetails = $this->doctorModel->getPetDetailsByPetID($id);

            //age calculation
            $petDOB = $petDetails->DOB;
            $visitDate = date("Y-m-d");
            $petDetails->DOB = $this->calculateAgeForMedicalReport($petDOB,$visitDate);

            


                $data = [
                    'pet_id' => $id,
                    'trtID' => $trtID,
                    'main_err' => '',
                    'petDetails' => $petDetails,
                    'diagnosis' =>'',
                    'treatment_plan' => '',
                    'prescription' => '',
                    'examination' => '',
                    'follow-up-reason' =>'',
                    'instructions' => '',
                    'date' =>'',
                    'status' => '',
                ];

            

               $this->view('dashboards/doctor/treatment/addTreatment',$data); 

            }
        }



        public function addWardTreatment($id,$trtID){


            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                 //get pet details and petowner details by pet id
                $petDetails = $this->doctorModel->getPetDetailsByPetID($id);

                //age calculation
                $petDOB = $petDetails->DOB;
                $visitDate = date("Y-m-d");
                $petDetails->DOB = $this->calculateAgeForMedicalReport($petDOB,$visitDate);

                    $data = [
                        'pet_id' => $id,
                        'trtID' => $trtID,
                        'main_err' => '',
                        'diagnosis' => $_POST['diagnosis'],
                        'treatment_plan' => $_POST['treatment-plan'],
                        'prescription' => $_POST['prescription'],
                        'examination' => $_POST['examination'],
                        'instructions' => $_POST['instruction'],
                        'status' => $_POST['status'],
                        'petDetails' => $petDetails,
                        'diagnosis_err' => '',
                        'treatment_plan_err' => '',
                        'prescription_err' => '',
                        'examination_err' => '',
                        'follow-up-reason_err' => '',
                        'instructions_err' => '',
                        'status_err' => '',

                    ];

                    //die(print_r($data));
                    
                    $error_count =0;

                    // Validate data
                    if (empty($data['diagnosis'])) {
                        $error_count++;
                        $data['diagnosis_err'] = 'Please enter diagnosis';
                    }

                    if (empty($data['treatment_plan'])) {
                        $error_count++;
                        $data['treatment_plan_err'] = 'Please enter treatment plan';
                    }

                    if (empty($data['prescription'])) {
                        $error_count++;
                        $data['prescription_err'] = 'Please enter prescription';
                    }

                    if (empty($data['examination'])) {
                        $error_count++;
                        $data['examination_err'] = 'Please enter examination';
                    }

                    

                    if (empty($data['instructions'])) {
                        $error_count++;
                        $data['instructions_err'] = 'Please enter instructions';

                    }

                    if (empty($data['status'])) {
                        $error_count++;
                        $data['status_err'] = 'Please select status';

                    }



                    if($error_count == 0){
                        // Validated

                        if($this->doctorModel->addWardTreatment($data)){

                            $_SESSION['notification'] = 'ok';
                            $_SESSION['notification_msg'] = 'Ward Treatment Added Successfully.';
                            $_SESSION['notification_title'] = 'Success!';

                            if($data['status'] == "Discharge"){
                                //send mail to pet owner and sms
                                $petandPetownerDetails = $this->doctorModel->getPetDetailsByPetID($id);
                                
                                $this->sendDischargeMail($petandPetownerDetails);
                                $this->sendDischargeSMS($petandPetownerDetails);

                                $_SESSION['notification'] = 'ok';
                                $_SESSION['notification_msg'] = 'Pet Discharged Successfully.';
                                $_SESSION['notification_title'] = 'Success!';

                            }
                            // Redirect to animalward
                            redirect('doctor/animalward');
                        } else {
                            die('Something went wrong');
                        }
                    }else{

                        //main error with error counts
                        $data['main_err'] = 'Please fill all the fields. You missed '.$error_count.' fields';

                        //load erros
                        $this->view('dashboards/doctor/treatment/addWardTreatment',$data);

                    }




            
            }else{

                 //get pet details and petowner details by pet id
                $petDetails = $this->doctorModel->getPetDetailsByPetID($id);

                //age calculation
                $petDOB = $petDetails->DOB;
                $visitDate = date("Y-m-d");
                $petDetails->DOB = $this->calculateAgeForMedicalReport($petDOB,$visitDate);
 
             
                 $data = [
                     'pet_id' => $id,
                     'trtID' => $trtID,
                     'main_err' => '',
                     'petDetails' => $petDetails,
                     'diagnosis' =>'',
                     'treatment_plan' => '',
                     'prescription' => '',
                     'examination' => '',
                     'instructions' => '',
                     'status' => '',
                 ];
 
                $this->view('dashboards/doctor/treatment/addWardTreatment',$data);

            }

            

        }


        public function sendDischargeMail($data){

            require __DIR__ . '/../libraries/phpmailer/vendor/autoload.php';

            
            try {
                // Create a new PHPMailer instance
                $mail = new PHPMailer(true);
        
                // Set mail configuration (replace with your actual details)
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['MAIL_USERNAME'];
                $mail->Password = $_ENV['MAIL_PASSWORD']; // Replace with your password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
        
                // Set email sender details
                $mail->setFrom($_ENV['MAIL_USERNAME'], 'PetCare');
        
                // Add recipient address
                $mail->addAddress($data->petowneremail, 'User: ' . $data->petowneremail);
        
                // Set subject and body
                $mail->Subject = 'Pet Discharge Notification';
                $mail->isHTML(true);
    
                $filePath = __DIR__ . '/../views/email/petDischargeEmail.php';
                $emailContent = file_get_contents($filePath);
    
                $emailContent = str_replace('{pet_owner_fname}', $data->petownerfname, $emailContent);
                $emailContent = str_replace('{pet_owner_lname}', $data->petownerlname, $emailContent);
                $emailContent = str_replace('{pet}',$data->pet, $emailContent);


                $mail->Body = $emailContent;
    
                // Send the email
                $mail->send();
    
                
               
                
    
            } catch (Exception $e) {
                // Handle exceptions
                echo 'Error: ' . $mail->ErrorInfo;
            }

        }


        public function sendDischargeSMS($data){

            // Send SMS
            $userID = $_ENV['NOTIFY_USERID'];
            $apiKey = $_ENV['NOTIFY_APIKEY'];
    
            $customMessage ="Hello " . $data->petownerfname . " " . $data->petownerlname  . "," .$data->pet. " is ready to be discharged from our care at PetCare Vet Clinic. Thank you for choosing PetCare. We're excited to serve you!" ; // Replace this with your custom message
            $sendEndpoint = "https://app.notify.lk/api/v1/send?user_id={$userID}&api_key={$apiKey}&sender_id=NotifyDEMO&to=[TO]&message=" . urlencode($customMessage);
            $sendEndpoint = str_replace('[TO]', $data->petownerphone, $sendEndpoint);
            //$sendResponse = file_get_contents($sendEndpoint);
        }






        public function appointment(){

            $appintment = $this->doctorModel->getAppointmentByVetID();
            $data =[
                'appointment' => $appintment
            ];

            $this->view('dashboards/doctor/appointment/appointment',$data);
        }

        public function animalward(){

            //get animal ward details
           $wardDetails = $this->doctorModel->getAnimalWardDetails();
           $counOfCage = $this->doctorModel->getCageCountAll();
           $dischargeDetails = $this->doctorModel->getDischargePets();

            $data = [
                'animalward' => $wardDetails,
                'cageCount' => $counOfCage,
                'dischargeDetails' => $dischargeDetails
            ];

            $this->view('dashboards/doctor/animalward/animalward',$data);
        }

        public function updateWardTreatment(){

            $data =null;

            $this->view('dashboards/doctor/animalward/updateWardTreatment',$data);
        }

        public function addmitPet($petid,$reason){

            $reason_text = str_replace('-', ' ', $reason);

            $data =[
                'petid' => $petid,
                'reason' => $reason_text
            ];

           //addmit pet to the ward

            if($this->doctorModel->addmitPetToWard($data)){
                $_SESSION['notification'] = 'ok';
                $_SESSION['notification_msg'] = 'Pet Admitted to the Ward Successfully.';
 
            }
            
              

            redirect('doctor/animalward');

        }

        public function pet(){
            
            //get all pet details
            $petDetails = $this->doctorModel->getAllPetDetails();

            //age calculation by calculateAge function
            foreach ($petDetails as $pet) {
                // Assuming 'DOB' is the property name, replace it with the correct property name if needed
                $petDOB = isset($pet->DOB) ? $pet->DOB : null;
                $pet->DOB = $this->calculateAge($petDOB);
            }


            $data = [
                'pet' => $petDetails
            ];


            $this->view('dashboards/doctor/pet/pet',$data);
        }


        public function calculateAge($birthdate) {
            // Create a DateTime object from the birthdate
            $birthdate = new DateTime($birthdate);
            
            // Get the current date
            $currentDate = new DateTime();
            
            // Calculate the difference in years, months, and days
            $ageInterval = $currentDate->diff($birthdate);
        
            $years = $ageInterval->y;
            $months = $ageInterval->m;
            $days = $ageInterval->d;
        
            // Build the age string
            $ageString = '';
            if ($years > 0) {
                $ageString .= "$years" . " Years ";
            }
            if ($months > 0 ) {
                $ageString .= "$months" . " Months ";
            }
            if ($days > 0 && $months == 0 && $years == 0) {
                $ageString .= "$days" . " Days";
            }
        
            return $ageString;
        }

        public function blog(){
            $blog = $this->postModel->getPosts();
            $data = [
                'blog' => $blog
            ];
            $this->view('dashboards/doctor/blog/blog',$data);
        }

        public function updateBlog($id){


            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                 $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                  if (isset($_FILES['blog_img'])) {
                    $uploadedFileName = $_FILES['blog_img']['name'];
                    $fileExtension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);  // Extract the file extension

                    // Generate a timestamp for uniqueness
                    $timestamp = time();

                    // Create a unique ID by concatenating values and adding the file extension
                    $uniqueImgFileName = $_POST['title'] . '_' . $_SESSION['user_id'] . '_' . $timestamp . '.' . $fileExtension;

                }

                $data = [
                    'title' => trim($_POST['title']),
                    'user_id' => $_SESSION['user_id'],
                    'content' => trim($_POST['content']),
                    'title_err' => '',
                    'content_err' => '',
                    'img' => ($_FILES['blog_img']['error'] === UPLOAD_ERR_NO_FILE) ? null : $_FILES['blog_img'],
                    'img_err' => '',
                    'uniqueImgFileName' =>$uniqueImgFileName,
                    'id' => $id
                 ];


                //  $this->view('dashboards/doctor/blog/addBlog',$data);



                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter the title';
                 }

                 if(empty($data['content'])){
                    $data['content_err'] = 'Please fill the content field';
                 }

                

                

                $allowedTypes = ['image/jpeg', 'image/png'];

                 if(empty($data['img'])){
                    $data['img_err'] = 'Please choose a Thumnail Photo';
                 }elseif(!isset($_FILES['blog_img']['type']) || ($_FILES['blog_img']['type'] && !in_array($_FILES['blog_img']['type'], $allowedTypes))) {
                    // Invalid file type
                    $data['img_err'] = 'Invalid file type. Please upload an image (JPEG or PNG).';
                 }elseif(isset($_FILES['blog_img'])){
                   
                    $dimensions = getimagesize($_FILES['blog_img']['tmp_name']);
                    $width = $dimensions[0];
                    $height = $dimensions[1];
                    
                    // Check if the image is portrait-oriented (height > width)
                    if($height > $width){
                        

                        $data['img_err'] = 'Sorry, only landscape-oriented images are allowed.';

                    } 
                }elseif($_FILES['blog_img']['size'] > 5 * 1024 * 1024 ){ // 5MB in bytes
                    $data['img_err'] = 'Image size must be less than 5 MB';
                }


               
                 
                 
                if(empty($data['title_err']) && empty($data['content_err']) && empty($data['img_err'])){
                    if($this->postModel->updateBlog($data)){

                        $_SESSION['notification'] = 'ok';
                        $_SESSION['notification_msg'] = 'Blog Updated Successfully.';
                        
                       
                        redirect('doctor/blog');
                        
                        
                     }else{

                        $_SESSION['notification'] = 'error';
                        $_SESSION['notification_msg'] = 'Something went wrong. Please try again.';
                        
                       
                        redirect('doctor/blog');
                     }
                 }else{
                    
                    //load with errors
                    $this->view('dashboards/doctor/blog/updateBlog',$data);

                 }

                 

            }else{

                $post = $this->postModel->getPostById($id);

                $data = [
                    'id' => $id,
                    'title' => $post->title,
                    // 'tags' => $post->tags,
                    'img' => $post->thumbnail,
                    'content' => $post->content,
                    'title_err' => '',
                    'content_err' => '',
                    'img_err' => '',
                    
                 ];


                 //validate

                 

                //  print_r($data['title_err']);
                 $this->view('dashboards/doctor/blog/updateBlog',$data);

            }



            
        }

        public function deleteBlog($id){
            // if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // die ("delete");
                if($this->postModel->deleteBlog($id)){
                    
                    $_SESSION['notification'] = 'ok';
                    $_SESSION['notification_msg'] = 'Blog Deleted Successfully.';
                   

                    redirect('doctor/blog');
                      

                }else{

                    $_SESSION['notification'] = 'error';
                    $_SESSION['notification_msg'] = 'Something went wrong. Please try again.';
                    

                    redirect('doctor/blog');

                }
            // // }else{
            //     redirect('doctor/blog');
            // // }
        }

        public function addBlog(){

         


            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                 $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                 

                 if (isset($_FILES['blog_img'])) {
                    $uploadedFileName = $_FILES['blog_img']['name'];
                    $fileExtension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);  // Extract the file extension

                    // Generate a timestamp for uniqueness
                    $timestamp = time();

                    // Create a unique ID by concatenating values and adding the file extension
                    $uniqueImgFileName = $_POST['title'] . '_' . $_SESSION['user_id'] . '_' . $timestamp . '.' . $fileExtension;

                }

                 $data = [
                    'title' => trim($_POST['title']),
                    'user_id' => $_SESSION['user_id'],
                    'content' => trim($_POST['content']),
                    'title_err' => '',
                    'content_err' => '',
                    'img' => ($_FILES['blog_img']['error'] === UPLOAD_ERR_NO_FILE) ? null : $_FILES['blog_img'],
                    'img_err' => '',
                    'uniqueImgFileName' =>$uniqueImgFileName
                 ];



                //  $this->view('dashboards/doctor/blog/addBlog',$data);



                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter the title';
                 }

                 if(empty($data['content'])){
                    $data['content_err'] = 'Please fill the content field';
                 }

          /*       $allowedTypes = ['image/jpeg', 'image/png'];

                 if(empty($data['img'])){
                    $data['img_err'] = 'Please choose a Thumnail Photo';
                 }elseif(!isset($_FILES['blog_img']['type']) || ($_FILES['blog_img']['type'] && !in_array($_FILES['blog_img']['type'], $allowedTypes))) {
                    // Invalid file type
                    $data['img_err'] = 'Invalid file type. Please upload an image (JPEG or PNG).';
                 }elseif(isset($_FILES['blog_img'])){
                   
                    $dimensions = getimagesize($_FILES['blog_img']['tmp_name']);
                    $width = $dimensions[0];
                    $height = $dimensions[1];
                    
                    // Check if the image is portrait-oriented (height > width)
                    if($height > $width){
                        

                        $data['img_err'] = 'Sorry, only landscape-oriented images are allowed.';

                    } 
                }elseif($_FILES['blog_img']['size'] > 5 * 1024 * 1024 ){ // 5MB in bytes
                    $data['img_err'] = 'Image size must be less than 5 MB';
                }


                */

                




                $allowedTypes = ['image/jpeg', 'image/png'];

                 if(empty($data['img'])){
                    $data['img_err'] = 'Please choose a Thumnail Photo';
                 }elseif(!isset($_FILES['blog_img']['type']) || ($_FILES['blog_img']['type'] && !in_array($_FILES['blog_img']['type'], $allowedTypes))) {
                    // Invalid file type
                    $data['img_err'] = 'Invalid file type. Please upload an image (JPEG or PNG).';
                 }elseif(isset($_FILES['blog_img'])){
                   
                    $dimensions = getimagesize($_FILES['blog_img']['tmp_name']);
                    $width = $dimensions[0];
                    $height = $dimensions[1];
                    
                    // Check if the image is portrait-oriented (height > width)
                    if($height > $width){
                        

                        $data['img_err'] = 'Sorry, only landscape-oriented images are allowed.';

                    } 
                }elseif($_FILES['blog_img']['size'] > 5 * 1024 * 1024 ){ // 5MB in bytes
                    $data['img_err'] = 'Image size must be less than 5 MB';
                }

               

             
                 //handle error in img here
                 /*
                    mandotary to upload image before post

                    1.file not upload
                    2.dimension
                    3. img type jpg or png

                    need to update method , remove tags , 
                    
                    img dir -> storage/uploads/blogs 
                    img uniquefile name insert to the db
                 */

                 
                 if(empty($data['title_err']) && empty($data['content_err']) && empty($data['img_err'])){
                    if($this->postModel->addBlog($data)){

                        $_SESSION['notification'] = 'ok';
                        $_SESSION['notification_msg'] = 'Blog Added Successfully.';
                      

                        redirect('doctor/blog');
                       
                       
                        
                        
                     }else{

                        $_SESSION['notification'] = 'error';
                        $_SESSION['notification_msg'] = 'Something went wrong. Please try again.';
                        
    
                        redirect('doctor/blog');
                     }
                 }else{
                    
                    //load with errors
                    $this->view('dashboards/doctor/blog/addBlog',$data);

                 }

                 

            }else{
                $data = [
                    'title' => '',
                    'content' => '',
                    'title_err' => '',
                    'content_err' => '',
                    'img_err' => '',
                 ];


                 //validate

                 

                //  print_r($data['title_err']);
                 $this->view('dashboards/doctor/blog/addBlog',$data);

            }



            
        }

        public function treatment(){
              //getTreatmentDetailsByVetID
              $treatmentDetails = $this->doctorModel->getTreatmentDetailsByVetID();
              $data = [
                  'treatment' => $treatmentDetails
              ];
            $this->view('dashboards/doctor/treatment/treatment',$data);
        }


        
        public function settings($setting_name){
            
                //$user_id = ($_SESSION['user_id']);
                //$settingsData = $this->settingsModel->getSettingDetails($user_id);
    
    
                $setting_name_array = [
                
                    'all',
                    'profile',
                    'email',
                    'password',
                    'mobile',
                    
                
                ];
        
                //check user intensionally going to wrong url
                if(!in_array($setting_name, $setting_name_array)){
                    redirect('doctor/notfound');
                }
    
    
                //================ all use to show all settings =========================//    
            if($setting_name == "all"){
    
    
                $data = null;
                $this->view('dashboards/doctor/setting/settings', $data);
    
            //================ profile use to show profile settings =========================//  
        }elseif($setting_name == "profile"){



            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                    if (isset($_FILES['pro_img'])) {
                        $uploadedFileName = $_FILES['pro_img']['name'];
                        $fileExtension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);  // Extract the file extension

                        // Generate a timestamp for uniqueness
                        $timestamp = time();

                        // Create a unique ID by concatenating values and adding the file extension
                        $uniqueImgFileName = $_POST['fname'] . '_' . $_POST['lname'] . '_' . $timestamp . '.' . $fileExtension;

                    }

                    $user = $this->dashboardModel->getStaffUserById($_SESSION['user_id']);

                   
                         



                    $data = [
                        'fname' => trim($_POST['fname']),
                        'lname' => trim($_POST['lname']),
                        'address' => trim($_POST['address']),
                        'profile_pic' => $_SESSION['user_profileimage'],
                        'profile_pic_img' => ($_FILES['pro_img']['error'] === UPLOAD_ERR_NO_FILE) ? null : $_FILES['pro_img'],
                        'nic' => trim($_POST['nic']),
                        'bio' => trim($_POST['bio']),
                        
                        'fname_err' => '',
                        'lname_err' => '',
                        'name_err'  => '',
                        'address_err' => '',
                        'img_err' => '',
                        'main_err' => '',
                        'uniqueImgFileName' => $uniqueImgFileName,
                        'nic_err' => '',
                        'bio_err' => ''

                    ];


                    //validating name
                    if(empty($data['fname']) && empty($data['lname'])){
                        $data['name_err'] = '*Please enter First Name and Last Name';
                        $data['fname_err'] = 'Please enter First Name';
                        $data['lname_err'] = 'Please enter Last Name';

                    }elseif(empty($data['fname'])){
                        $data['name_err'] = '*Please enter First Name';
                        $data['fname_err'] = 'Please enter First Name';

                    }elseif(empty($data['lname'])){
                        $data['name_err'] = '*Please enter Last Name';
                        $data['lname_err'] = 'Please enter Last Name';
                    }

                
                    //validate address
                    if(empty($data['address'])){
                        $data['address_err'] = '*Please enter Address';
                    }

                    //validate nic
                    if(empty(trim($_POST['nic']))){
                        $data['nic_err'] = '*Please enter NIC';
                    }elseif(strlen(trim($_POST['nic'])) != 12 && strlen(trim($_POST['nic'])) == 10 && (strtoupper($data['nic'][9]) !== 'V' )){
                        $data['nic_err'] = '*Please Enter Valid NIC. Old NIC must be 9 digits With V.';
                    }elseif(strlen(trim($_POST['nic'])) != 12 && strlen(trim($_POST['nic'])) != 10){
                        $data['nic_err'] = 'New NIC: 12 digits. Old NIC: 9 digits with V.';
                    }else{

                        if(strlen(trim($_POST['nic'])) == 10){
                            $data['nic'][9] = strtoupper($data['nic'][9]);
                        }
                    }


                    //validate Bio
                    if(empty(trim($_POST['bio']))){
                        $data['bio_err'] = '*Please enter Bio';
                    }elseif(strlen(trim($_POST['bio'])) > 500){
                        $data['bio_err'] = '*Bio must be less than 500 characters';
                    }



                    $allowedTypes = ['image/jpeg', 'image/png'];

                    if($data['profile_pic'] != null){
                        if (!isset($_FILES['pro_img']['type']) || ($_FILES['pro_img']['type'] && !in_array($_FILES['pro_img']['type'], $allowedTypes))) {
                            // Invalid file type
                            $data['img_err'] = '*Invalid file type. Please upload an image (JPEG or PNG).';
                        }
        
                        if($_FILES['pro_img']['size'] > 5 * 1024 * 1024 ){ // 5MB in bytes
                            $data['img_err'] = '*Image size must be less than 5 MB';
                        }
                    }

                     //going to check is there to any update or not 
                     //eg:- user didnt change anything but click update
                     if($user->firstname == trim($_POST['fname']) && $user->lastname == trim($_POST['lname']) && $user->address == trim($_POST['address']) && $data['profile_pic_img'] == null && $user->nic == trim($_POST['nic']) && $user->bio == trim($_POST['bio'])){
                        
                        $data['main_err'] = "*No changes were detected. The data remains as is.";
                     }


                    //Make sure errors are empty
                    if(empty($data['name_err']) && empty($data['address_err']) && empty($data['img_err']) && empty($data['main_err']) && empty($data['nic_err']) && empty($data['bio_err'])){
                        
                        //update profile
                        if($this->settingsModel->updateStaffProfile($data)){


                            //for notification
                            $_SESSION['notification'] = "ok";
                            $_SESSION['notification_msg'] = "Your profile information has been updated.";
                           redirect('doctor/settings/all');
        
                        }else{

                            //update error : can be database error
                            $_SESSION['notification'] = "error";
                            $_SESSION['notification_msg'] = "Please review and try again";
                            redirect('doctor/settings/all');
                        }


                    }else{

                        //load view with errors
                        $this->view('dashboards/admin/setting/profile_settings', $data);
                    }

            }else{

                //normal get requset for profile

                    $user = $this->dashboardModel->getStaffUserById($_SESSION['user_id']);

                    $data = [
                        'fname' => $user->firstname,
                        'lname' => $user->lastname,
                        'address' => $user->address,
                        'profile_pic' => $user->profileImage ,
                        'nic' => $user->nic,
                        'bio' => $user->bio,
                        
                        'fname_err' => '',
                        'lname_err' => '',
                        'name_err'  => '',
                        'address_err' => '',
                        'img_err' => '',
                        'main_err' => '',
                        'nic_err' =>'',
                        'bio_err' => '',
                        
                    ];

                    $this->view('dashboards/admin/setting/profile_settings', $data);

            }
    
                
    
           //================ password use to show password settings =========================//  
            }elseif($setting_name == "password"){
    
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
                    $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
    
                    $data = [
                        'cur_password' => trim($_POST['current_password']),
                        'new_password' => trim($_POST['new_password']),
                        'confirm_password' => trim($_POST['confirm_password']),
    
    
                        'cur_password_err' => '',
                        'new_password_err' => '',
                        'confirm_err' => '',
                    ];
    
                    //validate current password
                    if(empty($data['cur_password'])){
                        $data['cur_password_err'] = '*Please enter current password';
                    }elseif(!$this->settingsModel->verifyPasswordStaff($data['cur_password'])){
                        $data['cur_password_err'] = '*Incorrect password';
                    }
    
                    //validate new password
                    if(empty($data['new_password'])){
                        $data['new_password_err'] = '*Please enter new password';
                    }elseif(strlen($data['new_password']) < 8){
                        $data['new_password_err'] = '*Password must be at least 8 characters';
                    }
    
                    //validate confirm password
                    if(empty($data['confirm_password'])){
                        $data['confirm_err'] = '*Please confirm password';
                    }else{
                        if($data['new_password'] != $data['confirm_password']){
                            $data['confirm_err'] = '*Passwords do not match';
                            $data['confirm_password'] = '';
                        }
                    }
    
                    //Make sure errors are empty
                    if(empty($data['cur_password_err']) && empty($data['new_password_err']) && empty($data['confirm_err'])){
                        //validated
    
                        //hash password
                        $data['new_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
    
                        //update password
                        if($this->settingsModel->updatePasswordStaff($data['new_password'])){
    
                            //for notification
                            $_SESSION['notification'] = "ok";
                            $_SESSION['notification_msg'] = "Your password has been changed successfully.";
                            redirect('doctor/settings/all');
                        }else{
                            //update error : can be database error
                            $_SESSION['notification'] = "error";
                            $_SESSION['notification_msg'] = "Password update failed";
                            redirect('doctor/settings/all');
                        }
    
                    }else{
                        //load view with errors
                        $this->view('dashboards/admin/setting/password_settings', $data);
                    }
    
    
    
    
                }else{
    
                    $data = [
                        'cur_password' => '',
                        'new_password' => '',
                        'confirm_password' => '',
    
                        'cur_password_err' => '',
                        'new_password_err' => '',
                        'confirm_err' => '',
                        
                    ];
                    $this->view('dashboards/admin/setting/password_settings', $data);
                }
    
                
            //================ email use to show email settings =========================//  
            }elseif($setting_name == "email"){
    
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
                    $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
    
                    $user = $this->dashboardModel->getStaffUserById($_SESSION['user_id']);
    
    
                    $data = [
                        'new_email' => trim($_POST['new_email']),
                        'email' => $_SESSION['user_email'],
                        'otp_code' =>'',
                        'fname' => $user->firstname,
                        'lname' => $user->lastname,
    
                        'new_email_err' => '',
                        'otp_section' => 0,
                        'otp_err' => '',
                        'verify_msg' => 'We send OTP code to your Email.',
                        //
                    ];
    
                    
    
                    if(isset($_SESSION['otp']) && isset($_SESSION['otp_status']) && isset($_POST['main-submit'])){
    
                        if($_SESSION['otp'] == $_POST['otp_code']){
    
                            //update email
                            if($this->settingsModel->updateStaffEmail($data['new_email'])){
    
                                //for notification
                                $_SESSION['notification'] = "ok";
                                $_SESSION['notification_msg'] = "Your email address has been successfully updated";
    
                                unset($_SESSION['otp']);
                                unset($_SESSION['otp_status']);
    
    
                                redirect('doctor/settings/all');
                            }else{
    
    
                                //update error : can be database error
                                $_SESSION['notification'] = "error";
                                $_SESSION['notification_msg'] = "Email update failed";
    
                                unset($_SESSION['otp']);
                                unset($_SESSION['otp_status']);
    
                                redirect('doctor/settings/all');
                            }
    
                        }else{
                            //load with erros
                            $data['otp_code'] = trim($_POST['otp_code']);
                            $data['otp_err'] = '*OTP is incorrect';
                            $data['otp_section'] = 1;
                            $this->view('dashboards/admin/setting/email_settings', $data);
                        }
    
                    }
    
    
    
    
                    if(isset($_POST['main-submit'])){
    
                        
    
                        
    
                        //validate Email
                        if(empty($data['new_email'])){
                            $data['new_email_err'] = '*Please enter email';
                        }else{
                                
                                if(!filter_var($data['new_email'], FILTER_VALIDATE_EMAIL)){ //check email in correct formate
                                    $data['new_email_err'] = '*Please enter valid email';
                                }elseif($this->userModel->findStaffUserByEmail($data['new_email'])){  //check email in the DB
                                    $data['new_email_err'] = '*Email is already taken';
                                }
                        }
    
                        //Make sure errors are empty
    
                        if(empty($data['new_email_err'])){
    
                            if(isset($_SESSION['otp'])){
    
                                $data['otp_err'] = '*Please enter OTP';
    
                                //activate otp input
                                $data['otp_section'] = 1;
                                
                                
                            }else{
                                
                                //activate otp input
                                $data['otp_section'] = 1;
    
                                //genrate 4 digit numbers
                                $otp = rand(1000,9999);
    
                               
                                $data['otp_code'] = $otp;
                                //store otp in session
                                $_SESSION['otp'] = $otp;
    
                                //send otp to email
                                $this->sendOtpCodeEmail($data);
    
                                $data['otp_code'] = '';
    
                            }
    
                            
    
                            $this->view('dashboards/admin/setting/email_settings', $data);
    
                        }else{
    
                            //load with erros
                            $this->view('dashboards/admin/setting/email_settings', $data);
                        }
    
                        
                    
                    }elseif(isset($_POST['otp-button'])){
    
                        //activate otp input
                        $data['otp_section'] = 1;
    
                        $data['otp_code'] = trim($_POST['otp_code']);
    
                        //validate OTP
                        if(empty(trim($_POST['otp_code']))){
                            $data['otp_err'] = '*Please enter OTP';
                        }else{
                            if(trim($_POST['otp_code']) != $_SESSION['otp']){
                                $data['otp_err'] = '*OTP is incorrect';
                            }
                        }
    
                        //Make sure errors are empty
    
                        if(empty($data['otp_err'])){
    
                            $_SESSION['otp_status'] = "correct";
                            $data['verify_msg'] = '*Email verified successfully. Click Update.';
                            $this->view('dashboards/admin/setting/email_settings', $data);
                        }else{
                            //load with erros
                            $this->view('dashboards/admin/setting/email_settings', $data);
                        }
    
                        
                    }
    
                }else{
    
                    if(isset($_SESSION['otp']) || isset($_SESSION['otp_status'])){
                        unset($_SESSION['otp']);
                        unset($_SESSION['otp_status']);
                    }
    
                    $user = $this->dashboardModel->getStaffUserById($_SESSION['user_id']);
    
    
    
                    $data = [
                        'email' => $user->email,
                        'new_email' => '',
    
                        'new_email_err' => '',
                        'otp_section' => 0,
                        //We send OTP code to your Email.
                    ];
    
                    $this->view('dashboards/admin/setting/email_settings', $data);
                }
    
            }elseif($setting_name == "mobile"){
    
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
                    $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
    
                    $user = $this->dashboardModel->getStaffUserById($_SESSION['user_id']);
    
                    $data = [
                        'mobile' => $user->phone,
                        'new_mobile' => trim($_POST['new_mobile']),
                        'otp_code' =>'',
                        'fname' => $user->firstname,
                        'lname' => $user->lastname,
    
                        'new_mobile_err' => '',
                        'otp_section' => 0,
                        'otp_err' => '',
                        'verify_msg' => 'We send OTP code to your Mobile.',
                        //
                    ];
    
    
    
                    if(isset($_SESSION['otp_sms']) && isset($_SESSION['otp_status_sms']) && isset($_POST['main-submit'])){
    
                        if($_SESSION['otp_sms'] == $_POST['otp_code']){
    
                            //update email
                            if($this->settingsModel->updateStaffMobile($data['new_mobile'])){
    
                                //for notification
                                $_SESSION['notification'] = "ok";
                                $_SESSION['notification_msg'] = "Your mobile number has been updated.";
    
                                unset($_SESSION['otp_sms']);
                                unset($_SESSION['otp_status_sms']);
    
    
                                redirect('doctor/settings/all');
                            }else{
    
    
                                //update error : can be database error
                                $_SESSION['notification'] = "error";
                                $_SESSION['notification_msg'] = "Mobile Number Update Failed";
    
                                unset($_SESSION['otp_sms']);
                                unset($_SESSION['otp_status_sms']);
    
                                redirect('doctor/settings/all');
                            }
    
                        }else{
    
                            $data['otp_code'] = trim($_POST['otp_code']);
                            $data['otp_err'] = '*OTP is incorrect';
                            $data['otp_section'] = 1;
                            $this->view('dashboards/admin/setting/mobile_settings', $data);
                        }
    
                    }
    
    
    
    
                    if(isset($_POST['main-submit'])){
    
                        
    
                        
    
                        
                            //validate mobile
                        if(empty($data['new_mobile'])){
                            $data['new_mobile_err'] = 'Please enter mobile number';
                        }else{
    
                            if (!preg_match("/^94(?:7\d{8})$/", $data['new_mobile'])) {
                                $data['new_mobile_err'] = 'Please enter a valid mobile number starting with 94';
                            } elseif ($this->userModel->findStaffByMobile($data['new_mobile'])) {
                                $data['new_mobile_err'] = '*Mobile number is already taken';
                            }
                              
                        }
    
                        //Make sure errors are empty
    
                        if(empty($data['new_mobile_err'])){
    
                            if(isset($_SESSION['otp_sms'])){
    
                                $data['otp_err'] = '*Please enter OTP';
    
                                //activate otp input
                                $data['otp_section'] = 1;
                                
                                
                            }else{
                                
                                //activate otp input
                                $data['otp_section'] = 1;
    
                                //genrate 6 digit numbers
                                $otp = rand(100000,999999);
    
                                $otp= 1234;
    
                               
                                $data['otp_code'] = $otp;
                                //store otp in session
                                $_SESSION['otp_sms'] = $otp;
    
                                //send otp to email
                                $this->sendOtpCodeSMS($data);
    
                                $data['otp_code'] = '';
    
                            }
    
                            
    
                            $this->view('dashboards/admin/setting/mobile_settings', $data);
    
                        }else{
    
                            //load with erros
                            $this->view('dashboards/admin/setting/mobile_settings', $data);
                        }
    
                        
                    
                    }elseif(isset($_POST['otp-button'])){
    
                        //activate otp input
                        $data['otp_section'] = 1;
    
                        $data['otp_code'] = trim($_POST['otp_code']);
    
                        //validate OTP
                        if(empty(trim($_POST['otp_code']))){
                            $data['otp_err'] = '*Please enter OTP';
                        }else{
                            if(trim($_POST['otp_code']) != $_SESSION['otp_sms']){
                                $data['otp_err'] = '*OTP is incorrect';
                            }
                        }
    
                        //Make sure errors are empty
    
                        if(empty($data['otp_err'])){
    
                            $_SESSION['otp_status_sms'] = "correct";
                            $data['verify_msg'] = '*Mobile Number verified successfully. Click Update.';
                            $this->view('dashboards/admin/setting/mobile_settings', $data);
                        }else{
                            //load with erros
                            $this->view('dashboards/admin/setting/mobile_settings', $data);
                        }
    
                        
                    }
    
                    
    
                }else{
    
                    if(isset($_SESSION['otp_sms']) || isset($_SESSION['otp_status_sms'])){
                        unset($_SESSION['otp_sms']);
                        unset($_SESSION['otp_status_sms']);
                    }
    
    
    
                    $user = $this->dashboardModel->getStaffUserById($_SESSION['user_id']);
    
                    $data = [
                        'mobile' => $user->phone,
                        'new_mobile' => '',
    
                        'new_mobile_err' => '',
                        'otp_section' => 0,
                        
                    ];
    
                    $this->view('dashboards/admin/setting/mobile_settings', $data);
                }
    
    
            }
        }

            //send email with otp code

    public function sendOtpCodeEmail($data){

        require __DIR__ . '/../libraries/phpmailer/vendor/autoload.php';

        //data['otp_code] split into 4 variables
        $otp_code = $data['otp_code'];
        $first_digit = substr($otp_code, 0, 1);
        $second_digit = substr($otp_code, 1, 1);
        $third_digit = substr($otp_code, 2, 1);
        $fourth_digit = substr($otp_code, 3, 1);

        
        try {
            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);
    
            // Set mail configuration (replace with your actual details)
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD']; // Replace with your password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
    
            // Set email sender details
            $mail->setFrom($_ENV['MAIL_USERNAME'], 'PetCare');
    
            // Add recipient address
            $mail->addAddress($data['new_email'], 'User: ' . $data['new_email']);
    
            // Set subject and body
            $mail->Subject = 'Update Email OTP - PetCare';
            $mail->isHTML(true);

            $filePath = __DIR__ . '/../views/email/otpCodeForUpdateEmail.php';
            $emailContent = file_get_contents($filePath);

            $emailContent = str_replace('{pet_owner_fname}', $data['fname'], $emailContent);
            $emailContent = str_replace('{pet_owner_lname}', $data['lname'], $emailContent);
            $emailContent = str_replace('{first-digit}',$first_digit, $emailContent);
            $emailContent = str_replace('{second-digit}',$second_digit, $emailContent);
            $emailContent = str_replace('{third-digit}',$third_digit, $emailContent);
            $emailContent = str_replace('{fourth-digit}',$fourth_digit, $emailContent);


            $mail->Body = $emailContent;

            // Send the email
            $mail->send();

            
           
            

        } catch (Exception $e) {
            // Handle exceptions
            echo 'Error: ' . $mail->ErrorInfo;
        }
    

        
    }


    public function sendOtpCodeSMS($data){

        // Send SMS
        $userID = $_ENV['NOTIFY_USERID'];
        $apiKey = $_ENV['NOTIFY_APIKEY'];

        $customMessage ="Hello " . $_SESSION['user_fname'] . " " . $_SESSION['user_lname'] . "" .$data['otp_code']. " Thank you for choosing PetCare. We're excited to serve you!"; // Replace this with your custom message
        $sendEndpoint = "https://app.notify.lk/api/v1/send?user_id={$userID}&api_key={$apiKey}&sender_id=NotifyDEMO&to=[TO]&message=" . urlencode($customMessage);
        $sendEndpoint = str_replace('[TO]', $data['new_mobile'], $sendEndpoint);
        //$sendResponse = file_get_contents($sendEndpoint);
    }

    public function profilePetowner($id){
        
          
        $user = $this->dashboardModel->getPetownerDetailsById($id);
        $pets = $this->dashboardModel->getPetDetailsByPetownerID($id);

        if($user == null){
            redirect('doctor/notfound');
        }

        $data = [
                'user' =>$user,
                'pet' => $pets
        ];

        
        $this->view('dashboards/common/petownerProfile', $data);
    }

       

        

    }