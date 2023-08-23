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
        <div class="col">
            <div class="custom-container3 p-5 my-2 border">
                <div class="d-flex align-items-center">
                    <h5>Total Transaction</h5>
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                </div>
            </div>
            <div class="container">
                 <h3>Numbers:s</h3>
            </div>
        </div>
        <div class="col">
            <div class="custom-container3 p-5 my-2 border">
                <div class="d-flex align-items-center">
                    <h5>Number of Users</h5>
                </div>
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
        <div class="col">
            <div class="custom-container3 p-5 my-2 border">
                <div class="d-flex align-items-center">
                    <h5>Daily Transaction</h5>
                </div>
                <i class="fa-solid fa-calendar-day"></i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="custom-container3 p-5 my-2 border">
                <div class="d-flex align-items-center">
                    <h5>Weekly</h5>
                </div>
                <i class="fa-solid fa-calendar-week"></i>
            </div>
        </div>
        <div class="col">
            <div class="custom-container3 p-5 my-2 border">
                <div class="d-flex align-items-center">
                    <h5>Monthly</h5>
                </div>
                <i class="fa-solid fa-calendar-days"></i>
        </div>
    </div>
  </div>
  </div>
  <div class="col-sm-4">
    <div class="custom-container3 p-5 my-2 border">
        <h5>Featured Transaction</h5>
    </div>
  </div>

</div>
<?php 
    
    include("footer.php");
?>
