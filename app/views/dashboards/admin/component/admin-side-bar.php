
      <!--sidebar-->
      <div class="sidebar">
         <a href="#" class="logo">
            <img src="<?php echo URLROOT; ?>/public/img/logo/logo-croped.png" class="logo-top">
            <div class="logo-name">PetCare<span>.</span></div>
         </a>
         <ul class="side-menu">
            <li class="<?php echo ($current_page == 'index') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/admin/"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
            <li class="<?php echo ($current_page == 'shop') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/admin/shop"><i class='bx bx-store-alt'></i> Shop</a></li>
            <li class="<?php echo ($current_page == 'analytics') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/admin/analytics"><i class='bx bx-analyse'></i> Analytics</a></li>
            <li class="<?php echo ($current_page == 'tickets') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/admin/tickets"><i class='bx bx-message-square-dots'></i> Tickets</a></li>
            <li class="<?php echo ($current_page == 'staff') ? 'active' : '' ; ?>" ><a href="<?php echo URLROOT; ?>/admin/staff"><i class='bx bx-group'></i> Staff</a></li>
            <li class="class=<?php echo ($current_page == 'setting') ? 'active' : '' ; ?>"><a href="<?php echo URLROOT; ?>/admin/settings"><i class='bx bx-group'></i> Settings</a></li>
         </ul>
         <ul class="sidemenu">
            <li>
               <a href="<?php echo URLROOT; ?>/users/logout" class="logout">
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
            <form action="#">
               <div class="form-input">
                  <input type="search" placeholder="Searrch..." >
                  <button class="search-btn" type="submit"><i class='bx bx-search' ></i></button>
               </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
            <i class='bx bx-bell' ></i>
            <span class="count">12</span>
            </a>
            <a href="#" class="profile">
               <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $_SESSION['user_profileimage'];?>" >   <!-- image input.....-->
            </a>
         </nav>
         <!--end of nav bar -->

       



