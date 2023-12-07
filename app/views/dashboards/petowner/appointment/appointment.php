<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/petowner/Dashboard-petowner-appointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/appointment_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Appointment</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/petowner">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/petowner/appointment" class="active">Appointment</a></li>
                    </ul>
                </div>


              
               
            </div>

            <!-- appointmetn here -->

            <div class="appointment-box">
                    <div class="apppoitnment-left">
                        <div class="appointment-text-large">
                            Need an Appointment?
                        </div>
                        <div class="appointment-text-down">
                        <a style="text-decoration:none;" href="<?php echo URLROOT;?>/petowner/addAppointment"><i class='bx bx-plus-circle'></i></a>
                            <div class="appointment-text-down-small">
                                Appointment
                            </div>
                        </div>
                    </div>
                    <div class="apppoitnment-right">
                        <img src="<?php echo URLROOT;?>/public/img/dashboard/petowner-appointment.svg" alt="">
                    </div>
                </div>


                
                    <div class="bottom-data">
                       


                    <div class="users" id="appointment">
                    <div class="header">
                    <i class='bx bx-calendar'></i>
                        <h3>Appointment</h3>

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
                                
                                <th>Id <i class='bx bxs-sort-alt sort' data-sort="id-search"></i></th>
                                <th>Pet Name <i class='bx bxs-sort-alt sort' data-sort="profile"></th>
                                <th>Veterinarian<i class='bx bxs-sort-alt sort' data-sort="profile-three"></th>
                                <th>Date <i class='bx bxs-sort-alt sort' data-sort="date-search"></th>
                                <th>Time <i class='bx bxs-sort-alt sort' data-sort="time-search"></th>
                                <th>Species <i class='bx bxs-sort-alt sort' data-sort="species-search"></th>
                                <th>Type <i class='bx bxs-sort-alt sort' data-sort="type-search"></th>
                                <th>Status <i class='bx bxs-sort-alt sort' data-sort="status-search"></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">

                            

                            <?php

                            if(count($data['appointment']) == 0){

                                echo '<td class="isempty" colspan="8">No data available in table</td>';

                            }else
                            
                            
                            foreach($data['appointment'] as $appointment) : ?>

                            <tr>
                                <td class="id-search"><?php echo $appointment->appointment_id?></td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/<?php echo $appointment->propic?>" ><p><?php echo $appointment->pet_name?></p>
                                </td>

                                 <td>
                                    <div class="profile-three">
                                        <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $appointment->vetpic?>" >
                                    <p><?php echo $appointment->fname?> <?php echo $appointment->lname?></p>
                                    </div>
                                </td>

                                <td class="date-search"><?php echo $appointment->appointment_date?></td>
                                <td class="time-search"><?php echo $appointment->appointment_time?></td>
                                <td class="species-search"><?php echo $appointment->pet_species?></td>
                                <td class="type-search"><?php echo $appointment->appointment_type?></td>

                                   
                                <?php
                                        if ($appointment->status === "Confirmed" || $appointment->status === "Completed" ) {
                                            echo '<td class="status-search status-green">' . $appointment->status . '</td>';
                                        } else {
                                            echo '<td class="status-search status-red">' . $appointment->status . '</td>';
                                        }

                                        //action restricted for reshedule appoitments
                                        
                                        if ($appointment->status === "Confirmed") {
                                            echo '<td class="action"> <div class="act-icon"> <a href="' . URLROOT . '/petowner/updateAppointment/' . $appointment->id . '"><i class="bx bx-edit"></i></a> </div> </td>';
                                        } else {
                                            echo '<td class="action"> ---  </td>';
                                        }

                                ?>

                                
                            </tr>

                        <?php endforeach;  ?>
                        </tbody>
                    </table>

                    <?php include __DIR__ . '/../../common/pagination_footer.php'; ?>


                </div>
 
            </div> <!-- content over -->


           



             
                                
        </main>

                      

           




    </div>

   


  


    
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/petowner/appointmentTable.js"></script>
    
</body>
</html>