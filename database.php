<?php
    $db_server = "";
    $db_user = "u854000491_root";
    $db_pass = "Letmein123";
    $db_name = "u854000491_csms";
    $conn = "";

    try{
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    }
    catch(mysqli_sql_exception){
        echo "You could not connect! <br>";
    }
    if($conn){
        //echo "You are connected!";
    }
    ?>