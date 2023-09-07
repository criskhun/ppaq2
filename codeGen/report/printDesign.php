<?php

session_start();
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
// Get the filtered table data from the query parameter
$tableData = json_decode($_GET['tableData'], true);

$currentDate = date('Y-m-d'); 

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Generator</title>
    <link rel="stylesheet" href="print.css">
</head>
<body>
    <div class="page" size="A4">
        <div class="content">
        <div class="top-section">
            <div class="address">
                <div class="address-content">
                    <h2>PPA - PMO SOCSARGEN</h2>
                    <p>Makar Wharf, Labangal, General Santos City, 9500 Philippines</p>
                </div>
            </div>
            <div class="contact">
                <div class="contact-content">
                    <div class="email"> Email: <span class="span">pmosocsargen@ppa.com.ph</span></div>
                    <div class="number"> Number: <span class="span">(083) 552.4484</span></div>
                    <div class="fax"> Fax No.: <span class="span">(083) 552.4446</span></div>
                </div>
            </div>
        </div>
        <div class="billing-invoice">
            <div class="title">
                Document Report
            </div>
            <div class="des">
                <p class="code">
                    document code
                </p>
                <p class="issue"> Issued: <span> Date </span></p>
            </div>
        </div>
        <div class="billing-to">
            <div class="title"> Prepared by: </div>
            <div class="billed-sec">
                <div class="name">
                    <?php echo "{$sn}, {$fn} {$mn}";  ?>
                </div>
                <p> <?php echo $email; ?></p>
                <p> <?php echo $pn; ?> </p>
            </div>
    
            <div class="billed-sec">
                <div class="sub-title"> Role </div>
                <div class="ship-add"> <?php echo $role; ?> </div>
            </div>
        </div>
        <div class="table">
        <table>
            <tr>
            <th>#</th>
                <th>Document Code</th>
                <th>Title</th>
                <th>Sender</th>
                <th>Document Type</th>
                <th>Urgent</th>
                <th>Date</th>
                <th>Comment</th>
                <th>Document File</th>
            </tr>

            <!-- i want to replace the table content-->
            <?php
                
                foreach ($tableData as $rowData) {
                echo "<tr>";
                
                foreach ($rowData as $cellData) {
                echo "<td>" . $cellData . "</td>";
                }
                echo "</tr>";
                
                }
            ?>
        </table>
    </div>
    <div class="bottom-section">
        <div class="status-content">
            <h4> CodeGen </h4>
            <p> Division: <span> Office of the Port Manager</span></p>
            <p class="tnx"> This document was published on <?php $currentDate ?> </p>
        </div>
    </div>
    </div>
    </div>

</body>
</html>