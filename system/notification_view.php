<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
include 'models/Notification.php';
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
                <h4 class="page-title"><?php echo trans('notifications'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="notification_view.php"><?php echo trans('notifications'); ?></a>
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
            $notificationsObj = new Notification();
            $data_num = $notificationsObj->count($_GET);
            $allData = $notificationsObj->getAll($start, $items, $_GET);  //echo '<pre>'; print_r($allData); die();
            $url = "client_view.php?items=" . $items;
            $navigation = navigationHomee($data_num, $start, count($allData), $url, $items);
            ?>
            <div class="card-box table-responsive">
                <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <table  class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo trans('name_ar'); ?></th>
                                <th><?php echo trans('name_en'); ?></th>
                                <th><?php echo trans('link'); ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $x = 1;
                            foreach ($allData as $key => $row) {
                                $id = $row['id'];
                                $name_ar = $row['name_ar'];
                                $name_en = $row['name_en'];
                                $link = $row['link'];
                                ?>
                                <tr>
                                    <td><?php echo $x; ?></td>
                                    <td><?php echo $name_ar; ?></td>
                                    <td><?php echo $name_en; ?></td>
                                    <td><?php echo $link; ?></td>
                                    <td>
                                        <a href="javascript:;" data-id="<?php echo $id; ?>" data-image="<?php echo $client_image; ?>" class="deletemsg" ><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $x++;
                            }
                            ?>
                            <?php if ($data_num == 0) { ?>
                                <tr class="selectable" >
                                    <td colspan="5" class="center uniformjs" style="text-align: center"><?php echo trans('noElements'); ?></td>
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
    $('body').on('click', '.deletemsg', function () {
        let id = $(this).attr('data-id');
        bootbox.dialog({
            message: "<?php echo trans('askDelete'); ?>",
            title: "<?php echo trans('confirmDelete'); ?>", buttons: {
                danger: {
                    label: "<?php echo trans('cancel'); ?>",
                    className: "btn-danger"
                },
                main: {
                    label: "<?php echo trans('delete'); ?>", className: "btn-primary",
                    callback: function () {
                        //do something else
                        $.ajax({
                            type: "POST",
                            url: "notification.php",
                            data: {
                                type: "delete",
                                id: id
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