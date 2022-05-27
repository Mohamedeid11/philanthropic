<?php
include("config.php");

include 'models/Message.php';

if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
if (isset($_POST['submit'])) {
    $messagesObj = new Message();


    $type = $_POST['type'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $content = $_POST['content'];

    $errors = array();

    if (empty($name) || empty($email)  || empty($address) || empty($content)) {
        $errors[] = "Please enter all fields!";
    } elseif (strlen($name) < 3 || strlen($name) > 100) {
        $errors[] = "Field Name ar must be between 3, 100 characters";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {
        $messagesObj->create([
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'content' => $content,
            'date' => date('Y-m-d h:i'),
        ]);
        echo get_success("The Message Added successfully");
//     echo "<meta http-equiv='refresh' content='Added Successfully'>";

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
                <h4 class="page-title"><?php echo trans('messages'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="messages_view.php"><?php echo trans('messages'); ?></a>
                    </li>
                    <li class="active">
                        <?php echo trans('add_message'); ?>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" data-parsley-validate novalidate>

                        <div class="clearfix"></div>

                        <div class="form-group col-md-5">
                            <label for="name"><?php echo trans('name'); ?></label>
                            <input type="text" name="name" parsley-trigger="change" required placeholder="<?php echo trans('name_ar'); ?>" class="form-control" >
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-md-5">
                            <label for="email"><?php echo trans('email'); ?></label>
                            <input type="email" name="email" parsley-trigger="change" required placeholder="<?php echo trans('email'); ?>" class="form-control" >
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-md-5">
                            <label for="address"><?php echo trans('address'); ?></label>
                            <input type="address" name="address" parsley-trigger="change" required placeholder="<?php echo trans('address'); ?>" class="form-control" >
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-md-9" id="contenف" >
                            <label><?= trans('content'); ?></label>
                            <textarea name="content" class="form-control"> </textarea>
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