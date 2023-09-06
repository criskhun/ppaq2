<?php
$sqldaily = "SELECT * FROM documentCG_tbl ORDER BY id DESC";
    $resultDaily= $conn->query($sqldaily);

    if (!$resultDaily) {
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
        <div id="rowCountDaily">
            <?php
                $rowCountDaily = $resultDaily->num_rows;
                echo "Total rows: $rowCountDaily";
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
                    <tbody id="tableBodyDaily">
                        <?php
                        $counterDaily = 1;
                            while ($rowDaily = $resultDaily->fetch_assoc()) {
                                $transactionId = $rowDaily['id'];
                                echo "
                                <tr>
                                    <td>$counter</td>
                                    <td>$rowDaily[docCode]</td>
                                    <td>$rowDaily[title]</td>
                                    <td>$rowDaily[sender]</td>
                                    <td>$rowDaily[doctype]</td>
                                    <td>$rowDaily[urgent]</td>
                                    <td>$rowDaily[docdate]</td>
                                    <td>$rowDaily[comment]</td>
                                    <td><a href='" . $rowDaily['docfile'] . "' target='_blank'>Download</a></td>
                                </tr>
                                ";
                                $counterDaily++;
                            }
                        ?>
                    </tbody>
                </table>

<script>
     $(document).ready(function() {
        function updateRowCountDaily() {
            const visibleRowCount = $("#tableBodyDaily tr:visible").length;
            $("#rowCountDaily").text(`Total rows: ${visibleRowCount}`);
        }

        function filterTableRows(searchValue) {
            searchValue = searchValue.toLowerCase();

            $("#tableBodyDaily tr").each(function () {
                const rowText = $(this).text().toLowerCase();

                // Check if the row text contains the search value and the date matches the current date
                if (rowText.includes(searchValue) && $(this).find("td:eq(6)").text() === "<?= date('Y-m-d'); ?>") {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            updateRowCountDaily();
        }

        $("#searchInput").on("input", function() {
            const searchValue = $(this).val();
            filterTableRows(searchValue);
        });

        // Initial row count display
        updateRowCountDaily();
    });
</script>