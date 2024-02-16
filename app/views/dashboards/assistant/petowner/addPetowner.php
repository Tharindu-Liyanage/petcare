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
                <h1>Pet Owner</h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT;?>/assistant">Dashboard</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/assistant/petowner">Petowner</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/assistant/addPetowner" class="active">Add petowner</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">

            

<!-- staff add model here -->
<div class="add-model">

   <div class="header">
   <i class='bx bx-user' ></i>
        <h3>Add petowner</h3>       
    </div>

    


    <form class="form" method="post"  action="">

      

    <div class="column-for-inputs">

                <div class="flex-column">
                            
                    <label>First Name</label>
                        
                        <div class="inputForm <?php echo (!empty($data['firstname_err'])) ? 'is-invalid' : '' ; ?>">
                        <i class='bx bx-user' ></i>
                            <input type="text" class="input" name="firstname" placeholder="Enter first Name" value="<?php echo $data['firstname']?>">
                        </div>

                        <span class="invalid-feedback"><?php echo $data['firstname_err']?></span>
                </div>               

                <div class="flex-column">

                    <label>Last Name</label>
                            
                        <div class="inputForm <?php echo (!empty($data['lastname_err'])) ? 'is-invalid' : '' ; ?>">
                        <i class='bx bx-user' ></i>
                            <input type="text" class="input " placeholder="Enter last name" value="<?php echo $data['lastname']?>" name="lastname">
                        </div>
                        <!-- me span ek error msg ekk pennann -->
                        <span class="invalid-feedback"><?php echo $data['lastname_err']?></span> 

                </div>




                
                <div class="flex-column">

                    <label>Address</label>
                            
                        <div class="inputForm <?php echo (!empty($data['address_err'])) ? 'is-invalid' : '' ; ?>">
                        <i class='bx bx-user' ></i>
                            <input type="text" class="input " placeholder="Enter address" value="<?php echo $data['address']?>" name="address">
                        </div>
                        <!-- me span ek error msg ekk pennann -->
                        <span class="invalid-feedback"><?php echo $data['address_err']?></span> 

                </div>


                <div class="flex-column">
                    
                    <label>Email</label>
                       
                    <div class="inputForm <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ; ?>">
                    <i class='bx bx-envelope'></i>
                        <input type="text" class="input " placeholder="Enter Email" value="<?php echo $data['email']?>" name="email">
                    </div>
                    <span class="invalid-feedback"><?php echo $data ['email_err']?></span>
                </div>
                        
                 <div class="flex-column">
                            
                    <label>Phone Number</label>
                   
                    <div class="inputForm <?php echo (!empty($data['mobile_err'])) ? 'is-invalid' : '' ; ?>">
                    <i class='bx bxs-phone'></i>
                        <input type="text" class="input " placeholder="Enter phone number" value="<?php echo $data['mobile']?>" name="mobile">
                    </div>
                        
                    <span class="invalid-feedback"><?php echo $data['mobile_err']?></span>

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