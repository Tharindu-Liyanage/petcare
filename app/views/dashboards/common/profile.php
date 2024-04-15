<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/profile.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                        <li><a href="<?php echo URLROOT; ?>" class="active"> Home</a></li>
                    </ul>
                </div>
                
            </div>
]

            <div class="bottom-data">

            <div class="box1">
                    <div class="left">
                        <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $_SESSION['user_profileimage'];?>" >   <!-- image input.....-->
                    </div>
                    <div class="middle">
                        <img src="<?php echo URLROOT; ?>/public/img/dashboard/Line 27.svg" alt="">
                    </div>
                    <div class="right">
                        <div class="name-large">
                            <?php echo $data['user']->firstname . '  ' . $data['user']->lastname ; ?> 
                        </div>
                        <div class="type">
                            <?php echo $data['user']->role ; ?>
                        </div>
                        <div class="description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, omnis nihil repudiandae incidunt temporibus doloribus sequi expedita, tempore, sapiente repellat ullam nesciunt corrupti minima. Quo aliquid voluptates qui dolore veritatis.
                        </div>
                        <div class="button-list">
                            <div class="button-container">
                                <i class='bx bx-send'></i>
                                <button class="email">Send Email</button>
                            </div>
                            <div class="button-container">
                                <i class='bx bx-phone-call'></i>
                                <button class="call">Make a Call</button>
                            </div>
                            <div class="button-container">
                                <i class='bx bx-calendar'></i>
                                <button class="appointment">Make Appointment</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box2">
                    <div class="options">
                        
                        <button class="Contact me">Contact me</button>
                    </div>
                    <div class="inner-box-1">
                        <div class="line-1">
                            <div class="text">
                                Contact me
                            </div>
                            
                        </div>
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
                                    <?php echo $data['user']->phone ; ?>
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


                    <div class="inner-box-2">
                        <div class="line-1">
                            <div class="text">
                                Social Links
                            </div>
                          
                        </div>
                        <div class="social-media">
                            <div class="social-media-container">
                                <i class='bx bxl-facebook-circle' ></i>
                                <button class="btn face-book-btn">
                                    <a href="<?php echo $data['user']->fb_ur ; ?>">Facebook</a>
                                </button>
                            </div>
                            <div class="social-media-container">
                                <i class='bx bxl-whatsapp' ></i>
                                <button class="btn whatsapp-btn">
                                    <a href="">Whatsapp</a>
                                </button>
                            </div>
                            <div class="social-media-container">
                                <i class='bx bxl-instagram-alt' ></i>
                                <button class="btn instagram-btn">
                                    <a href="<?php echo $data['user']->insta_url ; ?>">Instagram</a>
                                </button>
                            </div>
                        </div>
                    </div>

                    

                </div>

        </main>
    </div>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
</body>
</html>