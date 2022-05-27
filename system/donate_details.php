<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
include 'models/Donate.php';
include 'models/DonateType.php';

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
                <h4 class="page-title"><?= trans('donates'); ?></h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="donate_view.php"><?= trans('donates'); ?></a>
                    </li>
                    <li class="active">
                        <?= trans('donates'); ?>
                    </li>
                </ol>
            </div>

            <?php
            if (isset($_GET['donate_id'])) {

            $donateObj = new Donate();

            $row_select = $donateObj->getById($_GET['donate_id']);

            $id = $row_select['id'];
            $title_ar = $row_select['title_ar'];
            $title_en = $row_select['title_en'];
            $type_id = $row_select['type_id'];
            $price = $row_select['price'];
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
                                <td width="400"><?= trans('donate_type'); ?>  </td>
                                <?php
                                $donate_typeObj = new DonateType();
                                $data = $donate_typeObj->getActiveByID($type_id);
                                foreach($data as $key => $row1){
                                    $donate_type_id = $row1['id'];
                                    $donate_type_name = $row1['name'];
                                    ?>
                                    <td><a href="donate_type_view.php?donate_type_id=<?=$donate_type_id?>"><?= $donate_type_name; ?></a></td>
                                <?php } ?>
                            </tr>
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
                                <td> <?= trans('price'); ?>  </td>
                                <td>
                                    <?=$price?>
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