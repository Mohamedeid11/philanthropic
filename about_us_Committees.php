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
                            <h1 class="text-white font-weight-bold"><?=trans('committees')?></h1>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent d-flex justify-content-center">
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?=trans('home')?></a></li>
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?=trans('about_us')?> </a></li>
                                <li class="breadcrumb-item active text-white h5  oppacity" aria-current="page"><?=trans('committees')?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!--end Breadcrumb-->


        <!--start about us Committees-->

        <div class="committees my-4">
            <div class="container">
                <?php
                $committyObj = new Committees();
                $committees_data = $committyObj->getActive();

                foreach ($committees_data as $committy){

                    $name = $committy['name_' . $lang];
                    $position = $committy['position_' . $lang];
                    $title = $committy['title_' . $lang];
                    $desc = $committy['desc_' . $lang];
                    $image = $committy['image'];
                    ?>
                <div class="my-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-7">
                            <div class="m-3">
                                <h5 class="main_text main_bold py-3"><?= $title ?></h5>
                                <p style="white-space: pre-line"><?= $desc ?> </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="m-3">
                                <div class="d-flex justify-content-center">
                                    <div class="card shadow point rounded" style="width: 15rem">
                                        <div class="overflow-hidden m-2">
                                            <img src="<?= $image ?>" class="img-fluid w-100 rounded" alt="man">
                                        </div>
                                        <div class="card-body text-center p-2">
                                            <h5 class="main_text"><?= $name ?></h5>
                                            <span><?= $position ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="thin_border">
                <?php }?>
            </div>
        </div>

        <!--end about us Committees-->


<?php

include('include/footer.php');

?>