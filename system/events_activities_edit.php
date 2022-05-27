<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
include 'models/EventActivity.php';

?>

<?php
// error_reporting(0);

$event_activityObj = new EventActivity();

if (isset($_POST['event_activity_update'])) {

    $id = $_POST['id_update'];
    $title_ar = mysqli_real_escape_string($con, trim($_POST['title_ar']));
    $title_en = mysqli_real_escape_string($con, trim($_POST['title_en']));
    $desc_en = mysqli_real_escape_string($con, trim($_POST['desc_en']));
    $desc_ar = mysqli_real_escape_string($con, trim($_POST['desc_ar']));

    $event_activity = $event_activityObj->getById($id);

    $errors = array();

    if (empty($title_ar || $title_en)) {
        $errors[] = "Please enter all fields!";
    } elseif (strlen($title_ar) < 3 || strlen($title_ar) > 100) {
        $errors[] = "Field Name ar must be between 3, 100 characters";
    }elseif (strlen($title_en) < 3 || strlen($title_en) > 100) {
        $errors[] = "Field Name EN must be between 3, 100 characters";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {
        if (isset($_FILES['image_update']['name']) && $_FILES['image_update']['name'] != '') {

            $target_dir = "api/uploads/events_activities/" . $id;
            $target_file = $target_dir . "/" . basename($_FILES["image_update"]["name"]);

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }


            if ($event_activity['image']) {
                $name = strstr($event_activity['image'], 'api/');
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

            $event_activityObj->update([
                'image' => $image_database,
                'id' => $id
            ]);

        }


        $update = $event_activityObj->update([
            'id' => $id,
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'desc_en' => $desc_en,
            'desc_ar' => $desc_ar,
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
                <h4 class="page-title"> <?php echo trans('events_activities'); ?> </h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="events_activities_view.php?lang=<?php echo $lang; ?>"><?php echo trans('events_activities'); ?>  </a>
                    </li>
                    <li class="active">
                        <?php echo trans('edit_event_activity'); ?>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <?php
                    if (isset($_GET['event_activity_id'])) {
                        $row_select = $event_activityObj->getById($_GET['event_activity_id']);

                        $id = $row_select['id'];
                        $title_ar = $row_select['title_ar'];
                        $title_en = $row_select['title_en'];
                        $desc_en = $row_select['desc_en'];
                        $desc_ar = $row_select['desc_ar'];
                        $image = $row_select['image'];

                        if ($row_select) {
                            ?>

                            <form method="POST" enctype="multipart/form-data" data-parsley-validate novalidate>

                                <input type="hidden" name="id_update" id="id_update" parsley-trigger="change"  value="<?php echo $id; ?>" class="form-control">

                                <div class="clearfix"></div>

                                <div class="form-group col-md-3">
                                    <label for="title_en"><?php echo trans('title_en'); ?></label>
                                    <input value="<?php echo $title_en; ?>" name="title_en" required class="form-control">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="title_ar"><?php echo trans('title_ar'); ?></label>
                                    <input value="<?php echo $title_ar; ?>" name="title_ar" required class="form-control">

                                </div>

                                <div class="clearfix"></div>

                                <div class="form-group col-md-3">
                                    <label for="desc_ar"><?php echo trans('desc_en'); ?></label>
                                    <input type="text" value="<?php echo $desc_en; ?>" name="desc_en" required class="form-control">

                                </div>

                                <div class="form-group col-md-3">
                                    <label for="desc_ar"><?php echo trans('desc_ar'); ?></label>
                                    <input type="text" value="<?php echo $desc_ar; ?>" name="desc_ar" required class="form-control">

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
                                            <button type="submit" name="event_activity_update" class="btn w-sm btn-default waves-effect waves-light"><?php echo trans('update'); ?></button>
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