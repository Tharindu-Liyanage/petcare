<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <?php require_once __DIR__ . '/../../common/favicon.php'; ?>
    <title>PetCare | Report</title>

    <style>
        

        .chart-container {
            margin:auto;
            width: 70%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .chart-header {
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 20px;
            padding-bottom: 20px;
        }

        .chart-header h2 {
            font-size: 1.5rem;
            margin: 0;
        }

        .chart {
            height: auto;
            width: 100%;
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

<?php require_once __DIR__ . '/../../common/common_variable/report_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


        <main>
            <div class="header">
                <div class="left">
                    <h1>Reports</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                            Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT; ?>/admin/report" class="active"> Report</a></li>
                    </ul>
                </div>
                
            </div>

    

            <div class="bottom-data">


                <div class="chart-container">

                    <div class="chart-header">
                     <h2> <i class='bx bx-store'></i> Store Sales</h2>
                    </div>

                    <div class="chart">
                        <canvas id="salesChart"></canvas>
                    </div>

                    <div class="filter-buttons-container">
                        <button class="filter-button1" id="filter-button-1" onclick="changeDataSetSales(this)" value="year">Year</button>
                        <button class="filter-button1 active" id="filter-button-2" onclick="changeDataSetSales(this)" value="month">Month</button>
                    </div>

        
                </div>

                <div class="chart-container">

                    <div class="chart-header">
                        <h2> <i class='bx bx-calendar' ></i> Appointment Revenue</h2>
                    </div>

                    <div class="chart">
                        <canvas id="appointmentChart"></canvas>
                    </div>

                    <div class="filter-buttons-container">
                        <button class="filter-button2" id="filter-button-1" onclick="changeDataSetAppointment(this)" value="year">Year</button>
                        <button class="filter-button2 active" id="filter-button-2" onclick="changeDataSetAppointment(this)" value="month">Month</button>
                    </div>

        
                </div>


                <div class="chart-container">

                    <div class="chart-header">
                        <h2> <i class='bx bx-plus-medical'></i> Animal Ward Income</h2>
                    </div>

                    <div class="chart">
                        <canvas id="animalWardChart"></canvas>
                    </div>

                    <div class="filter-buttons-container">
                        <button class="filter-button3" id="filter-button-1" onclick="changeDataSetWard(this)" value="year">Year</button>
                        <button class="filter-button3 active" id="filter-button-2" onclick="changeDataSetWard(this)" value="month">Month</button>
                    </div>

        
                </div>


            </div>

         <script>

            //if button click add class active
            const filterButtons = document.querySelectorAll(".filter-button1");

            filterButtons.forEach(button => {
                button.addEventListener("click", () => {
                    filterButtons.forEach(b => b.classList.remove("active"));
                    button.classList.add("active");
                });
            });

            //if button click add class active
            const filterButtons2 = document.querySelectorAll(".filter-button2");

            filterButtons2.forEach(button => {
                button.addEventListener("click", () => {
                    filterButtons2.forEach(b => b.classList.remove("active"));
                    button.classList.add("active");
                });
            });

            //if button click add class active
            const filterButtons3 = document.querySelectorAll(".filter-button3");

            filterButtons3.forEach(button => {
                button.addEventListener("click", () => {
                    filterButtons3.forEach(b => b.classList.remove("active"));
                    button.classList.add("active");
                });
            });

            


         </script>

 

            

        </main>
    </div>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/sales.js"></script>

    <script>

        var chartData = <?php echo json_encode($data); ?>;
        // Sample monthly sales data (you can replace this with your actual data)


// Get a reference to the canvas element
const ctx = document.getElementById("salesChart").getContext("2d");

// Create a bar chart using Chart.js
const salesChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: chartData.labelsSalesMonth,
        datasets: [{
            label: "Monthly Sales",
            data: chartData.dataSalesMonth,
            backgroundColor: "rgba(102, 126, 234, 1)", // Bar color
            borderColor: "rgba(75, 192, 192, 1)", // Border color
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: "Sales (LKR)"
                }
            },
            x: {
                title: {
                    display: true,
                    text: "Year-Month"
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});


function changeDataSetSales(button) {
    // Get the value of the button
    const value = button.value;

    // Update the chart data
    if (value === "year") {
        salesChart.data.labels = chartData.labelsSalesYear;
        salesChart.data.datasets[0].data = chartData.dataSalesYear;
        salesChart.data.datasets[0].label = "Yearly Sales";
        //x-axis title
        salesChart.options.scales.x.title.text = "Year";
    } else {
        salesChart.data.labels = chartData.labelsSalesMonth;
        salesChart.data.datasets[0].data = chartData.dataSalesMonth;
        salesChart.data.datasets[0].label = "Monthly Sales";
        //x-axis title
        salesChart.options.scales.x.title.text = "Year-Month";
    }

    // Update the chart
    salesChart.update();
}

//for appointment revenue chart

var chartData2 = <?php echo json_encode($data); ?>;

// Get a reference to the canvas element
const ctx2 = document.getElementById("appointmentChart").getContext("2d");

// Create a bar chart using Chart.js

const appointmentChart = new Chart(ctx2, {
    type: "bar",
    data: {
        labels: chartData2.labelsAppointmentMonth,
        datasets: [{
            label: "Monthly Appointment Revenue",
            data: chartData2.dataAppointmentMonth,
            backgroundColor: "rgba(102, 126, 234, 1)", // Bar color
            borderColor: "rgba(75, 192, 192, 1)", // Border color
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: "Revenue (LKR)"
                }
            },
            x: {
                title: {
                    display: true,
                    text: "Year-Month"
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }

});

function changeDataSetAppointment(button) {
    // Get the value of the button
    const value = button.value;

    // Update the chart data
    if (value === "year") {
        appointmentChart.data.labels = chartData2.labelsAppointmentYear;
        appointmentChart.data.datasets[0].data = chartData2.dataAppointmentYear;
        appointmentChart.data.datasets[0].label = "Yearly Appointment Revenue";
        //x-axis title
        appointmentChart.options.scales.x.title.text = "Year";
    } else {
        appointmentChart.data.labels = chartData2.labelsAppointmentMonth;
        appointmentChart.data.datasets[0].data = chartData2.dataAppointmentMonth;
        appointmentChart.data.datasets[0].label = "Monthly Appointment Revenue";
        //x-axis title
        appointmentChart.options.scales.x.title.text = "Year-Month";
    }

    // Update the chart

    appointmentChart.update();

}

//for animal ward chart

var chartData3 = <?php echo json_encode($data); ?>;

// Get a reference to the canvas element

const ctx3 = document.getElementById("animalWardChart").getContext("2d");

// Create a bar chart using Chart.js

const animalWardChart = new Chart(ctx3, {
    type: "bar",
    data: {
        labels: chartData3.labelsWardMonth,
        datasets: [{
            label: "Monthly Animal Ward Revenue",
            data: chartData3.dataWardMonth,
            backgroundColor: "rgba(102, 126, 234, 1)", // Bar color
            borderColor: "rgba(75, 192, 192, 1)", // Border color
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: "Revenue (LKR)"
                }
            },
            x: {
                title: {
                    display: true,
                    text: "Year-Month"
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }

});

function changeDataSetWard(button) {
    // Get the value of the button
    const value = button.value;

    // Update the chart data
    if (value === "year") {
        animalWardChart.data.labels = chartData3.labelsWardYear;
        animalWardChart.data.datasets[0].data = chartData3.dataWardYear;
        animalWardChart.data.datasets[0].label = "Yearly Animal Ward Revenue";
        //x-axis title
        animalWardChart.options.scales.x.title.text = "Year";
    } else {
        animalWardChart.data.labels = chartData3.labelsWardMonth;
        animalWardChart.data.datasets[0].data = chartData3.dataWardMonth;
        animalWardChart.data.datasets[0].label = "Monthly Animal Ward Revenue";
        //x-axis title
        animalWardChart.options.scales.x.title.text = "Year-Month";
    }

    // Update the chart

    animalWardChart.update();

}




    </script>
</body>
</html>