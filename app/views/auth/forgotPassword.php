<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/forgotPassword.css">
    <title>Forgot Password</title>
</head>
<body>

    <div class="container">
        <div class="form-container">

            <form action="<?php echo URLROOT; ?>/users/forgotpassword" method="POST">

                <div class="logo">
                    <img class="logo-icon" src="<?php echo URLROOT;?>/public/img/logo/logo-croped.png">
                    <span class="logo-txt">PetCare<span class="logo-dot">.</span></span>
                    
                </div>

                <div class="title">
                    <span class="title-text"><b>Forgot password</b></span>
                </div>


            <div class="text">
                    <p>Enter your email and we’ll send you a link to reset your password</p>
                </div>

               


                <div class="input-field">

    
            
                    <input class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ; ?>" type="text" placeholder="Email" id="email" value="<?php echo $data['email']?>"  name="email" >
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                   
                    
      
                <div class="signUp-but">
                    <button class="but"><img class="btn-svg" src="<?php echo URLROOT;?>/public/img/auth/submit.svg">Submit</button>
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
                        <img class="overlay-img" src="<?php echo URLROOT;?>/public/img/auth/forgot_password.svg" alt="">
                    </div>
                </div>

               

        
    </div>

    <Script>
     

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');

        form.addEventListener('submit', function () {
            const submitButton = form.querySelector('.but');
            
            // Disable the submit button to prevent multiple submissions
            submitButton.disabled = true;
            
            // Optionally, you can change the text of the button to indicate loading
            submitButton.innerHTML = '<img class="btn-svg" src="<?php echo URLROOT;?>/public/img/auth/loading.svg">Loading...';
        });
    });


    </Script>


    
</body>
</html>