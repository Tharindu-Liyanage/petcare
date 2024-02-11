<?php

    class Shop extends Controller {

        public function __construct(){

            $this->shopModel = $this->model('ShopModel');
            $this->PostModel = $this->model('Post');

            if(isset($_SESSION['shop_user'])){
    
                unset($_SESSION['shop_user']);

            }
           
        }

        public function index(){

            $data =null;
   
            
            $this->view('shop/index', $data);
        }

        public function createAccount(){

            $_SESSION['shop_user'] = true;

            redirect('users/signup');
        }

        public function login(){
                
                $_SESSION['shop_user'] = true;
    
                redirect('users/login');
        }

        public function logout(){
            $_SESSION['shop_user'] = true;
            redirect('users/logout');
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


        public function addToCart(){
            $postData = json_decode(file_get_contents('php://input'), true);

            // Check if productId and quantity are provided
            if (isset($_POST['productId']) && isset($_POST['quantity'])) {
                // Get productId and quantity from the request
                $productId = $_POST['productId'];
                $quantity = $_POST['quantity'];
                

                // Store product in the cart session variable
                $_SESSION['cart'][$productId] = $quantity;

                // Send success response
                echo json_encode(['success' => true]);
            } else {
                // Send error response
                echo json_encode(['success' => false, 'error' => 'Missing productId or quantity']);
            }
         }

         public function updateCartInfo() {
            // Initialize cart information
            $cartInfo = array(
                'total' => 0.00, // Total cart value
                'itemCount' => 0 // Number of items in the cart
            );
        
            // Example: Retrieve cart information from session
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $productId => $quantity) {
                    // You need to fetch the product details from the database
                    // and calculate the total based on product price and quantity
                   
                    $price = $this->shopModel->getProductPrice($productId);
                    
        
                    $cartInfo['total'] += $price * $quantity;
                    $cartInfo['itemCount'] += $quantity;
                }
            }
        
            // Set the content type to JSON
            header('Content-Type: application/json');
        
            // Output the cart information as JSON
            echo json_encode($cartInfo);
        }


        public function shopcart() {
            // Initialize data array
            $data = ['cart' => '',
                    'total' => ''];
        
            // Check if the 'cart' session variable is set
            if (isset($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];
        
                // Check if the cart is not empty
                if (!empty($cart)) {
                    // Extract product IDs from the cart
                    $productIds = array_keys($cart);
        
                    // Get cart products from the database
                    $cartProducts = $this->shopModel->getProductsByCart($productIds);

                    
        
                    // Assign cart products to the data array
                    $data['cart'] = $cartProducts;
                
                }
            }

            
        
            // Load the view with the data
            $this->view('shop/shopcart', $data);
        }

        public function removeFromCart(){
            $postData = json_decode(file_get_contents('php://input'), true);



                // Check if productId is provided in the request
                if(isset($_POST['productId'])) {
                    $productId = $_POST['productId'];

                    // Remove the product from the cart session variable
                    if(isset($_SESSION['cart'][$productId])) {
                        unset($_SESSION['cart'][$productId]);
                        // Optionally, you might want to do some additional cleanup or logging here
                        // For example, logging the removal of the product or updating other related data
                        // depending on your application's requirements.
                        echo json_encode(array('success' => true)); // Send success response
                        exit;
                    } else {
                        // If product with given productId is not found in the cart
                        echo json_encode(array('success' => false, 'message' => 'Product not found in cart.'));
                        exit;
                    }
                } else {
                    // If productId is not provided in the request
                    echo json_encode(array('success' => false, 'message' => 'Product ID not provided.'));
                    exit;
                }

         }

         public function updateCartQuantity(){

            $postData = json_decode(file_get_contents('php://input'), true);
                        // Check if productId and quantity are provided in the request
            if(isset($_POST['productId']) && isset($_POST['quantity'])) {
                $productId = $_POST['productId'];
                $quantity = $_POST['quantity'];

                // Update the quantity in the cart session variable
                if(isset($_SESSION['cart'][$productId])) {
                    $_SESSION['cart'][$productId] = $quantity;
                    echo json_encode(array('success' => true)); // Send success response
                    exit;
                } else {
                    // If product with given productId is not found in the cart
                    echo json_encode(array('success' => false, 'message' => 'Product not found in cart.'));
                    exit;
                }
            } else {
                // If productId or quantity is not provided in the request
                echo json_encode(array('success' => false, 'message' => 'Product ID or quantity not provided.'));
                exit;
            }
         }

         public function payment(){

             //calcualte total price in cart
            $total = 0;
            if(isset($_SESSION['cart'])){
                $cart = $_SESSION['cart'];
                $productIds = array_keys($cart);
                $cartProducts = $this->shopModel->getProductsByCart($productIds);
                foreach ($cartProducts as $product) {
                    $total += $product->price * $cart[$product->id];
                }
            }


            if(isLoggedIn() == false){
                $_SESSION['shop_user_shopcart'] = true;
                $_SESSION['error_msg_from_shop'] = 'Please login to continue.';
                redirect('shop/login');


            }elseif($total == 0){//if cart total is 0
               
                $_SESSION['shop_user_shopcart_error'] = "Your cart is empty. Please add products to the cart to continue.";
                redirect('shop/shopcart');

            }else{


                $_SESSION['shop_user_shopcart'] = false;

                $cart = $_SESSION['cart'];
                $productIds = array_keys($cart);
                 // Get cart products from the database
                $cartProducts = $this->shopModel->getProductsByCart($productIds);

                $lineItems = array();
                foreach ($cartProducts as $product) {
                    $lineItems[] = array(
                        'price_data' => array(
                            'currency' => 'lkr',
                            'product_data' => array(
                                'name' => $product->name,
                                //'images' => array($product->image),
                                'images' => array(URLROOT . '/public/img/shop/popular.png'), // Concatenate URLROOT with the image path
                            ),
                            'unit_amount' => $product->price * 100, // Convert price to cents
                        ),
                        'quantity' => $cart[$product->id],
                    );
                }

                require __DIR__ . '/../libraries/stripe/vendor/autoload.php';
                \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
        
                $expiresAt = time() + (30 * 60); // in 30 min this will expire
                $expirationDescription = date('Y-m-d H:i:s', $expiresAt);
        
                // Create a payment session
                $paymentSession = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'mode' => 'payment', // Set mode to 'payment' for one-time payments
                    'line_items' => $lineItems,
                    'success_url' => 'http://localhost/petcare/shop/paymentSuccess', // Add a query parameter for success
                    'cancel_url' => 'http://localhost/petcare/shop/paymentCancel', // Add a query parameter for cancel
                    "customer_email" => $_SESSION['user_email'], // set customer email
                    "expires_at" => $expiresAt,
                ]);
        
                // Redirect to the Payment Link URL
                header('Location: ' . $paymentSession->url);
                exit;

            }
        
         }

            public function paymentSuccess(){
                
                $_SESSION['shop_payment_success'] = true;


                //unset
                unset($_SESSION['cart']);
    
                redirect('shop/confirmMessage');
            }

            public function paymentCancel(){
                $_SESSION['shop_payment_cancel'] = true;
                redirect('shop/confirmMessage');
            }

            public function confirmMessage(){

                if(!isset($_SESSION['shop_payment_success']) && !isset($_SESSION['shop_payment_cancel'])){
                    redirect('shop');
                }
    
                if(isset($_SESSION['shop_payment_success'])){

                    //unset
                    unset($_SESSION['shop_payment_success']);
                    $data = [
                        'title' => 'Your Payment Is Complete!',
                        'msg' => 'You will receive a confirmation email with order details.',
                        'btn-msg' => 'Explore more Products',
                        'btn-link' => 'shop'
                    ];


                }else if(isset($_SESSION['shop_payment_cancel'])){
                    //unset
                    unset($_SESSION['shop_payment_cancel']);
                    $data = [
                        'title' => 'Your Payment Is Incomplete!',
                        'msg' => 'You can try again.',
                        'btn-msg' => 'Visit Cart',
                        'btn-link' => 'shop/shopcart'
                    ];
                }
    
                
                $this->view('shop/orderMessage', $data);
            }


        


        
        


    }