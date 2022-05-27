<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
include 'models/CommonQuestions.php';

?>
<!DOCTYPE html>
<html>
<?php include("include/heads.php"); ?>
<?php include("include/leftsidebar.php"); ?>
<div class="wrapper">
    <div class="container">    <!-- Start content -->
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title"><?= trans('common_questions'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="common_questions_view.php"><?= trans('common_questions'); ?></a>
                    </li>
                    <li class="active">
                        <?= trans('common_questions'); ?>
                    </li>
                </ol>
            </div>

            <?php
            if (isset($_GET['common_question_id'])) {

            $common_questionObj = new CommonQuestions();

            $row_select = $common_questionObj->getById($_GET['common_question_id']);

            $id = $row_select['id'];
            $title_ar = $row_select['title_ar'];
            $title_en = $row_select['title_en'];
            $desc_en = $row_select['desc_en'];
            $desc_ar = $row_select['desc_ar'];
            $display = $row_select['display'];
            $date = $row_select['date'];

            if ($row_select) {
            ?>
            <div class="card-box table-responsive">
                <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td> <?= trans('title_ar'); ?>  </td>
                                <td>
                                    <?=$title_ar?>
                                </td>
                            </tr>
                            <tr>
                                <td> <?= trans('title_en'); ?>  </td>
                                <td>
                                    <?=$title_en?>
                                </td>
                            </tr>
                            <tr>
                                <td> <?= trans('desc_en'); ?>  </td>
                                <td>
                                    <?=$desc_en?>
                                </td>
                            </tr>
                            <tr>
                                <td> <?= trans('desc_ar'); ?>  </td>
                                <td>
                                    <?=$desc_ar?>
                                </td>
                            </tr>
                            <tr>
                                <td> <?= trans('date'); ?></td>
                                <td>
                                    <?=$date?>
                                </td>
                            </tr>
                            <tr>
                                <td> <?= trans('status'); ?> </td>
                                <td>
                                    <?php
                                    if ( $display== 0) {
                                        echo "مخفي";
                                    } else {
                                        echo "ظاهر";
                                    }
                                    ?>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                        <?php
                        }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include("include/footer_text.php"); ?>

<?php include("include/footer.php"); ?>

</body>
</html>