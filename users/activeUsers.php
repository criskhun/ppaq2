<?php

    include("../designPage/headerLogin.php");
    include("../dashboard/navbar.php");

    if ($conn->connect_error) {
        die("Connection Failed: " .$conn->connect_error);
    }

    $sql4 = "SELECT * FROM users ORDER BY date DESC";
    $resultUsers = $conn->query($sql4);

    if (!$resultUsers) {
        die("Invalid query: " . $conn->error);
    }
    $countUsers = $resultUsers->num_rows;
?>

<div class="m-5">
<div class="container-fluid p-5 my-1 bg-light text-black">
<div class="col-sm-12"><h3>Active Users</h3>
<div class='item-row'>
                <span> <p>Number of transaction: <?php echo $countUsers; ?></p> </span>
                <a class="btn btn-outline-success" href="../users/addUser.php"><i class="fa-solid fa-user-plus"></i> Add User</a>
</div>

            <div class="table-responsive">
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Surname</th>
                            <th>Birth Date</th>
                            <th>Mobile Number</th>
                            <th>Date Hire</th>
                            <th>Role</th>
                            <th>Designation</th>
                            <th class="action-column">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
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
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="../users/refreshActive.js"></script>
<?php
    include("../transaction/serveModal.php");
?> 