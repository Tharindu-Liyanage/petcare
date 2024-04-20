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
    


        <title>PetCare | Shop category</title>

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

.not-found-img{
    margin:auto;
    display:grid;
    align-items:center;
    margin-left:370px;

}

.not-found-img img{
    width: 600px;
    height: auto;
}

.not-found-img p{
    font-size: 1.5rem;
    font-weight: 600;
    color: #202020;
    margin-left:100px;
    margin-top: 20px;
}

.showing-results{
    margin-top: 10px;
    font-size: 1.3rem;
    font-weight: 500;
    color: #202020;
}
    </style>
    </head>
    <body>

    <?php require_once __DIR__ . '/shopHeader.php'; ?>


        


            
            
                <div class="category-title"><?php echo strtoupper($data['title']); ?> CATEGORY</div>



    <section id = "search-product">
       <div class= "product-heading">
        <h3><?php echo strtoupper($data['title']); ?></h3>
        <span>All</span>

       </div> 

    <div id="before-list">

    <?php if($data['product'] == null) : ?>
        <div class="not-found-img">
            <img src="<?php echo URLROOT?>/public/img/shop/notfound.png" alt="not-found">
            <p>Apologies, we couldn't find any results for your search.</p>
        </div>

    <?php else : ?>
       
    
    <ul class="product-container list">

    

    <?php foreach ($data['product'] as $product) : ?>

        <li class="product-box">
            <img src="<?php echo URLROOT?>/public/storage/uploads/products/<?php echo $product->image?>" alt="popular">
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


        
        
 
    </body>
</html>