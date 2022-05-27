<?php

include "models/Model.php";
include "models/EventActivity.php";

$event_activityObj = new EventActivity();

if ($_POST['type'] == 'visible') {
    $event_activityObj->update([
        'id' => $_POST['id'],
        'display' => '1'
    ]);
} elseif ($_POST['type'] == 'hidden') {
    $event_activityObj->update([
        'id' => $_POST['id'],
        'display' => '0'
    ]);
} elseif($_POST['type'] == 'delete') {
    $event_activityObj->delete($_POST['id']);
    $name = strstr($_POST['image'], 'api/');
    if (is_file($name)) {
        unlink($name);
    }
    if (is_dir('api/uploads/events_activities/' . $_POST['id'])) {
        rmdir('api/uploads/events_activities/' . $_POST['id']);
    }
}

