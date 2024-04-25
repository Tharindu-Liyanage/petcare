<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

    class Assistant extends Controller {


        public function __construct(){
           
            if(!isset($_SESSION['user_id'])){
                
                redirect('users/staff');

            }else{


                if($_SESSION['user_role'] != "Assistant"){

                    // Unauthorized access
                    redirect('users/staff');
                     
                }
            }

            $this->settingsModel= $this->model('Settings') ;
            $this->assistantModel = $this->model('AssistantModel');
            $this->dashboardModel = $this->model('Dashboard');
            $this->userModel = $this->model('User');


        }

        

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        public function index(){

            $count = $this->assistantModel->countAppointments();
            $countBill=$this->assistantModel->countMedicalBills();
            $countIncome=$this->assistantModel->countMedicalBillsIncome();
            $greetingmsg = $this->getWelcomeGreeting();
            
            $totalPrice = 0;

            foreach ($countIncome as $income) {
                $totalPrice += $income->price;
            }
            $data=[
                'pendingAppointments'=> $count,
                'pendingMedicalBills'=> $countBill,
                'todayMedicalBillsIncome'=>$totalPrice,
                'greetingmsg'=> $greetingmsg
                

            ];

           
            
            $this->view('dashboards/assistant/index',$data);
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

    public function profilePetowner($id){
            
              
        $user = $this->dashboardModel->getPetownerDetailsById($id);
        $pets = $this->dashboardModel->getPetDetailsByPetownerID($id);

        if($user == null){
            redirect('assistant/notfound');
        }

        $data = [
                'user' =>$user,
                'pet' => $pets
        ];

        
        $this->view('dashboards/common/petownerProfile', $data);
    }


    public function profileStaff($id){
            
              
        $user = $this->dashboardModel->getStaffUserById($id);

        if($user == null){
            redirect('admin/notfound');
        }

        $data = [
                'user' =>$user
        ];

        
        $this->view('dashboards/common/profile', $data);
    }
    


        public function appointment(){
            $appointmentDetails = $this -> assistantModel ->getAppointmentDetails();

            $data = [
                'appointment'=> $appointmentDetails
            ];
   
   
            
            $this->view('dashboards/assistant/appointment/appointment',$data);
        }

        public function confirmAppointment($appointmentID){
         if($this -> assistantModel ->updateAppointmentStatusToConfirm($appointmentID)){
            
            $_SESSION['notification'] = "ok";
            $_SESSION['notification_msg'] = "Appointment confirmation Successful.";
            
            $appointmentDetails=$this->assistantModel->getAppointmentById($appointmentID);
            $data = [
                'appointment_Staus'=> $appointmentDetails
            ];
            $this->appointmentStatusMail($data);
    

            redirect('assistant/appointment');
         } else{ die("something went wrong");

         }
         
        }


        
        public function rejectedAppointment($appointmentID){
            if($this -> assistantModel ->updateAppointmentStatusToReject($appointmentID)){
                $_SESSION['notification'] = "ok";
                        $_SESSION['notification_msg'] = "Appointment Rejection Successful.";
                        $appointmentDetails=$this->assistantModel->getAppointmentById($appointmentID);
            $data = [
                'appointment_Staus'=> $appointmentDetails
            ];
                        $this->appointmentStatusMail($data);
               redirect('assistant/appointment');
            } else{ die("something went wrong");
   
            }
            
           }

           //email-------------------------------------------------------------------------------------------------



           public function appointmentStatusMail($data){
          
            
            
                
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
                $mail->addAddress($data['appointment_Staus'] -> petowneremail,'Pet Owner: ' . $data['appointment_Staus']-> petownerfname.  $data['appointment_Staus']-> petownerlname );
        
                // Set subject and body
                $mail->Subject = 'Important Update from Pet Care Appointment';
                $mail->isHTML(true);

                $filePath = __DIR__ . '/../views/email/appointmentstatus.php';
                $emailContent = file_get_contents($filePath);
                $emailContent = str_replace('{user_fname}', $data['appointment_Staus']->petownerfname, $emailContent);
                $emailContent = str_replace('{user_lname}', $data['appointment_Staus']->petownerlname, $emailContent);
                $emailContent = str_replace('{status}',$data['appointment_Staus']->status, $emailContent);
                $emailContent = str_replace('{appointment_id}',$data['appointment_Staus']->appointment_id, $emailContent);
                $emailContent = str_replace('{vet_fname}',$data['appointment_Staus']->vetfname, $emailContent);
                $emailContent = str_replace('{vet_lname}',$data['appointment_Staus']->vetlname, $emailContent);
                $emailContent = str_replace('{appointment_date}',$data['appointment_Staus']->appointment_date, $emailContent);
                $emailContent = str_replace('{appointment_time}',$data['appointment_Staus']->appointment_time, $emailContent);
                $emailContent = str_replace('{treatment}',$data['appointment_Staus']->treatment_id, $emailContent);
                $emailContent = str_replace('{appointment_reason}',$data['appointment_Staus']->appointment_type, $emailContent);
                $emailContent = str_replace('{pet_name}',$data['appointment_Staus']->petname, $emailContent);
                
                
                $mail->Body = $emailContent;

               
        
                // Send the email
                $mail->send();

                

            } catch (Exception $e) {
                // Handle exceptions
                echo 'Error: ' . $mail->ErrorInfo;
            }
        
        
        

    }
//petowner---------------------------------------------------------------
        public function petowner(){

            $petownerDetails = $this ->assistantModel->getPetownerDetails();
            $data = [
                'petowner'=> $petownerDetails
            ];
   
            
            $this->view('dashboards/assistant/petowner/petowner',$data);
        }


        
       
         
         public function addAppointment(){
             $data =null;
 
            $this->view('dashboards/assistant/petowner/addPetowner',$data);


            }

            

        public function addPetowner(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                    $data = [
                        'firstname' => trim($_POST['firstname']),
                        'lastname' => trim($_POST['lastname']),
                        'address' => trim($_POST['address']),
                        'email' => trim($_POST['email']),
                        'mobile' => trim($_POST['mobile']),
                        'firstname_err' => '',
                        'lastname_err' => '',
                        'address_err' =>'',
                        'email_err' => '',
                        'mobile_err' => '',
                        'password'=> '',
                    ];

                    //validate pName
                    if(empty($data['firstname'])){
                        $data['firstname_err'] = 'Please enter first Name';
                    }   

                     //validate pName
                     if(empty($data['lastname'])){
                        $data['lastname_err'] = 'Please enter last Name';
                    } 

                    //validate address
                    if(empty($data['address'])){
                        $data['address_err']= 'Please enter address';
                    }


                    //validate Email
                    if(empty($data['email'])){

                        $data['email_err'] = 'Please enter email';

                    }else{
 
                        if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){ //check email in correct formate

                            $email=$this->assistantModel->findEmail($data['email']);//check database 

                            if($email){
                                $data['email_err'] = 'email already taken';
                            }
                           
                        }else{  //check email in the DB
                        
                             $data['email_err'] = 'Email is not valid';
 
                        }


                    }


                    //validate mobile
                    if(empty($data['mobile'])){

                        $data['mobile_err'] = 'Please enter mobile';
                        
                    }else{
 
                        if(preg_match("/^94\d{9}$/", $data['mobile'])){ //check email in correct formate

                            $mobile=$this->assistantModel->findMobile($data['mobile']);//check database 

                            if($mobile){
                                $data['mobile_err'] = 'mobile already taken';
                            }
                           
                        }else{  //check email in the DB
                        
                             $data['mobile_err'] = 'mobile is not valid';
 
                        }


                    }
                    

                    if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['email_err'])  && empty($data['mobile_err']) && empty($data['address_err'])  ){

                                        //validated
                                    
                                    //mobile number set as password
                                    $data['password'] = password_hash($data['mobile'],PASSWORD_DEFAULT);
                                    

                                    //Regster User

                                    if($this->assistantModel->addpetowner($data)){
                                        $_SESSION['notification'] = "ok";
                                        $_SESSION['notification_msg'] = "Add petowner Successful.";
                                      
                    
                                    redirect('assistant/petowner');

                                    }else{
                                        die("Something went wrong");
                                    }


                    }else{
                        $this->view('dashboards/assistant/petowner/addPetowner',$data);//load with errors  
                    }
                    
                    
                    
                    
    
 
                

            }else{//form eken submit krnne nthuw normal load wena ek

                $data = [
                    'firstname' => '',
                    'lastname' => '',
                    'address' => '',
                    'email' => '',
                    'mobile' => '',
                    'firstname_err' => '',
                    'lastname_err' => '',
                    'email_err' => '',
                    'mobile_err' => '',
                    'address_err' => '',
                   
            
                ];


            
   
            
            $this->view('dashboards/assistant/petowner/addPetowner',$data);
            

            }

            
        }  


