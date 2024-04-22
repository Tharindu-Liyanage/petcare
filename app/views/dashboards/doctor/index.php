<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/doctor/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css"> <!-- for two pic table -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>PetCare | Dashboard</title>
</head>
<body>

<?php require_once __DIR__ . '/../common/common_variable/index_common.php'; ?>
<?php include __DIR__ . '/../common/dashboard-top-side-bar.php'; ?>


        <main>
            <div class="header">
                <div class="left">
                    <h1>dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                            Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT; ?>/doctor" class="active"> Home</a></li>
                    </ul>
                </div>
                
            </div>

            <div class="home-box" 
            
            <?php if($_SESSION['user_role'] == "Nurse") : ?>
                style="height:200px;"
            <?php endif ?>
            
            >
                    <div class="home-left">
                        <div class="home-text-large">
                        <?php echo $data['greetingmsg']; ?>,  <span><?php echo $_SESSION['user_fname']?></span>
                        </div>
                        <div class="home-text-small">

                        <ol>

                        <?php if($_SESSION['user_profileimage'] == 'petcare-default-picture-user.png' ) :?>
                                <li>Please upload a <span>profile picture</span> to make your profile stand out.</li>
                        <?php endif; ?>
                        
                            <?php if($_SESSION['user_role'] == "Doctor") : ?>
                           <li>You have <span> <?php if($data['todayAppointment'] != null) { echo  count($data['todayAppointment']);} else { echo 0;}  ?> </span> upcoming appointments.</li> 
                            <?php endif ?>

                            <?php if($_SESSION['user_role'] == "Nurse") : ?>
                             <li> Currently <span><?php if($data['wardDetails'] != null) { echo  count($data['wardDetails']);} else { echo 0;}  ?> </span> animals in the ward.</li> 
                            <?php endif ?>

                        </div>
                    </div>
                    <div class="home-right">
                        <img
                        
                        <?php if($_SESSION['user_role'] == "Nurse") : ?>

                            Style="width: 140px; height:auto;" 
                        <?php endif ?>
                        src="<?php echo URLROOT;?>/public/img/dashboard/girlWithHeart.svg" alt="">
                    </div>
                </div>

            <?php if($_SESSION['user_role'] == "Doctor") : ?>

                <div class="home-box2" id="appointmentDetails-container">

                <?php

                    if($data['appointmentDetails'] == null ){

                        echo '

                       
                    <div class="home-left2">
                        <div class="home-text-large">
                           Currently, <span  id="petName">No Appointments!</span>
                        </div> 
                    </div>
                    <div class="home-right">
                    <img id="petImage" src="' . URLROOT . '/public/img/dashboard/noappointment.svg" alt="">
                    </div>
                ';

                    
                    }else{

                        echo '

                        
                    <div class="home-left2">
                        <div class="home-text-large">
                            Time for Treatment, <span id="petName">'. $data['appointmentDetails']->pet .'!</span>
                        </div>
                        <div class="date-time-type">
                            <div>Date : <span id="appointmentDate">'. $data['appointmentDetails']->appointment_date .'</span></div>
                            <div>Time : <span id="appointmentTime">'. $data['appointmentDetails']->appointment_time .'</span></div>
                            <div>Type : <span id="appointmentType">'. $data['appointmentDetails']->appointment_type .'</span></div>
                        </div>
                        <div class="buttons">
                            <button class="button cancel-button">Cancel</button>
                            <button class="button treatment-button">Treatment</button>
                        </div>
                    </div>
                    <div class="home-right">
                    <img id="petImage" src="' . URLROOT . '/public/storage/uploads/animals/'. $data['appointmentDetails']->profileImage .'" alt="">
                    </div>
                     ';

                    }

                ?>

                </div>
                
            <?php endif ?>
                <!-- latest patient table is here -->

                

                <!-- latest patient is over -->

        </main>
    </div>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/doctor/doctorMain.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</body>
</html>