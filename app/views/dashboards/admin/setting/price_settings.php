<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/settings.css">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <?php require_once __DIR__ . '/../../common/favicon.php'; ?>
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
                                    <li><a href="<?php echo URLROOT?>/admin/index">
                                        Dashboard
                                    </a></li>  
                                    >
                                    <li><a href="<?php echo URLROOT?>/admin/settings/all" class=""> Settings</a></li>
                                    >
                                    <li><a href="<?php echo URLROOT?>/admin/settings/appointmentPrice" class="active"> Change Appointment Price</a></li>
                                </ul>
                            </div>
                            
                        </div>



        <form class="container"   method="POST" action="<?php echo URLROOT?>/admin/settings/appointmentPrice" id="myForm">     <!--start of form-->
                                    
                                    <div class="content-box">
                                        <div class="inner-content active">                 <!-- start of inner content1 (Myprofile)-->
                                            <div class="personal-info">                 <!-- personal info-->
                                                <div class="large">
                                                    Change Appointment Price
                                                </div>
                                                <div class="line2">
                                                    <div class="small">
                                                     You can change the price of appointment here.
                                                        
                                                    </div>
                                                    <button type="reset" class="cancel-btn" onclick="window.location.href = '<?php echo URLROOT; ?>/admin/settings/price';">Cancel</button>
                                                    <button class="save-changes-btn">Update</button>
                                                </div>
                                            </div>

                                            <div class="input-field">
                                                <div class="title">
                                                    Current Price (LKR)
                                                    <div><span class="invalid-feedback"><?php echo $data['price_err'];?></span></div>
                                                </div>
                                                
                                                <div class="input">
                                                    <input class="<?php echo (!empty($data['price_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="appointment_price" placeholder="Enter your price here" value="<?php echo $data['appointment_price']; ?>">  
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