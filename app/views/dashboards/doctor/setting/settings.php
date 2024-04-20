<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/settings.css">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
      <title>PetCare | Settings</title>
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


        <!-- Account Settings -->
    
        <form class="container" >     <!--start of form-->


        

            <div class="setting-title">
            <i class='bx bx-cog'></i> Account
            </div> 

            <div class="border-bottom-title"></div>    

            <!-- ancor tag for each account setting -->
                <div class="setting-list">

                    <a href="<?php echo URLROOT; ?>/doctor/settings/profile"> 

                        <div>

                            <i class="far fa-user"></i>
                            <label >Profile</label>
                            <!--  icon chevron right-->
                            <i class='bx bx-chevron-right' ></i>

                        </div>
                    </a>

                    <a href="<?php echo URLROOT; ?>/doctor/settings/password"> 

                        <div>

                            <i class="fas fa-lock"></i>
                            <label >Password</label>
                            <!--  icon chevron right-->
                            <i class='bx bx-chevron-right' ></i>

                        </div>
                    </a>

                    <a href="<?php echo URLROOT; ?>/doctor/settings/email"> 

                        <div>

                            <i class="fas fa-envelope"></i>
                            <label >Email</label>
                            <!--  icon chevron right-->
                            <i class='bx bx-chevron-right' ></i>

                        </div>
                    </a>

                    <a href="<?php echo URLROOT; ?>/doctor/settings/mobile"> 

                        <div>

                            <i class="fas fa-phone"></i>
                            <label >Mobile</label>
                            <!--  icon chevron right-->
                            <i class='bx bx-chevron-right' ></i>

                        </div>
                    </a>

                    
                </div>

      
        </form>       <!-- end of form -->




        <?php
     
        if ($_SESSION['notification'] == "error") {
            
            toast_notifications("Settings Update Failed",$_SESSION['notification_msg'],"bx bx-x check-error"); 
            
        }else if($_SESSION['notification'] == "ok"){

            toast_notifications("Settings Updated!",$_SESSION['notification_msg'],"fas fa-solid fa-check check"); 
            
        }

    ?>




    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/setting.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
   </body>
</html>