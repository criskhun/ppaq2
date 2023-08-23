<?php 
    session_start();
    include("../designPage/headerLogin.php");
    include("navbar.php");
    if (isset($_SESSION["email"])) {
        $email = $_SESSION["email"];
        $id = $_SESSION["id"];
        $fn = $_SESSION["first_name"];
        $mn = $_SESSION["midle_name"];
        $sn = $_SESSION["surname"];
        $bd = $_SESSION["birthdate"];
        $pn = $_SESSION["phone"];
        $date = $_SESSION["date"];
        $role = $_SESSION["role"];
        $des = $_SESSION["designation"];
    }
?>

<div class="container-fluid">
    <h3>Dashboard</h3>
</div>

<div class="row">
  <div class="col-sm-8">
    <div class="row">
        <div class="col">Total Transaction</div>
        <div class="col">Number of Users</div>
        <div class="col">Other</div>
    </div>
  </div>
  <div class="col-sm-4">
    Popular Transaction
  </div>
</div>

<?php 
    
    include("footer.php");
?>
