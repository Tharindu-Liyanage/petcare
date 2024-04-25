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

   <?php require_once __DIR__ . '/../../common/common_variable/pet_common.php'; ?>
   <?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?> <!-- this HTML code is for the top and sidebar of the dashboard -->

    <main>

         <div class="header">
            <div class="left">
                <h1>Pet</h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT;?>/assistant">Dashboard</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/assistant/pet">Pet</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/assistant/addPet" class="active">Add pet</a></li>
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
                            <i class='bx bxs-dog' ></i>
                            <input type="text" class="input" name="pname" placeholder="Enter pet Name" value="<?php echo $data['pname']?>">
                        </div>

                        <span class="invalid-feedback"><?php echo $data['pname_err']?></span>
                </div>               

                <div class="flex-column">

                    <label>Date Of Birth</label>
                            
                        <div class="inputForm <?php echo (!empty($data['dob_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-calendar' ></i>
                            <input type="date" class="input " placeholder="Select Date" value="<?php echo $data['dob']?>" name="dob">
                        </div>
                        
                        <span class="invalid-feedback"><?php echo $data['dob_err']?></span>

                </div>


                <div class="flex-column">
                    
                    <label>Species </label>
                       
                    <div class="inputForm <?php echo (!empty($data['species_err'])) ? 'is-invalid' : '' ; ?>">
                        <i class='bx bx-spreadsheet' ></i>
                        <input type="text" class="input " placeholder="Select Species" value="<?php echo $data['species']?>" name="species">
                    </div>
                    <span class="invalid-feedback"><?php echo $data['species_err']?></span>
                </div>



                <div class="flex-column">
                    
                    <label>breed </label>
                       
                    <div class="inputForm <?php echo (!empty($data['breed_err'])) ? 'is-invalid' : '' ; ?>">
                        <i class='bx bx-spreadsheet' ></i>
                        <input type="text" class="input " placeholder="Select breed" value="<?php echo $data['breed']?>" name="breed">
                    </div>
                    <span class="invalid-feedback"><?php echo $data['breed_err']?></span>
                </div>
                        
                
            

                <div class="flex-column">
                            <label>Sex</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['sex_err'])) ? 'is-invalid' : '' ; ?>">
                        <i class='bx bx-male-sign' ></i>
                            <select name="sex">
                                <option value=""  selected>Select Sex</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                               
                        </div>
                        <span class="invalid-feedback"><?php echo $data['sex_err']; ?></span>



                 <div class="flex-column">
                    
                    <label>petownerID</label>
                       
                    <div class="inputForm <?php echo (!empty($data['petownerID_err'])) ? 'is-invalid' : '' ; ?>">
                    <i class='bx bxs-id-card'></i>
                        <input type="text" class="input" placeholder="Enter petownerID" value="<?php echo $data['petownerID']?>" name="petownerID">
                    </div>
                    <span class="invalid-feedback"><?php echo $data ['petownerID_err']?></span>
                </div>
                        

                
                        
                        


            

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