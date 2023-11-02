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
        <div id="menu-btn" ><span class="material-symbols-outlined">menu</span></div>

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

    <!-- service end-->

     <!--ourteam start-->

    <!-- ourteam end-->


    <!--ourBlog start-->

    <!-- ourBlog end-->

     <!--footer start-->

    <!-- footer end-->

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({duration: 1500, offset:80});
  </script>
</body>
</html>



