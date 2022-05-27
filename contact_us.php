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
                            <h1 class="text-white font-weight-bold"><?=trans('contact_us')?></h1>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent d-flex justify-content-center">
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?=trans('home')?></a></li>
                                <li class="breadcrumb-item active text-white h5  oppacity" aria-current="page"> <?=trans('contact_us')?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!--end Breadcrumb-->
        <?php
        if (isset($_POST['submit'])) {
            $messagesObj = new Message();


            $type = $_POST['type'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $content = $_POST['content'];


            $confirm = $messagesObj->create([
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'content' => $content,
                'date' => date('Y-m-d h:i'),
            ]);

            if ($confirm) {
                echo '<script type="text/javascript">';
                echo 'alert("Your Message Has been Send Successfully!")';
                echo '</script>';
            }

        }
        ?>

        <div class="my-5">
            <div class="container">

                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="m-2">
                            <h5 class="main_text my-3"> <?=trans('contact_us')?></h5>
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                                <div class="row rowpadding6">
                                    <input type="text" name="name" parsley-trigger="change" required placeholder="<?php echo trans('name_ar'); ?>" class="p-3 my-3 shadow-sm rounded d-block border w-100">

                                    <input type="email" name="email" parsley-trigger="change" required placeholder="<?php echo trans('email'); ?>" class="p-3 my-3 shadow-sm rounded d-block border w-100">

                                    <input type="text" name="address" parsley-trigger="change" required placeholder="<?php echo trans('address'); ?>" class="p-3 my-3 shadow-sm rounded d-block border w-100">

                                    <textarea  name="content" class="rounded w-100 shadow-sm border d-block p-3" rows="5" placeholder="الرساله"></textarea>

                                    <div class="col-md-4 col-md-offset-8">
                                        <input type="submit" name="submit" class="border last_bt rounded px-5 py-2 w-100 transition-me my-3" value="<?php echo trans('send'); ?>">
                                    </div>
                                </div>
                            </form>

                            <div class="my-4">
                                <h5 class="my_bold my-4"><?=trans('contact')?> </h5>
                                <div class="my-2">
                                    <span class="my_bold"><?=$contact_phone?></span>
                                    <i class="icon-mobile21 h5 main_text mx-2"></i>
                                </div>
                                <div class="my-2">
                                    <span class="my_bold"><?=$contact_email?></span>
                                    <i class="icon-envelope h5 main_text mx-2"></i>
                                </div>
                                <div class="my-2">
                                    <i class="icon-location h5 main_text mx-2"></i>
                                    <span class="my_bold"><?=$contact_address?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="py-5 m-2">
                            <div class="form-group col-sm-12" id="map" style="height: 300px"></div>

<!--                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7286615.899145397!2d30.8768375!3d26.906099949999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1610560541403!5m2!1sar!2seg" class="w-100" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>-->
                        </div>
                    </div>
                </div>

            </div>
        </div>


<?php

include('include/footer.php');

?>
