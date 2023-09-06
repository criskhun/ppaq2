<?php 
    include("headerCG.php");
    include("navBarCG.php");
    include("navBarMen.php");

    include "../codeGen/phpqrcode/qrlib.php";
                $PNG_TEMP_DIR = 'temp/';
                if (!file_exists($PNG_TEMP_DIR))
                mkdir($PNG_TEMP_DIR);

                $filelie = $PNG_TEMP_DIR . 'test.png';


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

    if(isset($_POST["submit"])){
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

        $docCode = 'SSG-'. $formattedCodeSeries ."-". $year;
        $docTitle = $_POST['title'];
        $sender = $_POST['sender'];
        $docType = $_POST['doctype'];
        $urgent = $_POST['urgentlvl'];
        $date = $_POST['reminder'];
        $comment = $_POST['comment'];

        if($_FILES["files"]["error"] === 4){
            echo
            "<script> alert('File Does Not Exist'); </script>"
            ;
        }
        else{
            $fileName = $_FILES["files"]["name"];
            $fileSize = $_FILES["files"]["size"];
            $tmpName = $_FILES["files"]["tmp_name"];

            $validFileExtension = ['jpg', 'jpeg', 'png', 'pdf'];
            $fileExtension = explode('.', $fileName);
            $fileExtension = strtolower(end($fileExtension));
           
            if(!in_array($fileExtension, $validFileExtension)){
                echo
                "<script> alert('Invalid File Extension'); </script>"
                ;
                echo "File Extension: $fileExtension<br>";
                echo "Valid Extensions: " . implode(', ', $validFileExtension) . "<br>";
            }
            else if($fileSize > 1000000){
                echo
                "<script> alert('File Size Too Large'); </script>"
                ;
            }
            else {
                $newFileName = $fileName;
                //$newFileName .= '.' . $fileExtension;
                $uploadDirectory = '../codeGen/file/';
                move_uploaded_file($tmpName, $uploadDirectory . $newFileName);

                $query = "INSERT INTO documentCG_tbl VALUES ('', '$docCode', '$docTitle', '$sender', '$docType', '$urgent', '$date', '$comment', '$newFileName')";
                mysqli_query($conn, $query);

                $codeString = $_POST["codeS"];

                $filelie = $PNG_TEMP_DIR . 'test' .
                md5($codeString) . '.png';

                QRcode::png($codeString, $filelie);

                echo '<img src="' . $PNG_TEMP_DIR .
                basename($filelie) . '" /><hr/>';

                echo
                "<script> 
                
                    alert('Successfully Added');
                    document.location.href = 'reportCG.php';
                 </script>"

                ;
            }
        }
    }
?>



<div class="row" style="margin-left: 20px; margin-right: 20px;">
  <div class="col">

  <form action="" class="form" method="post" autocomplete="off" enctype="multipart/form-data">
    <div hidden>
    <input type="text" class="form-control" id="codeS" name="codeS" value="<?php echo "SSG-" . $formattedCodeSeries . "-" . $year; ?>">
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
        <select class="form-select" id="sender" name="sender">
            <option>Administrative Division</option>
            <option>Engineering Services Division</option>
            <option>Finance Division</option>
            <option>Port Police Division</option>
            <option>Port Services Division</option>
            <option>Office of the Port Manager</option>
            <option>Others</option>
        </select>
        <label for="sender" class="form-label">Sender (select one):</label>
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
        <input type="file" class="form-control" id="files" name="files" accept=".jpg, .jpeg, .png, .pdf" value="">
        <label for="files">Select a File</label>
    </div>
    <button type="submit" name="submit">Submit</button>
    </form>
    <br>
    <a href="reportCG.php">Data</a>



  </div>

  <div class="col">.col

  </div>
</div>