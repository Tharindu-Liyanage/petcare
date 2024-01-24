<?php

    class StoreManager extends Controller {

        public function __construct(){
           

            if(!isset($_SESSION['user_id'])){
                
                redirect('users/staff');

            }else{


                if($_SESSION['user_role'] != "Store Manager"){

                    // Unauthorized access
                    redirect('users/staff');
                     
                }
            }

            $this->dashboardModel = $this->model('Dashboard');
            $this->settingsModel= $this->model('Settings') ;

        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        public function index(){

            $data =null;
   
            
            $this->view('dashboards/storemanager/index', $data);
        }

        public function settings(){

            $user_id = ($_SESSION['user_id']);
            $settingsData = $this->settingsModel->getSettingDetails($user_id);

            $data =[
                'settings' => $settingsData
            ];
   
            
            $this->view('dashboards/storemanager/setting/settings', $data);
        }

        public function inventory(){

            $products = $this->dashboardModel->getInventoryDetails();

            $data = [
                'products' =>$products
            ];
   
            
            $this->view('dashboards/storemanager/inventory/inventory', $data);
        }

        public function order(){

            
            $data =null;
   
            
            $this->view('dashboards/storemanager/order/order', $data);
        }

        /*==================================================================
        
            * Crud methods here ==========================================

        */ 


        //=============== Remove Product ==============================

        public function removeProduct($id){

            
            
            if($this->dashboardModel->removeProduct($id)){

                //$_SESSION['staff_user_removed'] = true;
                redirect('storemanager/inventory');

            }else{
                die("error in user delete model");
            }


        }



        //=============== add Product ==============================


        public function addProduct(){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data

                $data = [
                    'pname' => trim($_POST['pname']),
                    'brand' => trim($_POST['brand']),
                    'category' => trim($_POST['category']),
                    'stock' => trim($_POST['stock']),
                    'price' => trim($_POST['price']),
                    'pname_err' => '',
                    'brand_err' => '',
                    'cat_err' => '',
                    'price_err' => '',
                    'stock_err'  =>''
            
                ];

              
                

            
                //validate pName
                if(empty($data['pname'])){
                    $data['pname_err'] = 'Please enter product name';
                }

                //validate brand
                if(empty($data['brand'])){
                    $data['brand_err'] = 'Please enter brand name';
                }

                //validate address
                if(empty($data['stock'])){
                    $data['stock_err'] = 'Please enter amount stock';
                }


                if (empty($data['category'])) {
                    $data['cat_err'] = 'Please select a category';
                }

                if (empty($data['price'])) {
                    $data['price_err'] = 'Please enter a price';
                }
                

                

                //Make sure errors are empty

                if(empty($data['pname_err']) && empty($data['brand_err']) && empty($data['stock_err']) && empty($data['cat_err']) && empty($data['price_err'])){
                    //validated
                    
                   
                    

                    //add product

                    if($this->dashboardModel->addProduct($data)){
                       
                       // $_SESSION['staff_user_added'] = true;
      
                       redirect('storemanager/inventory');

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/storemanager/inventory/addProduct', $data);
                    
                    

                }


            }else{

                //init data
                $data = [
                    'pname' =>'' ,
                    'brand' =>'' ,
                    'category' => '',
                    'stock' => '',
                    'price' => '',
                    'pname_err' => '',
                    'brand_err' => '',
                    'cat_err' => '',
                    'price_err' => '',
                    'stock_err'  =>''
            
                ];

                
                //load view
                $this->view('dashboards/storemanager/inventory/addProduct', $data);
            }
   
            
            
        }


         //=============== update Product ==============================


         public function updateProduct($id){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data

                $data = [
                    'id' => $id,
                    'pname' => trim($_POST['pname']),
                    'brand' => trim($_POST['brand']),
                    'category' => trim($_POST['category']),
                    'stock' => trim($_POST['stock']),
                    'price' => trim($_POST['price']),
                    'pname_err' => '',
                    'brand_err' => '',
                    'cat_err' => '',
                    'price_err' => '',
                    'stock_err'  =>''
            
                ];

              
                

            
                //validate pName
                if(empty($data['pname'])){
                    $data['pname_err'] = 'Please enter product name';
                }

                //validate brand
                if(empty($data['brand'])){
                    $data['brand_err'] = 'Please enter brand name';
                }

                //validate address
                if(empty($data['stock'])){
                    $data['stock_err'] = 'Please enter amount stock';
                }


                if (empty($data['category'])) {
                    $data['cat_err'] = 'Please select a category';
                }

                if (empty($data['price'])) {
                    $data['price_err'] = 'Please enter a price';
                }
                

                

                //Make sure errors are empty

                if(empty($data['pname_err']) && empty($data['brand_err']) && empty($data['stock_err']) && empty($data['cat_err']) && empty($data['price_err'])){
                    //validated
                    
                   
                   

                    //add product

                    if($this->dashboardModel->updateProduct($data)){
                       
                       // $_SESSION['staff_user_added'] = true;
                     
                       redirect('storemanager/inventory');
                      

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/storemanager/inventory/updateProduct', $data);
                    
                    

                }


            }else{

                $product =$this->dashboardModel-> getProductDetailsById($id);



                //init data
                $data = [
                    'id' => $id,
                    'pname' =>$product->name,
                    'brand' =>$product->brand ,
                    'category' => $product->category,
                    'stock' => $product->stock,
                    'price' => $product->price,
                    'pname_err' => '',
                    'brand_err' => '',
                    'cat_err' => '',
                    'price_err' => '',
                    'stock_err'  =>''
            
                ];

                
                //load view
                $this->view('dashboards/storemanager/inventory/updateProduct', $data);
            }
   
            
            
        }



        /* view Cart*/ 

        public function viewCart(){

            $data =null;
   
            
            $this->view('dashboards/storemanager/order/cart', $data);

        }

        

    }