<?php
include("config.php");

include 'models/About.php';

if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
if (isset($_POST['submit'])) {

    $title_ar  = mysqli_real_escape_string($con, trim($_POST['title_ar']));
    $title_en  = mysqli_real_escape_string($con, trim($_POST['title_en']));
    $desc_en  = mysqli_real_escape_string($con, trim($_POST['desc_en']));
    $desc_ar  = mysqli_real_escape_string($con, trim($_POST['desc_ar']));

    $errors = array();

    if (empty($title_ar || $title_en)) {
        $errors[] = "Please enter all fields!";
    }elseif (strlen($title_ar) < 3 || strlen($title_ar) > 100) {
        $errors[] = "Field Name ar must be between 3, 100 characters";
    }elseif (strlen($title_en) < 3 || strlen($title_en) > 100) {
        $errors[] = "Field Name en must be between 3, 100 characters";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {

        $aboutObj = new About();
        $id = $aboutObj->create([
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'desc_en' => $desc_en,
            'desc_ar' => $desc_ar,
            'display' => 1,
            'date' => date('Y-m-d h:i'),
        ]);

        echo get_success("Added Successfully");
//        echo "<meta http-equiv='refresh' content='0'>";
    }
}
?>
<!DOCTYPE html>
<html>
<?php include("include/heads.php"); ?>
<?php include("include/leftsidebar.php"); ?>
<div class="wrapper">
    <div class="container">    <!-- Start content -->
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title"><?php echo trans('about'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="about_view.php"><?php echo trans('about'); ?></a>
                    </li>
                    <li class="active">
                        <?php echo trans('add_about'); ?>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" data-parsley-validate novalidate>

                        <div class="clearfix"></div>

                        <div class="form-group col-md-5">
                            <label for="title_en "><?php echo trans('title_en'); ?></label>
                            <input type="text" name="title_en" parsley-trigger="change" required placeholder="<?php echo trans('title_en'); ?>" class="form-control" >
                        </div>

                        <div class="form-group col-md-5">
                            <label for="title_ar "><?php echo trans('title_ar'); ?></label>
                            <input type="text" name="title_ar" parsley-trigger="change" required placeholder="<?php echo trans('title_ar'); ?>" class="form-control" >
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-md-5">
                            <label for="desc_en "><?php echo trans('desc_en'); ?></label>
                            <input type="text" name="desc_en" parsley-trigger="change" required placeholder="<?php echo trans('desc_en'); ?>" class="form-control" >
                        </div>

                        <div class="form-group col-md-5">
                            <label for="desc_ar "><?php echo trans('desc_ar'); ?></label>
                            <input type="text" name="desc_ar" parsley-trigger="change" required placeholder="<?php echo trans('desc_ar'); ?>" class="form-control" >
                        </div>

                        <div class="clearfix"></div>

                        <br />
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-center p-20">
                                    <button type="reset" class="btn w-sm btn-white waves-effect"><?php echo trans('cancel'); ?></button>
                                    <button type="submit" name="submit" class="btn w-sm btn-default waves-effect waves-light"><?php echo trans('add'); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include("include/footer_text.php"); ?>
<!-- END wrapper -->
<?php include("include/footer.php"); ?>
<script>
    $('.select2me').select2({
        placeholder: "Select",
        width: 'auto',
        allowClear: true
    });
</script>
<script>

    $(".select2, .select2-multiple").select2();

</script>

</body>
</html>