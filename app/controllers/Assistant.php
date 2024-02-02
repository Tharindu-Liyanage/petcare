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

        public function addAppointment(){

            $data =null;
   
            
            $this->view('dashboards/assistant/appointment/addAppointment',$data);
        }

        public function petowner(){

            $petownerDetails = $this ->assistantModel->getPetownerDetails();
            $data = [
                'petowner'=> $petownerDetails
            ];
   
            
            $this->view('dashboards/assistant/petowner/petowner',$data);
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