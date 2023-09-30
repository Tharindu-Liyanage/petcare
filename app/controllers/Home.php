<?php

    class Home extends Controller {

        public function __construct(){
           
        }

        public function index(){

            $data =null;
   
            
            $this->view('home/index', $data);
        }

        

    }