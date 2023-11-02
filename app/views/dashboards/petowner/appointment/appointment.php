<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/temp/Dashboard-petowner-appointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/appointment_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Appointment</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/petowner">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/petowner/appointment" class="active">Appointment</a></li>
                    </ul>
                </div>


              
               
            </div>

            <!-- appointmetn here -->

            <div class="appointment-box">
                    <div class="apppoitnment-left">
                        <div class="appointment-text-large">
                            Need an Appointment?
                        </div>
                        <div class="appointment-text-down">
                        <a style="text-decoration:none;" href="<?php echo URLROOT;?>/petowner/addAppointment"><i class='bx bx-plus-circle'></i></a>
                            <div class="appointment-text-down-small">
                                Appointment
                            </div>
                        </div>
                    </div>
                    <div class="apppoitnment-right">
                        <img src="<?php echo URLROOT;?>/public/img/dashboard/petowner-appointment.svg" alt="">
                    </div>
                </div>
                <div class="box">
                    <div class="bottom-data">
                        <!-- Start of orders -->
                        <div class="orders">
                            <div class="header">
                                <div class="header-left">
                                    <h3>My Appointments</h3>
                                </div>
                                <div class="header-right">
                                    <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i>
                                </div>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Pet</th>
                                        <th>Pet Owmer</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="profile">
                                            <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/pet1.png"><p>  Zoro</p>
                                        </td>
                                        <td>Kate Carpenter</td>
                                        <td>01-09-2023</td>
                                        <td>11.00 AM</td>
                                        <td>Grooming</td>
                                        <td>
                                            <i class='bx bx-trash'></i>
                                              <a href="<?php echo URLROOT;?>/petowner/updateAppointment" > <i class='bx bx-edit'></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td class="profile">
                                            <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/pet2.png"><p>  Garfield</p>
                                        </td>
                                        <td>Ava Smith</td>
                                        <td>01-05-2023</td>
                                        <td>08.00 AM</td>
                                        <td>Vaccination</td>
                                        <td>
                                            <i class='bx bx-trash'></i>
                                                <i class='bx bx-edit'></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td class="profile">
                                            <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/pet3.png"><p>  Rex</p>
                                        </td>
                                        <td>Lily Doe</td>
                                        <td>11-10-2023</td>
                                        <td>09.00 AM</td>
                                        <td>Surgery</td>
                                        <td>
                                            <i class='bx bx-trash'></i>
                                                <i class='bx bx-edit'></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td class="profile">
                                            <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/pet4.png"><p>  Oreo</p>
                                        </td>
                                        <td>Amelia Williamson</td>
                                        <td>11-02-2023</td>
                                        <td>02.00 PM</td>
                                        <td>Dental</td>
                                        <td>
                                            <i class='bx bx-trash'></i>
                                                <i class='bx bx-edit'></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td class="profile">
                                            <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/pet5.png"><p>  Roxky</p>
                                        </td>
                                        <td>Ava Smith</td>
                                        <td>31-09-2023</td>
                                        <td>12.00 AM</td>
                                        <td>Vaccination</td>
                                        <td>
                                            <i class='bx bx-trash'></i>
                                                <i class='bx bx-edit'></i>
                                        </td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                            <div class="footer-block">
                                <div class="footer-left">
                                    Showing <span class="current">5</span> out of <span class="total">25</span> entries
                                </div>
                                <div class="footer-right">
                                    <div class="previous">previous</div>
                                    <div class="page page1">1</div>
                                    <div class="page page2">2</div>
                                    <div class="page page3">3</div>
                                    <div class="page page4">4</div>
                                    <div class="page page5">5</div>
                                    <div class="next">next</div>                                    
                                </div>
                            </div>
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