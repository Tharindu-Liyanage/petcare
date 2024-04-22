<DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/home.css">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> <!--Animate On Scroll Library -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- link swiper's css -->
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet"> <!--splide css-->

    <?php require_once __DIR__ . '/../dashboards/common/favicon.php'; ?>


    <title>PetCare | Home</title>
</head>
<body>
    <!-- header start  -->
     
    <header class="header">

        
            <div class="logo">
                <img class="logo-icon" src="<?php echo URLROOT;?>/public/img/logo/logo-croped.png">
                <span class="logo-txt">PetCare<span class="logo-dot">.</span></span>
                
            </div>

        <nav class="navbar">
                <a href="<?php echo URLROOT;?>/home">Home</a>
                <a href="<?php echo URLROOT;?>/shop/">Shop</a>
                <a href="<?php echo URLROOT;?>/blog/">Blog</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>  
        </nav>

        <a href="<?php echo URLROOT;?>/users/login" class="btn login">Login</a>
        <a href="<?php echo URLROOT;?>/users/signup" class="btn signup">signup</a>
        <div id="menu-btn"  ><i class='bx bx-menu'></i></div>

    </header>


    <!-- header over -->


    <!--home-->

    <section class="home" id="home">

    <div class="contents" data-aos="fade-in">

        
            <h3 class="title1"> Welcome to <br><span class="title2">PetCare</span></h3>
            <p>Your Pet's Home for Care. We're passionate about pets and committed to their well-being. Schedule an appointment today and experience top-quality veterinary care!"</p>
            <div data-aos="fade-up"  data-aos-delay="1"> <a href="#" class="btn" >Make Appointment</a></div> 
        

       
    </div>



    </section>

    <!--home end-->



    <!-- about us -->

    <section class="about" id="about">

        <h1 class="headings">about us</a></h1>
    
        <div class="row" data-aos="fade-up">

                <div class="image" >
                        <img src="<?php echo URLROOT;?>/public/img/home/puppy2.svg" alt="puppy2">
                </div>

                <div class="content">
                    <h3>We're here to help you and your pet live long, happy lives.</h3>
                    <p>Pet Care is a veterinary hospital that offers 365 days and 24 hours a day clinic services.
                        we are equipped with state of the art technology and highly qualified, pet friendly staff. </p>
                    
                    <a href="#" class="btn">Read More</a>
                    
                </div>

        </div>


    </section>


    <!--services start-->
    <section class="Services" id="Service">
  
        <h1 class="headings">Services</a></h1>
    <div class="row">
        <div class="column">
            <div class="card">
                <div class="icon-wrapper">
                    <i class="fas fa-hammer"></i>
                </div>
                <h3>Pet Store</h3>
                <p>Shop with us for a range of 
                    pet food, vitamins, grooming products and pet accessories</p>
            </div>
        </div>


        <div class="column">
            <div class="card">
                <div class="icon-wrapper">
                    <i class="fas fa-hammer"></i>
                </div>
                <h3>Animal Ward</h3>
                <p>Shop with us for a range of 
                    pet food, vitamins, grooming products and pet accessories</p>
            </div>
        </div>


        <div class="column">
            <div class="card">
                <div class="icon-wrapper">
                    <i class="fas fa-hammer"></i>
                </div>
                <h3>Surgery</h3>
                <p>Shop with us for a range of 
                    pet food, vitamins, grooming products and pet accessories</p>
            </div>
        </div>



        <div class="column">
            <div class="card">
                <div class="icon-wrapper">
                    <i class="fas fa-hammer"></i>
                </div>
                <h3>OPD</h3>
                <p>Shop with us for a range of 
                    pet food, vitamins, grooming products and pet accessories</p>
            </div>
        </div>



        <div class="column">
            <div class="card">
                <div class="icon-wrapper">
                    <i class="fas fa-hammer"></i>
                </div>
                <h3>Testing</h3>
                <p>Shop with us for a range of 
                    pet food, vitamins, grooming products and pet accessories</p>
            </div>
        </div>



        <div class="column">
            <div class="card">
                <div class="icon-wrapper">
                    <i class="fas fa-hammer"></i>
                </div>
                <h3>Grooming</h3>
                <p>Shop with us for a range of 
                    pet food, vitamins, grooming products and pet accessories</p>
            </div>
        </div>


        

    </div>
 </section>
    <!-- service end-->

    <!-- Blog start -->

    <!-- ourteam start-->
  
    <!-- <section class="swiper mySwiper"> 

    <div class="swiper-wrapper">

      <div class="card swiper-slide">
        <div class="card__image">
          <img src="<?php echo URLROOT;?>/public/img/home/puppy2.svg">
        </div>

        <div class="card__content">
          <span class="card__title">Web Designer</span>
          <span class="card__name">Vanessa Martinez</span>
          <p class="card__text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit veritatis labore provident non tempora odio est sunt, ipsum</p>
          <button class="card__btn">View More</button>
        </div>
      </div>

      <div class="card swiper-slide">
        <div class="card__image">
          <img src="/images/user2.jpg" alt="card image">
        </div>

        <div class="card__content">
          <span class="card__title">Ui Designer</span>
          <span class="card__name">Sarah Bowen</span>
          <p class="card__text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit veritatis labore provident non tempora odio est sunt, ipsum</p>
          <button class="card__btn">View More</button>
        </div>
      </div>

      <div class="card swiper-slide">
        <div class="card__image">
          <img src="/images/user3.jpg" alt="card image">
        </div>

        <div class="card__content">
          <span class="card__title">Web Developer</span>
          <span class="card__name">David Murphy</span>
          <p class="card__text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit veritatis labore provident non tempora odio est sunt, ipsum</p>
          <button class="card__btn">View More</button>
        </div>
      </div>

      <div class="card swiper-slide">
        <div class="card__image">
          <img src="/images/user4.jpg" alt="card image">
        </div>

        <div class="card__content">
          <span class="card__title">Mobile Designer</span>
          <span class="card__name">Kelsey West</span>
          <p class="card__text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit veritatis labore provident non tempora odio est sunt, ipsum</p>
          <button class="card__btn">View More</button>
        </div>
      </div>

    </div>
  </section>
    </div>



   


 -->
 



 <section class="splide our-team" aria-label="Basic Structure Example">

    <h1 class="headings">our team</a></h1>

  <div class="splide__track">
    <ul class="splide__list">


    <!-- ===================================================================================================== -->

