<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css">
    <!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/storemanager/category.css"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/storemanager_category_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Category</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/storemanager">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/storemanager/category" class="active">Category</a></li>
                    </ul>
                </div>

                

                <div class="add-button">
                    <a href="<?php echo URLROOT;?>/storemanager/addCategory" >
                    <button id="add-form-button">
                        <i class='bx bx-user-plus' ></i>
                                Add Category
                    </button>
                     </a>
                </div>

            </div>
            

            <div class="bottom-data">

                <!--start od orders-->
                <div class="users" id="category">
                    <div class="header">
                    <i class='bx bx-shopping-bag' ></i>
                        <h3>Categories</h3>
                       
                    <!-- Search Container -->

                    <div class="search-container-table">
                     <input type="text"  id="userSearch" name="text" class="search" placeholder="Search here..">
                     <i class='bx bx-search' ></i>
                    </div>

                    <!-- search container over -->
                    
                    <table>
                        <thead>
                            <tr>
                                
                                <th>Id <i class='bx bxs-sort-alt sort' data-sort="category-id"></i></th>
                                <th>Category<i class='bx bxs-sort-alt sort' data-sort="category-name"></i></th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody class="list" >

                           <?php foreach($data['category'] as $category) : ?>

                                <tr>
                                    <td class="category-id" ><?php echo $category->id  ; ?></td>
                                    <td class="category-name" ><?php echo $category->categoryname  ; ?></td>
                                    
                                    
                                   
                                    <td class="action action-last">
                                        
                                        <div class="act-icon">
                                            <a href="<?php echo URLROOT;?>/storemanager/updateCategory/<?php echo $category->id  ; ?>" ><i class='bx bx-edit' ></i></a>
                                            <a class="removeLink" href="<?php echo URLROOT;?>/storemanager/removeCategory/<?php echo $category->id  ; ?>" ><i class='bx bx-trash'></i></a></a>     
                                            
                                        </div>
                                        
                                    </td>
                                </tr>
                            <?php endforeach ; ?>


                        
                        </tbody>
                    </table>
                </div>
                <?php include __DIR__ . '/../../common/pagination_footer.php'; ?>
                
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
                            <span class="title">Remove Category</span>
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

    <?php
     
     if ($_SESSION['notification'] == "error") {
           
        toast_notifications('Error!',$_SESSION['notification_msg'],"fas fa-solid fa-xmark check-error"); 
        
    }else if($_SESSION['notification'] == "ok"){

        toast_notifications('Succsess!',$_SESSION['notification_msg'],"fas fa-solid fa-check check"); 

    }

    ?>


    <!-- staff add model over -->


    

    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/storemanager/manageCategory.js"></script>
    
</body>
</html>