// Sample monthly sales data (you can replace this with your actual data)
const months = ["January", "February", "March", "April", "May", "June"];
const salesData = [1200, 1500, 1800, 1600, 2000, 2200];

// Get a reference to the canvas element
const ctx = document.getElementById("salesChart").getContext("2d");

// Create a bar chart using Chart.js
const salesChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: months,
        datasets: [{
            label: "Monthly Sales",
            data: salesData,
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
                    text: "Sales"
                }
            },
            x: {
                title: {
                    display: true,
                    text: "Month"
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


