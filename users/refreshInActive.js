
    // Function to fetch and update table data using AJAX
    function refreshTableData() {
        $.ajax({
            url: '../users/fetchInActiveTbl.php',  // Replace with your server-side script URL
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $('#table-body').html(response);
            }
        });
    }

    // Refresh the table data every 1/2 second
    setInterval(refreshTableData, 500);

