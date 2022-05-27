<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
include "models/Setting.php";

$page = isset($_GET['page']) ? ucfirst($_GET['page']) : 'Settings';

if (isset($_POST['client_update'])) {

    $id     = $_POST['id'];
    $key    = $_POST['setting_key'];
    $value  = $_POST['setting_value'];

    $settingObj = new Setting();
    $setting = $settingObj->getById($id);

    $errors = array();

    var_dump($key, $value);

    if (empty($key) || empty($value)) {
        $errors[] = "Please enter all fields!";
    } elseif (strlen($key) < 3 || strlen($key) > 100) {
        $errors[] = "Field Key must be between 3, 100 characters";
    } elseif (strlen($value) < 3 || strlen($value) > 5000) {
        $errors[] = "Field Value must be between 3, 5000 characters";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {

        $settingObj = new Setting();
        $update = $settingObj->update([
            'id'    => $id,
            'key'   => $key,
            'value' => $value,
        ]);


        if ($update) {
            echo get_success(trans('updatedSuccessfully'));
        } else {
            echo get_error(trans('somethingWrong'));
        }
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
                <h4 class="page-title"><?php echo trans('settings'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="client_edit.php"><?php echo trans('settings'); ?></a>
                    </li>
                    <li class="active">
                        <?php echo trans('editSetting'); ?>
                    </li>
                </ol>
            </div>
        </div>
        <?php
        if (isset($_GET['id']) || isset($_GET['page'])) {

            $settingObj = new Setting();
            $row_select = isset($_GET['id']) ?
                $settingObj->getById($_GET['id']) :
                $settingObj->getByKey($_GET['page']);

            if ($row_select) {
                $id     = $row_select['id'];
                $key    = $row_select['key'];
                $value  = $row_select['value'];
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <form method="POST" enctype="multipart/form-data" data-parsley-validate novalidate>
                                <input type="hidden" name="id" id="client_id_update" parsley-trigger="change" required value="<?php echo $id; ?>" class="form-control">
                                <input type="hidden" name="setting_key" id="setting_key" parsley-trigger="change" required value="<?php echo $key; ?>" class="form-control">
                                <h3><?php echo trans('title') . ': ' . $key; ?></h3>
                                <div class="form-group col-md-9">
                                    <label for="setting_value"><?php echo trans('content'); ?></label>
                                    <textarea name="setting_value" id="setting_value" parsley-trigger="change" required class="form-control"><?php echo $value; ?></textarea>
                                </div>
                                <div class="clearfix"></div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="text-center p-20">
                                            <button type="reset" class="btn w-sm btn-white waves-effect"><?php echo trans('cancel'); ?></button>
                                            <button type="submit" name="client_update" class="btn w-sm btn-default waves-effect waves-light"><?php echo trans('update'); ?></button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
        ?>
                <h4 class="text-center">Sorry there is no <?php echo $page; ?> data</h4>
        <?php
            }
        }
        ?>


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