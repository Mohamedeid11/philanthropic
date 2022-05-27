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
                        <h1 class="text-white font-weight-bold"><?= trans('media_center')?></h1>
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent d-flex justify-content-center">
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?= trans('home')?></a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?= trans('media_center')?></a></li>
                            <li class="breadcrumb-item active text-white h5  oppacity" aria-current="page"><?= trans('news')?></li>
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
            <div class="row">
                <?php
                if (isset($_GET['media_center_id'])) {
                $media_center_id  = $_GET['media_center_id'] ;
                $media_centerObj = new MediaCenter();
                    $media_center = $media_centerObj->getById($media_center_id);

                    $title = $media_center['title_' . $lang];
                    $desc = $media_center['desc_' . $lang];
                    $image = $media_center['image'];
                    ?>
                    <div class="my-4">
                        <div class="d-flex justify-content-center">
                            <div class="overflow-hidden col-md-8">
                                <img src="<?=$image ?>" class="img-fluid w-100 transition-me" alt="images11">
                                <h6 class="d-flex justify-content-center font-weight-bold my-2 main_text transition-me"><?=$title?></h6>

                                <p class=" teny_size"style="white-space: pre-line"><?=$desc?>.</p>
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