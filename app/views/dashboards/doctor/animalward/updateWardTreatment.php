<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/addStaff.css"> <!-- for table -->
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <title>PetCare | AnimalWard</title>
   </head>
   <body>

   <?php require_once __DIR__ . '/../../common/common_variable/animalward_common.php'; ?>
   <?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>

    <main>

         <div class="header">
            <div class="left">
                <h1>Animal Ward</h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT;?>/doctor">Dashboard</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/doctor/animalward">Animal Ward</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/admin/UpdateWardTreatment" class="active">Dischaerge Patient</a></li>
                </ul>
            </div>
        </div>


            
               

        <div class="bottom-data">

            

            <!-- staff add model here -->
            <div class="add-model">

               <div class="header">
                <i class='bx bx-plus-medical' ></i>
                    <h3>Discharge Patient </h3>       
                </div>

                


                <form class="form" method="post" action="">  <!-- action removed -->

                  

                <div class="column">

                        <div class="flex-column">
                            <label>Pet</label>
                        </div>
                        <div class="inputForm ">
                        <i class='bx bx-search'></i>
                            <input type="text" class="input" name="fname" placeholder="Search pet" value="">
                        </div>
                        <span class="invalid-feedback"></span>

                        

                        <div class="flex-column">
                            <label>Follow-Up-Date</label>
                        </div>
                        <div class="inputForm ">
                            <i class='bx bx-calendar' ></i>
                            <input type="date" class="input" name="fname" placeholder="Select a Date" value="">
                        </div>
                        <span class="invalid-feedback"></span>


                </div> <!-- column tag close -->

                <div class="column">

                  


                            <div class="flex-column">
                                <label>Veterinarian / Nurse Note</label>
                             </div>
                            <div class="inputForm" style="height:125px;">

                            <div style="display:flex; ">
                                
                            <i class='bx bx-pencil' ></i>
                            <textarea rows="4"  cols="50"  type="text" class="input"   name="fname" placeholder="Write here" style="width:100%;" ></textarea> </div>
                            </div>
                            <span class="invalid-feedback"></span>



                </div> <!-- column close -->

                <div class="button-form">
                  <button type="reset"  class="button-submit">Reset</button> 
                  <button type="submit" id="button-submit" class="button-submit">Discharge</button>
                </div>
           
            </form>

            </div> <!-- model over -->
            </div> <!-- content over -->
           
         </main>
      </div>
      
      <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
   </body>
</html>