<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/signUp.css">
    
    <title>SignUp</title>
</head>
<body>

    <div class="container">
        <div class="form-container">

            <form action="<?php echo URLROOT; ?>/users/signup" method="post">

                <div class="logo">
                <a href="<?php echo URLROOT; ?>/home" ><img class="logo-icon" src="<?php echo URLROOT;?>/public/img/logo/logo-croped.png"> </a>
                    <span class="logo-txt">PetCare<span class="logo-dot">.</span></span>
                    
                </div>

                <div class="title">
                    <span class="title-text"><b>Sign up for PetCare</b></span>
                </div>


                <div class="input-field">

                    <div class="name-field">

                        <input class="name <?php echo (!empty($data['fname_err'])) ? 'is-invalid' : '' ; ?>" type="text" placeholder="First Name" id="firstname" value="<?php echo $data['first_name']?>"  name="fname">
                        


                        <input class="name <?php echo (!empty($data['lname_err'])) ? 'is-invalid' : '' ; ?>" type="text" placeholder="Last Name" id="lastname" value="<?php echo $data['last_name']?>"  name="lname" >
                        

                    </div>

                    <div class="err-for-names">
                        <span class="invalid-feedback"><?php echo $data['fname_err']; ?></span>
                        <span class="invalid-feedback lname"><?php echo $data['lname_err']; ?></span>

                    </div>
                    
                   
                    
                    <input class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ; ?>" type="text" placeholder="Email" id="email" value="<?php echo $data['email']?>"  name="email" >
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>

                    <input class="<?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ; ?>" type="password" placeholder="Password" id="password" value="<?php echo $data['password']?>"  name="password"  >
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>

                    <input class="<?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : '' ; ?>" type="password" placeholder="Re-type Password" id="rePwd" value="<?php echo $data['re_password']?>"  name="re_password">
                    <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>

                    <input class="<?php echo (!empty($data['mobile_err'])) ? 'is-invalid' : '' ; ?>" type="text" placeholder="e.g. 94771234567" id="mobile" value="<?php echo $data['mobile']?>"  name="mobile"  >
                    <span class="invalid-feedback"><?php echo $data['mobile_err']; ?></span>
                    
                <div class="signUp-but">
                    <button value="signup" class="but"><img class="btn-svg" src="<?php echo URLROOT;?>/public/img/auth/add-user.svg">Sign Up</button>
                </div>


                </div>

                

                <div class="footer">
                    <p>I agree to abide by PetCare's <a href="#">Terms of Service</a> and its <a href="#" >Privacy Policy</a></p>
                    <p class="Q1"><img class="svg" src="<?php echo URLROOT;?>/public/img/auth/warn.svg"> Are you a <a href="<?php echo URLROOT;?>/users/vet_signup">Veterinarian</a>?</p>
                </div>

            </form>

            </div>

                <div class="overlay-container">
                    <div class="overlay">
                        <img class="overlay-img" src="<?php echo URLROOT;?>/public/img/auth/signUp-left.svg" alt="">
                    </div>
                </div>

               

        
    </div>


    
   


    
</body>
</html>