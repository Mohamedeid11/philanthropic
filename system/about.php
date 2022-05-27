<?php

include "models/Model.php";
include "models/About.php";

$aboutObj = new About();

if ($_POST['type'] == 'visible') {
    $aboutObj->update([
        'id' => $_POST['id'],
        'display' => '1'
    ]);
} elseif ($_POST['type'] == 'hidden') {
    $aboutObj->update([
        'id' => $_POST['id'],
        'display' => '0'
    ]);
} elseif($_POST['type'] == 'delete') {
    $aboutObj->delete($_POST['id']);
}

