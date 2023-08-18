<?php 
    include("../designPage/headerLogReg.php");

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
                header("Location: ../dashboard/dashboard.php"); //Redirect to the page
                exit();
            } else {
                $message = "Invalid email or password.";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card shadow login-container">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                        <a href="../index.php">
                            <img src="../images/logo.png" alt="Logo" class="logo-image">
                        </a>
                        <h4 class="card-title">Login</h4>
                    </div>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                        </div>
                        <div class="d-grid">
                            <input type="submit" class="btn btn-primary" name="login" value="Login"></input>
                            </div>
                            <hr>
                                <div class="alert alert-danger <?php if (empty($message)) echo 'd-none'; ?>">
                                    <?php echo $message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php
    include("../designPage/footer.html");
?>