<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
include 'models/Message.php';

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
                <h4 class="page-title"><?= trans('messages'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="messages_view.php"><?= trans('messages'); ?></a>
                    </li>
                    <li class="active">
                        <?= trans('messages'); ?>
                    </li>
                </ol>
            </div>

            <?php
            if (isset($_GET['message_id'])) {

            $messageObj = new Message();
            $row_select = $messageObj->getById($_GET['message_id']);

            $id = $row_select['id'];
            $name = $row_select['name'];
            $email = $row_select['email'];
            $address = $row_select['address'];
            $content = $row_select['content'];
            $date = $row_select['date'];

            if ($row_select) {
            ?>
            <div class="card-box table-responsive">
                <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td> <?= trans('name'); ?>  </td>
                                <td>
                                    <?=$name?>
                                </td>
                            </tr>
                            <tr>
                                <td> <?= trans('email'); ?>  </td>
                                <td>
                                    <?=$email?>
                                </td>
                            </tr>
                            <tr>
                                <td> <?= trans('address'); ?>  </td>
                                <td>
                                    <?=$address?>
                                </td>
                            </tr>
                            <tr>
                                <td> <?= trans('content'); ?>  </td>
                                <td>
                                    <?=$content?>
                                </td>
                            </tr>
                            <tr>
                                <td> <?= trans('date'); ?></td>
                                <td>
                                    <?=$date?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <?php
                        }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include("include/footer_text.php"); ?>

<?php include("include/footer.php"); ?>

</body>
</html>