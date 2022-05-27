<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {

    $key    = mysqli_real_escape_string($con, trim($_POST['key']));
    $value  = mysqli_real_escape_string($con, trim($_POST['value']));


    $errors = array();
    include 'models/Setting.php';
    $settingObj = new Setting();

    if (empty($key) || empty($value)) {
        $errors[] = "Please enter all fields!";
    } elseif (strlen($key) < 3 || strlen($key) > 100) {
        $errors[] = "Field Key must be between 3, 100 characters";
    } elseif (strlen($value) < 3 || strlen($value) > 5000) {
        $errors[] = "Field Value must be between 3, 5000 characters";
    } elseif ((bool)$settingObj->getByKey($key)) {
        $errors[] = "Field Key is already taken";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {

        $settingObj->create([
            'key'       => $key,
            'value'     => $value,
            'display'   => 1,
            'type'      => 'contact'
        ]);
        echo get_success(trans(trans('addedSuccessfully')));
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
                <h4 class="page-title"><?php echo trans('other'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="setting_add.php"><?php echo trans('other'); ?></a>
                    </li>
                    <li class="active">
                        <?php echo trans('addSetting'); ?>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" data-parsley-validate novalidate>
                        <div class="form-group col-md-3">
                            <label for="key"><?php echo trans('title'); ?></label>
                            <input type="text" name="key" value="<?php echo old('key'); ?>" parsley-trigger="change" required placeholder="<?php echo trans('key'); ?>" class="form-control" >
                        </div>
                        <div class="form-group col-md-9">
                            <label for="value"><?php echo trans('content'); ?></label>
                            <textarea type="text" name="value" value="<?php echo old('value'); ?>" parsley-trigger="change" required placeholder="<?php echo trans('value'); ?>" class="form-control" ></textarea>
                        </div>
                        <div class="clearfix"></div>
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

<?php include("include/footer.php"); ?>
<script>
    $('.select2me').select2({
        placeholder: "Select",
        width: 'auto',
        allowClear: true
    });
</script>

</body>
</html>