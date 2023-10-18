<?php

    class Shop extends Controller {

        public function __construct(){
           
        }

        public function index(){

            $data =null;
   
            
            $this->view('shop/index', $data);
        }

        

    }