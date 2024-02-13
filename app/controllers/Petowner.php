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

                                    redirect('petowner/appointment');
                                    
                                }else{
                                    die("Something went wrong in update Appointment");
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
        
                // Create a payment session
                $paymentSession = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'mode' => 'payment', // Set mode to 'payment' for one-time payments
                    'line_items' => [[
                        'price' => 'price_1OIZwlEMWpdWcJS8zC9MFJoR', // Use the price ID, not the product ID
                        'quantity' => 1,
                    ]],
                    'success_url' => 'http://localhost/petcare/petowner/appointmentSuccess', // Add a query parameter for success
                    'cancel_url' => 'http://localhost/petcare/petowner/appointment', // Add a query parameter for cancel
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
                'petcareInfo' => $petcareInfo
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

            $data = null;
            $this->view('dashboards/petowner/animalward/animalward', $data);
        }

        public function settings(){

            $data = null;
            $this->view('dashboards/petowner/setting/settings', $data);
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

        
}
            
        


        
    
    
 
