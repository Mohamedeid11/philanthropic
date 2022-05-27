<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
include 'models/MediaCenter.php';
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
                <h4 class="page-title"><?php echo trans('media_center'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="media_center_view.php"><?php echo trans('media_center'); ?></a>
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
            $media_centerObj = new MediaCenter();
            $data_num = $media_centerObj->count($_GET);
            $allData = $media_centerObj->getAll($start, $items, $_GET);  //echo '<pre>'; print_r($allData); die();
            $url = "media_center_view.php?items=" . $items;
            $navigation = navigationHomee($data_num, $start, count($allData), $url, $items);
            ?>
            <div class="card-box table-responsive">
                <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <table  class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo trans('title_ar'); ?></th>
                                <th><?php echo trans('title_en'); ?></th>
                                <th><?php echo trans('image'); ?></th>
                                <th><?php echo trans('status'); ?></th>
                                <th><?php echo trans('date'); ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $x = 1;
                            foreach ($allData as $key => $row) {
                                $id = $row['id'];
                                $title_ar = $row['title_ar'];
                                $title_en = $row['title_en'];
                                $image = $row['image'];
                                $display = $row['display'];
                                $date = $row['date'];

                                ?>
                                <tr>
                                    <td><?php echo $x; ?></td>
                                    <td><?php echo $title_ar; ?></td>
                                    <td><?php echo $title_en; ?></td>
                                    <td><a href="<?php echo $image; ?>"><img src="<?php echo $image; ?>" width="90" height="90"></a></td>
                                    <td>
                                        <?php if ($display == 1) { ?>
                                            <input class="change_status_off"   data-id="<?php echo $id; ?>" type="checkbox" checked data-plugin="switchery" data-color="#81c868"/>
                                        <?php } else { ?>
                                            <input class="change_status_on"  data-id="<?php echo $id; ?>" type="checkbox" data-plugin="switchery" data-color="#81c868"/>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $date; ?></td>

                                    <td>
                                        <a href="media_center_details.php?media_center_id=<?= $id; ?>" class="on-default"><i class="fa fa-eye"></i></a>

                                        <a href="media_center_edit.php?media_center_id=<?php echo $id; ?>" class="on-default"><i class="fa fa-pencil"></i></a>

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
    let lang = $('#pageLang').val();

    $('body').on('change', '.change_status_off', function () {
        let id = $(this).attr('data-id');

        swal({
            title: "<?php echo trans('confirmHidding'); ?>",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dd6b55",
            confirmButtonText: "<?php echo trans('yes'); ?>",
            cancelButtonText: "<?php echo trans('cancel'); ?>",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                swal("<?php echo $languages[$lang]["changed"]; ?>", "", "success");
                $.ajax({
                    type: "POST",
                    url: "media_center.php",
                    data: {
                        id: id,
                        type: 'hidden'
                    },
                    dataType: 'text',
                    cache: false,
                    success: function (data) {
                        $(".deleteData").html(data);
                    }
                });
            } else {
                swal("<?php echo $languages[$lang]["changed"]; ?>", "<?php echo $languages[$lang]["changed"]; ?> :)", "error");
            }
        });
    });
    $('body').on('change', '.change_status_on', function () {
        var id = $(this).attr('data-id');

        swal({
            title: "<?php echo trans('changeStatus'); ?>",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo trans('yes'); ?>",
            cancelButtonText: "<?php echo trans('cancel'); ?>",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                swal("<?php echo $languages[$lang]["changed"]; ?>", "", "success");
                $.ajax({
                    type: "POST",
                    url: "media_center.php",
                    data: {
                        id: id,
                        type: 'visible'
                    },
                    dataType: 'text',
                    cache: false,
                    success: function (data) {
                        $(".deleteData").html(data);
                    }
                });
            } else {
                swal("<?php echo $languages[$lang]["changed"]; ?>", "<?php echo $languages[$lang]["changed"]; ?> :)", "error");
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
                            url: "media_center.php",
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