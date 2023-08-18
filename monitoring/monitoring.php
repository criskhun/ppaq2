<?php
include("../designPage/headerLogin.php");
include("../dashboard/navbar.php");

$sql = "SELECT * FROM transaction_tbl WHERE transaction='Access Pass' ORDER BY id ASC";
    $resultAP = $conn->query($sql);

    if (!$resultAP) {
        die("Invalid query: " . $conn->error);
    }
$sql = "SELECT * FROM transaction_tbl WHERE transaction='Marine' ORDER BY id ASC";
    $resultMA = $conn->query($sql);

    if (!$resultMA) {
        die("Invalid query: " . $conn->error);
    }
$sql = "SELECT * FROM transaction_tbl WHERE transaction='Terminal' ORDER BY id ASC";
    $resultTE = $conn->query($sql);

    if (!$resultTE) {
        die("Invalid query: " . $conn->error);
    }
$sql = "SELECT * FROM transaction_tbl WHERE transaction='Data Encoding' ORDER BY id ASC";
    $resultDE = $conn->query($sql);

    if (!$resultDE) {
        die("Invalid query: " . $conn->error);
    }
$sql = "SELECT * FROM transaction_tbl WHERE transaction='Assessment' ORDER BY id ASC";
    $resultAS = $conn->query($sql);

    if (!$resultAS) {
        die("Invalid query: " . $conn->error);
    }
$sql = "SELECT * FROM transaction_tbl WHERE transaction='Collection' ORDER BY id ASC";
    $resultCO = $conn->query($sql);

    if (!$resultCO) {
        die("Invalid query: " . $conn->error);
    }
?>

<div class="container-fuild custom-container">
<div class="row">
  <div class="col-sm-4">
    <div class="container p-5 my-5 bg-light text-black custom-shadow custom-container2"><h3>Access Pass</h3>
    <table class="table table-borderless">
        <thead>
        <tr>
            <th>Code</th>
            <th>Company</th>
        </tr>
        </thead>
        <tbody id="table-body1">
        <?php
                            while ($rowAP = $resultAP->fetch_assoc()) {
                                echo "
                                <tr>
                                    <td>$rowAP[que_no]</td>
                                    <td>$rowAP[company]</td>
                                </tr>
                                ";
                            }
                        ?>

        </tbody>
    </table>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="container p-5 my-5 bg-light text-black custom-shadow custom-container2"><h3>Marine</h3>
    <table class="table table-borderless">
        <thead>
        <tr>
            <th>Code</th>
            <th>Company</th>
        </tr>
        </thead>
        <tbody id="table-body2">
        <?php
                            while ($rowMA = $resultMA->fetch_assoc()) {
                                echo "
                                <tr>
                                    <td>$rowMA[que_no]</td>
                                    <td>$rowMA[company]</td>
                                </tr>
                                ";
                            }
                        ?>

        </tbody>
    </table>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="container p-5 my-5 bg-light text-black custom-shadow custom-container2"><h3>Terminal</h3>
    <table class="table table-borderless">
        <thead>
        <tr>
            <th>Code</th>
            <th>Company</th>
        </tr>
        </thead>
        <tbody id="table-body3">
        <?php
                            while ($rowTE = $resultTE->fetch_assoc()) {
                                echo "
                                <tr>
                                    <td>$rowTE[que_no]</td>
                                    <td>$rowTE[company]</td>
                                </tr>
                                ";
                            }
                        ?>

        </tbody>
    </table>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="container p-5 my-5 bg-light text-black custom-shadow custom-container2"><h3>Data Encoding</h3>
    <table class="table table-borderless">
        <thead>
        <tr>
            <th>Code</th>
            <th>Company</th>
        </tr>
        </thead>
        <tbody id="table-body4">
        <?php
                            while ($rowDE = $resultDE->fetch_assoc()) {
                                echo "
                                <tr>
                                    <td>$rowDE[que_no]</td>
                                    <td>$rowDE[company]</td>
                                </tr>
                                ";
                            }
                        ?>

        </tbody>
    </table>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="container p-5 my-5 bg-light text-black custom-shadow custom-container2"><h3>Assessment</h3>
    <table class="table table-borderless">
        <thead>
        <tr>
            <th>Code</th>
            <th>Company</th>
        </tr>
        </thead>
        <tbody id="table-body5">
        <?php
                            while ($rowAS = $resultAS->fetch_assoc()) {
                                echo "
                                <tr>
                                    <td>$rowAS[que_no]</td>
                                    <td>$rowAS[company]</td>
                                </tr>
                                ";
                            }
                        ?>

        </tbody>
    </table>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="container p-5 my-5 bg-light text-black custom-shadow custom-container2"><h3>Collection</h3>
    <table class="table table-borderless">
        <thead>
        <tr>
            <th>Code</th>
            <th>Company</th>
        </tr>
        </thead>
        <tbody id="table-body6">
        <?php
                            while ($rowCO = $resultAS->fetch_assoc()) {
                                echo "
                                <tr>
                                    <td>$rowCO[que_no]</td>
                                    <td>$rowCO[company]</td>
                                </tr>
                                ";
                            }
                        ?>

        </tbody>
    </table>
    </div>
  </div>
  </div>
</div>

<script src="../monitoring/refreshMonitor.js"></script>
