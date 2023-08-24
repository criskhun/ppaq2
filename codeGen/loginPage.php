<?php
    include("../codeGen/headerCG.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3" style="background-image: url('../images/encoding.jpg'); background-size: cover; background-position: center; height: 100vh;">

        </div>
        <div class="col-sm-3">
            <form action="/action_page.php" class="was-validated">
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="myCheck" name="remember" required>
                    <label class="form-check-label" for="myCheck">I agree on blabla.</label>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Check this checkbox to continue.</div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php
    include("../codeGen/footerCG.php")
?>