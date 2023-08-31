<?php 

header("Access-Control-Allow-Origin: https://ppaq2.pmosocsargen.com");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

    session_start();
    include("headerCG.php");
    include("navBarCG.php");
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
    
        $conn->close(); // Close the database connection
    } else {
        echo "Database connection failed: " . mysqli_connect_error();
    }
    

    $year = date("Y");
?>


<div class="container justify-content-center align-item-center custom-container mt-3"> 
    <div class="row" id="rowrow">
        <div class="col">
            <div hidden>
            <input type="text" class="form-control" id="codeS" name="codeS" value="<?php echo $formattedCodeSeries; ?>">
            <input type="text" class="form-control" id="port" name="port" value="SSG">
            <input type="text" class="form-control" id="year" name="yesr" value="<?php echo $year; ?>">
            </div>
        
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" id="email" placeholder="Enter Document Title" name="title">
                <label for="title">Document Title</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="text" class="form-control" id="pwd" placeholder="Enter Sender Name" name="sender">
                <label for="pwd">Sender</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <select class="form-select" id="doctype" name="doctype">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
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
                <textarea class="form-control" id="comment" name="text" placeholder="Comment goes here"></textarea>
                <label for="comment">Comments</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input type="file" class="form-control" id="file" name="file">
                <label for="file">Select a File</label>
            </div>
            <button type="button" class="btn btn-primary" id="generateButton">Generate</button>
           
        </div>
        <div class="col">
            <div class="wrapper">
                <header>
                    <h1>QR Code Generator</h1>
                    <p>Paste a url or enter text to create QR code</p>
                </header>
                <div class="form">
                    <input type="text" spellcheck="false" id="codeHere" name="codeHere" placeholder="Enter text or url" value="SSG-<?php echo $formattedCodeSeries; ?>-<?php echo $year; ?>">
                    <button>Generate QR Code</button>
                </div>
                <div class="qr-code" id="canvas_id">
                    <img src="../images/example.png" alt="qr-code" id="qrImage">
                </div>
                <div id="trytry">
                    <img src="../images/example.png" alt="">
                </div>
            </div>

    
        </div>
        <a id="download">Download</a>
    </div>
    
</div>


<script>
    const wrapper = document.querySelector(".wrapper"),
  qrInput = wrapper.querySelector(".form input"),
  generateBtn = wrapper.querySelector(".form button"),
  qrImg = wrapper.querySelector(".qr-code img");
let preValue;

generateBtn.addEventListener("click", () => {
  let qrValue = qrInput.value.trim();
  if (!qrValue || preValue === qrValue) return;
  preValue = qrValue;
  generateBtn.innerText = "Generating QR Code...";
  
  // Update the QR code URL to include response-content-disposition parameter
  qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}&response-content-disposition=attachment%3B+filename%3Dqr_code.png`;

  qrImg.addEventListener("load", () => {
    console.log("QR code image loaded.");
    wrapper.classList.add("active");
    generateBtn.innerText = "Generate QR Code";
  });
});

qrInput.addEventListener("keyup", () => {
  if (!qrInput.value.trim()) {
    wrapper.classList.remove("active");
    preValue = "";
  }
});

</script>