

<?php 
   include("../database.php");

   $sql = "SELECT * FROM transaction_tbl WHERE transaction='Collection' ORDER BY id ASC";
    $resultCO = $conn->query($sql);


    if ($resultCO) {
        while ($rowCO = $resultCO->fetch_assoc()) {
            echo "
            <tr>
                <td>$rowCO[que_no]</td>
                <td>$rowCO[company]</td>
            </tr>
            ";
        }
    } else {
        echo "Error in fetching data: " . $conn->error;
    }
    $conn->close();

?>