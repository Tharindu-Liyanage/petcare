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
                        <li><a href="<?php echo URLROOT; ?>/assistnat" class="active"> Home</a></li>
                    </ul>
                </div>
                
            </div>

            <!--insights-->
            <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check' ></i>
                    <span class="info">
                        <?php echo count($data['pendingAppointments'])?>
                    </span>
                </li>
                <li><i class='bx bx-show-alt' ></i>
                    <span class="info">
                        <h3>10</h3>
                        <p>Pending Medical Bills</p>
                    </span></li>
                
                <li><i class='bx bx-dollar-circle' ></i>
                    <span class="info">
                        <h3>10</h3>
                        <p>Ward Empty Cages </p>
                    </span></li>
            </ul>
            <!--end of insisghts-->

            <div class="bottom-data">

                <!--start od orders-->
                <div class="users">
                    <div class="header">
                    <i class='bx bx-calendar' ></i>
                        <h3>Latest Patients</h3>
                        <i class='bx bx-filter' ></i>
                        <i class='bx bx-search' ></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                
                                <th>#</th>
                                <th>Pet Owner</th>
                                <th>Pet</th>
                                <th>Time</th>
                                <th>Type</th>
                                
                               
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
                                
                               
                            </tr>

                        </tbody>
                    </table>
                </div>
 
            </div> <!-- content over -->

        </main>
    </div>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
  
</body>
</html>