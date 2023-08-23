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

    $sql = "SELECT COUNT(*) AS total_transactions FROM transactionLog_tbl";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalTransactions = $row["total_transactions"];

    $sql = "SELECT COUNT(*) AS total_users FROM users";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalUsers = $row["total_users"];

    $currentDate = date("Y-m-d");

    $sql = "SELECT COUNT(*) AS totalTransactionDaily FROM transactionLog_tbl WHERE date='$currentDate'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalTransactionDaily = $row["totalTransactionDaily"];
    $displayTextDaily = ($totalTransactionDaily > 0) ? $totalTransactionDaily : "0";

    $weekStart = date("Y-m-d", strtotime('this week', strtotime($currentDate)));
    $weekEnd = date("Y-m-d", strtotime('this week +6 days', strtotime($currentDate)));

    // Query to get the total number of transactions for the current week
    $sql = "SELECT COUNT(*) AS total_weekly FROM transactionLog_tbl WHERE date BETWEEN '$weekStart' AND '$weekEnd'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalTransactionsWeekly = $row["total_weekly"];

    // Determine the text to display based on the result
    $displayTextWeekly = ($totalTransactionsWeekly > 0) ? $totalTransactionsWeekly : "0";

    $monthStart = date("Y-m-01", strtotime($currentDate));
    $monthEnd = date("Y-m-t", strtotime($currentDate));

    // Query to get the total number of transactions for the current month
    $sql = "SELECT COUNT(*) AS total_month FROM transactionLog_tbl WHERE date BETWEEN '$monthStart' AND '$monthEnd'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalTransactionsMonthly = $row["total_month"];

    // Determine the text to display based on the result
    $displayTextMonthly = ($totalTransactionsMonthly > 0) ? $totalTransactionsMonthly : "0";


?>

<div class="container-fluid">
    <h3>Dashboard</h3>
</div>

<div class="row">
  <div class="col-sm-8">
    <div class="row">

        <div class="col">
            <div class="custom-container3 p-5 my-2 border d-flex flex-column align-items-start">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="m-0">Total Transaction</h5>
                    <i class="fa-solid fa-wand-magic-sparkles icon ml-2"></i>    
                </div>
                <span><h1><?php echo $totalTransactions; ?></h1></span>
            </div>
        </div>

        <div class="col">
            <div class="custom-container3 p-5 my-2 border d-flex flex-column align-items-start">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="m-0">Number of Users</h5>
                    <i class="fa-solid fa-users icon ml-2"></i>    
                </div>
                <span><h1><?php echo $totalUsers; ?></h1></span>
            </div>
        </div>

        <div class="col">
            <div class="custom-container3 p-5 my-2 border d-flex flex-column align-items-start">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="m-0">Daily Transaction</h5>
                    <i class="fa-solid fa-calendar-day icon ml-2"></i>    
                </div>
                <span><h1><?php echo $displayTextDaily; ?></h1></span>
            </div>
        </div>
     </div>

    <div class="row">

        <div class="col">
            <div class="custom-container3 p-5 my-2 border d-flex flex-column align-items-start">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="m-0">Weekly</h5>
                    <i class="fa-solid fa-calendar-week icon ml-2"></i>    
                </div>
                <span><h2><?php echo $displayTextWeekly; ?></h2></span>
            </div>
        </div>

        <div class="col">
            <div class="custom-container3 p-5 my-2 border d-flex flex-column align-items-start">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="m-0">Monthly</h5>
                    <i class="fa-solid fa-calendar-days icon ml-2"></i>    
                </div>
                <span><h2><?php echo $displayTextMonthly; ?></h2></span>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="custom-container3 p-5 my-2 border d-flex flex-column align-items-start">
            <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="m-0">Yearly Transaction</h5>
                    <i class="fa-solid fa-calendar-days icon ml-2"></i>    
                </div>
                <canvas id="monthlyChart"></canvas>

        </div>
    </div>

  </div>

  <div class="col-sm-4">
  <div class="col">
            <div class="custom-container3 p-5 my-2 border d-flex flex-column align-items-start">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="m-0">User List</h5>
                    <br>
                    <hr>
                    <i class="fa-solid fa-list icon ml-2"></i>   
                </div>
                <?php
                // Fetch data from the database
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);
                ?>

                <!-- Display the list -->
                <ul class="custom-list">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<li><span>" . $row["surname"] . ", " . $row["first_name"] . " " . $row["midle_name"] . "</span><span> " . $row["role"] . "</span><span>" . $row["designation"] . "</span></li>";
                        }
                    } else {
                        echo "No transactions found.";
                    }
                    ?>
                </ul>
                <?php
                    $conn->close();
                ?>

            </div>
        </div>
  </div>

</div>


<script src="../dashboard/chart.js"></script>

