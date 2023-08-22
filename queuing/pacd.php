<?php
    include("../designPage/headerLogin.php");
    include("../dashboard/navbar.php");
?>

<div class="container mt-3">

  <div class="card-container">
    <div class="card col-md-4" style="width:400px">
        <img class="card-img-top" src="../images/mainbkg.jpg" alt="Card image" style="width:100%">
        <div class="card-body">
        <h4 class="card-title">(PICO) SERVICE</h4>
        <p class="card-text">Port Services Clearance Office </p>
        <form action="../queuing/pico.php" method="POST">
            <input type="hidden" name="pacdToPass" value="PICO">
            <button type="submit" class="btn btn-primary" name="submitBtnPICO"><i class="fa-solid fa-caret-right"></i> Click to Proceed</button>
        </form>
        </div>
    </div>
    <div class="card col-md-4" style="width:400px">
        <img class="card-img-top" src="../images/mainbkg.jpg" alt="Card image" style="width:100%">
        <div class="card-body">
        <h4 class="card-title">EXTERNAL SERVICES</h4>
        <p class="card-text">External Transaction</p>
        <form action="../queuing/external.php" method="POST">
            <input type="hidden" name="pacdToPass" value="External">
            <button type="submit" class="btn btn-primary" name="submitBtnPICO"><i class="fa-solid fa-caret-right"></i> Click to Proceed</button>
        </form>
        </div>
    </div>
  </div>
</div>

<?php
    include("../dashboard/footer.php");
?>