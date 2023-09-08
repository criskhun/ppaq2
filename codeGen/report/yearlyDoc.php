<?php
$sqlYearly = "SELECT * FROM documentCG_tbl ORDER BY id DESC";
    $resultYearly= $conn->query($sqlYearly);

    if (!$resultYearly) {
        die("Invalid query: " . $conn->error);
    }

    // Set default number of rows per page

?>

    <div>
        <button class="btn btn-success" id="printButtonYear"><i class="fa-solid fa-print"></i> Print</button>
        <button class="btn btn-success" id="exportButton"><i class="fa-solid fa-file-export"></i> Export</button>
    </div>
</div>
<br>

<div class="table-responsive">  
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <div id="rowCountYearly"></div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="yearPicker">Yearly Report</label>
                    <input type="number" class="form-control" id="yearPicker" placeholder="Please enter a year" min="1900" max="2099">
                </div>
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
                    <tbody id="tableBodyYearly">
                        <?php
                        $counterYearly = 1;
                            while ($rowYearly = $resultYearly->fetch_assoc()) {
                                $transactionId = $rowYearly['id'];
                                echo "
                                <tr>
                                    <td>$counterYearly</td>
                                    <td>$rowYearly[docCode]</td>
                                    <td>$rowYearly[title]</td>
                                    <td>$rowYearly[sender]</td>
                                    <td>$rowYearly[doctype]</td>
                                    <td>$rowYearly[urgent]</td>
                                    <td>$rowYearly[docdate]</td>
                                    <td>$rowYearly[comment]</td>
                                    <td><a href='" . $rowYearly['docfile'] . "' target='_blank'><i class='fa-solid fa-download'></i> Download</a></td>
                                </tr>
                                ";
                                $counterYearly++;
                            }
                        ?>
                    </tbody>
                </table>



<!-- Rest of your HTML code -->
<script>
// Get a reference to the "Print" button element
var printButton = document.getElementById("printButtonYear");

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
    $("#tableBodyYearly tr:visible").each(function () {
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
        function updateRowCountYearly() {
            const visibleRowCount = $("#tableBodyYearly tr:visible").length;
            $("#rowCountYearly").text(`Total rows: ${visibleRowCount}`);
        }

        function filterTableRowsByYear(selectedYear) {
            $("#tableBodyYearly tr").each(function () {
                const rowDate = moment($(this).find("td:eq(6)").text()); // Assuming date is in the 6th column
                const rowYear = rowDate.year(); // Extract the year from the date

                if (rowYear === selectedYear) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            updateRowCountYearly();
        }

        // Handle changes in the year picker
        $("#yearPicker").on("input", function() {
            const selectedYear = parseInt($(this).val());
            filterTableRowsByYear(selectedYear);
        });

        function filterTableRows(searchValue) {
            searchValue = searchValue.toLowerCase();

            $("#tableBodyYearly tr").each(function () {
                const rowText = $(this).text().toLowerCase();
                const rowDate = moment($(this).find("td:eq(6)").text()); // Assuming date is in the 6th column
                const rowYear = rowDate.year(); // Extract the year from the date

                if (rowYear === selectedYear && rowText.includes(searchValue)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            updateRowCountYearly();
        }

        $("#searchInputYearly").on("input", function() {
            const searchValue = $(this).val();
            filterTableRows(searchValue);
        });

        // When clearing the filter input, show all data for the selected year
        $("#searchInputYearly").on("keyup", function() {
            if ($(this).val() === "") {
                filterTableRowsByYear(selectedYear);
            }
        });

        // Initial row count display
        updateRowCountYearly();
    });

</script>