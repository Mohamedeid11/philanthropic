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

    $name       = mysqli_real_escape_string($con, trim($_POST['name']));
    $mobile     = mysqli_real_escape_string($con, trim($_POST['phone']));
    $email      = mysqli_real_escape_string($con, trim($_POST['email']));
    $password   = mysqli_real_escape_string($con, trim($_POST['password']));


    $errors = array();
    include 'models/Client.php';
    $clientObj = new Client();

    if (empty($name) || empty($mobile) || empty($email) || empty($password)) {
        $errors[] = trans('PleaseEnterAllFields');
    } elseif (strlen($name) < 3 || strlen($name) > 100) {
        $errors[] = trans('fieldNameBetween');
    } elseif (!preg_match('/^([0]{1})([1]{1})([0-2]{1})([0-9]{8})$/', $mobile)) {
        $errors[] = trans('fieldPhoneValid');
    } elseif ((bool)$clientObj->getByMobile($mobile)) {
        $errors[] = trans('fieldPhoneTaken');
    } elseif ((bool)$clientObj->getByEmail($email)) {
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
        $clientObj->create([
            'mobile' => $mobile,
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'verified' => 0
        ]);
        echo get_success(trans('addedSuccessfully'));
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
                            <?php echo trans('addClient'); ?>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" data-parsley-validate novalidate>
                            <div class="form-group col-md-3">
                                <label for="name"><?php echo trans('name'); ?></label>
                                <input type="text" name="name" value="<?php echo old('name'); ?>" parsley-trigger="change" required placeholder="<?php echo trans('name'); ?>" class="form-control" >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="phone"><?php echo trans('phone'); ?></label>
                                <input type="phone" name="phone" value="<?php echo old('phone'); ?>" parsley-trigger="change" required placeholder="<?php echo trans('phone'); ?>" class="form-control" >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="email"><?php echo trans('email'); ?></label>
                                <input type="email" name="email"  placeholder="<?php echo trans('email'); ?> " class="form-control" >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="client_password"><?php echo trans('password'); ?></label>
                                <input type="password" name="password" value="<?php echo old('password'); ?>"  parsley-trigger="change"  value="" class="form-control">
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