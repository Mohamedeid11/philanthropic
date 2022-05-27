<?php

include "models/Model.php";
include "models/User.php";
$userObj = new User();
if ($_POST['type'] == 'disable') {
    $userObj->update([
        'id' => $_POST['id'],
        'status' => '0'
    ]);
} elseif($_POST['type'] == 'enable') {
    $userObj->update([
        'id' => $_POST['id'],
        'status' => '1'
    ]);
} elseif($_POST['type'] == 'delete') {
    $userObj->delete($_POST['id']);
    $name = strstr($_POST['image'], 'api/');
    if (is_file($name)) {
        unlink($name);
    }
    if (is_dir('api/uploads/users/' . $_POST['id'])) {
        rmdir('api/uploads/users/' . $_POST['id']);
    }
}