
<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container">

            <!-- Logo container-->
            <div class="logo">
                <a href="index.php" class="logo">
                    <span><?php echo trans('home'); ?></span>
                </a>
            </div>
            <!-- End Logo container-->
            <div class="menu-extras">

                <ul class="nav navbar-nav navbar-right pull-right">
                    <?php
                    $query = $con->query("SELECT * FROM `users` WHERE `id`='" . $_SESSION['user_id'] . "' ORDER BY `id` DESC");
                    $x = 1;

                    $row = mysqli_fetch_assoc($query);

                    $user_name = $row['username'];
                    $user_image = $row['image'];
                    $get_image_ext = explode('.', $user_image);
                    $image_ext = strtolower(end($get_image_ext));
                    $user_id = $row['id'];
                    ?>

                    <li class="dropdown navbar-c-items">
                        <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo $user_image; ?>" alt="user-img" class="img-circle"> </a>
                        <ul class="dropdown-menu">
                            <li><a href="user_edit.php?id=<?php echo $_SESSION["user_id"]; ?>"><i class="ti-user text-custom m-r-10"></i> <?php echo trans('profile'); ?></a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="ti-power-off text-danger m-r-10"></i>  <?php echo trans('logout'); ?></a></li>
                        </ul>
                    </li>
                </ul>
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

        </div>
    </div>

    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <a href="index.php"><i class="md md-dashboard"></i> <?php echo trans('home'); ?></a>
                    </li>

                    <li id="item90" class="has-submenu">
                        <a href="#"><i class="md md-filter"></i><?php echo trans('slider'); ?></a>
                        <ul class="submenu">
                            <?php if ($_SESSION['user_role'] == 'admin') { ?>
                                <li><a href="slider_add.php"><?php echo trans('add_slider'); ?></a></li>
                            <?php } ?>
                            <li><a href="slider_view.php"><?php echo trans('viewAll'); ?></a></li>
                        </ul>
                    </li>

                    <li id="item90" class="has-submenu">
                        <a href="#"><i class="md-account-child"></i><?php echo trans('directors'); ?></a>
                        <ul class="submenu">
                            <?php if ($_SESSION['user_role'] == 'admin') { ?>
                                <li><a href="directors_add.php"><?php echo trans('add_director'); ?></a></li>
                            <?php } ?>
                            <li><a href="directors_view.php"><?php echo trans('viewAll'); ?></a></li>
                        </ul>
                    </li>

                    <li id="item90" class="has-submenu">
                        <a href="#"><i class="md-account-child"></i><?php echo trans('founders'); ?></a>
                        <ul class="submenu">
                            <?php if ($_SESSION['user_role'] == 'admin') { ?>
                                <li><a href="founders_add.php"><?php echo trans('add_founder'); ?></a></li>
                            <?php } ?>
                            <li><a href="founders_view.php"><?php echo trans('viewAll'); ?></a></li>
                        </ul>
                    </li>

                    <li id="item90" class="has-submenu">
                        <a href="#"><i class="md-account-child"></i><?php echo trans('committees'); ?></a>
                        <ul class="submenu">
                            <?php if ($_SESSION['user_role'] == 'admin') { ?>
                                <li><a href="committees_add.php"><?php echo trans('add_committee'); ?></a></li>
                            <?php } ?>
                            <li><a href="committees_view.php"><?php echo trans('viewAll'); ?></a></li>
                        </ul>
                    </li>

                    <li id="item90" class="has-submenu">
                        <a href="#"><i class="md-settings-input-composite"></i><?php echo trans('donates'); ?></a>
                        <ul class="submenu">
                            <?php if ($_SESSION['user_role'] == 'admin') { ?>
                                <li><a href="donate_add.php"><?php echo trans('add_donate'); ?></a></li>
                            <?php } ?>
                            <li><a href="donate_view.php"><?php echo trans('viewAll'); ?></a></li>
                        </ul>
                    </li>

                    <li id="item90" class="has-submenu">
                        <a href="order_view.php"><i class="md-settings-input-composite"></i><?php echo trans('donation_details'); ?></a>
                    </li>

                    <li id="item90" class="has-submenu">
                        <a href="payment_method_view.php"><i class="md-settings-input-composite"></i><?php echo trans('payment'); ?></a>
                    </li>

