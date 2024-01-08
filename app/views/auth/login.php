<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/login.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <title>Login</title>
</head>
<body>

    <div class="container">
        <div class="form-container">

            <form  action="<?php echo URLROOT; ?>/users/login" method="post">

                <div class="logo">
                   <a href="<?php echo URLROOT; ?>/home" ><img class="logo-icon" src="<?php echo URLROOT;?>/public/img/logo/logo-croped.png"> </a>
                    <span class="logo-txt">PetCare<span class="logo-dot">.</span></span>
                    
                </div>

                <div class="title">
                    <span class="title-text"><b>Login to PetCare</b></span>
                </div>

                <?php if(isset($_SESSION['session_err_PO'])){

                    //this is the error message from the change password page 
                    echo "<div class='badges'>
                            <div class='red'>".$_SESSION['session_err_PO']."</div>
                        </div>";
                    
                    //unset
                    unset($_SESSION['session_err_PO']);
                }

                 if(!empty($_SESSION['change_pwd_msg_PO'])){

                    echo "
                    <div class='badges'>
                            <div class='green'>".$_SESSION['change_pwd_msg_PO']."</div>   
                    </div>";

                    //unset
                    unset($_SESSION['change_pwd_msg_PO']);
                } 


                if(!empty($_SESSION['PO_last_activity'])){

                    echo "
                    <div class='badges'>
                            <div class='red'>".$_SESSION['PO_last_activity']."</div>   
                    </div>";

                    //unset
                    unset($_SESSION['PO_last_activity']);
                    session_destroy();

                }

                    


                
                
                
                ?>

              

                
                

                <div class="input-field">

    
                <input class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ; ?>" type="text" placeholder="Email" id="email" value="<?php echo $data['email']?>"  name="email" >
                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>

                <input class="<?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ; ?>  last" type="password" placeholder="Password" id="password" value="<?php echo $data['password']?>"  name="password"  >
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>

                    <div class="footer">
                        <div class="Q1">
                          <img class="img" src="<?php echo URLROOT;?>/public/img/auth/question.svg" alt=""><span><a href="<?php echo URLROOT;?>/users/forgotPassword">Forgotten Password?</a></span>
                        </div>
                      
                <div class="signUp-but">
                    <button value="login" class="but"><img class="btn-svg" src="<?php echo URLROOT;?>/public/img/auth/login.svg">Log In</button>
                </div>


               <!-- <div class="footer">
                  <div class="Q1">
                    <img class="img" src="../../img/question.svg" alt=""><span><a href="./forgotpwd.html">Forgotten Password?</a></span>
                  </div> -->

                  <div class="Q1 Q2">
                    <img class="img img2" src="<?php echo URLROOT;?>/public/img/auth/warn.svg" alt=""><span>Don’t have an account? <a href="<?php echo URLROOT;?>/users/signup">Create your account.</a></span>
                  </div>

                  <div class="Q1 Q2 Q3">
                    <img class="img img2" src="<?php echo URLROOT;?>/public/img/auth/warn.svg" alt=""><span><a href="<?php echo URLROOT;?>/users/staff">Staff Login Portal.</a></span>
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

   
    <!--this from the helpers -->

    <?php toast_notification("Signup Successful","You can now log in with your credentials.","fa-solid fa-xmark close"); ?>
   <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>


    
</body>
</html>