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
                        <?= trans('viewAll'); ?>
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
            $messageObj = new Message();
            $data_num = $messageObj->count($_GET);
            $allData = $messageObj->getAll($start, $items, $_GET);  //echo '<pre>'; print_r($allData); die();
            $url = "messages_view.php?items=" . $items;
            $navigation = navigationHomee($data_num, $start, count($allData), $url, $items);
            ?>
            <div class="card-box table-responsive">
                <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <table  class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?= trans('name'); ?></th>
                                <th><?= trans('email'); ?></th>
                                <th><?= trans('address'); ?></th>
                                <th><?= trans('date'); ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $x = 1;
                            foreach ($allData as $key => $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $address = $row['address'];
                                $content = $row['content'];
                                $date = $row['date'];
                                ?>
                                <tr>
                                    <td><?= $x; ?></td>
                                    <td><?= $name; ?></td>
                                    <td><?= $email; ?></td>
                                    <td><?= $address; ?></td>
                                    <td><?= $date; ?></td>
                                    <td>
                                        <a href="messages_details.php?message_id=<?= $id; ?>" class="on-default"><i class="fa fa-eye"></i></a>

                                        <a href="javascript:;" data-id="<?= $id; ?>" class="deletemsg" ><i class="fa fa-trash-o"></i></a>
                                    </td>

                                </tr>
                                <?php
                                $x++;
                            }
                            ?>
                            <?php if ($data_num == 0) { ?>
                                <tr class="selectable" >
                                    <td colspan="7" class="center uniformjs" style="text-align: center"><?= trans('noElements'); ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div class="pull-left" style="width: auto; ">
                            <?= $navigation; ?>
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
    let lang = $('#pageLang').val();

    $('body').on('click', '.deletemsg', function () {
        let id = $(this).attr('data-id');
        bootbox.dialog({
            message: "<?= trans('askDelete'); ?>",
            title: "<?= trans('confirmDelete'); ?>",
            buttons: {
                danger: {
                    label: "<?= trans('cancel'); ?>",
                    className: "btn-danger"
                },
                main: {
                    label: "<?= trans('confirm'); ?>",
                    className: "btn-primary",
                    callback: function () {
                        //do something else
                        $.ajax({
                            type: "POST",
                            url: "messages.php",
                            data: {
                                type: "delete",
                                id: id,
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