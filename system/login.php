<? ob_start(); ?>
<?php
include("config.php");
if (loggedin()) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <?php include("include/heads.php"); ?>
    <body>

        <?php
        // error_reporting(0);
        if (isset($_POST['submit'])) {

            $username = mysqli_real_escape_string($con, $_POST['username']);
            $password = $_POST['password'];

            // check that username & password entered !!
            if ($username && $password) {
                $login = $con->query("SELECT * FROM `users` WHERE `username`='$username'");
                if (mysqli_num_rows($login) == 0) {
                    echo get_error("Invalid Username Or Password !");
                } else {
                    while ($row = mysqli_fetch_assoc($login)) {
                        // Check Password
                        if ($row['password'] == $password) {
                            $_SESSION['user_id'] = $row['id'];
                            $_SESSION['user_role'] = $row['role'];
                            $_SESSION['user_name'] = $row['username'];
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['image'] = $row['image'];
                            $_SESSION['status'] = $row['status'];
                            $_SESSION['mobile'] = $row['mobile'];

                            header("Location: index.php");
                        } else {
                            echo get_error("Password is incorrect! Please try again");
                        }
                    }
                }
            }
        }
        ?>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class=" card-box">
                <div class="panel-heading">
                    <h3 class="text-center"> <?= trans('login'); ?>  <strong class="text-custom"><?= trans('management'); ?></strong> </h3>
                </div> 
                <div class="panel-body">
                    <form class="form-horizontal m-t-20" action="" method="POST">

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="username" required="" placeholder="<?= trans('user_name'); ?> ">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" required="" placeholder="<?= trans('password'); ?>  ">
                            </div>
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

                        <div class="form-group text-center m-t-40">
                            <div class="col-xs-12">
                                <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit" name="submit"><?= trans('login'); ?> </button>
                            </div>
                        </div>
                        <div class="form-group m-t-30 m-b-0">
                            <div class="col-sm-12">
                                <a  href="email_recover.php" class="text-dark"><i class="fa fa-lock m-r-5"></i><?= trans('forget_password'); ?></a>
                            </div>
                        </div>
                    </form>					
                </div>   
            </div>                              
            <div class="row">
                <div class="col-sm-12 text-center">
                    <!--<p>لا أمتلك حساب حتى الآن؟ <a href="#" class="text-primary m-l-5"><b>تسجيل عضوية جديدة</b></a></p>-->
                </div>
            </div>	
        </div>
        <?php include("include/footer.php"); ?>
    </body>
</html>
<? ob_flush(); ?>