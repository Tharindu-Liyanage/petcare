<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css"> <!-- for tthe table -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/doctor/doctor-appointment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>

    <style>
        .status .red{
            color: #EA3D2E;
            font-weight: 600;
        }

        .status .yellow{
            color: #F2AA16;
            font-weight: 600;
        }

        .status .green{
            color: #31A751;
            font-weight: 600;
        }
    </style>
</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/bill_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Medical Bill</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/petowner">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/petowner/medicalBill" class="active">Medical Bill</a></li>
                    </ul>
                </div>


              


               
            </div>

           

            

            <div class="bottom-data">



                <!--start od orders-->
                <div class="users" id="appointment">
                    <div class="header">
                        <i class='bx bx-money' ></i>
                        <h3>Payment Processing</h3>

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
                                
                                <th>Animal Ward Id <i class='bx bxs-sort-alt sort' data-sort="id-search"></i></th>
                                <th>Pet Name <i class='bx bxs-sort-alt sort' data-sort="profile"></th>
                                <th>Payment Status<i class='bx bxs-sort-alt sort' data-sort="profile-three"></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">

                            

                            <?php

                            if(count($data['bill']) == 0){

                                echo '<td class="isempty" colspan="8">No data available in table</td>';

                            }else
                            
                            
                            foreach($data['bill'] as $med) : ?>

                            <tr>
                                <td class="id-search">AID-<?php echo $med->ward_treatment_id?></td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/<?php echo $med->petpic?>" ><p><?php echo $med->genPetID?> | <?php echo $med->petname?></p>
                                </td>

                                 

                                <td class="status">
                                    
                                    <?php if($med->payment_status == "Processing") : ?>
                                    <span class="red"><?php echo $med->payment_status?></span> 
                                    <?php elseif($med->payment_status == "Pending"): ?>
                                    <span class="yellow"><?php echo $med->payment_status?></span>
                                    <?php elseif($med->payment_status == "Paid"): ?>
                                    <span class="green"><?php echo $med->payment_status?></span>
                                    <?php endif; ?>

                                </td>
                                
                    
                                
                               

                                <td class="action"> 

                                    <?php if($med->payment_status == "Pending" || $med->payment_status == "Complete" ) : ?>

                                    <a title="Treatment" class="accept" href="<?php echo URLROOT; ?>/petowner/viewWardBill/<?php echo $med->ward_treatment_id;?>"><i class='bx bx-chevron-right'></i></i></a>
                                   
                                    <?php endif; ?>
                                
                                </td>


                                
                            </tr>

                        <?php endforeach;  ?>
                        </tbody>
                    </table>

                    <?php include __DIR__ . '/../../common/pagination_footer.php'; ?>


                </div>
 
            </div> <!-- content over -->

             
                                
        </main>

        
    </div>

   


   

 


    

    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/nurse/medicalBill.js"></script>
    
</body>
</html>