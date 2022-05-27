<?php

include "models/Model.php";
include "models/Committees.php";

$committeeObj = new Committees();

if ($_POST['type'] == 'visible') {
    $committeeObj->update([
        'id' => $_POST['id'],
        'display' => '1'
    ]);
} elseif ($_POST['type'] == 'hidden') {
    $committeeObj->update([
        'id' => $_POST['id'],
        'display' => '0'
    ]);
} elseif($_POST['type'] == 'delete') {
    $committeeObj->delete($_POST['id']);
    $name = strstr($_POST['image'], 'api/');
    if (is_file($name)) {
        unlink($name);
    }
    if (is_dir('api/uploads/committees/' . $_POST['id'])) {
        rmdir('api/uploads/committees/' . $_POST['id']);
    }
}

