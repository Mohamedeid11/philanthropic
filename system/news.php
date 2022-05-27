<?php

include "models/Model.php";
include "models/News.php";

$newsObj = new News();

if ($_POST['type'] == 'visible') {
    $newsObj->update([
        'id' => $_POST['id'],
        'display' => '1'
    ]);
} elseif ($_POST['type'] == 'hidden') {
    $newsObj->update([
        'id' => $_POST['id'],
        'display' => '0'
    ]);
} elseif($_POST['type'] == 'delete') {
    $newsObj->delete($_POST['id']);
    $name = strstr($_POST['image'], 'api/');
    if (is_file($name)) {
        unlink($name);
    }
    if (is_dir('api/uploads/news/' . $_POST['id'])) {
        rmdir('api/uploads/news/' . $_POST['id']);
    }
}

