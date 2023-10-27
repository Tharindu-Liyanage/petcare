<?php

    class Nurse extends Controller {

        public function __construct(){

            if(!isset($_SESSION['user_id'])){
                
                redirect('users/staff');

            }else{


                if($_SESSION['user_role'] != "Nurse"){

                    //unauthorized accsess
                    // Unauthorized access
                    echo '<script>
                    var confirmation = confirm("Unauthorized access. Click OK to proceed to staff page.");
                    if (confirmation) {
                            window.location.href = "users/staff";
                    }
                    </script>';
                    
                }
            }
        }

        public function index(){

            $data =null;
   
            
            $this->view('dashboards/nurse/index', $data);
        }

        

    }