<?php 
    include("../designPage/headerLogReg.php");
    include("../database.php");
session_start();
?>
<?php
    $message = "";

    if(isset($_POST["submit"])){
        $fn = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS);
        $mn = filter_input(INPUT_POST, "mname", FILTER_SANITIZE_SPECIAL_CHARS);
        $sn = filter_input(INPUT_POST, "sname", FILTER_SANITIZE_SPECIAL_CHARS);
        $pn = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_NUMBER_INT);
        $pn = preg_replace('/[^0-9]/', '', $pn);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $pw = filter_input(INPUT_POST, "pswd", FILTER_SANITIZE_SPECIAL_CHARS);
        $pw2 = filter_input(INPUT_POST, "pswd2", FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($fn)){
            $message = "Please enter a first name";
        }
        elseif(empty($sn)){
            $message = "Please enter a surname";
        }
        elseif(empty($pn)){
            $message = "Please enter a mobile number";
        }
        elseif(empty($email)){
            $message = "Please enter an email";
        }
        elseif(empty($pw) || empty($pw2)){
            $message = "Please fill in both password fields";
        }
        elseif($pw !== $pw2){
            $message = "Password do not match";
        }
        else {
            $sql = "INSERT INTO users (first_name, midle_name, surname, birthdate, phone, email, password, role, designation)
            VALUES ('$fn', '$mn', '$sn', '', '$pn', '$email', '$pw', 'User', '')";

            try{
                mysqli_query($conn, $sql);
                $message = "You are now registered!";
            }
            catch(mysqli_sql_exception $e){
                $message = "Registration Failed: " . $e->getMessage();
            }
        }
    }
    mysqli_close($conn);
?>


<body>
<div class="container-fluid mt-5 custom-container">
    <div class="shadow p-4 mb-4 bg-white">
        <h2>Registration</h2>
        <form action="userRegistration.php" method="post" onsubmit="return submitForm();">
            <div class="row">
                <label for="fname">Full Name:</label>
                <div class="col">
                    <input type="text" class="form-control" placeholder="First Name" name="fname">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Middle Name" name="mname">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Surame" name="sname">
                </div>
            </div>
            <div class="mb-3 mt-3">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" placeholder="Mobile Number" name="phone">
            </div>
            <div class="mb-3 mt-3">
                <label for="emaik">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email">
            </div>
            <div class="mb-3 mt-3">
                <label for="emaik">Password</label>
                <input type="password" class="form-control" id="pswd" placeholder="Enter Password" name="pswd">
            </div>
            <div class="mb-3 mt-3">
                <label for="emaik">Re-Password</label>
                <input type="password" class="form-control" id="pswd2" placeholder="Enter Password" name="pswd2">
            </div>
            <div class="form-check mb-3">
                <label for="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember" required>Terms and Condition
                </label>
            </div>
            <input type="submit" class="btn btn-success" value="Register" name="submit">
            <a href="userLogin.php" class="btn btn-primary"><i class="fa-solid fa-key"></i> Login</a>
        </form>
        <hr>
        <div class="alert alert-danger <?php if (empty($message)) echo 'd-none'; ?>">
            <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
<?php
    include("agreeModal.php");
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const agreeCheckbox = document.querySelector(".form-check-input");
    const modal = new bootstrap.Modal(document.getElementById("myModalReg"));

    agreeCheckbox.addEventListener("change", function() {
        if (this.checked) {
            modal.show();
        } else {
            modal.hide();
        }
    });
});
</script>


