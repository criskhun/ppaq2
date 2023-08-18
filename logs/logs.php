<?php
include("../designPage/headerLogin.php");
include("../dashboard/navbar.php");
?>

<div class="container-fluid mt-5">
    <div class="accordion" id="accordionExample">

      <!-- Option 1 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Transaction Log
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <!-- Your content for Option 1 here -->
            <div>
              <?php
                include("../logs/transactionLogTbl.php");
              ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Option 2 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            User Log
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <!-- Your content for Option 2 here -->
            <div>This is the content for Option 2.</div>
          </div>
        </div>
      </div>

      <!-- Option 3 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Report Log
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <!-- Your content for Option 3 here -->
            <div>This is the content for Option 3.</div>
          </div>
        </div>
      </div>

    </div>
  </div>

<?php
    include("../logs/footerLogs.php");
?>