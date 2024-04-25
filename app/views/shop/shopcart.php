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


<?php require_once __DIR__ . '/shopHeader.php'; ?>

 <!-- after header is here -->


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
</html>

   