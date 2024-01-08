<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    use donatj\UserAgent\UserAgentParser;

    class Users extends Controller{

        public function __construct(){

            $this->userModel = $this->model('User');

           

        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        
        public function signup(){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data

                $data = [
                    'first_name' => trim($_POST['fname']),
                    'last_name' => trim($_POST['lname']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    're_password' => trim($_POST['re_password']),
                    'mobile' => trim($_POST['mobile']),
                    'fname_err' => '',
                    'lname_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'mobile_err' => ''
                ];
                

                //validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }else{
 
                    if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){ //check email in correct formate

                        $data['email_err'] = 'Please enter valid email';
 
                    }elseif($this->userModel->findUserByEmail($data['email'])){  //check email in the DB
                        
                        $data['email_err'] = 'Email is already taken';
 
                    }


                }

                //validate fName
                if(empty($data['first_name'])){
                    $data['fname_err'] = 'Please enter first name';
                }

                //validate lName
                if(empty($data['last_name'])){
                    $data['lname_err'] = 'Please enter last name';
                }

                //validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                }elseif(strlen($data['password']) < 8){
                    $data['password_err'] = 'Password must be at least 8 characters';
                }

                //validate password
                if(empty($data['re_password'])){
                    $data['confirm_password_err'] = 'Please confirm password';
                }else{

                    if($data['password'] != $data['re_password'])
                    $data['confirm_password_err'] = 'Passwords do not match';
                }

                //validate mobile
                if(empty($data['mobile'])){
                    $data['mobile_err'] = 'Please enter mobile number';
                }else{
                    if (!preg_match("/^94\d{9}$/", $data['mobile'])) {
                        // Check mobile in correct format, Sri Lanka
                        $data['mobile_err'] = 'Please enter a valid Sri Lankan mobile number starting with 94';
                    } elseif ($this->userModel->findUserByMobile($data['mobile'])) {
                        // Check if mobile number is already taken in the DB
                        $data['mobile_err'] = 'Mobile number is already taken';
                    }
                    

                    
                }

                //Make sure errors are empty

                if(empty($data['email_err']) && empty($data['fname_err']) && empty($data['lname_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['mobile_err'])){
                    //validated
                    
                    //hash password
                    $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                    //Regster User

                    if($this->userModel->register($data)){
                       
                        $_SESSION['signup_check'] = true;
      
                       redirect('users/login');

                    }else{
                        die("Something went wrong");
                    }



                }else{
                    //load view with errors
                    $this->view('auth/signup',$data);
                    
                    

                }


            }else{

                //init data
                $data = [
                    'first_name' => '',
                    'last_name' =>'' ,
                    'email' => '',
                    'password' => '',
                    're_password' => '',
                    'mobile' => '',
                    'fname_err' => '',
                    'lname_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'mobile_err' => ''
                ];

                //load view
                $this->view('auth/signup',$data);
            }

        }

        public function vet_signup(){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //process form

                //Sanatze POST data
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data

                $data = [
                    'first_name' => trim($_POST['fname']),
                    'last_name' => trim($_POST['lname']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    're_password' => trim($_POST['re_password']),
                    'mobile' => trim($_POST['mobile']),
                    'fname_err' => '',
                    'lname_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'mobile_err' => ''
                ];
                

                //validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }else{
 
                    if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){ //check email in correct formate

                        $data['email_err'] = 'Please enter valid email';
 
                    }elseif($this->userModel->findUserByEmail($data['email'])){  //check email in the DB
                        
                        $data['email_err'] = 'Email is already taken';
 
                    }
                }

                //validate fName
                if(empty($data['first_name'])){
                    $data['fname_err'] = 'Please enter first name';
                }

                //validate lName
                if(empty($data['last_name'])){
                    $data['lname_err'] = 'Please enter last name';
                }

                //validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                }elseif(strlen($data['password']) < 8){
                    $data['password_err'] = 'Password must be at least 8 characters';
                }

                //validate password
                if(empty($data['re_password'])){
                    $data['confirm_password_err'] = 'Please confirm password';
                }else{

                    if($data['password'] != $data['re_password'])
                    $data['confirm_password_err'] = 'Passwords do not match';
                }

                //validate mobile
                if(empty($data['mobile'])){
                    $data['mobile_err'] = 'Please enter mobile number';
                }else{

                    if(!preg_match("/^(?:\+?94)?(?:7\d{8})$/", $data['mobile'])){ //check mobile in correct formate, SriLanka

                        $data['mobile_err'] = 'Please enter valid mobile number';
 
                    }elseif($this->userModel->findUserByMobile($data['mobile'])){  //check mobile in the DB
                        
                        $data['mobile_err'] = 'Mobile number is already taken';
 
                    }   
                }


                //Make sure errors are empty

                if(empty($data['email_err']) && empty($data['fname_err']) && empty($data['lname_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['mobile_err'])){
                    //validated
                    die('Success');
                }else{
                    //load view with errors
                    $this->view('auth/signUp_Vet',$data);

                }




            }else{

                //init data
                $data = [
                    'first_name' => '',
                    'last_name' =>'' ,
                    'email' => '',
                    'password' => '',
                    're_password' => '',
                    'mobile' => '',
                    'fname_err' => '',
                    'lname_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'mobile_err' => ''
                ];

                //load view
                $this->view('auth/signUp_Vet',$data);
            }

        }

        //=========================Login===========================

        public function login(){

             //if not unset in change password page
             if(isset( $_SESSION['User_Role'])){
                unset( $_SESSION['User_Role']);
            }

            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $data = [
                    
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => '',
                    
                ];

                //validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }else{

                    if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                        $data['email_err'] = 'Please enter valid email';
                    }else{

                        //Check for user/email

                         if($this->userModel->findUserByEmail($data['email'])){
                             //user found
                         }else{
                                $data['email_err'] = 'No user found';
                        }

                    }
                    
                }

                //validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                }

                


                //Make sure errors are empty

                if(empty($data['email_err']) && empty($data['password_err'])){
                    //validated
                    //check and set logged in user

                    $loggedInUser = $this->userModel->login($data['email'],$data['password']);

                    if($loggedInUser){
                        //create session
                        
                        $this->createUserSession($loggedInUser);

                    }else{
                        $data['password_err'] ='Password incorrect';

                        //load the errors
                        $this->view('auth/login',$data);

                    }



                }else{


                    //load view with errors
                    $this->view('auth/login',$data);

                }


            }else{

                //init data
                $data = [
                    
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => ''   
                ];

                //load view
                $this->view('auth/login',$data);
            }

        }

        //=============== forgot password =================================================

        public function forgotPassword(){

           

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $data = [
                    
                    'email' => trim($_POST['email']),
                    'otp' =>random_int(1000, 9999),
                    'first_digit' => '',
                    'second_digit' => '',
                    'third_digit' => '',
                    'fourth_digit' => '',
                    'email_err' => '',
                ];

                //validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }else{

                    if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                        $data['email_err'] = 'Please enter valid email';
                    }else{

                        //Check for user/email
                        // 1 .check staff (if not found)
                        //2 . check petowner
                        //3. check user ban or not

                        if(isset($_SESSION['User_Role']) && $_SESSION['User_Role'] == 'staff'){

                            if(!$this->userModel->findStaffUserByEmail($data['email'])){
                                //user not found
                                $data['email_err'] = 'Please check your email and try again.';
                            }


                        }else{

                            if(!$this->userModel->findUserByEmail($data['email'])){
                                //user not found
                                $data['email_err'] = 'Please check your email and try again.';
                            }
                        }

                    }
                    
                }

                //check user is banned or not

                if($this->userModel->isUserBan($data['email'])){
                    $data['email_err'] = 'Your email temporarily suspended. Please try again later';
                }

                if(empty($data['email_err'])){

                    // Convert OTP to a string
                     $otpString = (string) $data['otp'];
                    // Extract individual digits  for Email
                    $data['first_digit'] = $otpString[0];
                    $data['second_digit'] = $otpString[1];
                    $data['third_digit'] = $otpString[2];
                    $data['fourth_digit'] = $otpString[3];

                    $this->userModel->sendOtpCode($data);
                    $userDetails = $this->userModel->findUserByEmailForForgotPassword($data['email']);

                    $data['user_fname'] = $userDetails->first_name;
                    $data['user_lname'] = $userDetails->last_name;
                    $data['mobile'] = $userDetails->mobile;

                    $this->sendOtpCodeEmail($data);

                    //create session before redirect to otpVerification
                    $_SESSION['forgotUser_email'] = $data['email'];
                    $_SESSION['forgotUser_fname'] = $userDetails->first_name;
                    $_SESSION['forgotUser_lname'] = $userDetails->last_name;
                    $_SESSION['forgotUser_Try_Attempt'] = 3;


                    redirect('users/otpVerification');





                }else{

                    //load view with errors
                    $this->view('auth/forgotPassword',$data);
                }

                
            }else{

                //init data
                $data = [
                    
                    'email' => '',
                    'email_err' => '',  
                ];

                //load view
                $this->view('auth/forgotPassword',$data);
            }

        }


        //send email with otp code

        public function sendOtpCodeEmail($data){

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
                $mail->addAddress($data['email'], 'User: ' . $data['email']);
        
                // Set subject and body
                $mail->Subject = 'Password Reset OTP - PetCare';
                $mail->isHTML(true);

                $filePath = __DIR__ . '/../views/email/otpCodeForForgotPassword.php';
                $emailContent = file_get_contents($filePath);

                $emailContent = str_replace('{pet_owner_fname}', $data['user_fname'], $emailContent);
                $emailContent = str_replace('{pet_owner_lname}', $data['user_lname'], $emailContent);
                $emailContent = str_replace('{first-digit}',$data['first_digit'], $emailContent);
                $emailContent = str_replace('{second-digit}',$data['second_digit'], $emailContent);
                $emailContent = str_replace('{third-digit}',$data['third_digit'], $emailContent);
                $emailContent = str_replace('{fourth-digit}',$data['fourth_digit'], $emailContent);


                $mail->Body = $emailContent;

                // Send the email
                $mail->send();

                
               
                

            } catch (Exception $e) {
                // Handle exceptions
                echo 'Error: ' . $mail->ErrorInfo;
            }
        

            
        }

        public function otpVerification(){

           
            //unothorized access block

            if(!isset($_SESSION['forgotUser_email'])){
                redirect('users/forgotPassword');
            }

            
          
            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);




                if (isset($_POST['resend'])) {

                    $data = [
                    
                        'first_digit' => '',
                        'second_digit' => '',
                        'third_digit' => '',
                        'fourth_digit' => '',
                        'otp_err' => '',
                        'user_fname' => $_SESSION['forgotUser_fname'],
                        'user_lname' => $_SESSION['forgotUser_lname'],
                        'email' => $_SESSION['forgotUser_email'],
                        'otp' =>'',
                        'expire_at' => ''
                    ];

                    //get expire time
                    

                   

                    if($_SESSION['forgotUser_Try_Attempt'] == 0){
                        $data['otp_err'] = 'You have exceeded the maximum number of attempts. Please try again later.';

                        $expireTime = $this->userModel->getExpireTimeOTPCode($_SESSION['forgotUser_email']);
                        $data['expire_at'] = $expireTime->expired_at; //assign expire time to data array

                        $this->view('auth/otpVerification',$data);
                    }else{

                        

                        $data['otp'] = random_int(1000, 9999);
                        // Convert OTP to a string
                        $otpString = (string) $data['otp'];
                        // Extract individual digits  for Email
                        $data['first_digit'] = $otpString[0];
                        $data['second_digit'] = $otpString[1];
                        $data['third_digit'] = $otpString[2];
                        $data['fourth_digit'] = $otpString[3];

                        $this->userModel->sendOtpCode($data); //to database
                        $this->sendOtpCodeEmail($data); //send Email again

                        //after send new otp get new expire time
                        $expireTime = $this->userModel->getExpireTimeOTPCode($_SESSION['forgotUser_email']);
                        $data['expire_at'] = $expireTime->expired_at; //assign expire time to data array
                        

                        $this->view('auth/otpVerification',$data);

                    }

                }else if(isset($_POST['mainSubmit'])){

                    $data = [
                    
                        'first_digit' => trim($_POST['first_digit_input']),
                        'second_digit' => trim($_POST['second_digit_input']),
                        'third_digit' => trim($_POST['third_digit_input']),
                        'fourth_digit' => trim($_POST['fourth_digit_input']),
                        'otp_err' => '',
                        'email' => $_SESSION['forgotUser_email'],
                        'expire_at' => ''
                    ];

                  //  die(var_dump($data));

                   


                    //get expire time
                    $expireTime = $this->userModel->getExpireTimeOTPCode($_SESSION['forgotUser_email']);
                    $data['expire_at'] = $expireTime->expired_at; //assign expire time to data array

                    $otp = $data['first_digit'].$data['second_digit'].$data['third_digit'].$data['fourth_digit'];

                    $latestOTPCodeQuery =  $this->userModel->getOtpCodeByEmail($_SESSION['forgotUser_email']);
                    $latestOTPCode = $latestOTPCodeQuery->otp_code;



                    if($_SESSION['forgotUser_Try_Attempt'] == 0){

                        //checking the last attempt

                        $data['otp_err'] = 'You have exceeded the maximum number of attempts.<br>Please try again later.';
                        $this->view('auth/otpVerification',$data);


                    }else{
                    
                        if ($data['first_digit'] !== "" && $data['second_digit'] !== "" && $data['third_digit'] !== "" && $data['fourth_digit'] !== "") {

                            
                           //Now error are empty



                            //current time 

                            $currentTime = new DateTime('now'); 
                          //  die(var_dump($currentTime , $expireTime->expired_at));

                           

                            if($otp == $latestOTPCode){



                                if(($currentTime->format('Y-m-d H:i:s') > $expireTime->expired_at)){

                                    //checking OTP is expired!

                                    $data['otp_err'] = 'OTP code has expired. Please try again.';
                                    $this->view('auth/otpVerification',$data);


                                }else{

                                    //all good , now go to changePassword page

                                    //unset session variables
                                    $_SESSION['VerifiedUser_email'] = $_SESSION['forgotUser_email'];
                                    $_SESSION['VerifiedUser_PWD_Session_LastActivity'] = time(); //time of last activity
                                    unset($_SESSION['forgotUser_email']);
                                    unset($_SESSION['forgotUser_fname']);
                                    unset($_SESSION['forgotUser_lname']);
                                    unset($_SESSION['forgotUser_Try_Attempt']);



                                    redirect('users/changePassword');
                                }

                            }else{

                                //wrong code type

                                
                                $_SESSION['forgotUser_Try_Attempt'] = $_SESSION['forgotUser_Try_Attempt'] - 1;

                                if($_SESSION['forgotUser_Try_Attempt'] == 0){
                                    $data['otp_err'] = 'You have exceeded the maximum number of attempts.<br>Please try again later.';

                                    $this->sendUnauthorizedAccessEmail($data);
                                    $this->userModel->tempBanUser();

                                }else{
                                    $data['otp_err'] = 'Wrong OTP Code. You have '.$_SESSION['forgotUser_Try_Attempt'].' attempts left.';
                                }
                                
                                $this->view('auth/otpVerification',$data);
                            }  



                        }else{
                            
                            //nothing type

                            $data['otp_err'] = 'Please enter the OTP code.';
                            $this->view('auth/otpVerification',$data);
                        } 

                    }

                    

                }

            }else{

                //normal loading 1st time

                 //get expire time
                 $expireTime = $this->userModel->getExpireTimeOTPCode($_SESSION['forgotUser_email']);
                    
                    //init data
                    $data = [
                    
                        'first_digit' => '',
                        'second_digit' => '',
                        'third_digit' => '',
                        'fourth_digit' => '',
                        'otp_err' => '',
                        'email' => $_SESSION['forgotUser_email'],
                        'otp' =>'',
                        'expire_at' => $expireTime->expired_at
                    ];
    
                    //load view
                    $this->view('auth/otpVerification',$data);
            }

           
            

        }

        //  ====================== Create User session =======================


        public function createUserSession($user){

            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_fname'] = $user->first_name;
            $_SESSION['user_lname'] = $user->last_name;
            $_SESSION['user_mobile'] = $user->mobile;
            $_SESSION['user_profileimage'] = $user->profileImage;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_role'] = 'Pet Owner';
            $_SESSION['PO_last_activity'] = time(); //time of last activity

            //redirect to dashboard
            redirect('petowner');

        }

         //  ====================== Create Staff User session =======================


         public function createStaffUserSession($user){

            $_SESSION['user_id'] = $user->staff_id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_fname'] = $user->firstname;
            $_SESSION['user_lname'] = $user->lastname;
            $_SESSION['user_role'] = $user->role;
            $_SESSION['user_profileimage'] = $user->profileImage;

            switch ($_SESSION['user_role']) {
                case "Admin":
                    redirect('admin');
                    break;
                case "Assistant":
                    redirect('assistant');
                    break;
                case "Store Manager":
                    redirect('storemanager');
                    break;
                case "Doctor":
                    redirect('doctor');
                    break;
                case "Nurse":
                    redirect('doctor');
                    break;
                default:
                 
                    // Handle unexpected roles, e.g., redirect to a default page or show an error message.
                    break;
            }
            

        }


        //================= Logout====================

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_fname']);
            unset($_SESSION['user_lname'] );
            unset($_SESSION['user_mobile']);
            unset($_SESSION['user_role']);
            unset( $_SESSION['user_profileimage']);

            session_destroy();
            redirect('users/login');
        }



        //================= staff Logout====================

        public function staffLogout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_fname']);
            unset($_SESSION['user_lname'] );
            unset($_SESSION['user_role']);
            unset( $_SESSION['user_profileimage']);

            session_destroy();
            redirect('users/staff');
        }


    // ===================== Staff Login ===========

    public function staff(){

        $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

        //check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $data = [
                
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
                
            ];

            //validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }else{

                if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                    $data['email_err'] = 'Please enter valid email';
                }else{

                    //Check for user/email

                     if($this->userModel->findStaffUserByEmail($data['email'])){
                         //user found
                     }else{
                            $data['email_err'] = 'No user found';
                    }

                }
                
            }

            //validate password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }

            


            //Make sure errors are empty

            if(empty($data['email_err']) && empty($data['password_err'])){
                //validated
                //check and set logged in user

                $loggedInUser = $this->userModel->stafflogin($data['email'],$data['password']);

                if($loggedInUser){
                    //create session
                    
                    $this->createStaffUserSession($loggedInUser);

                }else{
                    $data['password_err'] ='Password incorrect';

                    //load the errors
                    $this->view('auth/staff_login',$data);

                }



            }else{


                //load view with errors
                $this->view('auth/staff_login',$data);

            }


        }else{

            //init data
            $data = [
                
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''   
            ];

            //load view
            $this->view('auth/staff_login',$data);
        }

    }



    public function changePassword(){

        //unothorized access block
        if(!isset($_SESSION['VerifiedUser_email'])){

            redirect('users/forgotPassword');
        }


        //session expire if user idle for 5 minutes
        $currentTime = time();
        $inactiveTime = 300; //5 minutes -> 300sec

        if(isset($_SESSION['VerifiedUser_PWD_Session_LastActivity']) && ($currentTime - $_SESSION['VerifiedUser_PWD_Session_LastActivity'] > $inactiveTime)){
            //last request was more than 5 minutes ago
            
            //messages for login page
            $_SESSION['session_err_PO'] = "<i class='bx bx-error'></i> Session expired! Please try again.";  // for login page. for loading without any errors

            //unset session variables
            unset($_SESSION['VerifiedUser_PWD_Session_LastActivity']);
            unset($_SESSION['VerifiedUser_email']);

            if(isset($_SESSION['User_Role']) && $_SESSION['User_Role'] == 'staff'){

                if(isset( $_SESSION['User_Role'])){
                    unset( $_SESSION['User_Role']);
                }

                redirect('users/staff');

            }else{

                redirect('users/login');

            }

            

        }else{


            $_SESSION['VerifiedUser_PWD_Session_LastActivity'] = $currentTime;

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $data = [
                    
                    'password' => trim($_POST['password']),
                    're_password' => trim($_POST['re_password']),
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'email' => $_SESSION['VerifiedUser_email']
                    
                ];

                //validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                }elseif(strlen($data['password']) < 8){
                    $data['password_err'] = 'Password must be at least 8 characters';
                }

                //validate password ,checking confirm
                if(empty($data['re_password'])){
                    $data['confirm_password_err'] = 'Please confirm password';
                }else{

                    if($data['password'] != $data['re_password'])
                    $data['confirm_password_err'] = 'Passwords do not match';
                }

                //Make sure errors are empty
                if(empty($data['password_err']) && empty($data['confirm_password_err'])){

                    //hash password
                    $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                    //update password
                    if($this->userModel->updatePassword($data)){

                        //messages for login page
                        $_SESSION['change_pwd_msg_PO'] = "<i class='bx bx-check-circle' ></i>Password changed successfully!";  // for change password page. for loading without any errors

                          //unset session variables
                          unset($_SESSION['VerifiedUser_PWD_Session_LastActivity']);
                          unset($_SESSION['VerifiedUser_email']);


                        if(isset($_SESSION['User_Role']) && $_SESSION['User_Role'] == 'staff'){

                            if(isset( $_SESSION['User_Role'])){
                                unset( $_SESSION['User_Role']);
                            }

                            redirect('users/staff');


                        }else{
                            redirect('users/login');
                        }
                       

                        
                    }else{
                        die('Something went wrong');
                    }

                }else{

                    //load view with errors
                    $this->view('auth/changepassword',$data);
                }
        

            //
        }else{

            $data = [
                
                're_password' => '',
                'password' => '',
                'password_err' => '',
                're_password_err' => '' ,
                'confirm_password_err' => '',  
            ];
    
            //load view
            $this->view('auth/changepassword',$data);




        }
        }
    }

    //change password for staff

    public function changePasswordStaff(){

        //set this session variable to idnetify the user is staff

        $_SESSION['User_Role'] = 'staff';
        redirect('users/forgotpassword');
    
    }


    public function sendUnauthorizedAccessEmail($data){

          

            require __DIR__ . '/../libraries/PhpUserAgent/vendor/autoload.php'; 
            require __DIR__ . '/../libraries/phpmailer/vendor/autoload.php';

            // this for PhpUserAgent

            $parser = new UserAgentParser(); 

            // object-oriented call
            $ua = $parser->parse();

            // PhpUserAgent end
                
            try {

                $date = date("Y-m-d");
                $time = date("H:i:s");

                

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
                $mail->addAddress($data['email'], 'User: ' . $data['email']);
        
                // Set subject and body
                $mail->Subject = 'Unauthorized Access - PetCare';
                $mail->isHTML(true);
    
                $filePath = __DIR__ . '/../views/email/forgotpasswordTempBan.php';
                $emailContent = file_get_contents($filePath);
    
                $emailContent = str_replace('{pet_owner_fname}', $_SESSION['forgotUser_fname'], $emailContent);
                $emailContent = str_replace('{pet_owner_lname}', $_SESSION['forgotUser_lname'], $emailContent);
                $emailContent = str_replace('{date}',$date, $emailContent);
                $emailContent = str_replace('{time}',$time, $emailContent);
                $emailContent = str_replace('{user_os}',$ua->platform() . PHP_EOL, $emailContent);
                $emailContent = str_replace('{user_browser}',$ua->browser() . PHP_EOL, $emailContent);

                $mail->Body = $emailContent;
                // Send the email
                $mail->send();

        }

        catch (Exception $e) {
            // Handle exceptions
            echo 'Error: ' . $mail->ErrorInfo;
        }

    }


}