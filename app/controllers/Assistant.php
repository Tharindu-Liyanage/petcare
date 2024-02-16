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



        public function addPet(){

            $data =null;
   
            
            $this->view('dashboards/assistant/pet/addPet',$data);
        }   





        public function pet(){

            $petDetails = $this ->assistantModel ->getPetDetails ();
            $data = [
                'pet' => $petDetails
            ];

            $this ->view('dashboards/assistant/pet/pet', $data);
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