<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/addStaff.css">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <title>Dashboard</title>
   </head>
   <body>

   <?php require_once __DIR__ . '/../../common/inventory_common.php'; ?>
   <?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>

    <main>

         <div class="header">
            <div class="left">
                <h1>Inventory</h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT;?>/storemanager">Dashboard</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/storemanager/inventory">Inventory</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/storemanager/addProdut" class="active">Add Product</a></li>
                </ul>
            </div>
        </div>


            
               

        <div class="bottom-data">

            

            <!-- staff add model here -->
            <div class="add-model">

               <div class="header">
                    <i class='bx bx-package' ></i>
                    <h3>Add Product</h3>       
                </div>

                


                <form class="form" method="post" action="<?php echo URLROOT; ?>/storemanager/addProduct">

                  

                <div class="column">

                        <div class="flex-column">
                            <label>Product Name</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['pname_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-purchase-tag' ></i>
                            <input type="text" class="input" name="pname" placeholder="Enter product Name" value="<?php echo $data['pname']?>">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['pname_err']; ?></span>

                        <div class="flex-column">
                            <label>Brand</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['brand_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-buildings' ></i>
                            <input type="text" class="input " placeholder="Enter brand Name" value="<?php echo $data['brand']?>" name="brand">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['brand_err']; ?></span>

                        <div class="flex-column">
                            <label>Category</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['cat_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-category' ></i>
                            <select name="category">
                                <option value=""  selected>Select Category</option>
                                <option value="Food">Food</option>
                                <option value="Toys">Toys</option>
                                <option value="Accessories">Accessories</option>
                                <option value="Treats">Treats</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <span class="invalid-feedback"><?php echo $data['cat_err']; ?></span>
                       

                </div> <!-- column tag close -->

                <div class="column">

                        <div class="flex-column">
                            <label>Stock</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['stock_err'])) ? 'is-invalid' : '' ; ?>">
                         <i class='bx bx-box' ></i>
                            <input type="text" class="input" placeholder="Enter amount Stock" name="stock" value="<?php echo $data['stock']?>">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['stock_err']; ?></span>


                        <div class="flex-column">
                            <label>Price</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['price_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-dollar' ></i>
                            <input type="text" class="input" placeholder="Enter price" name="price" value="<?php echo $data['price']?>" >
                        </div>
                        <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>


                        

                </div> <!-- column close -->

                <div class="button-form">
                  <button type="reset"  class="button-submit">Reset</button> 
                  <button type="submit" id="button-submit" class="button-submit">Add</button>
                </div>
           
            </form>

            </div> <!-- model over -->
            </div> <!-- content over -->
           
         </main>
      </div>
      
      <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
   </body>
</html>