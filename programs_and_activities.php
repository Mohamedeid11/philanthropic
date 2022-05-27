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
                            <h1 class="text-white font-weight-bold"><?=trans('events_activities')?></h1>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent d-flex justify-content-center">
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?=trans('events_activities')?></a></li>
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?=trans('media_center')?></a></li>
                                <li class="breadcrumb-item active text-white h5  oppacity" aria-current="page"><?=trans('events_activities')?></li>
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
                    $event_activityObj = new EventActivity();
                    $event_activity_data = $event_activityObj->getActive();

                    foreach ($event_activity_data as $event_activity){
                        $event_activity_id = $event_activity['id'];
                        $title = $event_activity['title_' . $lang];
                        $desc = $event_activity['desc_' . $lang];
                        $image = $event_activity['image'];
                        ?>
                    <div class="col-12 col-md-4">
                        <div class="m-4 d-flex justify-content-center">
                            <a href="programmes_details.php?programmes_id=<?=$event_activity_id?>">
                                <div class="thin_border rounded overflow-hidden">
                                    <div class="overflow-hidden">
                                        <img src="<?=$image?>" class="img-fluid w-100 transition-me" alt="images11">
                                    </div>
                                    <div class="body_card p-3">
                                        <h6 class="main_text font-weight-bold my-2 point transition-me"><?= $title?></h6>
                                        <p class="main_text teny_size"style="white-space: pre-line"><?= $desc?>.</p>
                                        <div class="">
                                            <button class="last_bt rounded py-2 px-4 thin_border transition-me"><?= trans('more')?></button>
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

        <!--end Donation-->
<?php

include('include/footer.php');

?>