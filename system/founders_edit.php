<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
include 'models/Founders.php';

?>

<?php
// error_reporting(0);

$founderObj = new Founders();

if (isset($_POST['founder_update'])) {

    $id = $_POST['id_update'];
    $name_ar = mysqli_real_escape_string($con, trim($_POST['name_ar']));
    $name_en = mysqli_real_escape_string($con, trim($_POST['name_en']));
    $position_ar = mysqli_real_escape_string($con, trim($_POST['position_ar']));
    $position_en = mysqli_real_escape_string($con, trim($_POST['position_en']));

    $founder = $founderObj->getById($id);

    $errors = array();

    if (empty($name_ar || $name_en || $position_ar || $position_en)) {
        $errors[] = "Please enter all fields!";
    } elseif (strlen($name_ar) < 3 || strlen($name_ar) > 100) {
        $errors[] = "Field Name ar must be between 3, 100 characters";
    }elseif (strlen($name_en) < 3 || strlen($name_en) > 100) {
        $errors[] = "Field Name EN must be between 3, 100 characters";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {
        if (isset($_FILES['image_update']['name']) && $_FILES['image_update']['name'] != '') {

            $target_dir = "api/uploads/founders/" . $id;
            $target_file = $target_dir . "/" . basename($_FILES["image_update"]["name"]);

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }


            if ($founder['image']) {
                $name = strstr($founder['image'], 'api/');
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

            $founderObj->update([
                'image' => $image_database,
                'id' => $id
            ]);

        }


        $update = $founderObj->update([
            'id' => $id,
            'name_ar' => $name_ar,
            'name_en' => $name_en,
            'position_ar' => $position_ar,
            'position_en' => $position_en,
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
                <h4 class="page-title"> <?php echo trans('founders'); ?> </h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="founders_view.php?lang=<?php echo $lang; ?>"><?php echo trans('founders'); ?>  </a>
                    </li>
                    <li class="active">
                        <?php echo trans('edit_founder'); ?>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <?php
                    if (isset($_GET['founder_id'])) {
                        $row_select = $founderObj->getById($_GET['founder_id']);

                        $id = $row_select['id'];
                        $name_ar = $row_select['name_ar'];
                        $name_en = $row_select['name_en'];
                        $position_ar = $row_select['position_ar'];
                        $position_en = $row_select['position_en'];
                        $image = $row_select['image'];

                        if ($row_select) {
                            ?>

                            <form method="POST" enctype="multipart/form-data" data-parsley-validate novalidate>

                                <input type="hidden" name="id_update" id="id_update" parsley-trigger="change"  value="<?php echo $id; ?>" class="form-control">

                                <div class="form-group col-md-3">
                                    <label for="name_ar"><?php echo trans('name_ar'); ?></label>
                                    <input value="<?php echo $name_ar; ?>" name="name_ar" required class="form-control">

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="name_en"><?php echo trans('name_en'); ?></label>
                                    <input value="<?php echo $name_en; ?>" name="name_en" required class="form-control">

                                </div>

                                <div class="clearfix"></div>

                                <div class="form-group col-md-3">
                                    <label for="position_ar"><?php echo trans('position_ar'); ?></label>
                                    <input value="<?php echo $position_ar; ?>" name="position_ar" required class="form-control">

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="position_en"><?php echo trans('position_en'); ?></label>
                                    <input value="<?php echo $position_en; ?>" name="position_en" required class="form-control">

                                </div>

                                <div class="clearfix"></div>

                                <div class="gal-detail thumb getImage">
                                    <a href="<?php echo $image; ?>" class="image-popup" title="<?php echo $id; ?>">
                                        <img src="<?php echo $image; ?>" class="thumb-img" alt="<?php echo $id; ?>" style="display: block !important;" height="40" width="40">
                                    </a>
                                </div>
                                <div class="form-group m-b-0">
                                    <label class="control-label"> <?php echo trans('image'); ?>*</label>
                                    <input type="file"  name="image_update" id="image_update" class="filestyle" multiple data-buttonname="btn-primary">
                                </div>
                                <br />

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="text-center p-20">
                                            <button type="reset" class="btn w-sm btn-white waves-effect"><?php echo trans('cancel'); ?></button>
                                            <button type="submit" name="founder_update" class="btn w-sm btn-default waves-effect waves-light"><?php echo trans('update'); ?></button>
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