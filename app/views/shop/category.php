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
        <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/shop/category.css">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> <!--Animate On Scroll Library -->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    


        <title>shop category</title>
    </head>
    <body>

    <?php require_once __DIR__ . '/shopHeader.php'; ?>


        


            
            
                <div class="category-title"><?php echo strtoupper($data['title']); ?> </div>

                <div class="category" id="dryfoods">
                    <div class="item-list">
                        <?php foreach($data['product'] as $product) : ?>
                            <div class="item-card">
                                <div class="item-image">
                                <a href="<?php echo URLROOT ; ?>/shop/show/<?php echo $product->id ;?>">
                                    <img src="<?php echo URLROOT;?>/public/img/blog/blog-photo-1.jpeg" alt="" >
                                </a>
                                </div>
                                <div class="item-title"><?php echo $product->name ; ?></div>
                                <div class="item-price"><?php echo $product->price ; ?></div>
                                <div class="buttons">
                                    <a href="" class="btn buy-now-buttton">Buy Now</a>
                                    <a href="" class="btn add-to-cart-buttton">Add To Cart</a>
                                </div>
                            </div>
                        <?php endforeach ; ?>
                    </div>
                </div>


        
        
 
    </body>
</html>