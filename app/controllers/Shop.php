<?php

    class Shop extends Controller {

        public function __construct(){
           
        }

        public function index(){

            $data =null;
   
            
            $this->view('shop/index', $data);
        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        

    }