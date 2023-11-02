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
                <h1>Staff</h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT;?>/petowner">Dashboard</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/petowner/pet">Pet</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/petowner/addPet" class="active">Add Pet</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">

            

<!-- staff add model here -->
<div class="add-model">

   <div class="header">
        <i class='bx bxs-user-plus icon-header' ></i>
        <h3>Add Staff Member</h3>       
    </div>

    


    <form class="form" method="post" action="<?php echo URLROOT; ?>/petowner/updatePet/<?php echo $data['id'] ;?>">

      

    <div class="column">

        <div class="flex-column">
                            <label>Pet Name</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['pname_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-user' ></i>
                            <input type="text" class="input" name="pname" placeholder="Enter pet Name" value="<?php echo $data['pname']?>">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['pname_err']; ?></span>

                        <div class="flex-column">
                            <label>Date Of Birth</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['dob_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-user' ></i>
                            <input type="date" class="input " placeholder="Select Date" value="<?php echo $data['dob']?>" name="dob">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['dob_err']; ?></span>

                        <div class="flex-column">
                            <label>Species </label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['species_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-envelope' ></i>
                            <input type="text" class="input " placeholder="Select Species" value="<?php echo $data['species']?>" name="species">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['species_err']; ?></span>

                        

    </div> <!-- column tag close -->

    <div class="column">

                     <div class="flex-column">
                            <label>Breed </label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['breed_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-envelope' ></i>
                            <input type="text" class="input " placeholder="Enter Breed" value="<?php echo $data['breed']?>" name="breed">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['breed_err']; ?></span>


                        <div class="flex-column">
                            <label>Sex</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['sex_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-briefcase-alt' ></i>
                            <select name="sex">
                            <option value="Male" <?php echo (($data['sex']) == 'Male') ? 'selected' : '' ; ?>  >Male</option>
                            <option value="Female" <?php echo (($data['sex']) == 'Female') ? 'selected' : '' ; ?> >Female</option>
                                
                            </select>
                               
                        </div>
                        <span class="invalid-feedback"><?php echo $data['sex_err']; ?></span>


                        <div class="flex-column">
                            <label>Age</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['age_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-user' ></i>
                            <input type="text" class="input" name="age" placeholder="Enter pet Age" value="<?php echo $data['age']?>">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['age_err']; ?></span>

                        
                        


            

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