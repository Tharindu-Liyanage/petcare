<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/petowner/Dashboard-petowner-appointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/dashboard/petowner/medicalReport.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>

    <style>
   
        td{
            user-select: none;
        }
  </style>


</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/animalward_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Ward Medical Reports</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/petowner">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/petowner/animalWard" class="active">Animal Ward</a></li>
                    </ul>
                </div>


              
               
            </div>

            <!-- Medical report here -->

           

                
                    <div class="bottom-data">
                       


                    <div class="users" id="medicalreport">
                    <div class="header">
                    <i class='bx bx-first-aid' ></i>
                        <h3>Ward Medical Reoprt</h3>

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
                                <th>Diagnosis <i class='bx bxs-sort-alt sort' data-sort="diagnosis-search"></th>
                                <th>Last update <i class='bx bxs-sort-alt sort' data-sort="lastupdate-search"></th>
                                <th>Status <i class='bx bxs-sort-alt sort' data-sort="status-search"></th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">


                        <?php

                                if(count($data['animalward']) == 0){

                                    echo '<td class="isempty" colspan="8">No data available in table</td>';

                                }else


                                foreach($data['animalward'] as $medicalreport) : ?>

<tr>
                                <td class="id-search">AWT-<?php echo $medicalreport->treatment_id?></td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/<?php echo $medicalreport->petpic?>" ><p><?php echo $medicalreport->petname?></p>
                                </td>

                                 <td>
                                    <div class="profile-three">
                                        <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $medicalreport->vetpic?>" >
                                    <p><?php echo $medicalreport->vetfname?> <?php echo $medicalreport->vetlname?></p>
                                    </div>
                                </td>

                                <td class="diagnosis-search"><?php echo $medicalreport->diagnosis?></td>
                                <td class="lastupdate-search"><?php echo $medicalreport->lastupdate?></td>
                                
                                <?php
                                        if ($medicalreport->status === "In Progress" ) {
                                            echo '<td class="status-search status-green">' . $medicalreport->status . '</td>';
                                        } else{
                                            echo '<td class="status-search status-red">' . $medicalreport->status . '</td>';
                                        }
                                ?>       


                                
                                <td class="action">
                                    <div class="act-icon">
                                        <a href="<?php echo URLROOT;?>/petowner/showWardMedicalReport/<?php echo $medicalreport->treatment_id; ?>"><i class='bx bx-show' ></i></a>
                                    </div>
                                </td>
                                    

                                <?php endforeach;  ?>

                            

                                    

                               
                           

                            

                        </tbody>
                    </table>

                    <?php  include __DIR__ . '/../../common/pagination_footer.php'; ?>


                </div>
 
            </div> <!-- content over -->

        </main>
    </div>

    
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/petowner/WardmedicalReportTable.js"></script>
    
</body>
</html>