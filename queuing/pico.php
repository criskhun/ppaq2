<?php
    include("../designPage/headerLogin.php");
    include("../dashboard/navbar.php");
?>


<?php
//this is where you get the value from the pacd page
if(isset($_POST['submitBtnPICO'])) {
    $picoValue = $_POST['pacdToPass'];
    //echo "Value passed from previous page: " . $picoValue;
}
?>

<div class="container mt-5">
    <div class="card-container row justify-content-center">
        <div class="card col-md-4 custom-card" style="width: 400px;">
            <img class="card-img-top-custom" src="../images/accesspass.jpg" alt="Card Image" width="100%">
            <div class="card-body">
            <h4 class="card-title">Access Pass</h4>
            <p class="card-text" id="cardText">Access Pass</p>
            <form action="../queuing/picoServices.php" method="POST">
                <input type="hidden" name="accessPassToPass" value="Access Pass">
                <input type="hidden" name="pacdToPass" value="<?php echo isset($_POST['pacdToPass']) ? $_POST['pacdToPass'] : ''; ?>">
                <button type="submit" class="btn btn-primary" name="submitBtnAccessPass"><i class="fa-solid fa-caret-right"></i> Access Pass</button>
            </form>
            </div>
        </div>
        <div class="card col-md-4 custom-card" style="width: 400px;">
            <img class="card-img-top-custom" src="../images/marine.jpg" alt="Card Image" width="100%">
            <div class="card-body">
            <h4 class="card-title">Marine</h4>
            <p class="card-text" id="cardText">Marine</p>
            <form action="../queuing/picoServices.php" method="POST">
                <input type="hidden" name="accessPassToPass" value="Marine">
                <input type="hidden" name="pacdToPass" value="<?php echo isset($_POST['pacdToPass']) ? $_POST['pacdToPass'] : ''; ?>">
                <button type="submit" class="btn btn-primary" name="submitBtnAccessPass"><i class="fa-solid fa-caret-right"></i> Marine</button>
            </form>
            </div>
        </div>
        <div class="card col-md-4 custom-card" style="width: 400px;">
            <img class="card-img-top-custom" src="../images/terminal.jpg" alt="Card Image" width="100%">
            <div class="card-body">
            <h4 class="card-title">Terminal</h4>
            <p class="card-text" id="cardText">Terminal</p>
            <form action="../queuing/picoServices.php" method="POST">
                <input type="hidden" name="accessPassToPass" value="Terminal">
                <input type="hidden" name="pacdToPass" value="<?php echo isset($_POST['pacdToPass']) ? $_POST['pacdToPass'] : ''; ?>">
                <button type="submit" class="btn btn-primary" name="submitBtnAccessPass"><i class="fa-solid fa-caret-right"></i> Terminal</button>
            </form>
            </div>
        </div>
        <div class="card col-md-4 custom-card" style="width: 400px;">
            <img class="card-img-top-custom" src="../images/encoding.jpg" alt="Card Image" width="100%">
            <div class="card-body">
            <h4 class="card-title">Data Encoding</h4>
            <p class="card-text" id="cardText">Data Encoding</p>
            <form action="../queuing/picoServices.php" method="POST">
                <input type="hidden" name="accessPassToPass" value="Data Encoding">
                <input type="hidden" name="pacdToPass" value="<?php echo isset($_POST['pacdToPass']) ? $_POST['pacdToPass'] : ''; ?>">
                <button type="submit" class="btn btn-primary" name="submitBtnAccessPass"><i class="fa-solid fa-caret-right"></i> Data Encoding</button>
            </form>
            </div>
        </div>
        <div class="card col-md-4 custom-card" style="width: 400px;">
            <img class="card-img-top-custom" src="../images/assessment.jpg" alt="Card Image" width="100%">
            <div class="card-body">
            <h4 class="card-title">Assessment</h4>
            <p class="card-text" id="cardText">Assessment</p>
            <form action="../queuing/picoServices.php" method="POST">
                <input type="hidden" name="accessPassToPass" value="Assessment">
                <input type="hidden" name="pacdToPass" value="<?php echo isset($_POST['pacdToPass']) ? $_POST['pacdToPass'] : ''; ?>">
                <button type="submit" class="btn btn-primary" name="submitBtnAccessPass"><i class="fa-solid fa-caret-right"></i> Assessment</button>
            </form>
            </div>
        </div>
        <div class="card col-md-4 custom-card" style="width: 400px;">
            <img class="card-img-top-custom" src="../images/collection.jpg" alt="Card Image" width="100%">
            <div class="card-body">
            <h4 class="card-title">Collection</h4>
            <p class="card-text" id="cardText">Collection</p>
            <form action="../queuing/picoServices.php" method="POST">
                <input type="hidden" name="accessPassToPass" value="Collection">
                <input type="hidden" name="pacdToPass" value="<?php echo isset($_POST['pacdToPass']) ? $_POST['pacdToPass'] : ''; ?>">
                <button type="submit" class="btn btn-primary" name="submitBtnAccessPass"><i class="fa-solid fa-caret-right"></i> Collection</button>
            </form>
            </div>
        </div>
    </div>
</div>


<?php
    include("../dashboard/footer.php");
?>