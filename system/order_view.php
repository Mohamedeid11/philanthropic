<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
include 'models/Orders.php';
include 'models/Client.php';
include 'models/DonateType.php';
include 'models/PaymentMethod.php';
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
                <h4 class="page-title"><?php echo trans('order'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="order_view.php"><?php echo trans('order'); ?></a>
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
            $orderObj = new Orders();
            $data_num = $orderObj->count($_GET);
            $allData = $orderObj->getAll($start, $items, $_GET);  //echo '<pre>'; print_r($allData); die();
            $url = "order_view.php?items=" . $items;
            $navigation = navigationHomee($data_num, $start, count($allData), $url, $items);
            ?>
            <div class="card-box table-responsive">
                <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <table  class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo trans('client_name'); ?></th>
                                <th><?php echo trans('phone'); ?></th>
                                <th><?php echo trans('donate_type'); ?></th>
                                <th><?php echo trans('payment_method'); ?></th>
                                <th><?php echo trans('total_price'); ?></th>
                                <th><?php echo trans('date'); ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $x = 1;
                            foreach ($allData as $key => $row) {
                                $id = $row['id'];
                                $donate_type_id = $row['donate_type'];
                                $client_id = $row['client_id'];
                                $cart_id = $row['cart_id'];
                                $payment_method = $row['payment_method'];
                                $total_price = $row['total_price'];
                                $date = $row['date'];

                                ?>
                                <tr>
                                    <td><?php echo $x; ?></td>

                                    <?php
                                    $clientObj = new Client();
                                    $data = $clientObj->getActiveByID($client_id);
                                    foreach($data as $key => $row2){
                                        $client_id = $row2['id'];
                                        $client_name = $row2['name'];
                                        $client_mobile  = $row2['mobile'];
                                        ?>
                                        <td><?= $client_name; ?></td>
                                        <td><?= $client_mobile; ?></td>
                                    <?php } ?>

                                    <?php
                                    $donate_typeObj = new DonateType();
                                    $data = $donate_typeObj->getActiveByID($donate_type_id);
                                    foreach($data as $key => $row2){
                                        $donate_type_id = $row2['id'];
                                        $donate_type_name = $row2['name'];
                                        ?>

                                        <td><?= $donate_type_name; ?></td>
                                    <?php } ?>

                                    <?php
                                    $paymentObj = new PaymentMethod();
                                    $data = $paymentObj->getActiveByID($payment_method);
                                    foreach($data as $key => $row2){
                                        $payment_id = $row2['id'];
                                        $payment_title = $row2['title_' . $lang];
                                        ?>

                                        <td><?= $payment_title; ?></td>

                                    <?php } ?>

                                    <td><?php echo $total_price; ?></td>

                                    <td><?php echo $date; ?></td>

                                    <td>
                                        <!--                                        <a href="order_details.php?order_id=--><?//= $id; ?><!--" class="on-default"><i class="fa fa-eye"></i></a>-->

                                        <a href="order_edit.php?order_id=<?php echo $id; ?>" class="on-default"><i class="fa fa-pencil"></i></a>

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
                    url: "orders.php",
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
                    url: "orders.php",
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
                            url: "orders.php",
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