<!--                    <li id="item90" class="has-submenu">-->
<!--                        <a href="#"><i class="md-view-list"></i>--><?php //echo trans('news'); ?><!--</a>-->
<!--                        <ul class="submenu">-->
<!--                            --><?php //if ($_SESSION['user_role'] == 'admin') { ?>
<!--                                <li><a href="news_add.php">--><?php //echo trans('add_news'); ?><!--</a></li>-->
<!--                            --><?php //} ?>
<!--                            <li><a href="news_view.php">--><?php //echo trans('viewAll'); ?><!--</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->

                    <li id="item90" class="has-submenu">
                        <a href="#"><i class="md-view-list"></i><?php echo trans('news'); ?></a>
                        <ul class="submenu">
                            <?php if ($_SESSION['user_role'] == 'admin') { ?>
                                <li><a href="media_center_add.php"><?php echo trans('add_news'); ?></a></li>
                            <?php } ?>
                            <li><a href="media_center_view.php"><?php echo trans('viewAll'); ?></a></li>
                        </ul>
                    </li>

                    <li id="item90" class="has-submenu">
                        <a href="#"><i class="md-view-list"></i><?php echo trans('events_activities'); ?></a>
                        <ul class="submenu">
                            <?php if ($_SESSION['user_role'] == 'admin') { ?>
                                <li><a href="events_activities_add.php"><?php echo trans('add_event_activity'); ?></a></li>
                            <?php } ?>
                            <li><a href="events_activities_view.php"><?php echo trans('viewAll'); ?></a></li>
                        </ul>
                    </li>

                    <li id="item90" class="has-submenu">
                        <a href="#"><i class="md-speaker-notes"></i><?php echo trans('magazine'); ?></a>
                        <ul class="submenu">
                            <li><a href="magazine_add.php"><?php echo trans('add_magazine'); ?></a></li>
                            <li><a href="magazine_view.php"><?php echo trans('viewAll'); ?></a></li>
                        </ul>
                    </li>

                    <li id="item90" class="has-submenu">
                        <a href="#"><i class="md-swap-vert"></i><?php echo trans('common_questions'); ?></a>
                        <ul class="submenu">
                            <?php if ($_SESSION['user_role'] == 'admin') { ?>
                                <li><a href="common_questions_add.php"><?php echo trans('add_common_question'); ?></a></li>
                            <?php } ?>
                            <li><a href="common_questions_view.php"><?php echo trans('viewAll'); ?></a></li>
                        </ul>
                    </li>
