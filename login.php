<?php
include("system/config.php");

if (Clientloggedin()) {
    header('Location: index.php');
}

include('include/head.php');
include('include/header.php');
?>
<!--start Breadcrumb-->

<div class="bread py-4">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <div class="">
                <div class="text-center my-3">
                    <h1 class="text-white font-weight-bold"><?=trans('login')?></h1>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent d-flex justify-content-center">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?=trans('home')?></a></li>
                        <li class="breadcrumb-item active text-white h5  oppacity" aria-current="page"><?=trans('login')?> </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!--end Breadcrumb-->

<?php

// error_reporting(0);
if (isset($_POST['submit'])) {
    $mobile  =  $_POST['mobile'];
    $password = $_POST['password'];

    // check that username & password entered !!
    if ($mobile && $password) {
        $login = $con->query("SELECT * FROM `clients` WHERE `mobile`='$mobile'");
        if (mysqli_num_rows($login) == 0) {
            echo get_error("Invalid Phone Or Password !");
        } else {
            while ($row = mysqli_fetch_assoc($login)) {
                // Check Password
                if ($row['password'] == $password) {
                    $_SESSION['client_id'] = $row['id'];
                    $_SESSION['client_name'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['verified'] = $row['verified'];
                    $_SESSION['mobile'] = $row['mobile'];

                    header("Location: index.php");
                } else {
                    echo '<script type="text/javascript">';
                    echo 'alert("Password Invalid!")';
                    echo '</script>';
                }
            }
        }
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
                    <form class="form-horizontal m-t-20" action="" method="POST">

                        <div class="position-relative my-2">
                            <i class="icon-phone8 main_text h3 position-absolute"></i>
                            <input class="w-100 px-5 py-2 rounded thin_border main_bold" type="phone" name="mobile"  required placeholder="<?php echo trans('phone'); ?> ">
                        </div>

                        <div class="position-relative my-2">
                            <i class="icon-lock-closed2 main_text h4 position-absolute"></i>
                            <input class="w-100 px-5 py-2 rounded thin_border main_bold" type="text" name="password"  required placeholder="<?php echo trans('password'); ?> ">
                        </div>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup">
                                        <?= trans('remember'); ?>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <button class="last_bt rounded py-2 w-100 thin_border transition-me my-4 main_bold" type="submit" name="submit"><?= trans('login'); ?> </button>
                        <!--                        <div class="px-2">-->
                        <!--                            <a  href="email_recover.php" class="text-decoration-none main_link_1 transition-me"><i class="fa fa-lock m-r-5"></i>--><?//= trans('forget_password'); ?><!--</a>-->
                        <!--                        </div>-->
                    </form>





                    <!--                    <div class="text-center">-->
                    <!--                        <img src="assets/img/logo.png" class="img-fluid" alt="logo">-->
                    <!--                    </div>-->
                    <!--                    <div class="position-relative my-2">-->
                    <!--                        <i class="icon-phone8 main_text h3 position-absolute"></i>-->
                    <!--                        <input type="text" class="w-100 px-5 py-2 rounded thin_border main_bold" placeholder="رقم الجوال">-->
                    <!--                    </div>-->
                    <!--                    <div class="position-relative my-2">-->
                    <!--                        <i class="icon-lock-closed2 main_text h4 position-absolute"></i>-->
                    <!--                        <input type="password" class="w-100 px-5 py-2 rounded thin_border main_bold" placeholder="كلمه المرور">-->
                    <!--                    </div>-->
                    <!--                    <div class="d-flex justify-content-between align-items-center">-->
                    <!--                        <div class="px-2">-->
                    <!--                            <input type="checkbox" class="">-->
                    <!--                            <span>--><?//= trans('remember'); ?><!--</span>-->
                    <!--                        </div>-->
                    <!--                        <div class="px-2">-->
                    <!--                            <a href="#" class="text-decoration-none main_link_1 transition-me">نسيت كلمه المرور ؟</a>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                    <button type="submit" name="submit" class="last_bt rounded py-2 w-100 thin_border transition-me my-4 main_bold">--><?//= trans('login'); ?><!--</button>-->
                </div>
            </div>
        </div>
    </div>
</div>

<!--end create account-->

<?php

include('include/footer.php');

?>

