<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <?php require_once __DIR__ . '/../common/favicon.php'; ?>


    <title>PetCare | Dashboard</title>

    <style>
        .orders table {
            font-size: 12px !important;
        }

        .orders table a{
            color:var(--black) !important;
        }

    /*make table tbody scrollable with table header*/
    .orders table tbody {
        display: block;
        height: 250px;
        overflow-y: auto;
    }

    .orders table thead,
    .orders table tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    .orders table thead {
        width: calc(100% - 17px); /* Adjust for scrollbar width */
    }

    .orders table tbody {
        width: 100%;
    }

    .orders table td {
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }

    .orders table img{
        width:35px !important;
        height:35px !important;
    }



        
        

        .orders table tr td .status{
            display: flex;
            align-items: center;
            color:var(--black) !important;
            font-size: 12px !important;
        }

        .orders table tr td .status i{
            font-size: 10px !important;
            margin-right: 5px;
        }

        .orders table tr td .status.green{
            color:green !important;
        }

        .orders table tr td .status.red{
            color:#E32636 !important;
        }

        .content main .bottom-data .orders{
            flex-basis:250px !important;
           /* height: 510px;*/
        }

        .content main .bottom-data .orders table tr td.profile-search{
            font-weight:500;
            margin-right:5px;
            text-wrap: pretty;
        }

        .content main .bottom-data .orders table tr td.time-search{
           text-align:center;
        }

        
        .filter-buttons-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .filter-button1, .filter-button2 , .filter-button3{
            background-color: #f0f0f0;
            border: none;
            color: #333;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 10px;
        }

        .filter-button1.active, .filter-button2.active , .filter-button3.active{
            background-color: var(--primary);
            color: #fff;
        }

        .filter-button1:hover, .filter-button2:hover , .filter-button3:hover{
            background-color: #4672F1;
            color: #fff;
        }
    </style>
</head>
<body>

<?php require_once __DIR__ . '/../common/common_variable/index_common.php'; ?>
<?php include __DIR__ . '/../common/dashboard-top-side-bar.php'; ?>


        <main>
            <div class="header">
                <div class="left">
                    <h1>dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                            Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT; ?>/admin" class="active"> Home</a></li>
                    </ul>
                </div>
                
            </div>

            <!--insights-->
            <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check' ></i>
                    <span class="info">
                        <h3>1,074</h3>
                        <p>Paid Order</p>
                    </span>
                </li>
                <li><i class='bx bx-show-alt' ></i>
                    <span class="info">
                        <h3>3,944</h3>
                        <p>Site Visit</p>
                    </span></li>
                <li><i class='bx bx-line-chart' ></i>
                    <span class="info">
                        <h3>14,743</h3>
                        <p>Searchers</p>
                    </span></li>
                <li><i class='bx bx-dollar-circle' ></i>
                    <span class="info">
                        <h3>$6,766</h3>
                        <p>Total Sales</p>
                    </span></li>
            </ul>
            <!--end of insisghts-->

            <div class="bottom-data">

                
                <!--reminders-->
                <div class="reminders">
                    <div class="header">
                    <i class='bx bx-line-chart'></i>
                        <h3>Customers</h3>
                       
                    </div>

                    <canvas id="myChart"></canvas>

                    <div class="filter-buttons-container">
                        <button class="filter-button3" id="filter-button-1" onclick="changeDataSetCustomer(this)" value="year">Year</button>
                        <button class="filter-button3 active" id="filter-button-2" onclick="changeDataSetCustomer(this)" value="month">Month</button>
                    </div>

                <!-- end of reminder -->
            </div>

            <!--start od orders-->
            <div class="orders" id="staff">
                    <div class="header">
                    <i class='bx bx-user-circle'></i>
                        <h3>Staff</h3>
                        
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
                                <th>User <i class='bx bxs-sort-alt sort' data-sort="profile-search"></th>
                                <th>Last Login <i class='bx bxs-sort-alt sort' data-sort="time-search"></th>
                                <th>Status <i class='bx bxs-sort-alt sort' data-sort="status-search"></th>
                            </tr>
                        </thead>
                        <tbody class="list">

                        <?php

                            if(count($data['staff']) == 0){

                                echo '<td class="isempty" colspan="7">No data available in table</td>';

                            }else
                            
                            
                            foreach($data['staff'] as $staff) : ?>
                            <tr>
                                <td class="profile-search">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $staff->profileImage?>" ><p><a href="<?php echo URLROOT;?>/admin/profileStaff/<?php echo $staff->staff_id?>"><?php echo $staff->firstname;?> <?php echo $staff->lastname;?></a></p>
                                </td>
                                <td class="time-search"> 
                                <?php
                                    $last_login = $staff->last_login;
                                    $current_time = time(); // Get current timestamp
                                    $time_diff = $current_time - strtotime($last_login); // Time difference in seconds
                                    if($staff->last_login == null){
                                        echo 'Never';
                                    }elseif ($time_diff < 60) {
                                        echo $time_diff . ' seconds ago';
                                    } elseif ($time_diff < 3600) { // Less than 1 hour
                                        $minutes = floor($time_diff / 60);
                                        echo $minutes . ' minutes ago';
                                    } elseif ($time_diff < 86400) { // Less than 1 day
                                        $hours = floor($time_diff / 3600);
                                        echo $hours . ' hours ago';
                                    } else {
                                        $days = floor($time_diff / 86400);
                                        echo $days . ' days ago';
                                    }
                                    ?>

                                </td>
                                <td class="status-search"><span class="status <?php if($staff->online_status == 1){ echo "green"; } else { echo "red"; } ?>"> <i class='bx bxs-circle'></i> <?php if($staff->online_status == 1){ echo "Online"; } else { echo "Offline"; } ?></span></td>
                            </tr>
                            
                            <?php endforeach; ?>
                            
                        </tbody>
                    </table>
                    <div class="pagination-main">
                        <ul class="pagination"></ul>
                    </div>
                </div>

        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/admin/indexTable.js"></script>

    <script>

            //if button click add class active
            const filterButtons = document.querySelectorAll(".filter-button3");

            filterButtons.forEach(button => {
                button.addEventListener("click", () => {
                    filterButtons.forEach(b => b.classList.remove("active"));
                    button.classList.add("active");
                });
            });

            var chartData = <?php echo json_encode($data); ?>;

            var ctx = document.getElementById('myChart').getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labelsMonth,
                    datasets: [{
                        label: 'Pet Owners',
                        data: chartData.dataMonth,
                        backgroundColor: 'rgba(70, 114, 241, 0.2)',
                        borderColor: 'rgba(70, 114, 241, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            function changeDataSetCustomer(button){
                // Get the value of the button
                const value = button.value;

                // Update the chart data
                if (value === "year") {
                    myChart.data.labels = chartData.labelsYear;
                    myChart.data.datasets[0].data = chartData.dataYear;
                    myChart.data.datasets[0].label = "Yearly Customers";
                    //x-axis title
                    myChart.options.scales.x.title.text = "Year";
                } else {
                    myChart.data.labels = chartData.labelsMonth;
                    myChart.data.datasets[0].data = chartData.dataMonth;
                    myChart.data.datasets[0].label = "Monthly Customers";
                    //x-axis title
                    myChart.options.scales.x.title.text = "Year-Month";
                }

                // Update the chart
                myChart.update();
            }


    </script>
    
    
</body>
</html>