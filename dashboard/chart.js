
// Get the canvas element
var ctx = document.getElementById("monthlyChart").getContext("2d");

// Your PHP array containing monthly transaction data
var monthlyData = {
    "January": 50,
    "February": 30,
    "March": 70,
    "April": 40,
    "May": 90,
    "June": 60,
    "July": 80,
    "August": 55,
    "September": 75,
    "October": 45,
    "November": 85,
    "December": 65
};

// Extract months and counts
var months = Object.keys(monthlyData);
var counts = Object.values(monthlyData);

// Create the bar chart
var chart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: months,
        datasets: [{
            label: "Monthly Transactions",
            data: counts,
            backgroundColor: "rgba(75, 192, 192, 0.2)", // Customize the color
            borderColor: "rgba(75, 192, 192, 1)",     // Customize the border color
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

