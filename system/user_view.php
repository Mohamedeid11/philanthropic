<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}

include 'models/User.php';
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
                        <a href="client_view.php"><?php echo trans('users'); ?></a>
                    </li>
                    <li class="active">
                        <?php echo trans('viewAll'); ?>
                    </li>
                </ol>
            </div>



            <?php
            $items = isset($_GET['items']) ? (int) $_GET['items'] : 10;
            $query_items = '';
            if ($items > 0) {
                $query_items = '&items=' . $items;
            }

            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $page = ($page < 1) ? 1 : $page;
            $start = ($page - 1) * $items;
            $userObj = new User();
            $allData = $userObj->getAll($start, $items, $_GET);  //echo '<pre>'; print_r($allData); die();
            $data_num = count($allData);
            $url = "user_view.php?items=" . $items;
            $navigation = navigationHomee($data_num, $start, count($allData), $url, $items);
            ?>
            <div class="card-box table-responsive">
                <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <table  class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo trans('user_name'); ?></th>
                                <th><?php echo trans('email'); ?></th>
                                <th><?php echo trans('phone'); ?></th>
                                <th><?php echo trans('status'); ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $x = 1;
                            foreach ($allData as $key => $row) {
                                $id = $row['id'];
                                $name = $row['username'];
                                $email = $row['email'];
                                $phone = $row['mobile'];
                                $status = $row['status'];
                                $image = $row['image'];
                                ?>
                                <tr>
                                    <td><?php echo $x; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $phone; ?></td>
                                    <td style="text-align:center;" class="mousta">
                                        <?php
                                        if ($status == 0) {
                                            echo '<div class="verifyMeTwo"><a>' . trans('disable') . '</a><br /><br /><a lang="' . $id . '" class="btn btn-info waves-effect waves-light btn-sm verify">' . trans('enable') . '</a></div>';
                                        } else {
                                            echo '<div class="cancelVerifyMeTwo"><a>' . trans('enable') . '</a><br /><br /><a lang="' . $id . '" class="btn btn-info waves-effect waves-light btn-sm cancel_verify">' . trans('disable') . '</a></div>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="user_edit.php?id=<?php echo $id; ?>" class="on-default"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:;" data-id="<?php echo $id; ?>" data-image="<?php echo $image; ?>" class="deletemsg" ><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $x++;
                            }
                            ?>
                            <?php if ($data_num == 0) { ?>
                                <tr class="selectable" >
                                    <td colspan="7" class="center uniformjs" style="text-align: center"><?php echo trans('noElements'); ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div class="pull-left" style="width: auto; ">
                            <?php echo $navigation; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="deletedSuccess" class="bg-success" style="display: none; position: fixed; top: 10px; left: 10px; z-index: 9999; padding: 10px;">
    <h4 class="text-white">Deleted Successfully</h4>
</div>
<?php include("include/footer_text.php"); ?>

<?php include("include/footer.php"); ?>


<script type="text/javascript">
    $('body').on('click', '.verify', function () {
        var id = $(this).attr('lang');
        bootbox.dialog({
            message: "<?php echo trans('activationMessage'); ?>",
            title: "<?php echo trans('activationTitle'); ?>",
            buttons: {
                danger: {
                    label: "<?php echo trans('cancel'); ?>",
                    className: "btn-danger"
                },
                main: {
                    label: "<?php echo trans('confirm'); ?>",
                    className: "btn-primary",
                    callback: function () {
                        //do something else
                        $.ajax({
                            type: "POST",
                            url: "user.php",
                            data: {type: "enable", id: id},
                            dataType: 'text',
                            cache: false,
                            success: function () {
                                location.reload()
                            }
                        });
                    }
                }
            }
        });
    });


    $('body').on('click', '.cancel_verify', function () {
        var id = $(this).attr('lang');
        bootbox.dialog({
            message: "<?php echo trans('deactivationMessage'); ?>",
            title: "<?php echo trans('deactivationTitle'); ?>",
            buttons: {
                danger: {
                    label: "<?php echo trans('cancel'); ?>",
                    className: "btn-danger"
                },
                main: {
                    label: "<?php echo trans('confirm'); ?>",
                    className: "btn-primary",
                    callback: function () {
                        //do something else
                        $.ajax({
                            type: "POST",
                            url: "user.php",
                            data: {type: "disable", id: id},
                            dataType: 'text',
                            cache: false,
                            success: function () {
                                location.reload()
                            }
                        });
                    }
                }
            }
        });
    });

    $('body').on('click', '.deletemsg', function () {
        let id = $(this).attr('data-id');
        let image = $(this).attr('data-image');
        bootbox.dialog({
            message: "<?php echo trans('askDelete'); ?>",
            title: "<?php echo trans('confirmDelete'); ?>",
            buttons: {
                danger: {
                    label: "<?php echo trans('cancel'); ?>",
                    className: "btn-danger"
                },
                main: {
                    label: "<?php echo trans('confirm'); ?>",
                    className: "btn-primary",
                    callback: function () {
                        //do something else
                        $.ajax({
                            type: "POST",
                            url: "user.php",
                            data: {
                                type: "delete",
                                id: id,
                                image: image
                            },
                            dataType: 'text',
                            cache: false,
                            success: function (data) {
                                $("#deletedSuccess").show();
                                setTimeout(function(){ location.reload(); }, 2000);
                            }
                        });
                    }
                }
            }
        });
    });


</script>

</body>
</html>