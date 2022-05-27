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

    $name_ar        = mysqli_real_escape_string($con, trim($_POST['name_ar']));
    $name_en        = mysqli_real_escape_string($con, trim($_POST['name_en']));
    $category_id    = mysqli_real_escape_string($con, trim($_POST['category_id']));
    $entity_id      = mysqli_real_escape_string($con, trim($_POST['entity_id']));
    $link           = mysqli_real_escape_string($con, trim($_POST['link']));


    $errors = array();
    include 'models/Notification.php';
    include 'models/Client.php';
    $notificationObj = new Notification();
    $clientObj = new Client();
    $ids = $clientObj->getDeviceTokens();

    if (empty($name_ar) || empty($name_en)) {
        $errors[] = "Please enter name fields!";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {

        $notificationObj->create([
            'name_ar'       => $name_ar,
            'name_en'       => $name_en,
            'category_id'   => $category_id,
            'entity_id'     => $entity_id,
            'link'          => $link,
            'date'          => date('Y-m-d')
        ]);
        
        $url = "https://fcm.googleapis.com/fcm/send";
        
        
        foreach($ids as $id) {

            $serverKey = 'AAAA8KT53kE:APA91bFmlZQY9TJ0Em16WuQ9f66xv2iP9WjZkW905vuX-nmVdvHWMmDsv0qa2fsEce5AbWGFiwPbiWHig7HRaljXyZIq2V3s2zenaC1kfbhCFoGLmuTNDgKcowDKK1P1QuphIU4Zr0_K';
            $title = "Pool BHR";
            $body = $name_ar;
            // $type = $params['data']['type'];
            $notification = array('title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1');
            // $data = array('type' => $type);
            $arrayToSend = array('to' => $id, 'notification' => $notification, 'priority' => 'high', "data" => ['a' => 'a']);
            $json = json_encode($arrayToSend);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key=' . $serverKey;
            $ch = curl_init();
    
    
    
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send'); //For firebase, use https://fcm.googleapis.com/fcm/send
    
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    
            //Send the request
            $response = curl_exec($ch);
            //Close request
            if ($response === FALSE) {
                die('FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);
            // echo die(var_dump($response));
            // var_dump($response);
        }
        
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
                <h4 class="page-title"><?php echo trans('notifications') ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="notification_view.php"><?php echo trans('notifications') ?></a>
                    </li>
                    <li class="active">
                        <?php echo trans('addNotification') ?>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" data-parsley-validate novalidate>
                        <div class="form-group col-md-6">
                            <label for="name"><?php echo trans('name_ar') ?></label>
                            <textarea name="name_ar" parsley-trigger="change" required placeholder="<?php echo trans('name_ar') ?>" class="form-control" ><?php echo old('name_ar'); ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name"><?php echo trans('name_en') ?></label>
                            <textarea name="name_en" parsley-trigger="change" required placeholder="<?php echo trans('name_en') ?>" class="form-control" ><?php echo old('name_en'); ?></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="select_payment_type"><?php echo trans('categories'); ?></label>
                            <select class="form-control select2me" name="category_id" id="category"  parsley-trigger="change">
                                <option value=''><?php echo trans('all'); ?></option>
                                <?php
                                include 'models/Category.php';
                                $categoryObj = new Category();
                                $categories = $categoryObj->getActive();
                                foreach ($categories as $category) {
                                    ?>
                                    <option value='<?php echo $category['id']; ?>'><?php echo $category['name_' . $lang]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="select_payment_type"><?php echo trans('categories'); ?></label>
                            <select class="form-control select2me" name="entity_id" id="entities"  parsley-trigger="change">
                                <option value=''>---</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email"><?php echo trans('link') ?></label>
                            <input type="text" name="link" value="<?php echo old('link'); ?>" parsley-trigger="change"  placeholder="<?php echo trans('link') ?>" class="form-control" >
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-center p-20">
                                    <button type="reset" class="btn w-sm btn-white waves-effect"><?php echo trans('cancel') ?></button>
                                    <button type="submit" name="submit" class="btn w-sm btn-default waves-effect waves-light"><?php echo trans('add') ?></button>
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

    $('#category').change(function () {
        let id = $(this).val();
        $.ajax({
            type: "POST",
            url: "entity.php",
            data: {
                type: "getEntity",
                id: id,
            },
            dataType: 'text',
            cache: false,
            success: function (data) {
                let xx = `<option value="">---</option>`;
                if (JSON.parse(data).length > 0) {
                    for (let i = 0; i < JSON.parse(data).length; i++) {
                        xx += `<option value="${JSON.parse(data)[i].id}">
                            ${JSON.parse(data)[i].name_<?php echo $lang; ?>}
                        </option>`
                    }
                }
                $("#entities").empty().append(xx);
            }
        });
    })
</script>