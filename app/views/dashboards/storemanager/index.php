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
                                <th>Total</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['order'] as  $order) : ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/<?php echo $order->profileImage ; ?>"><p><?php echo "  " . $order->first_name .' ' . $order->last_name ; ?></p>
                                    </td>
                                    <td> <?php echo $order->invoice_date ; ?></td>
                                    <td><?php echo $order-> price ;?></td>
                                    
                                    <td>
                                        <span <?php 
                                            if ($order->ship_status == 'Shipped') {
                                                echo 'class="status shipped"';
                                            } elseif ($order->ship_status == 'Delivered') {
                                                echo 'class="status delivered"';
                                            } elseif ($order->ship_status == 'On process') {
                                                echo 'class="status on-process"';
                                            } ?>>
                                            <?php echo $order->ship_status; ?>
                                        </span>
                                    </td>
                                    
                                </tr>
                            <?php endforeach  ; ?>
                            
                        </tbody>
                    </table>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <!--reminders-->
                

                <!-- end of reminder -->
            </div>

        </main>
    </div>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/storemanager/dashboardStoreManager.js" ></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>

    <script src="<?php echo URLROOT; ?>/public/js/dashboard/sales.js"></script>
</body>
</html>