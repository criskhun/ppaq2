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
?>

<div class="row" style="margin-left: 20px; margin-right: 20px;">
  <div class="col">
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
        <input type="file" class="form-control" id="file" name="file">
        <label for="file">Select a File</label>
    </div>
  </div>
  <div class="col">.col

  </div>
</div>