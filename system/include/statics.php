
<?php
$users = $con->query("SELECT * FROM `users`");
$users_count = mysqli_num_rows($users);

$slider = $con->query("SELECT * FROM `slider`");
$sliders_num = mysqli_num_rows($slider);

$directories = $con->query("SELECT * FROM `directors`");
$directories_num = mysqli_num_rows($directories);

$founders = $con->query("SELECT * FROM `founders` ");
$founders_num = mysqli_num_rows($founders);

$committees= $con->query("SELECT * FROM `committees`");
$committees_num = mysqli_num_rows($committees);

$donates = $con->query("SELECT * FROM `donates` ");
$donates_num = mysqli_num_rows($donates);

$media_center = $con->query("SELECT * FROM `media_center` ");
$media_center_num = mysqli_num_rows($media_center);

$events_activities = $con->query("SELECT * FROM `events_activities` ");
$common_questions_num = mysqli_num_rows($events_activities);


$magazine = $con->query("SELECT * FROM `magazine` ");
$magazine_num = mysqli_num_rows($magazine);


$common_questions= $con->query("SELECT * FROM `common_questions` ");
$events_activities_num = mysqli_num_rows($common_questions);


$clients = $con->query("SELECT * FROM `clients` ");
$clients_count = mysqli_num_rows($clients);
?>


<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="md md-person text-info"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter"><?= $users_count ?></b></h3>
                <p class="text-muted"><?php echo trans('users'); ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="md md-filter text-info"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter"><?= $sliders_num ?></b></h3>
                <p class="text-muted"><?php echo trans('slider'); ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="md-account-child text-info"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter"><?= $directories_num ?></b></h3>
                <p class="text-muted"><?php echo trans('directors'); ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="md-account-child text-info"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter"><?= $founders_num ?></b></h3>
                <p class="text-muted"><?php echo trans('founders'); ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="md-account-child text-info"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter"><?= $committees_num ?></b></h3>
                <p class="text-muted"><?php echo trans('committees'); ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="md-settings-input-composite text-info"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter"><?= $donates_num ?></b></h3>
                <p class="text-muted"><?php echo trans('donates'); ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-pink pull-left">
                <i class="md-view-list text-pink"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter"><?= $media_center_num ?></b></h3>
                <p class="text-muted"><?php echo trans('media_center'); ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-pink pull-left">
                <i class="md-view-list text-pink"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter"><?= $events_activities_num ?></b></h3>
                <p class="text-muted"><?php echo trans('events_activities'); ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-pink pull-left">
                <i class="md-speaker-notes text-pink"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter"><?= $magazine_num ?></b></h3>
                <p class="text-muted"><?php echo trans('magazine'); ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-pink pull-left">
                <i class="md-swap-vert text-pink"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter"><?= $common_questions_num ?></b></h3>
                <p class="text-muted"><?php echo trans('common_questions'); ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-pink pull-left">
                <i class="mmd md-people text-pink"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter"><?= $clients_count ?></b></h3>
                <p class="text-muted"><?php echo trans('clients'); ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</div>

