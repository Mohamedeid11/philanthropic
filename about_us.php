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
                            <h1 class="text-white font-weight-bold"><?= trans('about')?></h1>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent">
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?= trans('home')?></a></li>
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?= trans('about_us')?> </a></li>
                                <li class="breadcrumb-item active text-white h5  oppacity" aria-current="page"><?= trans('about')?> </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!--end Breadcrumb-->


        <!--start about us-->

        <div class="about my-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <?php
                        $aboutObj = new About();
                        $about_data = $aboutObj->getActive();

                        foreach ($about_data as $about){

                            $title = $about['title_' . $lang];
                            $desc = $about['desc_' . $lang];

                            ?>
                        <div class="m-3">
                            <h5 class="main_text main_bold py-2"><?= $title ?></h5>
                            <p class=""><?= $desc ?>.</p>
                        </div>
                        <hr class="thin_border">
                        <?php } ?>

                    </div>
                    <div class="col-12 col-md-4">
                        <div class="m-3">
                            <img src="<?= $setting_header_logo ?>" class="img-fluid w-100" alt="logo">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end about us-->


<?php

include('include/footer.php');

?>