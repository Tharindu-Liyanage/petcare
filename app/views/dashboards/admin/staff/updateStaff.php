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

   <?php require_once __DIR__ . '/../../common/staff_common.php'; ?>
    <?php require_once __DIR__ . '/../component/admin-side-bar.php'; ?>

    <main>

         <div class="header">
            <div class="left">
                <h1>Staff</h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT;?>/admin">Dashboard</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/admin/staff">Staff</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/admin/addStaff" class="active">Update Staff</a></li>
                </ul>
            </div>
        </div>


            
               

        <div class="bottom-data">

            

            <!-- staff add model here -->
            <div class="add-model">

               <div class="header">
                    <i class='bx bx-edit icon-header' ></i>
                    <h3>Update Staff Member</h3>       
                </div>

                


                <form class="form" method="post" action="<?php echo URLROOT; ?>/admin/updateStaff/<?php echo $data['id']; ?>">

                  

                <div class="column">

                        <div class="flex-column">
                            <label>First Name</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['fname_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-user' ></i>
                            <input type="text" class="input" name="fname" placeholder="Enter first Name" value="<?php echo $data['first_name']?>">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['fname_err']; ?></span>

                        <div class="flex-column">
                            <label>Last Name</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['lname_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-user' ></i>
                            <input type="text" class="input " placeholder="Enter last Name" value="<?php echo $data['last_name']?>" name="lname">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['lname_err']; ?></span>

                        <div class="flex-column">
                            <label>Email </label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-envelope' ></i>
                            <input type="text" class="input " placeholder="Enter email Address" value="<?php echo $data['email']?>" name="email">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>


                </div> <!-- column tag close -->

                <div class="column">

                        <div class="flex-column">
                            <label>Address</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['address_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-buildings' ></i>
                            <input type="text" class="input" placeholder="Enter Address" name="address" value="<?php echo $data['address']?>">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['address_err']; ?></span>


                        <div class="flex-column">
                            <label>Mobile</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['role_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-phone-call' ></i>
                            <input type="text" class="input" placeholder="Enter mobile Number" name="mobile" value="<?php echo $data['mobile']?>" >
                        </div>
                        <span class="invalid-feedback"><?php echo $data['mobile_err']; ?></span>


                        <div class="flex-column">
                            <label>Role</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['role_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-briefcase-alt' ></i>
                            <select name="role">
                                <option value="Admin" <?php echo (($data['role']) == 'Admin') ? 'selected' : '' ; ?>  >Admin</option>
                                <option value="Assistant" <?php echo (($data['role']) == 'Assistant') ? 'selected' : '' ; ?> >Assistant</option>
                                <option value="Doctor" <?php echo (($data['role']) == 'Doctor') ? 'selected' : '' ; ?> >Doctor</option>
                                <option value="Nurse" <?php echo (($data['role']) == 'Nurse') ? 'selected' : '' ; ?> >Nurse</option>
                                <option value="Store Manager" <?php echo (($data['role']) == 'Store Manager') ? 'selected' : '' ; ?> >Store Manager</option>
                            </select>
                        </div>
                        <span class="invalid-feedback"><?php echo $data['role_err']; ?></span>

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