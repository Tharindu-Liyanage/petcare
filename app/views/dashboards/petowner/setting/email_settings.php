<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/settings.css">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <title>Dashboard</title>
   </head>
   <body>

   <?php require_once __DIR__ . '/../../common/common_variable/setting_common.php'; ?>
   <?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


        <main>
                        <div class="header">
                            <div class="left">
                                <h1>Settings</h1>
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo URLROOT?>/petowner/">
                                        Dashboard
                                    </a></li>  
                                    >
                                    <li><a href="<?php echo URLROOT?>/petowner/settings/all" class=""> Settings</a></li>
                                    >
                                    <li><a href="<?php echo URLROOT?>/petowner/settings/email" class="active"> Change Email</a></li>
                                </ul>
                            </div>
                            
                        </div>



        <form class="container"   method="POST" action="<?php echo URLROOT?>/petowner/settings/email" id="myForm">     <!--start of form-->
                                    
                                    <div class="content-box">
                                        <div class="inner-content active">                 <!-- start of inner content1 (Myprofile)-->
                                            <div class="personal-info">                 <!-- personal info-->
                                                <div class="large">
                                                    Change Email
                                                </div>
                                                <div class="line2">
                                                    <div class="small">
                                                        Update your email address. Verify your new email address to complete the process.
                                                   
                                                    </div>
                                                    <button type="reset" class="cancel-btn" onclick="window.location.href = '<?php echo URLROOT; ?>/petowner/settings/email';">Cancel</button>
                                                    <button class="save-changes-btn" name="main-submit">Update</button>
                                                </div>
                                            </div>

                                            <div class="input-field">
                                                <div class="title">
                                                    Current Email
                                                </div>
                                                
                                                <div class="input">
                                                    <input  type="text" name="email"  value="<?php echo $data['email']; ?> " readonly>  
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>
                                            


                                            
                                            <div class="input-field">
                                                <div class="title">
                                                    New Email
                                                    <div><span class="invalid-feedback"><?php echo $data['new_email_err'];?></span></div>
                                                </div>
                                                <div class="input">
                                                    <input type="text" class="<?php echo (!empty($data['new_email_err'])) ? 'is-invalid' : '' ; ?>" name="new_email"  placeholder="Enter new email" value="<?php echo $data['new_email'] ?>">
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>


                                            <?php if($data['otp_section'] == 1) : ?>
                                            <div class="input-field">
                                                <div class="title">
                                                    Verify Email
                                                    <div><span class="is-right"><?php echo $data['verify_msg'];?></span></div>
                                                    <div><span class="red-font-error"><?php echo $data['otp_err'];?></span></div>
                                                </div>
                                                <div class="input">
                                                  
                                                    <input type="text" class="otp-code <?php echo (!empty($data['otp_err'])) ? 'is-invalid' : '' ; ?> " name="otp_code"  placeholder="Enter OTP code here" value="<?php echo $data['otp_code'];?>">
                                                    <button class="verify-btn" name="otp-button" type="submit">Verify</button>
                                                    
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>

                                            <?php endif; ?>

                                                   
                                        </div>                 <!-- end of inner content 1 (My profile)-->

                                    </div>                              
                        
        </form>       <!-- end of form -->



    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/setting.js"></script>

   </body>
</html>