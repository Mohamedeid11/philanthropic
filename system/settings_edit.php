<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
include 'models/Setting.php';

?>

<?php
// error_reporting(0);

$settingObj = new Setting();

if (isset($_POST['setting_update'])) {

    $id = $_POST['id_update'];
    $android_version = mysqli_real_escape_string($con, trim($_POST['android_version']));
    $android_link = mysqli_real_escape_string($con, trim($_POST['android_link']));
    $ios_version = mysqli_real_escape_string($con, trim($_POST['ios_version']));
    $ios_link = mysqli_real_escape_string($con, trim($_POST['ios_link']));
    $copyright_name_en = mysqli_real_escape_string($con, trim($_POST['copyright_name_en']));
    $copyright_name_ar = mysqli_real_escape_string($con, trim($_POST['copyright_name_ar']));
    $copyright_link = mysqli_real_escape_string($con, trim($_POST['copyright_link']));
    $facebook = mysqli_real_escape_string($con, trim($_POST['facebook']));
    $instgram = mysqli_real_escape_string($con, trim($_POST['instgram']));
    $twitter = mysqli_real_escape_string($con, trim($_POST['twitter']));


    $setting = $settingObj->getById($id);

    $errors = array();

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {
        if (isset($_FILES['header_logo']['name']) && $_FILES['header_logo']['name'] != '') {

            $target_dir = "api/uploads/settings/header_logo";
            $target_file = $target_dir . "/" . basename($_FILES["header_logo"]["name"]);

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }


            if ($setting['header_logo']) {
                $name = strstr($setting['header_logo'], 'api/');
                if (is_file($name)) {
                    unlink($name);
                }
            }

            if (move_uploaded_file($_FILES["header_logo"]["tmp_name"], $target_file)) {
                $msg = "The file " . basename($_FILES["header_logo"]["name"]) . " has been uploaded.";
            }

            $header_logo_name_update = $_FILES['header_logo']['name'];
            $header_logo_tmp_update = $_FILES['header_logo']['tmp_name'];

            $header_logo_path = $site_url . $target_dir . '/' . $header_logo_name_update;
            $header_logo_database = $site_url . $target_dir ."/"  . $header_logo_name_update;

            $settingObj->update([
                'header_logo' => $header_logo_database,
                'id' => $id
            ]);

        }

        if (isset($_FILES['footer_logo']['name']) && $_FILES['footer_logo']['name'] != '') {

            $target_dir = "api/uploads/settings/footer_logo";
            $target_file = $target_dir . "/" . basename($_FILES["footer_logo"]["name"]);

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }


            if ($setting['footer_logo']) {
                $name = strstr($setting['footer_logo'], 'api/');
                if (is_file($name)) {
                    unlink($name);
                }
            }

            if (move_uploaded_file($_FILES["footer_logo"]["tmp_name"], $target_file)) {
                $msg = "The file " . basename($_FILES["footer_logo"]["name"]) . " has been uploaded.";
            }

            $footer_logo_name_update = $_FILES['footer_logo']['name'];
            $footer_logo_tmp_update = $_FILES['footer_logo']['tmp_name'];

            $footer_logo_path = $site_url . $target_dir . '/' . $footer_logo_name_update;
            $footer_logo_database = $site_url . $target_dir ."/"  . $footer_logo_name_update;

            $settingObj->update([
                'footer_logo' => $footer_logo_database,
                'id' => $id
            ]);

        }


        $update = $settingObj->update([
            'id' => $id,
            'android_version' => $android_version,
            'android_link' => $android_link,
            'ios_version' => $ios_version,
            'ios_link' => $ios_link,
            'copyright_name' => $copyright_name,
            'copyright_link' => $copyright_link,
            'facebook' => $facebook,
            'instgram' => $instgram,
            'twitter' => $twitter,
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
                <h4 class="page-title"> <?=  trans('settings'); ?> </h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="categories_view.php?lang=<?=  $lang; ?>"><?=  trans('settings'); ?>  </a>
                    </li>
                    <li class="active">
                        <?=  trans('settings'); ?>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <?php
                    if (isset($_GET['setting_id'])) {
                        $row_select = $settingObj->getById($_GET['setting_id']);

                        $id = $row_select['id'];
                        $android_version = $row_select['android_version'];
                        $android_link = $row_select['android_link'];
                        $ios_version = $row_select['ios_version'];
                        $ios_link = $row_select['ios_link'];
                        $copyright_name_en = $row_select['copyright_name_en'];
                        $copyright_name_ar = $row_select['copyright_name_ar'];
                        $copyright_link = $row_select['copyright_link'];
                        $facebook = $row_select['facebook'];
                        $instgram = $row_select['instgram'];
                        $twitter = $row_select['twitter'];
                        $header_logo = $row_select['header_logo'];
                        $footer_logo = $row_select['footer_logo'];

                        if ($row_select) {
                            ?>

                            <form method="POST" enctype="multipart/form-data" data-parsley-validate novalidate>

                                <input type="hidden" name="id_update" id="id_update" parsley-trigger="change"  value="<?=  $id; ?>" class="form-control">

<!--                                <div class="form-group col-md-4">-->
<!--                                    <label for="android_version">--><?//=  trans('android_version'); ?><!--</label>-->
<!--                                    <input value="--><?//=  $android_version; ?><!--" name="android_version"  class="form-control">-->
<!--                                </div>-->
<!---->
<!--                                <div class="form-group col-md-8">-->
<!--                                    <label for="android_link">--><?//=  trans('android_link'); ?><!--</label>-->
<!--                                    <input value="--><?//=  $android_link; ?><!--" name="android_link"  class="form-control">-->
<!--                                </div>-->
<!---->
<!--                                <div class="clearfix"></div>-->
<!---->
<!--                                <div class="form-group col-md-4">-->
<!--                                    <label for="ios_version">--><?//=  trans('ios_version'); ?><!--</label>-->
<!--                                    <input value="--><?//=  $ios_version; ?><!--" name="ios_version"  class="form-control">-->
<!--                                </div>-->
<!---->
<!--                                <div class="form-group col-md-8">-->
<!--                                    <label for="ios_link">--><?//=  trans('ios_link'); ?><!--</label>-->
<!--                                    <input value="--><?//=  $ios_link; ?><!--" name="ios_link"  class="form-control">-->
<!--                                </div>-->
<!---->
<!--                                <div class="clearfix"></div>-->

                                <div class="form-group col-md-4" >
                                    <label><?= trans('copyright_name_en'); ?></label>
                                    <textarea name="copyright_name_en" class="form-control"> <?= $copyright_name_en; ?></textarea>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><?= trans('copyright_name_ar'); ?></label>
                                    <textarea name="copyright_name_ar" class="form-control"> <?= $copyright_name_ar; ?></textarea>
                                </div>

                                <div class="form-group col-md-8">
                                    <label for="copyright_link"><?=  trans('copyright_link'); ?></label>
                                    <input value="<?=  $copyright_link; ?>" name="copyright_link"  class="form-control">
                                </div>

                                <div class="form-group col-md-5">
                                    <label for="facebook"><?=  trans('facebook'); ?></label>
                                    <input value="<?=  $facebook; ?>" name="facebook"  class="form-control">
                                </div>

                                <div class="form-group col-md-5">
                                    <label for="instgram"><?=  trans('instagram'); ?></label>
                                    <input value="<?=  $instgram; ?>" name="instgram"  class="form-control">
                                </div>

                                <div class="form-group col-md-5">
                                    <label for="twitter"><?=  trans('twitter'); ?></label>
                                    <input value="<?= $twitter; ?>" name="twitter"  class="form-control">
                                </div>
                                <hr>
                                <br/>
                                <div class="clearfix"></div>

                                <div class="gal-detail thumb getlogo">
                                    <a href="<?=  $header_logo; ?>" class="logo-popup" title="<?= $id; ?>">
                                        <img src="<?=  $header_logo; ?>" class="thumb-img" alt="<?= $id; ?>" style="    height="40" width="40">
                                    </a>
                                </div>
                                <div class="form-group m-b-0">
                                    <label class="control-label"> <?=  trans('header_logo'); ?>*</label>
                                    <input type="file"  name="header_logo" id="header_logo" class="filestyle" multiple data-buttonname="btn-primary">
                                </div>

                                <br />

                                <div class="gal-detail thumb get footer_logo">
                                    <a href="<?=  $footer_logo; ?>" class="footer_logo-popup" title="<?= $id; ?>">
                                        <img src="<?=  $footer_logo; ?>" class="thumb-img" alt="<?= $id; ?>" style="    height="40" width="40">
                                    </a>
                                </div>
                                <div class="form-group m-b-0">
                                    <label class="control-label"> <?=  trans('footer_logo'); ?>*</label>
                                    <input type="file"  name="footer_logo" id="footer_logo" class="filestyle" multiple data-buttonname="btn-primary">
                                </div>

                                <br />
                                <div class="clearfix"></div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="text-center p-20">
                                            <button type="reset" class="btn w-sm btn-white waves-effect"><?=  trans('cancel'); ?></button>
                                            <button type="submit" name="setting_update" class="btn w-sm btn-default waves-effect waves-light"><?=  trans('update'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>



</div>
</div>
<?php include("include/footer_text.php"); ?>

<?php include("include/footer.php"); ?>

</body>
</html>