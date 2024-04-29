<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/addStaff.css">
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
                    <li><a href="<?php echo URLROOT;?>/storemanager">Dashboard</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/storemanager/inventory">Inventory</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/storemanager/updateProdut" class="active">Update Product</a></li>
                </ul>
            </div>
        </div>


            
               

        <div class="bottom-data">

            

            <!-- staff add model here -->
            <div class="add-model">

               <div class="header">
                    <i class='bx bx-package' ></i>
                    <h3>Update Product</h3>       
                </div>

                


                <form class="form" method="post" enctype="multipart/form-data" action="<?php echo URLROOT; ?>/storemanager/updateProduct/<?php echo $data['id']; ?>">

                  

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
                                <option>Select a category</option>
                                <option value="1" <?php echo (($data['category']) == '1') ? 'selected' : '' ; ?>  >Food</option>
                                <option value="2" <?php echo (($data['category']) == '2') ? 'selected' : '' ; ?> >Toys</option>
                                <option value="3" <?php echo (($data['category']) == '3') ? 'selected' : '' ; ?> >Accessories</option>
                                <option value="4" <?php echo (($data['category']) == '4') ? 'selected' : '' ; ?> >Treats</option>
                                <option value="5" <?php echo (($data['category']) == '5') ? 'selected' : '' ; ?> >Medicines</option>
                                
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
                            LKR
                            <input type="text" class="input" placeholder="Enter price" name="price" value="<?php echo $data['price']?>" >
                        </div>
                        <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>

                        <div class="flex-column">
                            <label>Image</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['img_err'])) ? 'is-invalid' : '' ; ?>">
                        <i class='bx bx-image-alt'></i>
                            <input id="finput" type="file" class="input" name="inventory_img" accept="image/*" onchange="upload()">
                            <!-- <input type="file" class="input" name="inventory_img" accept="image/*"> -->
                        </div>
                        <span class="invalid-feedback"><?php echo $data['img_err']; ?></span>

                        <div class="img-preivew" style="display:none;" id="img-preivew">

                            <div class="flex-column">
                                <label>Image Preview</label>
                            </div>
                            <canvas id="canv1"></canvas>

                        </div>

                        

                </div> <!-- column close -->

                <div class="button-form">
                  <button type="reset"  class="button-submit">Reset</button> 
                  <button type="submit" id="button-submit" class="button-submit">Update</button>
                </div>
           
            </form>

            </div> <!-- model over -->
            </div> <!-- content over -->
           
         </main>
      </div>

      <script src="https://www.dukelearntoprogram.com/course1/common/js/image/SimpleImage.js"></script>
      <script>
        function upload(){
        //img-preivew to display block
        document.getElementById("img-preivew").style.display = "block";
        var imgcanvas = document.getElementById("canv1");
        var fileinput = document.getElementById("finput");
        var image = new SimpleImage(fileinput);
        image.drawTo(imgcanvas);
        }
      </script>
      
      <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
   </body>
</html>