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
                            <h1 class="text-white font-weight-bold"><?= trans('magazines')?></h1>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent d-flex justify-content-center">
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?= trans('magazines')?></a></li>
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?= trans('media_center')?> </a></li>
                                <li class="breadcrumb-item active text-white h5  oppacity" aria-current="page"><?= trans('magazines')?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!--end Breadcrumb-->


        <!--start Donation-->

        <div class="donation my-4">
            <div class="container">
                <h4 class="font-weight-bold py-4 text-center"><?=trans('about_magazine')?> </h4>
                <div class="row">
                    <?php
                    $magazineObj = new Magazine();
                    $magazine_data = $magazineObj->getActive();

                    foreach ($magazine_data as $magazine){

                    $title = $magazine['title_' . $lang];
                    $image = $magazine['image'];
                    ?>
                    <div class="col-12 col-md-4">
                        <div class="m-3 p-3">
                            <img src="<?=$image ?>" class="img-fluid" alt="Screenshot">
                            <a href="#" class="text-decoration-none main_link_1 transition-me h5"><?=$title?></a>
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
