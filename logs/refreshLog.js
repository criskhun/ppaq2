
    // Function to fetch and update table data using AJAX
    function refreshTableData(targetId, url) {
        $.ajax({
            url: url,  // Replace with your server-side script URL
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $(targetId).html(response);
            }
        });
    }

    // Refresh the table data every 1/2 second
    setInterval(function() {
        refreshTableData('#tableBody', '../logs/fetchTransLog.php');
    }, );