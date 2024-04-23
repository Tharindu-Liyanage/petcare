<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/temp/Dashboard- Assistant-petowner.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>dashboard</title>
</head>
<body>

<?php require_once __DIR__ . '/../../common/common_variable/petowner_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


        <main>
            <div class="header">
                <div class="left">
                    <h1>dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT; ?>/assistant">
                            Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT; ?>/assistant/petowner" class="active">Petowner</a></li>
                    </ul>
                </div>

                <!-- button is here -->

                <!-- change href to <?php echo URLROOT;?>/assistant/addPetowner (assistant is controller , addPetowner is method)  AND Add Staff Member to Add Petowner -->

                <div class="add-button">
             <a href="<?php echo URLROOT;?>/assistant/addPetowner" ><button id="add-form-button">
                <i class='bx bx-user-plus' ></i>
                        Add PET OWNER
                </button> </a>
            </div>


                   
            </div>

            

           

            <div class="bottom-data">

            

<!--start od orders-->
<div class="users" id="petowner">
    <div class="header">
    <i class='bx bx-user'></i>
        <h3>Petowner</h3>

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
                <th>Petowner <i class='bx bxs-sort-alt sort' data-sort="profile"></th>
                <th>Address <i class='bx bxs-sort-alt sort' data-sort="address-search"></th>
                <th>Mobile <i class='bx bxs-sort-alt sort' data-sort="mobile-search"></th>
                <th>Email <i class='bx bxs-sort-alt sort' data-sort="email-search"></th>
                <th>Action </th>
            </tr>
        </thead>
        <tbody class="list">

        <?php

            if(count($data['petowner']) == 0){

                echo '<td class="isempty" colspan="7">No data available in table</td>';

            }else

           
             foreach($data['petowner'] as $petowner) : ?>

            
            <tr>
                <td class="id-search"><?php echo $petowner->petowner_id_generate?></td>
                <td class="profile">
                    <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $petowner-> profileImage ?>" ><p> <a href="<?php echo URLROOT; ?>/assistant/profilePetowner/<?php echo $petowner->id?>"><?php echo $petowner-> first_name?>  <?php echo $petowner-> last_name?></a></p>
             </td>
                <td class="address-search"><?php echo $petowner->address?></td>
                <td class="mobile-search"><?php echo $petowner->mobile?></td>
                <td class="email-search"><?php echo $petowner->email?></td>
                
                <td class="action">
                    
                    <div class="act-icon">

                    <a href="<?php echo URLROOT;?>/assistant/updatePetowner/<?php echo $petowner->id?>" ><i class='bx bx-edit' ></i></a>   
                           
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
        <?php
     //view notifications-------
        if ($_SESSION['notification'] == "error") {
            
            toast_notifications("Changes Applied Failed",$_SESSION['notification_msg'],"bx bx-x check-error"); 
            
        }else if($_SESSION['notification'] == "ok"){

            toast_notifications("Changes Applied Succussfull!",$_SESSION['notification_msg'],"fas fa-solid fa-check check"); 
            
        }

    ?>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script> <!-- notification ekk blnn-->
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/assistant/petownerTable.js"></script>
    
</body>
</html>

