<?php
    include("../designPage/headerLogin.php");
    include("../dashboard/navbar.php");
?>

<?php
if (isset($_GET['transaction'])) {
    $transaction = $_GET['transaction'];
    $office = $_GET['office'];
    $service = $_GET['service'];
    $company = $_GET['company'];
    $portUser = $_GET['portUser'];
    $time = $_GET['time'];
    $date = $_GET['date'];
    $code = $_GET['code'];

    //echo "Transaction: " . $transaction . "<br>";
    //echo "Office: " . $office . "<br>";
    //echo "Service: " . $service . "<br>";
    //echo "Company: " . $company . "<br>";
    //echo "Port User: " . $portUser . "<br>";
    //echo "Time: " . $time . "<br>";
    //echo "Date: " . $date . "<br>";
    //echo "Code: " . $code . "<br>";
} else {
    echo "No data received.";
}
?>


<div class="container receipt-container bg-white">
    <img src="../images/logo.png" alt="logo" class="logo-receipt">
<?php
    echo "
            <div class='receipt-header'>
                    
            <h3>$office</h3>
            <h6>$code<h6>
        </div>
        <div class='receipt-body'>
            <div class='item-row'>
                <span>Transaction: </span>
                <span>$transaction</span>
            </div>
            <div class='item-row'>
                <span>Service: </span>
                <span>$service</span>
            </div>
            <hr>
            <div class='item-row'>
                <span>Company: </span>
                <span>$company</span>
            </div>
            <div class='item-row'>
                <span>Port User: </span>
                <span>$portUser</span>
            </div>
            <hr>
            <div class='item-row'>
                <strong>$time</strong>
                <strong>$date</strong>
            </div>
            <div class='text-center mt-3'>
                Thank you for your transaction!
            </div>
        </div>
    ";
?>
<div class="d-grid">
    
  <button type="button" class="btn btn-primary btn-block mb-2"><i class="fa-solid fa-print"></i> Print</button>
  <a href="../queuing/pacd.php" class="btn btn-primary btn-block mb-2"><i class="fa-solid fa-house"></i> Home</a>
</div>
</div>

<?php
    
    include("../dashboard/footer.php");
?>