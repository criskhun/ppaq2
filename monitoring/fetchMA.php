

<?php 
   include("../database.php");

   $sql = "SELECT * FROM transaction_tbl WHERE transaction='Marine' ORDER BY id ASC";
    $resultMA = $conn->query($sql);


    if ($resultMA) {
        while ($rowMA = $resultMA->fetch_assoc()) {
            echo "
            <tr>
                <td>$rowMA[que_no]</td>
                <td>$rowMA[company]</td>
            </tr>
            ";
        }
    } else {
        echo "Error in fetching data: " . $conn->error;
    }
    $conn->close();

?>