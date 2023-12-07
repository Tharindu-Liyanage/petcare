<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/temp/Dashboard-petowner-dash.css">
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
                    <div class="pet-detail">
                        <img class="pet-image pet-image1" src="<?php echo URLROOT; ?>/public/storage/uploads/animals/pet1.png" alt="">
                        <div class="pet-name pet-name1">Rocky</div>
                    </div>
                    <div class="pet-detail">
                        <img class="pet-image pet-image1" src="<?php echo URLROOT; ?>/public/storage/uploads/animals/pet2.png" alt="">
                        <div class="pet-name pet-name1">garfield</div>
                    </div>
                    <div class="pet-detail">
                        <img class="pet-image pet-image1" src="<?php echo URLROOT; ?>/public/storage/uploads/animals/pet3.png" alt="">
                        <div class="pet-name pet-name1">Rex</div>
                    </div>
                    <div class="pet-detail">
                        <img class="pet-image pet-image1" src="<?php echo URLROOT; ?>/public/storage/uploads/animals/pet4.png" alt="">
                        <div class="pet-name pet-name1">Oreo</div>
                    </div>
                    <div class="add-details">
                        <i class='bx bx-plus-circle'></i>
                        <div>New Pet</div>
                    </div>
                    
                </div>
                <div class="box">
                    <div class="bottom-data">
                        <!-- Start of orders -->
                        <div class="orders">
                            <div class="header">
                                <div class="header-left">
                                    <h3>Appointment History</h3>
                                </div>
                                <div class="header-right">
                                    <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i>
                                </div>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Pet</th>
                                        <th>Pet Owmer</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Type</th>
                                        <th>Treatment</th>
                                        <th>Folow-up Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="profile">
                                            <img src="<?php echo URLROOT; ?>/public/storage/uploads/animals/pet1.png"><p>  Zoro</p>
                                        </td>
                                        <td>Kate Carpenter</td>
                                        <td>01-09-2023</td>
                                        <td>11.00 AM</td>
                                        <td>Grooming</td>
                                        <td class="red">Finished</td>
                                        <td class="red">
                                            None
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td class="profile">
                                            <img src="<?php echo URLROOT; ?>/public/storage/uploads/animals/pet2.png"><p>  Garfield</p>
                                        </td>
                                        <td>Ava Smith</td>
                                        <td>01-05-2023</td>
                                        <td>08.00 AM</td>
                                        <td>Vaccination</td>
                                        <td class="green">In Progress</td>
                                        <td>
                                            07-09-2023
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td class="profile">
                                            <img src="<?php echo URLROOT; ?>/public/storage/uploads/animals/pet3.png"><p>  Rex</p>
                                        </td>
                                        <td>Lily Doe</td>
                                        <td>11-10-2023</td>
                                        <td>09.00 AM</td>
                                        <td>Surgery</td>
                                        <td class="green">In Progress</td>
                                        <td>
                                            10-09-2023
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td class="profile">
                                            <img src="<?php echo URLROOT; ?>/public/storage/uploads/animals/pet3.png"><p>  Oreo</p>
                                        </td>
                                        <td>Amelia Williamson</td>
                                        <td>11-02-2023</td>
                                        <td>02.00 PM</td>
                                        <td>Dental</td>
                                        <td class="red">Finished</td>
                                        <td class="red">
                                            None
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td class="profile">
                                            <img src="<?php echo URLROOT; ?>/public/storage/uploads/animals/pet4.png"><p>  Roxky</p>
                                        </td>
                                        <td>Ava Smith</td>
                                        <td>31-09-2023</td>
                                        <td>12.00 AM</td>
                                        <td>Vaccination</td>
                                        <td class="red">Finished</td>
                                        <td class="red">
                                            None
                                        </td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                            <div class="footer-block">
                                <div class="footer-left">
                                    Showing <span class="current">5</span> out of <span class="total">25</span> entries
                                </div>
                                <div class="footer-right">
                                    <div class="previous">previous</div>
                                    <div class="page page1">1</div>
                                    <div class="page page2">2</div>
                                    <div class="page page3">3</div>
                                    <div class="page page4">4</div>
                                    <div class="page page5">5</div>
                                    <div class="next">next</div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </div>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
</body>
</html>


