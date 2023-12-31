
<div class="offcanvas offcanvas-start" id="CGdemo">
  <div class="offcanvas-header">
    <h1 class="offcanvas-title">Code Generator</h1>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <h3>Core</h3>
  <div class="list-group list-group-flush">
        <!--<a href="../codeGen/codeGen.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
            <i class="fa-solid fa-gauge ms-2 me-2"></i>
            Code Generator
            </div></a>-->
        <a href="../codeGen/codeGen2.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
            <i class="fa-solid fa-gauge ms-2 me-2"></i>
            Code Generator2
            </div></a>
        <a href="../codeGen/reportCG.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-desktop ms-2 me-2"></i>
            Report
        </div>
        </a>
        
        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#usersSubMenu">
            <div class="d-flex align-item-center">
            <i class="fa-solid fa-users ms-2 me-2"></i>
            Users
            </div>
            <i class="fa-solid fa-list"></i>
            </a>
            <div class="collapse" id="usersSubMenu">
            <a href="../users/activeUsers.php" class="list-group-item list-group-item-action">
            <div class="d-flex align-item-center">
            <i class="fa-solid fa-circle ms-4 me-2"></i>
            Active
            </div>    
            </a>
            <a href="../users/inActiveUsers.php" class="list-group-item list-group-item-action">
            <div class="d-flex align-item-center">
            <i class="fa-solid fa-circle ms-4 me-2"></i>
            In-active
            </div>    
            </a>
            </div>
        <a href="../logs/logs.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div class="d-flex align-item-center">
            <i class="fa-solid fa-clipboard-list ms-2 me-2"></i>
            Scanner
            </div>
            </a>

    </div>
    <hr>
    <h3>Others</h3>
    <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div class="d-flex align-item-center">
            <i class="fa-solid fa-circle-question ms-2 me-2"></i>
            About
            </div>
            </a>
        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div class="d-flex align-item-center">
            <i class="fa-solid fa-gear ms-2 me-2"></i>
            Settings
            </div>
            </a>
        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div class="d-flex align-item-center">
            <i class="fa-solid fa-address-card ms-2 me-2"></i>
            Profile
            </div>
            </a>
        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center logout" data-bs-toggle="modal" data-bs-target="#myModalCG">
            <div class="d-flex align-item-center">
            <i class="fa-solid fa-right-from-bracket ms-2 me-2"></i>
            Logout
            </div>
            </a>                
    </div>
  </div>
  <div class="list-group list-group-flush">

    <?php
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

            echo '<button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#reportsSubMenu">';
            echo '<div class="d-flex align-item-center">';
            echo '<i class="fa-solid fa-user-secret ms-2 me-2"></i>';
            echo "{$sn}, {$fn} {$mn}";   
            echo '</div>';
            echo '<i class="fa-solid fa-chevron-down"></i>';
            echo '</button>';
            echo '<div class="collapse" id="reportsSubMenu">';
            echo '<a href="#" class="list-group-item list-group-item-action">';
            echo "{$role}";
            echo '</a>';
        }

        date_default_timezone_set("Asia/Singapore");
        $currentDate = date("Y-m-d"); // Gets the current date in the format "YYYY-MM-DD"
        $currentTime = date("H:i:s");

            echo '<a href="#" class="list-group-item list-group-item-action">';
            echo "{$currentTime}";
            echo '</a>';
            echo '<a href="#" class="list-group-item list-group-item-action">';
            echo "{$currentDate}";
            echo '</a>';

    ?>
        <!-- Add more report items as needed -->
      </div>
    </div>
</div>

<div class="container-fluid mt-3">
  <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#CGdemo"><i class="fa-solid fa-bars"></i>
    Open Menu
  </button>
</div>

<?php
    include("modalLogout.php");
?>

