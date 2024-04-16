<?php

    class Assistant extends Controller {

        public function __construct(){
           
            if(!isset($_SESSION['user_id'])){
                
                redirect('users/staff');

            }else{


                if($_SESSION['user_role'] != "Assistant"){

                    // Unauthorized access
                    redirect('users/staff');
                     
                }
            }

            $this->settingsModel= $this->model('Settings') ;
            $this->assistantModel = $this->model('AssistantModel');

        }

        

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        public function index(){

            $data =null;
   
            
            $this->view('dashboards/assistant/index',$data);
        }

        public function appointment(){
            $appointmentDetails = $this -> assistantModel ->getAppointmentDetails();

            $data = [
                'appointment'=> $appointmentDetails
            ];
   
   
            
            $this->view('dashboards/assistant/appointment/appointment',$data);
        }

        public function confirmAppointment($appointmentID){
         if($this -> assistantModel ->updateAppointmentStatusToConfirm($appointmentID)){
            $_SESSION['notification'] = "ok";
            $_SESSION['notification_msg'] = "Appointment confirmation Successful.";
            redirect('assistant/appointment');
         } else{ die("something went wrong");

         }
         
        }


        
        public function rejectedAppointment($appointmentID){
            if($this -> assistantModel ->updateAppointmentStatusToReject($appointmentID)){
                $_SESSION['notification'] = "ok";
                        $_SESSION['notification_msg'] = "Appointment Rejection Successful.";
               redirect('assistant/appointment');
            } else{ die("something went wrong");
   
            }
            
           }
        

        

        public function petowner(){

            $petownerDetails = $this ->assistantModel->getPetownerDetails();
            $data = [
                'petowner'=> $petownerDetails
            ];
   
            
            $this->view('dashboards/assistant/petowner/petowner',$data);
        }


        
       
         
         public function addAppointment(){
             $data =null;
 
            $this->view('dashboards/assistant/petowner/addPetowner',$data);


            }

            

        public function addPetowner(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                    $data = [
                        'firstname' => trim($_POST['firstname']),
                        'lastname' => trim($_POST['lastname']),
                        'address' => trim($_POST['address']),
                        'email' => trim($_POST['email']),
                        'mobile' => trim($_POST['mobile']),
                        'firstname_err' => '',
                        'lastname_err' => '',
                        'address_err' =>'',
                        'email_err' => '',
                        'mobile_err' => '',
                        'password'=> '',
                    ];

                    //validate pName
                    if(empty($data['firstname'])){
                        $data['firstname_err'] = 'Please enter first Name';
                    }   

                     //validate pName
                     if(empty($data['lastname'])){
                        $data['lastname_err'] = 'Please enter last Name';
                    } 

                    //validate address
                    if(empty($data['address'])){
                        $data['address_err']= 'Please enter address';
                    }


                    //validate Email
                    if(empty($data['email'])){

                        $data['email_err'] = 'Please enter email';

                    }else{
 
                        if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){ //check email in correct formate

                            $email=$this->assistantModel->findEmail($data['email']);//check database 

                            if($email){
                                $data['email_err'] = 'email already taken';
                            }
                           
                        }else{  //check email in the DB
                        
                             $data['email_err'] = 'Email is not valid';
 
                        }


                    }


                    //validate mobile
                    if(empty($data['mobile'])){

                        $data['mobile_err'] = 'Please enter mobile';
                        
                    }else{
 
                        if(preg_match("/^94\d{9}$/", $data['mobile'])){ //check email in correct formate

                            $mobile=$this->assistantModel->findMobile($data['mobile']);//check database 

                            if($mobile){
                                $data['mobile_err'] = 'mobile already taken';
                            }
                           
                        }else{  //check email in the DB
                        
                             $data['mobile_err'] = 'mobile is not valid';
 
                        }


                    }
                    

                    if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['email_err'])  && empty($data['mobile_err']) && empty($data['address_err'])  ){

                                        //validated
                                    
                                    //mobile number set as password
                                    $data['password'] = password_hash($data['mobile'],PASSWORD_DEFAULT);
                                    

                                    //Regster User

                                    if($this->assistantModel->addpetowner($data)){
                                    
                                      
                    
                                    redirect('assistant/petowner');

                                    }else{
                                        die("Something went wrong");
                                    }


                    }else{
                        $this->view('dashboards/assistant/petowner/addPetowner',$data);//load with errors  
                    }
                    
                    
                    
                    
    
 
                

            }else{//form eken submit krnne nthuw normal load wena ek

                $data = [
                    'firstname' => '',
                    'lastname' => '',
                    'address' => '',
                    'email' => '',
                    'mobile' => '',
                    'firstname_err' => '',
                    'lastname_err' => '',
                    'email_err' => '',
                    'mobile_err' => '',
                    'address_err' => '',
                   
            
                ];


            
   
            
            $this->view('dashboards/assistant/petowner/addPetowner',$data);
            

            }

            
        }  


