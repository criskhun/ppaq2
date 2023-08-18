<?php
    include("../designPage/headerLogin.php");
    include("../dashboard/navbar.php");
?>

<?php
if(isset($_POST['submitBtnAccessPass'])) {
    $accessPassValue = $_POST['accessPassToPass'];
    $pacdValue = $_POST['pacdToPass'];

    $chars = "";
    $errorMessage = "";
    $successMessage = "";
    switch($accessPassValue) {
        case "Access Pass";
        $chars = "AP";
        break;

        case "Marine";
        $chars = "MA";
        break;

        case "Terminal";
        $chars = "TE";
        break;

        case "Data Encoding";
        $chars = "DE";
        break;

        case "Assessment";
        $chars = "AS";
        break;

        case "Collection";
        $chars = "CO";
        break;

        case "Admin";
        $chars = "AD";
        break;

        case "Engineering";
        $chars = "ES";
        break;

        case "Finance";
        $chars = "FI";
        break;

        case "OPM-Legal";
        $chars = "OL";
        break;

        case "OPM-Permits";
        $chars = "OP";
        break;

        case "OPM-Records";
        $chars = "OR";
        break;

        case "Port Police";
        $chars = "PP";
        break;

        case "Port Services";
        $chars = "PS";
        break;
    }
}
?>

<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $office = $_POST["officeSelected00"];
    $transaction = $_POST["transactionSelected00"];
    $service = $_POST["serviceSelected00"];
    $company = $_POST["companySelected00"];
    $name = $_POST["portUserSelected00"];
    $date = $_POST["dateSelected00"];
    $time = $_POST["timeSelected00"];
    $Qcode = $_POST["codeSelected00"];
    $charsV = $_POST["chars00"];
    $countV = $_POST["count00"];


    do {
        if (empty($office) || empty($transaction) || empty($service) || empty($company) || empty($name) || empty($date) || empty($time) || empty($Qcode)){
            $errorMessage = "Something is missing";
            break;
        }
    
    try {
        $sql = "INSERT INTO transaction_tbl (office, transaction, service, company, name, date, time, que_no, remarks, served, duration)
            VALUES ('$office', '$transaction', '$service', '$company', '$name', '$date', '$time', '$Qcode', '', '', '')";
        $resultSave = $conn->query($sql);

        $sql2 = "INSERT INTO code_tbl (chars, number, transaction, service, date)
             VALUES('$charsV', '$countV', '$transaction', '$service', '$date')";
        $resultCode = $conn->query($sql2);

        if (!$resultSave && !$resultCode) {
            $errorMessage = "Error: " . $conn->error;
            break;
        } 
        $successMessage = "Transaction added Correctly";
        
        $encodedTransaction = urlencode($transaction);
        $encodedOffice = urlencode($office);
        $encodedService = urlencode($service);
        $encodedCompany = urlencode($company);
        $encodedPortUser = urlencode($name);
        $encodedTime = urlencode($time);
        $encodedDate = urlencode($date);
        $encodedCode = urlencode($Qcode);

        $redirectUrl = "../queuing/ticket.php?transaction=$encodedTransaction&office=$encodedOffice&service=$encodedService&company=$encodedCompany&portUser=$encodedPortUser&time=$encodedTime&date=$encodedDate&code=$encodedCode";

        echo '<script>window.location.href = "' . $redirectUrl . '";</script>';
        exit;
        mysqli_close($conn);

    } catch (mysqli_sql_exception $e) {
        $errorMessage = "Error: " . $e->getMessage();
    }
    } while (false);
}
?>

<div class="container p-5 my-5 bg-light text-black">
<form action="" method="post">
    <div class="row">
        <div class="col-sm-6">
            <h4><?php echo $accessPassValue ?></h4>
            
            <div class="option-container">
                <div class="form-check">
                    <?php
                    $options = array();
                    $sql = "SELECT service FROM service_tbl WHERE transaction='$accessPassValue'";
                    
                    $result = $conn->query($sql);
                    

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $options[] = $row['service'];
                        }
                        foreach ($options as $option) {
                            echo '<input type="radio" class="form-check-input opta" name="option" value="' . htmlspecialchars($option) . '" onclick="toggleDivHide(),handleRadioChange(this);">' . htmlspecialchars($option) . '<br>';
                        }
                    } else {
                        echo "No options found.";
                    }

                    $sql2 = "SELECT * FROM code_tbl WHERE chars='$chars'";
                    $resultCount = $conn->query($sql2);

                    if (!$resultCount) {
                        die("Invalid query: " . $conn->error);
                    }
                    $count = $resultCount->num_rows;
                    

                    if ($count === 0){
                        $count = 1;
                    } else {
                        $count = $count + 1;
                    }
                    //echo $count;
                    ?>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input opta" name="option" value="otherOption" onclick="toggleDivHide(),handleRadioChange(this);">
                    <label class="form-check-label" for="otherOption">Other</label>
                    <input type="text" class="form-control optionOtherInputOpta" name="otherOption" placeholder="Please specify" disabled>
                </div>
                <hr>
                <button type="button" id="submitButton" class="btn btn-outline-primary submit-button" onclick="displaySelectedValue(),toggleDivVisibility()">Next</button>
            </div>
            <div class="col-sm-6" hidden>
                <input type="text" id="officeInput" name="officeSelected00" value="<?php echo $pacdValue; ?>" >
                <input type="text" id="transactionInput" name="transactionSelected00" value="<?php echo $accessPassValue; ?>" >
                <input type="text" id="selectedValueInput" name="serviceSelected00" >
                <input type="text" id="dateValueInput" name="dateSelected00" value="<?php echo $currentDate; ?>" >
                <input type="text" id="timeValueInput" name="timeSelected00" value="<?php echo $currentTime; ?>" >
                <input type="text" id="codeValueInput" name="codeSelected00" value="<?php echo $chars . $count?>" >
                <input type="text" id="charsValue" name="chars00" value="<?php echo $chars; ?>" >
                <input type="text" id="countValue" name="count00" value="<?php echo $count; ?>" >
            </div>  
        </div>
        <div class="col-sm-6" id="hiddenDiv" hidden>
        <h4>Port User</h4>
        <div class="mb-3 mt-3">
            <label for="company" class="form-label">Company:</label>
            <input type="text" class="form-control" id="company" placeholder="Enter Company" name="companySelected00">
        </div>
        <div class="mb-3">
            <label for="portUser" class="form-label">Port User:</label>
            <input type="text" class="form-control" id="portUser" placeholder="Enter Name" name="portUserSelected00">
        </div>
        <hr>
        <button type="submit" name="codeRelay" class="btn btn-primary full-width-button">Submit</button>
        
        </div>
    </div>
</form>
</div>


<?php
    
    include("../queuing/footerQue.php");
?>