//update petowner----------------------------------------------------------------------------------------------------------------------
        public function updatePetowner($petownerID){


             if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                 $data = [
                        'id'    => $petownerID,
                        'mobile' => trim($_POST['mobile']),
                        'email' => trim($_POST['email']),
                    
                        'email_err' => '',
                        'mobile_err' => '',
                      
                    ];

                    
                    //validate Email
                if(empty($data['email'])){

                        $data['email_err'] = 'Please enter email';

                    }else{

                        if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){ //check email in correct formate

                        
                        }else{  //check email in the DB
                        
                            $data['email_err'] = 'Email is not valid';

                        }


                    }


                    
                    //validate mobile
                    if(empty($data['mobile'])){

                            $data['mobile_err'] = 'Please enter mobile';
                                    
                    }else{
            
                        if(preg_match("/^94\d{9}$/", $data['mobile'])){ //check email in correct formate

                                    
                        }else{  //check email in the DB
                                    
                                $data['mobile_err'] = 'mobile is not valid';
            
                        }


                    }


                        if( empty($data['email_err'])  && empty($data['mobile_err']) )  {


                                    //Regster User

                                    if($this->assistantModel->updatepetowner($data)){
                                        $_SESSION['notification'] = "ok";
                                        $_SESSION['notification_msg'] = "Update Successful.";
                                            redirect('assistant/petowner');

                                    }else{
                                            die("Something went wrong");
                                    }


                        }else{
                            $this->view('dashboards/assistant/petowner/updatePetowner',$data);//load with errors  
                        }  

                        






            }else{


                $petownerDetails= $this ->assistantModel ->getPetownerMobileEmailByID($petownerID);

                $data = [

                    'id' => $petownerID,
                    'email' => $petownerDetails->email,
                    'mobile' => $petownerDetails->mobile,
                    
                    'email_err' => '',
                    'mobile_err' =>'' ,
                ];
                $this->view('dashboards/assistant/petowner/updatePetowner',$data);

            }
           

            
        }





        
        // ADD PET part-------------------------------------------------------------------------------------------------------------------------------------------------




        public function pet(){

            $petDetails = $this ->assistantModel ->getPetDetails ();
            $data = [
                'pet' => $petDetails
            ];

            $this ->view('dashboards/assistant/pet/pet', $data);

        }

        public function addPetAppointment(){
            $data =null;

           $this->view('dashboards/assistant/pet/addPet',$data);


           }

           public function addPet(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                    $data = [
                        'pname'  => trim($_POST['pname']),
                        'dob'    => trim($_POST['dob']),
                        'species'=> trim($_POST['species']),
                        'breed'  => trim($_POST['breed']),
                        'sex'    => trim($_POST['sex']),
                        'petownerID'=>trim($_POST['petownerID']),
                        
                        'pname_err'    => '',
                        'dob_err'      => '',
                        'species_err'  => '',
                        'breed_err'    => '',
                        'sex_err'      => '',
                        'petownerID_err' => '',
                       
                        
                    ];

                    //validate pName
                    if(empty($data['pname'])){
                        $data['pname_err'] = 'Please enter pet Name';
                    }   

                    //validate dob
                    if(empty($data['dob'])){
                        $data['dob_err'] = 'Please enter dob';
                    }   

                    //validate species
                    if(empty($data['species'])){
                        $data['species_err'] = 'Please select species';
                    }   

                    //validate breed
                    if(empty($data['breed'])){
                    $data['breed_err'] = 'Please select breed';
                        }  

                         //validate sex
                    if(empty($data['sex'])){
                        $data['sex_err'] = 'Please select sex';
                            }  


                    
                         //validate petownerID
                    if(empty($data['petownerID'])){

                        $data['petownerID_err'] = 'Please enter petownerID';

                    }else{
 
                        if($this->assistantModel->findpetownerID($data['petownerID'])){ //check petownerID in correct formate

                            
                           
                        }else{  //check petownerID in the DB
                        
                             $data['petownerID_err'] = 'petownerID is not valid';
 
                        }


                    }

       
                        if(empty($data['pname_err']) && empty($data['dob_err']) && empty($data['species_err'])  && empty($data['breed_err']) && empty($data['sex_err']) && empty($data['petownerID_err']) )  {


                   //Regster User

                   if($this->assistantModel->addpet($data)){
                    $_SESSION['notification'] = "ok";
                    $_SESSION['notification_msg'] = "Pet Added Successful.";             
                                      
                    
                    redirect('assistant/pet');

                    }else{
                        die("Something went wrong");
                    }


                }else{
                    $this->view('dashboards/assistant/pet/addPet',$data);//load with errors  
                }

            }else{//form eken submit krnne nthuw normal load wena ek

                $data = [
                    'pname'   => '',
                    'dob'     => '',
                    'species' => '',
                    'breed'   => '',
                    'sex'     => '',
                    'petownerID' => '',
                   
                    'pname_err'   => '',
                    'dob_err'     => '',
                    'species_err' => '',
                    'breed_err'   => '',
                    'sex_err'     => '',
                    'petownerID_err' => '',
                    
                    ];
              
                    $this->view('dashboards/assistant/pet/addPet',$data);


            }
        }


