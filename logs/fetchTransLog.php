

<?php 
   include("../database.php");

   $sql5 = "SELECT * FROM transactionLog_tbl ORDER BY date DESC";
    $resultTransactionLog= $conn->query($sql5);


    if ($resultTransactionLog) {
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
    } else {
        echo "Error in fetching data: " . $conn->error;
    }
    $conn->close();

?>