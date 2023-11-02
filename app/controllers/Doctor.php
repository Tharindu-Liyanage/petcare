<?php

    class Doctor extends Controller {

        public function __construct(){

            if(!isset($_SESSION['user_id'])){
                
                redirect('users/staff');

            }else{


                if($_SESSION['user_role'] != "Doctor" && $_SESSION['user_role'] != "Nurse"  ){

                    // Unauthorized access
                    redirect('users/staff');
                     
                }
            }
           
        }

        public function index(){

            $data =null;
   
            
            $this->view('dashboards/doctor/index', $data);
        }


        public function appointment(){

            $data =null;

            $this->view('dashboards/doctor/appointment/appointment',$data);
        }

        public function animalward(){

            $data =null;

            $this->view('dashboards/doctor/animalward/animalward',$data);
        }

        public function updateWardTreatment(){

            $data =null;

            $this->view('dashboards/doctor/animalward/updateWardTreatment',$data);
        }

        public function admitPatient(){

            $data =null;

            $this->view('dashboards/doctor/animalward/admitPatient',$data);

        }

        public function pet(){
            $data = null;
            $this->view('dashboards/admin/pet/pet',$data);
        }

        public function blog(){
            $data = null;
            $this->view('dashboards/doctor/blog/blog',$data);
        }

        public function addBlog(){
            $data = null;
            $this->view('dashboards/doctor/blog/addBlog',$data);
        }

        public function updateBlog(){
            $data = null;
            $this->view('dashboards/doctor/blog/updateBlog',$data);
        }

        public function treatment(){
            $data = null;
            $this->view('dashboards/doctor/treatment/treatment',$data);
        }


        public function settings(){
            $data = null;
            $this->view('dashboards/doctor/setting/settings',$data);
        }

        

    }