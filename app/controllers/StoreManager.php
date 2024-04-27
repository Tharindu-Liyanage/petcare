<?php

    class StoreManager extends Controller {

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

            }elseif($_SESSION['user_role'] != "Store Manager"){

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


            $this->dashboardModel = $this->model('Dashboard');
            $this->settingsModel= $this->model('Settings') ;

        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        public function index(){

            $order = $this->dashboardModel->getOrderDetails();
            $data =[
                'index' => $order
            ];
   
            
            $this->view('dashboards/storemanager/index', $data);
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
                redirect('admin/notfound');
            }


            //================ all use to show all settings =========================//    
        if($setting_name == "all"){


            $data = null;
            $this->view('dashboards/storemanager/setting/settings', $data);

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
                           redirect('storemanager/settings/all');
        
                        }else{

                            //update error : can be database error
                            $_SESSION['notification'] = "error";
                            $_SESSION['notification_msg'] = "Please review and try again";
                            redirect('storemanager/settings/all');
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
                        'nic_err' => ''
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
                        redirect('storemanager/settings/all');
                    }else{
                        //update error : can be database error
                        $_SESSION['notification'] = "error";
                        $_SESSION['notification_msg'] = "Password update failed";
                        redirect('storemanager/settings/all');
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


                            redirect('storemanager/settings/all');
                        }else{


                            //update error : can be database error
                            $_SESSION['notification'] = "error";
                            $_SESSION['notification_msg'] = "Email update failed";

                            unset($_SESSION['otp']);
                            unset($_SESSION['otp_status']);

                            redirect('storemanager/settings/all');
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


                            redirect('storemanager/settings/all');
                        }else{


                            //update error : can be database error
                            $_SESSION['notification'] = "error";
                            $_SESSION['notification_msg'] = "Mobile Number Update Failed";

                            unset($_SESSION['otp_sms']);
                            unset($_SESSION['otp_status_sms']);

                            redirect('storemanager/settings/all');
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

        public function inventory(){

            $products = $this->dashboardModel->getInventoryDetails();

            $data = [
                'inventory' =>$products
            ];
   
            
            $this->view('dashboards/storemanager/inventory/inventory', $data);
        }

        public function order(){
             $orderData = $this->dashboardModel->getOrderDetails();

            //  print($_POST['shipmentStatus']);
            // $shipmentStatus = $this->
            
            $data = [
                'order' => $orderData
            ];
   
            
            $this->view('dashboards/storemanager/order/order', $data);
        }
    
        
            public function updateStatus($id){
            // Check if the request method is POST
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    // Check if shipmentStatus is provided in the POST data
                    if (isset($_POST['shipmentStatus'])) {

                        $shipmentStatus = $_POST['shipmentStatus'];
    
                        $response = array("success" => true, "shipmentStatus" => $shipmentStatus);
                        $this->dashboardModel->updateStatus($id , $response['shipmentStatus']);
                        echo json_encode($response);
                        return;
                    } else {
                        // If shipmentStatus is not provided in the POST data, return an error response
                        $response = array("success" => false, "message" => "Shipment status is missing in the request");
                        echo json_encode($response);
                        return;
                    }
                } else {
                    // If the request method is not POST, return an error response
                    $response = array("success" => false, "message" => "Invalid request method");
                    echo json_encode($response);
                    return;
                }
            }


            // Inside the controller function handling the AJAX request
            public function updateShipmentStatus() {
                
                
                // Check if the request is POST and if required parameters are set
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['invoiceId']) && isset($_POST['shipmentStatus'])) {

                    // die("success");
                    // echo $_POST['invoiceId'];
                    // echo $_POST['shipmentStatus'];
                    // Get the invoice ID and shipment status from the POST data
                    // $shipmentStatus = $this->dashboardModel->
                    $data = [
                        'invoiceId' => $_POST['invoiceId'],
                        'shipmentStatus' => $_POST['shipmentStatus']

                    ];
                    

                    
                    if($this->dashboardModel->updateShipmentStatus($data)){
                        redirect('storemanager/order');
                    }else{
                        die("Something went wrong");
                    }

                    
                    
                } else {
                    // $this->view('dashboards/storemanager/inventory/', $data);
                }
            }


        /*==================================================================
        
            * Crud methods here ==========================================

        */ 


        //=============== Remove Product ==============================

        public function removeProduct($id){

            
            
            if($this->dashboardModel->removeProduct($id)){

                //$_SESSION['staff_user_removed'] = true;
                redirect('storemanager/inventory');

            }else{
                die("error in user delete model");
            }


        }



        //=============== add Product ==============================


        public function addProduct(){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data




                if (isset($_FILES['inventory_img'])) {
                    $uploadedFileName = $_FILES['inventory_img']['name'];
                    $fileExtension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);  // Extract the file extension

                    // Generate a timestamp for uniqueness
                    $timestamp = time();

                    // Create a unique ID by concatenating values and adding the file extension
                    $uniqueImgFileName = $_POST['pname'] . '_' . $timestamp . '.' . $fileExtension;

                }
                
                
                

                $data = [
                    'pname' => trim($_POST['pname']),
                    'brand' => trim($_POST['brand']),
                    'category' => trim($_POST['category']),
                    'stock' => trim($_POST['stock']),
                    'price' => trim($_POST['price']),
                    'img' => ($_FILES['inventory_img']['error'] === UPLOAD_ERR_NO_FILE) ? null : $_FILES['inventory_img'],
                    'pname_err' => '',
                    'brand_err' => '',
                    'cat_err' => '',
                    'price_err' => '',
                    'stock_err'  =>'',
                    'img_err' =>'',
                    'uniqueImgFileName' =>$uniqueImgFileName,
            
                ];

                // die("done so far");
              
                

            
                //validate pName
                if(empty($data['pname'])){
                    $data['pname_err'] = 'Please enter product name';
                }

                //validate brand
                if(empty($data['brand'])){
                    $data['brand_err'] = 'Please enter brand name';
                }

                //validate address
                if(empty($data['stock'])){
                    $data['stock_err'] = 'Please enter amount stock';
                }


                if (empty($data['category'])) {
                    $data['cat_err'] = 'Please select a category';
                }

                if (empty($data['price'])) {
                    $data['price_err'] = 'Please enter a price';
                }

                $allowedTypes = ['image/jpeg', 'image/png'];

                 if(empty($data['img'])){
                    $data['img_err'] = 'Please choose a Product Photo';
                 }elseif(!isset($_FILES['inventory_img']['type']) || ($_FILES['inventory_img']['type'] && !in_array($_FILES['inventory_img']['type'], $allowedTypes))) {
                    // Invalid file type
                    $data['img_err'] = 'Invalid file type. Please upload an image (JPEG or PNG).';
                 }elseif($_FILES['inventory_img
                 ']['size'] > 5 * 1024 * 1024 ){ // 5MB in bytes
                    $data['img_err'] = 'Image size must be less than 5 MB';
                }
                

                

                //Make sure errors are empty

                if(empty($data['pname_err']) && empty($data['brand_err']) && empty($data['img_err']) && empty($data['stock_err']) && empty($data['cat_err']) && empty($data['price_err'])){
                    //validated
                    
                   
                    

                    //add product

                    if($this->dashboardModel->addProduct($data)){
                       
                       // $_SESSION['staff_user_added'] = true;
      
                       redirect('storemanager/inventory');

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/storemanager/inventory/addProduct', $data);
                    
                    

                }


            }else{

                //init data
                $data = [
                    'pname' =>'' ,
                    'brand' =>'' ,
                    'category' => '',
                    'stock' => '',
                    'price' => '',
                    'pname_err' => '',
                    'brand_err' => '',
                    'cat_err' => '',
                    'price_err' => '',
                    'stock_err'  =>'',
                    'img_err' => ''
            
                ];

                
                //load view
                $this->view('dashboards/storemanager/inventory/addProduct', $data);
            }
   
            
            
        }


         //=============== update Product ==============================


         public function updateProduct($id){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data

                $data = [
                    'id' => $id,
                    'pname' => trim($_POST['pname']),
                    'brand' => trim($_POST['brand']),
                    'category' => trim($_POST['category']),
                    'stock' => trim($_POST['stock']),
                    'price' => trim($_POST['price']),
                    'pname_err' => '',
                    'brand_err' => '',
                    'cat_err' => '',
                    'price_err' => '',
                    'stock_err'  =>''
            
                ];

              
                

            
                //validate pName
                if(empty($data['pname'])){
                    $data['pname_err'] = 'Please enter product name';
                }

                //validate brand
                if(empty($data['brand'])){
                    $data['brand_err'] = 'Please enter brand name';
                }

                //validate address
                if(empty($data['stock'])){
                    $data['stock_err'] = 'Please enter amount stock';
                }


                if (empty($data['category'])) {
                    $data['cat_err'] = 'Please select a category';
                }

                if (empty($data['price'])) {
                    $data['price_err'] = 'Please enter a price';
                }
                

                

                //Make sure errors are empty

                if(empty($data['pname_err']) && empty($data['brand_err']) && empty($data['stock_err']) && empty($data['cat_err']) && empty($data['price_err'])){
                    //validated
                    
                   
                   

                    //add product

                    if($this->dashboardModel->updateProduct($data)){
                       
                       // $_SESSION['staff_user_added'] = true;
                     
                       redirect('storemanager/inventory');
                      

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/storemanager/inventory/updateProduct', $data);
                    
                    

                }


            }else{

                $product =$this->dashboardModel-> getProductDetailsById($id);



                //init data
                $data = [
                    'id' => $id,
                    'pname' =>$product->name,
                    'brand' =>$product->brand ,
                    'category' => $product->category,
                    'stock' => $product->stock,
                    'price' => $product->price,
                    'pname_err' => '',
                    'brand_err' => '',
                    'cat_err' => '',
                    'price_err' => '',
                    'stock_err'  =>''
            
                ];

                
                //load view
                $this->view('dashboards/storemanager/inventory/updateProduct', $data);
            }
   
            
            
        }



        /* view Cart*/ 

        public function viewCart($id){

            $cartData = $this->dashboardModel->getOrderDetailsById($id);
            $cartDataRow = $this->dashboardModel->getOrderDetailsByIdRow($id);

            $data =[
                'cartData' => $cartData,
                'cartDataRow' => $cartDataRow
            ];

            // die ($data[0]);
            // print_r($data['cartData']);
   
            
            $this->view('dashboards/storemanager/order/cart', $data);

        }

        public function category(){
            $category = $this->dashboardModel->getCategories();

            $data = [
                'category' => $category
            ];

            $this->view('dashboards/storemanager/category/category', $data);
        }


        public function addCategory(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data

                $data = [
                    'categoryName' => trim($_POST['category_name']),
                    'categoryName_err' => ''
                    
                ];


                //validate catgeor_Name
                if(empty($data['categoryName'])){
                    $data['categoryName_err'] = 'Please enter category name';
                }

                

                

                //Make sure errors are empty

                if(empty($data['categoryName_err'])){
                    //validated
                    
                   
                    

                    //add product

                    if($this->dashboardModel->addCategory($data)){
                       
                       // $_SESSION['staff_user_added'] = true;
      
                       redirect('storemanager/category');

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/storemanager/category/addCategory', $data);
                    
                    

                }

            }else{

                
                $data = [
                    'categoryName' => '' ,
                    'categoryName_err' => ''
            
                ];

                
                //load view
                $this->view('dashboards/storemanager/category/addCategory', $data);

            }





            $this->view('dashboards/storemanager/category/addCategory' , $data);
        }

        public function updateCategory($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data

                $data = [
                    'id' => $id,
                    'categoryName' => trim($_POST['category_name']),
                    'categoryName_err' => ''
            
                ];

              
                

            
                //validate catgeor_Name
                if(empty($data['categoryName'])){
                    $data['categoryName_err'] = 'Please enter category name';
                }

                

                

                //Make sure errors are empty

                if(empty($data['categoryName_err'])){
                    //validated
                    
                   
                    

                    //add product

                    if($this->dashboardModel->updateCategory($data)){
                       
                       // $_SESSION['staff_user_added'] = true;
      
                       redirect('storemanager/category');

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/storemanager/category/updateCategory', $data);
                    
                    

                }



            }else{

                $category =$this->dashboardModel->getCategoriesById($id);

                

                


                //init data
                $data = [
                    'id' => $id,
                    'categoryName' => $category->categoryname,
                    'categoryName_err' => ''
            
                ];

                
                //load view
                $this->view('dashboards/storemanager/category/updateCategory', $data);
            }
        }


        public function removeCategory($id){

            
            
            if($this->dashboardModel->removeCategory($id)){

                //$_SESSION['staff_user_removed'] = true;
                redirect('storemanager/category');

            }else{
                die("error in user delete model");
            }


        }


        // public function updateShipmentStatus($shipmentId, $newStatus) {
        //     return $this->dashboardModel->updateShipmentStatus($shipmentId, $newStatus);
        // }



        

    }