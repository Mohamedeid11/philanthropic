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
                            <h1 class="text-white font-weight-bold"><?= trans('common_questions')?></h1>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent d-flex justify-content-center">
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none font-weight-normal h5 link_footer transition-me"><?= trans('home')?></a></li>
                                <li class="breadcrumb-item active text-white h5  oppacity" aria-current="page"><?= trans('common_questions')?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!--end Breadcrumb-->


        <!--start common question-->

        <div class="common my-4">
            <div class="container">
                <?php
                $common_questionObj = new CommonQuestions();
                $common_question_data = $common_questionObj->getActive();

                foreach ($common_question_data as $common_question){

                    $title = $common_question['title_' . $lang];
                    $desc = $common_question['desc_' . $lang];
                    ?>
                <div class="bg-light rounded py-3 my-3">

                    <div class="plus d-flex justify-content-between align-items-center px-3">
                        <h6 class="main_text main_bold"><?= $title ?></h6>
                        <i class="icon-plus main_text h6 point"></i>
                    </div>
                    <div class="inside px-2">
                        <hr class="thin_border">
                        <p class="teny_size" style="white-space: pre-line"> <?= $desc ?></p>
                    </div>
                </div>
                    <?php
                }
                ?>

            </div>
        </div>

        <!--end common question-->
<?php

include('include/footer.php');

?>