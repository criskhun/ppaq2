
<?php
 session_start();
 include("../database.php");
 include("../designPage/headerStyle.html");

// Check if user is not logged in and redirect if needed
if (!isset($_SESSION["email"])) {
    echo '<script>window.location.href = "../logReg/userLogin.php";</script>';
    exit;
}

// Logout functionality
if (isset($_POST['logout'])) {
    // Clear the session
    session_unset();
    session_destroy();

    // Redirect to login page
    echo '<script>window.location.href = "index.php";</script>';
    exit;
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    
    <div class="header">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-sm-8 bg-primary text-white d-flex align-items-center" style="padding: 20px;">
                    <img src="../images/white-logo.png" alt="logo" width="70" height="70" class="me-3">
                    <div>
                        <h3>Customer Service Monitoring System</h3>
                        <p>PPA PMO-SOCSARGEN QUEUING SYSTEM</p>
                        <?php echo $errorMessage; ?>
                    </div>
                </div>
                <div class="col-sm-4 p-3 bg-primary text-white d-flex align-items-center">
                    <div class="ms-2 my-text">
                        <?php 
                            if (isset($_SESSION["email"])) {
                                $role = $_SESSION["role"];
                                $fn = $_SESSION["first_name"];
                                $mn = $_SESSION["midle_name"];
                                $sn = $_SESSION["surname"];
                                echo "{$role}";
                            }
                        ?>
                    </div>
                    <img src="../images/boy.png" alt="Logo" style="width: 40px;" class="rounded-pill mx-2">
                    <div class="dropdown dropdown-menu-end">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            <?php
                                    echo "{$sn}, {$fn} {$mn}";       

                            ?>

                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="../queuing/pacd.php">PACD Menu</a></li>
                            <li><button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#myModal">Logout</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    

<?php
    include("modalLogout.php");
?>
