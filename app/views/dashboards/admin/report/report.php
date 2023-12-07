<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>dashboard</title>
</head>
<body>

<?php require_once __DIR__ . '/../../common/common_variable/report_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


        <main>
            <div class="header">
                <div class="left">
                    <h1>Reports</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                            Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT; ?>/admin/report" class="active"> Report</a></li>
                    </ul>
                </div>
                
            </div>

    

            <div class="bottom-data">


                <!--reminders-->
                <div class="reminders" style="width: 80%; margin: 0 auto;">
                    <div class="header">
                        <i class='bx bx-bar-chart-square' ></i>
                        <h3>Sales</h3>
                        <i class='bx bx-filter' ></i>
                       <!-- <i class='bx bx-plus' ></i> -->
                    </div>
                    <canvas id="salesChart"></canvas>
                </div>

                <!-- end of reminder -->
            </div>



 

            

        </main>
    </div>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/sales.js"></script>
</body>
</html>