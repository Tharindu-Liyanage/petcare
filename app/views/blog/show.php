<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>

    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/blog/show.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> <!--Animate On Scroll Library -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
    <body>
        <!-- start of header -->
         <header class="header">

        
                <div class="logo">
                    <img class="logo-icon" src="<?php echo URLROOT;?>/public/img/logo/logo-croped.png">
                    <span class="logo-txt">PetCare<span class="logo-dot">.</span></span>
                    
                </div>

                <nav class="navbar">
                        <a href="<?php echo URLROOT;?>/home">Home</a>
                        <a href="<?php echo URLROOT;?>/shop/">Shop</a>
                        <a href="<?php echo URLROOT;?>/blog/">Blog</a>
                        <a href="<?php echo URLROOT;?>/home/#about">About</a>
                        <a href="#">Contact</a>  
                </nav>

                <a href="<?php echo URLROOT;?>/users/login" class="btn login">Login</a>
                <a href="<?php echo URLROOT;?>/users/signup" class="btn signup">signup</a>
                <div id="menu-btn"  ><i class='bx bx-menu'></i></div>

        </header>

       
        <!-- end of header -->
        
        <div class="middle-part">
                
            <div class="left-part">
                <div class="blog-title">
                    <?php echo $data['posts']->title; ?>
                </div>
                <div class="blog-date">
                    <?php echo $data['posts']->publishdate; ?>
                </div>

                <div class="blog-author">
                    By <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $data['posts']->authorImage?>"> <?php echo $data['posts']->authorfname.' '.$data['posts']->authorlname ; ?>
                </div>


                <div class="thumnail-image">
                    <img src="<?php echo URLROOT;?>/public/storage/uploads/blog/<?php echo $data['posts']->thumbnail?>" alt="">
                </div>
                <div class="blog-content">
                    <?php echo $data['posts']->content; ?>
                </div>
            </div>

            <div class="right-part">
                <div class="recent-posts-block">
                    <div class="recent-post-text">RECENT POSTS</div>
                    <?php foreach($data['recentPost'] as $post) : ?>
                        <ul type="bullet">
                            <div class="post-title">
                                <li><a href="<?php echo URLROOT;?>/blog/show/<?php echo $post->blogID ;?>"><?php echo $post->title ; ?></a></li>
                            </div>
                        </ul>
                    <?php endforeach; ?>
                </div>
            </div>
               
                

                

                
        </div>

    
        <!-- start of footer -->
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

        <!-- end of footer -->
    </body>
</html>