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

            $data =[
                'settings' => $settingsData
            ];
            $this->view('dashboards/admin/setting/settings',$data);
            // print_r($data['settings']->firstname);
        }

        public function report(){
            $data = null;
            $this->view('dashboards/admin/report/report',$data);
        }

        public function editSettings($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'id' =>$id,
                    'firstname' => trim($_POST['fname']),
                    'lastname' => trim($_POST['lname']),
                    'mobile' =>trim($_POST['mobile']),
                    'nic' => trim($_POST['nic']),
                    'address' => trim($_POST['address']),
                    'email' => trim($_POST['email']),
                    'firstname_err' => '',
                    'lastname_err' => '',
                    'email_err' => '',
                    'mobile_err' => '',
                    'nic_err' => '',
                    'address_err' => ''


                ];

                if(empty($data['first_name'])){
                    $data['fname_err'] = 'Please enter first name';
                }

                //validate lName
                if(empty($data['last_name'])){
                    $data['lname_err'] = 'Please enter last name';
                }

                if(empty($data['address'])){
                    $data['address_err'] = 'Please enter address';
                }

                if(empty($data['nic'])){
                    $data['nic_err'] = 'Please enter nic';
                }

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
                if(empty($data['email_err']) && empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['nic_err']) && empty($data['address_err'])   && empty($data['mobile_err'])){
                    //validated
                    
                    //hash password
                    // $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                    //Regster User

                    if($this->dashboardModel->updateStaff($data)){
                       
                       
                        echo 'updated';
                       redirect('dashboard/admin/setting/settings');

                    }else{
                        die("Something went wrong");
                    }



                }else{
                    //load view with errors
                    $this->view('dashboard/admin/settin/settings',$data);
                    
                    

                }

                
            }else{
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
                //need to change
                $this->view('dashboard/admin/setting/settings',$data);
            }
        }


        

}