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
            <img class="card-img-top-custom" src="../images/ad.jpg" alt="Card Image" width="100%">
            <div class="card-body">
            <h4 class="card-title">ADMIN DIVISION</h4>
            <p class="card-text" id="cardText">Administrative Division</p>
            <form action="../queuing/picoServices.php" method="POST">
                <input type="hidden" name="accessPassToPass" value="Admin">
                <input type="hidden" name="pacdToPass" value="<?php echo isset($_POST['pacdToPass']) ? $_POST['pacdToPass'] : ''; ?>">
                <button type="submit" class="btn btn-primary" name="submitBtnAccessPass"><i class="fa-solid fa-caret-right"></i> Admin</button>
            </form>
            </div>
        </div>
        <div class="card col-md-4 custom-card" style="width: 400px;">
            <img class="card-img-top-custom" src="../images/esd.jpg" alt="Card Image" width="100%">
            <div class="card-body">
            <h4 class="card-title">ENGINEERING DIVISION</h4>
            <p class="card-text" id="cardText">Engineering Services Division</p>
            <form action="../queuing/picoServices.php" method="POST">
                <input type="hidden" name="accessPassToPass" value="Engineering">
                <input type="hidden" name="pacdToPass" value="<?php echo isset($_POST['pacdToPass']) ? $_POST['pacdToPass'] : ''; ?>">
                <button type="submit" class="btn btn-primary" name="submitBtnAccessPass"><i class="fa-solid fa-caret-right"></i> Engineering</button>
            </form>
            </div>
        </div>
        <div class="card col-md-4 custom-card" style="width: 400px;">
            <img class="card-img-top-custom" src="../images/fd.jpg" alt="Card Image" width="100%">
            <div class="card-body">
            <h4 class="card-title">FINANCE DIVISION</h4>
            <p class="card-text" id="cardText">Finance Division</p>
            <form action="../queuing/picoServices.php" method="POST">
                <input type="hidden" name="accessPassToPass" value="Finance">
                <input type="hidden" name="pacdToPass" value="<?php echo isset($_POST['pacdToPass']) ? $_POST['pacdToPass'] : ''; ?>">
                <button type="submit" class="btn btn-primary" name="submitBtnAccessPass"><i class="fa-solid fa-caret-right"></i> Finance</button>
            </form>
            </div>
        </div>
        <div class="card col-md-4 custom-card" style="width: 400px;">
            <img class="card-img-top-custom" src="../images/opm.jpg" alt="Card Image" width="100%">
            <div class="card-body">
            <h4 class="card-title">OPM</h4>
            <p class="card-text" id="cardText">Office of the Port Manager</p>
            <div class="row">
                <div class="col-md-4">
                    <form action="../queuing/picoServices.php" method="POST">
                        <input type="hidden" name="accessPassToPass" value="OPM-Legal">
                        <input type="hidden" name="pacdToPass" value="<?php echo isset($_POST['pacdToPass']) ? $_POST['pacdToPass'] : ''; ?>">
                        <button type="submit" class="btn btn-primary" name="submitBtnAccessPass"><i class="fa-solid fa-caret-right"></i> Legal</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <form action="../queuing/picoServices.php" method="POST">
                        <input type="hidden" name="accessPassToPass" value="OPM-Permits">
                        <input type="hidden" name="pacdToPass" value="<?php echo isset($_POST['pacdToPass']) ? $_POST['pacdToPass'] : ''; ?>">
                        <button type="submit" class="btn btn-primary" name="submitBtnAccessPass"><i class="fa-solid fa-caret-right"></i> Permits</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <form action="../queuing/picoServices.php" method="POST">
                        <input type="hidden" name="accessPassToPass" value="OPM-Records">
                        <input type="hidden" name="pacdToPass" value="<?php echo isset($_POST['pacdToPass']) ? $_POST['pacdToPass'] : ''; ?>">
                        <button type="submit" class="btn btn-primary" name="submitBtnAccessPass"><i class="fa-solid fa-caret-right"></i> Records</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <div class="card col-md-4 custom-card" style="width: 400px;">
            <img class="card-img-top-custom" src="../images/ppd.jpg" alt="Card Image" width="100%">
            <div class="card-body">
            <h4 class="card-title">PORT POLICE DIVISION</h4>
            <p class="card-text" id="cardText">Port Police Division</p>
            <form action="../queuing/picoServices.php" method="POST">
                <input type="hidden" name="accessPassToPass" value="Port Police">
                <input type="hidden" name="pacdToPass" value="<?php echo isset($_POST['pacdToPass']) ? $_POST['pacdToPass'] : ''; ?>">
                <button type="submit" class="btn btn-primary" name="submitBtnAccessPass"><i class="fa-solid fa-caret-right"></i> Port Police</button>
            </form>
            </div>
        </div>
        <div class="card col-md-4 custom-card" style="width: 400px;">
            <img class="card-img-top-custom" src="../images/collection.jpg" alt="Card Image" width="100%">
            <div class="card-body">
            <h4 class="card-title">PORT SERVICES DIVISION</h4>
            <p class="card-text" id="cardText">Port Police Division</p>
            <form action="../queuing/picoServices.php" method="POST">
                <input type="hidden" name="accessPassToPass" value="Port Services">
                <input type="hidden" name="pacdToPass" value="<?php echo isset($_POST['pacdToPass']) ? $_POST['pacdToPass'] : ''; ?>">
                <button type="submit" class="btn btn-primary" name="submitBtnAccessPass"><i class="fa-solid fa-caret-right"></i> Port Services</button>
            </form>
            </div>
        </div>
    </div>
</div>

<?php
    include("../dashboard/footer.php");
?>