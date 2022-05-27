<?php
include("config.php");

include 'models/Committees.php';

if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
if (isset($_POST['submit'])) {

    $name_ar  = mysqli_real_escape_string($con, trim($_POST['name_ar']));
    $name_en  = mysqli_real_escape_string($con, trim($_POST['name_en']));
    $position_ar  = mysqli_real_escape_string($con, trim($_POST['position_ar']));
    $position_en = mysqli_real_escape_string($con, trim($_POST['position_en']));
    $title_en  = mysqli_real_escape_string($con, trim($_POST['title_en']));
    $title_ar  = mysqli_real_escape_string($con, trim($_POST['title_ar']));
    $desc_en  = mysqli_real_escape_string($con, trim($_POST['desc_en']));
    $desc_ar = mysqli_real_escape_string($con, trim($_POST['desc_ar']));

    $image_name    = $_FILES['image']['name'];
    $image_temp    = $_FILES['image']['tmp_name'];

    $errors = array();

    if (empty($name_ar || $name_en || $position_ar || $position_en || $image_name)) {
        $errors[] = "Please enter all fields!";
    }elseif (strlen($name_ar) < 3 || strlen($name_ar) > 100) {
        $errors[] = "Field Name ar must be between 3, 100 characters";
    }elseif (strlen($name_en) < 3 || strlen($name_en) > 100) {
        $errors[] = "Field Name en must be between 3, 100 characters";
    }elseif(!$image_name){
        $errors[] = "Please Upload Your Image !";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {

        $committeeObj = new Committees();
        $id = $committeeObj->create([
            'name_ar' => $name_ar,
            'name_en' => $name_en,
            'position_ar' => $position_ar,
            'position_en' => $position_en,
            'title_en' => $title_en,
            'title_ar' => $title_ar,
            'desc_en' => $desc_en,
            'desc_ar' => $desc_ar,
            'display' => 1,
            'date' => date('Y-m-d h:i'),
        ]);
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ''){

            $target_dir  = "api/uploads/committees/" . $id ;
            $target_file = $target_dir . "/" . basename($_FILES["image"]["name"]);

            if (!file_exists($target_dir)){
                mkdir($target_dir , 0777 , true);
            }
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $msg = "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
            }

            $image_path = $site_url . $target_dir . '/' . $image_name;
            $image_database = $site_url . $target_dir ."/"  . $image_name;

            $committeeObj->update([
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
                <h4 class="page-title"><?php echo trans('committees'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="committees_view.php"><?php echo trans('committees'); ?></a>
                    </li>
                    <li class="active">
                        <?php echo trans('add_committee'); ?>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" data-parsley-validate novalidate>

                        <div class="form-group col-md-5">
                            <label for="name_en "><?php echo trans('name_en'); ?></label>
                            <input type="text" name="name_en" parsley-trigger="change" required placeholder="<?php echo trans('name_en'); ?>" class="form-control" >
                        </div>

                        <div class="form-group col-md-5">
                            <label for="name_ar "><?php echo trans('name_ar'); ?></label>
                            <input type="text" name="name_ar" parsley-trigger="change" required placeholder="<?php echo trans('name_ar'); ?>" class="form-control" >
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-md-5">
                            <label for="position_en"><?php echo trans('position_en'); ?></label>
                            <input type="text" name="position_en" parsley-trigger="change" required placeholder="<?php echo trans('position_en'); ?>" class="form-control" >
                        </div>

                        <div class="form-group col-md-5">
                            <label for="position_ar "><?php echo trans('position_ar'); ?></label>
                            <input type="text" name="position_ar" parsley-trigger="change" required placeholder="<?php echo trans('position_ar'); ?>" class="form-control" >
                        </div>

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

                        <div class="form-group col-md-9" id="content-ar" >
                            <label><?= trans('desc_en'); ?></label>
                            <textarea name="desc_en" class="form-control"> </textarea>
                        </div>

                        <div class="form-group col-md-9" id="content-ar" >
                            <label><?= trans('desc_ar'); ?></label>
                            <textarea name="desc_ar" class="form-control"> </textarea>
                        </div>

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