<?php

include('languages.php');


function entities_count() {

    global $con;

    $result = $con->query("SELECT * FROM `entities` ORDER BY `id` DESC");

    $category_count = mysqli_num_rows($result);

    return $category_count;
}

// View Sub Category Table
function view_entities() {

    global $con;
    $entities = array();

    $query_select = $con->query("SELECT * FROM `entities` order by id desc");

    while ($row = mysqli_fetch_assoc($query_select)) {
        array_push($entities, $row);
    }
    
    return $entities;
}

function getFeatures($entity_id, $type){
    global $con;
    
    $result2 = $con->query("select * from features where entity_id='$entity_id' and type='$type'") or die(mysqli_error($con));
    $features = [];
    if(mysqli_num_rows($result2) > 0){
        while($row2 = mysqli_fetch_assoc($result2)){
            array_push($features, $row2);
        }
    }
    
    return $features;
}

if (isset($_POST['entity_id_delete'])) {

    include("../connection.php");

    $delete_entity_id = $_POST['entity_id_delete'];
    $lang = $_POST['lang'];
    
    $query = $con->query("DELETE FROM `entities` WHERE `id`='$delete_entity_id'");
    $query1 = $con->query("DELETE FROM `entities_images` WHERE `id`='$delete_entity_id'");
    $query2 = $con->query("DELETE FROM `features` WHERE `id`='$delete_entity_id'");

    if ($query && $query1 && $query2) {
        echo get_success($languages[$lang]["deletedSuccessfully"]);
    }
    
}

if (isset($_POST['entity_image_delete'])) {

    include("../connection.php");

    $delete_entity_id = $_POST['entity_image_delete'];
    $lang = $_POST['lang'];


    $query1 = $con->query("DELETE FROM `entities_images` WHERE `id`='$delete_entity_id'");
    $name = substr($_POST['name'], 8, strlen($_POST['name']));
    if (file_exists('..' . $name)) {
        unlink('..' . $name);
    }
    if ($query1) {
        echo get_success($languages[$lang]["deletedSuccessfully"]);
    }
    
}

if (isset($_POST['change_cat_status_off'])) {

    include("../connection.php");

    $change_status_off = $_POST['change_cat_status_off'];
    $lang = $_POST['lang'];
    
    $query = $con->query("update `entities` set display='0' WHERE `id`='$change_status_off'");

    if ($query) {
        echo get_success($languages[$lang]["changeSuccessfully"]);
    }
}

if (isset($_POST['change_cat_status_on'])) {

    include("../connection.php");

    $change_status_on = $_POST['change_cat_status_on'];
    $lang = $_POST['lang'];
    
    $query = $con->query("update `entities` set display='1' WHERE `id`='$change_status_on'");

    if ($query) {
        echo get_success($languages[$lang]["changeSuccessfully"]);
    }
}
?>