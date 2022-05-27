<?ob_start(); ?>
<?php
include("config.php");
if (loggedin()) {
    header("Location: index.php");
    exit();
}
// mail("eslam.habsa94@gmail.com", 'password', 'password is 123123');
?>
<!DOCTYPE html>
<html>
    <?php include("include/heads.php"); ?>
    <body>

        <?php
        // error_reporting(0);
        if (isset($_POST['submit'])) {

            include('models/User.php');
            $userObj = new User();

            $email = mysqli_real_escape_string($con, $_POST['email']);

            // check that username & password entered !!
            if ($email) {
                $user = $userObj->getByEmail($email);
                if (!$user) {
                    echo get_error("هذا الإيميل غير مسجل من قبل!");
                } else {

                    // Check Password
                    $password = $user['password'];
                    $email = $user['email'];

                    $to = $email;
                    $subject = 'كلمة المرور';
                    $message = 'كلمة المرور:' . $password;
                    $headers = 'From:Pool BHR ';

                    mail($to, $subject, $message);
                    echo get_success("تم إرسال كلمة المرور الي البريد الإلكتروني  ");

                }
            }
        }
        ?>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class=" card-box">
                <div class="panel-body">
                    <form class="form-horizontal m-t-20" action="" method="POST">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="email" required="" placeholder=" البريد الإلكتروني">
                            </div>
                        </div>
                        <div class="form-group text-center m-t-40">
                            <div class="col-xs-12">
                                <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit" name="submit">سيتم ارسال رقم المرور علي الإيميل</button>
                            </div>
                        </div>

                    </form>					
                </div>   
            </div> 
        </div>
        <?php include("include/footer.php"); ?>
    </body>
</html>
<?ob_flush(); ?>