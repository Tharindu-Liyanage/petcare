<!DOCTYPE html>
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
        <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/shop/show.css">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> <!--Animate On Scroll Library -->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    </head>

    <body>
    <?php require_once __DIR__ . '/shopHeader.php'; ?>


        <div class="middle-part">
            <a href=""> 
                <img class="product-photo" src="<?php echo URLROOT;?>/public/img/blog/blog-photo-1.jpeg" alt="">
            </a>
            <div class="text-part">
                <div class="item-title"><?php echo $data['product']->name ; ?> </div>
                <div class="item-price"><?php echo $data['product']->price ; ?></div>
                <div class="item-category">Category : <?php echo $data['product'] -> category ;?> </div>
                <div class="description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur magni sequi dolorum eligendi autem excepturi, neque fugit eum voluptatibus! Ducimus aut molestias 
                    officiis incidunt aliquid et magnam? Officiis, veniam sit!
                </div>
                <div class="quantity"><span><?php echo $data['product']->stock ; ?></span> Products Available</div>
                <div class="buttons">
                    <div class="btn add-to-cart-button">Add to Cart</div>
                    <div class="btn buy-now-button">Buy Now</div>             
                </div>
                
            </div>
        </div>
    </body>
</html>