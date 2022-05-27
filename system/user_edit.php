<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}

include "models/User.php";

if (isset($_POST['user_update'])) {

    $id         = $_POST['id'];
    $username   = $_POST['name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];

    $userObj = new User();
    $user = $userObj->getById($id);

    if (isset($_POST['password']) && ($_POST['password'] != '')) {
        $password = trim($_POST['password']);
    } else {
        $old_pass = $_POST['old_pass'];
        $password = $old_pass;
    }
    $errors = array();

    if (empty($username) || empty($phone) || empty($email)) {
        $errors[] = trans('PleaseEnterAllFields');
    } elseif (strlen($username) < 3 || strlen($username) > 100) {
        $errors[] = trans('fieldNameBetween');
    } elseif (!preg_match('/^([0]{1})([1]{1})([0-2]{1})([0-9]{8})$/', $phone)) {
        $errors[] = trans('fieldPhoneValid');
    } elseif ($username != $user['username']  && (bool)$userObj->getByName($username)) {
        $errors[] = trans('fieldNameTaken');
    } elseif ($phone != $user['mobile']  && (bool)$userObj->getByMobile($phone)) {
        $errors[] = trans('fieldPhoneTaken');
    } elseif ($email != $user['email']  && (bool)$userObj->getByEmail($email)) {
        $errors[] = trans('fieldEmailTaken');
    } elseif (strlen($password) < 6 || strlen($password) > 100) {
        $errors[] = trans('fieldPasswordBetween');
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {
        if (isset($_FILES['image_update']['name']) && !empty($_FILES['image_update']['name'])) {

            $target_dir = "api/uploads/users/" . $id;
            $target_file = $target_dir . "/" . basename($_FILES["image_update"]["name"]);

            if (!file_exists($target_dir)) {
                mkdir($target_dir , 0777, true);
            }

            if ($user['image']) {
                $name = strstr($user['image'], 'api/');
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

            $userObj = new User();
            $userObj->update([
                'image' => $image_database,
                'id' => $id
            ]);
        }

        $userObj = new User();
        $update = $userObj->update([
            'username'  => $username,
            'password'  => $password,
            'email'     => $email,
            'mobile'    => $phone,
            'id'        => $id,
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
                <h4 class="page-title"><?php echo trans('users'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="client_edit.php"><?php echo trans('users'); ?></a>
                    </li>
                    <li class="active">
                        <?php echo trans('editUser'); ?>
                    </li>
                </ol>
            </div>
        </div>
        <?php
        if ($_GET['id']) {

            $id = $_GET['id'];

            $userObj = new User();
            $row_select = $userObj->getById($id);

            $id         = $row_select['id'];
            $name       = $row_select['username'];
            $email      = $row_select['email'];
            $phone      = $row_select['mobile'];
            $image      = $row_select['image'];
            $password   = $row_select['password'];

            if ($row_select) {
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <form method="POST" enctype="multipart/form-data" data-parsley-validate novalidate>
                                <input type="hidden" name="id" parsley-trigger="change" required value="<?php echo $id; ?>">
                                <input type="hidden" name="old_pass" id="old_pass" parsley-trigger="change" required value="<?php echo $password; ?>">

                                <div class="form-group col-md-4">
                                    <label for="name"><?php echo trans('user_name'); ?></label>
                                    <input type="text" name="name" id="name" parsley-trigger="change" required value="<?php echo $name; ?>" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email"><?php echo trans('email'); ?></label>
                                    <input type="text" name="email" id="email" parsley-trigger="change" required value="<?php echo $email; ?>" class="form-control">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="phone"><?php echo trans('phone'); ?></label>
                                    <input type="text" name="phone" id="phone" parsley-trigger="change" required value="<?php echo $phone; ?>" class="form-control">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="password"><?php echo trans('password'); ?> *</label>
                                    <input type="password" name="password" id="password" parsley-trigger="change"  value="" class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <input type="hidden" name="image_ext_old" value="<?php echo $image; ?>" />

                                <div class="gal-detail thumb">
                                    <a href="<?php echo $image; ?>" class="image-popup" title="Screenshot-2">
                                        <img src="<?php echo $image; ?>" class="thumb-img" alt="work-thumbnail">
                                    </a>
                                    <h4><?php echo trans('image'); ?></h4>
                                </div>
                                <div class="text-center m-t-30">
                                    <div class="fileupload btn btn-purple btn-md w-md waves-effect waves-light">
                                        <span><i class="ion-upload m-r-5"></i><?php echo trans('upload'); ?></span>
                                        <input type="file" name="image_update"  class="upload">
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="text-center p-20">
                                            <button type="reset" class="btn w-sm btn-white waves-effect"><?php echo trans('cancel'); ?></button>
                                            <button type="submit" name="user_update" class="btn w-sm btn-default waves-effect waves-light"><?php echo trans('update'); ?></button>
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