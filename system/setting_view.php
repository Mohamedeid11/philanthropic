<?php
include("config.php");
if (!loggedin()) {
    header("location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<?php include("include/heads.php"); ?>
<style>
    .pager  .active   a {
        background-color: #448bf4;

    }
</style>
<?php include("include/leftsidebar.php"); ?>

<!-- Start right Content here -->
<div class="deleteData"></div>

<div class="wrapper">
    <div class="container">    <!-- Start content -->
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title"><?php echo trans('settings'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="setting_view.php"><?php echo trans('settings'); ?></a>
                    </li>
                    <li class="active"><?php echo trans('viewAll'); ?></li>
                </ol>
            </div>

            <?php
            $items = isset($_GET['items']) ?  (int) $_GET['items'] : 10;
            $query_items = '';
            if ($items > 0) {
                $query_items = '&items=' . $items;
            }

            $page = isset($_GET['page']) ? (int) $_GET['page'] : 10;
            $page = ($page < 1) ? 1 : $page;
            $start = ($page - 1) * $items;
            include 'models/Setting.php';
            $settingObj = new Setting();
            $data_num = $settingObj->count($_GET); //echo $data_num; die();
            $allData = $settingObj->getAll(0, 0 , 0);  //echo '<pre>'; print_r($allData); die();
            $url = "setting_view.php?items=" . $items ;
            $navigation = navigationHomee($data_num, $start, count($allData), $url, $items);
            ?>
            <div class="card-box table-responsive">
                <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <table  class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo trans('key'); ?></th>
                                <th><?php echo trans('value'); ?></th>
                                <th><?php echo trans('display'); ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody> <?php
                            $x = 1;
                            foreach ($allData as $key => $row) {
                                $id = $row['id'];
                                $key = $row['key'];
                                $value = $row['value'];
                                $display = $row['display'];

                                ?>
                                <tr class="gradeX <?php echo $id; ?>">
                                    <td><?php echo $x; ?></td>
                                    <td><?php echo $key; ?></td>
                                    <td><?php echo $value; ?></td>
                                    <td>
                                        <?php if ($display == 1) { ?>
                                            <input class="change_status_off"   data-id="<?php echo $id; ?>" type="checkbox" checked data-plugin="switchery" data-color="#81c868"/>
                                        <?php } else { ?>
                                            <input class="change_status_on"  data-id="<?php echo $id; ?>" type="checkbox" data-plugin="switchery" data-color="#81c868"/>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <a href="setting_edit.php?id=<?php echo $id; ?>" class="on-default"><i class="fa fa-pencil"></i></a>
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
<?php include("include/footer_text.php"); ?>


<?php include("include/footer.php"); ?>

<script type="text/javascript">
    $("#navigation ul>li").removeClass("active");
    $("#item3").addClass("active");
</script>

<script>
    $('.select2me').select2({
        placeholder: "Select",
        width: 'auto',
        allowClear: true
    });

    let lang = $('#pageLang').val();

    $('body').on('change', '.change_status_off', function () {
        let id = $(this).attr('data-id');

        swal({
            title: "<?php echo trans('confirmHidding'); ?>",
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
                    url: "setting.php",
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
                    url: "setting.php",
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


</script>

</body>
</html>