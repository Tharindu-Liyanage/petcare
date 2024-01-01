<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/otpVerification.css"> <!-- Add otp css to this file -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>OTP Verification</title>
</head>
<body>

    <div class="container">
        <div class="form-container">

            <form action="<?php echo URLROOT;?>/users/otpVerification" method="POST">

                <div class="logo">
                    <a href="<?php echo URLROOT; ?>/home" ><img class="logo-icon" src="<?php echo URLROOT;?>/public/img/logo/logo-croped.png"> </a>
                    <span class="logo-txt">PetCare<span class="logo-dot">.</span></span>
                    
                </div>

                <div class="title">
                    <span class="title-text"><b>OTP Verification</b></span>
                </div>


            <div class="text">
                    <p>We emailed you a 4-digit code to <?php if(isset($data['email'])) echo $data['email']; ?>. Enter the code below to confirm your email address.</p>
                </div>

               


                <div class="input-field">

    
                <div class="wrapper">
                    <input type="text" class="field 1" name="first_digit_input" maxlength="1" value="">
                    <input type="text" class="field 2" name="second_digit_input" maxlength="1" value="">
                    <input type="text" class="field 3" name="third_digit_input" maxlength="1" value="">
                    <input type="text" class="field 4" name="fourth_digit_input" maxlength="1" value="">
                    
                </div>

                <div class="error">
                    <span class="invalid-feedback"><?php echo $data['otp_err']; ?></span>
                </div>

                <button type="submit" name="resend" value="resendButton" class="resend" id="resendButton">
                    <i class='bx bx-time'></i>Code Expire In: <span id="timer"></span>
                </button>



     
                <div class="signUp-but">
                    <button type="submit" name="mainSubmit" value="submit"  class="but"><img class="btn-svg" src="<?php echo URLROOT;?>/public/img/auth/submit.svg">Submit</button>
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
                        <img class="overlay-img" src="<?php echo URLROOT;?>/public/img/auth/OTP.svg" alt="">
                    </div>
                </div>

               

        
    </div>

    <script>
        const inputFields = document.querySelectorAll("input.field");

        inputFields.forEach((field) => {
        field.addEventListener("input", handleInput);
        });

        function handleInput(e) {
        let inputField = e.target;
        if (inputField.value.length >= 1) {
            let nextField = inputField.nextElementSibling;
            return nextField && nextField.focus();
        }
        }


     
function startCountdown(endTimestamp) {
    let timerElement = document.getElementById("timer");
    let buttonElement = document.getElementById("resendButton");

    //disable the button
   buttonElement.disabled = true;

    let countdownInterval = setInterval(function() {
        let now = Math.floor(Date.now() / 1000);
        let timeRemaining = endTimestamp - now;

        if (timeRemaining <= 0) {
            clearInterval(countdownInterval);
            //timerElement.innerHTML = "Countdown Complete!";
            buttonElement.disabled = false;
            buttonElement.innerHTML = "Code Expired, Resend";


        } else {
            let minutesRemaining = Math.floor(timeRemaining / 60);
            let secondsRemaining = timeRemaining % 60;

            // Display the remaining time
            timerElement.innerHTML = `${minutesRemaining}m ${secondsRemaining}s`;
        }
    }, 1000);
}


    // Convert "2024-01-01 18:11:40" to a timestamp in milliseconds
    let endTimestamp = Date.parse("<?php echo $data['expire_at'];?>") / 1000;

    // Start the countdown with the calculated timestamp
    startCountdown(endTimestamp);

    </script>


    
</body>
</html>