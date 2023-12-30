<?php

    class Home extends Controller {

        public function __construct(){

            $this->homeModel = $this->model('Home');  //homeModel is an object of the Home model class(models/Home.php)
           
        }

        public function index(){

            $data =null;  // now dont send any data to the view(view/home/index.php), 

            /*
                =========================================================================
                if u want to send data to the home view delete above $data= null;  !!!!

                ===========================================================================

                eg:- How send data to the view

                **getAllVetDetails() is a method in the Home model(models/Home.php).
                **This getAllVetDetails() method will return all the vet details from the database to the variable $vetData

                $vetData = $this->homeModel->getAllVetDetails();

                $data = [
                    'vetData' => $vetData
                ];

                
            */
   
            
            $this->view('home/index', $data);
        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        

    }