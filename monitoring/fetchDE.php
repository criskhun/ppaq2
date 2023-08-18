

<?php 
   include("../database.php");

   $sql = "SELECT * FROM transaction_tbl WHERE transaction='Data Encoding' ORDER BY id ASC";
    $resultDE = $conn->query($sql);


    if ($resultDE) {
        while ($rowDE = $resultDE->fetch_assoc()) {
            echo "
            <tr>
                <td>$rowDE[que_no]</td>
                <td>$rowDE[company]</td>
            </tr>
            ";
        }
    } else {
        echo "Error in fetching data: " . $conn->error;
    }
    $conn->close();

?>