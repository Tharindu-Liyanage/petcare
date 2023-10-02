<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/ChangePassword.css">
    <title>Change Password</title>
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
                    <span class="title-text"><b>Change password</b></span>
                </div>


            <div class="text">
                    <p>If you've forgotten your password, don't worry! You can reset it by following the steps below.</p>
                </div>

               


                <div class="input-field">

    
                    <input type="password" placeholder="Password" id="password" required>
                    <input  class="last"  type="password" placeholder="Re-type Password" id="rePwd" required>
                   
                    
                   
                      
                <div class="signUp-but">
                    <button class="but"><img class="btn-svg" src="<?php echo URLROOT;?>/public/img/auth/pwd_icon.svg">Change Password</button>
                </div>



                  
                </div>

                
                <div class="footer">
                    <div class="Q1">
                      <a href="<?php echo URLROOT;?>/users/login"><img class="img" src="<?php echo URLROOT;?>/public/img/auth/arrow.svg" alt=""><span>Back to Login</span></a>
                    </div>


                </div>

                

                

            </form>

            </div>

                <div class="overlay-container">
                    <div class="overlay">
                        <img class="overlay-img" src="<?php echo URLROOT;?>/public/img/auth/changepwd.svg" alt="">
                    </div>
                </div>

               

        
    </div>


    
</body>
</html>