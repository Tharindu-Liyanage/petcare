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
        }

        public function index(){

            $data =null;
   
            
            $this->view('dashboards/nurse/index', $data);
        }

        

    }