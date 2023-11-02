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

<?php include __DIR__ . '/../common/index_common.php'; ?>
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
                        <li><a href="<?php echo URLROOT; ?>/admin" class="active"> Home</a></li>
                    </ul>
                </div>
                
            </div>

            <!--insights-->
            <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check' ></i>
                    <span class="info">
                        <h3>1,074</h3>
                        <p>Paid Order</p>
                    </span>
                </li>
                <li><i class='bx bx-show-alt' ></i>
                    <span class="info">
                        <h3>3,944</h3>
                        <p>Site Visit</p>
                    </span></li>
                <li><i class='bx bx-line-chart' ></i>
                    <span class="info">
                        <h3>14,743</h3>
                        <p>Searchers</p>
                    </span></li>
                <li><i class='bx bx-dollar-circle' ></i>
                    <span class="info">
                        <h3>$6,766</h3>
                        <p>Total Sales</p>
                    </span></li>
            </ul>
            <!--end of insisghts-->

            <div class="bottom-data">

                <!--start od orders-->
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt' ></i>
                        <h3>Recent Orders</h3>
                        <i class='bx bx-filter' ></i>
                        <i class='bx bx-search' ></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Order Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/user2.jpeg" ><p>John Doe</p>
                                </td>
                                <td> 14-08-2-23</td>
                                <td><span class="status completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/user3.jpeg" ><p>John Doe</p>
                                </td>
                                <td> 14-08-2-23</td>
                                <td><span class="status pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/user4.jpeg"><p>John Doe</p>
                                </td>
                                <td> 14-08-2-23</td>
                                <td><span class="status process">Processing</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!--reminders-->
                <div class="reminders">
                    <div class="header">
                        <i class='bx bx-note' ></i>
                        <h3>reminders</h3>
                        <i class='bx bx-filter' ></i>
                        <i class='bx bx-plus' ></i>
                    </div>
                    <ul class="task-list">
                        <li class="completed">
                            <div class="task-title">
                                <i class='bx bx-check-circle' ></i>
                                <p>Start Our Meeting</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded' ></i>
                        </li>
                        <li class="completed">
                            <div class="task-title">
                                <i class='bx bx-check-circle' ></i>
                                <p>Analyse Our Site</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded' ></i>
                        </li>
                        <li class="completed">
                            <div class="task-title">
                                <i class='bx bx-x-circle' ></i>
                                <p>Play Footbal</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded' ></i>
                        </li>
                        
                    </ul>
                </div>

                <!-- end of reminder -->
            </div>

        </main>
    </div>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
</body>
</html>