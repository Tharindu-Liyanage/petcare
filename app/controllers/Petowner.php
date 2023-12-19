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
                
        
                
                \Stripe\Stripe::setApiKey('sk_test_51OIDiCEMWpdWcJS8G3LlaRo4qgZbpY9h0FHWQLqWZOLJEg7eVJDCQkGQLS14M2KkUuGWoiDbfdOFJbRuNR7eUNSK004utEcz6Y');
        
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

            if($addApp){
                $this->appointmentSuccessMail();
                $this->destroyAppointmentSessionVariables();
                redirect('petowner/appointment');
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
                    $mail->Username = 'petcarevetservices@gmail.com';
                    $mail->Password = 'jwfe xzpp fyft xeqw'; // Replace with your password
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
            
                    // Set email sender details
                    $mail->setFrom('petcarevetservices@gmail.com', 'PetCare');
            
                    // Add recipient address
                    $mail->addAddress('tharinduprabashwara71@gmail.com', 'Pet Owner Name');
            
                    // Set subject and body
                    $mail->Subject = 'Important Update from Pet Care';
                    $mail->isHTML(true);
                                        $mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml" lang="en">
  
                                        <head<link rel="preconnect" href="https://fonts.googleapis.com">
                                        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                                        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
                                          <title>Email template</title>
                                          <meta property="og:title" content="Email template">
                                          
                                      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                                      
                                      <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                      
                                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                          
                                          <style type="text/css">
                                         
                                            a{ 
                                              text-decoration: underline;
                                              color: inherit;
                                              font-weight: bold;
                                              color: #253342;
                                            }
                                            
                                            h1 {
                                              font-size: 56px;
                                            }
                                            
                                              h2{
                                              font-size: 28px;
                                              font-weight: 900; 
                                            }
                                            
                                            p {
                                              font-weight: 100;
                                            }
                                            
                                            td {
                                          vertical-align: top;
                                            }
                                            
                                            #email {
                                              margin: auto;
                                              width: 600px;
                                              background-color: white;
                                            }
                                            
                                            button{
                                              font: inherit;
                                              background-color: #FF7A59;
                                              border: none;
                                              padding: 10px;
                                              text-transform: uppercase;
                                              letter-spacing: 2px;
                                              font-weight: 900; 
                                              color: white;
                                              border-radius: 5px; 
                                              box-shadow: 3px 3px #d94c53;
                                            }
                                            
                                            .subtle-link {
                                              font-size: 9px; 
                                              text-transform:uppercase; 
                                              letter-spacing: 1px;
                                              color: #CBD6E2;
                                            }
                                            
                                          </style>
                                          
                                        </head>
                                          
                                        <body bgcolor="#F5F8FA" style="width: 100%; margin: auto 0; padding:0; font-family: Poppins, sans-serif; font-size:18px; color:#33475B; word-break:break-word">
                                        
                                      
                                        
                                        
                                        <! Banner --> 
                                               <table role="presentation" width="100%">
                                                  <tr>
                                               
                                                   <td bgcolor="#EAF0F6" align="center" style=" display: grid;  vertical-align: middle; text-align:center">
                                          <div>
                                              <img alt="Flower" src="https://i.ibb.co/wQncy57/logo-croped.png" style="width: 200px; height: auto;" align="middle">
                                          </div>
                                          <div style="color: #222; font-size:20px;">
                                              <h1> PetCare! </h1>
                                          </div>
                                      </td>
                                      
                                              </table>
                                        
                                        
                                        
                                        
                                          <! First Row --> 
                                        
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="10px" style="padding: 30px 30px 30px 60px;">
                                           <tr>
                                             <td>
                                              <h2> Lorem ipsum dolor sit amet</h2>
                                                  <p>
                                                    Ut eget semper libero. Vestibulum non maximus nisl, ut iaculis ante. Nunc arcu elit, cursus eget urna et, tempus aliquam eros. Ut eget semper libero. Vestibulum non maximus nisl, ut iaculis ante. Nunc arcu elit, cursus eget urna et, tempus aliquam eros.  
                                                  </p>
                                                      <button> 
                                                        Button 1
                                                      </button>
                                                </td> 
                                                </tr>
                                                       </table>
                                        
                                        <! Second Row with Two Columns--> 
                                        
                                          <table role="presentation" border="0" cellpadding="0" cellspacing="10px" width="100%" style="padding: 30px 30px 30px 60px;">
                                            <tr>
                                                <td> 
                                                 <img alt="Blog" src="https://www.hubspot.com/hubfs/assets/hubspot.com/style-guide/brand-guidelines/guidelines_sample-illustration-3.svg" width="200px" align="middle">
                                                  
                                               <h2> Vivamus ac elit eget </h2>
                                                  <p>
                                                    Vivamus ac elit eget dolor placerat tristique et vulputate nibh. Sed in elementum nisl, quis mollis enim. Etiam gravida dui vel est euismod, at aliquam ipsum euismod. 
                                            
                                                    </p>
                                        
                                                </td>
                                              
                                                <td>
                                                  
                                                  <img alt="Shopping" src="https://www.hubspot.com/hubfs/assets/hubspot.com/style-guide/brand-guidelines/guidelines_sample-illustration-5.svg" width="200px" align="middle">
                                               <h2> Suspendisse tincidunt iaculis </h2>
                                                  <p>
                                                    Suspendisse tincidunt iaculis fringilla. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras laoreet elit purus, quis pulvinar ipsum pulvinar et. 
                                            
                                                    </p> 
                                                </td>
                                                </tr>
                                            
                                                  <tr>
                                                    <td> <button> Button 2 </button> </td> 
                                                    <td> <button> Button 3 </button> </td> 
                                                    
                                        </table>
                                           
                                              <! Banner Row --> 
                                        <table role="presentation" bgcolor="#EAF0F6" width="100%" style="margin-top: 50px;" >
                                            <tr>
                                                <td align="center" style="padding: 30px 30px;">
                                                  
                                               <h2> Nullam porta arcu </h2>
                                                  <p>
                                                    Nam vel lobortis lorem. Nunc facilisis mauris at elit pulvinar, malesuada condimentum erat vestibulum. Pellentesque eros tellus, finibus eget erat at, tempus rutrum justo. 
                                            
                                                    </p>
                                                    <a href="#"> Ask us a question</a>      
                                                </td>
                                                </tr>
                                            </table>
                                        
                                              <! Unsubscribe Footer --> 
                                            
                                        <table role="presentation" bgcolor="#F5F8FA" width="100%" >
                                            <tr>
                                                <td align="left" style="padding: 30px 30px;">
                                                  <p style="color:#99ACC2"> Made with &hearts; at HubSpot HQ </p>
                                                    <a class="subtle-link" href="#"> Unsubscribe </a>      
                                                </td>
                                                </tr>
                                            </table> 
                                            </div>
                                          </body>
                                            </html>';

            
                    // Send the email
                    $mail->send();

            
                    $this->destroyAppointmentSessionVariables();
                    redirect('petowner/appointment');

                } catch (Exception $e) {
                    // Handle exceptions
                    echo 'Error: ' . $mail->ErrorInfo;
                }
            
            
            

        }

        public function destroyAppointmentSessionVariables(){

            unset($_SESSION['appointment_vetID']);
            unset($_SESSION['appointment_reason']);
            unset($_SESSION['appointment_petID']);
            unset($_SESSION['appointment_date']);
            unset($_SESSION['appointment_time']);
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

                if($isLocked){

                    $availability ="locked";
                }else if(!$isBooked){  //true mean book slot availble(not booked)

                    $availability = "booked";
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
            
        


        
    
    
 
