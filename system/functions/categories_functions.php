<?php

include('languages.php');

function get_category_by_id($category_id) {
    global $con;
    $query_select = $con->query("SELECT * FROM `categories` WHERE `id`='" . $category_id . "' ORDER BY `id` LIMIT 1 ");
    $row_select = mysqli_fetch_array($query_select);
    return $row_select;
}


function add_category($name_ar, $name_en) {

    global $con;

    $con->query("INSERT INTO `categories` VALUES (null,'$name_ar', '$name_en','" . date("Y-m-d H:i:s") . "')");
    return mysqli_insert_id($con);
}
function categories_count() {

    global $con;

    $result = $con->query("SELECT * FROM `categories` ORDER BY `id` DESC");

    $category_count = mysqli_num_rows($result);

    return $category_count;
}

// View Sub Category Table
function view_categories() {

    global $con;
    $categories = array();

    $query_select = $con->query("SELECT * FROM `categories` order by id desc");

    while ($row = mysqli_fetch_assoc($query_select)) {
        array_push($categories, $row);
    }
    
    return $categories;
}

if (isset($_POST['category_id_delete'])) {

    include("../connection.php");

    $delete_category_id = $_POST['category_id_delete'];
    $query = $con->query("DELETE FROM `categories` WHERE `id`='$delete_category_id'");

    if ($query) {

        echo get_success(" Deleted Successfully");
    }
}

if (isset($_POST['change_cat_status_off'])) {

    include("../connection.php");

    $change_status_off = $_POST['change_cat_status_off'];
    $lang = $_POST['lang'];
    
    $query = $con->query("update `categories` set display='0' WHERE `id`='$change_status_off'");

    if ($query) {
        echo get_success($languages[$lang]["changeSuccessfully"]);
    }
}

if (isset($_POST['change_cat_status_on'])) {

    include("../connection.php");

    $change_status_on = $_POST['change_cat_status_on'];
    $lang = $_POST['lang'];
    
    $query = $con->query("update `categories` set display='1' WHERE `id`='$change_status_on'");

    if ($query) {
        echo get_success($languages[$lang]["changeSuccessfully"]);
    }
}
?>