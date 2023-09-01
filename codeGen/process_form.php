<?php
if(isset($_POST['submit'])) {
    $docCode = 'SSG-'. $formattedCodeSeries ."-". $year;
    $docTitle = $_POST['title'];
    $sender = $_POST['sender'];
    $docType = $_POST['doctype'];
    $urgent = $_POST['urgentlvl'];
    $date = $_POST['reminder'];
    $comment = $_POST['comment'];

    $fname = rand(1000,1000). "-" .$_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    $uploads_dir = '../codes';
    move_uploaded_file($tname, $uploads_dir.'/'.$fname);

    $sql = "INSERT INTO documentCG_tbl (docCode, title, sender, doctype, urgent, docdate, comment, docfile) VALUES ('$docCode', '$docTitle', '$sender', '$docType', '$urgent', '$date', '$comment', '$fname')";

    if(mysqli_query($conn,$sql)){
        
        header('Location: codeGen.php');
    exit;
    }
    else {
        echo "Error";
    }

}
?>