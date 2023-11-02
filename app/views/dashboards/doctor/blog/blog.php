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



<?php require_once __DIR__ . '/../../common/blog_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Blog</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/doctor">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/doctor/blog" class="active">Blog</a></li>
                    </ul>
                </div>

                <div class="add-button">
             <a href="<?php echo URLROOT;?>/doctor/addBlog" ><button id="add-form-button">
                <i class='bx bx-user-plus' ></i>
                        Add Article 
                </button> </a>
            </div>

               
            </div>

           

            

            <div class="bottom-data">

                <!--start od orders-->
                <div class="users">
                    <div class="header">
                    <i class='bx bxl-blogger' ></i>
                        <h3>Blogs</h3>
                        <i class='bx bx-filter' ></i>
                        <i class='bx bx-search' ></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                
                                <th>Id</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Tags</th>
                                <th>Create Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                           

                            <tr>
                                <td>1</td>
                                <td>
                                How to Keep Your Pet Healthy
                                </td>
                                <td>Pet Care</td>
                                <td>pet health, preventive</td>
                                <td>02-10-2023</td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                           <a data-staff-id="" class="removeLink" href="" ><i class='bx bx-trash'></i></a>
                                           <a href="<?php echo URLROOT;?>/doctor/updateBlog" ><i class='bx bx-edit' ></i></a>     
                                           
                                    </div>
                                    
                                </td>
                            </tr>


                            <tr>
                                <td>2</td>
                                <td>
                                Adopting a Pet
                                </td>
                                <td>Pet Adopt</td>
                                <td>Pet Adopt</td>
                                <td>10-10-2023</td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                           <a data-staff-id="" class="removeLink" href="" ><i class='bx bx-trash'></i></a>
                                           <a href="<?php echo URLROOT;?>/admin/updatePet" ><i class='bx bx-edit' ></i></a>     
                                           
                                    </div>
                                    
                                </td>
                            </tr>


                            <tr>
                                <td>3</td>
                                <td>
                                How to Train Your Pet
                                </td>
                                <td>Pet Training</td>
                                <td>Animal Training</td>
                                <td>09-09-2023</td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                           <a data-staff-id="" class="removeLink" href="" ><i class='bx bx-trash'></i></a>
                                           <a href="<?php echo URLROOT;?>/admin/updatePet" ><i class='bx bx-edit' ></i></a>     
                                           
                                    </div>
                                    
                                </td>
                            </tr>


                            <tr>
                                <td>1</td>
                                <td>
                                How to Keep Your Pet Healthy
                                </td>
                                <td>Pet Care</td>
                                <td>pet health, preventive</td>
                                <td>02-10-2023</td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                           <a data-staff-id="" class="removeLink" href="" ><i class='bx bx-trash'></i></a>
                                           <a href="<?php echo URLROOT;?>/admin/updatePet" ><i class='bx bx-edit' ></i></a>     
                                           
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