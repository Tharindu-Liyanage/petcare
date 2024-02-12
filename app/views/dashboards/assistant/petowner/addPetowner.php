<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/addStaff.css">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <title>Dashboard</title>

      <style>

        .column-for-inputs{
            align-items: center;
        }

        .form{
         display:block !important;
         padding-left: 100px !important; 
         padding-right: 200px !important;
        }

        @media screen and (max-width: 600px) {
            .form{
                padding-left: 20px !important; 
                padding-right: 20px !important;
            }
            
        }
           
        
        
      

      </style>
   </head>
   <body>

   <?php require_once __DIR__ . '/../../common/common_variable/petowner_common.php'; ?>
   <?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?> <!-- this HTML code is for the top and sidebar of the dashboard -->

    <main>

         <div class="header">
            <div class="left">
                <h1>Pet</h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT;?>/assistant">Dashboard</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/assistant/petowner">Petownr</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/assistant/addPetowner" class="active">Add petowner</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">

            

<!-- staff add model here -->
<div class="add-model">

   <div class="header">
   <i class='bx bxs-dog' ></i>
        <h3>Add pet</h3>       
    </div>

    


    <form class="form" method="post" enctype="multipart/form-data" action="">

      

    <div class="column-for-inputs">

                <div class="flex-column">
                            
                    <label>Pet Name</label>
                        
                        <div class="inputForm <?php echo (!empty($data['pname_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-purchase-tag-alt' ></i>
                            <input type="text" class="input" name="pname" placeholder="Enter pet Name" value="">
                        </div>
                </div>               

                <div class="flex-column">

                    <label>Date Of Birth</label>
                            
                        <div class="inputForm <?php echo (!empty($data['dob_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-calendar' ></i>
                            <input type="date" class="input " placeholder="Select Date" value="" name="dob">
                        </div>
                        
                        <span class="invalid-feedback">bb</span>

                </div>


                <div class="flex-column">
                    
                    <label>Species </label>
                       
                    <div class="inputForm <?php echo (!empty($data['species_err'])) ? 'is-invalid' : '' ; ?>">
                        <i class='bx bx-spreadsheet' ></i>
                        <input type="text" class="input " placeholder="Select Species" value="" name="species">
                    </div>
                    <span class="invalid-feedback"></span>
                </div>
                        
                 <div class="flex-column">
                            
                    <label>Breed </label>
                        
                    <div class="inputForm <?php echo (!empty($data['breed_err'])) ? 'is-invalid' : '' ; ?>">
                        <i class='bx bx-spreadsheet' ></i>
                        <input type="text" class="input " placeholder="Enter Breed" value="" name="breed">
                    </div>
                        
                    <span class="invalid-feedback"></span>

                </div>


                <div class="flex-column">
                            
                    <label>Upload Image</label>
                        
                    <div class="inputForm <?php echo (!empty($data['img_err'])) ? 'is-invalid' : '' ; ?>">
                        <i class='bx bx-image-alt'></i>
                        <input type="file" class="input" name="pet_img" accept="image/*">
                    </div>
                        
                    <span class="invalid-feedback"></span>
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
                        
               

       
      
      <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
   </body>

</html>