<!---->
<!--                    <li id="item3" class="has-submenu">-->
<!--                        <a href="#"><i class="md  md-brightness-6"></i>--><?php //echo trans('breaks'); ?><!--</a>-->
<!--                        <ul class="submenu">-->
<!--                            --><?php //if ($_SESSION['user_role'] == 'admin') { ?>
<!--                                <li><a href="entity_add.php">--><?php //echo trans('addBreak'); ?><!--</a></li>-->
<!--                            --><?php //} ?>
<!--                            <li><a href="entities_view.php">--><?php //echo trans('viewAll'); ?><!--</a></li>-->
<!--                            --><?php //if ($_SESSION['user_role'] == 'admin') { ?>
<!--                                <li><a href="entity_calendar.php">--><?php //echo trans('calendar'); ?><!--</a></li>-->
<!--                            --><?php //} ?>
<!--                        </ul>-->
<!--                    </li>-->


                    <?php if ($_SESSION['user_role'] == 'admin') { ?>
                    <li id="item90" class="has-submenu">
                        <a href="#"><i class="md md-people"></i><?php echo trans('clients'); ?></a>
                        <ul class="submenu">
                            <li><a href="client_add.php"><?php echo trans('addClient'); ?></a></li>
                            <li><a href="client_view.php"><?php echo trans('viewAll'); ?></a></li>
                        </ul>
                    </li>

                    <li id="item90" class="has-submenu">
                        <a href="#"><i class="md md-person"></i><?php echo trans('users'); ?></a>
                        <ul class="submenu">
                            <li><a href="user_add.php"><?php echo trans('addUser'); ?></a></li>
                            <li><a href="user_view.php"><?php echo trans('viewAll'); ?></a></li>
                        </ul>
                    </li>

<!--                    <li id="item90" class="has-submenu">-->
<!--                        <a href="#"><i class="md-speaker-notes"></i>--><?php //echo trans('cart'); ?><!--</a>-->
<!--                        <ul class="submenu">-->
<!--                            <li><a href="cart_add.php">--><?php //echo trans('add_magazine'); ?><!--</a></li>-->
<!--                            <li><a href="cart_view.php">--><?php //echo trans('viewAll'); ?><!--</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li id="item90" class="has-submenu">-->
<!--                        <a href="report_form.php"><i class="md md-filter"></i>--><?php //echo trans('reports'); ?><!--</a>-->
<!--                    </li>-->
<!--                    <li id="item9" class="has-submenu">-->
<!--                        <a href="#"><i class="md md-vibration"></i>--><?php //echo trans('notifications'); ?><!--</a>-->
<!--                        <ul class="submenu">-->
<!--                            <li><a href="notification_add.php">--><?php //echo trans('addNotification'); ?><!--</a></li>-->
<!--                            <li><a href="notification_view.php">--><?php //echo trans('viewAll'); ?><!--</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
                    <li id="item9" class="has-submenu">
                        <a href="#"><i class="md md-settings"></i><?php echo trans('other'); ?></a>
                        <ul class="submenu">
                            <li><a href="about_view.php"><?php echo trans('about'); ?></a></li>
                            <li> <a href="donate_type_view.php"><?php echo trans('donate_type'); ?></a></li>
                            <li><a href="messages_view.php"><?php echo trans('messages'); ?></a></li>
                            <li><a href="contact_edit.php?contact_id=1"><?php echo trans('viewContact'); ?></a></li>
                            <li><a href="settings_edit.php?setting_id=1"><?php echo trans('settings'); ?></a></li>
                            <li><a href="lang/switch-lang.php"><i class="md md-language"></i> <?php echo trans('sLang'); ?></a></li>
                        </ul>
                    </li>
<!--                    <li id="item90" class="has-submenu">-->
<!--                        <a href="#"><i class="md md-location-city"></i>--><?php //echo trans('regions'); ?><!--</a>-->
<!--                        <ul class="submenu">-->
<!--                            <li><a href="region_add.php">--><?php //echo trans('addRegion'); ?><!--</a></li>-->
<!--                            <li><a href="region_view.php">--><?php //echo trans('viewAll'); ?><!--</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li id="item2" class="has-submenu">-->
<!--                        <a href="setting_privacy.php"><i class="md md-language"></i> <span style="color: black;">--><?php //echo trans('viewPrivacy'); ?><!--</span></a>-->
<!--                    </li>-->
                    <?php } ?>
                    
<!--                    <li><a href="lang/switch-lang.php"><i class="md md-language"></i> <span style="color: black;">--><?php //echo trans('sLang'); ?><!--</span></a></li>-->
<!--                    <li class="has-submenu">-->
<!--                        <a href="logout.php"><i class="md md-swap-vert"></i>--><?php //echo trans('logout'); ?><!--</a>-->
<!--                    </li>-->
                </ul>
                <!-- End navigation menu -->
            </div>
        </div> <!-- end container -->
    </div> <!-- end navbar-custom -->
</header>
<!-- End Navigation Bar-->

