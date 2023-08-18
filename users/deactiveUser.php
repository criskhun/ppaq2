<?php
include("../designPage/headerLogin.php");
include("../dashboard/navbar.php");

    $id = "";
    $email = "";
    $fname = "";
    $mname = "";
    $sname = "";
    $bdate = "";
    $phone = "";
    $date = "";
    $role = "";
    $designation = "";

    $errorMessage = "";
    $successMessage = "";

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql =  "SELECT * FROM users WHERE id = $id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            if (!$row) {
                header("location: activeUsers.php");
                exit;
            }

            $email = $row["email"];
            $fname = $row["first_name"];
            $mname = $row["midle_name"];
            $sname = $row["surname"];
            $bdate = $row["birthdate"];
            $phone = $row["phone"];
            $date = $row["date"];
            $role = $row["role"];
            $designation = $row["designation"];
            $defaultRole = $role;
            $defaultDes = $designation;

        } else {
            header("location: activerUsers.php");
            exit;
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST["id"];
        $id = $_POST["id"];
        $email = $_POST["email"];
        $fname = $_POST["fname"];
        $mname = $_POST["mname"];
        $sname = $_POST["sname"];
        $bdate = $_POST["bdate"];
        $phone = $_POST["phone"];
        $date = $_POST["date"];
        $role = $_POST["role"];
        $designation = $_POST["designation"];

        do {
            try {
                $sql = "INSERT INTO deactiveUser_tbl (email, first_name, midle_name, surname, birthdate, phone, password, date, role, designation)
                        VALUES ('$email', '$fname', '$mname', '$sname', '$bdate', '$phone', 'pass@word1', '$date', '$role', '$designation')";
                $result = $conn->query($sql);

                if(!$result) {
                    $errorMessage = "Error: " . $conn->error;
                    break;
                }

                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
        
                    $sql = "DELETE FROM users WHERE id = $id";
                    if ($conn->query($sql) === TRUE) {
                        $successMessage = "User added correctly";
                        $redirectUrl = "../users/activeUsers.php";

                        echo '<script>window.location.href = "' . $redirectUrl . '";</script>';
                        exit;
                    } else {
                        // Error in deletion
                        die("Error deleting user: " . $conn->error);
                    }
                }

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
<div class="col-sm-12"><h3>Update Active Users</h3>
<p>Are you sure you want to deactivate user?</p>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-floating mb-1 mt-1">
            <input type="text" class="form-control" id=email placeholder="Enter Email" name="email" value="<?php echo $email; ?>" readonly>
            <label for="email">Email</label>
        </div>
        
        <div class="row">
            <div class="col">
                <div class="form-floating mb-1 mt-1">
                    <input type="text" class="form-control" id=fname placeholder="Enter First name" name="fname" value="<?php echo $fname; ?>" readonly>
                    <label for="fname">First Name</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-1 mt-1">
                    <input type="text" class="form-control" id=mname placeholder="Enter Middle name" name="mname" value="<?php echo $mname; ?>" readonly>
                    <label for="mname">Middle Name</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-1 mt-1">
                    <input type="text" class="form-control" id=sname placeholder="Enter Surname" name="sname" value="<?php echo $sname; ?>" readonly>
                    <label for="sname">Surname</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-1 mt-1">
                    <input type="date" class="form-control" id=bdate placeholder="Birthdate" name="bdate" value="<?php echo $bdate; ?>" readonly>
                    <label for="bdate">Birth Date</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-1 mt-1">
                    <input type="text" class="form-control" id=phone placeholder="Mobile Number" name="phone" value="<?php echo $phone; ?>" readonly>
                    <label for="phone">Mobile Number</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-1 mt-1">
                    <input type="text" class="form-control" id=date placeholder="Date Hire" name="date" value="<?php echo $date; ?>" readonly>
                    <label for="phone">Date Hire</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-1 mt-1">
                    <select name="role" id="role" class="form-select readonly-select">
                    <?php
                    $defaultRole = $row["role"];
                    $sql = "SELECT role FROM role_tbl";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $transactionName = $row["role"];
                            $selected = ($transactionName === $defaultRole) ? "selected" : "";
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
                    <input type="text" class="form-control" id=designation placeholder="Designation" name="designation" value="<?php echo $designation; ?>" readonly>
                    <label for="designation">Designation</label>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">De-activate User</button>
            </div>
            <div class="col-sm-3 d-grid">
                    <a href="../users/activeUsers.php" class="btn btn-secondary" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
</div>
</div>

<?php
    include("../dashboard/footer.php");
?>