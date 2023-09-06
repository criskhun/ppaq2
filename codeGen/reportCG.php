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
    

    $year = date("Y");
?>

<div class="container-fluid mt-5">
    <div class="accordion" id="accordionExample">

      <!-- Option 1 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Daily Process Log
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <!-- Your content for Option 1 here -->
            <div>
              <?php
                include("../codeGen/report/dailyDoc.php");
              ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Option 2 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Weekly Process Log
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <!-- Your content for Option 2 here -->
            <div>
              <?php
                include("../codeGen/report/weeklyDoc.php");
              ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Option 3 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Montly Process Log
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <!-- Your content for Option 3 here -->
            <div>
              <?php
                include("../codeGen/report/monthlyDoc.php");
              ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Option 4 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            Yearly Process Log
          </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <!-- Your content for Option 3 here -->
            <div>
              <?php
                include("../codeGen/report/yearlyDoc.php");
              ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Option 4 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            All Process Log
          </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <!-- Your content for Option 3 here -->
            <div>
              <?php
                include("../codeGen/report/reportDoc.php");
              ?>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script>
    $(document).ready(function() {
        // Function to update row count for a specific table
        function updateRowCount(tableId) {
            const visibleRowCount = $(`#${tableId} tbody tr:visible`).length;
            $(`#${tableId}-rowCount`).text(`Total rows: ${visibleRowCount}`);
        }

        // Example: Update row count for table1
        updateRowCount("tableBody");

        // Example: Update row count for table2
        updateRowCount("tableBodyDaily");
    });
</script>