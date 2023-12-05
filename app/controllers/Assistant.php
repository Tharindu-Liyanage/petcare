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

            $data =null;
   
            
            $this->view('dashboards/assistant/petowner/petowner',$data);
        }

        public function settings(){

            $data =null;
   
            
            $this->view('dashboards/assistant/setting/settings',$data);
        }

        

    }