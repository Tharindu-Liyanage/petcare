<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/order_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Orders</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/storemanager">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/storemanager/order" class="active">Order</a></li>
                    </ul>
                </div>

                

               
            </div>

           

            

            <div class="bottom-data">

                <!--start od orders-->
                <div class="users" id="orders">
                    <div class="header">
                    <i class='bx bx-shopping-bag' ></i>
                        <h3>Orders</h3>

                    <!-- Search Container -->

                    <div class="search-container-table">
                     <input type="text"  id="userSearch" name="text" class="search" placeholder="Search here..">
                     <i class='bx bx-search' ></i>
                    </div>

                    <!-- search container over -->

                    
                    <table>
                        <thead>
                            <tr>
                                
                                <th>Id <i class='bx bxs-sort-alt sort' data-sort="invoice-id"></i></th>
                                <th>Customer <i class='bx bxs-sort-alt sort' data-sort="profile"></i></th>
                                <th>Order Date <i class='bx bxs-sort-alt sort' data-sort="order-date"></i></th>
                                <th>Totla <i class='bx bxs-sort-alt sort' data-sort="total"></i></th>
                                <th>Shipment Status <i class='bx bxs-sort-alt sort' data-sort="shipment-status"></i></th>
                                <th>Action </th>

                            </tr>
                        </thead>
                        <tbody class="list">

                           <?php foreach($data['order'] as $order) : ?>

                                <tr>
                                    <td class="invoice-id"><?php echo 'INV-'.$order->invoice_id  ; ?></td>
                                    <td class="profile"class="profile">
                                        <img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/user1.jpg">
                                        <p><?php echo $order->first_name ; ?></p>
                                    </td>
                                    <td class="order-date"><?php echo $order->invoice_date ; ?></td>
                                    <td class="total"><?php echo 'LKR '. $order->total_amount ; ?></td>
                                    <td class="shipment-status">
                                            <select class="shipment-status" id="ship-status" name="shipment-status" >
                                                <option class="on-process-value" value="on-process">On Process</option>
                                                <option class="shipped-value"  value="shipped">Shipped</option>
                                                <option class="delivered-value"  value="delivered">Delivered</option>
                                            </select>
                                            
                                    </td>
                                    <td class="action">
                                        
                                        <div class="act-icon">
                                            <a href="<?php echo URLROOT;?>/storemanager/viewCart/<?php echo $order->invoice_id ;?>" ><i class='bx bx-cart' ></i></a>       
                                        </div>
                                        
                                    </td>
                                </tr>
                            <?php endforeach ; ?>


                        
                        </tbody>
                        <?php include __DIR__ . '/../../common/pagination_footer.php'; ?>
                    </table>
                    
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
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/storemanager/manageOrders.js"></script>
   
    
</body>
</html>