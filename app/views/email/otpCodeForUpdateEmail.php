<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml" lang="en">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <title>PetCare Password Reset</title>
    <meta property="og:title" content="Email template">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        a {
            text-decoration: underline;
            color: inherit;
            font-weight: bold;
            color: #253342;
        }

        h1 {
            font-size: 56px;
        }

        h2 {
            font-size: 28px;
            font-weight: 900;
        }

        p {
            font-weight: 100;
        }

        #email {
            margin: auto;
            width: 600px;
            background-color: white;
        }

        button {
            font: inherit;
            background-color: #FF7A59;
            border: none;
            padding: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 900;
            color: white;
            border-radius: 5px;
            box-shadow: 3px 3px #d94c53;
        }

        .subtle-link {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #CBD6E2;
        }

        .otp-code {
            font-weight: 500;
            font-size: 100px;
        }


        .otp-code .code span {
            padding: 10px;
            background: #EAF0F6;

        }



        span.list {
            font-weight: 500;
        }

        .app-img {
            width: 50%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        @media screen and (max-width: 500px) {
            .app-img {
                width: 100%;
                height: auto;

            }

            .otp-code {
                font-size: 30px;
            }
        }
    </style>
</head>

<body bgcolor="#F5F8FA" style="width: 100%; margin: auto 0; padding:0; font-family: &quot;Poppins&quot;, sans-serif; font-size:18px; color:#33475B; word-break:break-word">
    <! Banner -->
    <table role="presentation" width="100%" bgcolor="#EAF0F6" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <p style="font-weight: 500;color: #222; font-size: 50px;">
                    <img alt="logo" src="https://i.ibb.co/wQncy57/logo-croped.png" style="width: 80px; height: auto;"> PetCare <span style="color: #1F2E88">.</span>
                </p>
            </td>
    </table>
    <! First Row -->
    <table role="presentation" border="0" cellpadding="0" cellspacing="10px" style="padding: 30px 30px 0 60px;">
        <tr>
            <td>
                <h2 align="center">Email Update OTP - PetCare </h2>
                <p align="left"> Hi, <b>{pet_owner_fname}</b>
                    <b>{pet_owner_lname}</b>
                </p>
                <p align="left"> You've requested to change your email. To complete this process, please use the following One-Time Password (OTP) code </p>
                <p align="left"> If you didn't request a password reset, please ignore this email. </p>
                <p align="left"> Best regards, <br> PetCare Team </p>
            </td>
        </tr>
    </table>
    <! Second Row with Two Columns-->
    <table width="100%" role="presentation" border="0" cellpadding="0" cellspacing="10px" width="500px" style="padding: 0px 30px 30px 60px;">
        <tr>
            <td align="center" style="padding: 30px 30px; text-align: center;">
                <h2>Your OTP Code</h2>
                <img class="app-img" alt="booking" src="https://i.ibb.co/mcWmBKP/undraw-mobile-encryption-re-yw3o.png">
            </td>
            <tr align="center" class="otp-code">
                <td>
                    <div class="code">
                        <span>{first-digit}</span>
                        <span>{second-digit}</span>
                        <span>{third-digit}</span>
                        <span>{fourth-digit}</span>
                    </div>
                </td>
            </tr>
        </tr>
    </table>
    <! Banner Row -->
    <table role="presentation" bgcolor="#EAF0F6" width="100%">
        <tr>
            <td align="center" style="padding: 30px 30px;">
                <h2>Thank You for Choosing PetCare &hearts;</h2>
                <p> We appreciate your decision to trust PetCare for your pets well-being. Our commitment is to provide exceptional care and service. </p>
                <a href="http://localhost/petcare/home">Visit Our Site</a>
            </td>
        </tr>
    </table>
    <! Unsubscribe Footer -->
    <table role="presentation" bgcolor="#F5F8FA" width="100%">
        <tr>
            <td align="center" style="padding: 30px 30px;">
                <p style="color:#99ACC2"> &copy; 2023-present PetCare. All rights reserved. </p>
                <!--  <a class="subtle-link" href="#"> Unsubscribe </a>      -->
            </td>
        </tr>
    </table>
    </div>
</body>

</html>