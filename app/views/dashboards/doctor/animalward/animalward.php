<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css"> <!-- for tthe table -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/doctor/doctor-appointment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <?php require_once __DIR__ . '/../../common/favicon.php'; ?>
    <title>PetCare | AnimalWard</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/animalward_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Animal Ward</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/doctor">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/doctor/animalward" class="active">Animal Ward</a></li>
                    </ul>
                </div>

               
            </div>

           

            

            <div class="bottom-data">



                <!--start od orders-->
                <div class="users" id="admit">
                    <div class="header">
                    <i class='bx bx-plus-medical' ></i>
                        <h3>Inward Pets (<?php echo count($data['animalward']) ;?>/<?php echo count($data['cageCount']);?>)</h3>

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
                                
                                <th>Pet ID <i class='bx bxs-sort-alt sort' data-sort="id-search"></i></th>
                                <th>Pet Name <i class='bx bxs-sort-alt sort' data-sort="profile"></th>
                                <th>Pet Owner<i class='bx bxs-sort-alt sort' data-sort="profile-three"></th>
                                <th>Cage No <i class='bx bxs-sort-alt sort' data-sort="cage-no"></th>
                                <th>Reason <i class='bx bxs-sort-alt sort' data-sort="reason-search"></th>
                                <th>Admit Date <i class='bx bxs-sort-alt sort' data-sort="date-search"></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">

                            

                            <?php

                            if(count($data['animalward']) == 0){

                                echo '<td class="isempty" colspan="8">No data available in table</td>';

                            }else
                            
                            
                            foreach($data['animalward'] as $ward) : ?>

                            <tr>
                                <td class="id-search">PET-<?php echo $ward->pet_id?></td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/<?php echo $ward->petpic?>" ><p><?php echo $ward->petname?></p>
                                </td>

                                 <td>
                                    <div class="profile-three">
                                        <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $ward->petownerpic?>" >
                                    <p><?php echo $ward->petownerfname?> <?php echo $ward->petownerlname?></p>
                                    </div>
                                </td>
                                
                                <td class="cage-search"><?php echo $ward->cage_no?></td>
                                <td class="reason-search"><?php echo $ward->reason?></td>
                                <td class="date-search"><?php echo $ward->admit_date?></td>
                                
                               

                                <td class="action"> 

                                <?php if($_SESSION['user_role'] == "Doctor") : ?>
                                <a title="Treatment" class="accept" href="<?php echo URLROOT; ?>/doctor/requestPastMedicalReports/<?php echo $ward->petID;?>/ward"><i class='bx bx-chevron-right'></i></i></a>

                                <?php elseif($_SESSION['user_role'] == "Nurse") : ?>
                                    <a title="Treatment" class="accept" href="<?php echo URLROOT; ?>/nurse/requestPastMedicalReports/<?php echo $ward->petID;?>/ward"><i class='bx bx-chevron-right'></i></i></a>
                                <?php endif; ?>
                                
                                </td>


                                
                            </tr>

                        <?php endforeach;  ?>
                        </tbody>
                    </table>

                    <?php include __DIR__ . '/../../common/pagination_footer.php'; ?>


                </div>


                
 
            </div> <!-- content over -->



            <!-- ========= this is of discharge pet =================-->

            <div class="bottom-data">



                <!--start od orders-->
                <div class="users" id="discharge">
                    <div class="header">
                    <i class='bx bx-plus-medical' ></i>
                        <h3>Dischaged Pets</h3>

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
                                
                                <th>Patient Id <i class='bx bxs-sort-alt sort' data-sort="id-search"></i></th>
                                <th>Pet Name <i class='bx bxs-sort-alt sort' data-sort="profile"></th>
                                <th>Pet Owner<i class='bx bxs-sort-alt sort' data-sort="profile-three"></th>
                                <th>Reason <i class='bx bxs-sort-alt sort' data-sort="reason-search"></th>
                                <th>Dischaged Date <i class='bx bxs-sort-alt sort' data-sort="date-search"></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">

                            

                            <?php

                            if(count($data['dischargeDetails']) == 0){

                                echo '<td class="isempty" colspan="8">No data available in table</td>';

                            }else
                            
                            
                            foreach($data['dischargeDetails'] as $ward) : ?>

                            <tr>
                                <td class="id-search">PET-<?php echo $ward->pet_id?></td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/<?php echo $ward->petpic?>" ><p><?php echo $ward->petname?></p>
                                </td>

                                 <td>
                                    <div class="profile-three">
                                        <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $ward->petownerpic?>" >
                                    <p><a href="<?php echo URLROOT;?>/<?php echo $_SESSION['user_role'];?>/profilePetowner/<?php echo $ward->poid;?>"><?php echo $ward->petownerfname?> <?php echo $ward->petownerlname?></a></p>
                                    </div>
                                </td>
                                
                                <td class="reason-search"><?php echo $ward->reason?></td>
                                <td class="date-search"><?php echo $ward->discharge_date?></td>
                                
                               

                                <td class="action"> 

                                <?php if($_SESSION['user_role'] == "Doctor") : ?>
                                <a title="Treatment" class="accept" href="<?php echo URLROOT; ?>/doctor/requestPastMedicalReports/<?php echo $ward->petID;?>/ward"><i class='bx bx-chevron-right'></i></i></a>

                                <?php elseif($_SESSION['user_role'] == "Nurse") : ?>
                                    <a title="Treatment" class="accept" href="<?php echo URLROOT; ?>/nurse/requestPastMedicalReports/<?php echo $ward->petID;?>/ward"><i class='bx bx-chevron-right'></i></i></a>
                                <?php endif; ?>
                                
                                </td>


                                
                            </tr>

                        <?php endforeach;  ?>
                        </tbody>
                    </table>

                    <footer> 
                    <span>Showing <span class="foot-number">
                    <?php if( count($data['dischargeDetails']) >= 5) {

                    echo ' 
                    <select class="show-entries-2">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>

                    </span> of <span class="foot-number">' . count($data['dischargeDetails']) . '</span> entries</span>

                    
                    <div class="pagination-main">
                        <ul class="pagination"></ul>
                    </div>
                    ';


                    }else {


                        echo    count($data['dischargeDetails']) . '</span> of <span class="foot-number">' . count($data['dischargeDetails']) . '</span> entries</span>
                        
                                <div class="pagination-main">
                               
                              
                                    <ul class="pagination"></ul>
                      

                                </div>
                        ';


                    } ?>

    
                </footer>


                </div>


                
 
            </div> <!-- content over -->


            <!-- ========= this is of discharge pet  OVer =================-->


            

             
                                
        </main>

           




    </div>

   


    <!-- staff add model over -->

    <?php
     
     if ($_SESSION['notification'] == "error") {
           
        toast_notifications('Error!',$_SESSION['notification_msg'],"fas fa-solid fa-xmark check-error"); 
        
    }else if($_SESSION['notification'] == "ok"){

        toast_notifications('Succsess!',$_SESSION['notification_msg'],"fas fa-solid fa-check check"); 

    }

    ?>

 


    

<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/doctor/doctoranimalWard.js"></script>
    
</body>
</html>