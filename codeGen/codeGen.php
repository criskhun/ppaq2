<?php 
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
?>

<div class="container justify-content-center align-item-center custom-container mt-3">
    <div class="row">
        <div class="col">
        <form action="/action_page.php">
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
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
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
            <button type="submit" class="btn btn-primary">Generate</button>
        </form>
        </div>
        <div class="col">

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#reminder').on('input', function() {
            let selectedDate = $(this).val();
            let parts = selectedDate.split('-'); // Split the date into parts
            if (parts.length === 3) {
                let formattedDate = parts[0] + '-' + parts[1].padStart(2, '0') + '-' + parts[2].padStart(2, '0');
                $(this).val(formattedDate);
            }
        });
    });
</script>

