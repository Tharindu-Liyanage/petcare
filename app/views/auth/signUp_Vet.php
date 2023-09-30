<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/signUp_Vet.css">
    <title>SignUp</title>
</head>
<body>
   

    <div class="container">
        <div class="form-container">

            <form class="full-form" action="#">

                <div class="logo">
                    <img class="logo-icon" src="<?php echo URLROOT;?>/public/img/logo/logo-croped.png">
                    <span class="logo-txt">PetCare<span class="logo-dot">.</span></span>
                    
                </div>

                <div class="title">
                    <span class="title-text"><b>Sign up for PetCare</b></span>
                </div>


                <div class="input-field">

                    <div class="name-field">

                        <input class="name" type="text" placeholder="First Name" id="firstname" required>
                        <input class="name" type="text" placeholder="Last Name" id="lastname" required>


                    </div>
                    
                    <input type="text" placeholder="Email" id="email" required>
                    <input type="password" placeholder="Password" id="password" required>
                    <input type="password" placeholder="Re-type Password" id="rePwd" required>
                    <input class="last" type="text" placeholder="Mobile" id="mobile" required>


                    <!-- upload the docucment-->
                   
                    <div class="upload-area">
                        <div class="inputs">
                            <p>NIC</p>
                            <input type="file" class="input-file" accept=".pdf, .jpg, .jpeg, .png" required>
                        </div>
                        <div class="inputs">
                            <p>Medical Licence</p>
                            <input type="file" class="input-file" accept=".pdf, .jpg, .jpeg, .png" required>
                        </div>
                    </div>


                    <!-- upload the docucment over-->
                    
                <div class="signUp-but">
                    <button class="but"><img class="btn-svg" src="<?php echo URLROOT;?>/public/img/auth/add-user.svg">Sign Up</button>
                </div>


                </div>

                

                <div class="footer">
                    <p>I agree to abide by PetCare's <a href="#">Terms of Service</a> and its <a href="#" >Privacy Policy</a></p>
                    <p class="Q1"><img class="svg" src="<?php echo URLROOT;?>/public/img/auth/warn.svg"> Are you a <a href="<?php echo URLROOT;?>/users/signup">Pet Owner</a>?</p>
                </div>

            </form>

            </div>

                <div class="overlay-container">
                    <div class="overlay">
                        <img class="overlay-img" src="<?php echo URLROOT;?>/public/img/auth/vet.svg" alt="">
                    </div>
                </div>

               

        
    </div>


    <script src="../../js/signUpVet.js"></script>
    
    
</body>
</html>