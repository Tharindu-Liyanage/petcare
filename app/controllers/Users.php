<?php
    class Users extends Controller{

        public function __construct(){

        }

        
        public function signup(){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //process form
            }else{

                //init data
                $data = [
                    'first_name' => '',
                    'last_name' => '',
                    'email' => '',
                    'password' => '',
                    're-password' => '',
                    'mobile' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                //load view
                $this->view('auth/signup',$data);
            }

        }

        public function vet_signup(){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //process form
            }else{

                //init data
                $data = [
                    'first_name' => '',
                    'last_name' => '',
                    'email' => '',
                    'password' => '',
                    're-password' => '',
                    'mobile' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                //load view
                $this->view('auth/signup_Vet',$data);
            }

        }

        public function login(){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //process form
            }else{

                //init data
                $data = [
                    
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => ''   
                ];

                //load view
                $this->view('auth/login',$data);
            }

        }


        public function forgotPassword(){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //process form
            }else{

                //init data
                $data = [
                    
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => ''   
                ];

                //load view
                $this->view('auth/forgotPassword',$data);
            }

        }



    }