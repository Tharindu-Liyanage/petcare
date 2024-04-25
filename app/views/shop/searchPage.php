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
        <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/shop/searchpage.css">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> <!--Animate On Scroll Library -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
        <style>

            body{
                padding-top:90px;
            }

            /* popular product */
#popular-product{
    margin: 20px auto;
}
.product-container{
    display:grid;
    grid-template-columns:1fr 1fr 1fr;
    grid-gap:30px;
    margin:40px 0px;

}
.product-box{
    width:100%;
    border:1px solid #eeeeee;
    background-color:#ffffff;
    padding:20px;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    position:relative;
}
.product-box img{
    width: 90%;
    height: 180px;
    object-fit: contain;
    object-position:center;
    margin:auto;
}
.product-box strong{
    color: #202020;
    font-size:1.1rem;
    letter-spacing: 1px;
    font-weight:600;
    margin-top: 10px;
}
.product-box .quantity{
    color:#949494;
    font-size: 0.9rem;
    font-weight:500;
    letter-spacing:1px;
}
.product-box.price{
    margin-top:10px;
    font-size:1.4rem;
    font-weight:600;
    color:#393939;
}
.product-box .cart-btn{
    width: 100%;
    height:40px;
    /*background-color:#ecf7ee;*/
       /* color:#4eb060;*/
       background-color: #d3d8ee;
   color:#667EEA;
    display:flex;
    justify-content: center;
    align-items:center;
    margin-top: 20px;
    transition:all ease 0.3s;
}

.product-box .cart-btn i{
    margin-right:10px;
}
.product-box .cart-btn:hover{
   /* background-color: #4eb060;*/
  background-color:#667EEA;
    color:#ffffff;
    transition:all ease 0.3s;
}
.product-box .like-btn{
    position: absolute;
    right: 0px;
    top: 20px;
    color:#c9c9c9;
    font-size:1.3rem;

}

/* popular bundle pack */
#popular-bundle-pack{
    display:flex;
    flex-direction:column;
    justify-content:center;
    max-width: 1150px;
    margin: 30px auto;
    padding: 60px 0px 20px 0px;
    border-radius:20px;
    background-color: #ecf7ee;
    border: 1px solid #f3f3f3;
    align-items:center;
}


.product-container
{
   /* max-width:1000px;*/
    width:100%;
}

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
    margin-left:200px;

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


        <title>PetCare | Search Results</title>
        <?php require_once __DIR__ . '/shopHeader.php'; ?>

        <main>

      

       

            <div class="filter-wrapper">

                
                 <!-- Filter options go here -->
               <!-- <h2 class="filter-title"> <i class='bx bx-filter-alt'></i> Filter</h2> -->

                <div class="part">

                    <div class="group">
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="icon">
                            <g>
                            <path
                                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"
                            ></path>
                            </g>
                        </svg>
                    <input id="search-filter" class="input" type="search" placeholder="Search" />
                    </div>

                </div>

                <form action="<?php echo URLROOT;?>/shop/searchpage/<?php echo $data['forForm'];?>" method="get" >

                <div class="part">

                    <span class="category main-title">Category:</span>

                   <div class="checkbox-field">

                   <?php $displayedCategories = array(); ?>

                   <?php foreach($data['products'] as $product) : ?>

                    <?php if(in_array($product->categoryname, $displayedCategories)) continue; ?>

                    <?php array_push($displayedCategories, $product->categoryname); ?>

                    <label class="container">
                        <span class="checkbox-title"><?php echo $product->categoryname ?></span>

                        <input type="checkbox"  name="category[]" value="<?php echo $product->category;?>"

                        <?php if($data['GETCategory'] != null) :?>

                         <?php foreach ($data['GETCategory'] as $GETCategory): ?>
                            
                            <?php if($GETCategory == $product->category) echo 'checked'; ?>

                            <?php endforeach; ?>

                        <?php endif; ?>

                        >

                        <span class="checkmark"></span>
                    </label>

                    <?php endforeach; ?>

                   </div>
                
                   

                </div>

                <!-- brand check box here -->
                <div class="part">

                    <span class="category main-title">Brand:</span>

                    <div class="checkbox-field">

                    <?php $displayedBrand = array(); ?>

                    <?php foreach($data['products'] as $product) : ?>

                    <?php if(in_array($product->brand, $displayedBrand)) continue; ?>

                    <?php array_push($displayedBrand, $product->brand); ?>

                    <label class="container">
                        <span class="checkbox-title"><?php echo $product->brand?></span>
                        <input type="checkbox" name ="brand[]"  value="<?php echo $product->brand?>"

                        <?php if($data['GETBrand'] != null) :?>
                        
                        <?php foreach ($data['GETBrand'] as $GETBrand): ?>
                            
                            <?php if($GETBrand == $product->brand) echo 'checked'; ?>

                            <?php endforeach; ?>
                        
                        <?php endif; ?>
                        
                         >
                        <span class="checkmark"></span>
                    </label>

                    <?php endforeach; ?>


                    

                    

                    </div>
                </div>

                <div class="part">

                    <div class="wrapper">
                            <header>
                                <span class="main-title">Price Range: </span>
                                
                            </header>
                        
                            <div class="price-input">
                                <div class="field">
                                <span>Min</span>
                                <input name="minprice" type="number" class="input-min" value="<?php echo $data['minprice']; ?>">
                                </div>
                                <div class="separator">-</div>
                                <div class="field">
                                <span>Max</span>
                                <input name="maxprice" type="number" class="input-max" value="<?php  echo $data['maxprice']; ?>">
                                </div>
                            </div>
                            <div class="slider">
                                <div class="progress"></div>
                            </div>
                            <div class="range-input">
                                <input type="range" class="range-min" min="0" max="<?php echo $data['rangeMaxprice'];?>" value="<?php if(isset($_GET['minprice'])) echo $_GET['minprice']; else echo $data['minprice']; ?>" step="50">
                                <input type="range" class="range-max" min="0" max="<?php echo $data['rangeMaxprice'];?>" value="<?php if(isset($_GET['maxprice'])) echo $_GET['maxprice']; else echo $data['maxprice']; ?>" step="50" <?php if ($data['minprice'] == $data['maxprice']) echo 'disabled'; ?>>
                            </div>
                    </div>
                </div>

                 <div class="part">

                        <div class="buttons">

                            <button class="btn-filter" type="reset">Reset</button>
                            <button class="btn-filter" type="submit">Filter</button>
                                
                        </div>

                </div>
            </form>
        <!-- Add more filter options as needed -->
            </div>

       

       

    <div id="products-wrapper">
        <!-- Product display goes here -->
        <h2><i class='bx bx-search-alt'></i> Search Results</h2>

        <?php
        $totalProducts = count($data['products']);
        $perPage = 6;

        $startIndex = 1;
        $endIndex = $totalProducts/$perPage;

        $endIndex = floor($endIndex);
        $endIndex += 1;

        if($perPage>$totalProducts){
            $endIndex = 1;
        }
        ?>

        <p class="showing-results">Showing <?php echo $startIndex; ?>-<?php echo $endIndex; ?> of <?php echo $totalProducts; ?> results</p>


    
         <!-- popular product -->
    <section id = "search-product">
       <!--<div class= "product-heading">
        <h3>Popular product</h3>
        <span>All</span>

       </div> -->

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

    

    </div>


    



    </main>

   
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
 
    <script src="<?php echo URLROOT; ?>/public/js/shop/searchPage.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/shop/shopcartHeader.js"></script>

            
        
    </body>
</html>

