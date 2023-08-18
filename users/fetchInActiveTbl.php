

<?php 
   include("../database.php");

   $sql4 = "SELECT * FROM deactiveUser_tbl ";
    $resultUsers = $conn->query($sql4);

    if ($resultUsers) {
        while ($rowUsers = $resultUsers->fetch_assoc()) {
            echo "
            <tr>
                <td>$rowUsers[email]</td>
                <td>$rowUsers[first_name]</td>
                <td>$rowUsers[midle_name]</td>
                <td>$rowUsers[surname]</td>
                <td>$rowUsers[birthdate]</td>
                <td>$rowUsers[phone]</td>
                <td>$rowUsers[date]</td>
                <td>$rowUsers[role]</td>
                <td>$rowUsers[designation]</td>
                <td class='action-cell'>
                <a class='btn btn-primary btn-sm' href='activate.php?id=$rowUsers[id]'><i class='fa-solid fa-user-slash'></i> Activate</a>
                </td>
            </tr>
            ";
        }
    } else {
        echo "Error in fetching data: " . $conn->error;
    }
    $conn->close();

?>