<?php

include "models/Model.php";
include "models/Magazine.php";

$magazineObj = new Magazine();

if ($_POST['type'] == 'visible') {
    $magazineObj->update([
        'id' => $_POST['id'],
        'display' => '1'
    ]);
} elseif ($_POST['type'] == 'hidden') {
    $magazineObj->update([
        'id' => $_POST['id'],
        'display' => '0'
    ]);
} elseif($_POST['type'] == 'delete') {

    $magazineObj->delete($_POST['id']);

    $name = strstr($_POST['image'], 'api/');
    if (is_file($name)) {
        unlink($name);
    }
    if (is_dir('api/uploads/magazine/' . $_POST['id'])) {
        rmdir('api/uploads/magazine/' . $_POST['id']);
    }
}

