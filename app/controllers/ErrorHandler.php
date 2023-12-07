<?php

    class ErrorHandler extends Controller {

        public function __construct(){
           
        }

        public function index(){

            $data =null;
   
            
            $this->view('error/404', $data);
        }

        public function notfound(){
            $data =null;
   
            
            $this->view('error/404', $data);

        }

        

    }