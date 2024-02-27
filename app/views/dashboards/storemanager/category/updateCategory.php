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

   <?php require_once __DIR__ . '/../../common/common_variable/inventory_common.php'; ?>
   <?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>

    <main>

         <div class="header">
            <div class="left">
                <h1>Category</h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT;?>/storemanager">Dashboard</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/storemanager/category">Category</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/storemanager/updateCategory" class="active">Update Category</a></li>
                </ul>
            </div>
        </div>


            
               

        <div class="bottom-data">

            

            <!-- staff add model here -->
            <div class="add-model">

               <div class="header">
                    <i class='bx bx-package' ></i>
                    <h3>Update Category</h3>       
                </div>

                


                <form class="form" method="post" action="<?php echo URLROOT; ?>/storemanager/updateCategory/<?php echo $data['id']; ?>">

                  

                <div class="column">

                <div class="flex-column">
                            <label>Category Name</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['categoryName_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-purchase-tag' ></i>
                            <input type="text" class="input" name="category_name" placeholder="Enter category Name" value="<?php echo $data['categoryName']?>">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['categoryName_err']; ?></span>  

                </div> <!-- column tag close -->

               

                <div class="button-form">
                  <button type="reset"  class="button-submit">Reset</button> 
                  <button type="submit" id="button-submit" class="button-submit">Update</button>
                </div>
           
            </form>

            </div> <!-- model over -->
            </div> <!-- content over -->
           
         </main>
      </div>
      
      <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
   </body>
</html>