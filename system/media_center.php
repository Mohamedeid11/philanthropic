<?php

include "models/Model.php";
include "models/MediaCenter.php";

$media_centerObj = new MediaCenter();

if ($_POST['type'] == 'visible') {
    $media_centerObj->update([
        'id' => $_POST['id'],
        'display' => '1'
    ]);
} elseif ($_POST['type'] == 'hidden') {
    $media_centerObj->update([
        'id' => $_POST['id'],
        'display' => '0'
    ]);
} elseif($_POST['type'] == 'delete') {
    $media_centerObj->delete($_POST['id']);
    $name = strstr($_POST['image'], 'api/');
    if (is_file($name)) {
        unlink($name);
    }
    if (is_dir('api/uploads/media_center/' . $_POST['id'])) {
        rmdir('api/uploads/media_center/' . $_POST['id']);
    }
}

