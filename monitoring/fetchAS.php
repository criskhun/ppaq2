

<?php 
   include("../database.php");

   $sql = "SELECT * FROM transaction_tbl WHERE transaction='Assessment' ORDER BY id ASC";
    $resultAS = $conn->query($sql);


    if ($resultAS) {
        while ($rowAS = $resultAS->fetch_assoc()) {
            echo "
            <tr>
                <td>$rowAS[que_no]</td>
                <td>$rowAS[company]</td>
            </tr>
            ";
        }
    } else {
        echo "Error in fetching data: " . $conn->error;
    }
    $conn->close();

?>