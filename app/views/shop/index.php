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
   
    <style>
        ul.pagination{
    display:flex;
    justify-content:center;
    align-items:center;
    list-style:none;
    margin-top:20px;
    padding:0px;
    font-size:13px;


}

ul.pagination li{
    margin:0px 5px;
    padding:5px 12px;
    border:1px solid #d3d3d3;
    border-radius:5px;
    cursor:pointer;
    transition:all ease 0.3s;
}

ul.pagination li.active{
    background-color:#667EEA;
    color:#ffffff;
    border:1px solid #667EEA;
    transition:all ease 0.3s;
}
    </style>


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


    <section id = "search-product">
       <div class= "product-heading">
        <h3>Popular product</h3>
        <span>All</span>

       </div> 

    <div id="before-list">

    <?php if($data['products'] == null) : ?>
        <div class="not-found-img">
            <img src="<?php echo URLROOT?>/public/img/shop/notfound.png" alt="not-found">
            <p>Apologies, we couldn't find any results for your search.</p>
        </div>

    <?php else : ?>
       
    
    <ul class="product-container list">

    

    <?php foreach ($data['products'] as $product) : ?>

        <li class="product-box">
            <img src="<?php echo URLROOT?>/public/img/shop/popular.png" alt="popular">
            <strong class="name"><?php echo $product->name ; ?></strong>


            <?php if($product->stock > 0) : ?>
            <span class="quantity"> Quntity <?php echo $product->stock ; ?> </span>
            <?php else : ?>
            <span class="quantity" style="color:#E5605E">OUT OF STOCK</span>
            <?php endif; ?>



            <span class ="price">Rs.<?php echo $product->price; ?></span>
            <!-- cart btn -->


             <?php if($product->stock > 0) : ?>

            <a href="#" class="cart-btn" data-product-id ="<?php echo $product->id ?>"  data-product-price="<?php echo $product->price; ?>">
                <i class="fas fa-shopping-bag"></i> Add To Cart
            </a>

            <?php else : ?>

            <a href="#" class="cart-btn" style="background-color:#FF7276; color:#ffffff; pointer-events: none;" data-product-id ="<?php echo $product->id ?>"  data-product-price="<?php echo $product->price; ?>">
                <i class="fas fa-shopping-bag"></i> Out of Stock
            </a>

            <?php endif; ?>

            <!-- heart-btn -->
          <!--  <a href="#" class="like-btn"> 
                <i class="far fa-heart"></i>
            </a> -->

        </li>

        <?php endforeach; ?>
        
       </ul>

       <ul class="pagination"></ul>
       </div>
    <?php endif; ?>
       

  

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


<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>

    <script>
        // Initialize List.js with pagination
        var monkeyList = new List('before-list', {
            valueNames: ['product-box', 'name'],
            page: 6,
            pagination: true,
            
        });

        monkeyList.on('updated', function() {
            attachAddToCartListeners();
            console.log('Pagination updated');
        });


    </script>


    <script src="<?php echo URLROOT; ?>/public/js/store.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/shop/shopcartHeader.js"></script>
</body>
</html>

   