// update pet----------------------------------------------------------------------------------------
         //public function updatePets($petid){// pets kyl dl thiyenne
          //  $data =null;

           // $this->view('dashboards/assistant/pet/updatePet',$data);
        





        public function updatePet($id){

            
            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);


              
                    
                //init data

                $data = [
                    'id' => $id,
                    'pname' => trim($_POST['pname']),
                    'dob' => trim($_POST['dob']),
                    'species' => trim($_POST['species']),
                    'sex' => trim($_POST['sex']),
                    'breed' => trim($_POST['breed']),
                  
                    'pname_err' => '',
                    'dob_err' => '',
                    'species_err' => '',
                    'sex_err' => '',
                    'breed_err'  =>'',
                  
                ];

            
                //validate pName
                if(empty($data['pname'])){
                    $data['pname_err'] = 'Please enter Pet Name';
                }

                //validate brand
                if(empty($data['dob'])){
                    $data['dob_err'] = 'Please enter DOB';
                }

                //validate sex
                if(empty($data['sex'])){
                    $data['sex_err'] = 'Please select Sex';
                }

               
                //validate breed
                if (empty($data['breed'])) {
                    $data['breed_err'] = 'Please enter breed';
                }

               
               //validate species
                if (empty($data['species'])) {
                    $data['species_err'] = 'Please enter Species';
                }

                  //validate DOB
                  //date validate
                if($data['dob'] > date('Y-m-d')){

                    $data['dob_err'] = 'DOB cannot be future date';
                }
                

                //Make sure errors are empty

                if(empty($data['pname_err']) && empty($data['breed_err'])&&empty($data['dob_err']) && empty($data['species_err'])  && empty($data['sex_err'])){
                    //validated
                    
                   
                    //add pet

                    if($this->assistantModel->updatePetDetails($data)){
                        $_SESSION['notification'] = "ok";
                        $_SESSION['notification_msg'] = "Pet Update Successful.";
                       
                       redirect('assistant/pet');
                       

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/assistant/pet/updatePet', $data);
                    
                    

                }


            }else{

                $pet =$this->assistantModel-> getPetDetailsByID($id);


                if($pet == null){   //if no data found : its mean user try to access url with wrong pet id(intentionally)

                    redirect('assistant/pet');
                }



                //init data
                $data = [
                    'id' => $id,
                    'pname' => $pet ->pet,
                    'dob' => $pet -> DOB,
                    'species' => $pet -> species,
                    'sex' => $pet -> sex,
                    'breed' => $pet -> breed,

                    'pname_err' => '',
                    'dob_err' =>'',
                    'species_err' =>'',
                    'sex_err' => '',
                    'breed_err'  =>''
            
            
                ];

                
                //load view
                $this->view('dashboards/assistant/pet/updatePet', $data);
            }
   

        }

        // Medical Bill---------------------------------------------------------------------------------
        public function medicalBill(){
            $medicalBillDetails = $this->assistantModel->getDischargeDetails();

            $data = [
                'bill' => $medicalBillDetails
            ];
    
    
            $this->view('dashboards/assistant/medicalBill/medicalBillTable',$data);
        }


        public function viewMedicalBill($id){
           
        $billDetails = $this->dashboardModel->getBillByTreatmentID($id);
        $payementDetails = $this->dashboardModel->getWardPaymentStatusByTreatmentID($id);

        //die(var_dump($billDetails));

        $totalPrice = 0;

        foreach ($billDetails as $bill) {
            $totalPrice += $bill->price;
        }

                $data = [
                    'id' => $id,
                    'services' =>$billDetails,
                    'totalPrice' => $totalPrice,
                    'paymentDetails' => $payementDetails
                ];

                $this->view('dashboards/assistant/medicalbill/viewMedicalBill', $data);
    } 
    // update payment------------------------------------------------------------------------------------------------
         public function updatePaymentStatus($id){
            if($this->assistantModel->updatePayment($id)){
                $_SESSION['notification'] = "ok";
                $_SESSION['notification_msg'] = "Payment Status Updated!";
               
               redirect('assistant/medicalBill');
               

            }else{
                die("Something went wrong");
            }
         }



            //settings-----------------------------------------------------------------------------------------------
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
                    redirect('assistant/notfound');
                }


                //================ all use to show all settings =========================//    
            if($setting_name == "all"){


                $data = null;
                $this->view('dashboards/assistant/setting/settings', $data);

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
                            
                            'fname_err' => '',
                            'lname_err' => '',
                            'name_err'  => '',
                            'address_err' => '',
                            'img_err' => '',
                            'main_err' => '',
                            'uniqueImgFileName' => $uniqueImgFileName,

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
                        if($user->firstname == trim($_POST['fname']) && $user->lastname == trim($_POST['lname']) && $user->address == trim($_POST['address']) && $data['profile_pic_img'] == null){
                            
                            $data['main_err'] = "*No changes were detected. The data remains as is.";
                        }


                        //Make sure errors are empty
                        if(empty($data['name_err']) && empty($data['address_err']) && empty($data['img_err']) && empty($data['main_err'])){
                            
                            //update profile
                            if($this->settingsModel->updateStaffProfile($data)){


                                //for notification
                                $_SESSION['notification'] = "ok";
                                $_SESSION['notification_msg'] = "Your profile information has been updated.";
                            redirect('assistant/settings/all');

                            }else{

                                //update error : can be database error
                                $_SESSION['notification'] = "error";
                                $_SESSION['notification_msg'] = "Please review and try again";
                                redirect('assistant/settings/all');
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
                            
                            'fname_err' => '',
                            'lname_err' => '',
                            'name_err'  => '',
                            'address_err' => '',
                            'img_err' => '',
                            'main_err' => '',
                            
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
                            redirect('assistant/settings/all');
                        }else{
                            //update error : can be database error
                            $_SESSION['notification'] = "error";
                            $_SESSION['notification_msg'] = "Password update failed";
                            redirect('assistant/settings/all');
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


                                redirect('assistant/settings/all');
                            }else{


                                //update error : can be database error
                                $_SESSION['notification'] = "error";
                                $_SESSION['notification_msg'] = "Email update failed";

                                unset($_SESSION['otp']);
                                unset($_SESSION['otp_status']);

                                redirect('assistant/settings/all');
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


                                redirect('assistant/settings/all');
                            }else{


                                //update error : can be database error
                                $_SESSION['notification'] = "error";
                                $_SESSION['notification_msg'] = "Mobile Number Update Failed";

                                unset($_SESSION['otp_sms']);
                                unset($_SESSION['otp_status_sms']);

                                redirect('assistant/settings/all');
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

        $customMessage ="Hello " . $_SESSION['user_fname'] . " " . $_SESSION['user_lname'] . ", This the OTP code for verify mobile number " .$data['otp_code']. " Thank you for choosing PetCare. We're excited to serve you!"; // Replace this with your custom message
        $sendEndpoint = "https://app.notify.lk/api/v1/send?user_id={$userID}&api_key={$apiKey}&sender_id=NotifyDEMO&to=[TO]&message=" . urlencode($customMessage);
        $sendEndpoint = str_replace('[TO]', $data['new_mobile'], $sendEndpoint);
        //$sendResponse = file_get_contents($sendEndpoint);
    }

        }


            