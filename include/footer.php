
<!--start footer-->

<footer class="main_bg p-3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 col-md-4">
                <div class="m-3">
                    <img src="<?= $setting_footer_logo ?>" class="img-fluid" alt="logo">
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="m-3">
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="text-decoration-none link_footer transition-me"><?= trans('home') ?></a>
                        <a href="about_us.php" class="text-decoration-none link_footer transition-me"> <?= trans('about_us') ?></a>
                        <a href="Donation.php" class="text-decoration-none link_footer transition-me"><?= trans('projects') ?></a>
                        <a href="common_questions.php" class="text-decoration-none link_footer transition-me"><?= trans('common_questions') ?></a>
                        <a href="media_center.php" class="text-decoration-none link_footer transition-me"> <?= trans('news') ?></a>
                        <a href="contact_us.php" class="text-decoration-none link_footer transition-me"> <?= trans('contact_us') ?></a>
                    </div>
                </div>
            </div>
        </div>
        <hr class="border-light">
        <div class="text-center">
            <ul class="list-unstyled d-flex justify-content-center">
                <li class="mx-3"><a href="<?= $setting_facebook ?>" class="link_footer text-decoration-none transition-me"><i class="icon-facebook-with-circle h4"></i></a></li>
                <li class="mx-3"><a href="<?= $setting_instgram ?>" class="link_footer text-decoration-none transition-me"><i class="icon-instagram h4"></i></a></li>
                <li class="mx-3"><a href="<?= $setting_twitter ?>" class="link_footer text-decoration-none transition-me"><i class="icon-twitter h4"></i></a></li>
            </ul>
            <h5 class="font-weight-bold oppacity text-white"><?= $setting_copyright_name ?></h5>
        </div>
    </div>
</footer>

<!--end footer-->


</body>
</html>

<?php include('foot.php'); ?>