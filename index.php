<?php
include("system/config.php");

include('include/head.php');
include('include/header.php');
?>
        <!--start main slider-->

        <div class="main_slider">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                        $sliderObj = new Slider();
                        $slider_data = $sliderObj->getActive();
                        $x = 1 ;
                        foreach ($slider_data as $slider){

                        $image = $slider['image'];
                    ?>
                    <div class="carousel-item <?php if ( $x == 1) { echo "active";} ?>">
                        <img src="<?= $image; ?>" class="d-block w-100" alt="Group">
                    </div>

                    <?php
                            $x++;
                        } ?>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <div class="main_bg rounded-circle p-2 transition-me">
                        <i class="icon-chevron-left1 h1"></i>
                    </div>
                </a>

                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <div class="main_bg rounded-circle p-2 transition-me">
                        <i class="icon-chevron-right1 h1"></i>
                    </div>
                </a>
            </div>
        </div>

        <!--end main slider-->


        <!--start Board of Directors-->

        <div class="board py-4">
            <div class="container">
                <div class="text-center my-3">
                    <h3 class="main_text font-weight-bold"><?= trans('directors') ?></h3>
                </div>
                <?php
                $directorObj = new Directors();
                $director = $directorObj->getLimitOne();

                $name = $director['name_' . $lang];
                $position = $director['position_' . $lang];
                $image = $director['image'];

                ?>
                <div class="my-4">
                    <div class="d-flex justify-content-center">
                        <div class="card shadow point rounded" style="width: 15rem">
                            <div class="overflow-hidden m-2">
                                <img src="<?= $image ?>" class="img-fluid w-100 rounded" alt="man">
                            </div>
                            <div class="card-body text-center p-2">
                                <h5 class="main_text"><?= $name; ?></h5>
                                <span><?= $position ?></span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="directors">
                    <div class="row">
                        <?php
                        $director_data = $directorObj->getLimitsix();
                        $data_count = count($director_data);
                        $x = 1 ;
                        foreach ($director_data as $one){
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

        <!--end Board of Directors-->



        <!--start projects-->

        <div class="projects">
            <div class="container">
                <div class="text-center my-3">
                    <h3 class="main_text font-weight-bold"><?= trans('events_activities') ?></h3>
                </div>
                <div class="row">
                    <?php
                        $event_activityObj = new EventActivity();
                        $events_activities_data = $event_activityObj->getActive();

                        foreach ($events_activities_data as $event_activity){

                            $title = $event_activity['title_' . $lang];
                            $desc = $event_activity['desc_' . $lang];
                            $image = $event_activity['image'];
                    ?>
                    <div class="col-12 col-md-4">
                        <div class="m-3">
                            <a href="programs_and_activities.php">
                                <div class="thin_border rounded overflow-hidden">
                                    <div class="in overflow-hidden">
                                        <img src="<?= $image ?>" class="img-fluid w-100 transition-me" alt="images11">
                                    </div>
                                    <div class="body_card p-3">
                                        <h6 class="main_text font-weight-bold my-2 transition-me point"><?= $title ?></h6>
                                        <p class="main_text teny_size"><?= $desc ?>.</p>
                                        <div class="">
                                            <button class="last_bt rounded py-2 px-4 thin_border transition-me"><?= trans('more') ?></button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php }?>
                </div>
            </div>
        </div>

        <!--end projects-->


        <!--start Media Center-->

        <div class="media_center my-4">
            <div class="container">
                <div class="text-center my-3">
                    <h3 class="main_text font-weight-bold"><?= trans('media_center') ?></h3>
                    <span><?= trans('news_media') ?></span>
                </div>
                <div class="row">
                    <?php
                    $media_centerObj = new MediaCenter();
                    $media_center_data = $media_centerObj->getActive();

                    foreach ($media_center_data as $media_center){

                    $title = $media_center['title_' . $lang];
                    $desc = $media_center['desc_' . $lang];
                    $image = $media_center['image'];
                    ?>
                    <div class="col-12 col-md-4">
                        <div class="m-3">
                            <a href="media_center.php">
                                <div class="thin_border rounded overflow-hidden">
                                    <div class="overflow-hidden">
                                        <img src="<?= $image ?>" class="img-fluid w-100 transition-me" alt="images11">
                                    </div>
                                    <div class="body_card p-3">
                                        <h6 class="main_text font-weight-bold my-2 point transition-me"><?= $title?></h6>
                                        <p class="main_text  teny_size"><?= $desc ?> .</p>
                                        <div class="">
                                                <button class="last_bt rounded py-2 px-4 thin_border transition-me"><?= trans('more') ?> ...</button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <!--end Media Center-->


        <!--start our location-->

        <div class="location mt-4">
            <div class="text-center main_bg p-2">
                <h3 class="text-white font-weight-bold"><?= trans('our_location')?></h3>
            </div>
            <div class="form-group col-sm-12" id="map" style="height: 300px"></div>

            <!--            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7286615.899145397!2d30.8768375!3d26.906099949999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1613273640570!5m2!1sar!2seg" class="w-100" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>-->
        </div>

        <!--end our location-->

<?php

include('include/footer.php');

?>
