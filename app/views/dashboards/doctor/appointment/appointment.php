<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/appointment_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Appointment</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/doctor">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/doctor/appointment" class="active">Appointment</a></li>
                    </ul>
                </div>



               
            </div>

           

            

            <div class="bottom-data">

                <!--start od orders-->
                <div class="users">
                    <div class="header">
                    <i class='bx bx-calendar' ></i>
                        <h3>Today Appointment</h3>
                        <i class='bx bx-filter' ></i>
                        <i class='bx bx-search' ></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                
                                <th>Id</th>
                                <th>Pet Owner</th>
                                <th>Pet</th>
                                <th>Time</th>
                                <th>Type</th>
                                <th>Status</th>
                               
                            </tr>
                        </thead>
                        <tbody>

                        

                            <tr>
                                <td>1</td>

                               
                              
                                <td class="profile">
                                    <img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/user1.jpg">
                                    <p>John Doe</p>
                                </td>

                                <td>
                                    <div class="profile-three">
                                    <img src="<?php echo URLROOT; ?>/public/storage/uploads/animals/pet1.png">
                                    <p>Rex</p>
                                    </div>
                                </td>


                           
                              

                                <td>10.00 AM</td>
                                <td>Dental</td>
                                <td style="color:#108C81; font-weight:600;">Completed</td>
                               
                            </tr>

                            <tr>
                                <td>2</td>

                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/user2.jpeg" ><p>Anna Marie</p>
                                </td>

                                <td>
                                    <div class="profile-three">
                                    <img src="<?php echo URLROOT; ?>/public/storage/uploads/animals/pet2.png">
                                    <p>Kitty</p>
                                    </div>
                                </td>
                                <td>10.30 AM</td>
                                <td>Dental</td>
                                <td style="color:#108C81; font-weight:600;">Completed</td>
                               
                            </tr>

                            <tr>
                                <td>3</td>

                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/user3.jpeg" ><p>John Doe</p>
                                </td>

                                <td>
                                    <div class="profile-three">
                                    <img src="<?php echo URLROOT; ?>/public/storage/uploads/animals/pet3.png">
                                    <p>Rocky</p>
                                    </div>
                                </td>
                                <td>11.00 AM</td>
                                <td>Dental</td>
                                <td style="color:#DE1C53; font-weight:600;">Reshedule</td>
                               
                            </tr>

                            <tr>
                                <td>4</td>

                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/user4.jpeg" ><p>John Doe</p>
                                </td>

                                <td>
                                    <div class="profile-three">
                                    <img src="<?php echo URLROOT; ?>/public/storage/uploads/animals/pet4.png">
                                    <p>Rex</p>
                                    </div>
                                </td>
                                <td>11.30 AM</td>
                                <td>Dental</td>
                                <td style="color:#DE1C53; font-weight:600;">Cenceled</td>
                               
                            </tr>

                        </tbody>
                    </table>
                </div>
 
            </div> <!-- content over -->

             
                                
        </main>

         



    </div>

   


    <!-- staff add model over -->



    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    
</body>
</html>