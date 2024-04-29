<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css">
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
            <div class="top">
                <div class="left">
                    <div class="greetings"> Hello, <span><?php echo $_SESSION['user_fname'] ."  " . $_SESSION['user_lname'];   ?></span></div>
                    <p>You Have <span><a href="<?php echo URLROOT; ?>/storemanager/onProcessOrder">
                                                        <?php
                                    $count = 0;
                                    foreach ($data['index'] as $order) {
                                        if ($order->ship_status == 'on-process') {
                                            $count++;
                                        }
                                    }
                                    echo $count;
                                    ?></a>
                                </span> Orders To Be Shipped. </p>
                                
                </div>
                <div class="right">
                    <img src="<?php echo URLROOT;?>/public/img/dashbooardStoreManager/dashboardStoreManager.svg" alt="">
                </div>
            </div>
            <!--end of insisghts-->

            <div class="bottom-data">

                <!--start od orders-->
                <div class="orders" id="orders" >
                    <div class="header">
                        <i class='bx bx-receipt' ></i>
                        <h3>Recent Orders</h3>
                        <!-- Search Container -->

                        <div class="search-container-table">
                            <input type="text"  id="userSearch" name="text" class="search" placeholder="Search here..">
                            <i class='bx bx-search' ></i>
                        </div>

                    <!-- search container over -->
                    
                        <table>
                            <thead>
                                <tr>
                                    <th>User<i class='bx bxs-sort-alt sort' data-sort="user"></i></th>
                                    <th>Order Date<i class='bx bxs-sort-alt sort' data-sort="order-date"></i></th>
                                    <th>Total<i class='bx bxs-sort-alt sort' data-sort="total"></i></th>
                                    <th>status<i class='bx bxs-sort-alt sort' data-sort="status"></i></th>
                                </tr>
                            </thead>
                            <tbody class="list" >

                                <?php foreach ($data['index'] as  $order) : ?>
                                    <tr>
                                        <td class="user" >
                                            <img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/<?php echo $order->profileImage ; ?>"><p><?php echo "  " . $order->first_name .' ' . $order->last_name ; ?></p>
                                        </td>
                                        <td class="order-date" > <?php echo $order->invoice_date ; ?></td>
                                        <td class="total" ><?php echo $order-> price ;?></td>
                                        
                                        <td >
                                            <span <?php 
                                                if ($order->ship_status == 'shipped') {
                                                    echo 'class="status shipped"';
                                                } elseif ($order->ship_status == 'delivered') {
                                                    echo 'class="status delivered"';
                                                } elseif ($order->ship_status == 'on-process') {
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
                    <?php include __DIR__ . '/../common/pagination_footer.php'; ?>
                </div>
                
                <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
                <!--reminders-->
                
                
                
            </div>        
            

        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/sales.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/storemanager/dashboardStoreManager.js" ></script>
</body>
</html>