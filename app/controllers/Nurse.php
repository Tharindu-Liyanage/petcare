<?php

    class Nurse extends Controller {

        public function __construct(){

            if(!isset($_SESSION['user_id'])){
                
                redirect('users/staff');

            }else{


                if($_SESSION['user_role'] != "Nurse"){

                    // Unauthorized access
                    redirect('users/staff');
                     
                }
            }
            $this->settingsModel= $this->model('Settings') ;
        }

        public function index(){

            $data =null;
   
            
            $this->view('dashboards/nurse/index', $data);
        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        public function settings(){
            $user_id = ($_SESSION['user_id']);
            $settingsData = $this->settingsModel->getSettingDetails($user_id);

            $data =[
                'settings' => $settingsData
            ];
            $this->view('dashboards/nurse/setting/settings',$data);
        }

        

    }