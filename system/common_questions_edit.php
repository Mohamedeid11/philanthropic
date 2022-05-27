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

<?php
// error_reporting(0);

$common_questionObj = new CommonQuestions();

if (isset($_POST['common_question_update'])) {

    $id = $_POST['id_update'];
    $title_ar = mysqli_real_escape_string($con, trim($_POST['title_ar']));
    $title_en = mysqli_real_escape_string($con, trim($_POST['title_en']));
    $desc_en = mysqli_real_escape_string($con, trim($_POST['desc_en']));
    $desc_ar = mysqli_real_escape_string($con, trim($_POST['desc_ar']));

    $common_question = $common_questionObj->getById($id);

    $errors = array();

    if (empty($title_ar || $title_en)) {
        $errors[] = "Please enter all fields!";
    } elseif (strlen($title_ar) < 3 || strlen($title_ar) > 100) {
        $errors[] = "Field Name ar must be between 3, 100 characters";
    }elseif (strlen($title_en) < 3 || strlen($title_en) > 100) {
        $errors[] = "Field Name EN must be between 3, 100 characters";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {


        $update = $common_questionObj->update([
            'id' => $id,
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'desc_en' => $desc_en,
            'desc_ar' => $desc_ar,
        ]);

        if ($update) {
            echo get_success(trans('updatedSuccessfully'));
        } else {
            echo get_error(trans('somethingWrong'));
        }
    }
}
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
                <h4 class="page-title"> <?php echo trans('common_questions'); ?> </h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="common_questions_view.php?lang=<?php echo $lang; ?>"><?php echo trans('common_questions'); ?>  </a>
                    </li>
                    <li class="active">
                        <?php echo trans('edit_common_question'); ?>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <?php
                    if (isset($_GET['common_question_id'])) {
                        $row_select = $common_questionObj->getById($_GET['common_question_id']);

                        $id = $row_select['id'];
                        $title_ar = $row_select['title_ar'];
                        $title_en = $row_select['title_en'];
                        $desc_en = $row_select['desc_en'];
                        $desc_ar = $row_select['desc_ar'];

                        if ($row_select) {
                            ?>

                            <form method="POST" enctype="multipart/form-data" data-parsley-validate novalidate>

                                <input type="hidden" name="id_update" id="id_update" parsley-trigger="change"  value="<?php echo $id; ?>" class="form-control">

                                <div class="clearfix"></div>

                                <div class="form-group col-md-3">
                                    <label for="title_ar"><?php echo trans('title_ar'); ?></label>
                                    <input value="<?php echo $title_ar; ?>" name="title_ar" required class="form-control">

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="title_en"><?php echo trans('title_en'); ?></label>
                                    <input value="<?php echo $title_en; ?>" name="title_en" required class="form-control">

                                </div>

                                <div class="clearfix"></div>

                                <div class="form-group col-md-3">
                                    <label for="desc_ar"><?php echo trans('desc_en'); ?></label>
                                    <input type="text" value="<?php echo $desc_en; ?>" name="desc_en" required class="form-control">

                                </div>

                                <div class="form-group col-md-3">
                                    <label for="desc_ar"><?php echo trans('desc_ar'); ?></label>
                                    <input type="text" value="<?php echo $desc_ar; ?>" name="desc_ar" required class="form-control">

                                </div>

                                <div class="clearfix"></div>
                                <br />

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="text-center p-20">
                                            <button type="reset" class="btn w-sm btn-white waves-effect"><?php echo trans('cancel'); ?></button>
                                            <button type="submit" name="common_question_update" class="btn w-sm btn-default waves-effect waves-light"><?php echo trans('update'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

<script>
    // $(document).ready(function(){
    $("#navigation ul>li").removeClass("active");
    $("#item2").addClass("active");
    // })
</script>

</body>
</html>