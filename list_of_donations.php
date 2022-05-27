<?php
include("system/config.php");

include('include/head.php');

if (isset($_GET['cart_id'])) {

    $cartObj = new Cart();
    $cartObj->delete($_GET['cart_id']);

    header('Location: list_of_donations.php');
}

include('include/header.php');
?>

        <!--start Breadcrumb-->
        <div class="bread py-4">
            <div class="container">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="">
                        <div class="text-center my-3">
                            <h1 class="text-white font-weight-bold"> <?=trans('donates_list')?></h1>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent d-flex justify-content-center">
                                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?=trans('home')?></a></li>
                                <li class="breadcrumb-item active text-white h5  oppacity" aria-current="page"><?=trans('donates_list')?> </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!--end Breadcrumb-->


        <!--start list donations-->

        <div class="list_donations">
            <div class="container">
                <div class="p-3">
                    <h6 class="main_text main_bold py-3"><?=trans('cart_details')?> </h6>
                    <div class="my-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="main_bold main_text"><?=trans('details')?></th>
                                    <th scope="col" class="main_bold main_text"><?=trans('price')?></th>
                                    <th scope="col" class="main_bold main_text"><?=trans('delete')?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                            $cartObj = new Cart();
                            $donateObj = new Donate();

                            $client_id = $_SESSION['client_id'];

                            $cart_data = $cartObj->NotConfirmed($client_id);
                            $count_card = count($cart_data);
                            $total = 0 ;
                            foreach ($cart_data as $cart){
                                $cart_id = $cart['id'];
                                $donate_id = $cart['donate_id'];
                                $total += $cart['price'];
                                $price = $cart['price'];


                            $donate = $donateObj->getById($donate_id);
                            $get_donate_id = $donate['id'];
                            $title = $donate['title_' . $lang];
                            $donate_price = $donate['price'];
                            $image = $donate['image'];
                            ?>
                                <tr>
                                    <td class="oppacity"><?=$title ?></td>
                                    <td class="oppacity"><?=$price ?> <?=trans('bhd')?></td>
                                    <td class="text-left">
                                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?cart_id=<?=$cart_id?>"><i class="icon-bin2 main_link_1 h5 "></i></a>
                                    </td>
<!--                                    <td class="text-left"><i class="icon-bin2 point main_link_1 h5 transition-me"></i></td>-->
                                </tr>
                                <?php
                            }


                            ?>
                            <tr>
                                <th class="oppacity" colspan="2"><?= trans('total')?></th>
                                <td class="oppacity"><?=$total ?> <?=trans('bhd')?></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="row py-4">
                        <div class="col-12 col-md-4">
                            <div class="d-flex justify-content-between">
                                <?php if ($count_card > 0) { ?>
                                <div class="mx-1 w-100">
                                    <a href="order_confirm.php" id="confirm-order">
                                        <button class="last_bt rounded py-2 w-100 thin_border transition-me"><?=trans('confirm')?></button>
                                    </a>
                                </div>
                                <?php } ?>
                                <div class="mx-1 w-100">
                                    <a href="Donation.php">
                                        <button class="last_bt rounded py-2 w-100 thin_border transition-me"><?=trans('back_projects')?></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end list donations-->

<?php

include('include/footer.php');

?>

