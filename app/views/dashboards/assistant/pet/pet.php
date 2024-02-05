<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/temp/Dashboard- Assistant-pet.css">
 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>dashboard</title>
</head>
<body>

<?php require_once __DIR__ . '/../../common/common_variable/pet_common.php'; ?>
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
                
            </div>

           

            <div class="bottom-data">

<!--start od orders-->
<div class="users" id="pet">
    <div class="header">
    <i class='bx bxs-dog'></i>
        <h3>Pet</h3>

        <!-- Search Container -->

    <div class="search-container-table">
     <input type="text"  id="petSearch" name="text" class="search" placeholder="Search here..">
     <i class='bx bx-search' ></i>
    </div>

    <!-- search container over -->

        
    </div>
    <table>
        <thead>
            <tr>
                
                <th>Id <i class='bx bxs-sort-alt sort' data-sort="id-search"></th>
                <th>Pet<i class='bx bxs-sort-alt sort' data-sort="profile"></th>
                <th>DOB <i class='bx bxs-sort-alt sort' data-sort="dob-search"></th>
                <th>breed <i class='bx bxs-sort-alt sort' data-sort="breed-search"></th>
                <th>sex<i class='bx bxs-sort-alt sort' data-sort="sex-search"></th>
                <th>Action </th>
            </tr>
        </thead>
        <tbody class="list">

        <?php

            if(count($data['pet']) == 0){

                echo '<td class="isempty" colspan="7">No data available in table</td>';

            }else

           
             foreach($data['pet'] as $pet) : ?>

            
            <tr>
                <td class="id-search"><?php echo $pet->pet_id_generate?></td>
                <td class="profile">
                    <img src="<?php echo URLROOT;?>/public/storage/uploads/animal/<?php echo $pet-> profileImage ?>" ><p><?php echo $pet->species?> <?php echo $pet-> petowner_id?></p>
                </td class="id-search">
                <td class="dob-search"><?php echo $pet->DOB?></td>
                <td class="breed-search"><?php echo $pet->breed?></td>
                <td class="sex-search"><?php echo $pet->sex?></td>
                
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