<?php
$settingObj = new Setting();
$setting_id = 1 ;
$settings_data = $settingObj->getById($setting_id);
$setting_copyright_name = $settings_data['copyright_name_'. $lang];
$setting_copyright_link = $settings_data['copyright_link'];
$setting_facebook = $settings_data['facebook'];
$setting_instgram = $settings_data['instgram'];
$setting_twitter = $settings_data['twitter'];
$setting_header_logo = $settings_data['header_logo'];
$setting_footer_logo = $settings_data['footer_logo'];


$contactObj = new Contact();
$contact_id = 1 ;
$contacts_data = $contactObj->getById($contact_id);
$contact_address = $contacts_data['address_' . $lang];
$contact_phone = $contacts_data['phone'];
$contact_email = $contacts_data['email'];
$contact_lat_loca = $contacts_data['lat_loca'];
$contact_long_loca = $contacts_data['long_loca'];


?>
<!--start navbar-->

<nav class="navbar navbar-expand-lg navbar-light position-relative">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="<?= $setting_header_logo ?>" class="img-fluid w-100" alt="<?= $setting_id ?>"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto pr-3">
                <li class="nav-item active">
                    <a class="nav-link font-weight-bold mx-1" href="index.php"><?= trans('home') ?><span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle font-weight-bold mx-1" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= trans('about_us') ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-right" href="about_us.php"><?= trans('about') ?></a>
                        <a class="dropdown-item text-right" href="about_us_Founders.php"><?= trans('founders') ?></a>
                        <a class="dropdown-item text-right" href="about_us_Board_of_Directors.php"><?= trans('directors') ?></a>
                        <a class="dropdown-item text-right" href="about_us_Committees.php"><?= trans('committees') ?></a>
                    </div>
                </li>
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link font-weight-bold mx-1" href="#">المشاريع</a>-->
<!--                </li>-->
                <li class="nav-item">
                    <a class="nav-link font-weight-bold mx-1" href="Donation.php"><?= trans('projects') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold mx-1" href="common_questions.php"><?= trans('common_questions') ?> </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle font-weight-bold mx-1" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= trans('media_center') ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-right" href="media_center.php"><?= trans('news') ?></a>
                        <a class="dropdown-item text-right" href="programs_and_activities.php"><?= trans('events_activities') ?></a>
                        <a class="dropdown-item text-right" href="bahrain_charitable_society_magazine.php"><?= trans('magazines') ?></a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold mx-1" href="contact_us.php"><?= trans('contact_us') ?> </a>
                </li>
                <?php if (Clientloggedin()) { ?>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold mx-1" href="list_of_donations.php"><?= trans('donates_list') ?> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold mx-1" href="logout.php"><?= trans('logout') ?> </a>
                    </li>

                <?php }else { ?>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold mx-1" href="create_new_account.php"><?= trans('register') ?> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold mx-1" href="login.php"><?= trans('login') ?> </a>
                    </li>

                <?php } ?>
            </ul>
            <div class="end_nav position-relative">
                <div class="">
                    <a class="dropdown-item main_link transition-me" href="system/lang/switch-lang.php"><span class="mx-2"><?= trans('sLang') ?></span><img src="assets_<?php echo $lang; ?>/img/globe.png" class="img-fluid w-25" alt="globe"></a>

    <!--                    <a class="nav-link dropdown-toggle font-weight-bold main_link transition-me position-relative" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
    <!--                        <span class="mx-2">--><?//= trans('sLang') ?><!--</span><img src="assets_<?php echo $lang; ?>/img/globe.png" class="img-fluid w-25" alt="globe">-->
    <!--                    </a>-->
<!--                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
<!--                        <a class="dropdown-item main_link transition-me" href="system/lang/switch-lang.php"><span class="mx-2">--><?//= trans('sLang') ?><!--</span><img src="assets_<?php echo $lang; ?>/img/globe.png" class="img-fluid w-25" alt="globe"></a>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </div>
</nav>
<!---->
<!--<div class="last_nav position-relative mb-4">-->
<!--    <div class="container-fluid">-->
<!--        <div class="w-100 position-absolute">-->
<!--            <div class="row justify-content-end">-->
<!--                <div class="col-12 col-md-4">-->
<!--                    <div class="d-flex justify-content-around align-items-center">-->
<!--                        --><?php //if (Clientloggedin()) { ?>
<!--                            <div class="">-->
<!--                                <a href="list_of_donations.php" class="main_bt text-decoration-none rounded main_bordrer transition-me nav_bt p-1"><i class="icon-shareable ml-1"></i><span> --><?//= trans('donates') ?><!--</span></a>-->
<!--                                <a href="logout.php" class="main_bt text-decoration-none p-1 rounded main_bordrer transition-me nav_bt"><i class="icon-lock-closed h6 ml-1"></i><span> --><?//= trans('logout') ?><!--</span></a>-->
<!--                            </div>-->
<!--                        --><?php //}else { ?>
<!--                            <div class="">-->
<!--                                <a href="create_new_account.php" class="main_bt text-decoration-none p-1 rounded main_bordrer transition-me nav_bt"><i class="icon-user2 ml-1"></i><span>--><?//= trans('register') ?><!-- </span></a>-->
<!--                                <a href="login.php" class="main_bt text-decoration-none p-1 rounded main_bordrer transition-me nav_bt"><i class="icon-lock-closed h6 ml-1"></i><span> --><?//= trans('login') ?><!--</span></a>-->
<!--                            </div>-->
<!--                        --><?php //} ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--end navbar-->