<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/doctor/doctor-appointment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <?php require_once __DIR__ . '/../../common/favicon.php'; ?>
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
                <div class="users" id="appointment">
                    <div class="header">
                    <i class='bx bx-calendar'></i>
                        <h3>My Appointments</h3>

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
                                <th>Pet Owner<i class='bx bxs-sort-alt sort' data-sort="profile-three"></th>
                                <th>Date <i class='bx bxs-sort-alt sort' data-sort="date-search"></th>
                                <th>Time <i class='bx bxs-sort-alt sort' data-sort="time-search"></th>
                                <th>Species <i class='bx bxs-sort-alt sort' data-sort="species-search"></th>
                                <th>Treatment <i class='bx bxs-sort-alt sort' data-sort="treatment-search"></th>
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
                                    <p><a href="<?php echo URLROOT;?>/<?php echo $_SESSION['user_role'];?>/profilePetowner/<?php echo $appointment->poid;?>"><?php echo $appointment->fname?> <?php echo $appointment->lname?></a></p>
                                    </div>
                                </td>

                                <td class="date-search"><?php echo $appointment->appointment_date?></td>
                                <td class="time-search"><?php echo $appointment->appointment_time?></td>
                                <td class="species-search"><?php echo $appointment->pet_species?></td>


                                <td class="treatment-search">
                                    
                                    <?php if($appointment->treatment_id == NULL){
                                        echo "NEW";
                                        }else{
                                            echo 'TRT-'. $appointment->treatment_id;
                                        
                                        } ?>
                                </td>



                                <td class="type-search"><?php echo $appointment->appointment_type?></td>

                                   
                                <?php
                                        if ($appointment->status === "Confirmed" || $appointment->status === "Completed" ) {
                                            echo '<td class="status-search status-green">' . $appointment->status . '</td>';
                                        } else if($appointment->status === "Pending") {
                                            echo '<td class="status-search status-yellow">' . $appointment->status . '</td>';
                                        }else{
                                            echo '<td class="status-search status-red">' . $appointment->status . '</td>';
                                        }

                                      
                                        
                                        
                                ?>

                                <td class="action"> 
                                    <?php 
                                        if ($appointment->status != "Pending" AND $appointment->status != "Completed" AND $appointment->status != "Rejected" ) : ?>
                                        
                                            <a title="Treatment" class="accept" href="<?php echo URLROOT; ?>/doctor/requestPastMedicalReports/<?php echo $appointment->pet_id;?>/appointment"><i class="bx bx-check"></i></a>
                                        <?php endif; ?>
                                
                                </td>


                                
                            </tr>

                        <?php endforeach;  ?>
                        </tbody>
                    </table>

                    <?php include __DIR__ . '/../../common/pagination_footer.php'; ?>


                </div>
 
            </div> <!-- content over -->

             
                                
        </main>

         



    </div>

    <?php
     
     if ($_SESSION['notification'] == "error") {
           
        toast_notifications('Error!',$_SESSION['notification_msg'],"fas fa-solid fa-xmark check-error"); 
        
    }else if($_SESSION['notification'] == "ok"){

        toast_notifications('Succsess!',$_SESSION['notification_msg'],"fas fa-solid fa-check check"); 

    }

    ?>

   


    <!-- staff add model over -->


    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/doctor/doctorAppointmentTable.js"></script>
    
</body>
</html>