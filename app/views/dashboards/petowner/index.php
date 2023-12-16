<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/temp/Dashboard-petowner-dash.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet"> <!--splide css-->
    <title>dashboard</title>
</head>
<body>

<?php require_once __DIR__ . '/../common/common_variable/index_common.php'; ?>
<?php include __DIR__ . '/../common/dashboard-top-side-bar.php'; ?>


        <main>
            <div class="header">
                <div class="left">
                    <h1>dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                            Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT; ?>/petowner" class="active"> Home</a></li>
                    </ul>
                </div>
                
            </div>

            <div class="home-box">
                    <div class="home-left">
                        <div class="home-text-large">
                            Welcome back,  <span><?php echo $_SESSION['user_fname']?>!</span>
                        </div>
                        <div class="home-text-small">
                            You have <span> 2 </span> upcoming appointments.
                        </div>
                    </div>
                    <div class="home-right">
                        <img src="<?php echo URLROOT;?>/public/img/dashboard/girlWithHeart.svg" alt="">
                    </div>
            </div>

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
                                                <div class="pet-name pet-name1"><?php echo $pet-> pet ?></div>
                                            </div>

                                    </li>

                                    <?php endforeach; ?>
      
                                </ul>
                        </div>
                    </div>
                    
                </div>

                <!-- remove .box css -->
        </main>
    </div>
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


