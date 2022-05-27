<?php

include "models/Model.php";
include "models/Slider.php";

$sliderObj = new Slider();

if ($_POST['type'] == 'visible') {
    $sliderObj->update([
        'id' => $_POST['id'],
        'display' => '1'
    ]);
} elseif ($_POST['type'] == 'hidden') {
    $sliderObj->update([
        'id' => $_POST['id'],
        'display' => '0'
    ]);
} elseif($_POST['type'] == 'delete') {
    $sliderObj->delete($_POST['id']);
    $name = strstr($_POST['image'], 'api/');

    if (is_file($name)) {
        unlink($name);
    }

    if (is_dir('api/uploads/slider/' . $_POST['id'])) {
        rmdir('api/uploads/slider/' . $_POST['id']);
    }
}

