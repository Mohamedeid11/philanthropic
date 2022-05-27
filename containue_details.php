<?php
include("system/config.php");

include('include/head.php');
include('include/header.php');
?>
        <!--start Breadcrumb-->

        <div class="bread py-4">
            <div class="container">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="">
                        <div class="text-center my-3">
                            <h1 class="text-white font-weight-bold"><?=trans('create_new_account')?> </h1>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent d-flex justify-content-center">
                                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?=trans('home')?></a></li>
                                <li class="breadcrumb-item active text-white h5  oppacity" aria-current="page"><?=trans('create_new_account')?> </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!--end Breadcrumb-->

<?php

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($con, trim($_POST['name']));
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $password = mysqli_real_escape_string($con, trim($_POST['password']));


    include 'models/Client.php';
    $errors = array();
    $clientObj = new Client();

    if (empty($name) || empty($email) || empty($password)) {
        $errors[] = trans('PleaseEnterAllFields');
    } elseif (strlen($name) < 3 || strlen($name) > 100) {
        $errors[] = trans('fieldNameBetween');
    }  elseif ((bool)$clientObj->getByEmail($email)) {
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
        $clientObj->up([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'verified' => 0
        ]);
        echo get_success(trans('addedSuccessfully'));
    }
}

?>
        <!--start create account-->

        <div class="new my-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-3">
                        <div class="p-2">
                            <div class="text-center">
                                <img src="<?= $setting_header_logo ?>" class="img-fluid" alt="logo">
                            </div>
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" data-parsley-validate novalidate>
                                <div class="position-relative my-2">
                                    <i class="icon-user main_text h4 position-absolute"></i>
                                    <input type="text" name="name" value="<?php echo old('name'); ?>" parsley-trigger="change" required placeholder="<?php echo trans('name'); ?>" class="w-100 px-5 py-2 rounded thin_border main_bold" >
                                </div>
                                <div class="position-relative my-2">
                                    <i class="icon-email main_text h4 position-absolute"></i>
                                    <input type="email" name="email"  parsley-trigger="change" required placeholder="<?php echo trans('email'); ?>" class="w-100 px-5 py-2 rounded thin_border main_bold" >
                                </div>
                                <div class="position-relative my-2">
                                    <i class="icon-lock-closed2 main_text h4 position-absolute"></i>
                                    <input type="text" name="password"  required placeholder="<?php echo trans('password'); ?>" class="w-100 px-5 py-2 rounded thin_border main_bold" >
                                </div>
                                <button type="submit" name="submit" class="last_bt rounded py-2 w-100 thin_border transition-me my-4 main_bold"><?php echo trans('save'); ?></button>
                            </form>



<!--                            <div class="text-center">-->
<!--                                <img src="--><?//= $setting_header_logo ?><!--" class="img-fluid" alt="logo">-->
<!--                            </div>-->
<!--                            <div class="position-relative my-2">-->
<!--                                <i class="icon-phone8 main_text h3 position-absolute"></i>-->
<!--                                <input type="text" class="w-100 px-5 py-2 rounded thin_border main_bold" placeholder="رقم الجوال">-->
<!--                            </div>-->
<!--                            <div class="position-relative my-2">-->
<!--                                <i class="icon-lock-closed2 main_text h4 position-absolute"></i>-->
<!--                                <input type="password" class="w-100 px-5 py-2 rounded thin_border main_bold" placeholder="كلمه المرور">-->
<!--                            </div>-->
<!--                            <button class="last_bt rounded py-2 w-100 thin_border transition-me my-4 main_bold">تسجيل</button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end create account-->

<?php

include('include/footer.php');

?>

