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



<?php require_once __DIR__ . '/../../common/common_variable/inventory_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Inventory</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/storemanager">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/storemanager/inventory" class="active">Inventory</a></li>
                    </ul>
                </div>

                <div class="add-button">
                    <a href="<?php echo URLROOT;?>/storemanager/addProduct" >
                    <button id="add-form-button">
                        <i class='bx bx-plus' ></i>
                                Add Product
                    </button> </a>
                </div>

               
            </div>

           

            

            <div class="bottom-data">

                <!--start od orders-->
                <div class="users" id="inventory">
                    <div class="header">
                    <i class='bx bx-archive' ></i>
                        <h3>Inventory</h3>
                    <!-- Search Container -->

                    <div class="search-container-table">
                     <input type="text"  id="userSearch" name="text" class="search" placeholder="Search here..">
                     <i class='bx bx-search' ></i>
                    </div>

                    <!-- search container over -->
                    
                    <table>
                        <thead>
                            <tr>
                                
                                <th>Id<i class='bx bxs-sort-alt sort' data-sort="invoice-id"></i></th>
                                <th>Name<i class='bx bxs-sort-alt sort' data-sort="inventory-name"></i></th>
                                <th>Brand<i class='bx bxs-sort-alt sort' data-sort="inventory-brand"></i></th>
                                <th>Category<i class='bx bxs-sort-alt sort' data-sort="category"></i></th><i class='bx bxs-sort-alt sort' data-sort="invoice-id"></i></th>
                                <th>Stock<i class='bx bxs-sort-alt sort' data-sort="stock"></i></th>
                                <th>Price<i class='bx bxs-sort-alt sort' data-sort="price"></i></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list" >

                        <?php foreach($data['inventory'] as $product) : ?>

                            <tr>
                                <td class="invoice-id" ><?php echo $product->id?></td>
                                <td class="inventory-name" >
                                <?php echo $product->name?>
                                </td>
                                <td class="inventory-brand" ><?php echo $product->brand?></td>
                                <td class="category" ><?php echo $product->category?></td>
                                <td class="stock" ><?php echo $product->stock?></td>
                                <td class="price" >Rs.<?php echo $product->price?></td>
                                <td class="action">
                                    
                                    <div class="act-icon">
                                           <a data-staff-id="<?php echo $product->id?>" class="removeLink" href="<?php echo URLROOT;?>/storemanager/removeProduct/<?php echo $product->id ?>" ><i class='bx bx-trash'></i></a>
                                           <a href="<?php echo URLROOT;?>/storemanager/updateProduct/<?php echo $product->id?>" ><i class='bx bx-edit' ></i></a>     
                                           
                                    </div>
                                    
                                </td>
                            </tr>
                            <?php endforeach; ?>
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
                            <span class="title">Remove Account</span>
                            <p class="message">Are you sure you want to remove this product? All of the product data will be permanently removed. This action cannot be undone.</p>
                        </div>

                        <div class="err-actions">
                            <button id="confirmDelete" class="desactivate" type="button">Remove</button>
                            <button id="cancelDelete" class="cancel" type="button">Cancel</button>
                        </div>

                    </div>
                </div>
            </div>




    </div>

   




    
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/storemanager/manageInventory.js"></script>
    
</body>
</html>