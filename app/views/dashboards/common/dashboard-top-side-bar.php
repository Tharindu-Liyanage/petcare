
      <!--sidebar-->
      <div class="sidebar">
         <a href="<?php echo URLROOT;?>/home" class="logo">
            <img src="<?php echo URLROOT; ?>/public/img/logo/logo-croped.png" class="logo-top">
            <div class="logo-name">PetCare<span>.</span></div>
         </a>
         <ul class="side-menu">

         <?php if($_SESSION['user_role'] == "Admin") : ?>

            <li class="<?php echo ($current_page == 'index') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/admin/"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
            <li class="<?php echo ($current_page == 'appointment') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/admin/appointment"><i class='bx bx-calendar'></i> Appointment</a></li>
            <li class="<?php echo ($current_page == 'staff') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/admin/staff"><i class='bx bx-group'></i> Staff</a></li>
            <li class="<?php echo ($current_page == 'petowner') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/admin/petowner"><i class='bx bx-user'></i> Pet Owner</a></li>
            <li class="<?php echo ($current_page == 'pet') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/admin/pet"><i class='bx bxs-dog' ></i> Pet</a></li>
            <li class="<?php echo ($current_page == 'report') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/admin/report"><i class='bx bx-line-chart'></i> Report</a></li>
            <li class="<?php echo ($current_page == 'setting') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/admin/settings/all"><i class='bx bx-cog' ></i> Settings</a></li>
         </ul>

         <?php elseif($_SESSION['user_role'] == "Assistant") : ?>

            <li class="<?php echo ($current_page == 'index') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/assistant/"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
            <li class="<?php echo ($current_page == 'appointment') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/assistant/appointment"><i class='bx bx-calendar' ></i> Appointment</a></li>
            <li class="<?php echo ($current_page == 'petowner') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/assistant/petowner"><i class='bx bx-user'></i> Pet Owner</a></li>
            <li class="<?php echo ($current_page == 'pet') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/assistant/pet"><i class='bx bxs-dog'></i> Pet</a></li>
            <li class="<?php echo ($current_page == 'bill') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/assistant/medicalBill"><i class='bx bx-wallet' ></i> Medical Bill</a></li>
            <li class="<?php echo ($current_page == 'setting') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/assistant/settings/all"><i class='bx bx-cog' ></i> Settings</a></li>
         </ul>

         <?php elseif($_SESSION['user_role'] == "Nurse") : ?>

            <li class="<?php echo ($current_page == 'index') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/nurse/"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
            <li class="<?php echo ($current_page == 'animalward') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/nurse/animalward"><i class='bx bx-plus-medical' ></i> Animal Ward</a></li>
            <li class="<?php echo ($current_page == 'pet') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/nurse/pet"><i class='bx bxs-dog' ></i></i> Pet</a></li>
            <li class="<?php echo ($current_page == 'bill') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/nurse/medicalBill"><i class='bx bx-file' ></i> Medical Bill</a></li>
            <li class="<?php echo ($current_page == 'setting') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/nurse/settings/all"><i class='bx bx-cog' ></i> Settings</a></li>
         </ul>

         <?php elseif($_SESSION['user_role'] == "Doctor") : ?>

            <li class="<?php echo ($current_page == 'index') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/doctor/"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
            <li class="<?php echo ($current_page == 'appointment') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/doctor/appointment"><i class='bx bx-calendar' ></i> Appointment</a></li>
            <li class="<?php echo ($current_page == 'animalward') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/doctor/animalward"><i class='bx bx-plus-medical' ></i> Animal Ward</a></li>
            <li class="<?php echo ($current_page == 'blog') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/doctor/blog"><i class='bx bxl-blogger' ></i></i> Blog</a></li>
            <li class="<?php echo ($current_page == 'pet') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/doctor/pet"><i class='bx bxs-dog' ></i></i> Pet</a></li>
            <li class="<?php echo ($current_page == 'treatment') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/doctor/treatment"><i class='bx bx-first-aid' ></i> Treatment</a></li>
            <li class="<?php echo ($current_page == 'setting') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/doctor/settings/all"><i class='bx bx-cog' ></i> Settings</a></li>
         </ul>

         <?php elseif($_SESSION['user_role'] == "Store Manager") : ?>

            <li class="<?php echo ($current_page == 'index') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/storemanager/"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
            <li class="<?php echo ($current_page == 'inventory') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/storemanager/inventory"><i class='bx bx-store-alt'></i> Inventory</a></li>
            <li class="<?php echo ($current_page == 'order') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/storemanager/order"><i class='bx bx-shopping-bag' ></i> Order</a></li>
            <li class="<?php echo ($current_page == 'category') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/storemanager/category"><i class='bx bx-category' ></i> Category</a></li>
            <li class="<?php echo ($current_page == 'setting') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/storemanager/settings/all"><i class='bx bx-cog' ></i> Settings</a></li>
         </ul>

         <?php elseif($_SESSION['user_role'] == "Pet Owner") : ?>

            <li class="<?php echo ($current_page == 'index') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/petowner/"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
            <li class="<?php echo ($current_page == 'appointment') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/petowner/appointment"><i class='bx bx-calendar'></i> Appointment</a></li>
            <li class="<?php echo ($current_page == 'medicalreport') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/petowner/medicalreport"><i class='bx bx-file'></i> Medical Report</a></li>
            <li class="<?php echo ($current_page == 'animalward') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/petowner/animalward"><i class='bx bx-plus-medical' ></i> Animal Ward</a></li>
            <li class="<?php echo ($current_page == 'pet') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/petowner/pet"><i class='bx bxs-dog' ></i> Pet</a></li>
            <li class="<?php echo ($current_page == 'bill') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/petowner/medicalBill"><i class='bx bx-wallet'></i></i> Medical Bill</a></li>
            <li class="<?php echo ($current_page == 'myorder') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/petowner/myOrders"><i class='bx bx-shopping-bag'></i> My Orders</a></li>
            <li class="<?php echo ($current_page == 'setting') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/petowner/settings/all"><i class='bx bx-cog' ></i> Settings</a></li>
         </ul>

         <?php endif; ?>

         <ul class="sidemenu">
            <li>
            <?php if($_SESSION['user_role'] == "Pet Owner"){
               echo '<a href="' . URLROOT . '/users/Logout" class="logout">';

            }else{
               echo '<a href="' . URLROOT . '/users/staffLogout" class="logout">';

            } ?>
               


               <i class='bx bx-log-out' ></i>
               <span class="lo">Logout </span> 
               </a>
            </li>
         </ul>
      </div>
      <!--end of side bar-->


      <!--main contenr-->
      <div class="content">
         <nav>
            <i class='bx bx-menu' ></i>
           <!-- <form action="#">
               <div class="form-input">
                  <input type="search-top" placeholder="Searrch..." >
                  <button class="search-btn" type="submit"><i class='bx bx-search' ></i></button>
               </div>
            </form> -->
            <input type="checkbox" id="theme-toggle" hidden>
         <!--   <label for="theme-toggle" class="theme-toggle"></label> -->
     <!--       <a href="#" class="notif">
          <i class='bx bx-bell' ></i>
            <span class="count">1</span>  
            </a> -->
            <a href="#" class="profile">

               <div class="info">
                    <p><span class="info-hi">Hey,</span> <b><?php echo $_SESSION['user_fname']; ?></b></p>
                    <small class="text-muted"><?php echo $_SESSION['user_role'];?></small>
                </div>

               <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $_SESSION['user_profileimage'];?>" >   <!-- image input.....-->
            </a>
         </nav>
         <!--end of nav bar -->

       



