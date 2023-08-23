
// Get the canvas element
var ctx = document.getElementById("monthlyChart").getContext("2d");

// Your PHP array containing monthly transaction data
var monthlyData = <?php echo json_encode($monthlyData); ?>;

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

