<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/doctor/doctor-appointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/greenCard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>

    <style>
        .enter-reason{
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .enter-reason p{
            margin-bottom: 5px;
        }

        .enter-reason input{
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/pet_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Pet</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/doctor">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/doctor/pet" class="active">Pet</a></li>
                    </ul>
                </div>



               
            </div>

           

            

            <div class="bottom-data">
                       


                    <div class="users" id="pet">
                    <div class="header">
                    <i class='bx bxs-dog' ></i>
                        <h3>Pet</h3>

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
                                <th>Pet owner<i class='bx bxs-sort-alt sort' data-sort="profile-three"></th>
                                <th>Age <i class='bx bxs-sort-alt sort' data-sort="age-search"></th>
                                <th>Breed <i class='bx bxs-sort-alt sort' data-sort="breed-search"></th>
                                <th>Species <i class='bx bxs-sort-alt sort' data-sort="species-search"></th>
                                <th>Sex <i class='bx bxs-sort-alt sort' data-sort="sex-search"></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">


                        <?php

                                if(count($data['pet']) == 0){

                                    echo '<td class="isempty" colspan="8">No data available in table</td>';

                                }else


                                foreach($data['pet'] as $petdetails) : ?>

<tr>
                                <td class="id-search"><?php echo $petdetails->pet_id_generate?></td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/<?php echo $petdetails->petpic?>" ><p><?php echo $petdetails->pet?></p>
                                </td>

                                 <td>
                                    <div class="profile-three">
                                        <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $petdetails->petownerpic?>" >
                                    <p><?php echo $petdetails->petownerfname?> <?php echo $petdetails->petownerlname?></p>
                                    </div>
                                </td>

                                <td class="age-search"><?php echo $petdetails->DOB?></td>
                                <td class="breed-search"><?php echo $petdetails->breed?></td>
                                <td class="species-search"><?php echo $petdetails->species?></td>
                                <td class="sex-search"><?php echo $petdetails->sex?></td>

                                  


                                
                                <td class="action"> 
                                   
                                           
                                  <!--  <a title="Reject" class="rej"><i class="bx bx-block"></i></a> -->

                                  

                                  <?php if($_SESSION['user_role'] == 'Doctor'): ?>
                                    <a href="<?php echo URLROOT; ?>/doctor/addmitPet/<?php echo $petdetails->petid;?>" class="removeLink rej" title="Admit"><i class='bx bx-plus'></i></a>
                                    <a title="Treatment" class="accept" href="<?php echo URLROOT; ?>/doctor/requestPastMedicalReports/<?php echo $petdetails->petid;?>/emergency"><i class="bx bx-check"></i></a>
                                  <?php elseif($_SESSION['user_role'] == 'Nurse'): ?>
                                    <a title="Treatment" class="accept" href="<?php echo URLROOT; ?>/nurse/requestPastMedicalReports/<?php echo $petdetails->petid;?>/emergency"><i class="bx bx-check"></i></a>
                                  <?php endif; ?>
                                
                                </td>
                                    

                                <?php endforeach;  ?>

                            

                                    

                               
                           

                            

                        </tbody>
                    </table>

                    <?php  include __DIR__ . '/../../common/pagination_footer.php'; ?>


                </div>
 
            </div> <!-- content over -->

             
                                
        </main>

           <!-- warninig model here -->
           <!-- warninig model here -->

           <div id="removeModel" class="card-all-background">
             <div class="card">
                <div class="err-header">

                        <div class="image">
                            <span class="material-symbols-outlined">warning</span>                   
                        </div>

                        <div class="err-content">
                            <span class="title">Admit to the ward</span>
                            <p class="message">Please confirm the admission of your pet to the hospital ward.</p>
                            
                        </div>

                        <div class="err-actions">
                            <div class="enter-reason">
                                <p>Enter reason for admission</p>
                                <input type="text" class="input" placeholder="Enter Reason" id ="reason">
                            </div>
                            
                            <button id="confirmDelete" class="desactivate" type="button">Addmit</button>
                            <button id="cancelDelete" class="cancel" type="button">Cancel</button>
                        </div>

                    </div>
                </div>
            </div>








    </div>

   


    <!-- staff add model over -->


    

    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/doctor/petTable.js"></script>
    
</body>
</html>