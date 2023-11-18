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
                                    <li><a href="#">
                                        Dashboard
                                    </a></li>  
                                    >
                                    <li><a href="#" class="active"> Settings</a></li>
                                </ul>
                            </div>
                            
                        </div>

        <form class="container" action="">     <!--start of form-->
                                    <div class="tab-box">                        
                                        <div class="tab-btn active">My Profile</div>
                                        <div class="tab-btn">Password</div>
                                      
                                        <div class="tab-btn">Social Profiles</div>
                                        <div class="line"></div>
                                    </div>
                                    <div class="content-box">
                                        <div class="inner-content active">                 <!-- start of inner content1 (Myprofile)-->
                                            <div class="personal-info">                 <!-- personal info-->
                                                <div class="large">
                                                    Personal Info
                                                </div>
                                                <div class="line2">
                                                    <div class="small">Update your profile photo and details here.</div>
                                                    <button class="cancel-btn">Cancel</button>
                                                    <button class="save-changes-btn">Save Changes</button>
                                                </div>
                                            </div>

                                            <div class="name">                  <!--name -->
                                                    <div class="name-text">Name</div>
                                                    <input type="text" class="text-box firstname-textbox" placeholder="Anna">
                                                    <input type="text" class="text-box lastname-textbox" placeholder="Marie">
                                            </div>

                                            <div class="email">                     <!-- Email-->
                                                <div class="email-text">Email</div>
                                                <input type="text" class="text-box email-textbox" placeholder="Annamarie@petcare.com">
                                            </div>

                                            <div class="address">                       <!-- address -->
                                                <div class="address-text">Address</div>
                                                <input type="text" class="text-box address-textbox" placeholder="290 Chatham Way Reston, Maryland(MD), 20191">
                                            </div>
                                            
                                            <div class="nic">                       <!-- nic-->
                                                <div class="nic-text">NIC</div>
                                                <input type="text" class="text-box nic-textbox" placeholder="1920664892V">
                                            </div>

                                            <div class="mobile">                            <!-- mobile-->
                                                <div class="mobile-text">Mobile</div>
                                                <input type="text" class="text-box mobile-textbox" placeholder="+94 773456789">
                                            </div>

                                            <div class="footer">                            <!-- footer -->
                                                <div class="footer-text1">
                                                    Your Photo
                                                </div>
                                                <div class="footer-line2">
                                                        <div class="footer-text2">This photo will be displayed on your profile</div>
                                                        <img  class="footer-image" src="../img/logo-croped.png" alt="">
                                                        <div class="footer-image-update">
                                                            <i class='bx bx-cloud-download'></i>
                                                            <div class="footer-text-3"><span>Click to upload </span> or drag and drop
                                                                SVG, PNG or JPG (max. 800x400px)
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>          <!-- end o ffooter-->
                                        </div>                 <!-- end of inner content 1 (My profile)-->

                                        <div class="inner-content">                 <!-- start of inner content2 (Passsword)-->
                                            <div class="personal-info">                 <!-- personal info-->
                                                <div class="large">
                                                    Password
                                                </div>
                                                <div class="line2">
                                                    <div class="small">Please enter your current password to change your password</div>
                                                    <button class="cancel-btn">Cancel</button>
                                                    <button class="save-changes-btn">Save Changes</button>
                                                </div>
                                            </div>

                                            <div class="current-password">
                                                
                                                <label class="password-label" for="password">Password</label>
                                                <input class="password-box" type="password" id="password" name="password" placeholder="*********">
                                            </div>

                                            <div class="new-password">
                                                
                                                <label class="password-label" for="password">New password</label>
                                                <div class="new-password-right">
                                                    <input class="password-box" type="password" id="password" name="password" placeholder="*********">
                                                    <div class="new-password-text">
                                                        Your new password must be more than 8 characters.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="new-confirm-password">
                                                
                                                <label class="password-label" for="password">Confirm New Password</label>
                                                <input class="password-box" type="password" id="password" name="password" placeholder="*********">
                                            </div>

                                        </div>


                                        
                                        <div class="inner-content">                 <!-- start of content 4 (Social profile)-->
                                            <div class="personal-info">                 <!-- personal info-->
                                                <div class="large">
                                                    Social Links
                                                </div>
                                                <div class="line2">
                                                    <div class="small">Update your social links.</div>
                                                    <button class="cancel-btn">Cancel</button>
                                                    <button class="save-changes-btn">Save Changes</button>
                                                </div>
                                            </div>
                                            <div class="billing-email">
                                                <div class="billing-email-left">
                                                    <div class="billing-email-text">
                                                        Email
                                                    </div>
                                                    <div class="billing-email-text-small">
                                                        Invoice will be sent to this email address.
                                                    </div>
                                                </div>
                                                
                                                <input type="text" class="text-box1 billing-email-textbox" placeholder="eg: ucsc123@gmail.com">
                                            </div>

                                            <div class="facebook">
                                                <div class="social-media-text">
                                                    Facebook
                                                </div>
                                                <div class="input-container">
                                                    <i class='bx bxl-facebook-square'></i>
                                                    <input type="text" class="text-box1 billing-email-textbox" placeholder="https://www.facebook.com/facebook_username">
                                                </div>
                                            </div>

                                            <div class="instagram">
                                                <div class="social-media-text">
                                                    Instagram
                                                </div>
                                                <div class="input-container">
                                                    <i class='bx bxl-instagram-alt' ></i>
                                                    <input type="text" class="text-box1 city-email-textbox" placeholder="https://www.instagram.com/instagram_username">
                                                </div>
                                            </div>

                                            <div class="twitter">

                                                <div class="social-media-text">
                                                    Twitter 
                                                </div>
                                                <div class="input-container">
                                                    <i class='bx bxl-twitter' ></i>
                                                    <input type="text" class="text-box1 province-email-textbox" placeholder="https://twitter.com/twitter_username ">
                                                </div>
                                            </div>



                                            

                                        </div>          <!-- end of inner content 4 (Social profile)-->

                                                            
                                    


                                    </div>                              
                        
                                </form>       <!-- end of form -->
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/setting.js"></script>
   </body>
</html>