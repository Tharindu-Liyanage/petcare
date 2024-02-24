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

   <?php require_once __DIR__ . '/../../common/common_variable/petowner_common.php'; ?>
   <?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>

    <main>

         <div class="header">
            <div class="left">
                <h1>Petowner</h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT;?>/petowner">Dashboard</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/petowner/petowner">Pet</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/petowner/updatePetowner/<?php echo $data['id'];?>" class="active">Update Petowner</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">

            

<!-- staff add model here -->
<div class="add-model">

   <div class="header">
   <i class='bx bxs-user' ></i>
        <h3>Update Petowner</h3>       
    </div>

    


    <form class="form" method="post" enctype="multipart/form-data" action="<?php echo URLROOT; ?>/petowner/updatePetowner/<?php echo $data['id'] ;?>">

      

    <div class="column">

                        <div class="flex-column">
                            
                            <label>Phone Number</label>
                           
                        <div class="inputForm <?php echo (!empty($data['mobile_err'])) ? 'is-invalid' : '' ; ?>">
                        <i class='bx bxs-phone'></i>
                        <input type="text" class="input " placeholder="Enter phone number" value="<?php echo $data['mobile']?>" name="mobile">
                        </div>
                                
                        <span class="invalid-feedback"><?php echo $data['mobile_err']?></span>
                        </div>


                        <div class="flex-column">
                    
                           <label>Email</label>
                       
                       <div class="inputForm <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ; ?>">
                       <i class='bx bx-envelope'></i>
                        <input type="text" class="input " placeholder="Enter Email" value="<?php echo $data['email']?>" name="email">
                       </div>
                       <span class="invalid-feedback"><?php echo $data ['email_err']?></span>
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