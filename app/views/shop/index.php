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
<?php require_once __DIR__ . '/shopHeader.php'; ?>

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

        <?php foreach($data['category'] as $category) : ?>                       
           <a href="<?php echo URLROOT; ?>/shop/category/<?php echo $category-> categoryname ; ?>/<?php echo $category-> id ; ?>" class = "category-box">
                <!-- <?php if($category-> categoryname == 'Food'){ ;?>
                    <div class="drop-icon icon-large"><i class="fa-solid fa-bowl-food"></i></div>
                <?php } elseif ($category-> categoryname == 'Toys'){ ; ?>
                    <div class="drop-icon icon-large"><i class="fa-solid fa-bread-slice"></i></div>
                <?php } elseif ($category-> categoryname == 'Grooming'){ ; ?>
                    <div class="drop-icon icon-large"><i class="fa-solid fa-paw"></i></div>
                <?php } elseif ($category-> categoryname == 'Accessories'){ ; ?>
                    <div class="drop-icon icon-large"><i class="fa-solid fa-table-cells-large"></i></div>
                <?php } ; ?> -->
                
                <span> <?php echo  $category -> categoryname ; ?> </span>
            </a>  
        <?php endforeach ; ?>

        
        
        

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

let subMenu = document.getElementById('subMenu');

function toggleMenu() {
    subMenu.classList.toggle('open-menu');
}

</script>


    <script src="<?php echo URLROOT; ?>/public/js/store.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/shop/shopcartHeader.js"></script>
</body>
</html>

   