<?php

include "models/Model.php";
include "models/Directors.php";

$directorObj = new Directors();

if ($_POST['type'] == 'visible') {
    $directorObj->update([
        'id' => $_POST['id'],
        'display' => '1'
    ]);
} elseif ($_POST['type'] == 'hidden') {
    $directorObj->update([
        'id' => $_POST['id'],
        'display' => '0'
    ]);
} elseif($_POST['type'] == 'delete') {
    $directorObj->delete($_POST['id']);
    $name = strstr($_POST['image'], 'api/');
    if (is_file($name)) {
        unlink($name);
    }
    if (is_dir('api/uploads/directors/' . $_POST['id'])) {
        rmdir('api/uploads/directors/' . $_POST['id']);
    }
}

