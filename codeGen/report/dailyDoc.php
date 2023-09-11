<?php
$sqldaily = "SELECT * FROM documentCG_tbl ORDER BY id DESC";
    $resultDaily= $conn->query($sqldaily);

    if (!$resultDaily) {
        die("Invalid query: " . $conn->error);
    }
?>
<div class="input-group mb-3" hidden>
    <input type="text" id="searchInputDaily" class="form-control" placeholder="Search...">
    <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Go</button>
</div>

    <div>
        <button class="btn btn-success" id="printButtonDay"><i class="fa-solid fa-print"></i> Print</button>
        <button class="btn btn-success" id="exportButtonDay"><i class="fa-solid fa-file-export"></i> Export</button>
    </div>
</div>
<br>

<div class="table-responsive">  
    <div class="table-responsive">
        <div id="rowCountDaily">

        </div>
    </div>
                <table id="daytlb" class="table table-striped table-borderless table-hover">
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
                    <tbody id="tableBodyDaily">
                        <?php
                        $counterDaily = 1;
                            while ($rowDaily = $resultDaily->fetch_assoc()) {
                                $transactionId = $rowDaily['id'];
                                echo "
                                <tr>
                                    <td>$counterDaily</td>
                                    <td>$rowDaily[docCode]</td>
                                    <td>$rowDaily[title]</td>
                                    <td>$rowDaily[sender]</td>
                                    <td>$rowDaily[doctype]</td>
                                    <td>$rowDaily[urgent]</td>
                                    <td>$rowDaily[docdate]</td>
                                    <td>$rowDaily[comment]</td>
                                    <td><a href='" . $rowDaily['docfile'] . "' target='_blank'><i class='fa-solid fa-download'></i> Download</a></td>
                                </tr>
                                ";
                                $counterDaily++;
                            }
                        ?>
                    </tbody>
                </table>

<script>
    document.getElementById("exportButtonDay").addEventListener("click", exportToExcel);

function exportToExcel() {
    // Create a new workbook
    var workbook = XLSX.utils.book_new();

    // Get the table element
    var table = document.getElementById("daytlb");

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
var currentYear = currentDate.getFullYear();
var currentMonth = currentDate.toLocaleString('default', { month: 'long' }); // Get the full month name
var currentDayOfWeek = getDayOfWeek(currentDate); // Function to get the day of the week

// Add the custom title as the first row
tableData.unshift([currentDayOfWeek + " (" + currentDate.getDate() + ")-" + currentMonth + "-" + currentYear]);

// Function to get the day of the week
function getDayOfWeek(date) {
    const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    return daysOfWeek[date.getDay()];
}

// Function to get the week number
function getWeekNumber(date) {
    date = new Date(Date.UTC(date.getFullYear(), date.getMonth(), date.getDate()));
    date.setUTCDate(date.getUTCDate() + 4 - (date.getUTCDay() || 7));
    var yearStart = new Date(Date.UTC(date.getUTCFullYear(), 0, 1));
    var weekNumber = Math.ceil((((date - yearStart) / 86400000) + 1) / 7);
    return weekNumber;
}

    // Create a worksheet and add data to it
    var worksheet = XLSX.utils.aoa_to_sheet(tableData);

    // Style the custom title (make it bold)
    worksheet["A1"].s = { font: { bold: true } };

    // Add the worksheet to the workbook
    XLSX.utils.book_append_sheet(workbook, worksheet, currentDayOfWeek + " (" + currentDate.getDate() + ")-" + "_" + currentMonth + "-" + currentYear);

    // Save the workbook as an XLSX file
    XLSX.writeFile(workbook, "DailyProcessCG.xlsx");
}

document.getElementById("exportButtonDay").addEventListener("click", exportToExcel);

// Get a reference to the "Print" button element
var printButton = document.getElementById("printButtonDay");

// Add a click event listener to the "Print" button
printButton.addEventListener("click", function () {
    // Get the filtered table data
    var filteredTableData = getFilteredTableData();

    // Encode the filtered data as a query parameter
    var queryParams = encodeURIComponent(JSON.stringify(filteredTableData));

    // Redirect to the other page with the query parameter
    //window.location.href = "report/printDesign.php?tableData=" + queryParams;
    window.location.href = "report/printDesign.php?tableData=" + queryParams;
});

// Function to get the filtered table data
function getFilteredTableData() {
    var filteredData = [];

    // Iterate through the visible table rows and collect the data
    $("#tableBodyDaily tr:visible").each(function () {
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
        function updateRowCountDaily() {
            const visibleRowCount = $("#tableBodyDaily tr:visible").length;
            $("#rowCountDaily").text(`Total rows: ${visibleRowCount}`);
        }

        function filterTableRowsByCurrentDate() {
            const currentDate = "<?= date('Y-m-d'); ?>";

            $("#tableBodyDaily tr").each(function () {
                const rowDate = $(this).find("td:eq(6)").text(); // Assuming date is in the 6th column

                if (rowDate === currentDate) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            updateRowCountDaily();
        }

        // Initial filter by current date
        filterTableRowsByCurrentDate();

        function filterTableRows(searchValue) {
            searchValue = searchValue.toLowerCase();

            $("#tableBodyDaily tr").each(function () {
                const rowText = $(this).text().toLowerCase();
                const rowDate = $(this).find("td:eq(6)").text(); // Assuming date is in the 6th column

                if (rowDate === currentDate && rowText.includes(searchValue)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            updateRowCountDaily();
        }

        $("#searchInputDaily").on("input", function() {
            const searchValue = $(this).val();
            filterTableRows(searchValue);
        });

        // When clearing the filter input, show only the current date data
        $("#searchInputDaily").on("keyup", function() {
            if ($(this).val() === "") {
                filterTableRowsByCurrentDate();
            }
        });

        // Initial row count display
        updateRowCountDaily();
    });

</script>