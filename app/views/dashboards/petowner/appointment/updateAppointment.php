<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/temp/Dashboard-petowner-pet-add appointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/appointment_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Pet</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/petowner">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/petowner/pet" class="active">Pet</a></li>
                    </ul>
                </div>


              
               
            </div>

            <!-- appointmetn add here -->

            <div class="box">
                    <div class="title-line">
                        <i class='bx bxs-user-account'></i>
                        <div class="title-line-text">Update  Appointment</div>
                    </div>
                    <div class="bottom-part">
                        <div class="left">
                            <div class="pet ">
                                <div class="pet-text">Pet</div>
                                <div class="pet-box">
                                    <i class='bx bxs-dog' ></i>
                                    <select id="my-selection" class="selection-dropdown">
                                        <option value="option1" selected>Rex</option>
                                        <option value="option2">maggy</option>
                                        <option value="option3">leena</option>
                                        <option value="option4">Yaara</option>
                                    </select>
                                </div>
                            </div>
                            <div class="veterinarian">
                                <div class="veterinarian-text">Veterinarian </div>
                                <div class="veterinarian-box">
                                    <i class='bx bx-user-circle'></i>
                                    <select id="my-selection" class="selection-dropdown">
                                        <option value="option1">nolan</option>
                                        <option value="option2">nisar</option>
                                        <option value="option3" selected>Lily doe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="type">
                                <div class="type-text"> type </div>
                                <div class="type-box">
                                    <i class='bx bxs-dashboard' ></i>
                                    <select id="my-selection" class="selection-dropdown">
                                        <option value="option1" selected>Vaccine</option>
                                        <option value="option2">checkup</option>
                                        <option value="option3">treatment 3</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="right">
                            <div class="date">
                                <div class="date-text"> Date</div>
                                <div class="date-box">
                                    <i class='bx bx-calendar' ></i>
                                    <input type="date" id="date" class="date-input" value="2023-11-05">
                                </div>
                                
                            </div>
                            <div class="time">
                                <div class="time-text"> Time </div>
                                <div class="time-box">
                                    <i class='bx bx-time' ></i>
                                    <input type="time" id="time" class="time-input" value="11:00" >
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="footer">
                        <div class="button-set">
                            <button class="reset-button">Reset</button>
                            <button class="update-button">Update</button>
                        </div>
                    </div>
                </div>
                

           



             
                                
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


    

    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/manageStaff.js"></script>
    
</body>
</html>