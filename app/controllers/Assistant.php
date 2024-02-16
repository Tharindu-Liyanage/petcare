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

            $data =null;
   
            
            $this->view('dashboards/assistant/appointment/appointment',$data);
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
                        'sex'    => trim($_post['sex']),
                        'img'    => trim($_post['img']),
                        
                        'pname_err'    => '',
                        'dob_err'      => '',
                        'species_err'  =>'',
                        'breed_err'    => '',
                        'sex_err'      => '',
                        'img_err'      => '',
                    
                        
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
                        $data['species_err'] = 'Please enter species';
                    }   

                    //validate breed
                    if(empty($data['breed'])){
                    $data['breed_err'] = 'Please enter breed';
                        }  

                         //validate sex
                    if(empty($data['sex'])){
                        $data['sex_err'] = 'Please enter sex';
                            }  

                              //validate img
                    if(empty($data['img'])){
                        $data['img_err'] = 'Please enter image';
                            }  
                        
                        
                        if(empty($data['pname_err']) && empty($data['dob_err']) && empty($data['species_err'])  && empty($data['breed_err']) && empty($data['sex_err']) && empty($data['img_err']) )  {

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
                    'img'     => '',
                   
                    'pname_err'   => '',
                    'dob_err'     => '',
                    'species_err' => '',
                    'breed_err'   => '',
                    'sex_err'     => '',
                    'img_err'     => '',
                    
                    ];
              
                    $this->view('dashboards/assistant/pet/addPet',$data);


            }
        }






            public function settings(){

                $user_id = ($_SESSION['user_id']);
                $settingsData = $this->settingsModel->getSettingDetails($user_id);
    
                $data =[
                    'settings' => $settingsData
                ];
                
                $this->view('dashboards/assistant/setting/settings',$data);
            }


        }      