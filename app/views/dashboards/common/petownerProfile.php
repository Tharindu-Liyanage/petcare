<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/profile.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/temp/Dashboard-petowner-dash.css">
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet"> <!--splide css-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>PetCare | Profile</title>
</head>
<body>

<?php require_once __DIR__ . '/../common/common_variable/index_common.php'; ?>
<?php include __DIR__ . '/../common/dashboard-top-side-bar.php'; ?>


        <main>
            <div class="header">
                <div class="left">
                    <h1>Profile</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT; ?>">
                            Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT; ?>" class="active"> View Profile</a></li>
                    </ul>
                </div>
                
            </div>

            <div class="bottom-data">

            

            <div class="box1">
                    <div class="left">
                        <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $data['user']->profileImage;?>" >   <!-- image input.....-->
                    </div>
                    <div class="middle">
                        <img src="<?php echo URLROOT; ?>/public/img/dashboard/Line 27.svg" alt="">
                    </div>
                    <div class="right" style="justify-content:center;">
                        <div class="name-large">
                            <?php echo $data['user']->first_name . '  ' . $data['user']->last_name ; ?> 
                        </div>
                        <div class="type">
                             Pet Owner
                        </div>
                        
                        <div class="button-list" style ="margin-top: 30px;">
                            <div class="button-container">
                                <i class='bx bx-send'></i>
                                <button onclick="window.location.href='mailto:<?php echo $data['user']->email ; ?>'" class="email">Send Email</button>
                            </div>
                            <div class="button-container">
                                <i class='bx bx-phone-call'></i>
                                <button onclick="window.location.href='tel:<?php echo $data['user']->mobile ; ?>'"  class="call">Make a Call</button>
                            </div>
                    
                        </div>
                    </div>
            </div>


                <div class="box2">
                    <div class="options">
                        
                        <button class="Contact-me">Personal Info</button>
                    </div>
                    <div class="inner-box-1">
                        
                        <div class="line-2">
                            <div class="email">
                                <div class="email-text">
                                    Email
                                </div>
                                <div class="email-address inner-text">
                                    <?php echo $data['user']->email ; ?>
                                </div>
                            </div>
                            <div class="phone">
                                <div class="phone-text">
                                    Phone
                                </div>
                                <div class="phone-number inner-text">
                                    <?php echo $data['user']->mobile ; ?>
                                </div>
                            </div>
                            <div class="address">
                                <div class="address-text ">
                                    Address
                                </div>
                                <div class="address-line inner-text">
                                    <?php echo $data['user']->address ; ?>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
       
        </div>

            <!-- pets -->

            <div class="my-pet-text">
                    My Pets  
            </div>
                <div class="my-pet-box">
                
                    <div class="splide" role="group" aria-label="Splide Basic HTML Example">
                        <div class="splide__track">
                                <ul class="splide__list">

                                <?php

                                    if(count($data['pet']) == 0){

                                        echo '<span class="is-pet-empty">We couldnt find any pets to show at the moment.</span>';

                                    }else


                                    foreach($data['pet'] as $pet) : ?>
                                    <li class="splide__slide">
                                        
                                            <div class="pet-detail">
                                                <img class="pet-image pet-image1" src="<?php echo URLROOT; ?>/public/storage/uploads/animals/<?php echo $pet-> profileImage?>" alt="">
                                                <div class="pet-name pet-name1">PET-<?php echo $pet->petid?> | <?php echo $pet-> pet ?></div>
                                            </div>

                                    </li>

                                    <?php endforeach; ?>
      
                                </ul>
                        </div>
                    </div>
                    
                </div>

                <div style="margin-bottom: 50px;"></div>

        </main>

        
   
    <script>
        var petcount = <?php echo count($data['pet']); ?>;

        if(petcount > 4){
            var petcount = 4;
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/petowner/petSlide.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
</body>
</html>