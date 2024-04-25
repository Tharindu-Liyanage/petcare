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

   <style>
    textarea{
        width: 100%;
        height: 100px;
        padding: 10px;
        border-radius: 10px;
        resize: none;
        background-color: var(--white);
        border: 1px solid #D3D3D3
    }
   </style>
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
                                    <li><a href="<?php echo URLROOT?>/admin/settings/profile" class="active"> Update Profile</a></li>
                                </ul>

                                <?php elseif($_SESSION['user_role'] == "Doctor") : ?>

                                    <ul class="breadcrumb">
                                    <li><a href="<?php echo URLROOT?>/doctor/">
                                        Dashboard
                                    </a></li>  
                                    >
                                    <li><a href="<?php echo URLROOT?>/doctor/settings/all" class=""> Settings</a></li>
                                    >
                                    <li><a href="<?php echo URLROOT?>/doctor/settings/profile" class="active"> Update Profile</a></li>
                                </ul>

                                <?php elseif($_SESSION['user_role'] == "Nurse") :?>

                                    <ul class="breadcrumb">
                                    <li><a href="<?php echo URLROOT?>/nurse/">
                                        Dashboard
                                    </a></li>  
                                    >
                                    <li><a href="<?php echo URLROOT?>/nurse/settings/all" class=""> Settings</a></li>
                                    >
                                    <li><a href="<?php echo URLROOT?>/nurse/settings/profile" class="active"> Update Profile</a></li>
                                </ul>

                                <?php elseif($_SESSION['user_role'] == "Store Manager") :?>

                                    <ul class="breadcrumb">
                                    <li><a href="<?php echo URLROOT?>/storemanager/">
                                        Dashboard
                                    </a></li>  
                                    >
                                    <li><a href="<?php echo URLROOT?>/storemanager/settings/all" class=""> Settings</a></li>
                                    >
                                    <li><a href="<?php echo URLROOT?>/storemanager/settings/profile" class="active"> Update Profile</a></li>
                                </ul>

                                <?php elseif($_SESSION['user_role'] == "Assistant") :?>

                                    <ul class="breadcrumb">
                                    <li><a href="<?php echo URLROOT?>/assistant/">
                                        Dashboard
                                    </a></li>  
                                    >
                                    <li><a href="<?php echo URLROOT?>/assistant/settings/all" class=""> Settings</a></li>
                                    >
                                    <li><a href="<?php echo URLROOT?>/assistant/settings/profile" class="active"> Update Profile</a></li>
                                </ul>

                                <?php endif; ?>


                            </div>
                            
                        </div>



        <form class="container" enctype="multipart/form-data"  method="POST" 
        
        <?php if($_SESSION['user_role'] == "Admin") : ?>

        action="<?php echo URLROOT?>/admin/settings/profile" 

        <?php elseif($_SESSION['user_role'] == "Doctor") : ?>

        action="<?php echo URLROOT?>/doctor/settings/profile"

        <?php elseif($_SESSION['user_role'] == "Nurse") :?>

        action="<?php echo URLROOT?>/nurse/settings/profile"

        <?php elseif($_SESSION['user_role'] == "Store Manager") :?>

        action="<?php echo URLROOT?>/storemanager/settings/profile"

        <?php elseif($_SESSION['user_role'] == "Assistant") :?>

        action="<?php echo URLROOT?>/assistant/settings/profile"

        <?php endif; ?>
        
        id="myForm">     <!--start of form-->
                                    
                                    <div class="content-box">
                                        <div class="inner-content active">                 <!-- start of inner content1 (Myprofile)-->
                                            <div class="personal-info">                 <!-- personal info-->
                                                <div class="large">
                                                    Personal Info
                                                </div>
                                                <div class="line2">
                                                    <div class="small">
                                                        Update your profile photo and details here.
                                                        <div><span class="invalid-feedback"><?php echo $data['main_err'];?></span></div>
                                                    </div>
                                                    <button type="reset" class="cancel-btn" 
                                                    
                                                    <?php if($_SESSION['user_role'] == "Admin") : ?>

                                                    onclick="window.location.href = '<?php echo URLROOT; ?>/admin/settings/profile';"

                                                    <?php elseif($_SESSION['user_role'] == "Doctor") : ?>

                                                    onclick="window.location.href = '<?php echo URLROOT; ?>/doctor/settings/profile';"

                                                    <?php elseif($_SESSION['user_role'] == "Nurse") :?>

                                                    onclick="window.location.href = '<?php echo URLROOT; ?>/nurse/settings/profile';"

                                                    <?php elseif($_SESSION['user_role'] == "Store Manager") :?>

                                                    onclick="window.location.href = '<?php echo URLROOT; ?>/storemanager/settings/profile';"

                                                    <?php elseif($_SESSION['user_role'] == "Assistant") :?>

                                                    onclick="window.location.href = '<?php echo URLROOT; ?>/assistant/settings/profile';"

                                                    <?php endif; ?>
                                                    
                                                    >Cancel</button>
                                                    <button class="save-changes-btn">Update</button>
                                                </div>
                                            </div>

                                            <div class="input-field">
                                                <div class="title">
                                                    Name
                                                    <div><span class="invalid-feedback"><?php echo $data['name_err'];?></span></div>
                                                </div>
                                                
                                                <div class="input">
                                                    <input class="<?php echo (!empty($data['fname_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="fname"  placeholder="First Name" value="<?php echo $data['fname'] ?>">
                                                    <input class="<?php echo (!empty($data['lname_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="lname" placeholder="Last Name" value="<?php echo $data['lname'] ?>">
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>
                                            


                                            
                                            <div class="input-field">
                                                <div class="title">
                                                    Address
                                                    <div><span class="invalid-feedback"><?php echo $data['address_err'];?></span></div>
                                                </div>
                                                <div class="input">
                                                    <input type="text" class="<?php echo (!empty($data['address_err'])) ? 'is-invalid' : '' ; ?>" name="address"  placeholder="Address" value="<?php echo $data['address'] ?>">
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>



                                            <div class="input-field">
                                                <div class="title">
                                                    NIC
                                                    <div><span class="invalid-feedback"><?php echo $data['nic_err'];?></span></div>
                                                </div>
                                                <div class="input">
                                                    <input type="text" class="<?php echo (!empty($data['nic_err'])) ? 'is-invalid' : '' ; ?>" name="nic"  placeholder="NIC" value="<?php echo $data['nic'] ?>">
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>

                                            <?php if($_SESSION['user_role'] == "Doctor") : ?>

                                            <div class="input-field">
                                                <div class="title">
                                                    Bio
                                                    <div><span class="invalid-feedback"><?php echo $data['bio_err'];?></span></div>
                                                </div>
                                                <div class="input">
                                                    <textarea type="text" class="<?php echo (!empty($data['bio_err'])) ? 'is-invalid' : '' ; ?>" name="bio"  placeholder="Enter Bio here"><?php echo $data['bio'];?></textarea>
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>

                                            <?php endif; ?>
                                        
                                            <div class="footer">                            <!-- footer -->
                                                <div class="footer-text1">
                                                    Your Photo
                                                </div>
                                                <div class="footer-line2">

                                                        <div class="footer-text2">
                                                            This photo will be displayed on your profile
                                                            <div><span class="invalid-feedback"><?php echo $data['img_err'];?></span></div>
                                                        </div>
                                                        <div class="img-preivew" id="img-preivew">
                                                            <img  class="footer-image" src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/<?php echo $data['profile_pic']?>" alt="">
                                                        </div>
                                                        <div class="input-file">
                                                        <i class="bx bx-image-alt"></i>
                                                        <input id="finput" type="file" class="input" name="pro_img" accept="image/*" onchange="upload()">
                                                        </div>
                                                       
                                                </div>
                                            </div>          <!-- end o ffooter-->
                                        </div>                 <!-- end of inner content 1 (My profile)-->

                                    </div>                              
                        
        </form>       <!-- end of form -->



    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/setting.js"></script>

    <script src="https://www.dukelearntoprogram.com/course1/common/js/image/SimpleImage.js"></script>
    <script>

    function upload(){
    

    //img which id as canv1 change to this -> <canvas id="canv1"></canvas>

 var img_preivew = document.getElementById("img-preivew");
    img_preivew.innerHTML = '<canvas id="canv1"></canvas>';
    var imgcanvas = document.getElementById("canv1");
    var fileinput = document.getElementById("finput");
    var image = new SimpleImage(fileinput);
    image.drawTo(imgcanvas);
    }

    </script>
   </body>
</html>