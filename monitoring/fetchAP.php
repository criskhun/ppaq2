

<?php 
   include("../database.php");

   $sql = "SELECT * FROM transaction_tbl WHERE transaction='Access Pass' ORDER BY id ASC";
    $resultAP = $conn->query($sql);


    if ($resultAP) {
        while ($rowAP = $resultAP->fetch_assoc()) {
            echo "
            <tr>
                <td>$rowAP[que_no]</td>
                <td>$rowAP[company]</td>
            </tr>
            ";
        }
    } else {
        echo "Error in fetching data: " . $conn->error;
    }
    $conn->close();

?>