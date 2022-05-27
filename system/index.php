<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <?php include("include/heads.php"); ?>
    <?php include("include/leftsidebar.php"); ?>
    <div class="wrapper">
        <div class="container">    <!-- Start content -->
            <!-- Page-Title -->

            <?php
            if ($_SESSION['user_role'] == 'admin') {
            ?>
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title"><?php echo trans('statics'); ?>  </h4>
                    </div>
                </div>
            <?php
                include("include/statics.php");
            }
            ?>

        </div>			
    </div>
    <?php include("include/footer_text.php"); ?>

    <?php include("include/footer.php"); ?>
</body>
</html>