<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/login.css">
    <title>Login</title>
</head>
<body>

    <div class="container">
        <div class="form-container">

            <form action="#">

                <div class="logo">
                    <img class="logo-icon" src="<?php echo URLROOT;?>/public/img/logo/logo-croped.png">
                    <span class="logo-txt">PetCare<span class="logo-dot">.</span></span>
                    
                </div>

                <div class="title">
                    <span class="title-text"><b>Login to PetCare</b></span>
                </div>


                <div class="input-field">

    
                    <input type="text" placeholder="Email" id="email" required>
                    <input class="last" type="password" placeholder="Password" id="password" required>

                    <div class="footer">
                        <div class="Q1">
                          <img class="img" src="<?php echo URLROOT;?>/public/img/auth/question.svg" alt=""><span><a href="<?php echo URLROOT;?>/users/forgotPassword">Forgotten Password?</a></span>
                        </div>
                      
                <div class="signUp-but">
                    <button class="but"><img class="btn-svg" src="<?php echo URLROOT;?>/public/img/auth/login.svg">Log In</button>
                </div>


               <!-- <div class="footer">
                  <div class="Q1">
                    <img class="img" src="../../img/question.svg" alt=""><span><a href="./forgotpwd.html">Forgotten Password?</a></span>
                  </div> -->

                  <div class="Q1 Q2">
                    <img class="img img2" src="<?php echo URLROOT;?>/public/img/auth/warn.svg" alt=""><span>Don’t have an account? <a href="<?php echo URLROOT;?>/users/signup">Create your account.</a></span>
                  </div>
                </div>


                </div>

                

                

            </form>

            </div>

                <div class="overlay-container">
                    <div class="overlay">
                        <img class="overlay-img" src="<?php echo URLROOT;?>/public/img/auth/login-left-svg.svg" alt="">
                    </div>
                </div>

               

        
    </div>


    
</body>
</html>