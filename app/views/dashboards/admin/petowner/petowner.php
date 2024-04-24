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
    <?php require_once __DIR__ . '/../../common/favicon.php'; ?>
    <title>PetCare | Petowner</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/petowner_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Pet Owner</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/admin">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/admin/petowner" class="active">Pet Owner</a></li>
                    </ul>
                </div>



               
            </div>

           

            

            <div class="bottom-data">

                <!--start od orders-->
                <div class="users" id="petowner">
                    <div class="header">
                    <i class='bx bxs-user-account main' ></i>
                        <h3>Pet Owners</h3>

                        <div class="search-container-table">
                            <input type="text"  id="userSearch" name="text" class="search" placeholder="Search here..">
                            <i class='bx bx-search' ></i>
                         </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                
                                <th>Id <i class='bx bxs-sort-alt sort' data-sort="id-search"></th>
                                <th>Name <i class='bx bxs-sort-alt sort' data-sort="profile"></th>
                                <th>Email <i class='bx bxs-sort-alt sort' data-sort="email-search"></th>
                                <th>Address <i class='bx bxs-sort-alt sort' data-sort="address-search"></th>
                                <th>Phone <i class='bx bxs-sort-alt sort' data-sort="phone-search"></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">

                        <?php

                            if(count($data['petowner']) == 0){

                                echo '<td class="isempty" colspan="8">No data available in table</td>';

                            }else

                            foreach($data['petowner'] as $petowner) : ?>

                            <tr>
                                <td class="id-search"><?php echo $petowner->petowner_id_generate?></td>
                                <td class="profile">
                                   
                                    <a href="<?php echo URLROOT;?>/admin/profilePetowner/<?php echo $petowner->id; ?>">
                                        <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $petowner->profileImage?>" ><p><?php echo $petowner->first_name?> <?php echo $petowner->last_name?></p>
                                    </a>
                              
                                </td>
                                <td class="email-search"><?php echo $petowner->email?></td>
                                <td class="address-search"><?php echo $petowner->address?></td>
                                <td class="phone-search"><?php echo $petowner->mobile?></td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                           <a petowner-id="<?php echo $petowner->id?>" class="removeLink" href="<?php echo URLROOT;?>/admin/removePetowner/<?php echo $petowner->id ?>" ><i class='bx bx-trash'></i></a>
                                           <a href="<?php echo URLROOT;?>/admin/updatePetowner/<?php echo $petowner->id ?>" ><i class='bx bx-edit' ></i></a>        
                                    </div>
                                    
                                </td>
                            </tr>

                        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?php include __DIR__ . '/../../common/pagination_footer.php'; ?>
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
     
     if ($_SESSION['notification'] == "error") {
           
        toast_notifications('Error!',$_SESSION['notification_msg'],"fas fa-solid fa-xmark check-error"); 
        
    }else if($_SESSION['notification'] == "ok"){

        toast_notifications('Succsess!',$_SESSION['notification_msg'],"fas fa-solid fa-check check"); 

    }

    ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/admin/petownerTable.js"></script>
    
</body>
</html>