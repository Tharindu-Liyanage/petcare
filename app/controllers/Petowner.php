<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    class Petowner extends Controller {

        public function __construct(){
           
            if(!isset($_SESSION['user_id'])){
                
                redirect('users/staff');

            }else{


                if($_SESSION['user_role'] != "Pet Owner"){

                    // Unauthorized access
                    redirect('users/login');
                     
                }
            }

            $this->dashboardModel = $this->model('Dashboard');
            require __DIR__ . '/../libraries/stripe/vendor/autoload.php';
            
          
            
        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        public function index(){

            $pets = $this->dashboardModel->getPetDetailsByPetownerID($_SESSION['user_id']);

            $data = [
                'pet' =>$pets
            ];
   
            
            $this->view('dashboards/petowner/index', $data);
        }


        public function pet(){

            $pets = $this->dashboardModel->getPetDetailsByPetownerID($_SESSION['user_id']);

            $data = [
                'pet' =>$pets
            ];

            $this->view('dashboards/petowner/pet/pet',$data);
        }


        public function addPet(){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data

                $data = [
                    'pname' => trim($_POST['pname']),
                    'dob' => trim($_POST['dob']),
                    'species' => trim($_POST['species']),
                    'sex' => trim($_POST['sex']),
                    'breed' => trim($_POST['breed']),
                    'age' => trim($_POST['age']),
                    'age_err' => '',
                    'pname_err' => '',
                    'dob_err' => '',
                    'species_err' => '',
                    'sex_err' => '',
                    'breed_err'  =>''
            
                ];

              
                

            
                //validate pName
                if(empty($data['pname'])){
                    $data['pname_err'] = 'Please pet name';
                }

                //validate brand
                if(empty($data['dob'])){
                    $data['dob_err'] = 'Please enter DOB';
                }

                //validate address
                if(empty($data['species'])){
                    $data['species_err'] = 'Please enter Species';
                }


                if (empty($data['sex'])) {
                    $data['sex_err'] = 'Please select Sex';
                }

                if (empty($data['breed'])) {
                    $data['breed_err'] = 'Please enter a price';
                }

                if (empty($data['age'])) {
                    $data['age_err'] = 'Please enter Age';
                }
                

                

                //Make sure errors are empty

                if(empty($data['pname_err']) && empty($data['breed_err']) && empty($data['sex_err']) && empty($data['cat_err']) &&  empty($data['dob_err']) &&   empty($data['age_err'])){
                    //validated
                    
                   
                    

                    //add product

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
                    'sex' =>'',
                    'breed' =>'',
                    'age' =>'',
                    'age_err' => '',
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

                //init data

                $data = [
                    'id' => $id,
                    'pname' => trim($_POST['pname']),
                    'dob' => trim($_POST['dob']),
                    'species' => trim($_POST['species']),
                    'sex' => trim($_POST['sex']),
                    'breed' => trim($_POST['breed']),
                    'age' => trim($_POST['age']),
                    'age_err' => '',
                    'pname_err' => '',
                    'dob_err' => '',
                    'species_err' => '',
                    'sex_err' => '',
                    'breed_err'  =>''
            
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


                if (empty($data['age'])) {
                    $data['age_err'] = 'Please enter Age';
                }

                if (empty($data['breed'])) {
                    $data['breed_err'] = 'Please enter breed';
                }

               

                if (empty($data['species'])) {
                    $data['species_err'] = 'Please enter Species';
                }
                

                

                //Make sure errors are empty

                if(empty($data['pname_err']) && empty($data['breed_err']) && empty($data['age_err']) && empty($data['species_err']) && empty($data['sex_err'])){
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



                //init data
                $data = [
                    'id' => $id,
                    'pname' => $pet ->pet,
                    'dob' => $pet -> DOB,
                    'species' => $pet -> species,
                    'sex' => $pet -> sex,
                    'breed' => $pet -> breed,
                    'age' => $pet -> age,
                    'age_err' =>'',
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
           

        
            $data = [
                'pet' =>$pets,
                'time_slots' => $time_slots,
                'vet' => $vets,
                'holiday' => $holidays,
                'reason' => $reason
            ];

            $this->view('dashboards/petowner/appointment/addAppointment', $data);
        }

        public function updateAppointment(){

            $data = null;
            $this->view('dashboards/petowner/appointment/updateAppointment', $data);
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

            $addApp = $this->dashboardModel->insertAppointment($_SESSION['appointment_vetID'], $_SESSION['appointment_reason'], $_SESSION['appointment_petID'], $_SESSION['appointment_date'], $_SESSION['appointment_time']);

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

        


        
        
        

        public function animalWard(){

            $data = null;
            $this->view('dashboards/petowner/animalward/animalward', $data);
        }

        public function settings(){

            $data = null;
            $this->view('dashboards/petowner/setting/settings', $data);
        }

        
}
            
        


        
    
    
 
