<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/temp/Dashboard- Assistant-petowner.css">
 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>dashboard</title>
</head>
<body>

<?php require_once __DIR__ . '/../../common/common_variable/petowner_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


        <main>
            <div class="header">
                <div class="left">
                    <h1>dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                            Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT; ?>/assistnat" class="active"> Home</a></li>
                    </ul>
                </div>

                <!-- button is here -->

                <!-- change href to <?php echo URLROOT;?>/assistant/addPetowner (assistant is controller , addPetowner is method)  AND Add Staff Member to Add Petowner -->

                <div class="add-button">
             <a href="<?php echo URLROOT;?>/assistant/addPetowner" ><button id="add-form-button">
                <i class='bx bx-user-plus' ></i>
                        Add PET OWNER
                </button> </a>
            </div>


                   
            </div>

            

           

            <div class="bottom-data">

            

<!--start od orders-->
<div class="users" id="pet">
    <div class="header">
    <i class='bx bx-user'></i>
        <h3>Petowner</h3>

        <!-- Search Container -->

    <div class="search-container-table">
     <input type="text"  id="userSearch" name="text" class="search" placeholder="Search here..">
     <i class='bx bx-search' ></i>
    </div>

    <!-- search container over -->

        
    </div>
    <table>
        <thead>
            <tr>
                
                <th>Id <i class='bx bxs-sort-alt sort' data-sort="id-search"></th>
                <th>Petowner <i class='bx bxs-sort-alt sort' data-sort="profile"></th>
                <th>Address <i class='bx bxs-sort-alt sort' data-sort="dob-search"></th>
                <th>Mobile <i class='bx bxs-sort-alt sort' data-sort="breed-search"></th>
                <th>Email <i class='bx bxs-sort-alt sort' data-sort="sex-search"></th>
                <th>Action </th>
            </tr>
        </thead>
        <tbody class="list">

        <?php

            if(count($data['petowner']) == 0){

                echo '<td class="isempty" colspan="7">No data available in table</td>';

            }else

           
             foreach($data['petowner'] as $petowner) : ?>

            
            <tr>
                <td class="id-search"><?php echo $petowner->petowner_id_generate?></td>
                <td class="profile">
                    <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $petowner-> profileImage ?>" ><p><?php echo $petowner-> first_name?> <?php echo $petowner-> last_name?></p>
                </td class="id-search">
                <td class="dob-search"><?php echo $petowner->address?></td>
                <td class="breed-search"><?php echo $petowner->mobile?></td>
                <td class="sex-search"><?php echo $petowner->email?></td>
                
                <td class="action">
                    
                    <div class="act-icon">
                          
                           
                    </div>
                    
                </td>
            </tr>

            <?php endforeach; ?>
       
        </tbody>
    </table>

    <?php include __DIR__ . '/../../common/pagination_footer.php'; ?>
</div>

</div> <!-- content over -->

        </main>
    </div>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
</body>
</html>