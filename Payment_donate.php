<?php
include("system/config.php");

include('include/head.php');
include('include/header.php');
?>
    <!--start Breadcrumb-->
    <div class="bread py-4">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <div class="">
                    <div class="text-center my-3">
                        <h1 class="text-white font-weight-bold"><?=trans('donates')?></h1>
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent d-flex justify-content-center">
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?=trans('home')?></a></li>
                            <li class="breadcrumb-item active text-white h5  oppacity" aria-current="page"><?=trans('donates')?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--end Breadcrumb-->
<?php

if(isset($_GET['payment'])){

    $cartObj = new Cart();
    $orderObj = new Orders();
    $client_id = $_SESSION['client_id'];

    $donate_type = 1 ;

    $payment_method = $_POST['payment_method'] ;

    $price = $_POST['price'] ;

    $confirm = $orderObj->create([
        'donate_type' => $donate_type,
        'client_id' => $client_id,
        'payment_method' => $payment_method,
        'total_price' => $price,
        'date' => date('Y-m-d'),
    ]);
    if ($confirm) {
        echo '<script type="text/javascript">';
        echo 'alert("Your Donate Has been Confirmed!")';
        echo '</script>';
    }
}
?>

    <div class="donation my-4">
        <div class="container">
            <div class="row">
                <form method="POST"  action="<?php echo $_SERVER['PHP_SELF']; ?>?payment" enctype="multipart/form-data" data-parsley-validate novalidate>
                    <input type="hidden" name="client_id" parsley-trigger="change" value="<?php echo $_SESSION['client_id']; ?>" required >

                    <div class="position-relative my-2">
                        <input type="number" name="price" required placeholder="<?php echo trans('price'); ?>" class="w-100 px-5 py-2 rounded thin_border main_bold" >
                    </div>
                    <?php
                    $payment_methodObj = new PaymentMethod();
                    $payment_method_data = $payment_methodObj->getActive();

                    foreach ($payment_method_data as $payment_method){

                        $payment_method_id = $payment_method['id'];
                        $payment_method_title = $payment_method['title_' . $lang];
                        ?>
                        <div class="position-relative my-2">
                            <input type="radio" name="payment_method" parsley-trigger="change" required class="m-3 px-5 py-2 rounded thin_border main_bold" value="<?=$payment_method_id?>"/><?=$payment_method_title?>
                        </div>
                    <?php }?>
                    <button type="submit" name="submit" class="last_bt rounded py-2 w-100 thin_border transition-me my-4 main_bold"><?php echo trans('send'); ?></button>
                </form>
            </div>
        </div>
    </div>
<?php

include('include/footer.php');

?>