<?php

include "models/Model.php";
include "models/Donate.php";

$donateObj = new Donate();

if ($_POST['type'] == 'visible') {
    $donateObj->update([
        'id' => $_POST['id'],
        'display' => '1'
    ]);
} elseif ($_POST['type'] == 'hidden') {
    $donateObj->update([
        'id' => $_POST['id'],
        'display' => '0'
    ]);
} elseif($_POST['type'] == 'delete') {
    $donateObj->delete($_POST['id']);
    $name = strstr($_POST['image'], 'api/');
    if (is_file($name)) {
        unlink($name);
    }
    if (is_dir('api/uploads/donates/' . $_POST['id'])) {
        rmdir('api/uploads/donates/' . $_POST['id']);
    }
}

