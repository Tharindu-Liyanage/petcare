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
                        <li><a href="<?php echo URLROOT;?>/storemanager/order">Order</a></li>
                        <li><a href="<?php echo URLROOT;?>/storemanager/viewCart" class="active">> Cart</a></li>
                    </ul>
                </div>

                

               
            </div>

            <div style=" margin:auto;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
            <table id="invoice-table" style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px green;">
                <thead>
                <tr>
                    <th style="text-align:left; font-size:40px;"><img style="max-width: 80px;" src="<?php echo URLROOT;?>/public/img/logo/logo-croped.png" alt="PetCare-Logo"> PetCare</th>
                    <th style="text-align:right;font-weight:400;"><?php echo $data['cartDataRow']->invoice_date;?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="height:35px;"></td>
                </tr>
                <tr>
                    <td  colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
                    <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Order status</span><b style="color:green;font-weight:normal;margin:0">Success</b></p>
                    <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Invoice ID</span><?php echo $data['cartDataRow'] -> invoice_id ?></p>
                    <p style="font-size:14px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Order amount</span>LKR <?php echo $data['cartDataRow'] -> total_amount ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="height:35px;"></td>
                </tr>
                <tr bgcolor="#F5F8FA">
                    <td style="width:50%;padding:20px;vertical-align:top">
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">Name</span> <?php echo $data['cartDataRow']->first_name .' '. $data['cartDataRow']->last_name ?></p>
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Email</span><?php echo $data['cartDataRow']->email ?></p>

                    </td>
                    <td style="width:50%;padding:20px;vertical-align:top">
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Address</span><?php echo $data['cartDataRow']-> address ?></p>
                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Phone</span><?php echo $data['cartDataRow']-> mobile ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Product Items</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding:15px;">
                    
                    <?php foreach($data['cartData'] as $item) : ?>

                        <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
                        <span style="display:block;font-size:13px;font-weight:normal;"><?php echo $item->name ?></span> LKR <?php $price = $item->price * $item->quantity; echo $price; ?> <b style="font-size:12px;font-weight:300;">| Quantity - <?php echo $item->quantity ?> | Unit Price - LKR <?php echo $item->price ?></b>
                    </p>

                    <?php endforeach; ?>


                    </td>
                </tr>
                </tbody>
                <tfooter >
                <tr bgcolor="#EAF0F6">
                        <td colspan="2" align="center" style="padding: 30px 30px;">
                            <h2>Thank You for Choosing PetCare &hearts;</h2>
                            <p> We appreciate your decision to trust PetCare for your pets well-being. Our commitment is to provide exceptional care and service. </p>
                            <a href="http://localhost/petcare/home">Visit Our Site</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" style="padding: 30px 30px;">
                            <p style="color:#99ACC2"> &copy; 2023-present PetCare. All rights reserved. </p>
                            <!--  <a class="subtle-link" href="#"> Unsubscribe </a>      -->
                        </td>
                    </tr>
                </tfooter>
            </table>

                <!-- donwload button here
                <div id="downloadPdf" class="download-btn">
                    <a class="btn" > <i class='bx bx-download' ></i> Download Invoice</a>
                </div> -->
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