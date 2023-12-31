<?php 
    include("headerCG.php");
    include("navBarCG.php");
    include("navBarMen.php");
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
    

    if ($conn) {
        $sql = "SELECT COUNT(*) AS codeSeries FROM codeSeriesCG_tbl";
        $result = $conn->query($sql);
    
        if ($result) {
            $row = $result->fetch_assoc();
            $codeSeries = $row["codeSeries"];
    
            if ($codeSeries < 1) {
                $codeSeries = 1;
            } else {
                $codeSeries++;
            }
    
            if ($codeSeries < 10) {
                $formattedCodeSeries = sprintf("00%d", $codeSeries);
            } elseif ($codeSeries < 100) {
                $formattedCodeSeries = sprintf("0%d", $codeSeries);
            } else {
                $formattedCodeSeries = (string)$codeSeries;
            }
            // Use $codeSeries for further processing or database insertion
        } else {
            echo "Error fetching data: " . $conn->error;
        }
    
    } else {
        echo "Database connection failed: " . mysqli_connect_error();
    }
    

    $year = date("Y");
?>

<?php
if(isset($_POST['submit'])) {
    $docCode = 'SSG-'. $formattedCodeSeries ."-". $year;
    $docTitle = $_POST['title'];
    $sender = $_POST['sender'];
    $docType = $_POST['doctype'];
    $urgent = $_POST['urgentlvl'];
    $date = $_POST['reminder'];
    $comment = $_POST['comment'];

    $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/codes';

    if (!file_exists($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }

    $fname = rand(1000,1000). "-" .$_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    $destination_path = $uploads_dir . '/' . $fname;

    if(move_uploaded_file($tname, $destination_path)) {
        $sql = "INSERT INTO documentCG_tbl (docCode, title, sender, doctype, urgent, docdate, comment, docfile) VALUES ('$docCode', '$docTitle', '$sender', '$docType', '$urgent', '$date', '$comment', '$fname')";
        $sql = "INSERT INTO codeSeriesCG_tbl (code) VALUES ('$formattedCodeSeries')";
        if(mysqli_query($conn, $sql)){
            echo '<script>alert("File Successfully uploaded"); window.location.href = "codeGen.php";</script>';
            exit;
        } else {
            echo "Error";
        }
    } else {
        echo "File upload failed";
    }

}
?>

<div class="container justify-content-center align-item-center custom-container mt-3"> 
    <div class="row" id="rowrow">
        <div class="col">
        <form method="post" enctype="multipart/form-data" action="">
            <div hidden>
            <input type="text" class="form-control" id="codeS" name="codeS" value="<?php echo "SSG-" . $formattedCodeSeries . "-" . $year; ?>">
            <input type="text" class="form-control" id="port" name="port" value="SSG">
            <input type="text" class="form-control" id="year" name="yesr" value="<?php echo $year; ?>">
            </div>
        
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" id="tile" placeholder="Enter Document Title" name="title">
                <label for="title">Document Title</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="text" class="form-control" id="sender" placeholder="Enter Sender Name" name="sender">
                <label for="sender">Sender</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <select class="form-select" id="doctype" name="doctype">
                    <?php
                    
                    $sql = "SELECT doc FROM document_type_tbl";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $transactionName = $row["doc"];
                            $selected = ($transactionName === $defaultTransaction) ? "selected" : "";
                            echo "<option $selected>$transactionName</option>";
                        }
                    }
                    //$conn->close();
                    ?>
                </select>
                <label for="doctype" class="form-label">Select Document Type (select one):</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <select class="form-select" id="urgentlvl" name="urgentlvl">
                    <option>Impact</option>
                    <option>Urgent</option>
                    <option>Priority</option>
                </select>
                <label for="urgentlvl" class="form-label">Select Urgent Lvl (select one):</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="date" class="form-control" id="reminder" placeholder="Enter Date" name="reminder">
                <label for="reminder">Date</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <textarea class="form-control" id="comment" name="comment" placeholder="Comment goes here"></textarea>
                <label for="comment">Comments</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input type="file" class="form-control" id="file" name="file">
                <label for="file">Select a File</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary" id="generateButton">Save</button>
        </form>
        </div>
        <div class="col">
            <div class="wrapper">
                <header>
                    <h1>QR Code Generator</h1>
                    <p>This is the code for this document. Please Press Generate to get the QR Code</p>
                </header>
                <div class="form">
                    <input type="text" spellcheck="false" id="codeHere" name="codeHere" placeholder="Enter text or url" value="SSG-<?php echo $formattedCodeSeries; ?>-<?php echo $year; ?>" readonly>
                    <button>Generate QR Code</button>
                </div>
                
                <div class="qr-code" id="canvas_id">
                    <img src="../images/example.png" alt="qr-code" id="qrImage">
                </div>
            </div>
    
        </div>
    </div>
</div>

<script src="script.js"></script>