//update petowner----------------------------------------------------------------------------------------------------------------------
        public function updatePetowner($petownerID){


            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                 $data = [
                        'mobile' => trim($_POST['mobile']),
                        'email' => trim($_POST['email']),
                    
                        'email_err' => '',
                        'mobile_err' => '',
                      
                    ];

                    
        //validate Email
        if(empty($data['email'])){

            $data['email_err'] = 'Please enter email';

        }else{

            if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){ //check email in correct formate

                $email=$this->assistantModel->findEmail($data['email']);//check database 

                if($email){
                    $data['email_err'] = 'email already taken';
                }
               
            }else{  //check email in the DB
            
                 $data['email_err'] = 'Email is not valid';

            }


        }


        
        //validate mobile
        if(empty($data['mobile'])){

             $data['mobile_err'] = 'Please enter mobile';
                        
         }else{
 
               if(preg_match("/^94\d{9}$/", $data['mobile'])){ //check email in correct formate

                    $mobile=$this->assistantModel->findMobile($data['mobile']);//check database 

                    if($mobile){
                            $data['mobile_err'] = 'mobile already taken';
                    }
                           
                    }else{  //check email in the DB
                        
                             $data['mobile_err'] = 'mobile is not valid';
 
                        }


              }


                

                $data = [

                    'id' => $petownerID,
                    'email' => $petownerDetails->email,
                    'mobile' => $petownerDetails->mobile,
                    
                    'email_err' => '',
                    'mobile_err' =>'' ,
                ];








            }else{


                $petownerDetails= $this ->assistantModel ->getPetownerMobileEmailByID($petownerID);

                $data = [

                    'id' => $petownerID,
                    'email' => $petownerDetails->email,
                    'mobile' => $petownerDetails->mobile,
                    
                    'email_err' => '',
                    'mobile_err' =>'' ,
                ];
                $this->view('dashboards/assistant/petowner/updatePetowner',$data);

            }
           

            
        }





        
        // ADD PET part-------------------------------------------------------------------------------------------------------------------------------------------------




        public function pet(){

            $petDetails = $this ->assistantModel ->getPetDetails ();
            $data = [
                'pet' => $petDetails
            ];

            $this ->view('dashboards/assistant/pet/pet', $data);

        }

        public function addPetAppointment(){
            $data =null;

           $this->view('dashboards/assistant/pet/addPet',$data);


           }

           public function addPet(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                    $data = [
                        'pname'  => trim($_POST['pname']),
                        'dob'    => trim($_POST['dob']),
                        'species'=> trim($_POST['species']),
                        'breed'  => trim($_POST['breed']),
                        'sex'    => trim($_POST['sex']),
                        'petownerID'=>trim($_POST['petownerID']),
                        
                        'pname_err'    => '',
                        'dob_err'      => '',
                        'species_err'  => '',
                        'breed_err'    => '',
                        'sex_err'      => '',
                        'petownerID_err' => '',
                       
                        
                    ];

                    //validate pName
                    if(empty($data['pname'])){
                        $data['pname_err'] = 'Please enter pet Name';
                    }   

                    //validate dob
                    if(empty($data['dob'])){
                        $data['dob_err'] = 'Please enter dob';
                    }   

                    //validate species
                    if(empty($data['species'])){
                        $data['species_err'] = 'Please select species';
                    }   

                    //validate breed
                    if(empty($data['breed'])){
                    $data['breed_err'] = 'Please select breed';
                        }  

                         //validate sex
                    if(empty($data['sex'])){
                        $data['sex_err'] = 'Please select sex';
                            }  


                    
                         //validate petownerID
                    if(empty($data['petownerID'])){

                        $data['petownerID_err'] = 'Please enter petownerID';

                    }else{
 
                        if($this->assistantModel->findpetownerID($data['petownerID'])){ //check petownerID in correct formate

                            
                           
                        }else{  //check petownerID in the DB
                        
                             $data['petownerID_err'] = 'petownerID is not valid';
 
                        }


                    }

       
                        if(empty($data['pname_err']) && empty($data['dob_err']) && empty($data['species_err'])  && empty($data['breed_err']) && empty($data['sex_err']) && empty($data['petownerID_err']) )  {


                   //Regster User

                   if($this->assistantModel->addpet($data)){
                                    
                                      
                    
                    redirect('assistant/pet');

                    }else{
                        die("Something went wrong");
                    }


                }else{
                    $this->view('dashboards/assistant/pet/addPet',$data);//load with errors  
                }

            }else{//form eken submit krnne nthuw normal load wena ek

                $data = [
                    'pname'   => '',
                    'dob'     => '',
                    'species' => '',
                    'breed'   => '',
                    'sex'     => '',
                    'petownerID' => '',
                   
                    'pname_err'   => '',
                    'dob_err'     => '',
                    'species_err' => '',
                    'breed_err'   => '',
                    'sex_err'     => '',
                    'petownerID_err' => '',
                    
                    ];
              
                    $this->view('dashboards/assistant/pet/addPet',$data);


            }
        }


