

<?php 
   include("../database.php");

   $sql = "SELECT * FROM transaction_tbl WHERE transaction='Terminal' ORDER BY id ASC";
    $resultTE = $conn->query($sql);


    if ($resultTE) {
        while ($rowTE = $resultTE->fetch_assoc()) {
            echo "
            <tr>
                <td>$rowTE[que_no]</td>
                <td>$rowTE[company]</td>
            </tr>
            ";
        }
    } else {
        echo "Error in fetching data: " . $conn->error;
    }
    $conn->close();

?>