<?php
    include("../designPage/headerLogin.php");
    include("../dashboard/navbar.php");
    
    $email = "";
    $fname = "";
    $mname = "";
    $sname = "";
    $bdate = "";
    $phone = "";
    $designation = "";

    $errorMessage = "";
    $successMessage = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST["email"];
        $fname = $_POST["fname"];
        $mname = $_POST["mname"];
        $sname = $_POST["sname"];
        $bdate = $_POST["bdate"];
        $phone = $_POST["phone"];
        $role = $_POST["role"];
        $designation = $_POST["designation"];

        do {
            if (empty($email)){
                $errorMessage = "Email required";
                echo "Email condition triggered";
                break;
            } elseif (empty($fname)){
                $errorMessage = "First name required";
                break;
            } elseif (empty($mname)){
                $errorMessage = "Middle name required";
                break;
            } elseif (empty($sname)){
                $errorMessage = "Surname required";
                break;
            } elseif (empty($bdate)){
                $errorMessage = "Birthdate required";
                break;
            } elseif (empty($phone)){
                $errorMessage = "Mobile phone required";
                break;
            } elseif (empty($role)){
                $errorMessage = "Role required";
                break;
            } elseif (empty($designation)){
                $errorMessage = "Designation required";
                break;
            }

            try {
                $sql = "INSERT INTO users (email, first_name, midle_name, surname, birthdate, phone, password, role, designation)
                        VALUES ('$email', '$fname', '$mname', '$sname', '$bdate', '$phone', 'pass@word1', '$role', '$designation')";
                $result = $conn->query($sql);

                if(!$result) {
                    $errorMessage = "Error: " . $conn->error;
                    break;
                }

                $successMessage = "User added correctly";
                $redirectUrl = "../users/activeUsers.php";

                echo '<script>window.location.href = "' . $redirectUrl . '";</script>';
                exit;


            } catch (mysqli_sql_exception $e) {
                $errorMessage = "Error: " . $e->getMessage();
            }
        } while (false);
    }

?>


<div class="m-5">
<div class="container-fluid p-5 my-1 bg-light text-black">
<?php
    if(!empty($errorMessage)) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong> $errorMessage</strong>
            <button type='button class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
    if(!empty($successMessage)) {
        echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong> $successMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
?>
<div class="col-sm-12"><h3>Active Users</h3>
    <form action="" method="post">
        <div class="form-floating mb-1 mt-1">
            <input type="text" class="form-control" id=email placeholder="Enter Email" name="email" value="<?php echo $email; ?>">
            <label for="email">Email</label>
        </div>
        
        <div class="row">
            <div class="col">
                <div class="form-floating mb-1 mt-1">
                    <input type="text" class="form-control" id=fname placeholder="Enter First name" name="fname" value="<?php echo $fname; ?>">
                    <label for="fname">First Name</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-1 mt-1">
                    <input type="text" class="form-control" id=mname placeholder="Enter Middle name" name="mname" value="<?php echo $mname; ?>">
                    <label for="mname">Middle Name</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-1 mt-1">
                    <input type="text" class="form-control" id=sname placeholder="Enter Surname" name="sname" value="<?php echo $sname; ?>">
                    <label for="sname">Surname</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-1 mt-1">
                    <input type="date" class="form-control" id=bdate placeholder="Birthdate" name="bdate" value="<?php echo $bdate; ?>">
                    <label for="bdate">Birth Date</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-1 mt-1">
                    <input type="text" class="form-control" id=phone placeholder="Mobile Number" name="phone" value="<?php echo $phone; ?>">
                    <label for="phone">Mobile Number</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-1 mt-1">
                    <select name="role" id="role" class="form-select">
                    <?php
                    
                    $sql = "SELECT role FROM role_tbl";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $transactionName = $row["role"];
                            $selected = ($transactionName === $defaultTransaction) ? "selected" : "";
                            echo "<option $selected>$transactionName</option>";
                        }
                    }
                    //$conn->close();
                    ?>
                    </select>
                    <label for="role" class="form-label">Select Role (select one):</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-1 mt-1">
                <select name="designation" id="designation" class="form-select">
                    <?php
                    
                    $sql = "SELECT transaction FROM transaction_list";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $transactionName = $row["transaction"];
                            $selected = ($transactionName === $defaultTransaction) ? "selected" : "";
                            echo "<option $selected>$transactionName</option>";
                        }
                    }
                    $conn->close();
                    ?>
                    </select>
                    <label for="designation" class="form-label">Select Designation (select one):</label>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Add User</button>
            </div>
            <div class="col-sm-3 d-grid">
                    <a href="../users/activeUsers.php" class="btn btn-secondary" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
</div>
</div>

<script src="../users/refreshActive.js"></script>
<?php
    include("../dashboard/footer.php");
?> 