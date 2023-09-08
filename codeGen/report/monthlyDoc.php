<?php
$sqlMonthly = "SELECT * FROM documentCG_tbl ORDER BY id DESC";
    $resultMonthly= $conn->query($sqlMonthly);

    if (!$resultMonthly) {
        die("Invalid query: " . $conn->error);
    }

    // Set default number of rows per page

?>

    <div>
        <button class="btn btn-success" id="printButtonMonth"><i class="fa-solid fa-print"></i> Print</button>
        <button class="btn btn-success" id="exportButton"><i class="fa-solid fa-file-export"></i> Export</button>
    </div>
</div>
<br>

<div class="table-responsive">  
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <div id="rowCountMonthly"></div>
            </div>
            <div class="col ">
                
                <div class="form-floating mb-3 mt-3">
                    <input type="month" class="form-control" id="monthPicker" placeholder="Please pick a month" name="monthly">
                    <label for="title">Monthly Report</label>
                </div>
                <!-- Add an input element for selecting the month -->

            </div>
        </div>
        

    </div>
                <table class="table table-striped table-borderless table-hover">
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
                    <tbody id="tableBodyMonthly">
                        <?php
                        $counterMonthly = 1;
                            while ($rowMonthly = $resultMonthly->fetch_assoc()) {
                                $transactionId = $rowMonthly['id'];
                                echo "
                                <tr>
                                    <td>$counterMonthly</td>
                                    <td>$rowMonthly[docCode]</td>
                                    <td>$rowMonthly[title]</td>
                                    <td>$rowMonthly[sender]</td>
                                    <td>$rowMonthly[doctype]</td>
                                    <td>$rowMonthly[urgent]</td>
                                    <td>$rowMonthly[docdate]</td>
                                    <td>$rowMonthly[comment]</td>
                                    <td><a href='" . $rowMonthly['docfile'] . "' target='_blank'><i class='fa-solid fa-download'></i> Download</a></td>
                                </tr>
                                ";
                                $counterMonthly++;
                            }
                        ?>
                    </tbody>
                </table>



<!-- Rest of your HTML code -->
<script>
// Get a reference to the "Print" button element
var printButton = document.getElementById("printButtonMonth");

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
    $("#tableBodyMonthly tr:visible").each(function () {
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
        function updateRowCountMonthly() {
            const visibleRowCount = $("#tableBodyMonthly tr:visible").length;
            $("#rowCountMonthly").text(`Total rows: ${visibleRowCount}`);
        }

        function filterTableRowsByMonth(selectedMonth) {
            $("#tableBodyMonthly tr").each(function () {
                const rowDate = moment($(this).find("td:eq(6)").text()); // Assuming date is in the 6th column

                if (rowDate.isSame(selectedMonth, 'month')) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            updateRowCountMonthly();
        }

        // Initial filter by current month
        const currentDate = moment();
        const initialMonth = currentDate.format('YYYY-MM');
        filterTableRowsByMonth(currentDate);

        // Handle changes in the month picker
        $("#monthPicker").on("change", function() {
            const selectedMonth = moment($(this).val(), 'YYYY-MM');
            filterTableRowsByMonth(selectedMonth);
        });

        function filterTableRows(searchValue) {
            searchValue = searchValue.toLowerCase();

            $("#tableBodyMonthly tr").each(function () {
                const rowText = $(this).text().toLowerCase();
                const rowDate = moment($(this).find("td:eq(6)").text()); // Assuming date is in the 6th column

                if (rowDate.isSame(selectedMonth, 'month') && rowText.includes(searchValue)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            updateRowCountMonthly();
        }

        $("#searchInputMonthly").on("input", function() {
            const searchValue = $(this).val();
            filterTableRows(searchValue);
        });

        // When clearing the filter input, show only the current month data
        $("#searchInputMonthly").on("keyup", function() {
            if ($(this).val() === "") {
                filterTableRowsByMonth(selectedMonth);
            }
        });

        // Initial row count display
        updateRowCountMonthly();
    });

</script>
