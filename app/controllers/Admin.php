<?php

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

        $data =null;

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

        public function UpdatePetowner(){

            
            $data = null;

            $this->view('dashboards/admin/petowner/updatePetowner',$data);
        }


        /*==================  pet owner  ============= 
        
        *
        *Give details to the array and send to the view
        
        */

        public function pet(){
            $data = null;
            $this->view('dashboards/admin/pet/pet',$data);
        }


        public function Updatepet(){
            $data = null;
            $this->view('dashboards/admin/pet/updatePet',$data);
        }



        /*================== Settings  ============= 
        
        *
        *Give details to the array and send to the view
        
        */

        public function settings(){
            
            $user_id = ($_SESSION['user_id']);
            $settingsData = $this->settingsModel->getSettingDetails($user_id);

            
            
            
            

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



        }

        public function report(){
            $data = null;
            $this->view('dashboards/admin/report/report',$data);
        }

       


        

}