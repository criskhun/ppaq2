

<?php 
session_start();
   include("../database.php");
   
   if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
    $des = $_SESSION["designation"];

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


    if ($resultTransaction) {
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
                    <a class='btn btn-primary btn-sm' href='serve.php?id=$rowTransaction[id]'>Serve</a>
                    <a class='btn btn-danger btn-sm' href='#' data-bs-toggle='modal' data-bs-target='#confirmDropModal' data-transaction-id='$transactionId'>Drop</a>
                </td>
            </tr>
            ";
        }
    } else {
        echo "Error in fetching data: " . $conn->error;
    }
    $conn->close();

?>
