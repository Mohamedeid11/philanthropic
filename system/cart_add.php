<?php
include("config.php");
include 'models/Cart.php';
include 'models/DonateType.php';
include 'models/Donate.php';
include 'models/Client.php';
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {

    $client_id = mysqli_real_escape_string($con, trim($_POST['client_id']));
    $donate_type_id = mysqli_real_escape_string($con, trim($_POST['donate_type_id']));
//    $donate_id = mysqli_real_escape_string($con, trim($_POST['donate_id']));
    $donate_id = $_POST['donate_id'];
    $price = mysqli_real_escape_string($con, trim($_POST['price']));
    $notes = mysqli_real_escape_string($con, trim($_POST['notes']));

    $errors = array();

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {

        $cartObj = new Cart();
        $id = $cartObj->create([
            'client_id' => $client_id,
            'donate_type_id' => $donate_type_id,
            'donate_id' => $donate_id,
            'price' => $price,
            'notes' => $notes,
            'date' => date('Y-m-d h:i'),
        ]);


        echo get_success("Added Successfully");
//        echo "<meta http-equiv='refresh' content='0'>";
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
                <h4 class="page-title"><?= trans('cart'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="cart_view.php"><?= trans('cart'); ?></a>
                    </li>
                    <li class="active">
                        <?= trans('add_cart'); ?>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" data-parsley-validate novalidate>

                        <div class="form-group col-md-3">
                            <label for="types"><?= trans('donate_type'); ?></label>
                            <select type="text" class="form-control" id="donate-type" name="donate_type_id">
                                <option value=""><?= trans('choose'); ?></option>
                                <?php
                                $donate_typeObj = new DonateType();
                                $donate_types = $donate_typeObj->getActive();
                                foreach ($donate_types as $donate_type) {
                                    ?>
                                    <option value="<?= $donate_type['id'] ?>"><?= $donate_type['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-md-5" id="client-id">
                            <label for="categories"><?= trans('client'); ?></label>
                            <select class="form-control"  name="client_id">
                                <option value="0"><?= trans('choose'); ?></option>
                                <?php
                                $clientObj = new Client();
                                $clients = $clientObj->getVerified();
                                foreach ($clients as $client) {
                                    $get_client_id = $client['id'];
                                    $client_name = $client['name'] ;
                                    ?>
                                    <option value="<?= $get_client_id ?> " data-id = <?= $get_client_id ?>><?= $client_name ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-md-12" id="donate-id" >
                                <label for="categories"><?= trans('donates'); ?></label> <br/>
    <!--                            <select class="form-control" id="donate-id" name="donate_id">-->
    <!--                                <option value="0">--><?//= trans('choose'); ?><!--</option>-->
                                    <?php
                                    $donateObj = new Donate();
                                    $donates = $donateObj->getActive();
                                    foreach ($donates as $donate) {
                                        $get_donate_id = $donate['id'];
                                        $donate_title_ar = $donate['title_ar'] ;
                                        $donate_title_en = $donate['title_en'] ;
                                        ?>
                                        <input type="checkbox" name="donate_id[]" value="<?= $get_donate_id ?> " data-id = <?= $get_donate_id ?>> <?= $donate_title_ar ?> - <?= $donate_title_en ?> <br/>
                                    <?php } ?>
<!--                            </select>-->
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-md-5" id="Price" style="display: none">
                            <label for="price"><?= trans('price'); ?></label>
                            <input type="number" name="price"  parsley-trigger="change" required placeholder="<?= trans('price'); ?>" class="form-control" >
                        </div>

                        <div class="form-group col-md-7" id="Notes" style="display: none">
                            <label><?= trans('notes'); ?></label>
                            <textarea name="notes"  class="form-control"></textarea>
                        </div>

                        <div class="clearfix"></div>

                        <br />
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-center p-20">
                                    <button type="reset" class="btn w-sm btn-white waves-effect"><?= trans('cancel'); ?></button>
                                    <button type="submit" name="submit" class="btn w-sm btn-default waves-effect waves-light"><?= trans('add'); ?></button>
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

<!--Script For Showing and hiding  Forms -->
<script>
    $('#donate-type').change(function () {

        if ($(this).val() ==  2 ) {
            $('#client-id').show();
            $('#donate-id').show();
            $('#Price').hide();
            $('#Notes').show();
        }
        if($(this).val() ==  1) {
            $('#client-id').hide();
            $('#donate-id').hide();
            $('#Price').show();
            $('#Notes').show();
        }

    })

    //    Fetch Select Category
    $('#client').change(function (){
        let mainCategoryId = $(this).val();
        $.ajax({
            type: 'post',
            url: 'categories.php',
            data: {
                mainId:mainCategoryId
            },
            success: function (response) {
                document.getElementById("category_select").innerHTML=response;
            }
        });
    });


</script>



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