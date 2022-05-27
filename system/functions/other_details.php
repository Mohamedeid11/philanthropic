<?php
if (isset($_POST['close_date'])) {
    include("../connection.php");

    $close_date = $_POST['close_date'];
    $other_id_session = $_POST['other_id_session'];
    $layaly_cat_id = $_POST['layaly_cat_id'];
    $user_type = $_POST['user_type'];
    $time_from = $_POST['time_from'];
    $time_to = $_POST['time_to'];
    $section_type = $_POST['section_type'];
    if ($user_type == 3 && $section_type == 1) {
        $sql_2 = "SELECT *  FROM `close_time_for_sections`  where `close_date`='$close_date' and `layaly_cat_id`='$layaly_cat_id' and `layaly_sub_cat_id`='$other_id_session' order by `id` desc";
    } else {
        $sql_2 = "SELECT *  FROM `close_time_for_sections`  where `close_date`='$close_date'    order by `id` desc";
    }
    $query_2 = $con->query($sql_2);
    $closed_time_count = mysqli_num_rows($query_2);
    if ($closed_time_count > 0) {
        ?>
        <table  style="margin-right:0px;width: 100%;">
            <thead><tr>
                    <th> القسم الرئيسي</th>
                    <th> القسم الفرعي</th>
                    <th> التاريخ</th>
                    <th> من</th>
                    <th> إلي</th>
                    <th> حذف</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($one = mysqli_fetch_assoc($query_2)) {
                    $closed_time_id = $one['id'];
                    $layaly_cat_id = $one['layaly_cat_id'];
                    $layaly_sub_cat_id = $one['layaly_sub_cat_id'];
                    $close_date = $one['close_date'];
                    $time_from = $one['time_from'];
                    $time_to = $one['time_to'];
                    $layaly_cat_name = get_layaly_cat_name($layaly_cat_id);
                    $layaly_sub_cat_name = get_layaly_sub_cat_name($layaly_sub_cat_id);

                    echo "<tr class='$closed_time_id'><td >$layaly_cat_name</td>";
                    echo "<td >$layaly_sub_cat_name</td>";
                    ?>

                <td > <?php
                    echo $close_date;
                    ?></td>
                <td> <?php
                    echo $time_from;
                    ?></td>
                <td > <?php
                    echo $time_to;
                    ?></td>


                <td class="actions">
                    <a href="javascript:;" data-id="<?php echo $closed_time_id; ?>" class="deletemsg" id="deleteParent"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
            <?php
        }
        echo "</tbody></table>";
    } else {
        echo "<h2 style='color: red;'>لا يوجد أيام مغلقة</h2>";
    }
    die();
}

function get_layaly_cat_name($layaly_cat_id) {
    global $con;
    $query_select = $con->query("SELECT * FROM `layaly_cats` WHERE `id`='" . $layaly_cat_id . "' ORDER BY `id` LIMIT 1 ");
    $row_select = mysqli_fetch_array($query_select);
    $name = $row_select['name'];
    return $name;
}

function get_layaly_sub_cat_name($layaly_sub_cat_id) {
    global $con;
    $query_select = $con->query("SELECT * FROM `layaly_sub_cats` WHERE `id`='" . $layaly_sub_cat_id . "' ORDER BY `id` LIMIT 1 ");
    $row_select = mysqli_fetch_array($query_select);
    $name = $row_select['name'];
    return $name;
}
?>
