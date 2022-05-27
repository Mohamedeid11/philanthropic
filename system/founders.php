<?php

include "models/Model.php";
include "models/Founders.php";

$founderObj = new Founders();

if ($_POST['type'] == 'visible') {
    $founderObj->update([
        'id' => $_POST['id'],
        'display' => '1'
    ]);
} elseif ($_POST['type'] == 'hidden') {
    $founderObj->update([
        'id' => $_POST['id'],
        'display' => '0'
    ]);
} elseif($_POST['type'] == 'delete') {
    $founderObj->delete($_POST['id']);
    $name = strstr($_POST['image'], 'api/');
    if (is_file($name)) {
        unlink($name);
    }
    if (is_dir('api/uploads/founders/' . $_POST['id'])) {
        rmdir('api/uploads/founders/' . $_POST['id']);
    }
}

