<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/temp/Dashboard-petowner-dash.css">
    <title>dashboard</title>

   
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
                        <li><a href="<?php echo URLROOT; ?>/assistnat" class="active"> Home</a></li>
                    </ul>
                </div>
                
            </div>

            
        <!--Greeting-->
        <div class="top">
                <div class="left">
                    <div class="greetings"><?php echo $data['greetingmsg']; ?>,<span> <?php echo $_SESSION['user_fname'] ."  " . $_SESSION['user_lname'];   ?></span></div>

                    <ol>
                    <?php if($_SESSION['user_profileimage'] == 'petcare-default-picture-user.png' ) :?>
                    <li>Please upload a <span>profile picture</span> to make your profile stand out. </li>
                    <?php endif; ?>
                    

                    </ol>
                                
                </div>
                <div class="right">
                    <img src="<?php echo URLROOT;?>/public/img/dashboard/assistant.svg" alt="">
                </div>
            </div>
            <!--Greeting over -->

            <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check' ></i>
                    <span class="info">
                        <h3><?php echo count($data['pendingAppointments'])?></h3>
                        <p>Pending Appointments</p>
                    </span>
                </li>
                <li><i class='bx bx-file'></i>
                    <span class="info">
                        <h3><?php echo count($data['pendingMedicalBills'])?></h3>
                        <p>Pending Medical Bills</p>
                    </span></li>

                <li><i class='bx bx-wallet' ></i>
                     <span class="info">
                        <h3> LKR <?php echo ($data['todayMedicalBillsIncome'])?></h3>
                        <p>Today Medical Bills Income</p>
                     </span></li>    
                
               
            </ul>

           
            </div> <!-- content over -->

        </main>
    </div>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
  
</body>
</html>