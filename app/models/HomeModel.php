<?php

    class HomeModel{
        private $db;

        public function __construct(){
            $this->db = new Database; // this will instantiate the Database class in the libraries/Database.php file, this file have the database connection and query methods
        }


        //methods here eg:- public function getAllVetDetails() {...}  after get results return to Home Controller (controllers/Home.php)
        

    }