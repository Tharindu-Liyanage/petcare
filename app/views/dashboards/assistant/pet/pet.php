<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/temp/Dashboard- Assistant-pet.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>dashboard</title>
</head>
<body>

<?php require_once __DIR__ . '/../../common/common_variable/pet_common.php'; ?>
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
                        <li><a href="<?php echo URLROOT; ?>/assistant/pet" class="active">Pet</a></li>
                    </ul>
                </div>


     <!-- =================  Button ================ -->           
                <div class="add-button">
             <a href="<?php echo URLROOT;?>/assistant/addPet" ><button id="add-form-button">  <!-- href eka , /assistant/addPets kiyala , addPet remove karapu nisa  -->
                <i class='bx bxs-dog' ></i>
                        Add PET
                </button> </a>
            </div>

     <!-- =================  Button OVER ================ -->
                
            </div>

           

            <div class="bottom-data">

<!--start od orders-->
<div class="users" id="pet">
    <div class="header">
    <i class='bx bxs-dog'></i>
        <h3>Pet</h3>

        <!-- Search Container -->

    <div class="search-container-table">
     <input type="text"  id="petSearch" name="text" class="search" placeholder="Search here..">
     <i class='bx bx-search' ></i>
    </div>

    <!-- search container over -->

        
    </div>
    <table>
        <thead>
            <tr>
                
                <th>Id <i class='bx bxs-sort-alt sort' data-sort="id-search"></th>
                <th>Pet<i class='bx bxs-sort-alt sort' data-sort="profile"></th>
                <th>Petowner<i class='bx bxs-sort-alt sort' data-sort="profile-three"></th>
                <th>DOB <i class='bx bxs-sort-alt sort' data-sort="dob-search"></th>
                <th>breed <i class='bx bxs-sort-alt sort' data-sort="breed-search"></th>
                <th>sex<i class='bx bxs-sort-alt sort' data-sort="sex-search"></th>
                <th>Action </th>
            </tr>
        </thead>
        <tbody class="list">

        <?php

            if(count($data['pet']) == 0){ // database eke data naththn 0

                echo '<td class="isempty" colspan="7">No data available in table</td>';

            }else

           
             foreach($data['pet'] as $pet) : ?>

            
            <tr>
                <td class="id-search"><?php echo $pet->pet_id_generate?></td>
                <td class="profile">
                    <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/<?php echo $pet-> petImage ?>" ><p> <?php echo $pet-> pet?>  
                </td>

                <td>
                  <div class="profile-three">
                     <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $pet->petownerImage?>" >
                     <a href="<?php echo URLROOT; ?>/assistant/profilePetowner/<?php echo $pet->petownerid?>"><?php echo $pet-> petownerfname?>  <?php echo $pet-> petownerlname?></a></p>
                  </div>
                </td>
                <td class="dob-search"><?php echo $pet->DOB?></td>
                <td class="breed-search"><?php echo $pet->breed?></td>
                <td class="sex-search"><?php echo $pet->sex?></td>
                
                <td class="action">
                    
                    <div class="act-icon">

                    <a href="<?php echo URLROOT;?>/assistant/updatePet/<?php echo $pet->petid?>" ><i class='bx bx-edit' ></i></a>
                          
                           
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
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/assistant/petTable.js"></script>
</body>
</html>