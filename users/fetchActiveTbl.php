

<?php 
   include("../database.php");

    $sql4 = "SELECT * FROM users ORDER BY date DESC";
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
                    <a class='btn btn-primary btn-sm' href='editUser.php?id=$rowUsers[id]'><i class='fa-solid fa-pen'></i> Edit</a>
                    <a class='btn btn-danger btn-sm' href='deactiveUser.php?id=$rowUsers[id]'><i class='fa-solid fa-trash'></i> In-active</a>
                </td>
            </tr>
            ";
        }
    } else {
        echo "Error in fetching data: " . $conn->error;
    }
    $conn->close();

?>
