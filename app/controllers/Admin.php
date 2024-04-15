<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Admin extends Controller {

        public function __construct(){
           
            if(!isset($_SESSION['user_id'])){
                
                redirect('users/staff');

            }else{


                if($_SESSION['user_role'] != "Admin"){

                    // Unauthorized access
                    
                    redirect('users/staff');
                     
                }
            }

            $this->dashboardModel = $this->model('Dashboard');
            $this->userModel = $this->model('User');
            $this->settingsModel= $this->model('Settings') ;
            $this->reportModel= $this->model('ReportModel') ;
            $this->doctorModel= $this->model('DoctorModel') ;

            
        
        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        /*==================  INDEX ============= */


        public function index(){
            
            
   
            $data = null;
            $this->view('dashboards/admin/index', $data);
        }


       
      


        /*==================  ADD STAFF ============= */

        public function addStaff(){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data

                $data = [
                    'first_name' => trim($_POST['fname']),
                    'last_name' => trim($_POST['lname']),
                    'email' => trim($_POST['email']),
                    'role' => trim($_POST['role']),
                    'address' => trim($_POST['address']),
                    'mobile' => trim($_POST['mobile']),
                    'fname_err' => '',
                    'lname_err' => '',
                    'email_err' => '',
                    'role_err'  =>'',
                    'address_err'  =>'',
                    'tmp_pwd'  =>'',
                    'mobile_err' => ''
                ];

              
                

                //validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }else{
 
                    if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){ //check email in correct formate

                        $data['email_err'] = 'Please enter valid email';
 
                    }elseif($this->userModel->findStaffUserByEmail($data['email'])){  //check email in the DB
                        
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

                //validate address
                if(empty($data['address'])){
                    $data['address_err'] = 'Please enter address';
                }


                if (empty($data['role'])) {
                    $data['role_err'] = 'Please select a role';
                }
                

                

                //validate mobile
                if(empty($data['mobile'])){
                    $data['mobile_err'] = 'Please enter mobile number';
                }else{

                    if(!preg_match("/^(?:\+?94)?(?:7\d{8})$/", $data['mobile'])){ //check mobile in correct formate, SriLanka

                        $data['mobile_err'] = 'Please enter valid mobile number';
 
                    }elseif($this->userModel->findStaffByMobile($data['mobile'])){  //check mobile in the DB
                        
                        $data['mobile_err'] = 'Mobile number is already taken';
 
                    }

                    
                }

                //Make sure errors are empty

                if(empty($data['email_err']) && empty($data['fname_err']) && empty($data['lname_err']) && empty($data['role_err']) && empty($data['address_err']) && empty($data['mobile_err'])){
                    //validated
                    
                    //set default password 123456789
                    $data['tmp_pwd'] = password_hash('123456789',PASSWORD_DEFAULT);
                    

                    //Regster User

                    if($this->dashboardModel->addStaff($data)){
                       
                        $_SESSION['staff_user_added'] = true;
      
                       redirect('admin/staff');

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/admin/staff/addStaff', $data);
                    
                    

                }


            }else{

                //init data
                $data = [
                    'first_name' => '',
                    'last_name' => '',
                    'email' => '',
                    'role' => '',
                    'address' => '',
                    'mobile' => '',
                    'fname_err' => '',
                    'lname_err' => '',
                    'email_err' => '',
                    'role_err'  =>'',
                    'address_err'  =>'',
                    'tmp_pwd'  =>'',
                    'mobile_err' => ''
                ];

                
                //load view
                $this->view('dashboards/admin/staff/addStaff', $data);
            }
   
            
            
        }



        /*==================  Update STAFF ============= */

        public function updateStaff($id){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data

                $data = [
                    'id' => $id,
                    'first_name' => trim($_POST['fname']),
                    'last_name' => trim($_POST['lname']),
                    'email' => trim($_POST['email']),
                    'role' => trim($_POST['role']),
                    'address' => trim($_POST['address']),
                    'mobile' => trim($_POST['mobile']),
                    'fname_err' => '',
                    'lname_err' => '',
                    'email_err' => '',
                    'role_err'  =>'',
                    'address_err'  =>'',
                    'mobile_err' => ''
                ];

              
                

                //validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }else{
 
                    if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){ //check email in correct formate

                        $data['email_err'] = 'Please enter valid email';
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

                //validate address
                if(empty($data['address'])){
                    $data['address_err'] = 'Please enter address';
                }


                if (empty($data['role'])) {
                    $data['role_err'] = 'Please select a role';
                }
                

                

                //validate mobile
                if(empty($data['mobile'])){
                    $data['mobile_err'] = 'Please enter mobile number';
                }else{

                    if(!preg_match("/^(?:\+?94)?(?:7\d{8})$/", $data['mobile'])){ //check mobile in correct formate, SriLanka

                        $data['mobile_err'] = 'Please enter valid mobile number';
 
                    }

                    
                }

                //Make sure errors are empty

                if(empty($data['email_err']) && empty($data['fname_err']) && empty($data['lname_err']) && empty($data['role_err']) && empty($data['address_err']) && empty($data['mobile_err'])){
                    //validated
                    

                    //update User

                    if($this->dashboardModel->updateStaff($data)){
                       
                        $_SESSION['staff_user_updated'] = true;
      
                       redirect('admin/staff');

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/admin/staff/updateStaff', $data);
                    
                    

                }


            }else{

                $staff_user =$this->dashboardModel-> getStaffUserById($id);


                if($staff_user -> staff_id == $_SESSION['user_id']){
                    redirect('admin/setting');
                }


                //init data
                $data = [
                    'id' => $id,
                    'first_name' => $staff_user->firstname,
                    'last_name' => $staff_user->lastname,
                    'email' => $staff_user->email,
                    'role' => $staff_user->role,
                    'address' => $staff_user->address,
                    'mobile' => $staff_user->phone,
                    'fname_err' => '',
                    'lname_err' => '',
                    'email_err' => '',
                    'role_err'  =>'',
                    'address_err'  =>'',
                    'mobile_err' => ''
                ];

                
                //load view
                $this->view('dashboards/admin/staff/updateStaff', $data);
            }
   
            
            
        }


        public function removeStaff($id){

            if( $id == $_SESSION['user_id']){
                redirect('admin/staff');
            }
            
            if($this->dashboardModel->removeStaffUser($id)){

                $_SESSION['staff_user_removed'] = true;
                redirect('admin/staff');

            }else{
                die("error in user delete model");
            }


        }







        /*==================  STAFF ============= 
        
        *Get staff details from database.
        *Give details to the array and send to the view
        
        */

        public function staff(){

            

            $staff_users = $this->dashboardModel->getStaffDetails();
            

        $data = [
            'staff' =>$staff_users
        ];

        
        $this->view('dashboards/admin/staff/staff', $data);


        
    }

    /*==================  Appointment ============= 
        
        *
        *Give details to the array and send to the view
        
        */


    public function appointment(){
        $appointment = $this->dashboardModel->getAppointments();

        $data =[
            'appointment' => $appointment
        ];

        $this->view('dashboards/admin/appointment/appointment',$data);
    }


    /*==================  pet owner  ============= 
        
        *
        *Give details to the array and send to the view
        
     */


        public function petowner(){

            $petowners = $this->dashboardModel-> getPetwonerDetails();

            $data = [
                'petowners' =>$petowners
            ];
    
            $this->view('dashboards/admin/petowner/petowner',$data);
        }

        public function UpdatePetowner($id){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data

                $data = [
                    'id' => $id,
                    'first_name' => trim($_POST['fname']),
                    'last_name' => trim($_POST['lname']),
                    'email' => trim($_POST['email']),
                    'address' => trim($_POST['address']),
                    'mobile' => trim($_POST['mobile']),
                    'fname_err' => '',
                    'lname_err' => '',
                    'email_err' => '',
                    'address_err'  =>'',
                    'mobile_err' => ''
                ];

              
                

                //validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }else{
 
                    if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){ //check email in correct formate

                        $data['email_err'] = 'Please enter valid email';
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

                //validate address
                if(empty($data['address'])){
                    $data['address_err'] = 'Please enter address';
                }


                if (empty($data['role'])) {
                    $data['role_err'] = 'Please select a role';
                }
                

                

                //validate mobile
                if(empty($data['mobile'])){
                    $data['mobile_err'] = 'Please enter mobile number';
                }else{

                    if(!preg_match("/^(?:\+?94)?(?:7\d{8})$/", $data['mobile'])){ //check mobile in correct formate, SriLanka

                        $data['mobile_err'] = 'Please enter valid mobile number';
 
                    }

                    
                }

                //Make sure errors are empty

                if(empty($data['email_err']) && empty($data['fname_err']) && empty($data['lname_err']) && empty($data['address_err']) && empty($data['mobile_err'])){
                    //validated
                    

                    //update User

                    if($this->dashboardModel->updatePetowner($data)){
                       
                        $_SESSION['petowner_updated'] = true;
      
                       redirect('admin/petowner');

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/admin/petowner/updatePetowner', $data);
                    
                    

                }


            }else{

                $petowner =$this->dashboardModel-> getPetownerDetailsById($id);

                

        
                if($petowner -> id == $_SESSION['user_id']){
                    redirect('admin/setting');
                }


                //init data
                $data = [
                    'id' => $id,
                    'first_name' => $petowner->first_name,
                    'last_name' => $petowner->last_name,
                    'email' => $petowner->email,
                    'address' => $petowner->address,
                    'mobile' => $petowner->mobile,
                    'fname_err' => '',
                    'lname_err' => '',
                    'email_err' => '',
                    'address_err'  =>'',
                    'mobile_err' => ''
                ];

                
                //load view
                $this->view('dashboards/admin/petowner/updatePetowner', $data);
            }
        }

        public function removePetowner($id){

            if( $id == $_SESSION['user_id']){
                redirect('admin/petowner');
            }
            
            if($this->dashboardModel->removePetowner($id)){
                // die('success');
                $_SESSION['petowner_removed'] = true;
                redirect('admin/petowner');

            }else{
                die("error in user delete model");
            }


        }

        

        /*==================  pet owner  ============= 
        
        *
        *Give details to the array and send to the view
        
        */

        public function pet(){
            $pet = $this->dashboardModel->getPetDetails();

            $data = [
                'pet' => $pet
            ];
            $this->view('dashboards/admin/pet/pet',$data);
        }
    


        public function updatePet($id){

            
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // die('succs');
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data

                $data = [
                    'id' => $id,
                    'petname' => trim($_POST['petname']),
                    'DOB' => trim($_POST['DOB']),
                    'species' => trim($_POST['species']),
                    'breed' => trim($_POST['breed']),
                    'sex' => trim($_POST['sex']),
                    'sex_err' => '',
                    'breed_err' => '',
                    'species_err' => '',
                    'DOB_err'  =>'',
                    'petname_err' => ''
                ];

              
                

                //validate petname
                if(empty($data['petname'])){
                    $data['petname_err'] = 'Please enter pet name';
                }

                //validate dob
                if(empty($data['DOB'])){
                    $data['DOB_err'] = 'Please enter date of birth';
                }

                //validate species
                if(empty($data['species'])){
                    $data['species_err'] = 'Please enter species';
                }

                //validate breed
                if(empty($data['breed'])){
                    $data['breed_err'] = 'Please enter breed';
                }


                if (empty($data['sex'])) {
                    $data['sex_err'] = 'Please select sex';
                }
                

                

                
                

                //Make sure errors are empty

                if(empty($data['sex_err']) && empty($data['breed_err']) && empty($data['species_err']) && empty($data['DOB_err']) && empty($data['petname_err'])){
                    //validated
                    

                    //update User

                    if($this->dashboardModel->updatePet($data)){
                       
                        $_SESSION['pet_updated'] = true;
      
                       redirect('admin/pet');

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/admin/pet/updatePet', $data);
                    
                    

                }


            }else{

              

                $pet =$this->dashboardModel->adminGetPetDetailsByID($id);

                

        
                


                //init data
                $data = [
                    'id' => $id,
                    'petname' =>$pet->pet,
                    'DOB' =>$pet->DOB,
                    'species' => $pet->species,
                    'breed' => $pet->breed,
                    'sex' => $pet->sex,
                    'sex_err' => '',
                    'breed_err' => '',
                    'species_err' => '',
                    'DOB_err'  =>'',
                    'petname_err' => ''
                ];

                
                //load view
                $this->view('dashboards/admin/pet/updatePet', $data);
            }
        }

     

        

        public function removePet($id){

            if($this->dashboardModel->removePetDetails($id)){
                // die('success');
                $_SESSION['pet_removed'] = true;
                redirect('admin/pet');

            }else{
                die("error in user delete model");
            }

        }



        /*================== Settings  ============= 
        
        *
        *Give details to the array and send to the view
        
        */

        public function settings($setting_name){
            
            //$user_id = ($_SESSION['user_id']);
            //$settingsData = $this->settingsModel->getSettingDetails($user_id);


            $setting_name_array = [
            
                'all',
                'profile',
                'email',
                'password',
                'mobile',
                
                'appointmentPrice',
                'time',

                'cage'
            
            ];
    
            //check user intensionally going to wrong url
            if(!in_array($setting_name, $setting_name_array)){
                redirect('admin/notfound');
            }


            //================ all use to show all settings =========================//    
        if($setting_name == "all"){


            $data = null;
            $this->view('dashboards/admin/setting/settings', $data);

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
                           redirect('admin/settings/all');
        
                        }else{

                            //update error : can be database error
                            $_SESSION['notification'] = "error";
                            $_SESSION['notification_msg'] = "Please review and try again";
                            redirect('admin/settings/all');
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
                        redirect('admin/settings/all');
                    }else{
                        //update error : can be database error
                        $_SESSION['notification'] = "error";
                        $_SESSION['notification_msg'] = "Password update failed";
                        redirect('admin/settings/all');
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


                            redirect('admin/settings/all');
                        }else{


                            //update error : can be database error
                            $_SESSION['notification'] = "error";
                            $_SESSION['notification_msg'] = "Email update failed";

                            unset($_SESSION['otp']);
                            unset($_SESSION['otp_status']);

                            redirect('admin/settings/all');
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


                            redirect('admin/settings/all');
                        }else{


                            //update error : can be database error
                            $_SESSION['notification'] = "error";
                            $_SESSION['notification_msg'] = "Mobile Number Update Failed";

                            unset($_SESSION['otp_sms']);
                            unset($_SESSION['otp_status_sms']);

                            redirect('admin/settings/all');
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


        }elseif($setting_name == "time"){

            $time_slots = $this->dashboardModel->getTimeSlots();


            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $data = [

                    'main_err' =>'',

                    'monday_m_start' => trim($_POST['monday_m_start']),
                    'monday_m_end' => trim($_POST['monday_m_end']),
                    'monday_a_start' => trim($_POST['monday_a_start']),
                    'monday_a_end' => trim($_POST['monday_a_end']),
                    'monday_m_gap' => trim($_POST['monday_m_gap']),
                    'monday_a_gap' => trim($_POST['monday_a_gap']),
                    'monday_err'   => '',
                    'monday_m_err' => '',
                    'monday_a_err' => '',

                    'tuesday_m_start' => trim($_POST['tuesday_m_start']),
                    'tuesday_m_end' => trim($_POST['tuesday_m_end']),
                    'tuesday_a_start' => trim($_POST['tuesday_a_start']),
                    'tuesday_a_end' => trim($_POST['tuesday_a_end']),
                    'tuesday_err'   => '',
                    'tuesday_m_gap' => trim($_POST['tuesday_m_gap']),
                    'tuesday_a_gap' => trim($_POST['tuesday_a_gap']),
                    'tuesday_m_err' =>'',
                    'tuesday_a_err' => '',

                    'wednesday_m_start' => trim($_POST['wednesday_m_start']),
                    'wednesday_m_end' => trim($_POST['wednesday_m_end']),
                    'wednesday_a_start' => trim($_POST['wednesday_a_start']),
                    'wednesday_a_end' => trim($_POST['wednesday_a_end']),
                    'wednesday_err'   => '',
                    'wednesday_m_gap' => trim($_POST['wednesday_m_gap']),
                    'wednesday_a_gap' => trim($_POST['wednesday_a_gap']),
                    'wednesday_m_err' => '',
                    'wednesday_a_err' => '',

                    'thursday_m_start' => trim($_POST['thursday_m_start']),
                    'thursday_m_end' => trim($_POST['thursday_m_end']),
                    'thursday_a_start' => trim($_POST['thursday_a_start']),
                    'thursday_a_end' => trim($_POST['thursday_a_end']),
                    'thursday_err'   => '',
                    'thursday_m_gap' => trim($_POST['thursday_m_gap']),
                    'thursday_a_gap' => trim($_POST['thursday_a_gap']),
                    'thursday_m_err' => '',
                    'thursday_a_err' => '',

                    'friday_m_start' => trim($_POST['friday_m_start']),
                    'friday_m_end' => trim($_POST['friday_m_end']),
                    'friday_a_start' => trim($_POST['friday_a_start']),
                    'friday_a_end' => trim($_POST['friday_a_end']),
                    'friday_err'   => '',
                    'friday_m_gap' => trim($_POST['friday_m_gap']),
                    'friday_a_gap' => trim($_POST['friday_a_gap']),
                    'friday_m_err' => '',
                    'friday_a_err' => '',

                    'saturday_m_start' => trim($_POST['saturday_m_start']),
                    'saturday_m_end' => trim($_POST['saturday_m_end']),
                    'saturday_a_start' => trim($_POST['saturday_a_start']),
                    'saturday_a_end' => trim($_POST['saturday_a_end']),
                    'saturday_err'   => '',
                    'saturday_m_gap' => trim($_POST['saturday_m_gap']),
                    'saturday_a_gap' => trim($_POST['saturday_a_gap']),
                    'saturday_m_err' => '',
                    'saturday_a_err' => '',

                    'sunday_m_start' => trim($_POST['sunday_m_start']),
                    'sunday_m_end' => trim($_POST['sunday_m_end']),
                    'sunday_a_start' => trim($_POST['sunday_a_start']),
                    'sunday_a_end' => trim($_POST['sunday_a_end']),
                    'sunday_err'   => '',
                    'sunday_m_gap' => trim($_POST['sunday_m_gap']),
                    'sunday_a_gap' => trim($_POST['sunday_a_gap']),
                    'sunday_m_err' => '',
                    'sunday_a_err' => '',

                ];
                //check all days gaps
                if(empty($data['monday_m_gap']) || empty($data['monday_a_gap']) || empty($data['tuesday_m_gap']) || empty($data['tuesday_a_gap']) || empty($data['wednesday_m_gap']) || empty($data['wednesday_a_gap']) || empty($data['thursday_m_gap']) || empty($data['thursday_a_gap']) || empty($data['friday_m_gap']) || empty($data['friday_a_gap']) || empty($data['saturday_m_gap']) && empty($data['saturday_a_gap']) || empty($data['sunday_m_gap']) || empty($data['sunday_a_gap']) ){
                    $data['main_err'] = '*Please Fill All the Input Fields';
                }

                
                //validation to gap

                if(empty($data['monday_m_gap']) ){

                    $data['monday_m_err'] = '*err';
                    $data['monday_err']  = "*Please enter gap";

                }else{

                    if($data['monday_m_gap'] < 15 || $data['monday_m_gap'] > 60){
                        $data['monday_m_err'] = 'err';
                        $data['monday_err']  = "*Please enter gap between 15 to 60 minutes";
                    }
                }

                if(empty($data['monday_a_gap']) ){

                    $data['monday_a_err'] = 'err';
                    $data['monday_err']  = "*Please enter gap";

                }else{

                    if($data['monday_a_gap'] < 15 || $data['monday_a_gap'] > 60){
                        $data['monday_a_err'] = 'err';
                        $data['monday_err']  = "*Please enter gap between 15 to 60 minutes";
                    }
                }

                if(empty($data['tuesday_m_gap']) ){

                    $data['tuesday_m_err'] = 'err';
                    $data['tuesday_err']  = "*Please enter gap";

                }else{

                    if($data['tuesday_m_gap'] < 15 || $data['tuesday_m_gap'] > 60){
                        $data['tuesday_m_err'] = 'err';
                        $data['tuesday_err']  = "*Please enter gap between 15 to 60 minutes";
                    }
                }


                if(empty($data['tuesday_a_gap']) ){

                    $data['tuesday_a_err'] = 'err';
                    $data['tuesday_err']  = "*Please enter gap";

                }else{

                    if($data['tuesday_a_gap'] < 15 || $data['tuesday_a_gap'] > 60){
                        $data['tuesday_a_err'] = 'err';
                        $data['tuesday_err']  = "*Please enter gap between 15 to 60 minutes";
                    }
                }

                
                if(empty($data['wednesday_m_gap']) ){

                    $data['wednesday_m_err'] = 'err';
                    $data['wednesday_err']  = "*Please enter gap";

                }else{

                    if($data['wednesday_m_gap'] < 15 || $data['wednesday_m_gap'] > 60){
                        $data['wednesday_m_err'] = 'err';
                        $data['wednesday_err']  = "*Please enter gap between 15 to 60 minutes";
                    }
                }


                if(empty($data['wednesday_a_gap']) ){

                    $data['wednesday_a_err'] = 'err';
                    $data['wednesday_err']  = "*Please enter gap";

                }else{

                    if($data['wednesday_a_gap'] < 15 || $data['wednesday_a_gap'] > 60){
                        $data['wednesday_a_err'] = 'err';
                        $data['wednesday_err']  = "*Please enter gap between 15 to 60 minutes";
                    }
                }


                if(empty($data['thursday_m_gap']) ){

                    $data['thursday_m_err'] = 'err';
                    $data['thursday_err']  = "*Please enter gap";

                }else{

                    if($data['thursday_m_gap'] < 15 || $data['thursday_m_gap'] > 60){
                        $data['thursday_m_err'] = 'err';
                        $data['thursday_err']  = "*Please enter gap between 15 to 60 minutes";
                    }
                }


                if(empty($data['thursday_a_gap']) ){

                    $data['thursday_a_err'] = 'err';
                    $data['thursday_err']  = "*Please enter gap";
                
                }else{

                    if($data['thursday_a_gap'] < 15 || $data['thursday_a_gap'] > 60){
                        $data['thursday_a_err'] = 'err';
                        $data['thursday_err']  = "*Please enter gap between 15 to 60 minutes";
                    }
                }


                if(empty($data['friday_m_gap']) ){

                    $data['friday_m_err'] = 'err';
                    $data['friday_err']  = "*Please enter gap";

                }else{
                    
                    if($data['friday_m_gap'] < 15 || $data['friday_m_gap'] > 60){
                        $data['friday_m_err'] = 'err';
                        $data['friday_err']  = "*Please enter gap between 15 to 60 minutes";
                    }
                }


                if(empty($data['friday_a_gap']) ){

                    $data['friday_a_err'] = 'err';
                    $data['friday_err']  = "*Please enter gap";

                }else{

                    if($data['friday_a_gap'] < 15 || $data['friday_a_gap'] > 60){
                        $data['friday_a_err'] = 'err';
                        $data['friday_err']  = "*Please enter gap between 15 to 60 minutes";
                    }
                }


                if(empty($data['saturday_m_gap']) ){

                    $data['saturday_m_err'] = 'err';
                    $data['saturday_err']  = "*Please enter gap";

                }else{

                    if($data['saturday_m_gap'] < 15 || $data['saturday_m_gap'] > 60){
                        $data['saturday_m_err'] = 'err';
                        $data['saturday_err']  = "*Please enter gap between 15 to 60 minutes";
                    }
                }


                if(empty($data['saturday_a_gap']) ){

                    $data['saturday_a_err'] = 'err';
                    $data['saturday_err']  = "*Please enter gap";

                }else{

                    if($data['saturday_a_gap'] < 15 || $data['saturday_a_gap'] > 60){
                        $data['saturday_a_err'] = 'err';
                        $data['saturday_err']  = "*Please enter gap between 15 to 60 minutes";
                    }
                }


                if(empty($data['sunday_m_gap']) ){

                    $data['sunday_m_err'] = 'err';
                    $data['sunday_err']  = "*Please enter gap";

                }else{

                    if($data['sunday_m_gap'] < 15 || $data['sunday_m_gap'] > 60){
                        $data['sunday_m_err'] = 'err';
                        $data['sunday_err']  = "*Please enter gap between 15 to 60 minutes";
                    }
                }


                if(empty($data['sunday_a_gap']) ){

                    $data['sunday_a_err'] = 'err';
                    $data['sunday_err']  = "*Please enter gap";
                
                }else{

                    if($data['sunday_a_gap'] < 15 || $data['sunday_a_gap'] > 60){
                        $data['sunday_a_err'] = 'err';
                        $data['sunday_err']  = "*Please enter gap between 15 to 60 minutes";
                    }
                }

                //check errors free

                if (
                    empty($data['monday_m_err']) &&
                    empty($data['monday_a_err']) &&
                    empty($data['tuesday_m_err']) &&
                    empty($data['tuesday_a_err']) &&
                    empty($data['wednesday_m_err']) &&
                    empty($data['wednesday_a_err']) &&
                    empty($data['thursday_m_err']) &&
                    empty($data['thursday_a_err']) &&
                    empty($data['friday_m_err']) &&
                    empty($data['friday_a_err']) &&
                    empty($data['saturday_m_err']) &&
                    empty($data['saturday_a_err']) &&
                    empty($data['sunday_m_err']) &&
                    empty($data['sunday_a_err']) &&
                    empty($data['main_err'])
                ) {

                    //update time slots
                    if($this->settingsModel->updateTimeSlots($data)){

                        //for notification
                        $_SESSION['notification'] = "ok";
                        $_SESSION['notification_msg'] = "Time slots have been updated successfully.";
                        redirect('admin/settings/all');
                    }else{
                        //update error : can be database error
                        $_SESSION['notification'] = "error";
                        $_SESSION['notification_msg'] = "Time slots update failed";
                        redirect('admin/settings/all');
                    }
                   
                }else{

                    //load witth error
                    $this->view('dashboards/admin/setting/time_settings', $data);

                }
                




                





            }else{

                
            $data =[
                'monday_m_start' => $time_slots[0]->start_time,
                'monday_m_end' => $time_slots[0]->end_time,
                'monday_a_start' => $time_slots[1]->start_time,
                'monday_a_end' => $time_slots[1]->end_time,
                'monday_m_gap' => $time_slots[0]->intervel,
                'monday_a_gap' => $time_slots[1]->intervel,
                'monday_err'   => '',
                'monday_m_err' => '',
                'monday_a_err' => '',

                'tuesday_m_start' => $time_slots[2]->start_time,
                'tuesday_m_end' => $time_slots[2]->end_time,
                'tuesday_a_start' => $time_slots[3]->start_time,
                'tuesday_a_end' => $time_slots[3]->end_time,
                'tuesday_err'   => '',
                'tuesday_m_gap' => $time_slots[2]->intervel,
                'tuesday_a_gap' => $time_slots[3]->intervel,
                'tuesday_m_err' =>'',
                'tuesday_a_err' => '',


                'wednesday_m_start' => $time_slots[4]->start_time,
                'wednesday_m_end' => $time_slots[4]->end_time,
                'wednesday_a_start' => $time_slots[5]->start_time,
                'wednesday_a_end' => $time_slots[5]->end_time,
                'wednesday_err'   => '',
                'wednesday_m_gap' => $time_slots[4]->intervel,
                'wednesday_a_gap' => $time_slots[5]->intervel,
                'wednesday_m_err' => '',
                'wednesday_a_err' => '',

                'thursday_m_start' => $time_slots[6]->start_time,
                'thursday_m_end' => $time_slots[6]->end_time,
                'thursday_a_start' => $time_slots[7]->start_time,
                'thursday_a_end' => $time_slots[7]->end_time,
                'thursday_err'   => '',
                'thursday_m_gap' => $time_slots[6]->intervel,
                'thursday_a_gap' => $time_slots[7]->intervel,
                'thursday_m_err' => '',
                'thursday_a_err' => '',


                'friday_m_start' => $time_slots[8]->start_time,
                'friday_m_end' => $time_slots[8]->end_time,
                'friday_a_start' => $time_slots[9]->start_time,
                'friday_a_end' => $time_slots[9]->end_time,
                'friday_err'   => '',
                'friday_m_gap' => $time_slots[8]->intervel,
                'friday_a_gap' => $time_slots[9]->intervel,
                'friday_m_err' => '',
                'friday_a_err' => '',

                'saturday_m_start' => $time_slots[10]->start_time,
                'saturday_m_end' => $time_slots[10]->end_time,
                'saturday_a_start' => $time_slots[11]->start_time,
                'saturday_a_end' => $time_slots[11]->end_time,
                'saturday_err'   => '',
                'saturday_m_gap' => $time_slots[10]->intervel,
                'saturday_a_gap' => $time_slots[11]->intervel,
                'saturday_m_err' => '',
                'saturday_a_err' => '',

                'sunday_m_start' => $time_slots[12]->start_time,
                'sunday_m_end' => $time_slots[12]->end_time,
                'sunday_a_start' => $time_slots[13]->start_time,
                'sunday_a_end' => $time_slots[13]->end_time,
                'sunday_err'   => '',
                'sunday_m_gap' => $time_slots[12]->intervel,
                'sunday_a_gap' => $time_slots[13]->intervel,
                'sunday_m_err' => '',
                'sunday_a_err' => '',

                'main_err' => ''

            
            ];

            $this->view('dashboards/admin/setting/time_settings', $data);



            }




            
            



        }elseif($setting_name == "appointmentPrice"){

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $priceDetails = $this->settingsModel->getPrice();

                $data = [

                    'main_err' =>'',

                    'appointment_price' => trim($_POST['appointment_price']),
                    'price_id' => '',
                    'price_err' => '',
                ];

                if(empty($data['appointment_price'])){
                    $data['price_err'] = '*Please enter price';
                }else{
                    if($data['appointment_price'] < 0){
                        $data['price_err'] = '*Please enter valid price';
                    }
                }

                //convert to cents LKR


                if(empty($data['price_err'])){

    
                  

                    // Assuming $data['appointment_price'] is the new price in dollars
                    $newPriceAmount = $data['appointment_price'] * 100; // Convert to cents
                    
                    $product_id = 'prod_P6nXOUvTK1HWrE'; // Replace with the actual product ID
                    $currency = 'lkr'; 
                    
                    require __DIR__ . '/../libraries/stripe/vendor/autoload.php';
                    
                    \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
                    
                    try {

                       


                        // Create a new price
                        $newPrice = \Stripe\Price::create([
                            'product' => $product_id,
                            'unit_amount' => $newPriceAmount,
                            'currency' => $currency,
                            // You can add more optional parameters here, such as metadata, nickname, etc.
                        ]);
                    
                        // Retrieve the ID of the newly created price
                        $newPriceId = $newPrice->id;
                        $data['price_id'] = $newPriceId;

                         // Retrieve the price
                         $preprice = \Stripe\Price::retrieve($priceDetails->price_id);

                         // Archive the price
                         $preprice->active = false; // Set 'active' to false to archive the price
                         $preprice->save();

                        //update new price id to database
                        $this->settingsModel->updatePrice($data);
                    
                        // Handle successful price creation
                        $_SESSION['notification'] = "ok";
                        $_SESSION['notification_msg'] = "Price has been updated successfully.";
                        redirect('admin/settings/all');
                    } catch (\Stripe\Exception\ApiErrorException $e) {
                        // Handle API error
                        $_SESSION['notification'] = "error";
                        $_SESSION['notification_msg'] = "Error creating new price: ";
                        redirect('admin/settings/all');
                    }
                    
      

                   
                   
                }else{

                    //load witth error
                    $this->view('dashboards/admin/setting/price_settings', $data);

                }
                
            }else{
                
                $price = $this->settingsModel->getPrice();

                $data = [
                    'appointment_price' => $price->price,
                    'price_err' => '',
                    'main_err' => ''
                ];

                $this->view('dashboards/admin/setting/price_settings', $data);
         
            }


        }elseif($setting_name = "cage"){

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $data = [


                    'cageCount' => trim($_POST['cage']),
                    'cage_err' => '',
                ];

                $cageCount = $this->doctorModel->getCageCountAll();

                if(empty($data['cageCount'])){
                    $data['cage_err'] = '*Please enter cage count';
                }elseif($data['cageCount'] < 0){
                    $data['cage_err'] = '*Please enter valid cage count';
                }else{

                    $newCageCount = $data['cageCount'];

                    if($newCageCount > count($cageCount)){

                        $newCageCount = $newCageCount - count($cageCount);

                        for($i = 0; $i < $newCageCount; $i++){
                            $this->settingsModel->addCage();
                        }

                       
                        $_SESSION['notification'] = "ok";
                        $_SESSION['notification_msg'] = "Cage has been updated successfully.";
                        redirect('admin/settings/all');


                       

                        

                    }else{

                        $newCageCount = count($cageCount) - $newCageCount;

                        for($i = 0; $i < $newCageCount; $i++){
                            $this->settingsModel->deleteCage();
                        }

                    
                        $_SESSION['notification'] = "ok";
                        $_SESSION['notification_msg'] = "Cage has been updated successfully.";
                        redirect('admin/settings/all');
                    }
                }


                



            }else{
                $cageCount = $this->doctorModel->getCageCountAll();

                $data = [
                    'cageCount' => count($cageCount),
                    'cage_err' => ''
                ];

                $this->view('dashboards/admin/setting/cage_settings', $data);
            }
        }




            
            
            
           /* 

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($_POST['formType'] == 1){
                    // die ($_POST['formType']);
                    $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                    $data = [
                        'id' =>$user_id,
                        'first_name' => trim($_POST['fname']),
                        'last_name' => trim($_POST['lname']),
                        'mobile' =>trim($_POST['mobile']),
                        'nic' => trim($_POST['nic']),
                        'address' => trim($_POST['address']),
                        'email' => trim($_POST['email']),
                        'firstname_err' => '',
                        'lastname_err' => '',
                        'email_err' => '',
                        'mobile_err' => '',
                        'nic_err' => '',
                        'address_err' => '',
                        'password_err' =>'',
                        'new_password_err' => '',
                        'new_confirm_password_err' => '',
                        'password' =>'',
                        'new_password' => '',
                        'new_confirm_password' => '',
                        'fb_url' => '',
                        'insta_url' => '',
                        'twitter_url' => '',
                        'formType' => '1',
                        'settings' => $settingsData
                       





                    ];

                    // if($_POST['profile-button'])

                    

                    if(empty($data['first_name'])){
                        $data['firstname_err'] = 'Please enter first name';
                    }

                    //validate lName
                    if(empty($data['last_name'])){
                        $data['lastname_err'] = 'Please enter last name';
                    }

                    if(empty($data['address'])){
                        $data['address_err'] = 'Please enter address';
                    }

                    if(empty($data['nic'])){
                        $data['nic_err'] = 'Please enter nic';
                    }

                    if(empty($data['mobile'])){
                        $data['mobile_err'] = 'Please enter mobile number';
                    }
                    // }else{
                    //     if (!preg_match("/^94\d{9}$/", $data['mobile'])) {
                    //         // Check mobile in correct format, Sri Lanka
                    //         $data['mobile_err'] = 'Please enter a valid Sri Lankan mobile number starting with 94';
                    //     } elseif ($this->userModel->findStaffUserByMobile($data['mobile'])) {
                    //         // Check if mobile number is already taken in the DB
                    //         $data['mobile_err'] = 'Mobile number is already taken';
                    //     }
                        
                

                        
                    // }

                    
                    if(empty($data['email_err']) && empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['nic_err']) && empty($data['address_err']) && empty($data['mobile_err'])){
                        //validated
                        
                        
                        //Regster User

                        if($this->dashboardModel->updateSettings1($data)){
                            
                            // die ($data['password']);
                            
                            redirect('admin/settings');

                        }else{
                            die("Something went wrong");
                        }



                    }else{
                        // die ('eroor noted');
                        //load view with errors
                        $this->view('dashboards/admin/setting/settings',$data);
                        
                        
                        

                    }
                }elseif($_POST['formType'] == 2){
                    // die ($_POST['formType']);
                    $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                    $data = [
                        'id' =>$user_id,
                        'password' =>trim($_POST['password']),
                        'new_password' => trim($_POST['new_password']),
                        'new_confirm_password' => trim($_POST['new_confirm_password']),
                        'password_err' =>'',
                        'new_password_err' => '',
                        'new_confirm_password_err' => '',
                        'firstname_err' => '',
                        'lastname_err' => '',
                        'email_err' => '',
                        'mobile_err' => '',
                        'nic_err' => '',
                        'address_err' => '',
                        'fb_url' => '',
                        'insta_url' => '',
                        'twitter_url' => '',
                        'first_name' => '',
                        'last_name' => '',
                        'mobile' =>'',
                        'nic' => '',
                        'address' => '',
                        'email' => '',
                       
                    ];
            
                    if (isset($data['password'])) {
                        $hashedPassword = $this->settingsModel->getPasswordById($user_id);
                    
                        if (password_verify($data['password'], $hashedPassword)) {
                            if (!empty($data['new_password'])) {
                                if (strlen($data['new_password']) < 8) {
                                    $data['new_password_err'] = 'Password must be at least 8 characters';
                                }
                            } else {
                                $data['new_password_err'] = 'Enter the new password';
                            }
                    
                            if (!empty($data['new_confirm_password'])) {
                                if ($data['new_password'] != $data['new_confirm_password']) {
                                    $data['new_confirm_password_err'] = 'Passwords do not match';
                                }
                            } else {
                                $data['new_confirm_password_err'] = 'Retype the new password';
                            }
                    
                        } else {
                            $data['password_err'] = 'Enter the correct Password';
                        }
                    }


                    // die ($data['new_confirm_password_err']);

                    if((empty($data['password_err'])  && empty($data['new_password_err'])  && empty($data['new_confirm_password_err']))){
                        //validated
                        //hash password
                        $data['password'] = password_hash($data['new_password'],PASSWORD_DEFAULT);
                            
                        
                        // die ('succss');
                        //Regster User

                        if($this->dashboardModel->updateSettings2($data)){
                            
                            // die ($data['password']);
                            
                            redirect('admin/settings');

                        }else{
                            die("Something went wrong");
                        }



                    }else{
                        //load view with errors
                        
                        $this->view('dashboards/admin/setting/settings',$data);
                        

                    }


                }

                elseif($_POST['formType'] == 3){
                    // die ($_POST['formType']);
                    $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                    $data = [
                        'fb_url' => trim($_POST['fb_url']),
                        'insta_url' => trim($_POST['insta_url']),
                        'twitter_url' => trim($_POST['twitter_url']),
                        'formType' => '3',
                        'password_err' =>'',
                        'new_password_err' => '',
                        'new_confirm_password_err' => '',
                        'firstname_err' => '',
                        'lastname_err' => '',
                        'email_err' => '',
                        'mobile_err' => '',
                        'nic_err' => '',
                        'address_err' => '',
                        'first_name' => '',
                        'last_name' => '',
                        'mobile' =>'',
                        'nic' => '',
                        'address' => '',
                        'email' => '',
                        'password' =>'',
                        'new_password' => '',
                        'new_confirm_password' => '',
                        
                        'settings' => $settingsData
                    ];
            
                    

                   if(!empty($data['fb_url']) || !empty($data['twitter_url']) || !empty($data['insta_url'])){
                        if($this->dashboardModel->updateSettings3($data)){
                            redirect('admin/settings');
                        }else{

                            die("Something went wrong");
                            
                        }


                   }else{
                    //load view with errors
                        
                        $this->view('dashboards/admin/setting/settings',$data);
                        
                   }


                        
                       
                        

                    


                }
                
            }else{
                // die ("not updated");
                

                $data = [
                    'id' =>$user_id,
                    'first_name' => $settingsData->firstname,
                    'last_name' => $settingsData->lastname,
                    'mobile' =>$settingsData->phone,
                    'nic' => $settingsData->email,
                    'address' => $settingsData->address,
                    'email' => $settingsData->email,
                    'fb_url' => $settingsData->fb_url,
                    'insta_url' => $settingsData->insta_url,
                    'twitter_url' => $settingsData->x_url,
                    'password' => '',
                    'new_password' => '',
                    'firstname_err' => '',
                    'lastname_err' => '',
                    'email_err' => '',
                    'mobile_err' => '',
                    'nic_err' => '',
                    'address_err' => '',
                    'password_err' =>'',
                    'new_password_err' => '',
                    'new_confirm_password_err' => '',
                    
      
                
                ];
                $this->view('dashboards/admin/setting/settings',$data);
                // print_r($data['settings']->firstname);

                //load view
                //need to change
                
            }
            */


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

        public function report(){

            $salesMonth = $this->reportModel->getSalesMonth();
            $salesYear = $this->reportModel->getSalesYear();

            foreach($salesMonth as $sale){
                $labelsMonth[] = $sale->month_year;
                $dataMonth[] = $sale->monthly_sales;
            }

            foreach($salesYear as $sale){
                $labelsYear[] = $sale->year;
                $dataYear[] = $sale->yearly_sales;
            }

            $appointmentRevenueMonth = $this->reportModel->getAppointmentRevenueMonth();
            $appointmentRevenueYear = $this->reportModel->getAppointmentRevenueYear();

            foreach($appointmentRevenueMonth as $appointment){
                $labelsAppointmentMonth[] = $appointment->month_year;
                $dataAppointmentMonth[] = $appointment->monthly_revenue;
            }

            foreach($appointmentRevenueYear as $appointment){
                $labelsAppointmentYear[] = $appointment->year;
                $dataAppointmentYear[] = $appointment->yearly_revenue;
            }


           

            $data = [
                'labelsSalesMonth' => $labelsMonth,
                'dataSalesMonth' => $dataMonth,

                'labelsSalesYear' => $labelsYear,
                'dataSalesYear' => $dataYear,

                'labelsAppointmentMonth' => $labelsAppointmentMonth,
                'dataAppointmentMonth' => $dataAppointmentMonth,

                'labelsAppointmentYear' => $labelsAppointmentYear,
                'dataAppointmentYear' => $dataAppointmentYear
            ];


            $this->view('dashboards/admin/report/report',$data);
        }

        public function profileStaff($id){
            
              
            $user = $this->dashboardModel->getStaffUserById($id);

            $data = [
                    'user' =>$user
            ];

            
            $this->view('dashboards/common/profile', $data);
        }

        public function profilePetowner($id){
            
              
            $user = $this->dashboardModel->getPetownerDetailsById($id);

            $data = [
                    'user' =>$user
            ];

            
            $this->view('dashboards/common/profile', $data);
        }
       


       


        

}