<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
include 'models/Slider.php';

?>

<?php
// error_reporting(0);

$sliderObj = new Slider();

if (isset($_POST['slider_update'])) {

    $id = $_POST['id_update'];

    $slider = $sliderObj->getById($id);

    $errors = array();

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {
        if (isset($_FILES['image_update']['name']) && $_FILES['image_update']['name'] != '') {

            $target_dir = "api/uploads/slider/" . $id;
            $target_file = $target_dir . "/" . basename($_FILES["image_update"]["name"]);

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }


            if ($slider['image']) {
                $name = strstr($slider['image'], 'api/');
                if (is_file($name)) {
                    unlink($name);
                }
            }

            if (move_uploaded_file($_FILES["image_update"]["tmp_name"], $target_file)) {
                $msg = "The file " . basename($_FILES["image_update"]["name"]) . " has been uploaded.";
            }

            $image_name_update = $_FILES['image_update']['name'];
            $image_tmp_update = $_FILES['image_update']['tmp_name'];

            $image_path = $site_url . $target_dir . '/' . $image_name_update;
            $image_database = $site_url . $target_dir ."/"  . $image_name_update;

            $update = $sliderObj->update([
                'image' => $image_database,
                'id' => $id
            ]);

            if ($update) {
                echo get_success(trans('updatedSuccessfully'));
            } else {
                echo get_error(trans('somethingWrong'));
            }

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
                <h4 class="page-title"> <?= trans('slider'); ?> </h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="slider_view.php?lang=<?= $lang; ?>"><?= trans('slider'); ?>  </a>
                    </li>
                    <li class="active">
                        <?= trans('editSlider'); ?>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <?php
                    if (isset($_GET['slider_id'])) {
                        $row_select = $sliderObj->getById($_GET['slider_id']);

                        $id = $row_select['id'];
                        $image = $row_select['image'];

                        if ($row_select) {
                            ?>

                            <form method="POST" enctype="multipart/form-data" data-parsley-validate novalidate>

                                <input type="hidden" name="id_update" id="id_update" parsley-trigger="change"  value="<?= $id; ?>" class="form-control">


                                <div class="clearfix"></div>

                                <div class="gal-detail thumb getImage">
                                    <a href="<?= $image; ?>" class="image-popup" title="<?= $id; ?>">
                                        <img src="<?= $image; ?>" class="thumb-img" alt="<?= $id; ?>" style="display: block !important;" height="40" width="40">
                                    </a>
                                </div>
                                <div class="form-group m-b-0">
                                    <label class="control-label"> <?= trans('image'); ?>*</label>
                                    <input type="file"  name="image_update" id="image_update" class="filestyle" multiple data-buttonname="btn-primary">
                                </div>
                                <br />

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="text-center p-20">
                                            <button type="reset" class="btn w-sm btn-white waves-effect"><?= trans('cancel'); ?></button>
                                            <button type="submit" name="slider_update" class="btn w-sm btn-default waves-effect waves-light"><?= trans('update'); ?></button>
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

<script>
    // $(document).ready(function(){
    $("#navigation ul>li").removeClass("active");
    $("#item2").addClass("active");
    // })
</script>

</body>
</html>