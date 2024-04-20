<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/petowner/Dashboard-petowner-appointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/dashboard/petowner/medicalReport.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>PetCare | My Orders</title>

    <style>
   
        td{
            user-select: none;
        }

        td.shop-status div{
            
            border-radius:10px;
            width: 100px;
            padding: 5px 10px;
            padding-right:0px;
            background:#E6EFFF !important;
            color:#222;
            font-weight: 500;
        }

        td.action .act-icon ::before{
            background: #DCF7E4;
            border-radius: 10px;
            padding: 5px;

        }


  </style>


</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/myorder.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>My Orders</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/petowner">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/petowner/myorders" class="active">My Orders</a></li>
                    </ul>
                </div>


              
               
            </div>

            <!-- Medical report here -->

           

                
                    <div class="bottom-data">
                       


                    <div class="users" id="medicalreport">
                    <div class="header">
                    <i class='bx bx-shopping-bag'></i>
                        <h3>My Orders</h3>

                    <!-- Search Container -->

                    <div class="search-container-table">
                     <input type="text"  id="userSearch" name="text" class="search" placeholder="Search here..">
                     <i class='bx bx-search' ></i>
                    </div>

                    <!-- search container over -->


                      
                        
                        
                    </div>
                    <table>
                        <thead>
                            <tr>
                                
                                <th>Invoice Id <i class='bx bxs-sort-alt sort' data-sort="id-search"></i></th>
                                <th>Order Date<i class='bx bxs-sort-alt sort' data-sort="profile"></th>
                                <th>Total<i class='bx bxs-sort-alt sort' data-sort="profile-three"></th>
                                <th>Shipment Status<i class='bx bxs-sort-alt sort' data-sort="profile-three"></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">


                        <?php

                                if(count($data['myorder']) == 0){

                                    echo '<td class="isempty" colspan="8">No data available in table</td>';

                                }else


                                foreach($data['myorder'] as $myorder) : ?>

<tr>
                                <td class="id-search">INV-<?php echo $myorder->invoice_id?></td>
                                <td class="profile">
                                 <?php echo $myorder->order_date?>
                                </td>
                                <td class="profile">
                                LKR <?php echo $myorder->total_price?>
                                </td>

                                <td class="shop-status"> <div >Pending</div></td>

                                
                                <td class="action">
                                    <div class="act-icon">
                                        <a href="<?php URLROOT?>/petcare/petowner/viewmyorder/<?php echo $myorder->cart_id?>"><i class='bx bx-cart'></i></a>
                                    </div>
                                </td>
                                    

                                <?php endforeach;  ?>

                            

                                    

                               
                           

                            

                        </tbody>
                    </table>

                    <?php  include __DIR__ . '/../../common/pagination_footer.php'; ?>


                </div>
 
            </div> <!-- content over -->

        </main>
    </div>

    
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/petowner/medicalReportTable.js"></script>
    
</body>
</html>