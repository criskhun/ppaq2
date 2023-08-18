<?php
ob_start();
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
$servedName = "";
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
            header("location: transaction.php");
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
        header("location: transaction.php");
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
        } 

        
        $sql = "INSERT INTO transactionLog_tbl (office, transaction, service, company, name, time, date, remarks, que_no, served, duration, status)
                VALUES ('$office', '$transaction', '$service', '$company', '$name', '$time', '$date', '$remark', '$que_no', '$serve', '$duration', 'Drop')";
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

        $successMessage = "transaction log added correctly";

        header("location: transaction.php");
        exit;       
    } while (false);
    header("location: transaction.php");
    exit;
    ob_end_flush();
}

?>
<div id="messageDiv">
    <?php
    if (!empty($errorMessage)) {
        echo '<div class="error-message">' . $errorMessage . '</div>';
    } elseif (!empty($successMessage)) {
        echo '<div class="success-message">' . $successMessage . '</div>';
    }
    ?>
</div>

<form id="transactionForm" action="" method="post" >
    <div class="col-sm-6">
        <input type="text" id="id" name="id" value="<?php echo $id; ?>" >
        <input type="text" id="office" name="office" value="<?php echo $office; ?>" >
        <input type="text" id="transaction" name="transaction" value="<?php echo $transaction; ?>">
        <input type="text" id="service" name="service" value="<?php echo $service; ?>" >
        <input type="text" id="company" name="company" value="<?php echo $company; ?>" >
        <input type="text" id="name" name="name" value="<?php $servedName = $sn . ', ' . $fn . ' ' . $mn;
                    echo $servedName;?>" >
        <input type="text" id="time" name="time" value="<?php echo $time; ?>" >
        <input type="text" id="date" name="date" value="<?php echo $currentDate; ?>" >
        <input type="text" id="que_no" name="que_no" value="<?php echo $que_no; ?>" >
        <input type="text" id="remarks" name="remarks" value="<?php echo $remark; ?>" >
        <input type="text" id="served" name="served" value="<?php $servedName = $sn . ', ' . $fn . ' ' . $mn;
                    echo $servedName; ?>" >
        <input type="text" id="duration" name="duration" value="<?php echo $duration; ?>" >
    </div> 
</form>
<script defer src="../transaction/submissionScript.js"></script>
