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

   <?php require_once __DIR__ . '/../../common/pet_common.php'; ?>
   <?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>

    <main>

         <div class="header">
            <div class="left">
                <h1>Pet Owner</h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT;?>/admin">Dashboard</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/admin/petowner">Pet</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/admin/updatePetowner" class="active">Update Pet</a></li>
                </ul>
            </div>
        </div>


            
               

        <div class="bottom-data">

            

            <!-- staff add model here -->
            <div class="add-model">

               <div class="header">
                    <i class='bx bx-edit icon-header' ></i>
                    <h3>Update Pet </h3>       
                </div>

                


                <form class="form" method="post" action="">  <!-- action removed -->

                  

                <div class="column">

                        <div class="flex-column">
                            <label>Pet Name</label>
                        </div>
                        <div class="inputForm ">
                        <i class='bx bx-purchase-tag-alt' ></i>
                            <input type="text" class="input" name="fname" placeholder="Enter first Name" value="">
                        </div>
                        <span class="invalid-feedback"></span>

                        <div class="flex-column">
                            <label>Date OF Birth</label>
                        </div>
                        <div class="inputForm ">
                            <i class='bx bx-time' ></i>
                            <input type="date" class="input " placeholder="Enter last Name" value="" name="lname">
                        </div>
                        <span class="invalid-feedback"></span>

                        <div class="flex-column">
                            <label>Species</label>
                        </div>
                        <div class="inputForm ">
                            <i class='bx bx-category-alt' ></i>
                            <select name="role">
                                <option value="Admin" >Cat</option>
                                <option value="Assistant">Dog</option>
                                <option value="Doctor">Other</option>
                                
                            </select>
                        </div>
                        <span class="invalid-feedback"></span>


                </div> <!-- column tag close -->

                <div class="column">

                        <div class="flex-column">
                                    <label>Breed</label>
                                </div>
                                <div class="inputForm ">
                                    <i class='bx bx-category-alt' ></i>
                                    <select name="role">
                                        <option value="Admin" >Dalmation</option>
                                        <option value="Assistant">Percian</option>
                                        <option value="Doctor">Other</option>
                                        
                                    </select>
                                </div>
                                <span class="invalid-feedback"></span>


                                <div class="flex-column">
                                    <label>Sex</label>
                                </div>
                                <div class="inputForm ">
                                    <i class='bx bx-male-sign' ></i>
                                    <select name="role">
                                        <option value="Admin" >Male</option>
                                        <option value="Assistant">Female</option>
                                        
                                        
                                    </select>
                                </div>
                                <span class="invalid-feedback"></span>



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
      
      <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
   </body>
</html>