<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/doctor/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css"> <!-- for two pic table -->
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
                        <li><a href="<?php echo URLROOT; ?>/doctor" class="active"> Home</a></li>
                    </ul>
                </div>
                
            </div>

            <div class="home-box">
                    <div class="home-left">
                        <div class="home-text-large">
                        <?php echo $data['greetingmsg']; ?>,  <span><?php echo $_SESSION['user_fname']?></span>
                        </div>
                        <div class="home-text-small">
                            You have <span> 20 </span> upcoming appointments.
                        </div>
                    </div>
                    <div class="home-right">
                        <img src="<?php echo URLROOT;?>/public/img/dashboard/girlWithHeart.svg" alt="">
                    </div>
                </div>

                <div class="home-box2" id="appointmentDetails-container">

                <?php

                    if($data['appointmentDetails'] == null){

                        echo '

                       
                    <div class="home-left2">
                        <div class="home-text-large">
                           Currently, <span  id="petName">No Appointments!</span>
                        </div> 
                    </div>
                    <div class="home-right">
                    <img id="petImage" src="' . URLROOT . '/public/img/dashboard/noappointment.svg" alt="">
                    </div>
                ';

                    
                    }else{

                        echo '

                        
                    <div class="home-left2">
                        <div class="home-text-large">
                            Time for Treatment, <span id="petName">'. $data['appointmentDetails']->pet .'!</span>
                        </div>
                        <div class="date-time-type">
                            <div>Date : <span id="appointmentDate">'. $data['appointmentDetails']->appointment_date .'</span></div>
                            <div>Time : <span id="appointmentTime">'. $data['appointmentDetails']->appointment_time .'</span></div>
                            <div>Type : <span id="appointmentType">'. $data['appointmentDetails']->appointment_type .'</span></div>
                        </div>
                        <div class="buttons">
                            <button class="button cancel-button">Cancel</button>
                            <button class="button treatment-button">Treatment</button>
                        </div>
                    </div>
                    <div class="home-right">
                    <img id="petImage" src="' . URLROOT . '/public/storage/uploads/animals/'. $data['appointmentDetails']->profileImage .'" alt="">
                    </div>
                     ';

                    }

                ?>

                </div>
                

                <!-- latest patient table is here -->

                <div class="bottom-data">

                <!--start od orders-->
                <div class="users" style="margin-bottom:50px;">
                    <div class="header">
                    <i class='bx bx-walk' style="font-size:2.5rem;"></i>
                        <h3>Latest Patients</h3>
                        <i class='bx bx-filter' ></i>
                        <i class='bx bx-search' ></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                
                                <th>Id</th>
                                <th>Pet Owner</th>
                                <th>Pet</th>
                                <th>Date</th>
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


                           
                              
                                <td>3-11-2023</td>
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

                                <td>3-11-2023</td>
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

                                <td>3-11-2023</td>
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

                                <td>3-11-2023</td>
                                <td>11.30 AM</td>
                                <td>Dental</td>
                                <td style="color:#DE1C53; font-weight:600;">Cenceled</td>
                               
                            </tr>

                        </tbody>
                    </table>
                </div>
 
            </div> <!-- content over -->

                <!-- latest patient is over -->

        </main>
    </div>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/doctor/doctorMain.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</body>
</html>