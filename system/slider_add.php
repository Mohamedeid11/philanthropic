<?php
include("config.php");
include 'models/Slider.php';
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {

    $errors = array();

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {

        $sliderObj = new Slider();
        $id = $sliderObj->create([
            'display' => 1,
            'date' => date('Y-m-d'),
        ]);
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ''){


            $image_name    = $_FILES['image']['name'];
            $image_temp    = $_FILES['image']['tmp_name'];


            $target_dir  = "api/uploads/slider/" . $id ;
            $target_file = $target_dir . "/" . basename($_FILES["image"]["name"]);



//            $get_image_ext = explode('.' , $image_name);
//            $image_ext     = strtolower(end($get_image_ext));
//
//            if (strtolower($image_ext) == 'png') {
//                $source = imagecreatefrompng($image_temp);
//            }
//
//            if (strtolower($image_ext) == 'jpg' || strtolower($image_ext) == 'jpeg') {
//                $source = imagecreatefromjpeg($image_temp);
//            }
//
//            list($width_min, $height_min) = getimagesize($image_temp);
//            $newWidth = 350;
//            $newHeight = ($newWidth / $width_min) * $height_min;
//
//            $tmp_min = imagecreatetruecolor($newWidth, $newHeight);
//
//            imagecopyresampled($tmp_min, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width_min, $height_min);
//            imagejpeg($tmp_min, $target_file, 50);

            if (!file_exists($target_dir)){
                mkdir($target_dir , 0777 , true);
            }
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $msg = "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
            }

            $image_path = $site_url . $target_dir . '/' . $image_name;
            $image_database = $site_url . $target_dir ."/"  . $image_name;

            $sliderObj->update([
                'image' => $image_database,
                'id' => $id
            ]);
        }

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
                <h4 class="page-title"><?php echo trans('slider'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="slider_view.php"><?php echo trans('slider'); ?></a>
                    </li>
                    <li class="active">
                        <?php echo trans('addSlider'); ?>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" data-parsley-validate novalidate>

                        <div class="clearfix"></div>

                        <div class="form-group m-b-0">
                            <label class="control-label"> <?php echo trans('image'); ?>*</label>
                            <input type="file"  name="image" id="image" class="filestyle" multiple data-buttonname="btn-primary">
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