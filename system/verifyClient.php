<?php

    include "models/Model.php";
    include "models/Client.php";
    $clientObj = new Client();
    if ($_POST['type'] == 'verify') {
        $clientObj->update([
            'id' => $_POST['id'],
            'verified' => '1'
        ]);
    } elseif($_POST['type'] == 'inVerify') {
        $clientObj->update([
            'id' => $_POST['id'],
            'verified' => '0'
        ]);
    } elseif($_POST['type'] == 'delete') {
        $clientObj->delete($_POST['id']);
        $name = strstr($_POST['image'], 'api/');
        if (is_file($name)) {
            unlink($name);
        }
        if (is_dir('api/uploads/clients/' . $_POST['id'])) {
            rmdir('api/uploads/clients/' . $_POST['id']);
        }
    }