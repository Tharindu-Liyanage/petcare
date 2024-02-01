<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/dashboard/doctor/accordination.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/treatment_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Treatment</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/doctor">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/doctor/treatment" class="active">Treatment</a></li>
                    </ul>
                </div>

     <!--           <div class="add-button">
             <a href="<?php// echo URLROOT;?>/doctor/addTreatment" ><button id="add-form-button">
                <i class='bx bx-user-plus' ></i>
                        Add Treatment
                </button> </a>
            </div>
    -->

               
            </div>

           

            

            <div class="bottom-data">

                <!--start od orders-->
                <div class="users" id="treatment">
                    <div class="header">
                    <i class='bx bxs-capsule' ></i>
                        <h3>Latest Treatment</h3>
                       
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
                                <th>Pet <i class='bx bxs-sort-alt sort' data-sort="profile"></i></th>
                                <th>Visit Date <i class='bx bxs-sort-alt sort' data-sort="visit-date-search"></i></th>
                                <th>Diagnosis <i class='bx bxs-sort-alt sort' data-sort="diagnosis-search"></i></th>
                                <th>Species <i class='bx bxs-sort-alt sort' data-sort="species-search"></i></th>
                                <th>Follow-Up-Date <i class='bx bxs-sort-alt sort' data-sort="followup-search"></i></th>
                                <th>Status <i class='bx bxs-sort-alt sort' data-sort="status-search"></i></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">

                           
                        <?php foreach($data['treatment'] as $treatment): ?>
                            <tr>
                                <td class="id-search">TRT-<?php echo $treatment-> treatment_id ?></td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/<?php echo $treatment->petpic?>" ><p><?php echo $treatment->petname ?></p>
                                </td>
                                <td class="visit-date-search"><?php echo $treatment->visit_date ?></td>
                                <td class="diagnosis-search"><?php echo $treatment->diagnosis ?></td>
                                <td class="species-search"><?php echo $treatment->petspecies ?></td>
                                 <td class="followup-search"><?php echo $treatment->followup_date !== null ? $treatment->followup_date : '----------'; ?></td>

                        <?php
                                        if ($treatment->status === "Ongoing" ) {
                                            echo '<td class="status-search status-green">' . $treatment->status . '</td>';
                                        } else{
                                            echo '<td class="status-search status-red">' . $treatment->status . '</td>';
                                        }
                        ?>   
                                
                                <td class="action-reports">
                                    
                                    <a href="<?php echo URLROOT;?>/doctor/viewMedicalReport/<?php echo $treatment->treatment_id;?>" title="Show Medical Report"><i class='bx bx-show' ></i></a>
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


    
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/doctor/treatmentTable.js"></script>
    
</body>
</html>