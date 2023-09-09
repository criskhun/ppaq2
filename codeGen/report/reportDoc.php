<?php
$sqlAll = "SELECT * FROM documentCG_tbl ORDER BY id DESC";
    $resultAll= $conn->query($sqlAll);

    if (!$resultAll) {
        die("Invalid query: " . $conn->error);
    }

    // Set default number of rows per page

?>
<div class="input-group mb-3">
    <input type="text" id="searchInputAll" class="form-control" placeholder="Search...">
    <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Go</button>
</div>

    <div>
        <button class="btn btn-success" id="printButtonAll"><i class="fa-solid fa-print"></i> Print</button>
        <button class="btn btn-success" id="exportButtonAll"><i class="fa-solid fa-file-export"></i> Export</button>
    </div>
</div>
<br>

<div class="table-responsive">  
    <div class="table-responsive">
        <div id="rowCountAll">

        </div>
    </div>
                <table id="allTable" class="table table-striped table-borderless table-hover">
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
                    <tbody id="tableBody">
                        <?php
                        $counterAll = 1;
                            while ($rowAll = $resultAll->fetch_assoc()) {
                                $transactionId = $rowAll['id'];
                                echo "
                                <tr>
                                    <td>$counterAll</td>
                                    <td>$rowAll[docCode]</td>
                                    <td>$rowAll[title]</td>
                                    <td>$rowAll[sender]</td>
                                    <td>$rowAll[doctype]</td>
                                    <td>$rowAll[urgent]</td>
                                    <td>$rowAll[docdate]</td>
                                    <td>$rowAll[comment]</td>
                                    <td><a href='" . $rowAll['docfile'] . "' target='_blank'><i class='fa-solid fa-download'></i> Download</a></td>
                                </tr>
                                ";
                                $counterAll++;
                            }
                        ?>
                    </tbody>
                </table>

<script>

// Function to export table data to Excel
function exportToExcel() {
    // Create a new workbook
    var workbook = XLSX.utils.book_new();

    // Get the table element
    var table = document.getElementById("allTable");

    // Get the table headers
    var headers = [];
    for (var i = 0; i < table.rows[0].cells.length; i++) {
        headers.push({ wch: 20, s: { font: { bold: true } }, v: table.rows[0].cells[i].textContent });
    }

    // Create an array to store the table data
    var tableData = [headers];

    // Add the custom header row
    tableData.unshift([{ v: "Document List", s: { font: { bold: true } } }]);

    // Iterate through the table rows and collect data
    for (var i = 1; i < table.rows.length; i++) {
        var rowData = [];
        for (var j = 0; j < table.rows[i].cells.length; j++) {
            rowData.push(table.rows[i].cells[j].textContent);
        }
        tableData.push(rowData);
    }

    // Create a worksheet and add data to it
    var worksheet = XLSX.utils.aoa_to_sheet(tableData);

    // Add the worksheet to the workbook
    XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");

    // Save the workbook as an XLSX file
    XLSX.writeFile(workbook, "AllProcessCG.xlsx");
}



    // Add a click event listener to the export button
    document.getElementById("exportButtonAll").addEventListener("click", exportToExcel);

    // Get a reference to the "Print" button element
    var printButton = document.getElementById("printButtonAll");

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
        $("#tableBody tr:visible").each(function () {
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
        function updaterowCountAll() {
            const visiblerowCountAll = $("#tableBody tr:visible").length;
            $("#rowCountAll").text(`Total rows: ${visiblerowCountAll}`);
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

            updaterowCountAll();
        }

        $("#searchInputAll").on("input", function() {
            const searchValue = $(this).val();
            filterTableRows(searchValue);
        });

        // Initial row count display
        updaterowCountAll();
    });
</script>