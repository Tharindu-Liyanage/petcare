<DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="180x180" href="http://localhost/petcare/public/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/petcare/public/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="http://localhost/petcare/public/img/favicons/favicon-16x16.png">
    <link rel="icon" href="http://localhost/petcare/public/img/favicons/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/home.css">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> <!--Animate On Scroll Library -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
   
   


    <title>Home</title>
</head>
<body>
    <!-- header start  -->
     
    <header class="header">

        
            <div class="logo">
                <img class="logo-icon" src="<?php echo URLROOT;?>/public/img/logo/logo-croped.png">
                <span class="logo-txt">PetCare<span class="logo-dot">.</span></span>
                
            </div>

        <nav class="navbar">
                <a href="<?php echo URLROOT;?>/">Home</a>
                <a href="<?php echo URLROOT;?>/shop/">Shop</a>
                <a href="#">Blog</a>
                <a href="#about">About</a>
                <a href="#">Contact</a>  
        </nav>

        <a href="<?php echo URLROOT;?>/users/login" class="btn login">Login</a>
        <a href="<?php echo URLROOT;?>/users/signup" class="btn signup">signup</a>
        <div id="menu-btn"  ><i class='bx bx-menu'></i></div>

    </header>


    <!-- header over -->


    <!--home-->

    <section class="home" id="home">

    <div class="contents" data-aos="fade-in">

        <div class="left-content" >
            <h3 class="title1"> Welcome to <br><span class="title2">PetCare</span></h3>
            <p>Your Pet's Home for Care. We're passionate about pets and committed to their well-being. Schedule an appointment today and experience top-quality veterinary care!"</p>
        <div data-aos="fade-up"  data-aos-delay="1"> <a href="#" class="btn" >Make Appointment</a></div> 
        </div>

        <div class="right-content" >
            <img src="<?php echo URLROOT;?>/public/img/home/home-dog-1.svg" alt="puppy">
        </div>
    
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
                <h3>Service Heading</h3>
                <p>Shop with us for a range of 
                    pet food, vitamins, grooming products and pet accessories</p>
            </div>
        </div>


        <div class="column">
            <div class="card">
                <div class="icon-wrapper">
                    <i class="fas fa-hammer"></i>
                </div>
                <h3>Service Heading</h3>
                <p>Shop with us for a range of 
                    pet food, vitamins, grooming products and pet accessories</p>
            </div>
        </div>


        <div class="column">
            <div class="card">
                <div class="icon-wrapper">
                    <i class="fas fa-hammer"></i>
                </div>
                <h3>Service Heading</h3>
                <p>Shop with us for a range of 
                    pet food, vitamins, grooming products and pet accessories</p>
            </div>
        </div>



        <div class="column">
            <div class="card">
                <div class="icon-wrapper">
                    <i class="fas fa-hammer"></i>
                </div>
                <h3>Service Heading</h3>
                <p>Shop with us for a range of 
                    pet food, vitamins, grooming products and pet accessories</p>
            </div>
        </div>



        <div class="column">
            <div class="card">
                <div class="icon-wrapper">
                    <i class="fas fa-hammer"></i>
                </div>
                <h3>Service Heading</h3>
                <p>Shop with us for a range of 
                    pet food, vitamins, grooming products and pet accessories</p>
            </div>
        </div>



        <div class="column">
            <div class="card">
                <div class="icon-wrapper">
                    <i class="fas fa-hammer"></i>
                </div>
                <h3>Service Heading</h3>
                <p>Shop with us for a range of 
                    pet food, vitamins, grooming products and pet accessories</p>
            </div>
        </div>


        
    </div>
 </section>
    <!-- service end-->

    <!-- ourteam start-->
    <section class="Team" id="Team">
    
    <h1 class="headings">our team</a></h1>
    
    <div class="team-row">
        <!-- column 1 -->
        <div class="team-column">
            <div class="team-card">
                <div class="img-container">
                <img src="<?php echo URLROOT;?>/public/storage/userprofiles/user1.png">
                </div>

            </div>
            <h3>Luna Turner</h3>
            <p>Founder</p>
            <div class="team-icons">
                <a href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="#">
                    <i class="fab fa-github"></i>
                </a>
                <a href="#">
                    <i class="fas fa-envelope"></i>
                </a>
            </div> 
        </div>



        <!-- column 2-->
        <div class="team-column">
            <div class="team-card">
                <div class="team-card.img-container"></div>
                <img src="../../img/pro_pic2.png"/>

            </div>
            <h3>Luna Turner</h3>
            <p>Founder</p>
            <div class="team-icons">
                <a href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="#">
                    <i class="fab fa-github"></i>
                </a>
                <a href="#">
                    <i class="fas fa-envelope"></i>
                </a>
            </div> 
        </div>



        <!-- column 3 -->
        <div class="team-column">
            <div class="team-card">
                <div class="img-container"></div>
                <img src="../../img/pro_pic1.png"/>

            </div>
            <h3>Luna Turner</h3>
            <p>Founder</p>
            <div class="team-icons">
                <a href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="#">
                    <i class="fab fa-github"></i>
                </a>
                <a href="#">
                    <i class="fas fa-envelope"></i>
                </a>
            </div> 
        </div>


    </div>
</section>
    
    <!-- ourteam end-->


    <!--ourBlog start-->

    <!-- ourBlog end-->

     <!--footer start-->

     
<!-- Footer -->
<footer class="section-p1 ">
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

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({duration: 1500, offset:80});
  </script>

  <script src="<?php echo URLROOT;?>/public/js/home.js"></script>
</body>
</html>



