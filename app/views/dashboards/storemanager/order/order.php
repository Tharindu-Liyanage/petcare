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



<?php require_once __DIR__ . '/../../common/order_common.php'; ?>
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
                <div class="users">
                    <div class="header">
                    <i class='bx bx-shopping-bag' ></i>
                        <h3>Orders</h3>
                        <i class='bx bx-filter' ></i>
                        <i class='bx bx-search' ></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                
                                <th>Id</th>
                                <th>Customer</th>
                                <th>Address</th>
                                <th>Payment</th>
                                <th>Order Date</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                           

                            <tr>
                                <td>1</td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/user1.jpg">
                                    <p>John Doe</p>
                                </td>
                                <td>456 Elm St.</td>
                                <td>Card</td>
                                <td>02-10-2023</td>
                                <td>LKR 1500</td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                    <a href="<?php echo URLROOT;?>/storemanager/viewCart" ><i class='bx bx-cart' ></i></a>     
                                           
                                    </div>
                                    
                                </td>
                            </tr>


                            <tr>
                                <td>2</td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/user2.jpeg">
                                    <p>Anna Smith</p>
                                </td>
                                <td>123 Main St.</td>
                                <td>Cash</td>
                                <td>02-10-2023</td>
                                <td>LKR 1500</td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                    <a href="<?php echo URLROOT;?>/storemanager/viewCart" ><i class='bx bx-cart' ></i></a>    
                                           
                                    </div>
                                    
                                </td>
                            </tr>


                            <tr>
                                <td>3</td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/user3.jpeg">
                                    <p>Will Smith</p>
                                </td>
                                <td>123 Main St.</td>
                                <td>Card</td>
                                <td>30-10-2023</td>
                                <td>LKR 9500</td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                    <a href="<?php echo URLROOT;?>/storemanager/viewCart" ><i class='bx bx-cart' ></i></a>     
                                           
                                    </div>
                                    
                                </td>
                            </tr>


                            <tr>
                                <td>4</td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/user4.jpeg">
                                    <p>Glenn Maxwell</p>
                                </td>
                                <td>756 Main St.</td>
                                <td>Card</td>
                                <td>15-10-2023</td>
                                <td>LKR 350</td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                           
                                           <a href="<?php echo URLROOT;?>/storemanager/viewCart" ><i class='bx bx-cart' ></i></a>     
                                           
                                    </div>
                                    
                                </td>
                            </tr>

                        
                        </tbody>
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


    

    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/manageStaff.js"></script>
    
</body>
</html>