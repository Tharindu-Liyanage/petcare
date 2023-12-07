// Sample monthly sales data (you can replace this with your actual data)
const months = ["January", "February", "March", "April", "May", "June"];
const salesData = [50, 100, 20, 10, 150, 30];

// Get a reference to the canvas element
const ctx = document.getElementById("myChart").getContext("2d");

// Create a bar chart using Chart.js
const myChart= new Chart(ctx, {
    type: "bar",
    data: {
        labels: months,
        datasets: [{
            label: "Customer New Registration",
            data: salesData,
            backgroundColor: salesData.map(value => (value < 1500) ? "rgba(102, 126, 234, 1)" : "rgba(102, 126, 234, 1)"), // Red for small values
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
                    text: "New Customer"
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