<!-- me pallahe  $data eka ethule tiyenn ona home controller eke data array eke ethule dena nama  eg:- denata dala ne , oya dann staff kiyana eka mage example eke tiyen widyata-->
    <?php foreach($data['staff']as $staffmember) : ?>
        
      
        
            <li class ="splide__slide" >

                <div class="card-team">
                        <div class="card__image">
                        <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $staffmember->profileImage ?>">
                        </div>

                        <div class="card__content">

                        <span class="card__title"><?php
                        
                        if($staffmember->role == 'Doctor'){
                            echo 'Veterinarian';
                        }else{
                            echo $staffmember->role;
                        }
                        ?></span>  


                        <span class="card__name"><?php echo $staffmember->firstname ?> <?php echo $staffmember->lastname ?>  </span>
                        <p class="card__text"><?php echo substr($staffmember->bio, 0, 300); ?> ....</p>
                        </div>
                    </div>



            </li>

        
        
        <?php endforeach; ?>

 

     
    </ul>
  </div>
</section>





    <!-- ourteam end-->


    <!--ourBlog start-->
    <section id="blog">
        <div class = "blog-heading">
            
            <h1>OUR LATEST BLOG</h1>
        </div>

        <!-- blog-container -->
            <div class= "blog-container">
            <?php foreach($data['posts'] as $posts) : ?>
                <!--box1  -->
                <div class="blog-box">
                    <!-- img -->
                    <div class="blog-img">
                    <img src="<?php echo URLROOT;?>/public/storage/uploads/blog/<?php echo $posts->thumbnail?>">
                    </div>

                    <!--text  -->
                    <div class="blog-text">
                        <span> <?php echo $posts->publishdate ; ?></span>
                        <div class="blog-title"><?php echo $posts->title; ?></div>
                        <p><?php echo $posts->content; ?></p>
                        <a href="<?php echo URLROOT;?>/blog/show/<?php echo $posts->blogID ;?>">Read More </a>
                    </div>
                </div>
            <?php endforeach ; ?>
            </div>

    
    
    


    <!-- ourBlog end-->

     <!--footer start-->

     
<!-- Footer -->
<footer class="section-p1" id="contact">
    <div class="col">
        <div class="logo-flex">
        <img class="logo" src="<?php echo URLROOT;?>/public/img/logo/logo-croped.png" alt="logo"><span>PetCare</span>
    </div>
        <h4>Contact</h4>
        <p><strong>Address:</strong>562 Nalandarama Road , Streat 32, Nugegoda</p>
        <p><strong>Phone:</strong>+0112 765 456/(+94)077 3678 778</p>
        <p><strong>Hourse:</strong>10:00-18:00,Mon-Sat</p>
        <div class="follow">
            <h4>Follow us</h4>
            <div class="icon">
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-pinterest-p"></i>
                <i class="fab fa-youtube"></i>
                    

                
            </div>
        </div>
        
    </div>
    <div class="col">
        <h4>About</h4>
        <a href="#">About Us</a><br>
        <a href="#">Privacy Policy</a><br>
        <a href="#">Terms & Conditions</a><br>
        <a href="#">Contact Us</a>
        
    </div>

    <div class="col">
        <h4>My Account</h4>
        <a href="#">Sign In</a><br>
        <a href="#">View Cart</a><br>
        <a href="#">Track My Order</a><br>
        <a href="#">Help</a>
        
    </div>

    <div class="col install">
        <h4>Secured Payment Gateways</h4>
        
        <div class ="row">
            <i class='bx bxl-visa'></i>
            <i class='bx bxl-mastercard' ></i>  
            <i class='bx bxl-stripe' ></i>
        </div>

       
       



    </div>

    <div class="copyright">
        <p>© 2023 PetCare. All Rights Reserved.</p>
    </div>
</footer>
    <!-- footer end-->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script>
    var splide = new Splide('.splide', {
        drag: 'free',
        snap: true,
        perPage: 3,
    });

    splide.mount();
</script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({duration: 1500, offset:80});
  </script>

  <script src="<?php echo URLROOT;?>/public/js/home.js"></script>

  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/66234c2e1ec1082f04e4ef00/1hrsu369j';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->




  

  
 
</body>
</html>




