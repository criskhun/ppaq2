<?php
    include("../designPage/headerLogin.php");
    include("../dashboard/navbar.php");

    if ($conn->connect_error) {
        die("Connection Failed: " .$conn->connect_error);
    }

    $sql4 = "SELECT * FROM deactiveUser_tbl ";
    $resultUsers = $conn->query($sql4);

    if (!$resultUsers) {
        die("Invalid query: " . $conn->error);
    }
    $countUsers = $resultUsers->num_rows;
?>


<div class="m-5">
<div class="container-fluid p-5 my-1 bg-light text-black">
    <div class="row">
        <div class="col-sm-12"><h3>In-active Users</h3>
        <p>Number of transaction: <?php echo $countUsers; ?></p>
            <div class="table-responsive">
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Surname</th>
                            <th>Birth Date</th>
                            <th>Mobile Number</th>
                            <th>Date Hire</th>
                            <th>Role</th>
                            <th>Designation</th>
                            <th class="action-column">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                            while ($rowUsers = $resultUsers->fetch_assoc()) {
                                echo "
                                <tr>
                                    <td>$rowUsers[email]</td>
                                    <td>$rowUsers[first_name]</td>
                                    <td>$rowUsers[midle_name]</td>
                                    <td>$rowUsers[surname]</td>
                                    <td>$rowUsers[birthdate]</td>
                                    <td>$rowUsers[phone]</td>
                                    <td>$rowUsers[date]</td>
                                    <td>$rowUsers[role]</td>
                                    <td>$rowUsers[designation]</td>
                                    <td class='action-cell'>
                                    <a class='btn btn-primary btn-sm' href='activate.php?id=$rowUsers[id]'><i class='fa-solid fa-user-slash'></i> Activate</a>
                                    </td>
                                </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>&per_page=<?php echo $itemsPerPage; ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </div>
                <div>
                    <label for="itemsPerPageSelect" class="me-2">Items per page:</label>
                    <select id="itemsPerPageSelect" class="form-select" onchange="location = '?page=1&per_page=' + this.value;">
                        <option value="10" <?php echo $itemsPerPage === 10 ? 'selected' : ''; ?>>10</option>
                        <option value="50" <?php echo $itemsPerPage === 50 ? 'selected' : ''; ?>>50</option>
                        <option value="100" <?php echo $itemsPerPage === 100 ? 'selected' : ''; ?>>100</option>
                        <option value="all" <?php echo $itemsPerPage === 'all' ? 'selected' : ''; ?>>Show All</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
    <!-- Pagination controls as before -->

    <div>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($page > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&per_page=<?php echo $itemsPerPage; ?>">Previous</a>
                    </li>
                <?php endif; ?>
                <?php if ($page < $totalPages) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&per_page=<?php echo $itemsPerPage; ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

            </div>
        </div>
    </div>
</div>
</div>
<script src="../users/refreshInActive.js"></script>
<?php
    include("../transaction/serveModal.php");
?> 