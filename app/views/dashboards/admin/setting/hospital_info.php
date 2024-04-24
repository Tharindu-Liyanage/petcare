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
                                    <li><a href="<?php echo URLROOT?>/admin/settings/hospitalInfo" class="active"> Change Hospital Info</a></li>
                                </ul>
                            </div>
                            
                        </div>



        <form class="container"   method="POST" action="<?php echo URLROOT?>/admin/settings/hospitalInfo" id="myForm">     <!--start of form-->
                                    
                                    <div class="content-box">
                                        <div class="inner-content active">                 <!-- start of inner content1 (Myprofile)-->
                                            <div class="personal-info">                 <!-- personal info-->
                                                <div class="large">
                                                    Change Hospital Info
                                                </div>
                                                <div class="line2">
                                                    <div class="small">
                                                    You can change the hospital information here.
                                                        
                                                    </div>
                                                    <button type="reset" class="cancel-btn" onclick="window.location.href = '<?php echo URLROOT; ?>/admin/settings/hospitalInfo';">Cancel</button>
                                                    <button class="save-changes-btn">Update</button>
                                                </div>
                                            </div>

                                            <div class="input-field">
                                                <div class="title">
                                                    Hospital Name
                                                    <div><span class="invalid-feedback"><?php echo $data['hospital_name_err'];?></span></div>
                                                </div>
                                                
                                                <div class="input">
                                                    <input class="<?php echo (!empty($data['hospital_name_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="hospital_name" placeholder="Enter Name Here" value="<?php echo $data['hospital_name']; ?>">  
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>

                                            <div class="input-field">
                                                <div class="title">
                                                    Hospital Email
                                                    <div><span class="invalid-feedback"><?php echo $data['hospital_email_err'];?></span></div>
                                                </div>
                                                
                                                <div class="input">
                                                    <input class="<?php echo (!empty($data['hospital_email_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="hospital_email" placeholder="Enter Email Here" value="<?php echo $data['hospital_email']; ?>">  
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>

                                            <div class="input-field">
                                                <div class="title">
                                                    Hospital Contact Number
                                                    <div><span class="invalid-feedback"><?php echo $data['hospital_phone_err'];?></span></div>
                                                </div>
                                                
                                                <div class="input">
                                                    <input class="<?php echo (!empty($data['hospital_phone_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="hospital_phone" placeholder="Enter Number Here" value="<?php echo $data['hospital_phone']; ?>">  
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>


                                            <div class="input-field">
                                                <div class="title">
                                                    Hospital Address
                                                    <div><span class="invalid-feedback"><?php echo $data['hospital_address_err'];?></span></div>
                                                </div>
                                                
                                                <div class="input">
                                                    <input class="<?php echo (!empty($data['hospital_address_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="hospital_address" placeholder="Enter Address Here" value="<?php echo $data['hospital_address']; ?>">  
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