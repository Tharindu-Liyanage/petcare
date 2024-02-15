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
    
        <form class="container" name="form1" action="<?php echo URLROOT; ?>/admin/settings" method="post" >     <!--start of form-->

                                <input type="hidden" name="formType" value="1">
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
                                                    <button type="reset" value="reset" class="cancel-btn">Cancel</button>
                                                    <button type="submit" value="my-profile" name="profile-button" class="save-changes-btn">Save Changes</button>
                                                </div>
                                            </div>

                            


                                            <div class="name">  
                                                <div class="name-left">                <!--name -->
                                                    <div class="name-text">Name</div>
                                                </div>
                                                <div class="name-right">
                                                    <div class="first-name">
                                                        <div class="inputForm <?php echo (!empty($data['firstname_err'])) ? 'is-invalid' : '' ; ?> first-name-inputform">
                                                        
                                                            <input type="text" name="fname" class="text-box firstname-textbox input" placeholder="Anna" value="<?php echo $data['first_name'] ; ?>">
                                                        </div>
                                                        <span class="invalid-feedback"><?php echo $data['firstname_err']; ?></span>
                                                    </div>
                                                    <div class="last-name">
                                                        <div class="inputForm <?php echo (!empty($data['lastname_err'])) ? 'is-invalid' : '' ; ?> first-name-inputform">
                                                                
                                                                <input type="text" name="lname" class="text-box firstname-textbox input" placeholder="Marie" value="<?php echo $data['last_name'] ; ?>">
                                                        </div>
                                                        <span class="invalid-feedback"><?php echo $data['lastname_err']; ?></span>
                                                    </div>
                                                </div>
                                             </div>

                                            <div class="email">                     <!-- Email-->
                                                <div class="email-text">Email</div>
                                                <div class="email-box">
                                                    <div class="inputForm <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ; ?>">
                                                        
                                                        <input type="text" name="email" class="text-box email-textbox input" placeholder="Annamarie@petcare.com" value="<?php echo $data['email'] ; ?>">
                                                    </div>
                                                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                                                </div>
                                                
                                            </div>

                                            <div class="address">                       <!-- address -->
                                                <div class="address-text">Address</div>
                                                <div class="address-box">
                                                    <div class="inputForm <?php echo (!empty($data['address_err'])) ? 'is-invalid' : '' ; ?>">
                                                        
                                                        <input type="text" name="address" class="text-box address-textbox input" placeholder="290 Chatham Way Reston, Maryland(MD), 20191" value="<?php echo $data['address'] ; ?>">
                                                    </div>
                                                    <span class="invalid-feedback"><?php echo $data['address_err']; ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="nic">                       <!-- nic-->
                                                <div class="nic-text">NIC</div>
                                                <div class="nic-box">
                                                    <div class="inputForm <?php echo (!empty($data['nic_err'])) ? 'is-invalid' : '' ; ?>">
                                                        
                                                        <input type="text" name="nic" class="text-box nic-textbox input" placeholder="1920664892V@" value="<?php echo $data['nic'] ; ?>">
                                                    </div>
                                                    <span class="invalid-feedback"><?php echo $data['nic_err']; ?></span>
                                                </div>
                                                <!-- need to add nic to the databse -->
                                            </div>

                                            <div class="mobile">                            <!-- mobile-->
                                                <div class="mobile-text">Mobile</div>
                                                <div class="mobile-box">
                                                    <div class="inputForm <?php echo (!empty($data['mobile_err'])) ? 'is-invalid' : '' ; ?>">
                                                        
                                                        <input type="text" name="mobile" class="text-box mobile-textbox input" placeholder="+94 773456789@" value="<?php echo $data['mobile'] ; ?>">
                                                    </div>
                                                    <span class="invalid-feedback"><?php echo $data['mobile_err']; ?></span>
                                                </div>
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
                                        </div>  
        </form>
        <form class="container" name="form1" action="<?php echo URLROOT; ?>/admin/settings" method="post" >     <!--start of form-->
                                        <!-- end of inner content 1 (My profile)-->

                                        <input type="hidden" name="formType" value="2">
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
                                                <div class="current-password-box">
                                                    <div class="inputForm <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ; ?>">                         
                                                            <input type="password" name="password" id="password" class="password-box text-box input" placeholder="*********" value="<?php echo $data['password'] ; ?>" >
                                                    </div>
                                                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                                                </div>
                                            </div>

                                            <div class="new-password">
                                                
                                                <label class="password-label" for="password">New password</label>
                                                <div class="new-password-right">
                                                
                                                    <div class="inputForm <?php echo (!empty($data['new_password_err'])) ? 'is-invalid' : '' ; ?>">                         
                                                            <input type="password" name="new_password" id="password" class="password-box text-box input" placeholder="*********" value="<?php echo $data['new_password'] ; ?>">
                                                    </div>
                                                    <div class="new-password-text">
                                                        Your new password must be more than 8 characters.
                                                    </div>
                                                    <span class="invalid-feedback"><?php echo $data['new_password_err']; ?></span>
                                                
                                                    
                                                </div>
                                            </div>

                                            <div class="new-confirm-password">
                                                
                                                <label class="password-label" for="password">Confirm New Password</label>
                                                <div class="confirm-password-box">
                                                    <div class="inputForm <?php echo (!empty($data['new_confirm_password_err'])) ? 'is-invalid' : '' ; ?>">                         
                                                            <input type="password" name="new_confirm_password" id="password" class="password-box text-box input" placeholder="*********">
                                                    </div>
                                                    <span class="invalid-feedback"><?php echo $data['new_confirm_password_err']; ?></span>
                                                </div>
                                            </div>

                                        </div>

</form>
<form class="container" name="form1" action="<?php echo URLROOT; ?>/admin/settings" method="post" >     <!--start of form-->
                                        
                                        <input type="hidden" name="formType" value="3">
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
                                            
                                            <div class="facebook">
                                                <div class="social-media-text">
                                                    Facebook
                                                </div>
                                                <div class="input-container">
                                                    <i class='bx bxl-facebook-square'></i>
                                                    <input type="text" name="fb_url" class="text-box1 billing-email-textbox" placeholder="https://www.facebook.com/facebook_username" value="<?php echo $data['fb_url'];; ?>">
                                                </div>
                                            </div>

                                            <div class="instagram">
                                                <div class="social-media-text">
                                                    Instagram
                                                </div>
                                                <div class="input-container">
                                                    <i class='bx bxl-instagram-alt' ></i>
                                                    <input type="text" name="insta_url" class="text-box1 city-email-textbox" placeholder="https://www.instagram.com/instagram_username" value="<?php echo $data['insta_url'];; ?>">
                                                </div>
                                            </div>

                                            <div class="twitter">

                                                <div class="social-media-text">
                                                    Twitter 
                                                </div>
                                                <div class="input-container">
                                                    <i class='bx bxl-twitter' ></i>
                                                    <input type="text" name="twitter_url" class="text-box1 province-email-textbox" placeholder="https://twitter.com/twitter_username" value="<?php echo $data['twitter_url'];; ?>">
                                                </div>
                                            </div>



                                            

                                        </div>          <!-- end of inner content 4 (Social profile)-->

                                                            
                                    


                                    </div>                              
                        
                                </form>       <!-- end of form -->
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/setting.js"></script>
   </body>
</html>