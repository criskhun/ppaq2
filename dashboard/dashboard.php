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
            <div class="custom-container3 p-5 my-2 border d-flex flex-column align-items-start">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="m-0">Total Transaction</h5>
                    <i class="fa-solid fa-wand-magic-sparkles icon ml-2"></i>    
                </div>
                <span><h2>Number</h2></span>
            </div>
        </div>

        <div class="col">
            <div class="custom-container3 p-5 my-2 border d-flex flex-column align-items-start">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="m-0">Number of Users</h5>
                    <i class="fa-solid fa-users icon ml-2"></i>    
                </div>
                <span><h2>Number</h2></span>
            </div>
        </div>

        <div class="col">
            <div class="custom-container3 p-5 my-2 border d-flex flex-column align-items-start">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="m-0">Daily Transaction</h5>
                    <i class="fa-solid fa-calendar-day icon ml-2"></i>    
                </div>
                <span><h2>Number</h2></span>
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
                <span><h2>Number</h2></span>
            </div>
        </div>

        <div class="col">
            <div class="custom-container3 p-5 my-2 border d-flex flex-column align-items-start">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="m-0">Monthly</h5>
                    <i class="fa-solid fa-calendar-days icon ml-2"></i>    
                </div>
                <span><h2>Number</h2></span>
            </div>
        </div>
    </div>

  </div>

  <div class="col-sm-4">
  <div class="col">
            <div class="custom-container3 p-5 my-2 border d-flex flex-column align-items-start">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="m-0">User List</h5>
                    <i class="fa-solid fa-list icon ml-2"></i>   
                </div>
                <?php
                // Fetch data from the database
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);
                ?>

                <!-- Display the list -->
                <ul>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<li>" . $row["surname"] . ", " . $row["first_name"] . " " . $row["midle_name"] . "\t " . $row["role"] . "\t " . $row["designation"] . "</li>";
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

<?php 
    
    include("footer.php");
?>
