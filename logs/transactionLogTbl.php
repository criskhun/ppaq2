<?php
$sql5 = "SELECT * FROM transactionLog_tbl ORDER BY date DESC";
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
                            <th>Office</th>
                            <th>Process</th>
                            <th>Service</th>
                            <th>Company</th>
                            <th>Port User</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Code</th>
                            <th>Remarks</th>
                            <th>Served</th>
                            <th>Duration</th>

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
                                    <td>$rowTransaction[office]</td>
                                    <td>$rowTransaction[transaction]</td>
                                    <td>$rowTransaction[service]</td>
                                    <td>$rowTransaction[company]</td>
                                    <td>$rowTransaction[name]</td>
                                    <td>$rowTransaction[date]</td>
                                    <td>$rowTransaction[time]</td>
                                    <td>$rowTransaction[que_no]</td>
                                    <td>$rowTransaction[remarks]</td>
                                    <td>$rowTransaction[served]</td>
                                    <td>$rowTransaction[duration]</td>
                                </tr>
                                ";
                                $counter++;
                            }
                        ?>
                    </tbody>
                </table>

