<div class="modal fade" id="myModalCG" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <input type="submit" class="btn btn-danger" style="margin: 10px" value="Logout" name="logout">
            </form>
            <!--<a href="../index.php" class="btn btn-danger" style="margin: 10px;">Logout</a>-->
        </div>
    </div>
</div>