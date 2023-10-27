<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/staff_common.php'; ?>
<?php require_once __DIR__ . '/../component/admin-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Staff</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/admin">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/admin/staff" class="active">Staff</a></li>
                    </ul>
                </div>



                <div class="add-button">
             <a href="<?php echo URLROOT;?>/admin/addStaff" ><button id="add-form-button">
                <i class='bx bx-user-plus' ></i>
                        Add Staff Member 
                </button> </a>
            </div>
               
            </div>

           

            

            <div class="bottom-data">

                <!--start od orders-->
                <div class="users">
                    <div class="header">
                    <i class='bx bxs-user-account main' ></i>
                        <h3>Staff</h3>
                        <i class='bx bx-filter' ></i>
                        <i class='bx bx-search' ></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($data['staff'] as $staff) : ?>

                            <tr>
                                <td><?php echo $staff->StaffID?></td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $staff->profileImage?>" ><p><?php echo $staff->firstname?> <?php echo $staff->lastname?></p>
                                </td>
                                <td><?php echo $staff->email?></td>
                                <td><?php echo $staff->address?></td>
                                <td><?php echo $staff->phone?></td>
                                <td><?php echo $staff->role?></td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                           <a data-staff-id="<?php echo $staff->StaffID?>" class="removeLink" href="<?php echo URLROOT;?>/admin/removeStaff/<?php echo $staff->StaffID ?>" ><i class='bx bx-trash'></i></a>
                                           <a href="<?php echo URLROOT;?>/admin/updateStaff/<?php echo $staff->StaffID ?>" ><i class='bx bx-edit' ></i></a>      
                                    </div>
                                    
                                </td>
                            </tr>

                        <?php endforeach; ?>
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