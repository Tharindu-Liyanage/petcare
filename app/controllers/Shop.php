<?php

    class Shop extends Controller {

        public function __construct(){
           $this->shopModel = $this->model('ShopModel');
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

            $catTitle = '';
            switch($category){
                case 'foodAndTreats' : $catTitle = 1 ;
                break;
                case 'groomingSupplies' : $catTitle = 3 ;
                break;
                case 'healthAndWellness' : $catTitle = 4 ;
                break;
                case 'toysAndBedding' : $catTitle = 2 ;
                break;
                case 'other' : $catTitle = 5 ;
                break;
                default  : $catTitle = 0;

            }
           
           
            
            
            $product = $this->shopModel->getProductInfo($catTitle);

            $data =[
                'title' => $category,
                'product' => $product
            ];

            // die ($data['product'] ->category);
   
            
            $this->view('shop/category' , $data);
        }

        public function show($id){
            $product = $this->shopModel->getProductById($id);

            $data = [
                'product' => $product
            ];

            $this->view('shop/show', $data);


        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        public function searchpage(){
            $data =null;

            $this->view('shop/searchPage',$data);
        }


    }