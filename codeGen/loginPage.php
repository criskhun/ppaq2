<?php
    include("../codeGen/headerCG.php");
    session_start();

    $message = "";
    //function to sanitize users input
    function sanitizeInput($input) {
        global $conn;
        $input = mysqli_real_escape_string($conn, $input);
        $input = htmlspecialchars($input);
        return $input;
    }

    //function to check if the provided credentials are valid
    function validateCredentials($email, $password) {
        global $conn;
        $email = sanitizeInput($email);
        $password = sanitizeInput($password);

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            return $user; //valid credential
        } else {
            return false; //invalide credential
        }
    }

    //handle the login form submission
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        if (empty($email) || empty($password)) {
            $message = "Please enter both email & password.";
        } else {
            if (validateCredentials($email, $password)) {
                //successful login
                $user = validateCredentials($email, $password);
                $_SESSION["email"] = $email;
                $_SESSION["id"] = $user["id"];
                $_SESSION["first_name"] = $user["first_name"];
                $_SESSION["midle_name"] = $user["midle_name"];
                $_SESSION["surname"] = $user["surname"];
                $_SESSION["birthdate"] = $user["birthdate"];
                $_SESSION["phone"] = $user["phone"];
                $_SESSION["date"] = $user["date"];
                $_SESSION["role"] = $user["role"];
                $_SESSION["designation"] = $user["designation"];
                header("Location: ../codeGen/codeGen.php"); //Redirect to the page
                exit();
            } else {
                $message = "Invalid email or password.";
            }
        }
    }
?>

<div class="container-fluid">
    <div class="container custom-container">
        <div class="row justify-content-center align-item-center">
            <div class="col-sm-3" style="background-image: url('../images/encoding.jpg'); background-size: cover; background-position: center; height: 100vh;">

            </div>
            <div class="col-sm-3">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="was-validated" method="post">
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="myCheck" name="remember" required>
                        <label class="form-check-label" for="myCheck">I agree on blabla.</label>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Check this checkbox to continue.</div>
                    </div>
                    <input type="submit" name="login" value="Login" class="btn btn-primary"></input>
                    <hr>
                                <div class="alert alert-danger <?php if (empty($message)) echo 'd-none'; ?>">
                                    <?php echo $message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                </form>
            </div>
        </div>
    </div> 
</div>

<?php
    include("../codeGen/footerCG.php")
?>