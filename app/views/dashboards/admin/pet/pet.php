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
    <title>PetCare | Pet</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/pet_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Pet</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/admin">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/admin/pet" class="active">Pet</a></li>
                    </ul>
                </div>



               
            </div>

           

            

            <div class="bottom-data">

                <!--start od orders-->
                <div class="users" id="pet">
                    <div class="header">
                    <i class='bx bxs-dog' ></i>
                        <h3>Pets</h3>

                        <div class="search-container-table">
                            <input type="text"  id="userSearch" name="text" class="search" placeholder="Search here..">
                            <i class='bx bx-search' ></i>
                        </div>

                    </div>
                    <table>
                        <thead>
                            <tr>
                                
                                <th>Id <i class='bx bxs-sort-alt sort' data-sort="id-search"></th>
                                <th>Pet <i class='bx bxs-sort-alt sort' data-sort="profile"></th>
                                <th>Pet Owner <i class='bx bxs-sort-alt sort' data-sort="profile"></th>
                                <th>DOB </th>
                                <th>Breed <i class='bx bxs-sort-alt sort' data-sort="breed-search"></th>
                                <th>Sex <i class='bx bxs-sort-alt sort' data-sort="sex-search"></th>
                              
                                <th>Species <i class='bx bxs-sort-alt sort' data-sort="species-search"></th>
                         <?php if($_SESSION['user_role'] == 'Admin')   echo  " <th>Action</th> " ;?>
                            </tr>
                        </thead>
                        <tbody class="list">

                        <?php

                            if(count($data['pet']) == 0){

                                echo '<td class="isempty" colspan="8">No data available in table</td>';

                            }else

                            foreach($data['pet'] as $pet) : ?>

                                <tr>
                                    <td class="id-search">PET-<?php echo $pet->id ; ?></td>
                                    <td class="profile">
                                        <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/<?php echo $pet->profileImage ; ?>" ><p><?php echo $pet->pet ; ?></p>
                                    </td>
                                    <td class="po-search">
                                        <div class="profile-three">
                                        <img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/<?php echo $pet->poimg ; ?>">
                                        <p><a href="<?php echo URLROOT;?>/admin/profilePetowner/<?php echo $pet->poid;?>"><?php echo $pet->petownerfname ; ?> <?php echo $pet->petownerlname ; ?></a></p>
                                        </div>
                                    </td>
                                    <td><?php echo $pet->DOB ; ?></td>
                                    <td class="breed-search"><?php echo $pet->breed ; ?></td>
                                    <td class="sex-search"><?php echo $pet->sex ; ?></td>
                                   
                                    <!-- need to change -->
                                    <td class="species-search"><?php echo $pet->species ; ?></td>

                                    <?php if ($_SESSION['user_role'] == 'Admin') { ?>
                                            <td class="action">
                                                <div class="act-icon">
                                                    <a petowner-id="<?php echo $pet->id ; ?>" class="removeLink" href="<?php echo URLROOT;?>/admin/removePet/<?php echo $pet->id ?>"><i class='bx bx-trash'></i></a>
                                                    <a href="<?php echo URLROOT; ?>/admin/updatePet/<?php echo $pet->id ; ?>"><i class='bx bx-edit'></i></a>
                                                </div>
                                            </td>
                                    <?php } ?>

                                    
                                </tr>
                            <?php endforeach ; ?>


                        
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


    
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/admin/petTable.js"></script>
    
</body>
</html>