// update pet----------------------------------------------------------------------------------------
         //public function updatePets($petid){// pets kyl dl thiyenne
          //  $data =null;

           // $this->view('dashboards/assistant/pet/updatePet',$data);
        





        public function updatePet($id){

            
            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);


              
                    // if (isset($_FILES['pet_img'])) {
                    //     $uploadedFileName = $_FILES['pet_img']['name'];
                    //     $fileExtension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);  // Extract the file extension

                    //     // Generate a timestamp for uniqueness
                    //     $timestamp = time();

                    //     // Create a unique ID by concatenating values and adding the file extension
                    //     $uniqueImgFileName = $id . '_' . $_POST['pname'] . '_' . $_POST['dob'] . '_' . $timestamp . '.' . $fileExtension;

                    // }
               

                //init data

                $data = [
                    'id' => $id,
                    'pname' => trim($_POST['pname']),
                    'dob' => trim($_POST['dob']),
                    'species' => trim($_POST['species']),
                    'sex' => trim($_POST['sex']),
                    'breed' => trim($_POST['breed']),
                  
                    'pname_err' => '',
                    'dob_err' => '',
                    'species_err' => '',
                    'sex_err' => '',
                    'breed_err'  =>'',
                  
                ];

            
                //validate pName
                if(empty($data['pname'])){
                    $data['pname_err'] = 'Please enter Pet Name';
                }

                //validate brand
                if(empty($data['dob'])){
                    $data['dob_err'] = 'Please enter DOB';
                }

                //validate sex
                if(empty($data['sex'])){
                    $data['sex_err'] = 'Please select Sex';
                }

               
                //validate breed
                if (empty($data['breed'])) {
                    $data['breed_err'] = 'Please enter breed';
                }

               
               //validate species
                if (empty($data['species'])) {
                    $data['species_err'] = 'Please enter Species';
                }
                

                //Make sure errors are empty

                if(empty($data['pname_err']) && empty($data['breed_err']) && empty($data['species_err']) && empty($data['img_err']) && empty($data['sex_err'])){
                    //validated
                    
                   
                    //add pet

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

                $pet =$this->assistantModel-> getPetDetailsByID($id);


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

                    'pname_err' => '',
                    'dob_err' =>'',
                    'species_err' =>'',
                    'sex_err' => '',
                    'breed_err'  =>''
            
            
                ];

                
                //load view
                $this->view('dashboards/petowner/pet/updatePet', $data);
            }
   

        }



//settings-----------------------------------------------------------------------------------------------
            public function settings(){

                $user_id = ($_SESSION['user_id']);
                $settingsData = $this->settingsModel->getSettingDetails($user_id);
    
                $data =[
                    'settings' => $settingsData
                ];
                
                $this->view('dashboards/assistant/setting/settings',$data);
            }

        }


            