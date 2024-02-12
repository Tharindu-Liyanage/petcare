<DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="180x180" href="http://localhost/petcare/public/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/petcare/public/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="http://localhost/petcare/public/img/favicons/favicon-16x16.png">
    <link rel="icon" href="http://localhost/petcare/public/img/favicons/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/shop/shop.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/shop/style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> <!--Animate On Scroll Library -->
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/shop/shopcart.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   


    <title>Shop</title>
</head>
<body>
    <!-- header start  -->

    <!-- navbar -->
     
    <header class="header">

            
            
            <div class="logo">
                <img class="logo-icon" src="<?php echo URLROOT;?>/public/img/logo/logo-croped.png">
               <span class="logo-txt">Shop<span class="logo-dot">.</span></span> 
                
            </div>

        <nav class="navbar" id="nav-menu">

        <ul class="flexitem">
            <li class="has-drop-down ">  <a class="one drop-down-button">Products<span class="material-symbols-outlined drop-down-product-icon drop-down-arrow">expand_more</span></a>

                <div class="mega">
                    <div class="container">
                        <div class="wrapper">
                            <div class="flexcol">
                                <div class="row ">
                                <div class="drop-icon icon-large"><i class="fa-solid fa-burger round"></i></div>
                                    <h4>Food and treats</h4>
                                    <ul class="drop-down-group">
                                        <li><a href="#dry">Dry food</a></li>
                                        <li><a href="">Wet food</a></li>
                                        <li><a href="">adawdwad</a></li>
                                        <li><a href="">adff</a></li>
                                        <li><a href="">afef</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="flexcol"> 
                                <div class="row">
                                <div class="drop-icon icon-large"><i class="fa-solid fa-paw round"></i></div>
                                    <h4>Grooming supplies</h4>
                                    <ul  class="drop-down-group">
                                        <li><a href="">Brushes</a></li>
                                        <li><a href="">Combs</a></li>
                                        <li><a href="">Combs</a></li>
                                        <li><a href="">Combs</a></li>
                                        <li><a href="">Combs</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="flexcol">
                                <div class="row">
                                <div class="drop-icon icon-large"><i class="fa-regular fa-heart round"></i></div>
                                    <h4>Health and wellness</h4>
                                    <ul class="drop-down-group">
                                        <li><a href="">Flea and tick medications</a></li>
                                        <li><a href="">Dewormers</a></li>
                                        <li><a href="">Dewormers</a></li>
                                        <li><a href="">Vaccinations</a></li>
                                        <li><a href="">Medications for specific health conditions</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="flexcol">
                                <div class="row">
                                <div class="drop-icon icon-large"><i class="fa-solid fa-basketball round"></i></div>
                                    <h4>Toys and bedding</h4>
                                    <ul class="drop-down-group">
                                        <li><a href="">Scratching posts</a></li>
                                        <li><a href="">Catnip toys</a></li>
                                        <li><a href="">Catnip toys</a></li>
                                        <li><a href="">Cat beds</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  </li>

              <li>   <a href="<?php echo URLROOT;?>/shop/">Shop</a></li>
              <li>  <a href="<?php echo URLROOT;?>/home">PetCare</a></li>
              <li>   <a href="#about">About</a></li>
              <li>   <a href="#">Contact</a>  </li>

                </ul>
        </nav>

        <div class="right flexitem">
            

           
                <div class="icon-large">
                <i class="ri-search-line"></i>        
                </div>
              


                <a href="#" class="iscart flexitem">
                    <div class="icon-large">
                        <i class="ri-shopping-cart-line"></i>
                        <div class="fly-item"><span class="item-number">0</span></div>
                    </div> 
                    
                
                    <div class="icon-text">
                        <div class="mini-text">Total</div>
                        <div class="cart-total">$0.00</div>
                    </div> 

                </a>

                
                <div class="icon-large user-profile" >
                <i class="ri-user-line profile"></i>
                </div>

                <div class="nav__toggle mobile-hide" id="nav-toggle">
                    
                        <i class="ri-menu-2-line nav__toggle-menu icon-large"></i>
                        <i class="ri-close-line nav__toggle-close icon-large"></i>
                     
                </div>
              
        </div>

                

    </header>

     <!-- navbar  over -->
      <!-- header over -->

 <!-- after header is here -->

 <body>

 <div class="container-cart head">
        <h1>Shopping Cart</h1>
        <ul class="breadcrumb">
            <li>Home</li>
            <li>Shopping Cart</li>
        </ul>
        <span class="count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?> products in the cart</span>

    </div>

    <section class="container-cart">
        <ul class="products">
            <!-- Product List -->
            <!-- Each product item should be added here using <li> elements -->

      <?php if(isset($_SESSION['shop_user_shopcart_error'])) :?>
        <div class="error">
            <div class="error__icon">
                <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z" fill="#393a37"></path></svg>
            </div>
            <div class="error__title"><?php echo $_SESSION['shop_user_shopcart_error'];  unset($_SESSION['shop_user_shopcart_error']); ?></div>
            
        </div>

        <?php endif; ?>

            <?php if($data['cart'] != null) : ?>

                <?php foreach($data['cart'] as $product) : ?>
                <!-- one product-->
                <li class="row">
                    <div class="col left">
                        <div class="thumbnail">
                            <a href="#">
                                <img src="<?php echo URLROOT?>/public/img/shop/popular.png" alt="">
                            </a>
                        </div>
                        <div class="detail">
                            <div class="name">
                                <a href="#"><?php echo $product -> name; ?></a>
                            </div>

                            <?php if($product->stock > 0) : ?>
                            <div class="description"><?php echo $product->stock?> left</div>
                            <?php else: ?>
                            <div class="description" style="color:#E5605E">OUT OF STOCK</div>
                            <?php endif; ?>

                            <div class="price">LKR <?php echo $product->price ?></div>
                        </div>
                    </div>
                    <div class="col right">
                        <div class="quantity">


                            <input 
                                type="number" 
                                class="quantity" 
                                min="<?php if($product->stock > 0) { echo "1";} else echo "0" ?>" 
                                max="<?php echo $product->stock?>" step="1" 
                                value="<?php  if($product->stock > 0 ) { echo $_SESSION['cart'][$product->id] ;} else echo "0"; ?>" 
                                data-product-id="<?php echo $product->id ?>" 
                                data-product-price="<?php echo $product->price ?>" 

                                style="
                                <?php
                                if(isset( $_SESSION['shop_user_shopcart_error_product_id']) && in_array($product->id, $_SESSION['shop_user_shopcart_error_product_id'])) {
                                    echo "border: 1px solid #E5605E;"; 
                                }?>"
                                >
                        </div>
                        <div class="remove">
                            <button type="button"><i class='bx bx-x-circle'></i></button>
                        </div>
                    </div>
                </li>
                <!-- one product-->

                <?php endforeach; ?>
                <?php  unset($_SESSION['shop_user_shopcart_error_product_id']); ?>
        </ul>
    </section>

    <section class="container-cart">
       <!-- <div class="promotion">
            <label for="promo-code">Have A Promo Code?</label>
            <input type="text" id="promo-code">
            <button type="button">Apply</button>
        </div>-->

        <div class="summary">
            <ul>
                <!--<li>Subtotal <span>$132.00</span></li>-->
                <!-- Discount will be shown if applicable -->
                <!-- <li>Discount <span>$XX.XX</span></li> -->
                <!--<li>Tax <span>$5.00</span></li>-->
                <li class="total">Total <span id="total"></span></li>
            </ul>
        </div>

        <div class="checkout">
            <button onclick="window.location.href = '<?php echo URLROOT; ?>/shop/payment';" type="button">Check Out</button>
        </div>
    </section>

    <?php endif; ?>

    <?php if($data['cart'] == null) : ?>

    <div class="empty-product">
        <h3>There are no products in your cart.</h3>
        <button onclick="window.location.href = '<?php echo URLROOT; ?>/shop';">Shopping now</button>
    </div>

    <?php endif; ?>
           

       


</body>







    <script src="<?php echo URLROOT; ?>/public/js/store.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/shop/shopcartHeader.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/shop/shopCart.js"></script>
</body>
</html>

   