<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
include 'models/EventActivity.php';

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
                <h4 class="page-title"><?= trans('events_activities'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="events_activities_view.php"><?= trans('events_activities'); ?></a>
                    </li>
                    <li class="active">
                        <?= trans('events_activities'); ?>
                    </li>
                </ol>
            </div>

            <?php
            if (isset($_GET['event_activity_id'])) {

            $event_activityObj = new EventActivity();

            $row_select = $event_activityObj->getById($_GET['event_activity_id']);

            $id = $row_select['id'];
            $title_ar = $row_select['title_ar'];
            $title_en = $row_select['title_en'];
            $desc_en = $row_select['desc_en'];
            $desc_ar = $row_select['desc_ar'];
            $image = $row_select['image'];
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
                        <div class="form-group">
                            <label class="col-md-3 control-label"> <?= trans('image'); ?>  :</label>
                            <div class="col-md-9">
                                <div class="form-group col-md-4">
                                    <div class="thumb">
                                        <img src="<?=$image?>" style="height: 200px;width: 200px;margin-left: 10px;">
                                    </div>
                                </div>
                            </div>
                        </div>
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