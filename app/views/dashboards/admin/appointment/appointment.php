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
    <title>PetCare | Appointment</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/appointment_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Appointment</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/admin">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/admin/appointment" class="active">Appointment</a></li>
                    </ul>
                </div>



               
            </div>

           

            

            <div class="bottom-data">

                <!--start od orders-->
                <div class="users" id="appointment" >
                    <div class="header">
                    <i class='bx bx-calendar' ></i>
                        <h3>Today Appointment</h3>
                    
                    
                    <!-- Search Container -->

                    <div class="search-container-table">
                        <input type="text"  id="userSearch" name="text" class="search" placeholder="Search here..">
                        <i class='bx bx-search' ></i>
                    </div>

                    <!-- search container over -->

                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Id <i class='bx bxs-sort-alt sort' data-sort="id-search"></th>
                                <th>Pet Owner <i  data-sort="petowner-search"></i></th>
                                <th>Pet <i  data-sort="pet-search"></i></th>
                                <th>Time <i  data-sort="time-search"></i></th>
                                <th>Type <i  data-sort="type-search"></i></th>
                                <th>Status <i  data-sort="status-search"></i></th>
                                
                               
                            </tr>
                        </thead>
                        <tbody class="list">

                            <?php foreach($data['appointment'] as $app) : ?>

                                <tr>
                                    <td class="id-search" >APT-<?php echo $app->id ;?></td>

                                
                                
                                    <td class="profile petowner-search">
                                        <img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/<?php echo $app->petownerProfile ; ?>">
                                        <p class="petowner-search" ><?php echo $app->first_name ; ?>  <?php echo $app->last_name ; ?></p>
                                    </td>

                                    <td class="pet-search" >
                                        <div class="profile-three">
                                        <img src="<?php echo URLROOT; ?>/public/storage/uploads/animals/<?php echo $app->petProfile ; ?>">
                                        <p><?php echo $app->pet ; ?></p>
                                        </div>
                                    </td>


                            
                                

                                    <td class="time-search" ><?php echo $app->appointment_time ; ?></td>
                                    <td class="type-search" ><?php echo $app->appointment_type ; ?></td>
                                    <td class="status-search"  style="color:#108C81; font-weight:600;"><?php echo $app->status ; ?></td>
                                
                                </tr>
                            <?php endforeach ; ?>

                            

                            

                            
                        </tbody>
                    </table>
                    <?php include __DIR__ . '/../../common/pagination_footer.php'; ?>
                </div>
 
            </div> <!-- content over -->

             
                                
        </main>

         



    </div>

   


    <!-- staff add model over -->



    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/admin/adminManageAppointments.js"></script>
    
</body>
</html>