
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
        refreshTableData('#table-body1', '../monitoring/fetchAP.php');
    }, 500);

    setInterval(function() {
        refreshTableData('#table-body2', '../monitoring/fetchMA.php');
    }, 500);
    
    setInterval(function() {
        refreshTableData('#table-body3', '../monitoring/fetchTE.php');
    }, 500);

    setInterval(function() {
        refreshTableData('#table-body4', '../monitoring/fetchDE.php');
    }, 500);

    setInterval(function() {
        refreshTableData('#table-body5', '../monitoring/fetchAS.php');
    }, 500);

    setInterval(function() {
        refreshTableData('#table-body6', '../monitoring/fetchCO.php');
    }, 500);

