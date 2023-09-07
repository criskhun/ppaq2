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
        <button class="btn btn-success" id="printButton"><i class="fa-solid fa-print"></i> Print</button>
        <button class="btn btn-success" id="exportButton"><i class="fa-solid fa-file-export"></i> Export</button>
    </div>
</div>
<br>

<div class="table-responsive">  
    <div class="table-responsive">
        <div id="rowCountDaily">

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
// Get a reference to the "Print" button element
var printButton = document.getElementById("printButton");

// Add a click event listener to the "Print" button
printButton.addEventListener("click", function () {
    // Get the filtered table data
    var filteredTableData = getFilteredTableData();

    // Encode the filtered data as a query parameter
    var queryParams = encodeURIComponent(JSON.stringify(filteredTableData));

    // Redirect to the other page with the query parameter
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