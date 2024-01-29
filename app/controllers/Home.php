<?php

    class Home extends Controller {

        public function __construct(){

            $this->homeModel = $this->model('HomeModel');  //homeModel is an object of the Home model class(models/Home.php)
            $this->PostModel = $this->model('Post');
        }

        public function index(){

             // now dont send any data to the view(view/home/index.php), 

            /*
                =========================================================================
                if u want to send data to the home view delete above $data= null;  !!!!

                ===========================================================================

                eg:- How send data to the view

                **getStaffDetails() is a method in the Home model(models/Home.php).
                **This getStaffDetails() method will return all the vet details from the database to the variable $staffData

                1.$staffData = $this->homeModel->getStaffDetails(); // this call to the getStaffDetails() method in the Home model(models/HomeModel.php) and get all the vet details from the database
                  $postData = $this->homeModel->getPosts(); // this call to the getPosts() method in the Post model(models/HomeModel.php) and get all the post details from the database

               2. $data = [
                    'staff' => $staffData,
                    'posts' => $postData // this will send the $staffData to the view(view/home/index.php) as an array
                ];

                **type below normal above number 1 and 2 codes and comment or remove the $data = null; and run the project to see the result
            */
            $staffData = $this->homeModel->getStaffDetails();
            $postData = $this->PostModel->getPosts();



            $data = [
                'staff' => $staffData,
                'posts' => $postData
            ];
            
            $this->view('home/index', $data);
        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }


        
        

    }