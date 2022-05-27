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
                            <h1 class="text-white font-weight-bold"><?=trans('founders')?></h1>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent">
                                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?=trans('home')?></a></li>
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"> <?=trans('about_us')?></a></li>
                                <li class="breadcrumb-item active text-white h5  oppacity" aria-current="page"><?=trans('founders')?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!--end Breadcrumb-->


        <!--start about us founders-->

        <div class="founders my-4">
            <div class="container">
                <div class="d-flex justify-content-center my-4">
                    <p class="main_bold h5"><?=trans('bahrain_charitable_society_was_founded_by_a_good_elite_of_patriots')?></p>
                </div>

                <div class="directors">
                    <div class="row">
                        <?php
                        $founderObj = new Founders();

                        $founder_data = $founderObj->getActive();
                        $data_count = count($founder_data);
                        $x = 1 ;
                        foreach ($founder_data as $one){
                            $name = $one['name_' . $lang];
                            $position = $one['position_' . $lang];
                            $image = $one['image'];
                            ?>
                            <div class="col-12 col-md-4 d-none d-md-block">
                                <div class="d-flex justify-content-center">
                                    <div class="card shadow point rounded mt-5" style="width: 15rem">
                                        <div class="overflow-hidden m-2">
                                            <img src="<?= $image ?>" class="img-fluid w-100 rounded" alt="man">
                                        </div>
                                        <div class="card-body text-center p-2">
                                            <h5 class="main_text"><?= $name; ?></h5>
                                            <span><?= $position; ?> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $x++;
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>

        <!--end about us founders-->


<?php

include('include/footer.php');

?>
