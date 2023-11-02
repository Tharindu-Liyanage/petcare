<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/temp/Dashboard- Assistant-petowner.css">
 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>dashboard</title>
</head>
<body>

<?php include __DIR__ . '/../../common/petowner_common.php'; ?>
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

            <div class="box">
                    <div class="bottom-data">
                        <!-- Start of orders -->
                        <div class="orders">
                            <div class="header">
                                <div class="header-left">
                                    <i class='bx bxs-user-account main'></i>
                                    <h3>Pet Owners</h3>
                                </div>
                                <div class="header-right">
                                    <i class='bx bx-filter'></i>
                                    <i class='bx bx-search'></i>
                                </div>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="profile">
                                            <img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/user1.jpg"><p> Doe John</p>
                                        </td>
                                        <td>123 Address St</td>
                                        <td>123-456-7890</td>
                                        <td>user1@example.com</td>
                                        <td class="action">
                                            <div class="act-icon">
                                                <i class='bx bx-trash'></i>
                                                <i class='bx bx-edit'></i>
                                                <i class='bx bx-show' ></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td class="profile">
                                            <img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/user2.jpeg"><p>smith Jane </p>
                                        </td>
                                        <td>456 elm st, new york NY 10001</td>
                                        <td>987-654-3210</td>
                                        <td>user2@example.com</td>
                                        <td class="action">
                                            <div class="act-icon">
                                                <i class='bx bx-trash'></i>
                                                <i class='bx bx-edit'></i>
                                                <i class='bx bx-show' ></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td class="profile">
                                            <img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/user3.jpeg"><p>john Mike </p>
                                        </td>
                                        <td>789 oak st, chicago NY IL 60007</td>
                                        <td>123-456-7890</td>
                                        <td>user3@example.com</td>
                                        <td class="action">
                                            <div class="act-icon">
                                                <i class='bx bx-trash'></i>
                                                <i class='bx bx-edit'></i>
                                                <i class='bx bx-show' ></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td class="profile">
                                            <img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/user3.jpeg"><p> Brown Saarah </p>
                                        </td>
                                        <td>111 pine st,seatle WA 98101</td>
                                        <td>444-789-3412</td>
                                        <td>user4@example.com</td>
                                        <td class="action">
                                            <div class="act-icon">
                                                <i class='bx bx-trash'></i>
                                                <i class='bx bx-edit'></i>
                                                <i class='bx bx-show' ></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                            <div class="footer-block">
                                <div class="footer-left">
                                    Showing <span class="current">5</span> out of <span class="total">25</span> entries
                                </div>
                                <div class="footer-right">
                                    <div class="previous">previous</div>
                                    <div class="page page1">1</div>
                                    <div class="page page2">2</div>
                                    <div class="page page3">3</div>
                                    <div class="page page4">4</div>
                                    <div class="page page5">5</div>
                                    <div class="next">next</div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </main>
    </div>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
</body>
</html>