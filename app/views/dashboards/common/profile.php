<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>dashboard</title>
</head>
<body>

<?php include __DIR__ . '/../common/index_common.php'; ?>
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
                        <img src="../img/profile photo.svg" alt="">
                    </div>
                    <div class="middle">
                        <img src="../img/Line 27.svg" alt="">
                    </div>
                    <div class="right">
                        <div class="name-large">
                            Ava Smith
                        </div>
                        <div class="type">
                            Veterinarian
                        </div>
                        <div class="description">
                            I am a Peradeniya BVSc veterinarian, dedicated to animal well-being, passionate about compassionate care, and committed to enhancing their lives.
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
                        <button class="appointment">Appointment</button>
                        <button class="Contact me">Contact me</button>
                    </div>
                    <div class="inner-box-1">
                        <div class="line-1">
                            <div class="text">
                                Contact me
                            </div>
                            <div class="button-container">
                                <i class='bx bxs-edit' ></i>
                                <button class="edit">Edit</button>
                            </div>
                        </div>
                        <div class="line-2">
                            <div class="email">
                                <div class="email-text">
                                    Email
                                </div>
                                <div class="email-address inner-text">
                                    annamarie@petcare.com
                                </div>
                            </div>
                            <div class="phone">
                                <div class="phone-text">
                                    Phone
                                </div>
                                <div class="phone-number inner-text">
                                    (+94) 077-1234567
                                </div>
                            </div>
                            <div class="address">
                                <div class="address-text ">
                                    Address
                                </div>
                                <div class="address-line inner-text">
                                    290 Chatham Way Reston, Maryland(MD), 20191
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="inner-box-2">
                        <div class="line-1">
                            <div class="text">
                                Social Links
                            </div>
                            <div class="button-container">
                                <i class='bx bxs-edit' ></i>
                                <button class="edit">Edit</button>
                            </div>
                        </div>
                        <div class="social-media">
                            <div class="social-media-container">
                                <i class='bx bxl-facebook-circle' ></i>
                                <button class="btn face-book-btn">Facebook</button>
                            </div>
                            <div class="social-media-container">
                                <i class='bx bxl-whatsapp' ></i>
                                <button class="btn whatsapp-btn">Whatsapp</button>
                            </div>
                            <div class="social-media-container">
                                <i class='bx bxl-instagram-alt' ></i>
                                <button class="btn instagram-btn">Instagram</button>
                            </div>
                        </div>
                    </div>

                    

                </div>

        </main>
    </div>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
</body>
</html>