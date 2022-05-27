<?php
include("system/config.php");

include('include/head.php');
include('include/header.php');
?>

        <!--start Breadcrumb-->

        <div class="bread py-4">
            <div class="container-fluid">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="">
                        <div class="text-center my-3">
                            <h1 class="text-white font-weight-bold"><?=trans('projects')?></h1>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent d-flex justify-content-center">
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?=trans('home')?></a></li>
                                <li class="breadcrumb-item active text-white h5  oppacity" aria-current="page"><?=trans('projects')?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!--end Breadcrumb-->
<?php

if (isset($_POST['client_id'])) {

    $cartObj = new Cart();

    $client_id = $_POST['client_id'];
    $donate_id = $_POST['donate_id'];
    $price = $_POST['price'];
    $status = 0;

    $errors = array();

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {
       $created = $cartObj->create([
            'client_id' => $client_id,
            'donate_id' => $donate_id,
            'price' => $price,
            'status' => $status,
            'date' => date('Y-m-d'),
        ]);
    }
}
?>

        <!--start Donation-->

        <div class="donation my-4">
            <div class="container-fluid">
                <div class="row">
                <?php
                $donateObj = new Donate();
                $donate_data = $donateObj->getActive();

                foreach ($donate_data as $donate){

                    $donate_id = $donate['id'];
                    $title = $donate['title_' . $lang];
                    $price = $donate['price'];
                    $image = $donate['image'];
                    ?>
                    <div class="col-12 col-md-4">
                        <div class="m-4 d-flex justify-content-center">
                            <div class="card point thin_border rounded" style="width: 22rem">
                                <div class="overflow-hidden rounded">
                                    <img src="<?= $image ?>" class="img-fluid rounded transition-me" alt="maintenance">
                                </div>
                                <div class="body_card_1 p-2">
                                    <h6 class="main_bold transition-me"><?= $title ?></h6>
                                    <span class="main_text teny_size"><?=trans('price')?> <?= $price ?> <?=trans('bhd')?></span>
                                    <div class="d-flex justify-content-between my-2">
                                        <?php if (Clientloggedin()) { ?>
                                        <form role="form" method="POST" id="cart-form"  >
                                            <div class="row rowpadding6">
                                                <input type="hidden" name="donate_id"  id="donate_id_update" parsley-trigger="change"  value="<?php echo $donate_id; ?>" required >

                                                <input type="hidden" name="client_id" parsley-trigger="change" value="<?php echo $_SESSION['client_id']; ?>" required >

                                                <input type="hidden" name="price" parsley-trigger="change" value="<?php echo $price?>" required >

                                                <button  type="submit" name="submit" class="last_bt rounded main_bordrer transition-me teny_size py-2" ><?php echo trans('add_to_donate'); ?></button>
                                            </div>
                                        </form>
                                        <?php }else{ ?>
                                            <a href="login.php">
                                                <button class="last_bt rounded main_bordrer transition-me teny_size py-2" ><?php echo trans('add_to_donate'); ?></button>
                                            </a>
                                        <?php } ?>
                                        <a href="Payment_donate.php">
                                            <button class="last_bt rounded main_bordrer transition-me teny_size py-2" ><?php echo trans('fast_donate'); ?></button>
                                        </a>
                                        <!--                                        <button class="last_bt rounded main_bordrer transition-me teny_size py-2">--><?//=trans('add_to_donate')?><!--</button>-->
<!--                                        <button class="last_bt rounded main_bordrer transition-me teny_size py-2 px-4">--><?//=trans('fast_donate')?><!-- </button>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

                </div>
            </div>
        </div>

        <!--end Donation-->

<?php

include('include/footer.php');

?>