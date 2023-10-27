<?php

    class Petowner extends Controller {

        public function __construct(){
           
            if(!isset($_SESSION['user_id'])){
                
                redirect('users/login');

            }else{


                if(isset($_SESSION['user_role'])){

                   
                    
                }
            }

            $this->dashboardModel = $this->model('Dashboard');
        }

        public function index(){

            $data =null;
   
            
            $this->view('dashboards/petowner/index', $data);
        }



        
}
            
        


        
    
    
 
