<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/temp/Dashboard- Store Manger-Orders.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
</head>
<body>

Dashboard- Store Manger-Orders

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
                        <li><a href="<?php echo URLROOT;?>/storemanager/order">Order</a></li>
                        <li><a href="<?php echo URLROOT;?>/storemanager/viewCart" class="active">> Cart</a></li>
                    </ul>
                </div>

                

               
            </div>

           

            

            <div class="bottom-part">
                    <div class="title">
                        <i class='bx bxs-cart' ></i>
                        <div class="title-text">Shopping Cart</div>
                    </div>
                    <div class="middle-part">
                        <div class="left">
                            <div class="item item1">
                                <img src="<?php echo URLROOT;?>/public/storage/uploads/products/food1.png" alt="">
                                <div class="item-text">
                                    Beef Bones and Chews Rawhide Dog Treat Multi Pack – 500g
                                </div>
                                <div class="quantity-price">
                                    Rs. 500 x 2
                                </div>
                            </div>
                            <div class="item item2">
                                <img src="<?php echo URLROOT;?>/public/storage/uploads/products/food1.png" alt="">
                                <div class="item-text">
                                    Nylabone Power Dura Chew Kabob Chicken Jerky Flavored Dog Chew Toy
                                </div>
                                <div class="quantity-price">
                                    Rs. 3500 x 2
                                </div>
                            </div>
                            <div class="item item3">
                                <img src="<?php echo URLROOT;?>/public/storage/uploads/products/food1.png" alt="">
                                <div class="item-text">
                                    Beef Bones and Chews Rawhide Dog Treat Multi Pack – 500g
                                </div>
                                <div class="quantity-price">
                                    Rs. 500 x 2
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="box">
                                <div class="title">
                                    <i class='bx bx-notepad' ></i>
                                    <div class="title-text">
                                        Summary
                                    </div>
                                </div>
                                <div class="line order-total">
                                    <div class="order-total-text">
                                        Order Total
                                    </div>
                                    <div class=" order-total-amount">
                                        Rs.9000.00
                                    </div>
                                </div>
                                <div class="line shipping-total">
                                    <div class="shipping-total-text">
                                        Shipping 
                                    </div>
                                    <div class="shipping-total-amount">
                                        Rs.500.00
                                    </div>
                                </div>
                                <div class="line sub-total">
                                    <div class="sub-total-text">
                                        Sub Total
                                    </div>
                                    <div class="sub-total-amount">
                                        Rs.9500.00
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="footer">
                    <a class="back-button" href="<?php echo URLROOT; ?>/storemanager/order">Back</a>

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