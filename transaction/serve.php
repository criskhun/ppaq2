<?php
include("../designPage/headerLogin.php");
include("../dashboard/navbar.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);


$id = "";
$office = "";
$transaction = "";
$service = "";
$company = "";
$name = "";
$time = "";
$date = "";
$que_no = "";
$remark = "";
$serve = "";
$duration = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET["id"];
        $sql5 = "SELECT * FROM transaction_tbl WHERE id = $id";
        $resultServe = $conn->query($sql5);
        $rowServe = $resultServe->fetch_assoc();

        if (!$rowServe) {
            header("location: ../transaction/transaction.php");
            exit;
        }

        $office = $rowServe["office"];
        $transaction = $rowServe["transaction"];
        $service = $rowServe["service"];
        $company = $rowServe["company"];
        $name = $rowServe["name"];
        $time = $rowServe["time"];
        $date = $rowServe["date"];
        $que_no = $rowServe["que_no"];
        $remark = $rowServe["remarks"];
        $serve = $rowServe["served"];
        $duration = $rowServe["duration"];
    } else {
        header("location: ../transaction/transaction.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST["id"];
    $id = $_POST["id"];
    $office = $_POST["office"];
    $transaction = $_POST["transaction"];
    $service = $_POST["service"];
    $company = $_POST["company"];
    $name = $_POST["name"];
    $time = $_POST["time"];
    $date = $_POST["date"];
    $que_no = $_POST["que_no"];
    $remark = $_POST["remarks"];
    $serve = $_POST["served"];
    $duration = $_POST["duration"];

    if (isset($_POST['function1'])){
    

    do {
        if (empty($office) ){
            $errorMessage = "Office required";
            break;
        } elseif (empty($transaction)) {
            $errorMessage = "Transaction required";
            break;
        } elseif (empty($service)) {
            $errorMessage = "Service required";
            break;
        } elseif (empty($company)) {
            $errorMessage = "Company required";
            break;
        } elseif (empty($name)) {
            $errorMessage = "Name required";
            break;
        } elseif (empty($time)) {
            $errorMessage = "Time required";
            break;
        } elseif (empty($date)) {
            $errorMessage = "Date required";
             break;
        } elseif (empty($que_no)) {
            $errorMessage = "Que_no required";
            break;
        } elseif (empty($serve)) {
            $errorMessage = "Serve required";
            break;
        } elseif (empty($duration)) {
            $errorMessage = "Duration required";
            break;
        }
        
        $sql = "UPDATE transaction_tbl " . 
                "SET remarks = '$remark', served = '$serve', duration = '$duration', transaction = '$transaction'" .
                "WHERE id = $id";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }

        $sql = "INSERT INTO transactionLog_tbl (office, transaction, service, company, name, time, date, remarks, que_no, served, duration, status)
                VALUES ('$office', '$transaction', '$service', '$company', '$name', '$time', '$date', '$remark', '$que_no', '$serve', '$duration', 'Transfer')";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Error: " . $conn->error;
            break;
        }

        $office = "";
        $transaction = "";
        $service = "";
        $company = "";
        $name = "";
        $servedName = "";
        $time = "";
        $date = "";
        $remakrs = "";
        $que_no = "";
        $serve = "";
        $duration = "";
        $status = "";


        $successMessage = "Transaction Passed Successfully!";
        $redirectUrl = "../transaction/transaction.php";

        echo '<script>window.location.href = "' . $redirectUrl . '";</script>';
        exit;

    } while (false);
} elseif (isset($_POST['function2'])) {
    do {
        if (empty($office) ){
            $errorMessage = "Office required";
            break;
        } elseif (empty($transaction)) {
            $errorMessage = "Transaction required";
            break;
        } elseif (empty($service)) {
            $errorMessage = "Service required";
            break;
        } elseif (empty($company)) {
            $errorMessage = "Company required";
            break;
        } elseif (empty($name)) {
            $errorMessage = "Name required";
            break;
        } elseif (empty($time)) {
            $errorMessage = "Time required";
            break;
        } elseif (empty($date)) {
            $errorMessage = "Date required";
             break;
        } elseif (empty($que_no)) {
            $errorMessage = "Que_no required";
            break;
        } elseif (empty($serve)) {
            $errorMessage = "Serve required";
            break;
        } elseif (empty($duration)) {
            $errorMessage = "Duration required";
            break;
        } 

        $sql = "INSERT INTO transactionLog_tbl (office, transaction, service, company, name, time, date, remarks, que_no, served, duration, status)
                VALUES ('$office', '$transaction', '$service', '$company', '$name', '$time', '$date', '$remark', '$que_no', '$serve', '$duration', 'Done')";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Error: " . $conn->error;
            break;
        }

        $office = "";
        $transaction = "";
        $service = "";
        $company = "";
        $name = "";
        $servedName = "";
        $time = "";
        $date = "";
        $remakrs = "";
        $que_no = "";
        $serve = "";
        $duration = "";
        $status = "";

        
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            $sql = "DELETE FROM transaction_tbl WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                // Successful deletion
                header("location: transaction.php");
                exit;
            } else {
                // Error in deletion
                die("Error deleting user: " . $conn->error);
            }
        }



        $successMessage = "Transaction Passed Successfully!";
        $redirectUrl = "../transaction/transaction.php";

        echo '<script>window.location.href = "' . $redirectUrl . '";</script>';
        exit;

    } while (false);
}
}
?>



