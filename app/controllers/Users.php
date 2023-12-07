<?php

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

                    if(!preg_match("/^(?:\+?94)?(?:7\d{8})$/", $data['mobile'])){ //check mobile in correct formate, SriLanka

                        $data['mobile_err'] = 'Please enter valid mobile number';
 
                    }elseif($this->userModel->findUserByMobile($data['mobile'])){  //check mobile in the DB
                        
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
                //process form
            }else{

                //init data
                $data = [
                    
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => ''   
                ];

                //load view
                $this->view('auth/forgotPassword',$data);
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
            $_SESSION['user_role'] = 'Pet Owner';

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

}