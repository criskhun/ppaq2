<?php
$sql5 = "SELECT * FROM documentCG_tbl ORDER BY id DESC";
    $resultTransactionLog= $conn->query($sql5);

    if (!$resultTransactionLog) {
        die("Invalid query: " . $conn->error);
    }

    // Set default number of rows per page

?>
<div class="input-group mb-3">
    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
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
        <div id="rowCount">
            <?php
                $rowCount = $resultTransactionLog->num_rows;
                echo "Total rows: $rowCount";
            ?>
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
                    <tbody id="tableBody">
                        <?php
                        $counter = 1;
                            while ($rowTransaction = $resultTransactionLog->fetch_assoc()) {
                                $transactionId = $rowTransaction['id'];
                                echo "
                                <tr>
                                    <td>$counter</td>
                                    <td>$rowTransaction[docCode]</td>
                                    <td>$rowTransaction[title]</td>
                                    <td>$rowTransaction[sender]</td>
                                    <td>$rowTransaction[doctype]</td>
                                    <td>$rowTransaction[urgent]</td>
                                    <td>$rowTransaction[docdate]</td>
                                    <td>$rowTransaction[comment]</td>
                                    <td>$rowTransaction[docfile]</td>
                                </tr>
                                ";
                                $counter++;
                            }
                        ?>
                    </tbody>
                </table>
<div>
    <p>Total Time: <span id="totalTime">00 : 00 : 00</span></p>
    <p>Average Time: <span id="averageTime">00 : 00 : 00</span></p>
</div>

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