<form action="" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
  
    <div class="container p-5 my-5 bg-light text-black">
    <?php
if (!empty($errorMessage)) {
  echo "
  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong> $errorMessage</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>
  ";
}
?>

<?php 
if (!empty($successMessage)) {
  echo "
  <div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong> $successMessage</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>
  ";
}
?>
        <div class="row">
                <div class="col">
                    <label for="office">Office</label>
                    <input type="text" class="form-control" id="office" placeholder="Office" name="office" value="<?php echo $office; ?>" readonly>
                </div>
                <div class="col">
                    <label for="transaction2">Transaction</label>
                    <input type="text" class="form-control" id="transaction2" placeholder="Office" name="transaction2" value="<?php echo $des; ?>" readonly>
                </div>
        </div>
        <div class="row">
                <div class="col">
                    <label for="service">Service</label>
                    <input type="text" class="form-control" id="service" placeholder="Service" name="service" value="<?php echo $service; ?>" readonly>
                </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <label for="company">Company</label>
                <input type="text" class="form-control" id="company" placeholder="Company" name="company" value="<?php echo $company; ?>" readonly>
            </div>
            <div class="col">
                <label for="name">Port User</label>
                <input type="text" class="form-control" id="name" placeholder="Port User" name="name" value="<?php echo $name; ?>" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="time">Time</label>
                <input type="text" class="form-control" id="time" placeholder="Time" name="time" value="<?php echo $time; ?>" readonly>
            </div>
            <div class="col">
                <label for="date">Date</label>
                <input type="text" class="form-control" id="date" placeholder="Date" name="date" value="<?php echo $date; ?>" readonly>
            </div>
            <div class="col">
                <label for="que_no">Code</label>
                <input type="text" class="form-control" id="que_no" placeholder="Code" name="que_no" value="<?php echo $que_no; ?>" readonly>
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label for="remarks">Remarks:</label>
            <textarea class="form-control" rows="2" id="remarks" name="remarks" placeholder="Input remarks"><?php echo $remark; ?></textarea>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <label for="served">Serve</label>
                <input type="text" class="form-control" id="served" name="served" placeholder="Serve by" value="<?php
                $servedName = $sn . ', ' . $fn . ' ' . $mn;
                echo $servedName; ?>" readonly>
            </div>
            <div class="col">
                <label for="duration">Duration</label>
                <input type="text" class="form-control" id="duration" name="duration" placeholder="Duration" value="00 : 00 : 00" readonly>
            </div>
        </div>
        <div class="form-check form-switch" style="margin: 10px">
            <input class="form-check-input" type="checkbox" id="mySwitchTrans" name="darkmode" value="yes" checked>
            <label class="form-check-label" for="mySwitchTrans">Want to Transfer?</label>
        </div>

        <div id="selectContainer" class="hidden-container">
            <label for="transaction" class="form-label">RC's List (select one):</label>
            <select class="form-select" id="transaction" name="transaction">
            
        <?php
        $defaultTransaction = $rowServe["transaction"];
        $sql = "SELECT transaction FROM transaction_list";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $transactionName = $row["transaction"];
                $selected = ($transactionName === $defaultTransaction) ? "selected" : "";
                echo "<option $selected>$transactionName</option>";
            }
        }
        $conn->close();
        ?>
            </select>
            <br>
            <hr>
            <button type="submit" class="btn btn-primary btn-block" name="function1" data-bs-dismiss="modal">Transfer</button>
        </div>
    
        <div class="hidden-container2" id="selectContainer2">
            <br>
            <hr>
            <button type="submit" class="btn btn-primary btn-block" name="function2" data-bs-dismiss="modal">Submit</button>
            

        </div>
    </div>
</form>

    
<?php
    include("../transaction/footerTrans.php");
?>