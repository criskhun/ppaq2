<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // JavaScript function to trigger printing
    document.querySelector('#printButton').addEventListener('click', function () {
        window.print();
    });

    // JavaScript function to handle table export
    document.querySelector('#exportButton').addEventListener('click', function () {
        exportTableToCSV();
    });

    // Function to export table data to CSV format
    function exportTableToCSV() {
        var csv = [];
        var rows = document.querySelectorAll('table tr');

        var headerRow = [], headerCols = document.querySelectorAll('table th');
        for (var k = 0; k < headerCols.length; k++) {
            headerRow.push(headerCols[k].innerText);
        }
        csv.push(headerRow.join(','));

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll('td, th');

            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }

            csv.push(row.join(','));
        }

        var csvContent = "data:text/csv;charset=utf-8," + csv.join('\n');
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', 'TransactionLog.csv');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        var signatories = document.createElement('div');
        signatories.innerHTML = "<h3>Signatories:</hr><ul><li>Signatory 1</li><li>Signatory 2</li></ul>";
        document.body.appendChild(signatories);
    }
</script>

<script>
    $(document).ready(function() {
        function updateRowCount() {
            const visibleRowCount = $("#tableBody tr:visible").length;
            $("#rowCount").text(`Total rows: ${visibleRowCount}`);
        }

        function filterTableRows(searchValue) {
            searchValue = searchValue.toLowerCase();

            $("#tableBody tr").each(function () {
                const rowText = $(this).text().toLowerCase();

                if (rowText.includes(searchValue)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            updateRowCount();
        }

        $("#searchInput").on("input", function() {
            const searchValue = $(this).val();
            filterTableRows(searchValue);
        });

        // Initial row count display
        updateRowCount();
    });
</script>


</body>
</html>