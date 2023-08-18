<?php
$sql5 = "SELECT * FROM transactionLog_tbl ORDER BY date DESC";
    $resultTransactionLog= $conn->query($sql5);

    if (!$resultTransactionLog) {
        die("Invalid query: " . $conn->error);
    }
?>
<div class="input-group mb-3">
    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
    <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Go</button>
</div>

<div class="pagination" style="display: flex; align-items: center; justify-content: space-between">
    <div style="display: flex; align-items: center;">
        <button class="btn btn-sm btn-primary" onclick="changePage(-1)"><i class="fa-solid fa-backward"></i> Prev</button>
        <buttton class="btn btn-sm btn-primary" onclick="changePage(1)">Next <i class="fa-solid fa-forward"></i></buttton>
        <select id="rowPerPage" onchange="changeRowsPerPage()" style="margin-left: 10px;">
            <option value="10">10 rows</option>
            <option value="50">50 rows</option>
            <option value="100">100 rows</option>
        </select>
    </div>
    <div>
        <button class="btn btn-success" id="printButton"><i class="fa-solid fa-print"></i> Print</button>
        <button class="btn btn-success" id="exportButton"><i class="fa-solid fa-file-export"></i> Export</button>
    </div>
</div>
<br>

<div class="table-responsive">  
                <table class="table table-striped table-borderless table-hover">
                    <thead class="print-header">
                        <tr>
                            <th>Office</th>
                            <th>Transaction</th>
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
                            while ($rowTransaction = $resultTransactionLog->fetch_assoc()) {
                                $transactionId = $rowTransaction['id'];
                                echo "
                                <tr>
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
                            }
                        ?>
                    </tbody>
                </table>
                <div class="print-footer">

                </div>

                <!--<script src="../logs/refreshLog.js"></script>-->