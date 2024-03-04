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

   <?php require_once __DIR__ . '/../../common/common_variable/pet_common.php'; ?>
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
                    
                        <div class="inputForm <?php echo (!empty($data['petname_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-buildings' ></i>
                            <input type="text" class="input" placeholder="Enter Pet Name" name="petname" value="<?php echo $data['petname']?>">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['petname_err']; ?></span>

                        <div class="flex-column">
                            <label>Date OF Birth</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['DOB_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-buildings' ></i>
                            <input type="text" class="input" placeholder="Enter Date Of Birth" name="DOB" value="<?php echo $data['DOB']?>">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['DOB_err']; ?></span>

                        <div class="flex-column">
                            <label>Species</label>
                        </div>
                        <div class="inputForm ">
                            <i class='bx bx-category-alt' ></i>
                            <select name="species">
                                <option value="cat" <?php echo (($data['species']) == 'cat') ? 'selected' : '' ; ?> >Cat</option>
                                <option value="dog" <?php echo (($data['species']) == 'dog') ? 'selected' : '' ; ?>>Dog</option>
                                <option value="other" <?php echo (($data['species']) == 'other') ? 'selected' : '' ; ?>>Other</option>
                                
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
                                    <select name="breed">
                                        <option value="germanshepherd" <?php echo (($data['breed']) == 'germanshepherd') ? 'selected' : '' ; ?> >German Shepherd</option>
                                        <option value="bulldog" <?php echo (($data['breed']) == 'bulldog') ? 'selected' : '' ; ?>>Bulldog</option>
                                        <option value="boxer" <?php echo (($data['breed']) == 'boxer') ? 'selected' : '' ; ?>>Boxer</option>
                                        <option value="persian" <?php echo (($data['breed']) == 'persian') ? 'selected' : '' ; ?>>Persian</option>
                                        <option value="bengal <?php echo (($data['breed']) == 'bengal') ? 'selected' : '' ; ?>">Bengal</option>
                                        <option value="sphynx" <?php echo (($data['breed']) == 'sphynx') ? 'selected' : '' ; ?>>Sphynx</option>
                                        
                                    </select>
                                </div>
                                <span class="invalid-feedback"></span>


                                <div class="flex-column">
                                    <label>Sex</label>
                                </div>
                                <div class="inputForm ">
                                    <i class='bx bx-male-sign' ></i>
                                    <select name="sex">
                                        <option value="male" <?php echo (($data['sex']) == 'male') ? 'selected' : '' ; ?> >Male</option>
                                        <option value="female" <?php echo (($data['sex']) == 'female') ? 'selected' : '' ; ?> >Female</option>
                                        
                                        
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