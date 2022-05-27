<?php

    include "models/Model.php";
    include "models/Setting.php";
    $settingObj = new Setting();
    if ($_POST['type'] == 'visible') {
        $settingObj->update([
            'id' => $_POST['id'],
            'display' => '1'
        ]);
    } elseif($_POST['type'] == 'hidden') {
        $settingObj->update([
            'id' => $_POST['id'],
            'display' => '0'
        ]);
    } elseif($_POST['type'] == 'delete') {
        $settingObj->delete($_POST['id']);
    }