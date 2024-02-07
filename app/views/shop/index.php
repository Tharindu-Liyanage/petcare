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

       <!-- Search banner -->
    <section id="search-banner">
        <img class="bg-3"src="<?php echo URLROOT?>/public/img/shop/bg3.png" alt ="bg3">

        <div class="search-banner-text">
            <h1> Order Your Pet Items</h1>
            <strong>#Free Delivery</strong>

            <form id="searchForm" action="<?php echo URLROOT;?>/shop/searchpage/" class ="search-box" method="post">
                <i class="fas fa-search"></i>
                <input type="search" class="search-input" placeholder="Search your pet item" name="search" required>
                <button type="submit" class="search-btn" >Search</button>
            </form>

        </div>
        
    </section>


    <!-- category banner -->


    <section id = "category">
        <div class ="category-heading">
            <h2>Category</h2>
            <span>All</span>

        </div>

    <div class=" category-container">
        <a href="<?php echo URLROOT; ?>/shop/category/foodAndTreats" class = "category-box">
            <div class="drop-icon icon-large"><i class="fa-solid fa-cookie round"></i></div>
            <span>Foods And Treats </span>
        </a>


        <a href="<?php echo URLROOT; ?>/shop/category/groomingSupplies" class = "category-box">
            <div class="drop-icon icon-large"><i class="fa-solid fa-paw round"></i></div>
            <span>Grooming Supplies </span>''
        </a>
        

        <a href="<?php echo URLROOT; ?>/shop/category/healthAndWellness" class = "category-box">
            <div class="drop-icon icon-large"><i class="fa-regular fa-heart round"></i></div>
            <span>Health And Welness</span>
        </a>

        <a href="<?php echo URLROOT; ?>/shop/category/toysAndBedding" class = "category-box"> 
        <div class="drop-icon icon-large"><i class="fa-solid fa-basketball round"></i></div>
            <span>Toys And Bedding </span>
        </a>
        
        

    </div>
    </section>


    <!-- popular product -->
    <section id = "popular-product">
       <div class= "product-heading">
        <h3>Popular product</h3>
        <span>All</span>

       </div>

       <div class="product-container">
        <div class="product-box">
            <img src="<?php echo URLROOT?>/public/img/shop/popular.png" alt="popular">
            <strong>Happy Dog</strong>
            <span class="quantity"> 1 KG </span>
            <span class ="price">$2</span>
            <!-- cart btn -->
            <a href="#" class="cart-btn">
                <i class="fas fa-shopping-bag"></i> Add To Cart
            </a>

            <!-- heart-btn -->
            <a href="#" class="like-btn">
                <i class="far fa-heart"></i>
            </a>

        </div>

        <div class="product-box">
            <img src="<?php echo URLROOT?>/public/img/shop/popular.png" alt="popular">
            <strong>Happy Dog</strong>
            <span class="quantity"> 1 KG </span>
            <span class ="price">$2</span>
            <!-- cart btn -->
            <a href="#" class="cart-btn">
                <i class="fas fa-shopping-bag"></i> Add To Cart
            </a>

            <!-- heart-btn -->
            <a href="#" class="like-btn">
                <i class="far fa-heart"></i>
            </a>

        </div>

        <div class="product-box">
            <img src="<?php echo URLROOT?>/public/img/shop/popular.png" alt="popular">
            <strong>Happy Dog</strong>
            <span class="quantity"> 1 KG </span>
            <span class ="price">$2</span>
            <!-- cart btn -->
            <a href="#" class="cart-btn">
                <i class="fas fa-shopping-bag"></i> Add To Cart
            </a>

            <!-- heart-btn -->
            <a href="#" class="like-btn">
                <i class="far fa-heart"></i>
            </a>

        </div>

        <div class="product-box">
            <img src="<?php echo URLROOT?>/public/img/shop/popular.png" alt="popular">
            <strong>Happy Dog</strong>
            <span class="quantity"> 1 KG </span>
            <span class ="price">$2</span>
            <!-- cart btn -->
            <a href="#" class="cart-btn">
                <i class="fas fa-shopping-bag"></i> Add To Cart
            </a>

            <!-- heart-btn -->
            <a href="#" class="like-btn">
                <i class="far fa-heart"></i>
            </a>

        </div>

        <div class="product-box">
            <img src="<?php echo URLROOT?>/public/img/shop/popular.png" alt="popular">
            <strong>Happy Dog</strong>
            <span class="quantity"> 1 KG </span>
            <span class ="price">$2</span>
            <!-- cart btn -->
            <a href="#" class="cart-btn">
                <i class="fas fa-shopping-bag"></i> Add To Cart
            </a>

            <!-- heart-btn -->
            <a href="#" class="like-btn">
                <i class="far fa-heart"></i>
            </a>

        </div>

        <div class="product-box">
            <img src="<?php echo URLROOT?>/public/img/shop/popular.png" alt="popular">
            <strong>Happy Dog</strong>
            <span class="quantity"> 1 KG </span>
            <span class ="price">$2</span>
            <!-- cart btn -->
            <a href="#" class="cart-btn">
                <i class="fas fa-shopping-bag"></i> Add To Cart
            </a>

            <!-- heart-btn -->
            <a href="#" class="like-btn">
                <i class="far fa-heart"></i>
            </a>

        </div>
        
       </div>

    </section>

    <!-- popular product end -->



    <script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevents the default form submission

        // Extract the search keyword from the input field and replace spaces with hyphens
        var searchKeyword = document.querySelector('.search-input').value.trim().replace(/\s+/g, '-');

        // Construct the URL for redirection
        var redirectUrl = '<?php echo URLROOT; ?>/shop/searchpage/' + encodeURIComponent(searchKeyword);

        // Redirect to the constructed URL
        window.location.href = redirectUrl;
    });
});
</script>


    <script src="<?php echo URLROOT; ?>/public/js/store.js"></script>
</body>
</html>

   