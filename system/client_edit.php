<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
include "models/Client.php";

if (isset($_POST['client_update'])) {

    $client_id_update = $_POST['client_id_update'];
    $client_name = $_POST['client_name'];
    $client_email = $_POST['client_email'];
    $client_phone = $_POST['client_phone'];

    $clientObj = new Client();
    $client = $clientObj->getById($client_id_update);

    if (isset($_POST['client_password']) && ($_POST['client_password'] != '')) {
        $client_password = trim($_POST['client_password']);
    } else {
        $old_pass = $_POST['old_pass'];
        $client_password = $old_pass;
    }
    $errors = array();

    if (empty($client_name) || empty($client_phone) || empty($client_email)) {
        $errors[] = trans('PleaseEnterAllFields');
    } elseif (strlen($client_name) < 3 || strlen($client_name) > 100) {
        $errors[] = trans('fieldNameBetween');
    } elseif (!preg_match('/^([0]{1})([1]{1})([0-2]{1})([0-9]{8})$/', $client_phone)) {
        $errors[] = trans('fieldPhoneValid');
    } elseif ($client_phone != $client['mobile']  && (bool)$clientObj->getByMobile($client_phone)) {
        $errors[] = trans('fieldPhoneTaken');
    } elseif ($client_email != $client['email']  && (bool)$clientObj->getByEmail($client_email)) {
        $errors[] = trans('fieldEmailTaken');
    } elseif (strlen($client_password) < 6 || strlen($client_password) > 100) {
        $errors[] = trans('fieldPasswordBetween');
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {
//        if (isset($_FILES['image_update']['name']) && !empty($_FILES['image_update']['name'])) {
//
//            $target_dir = "api/uploads/clients/" . $client_id_update;
//            $target_file = $target_dir . "/" . basename($_FILES["image_update"]["name"]);
//            $photo_name = $_FILES['image_update']['name'];
//            $photo_tmp = $_FILES['image_update']['tmp_name'];
//            $get_image_ext = explode('.', $photo_name);
//            $image_ext = strtolower(end($get_image_ext));
//
//            if (!file_exists($target_dir)) {
//                mkdir($target_dir);
//            }
//
//            if ($client['image']) {
//                $name = strstr($client['image'], 'api/');
//                if (is_file($name)) {
//                    unlink($name);
//                }
//            }
//
//            if (strtolower($image_ext) == 'png') {
//                $source = imagecreatefrompng($photo_tmp);
//            }
//
//            if (strtolower($image_ext) == 'jpg' || strtolower($image_ext) == 'jpeg') {
//                $source = imagecreatefromjpeg($photo_tmp);
//            }
//
//            list($width_min, $height_min) = getimagesize($photo_tmp);
//            $newWidth = 350;
//            $newHeight = ($newWidth/$width_min) * $height_min;
//
//            $tmp_min = imagecreatetruecolor($newWidth, $newHeight);
//
//            imagecopyresampled($tmp_min, $source, 0,0,0,0,$newWidth, $newHeight, $width_min, $height_min);
//            imagejpeg($tmp_min, 'api/uploads/' . $photo_name, 80);
//            if (move_uploaded_file($_FILES["image_update"]["tmp_name"], $target_file)) {
//                $msg = "The file " . basename($_FILES["image_update"]["name"]) . " has been uploaded.";
//            }
//
//            $image_name_update = $_FILES['image_update']['name'];
//            $image_tmp_update = $_FILES['image_update']['tmp_name'];
//
//            if ($_SERVER['SERVER_NAME'] == 'localhost') {
//                $image_path = "http://localhost/poolbhr/api/uploads/clients/" . $client_id_update . '/' . $image_name_update;
//                $image_database = "http://localhost/poolbhr/api/uploads/clients/{$client_id_update}/{$image_name_update}";
//            } else {
//                $image_path = "http://poolbhr.com/admin/api/uploads/clients/" . $client_id_update . '/' . $image_name_update;
//                $image_database = "http://poolbhr.com/admin/api/uploads/clients/{$client_id_update}/{$image_name_update}";
//            }
//
//            $clientObj = new Client();
//            $clientObj->update([
//                'image' => $image_database,
//                'id' => $client_id_update
//            ]);
//        }

        $clientObj = new Client();
        $update = $clientObj->update([
            'name' => $client_name,
            'password' => $client_password,
            'email' => $client_email,
            'mobile' => $client_phone,
            'id' => $client_id_update
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
                    <h4 class="page-title"><?php echo trans('clients'); ?></h4>
                    <ol class="breadcrumb">
                        <li>
                            <a href="client_view.php"><?php echo trans('clients'); ?></a>
                        </li>
                        <li class="active">
                            <?php echo trans('editClient'); ?>
                        </li>
                    </ol>
                </div>
            </div>
            <?php
            if ($_GET['clientId']) {

                $get_client_id = $_GET['clientId'];

                $clientObj = new Client();
                $clientObj->getById($get_client_id);
                $row_select = $clientObj->getById($get_client_id);

                $client_id = $row_select['id'];
                $client_name = $row_select['name'];
                $client_email = $row_select['email'];
                $client_phone = $row_select['mobile'];
//                $client_image = $row_select['image'];
                $client_verify = $row_select['verified'];
                $client_password = $row_select['password'];

                if ($row_select) {
                    ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <form method="POST" enctype="multipart/form-data" data-parsley-validate novalidate>
                                        <input type="hidden" name="client_id_update" id="client_id_update" parsley-trigger="change" required value="<?php echo $client_id; ?>" class="form-control">
                                        <input type="hidden" name="old_pass" id="old_pass" parsley-trigger="change" required value="<?php echo $client_password; ?>" class="form-control">

                                        <div class="form-group col-md-3">
                                            <label for="client_name"><?php echo trans('name'); ?></label>
                                            <input type="text" name="client_name" id="client_name" parsley-trigger="change" required value="<?php echo $client_name; ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="client_email"><?php echo trans('email'); ?></label>
                                            <input type="text" name="client_email" id="client_email" parsley-trigger="change" required value="<?php echo $client_email; ?>" class="form-control">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="client_phone"><?php echo trans('phone'); ?></label>
                                            <input type="text" name="client_phone" id="client_phone" parsley-trigger="change" required value="<?php echo $client_phone; ?>" class="form-control">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="client_password"><?php echo trans('password'); ?> *</label>
                                            <input type="password" name="client_password" id="client_password" parsley-trigger="change"  value="" class="form-control">
                                        </div>

                                        <div class="clearfix"></div>
<!--                                        <input type="hidden" name="image_ext_old" value="--><?php //echo $client_image; ?><!--" />-->

<!--                                        <div class="gal-detail thumb">-->
<!--                                            <a href="--><?php //echo $client_image; ?><!--" class="image-popup" title="Screenshot-2">-->
<!--                                                <img src="--><?php //echo $client_image; ?><!--" class="thumb-img" alt="work-thumbnail">-->
<!--                                            </a>-->
<!--                                            <h4>--><?php //echo trans('image'); ?><!--</h4>-->
<!--                                        </div>-->
<!--                                        <div class="text-center m-t-30">-->
<!--                                            <div class="fileupload btn btn-purple btn-md w-md waves-effect waves-light">-->
<!--                                                <span><i class="ion-upload m-r-5"></i>--><?php //echo trans('upload'); ?><!--</span>-->
<!--                                                <input type="file" name="image_update"  class="upload">-->
<!--                                            </div>-->
<!--                                        </div>-->
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
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.image-popup').magnificPopup({
                                type: 'image',
                                closeOnContentClick: true,
                                mainClass: 'mfp-fade',
                                gallery: {
                                    enabled: true,
                                    navigateByImgClick: true,
                                    preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                                }
                            });
                        });
                    </script>
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