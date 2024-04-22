<?php

    class Nurse extends Controller {

        public function __construct(){

            if(!isset($_SESSION['user_id'])){
                
                redirect('users/staff');

            }else{


                if($_SESSION['user_role'] != "Nurse"){

                    // Unauthorized access
                    redirect('users/staff');
                     
                }
            }
            $this->settingsModel= $this->model('Settings') ;
            $this->doctorModel = $this->model('DoctorModel');
            $this->dashboardModel = $this->model('Dashboard');
            $this->postModel = $this->model('Post');
            $this->nurseModel = $this->model('NurseModel');
        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        public function index(){

            $greetingmsg = $this->getWelcomeGreeting();
            $wardDetails = $this->doctorModel->getAnimalWardDetails();
            //$appointmentDetails = $this->getCurrentAppointment();

            $data = [
                'greetingmsg' => $greetingmsg,
                'wardDetails' => $wardDetails,
                //'appointmentDetails' =>$appointmentDetails,
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


        

       

        public function requestPastMedicalReports($pet_id,$wardOrNot){

            
            

                    
                //get treatment details by pet id
                $treatmentDetails = $this->doctorModel->getTreatmentDetailsByPetID($pet_id);
                $closedTreatmentDetails = $this->doctorModel->getClosedTreatmentDetailsByPetID($pet_id);
                $wardDetails = $this->doctorModel->getWardTreatmentDetailsByPetID($pet_id);

                //get latest treatment id by pet id from appointment table
                $latestTreatmentID = $this->doctorModel->getLatestTreatmentID($pet_id);

                //get pet age
                $petDetails  =$this->doctorModel-> getPetDetailsByPetID($pet_id);
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
                    redirect('doctor/appointment');
                }
    
                foreach ($medicalReport as $treament) {
                    // Assuming 'DOB' is the property name, replace it with the correct property name if needed
                    $petDOB = isset($treament->DOB) ? $treament->DOB : null;
                    $visitDate = isset($treament->visit_date) ? $treament->visit_date : null;
            
                    $treament->petAge = $this->calculateAgeForMedicalReport($petDOB,$visitDate);
                }
               
    
                $data = [
                    'medicalreportview' => $medicalReport,
                    'petcareInfo' => $hospitalInfo
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
                'petcareInfo' => $hospitalInfo
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

        

        public function addmitPet($petid,$reason){

            $reason_text = str_replace('-', ' ', $reason);

            $data =[
                'petid' => $petid,
                'reason' => $reason_text
            ];

           //addmit pet to the ward
              $this->doctorModel->addmitPetToWard($data);
              

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

       
        public function medicalBillCalculate($trtID){

            //is server req post?
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                //sanitize post array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'trtID' => $trtID,
                    'services' => $_POST['service'],
                    'prices' =>$_POST['price'],
                    
                ];

                //prepare medical bill

                $this->nurseModel->prepareMedicalBill($data);

                redirect('nurse/medicalBill');

            }else{

            
                ///get addmit and discharge date
                $addmitDischargeDate = $this->nurseModel->getAddmitDischargeDate($trtID);

                //difference between addmit and discharge date
                $admitDate = new DateTime($addmitDischargeDate->admit_date);
                $dischargeDate = new DateTime($addmitDischargeDate->discharge_date);
                $interval = $admitDate->diff($dischargeDate);
                $days = $interval->format('%a');

                if($days == 0){
                    $days = 1;
                }


                $data = [
                    'daysDiff' => $days,
                    'details' => $addmitDischargeDate,
                    'trtID' => $trtID
                ];
                $this->view('dashboards/nurse/medicalBill/prepareMedicalBill',$data);

            }
        }

        public function medicalBill(){
            

            $medicalBillDetails = $this->nurseModel->getDischargeDetails();

            $data = [
                'bill' => $medicalBillDetails
            ];


            $this->view('dashboards/nurse/medicalBill/medicalBill',$data);
        }


        public function settings($setting_name){
            
                $setting_name_array = [
                
                    'all',
                    'profile',
                    'email',
                    'password',
                    'mobile',
                
                ];
        
                //check user intensionally going to wrong url
                if(!in_array($setting_name, $setting_name_array)){
                   redirect('nurse/notfound');
                }


                //================ all use to show all settings =========================//    
            if($setting_name == "all"){


                $data = null;
                $this->view('dashboards/nurse/setting/settings', $data);

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
                            
                            'fname_err' => '',
                            'lname_err' => '',
                            'name_err'  => '',
                            'address_err' => '',
                            'img_err' => '',
                            'main_err' => '',
                            'uniqueImgFileName' => $uniqueImgFileName,
                            'nic_err' => ''

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
                        if($user->firstname == trim($_POST['fname']) && $user->lastname == trim($_POST['lname']) && $user->address == trim($_POST['address']) && $data['profile_pic_img'] == null && $user->nic == trim($_POST['nic'])){
                            
                            $data['main_err'] = "*No changes were detected. The data remains as is.";
                        }


                        //Make sure errors are empty
                        if(empty($data['name_err']) && empty($data['address_err']) && empty($data['img_err']) && empty($data['main_err']) && empty($data['nic_err'])){
                            
                            //update profile
                            if($this->settingsModel->updateStaffProfile($data)){


                                //for notification
                                $_SESSION['notification'] = "ok";
                                $_SESSION['notification_msg'] = "Your profile information has been updated.";
                           redirect('nurse/settings/all');
            
                            }else{

                                //update error : can be database error
                                $_SESSION['notification'] = "error";
                                $_SESSION['notification_msg'] = "Please review and try again";
                               redirect('nurse/settings/all');
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
                            
                            'fname_err' => '',
                            'lname_err' => '',
                            'name_err'  => '',
                            'address_err' => '',
                            'img_err' => '',
                            'main_err' => '',
                            'nic_err' =>''
                            
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
                           redirect('nurse/settings/all');
                        }else{
                            //update error : can be database error
                            $_SESSION['notification'] = "error";
                            $_SESSION['notification_msg'] = "Password update failed";
                           redirect('nurse/settings/all');
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


                               redirect('nurse/settings/all');
                            }else{


                                //update error : can be database error
                                $_SESSION['notification'] = "error";
                                $_SESSION['notification_msg'] = "Email update failed";

                                unset($_SESSION['otp']);
                                unset($_SESSION['otp_status']);

                               redirect('nurse/settings/all');
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


                               redirect('nurse/settings/all');
                            }else{


                                //update error : can be database error
                                $_SESSION['notification'] = "error";
                                $_SESSION['notification_msg'] = "Mobile Number Update Failed";

                                unset($_SESSION['otp_sms']);
                                unset($_SESSION['otp_status_sms']);

                               redirect('nurse/settings/all');
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