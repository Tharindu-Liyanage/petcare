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

                                <?php if($_SESSION['user_role'] == "Admin") : ?>

                                <ul class="breadcrumb">
                                    <li><a href="<?php echo URLROOT?>/admin/">
                                        Dashboard
                                    </a></li>  
                                    >
                                    <li><a href="<?php echo URLROOT?>/admin/settings/all" class=""> Settings</a></li>
                                    >
                                    <li><a href="<?php echo URLROOT?>/admin/settings/password" class="active"> Change Password</a></li>
                                </ul>

                                <?php elseif($_SESSION['user_role'] == "Doctor") : ?>

                                    <ul class="breadcrumb">
                                    <li><a href="<?php echo URLROOT?>/doctor/">
                                        Dashboard
                                    </a></li>  
                                    >
                                    <li><a href="<?php echo URLROOT?>/doctor/settings/all" class=""> Settings</a></li>
                                    >
                                    <li><a href="<?php echo URLROOT?>/doctor/settings/password" class="active"> Change Password</a></li>
                                </ul>

                                <?php elseif($_SESSION['user_role'] == "Nurse") :?>
                                    
                                    <ul class="breadcrumb">
                                    <li><a href="<?php echo URLROOT?>/nurse/">
                                        Dashboard
                                    </a></li>  
                                    >
                                    <li><a href="<?php echo URLROOT?>/nurse/settings/all" class=""> Settings</a></li>
                                    >
                                    <li><a href="<?php echo URLROOT?>/nurse/settings/password" class="active"> Change Password</a></li>
                                </ul>

                                <?php elseif($_SESSION['user_role'] == "Store Manager") :?>

                                    <ul class="breadcrumb">
                                    <li><a href="<?php echo URLROOT?>/storemanager/">
                                        Dashboard
                                    </a></li>  
                                    >
                                    <li><a href="<?php echo URLROOT?>/storemanager/settings/all" class=""> Settings</a></li>
                                    >
                                    <li><a href="<?php echo URLROOT?>/storemanager/settings/password" class="active"> Change Password</a></li>
                                </ul>

                                <?php elseif($_SESSION['user_role'] == "Assistant") :?>

                                    <ul class="breadcrumb">
                                    <li><a href="<?php echo URLROOT?>/assistant/">
                                        Dashboard
                                    </a></li>  
                                    >
                                    <li><a href="<?php echo URLROOT?>/assistant/settings/all" class=""> Settings</a></li>
                                    >
                                    <li><a href="<?php echo URLROOT?>/assistant/settings/password" class="active"> Change Password</a></li>
                                </ul>

                                <?php endif; ?>


                            </div>
                            
                        </div>



        <form class="container"   method="POST" 
        
        <?php if($_SESSION['user_role'] == "Admin") : ?>

        action="<?php echo URLROOT?>/admin/settings/password" 

        <?php elseif($_SESSION['user_role'] == "Doctor") : ?>

        action="<?php echo URLROOT?>/doctor/settings/password"

        <?php elseif($_SESSION['user_role'] == "Nurse") :?>

        action="<?php echo URLROOT?>/nurse/settings/password"

        <?php elseif($_SESSION['user_role'] == "Store Manager") :?>

        action="<?php echo URLROOT?>/storemanager/settings/password"

        <?php elseif($_SESSION['user_role'] == "Assistant") :?>

        action="<?php echo URLROOT?>/assistant/settings/password"

        <?php endif; ?>
        
        id="myForm">     <!--start of form-->
                                    
                                    <div class="content-box">
                                        <div class="inner-content active">                 <!-- start of inner content1 (Myprofile)-->
                                            <div class="personal-info">                 <!-- personal info-->
                                                <div class="large">
                                                    Change Password
                                                </div>
                                                <div class="line2">
                                                    <div class="small">
                                                    Please enter your current password to change your password
                                                        
                                                    </div>
                                                    <button type="reset" class="cancel-btn" 
                                                    
                                                    <?php if($_SESSION['user_role'] == "Admin") : ?>

                                                    onclick="window.location.href = '<?php echo URLROOT; ?>/admin/settings/password';"

                                                    <?php elseif($_SESSION['user_role'] == "Doctor") : ?>

                                                    onclick="window.location.href = '<?php echo URLROOT; ?>/doctor/settings/password';"

                                                    <?php elseif($_SESSION['user_role'] == "Nurse") :?>

                                                    onclick="window.location.href = '<?php echo URLROOT; ?>/nurse/settings/password';"

                                                    <?php elseif($_SESSION['user_role'] == "Store Manager") :?>

                                                    onclick="window.location.href = '<?php echo URLROOT; ?>/storemanager/settings/password';"

                                                    <?php elseif($_SESSION['user_role'] == "Assistant") :?>

                                                    onclick="window.location.href = '<?php echo URLROOT; ?>/assistant/settings/password';"

                                                    <?php endif; ?>
                                                    
                                                    >Cancel</button>
                                                    <button class="save-changes-btn">Update</button>
                                                </div>
                                            </div>

                                            <div class="input-field">
                                                <div class="title">
                                                    Current Password
                                                    <div><span class="invalid-feedback"><?php echo $data['cur_password_err'];?></span></div>
                                                </div>
                                                
                                                <div class="input">
                                                    <input class="<?php echo (!empty($data['cur_password_err'])) ? 'is-invalid' : '' ; ?>" type="password" name="current_password" placeholder="Enter your current password" value="<?php echo $data['cur_password']; ?>">  
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>
                                            


                                            
                                            <div class="input-field">
                                                <div class="title">
                                                    New Password
                                                    <div><span class="invalid-feedback"><?php echo $data['new_password_err'];?></span></div>
                                                </div>
                                                <div class="input">
                                                    <input type="password" class="<?php echo (!empty($data['new_password_err'])) ? 'is-invalid' : '' ; ?>" name="new_password"  placeholder="Enter new password" value="<?php echo $data['new_password'] ?>">
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>


                                            <div class="input-field">
                                                <div class="title">
                                                    Confirm Password
                                                    <div><span class="invalid-feedback"><?php echo $data['confirm_err'];?></span></div>
                                                </div>
                                                <div class="input">
                                                    <input type="password" class="<?php echo (!empty($data['confirm_err'])) ? 'is-invalid' : '' ; ?>" name="confirm_password"  placeholder="Enter new password again" value="<?php echo $data['confirm_password'] ?>">
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>

                                                   
                                        </div>                 <!-- end of inner content 1 (My profile)-->

                                    </div>                              
                        
        </form>       <!-- end of form -->



    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/setting.js"></script>

   </body>
</html>