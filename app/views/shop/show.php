<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="apple-touch-icon" sizes="180x180" href="http://localhost/petcare/public/img/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/petcare/public/img/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="http://localhost/petcare/public/img/favicons/favicon-16x16.png">
        <link rel="icon" href="http://localhost/petcare/public/img/favicons/favicon.ico" type="image/x-icon">

        <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/shop/show.css">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> <!--Animate On Scroll Library -->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    </head>

    <body>
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