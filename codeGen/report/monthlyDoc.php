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
        <button class="btn btn-success" id="exportButtonMonth"><i class="fa-solid fa-file-export"></i> Export</button>
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
                <table id="Monthlytlb" class="table table-striped table-borderless table-hover">
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
        var selectedMonth;
        
        $(document).ready(function() {
            function updateRowCountMonthly() {
                const visibleRowCount = $("#tableBodyMonthly tr:visible").length;
                $("#rowCountMonthly").text(`Total rows: ${visibleRowCount}`);
            }
        
            function filterTableRowsByMonth(selectedMonth) {
                $("#tableBodyMonthly tr").each(function () {
                    const rowDate = moment($(this).find("td:eq(6)").text(), 'YYYY-MM-DD'); // Assuming date is in the 6th column
        
                    if (rowDate.isSame(selectedMonth, 'month')) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
        
                updateRowCountMonthly();
            }
        
            // Handle changes in the month picker
            $("#monthPicker").on("change", function() {
                selectedMonth = moment($(this).val(), 'YYYY-MM');
                filterTableRowsByMonth(selectedMonth);
            });
        
            function filterTableRows(searchValue) {
                searchValue = searchValue.toLowerCase();
        
                $("#tableBodyMonthly tr").each(function () {
                    const rowText = $(this).text().toLowerCase();
                    const rowDate = moment($(this).find("td:eq(6)").text(), 'YYYY-MM-DD'); // Assuming date is in the 6th column
        
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
        
            // Function to export table data to Excel for the monthly report
            function exportToExcel() {
                // Create a new workbook
                var workbook = XLSX.utils.book_new();
        
                // Get the table element
                var table = document.getElementById("MonthlyTable");
        
                // Get the table headers
                var headers = [];
                for (var i = 0; i < table.rows[0].cells.length; i++) {
                    headers.push(table.rows[0].cells[i].textContent);
                }
        
                // Create an array to store the table data
                var tableData = [headers];
        
                // Iterate through the table rows and collect data for the selected month
                $("#tableBodyMonthly tr:visible").each(function () {
                    var rowDate = moment($(this).find("td:eq(6)").text(), 'YYYY-MM-DD'); // Assuming date is in the 6th column
                    if (rowDate.isSame(selectedMonth, 'month')) {
                        var rowData = [];
                        for (var j = 0; j < $(this).find("td").length; j++) {
                            rowData.push($(this).find("td:eq(" + j + ")").text().trim());
                        }
                        tableData.push(rowData);
                    }
                });
        
                // Add the custom title as the first row
                tableData.unshift(["Monthly Transaction"]);
        
                // Create a worksheet and add data to it
                var worksheet = XLSX.utils.aoa_to_sheet(tableData);
        
                // Style the custom title (make it bold)
                worksheet["A1"].s = { font: { bold: true } };
        
                // Format the date as YYYY-MM
                var formattedDate = selectedMonth.format('YYYY-MM');
        
                // Add the worksheet to the workbook
                XLSX.utils.book_append_sheet(workbook, worksheet, formattedDate);
        
                // Save the workbook as an XLSX file
                XLSX.writeFile(workbook, "MonthProcessCG.xlsx");
            }
        
            // Add a click event listener to the export button
            document.getElementById("exportButtonMonth").addEventListener("click", exportToExcel);
        });
    </script>