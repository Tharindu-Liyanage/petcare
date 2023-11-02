<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css"> <!-- for tthe table -->
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/animalward_common.php'; ?>
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


                <div class="add-button">
             <a href="<?php echo URLROOT;?>/doctor/admitPatient" ><button id="add-form-button">
                <i class='bx bx-user-plus' ></i>
                        Admit Patient 
                </button> </a>
            </div>


               
            </div>

           

            

            <div class="bottom-data">

                <!--start od orders-->
                <div class="users">
                    <div class="header">
                    <i class='bx bx-plus-medical' ></i>
                        <h3>In Ward Patients</h3>
                        <i class='bx bx-filter' ></i>
                        <i class='bx bx-search' ></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                
                                <th>Id</th>
                                <th>Pet</th>
                                <th>Cage Id</th>
                                <th>Admit Date</th>
                                <th>Reson</th>
                                <th>Species</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                           

                            <tr>
                                <td>1</td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/pet1.png" ><p>Rex</p>
                                </td>
                                <td>3</td>
                                <td>02-03-2023</td>
                                <td>Infection</td>
                                <td>Dog</td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                           <a data-staff-id="" class="removeLink" href="" ><i class='bx bx-trash'></i></a>
                                           <a href="<?php echo URLROOT;?>/doctor/updateWardTreatment" ><i class='bx bx-edit' ></i></a>  
                                           <i class='bx bx-show'></i>   
                                           
                                    </div>
                                    
                                </td>
                            </tr>


                            <tr>
                                <td>2</td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/pet2.png" ><p>Garfield</p>
                                </td>
                                <td>5</td>
                                <td>02-05-2023</td>
                                <td>Surgeory</td>
                                <td>Cat</td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                           <a data-staff-id="" class="removeLink" href="" ><i class='bx bx-trash'></i></a>
                                           <a href="<?php echo URLROOT;?>/doctor/updateTreatment" ><i class='bx bx-edit' ></i></a>  
                                           <i class='bx bx-show'></i>   
                                           
                                    </div>
                                    
                                </td>
                            </tr>


                            <tr>
                                <td>4</td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/pet3.png" ><p>Rex</p>
                                </td>
                                <td>14</td>
                                <td>02-03-2023</td>
                                <td>Kidney disease</td>
                                <td>Dog</td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                           <a data-staff-id="" class="removeLink" href="" ><i class='bx bx-trash'></i></a>
                                           <a href="<?php echo URLROOT;?>/doctor/updateTreatment" ><i class='bx bx-edit' ></i></a>  
                                           <i class='bx bx-show'></i>   
                                           
                                    </div>
                                    
                                </td>
                            </tr>


                            <tr>
                                <td>4</td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/pet4.png" ><p>Oreo</p>
                                </td>
                                <td>2</td>
                                <td>02-03-2023</td>
                                <td>Broken bone</td>
                                <td>Cat</td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                           <a data-staff-id="" class="removeLink" href="" ><i class='bx bx-trash'></i></a>
                                           <a href="<?php echo URLROOT;?>/doctor/updateTreatment" ><i class='bx bx-edit' ></i></a> 
                                           <i class='bx bx-show'></i>    
                                           
                                    </div>
                                    
                                </td>
                            </tr>

                        
                        </tbody>
                    </table>
                </div>
 
            </div> <!-- content over -->

             
                                
        </main>

            <!-- warninig model here -->

            <div id="removeModel" class="card-all-background">
             <div class="card">
                <div class="err-header">

                        <div class="image">
                            <span class="material-symbols-outlined">warning</span>                   
                        </div>

                        <div class="err-content">
                            <span class="title">Remove Account</span>
                            <p class="message">Are you sure you want to remove this account? All of account data will be permanently removed. This action cannot be undone.</p>
                        </div>

                        <div class="err-actions">
                            <button id="confirmDelete" class="desactivate" type="button">Remove</button>
                            <button id="cancelDelete" class="cancel" type="button">Cancel</button>
                        </div>

                    </div>
                </div>
            </div>




    </div>

   


    <!-- staff add model over -->


    

    <?php

        if (($_SESSION['staff_user_added']) === true) {
           
            toast_notification("Staff Memeber Added","A new member has been added successfully.","fa-solid fa-xmark close"); 
        }

        else if (($_SESSION['staff_user_updated']) === true ) {
            toast_notification("Staff Memeber Updated","A member has been updated successfully.","fa-solid fa-xmark close"); 
            
        } else if (($_SESSION['staff_user_removed']) === true ) {
            toast_notification("Staff Memeber Removed","A member has been removed successfully.","fa-solid fa-xmark close"); 
            
        }
    
        
    
    ?>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/manageStaff.js"></script>
    
</body>
</html>