<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    class Petowner extends Controller {

        public function __construct(){

            $currentTime = time();
            $inactiveTime =300; // 5 minutes in seconds

            if (!isset($_SESSION['PO_last_activity'])) {
                $_SESSION['PO_last_activity'] = $currentTime; // Set initial last activity time
            } else {
                // Update last activity time to current time
                $_SESSION['PO_last_activity'] = $currentTime;
            }
           
           
            if(!isset($_SESSION['user_id'])){
                
                redirect('users/login');

            }else if($_SESSION['user_role'] != "Pet Owner"){
                    // Unauthorized access
                    redirect('users/login');
                     
                
            }else if( $currentTime - $_SESSION['PO_last_activity'] > $inactiveTime){

            /*    unset($_SESSION['user_id']);
                unset($_SESSION['user_email']);
                unset($_SESSION['user_fname']);
                unset($_SESSION['user_lname'] );
                unset($_SESSION['user_mobile']);
                unset($_SESSION['user_role']);
                unset( $_SESSION['user_profileimage']);
                unset($_SESSION['PO_last_activity']);
                $_SESSION['error_msg_from_petowner'] ="Session Expired. Please login again.";
                redirect('users/login');*/

            }

            $this->dashboardModel = $this->model('Dashboard');
            $this->settingsModel = $this->model('Settings');
            $this->userModel = $this->model('User');
            $this->doctorModel = $this->model('DoctorModel');
            $this->nurseModel = $this->model('NurseModel');
           

            
          
            
        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        public function index(){

            $pets = $this->dashboardModel->getPetDetailsByPetownerID($_SESSION['user_id']);
            $greetingmsg = $this->getWelcomeGreeting();

            $data = [
                'pet' =>$pets,
                'greetingmsg' => $greetingmsg
            ];
   
            
            $this->view('dashboards/petowner/index', $data);
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


        public function pet(){

            $pets = $this->dashboardModel->getPetDetailsByPetownerID($_SESSION['user_id']);

            foreach ($pets as $pet) {
                // Assuming 'DOB' is the property name, replace it with the correct property name if needed
                $petDOB = isset($pet->DOB) ? $pet->DOB : null;
        
                $pet->age = $this->calculateAge($petDOB);
            }

           
            $data = [
                'pet' =>$pets    
            ];

            $this->view('dashboards/petowner/pet/pet',$data);
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
        


        public function addPet(){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);


               

                
                if (isset($_FILES['pet_img'])) {
                    $uploadedFileName = $_FILES['pet_img']['name'];
                    $fileExtension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);  // Extract the file extension

                    // Generate a timestamp for uniqueness
                    $timestamp = time();

                    // Create a unique ID by concatenating values and adding the file extension
                    $uniqueImgFileName = $_POST['pname'] . '_' . $_POST['dob'] . '_' . $timestamp . '.' . $fileExtension;

                }

                //init data

                $data = [
                    'pname' => trim($_POST['pname']),
                    'dob' => trim($_POST['dob']),
                    'species' => trim($_POST['species']),
                    'sex' => trim($_POST['sex']),
                    'breed' => trim($_POST['breed']),
                    'img' => ($_FILES['pet_img']['error'] === UPLOAD_ERR_NO_FILE) ? null : $_FILES['pet_img'],
                    'img_err' => '',
                    'pname_err' => '',
                    'dob_err' => '',
                    'species_err' => '',
                    'sex_err' => '',
                    'breed_err'  =>'',
                    'uniqueImgFileName' =>$uniqueImgFileName
            
                ];

                  //validate pName
                  if(empty($data['pname'])){
                    $data['pname_err'] = 'Please enter Pet Name';
                }

                //validate brand
                if(empty($data['dob'])){
                    $data['dob_err'] = 'Please enter DOB';
                }

                //validate address
                if(empty($data['sex'])){
                    $data['sex_err'] = 'Please select Sex';
                }

                $allowedTypes = ['image/jpeg', 'image/png'];

                if (!isset($_FILES['pet_img']['type']) || ($_FILES['pet_img']['type'] && !in_array($_FILES['pet_img']['type'], $allowedTypes))) {
                    // Invalid file type
                    $data['img_err'] = 'Invalid file type. Please upload an image (JPEG or PNG).';
                }

                if($_FILES['pet_img']['size'] > 5 * 1024 * 1024 ){ // 5MB in bytes
                    $data['img_err'] = 'Image size must be less than 5 MB';
                }
                


                if (empty($data['breed'])) {
                    $data['breed_err'] = 'Please enter breed';
                }

               

                if (empty($data['species'])) {
                    $data['species_err'] = 'Please enter Species';
                }
                

                

                //Make sure errors are empty

                if(empty($data['pname_err']) && empty($data['breed_err']) && empty($data['species_err']) && empty($data['img_err']) && empty($data['sex_err'])){
                    
                   
                
                    if($this->dashboardModel->addPetDetails($data)){
                       
                       // $_SESSION['staff_user_added'] = true;

                       $_SESSION['notification'] = "ok";
                       $_SESSION['notification_msg'] = "Pet Added Successfully";
      
                       redirect('petowner/pet');

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/petowner/pet/addPet', $data);
                    
                    

                }


            }else{

                //init data
                $data = [
                    'pname' => '',
                    'dob' => '',
                    'species' => '',
                    'sex' => '',
                    'breed' => '',
                    'img_err'=>'',
                    'pname_err' => '',
                    'dob_err' => '',
                    'species_err' => '',
                    'sex_err' => '',
                    'breed_err'  =>''
            
            
                ];

                
                //load view
                $this->view('dashboards/petowner/pet/addPet', $data);
            }
   
            
        }


        public function updatePet($id){

            
            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);


              
                    if (isset($_FILES['pet_img'])) {
                        $uploadedFileName = $_FILES['pet_img']['name'];
                        $fileExtension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);  // Extract the file extension

                        // Generate a timestamp for uniqueness
                        $timestamp = time();

                        // Create a unique ID by concatenating values and adding the file extension
                        $uniqueImgFileName = $id . '_' . $_POST['pname'] . '_' . $_POST['dob'] . '_' . $timestamp . '.' . $fileExtension;

                    }
               

                //init data

                $data = [
                    'id' => $id,
                    'pname' => trim($_POST['pname']),
                    'dob' => trim($_POST['dob']),
                    'species' => trim($_POST['species']),
                    'sex' => trim($_POST['sex']),
                    'breed' => trim($_POST['breed']),
                    'img' => ($_FILES['pet_img']['error'] === UPLOAD_ERR_NO_FILE) ? null : $_FILES['pet_img'],
                    'img_err' => '',
                    'pname_err' => '',
                    'dob_err' => '',
                    'species_err' => '',
                    'sex_err' => '',
                    'breed_err'  =>'',
                    'uniqueImgFileName' => $uniqueImgFileName
            
                ];

                
              
                

            
                //validate pName
                if(empty($data['pname'])){
                    $data['pname_err'] = 'Please enter Pet Name';
                }

                //validate brand
                if(empty($data['dob'])){
                    $data['dob_err'] = 'Please enter DOB';
                }

                //validate address
                if(empty($data['sex'])){
                    $data['sex_err'] = 'Please select Sex';
                }

                $allowedTypes = ['image/jpeg', 'image/png'];

                if (!isset($_FILES['pet_img']['type']) || ($_FILES['pet_img']['type'] && !in_array($_FILES['pet_img']['type'], $allowedTypes))) {
                    // Invalid file type
                    $data['img_err'] = 'Invalid file type. Please upload an image (JPEG or PNG).';
                }

                if($_FILES['pet_img']['size'] > 5 * 1024 * 1024 ){ // 5MB in bytes
                    $data['img_err'] = 'Image size must be less than 5 MB';
                }
                


                if (empty($data['breed'])) {
                    $data['breed_err'] = 'Please enter breed';
                }

               

                if (empty($data['species'])) {
                    $data['species_err'] = 'Please enter Species';
                }
                

                

                //Make sure errors are empty

                if(empty($data['pname_err']) && empty($data['breed_err']) && empty($data['species_err']) && empty($data['img_err']) && empty($data['sex_err'])){
                    //validated
                    
                   
                   

                    //add product

                    if($this->dashboardModel->updatePetDetails($data)){
                       
                       // $_SESSION['staff_user_added'] = true;

                       $_SESSION['notification'] = "ok";
                       $_SESSION['notification_msg'] = "Pet Updated Successfully";
                     
                       redirect('petowner/pet');
                       

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/petowner/pet/updatePet', $data);
                    
                    

                }


            }else{

                $pet =$this->dashboardModel-> getPetDetailsByID($id);


                if($pet == null){   //if no data found : its mean user try to access url with wrong pet id(intentionally)
                    redirect('petowner/pet');
                }



                //init data
                $data = [
                    'id' => $id,
                    'pname' => $pet ->pet,
                    'dob' => $pet -> DOB,
                    'species' => $pet -> species,
                    'sex' => $pet -> sex,
                    'breed' => $pet -> breed,
                    'img_err'=>'',
                    'pname_err' => '',
                    'dob_err' => '',
                    'species_err' => '',
                    'sex_err' => '',
                    'breed_err'  =>''
            
            
                ];

                
                //load view
                $this->view('dashboards/petowner/pet/updatePet', $data);
            }
   

        }


        public function removePet($id){

            if($this->dashboardModel->removePetDetails($id)){

                //$_SESSION['staff_user_removed'] = true;
                $_SESSION['notification'] = "ok";
                $_SESSION['notification_msg'] = "Pet Deleted Successfully";
                redirect('petowner/pet');

            }else{
                die("error in user delete model");
            }
            
        }



        /*Appointment here */

        public function appointment(){

            
            $appointments = $this->dashboardModel->getAppointmentDetailsByPetOwner($_SESSION['user_id']);
            
         


        $data = [
            'appointment' =>$appointments
        ];

           
            $this->view('dashboards/petowner/appointment/appointment', $data);
        }

        public function addAppointment(){

            $pets = $this->dashboardModel->getPetDetailsByPetownerID($_SESSION['user_id']);
            $vets = $this->dashboardModel->getVetDetails();
            $time_slots = $this->dashboardModel->getTimeSlots();
            $holidays = $this->dashboardModel->getHolidayDetails();
            $reason = $this->dashboardModel->getAppointmentReasons();
            $treament_data = $this->dashboardModel->getTreatmentDetailsByUserIDOnlyOngoing($_SESSION['user_id']);
           

        
            $data = [
                'pet' =>$pets,
                'time_slots' => $time_slots,
                'vet' => $vets,
                'holiday' => $holidays,
                'reason' => $reason,
                'medicalreport' =>$treament_data
            ];

            $this->view('dashboards/petowner/appointment/addAppointment', $data);
        }

        public function updateAppointment($id){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $pets = $this->dashboardModel->getPetDetailsByPetownerID($_SESSION['user_id']);
                $vets = $this->dashboardModel->getVetDetails();
                $time_slots = $this->dashboardModel->getTimeSlots();
                $holidays = $this->dashboardModel->getHolidayDetails();
                $reason = $this->dashboardModel->getAppointmentReasons();
                $treament_data = $this->dashboardModel->getTreatmentDetailsByUserIDOnlyOngoing($_SESSION['user_id']);
                $appointmentDetails = $this->dashboardModel->getAppointmentDetailsByID($id, $_SESSION['user_id']);
                
                $data= [
                    'appointment_id' => $id,
                    'vet_post' => trim($_POST['vet']),
                    'reason_post' => trim($_POST['reason']),
                    'pet_post' => trim($_POST['pet']),
                    'date_post' => trim($_POST['date']),
                    'time_post' => trim($_POST['time']),
                    'treatment_post' => trim($_POST['treatment']),
                    'pet' =>$pets,
                    'time_slots' => $time_slots,
                    'vet' => $vets,
                    'holiday' => $holidays,
                    'reason' => $reason,
                    'medicalreport' =>$treament_data,
                    'appointment_details' => $appointmentDetails,
                    'main_err' => ''
                ];

                 //checkavailability
                 $isBooked = $this->dashboardModel->checkAvailability($data['time_post'], $data['date_post'], $data['vet_post']); // give true mean availbe
                 $isLocked = $this->dashboardModel->checkTimeSlotIsLocked($data['time_post'], $data['date_post'], $data['vet_post']);
 

               // die(var_dump($data['vet_post'], $data['reason_post'], $data['pet_post'], $data['date_post'], $data['time_post'], $data['treatment_post'], $appointmentDetails));

               // ...

                        // check anything new update or not
                        if (
                            (int)$appointmentDetails->vet_id == (int)$data['vet_post'] &&
                            $appointmentDetails->appointment_type == $data['reason_post'] &&
                            (int)$appointmentDetails->pet_id == (int)$data['pet_post'] &&
                            $appointmentDetails->appointment_date == $data['date_post'] &&
                            $appointmentDetails->appointment_time == $data['time_post'] &&
                            (
                                is_numeric($data['treatment_post']) 
                                ? (int)$appointmentDetails->treatment_id == (int)$data['treatment_post'] 
                                : $data['treatment_post'] == "NONE"
                            )
                        ) {
                            $data['main_err'] = "No changes were detected. The data remains as is.";
                        
                        }else if(!$isBooked){
                           
                            $data['main_err'] = "The selected time slot is already booked. Please select another time slot.";
                           
                        }else if($isLocked){
                            $data['main_err'] = "The selected time slot is locked. Please select another time slot or try again later.";
                        }else{

                            //selected data is holiday?
                            $isHoliday = $this->dashboardModel->getHolidayDetails();

                            $dateString = $data['date_post'];
                            $timestamp = strtotime($dateString);
                            $dayOfWeek = date('l', $timestamp);
                           //to make $daysofweek output first letter simple
                            $formattedDay = strtolower(substr($dayOfWeek, 0));


                            foreach($isHoliday as $holidays){

                                    if($holidays->day == $formattedDay){
                                        $isHoliday = true;
                                        break;
                                    }else{
                                        $isHoliday = false;
                                    }  
                            
                            }

                            // Current time
                            $currentDateTime = new DateTime();
                            $currentTimestamp = $currentDateTime->getTimestamp();

                            $timestamp1 = strtotime($data['time_post']);
                            $today = date('Y-m-d');



                            if($isHoliday){
                                $data['main_err'] = "The selected date is a holiday. Please select another date.";
                            }else if($timestamp1 < $currentTimestamp && ($today == $data['date_post'])){
                                $data['main_err'] = "The selected time slot is already passed. Please select another time slot.";
                            }else{
                                
                                
                                if($this->dashboardModel->updateAppointment($data)){


                                    $_SESSION['notification'] = "ok";
                                    $_SESSION['notification_msg'] = "Appointment Updated Successfully";


                                    redirect('petowner/appointment');
                                    
                                }else{

                                    $_SESSION['notification'] = "error";
                                    $_SESSION['notification_msg'] = "Something went wrong. Please try again.";
                                    redirect('petowner/appointment');
                                }
                            }
                                
                            
                            
                        }
                    

                    // check errors
                    if (empty($data['main_err'])) {
                        // process the form, as there are no errors
                    } else {
                        // load errors
                        $this->view('dashboards/petowner/appointment/updateAppointment', $data);
                    }


            }else{

                $appointmentDetails = $this->dashboardModel->getAppointmentDetailsByID($id, $_SESSION['user_id']);

                if($appointmentDetails == null){   //if no data found : its mean user try to access url with wrong appointment id(intentionally)
                    redirect('petowner/appointment');
                }


                $pets = $this->dashboardModel->getPetDetailsByPetownerID($_SESSION['user_id']);
                $vets = $this->dashboardModel->getVetDetails();
                $time_slots = $this->dashboardModel->getTimeSlots();
                $holidays = $this->dashboardModel->getHolidayDetails();
                $reason = $this->dashboardModel->getAppointmentReasons();
                $treament_data = $this->dashboardModel->getTreatmentDetailsByUserIDOnlyOngoing($_SESSION['user_id']);
    
                $data = [
                    'appointment_id' => $id,
                    'pet' =>$pets,
                    'time_slots' => $time_slots,
                    'vet' => $vets,
                    'holiday' => $holidays,
                    'reason' => $reason,
                    'medicalreport' =>$treament_data,
                    'appointment_details' => $appointmentDetails,
                    'vet_err' => '',
                    'reason_err' => '',
                    'pet_err' => '',
                    'date_err' => '',
                    'time_err' => '',
                    'treatment_err' => '',
                    'main_err' => ''

                ];
                
                $this->view('dashboards/petowner/appointment/updateAppointment', $data);



            }    
           
        }


        public function checkoutAppointment(){

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $price = $this->settingsModel->getPrice();
        
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
                // Store POST data to session variables for later use
                $_SESSION['appointment_vetID'] = trim($_POST['vet']);
                $_SESSION['appointment_reason'] = trim($_POST['reason']);
                $_SESSION['appointment_petID'] = trim($_POST['pet']);
                $_SESSION['appointment_date'] = trim($_POST['date']);
                $_SESSION['appointment_time'] = trim($_POST['time']);
                $_SESSION['appointment_treatment'] = trim($_POST['treatment']);

                
        
                require __DIR__ . '/../libraries/stripe/vendor/autoload.php';
                \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
        
                $expiresAt = time() + (30 * 60); // in 30 min this will expire
                $expirationDescription = date('Y-m-d H:i:s', $expiresAt);

                $price_id = $price->price_id;
        
                // Create a payment session
                $paymentSession = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'mode' => 'payment', // Set mode to 'payment' for one-time payments
                    'line_items' => [[
                        //'price' => 'price_1OIZwlEMWpdWcJS8zC9MFJoR', // Use the price ID, not the product ID
                        'price' => $price_id,
                        'quantity' => 1,
                    ]],
                    'success_url' => 'http://localhost/petcare/petowner/appointmentSuccess', // Add a query parameter for success
                    'cancel_url' => 'http://localhost/petcare/petowner/appointmentFailed', // Add a query parameter for cancel
                    "expires_at" => $expiresAt,
                ]);
        
                // Redirect to the Payment Link URL
                header('Location: ' . $paymentSession->url);
                exit;
        
            } else {
        
                // Redirect back to the appointment page if not a POST request or payment success
                redirect('petowner/appointment');
            }
        }

        public function appointmentFailed(){
            $_SESSION['notification'] = "error";
            $_SESSION['notification_msg'] = "Appointment Payment Failed. Please try again.";
            redirect('petowner/appointment');
        }


        public function appointmentSuccess(){

            $addApp = $this->dashboardModel->insertAppointment($_SESSION['appointment_vetID'], $_SESSION['appointment_reason'], $_SESSION['appointment_petID'], $_SESSION['appointment_date'], $_SESSION['appointment_time'], $_SESSION['appointment_treatment']);

            $vetName = $this->dashboardModel->getVetNameByID($_SESSION['appointment_vetID']);
            $petName = $this->dashboardModel->getPetNameByID($_SESSION['appointment_petID']);
            $generatedIDAppointment = $this->dashboardModel->getGeneratedIDAppointment($_SESSION['appointment_vetID'], $_SESSION['appointment_reason'], $_SESSION['appointment_petID'], $_SESSION['appointment_date'], $_SESSION['appointment_time']);

            $_SESSION['appointment_vetFname'] = $vetName->firstname;
            $_SESSION['appointment_vetLname'] = $vetName->lastname;
            $_SESSION['appointment_petName'] = $petName->pet;
            $_SESSION['appointment_generatedID'] = $generatedIDAppointment->appointment_id;




            if($addApp){

                $_SESSION['notification'] = "ok";
                $_SESSION['notification_msg'] = "Appointment Added Successfully";
                $this->appointmentSuccessMail();
                
            }else{
                die("error in user delete model");
            }

           
        }

        public function appointmentSuccessMail(){
          
            
            
                
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
                    $mail->addAddress($_SESSION['user_email'], 'Pet Owner: ' . $_SESSION['user_fname'] . ' ' . $_SESSION['user_lname']);
            
                    // Set subject and body
                    $mail->Subject = 'Important Update from Pet Care';
                    $mail->isHTML(true);

                   ob_start();  // Start output buffering
                    include(__DIR__ . '/../views/email/appointmentPending.php');
                    $mailBody = ob_get_clean();

                    $mail->Body = $mailBody;

            
                    // Send the email
                    $mail->send();

                    
                    $this->destroyAppointmentSessionVariables();
                    $this->appointmentSuccessSMS();
                    

                } catch (Exception $e) {
                    // Handle exceptions
                    echo 'Error: ' . $mail->ErrorInfo;
                }
            
            
            

        }

        public function appointmentSuccessSMS(){

            // Send SMS
            $userID = $_ENV['NOTIFY_USERID'];
            $apiKey = $_ENV['NOTIFY_APIKEY'];

            $customMessage ="Hello " . $_SESSION['user_fname'] . " " . $_SESSION['user_lname'] . ", we've received your payment for the appointment. It's currently pending confirmation. Once accepted, we'll send you a confirmation. Thank you for choosing Pet Care—we're excited to serve you!"; // Replace this with your custom message
            $sendEndpoint = "https://app.notify.lk/api/v1/send?user_id={$userID}&api_key={$apiKey}&sender_id=NotifyDEMO&to=[TO]&message=" . urlencode($customMessage);
            $sendEndpoint = str_replace('[TO]', $_SESSION['user_mobile'], $sendEndpoint);
          //  $sendResponse = file_get_contents($sendEndpoint);
            redirect('petowner/appointment');


        }

        public function destroyAppointmentSessionVariables(){

            unset($_SESSION['appointment_vetID']);
            unset($_SESSION['appointment_reason']);
            unset($_SESSION['appointment_petID']);
            unset($_SESSION['appointment_date']);
            unset($_SESSION['appointment_time']);
            unset($_SESSION['appointment_vetFname']);
            unset($_SESSION['appointment_vetLname']);
            unset($_SESSION['appointment_petName']);
            unset($_SESSION['appointment_generatedID']);
            unset($_SESSION['appointment_treatment']);
        }

        
        

        

        public function checkAvailabilityTimeSlots(){

            //this get data from ajax request. 

            $postData = json_decode(file_get_contents('php://input'), true);
            
            if (isset($postData['selectedTime'], $postData['selectedDate'], $postData['selectedVetId'])) {
                $selectedTime = $postData['selectedTime'];
                $selectedDate = $postData['selectedDate'];
                $selectedVetId = $postData['selectedVetId'];
            
                $availability = $this->dashboardModel->checkAvailability($selectedTime, $selectedDate, $selectedVetId);

                //true mean booked

                echo json_encode(['available' => $availability]);
            } else {
                echo json_encode(['error' => 'Missing POST parameters']);
            }
        }

        public function timeSlotBookedOrLocked(){

            //this get data from ajax request. 

            $postData = json_decode(file_get_contents('php://input'), true);
            
            if (isset($postData['selectedTime'], $postData['selectedDate'], $postData['selectedVetId'])) {
                $selectedTime = $postData['selectedTime'];
                $selectedDate = $postData['selectedDate'];
                $selectedVetId = $postData['selectedVetId'];
            
                $isBooked = $this->dashboardModel->checkAvailability($selectedTime, $selectedDate, $selectedVetId);
                $isLocked = $this->dashboardModel->checkTimeSlotIsLocked($selectedTime, $selectedDate, $selectedVetId);

                $availability = '';

                if(!$isBooked){//true mean book slot availble(not booked)

                    $availability ="booked";
                }else if($isLocked){  

                    $availability = "locked";
                }

                echo json_encode(['available' => $availability]);
            } else {
                echo json_encode(['error' => 'Missing POST parameters']);
            }
        }


        public function timeSlotLock(){  //lock time slot

            $postData = json_decode(file_get_contents('php://input'), true);
            if (isset($postData['selectedTime'], $postData['selectedDate'], $postData['selectedVetId'], $postData['endTimeLock'], $postData['startTimeLock'])) {
                $selectedTime = $postData['selectedTime'];
                $selectedDate = $postData['selectedDate'];
                $selectedVetId = $postData['selectedVetId'];
                $endTimeLock = $postData['endTimeLock'];
                $startTimeLock = $postData['startTimeLock'];
            
                $locked = $this->dashboardModel->timeSlotLock($selectedTime, $selectedDate, $selectedVetId,$endTimeLock,$startTimeLock);
                echo json_encode(['locked' => $locked]);
            } else {
                echo json_encode(['error' => 'Missing POST parameters']);
            }

        }

        public function getHolidayDetails(){  //lock time slot

            
           
                
                $holidays = $this->dashboardModel->getHolidayDetails();

                if(count($holidays) > 0){

                    echo json_encode(['holidays' => $holidays]);

                }else{
                    echo json_encode(['holidays' => '']);
                }
                
            

        }

        
        public function medicalReport(){


            $treament_data = $this->dashboardModel->getTreatmentDetailsByUserID($_SESSION['user_id']);

            $data = [
                'medicalreport' =>$treament_data
            ];
           
            $this->view('dashboards/petowner/medicalreport/medicalReport', $data);
        }

        public function showMedicalReport($treament_id){

            $treament_data = $this->dashboardModel->getTreatmentDetailsByTreatmentID($treament_id);
            $petcareInfo = $this->dashboardModel->getPetCareDetails();

        
            if($treament_data == null){   //if no data found : its mean user try to access url with wrong treatment id(intentionally)
                redirect('petowner/medicalreport');
            }

            foreach ($treament_data as $treament) {
                // Assuming 'DOB' is the property name, replace it with the correct property name if needed
                $petDOB = isset($treament->DOB) ? $treament->DOB : null;
                $visitDate = isset($treament->visit_date) ? $treament->visit_date : null;
        
                $treament->petAge = $this->calculateAgeForMedicalReport($petDOB,$visitDate);
            }

            $data = [
                'medicalreportview' =>$treament_data,
                'petcareInfo' => $petcareInfo,
                'treatment_id' => $treament_id
            ];

            $this->view('dashboards/petowner/medicalreport/viewMedicalReport', $data);
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

        
        
        

        public function animalWard(){

            $medicalreports = $this->dashboardModel->getWardTreatmentDetailsByUserID($_SESSION['user_id']);

            $data = [
                'animalward' => $medicalreports
            ];

            $this->view('dashboards/petowner/animalward/animalward', $data);
        }


        public function showWardMedicalReport($id){

            $medicalReport = $this->doctorModel->getWardTreatmentDetailsByTreatmentID($id);
            //hospital info from dashboard model 
            $hospitalInfo = $this->dashboardModel->getPetCareDetails();  
            
            if($medicalReport == null){   //if no data found : its mean user try to access url with wrong treatment id(intentionally)

                
                    redirect('petowner/notfound');
               
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

        



        public function myOrders(){
                
                $myOrders = $this->dashboardModel->getMyOrdersByPetownerID($_SESSION['user_id']);

                $data = [
                    'myorder' =>$myOrders
                ];

                $this->view('dashboards/petowner/myorder/myOrders', $data);
        }

        public function viewMyOrder($id){
                
            
         $cartDetails = $this->dashboardModel->getCartDetailsByCartID($id);

         if($cartDetails == null){   //if no data found : its mean user try to access url with wrong order id(intentionally)
            redirect('petowner/myOrders');
         }

          $products = $this->dashboardModel->getProductsByCartID($id);

          $data = [
                'products' =>$products,
                'cartDetails' => $cartDetails
          ];

            $this->view('dashboards/petowner/myorder/viewMyOrder', $data);
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
            redirect('petowner/notfound');
        }


        //================ all use to show all settings =========================//    
        if($setting_name == "all"){


            $data = null;
            $this->view('dashboards/petowner/setting/settings', $data);

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

                    $user = $this->dashboardModel->getPetownerDetailsById($_SESSION['user_id']);

                   
                         



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
                     if($user->first_name == trim($_POST['fname']) && $user->last_name == trim($_POST['lname']) && $user->address == trim($_POST['address']) && $data['profile_pic_img'] == null){
                        
                        $data['main_err'] = "*No changes were detected. The data remains as is.";
                     }


                    //Make sure errors are empty
                    if(empty($data['name_err']) && empty($data['address_err']) && empty($data['img_err']) && empty($data['main_err'])){
                        
                        //update profile
                        if($this->settingsModel->updatePetownerProfile($data)){


                            //for notification
                            $_SESSION['notification'] = "ok";
                            $_SESSION['notification_msg'] = "Profile update successfully";
                           redirect('petowner/settings/all');
        
                        }else{

                            //update error : can be database error
                            $_SESSION['notification'] = "error";
                            $_SESSION['notification_msg'] = "Profile update failed. Please try again later.";
                            redirect('petowner/settings/all');
                        }


                    }else{

                        //load view with errors
                        $this->view('dashboards/petowner/setting/profile_settings', $data);
                    }

            }else{

                //normal get requset for profile

                    $user = $this->dashboardModel->getPetownerDetailsById($_SESSION['user_id']);

                    $data = [
                        'fname' => $user->first_name,
                        'lname' => $user->last_name,
                        'address' => $user->address,
                        'profile_pic' => $user->profileImage ,
                        
                        'fname_err' => '',
                        'lname_err' => '',
                        'name_err'  => '',
                        'address_err' => '',
                        'img_err' => '',
                        'main_err' => '',
                        
                    ];

                    $this->view('dashboards/petowner/setting/profile_settings', $data);

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
                }elseif(!$this->settingsModel->verifyPasswordPetowner($data['cur_password'])){
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
                    if($this->settingsModel->updatePetownerPassword($data['new_password'])){

                        //for notification
                        $_SESSION['notification'] = "ok";
                        $_SESSION['notification_msg'] = "Password update successfully";
                        redirect('petowner/settings/all');
                    }else{
                        //update error : can be database error
                        $_SESSION['notification'] = "error";
                        $_SESSION['notification_msg'] = "Password update failed";
                        redirect('petowner/settings/all');
                    }

                }else{
                    //load view with errors
                    $this->view('dashboards/petowner/setting/password_settings', $data);
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
                $this->view('dashboards/petowner/setting/password_settings', $data);
            }

            
        //================ email use to show email settings =========================//  
        }elseif($setting_name == "email"){

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $user = $this->dashboardModel->getPetownerDetailsById($_SESSION['user_id']);


                $data = [
                    'new_email' => trim($_POST['new_email']),
                    'email' => $_SESSION['user_email'],
                    'otp_code' =>'',
                    'fname' => $user->first_name,
                    'lname' => $user->last_name,

                    'new_email_err' => '',
                    'otp_section' => 0,
                    'otp_err' => '',
                    'verify_msg' => 'We send OTP code to your Email.',
                    //
                ];

                

                if(isset($_SESSION['otp']) && isset($_SESSION['otp_status']) && isset($_POST['main-submit'])){

                    if($_SESSION['otp'] == $_POST['otp_code']){

                        //update email
                        if($this->settingsModel->updatePetownerEmail($data['new_email'])){

                            //for notification
                            $_SESSION['notification'] = "ok";
                            $_SESSION['notification_msg'] = "Email update successfully";

                            unset($_SESSION['otp']);
                            unset($_SESSION['otp_status']);


                            redirect('petowner/settings/all');
                        }else{


                            //update error : can be database error
                            $_SESSION['notification'] = "error";
                            $_SESSION['notification_msg'] = "Email update failed";

                            unset($_SESSION['otp']);
                            unset($_SESSION['otp_status']);

                            redirect('petowner/settings/all');
                        }

                    }else{

                        $data['otp_code'] = trim($_POST['otp_code']);
                        $data['otp_err'] = '*OTP is incorrect';
                        $data['otp_section'] = 1;
                        $this->view('dashboards/petowner/setting/email_settings', $data);
                    }

                }




                if(isset($_POST['main-submit'])){

                    

                    

                    //validate Email
                    if(empty($data['new_email'])){
                        $data['new_email_err'] = '*Please enter email';
                    }else{
                            
                            if(!filter_var($data['new_email'], FILTER_VALIDATE_EMAIL)){ //check email in correct formate
                                $data['new_email_err'] = '*Please enter valid email';
                            }elseif($this->userModel->findUserByEmail($data['new_email'])){  //check email in the DB
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

                        

                        $this->view('dashboards/petowner/setting/email_settings', $data);

                    }else{

                        //load with erros
                        $this->view('dashboards/petowner/setting/email_settings', $data);
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
                        $this->view('dashboards/petowner/setting/email_settings', $data);
                    }else{
                        //load with erros
                        $this->view('dashboards/petowner/setting/email_settings', $data);
                    }

                    
                }

            }else{

                if(isset($_SESSION['otp']) || isset($_SESSION['otp_status'])){
                    unset($_SESSION['otp']);
                    unset($_SESSION['otp_status']);
                }

                $user = $this->dashboardModel->getPetownerDetailsById($_SESSION['user_id']);



                $data = [
                    'email' => $user->email,
                    'new_email' => '',

                    'new_email_err' => '',
                    'otp_section' => 0,
                    //We send OTP code to your Email.
                ];

                $this->view('dashboards/petowner/setting/email_settings', $data);
            }

        }elseif($setting_name == "mobile"){

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $user = $this->dashboardModel->getPetownerDetailsById($_SESSION['user_id']);

                $data = [
                    'mobile' => $user->mobile,
                    'new_mobile' => trim($_POST['new_mobile']),
                    'otp_code' =>'',
                    'fname' => $user->first_name,
                    'lname' => $user->last_name,

                    'new_mobile_err' => '',
                    'otp_section' => 0,
                    'otp_err' => '',
                    'verify_msg' => 'We send OTP code to your Mobile.',
                    //
                ];



                if(isset($_SESSION['otp_sms']) && isset($_SESSION['otp_status_sms']) && isset($_POST['main-submit'])){

                    if($_SESSION['otp_sms'] == $_POST['otp_code']){

                        //update email
                        if($this->settingsModel->updatePetownerMobile($data['new_mobile'])){

                            //for notification
                            $_SESSION['notification'] = "ok";
                            $_SESSION['notification_msg'] = "Mobile Number Update Successfully";

                            unset($_SESSION['otp_sms']);
                            unset($_SESSION['otp_status_sms']);


                            redirect('petowner/settings/all');
                        }else{


                            //update error : can be database error
                            $_SESSION['notification'] = "error";
                            $_SESSION['notification_msg'] = "Mobile Number Update Failed";

                            unset($_SESSION['otp_sms']);
                            unset($_SESSION['otp_status_sms']);

                            redirect('petowner/settings/all');
                        }

                    }else{

                        $data['otp_code'] = trim($_POST['otp_code']);
                        $data['otp_err'] = '*OTP is incorrect';
                        $data['otp_section'] = 1;
                        $this->view('dashboards/petowner/setting/mobile_settings', $data);
                    }

                }




                if(isset($_POST['main-submit'])){

                    

                    

                    
                        //validate mobile
                    if(empty($data['new_mobile'])){
                        $data['new_mobile_err'] = 'Please enter mobile number';
                    }else{

                        if (!preg_match("/^94(?:7\d{8})$/", $data['new_mobile'])) {
                            $data['new_mobile_err'] = 'Please enter a valid mobile number starting with 94';
                        } elseif ($this->userModel->findUserByMobile($data['new_mobile'])) {
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

                           
                            $data['otp_code'] = $otp;
                            //store otp in session
                            $_SESSION['otp_sms'] = $otp;

                            //send otp to email
                            $this->sendOtpCodeSMS($data);

                            $data['otp_code'] = '';

                        }

                        

                        $this->view('dashboards/petowner/setting/mobile_settings', $data);

                    }else{

                        //load with erros
                        $this->view('dashboards/petowner/setting/mobile_settings', $data);
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
                        $this->view('dashboards/petowner/setting/mobile_settings', $data);
                    }else{
                        //load with erros
                        $this->view('dashboards/petowner/setting/mobile_settings', $data);
                    }

                    
                }

                

            }else{

                if(isset($_SESSION['otp_sms']) || isset($_SESSION['otp_status_sms'])){
                    unset($_SESSION['otp_sms']);
                    unset($_SESSION['otp_status_sms']);
                }



                $user = $this->dashboardModel->getPetownerDetailsById($_SESSION['user_id']);

                $data = [
                    'mobile' => $user->mobile,
                    'new_mobile' => '',

                    'new_mobile_err' => '',
                    'otp_section' => 0,
                    
                ];

                $this->view('dashboards/petowner/setting/mobile_settings', $data);
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

    public function medicalBill(){
        $medicalBillDetails = $this->dashboardModel->getDischargeDetails();

        $data = [
            'bill' => $medicalBillDetails
        ];


        $this->view('dashboards/petowner/medicalBill/medicalbillTable',$data);
    }

    public function viewWardBill($id){


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

                $this->view('dashboards/petowner/medicalbill/viewMedicalBill', $data);
    }      
}
            
        


        
    
    
 
