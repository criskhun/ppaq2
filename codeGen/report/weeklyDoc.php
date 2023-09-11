<?php
$sqlWeekly = "SELECT * FROM documentCG_tbl ORDER BY id DESC";
    $resultWeekly= $conn->query($sqlWeekly);

    if (!$resultWeekly) {
        die("Invalid query: " . $conn->error);
    }

    // Set default number of rows per page

?>
<div class="input-group mb-3" hidden>
    <input type="text" id="searchInputWeekly" class="form-control" placeholder="Search...">
    <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Go</button>
</div>

    <div>
        <button class="btn btn-success" id="printButtonWeek"><i class="fa-solid fa-print"></i> Print</button>
        <button class="btn btn-success" id="exportButtonWeek"><i class="fa-solid fa-file-export"></i> Export</button>
    </div>
</div>
<br>

<div class="table-responsive">  
    <div class="table-responsive">
        <div id="rowCountWeekly">

        </div>
    </div>
                <table id="weektlb" class="table table-striped table-borderless table-hover">
                    <thead class="print-header">
                        <tr>
                            <th>#</th>
                            <th>Document Code</th>
                            <th>Title</th>
                            <th>Sender</th>
                            <th>Document Type</th>
                            <th>Urgent</th>
                            <th>Date</th>
                            <th>Comment</th>
                            <th>Document File</th>

                        </tr>
                    </thead>
                    <tbody id="tableBodyWeekly">
                        <?php
                        $counterWeekly = 1;
                            while ($rowWeekly = $resultWeekly->fetch_assoc()) {
                                $transactionId = $rowWeekly['id'];
                                echo "
                                <tr>
                                    <td>$counterWeekly</td>
                                    <td>$rowWeekly[docCode]</td>
                                    <td>$rowWeekly[title]</td>
                                    <td>$rowWeekly[sender]</td>
                                    <td>$rowWeekly[doctype]</td>
                                    <td>$rowWeekly[urgent]</td>
                                    <td>$rowWeekly[docdate]</td>
                                    <td>$rowWeekly[comment]</td>
                                    <td><a href='" . $rowWeekly['docfile'] . "' target='_blank'><i class='fa-solid fa-download'></i> Download</a></td>
                                </tr>
                                ";
                                $counterWeekly++;
                            }
                        ?>
                    </tbody>
                </table>


<script>
    function exportToExcel() {
    // Create a new workbook
    var workbook = XLSX.utils.book_new();

    // Get the table element
    var table = document.getElementById("weektlb");

    // Get the table headers
    var headers = [];
    for (var i = 0; i < table.rows[0].cells.length; i++) {
        headers.push(table.rows[0].cells[i].textContent);
    }

    // Create an array to store the table data
    var tableData = [headers];

    // Iterate through the table rows and collect data
    for (var i = 1; i < table.rows.length; i++) {
        var rowData = [];
        for (var j = 0; j < table.rows[i].cells.length; j++) {
            rowData.push(table.rows[i].cells[j].textContent);
        }
        tableData.push(rowData);
    }

    var currentDate = new Date();
    var currentMonth = currentDate.getMonth() + 1; // Adding 1 because getMonth() returns 0-based months
    var currentYear = currentDate.getFullYear();

    // Add the custom title as the first row
    tableData.unshift(["Weekly Transaction - " + currentMonth + "-" + currentYear]);

    // Create a worksheet and add data to it
    var worksheet = XLSX.utils.aoa_to_sheet(tableData);

    // Style the custom title (make it bold)
    worksheet["A1"].s = { font: { bold: true } };

    // Add the worksheet to the workbook
    var currentYear = new Date().getFullYear();
    XLSX.utils.book_append_sheet(workbook, worksheet, currentMonth + "-" + currentYear);

    // Save the workbook as an XLSX file
    XLSX.writeFile(workbook, "WeekProcessCG.xlsx");
}

    // Add a click event listener to the export button
    document.getElementById("exportButtonWeek").addEv
    // Get a reference to the second button element
var printButtonWeek = document.getElementById("printButtonWeek");

// Add a click event listener to the second button
printButtonWeek.addEventListener("click", function () {
    // Get the filtered table data for the second table (modify as needed)
    var filteredTableData = getFilteredTableDataForWeek();

    // Encode the filtered data as a query parameter
    var queryParams = encodeURIComponent(JSON.stringify(filteredTableData));

    // Redirect to the other page with the query parameter
    window.location.href = "report/printDesign.php?tableData=" + queryParams;
});

// Function to get the filtered table data for the second table (modify as needed)
function getFilteredTableDataForWeek() {
    var filteredData = [];

    // Modify this selector to target the second table's rows
    $("#tableBodyWeekly tr:visible").each(function () {
        var rowData = [];
        $(this).find("td").each(function () {
            rowData.push($(this).text().trim());
        });
        filteredData.push(rowData);
    });

    return filteredData;
}

</script>

<script>
     $(document).ready(function() {
        function updateRowCountWeekly() {
            const visibleRowCount = $("#tableBodyWeekly tr:visible").length;
            $("#rowCountWeekly").text(`Total rows: ${visibleRowCount}`);
        }

        function filterTableRowsByCurrentWeek() {
            const currentDate = new Date();
            const currentWeek = currentDate.getDate() - currentDate.getDay();

            const startOfWeek = new Date(currentDate.setDate(currentWeek));
            const endOfWeek = new Date(currentDate.setDate(currentWeek + 6));

            // Format the start and end dates as strings in "YYYY-MM-DD" format
            const startDateString = startOfWeek.toISOString().slice(0, 10);
            const endDateString = endOfWeek.toISOString().slice(0, 10);

            $("#tableBodyWeekly tr").each(function () {
                const rowDate = $(this).find("td:eq(6)").text(); // Assuming date is in the 6th column

                if (rowDate >= startDateString && rowDate <= endDateString) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            updateRowCountWeekly();
        }

        // Initial filter by current week
        filterTableRowsByCurrentWeek();

        function filterTableRows(searchValue) {
            searchValue = searchValue.toLowerCase();

            $("#tableBodyWeekly tr").each(function () {
                const rowText = $(this).text().toLowerCase();
                const rowDate = $(this).find("td:eq(6)").text(); // Assuming date is in the 6th column

                if (rowDate >= startDateString && rowDate <= endDateString && rowText.includes(searchValue)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            updateRowCountWeekly();
        }

        $("#searchInputWeekly").on("input", function() {
            const searchValue = $(this).val();
            filterTableRows(searchValue);
        });

        // When clearing the filter input, show only the current week data
        $("#searchInputWeekly").on("keyup", function() {
            if ($(this).val() === "") {
                filterTableRowsByCurrentWeek();
            }
        });

        // Initial row count display
        updateRowCountWeekly();
    });

</script>