<?php

include "models/Model.php";
include "models/Orders.php";

$orderObj = new Orders();

if ($_POST['type'] == 'visible') {
    $orderObj->update([
        'id' => $_POST['id'],
        'display' => '1'
    ]);
} elseif ($_POST['type'] == 'hidden') {
    $orderObj->update([
        'id' => $_POST['id'],
        'display' => '0'
    ]);
} elseif($_POST['type'] == 'delete') {
    $orderObj->delete($_POST['id']);
    $name = strstr($_POST['image'], 'api/');
    if (is_file($name)) {
        unlink($name);
    }
    if (is_dir('api/uploads/orders/' . $_POST['id'])) {
        rmdir('api/uploads/orders/' . $_POST['id']);
    }
}

