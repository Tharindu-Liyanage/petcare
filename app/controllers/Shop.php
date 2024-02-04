<?php

    class Shop extends Controller {

        public function __construct(){
           
        }

        public function index(){

            $data =null;
   
            
            $this->view('shop/index', $data);
        }
        // public function foodAndTreats(){

        //     $data =null;
   
            
        //     $this->view('shop/foodsAndTreats', $data);
        // }
        // public function groomingSupplies(){

        //     $data =null;
   
            
        //     $this->view('shop/groomingSupplies', $data);
        // }
        // public function healthAndWellness(){

        //     $data =null;
   
            
        //     $this->view('shop/healthAndWellness', $data);
        // }
        public function category($category){

            $data =[
                'title' => $category
            ];
   
            
            $this->view('shop/category' , $data);
        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        

    }