<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="http://localhost/petcare/public/css/signUp.css">
    <title>SignUp</title>
</head>
<body>

    <div class="container">
        <div class="form-container">

            <form action="<?php echo URLROOT; ?>/users/register" method="post">

                <div class="logo">
                    <img class="logo-icon" src="http://localhost/petcare/public/img/logo/logo-croped.png">
                    <span class="logo-txt">PetCare<span class="logo-dot">.</span></span>
                    
                </div>

                <div class="title">
                    <span class="title-text"><b>Sign up for PetCare</b></span>
                </div>


                <div class="input-field">

                    <div class="name-field">

                        <input class="name" type="text" placeholder="First Name" id="firstname" value="<?php echo $data['first_name']?>"  name="fname" required>
                        <input class="name" type="text" placeholder="Last Name" id="lastname" value="<?php echo $data['last_name']?>"  name="lname" required>


                    </div>
                    
                    <input type="text" placeholder="Email" id="email" value="<?php echo $data['email']?>"  name="email" required>
                    <input type="password" placeholder="Password" id="password" value="<?php echo $data['password']?>"  name="password"  required>
                    <input type="password" placeholder="Re-type Password" id="rePwd" value="<?php echo $data['re-password']?>"  name="re-password"  required>
                    <input class="last" type="text" placeholder="Mobile" id="mobile" value="<?php echo $data['mobile']?>"  name="mobile"  required>

                    
                <div class="signUp-but">
                    <button class="but"><img class="btn-svg" src="http://localhost/petcare/public/img/auth/add-user.svg">Sign Up</button>
                </div>


                </div>

                

                <div class="footer">
                    <p>I agree to abide by PetCare's <a href="#">Terms of Service</a> and its <a href="#" >Privacy Policy</a></p>
                    <p class="Q1"><img class="svg" src="http://localhost/petcare/public/img/auth/warn.svg"> Are you a <a href="http://localhost/petcare/users/vet_signup">Veterinarian</a>?</p>
                </div>

            </form>

            </div>

                <div class="overlay-container">
                    <div class="overlay">
                        <img class="overlay-img" src="http://localhost/petcare/public/img/auth/signUp-left.svg" alt="">
                    </div>
                </div>

               

        
    </div>


    
</body>
</html>