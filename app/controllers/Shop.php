<?php

    class Shop extends Controller {

        public function __construct(){

            $this->shopModel = $this->model('ShopModel');
            $this->PostModel = $this->model('Post');
           
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

        public function searchpage($keyword){

            if($_SERVER['REQUEST_METHOD'] == 'GET'){
               
               $searchKeyword = str_replace('-', ' ', $keyword);
               $category = $_GET['category'] ?? null;
               $brand = $_GET['brand'] ?? null;
               $minprice = $_GET['minprice'] ?? null;
               $maxprice = $_GET['maxprice'] ?? null;

               $returnpriceInfo = $this->shopModel->returnMinandMaxprice();


              // die(var_dump($category,$brand,$minprice,$maxprice));

               $data =[
                'keyword' => $searchKeyword,
                'forForm' =>$keyword,
                'GETBrand' => $brand,
                'GETCategory' => $category,
                'GETMinPrice' => $minprice,
                'GETMaxPrice' => $maxprice,
                'products' => '',
                'maxprice' => '',
                'minprice' => '',
                'rangeMinprice' => $returnpriceInfo->min_price,
                'rangeMaxprice' => $returnpriceInfo->max_price


                ];

               

                $getProductsByKeyword = $this->shopModel->getProductsByKeywordANDFilter($data);

                if($getProductsByKeyword == null){
                    $maxprice = 0;
                    $minprice = 0;
                }else{

                    if(isset($_GET['maxprice']) && isset($_GET['minprice'])){
                        $maxprice = $_GET['maxprice'];
                        $minprice = $_GET['minprice'];
                    }else{
                        
                      

                        $maxprice = $returnpriceInfo->max_price;
                        $minprice = $returnpriceInfo->min_price;

                    }
                    
                }
    
                


                 $data['products'] = $getProductsByKeyword;
                $data['maxprice'] = $maxprice;
                $data['minprice'] = $minprice;

                 //die(var_dump($category,$brand,$minprice,$maxprice,$data));

                //unset gets
                unset($_GET['category']);
                unset($_GET['brand']);
                unset($_GET['minprice']);
                unset($_GET['maxprice']);


                $this->view('shop/searchPage',$data);

            }


            

            
        }


    }