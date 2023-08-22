<?php
    include("../designPage/headerLogin.php");
    include("../dashboard/navbar.php");
    
    error_reporting(E_ALL);
ini_set('display_errors', 1);

    if ($conn->connect_error) {
        die("Connection Failed: " .$conn->connect_error);
    }

    $countQuery = "SELECT COUNT(*) as total FROM transaction_tbl";
    $countResult = $conn->query($countQuery);
    $countRow = $countResult->fetch_assoc();
    $totalRows = $countRow['total'];

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $itemsPerPage = 10; // Number of items to display per page

    $startIndex = ($currentPage - 1) * $itemsPerPage;

    $sql3 = "SELECT * FROM transaction_tbl WHERE transaction='$des' ORDER BY time DESC LIMIT $startIndex, $itemsPerPage";
    $resultTransaction = $conn->query($sql3);

    if (!$resultTransaction) {
        die("Invalid query: " . $conn->error);
    }

    $sql5 = "SELECT * FROM transaction_tbl WHERE transaction='$des' ORDER BY time DESC";
    $resultTransactionCount = $conn->query($sql5);

    if (!$resultTransactionCount) {
        die("Invalid query: " . $conn->error);
    }
    $countTransaction = $resultTransactionCount->num_rows;

    $sql4 = "SELECT * FROM transactionLog_tbl WHERE transaction='$des' ORDER BY time DESC";
    $resultTransactionLog = $conn->query($sql4);

    if (!$resultTransactionLog) {
        die("Invalid query: " . $conn->error);
    }
    $countTransactionLog = $resultTransactionLog->num_rows;
?>

<div class="m-5">
<div class="container-fluid p-5 my-1 bg-light text-black">
    <div class="row">
        <div class="col-sm-9">Queuing List
        <p>Number of transaction: <?php echo $countTransaction; ?></p>
            <div class="table-responsive">  
                <table class="table table-bordered">
                    <thead>
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
                            <th class="action-column">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                            while ($rowTransaction = $resultTransaction->fetch_assoc()) {
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
                                    <td class='action-cell'>
                                        <a class='btn btn-primary btn-sm' href='serve.php?id=$rowTransaction[id]'><i class='fa-solid fa-wand-sparkles'></i>Serve</a>
                                        <a class='btn btn-danger btn-sm' href='#' data-bs-toggle='modal' data-bs-target='#confirmDropModal' data-transaction-id='$transactionId'><i class='fa-solid fa-trash-can'></i> Drop</a>
                                    </td>
                                </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
  // Determine the total number of pages based on the total number of rows and items per page
  $totalPages = ceil($totalRows / $itemsPerPage);

  if ($currentPage > 1) {
    echo "<a class='btn btn-primary' href='transaction.php?page=" . ($currentPage - 1) . "'><i class='fa-solid fa-backward'></i> Previous</a>";
  }

  if ($currentPage < $totalPages) {
    echo "<a class='btn btn-primary' href='transaction.php?page=" . ($currentPage + 1) . "'><i class='fa-solid fa-forward'></i> Next</a>";
  }
  ?>
        </div>
        <div class="col-sm-3">Served for the day
        <p>Number of transaction Log: <?php echo $countTransactionLog; ?></p>
            <div class="table-responsive custom-table-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>Service</th>
                        <th>Company</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $rowCount = 0;
                            while ($rowTransactionLog = $resultTransactionLog->fetch_assoc()) {
                                if ($rowCount < 10) {
                                echo "
                                <tr>
                                    <td>$rowTransactionLog[service]</td>
                                    <td>$rowTransactionLog[company]</td>
                                </tr>
                                ";
                                $rowCount++;
                            } else {
                                break;
                            }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<script src="../transaction/refreshTrans.js"></script>
<?php
    include("../transaction/dropModal.php"); //this is the modal came from
?>
<script defer src="../transaction/modalScrip.js"></script>
