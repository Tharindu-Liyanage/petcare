<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="apple-touch-icon" sizes="180x180" href="http://localhost/petcare/public/img/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/petcare/public/img/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="http://localhost/petcare/public/img/favicons/favicon-16x16.png">
        <link rel="icon" href="http://localhost/petcare/public/img/favicons/favicon.ico" type="image/x-icon">

        <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/shop/foodAndTreats.css">
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
      
        </style>


        <title>Search Results</title>
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

        <main>

      

       

            <div class="filter-wrapper">

                <form action="" method="get" >
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

                <div class="part">

                    <span class="category main-title">Category:</span>

                   <div class="checkbox-field">

                    <label class="container">
                        <span class="checkbox-title">Food and Treats</span>
                        <input type="checkbox" checked="checked" >
                        <span class="checkmark"></span>
                    </label>

                    <label class="container"> 
                            
                        <span class="checkbox-title">Grooming Supplies</span>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>

                    <label class="container"> 
                           
                        <span class="checkbox-title">Health and Wellness</span>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>

                    <label class="container"> 
                        <span class="checkbox-title">Toys and Bedding</span>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>

                    </div>
                
                   

                </div>

                <!-- brand check box here -->
                <div class="part">

                    <span class="category main-title">Brand:</span>

                    <div class="checkbox-field">

                    <label class="container">
                        <span class="checkbox-title">Kong</span>
                        <input type="checkbox" checked="checked" >
                        <span class="checkmark"></span>
                    </label>

                    <label class="container"> 
                        
                        <span class="checkbox-title">West Paw</span>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>

                    <label class="container"> 
                        <span class="checkbox-title">Ruffwear</span>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>

                    <label class="container">
                        <span class="checkbox-title">Blue Buffalo</span>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>

                    

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
                                <input type="number" class="input-min" value="2500">
                                </div>
                                <div class="separator">-</div>
                                <div class="field">
                                <span>Max</span>
                                <input type="number" class="input-max" value="7500">
                                </div>
                            </div>
                            <div class="slider">
                                <div class="progress"></div>
                            </div>
                            <div class="range-input">
                                <input type="range" class="range-min" min="0" max="10000" value="2500" step="100">
                                <input type="range" class="range-max" min="0" max="10000" value="7500" step="100">
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

         <!-- popular product -->
    <section id = "search-product">
       <!--<div class= "product-heading">
        <h3>Popular product</h3>
        <span>All</span>

       </div> -->

    <div id="before-list">
       
    
    <ul class="product-container list">

        <li class="product-box">
            <img src="<?php echo URLROOT?>/public/img/shop/popular.png" alt="popular">
            <strong class="name">Happy Dog</strong>
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

        </li>

        <li class="product-box">
            <img src="<?php echo URLROOT?>/public/img/shop/popular.png" alt="popular">
            <strong class="name">Happy Dog</strong>
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

        </li>

        <li class="product-box">
            <img src="<?php echo URLROOT?>/public/img/shop/popular.png" alt="popular">
            <strong class="name">Happy Dog</strong>
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

        </li>

        <li class="product-box">
            <img src="<?php echo URLROOT?>/public/img/shop/popular.png" alt="popular">
            <strong class="name">Happy Dog</strong>
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

        </li>

        <li class="product-box">
            <img src="<?php echo URLROOT?>/public/img/shop/popular.png" alt="popular">
            <strong class="name">Happy Dog</strong>
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

        </li>

        <li class="product-box">
            <img src="<?php echo URLROOT?>/public/img/shop/popular.png" alt="popular">
            <strong class="name">Happy Cat Dog</strong>
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

        </li>
        
       </ul>

       <ul class="pagination"></ul>
       </div>

       

  

    </section>

    <!-- popular product end -->

    

    </div>


    



    </main>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>

       <Script>

    var monkeyList = new List('before-list', {
    valueNames: ['product-box','name'],
    page: 3,
    pagination: true
    });

    var searchInput = document.getElementById('search-filter');
    searchInput.addEventListener('input', function () {
            var searchString = searchInput.value.toLowerCase();
            monkeyList.search(searchString);
        });

        //list over

        //range start
    
        const rangeInput = document.querySelectorAll(".range-input input"),
priceInput = document.querySelectorAll(".price-input input"),
range = document.querySelector(".slider .progress");
let priceGap = 1000;

priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
        maxPrice = parseInt(priceInput[1].value);
        
        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
            if(e.target.className === "input-min"){
                rangeInput[0].value = minPrice;
                range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
            }else{
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});

rangeInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput[0].value),
        maxVal = parseInt(rangeInput[1].value);

        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min"){
                rangeInput[0].value = maxVal - priceGap
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});



       </Script>
            
        
    </body>
</html>

